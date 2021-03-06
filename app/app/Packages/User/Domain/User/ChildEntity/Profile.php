<?php


namespace App\Packages\User\Domain\User\ChildEntity;


class Profile
{
    private ?string $backgroundImage;
    private ?string $image;
    private string $name;
    private string $userCode;
    private ?string $biography;
    private ?array $genres;

    private function __construct(){}

    public static function fromRepository(
        $backgroundImage,
        $image,
        $name,
        $userCode,
        $biography,
        $genres
    )
    {
        $self = new self();
        $self->backgroundImage = $backgroundImage;
        $self->image = $image;
        $self->name = $name;
        $self->userCode = $userCode;
        $self->biography = $biography;
        $self->genres = $genres;
        return $self;
    }

    public static function reconstruct($name, $userCode)
    {
        $self = new self();
        $self->name = $name;
        $self->userCode = $userCode;
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
     * @param string $userCode
     */
    public function setUserCode($userCode)
    {
        $this->userCode = $userCode;
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
    public function getUserCode()
    {
        return $this->userCode;
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
