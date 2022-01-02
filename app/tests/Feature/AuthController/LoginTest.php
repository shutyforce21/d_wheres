<?php

namespace Tests\Feature\AuthController;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function 「正常系」ユーザーがログインする()
    {
        $sampleEmail = 'asdf1@asdf.com';
        $samplePass = 'password';

        $loginResponse = $this->postJson(
            '/api/user/login',
            [
                'email' => $sampleEmail,
                'password' => $samplePass
            ]
        );
        $token = $loginResponse->assertSuccessful()["data"]["token"];
        // 認証トークン返却
        $this->assertNotNull($token);
    }

    /**
     * @test
     */
    public function 「異常系」ユーザーがログインする()
    {
        $sampleEmail = 'asdf@asdf.com'; // 存在しないメールアドレス
        $samplePass = 'password';

        $loginResponse = $this->postJson(
            '/api/user/login',
            [
                'email' => $sampleEmail,
                'password' => $samplePass
            ]
        );

        //バリデーションエラー
        $this->assertEquals(
            Response::HTTP_BAD_REQUEST,
            $loginResponse->getStatusCode()
        );
    }
}
