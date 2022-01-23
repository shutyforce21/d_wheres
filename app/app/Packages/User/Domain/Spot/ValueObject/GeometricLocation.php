<?php


namespace App\Packages\User\Domain\Spot\ValueObject;

use Illuminate\Support\Facades\DB;

class GeometricLocation
{
    private string $lat;
    private string $lng;

    // TODO 緯度経度を日本に絞る
    // const LOWEST_LATITUDE = 1234.1234
    // const HIGHEST_LATITUDE = 1234.1234
    // const LOWEST_LONGITUDE = 1234.1234
    // const HIGHEST_LONGITUDE = 1234.1234

    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * MySql用ST_GeomFromText関数に通した値を返す
     * @return \Illuminate\Database\Query\Expression
     */
    public function getGft() {
        $point = 'POINT(' . $this->lng . ' ' . $this->lat . ')';
        return DB::raw('ST_GeomFromText("' . $point . '")');
    }
}
