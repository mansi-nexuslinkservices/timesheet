<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Auth;
use View;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) 
        {
            $user = Auth::user();
            if(isset($user) && !empty($user)){
                $user_designation = User::with('designation')->find($user->id);
                $view->with('user_designation', $user_designation); 
            }
            $view->with('user', $user);
              
        });
    }
}
