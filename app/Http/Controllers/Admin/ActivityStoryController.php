<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityStory;
use App\Http\Requests\Admin\StoreActivityStoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityStoryController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = ActivityStory::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tag', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if (in_array($request->status, ['draft', 'published', 'archived'])) {
                $query->where('status', $request->status);
            } elseif ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Determine date field
        $dateField = ($request->status === 'active') ? 'event_date' : 'created_at';

        // Filter by Date Range
        if ($request->filled('start_date')) {
            $query->whereDate($dateField, '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate($dateField, '<=', $request->end_date);
        }

        $stories = $query->orderBy('sort_order', 'asc')
                         ->orderBy($dateField, 'desc')
                         ->paginate(10)
                         ->withQueryString();

        if ($request->ajax()) {
            return view('admin.activity-stories.partials.table', compact('stories'))->render();
        }

        return view('admin.activity-stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.activity-stories.create');
    }

    public function store(StoreActivityStoryRequest $request)
    {
        $data = $request->validated();
        
        // Handle images
        if ($request->filled('image_urls')) {
            $data['images'] = $this->finalizeImages($request->image_urls);
            $data['image_path'] = $data['images'][0] ?? null;
        }

        // Set is_active and published_at based on status
        $data['is_active'] = ($data['status'] === 'published');
        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        $story = ActivityStory::create($data);

        ActivityLog::record('create', "Cerita Aktiviti Kami dicipta: {$story->title}", $story);

        return redirect()->route('admin.activity-stories.index')->with('success', 'Cerita berjaya dicipta!');
    }

    public function edit(ActivityStory $activity_story)
    {
        return view('admin.activity-stories.edit', ['story' => $activity_story]);
    }

    public function update(StoreActivityStoryRequest $request, ActivityStory $activity_story)
    {
        $data = $request->validated();

        // Handle images
        if ($request->filled('image_urls')) {
            $data['images'] = $this->finalizeImages($request->image_urls, $activity_story->images ?? []);
            $data['image_path'] = $data['images'][0] ?? null;
            
            // Cleanup deleted images from storage
            $oldImages = $activity_story->images ?? [];
            foreach ($oldImages as $old) {
                if (!in_array($old, $data['images'])) {
                    Storage::disk('public')->delete($old);
                }
            }
        } else {
            // If all images removed
            if ($activity_story->images) {
                foreach ($activity_story->images as $img) {
                    Storage::disk('public')->delete($img);
                }
            }
            $data['images'] = [];
            $data['image_path'] = null;
        }

        // Handle Status Transition
        // BLOCK: Published -> Draft transition
        // BLOCK: Published/Archived -> Draft transition
        if ($activity_story->status !== 'draft' && $data['status'] === 'draft') {
            return back()->withErrors(['status' => 'Cerita yang telah diterbitkan atau diarkibkan tidak boleh ditukar semula kepada draf.'])->withInput();
        }

        $data['is_active'] = ($data['status'] === 'published');
        if ($data['status'] === 'published' && !$activity_story->published_at) {
            $data['published_at'] = now();
        }

        $activity_story->update($data);

        ActivityLog::record('update', "Cerita Aktiviti Kami dikemaskini: {$activity_story->title}", $activity_story);

        return redirect()->route('admin.activity-stories.index')->with('success', 'Cerita berjaya dikemaskini!');
    }

    public function destroy(ActivityStory $activity_story)
    {
        // Cleanup all images
        if ($activity_story->images) {
            foreach ($activity_story->images as $img) {
                Storage::disk('public')->delete($img);
            }
        } elseif ($activity_story->image_path) {
            Storage::disk('public')->delete($activity_story->image_path);
        }

        ActivityLog::record('delete', "Cerita Aktiviti Kami dipadam: {$activity_story->title}", $activity_story);
        $activity_story->delete();

        return redirect()->route('admin.activity-stories.index')->with('success', 'Cerita berjaya dipadam!');
    }

    /**
     * Handle AJAX image upload (Temporary).
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $path = $request->file('image')->store('activity_stories/temp', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }

    /**
     * Finalize images from temp to permanent storage.
     */
    private function finalizeImages($urls, $existingImages = [])
    {
        $finalPaths = [];

        foreach ($urls as $url) {
            // Already permanent if it contains the permanent folder
            if (Str::contains($url, '/storage/activity_stories/') && !Str::contains($url, '/temp/')) {
                $path = str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));
                $finalPaths[] = $path;
                continue;
            }

            // Example temp path: /storage/activity_stories/temp/filename.jpg
            $tempPath = str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));

            if (Storage::disk('public')->exists($tempPath)) {
                $filename = basename($tempPath);
                $newPath = 'activity_stories/' . $filename;
                
                // Move from temp to permanent
                Storage::disk('public')->move($tempPath, $newPath);
                $finalPaths[] = $newPath;
            }
        }

        return $finalPaths;
    }
}
