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
        $data['content']   = $this->finalizeEditorImages($data['content']);
        $data['slug']      = Str::slug($data['title']) . '-' . time();
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data['author_id'] = $user->id;

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        if ($request->filled('thumbnail_url')) {
            $data['thumbnail'] = $this->finalizeThumbnail($request->thumbnail_url);
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

        if ($request->filled('thumbnail_url')) {
            // Delete old thumbnail
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $data['thumbnail'] = $this->finalizeThumbnail($request->thumbnail_url);
        } elseif ($request->has('thumbnail_url') && empty($request->thumbnail_url)) {
            // User removed thumbnail
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $data['thumbnail'] = null;
        }

        $data['content'] = $this->finalizeEditorImages($data['content']);
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

        // Delete all editor images
        $content = json_decode($news->content, true);
        if ($content && isset($content['blocks'])) {
            foreach ($content['blocks'] as $block) {
                if ($block['type'] === 'image' && isset($block['data']['url'])) {
                    $path = str_replace('/storage/', '', parse_url($block['data']['url'], PHP_URL_PATH));
                    Storage::disk('public')->delete($path);
                }
                if ($block['type'] === 'gallery' && isset($block['data']['images'])) {
                    foreach ($block['data']['images'] as $img) {
                        $path = str_replace('/storage/', '', parse_url($img['url'], PHP_URL_PATH));
                        Storage::disk('public')->delete($path);
                    }
                }
            }
        }

        ActivityLog::record('delete', "Artikel berita dipadam: {$news->title}", $news);

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Artikel berjaya dipadam!');
    }

    /**
     * Move images from temp to permanent storage and update JSON.
     */
    private function finalizeEditorImages($contentJson)
    {
        if (!$contentJson) return $contentJson;

        // Pattern to find temp images in the JSON: /storage/news/temp/filename.ext
        $pattern = '/\/storage\/news\/temp\/([a-zA-Z0-9_.\-]+)/';
        
        if (preg_match_all($pattern, $contentJson, $matches)) {
            foreach ($matches[1] as $filename) {
                $oldPath = 'news/temp/' . $filename;
                $newPath = 'news/content-images/' . $filename;

                if (Storage::disk('public')->exists($oldPath)) {
                    // Move file to permanent storage
                    Storage::disk('public')->move($oldPath, $newPath);
                    
                    // Update URL in JSON
                    $contentJson = str_replace(
                        '/storage/news/temp/' . $filename,
                        '/storage/news/content-images/' . $filename,
                        $contentJson
                    );
                }
            }
        }

        return $contentJson;
    }

    /**
     * Move thumbnail from temp to permanent storage.
     */
    private function finalizeThumbnail($url)
    {
        if (!$url || !str_contains($url, '/storage/news/temp/')) {
            return str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));
        }

        $filename = basename(parse_url($url, PHP_URL_PATH));
        $oldPath = 'news/temp/' . $filename;
        $newPath = 'news/thumbnails/' . $filename;

        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->move($oldPath, $newPath);
            return $newPath;
        }

        return str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));
    }
}
