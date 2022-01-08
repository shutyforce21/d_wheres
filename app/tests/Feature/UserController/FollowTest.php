<?php


namespace Tests\Feature\UserController;


use App\Models\Spot;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FollowTest extends TestCase
{
    use DatabaseTransactions;

    private $authToken;
    private $userId;

    public function setUp(): void
    {
        parent::setUp();
        $loginResponse = $this->postJson(
            '/api/login',
            ['email' => 'asdf5@asdf.com', 'password' => 'password']
        );

        $authToken = $loginResponse->getOriginalContent()['data']['token'];
        $userId = $loginResponse->getOriginalContent()['data']['user_id'];

        $this->authToken = $authToken;
        $this->userId = $userId;
    }

    /**
     * @test
     */
    public function 「正常系」他のユーザーをフォローする()
    {
        $followedId = 2;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get("/api/follow/{$followedId}");
        $response->assertSuccessful();

        $this->assertDatabaseHas('follows', [
            'follower_id' => $this->userId,
            'followed_id' => $followedId
        ]);
    }

    /**
     * 無効なユーザーをフォローしようとした時
     * @test
     */
    public function 「異常系」他のユーザーをフォローする()
    {
        //case1: 自分自身をフォロー
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get("/api/follow/{$this->userId}");

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);

        //case2: 存在しないユーザーをフォロー
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->get("/api/follow/999");

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
