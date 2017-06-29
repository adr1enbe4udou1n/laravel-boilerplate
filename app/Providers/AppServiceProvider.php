<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Contracts\AccountRepository;
use App\Repositories\Contracts\FormSettingRepository;
use App\Repositories\Contracts\FormSubmissionRepository;
use App\Repositories\Contracts\MetaRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\RedirectionRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\EloquentAccountRepository;
use App\Repositories\EloquentFormSettingRepository;
use App\Repositories\EloquentFormSubmissionRepository;
use App\Repositories\EloquentMetaRepository;
use App\Repositories\EloquentPostRepository;
use App\Repositories\EloquentRedirectionRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentTagRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'post' => Post::class,
            'user' => User::class,
        ]);

        if (config('app.url_force_https')) {
            // Force SSL if isSecure does not detect HTTPS
            URL::forceScheme('https');
        }

        if ($root = config('app.url_root')) {
            // Force Route URL (useful for multi-device development)
            URL::forceRootUrl($root);
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            AccountRepository::class,
            EloquentAccountRepository::class
        );

        $this->app->bind(
            RoleRepository::class,
            EloquentRoleRepository::class
        );

        $this->app->bind(
            MetaRepository::class,
            EloquentMetaRepository::class
        );

        $this->app->bind(
            FormSettingRepository::class,
            EloquentFormSettingRepository::class
        );

        $this->app->bind(
            FormSubmissionRepository::class,
            EloquentFormSubmissionRepository::class
        );

        $this->app->bind(
            RedirectionRepository::class,
            EloquentRedirectionRepository::class
        );

        $this->app->bind(
            PostRepository::class,
            EloquentPostRepository::class
        );

        $this->app->bind(
            TagRepository::class,
            EloquentTagRepository::class
        );
    }
}
