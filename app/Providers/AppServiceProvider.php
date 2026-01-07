<?php

namespace App\Providers;

use App\Repositories\CartaoInterface;
use App\Repositories\CartaoEloquentORM;
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
        $this->app->bind(CartaoInterface::class, 
        CartaoEloquentORM::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
