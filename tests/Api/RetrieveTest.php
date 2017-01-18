<?php
namespace ArianRashidi\PocketApi\Tests\Api;

use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use GuzzleHttp\Psr7\Response;

/**
 * Class RetrieveTest
 *
 * @package ArianRashidi\PocketApi\Tests\Api
 */
class RetrieveTest extends \PHPUnit_Framework_TestCase
{
    use SupportTrait;

    /**
     * @var array
     */
    protected $responseBody = [
        'status' => 1,
        'list'   => [
            '154274175' => [
                'item_id'        => 154274175,
                'resolved_id'    => 154274175,
                'given_url'      => 'http://getpocket.com/',
                'given_title'    => '',
                'favorite'       => 0,
                'status'         => 0,
                'time_added'     => 1484684029,
                'time_updated'   => 1484684030,
                'time_read'      => 0,
                'time_favorited' => 0,
                'sort_id'        => 0,
                'resolved_title' => '"Page Saved!" Here are some tips to get started with Pocket',
                'resolved_url'   => 'https://getpocket.com/',
                'excerpt'        => "You've used the Pocket button to save a page from Pocket's website!",
                'is_article'     => 1,
                'is_index'       => 1,
                'has_video'      => 0,
                'has_image'      => 1,
                'word_count'     => 360,
            ],
        ],

    ];

    /**
     * Retrieve::get()
     */
    public function testGet()
    {
        $responseBody = json_encode($this->responseBody + $this->mainKeys());
        $pocket = $this->pocketWithHttpClient([new Response(200, [], $responseBody)]);
        $pocket->setAccessToken($this->validKeys['access_token1']);

        $result = $pocket->retrieveApi()->get(['count' => 1]);

        $this->assertEquals($this->responseBody['status'], $result->status);
        $this->assertTrue(isset($result->list));
    }
}
