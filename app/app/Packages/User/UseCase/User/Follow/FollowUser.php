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

    public function handle($followedId, $followerId)
    {
        $followedUser = $this->repository->findById($followerId);
        $followedUser->follow($followedId);
        $this->repository->follow($followedUser);
    }
}
