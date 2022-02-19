<?php


namespace App\Packages\Admin\Domain\Spot\DataAccessInterface;


use App\Packages\Admin\Domain\Spot\Spot;

interface RepositoryInterface
{
    /**
     * @param $spotId
     * @return Spot
     */
    public function findById($spotId);

    /**
     * @param Spot $spot
     * @throws \Exception
     */
    public function activate(Spot $spot);
}
