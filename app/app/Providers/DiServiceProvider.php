<?php


namespace App\Providers;


use App\Services\Interfaces\RedisService;
use Illuminate\Support\ServiceProvider;

class DiServiceProvider extends ServiceProvider
{

    public function register()
    {
        // サービスクラスの登録
        $prefix = 'App\\Services\\Impl\\';
        app()->singleton(RedisService::class, $prefix . 'RedisServiceImpl');

    }

    public function boot()
    {
    }

}
