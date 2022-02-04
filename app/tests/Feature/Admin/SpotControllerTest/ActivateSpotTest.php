<?php


namespace Tests\Feature\Admin\SpotControllerTest;


use App\Models\Spot;
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
        $inactiveSpotId = 41;
        $inactiveSpot = Spot::find($inactiveSpotId);

        //有効フラグがfalse
        $this->assertFalse($inactiveSpot->active);

        $loginResponse = $this->putJson(
            '/admin/spots/41/activate',
            ['email' => 'asdf1@asdf.com', 'password' => 'password']
        );
        $loginResponse->assertSuccessful();


        $inactiveSpotId = 41;
        $inactiveSpot = Spot::find($inactiveSpotId);

        //有効フラグがfalse
        $this->assertTrue($inactiveSpot->active);
    }
}
