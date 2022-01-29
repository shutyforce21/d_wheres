<?php

namespace App\Packages\User\UseCase\User\Follow;


use App\Packages\User\Domain\User\DataAccessInterface\RepositoryInterface;

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
    public function __invoke($authId, $followedId)
    {
        $user = $this->repository->findById($authId);
        $user->follow($followedId);
        $this->repository->followAndSave($user);
    }
}
