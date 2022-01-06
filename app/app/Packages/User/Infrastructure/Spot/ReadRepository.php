<?php


namespace App\Packages\User\Infrastructure\Spot;


use App\Models\Spot as SpotModel;
use App\Packages\Shared\Service\ImagePath;
use App\Packages\User\Domain\Spot\ReadModel\ReadSpot;
use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadAvailableTime;
use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadLocation;
use App\Packages\User\Domain\Spot\Spot;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReadRepository implements ReadRepositoryInterface
{
    private $spotModel;

    public function __construct(SpotModel $spotModel)
    {
        $this->spotModel = $spotModel->selectRaw(
            "ST_X(location) as lng, " .
            "ST_Y(location) as lat, " .
            "id, code, name, image, code, prefecture_id, address, open_on, close_on"
        );
    }

    /**
     * @return array
     */
    public function all()
    {
        $rows = $this->spotModel->get();

        if ($rows->isNotEmpty()) {
            foreach ($rows as $row) {
                $spots[] = ReadSpot::reconstructForPart(
                    $row->id,
                    $row->name,
                    $row->image,
                    $row->address,
                    new ReadAvailableTime(
                        $row->open_on,
                        $row->close_on
                    )
                );
            }
            return $spots;

        }
        return [];
    }

    /**
     * @param $spotId
     * @return ReadSpot
     */
    public function findById($spotId)
    {
        if ($row = $this->spotModel->where('id', $spotId)->first()) {

            $readSpot = ReadSpot::reconstructForDetail(
                $row->id,
                $row->code,
                $row->name,
                $row->image,
                $row->prefecture_id,
                $row->address,
                $row->content,
                new ReadLocation(
                    $row->lat,
                    $row->lng
                ),
                new ReadAvailableTime(
                    $row->open_on,
                    $row->close_on
                )
            );
            return $readSpot;

        } else {
            throw new ModelNotFoundException('スポットの情報が見つかりませんでした。');
        }

    }
}
