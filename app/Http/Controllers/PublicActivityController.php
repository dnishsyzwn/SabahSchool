<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityStory;
use Illuminate\Http\Request;

class PublicActivityController extends Controller
{
    public function index()
    {
        $stories = ActivityStory::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.aktiviti-kami', compact('stories'));
    }
}
