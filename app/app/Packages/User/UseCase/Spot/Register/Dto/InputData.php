<?php

namespace App\packages\User\UseCase\Spot\Register\Dto;

class InputData 
{
    private string $name;
    private $image;
    private int $prefectureId;
    private string $address;
    private ?string $content;
    private string $latitude;
    private string $longitude;

    public function __construct(
        $name,
        $image,
        $prefectureId,
        $address,
        $content,
        $latitude,
        $longitude
    ){
        $this->name = $name;
        $this->image = $image;
        $this->prefectureId = $prefectureId;
        $this->address = $address;
        $this->content = $content;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getName(){
        return $this->name;
    }

    public function getImage(){
        return $this->image;
    }

    public function getPrefectureId(){
        return $this->prefectureId;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getContent(){
        return $this->content;
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public function getLongitude(){
        return $this->longitude;
    }
}
