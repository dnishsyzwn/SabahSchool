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

        // Active filter
        if ($request->filled('status')) {
            if ($request->status === 'active')   $query->where('is_active', true);
            if ($request->status === 'inactive') $query->where('is_active', false);
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
        
        if ($request->filled('image_path')) {
            $data['image_path'] = $this->finalizeImage($request->image_path);
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

        if ($request->filled('image_path') && $request->image_path !== Storage::url($activity_story->image_path)) {
            // Delete old image
            if ($activity_story->image_path) {
                Storage::disk('public')->delete($activity_story->image_path);
            }
            $data['image_path'] = $this->finalizeImage($request->image_path);
        }

        $activity_story->update($data);

        ActivityLog::record('update', "Cerita Aktiviti Kami dikemaskini: {$activity_story->title}", $activity_story);

        return redirect()->route('admin.activity-stories.index')->with('success', 'Cerita berjaya dikemaskini!');
    }

    public function destroy(ActivityStory $activity_story)
    {
        if ($activity_story->image_path) {
            Storage::disk('public')->delete($activity_story->image_path);
        }

        ActivityLog::record('delete', "Cerita Aktiviti Kami dipadam: {$activity_story->title}", $activity_story);
        $activity_story->delete();

        return redirect()->route('admin.activity-stories.index')->with('success', 'Cerita berjaya dipadam!');
    }

    /**
     * Move image from temp to permanent storage.
     */
    private function finalizeImage($tempUrl)
    {
        if (!$tempUrl) return null;

        // If it's already a permanent URL, extract the path
        if (Str::contains($tempUrl, '/storage/activity_stories/')) {
            return str_replace('/storage/', '', parse_url($tempUrl, PHP_URL_PATH));
        }

        // Example temp path: /storage/claims/temp/filename.jpg
        $tempPath = str_replace('/storage/', '', parse_url($tempUrl, PHP_URL_PATH));

        if (Storage::disk('public')->exists($tempPath)) {
            $filename = basename($tempPath);
            $newPath = 'activity_stories/' . $filename;
            Storage::disk('public')->move($tempPath, $newPath);
            return $newPath;
        }

        return null;
    }
}
