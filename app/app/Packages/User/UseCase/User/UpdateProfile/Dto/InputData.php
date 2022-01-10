<?php

namespace App\Packages\User\UseCase\User\UpdateProfile\Dto;

class InputData
{
    private $backgroundImage;
    private $image;
    private string $name;
    private ?string $biography;
    private ?array $genres;

    public function __construct(
        $backgroundImage,
        $image,
        $name,
        $biography,
        $genres
    )
    {
        $this->backgroundImage = $backgroundImage;
        $this->image = $image;
        $this->name = $name;
        $this->biography = $biography;
        $this->genres = $genres;
    }

    /**
     * @return mixed
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
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
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @return array|null
     */
    public function getGenres()
    {
        return $this->genres;
    }

}
