<?php


namespace Tests\Feature\ProfileController;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShowProfileTest extends TestCase
{
    private $authToken;
    private $userId;

    public function setUp(): void
    {
        parent::setUp();
        $loginResponse = $this->postJson(
            '/api/login',
            ['email' => 'asdf1@asdf.com', 'password' => 'password']
        );

        $authToken = $loginResponse->getOriginalContent()['data']['token'];
        $userId = $loginResponse->getOriginalContent()['data']['user_id'];

        $this->authToken = $authToken;
        $this->userId = $userId;
    }

    /**
     * @test
     */
    public function 「正常系」ユーザーが自信のプロフールを取得する()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
        ])->get("/api/profiles/{$this->userId}");
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "id",
                    "code",
                    "profile" => [
                        "image",
                        "background",
                        "name",
                        "user_code",
                        "follows",
                        "followers",
                        "biography",
                        "genres"
                    ],
                    "is_self"
                ]
            ]
        );

        $this->assertEquals(
            $response->json()["data"]["is_self"],
            true
        );
    }

    /**
     * @test
     */
    public function 「正常系」ユーザーが自分以外のプロフールを取得する()
    {
        $otherUserId = 4;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
        ])->get("/api/profiles/{$otherUserId}");
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "id",
                    "code",
                    "profile" => [
                        "image",
                        "background",
                        "name",
                        "user_code",
                        "follows",
                        "followers",
                        "biography",
                        "genres"
                    ],
                    "is_self"
                ]
            ]
        );

        $this->assertEquals(
            $response->json()["data"]["is_self"],
            false
        );
    }

    /**
     * @test
     */
    public function 「異常系」ユーザーが自分以外のプロフールを取得する()
    {
        $IdNotExist = 99999;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
        ])->get("/api/profiles/{$IdNotExist}");

        $response->assertStatus(Response::HTTP_NOT_FOUND);

    }
}
