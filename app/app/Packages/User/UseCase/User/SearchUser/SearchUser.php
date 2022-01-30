<?php


namespace App\Packages\User\UseCase\User\SearchUser;

use App\Packages\User\Domain\User\DataAccessInterface\ReadRepositoryInterface;

class SearchUser
{
    private $readRepository;

    public function __construct(
        ReadRepositoryInterface $readRepository
    )
    {
        $this->readRepository = $readRepository;
    }

    public function __invoke()
    {
        return [];
    }

}
