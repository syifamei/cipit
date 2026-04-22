<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RecaptchaRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $response = $value;
        $secretKey = config('services.recaptcha.secret_key');
        
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$response}"
        );
        
        $responseKeys = json_decode($response, true);
        
        if (intval($responseKeys["success"]) !== 1) {
            $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
        }
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.';
    }
}
