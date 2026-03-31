<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use App\Models\ActivityLog;
use App\Models\NewsCategory;
use App\Models\NewsPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $posts = NewsPost::with(['category', 'author'])
            ->latest()
            ->paginate(15);

        return view('admin.news.index', compact('posts'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('name')->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();
        $data['slug']      = Str::slug($data['title']) . '-' . time();
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data['author_id'] = $user->id;

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('news/thumbnails', 'public');
        }

        $post = NewsPost::create($data);

        ActivityLog::record('create', "Artikel berita dibuat: {$post->title}", $post);

        return redirect()->route('admin.news.index')->with('success', 'Artikel berjaya ditambah!');
    }

    public function show(NewsPost $news)
    {
        return redirect()->route('admin.news.edit', $news);
    }

    public function edit(NewsPost $news)
    {
        $categories = NewsCategory::orderBy('name')->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(UpdateNewsRequest $request, NewsPost $news)
    {
        $data = $request->validated();

        if ($data['status'] === 'published' && !$news->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('news/thumbnails', 'public');
        }

        $news->update($data);

        ActivityLog::record('update', "Artikel berita dikemaskini: {$news->title}", $news);

        return redirect()->route('admin.news.index')->with('success', 'Artikel berjaya dikemaskini!');
    }

    public function destroy(NewsPost $news)
    {
        // Delete thumbnail from storage
        if ($news->thumbnail) {
            Storage::disk('public')->delete($news->thumbnail);
        }

        ActivityLog::record('delete', "Artikel berita dipadam: {$news->title}", $news);

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Artikel berjaya dipadam!');
    }
}
