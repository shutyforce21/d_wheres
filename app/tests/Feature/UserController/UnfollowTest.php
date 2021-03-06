<?php


namespace Tests\Feature\UserController;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class UnfollowTest extends TestCase
{
    use DatabaseTransactions;

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
    public function 「正常系」ユーザーをアンフォローする()
    {
        $followedId = 2;
        // フォロー済み
        $this->assertDatabaseHas('follows', [
            'follower_id' => $this->userId,
            'followed_id' => $followedId
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get("/api/unfollow/{$followedId}");
        $response->assertSuccessful();

        // 未フォロー
        $this->assertDatabaseMissing('follows', [
            'follower_id' => $this->userId,
            'followed_id' => $followedId
        ]);
    }

    /**
     * @test
     */
    public function 「異常系」自分自身をアンフォローする()
    {
        //case1: 自分自身をフォロー
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get("/api/unfollow/{$this->userId}");

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @test
     */
    public function 「異常系」フォローしていないユーザーをアンフォローする()
    {
        //case2: 存在しないユーザーをフォロー
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get("/api/unfollow/999");

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
