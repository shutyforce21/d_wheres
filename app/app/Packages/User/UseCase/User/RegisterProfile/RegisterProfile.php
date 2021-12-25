<?php


namespace App\Packages\User\UseCase\User\RegisterProfile;


use App\Packages\User\Domain\User\ChildEntity\Profile;
use App\Packages\User\Infrastructure\User\FileRepositoryInterface;
use App\Packages\User\Infrastructure\User\RepositoryInterface;
use App\Packages\User\UseCase\User\RegisterProfile\Dto\InputData;

class RegisterProfile
{
    private $repository;
    private $fileRepository;

    public function __construct(
        RepositoryInterface $repository,
        FileRepositoryInterface $fileRepository
    )
    {
        $this->repository = $repository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param InputData $inputData
     * @param $userId
     * @throws \Exception
     */
    public function handle(InputData $inputData, $userId)
    {
        $userEntity = $this->repository->findById($userId);

        $imgPath = $this->fileRepository->saveProfileImg(
            $inputData->getImage(),
            $userEntity->getCode()
        );

        $profile = Profile::reconstruct(
            $imgPath,
            $inputData->getBiography(),
            $inputData->getGenres()
        );
        $userEntity->setProfile($profile);

        $this->repository->saveProfile($userEntity);
    }

}
