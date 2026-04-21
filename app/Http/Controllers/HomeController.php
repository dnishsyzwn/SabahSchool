<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with latest news.
     */
    public function index()
    {
        // Fetch 9 latest published news posts
        $news = NewsPost::where('status', 'published')
            ->latest('published_at')
            ->take(9)
            ->get();

        return view('pages.home', compact('news'));
    }
}
