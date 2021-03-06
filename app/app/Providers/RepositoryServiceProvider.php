<?php

namespace App\Providers;

use App\Packages\User\Domain\Spot\DataAccessInterface\FileRepositoryInterface as SpotFileRepositoryInterface;
use App\Packages\User\Domain\Spot\DataAccessInterface\ReadRepositoryInterface as SpotReadRepositoryInterface;
use App\Packages\User\Domain\Spot\DataAccessInterface\RepositoryInterface as SpotRepositoryInterface;
use App\Packages\User\Domain\User\DataAccessInterface\FileRepositoryInterface as UserFileRepositoryInterface;
use App\Packages\User\Domain\User\DataAccessInterface\ReadRepositoryInterface as UserReadRepositoryInterface;
use App\Packages\User\Domain\User\DataAccessInterface\RepositoryInterface as UserRepositoryInterface;
use App\Packages\User\Infrastructure\Spot\FileRepository as SpotFileRepository;
use App\packages\User\Infrastructure\Spot\Repository as SpotRepository;
use App\Packages\User\Infrastructure\Spot\ReadRepository as SpotReadRepository;
use App\Packages\User\Infrastructure\User\ReadRepository as UserReadRepository;
use App\Packages\User\Infrastructure\User\Repository as UserRepository;
use App\Packages\User\Infrastructure\User\FileRepository as UserFileRepository;

use App\Services\Interfaces\RedisService;
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
        $this->app->bind(SpotFileRepositoryInterface::class, SpotFileRepository::class);

        //ユーザー
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserFileRepositoryInterface::class, UserFileRepository::class);
        $this->app->bind(UserReadRepositoryInterface::class, UserReadRepository::class);

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
