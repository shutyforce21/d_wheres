<?php


namespace App\Packages\User\Infrastructure\User;

use App\Models\User as UserModel;
use App\Models\Profile as ProfileModel;
use App\Packages\User\Domain\User\ReadModel\ChildEntity\ReadProfile;
use App\Packages\User\Domain\User\ReadModel\ReadUser;

class ReadRepository implements ReadRepositoryInterface
{
    private $userModel;
    private $profileModel;

    public function __construct(
        UserModel $userModel,
        ProfileModel $profileModel
    )
    {
        $this->userModel = $userModel;
        $this->profileModel = $profileModel;
    }

    public function findById($userId)
    {
        if ($userModel = $this->userModel->find($userId)) {
            $readUser = new ReadUser(
                $userModel->id,
                $userModel->code,
                $userModel->name,
                new ReadProfile(
                    optional($userModel->profile)->image,
                    optional($userModel->profile)->biography,
                    optional($userModel->genres)->map(function($g) {
                        return $g->id;
                    })
                )
            );
            return $readUser;

        } else {
            throw new \Exception('ユーザーが見つかりませんでした。');
        }
    }
}
