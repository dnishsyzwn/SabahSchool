<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use App\Models\NewsPost;
use Illuminate\Http\Request;

class NewsPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsPost::with(['category', 'author'])
            ->where('status', 'published')
            ->latest('published_at');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $query->where('category_id', $category);
        }

        $posts      = $query->paginate(9);
        $categories = NewsCategory::withCount(['posts' => fn($q) => $q->where('status', 'published')])->get();

        return view('pages.berita', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = NewsPost::with(['category', 'author', 'images'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment view count
        $post->increment('view_count');

        // Related news (same category, exclude current)
        $related = NewsPost::with(['category'])
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn($q) => $q->where('category_id', $post->category_id))
            ->latest('published_at')
            ->take(3)
            ->get();

        // Recent sidebar posts
        $recentPosts = NewsPost::with(['category'])
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('pages.berita-detail', compact('post', 'related', 'recentPosts'));
    }
}
