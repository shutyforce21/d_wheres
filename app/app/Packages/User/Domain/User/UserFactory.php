<?php


namespace App\Packages\User\Domain\User;


use App\Packages\Shared\Service\UniqueCode;
use App\Packages\User\Domain\User\ChildEntity\Profile;
use App\Packages\User\Domain\User\ValueObject\Password;
use App\Packages\User\UseCase\User\Register\Dto\InputData;

class UserFactory
{
    const USER_TABLE_NAME = 'users';
    const USER_UNIQUE_CODE_FIELD_NAME = 'code';
    const PROFILE_TABLE_NAME = 'profiles';
    const PROFILE_UNIQUE_CODE_FIELD_NAME = 'user_code';

    public static function create(InputData $inputData)
    {
        $code = UniqueCode::create(self::USER_TABLE_NAME, self::USER_UNIQUE_CODE_FIELD_NAME);

        $user = User::reconstruct(
            $code,
            $inputData->getEmail(),
            new Password($inputData->getPassword()),
            Profile::reconstruct(
                $inputData->getName(),
                UniqueCode::create(self::PROFILE_TABLE_NAME, self::PROFILE_UNIQUE_CODE_FIELD_NAME)
            )
        );

        return $user;
    }
}
