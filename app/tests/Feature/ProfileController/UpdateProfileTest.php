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
            ['email' => 'asdf2@asdf.com', 'password' => 'password']
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
        //初回登録データ
        $firstCreatedData = $data[0];
        //更新データ
        $updatedData = $data[1];

        // 初回登録
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->put("/api/profiles", $firstCreatedData);
        $response->assertSuccessful();

        // プロフィール情報が保存されているか
        $this->assertDatabaseHas('profiles', [
            'user_id' => $this->userId,
            'name' => $firstCreatedData['name'],
            'biography' => $firstCreatedData['biography']
        ]);

        // ジャンルが登録されているか
        foreach ($firstCreatedData['genres'] as $genreId) {
            $this->assertDatabaseHas('user_genre', [
                'user_id' => $this->userId,
                'genre_id' => $genreId
            ]);
        }

        //ユーザーモデル取得
        $userModel = User::find($this->userId);
        $profileModel = $userModel->profile;

        // プロフィールのイメージパスを取得
        $firstCreatedImagePath = str_replace('storage','public',  $profileModel->image);
        // プロフィールの背景イメージパスを取得
        $firstCreatedBackgroundImgPath = str_replace('storage','public',  $profileModel->background);

        // プロフィールのイメージがstorageに存在するか
        $this->assertTrue(Storage::exists($firstCreatedImagePath));
        // プロフィールの背景イメージがstorageに存在するか
        $this->assertTrue(Storage::exists($firstCreatedBackgroundImgPath));

        // アップデート
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->put("/api/profiles", $updatedData);
        $response->assertSuccessful();

        // プロフィール情報が保存されているか
        $this->assertDatabaseHas('profiles', [
            'user_id' => $this->userId,
            'name' => $updatedData['name'],
            'biography' => $updatedData['biography']
        ]);

        // ジャンルが登録されているか
        foreach ($updatedData['genres'] as $genreId) {
            $this->assertDatabaseHas('user_genre', [
                'user_id' => $this->userId,
                'genre_id' => $genreId
            ]);
        }
        //ユーザーモデル取得
        $updatedUserModel = User::find($this->userId);
        $updatedProfileModel = $updatedUserModel->profile;

        // プロフィールのイメージパスを取得
        $updatedImagePath = str_replace('storage','public',  $updatedProfileModel->image);
        // プロフィールの背景イメージパスを取得
        $updatedBackgroundImgPath = str_replace('storage','public',  $updatedProfileModel->background);

        // 初回登録時のファイルがstorageから削除されている
        $this->assertFalse(Storage::exists($firstCreatedImagePath));
        $this->assertFalse(Storage::exists($firstCreatedBackgroundImgPath));

        // 初回登録時のファイルがstorageから削除されている
        $this->assertTrue(Storage::exists($updatedImagePath));
        $this->assertTrue(Storage::exists($updatedBackgroundImgPath));

        // ディレクトリごと削除
        $this->assertTrue(Storage::deleteDirectory("public/user/{$updatedUserModel->code}/"));
    }

    public function 「異常系」ユーザーがプロフールを更新する($data){}


    /**
     * プロフィール更新データ
     * @return \Generator
     */
    public function initData()
    {
        yield [
            'data' =>[
                [
                    'background' => UploadedFile::fake()->create('bg-image.jpg')->size(499),
                    'image' => UploadedFile::fake()->create('image.jpg')->size(499),
                    'name' => 'first created name',
                    'biography' => 'This is first created biography content explained profile',
                    'genres' => [1,2]
                ], [
                    'background' => UploadedFile::fake()->create('bg-image3.jpg')->size(499),
                    'image' => UploadedFile::fake()->create('image3.jpg')->size(499),
                    'name' => 'updated name',
                    'biography' => 'This is updated content biography explained profile',
                    'genres' => [1,2,3]
                ]
            ]
        ];
    }
}
