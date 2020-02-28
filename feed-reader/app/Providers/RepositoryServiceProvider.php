<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\WordRepository;
use App\Repositories\Contracts\WordRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            WordRepositoryInterface::class, 
            WordRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
