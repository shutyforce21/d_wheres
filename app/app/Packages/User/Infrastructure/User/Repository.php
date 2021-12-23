<?php


namespace App\Packages\User\Infrastructure\User;


use App\Models\User as UserModel;
use App\Packages\User\Domain\User\User;

class Repository implements RepositoryInterface
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param User $user
     * @return mixed
     * @throws \Exception
     */
    public function save(User $user)
    {
        try {
            $this->userModel->code = $user->getCode();
            $this->userModel->name = $user->getName();
            $this->userModel->email = $user->getEmail();
            $this->userModel->password = $user->getPassword();
            $this->userModel->save();

            return $this->userModel->id;

        } catch (\Throwable $throwable) {
            logger()->info($throwable->getMessage());
            throw new \Exception($throwable->getMessage());
        }

    }
}
