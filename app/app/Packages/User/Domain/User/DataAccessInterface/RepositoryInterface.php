<?php


namespace App\Packages\User\Domain\User\DataAccessInterface;


use App\Packages\User\Domain\User\User;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return mixed|void
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
     * @return bool
     * @throws \Exception
     */
    public function updateProfile(User $user);

    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function followAndSave(User $user);

    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function unfollowAndSave(User $user);
}
