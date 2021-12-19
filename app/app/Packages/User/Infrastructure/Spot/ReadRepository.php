<?php


namespace App\Packages\User\Infrastructure\Spot;


use App\Models\Spot as SpotModel;
use App\Packages\User\Domain\Spot\ReadModel\ReadSpot;
use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadLocation;

class ReadRepository implements ReadRepositoryInterface
{
    private $spotModel;

    public function __construct(SpotModel $spotModel)
    {
        $this->spotModel = $spotModel;
    }

    /**
     * @return array
     */
    public function all()
    {
        $rows = $this->spotModel->selectRaw(
            "ST_X(location) as lng, " .
            "ST_Y(location) as lat, " .
            "id, name, image, prefecture_id, address"
        )->get();

        if ($rows->isNotEmpty()) {
            foreach ($rows as $r) {
                $spots[] = new ReadSpot(
                    $r->id,
                    $r->name,
                    $r->image,
                    $r->prefecture_id,
                    $r->address,
                    $r->content,
                    new ReadLocation(
                        $r->lat,
                        $r->lng
                    )
                );
            }
            return $spots;

        }
        return [];
    }
}
