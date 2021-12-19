<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpotRequest;
use App\packages\User\UseCase\Spot\Register\RegisterSpot;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SpotController extends Controller 
{
    public function index()
    {

    }

    public function store(StoreSpotRequest $request, RegisterSpot $usecase)
    {
        // $userId = Auth::id();
        $userId = 1;
        $inputData = $request->getInputData();
        try {
            $usecase->handle($inputData, $userId);
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
}

?>