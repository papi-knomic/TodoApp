<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use App\Observers\TodoObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe( UserObserver::class);
        Todo::observe( TodoObserver::class);
    }
}
