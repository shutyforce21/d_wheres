<?php


namespace App\Http\Controllers\Admin;


use App\Packages\Admin\UseCase\Spot\Activate\ActivateSpot;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SpotController
{
    /**
     * 一覧
     * @return string
     */
    public function index()
    {
        $spots = [1,2,3,4,5];
        return view('admin.spot.index')->with(["spots" => $spots]);
    }

    /**
     * 有効化
     * @return string
     */
    public function activate($spotId, ActivateSpot $usecase)
    {
        try {
            $usecase($spotId);
            return response()->json(
                ['message' => 'success'],
                Response::HTTP_OK
            );
        } catch(\Throwable $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * 無効化
     * @return string
     */
    public function inactivate($spotId)
    {
        return 'asdf';
    }
}
