<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Borang;
use App\Models\FormSubmission;
use App\Models\FormType;
use App\Mail\FormSubmissionEmail;
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'form_type' => 'required|string',
            'subject' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'message' => 'nullable|string',
        ]);

        // Find or create the form type ID based on the selection
        // Since file_path is nullable now, we can just use firstOrCreate
        $formType = FormType::firstOrCreate(['name' => $request->form_type]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        $submission = FormSubmission::create([
            'form_type_id' => $formType->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'file_path' => $filePath,
        ]);

        // Send Email Notification (SMTP)
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
