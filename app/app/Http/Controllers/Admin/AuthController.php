<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $inputData = $request->getInputData();

        $user = AdminUser::where('email', $inputData->getEmail())->first();
        if (!$user || !password_verify($inputData->getPassword(), $user->password)) {
            return response()->json(["message" => "メールアドレスまたはパスワードが違います。"],Response::HTTP_NOT_FOUND);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;
        return response()->json([
            'message' => 'success',
            'data' => [
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
    public function isAuthenticated()
    {
        return response()->json(
            ['message' => 'success'],
            Response::HTTP_OK);
    }
}
