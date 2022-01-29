<?php

namespace App\Packages\User\UseCase\Spot\Show;

use App\Packages\User\Infrastructure\Spot\ReadRepositoryInterface;

class ShowSpot
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    /**
     * @param $spotId
     * @return \App\Packages\User\Domain\Spot\ReadModel\ReadSpot
     */
    public function __invoke($spotId)
    {
        $outputData = $this->readRepository->findById($spotId);
        return $outputData;
    }
}
