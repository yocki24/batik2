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
        Gate::define('manage-dashboard', function($user){
            return $user->role == "Administrator";
        });
        Gate::define('ketua', function($user){
            return $user->role == "Ketua";
        });
        Gate::define('pengrajin', function($user){
            return $user->role == "Pengrajin";
        });
        Gate::define('customer', function($user){
            return $user->role == "Customer";
        });
    }
}