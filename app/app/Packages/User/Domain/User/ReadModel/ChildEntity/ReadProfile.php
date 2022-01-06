<?php

namespace App\Packages\User\Domain\User\ReadModel\ChildEntity;

use App\Packages\Shared\Service\ImagePath;

class ReadProfile
{
    private ?string $image;
    private ?string $biography;
    private ?array $genres;
    private ?int $follows;
    private ?int $followers;

    public function __construct(
        $image,
        $follows,
        $followers,
        $biography,
        $genres
    )
    {
        $this->image = $image;
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
        if ($this->image) {
            $imgPath = ImagePath::getAbsolutePath($this->image);
        }
        return $imgPath;
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
