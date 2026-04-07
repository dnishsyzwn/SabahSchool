<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(15);
        return view('admin.kerjaya.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.kerjaya.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'salary_range' => 'nullable|string|max:255',
            'deadline' => 'required|date',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'status' => 'required|in:active,closed,draft',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['posted_by'] = Auth::id();

        $job = Job::create($data);

        ActivityLog::record('create', "Jawatan kerjaya baru dicipta: {$job->title}", $job);

        return redirect()->route('admin.kerjaya.index')->with('success', 'Jawatan berjaya ditambah!');
    }

    public function edit(Job $kerjaya)
    {
        return view('admin.kerjaya.edit', ['job' => $kerjaya]);
    }

    public function update(Request $request, Job $kerjaya)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'salary_range' => 'nullable|string|max:255',
            'deadline' => 'required|date',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'status' => 'required|in:active,closed,draft',
        ]);

        $kerjaya->update($data);

        ActivityLog::record('update', "Jawatan kerjaya dikemaskini: {$kerjaya->title}", $kerjaya);

        return redirect()->route('admin.kerjaya.index')->with('success', 'Jawatan berjaya dikemaskini!');
    }

    public function destroy(Job $kerjaya)
    {
        ActivityLog::record('delete', "Jawatan kerjaya dipadam: {$kerjaya->title}", $kerjaya);
        $kerjaya->delete();

        return redirect()->route('admin.kerjaya.index')->with('success', 'Jawatan berjaya dipadam!');
    }
}
