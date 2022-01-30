<?php

namespace App\Packages\User\UseCase\Spot\Get;


use App\Packages\User\Domain\Spot\DataAccessInterface\ReadRepositoryInterface;

class GetSpots
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    /**
     * @return array
     */
    public function __invoke()
    {
        $outputData = $this->readRepository->get();
        return $outputData;
    }
}
