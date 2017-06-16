<?php

namespace App\Providers;

use App\Listeners\AuthenticatedEventListener;
use App\Listeners\FormSubmissionEventListener;
use App\Listeners\UserEventListener;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Authenticated::class => [
            AuthenticatedEventListener::class
        ],
    ];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventListener::class,
        FormSubmissionEventListener::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
