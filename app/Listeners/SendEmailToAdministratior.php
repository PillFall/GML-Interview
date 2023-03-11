<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\TotalUsersByCountry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendEmailToAdministratior
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
    public function handle(UserCreated $event): void
    {
        Notification::route('mail', config('logging.admin_mail'))
            ->notify(new TotalUsersByCountry);
    }
}
