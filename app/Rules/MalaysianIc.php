<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MalaysianIc implements ValidationRule
{
    /**
     * Run the validation rule.
     * Accepts IC with or without dashes. Exactly 12 digits required.
     * Example: 123412-12-1212 or 123412121212
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Strip dashes to get raw digits only
        $digits = str_replace('-', '', $value);

        // Must be exactly 12 digits
        if (!preg_match('/^\d{12}$/', $digits)) {
            $fail('Format No. IC tidak sah. Sila masukkan 12 digit nombor IC yang tepat (contoh: 123412-12-1212).');
            return;
        }

        // Basic birth date validation (YYMMDD)
        $year  = (int) substr($digits, 0, 2);
        $month = (int) substr($digits, 2, 2);
        $day   = (int) substr($digits, 4, 2);

        if ($month < 1 || $month > 12) {
            $fail('No. IC tidak sah. Bulan lahir tidak tepat.');
            return;
        }

        if ($day < 1 || $day > 31) {
            $fail('No. IC tidak sah. Tarikh lahir tidak tepat.');
            return;
        }
    }
}
