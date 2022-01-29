<?php

namespace App\Packages\User\UseCase\Spot\Register;

use App\Packages\User\Domain\Spot\DataAccessInterface\FileRepositoryInterface;
use App\Packages\User\Domain\Spot\DataAccessInterface\RepositoryInterface;
use App\Packages\User\Domain\Spot\SpotFactory;
use App\packages\User\UseCase\Spot\Register\Dto\InputData;

class RegisterSpot
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
     */
    public function __invoke(InputData $inputData, $userId)
    {
        //spotEntity新規作成Factory
        $spot = SpotFactory::create($inputData);

        if ($inputData->getImage()) {
            //imageがあればrepositoryで保存し、pathを返却
            $imgPath = $this->fileRepository->saveProfileImg(
                $inputData->getImage(),
                $spot->getCode()
            );
            //spotEntityにpathをセット
            $spot->setImage($imgPath);
        }
        //保存
        $this->repository->save($spot, $userId);
    }
}
