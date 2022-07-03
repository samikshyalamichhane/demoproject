<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('news-create', fn(User $user) => $user->is_admin==0);
        Gate::define('users-list', fn(User $user) => $user->is_admin);
        Gate::define('category-list', fn(User $user) => $user->is_admin);
        // Gate::define('news-publish', fn(User $user) => $user->is_admin);
    }
}
