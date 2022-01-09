<?php

namespace Tests\Feature\ProfileController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
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
     * @dataProvider initData
     */
    public function 「正常系」ユーザーがプロフールを更新する($data)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->put("/api/profiles", $data);
        $response->assertSuccessful();

        // プロフィール情報が保存されているか
        $this->assertDatabaseHas('profiles', [
            'user_id' => $this->userId,
            'biography' => $data['biography']
        ]);

        // ジャンルが登録されているか
        foreach ($data['genres'] as $genreId) {
            $this->assertDatabaseHas('user_genre', [
                'user_id' => $this->userId,
                'genre_id' => $genreId
            ]);
        }

        //ユーザーモデル取得
        $userModel = User::find($this->userId);
        $profileModel = $userModel->profile;

        // プロフィールのイメージパスを取得
        $imagePath = str_replace('storage','public',  $profileModel->image);
        // プロフィールの背景イメージパスを取得
        $backgroundImgPath = str_replace('storage','public',  $profileModel->background);

        // プロフィールのイメージがstorageに存在するか
        $this->assertTrue(Storage::exists($imagePath));
        // プロフィールの背景イメージがstorageに存在するか
        $this->assertTrue(Storage::exists($backgroundImgPath));
        // ディレクトリごと削除
        $this->assertTrue(Storage::deleteDirectory("public/user/{$userModel->code}/"));
    }

    public function 「異常系」ユーザーがプロフールを更新する($data){}


    /**
     * プロフィール更新データ
     * @return \Generator
     */
    public function initData()
    {
        yield [
            'data' => [
                'background' => UploadedFile::fake()->create('bg-image.jpg')->size(499),
                'image' => UploadedFile::fake()->create('image.jpg')->size(499),
                'biography' => 'こちらはユーザーのプロフィール情報になります。',
                'genres' => [1,2]
            ]
        ];
    }
}
