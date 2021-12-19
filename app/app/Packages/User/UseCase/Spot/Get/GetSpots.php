<?php

namespace App\packages\User\UseCase\Spot\Get;

use App\packages\User\Infrastructure\Spot\ReadRepositoryInterface;

class GetSpots
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    public function handle()
    {
        $this->readRepository;
    }
}