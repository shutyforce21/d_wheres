<?php

namespace App\Packages\User\UseCase\User\RegisterProfile\Dto;

class InputData
{
    private $image;
    private ?string $biography;
    private ?array $genres;

    public function __construct(
        $image,
        $biography,
        $genres
    )
    {
        $this->image = $image;
        $this->biography = $biography;
        $this->genres = $genres;
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
