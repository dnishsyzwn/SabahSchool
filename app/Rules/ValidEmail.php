<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class ValidEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     * Validates format AND performs a DNS/MX record lookup
     * to ensure the email domain actually exists.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Step 1: Basic format check
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $fail('Format emel tidak sah. Sila semak semula alamat emel anda.');
            return;
        }

        // Step 2: Extract domain
        $domain = substr(strrchr($value, '@'), 1);

        if (empty($domain)) {
            $fail('Domain emel tidak ditemui.');
            return;
        }

        // Step 3: Check for MX record (primary)
        if (checkdnsrr($domain, 'MX')) {
            return; // Domain has mail server - email is valid
        }

        // Step 4: Fallback — check for A record (some domains use A record instead of MX)
        if (checkdnsrr($domain, 'A')) {
            return;
        }

        $fail('Domain emel "' . $domain . '" tidak wujud atau tidak mempunyai pelayan mel. Sila semak semula alamat emel anda.');
    }
}
