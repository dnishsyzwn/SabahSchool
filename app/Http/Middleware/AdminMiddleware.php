<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user is active and has an admin role
        $user = Auth::user();
        if (!$user->is_active || !in_array($user->role, ['superadmin', 'admin', 'editor'])) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is inactive or lacks admin privileges.'
            ]);
        }

        return $next($request);
    }
}
