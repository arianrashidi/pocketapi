<?php
namespace ArianRashidi\PocketApi\Tests\Api;

use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ModifyTest
 *
 * @package ArianRashidi\PocketApi\Tests\Api
 */
class ModifyTest extends TestCase
{
    use SupportTrait;

    /**
     * @var array
     */
    protected $responseBody = [
        'status'         => 1,
        'action_results' => [1],
    ];

    /**
     * Modify::send()
     */
    public function testSend()
    {
        $responseBody = json_encode($this->responseBody + $this->mainKeys());
        $pocket = $this->pocketWithHttpClient([new Response(200, [], $responseBody)]);
        $pocket->setAccessToken($this->validKeys['access_token1']);
        $result = $pocket->modifyApi()->send([
            [
                'action'  => 'favorite',
                'item_id' => 154274175,
            ],
        ]);

        self::assertTrue(isset($result->status));
        self::assertTrue(isset($result->action_results));
    }
}
