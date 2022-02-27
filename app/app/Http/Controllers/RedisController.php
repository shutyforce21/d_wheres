<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\RedisService;
use Illuminate\Http\Request;

class RedisController extends Controller
{
    public function redis1(Request $request, RedisService $redisService)
    {
        $key1Value = $request->input('key1');

        if (!is_null($key1Value)) {
            $redisService->setKey1($key1Value);
        }

        return view('sample.redis1');

    }

    public function redis2(RedisService $redisService)
    {
        $key1Value = $redisService->getKey1();

        $data = ['key1Value' => var_export($key1Value, true)];

        return view('sample.redis2', $data);
    }
}
