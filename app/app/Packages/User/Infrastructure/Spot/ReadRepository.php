<?php

namespace App\packages\User\Infrastructure\Spot;

use App\Models\Spot as SpotModel;

class ReadRepository implements ReadRepositoryInterface
{
    private $spotModel;

    public function __construct(SpotModel $spotModel)
    {
        $this->spotModel = $spotModel;
    }

    public function all()
    {
        $spots = $this->spotModel->all();
        dd($spots);
    }

}