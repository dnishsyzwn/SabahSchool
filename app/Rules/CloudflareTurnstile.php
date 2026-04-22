<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class CloudflareTurnstile implements ValidationRule
{
    /**
     * Run the validation rule.
     * Verifies the Cloudflare Turnstile token with Cloudflare's siteverify API.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Sila selesaikan pengesahan keselamatan (CAPTCHA) sebelum menghantar borang.');
            return;
        }

        try {
            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret'   => config('services.cloudflare.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $result = $response->json();

            if (!($result['success'] ?? false)) {
                $fail('Pengesahan keselamatan gagal. Sila cuba lagi.');
            }
        } catch (\Throwable $e) {
            // If Cloudflare is unreachable, log and fail gracefully
            
            $fail('Pengesahan keselamatan tidak dapat disahkan. Sila cuba lagi.');
        }
    }
}
