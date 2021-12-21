<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Packages\User\UseCase\User\Register\RegisterUser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request, RegisterUser $useCase)
    {
        $inputData = $request->getInputData();
        dd($inputData);
        $useCase->handle($inputData);
    }
}
