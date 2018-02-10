<?php

namespace App\Providers;

use App\Events\SluggableSaving;
use Illuminate\Auth\Events\Login;
use App\Listeners\UserEventListener;
use App\Listeners\LoginEventListener;
use App\Listeners\SluggableEventListener;
use App\Listeners\FormSubmissionEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Login::class => [
            LoginEventListener::class,
        ],
        SluggableSaving::class => [
            SluggableEventListener::class,
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
