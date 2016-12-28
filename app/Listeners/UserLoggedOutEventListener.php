<?php

namespace App\Listeners;

use App\User;
use App\Notifications\UserLoggedOutNotification;
use App\Events\UserLoggedOutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoggedOutEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoggedOutEvent  $event
     * @return void
     */
    public function handle(UserLoggedOutEvent $event)
    {
        $event->user->notify(new UserLoggedOutNotification($event->time));
    }
}
