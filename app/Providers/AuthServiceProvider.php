<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @throws \InvalidArgumentException
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach(config('permissions') as $key => $permissions) {
            Gate::define($key, function (User $user) {
                return true;
            });
        }
    }
}
