<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class PublicActivityController extends Controller
{
    public function index()
    {
        $featured = Activity::with('images')
            ->where('is_featured', true)
            ->where('status', 'published')
            ->first();

        // If no featured, get latest published
        if (!$featured) {
            $featured = Activity::with('images')
                ->where('status', 'published')
                ->latest('event_date')
                ->first();
        }

        $activities = Activity::with('images')
            ->where('status', 'published')
            ->where('id', '!=', $featured?->id)
            ->latest('event_date')
            ->get();

        return view('pages.aktiviti-kami', compact('featured', 'activities'));
    }
}
