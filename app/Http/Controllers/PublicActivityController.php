<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityStory;
use Illuminate\Http\Request;

class PublicActivityController extends Controller
{
    public function index()
    {
        $stories = ActivityStory::where('status', 'published')
            ->orWhere(function($query) {
                $query->whereNull('status')->where('is_active', true);
            })
            ->orderBy('event_date', 'desc')
            ->paginate(6);

        return view('pages.aktiviti-kami', compact('stories'));
    }
}
