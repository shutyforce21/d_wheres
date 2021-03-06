<?php

namespace App\Packages\User\UseCase\User\ShowProfile;


use App\Packages\User\Domain\User\DataAccessInterface\ReadRepositoryInterface;

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
    public function __invoke($authId, $userId)
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
