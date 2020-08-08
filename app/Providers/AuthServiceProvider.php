<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\role_user;
use App\role;
use App\category;
use App\Policies\CategoryPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\category::class => \App\Policies\CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       /* Gate::define('edit', function(?User $user) {
           
            dd($user);
            return $user->role=="admin";
        });*/
        Gate::define('do', function ($user) {
           
            //dd($user->id);
            foreach($user->role as $role)
            {
                
                 return $role->name=="admin";
            }
            
        });
        //
    }
}
