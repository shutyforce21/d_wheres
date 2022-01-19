<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Packages\User\UseCase\User\Register\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @param RegisterUserRequest $request
     * @param RegisterUser $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request, RegisterUser $useCase)
    {
        $inputData = $request->getInputData();
        try {
            $useCase->handle($inputData);
            return response()->json(
                ['message' => 'success'],
                Response::HTTP_OK);

        } catch (\Throwable $throwable) {
            return response()->json(
                ['message' => $throwable->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $inputData = $request->getInputData();

        $user = User::where('email', $inputData->getEmail())->first();
        if (!$user || !password_verify($inputData->getPassword(), $user->password)) {
            return response()->json(["message" => "メールアドレスまたはパスワードが違います。"],Response::HTTP_NOT_FOUND);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'code' => $user->code,
                'token' => $token
            ]
        ], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(
            ['message' => 'success'],
            Response::HTTP_OK);
    }

    /**
     * tokenが認証済みかどうか
     * @return \Illuminate\Http\JsonResponse
     */
    public function isAuthenticated() {
        return response()->json(
            ['message' => 'success'],
            Response::HTTP_OK);
    }
}
