<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use JWT;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
        //$this->registerPolicies();

        /* Qrr Authorization */

        Gate::define('roleedit', function (User $user, $name) {
            if (auth()->user()->getRoleNames()[0] !== $name) {
                return true;
            }
           return false;
        });

        Gate::define('profile', function (User $user, $id) {
            if (auth()->user()->id == $id) {
                return true;
            }
           return false;
        });
    }
}
