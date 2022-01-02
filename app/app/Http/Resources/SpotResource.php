<?php

namespace App\Http\Resources;

use App\Packages\User\Domain\Spot\ReadModel\ReadSpot;
use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\TestFixture\func;

class SpotResource
{
    /**
     * @param ReadSpot $spot
     * @return array
     */
    public static function toArrayForPart(ReadSpot $spot)
    {
        return [
            'id' => $spot->getId(),
            'name' => $spot->getName(),
            'image' => $spot->getImage(),
            'available_time' => [
                'open_on' => $spot->getAvailableTime()->getOpenOn(),
                'close_on' => $spot->getAvailableTime()->getCloseOn(),
            ]
        ];
    }

    /**
     * @param ReadSpot $spot
     * @return array
     */
    public static function toArrayForDetail(ReadSpot $spot)
    {
        return [
            'id' => $spot->getId(),
            'code' => $spot->getCode(),
            'name' => $spot->getName(),
            'image' => $spot->getImage(),
            'prefecture_id' => $spot->getPrefectureId(),
            'address' => $spot->getAddress(),
            'content' => $spot->getContent(),
            'location' => [
                'latitude' => $spot->getLocation()->getLat(),
                'longitude' => $spot->getLocation()->getLng()
            ],
            'available_time' => [
                'open_on' => $spot->getAvailableTime()->getOpenOn(),
                'close_on' => $spot->getAvailableTime()->getCloseOn(),
            ]
        ];
    }

    public static function collection(array $spots)
    {
        return array_map(function($spot){
            return self::toArray($spot);
        }, $spots);
    }
}
