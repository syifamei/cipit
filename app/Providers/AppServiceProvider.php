<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\RecaptchaRule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            $secretKey = config('services.recaptcha.secret_key');
            
            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$value}"
            );
            
            $responseKeys = json_decode($response, true);
            
            return intval($responseKeys["success"]) === 1;
        });
    }
}
