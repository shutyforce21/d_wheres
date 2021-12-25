<?php


namespace App\Packages\User\UseCase\User\Login\Dto;


class InputData
{
    private string $email;
    private string $password;

    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;
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
