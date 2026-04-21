<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Rules\CloudflareTurnstile;
use App\Rules\MalaysianIc;
use App\Rules\ValidEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageEmail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.hubungi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cf-turnstile-response' => ['required', new CloudflareTurnstile()],
            'name'    => 'required|string|max:255',
            'email'   => ['required', 'max:255', new ValidEmail()],
            'ic'      => ['required', new MalaysianIc()],
            'phone'   => 'required|string|min:10|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'school'  => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'cf-turnstile-response.required' => 'Sila selesaikan pengesahan keselamatan (CAPTCHA).',
            'phone.regex' => 'Format nombor telefon tidak sah.',
            'phone.min' => 'Nombor telefon mesti mengandungi sekurang-kurangnya 10 digit.',
        ]);

        // Normalise IC — strip dashes, store as 12 digits
        $icNormalized = $request->filled('ic')
            ? str_replace('-', '', $request->ic)
            : null;

        $message = ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'ic'      => $icNormalized,
            'phone'   => $request->phone,
            'school'  => $request->school,
            'message' => $request->message,
        ]);

        // Send Email Notification
        try {
            $recipient = \App\Models\SiteSetting::get('admin_email');
            if (!$recipient) {
                $recipient = \App\Models\User::where('role', 'superadmin')->pluck('email')->toArray();
            }
            if (empty($recipient)) {
                $recipient = config('mail.from.address');
            }
            Mail::to($recipient)->send(new ContactMessageEmail($message));
            $message->update(['email_notified' => true]);
        } catch (\Exception $e) {
            Log::error("Gagal menghantar emel: " . $e->getMessage());
        }

        return back()->with('success', 'Mesej anda telah berjaya dihantar. Kami akan menghubungi anda semula.');
    }
}
