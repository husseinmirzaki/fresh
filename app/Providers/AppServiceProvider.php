<?php

namespace App\Providers;

use App\Classes\MyAuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //dd("Changes are made in " . __FILE__, Auth::attempt(["username" => "test", "password" => "test"]));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local')
            $this->app->bind('auth', function ($app) {
                return new MyAuthManager($app);
            });
    }
}
