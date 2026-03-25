<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // If already logged in, redirect to dashboard
        if (Auth::check() && in_array(Auth::user()->role, ['superadmin', 'admin', 'editor'])) {
            return redirect()->route('admin.dashboard');
        }

        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Additional check for active and valid role
            if (!$user->is_active || !in_array($user->role, ['superadmin', 'admin', 'editor'])) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akaun anda tidak aktif atau tiada kebenaran.',
                ])->onlyInput('email');
            }

            // Update last login
            $user->update(['last_login_at' => now()]);

            $request->session()->regenerate();

            // Log activity
            ActivityLog::record('login', 'User logged into admin panel', $user);

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak padan dengan rekod kami.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            ActivityLog::record('logout', 'User logged out', Auth::user());
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
