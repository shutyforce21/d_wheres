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
}
