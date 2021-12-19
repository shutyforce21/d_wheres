<?php

namespace App\Providers;

use App\Packages\User\Infrastructure\Spot\ReadRepositoryInterface;
use App\packages\User\Infrastructure\Spot\Repository as SpotRepository;
use App\packages\User\Infrastructure\Spot\RepositoryInterface as SpotRepositoryInterface;
use App\Packages\User\Infrastructure\Spot\ReadRepositoryInterface as SpotReadRepositoryInterface;
use App\Packages\User\Infrastructure\Spot\ReadRepository as SpotReadRepository;
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
        $this->app->bind(SpotRepositoryInterface::class, SpotRepository::class);
        $this->app->bind(SpotReadRepositoryInterface::class, SpotReadRepository::class);
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
