<?php

namespace App\Packages\User\Domain\Spot\ReadModel;


use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadLocation;

class ReadSpot
{
    private int $id;
    private string $name;
    private ?string $image;
    private int $prefectureId;
    private string $address;
    private ?string $content;
    private ReadLocation $location;

    public function __construct(
        $id,
        $name,
        $image,
        $prefectureId,
        $address,
        $content,
        ReadLocation $location
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->prefectureId = $prefectureId;
        $this->address = $address;
        $this->content = $content;
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getPrefectureId()
    {
        return $this->prefectureId;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return ReadLocation
     */
    public function getLocation()
    {
        return $this->location;
    }
}

?>
