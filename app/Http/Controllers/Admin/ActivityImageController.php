<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityImageController extends Controller
{
    /**
     * Handle image upload to temp storage.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        $path = $request->file('image')->store('activities/temp', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }
}
