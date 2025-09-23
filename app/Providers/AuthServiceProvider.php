<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('gerencia', function($user) {
            if($user->role_id == 1){
                return true;
            }
        });
        Gate::define('administracion', function($user) {
            if($user->role_id == 1){
                return true;
            }
        });
        Gate::define('secretaria', function($user) {
            if($user->role_id == 4){
                return true;
            }
        });
        Gate::define('medicina', function($user) {
            if($user->role_id == 2){
                return true;
            }
        });
        Gate::define('farmaceutico', function($user) {
            if($user->role_id == 5){
                return true;
            }
        });
    }
}
