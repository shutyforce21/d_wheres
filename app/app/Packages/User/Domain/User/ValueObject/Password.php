<?php


namespace App\Packages\User\Domain\User\ValueObject;

use Illuminate\Support\Facades\Hash;

class Password
{
    private string $hashedPassword;

    public function __construct($value)
    {
        $value = Hash::make($value);
        $this->hashedPassword = $value;
    }

    /**
     * @return string
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

}
