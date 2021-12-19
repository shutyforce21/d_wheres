<?php

namespace App\Providers;

use App\packages\User\Infrastructure\Spot\Repository as SpotRepository;
use App\packages\User\Infrastructure\Spot\RepositoryInterface as SpotRepositoryInterface;
use App\packages\User\Infrastructure\Spot\ReadRepository as SpotReadRepository;
use App\packages\User\Infrastructure\Spot\ReadRepositoryInterface as SpotReadRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //練習場所
        $this->app->bind(
            SpotRepositoryInterface::class,
            SpotRepository::class
        );
        $this->app->bind(
            SpotReadRepositoryInterface::class,
            SpotReadRepository::class
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
