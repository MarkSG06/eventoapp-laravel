<?php

namespace App\Http\Controllers\Admin;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\MySQL\Customer;

class MailController
{
    public static function sendWelcomeMail($email, $name)
    {
        $user = Customer::where('email', $email)
            ->where('name', $name)
            ->first();

        if (!$user) return;

        Mail::to($email)->send(new WelcomeMail($user));
    }
}