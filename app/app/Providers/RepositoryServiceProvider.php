<?php

namespace App\Providers;

use App\packages\User\Infrastructure\Spot\Repository as SpotRepository;
use App\packages\User\Infrastructure\Spot\RepositoryInterface as SpotRepositoryInterface;
use App\Packages\User\Infrastructure\Spot\ReadRepositoryInterface as SpotReadRepositoryInterface;
use App\Packages\User\Infrastructure\Spot\ReadRepository as SpotReadRepository;
use App\Packages\User\Infrastructure\User\Repository as UserRepository;
use App\Packages\User\Infrastructure\User\RepositoryInterface as UserRepositoryInterface;

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

        //ユーザー
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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