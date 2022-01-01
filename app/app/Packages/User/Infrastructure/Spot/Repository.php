<?php


namespace App\Packages\User\Infrastructure\Spot;


use App\Models\Spot as SpotModel;
use App\packages\User\Domain\Spot\Spot;
use Illuminate\Support\Facades\DB;

class Repository implements RepositoryInterface
{
    private $spotModel;

    public function __construct(SpotModel $spotModel)
    {
        $this->spotModel = $spotModel;
    }

    /**
     * 練習場所を登録
     * @param Spot $spot
     * @param [type] $userId
     * @return void
     */
    public function save(Spot $spot, $userId)
    {
        DB::beginTransaction();
        try {
            $this->spotModel->code = $spot->getCode();
            $this->spotModel->name = $spot->getName();
            $this->spotModel->image = $spot->getImage();
            $this->spotModel->prefecture_id = $spot->getPrefectureId();
            $this->spotModel->address = $spot->getAddress();
            $this->spotModel->location = $spot->getLocation()->getGft();
            $this->spotModel->open_on = $spot->getAvailableTime()->getOpenOn();
            $this->spotModel->close_on = $spot->getAvailableTime()->getCloseOn();
            $this->spotModel->create_user_id = $userId;
            $this->spotModel->save();
            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            logger()->error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

}
