<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class NewsImageController extends Controller
{
    /**
     * Handle inline image upload from Trix editor.
     * Returns the image URL for embedding into the editor.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        $path = $request->file('image')->store('news/temp', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }

    /**
     * Delete an inline image that was removed from the editor.
     */
    public function destroy(Request $request)
    {
        $request->validate(['url' => ['required', 'string']]);

        // Get the path from the URL accurately
        $urlPath = parse_url($request->url, PHP_URL_PATH);
        
        // Robust strip of /storage/ or variants
        $path = preg_replace('/^.*?storage\//', '', $urlPath);
        $path = ltrim($path, '/');

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['ok' => true, 'deleted' => $path]);
        }

        return response()->json(['ok' => false, 'message' => 'File not found', 'path' => $path], 404);
    }
}
