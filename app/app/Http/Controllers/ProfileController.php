<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserProfileRequest;
use App\Packages\User\UseCase\User\RegisterProfile\RegisterProfile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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

    public function show(RegisterProfile $useCase)
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

}
