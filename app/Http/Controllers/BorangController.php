<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Borang;

class BorangController extends Controller
{
    public function index()
    {
        $borangs = Borang::latest()->get();
        return view('pages.muat-turun', compact('borangs'));
    }
}
