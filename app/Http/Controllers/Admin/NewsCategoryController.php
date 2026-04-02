<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    /**
     * Store a new category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:news_categories,name'],
        ]);

        $category = NewsCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'ok' => true,
            'category' => $category
        ]);
    }

    /**
     * Delete a category if not in use.
     */
    public function destroy(NewsCategory $category)
    {
        if ($category->posts()->exists()) {
            return response()->json([
                'ok' => false,
                'message' => 'Gagal padam: Kategori ini sedang digunakan oleh beberapa artikel berita.'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'ok' => true
        ]);
    }

    /**
     * List categories for searching/refreshing.
     */
    public function index()
    {
        $categories = NewsCategory::orderBy('name')->get();
        return response()->json($categories);
    }
}
