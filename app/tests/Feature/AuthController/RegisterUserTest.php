<?php

namespace Tests\Feature\AuthController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @dataProvider initData
     */
    public function 「正常系」ユーザーが新規登録する($data)
    {
        $loginResponse = $this->postJson('/api/register', $data);
        $loginResponse->assertSuccessful();

        // ユーザー情報が保存されているか
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        $userModel = User::orderBy('created_at', 'desc')->first();

        $bool = password_verify($data['password'], $userModel->password);
        $this->assertTrue($bool);
    }

    /**
     * @test
     * @dataProvider initData
     */
    public function 「異常系」ユーザーが新規登録する($data)
    {
        // パスワード制約: 大文字、小文字、数字
        $data['password'] = 'asdf1234';
        $loginResponse = $this->postJson('/api/register', $data);

        //バリデーションエラー
        $this->assertEquals(
            Response::HTTP_BAD_REQUEST,
            $loginResponse->getStatusCode()
        );
    }


    /**
     * ユーザー新規作成データ
     * @return \Generator
     */
    public function initData()
    {
        yield [
            'data' => [
                'name' => 'テストダンサー',
                'email' => 'testEmail@example.com',
                'password' => 'Asdf1234',
                'password_confirmation' => 'Asdf1234',
            ]
        ];
    }
}
