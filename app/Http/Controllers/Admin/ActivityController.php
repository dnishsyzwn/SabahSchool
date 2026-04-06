<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreActivityRequest;
use App\Http\Requests\Admin\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('images')->latest()->paginate(15);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(StoreActivityRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['created_by'] = Auth::id();

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        // Handle featured activity
        if ($request->boolean('is_featured')) {
            Activity::where('is_featured', true)->update(['is_featured' => false]);
            $data['is_featured'] = true;
        } else {
            $data['is_featured'] = false;
        }

        $activity = Activity::create($data);

        // Handle multiple images
        if ($request->has('image_urls')) {
            foreach ($request->image_urls as $index => $url) {
                $path = $this->finalizeImage($url);
                if ($path) {
                    $activity->images()->create([
                        'image_path' => $path,
                        'sort_order' => $index + 1
                    ]);
                }
            }
        }

        ActivityLog::record('create', "Aktiviti baru dicipta: {$activity->title}", $activity);

        return redirect()->route('admin.activities.index')->with('success', 'Aktiviti berjaya ditambah!');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $data = $request->validated();

        if ($data['status'] === 'published' && !$activity->published_at) {
            $data['published_at'] = now();
        }

        // Handle featured activity
        if ($request->boolean('is_featured')) {
            Activity::where('is_featured', true)->where('id', '!=', $activity->id)->update(['is_featured' => false]);
            $data['is_featured'] = true;
        } else {
            $data['is_featured'] = false;
        }

        $data['updated_by'] = Auth::id();
        $activity->update($data);

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
            $oldImages = $activity->images()->get();
            foreach ($oldImages as $oldImage) {
                if (!in_array($oldImage->image_path, $newPaths)) {
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }
            }

            // Update/Create new images
            foreach ($newPaths as $index => $path) {
                $activity->images()->updateOrCreate(
                    ['image_path' => $path],
                    ['sort_order' => $index + 1]
                );
            }
        }

        ActivityLog::record('update', "Aktiviti dikemaskini: {$activity->title}", $activity);

        return redirect()->route('admin.activities.index')->with('success', 'Aktiviti berjaya dikemaskini!');
    }

    public function destroy(Activity $activity)
    {
        foreach ($activity->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $activity->images()->delete();

        ActivityLog::record('delete', "Aktiviti dipadam: {$activity->title}", $activity);
        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Aktiviti berjaya dipadam!');
    }

    private function finalizeImage($url)
    {
        if (!$url) return null;

        $path = parse_url($url, PHP_URL_PATH);
        
        // If it's already a clean path (no /storage/), just return it
        if (!str_contains($path, '/storage/activities/temp/')) {
            return ltrim(str_replace('/storage/', '', $path), '/');
        }

        $filename = basename($path);
        $oldPath = 'activities/temp/' . $filename;
        $newPath = 'activities/main/' . $filename;

        // Ensure directory exists
        if (!Storage::disk('public')->exists('activities/main')) {
            Storage::disk('public')->makeDirectory('activities/main');
        }

        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->move($oldPath, $newPath);
            return $newPath;
        }

        return ltrim(str_replace('/storage/', '', $path), '/');
    }
}
