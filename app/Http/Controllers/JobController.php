<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        return view('pages.kerjaya');
    }

    public function show($slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        return view('pages.kerjaya-detail', compact('job'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ic_no' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
            'message' => 'nullable|string',
        ]);

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $validated['resume_path'] = $path;
        }

        $application = \App\Models\JobApplication::create($validated);

        // Send Email Notification
        try {
            $adminEmail = \App\Models\SiteSetting::get('admin_email', config('mail.from.address'));
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\JobApplicationEmail($application));
            
            $application->update(['email_notified' => true]);
        } catch (\Exception $e) {
            \Log::error("Gagal menghantar emel permohonan kerjaya: " . $e->getMessage());
        }

        return back()->with('success', 'Permohonan anda telah berjaya dihantar. Pihak kami akan menghubungi anda jika terpilih.');
    }
}
