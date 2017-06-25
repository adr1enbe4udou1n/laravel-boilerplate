<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        $userRepository = $this->app->make(UserRepository::class);

        foreach (config('permissions') as $key => $permissions) {
            Gate::define($key, function (User $user) use ($userRepository, $key) {
                return $userRepository->hasPermission($user, $key);
            });
        }
    }
}
