<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class OTPService
{
    /**
     * Generate and send OTP to user email
     */
    public function generateAndSendOTP(User $user): bool
    {
        try {
            // Generate 6-digit OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Set OTP expiration (15 minutes)
            $expiresAt = now()->addMinutes(15);
            
            // Update user with OTP
            $user->update([
                'otp_code' => $otp,
                'otp_expires_at' => $expiresAt,
            ]);
            
            // Send OTP via email
            Mail::to($user->email)->send(new OTPMail($otp, $expiresAt));
            
            return true;
        } catch (\Exception $e) {
            \Log::error('OTP generation failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Verify OTP
     */
    public function verifyOTP(User $user, string $otp): bool
    {
        // Check if OTP exists and is not expired
        if (!$user->otp_code || !$user->otp_expires_at) {
            return false;
        }
        
        // Check if OTP is expired
        if (now()->greaterThan($user->otp_expires_at)) {
            return false;
        }
        
        // Verify OTP code
        return $user->otp_code === $otp;
    }
    
    /**
     * Mark email as verified and clear OTP
     */
    public function verifyEmail(User $user): bool
    {
        try {
            $user->update([
                'email_verified_at' => now(),
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Email verification failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Check if OTP is expired
     */
    public function isOTPExpired(User $user): bool
    {
        if (!$user->otp_expires_at) {
            return true;
        }
        
        return now()->greaterThan($user->otp_expires_at);
    }
}
