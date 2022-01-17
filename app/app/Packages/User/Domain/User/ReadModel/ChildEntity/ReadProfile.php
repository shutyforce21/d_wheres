<?php

namespace App\Packages\User\Domain\User\ReadModel\ChildEntity;

use App\Packages\Shared\Service\ImagePath;

class ReadProfile
{
    private ?string $image;
    private ?string $backgroundImage;
    private string $name;
    private string $userCode;
    private ?string $biography;
    private ?array $genres;
    private ?int $follows;
    private ?int $followers;

    public function __construct(
        $image,
        $backgroundImage,
        $name,
        $userCode,
        $follows,
        $followers,
        $biography,
        $genres
    )
    {
        $this->image = $image;
        $this->backgroundImage = $backgroundImage;
        $this->name = $name;
        $this->userCode = $userCode;
        $this->follows = $follows;
        $this->followers = $followers;
        $this->biography = $biography;
        $this->genres = $genres;
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
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
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
     * @return int|null
     */
    public function getFollows()
    {
        return $this->follows;
    }

    /**
     * @return int|null
     */
    public function getFollowers()
    {
        return $this->followers;
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
