<?php

namespace App\Packages\User\UseCase\User\UpdateProfile;

use App\Packages\User\Domain\User\DataAccessInterface\FileRepositoryInterface;
use App\Packages\User\Domain\User\DataAccessInterface\RepositoryInterface;
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
    public function __invoke(InputData $inputData, $userId)
    {
        //userEntityを呼び出す
        $userEntity = $this->repository->findById($userId);

        $profile = $userEntity->getProfile();
        $profile->setName($inputData->getName());
        $profile->setBiography($inputData->getBiography());
        $profile->setGenres($inputData->getGenres());
        $profile->setUserCode($inputData->getUserCode());

        // 背景イメージの永続化
        // 文字列(path)の場合は更新しない。
        if (!is_string($inputData->getBackgroundImage())) {
            $backgroundImgPath = $this->fileRepository->updateBackgroundImage(
                $inputData->getBackgroundImage(), $userEntity->getCode()
            );
            $profile->setBackgroundImage($backgroundImgPath);
        }

        // イメージの永続化
        // 文字列(path)の場合は更新しない。
        if (!is_string($inputData->getImage())) {
            $imgPath = $this->fileRepository->updateImage(
                $inputData->getImage(), $userEntity->getCode()
            );
            $profile->setImage($imgPath);
        }

        //userEntityにprofileEntityをセット
        $userEntity->setProfile($profile);
        //永続化
        $this->repository->updateProfile($userEntity);
    }

}
