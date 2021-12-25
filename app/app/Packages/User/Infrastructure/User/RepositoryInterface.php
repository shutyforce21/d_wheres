<?php

namespace App\Packages\User\Infrastructure\User;

use App\Packages\User\Domain\User\User;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     * @throws \Exception
     */
    public function save(User $user);

    /**
     * @param $userId
     * @return User
     * @throws \Exception
     */
    public function findById($userId);

    /**
     * @param User $user
     * @throws \Exception
     */
    public function saveProfile(User $user);
}
