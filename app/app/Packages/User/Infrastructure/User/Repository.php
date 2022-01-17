<?php


namespace App\Packages\User\Infrastructure\User;


use App\Models\User as UserModel;
use App\Models\Profile as ProfileModel;
use App\Packages\User\Domain\User\ChildEntity\Profile;
use App\Packages\User\Domain\User\User;
use Illuminate\Support\Facades\DB;

class Repository implements RepositoryInterface
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

    /**
     * @param User $user
     * @return mixed|void
     * @throws \Exception
     */
    public function save(User $user)
    {
        DB::beginTransaction();
        try {
            $this->userModel->code = $user->getCode();
            $this->userModel->email = $user->getEmail();
            $this->userModel->password = $user->getPassword();
            $this->userModel->save();

            $this->profileModel->user_id = $this->userModel->id;
            $this->profileModel->user_code = $user->getProfile()->getUserCode();
            $this->profileModel->name = $user->getProfile()->getName();
            $this->profileModel->save();
            DB::commit();

        } catch (\Throwable $throwable) {
            DB::rollBack();
            logger()->info($throwable->getMessage());
            throw new \Exception($throwable->getMessage());
        }
    }

    /**
     * @param $userId
     * @return User
     * @throws \Exception
     */
    public function findById($userId)
    {
        if($userModel = $this->userModel->find($userId)) {
            $user = User::fromRepository(
                $userModel->id,
                $userModel->code,
                $userModel->name,
                Profile::fromRepository(
                    optional($userModel->profile)->background,
                    optional($userModel->profile)->image,
                    $userModel->profile->name,
                    $userModel->profile->user_code,
                    optional($userModel->profile)->biography,
                    optional($userModel->profile)->genres
                )
            );

            $followedIds = optional($userModel->follows)->map(function($user) {
                return $user->id;
            })->toArray();
            $user->setFollowedIds($followedIds);

            return $user;

        } else {
            throw new \Exception('ユーザーが見つかりませんでした。');
        }
    }

    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function updateProfile(User $user)
    {
        DB::beginTransaction();
        try {
            $this->profileModel->updateOrCreate(
                [
                    'user_id' => $user->getId()
                ], [
                    'image' => $user->getProfile()->getImage(),
                    'background' => $user->getProfile()->getBackgroundImage(),
                    'name' => $user->getProfile()->getName(),
                    'user_code' => $user->getProfile()->getUserCode(),
                    'biography' => $user->getProfile()->getBiography()
                ]
            );

            $this->userModel
                ->find($user->getId())
                ->genres()
                ->sync($user->getProfile()->getGenres());

            DB::commit();
            return true;

        } catch (\Throwable $throwable) {

            DB::rollBack();
            logger()->info($throwable->getMessage());
            throw new \Exception($throwable->getMessage());
        }
    }


    /**
     * ユーザーをフォローする
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function followAndSave(User $user)
    {
        if ($userModel = $this->userModel->find($user->getId())) {
            try {
                $userModel->follows()->attach($user->getNewFollowedId());
                return true;

            } catch (\Throwable $throwable) {
                logger()->info($throwable->getMessage());
                throw new \Exception($throwable->getMessage());
            }

        } else {
            throw new \Exception('ユーザーが見つかりませんでした。');
        }
    }

    /**
     * ユーザーをアンフォローする
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function unfollowAndSave(User $user)
    {
        if ($userModel = $this->userModel->find($user->getId())) {
            try {
                $userModel->follows()->detach($user->getUnfollowedId());
                return true;

            } catch (\Throwable $throwable) {
                logger()->info($throwable->getMessage());
                throw new \Exception($throwable->getMessage());
            }

        } else {
            throw new \Exception('ユーザーが見つかりませんでした。');
        }
    }
}
