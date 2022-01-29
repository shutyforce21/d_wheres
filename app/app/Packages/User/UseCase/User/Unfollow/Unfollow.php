<?php

namespace App\Packages\User\UseCase\User\Unfollow;

use App\Packages\User\Infrastructure\User\RepositoryInterface;

class Unfollow
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
    public function __invoke($authId, $followedId)
    {
        $user = $this->repository->findById($authId);
        $user->unfollow($followedId);
        $this->repository->unfollowAndSave($user);
    }
}
