<?php

namespace App\Packages\User\UseCase\Spot\Register;

use App\packages\User\Domain\Spot\Spot;
use App\packages\User\Domain\Spot\ValueObject\GeometricLocation;
use App\packages\User\Infrastructure\Spot\RepositoryInterface;
use App\packages\User\UseCase\Spot\Register\Dto\InputData;

class RegisterSpot
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(InputData $inputData, $userId)
    {
        $spot = Spot::reconstruct(
            $inputData->getName(),
            $inputData->getImage(),
            $inputData->getPrefectureId(),
            $inputData->getAddress(),
            $inputData->getContent(),
            new GeometricLocation(
                $inputData->getLatitude(),
                $inputData->getLongitude()
            )
        );

        $this->repository->save($spot, $userId);
    }
}
