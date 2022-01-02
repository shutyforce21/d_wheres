<?php


namespace Tests\Feature\SpotController;


use Illuminate\Http\Response;
use Tests\TestCase;

class ShowSpotTest extends TestCase
{
    /**
     * @test
     */
    public function 「正常系」スポットの詳細を取得する()
    {
        $spotId = 1;

        $response = $this->get("/api/spots/{$spotId}");
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "id",
                    "code",
                    "name",
                    "image",
                    "location" => [
                        "latitude",
                        "longitude"
                    ],
                    "available_time" => [
                        "open_on",
                        "close_on"
                    ]
                ]
            ]
        );
    }

    /**
     * @test
     */
    public function 「異常系」スポットの詳細を取得する()
    {
        // 存在しないspotId
        $spotId = 9999999;

        $response = $this->get("/api/spots/{$spotId}");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
