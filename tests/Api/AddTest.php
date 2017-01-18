<?php
namespace ArianRashidi\PocketApi\Tests\Api;

use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use GuzzleHttp\Psr7\Response;

/**
 * Class AddTest
 *
 * @package ArianRashidi\PocketApi\Tests\Api
 */
class AddTest extends \PHPUnit_Framework_TestCase
{
    use SupportTrait;

    /**
     * @var array
     */
    protected $responseBody = [
        'status' => 1,
        'item'   => [
            'item_id'              => 154274175,
            'normal_url'           => 'http://getpocket.com',
            'resolved_id'          => 154274175,
            'extended_item_id'     => 154274175,
            'resolved_url'         => 'https://getpocket.com/',
            'domain_id'            => 5863470,
            'origin_domain_id'     => 5863470,
            'response_code'        => 202,
            'mime_type'            => 'text/html',
            'content_length'       => 3931,
            'encoding'             => 'utf-8',
            'date_resolved'        => '2017-01-17 09:42:11',
            'date_published'       => '0000-00-00 00:00:00',
            'title'                => '"Page Saved!" Here are some tips to get started with Pocket',
            'excerpt'              => "You've used the Pocket button to save a page from Pocket's website!",
            'word_count'           => 360,
            'innerdomain_redirect' => 0,
            'login_required'       => 0,
            'has_image'            => 1,
            'has_video'            => 0,
            'is_index'             => 1,
            'is_article'           => 1,
            'used_fallback'        => 0,
            'lang'                 => 'en',
            'time_first_parsed'    => 0,
            'authors'              => [],
            'images'               => [
                [
                    'item_id'  => 154274175,
                    'image_id' => 1,
                    'src'      => 'https://s3.amazonaws.com/pocket-general-images/welcome/Header_Image_ArticleView.jpg',
                    'width'    => 0,
                    'height'   => 0,
                    'credit'   => '',
                    'caption'  => '',
                ],
            ],
        ],
    ];

    /**
     * Add::single()
     */
    public function testSingle()
    {
        $responseBody = json_encode($this->responseBody + $this->mainKeys());
        $pocket = $this->pocketWithHttpClient([new Response(200, [], $responseBody)]);
        $pocket->setAccessToken($this->validKeys['access_token1']);
        $result = $pocket->addApi()->single('http://getpocket.com', 'getpocket.com', ['read', 'later'], '821420170876');

        $this->assertEquals($this->responseBody['status'], $result->status);
        $this->assertEquals($this->responseBody['item']['normal_url'], $result->item->normal_url);
        $this->assertTrue(is_array($result->item->authors));
    }
}
