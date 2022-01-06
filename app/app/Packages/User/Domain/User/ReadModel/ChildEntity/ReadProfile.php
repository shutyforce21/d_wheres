<?php

namespace App\Packages\User\Domain\User\ReadModel\ChildEntity;

use App\Packages\Shared\Service\ImagePath;

class ReadProfile
{
    private ?string $image;
    private ?string $backgroundImage;
    private ?string $biography;
    private ?array $genres;
    private ?int $follows;
    private ?int $followers;

    public function __construct(
        $image,
        $backgroundImage,
        $follows,
        $followers,
        $biography,
        $genres
    )
    {
        $this->image = $image;
        $this->backgroundImage = $backgroundImage;
        $this->follows = $follows;
        $this->followers = $followers;
        $this->biography = $biography;
        $this->genres = $genres;
    }

    /**
     * @param $imgPath
     * @return string|null
     */
    protected function setOriginPath($imgPath)
    {
        if ($imgPath) {
            return ImagePath::getAbsolutePath($imgPath);

        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->setOriginPath($this->image);
    }

    /**
     * @return string|null
     */
    public function getBackgroundImage()
    {
        return $this->setOriginPath($this->backgroundImage);
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
