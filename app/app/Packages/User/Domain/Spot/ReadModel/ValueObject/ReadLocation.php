<?php


namespace App\Packages\User\Domain\Spot\ReadModel\ValueObject;


class ReadLocation
{
    private string $lat;
    private string $lng;

    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getLat() {
        return $this->lat;
    }

    public function getLng(){
        return $this->lng;
    }
}
