<?php

namespace App\Packages\User\UseCase\Spot\Register;

use App\packages\User\Domain\Spot\Spot;
use App\Packages\User\Domain\Spot\SpotFactory;
use App\packages\User\Domain\Spot\ValueObject\GeometricLocation;
use App\Packages\User\Infrastructure\Spot\FileRepositoryInterface;
use App\packages\User\Infrastructure\Spot\RepositoryInterface;
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
