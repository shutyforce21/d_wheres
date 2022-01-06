<?php


namespace App\Http\Resources;

use App\Packages\User\Domain\User\ReadModel\ReadUser;

class ProfileResource
{

    public static function toArray(ReadUser $user)
    {
        return [
            'id' => $user->getId(),
            'code' => $user->getCode(),
            'name' => $user->getName(),
            'profile' => [
                'image' => $user->getProfile()->getImage(),
                'background' => $user->getProfile()->getBackgroundImage(),
                'follows' => $user->getProfile()->getFollows(),
                'followers' => $user->getProfile()->getFollowers(),
                'biography' => $user->getProfile()->getBiography(),
                'genres' => $user->getProfile()->getGenres(),
            ]
        ];
    }
}
