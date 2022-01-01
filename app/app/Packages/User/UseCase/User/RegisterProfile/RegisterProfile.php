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
        //userEntityを呼び出す
        $userEntity = $this->repository->findById($userId);
        //profileEntityを作成
        $profile = Profile::reconstruct(
            $inputData->getBiography(),
            $inputData->getGenres()
        );

        if ($inputData->getImage()) {
            //imageがあればrepositoryで保存し、pathを返却
            $imgPath = $this->fileRepository->saveProfileImg(
                $inputData->getImage(),
                $userEntity->getCode()
            );
            //profileEntityにpathをセット
            $profile->setImage($imgPath);
        }
        //userEntityにprofileEntityをセット
        $userEntity->setProfile($profile);
        //保存
        $this->repository->saveProfile($userEntity);
    }

}
