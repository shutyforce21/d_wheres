<?php


namespace App\Packages\Admin\Infrastructure\Spot;


use App\Packages\Admin\Domain\Spot\DataAccessInterface\RepositoryInterface;
use App\Models\Spot as SpotModel;
use App\Packages\Admin\Domain\Spot\Spot;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Repository implements RepositoryInterface
{
    private $spotModel;

    public function __construct(SpotModel $spotModel)
    {
        $this->spotModel = $spotModel;
    }

    /**
     * @param $spotId
     * @return Spot
     */
    public function findById($spotId)
    {
        if ($spotModel = $this->spotModel->find($spotId)) {
            $spot = Spot::fromRepository(
                $spotModel->id,
                $spotModel->active
            );
            return $spot;

        } else {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param Spot $spot
     * @throws \Exception
     */
    public function activate(Spot $spot)
    {
        try {
            $spotModel = $this->spotModel->find($spot->getId());
            $spotModel->active = $spot->getActiveFlag();
            $spotModel->save();

        } catch (\Throwable $th) {
            logger()->info($th->getMessage());
            throw new \Exception();
        }
    }
}
