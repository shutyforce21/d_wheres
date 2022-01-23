<?php


namespace App\Packages\User\UseCase\Spot\Get;


use App\Packages\User\Infrastructure\Spot\ReadRepositoryInterface;

class GetSpots
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    public function handle()
    {
        $outputData = $this->readRepository->get();
        return $outputData;
    }
}
