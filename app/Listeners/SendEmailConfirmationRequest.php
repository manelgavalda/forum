<?php

namespace App\Listeners;

use Mail;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Auth\Events\Registered;

class SendEmailConfirmationRequest
{
    public function handle(Registered $event)
    {
        Mail::to($event->user)->send(new PleaseConfirmYourEmail($event->user));
    }
}
