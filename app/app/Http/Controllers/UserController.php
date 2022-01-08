<?php

namespace App\Http\Controllers;

use App\Packages\User\UseCase\User\Follow\FollowUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request) {

    }

    /**
     * @param $followedId
     * @param FollowUser $useCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow($followedId, FollowUser $useCase)
    {
        $authId = Auth::id();

        try {
            $useCase->handle($authId, $followedId);
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
     * spotに向かう
     */
    public function goToSpot(){}

    /**
     * spotにいる
     */
    public function nowInSpot(){}

}
