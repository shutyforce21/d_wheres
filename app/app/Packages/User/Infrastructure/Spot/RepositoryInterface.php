<?php


namespace App\Packages\User\Infrastructure\Spot;


use App\packages\User\Domain\Spot\Spot;

interface RepositoryInterface
{

    /**
     * 練習場所を登録
     * @param Spot $spot
     * @param [type] $userId
     * @return void
     */
    public function save(Spot $spot, $userId);
}
