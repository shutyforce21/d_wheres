<?php


namespace App\Packages\User\UseCase\User\Register;


use App\Packages\User\Domain\User\DataAccessInterface\RepositoryInterface;
use App\Packages\User\Domain\User\UserFactory;
use App\Packages\User\UseCase\User\Register\Dto\InputData;

class RegisterUser
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param InputData $inputData
     * @throws \Exception
     */
    public function __invoke(InputData $inputData)
    {
        $userEntity = UserFactory::create($inputData);
        $this->repository->save($userEntity);
    }
}
