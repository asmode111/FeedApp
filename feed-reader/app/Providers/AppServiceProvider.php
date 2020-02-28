<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GuzzleService;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Contracts\FetchServiceInterface', function ($app) {
            return new GuzzleService(new Client);
        });
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
