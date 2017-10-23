<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Repositories\Contracts\AccountRepository;

class LoginEventListener
{
    /**
     * @var \App\Repositories\Contracts\AccountRepository
     */
    protected $users;

    /**
     * Create the event listener.
     *
     * @param \App\Repositories\Contracts\AccountRepository $users
     */
    public function __construct(AccountRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param \Illuminate\Auth\Events\Authenticated $event
     */
    public function handle(Login $event)
    {
        $this->users->login($event->user);
    }
}
