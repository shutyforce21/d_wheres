<?php


namespace App\Packages\User\Domain\User\ChildEntity;


class Profile
{
    private ?string $backgroundImage;
    private ?string $image;
    private string $name;
    private ?string $biography;
    private ?array $genres;

    private function __construct(){}

    public static function fromRepository(
        $backgroundImage,
        $image,
        $name,
        $biography,
        $genres
    )
    {
        $self = new self();
        $self->backgroundImage = $backgroundImage;
        $self->image = $image;
        $self->name = $name;
        $self->biography = $biography;
        $self->genres = $genres;
        return $self;
    }

    public static function reconstruct($name)
    {
        $self = new self();
        $self->name = $name;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string|null $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * @param array|null $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
