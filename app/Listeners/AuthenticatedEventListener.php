<?php

namespace App\Listeners;

use App\Repositories\Contracts\AccountRepository;
use Illuminate\Auth\Events\Authenticated;

class AuthenticatedEventListener
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
    public function handle(Authenticated $event)
    {
        $this->users->login($event->user);
    }
}
