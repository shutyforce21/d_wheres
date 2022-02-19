<?php


namespace App\Packages\Admin\UseCase\Spot\Activate;


use App\Packages\Admin\Domain\Spot\DataAccessInterface\RepositoryInterface;

class ActivateSpot
{
    private $repository;

    public function __construct(
        RepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param $spotId
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($spotId)
    {
        $spot = $this->repository->findById($spotId);
        //spotを有効化する
        $spot->activate();
        return $this->repository->activate($spot);
    }
}
