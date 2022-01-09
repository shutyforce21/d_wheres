<?php

namespace App\Packages\User\UseCase\User\UpdateProfile;

use App\Packages\User\Domain\User\ChildEntity\Profile;
use App\Packages\User\Infrastructure\User\FileRepositoryInterface;
use App\Packages\User\Infrastructure\User\RepositoryInterface;
use App\Packages\User\UseCase\User\UpdateProfile\Dto\InputData;

class UpdateProfile
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
        //userEntityを呼び出す
        $userEntity = $this->repository->findById($userId);
        //profileEntityを作成
        $profile = Profile::reconstruct(
            $inputData->getBiography(),
            $inputData->getGenres()
        );

        // 背景イメージの永続化
        $imgPath = $this->fileRepository->updateBackgroundImage($inputData->getBackgroundImage(), $userEntity->getCode());
        //profileEntityにpathをセット
        $profile->setBackgroundImage($imgPath);

        // イメージの永続化
        $imgPath = $this->fileRepository->updateImage($inputData->getImage(), $userEntity->getCode());
        //profileEntityにpathをセット
        $profile->setImage($imgPath);

        //userEntityにprofileEntityをセット
        $userEntity->setProfile($profile);
        //永続化
        $this->repository->updateProfile($userEntity);
    }

}
