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
                 if($role->name=="admin"||$role->name=="super admin")
              
                 return true;
            }
            
        });
        Gate::define('adminEditYourSelf', function ($user,$user_eited) 
        {
            if($user->id==$user_eited->id)
            return true;
        });
      
        Gate::define('editThisAdmin', function ($user,$user_eited) {
           
            //dd($user->id);
           /*if($user->id==$user_eited->id)
                return true;*/
            $caneditAdmin=false;
           
            foreach($user->role as $role)
            {
                if($role->name=="super admin")
                {
                    $caneditAdmin=true;
                    return true;
                }
            }
          
           if($caneditAdmin==false)
            {
                foreach($user_eited->role as $role)
                {
                    if($role->name=="admin" || $role->name=="super admin")
                    {
                        
                        return false;
                    }
                }
                return true;
            }
            
        });
        //
    }
}
