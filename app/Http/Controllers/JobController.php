<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Rules\CloudflareTurnstile;
use App\Rules\MalaysianIc;
use App\Rules\ValidEmail;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'cf-turnstile-response' => ['required', new CloudflareTurnstile()],
            'name'    => 'required|string|max:255',
            'email'   => ['required', 'max:255', new ValidEmail()],
            'ic'      => ['nullable', new MalaysianIc()],
            'alamat'  => 'required|string',
            'phone'   => 'required|string|max:20',
            'resume'  => 'required|file|mimes:pdf,doc,docx|max:10240',
            'message' => 'nullable|string',
        ], [
            'cf-turnstile-response.required' => 'Sila selesaikan pengesahan keselamatan (CAPTCHA).',
        ]);

        // Normalise IC
        $icNormalized = $request->filled('ic')
            ? str_replace('-', '', $request->ic)
            : null;

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        $application = \App\Models\JobApplication::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'ic'          => $icNormalized,
            'alamat'      => $request->alamat,
            'phone'       => $request->phone,
            'resume_path' => $resumePath,
            'message'     => $request->message,
        ]);

        // Send Email Notification
        try {
            $adminEmail = \App\Models\SiteSetting::get('admin_email', config('mail.from.address'));
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\JobApplicationEmail($application));
            $application->update(['email_notified' => true]);
        } catch (\Throwable $e) {
            Log::error("Gagal menghantar emel permohonan kerjaya: " . $e->getMessage());
        }

        return back()->with('success', 'Permohonan anda telah berjaya dihantar. Pihak kami akan menghubungi anda jika terpilih.');
    }
}
