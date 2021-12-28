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
    private ?array $followedIds = [];
    private ?int $newFollowedId;

    private function __construct(){}

    /**
     * //新規生成ルート
     * @param $code
     * @param $name
     * @param $email
     * @param Password $password
     * @return User
     */
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
     * repositoryから生成ルート
     * @param $id
     * @param $code
     * @param $name
     * @param Profile $profile
     * @return User
     */
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
     * profileエンティティ
     * @param $profile
     * @throws \Exception
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
     * フォローユーザーのIds
     * @param $followedIds
     */
    public function setFollowedIds($followedIds)
    {
        $this->followedIds = $followedIds;
    }

    /**
     * ユーザーをフォローする
     * @param $followedId
     * @throws \Exception
     */
    public function follow($followedId)
    {
        if (in_array($followedId, $this->getFollowedIds())) {
            throw new \Exception('既にフォロー済みです。');

        } elseif ($followedId === $this->getId()) {
            throw new \Exception('自分自信をフォローする事はできません。');

        } else {
            $this->newFollowedId = $followedId;
        }
    }

    /**
     * フォローしたユーザーIDを取得する
     * @return int|null
     */
    public function getNewFollowedId()
    {
        return $this->newFollowedId;
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

    /**
     * @return array|null
     */
    public function getFollowedIds()
    {
        return $this->followedIds;
    }
}
