<?php


namespace Tests\Feature\SpotController;


use Tests\TestCase;

class SearchSpotsTest extends TestCase
{
    /**
     * @test
     */
    public function 「正常系」スポットを検索する（パラメータなし）()
    {
        $response = $this->get("/api/spots");
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "*" => [
                        'id',
                        'name',
                        'image',
                        'available_time' => [
                            'open_on',
                            'close_on',
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * @test
     */
    public function 「正常系」スポットを検索する（パラメータあり）()
    {
        $response = $this->get("/api/spots");
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "*" => [
                        'id',
                        'name',
                        'image',
                        'available_time' => [
                            'open_on',
                            'close_on',
                        ]
                    ]
                ]
            ]
        );
    }
}
