<?php

namespace App\Listeners;

use App\Events\UserRegistered as UserRegisteredEvent;
use App\Mail\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutSucessfullRegister
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        $email = new UserRegistered($event->user->email);
        Mail::to($event->user->email)->send($email);
    }
}
