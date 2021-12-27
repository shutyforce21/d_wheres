<?php

namespace App\Packages\User\UseCase\User\Follow;

use App\Packages\User\Infrastructure\User\ReadRepositoryInterface;

class FollowUser
{
    private $repository;

    public function __construct(ReadRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle($followedId, $followerId)
    {
//        $followedUser = $this->repository->findById($followedId);
//        $followedUser->follow($followedId);
//        $this->repository->follow($followedUser);
    }
}
