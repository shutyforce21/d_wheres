<?php

namespace App\Packages\User\Domain\Spot\ReadModel;


use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadAvailableTime;
use App\Packages\User\Domain\Spot\ReadModel\ValueObject\ReadLocation;

class ReadSpot
{
    private int $id;
    private string $code;
    private string $name;
    private ?string $image;
    private int $prefectureId;
    private string $address;
    private ?string $content;
    private ReadLocation $location;
    private ReadAvailableTime $availableTime;

    private function __construct() {}

    /**
     * 一覧用 生成ルート
     *
     * @param $id
     * @param $name
     * @param $image
     * @param $address
     * @param ReadAvailableTime $availableTime
     * @return ReadSpot
     */
    public static function reconstructForPart(
        $id,
        $name,
        $image,
        $address,
        ReadAvailableTime $availableTime
    ) {
        $self = new self();
        $self->id = $id;
        $self->name = $name;
        $self->image = $image;
        $self->address = $address;
        $self->availableTime = $availableTime;
        return $self;
    }

    /**
     * 詳細取得用 生成ルート
     *
     * @param $id
     * @param $code
     * @param $name
     * @param $image
     * @param $prefectureId
     * @param $address
     * @param $content
     * @param ReadLocation $location
     * @param ReadAvailableTime $availableTime
     * @return ReadSpot
     */
    public static function reconstructForDetail(
        $id,
        $code,
        $name,
        $image,
        $prefectureId,
        $address,
        $content,
        ReadLocation $location,
        ReadAvailableTime $availableTime
    ) {
        $self = new self();
        $self->id = $id;
        $self->code = $code;
        $self->name = $name;
        $self->image = $image;
        $self->prefectureId = $prefectureId;
        $self->address = $address;
        $self->content = $content;
        $self->location = $location;
        $self->availableTime = $availableTime;
        return $self;
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
    public function getCode()
    {
        return $this->code;
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

    /**
     * @return ReadAvailableTime
     */
    public function getAvailableTime()
    {
        return $this->availableTime;
    }
}

?>
