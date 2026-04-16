<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'ic' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'school' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($validated);

        // Send Email Notification
        try {
            // Priority 1: Site Setting 'admin_email'
            // Priority 2: All users with 'superadmin' role
            // Priority 3: Default system from address
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
            // Log error or handle silently for now
            \Log::error("Gagal menghantar emel: " . $e->getMessage());
        }

        return back()->with('success', 'Mesej anda telah berjaya dihantar. Kami akan menghubungi anda semula.');
    }
}
