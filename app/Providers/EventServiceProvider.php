<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\UserEventListener;
use App\Listeners\LoginEventListener;
use Illuminate\Auth\Events\Registered;
use App\Listeners\FormSubmissionEventListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LoginEventListener::class,
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
