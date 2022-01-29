<?php


namespace App\Packages\User\UseCase\Spot\Search;

use App\Packages\User\Domain\Spot\DataAccessInterface\ReadRepositoryInterface;

class SearchSpots
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
        $outputData = $this->readRepository->all();
        return $outputData;
    }
}
