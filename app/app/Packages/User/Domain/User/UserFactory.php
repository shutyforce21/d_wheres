<?php


namespace App\Packages\User\Domain\User;


use App\Packages\Shared\Service\UniqueCode;
use App\Packages\User\Domain\User\ChildEntity\Profile;
use App\Packages\User\Domain\User\ValueObject\Password;
use App\Packages\User\UseCase\User\Register\Dto\InputData;

class UserFactory
{
    const TABLE_NAME = 'users';

    public static function create(InputData $inputData)
    {
        $code = UniqueCode::create(self::TABLE_NAME);

        $user = User::reconstruct(
            $code,
            $inputData->getEmail(),
            new Password($inputData->getPassword()),
            Profile::reconstruct($inputData->getName())
        );

        return $user;
    }
}
