<?php


namespace App\Packages\User\Domain\User\DataAccessInterface;


use App\Packages\User\Domain\User\ReadModel\ReadUser;

interface ReadRepositoryInterface
{
    /**
     * @param $userId
     * @return ReadUser
     * @throws \Exception
     */
    public function findById($userId);

}
