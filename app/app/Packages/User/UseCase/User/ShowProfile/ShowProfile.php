<?php

namespace App\Packages\User\UseCase\User\ShowProfile;

use App\Packages\User\Infrastructure\User\ReadRepositoryInterface;

class ShowProfile
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    public function handle($userId)
    {
        $outputData = $this->readRepository->findById($userId);
        return $outputData;
    }

}
