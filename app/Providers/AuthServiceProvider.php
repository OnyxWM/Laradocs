<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [];

    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('is-manager', function (User  $user) {
            return $user->isAdmin() || $user->isManager();
        });
    }
}
