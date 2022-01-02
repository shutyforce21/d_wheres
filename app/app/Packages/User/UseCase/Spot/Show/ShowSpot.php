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

    public function handle($spotId)
    {
        $outputData = $this->readRepository->findById($spotId);
        return $outputData;
    }
}
