<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borang;
use App\Models\FormSubmission;
use App\Models\FormType;
use App\Mail\FormSubmissionEmail;
use App\Rules\CloudflareTurnstile;
use App\Rules\MalaysianIc;
use App\Rules\ValidEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class BorangController extends Controller
{
    public function index()
    {
        $borangs = Borang::latest()->get();
        return view('pages.muat-turun', compact('borangs'));
    }

    public function hantar()
    {
        $borangs = Borang::latest()->get();
        return view('pages.hantar-borang', compact('borangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cf-turnstile-response' => ['required', new CloudflareTurnstile()],
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'max:255', new ValidEmail()],
            'ic'        => ['nullable', new MalaysianIc()],
            'phone'     => 'required|string|max:20',
            'form_type' => 'required|string',
            'subject'   => 'required|string|max:255',
            'file'      => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'message'   => 'nullable|string',
        ], [
            'cf-turnstile-response.required' => 'Sila selesaikan pengesahan keselamatan (CAPTCHA).',
        ]);

        // Normalise IC
        $icNormalized = $request->filled('ic')
            ? str_replace('-', '', $request->ic)
            : null;

        $formType = FormType::firstOrCreate(['name' => $request->form_type]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        $submission = FormSubmission::create([
            'form_type_id' => $formType->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'ic'           => $icNormalized,
            'phone'        => $request->phone,
            'subject'      => $request->subject,
            'message'      => $request->message,
            'file_path'    => $filePath,
        ]);

        // Send Email Notification
        try {
            $adminEmail = \App\Models\SiteSetting::get('admin_email', config('mail.from.address'));
            Mail::to($adminEmail)->send(new FormSubmissionEmail($submission));
            $submission->update(['email_notified' => true]);
        } catch (\Throwable $e) {
            Log::error("Gagal menghantar emel penghantaran borang: " . $e->getMessage());
        }

        return back()->with('success', 'Borang anda telah berjaya dihantar. Pihak kami akan memprosesnya dalam masa 3-5 hari bekerja.');
    }
}
