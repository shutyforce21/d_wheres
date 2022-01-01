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
    public static function toArray(ReadSpot $spot)
    {
        return [
            'id' => $spot->getId(),
            'code' => $spot->getCode(),
            'name' => $spot->getName(),
            'image' => $spot->getImage(),
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
