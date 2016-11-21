<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use Log;

class UserEventListener
{
    /**
     * @param $event
     */
    public function onCreated(UserCreated $event)
    {
        Log::notice(trans('logs.backend.users.created', ['user' => $event->user->id]));
    }

    /**
     * @param $event
     */
    public function onUpdated(UserUpdated $event)
    {
        Log::notice(trans('logs.backend.users.updated', ['user' => $event->user->id]));
    }

    /**
     * @param $event
     */
    public function onDeleted(UserDeleted $event)
    {
        Log::notice(trans('logs.backend.users.deleted', ['user' => $event->user->id]));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UserCreated::class,
            'App\Listeners\UserEventListener@onCreated'
        );

        $events->listen(
            UserUpdated::class,
            'App\Listeners\UserEventListener@onUpdated'
        );

        $events->listen(
            UserDeleted::class,
            'App\Listeners\UserEventListener@onDeleted'
        );
    }
}
