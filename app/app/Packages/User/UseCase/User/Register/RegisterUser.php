<?php


namespace App\Packages\User\UseCase\User\Register;


use App\Packages\User\Domain\User\UserFactory;
use App\Packages\User\Infrastructure\User\RepositoryInterface;
use App\Packages\User\UseCase\User\Register\Dto\InputData;

class RegisterUser
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(InputData $inputData)
    {
        $userEntity = UserFactory::create($inputData);
        $userId = $this->repository->save($userEntity);
        return $userId;
    }
}
