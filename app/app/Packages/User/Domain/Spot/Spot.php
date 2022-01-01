<?php


namespace App\Packages\User\Domain\Spot;


use App\Packages\User\Domain\Spot\ValueObject\AvailableTime;
use App\packages\User\Domain\Spot\ValueObject\GeometricLocation;

class Spot
{
    private string $code;
    private string $name;
    private ?string $image;
    private int $prefectureId;
    private string $address;
    private ?string $content;
    private GeometricLocation $location;
    private AvailableTime $availableTime;

    private function __construct(){}

    public static function reconstruct(
        $code,
        $name,
        $prefectureId,
        $address,
        $content,
        GeometricLocation $location,
        AvailableTime $availableTime
    ){
        $self = new self();
        $self->code = $code;
        $self->name = $name;
        $self->image = null;
        $self->prefectureId = $prefectureId;
        $self->address = $address;
        $self->content = $content;
        $self->location = $location;
        $self->availableTime = $availableTime;
        return $self;
    }

    /**
     * @param string|null $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPrefectureId()
    {
        return $this->prefectureId;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return AvailableTime
     */
    public function getAvailableTime()
    {
        return $this->availableTime;
    }
}
