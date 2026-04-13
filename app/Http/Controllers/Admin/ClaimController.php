<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClaimRequest;
use App\Http\Requests\Admin\UpdateClaimRequest;
use App\Models\Claim;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClaimController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Claim::with('images');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('member_name', 'like', "%{$search}%")
                  ->orWhere('school', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('compensation_amount', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Determine which date field to use for range filtering and default sorting
        $dateField = ($request->status === 'published') ? 'published_at' : 'created_at';

        // Filter by Date Range
        if ($request->filled('start_date')) {
            $query->whereDate($dateField, '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate($dateField, '<=', $request->end_date);
        }

        $claims = $query->orderBy($dateField, 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.claims.partials.table', compact('claims'))->render();
        }

        return view('admin.claims.index', compact('claims'));
    }

    public function create()
    {
        return view('admin.claims.create');
    }

    public function store(StoreClaimRequest $request)
    {
        $data = $request->validated();
        $data['title'] = $data['title'] ?? $data['member_name'];
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['created_by'] = Auth::id();

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        $claim = Claim::create($data);

        // Handle multiple images
        if ($request->has('image_urls')) {
            foreach ($request->image_urls as $index => $url) {
                $path = $this->finalizeImage($url);
                if ($path) {
                    $claim->images()->create([
                        'image_path' => $path,
                        'sort_order' => $index + 1
                    ]);
                }
            }
        }

        ActivityLog::record('create', "Bukti Tuntutan baru dicipta: {$claim->title}", $claim);

        return redirect()->route('admin.claims.index')->with('success', 'Bukti Tuntutan berjaya ditambah!');
    }

    public function edit(Claim $claim)
    {
        return view('admin.claims.edit', compact('claim'));
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        $data = $request->validated();

        if ($data['status'] === 'published' && !$claim->published_at) {
            $data['published_at'] = now();
        }

        $data['updated_by'] = Auth::id();
        $claim->update($data);

        // Sync multiple images
        if ($request->has('image_urls')) {
            $newPaths = [];
            foreach ($request->image_urls as $index => $url) {
                $path = $this->finalizeImage($url);
                if ($path) {
                    $newPaths[] = $path;
                }
            }

            // Delete images not in new set
            $oldImages = $claim->images()->get();
            foreach ($oldImages as $oldImage) {
                if ($oldImage->image_path && !in_array($oldImage->image_path, $newPaths)) {
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }
            }

            // Update/Create new images
            foreach ($newPaths as $index => $path) {
                $claim->images()->updateOrCreate(
                    ['image_path' => $path],
                    ['sort_order' => $index + 1]
                );
            }
        }

        ActivityLog::record('update', "Bukti Tuntutan dikemaskini: {$claim->title}", $claim);

        return redirect()->route('admin.claims.index')->with('success', 'Bukti Tuntutan berjaya dikemaskini!');
    }

    public function destroy(Claim $claim)
    {
        foreach ($claim->images as $image) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        $claim->images()->delete();

        ActivityLog::record('delete', "Bukti Tuntutan dipadam: {$claim->title}", $claim);
        $claim->delete();

        return redirect()->route('admin.claims.index')->with('success', 'Bukti Tuntutan berjaya dipadam!');
    }

    private function finalizeImage($url)
    {
        if (!$url) return null;

        $path = parse_url($url, PHP_URL_PATH);
        
        // If it's already a clean path (no /storage/), just return it
        if (!str_contains($path, '/storage/claims/temp/')) {
            return ltrim(str_replace('/storage/', '', $path), '/');
        }

        $filename = basename($path);
        $oldPath = 'claims/temp/' . $filename;
        $newPath = 'claims/main/' . $filename;

        // Ensure directory exists
        if (!Storage::disk('public')->exists('claims/main')) {
            Storage::disk('public')->makeDirectory('claims/main');
        }

        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->move($oldPath, $newPath);
            return $newPath;
        }

        return ltrim(str_replace('/storage/', '', $path), '/');
    }
}
