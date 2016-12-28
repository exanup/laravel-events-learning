<?php

namespace App\Listeners;

use App\User;
use App\Notifications\UserLoggedInNotification;
use App\Events\UserLoggedInEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoggedInEventListener implements ShouldQueue
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
     * @param  UserLoggedInEvent  $event
     * @return void
     */
    public function handle(UserLoggedInEvent $event)
    {
        $event->user->notify(new UserLoggedInNotification($event->time));
    }
}
