<?php


namespace Tests\Feature\AuthController;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseTransactions;

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
    public function 「正常系」ログアウトする()
    {
        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $this->userId
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get('/api/user/logout');
        $response->assertSuccessful();

        //トークンテーブルからuserIdが消えているか
        $this->assertDatabaseMissing('personal_access_tokens', [
           'tokenable_id' => $this->userId
        ]);
    }

    /**
     * @test
     */
    public function 「異常系」ログアウトする()
    {
        $unAuthorizedToken = 'sdf;lkjasdfl;j';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$unAuthorizedToken
        ])->get('/api/user/logout');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
