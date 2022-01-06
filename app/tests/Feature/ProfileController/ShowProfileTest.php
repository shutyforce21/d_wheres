<?php


namespace Tests\Feature\ProfileController;


use Illuminate\Foundation\Testing\DatabaseTransactions;
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
            '/api/user/login',
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
        ])->get('/api/user/my-profile');
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                "message",
                "data" => [
                    "id",
                    "code",
                    "name",
                    "profile" => [
                        "image",
                        "background",
                        "follows",
                        "followers",
                        "biography",
                        "genres"
                    ]
                ]
            ]
        );
    }
}
