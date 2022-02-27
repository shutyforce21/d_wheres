<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterSpotRequest;
use App\Http\Resources\SpotResource;
use App\Packages\User\UseCase\Spot\Get\GetSpots;
use App\Packages\User\UseCase\Spot\Search\SearchSpots;
use App\packages\User\UseCase\Spot\Register\RegisterSpot;
use App\Packages\User\UseCase\Spot\Show\ShowSpot;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SpotController extends Controller
{
    /**
     * (メモ) ログインしていれば、誰がいるかとか、場所の詳細を確認できる。
     * @param SearchSpots $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(SearchSpots $useCase)
    {
        try {
            $outputData = $useCase();
            return response()->json(
                [
                    'message' => 'success',
                    'data' => SpotResource::collectionForSearch($outputData)
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
     * @param GetSpots $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetSpots $useCase)
    {
        try {
            $outputData = $useCase();
            return response()->json(
                [
                    'message' => 'success',
                    'data' => SpotResource::collectionForMap($outputData)
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
        $userId = Auth::id();
        $inputData = $request->getInputData();

        try {
            $useCase($inputData, $userId);
            return response()->json(
                ['message' => 'success'],
                Response::HTTP_OK
            );

        } catch(Throwable $e) {
            logger()->info($e->getMessage());
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param $spotId
     * @param ShowSpot $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($spotId, ShowSpot $useCase)
    {
        try {
            $outputData = $useCase($spotId);
            return response()->json(
                [
                    'message' => 'success',
                    'data' => SpotResource::toArrayForDetail($outputData)
                ],
                Response::HTTP_OK
            );

        } catch(Throwable $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}

?>
