<?php

namespace App\Packages\User\UseCase\User\UpdateProfile\Dto;

class InputData
{
    private $backgroundImage;
    private $image;
    private string $name;
    private string $userCode;
    private ?string $biography;
    private ?array $genres;

    public function __construct(
        $backgroundImage,
        $image,
        $name,
        $userCode,
        $biography,
        $genres
    )
    {
        $this->backgroundImage = $backgroundImage;
        $this->image = $image;
        $this->name = $name;
        $this->userCode = $userCode;
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
     * @return string
     */
    public function getUserCode()
    {
        return $this->userCode;
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
