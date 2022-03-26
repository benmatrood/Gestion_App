<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
// import User model
use App\Models\User;

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

        //création d'une permission pour les admins
        Gate::define('admin', function (User $user) {
            return $user->hasRole('admin');
        });
        // création d'une permission pour les managers
        Gate::define('manager', function (User $user) {
            return $user->hasRole('manager');
        });
        // création d'une permission pour les employes
        Gate::define('employer', function (User $user) {
            return $user->hasRole('employer');
        });
        // création d'une permission pour les superadmins
        // le superadmin a toutes les permissions donc c'est lui 
        // qu'onvérifie en dermier("after")
        Gate::after(function (User $user) {
            return $user->hasRole('superadmin');  
    });
}
}
