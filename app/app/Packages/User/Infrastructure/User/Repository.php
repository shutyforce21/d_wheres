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
     * @return mixed
     * @throws \Exception
     */
    public function save(User $user)
    {
        try {
            $this->userModel->code = $user->getCode();
            $this->userModel->name = $user->getName();
            $this->userModel->email = $user->getEmail();
            $this->userModel->password = $user->getPassword();
            $this->userModel->save();

            return $this->userModel->id;

        } catch (\Throwable $throwable) {
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
                    optional($userModel->profile)->image,
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
    public function saveProfile(User $user)
    {
        DB::beginTransaction();
        try {
            $profileModel = new ProfileModel();
            $profileModel->user_id = $user->getId();
            $profileModel->image = $user->getProfile()->getImage();
            $profileModel->biography = $user->getProfile()->getBiography();
            $profileModel->save();

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
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function follow(User $user)
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
}
