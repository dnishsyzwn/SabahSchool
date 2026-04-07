<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'active')->latest()->get();
        return view('pages.kerjaya', compact('jobs'));
    }

    public function show($slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        return view('pages.kerjaya-detail', compact('job'));
    }
}
