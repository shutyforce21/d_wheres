<?php


namespace App\Http\Controllers;


use App\Models\Genre;
use Illuminate\Http\Response;
use function PHPUnit\TestFixture\func;

class MasterController
{
    public function getMaster()
    {
        $genres = Genre::all()->map(function ($g) {
            return [
                'id' => $g->id,
                'name' => $g->name,
            ];
        })->toArray();

        $prefectures = config('data.prefectures');

        return response()->json([
            'message' => 'success',
            'data' => [
                'genres' => $genres,
                'prefectures' => $prefectures
            ]
        ], Response::HTTP_OK);
    }
}
