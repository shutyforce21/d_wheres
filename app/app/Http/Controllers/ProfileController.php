<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Packages\User\UseCase\User\UpdateProfile\UpdateProfile;
use App\Packages\User\UseCase\User\ShowProfile\ShowProfile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @param UpdateUserProfileRequest $request
     * @param UpdateProfile $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserProfileRequest $request, UpdateProfile $useCase)
    {
        $authId = Auth::id();
//        try {
            $inputData = $request->getInputData();
            $useCase->handle($inputData, $authId);

            return response()->json(
                ['message' => 'success'],
                Response::HTTP_OK
            );

//        } catch (\Throwable $throwable) {
//            return response()->json(
//                ['message' => $throwable->getMessage()],
//                Response::HTTP_INTERNAL_SERVER_ERROR
//            );
//        }
    }

    /**
     * @param ShowProfile $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($userId, ShowProfile $useCase)
    {
        $authId = Auth::id();
        try {
            $outputData = $useCase->handle($authId, $userId);
            return response()->json(
                [
                    'message' => 'success',
                    'data' => ProfileResource::toArray($outputData)],
                Response::HTTP_OK
            );

        } catch (\Throwable $throwable) {
            return response()->json(
                ['message' => $throwable->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
