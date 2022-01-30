<?php


namespace Tests\Feature\UserController;


use Tests\TestCase;

class SearchUsersTest extends TestCase
{
    /**
     * @test
     */
    public function 「正常系」ユーザーを検索する（パラメータなし）()
    {
        $response = $this->get("/api/users/search");
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "*" => [
                        'id',
                        'name',
                        'image',
                        'code'
                    ]
                ]
            ]
        );
    }
}
