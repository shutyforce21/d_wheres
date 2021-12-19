<?php
namespace App\packages\User\Domain\Spot;

use App\packages\User\Domain\Spot\ValueObject\GeometricLocation;

class Spot
{
    private string $name;
    private ?string $image;
    private int $prefectureId;
    private string $address;
    private ?string $content;
    private GeometricLocation $location;

    private function __construct(){}

    public static function reconstruct(
        $name,
        $image,
        $prefectureId,
        $address,
        $content,
        $location
    ){
        $self = new self();
        $self->name = $name;
        $self->image = $image;
        $self->prefectureId = $prefectureId;
        $self->address = $address;
        $self->content = $content;
        if ($location instanceof GeometricLocation) {
            $self->location = $location;
        }
        return $self;
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
}

?>