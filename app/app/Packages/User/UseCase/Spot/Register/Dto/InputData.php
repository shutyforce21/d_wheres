<?php


namespace App\Packages\User\UseCase\Spot\Register\Dto;

class InputData
{
    private string $name;
    private $image;
    private int $prefectureId;
    private ?string $address;
    private ?string $content;
    private string $latitude;
    private string $longitude;
    private ?string $openOn;
    private ?string $closeOn;

    public function __construct(
        $name,
        $image,
        $prefectureId,
        $address,
        $content,
        $latitude,
        $longitude,
        $openOn,
        $closeOn
    ) {
        $this->name = $name;
        $this->image = $image;
        $this->prefectureId = $prefectureId;
        $this->address = $address;
        $this->content = $content;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->openOn = $openOn;
        $this->closeOn = $closeOn;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getPrefectureId()
    {
        return $this->prefectureId;
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return string|null
     */
    public function getOpenOn()
    {
        return $this->openOn;
    }

    /**
     * @return string|null
     */
    public function getCloseOn()
    {
        return $this->closeOn;
    }
}
