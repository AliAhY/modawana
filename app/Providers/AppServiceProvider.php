<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    public function boot()
    {
        View::composer('site.*', function ($view) {
            $id = Auth::id(); // تأكد من أنك تستخدم Auth لجلب معرف المستخدم  
            $user_name = $id ? User::with('profile')->find($id) : null;
            $view->with('user_name', $user_name);
        });
    }
}
