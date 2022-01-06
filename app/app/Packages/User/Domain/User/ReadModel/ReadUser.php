<?php


namespace App\Packages\User\Domain\User\ReadModel;

use App\Packages\User\Domain\User\ReadModel\ChildEntity\ReadProfile;

class ReadUser
{
    private int $id;
    private string $code;
    private string $name;
    private ReadProfile $profile;
    private bool $isSelf;

    public function __construct(
        $id,
        $code,
        $name,
        ReadProfile $profile
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->profile = $profile;
        $this->isSelf = false;
    }

    /**
     * @return bool
     */
    public function getSelfFlag()
    {
        return $this->isSelf;
    }

    /**
     * 自信のプロフィールだった場合
     */
    public function isSelf()
    {
        $this->isSelf = true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return ReadProfile
     */
    public function getProfile()
    {
        return $this->profile;
    }

}
