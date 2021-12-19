<?php
namespace App\packages\User\Domain\Spot\ReadModel;

class ReadSpot
{
    private string $name;
    private ?string $image;
    private int $prefectureId;
    private string $address;
    private ?string $content;

    public function __construct(
        $name,
        $image,
        $prefectureId,
        $address,
        $content
    ) {
        $this->name = $name;
        $this->image = $image;
        $this->prefectureId = $prefectureId;
        $this->address = $address;
        $this->content = $content;
    }
}
?>