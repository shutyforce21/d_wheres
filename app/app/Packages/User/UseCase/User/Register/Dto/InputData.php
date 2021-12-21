<?php

namespace App\Packages\User\UseCase\User\Register\Dto;

class InputData
{
    private string $name;
    private string $email;
    private string $password;

    public function __construct(
        $name,
        $email,
        $password
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
