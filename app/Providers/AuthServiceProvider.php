<?php

namespace App\Providers;

use App\Models\Qrr;
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

        Gate::define('editdeleteqrr', function (User $user, Qrr $qrr) {
            if ($user->hasRole('Super Admin')) {
                return true;
            }

            if ($user->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
                return $user->districtID == $qrr->districtID;
            }

            if ($user->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
                if (($user->districtID == $qrr->districtID) && ($user->thanaID == $qrr->thanaID)) {
                    return true;
                }
            }

            return false;
        });
    }
}
