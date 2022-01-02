<?php

namespace Tests\Feature\SpotController;

use App\Models\Spot;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegisterSpotTest extends TestCase
{
    use DatabaseTransactions;

    private $authToken;

    public function setUp(): void
    {
        parent::setUp();
        $loginResponse = $this->postJson(
            '/api/user/login',
            ['email' => 'asdf1@asdf.com', 'password' => 'password']
        );
        
        $authToken = $loginResponse->getOriginalContent()['data']['token'];
        $this->authToken = $authToken;
    }

    /**
     * @test
     * @dataProvider initData
     */
    public function 「正常系」スポットを登録する($data)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->post('/api/spots', $data);
        $response->assertSuccessful();

        $this->assertDatabaseHas('spots', [
            'name' => $data['name'],
            'prefecture_id' => $data['prefecture_id'],
            'address' => $data['address'],
            'content' => $data['content']
        ]);

        $spotModel = Spot::orderBy('created_at', 'desc')->first();

        // スポットのイメージパスを取得
        $imagePath = $spotModel->image;
        $logoPath = str_replace('storage','public',  $imagePath);
        // スポットのイメージを削除
        $this->assertTrue(Storage::exists($logoPath));
        $this->assertTrue(Storage::deleteDirectory("public/spot/{$spotModel->code}/"));
    }

    /**
     * @test
     * @dataProvider initData
     */
    public function 「異常系」スポットを登録する($data)
    {
        $data['name'] = null;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->authToken
        ])->post('/api/spots', $data);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * スポット新規作成データ
     * @return \Generator
     */
    public function initData()
    {
        yield [
            'data' => [
                'name' => '東京駅前スーポーツセンター',
                'image' => UploadedFile::fake()->create('sample.jpg')->size(499),
                'prefecture_id' => 2,
                'address' => '東京都1-2-1',
                'content' => 'ここに詳細が入ります。',
                'location' => [
                    'latitude' => '12.12341234',
                    'longitude' => '-12.348762',
                ],
                'open_on' => '12:34:56',
                'close_on' => '12:34:56'
            ]
        ];
    }
}
