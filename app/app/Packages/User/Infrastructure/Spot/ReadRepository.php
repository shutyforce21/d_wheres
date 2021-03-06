<?php


namespace App\Packages\User\Infrastructure\Spot;

use App\Models\Spot as SpotModel;
use App\Packages\User\Domain\Spot\ReadModel\ReadSpot;
use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadAvailableTime;
use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadLocation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Packages\User\Domain\Spot\DataAccessInterface\ReadRepositoryInterface;

class ReadRepository implements ReadRepositoryInterface
{
    private $spotModel;

    /**
     * ST_X(location) => longitude(経度)
     * ST_Y(location) => latitude(緯度)
     *
     * ReadRepository constructor.
     * @param SpotModel $spotModel
     */
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
    public function get()
    {
        $rows = $this->spotModel->get();
        if ($rows->isNotEmpty()) {
            foreach ($rows as $row) {
                $spot = ReadSpot::reconstructForPart(
                    $row->id,
                    $row->name,
                    $row->image,
                    $row->address,
                    new ReadAvailableTime(
                        $row->open_on,
                        $row->close_on
                    )
                );
                $spot->setLocation(
                    new ReadLocation(
                        $row->lat,
                        $row->lng
                    )
                );
                $spots[] = $spot;
            }
            return $spots;

        }
        return [];
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
