<?php


namespace App\Packages\User\Domain\User\ChildEntity;


class Profile
{
    private ?string $backgroundImage;
    private ?string $image;
    private ?string $biography;
    private ?array $genres;

    private function __construct(){}

    public static function fromRepository(
        $backgroundImage,
        $image,
        $biography,
        $genres
    )
    {
        $self = new self();
        $self->backgroundImage = $backgroundImage;
        $self->image = $image;
        $self->biography = $biography;
        $self->genres = $genres;
        return $self;
    }

    public static function reconstruct(
        $biography,
        $genres
    )
    {
        $self = new self();
        $self->biography = $biography;
        $self->genres = $genres;
        return $self;
    }

    /**
     * @param string|null $backgroundImage
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @param string|null $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return array|null
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @return string|null
     */
    public function getBiography()
    {
        return $this->biography;
    }
}
