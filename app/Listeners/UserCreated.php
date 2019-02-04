<?php

namespace App\Listeners;

use App\Events\UserCreated as UserCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserProfile;

class UserCreated
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        $user = $event->user;

        $userProfile = new UserProfile;
        $userProfile->user()->associate($user);
        $userProfile->save();
    }
}
