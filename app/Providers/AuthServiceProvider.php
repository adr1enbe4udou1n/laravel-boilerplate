<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\AccountRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies
        = [
            User::class => UserPolicy::class,
            Post::class => PostPolicy::class,
        ];

    /**
     * Register any authentication / authorization services.
     *
     * @throws \InvalidArgumentException
     */
    public function boot()
    {
        $this->registerPolicies();

        $accountRepository = $this->app->make(AccountRepository::class);

        foreach (config('permissions') as $key => $permissions) {
            Gate::define($key, function (User $user) use ($accountRepository, $key) {
                return $accountRepository->hasPermission($user, $key);
            });
        }
    }
}
