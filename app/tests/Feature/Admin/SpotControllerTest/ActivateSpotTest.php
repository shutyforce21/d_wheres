<?php


namespace Tests\Feature\Admin\SpotControllerTest;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ActivateSpotTest extends TestCase
{
    use DatabaseTransactions;

    private $authToken;

    public function setUp(): void
    {
        parent::setUp();
        $loginResponse = $this->postJson(
            '/api/login',
            ['email' => 'asdf1@asdf.com', 'password' => 'password']
        );

        $authToken = $loginResponse->getOriginalContent()['data']['token'];
        $this->authToken = $authToken;
    }

    /**
     * @test
     */
    public function 「正常系」総合管理者がスポットを有効化する()
    {

    }
}
