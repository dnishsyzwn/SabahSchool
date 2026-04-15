<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VerifyNewEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Check if sensitive info (email or password) is changing
        $emailChanging = $request->email !== $user->email;
        $passwordChanging = $request->filled('new_password');

        if ($emailChanging || $passwordChanging) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata laluan semasa diperlukan untuk menukar maklumat sensitif (emel atau kata laluan).']);
            }
        }

        $data = [
            'name' => $request->name,
        ];

        // Handle Email Change with Verification
        $emailMessage = '';
        if ($emailChanging) {
            $newEmail = $request->email;
            
            // Generate a signed URL for verification
            $verificationUrl = URL::temporarySignedRoute(
                'admin.profile.verify-email',
                now()->addMinutes(60),
                ['user' => $user->id, 'new_email' => $newEmail]
            );

            // Send verification email to the NEW email
            Mail::to($newEmail)->send(new VerifyNewEmail($verificationUrl, $newEmail));
            
            $emailMessage = ' Sila semak emel baru anda (' . $newEmail . ') untuk mengesahkan pertukaran emel.';
        }

        if ($passwordChanging) {
            $data['password'] = Hash::make($request->new_password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profil anda telah berjaya dikemaskini.' . $emailMessage);
    }

    public function verifyEmail(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Pautan pengesahan tidak sah atau telah tamat tempoh.');
        }

        $user = \App\Models\User::findOrFail($request->user);
        $newEmail = $request->new_email;

        // Check if email already taken in the meantime
        if (\App\Models\User::where('email', $newEmail)->where('id', '!=', $user->id)->exists()) {
            return redirect()->route('admin.profile.index')->with('error', 'Alamat emel ini telah didaftarkan oleh pengguna lain.');
        }

        $user->update(['email' => $newEmail]);

        return redirect()->route('admin.profile.index')->with('success', 'Alamat emel anda telah berjaya disahkan.');
    }
}
