<?php

namespace App\Packages\User\UseCase\User\Follow;

use App\Packages\User\Infrastructure\User\RepositoryInterface;

class FollowUser
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $authId
     * @param $followedId
     * @throws \Exception
     */
    public function handle($authId, $followedId)
    {
        $followedUser = $this->repository->findById($authId);
        $followedUser->follow($followedId);
        $this->repository->followAndSave($followedUser);
    }
}
