<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Packages\User\UseCase\User\RegisterProfile\RegisterProfile;
use App\Packages\User\UseCase\User\ShowProfile\ShowProfile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @param RegisterUserProfileRequest $request
     * @param RegisterProfile $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterUserProfileRequest $request, RegisterProfile $useCase)
    {
        $userId = 1;
//        $userId = Auth::id();
        try {
            $inputData = $request->getInputData();
            $useCase->handle($inputData, $userId);

            return response()->json(
                ['message' => 'success'],
                Response::HTTP_OK
            );

        } catch (\Throwable $throwable) {
            return response()->json(
                ['message' => $throwable->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param ShowProfile $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowProfile $useCase)
    {
        $userId = 1;
//        $userId = Auth::id();
        try {
            $outputData = $useCase->handle($userId);
            return response()->json(
                ['data' => ProfileResource::toArray($outputData)],
                Response::HTTP_OK
            );

        } catch (\Throwable $throwable) {
            return response()->json(
                ['message' => $throwable->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
