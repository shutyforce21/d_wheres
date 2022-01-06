<?php

namespace App\Packages\User\UseCase\User\ShowProfile;

use App\Packages\User\Infrastructure\User\ReadRepositoryInterface;

class ShowProfile
{
    private $readRepository;

    public function __construct(ReadRepositoryInterface $readRepository)
    {
        $this->readRepository = $readRepository;
    }

    /**
     * @param $authId
     * @param $userId
     * @return \App\Packages\User\Domain\User\ReadModel\ReadUser
     * @throws \Exception
     */
    public function handle($authId, $userId)
    {
        $readUserEntity = $this->readRepository->findById($userId);
        // 自分自身のプロフィールを取得した場合
        if (intval($authId) === intval($userId)) {
            // selfFlagをtrue
            $readUserEntity->isSelf();
        }
        return $readUserEntity;
    }

}
