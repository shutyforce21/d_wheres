<?php


namespace App\Packages\User\Domain\User;

use App\Packages\User\Domain\User\ChildEntity\Profile;
use App\Packages\User\Domain\User\ValueIObject\Password;

class User
{
    private int $id;
    private string $code;
    private string $name;
    private string $email;
    private Password $password;
    private Profile $profile;

    private function __construct(){}

    public static function reconstruct(
        $code,
        $name,
        $email,
        Password $password
    )
    {
        $self = new self();
        $self->code = $code;
        $self->name = $name;
        $self->email = $email;
        $self->password = $password->getHashedPassword();
        return $self;
    }

    public static function fromRepository(
        $id,
        $code,
        $name,
        Profile $profile
    )
    {
        $self = new self();
        $self->id = $id;
        $self->code = $code;
        $self->name = $name;
        $self->profile = $profile;
        return $self;
    }

    /**
     * @param Profile $profile
     */
    public function setProfile($profile)
    {
        if ($profile instanceof Profile) {
            $this->profile = $profile;

        } else {
            throw new \Exception('インスタンスが違います。');
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
