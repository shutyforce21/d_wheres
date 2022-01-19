<?php


namespace App\Packages\User\UseCase\Spot\Search;

use App\Packages\User\Infrastructure\Spot\ReadRepositoryInterface;

class SearchSpots
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    public function handle()
    {
        $outputData = $this->readRepository->all();
        return $outputData;
    }
}
