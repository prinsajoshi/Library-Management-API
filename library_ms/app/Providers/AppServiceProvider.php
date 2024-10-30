<?php

namespace App\Providers;

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckAdminOrLibrarian;
use App\Http\Middleware\CheckUser;
use App\Http\Middleware\CheckUserAdminLibarary;
use Illuminate\Support\ServiceProvider;

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
        $this->app['router']->aliasMiddleware('checkAdminOrLibrarian', CheckAdminOrLibrarian::class);
        $this->app['router']->aliasMiddleware('checkUser', CheckUser::class);
        $this->app['router']->aliasMiddleware('checkUserAdminLibrarian', CheckUserAdminLibarary::class);
        $this->app['router']->aliasMiddleware('checkAdmin', CheckAdmin::class);
    }
}
