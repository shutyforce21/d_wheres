<?php


namespace App\Packages\User\Domain\User;

use App\Packages\User\Domain\User\ValueIObject\Password;

class User
{
    private string $code;
    private string $name;
    private string $email;
    private Password $password;

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
