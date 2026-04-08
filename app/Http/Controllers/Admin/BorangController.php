<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Borang;
use App\Http\Requests\Admin\StoreBorangRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivityLog;

class BorangController extends Controller
{
    public function index()
    {
        $borangs = Borang::latest()->paginate(15);
        return view('admin.borang-pintar.index', compact('borangs'));
    }

    public function store(StoreBorangRequest $request)
    {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('borangs', $fileName, 'public');

        // Format file size
        $size = $file->getSize();
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) $size /= 1024;
        $fileSize = round($size, 2) . ' ' . $units[$i];

        $borang = Borang::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_size' => $fileSize,
        ]);

        ActivityLog::record('create', "Borang baru dimuat naik: {$borang->title}", $borang);

        return redirect()->route('admin.borang-pintar.index')->with('success', 'Borang berjaya dimuat naik!');
    }

    public function destroy(Borang $borang_pintar)
    {
        if ($borang_pintar->file_path && Storage::disk('public')->exists($borang_pintar->file_path)) {
            Storage::disk('public')->delete($borang_pintar->file_path);
        }

        ActivityLog::record('delete', "Borang dipadam: {$borang_pintar->title}", $borang_pintar);
        //$borang_pintar->delete();
        $borang_pintar->delete();

        return redirect()->route('admin.borang-pintar.index')->with('success', 'Borang berjaya dipadam!');
    }
}
