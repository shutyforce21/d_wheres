<?php


namespace App\Packages\User\Domain\Spot;

use App\Packages\Shared\Service\UniqueCode;
use App\Packages\User\Domain\Spot\ValueObject\AvailableTime;
use App\Packages\User\Domain\Spot\ValueObject\GeometricLocation;
use App\Packages\User\UseCase\Spot\Register\Dto\InputData;

class SpotFactory
{
    const TABLE_NAME = 'spots';
    const UNIQUE_CODE_FILED_NAME = 'code';

    public static function create(InputData $inputData)
    {
        $code = UniqueCode::create(self::TABLE_NAME, self::UNIQUE_CODE_FILED_NAME);

        $spot = Spot::reconstruct(
            $code,
            $inputData->getName(),
            $inputData->getPrefectureId(),
            $inputData->getAddress(),
            $inputData->getContent(),
            new GeometricLocation(
                $inputData->getLatitude(),
                $inputData->getLongitude()
            ),
            new AvailableTime(
                $inputData->getOpenOn(),
                $inputData->getCloseOn()
            )
        );

        return $spot;
    }
}
