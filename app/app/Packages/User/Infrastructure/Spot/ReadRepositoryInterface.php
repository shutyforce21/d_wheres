<?php


namespace App\Packages\User\Infrastructure\Spot;

use App\Packages\User\Domain\Spot\ReadModel\ReadSpot;

interface ReadRepositoryInterface
{
    /**
     * @return array
     */
    public function all();

    /**
     * @param $spotId
     * @return ReadSpot
     */
    public function findById($spotId);
}
