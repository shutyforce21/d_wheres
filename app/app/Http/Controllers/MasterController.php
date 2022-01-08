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

        return response()->json([
            'message' => 'success',
            'data' => [
                'genres' => $genres
            ]
        ], Response::HTTP_OK);
    }
}
