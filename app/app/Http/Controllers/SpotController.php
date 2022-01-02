<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterSpotRequest;
use App\Http\Resources\SpotResource;
use App\Packages\User\UseCase\Spot\Get\GetSpots;
use App\packages\User\UseCase\Spot\Register\RegisterSpot;
use Illuminate\Http\Response;
use Throwable;

class SpotController extends Controller
{
    /**
     * (メモ) ログインしていれば、誰がいるかとか、場所の詳細を確認できる。
     * @param GetSpots $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetSpots $useCase)
    {
        try {
            $outputData = $useCase->handle();
            return response()->json(
                [
                    'message' => 'success',
                    'data' => SpotResource::collection($outputData)
                ],
                Response::HTTP_OK
            );

        } catch(Throwable $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param RegisterSpotRequest $request
     * @param RegisterSpot $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterSpotRequest $request, RegisterSpot $useCase)
    {
        // $userId = Auth::id();
        $userId = 1;
        $inputData = $request->getInputData();
        try {
            $useCase->handle($inputData, $userId);
            return response()->json(
                ['message' => 'success'],
                Response::HTTP_OK
            );

        } catch(Throwable $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show($spotId)
    {

    }
}

?>
