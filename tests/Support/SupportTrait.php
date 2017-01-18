<?php
namespace ArianRashidi\PocketApi\Tests\Support;

use ArianRashidi\PocketApi\Pocket;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;

/**
 * Class SupportTrait
 *
 * @package ArianRashidi\PocketApi\Tests\Support
 */
trait SupportTrait
{
    /**
     * Valid consumer key and access token.
     *
     * @var array
     */
    protected $validKeys = [
        'consumer_key1' => '94857-7tv545tv684t8zb45tvzbq9z',
        'consumer_key2' => '34897-7tv545tv684t4db45tvzbq9z',
        'access_token1' => '5678defg-5678-defg-5678-defg56',
        'access_token2' => '384ztf43-5678-defg-5678-defg56',
        'request_token' => 'dcba4331-dcba-4321-dcba-4321dc',
        'state'         => '7v6t845dfgdfgtew24t34ze5ahea29',
    ];

    /**
     * Get an Pocket instance.
     *
     * @param string            $consumerKey
     * @param string|null       $accessToken
     * @param GuzzleClient|null $httpClient
     *
     * @return Pocket
     */
    protected function pocket(string $consumerKey, string $accessToken = null, GuzzleClient $httpClient = null): Pocket
    {
        return new Pocket($consumerKey, $accessToken, $httpClient);
    }

    /**
     * A new Guzzle Client mock.
     *
     * @param array $responses
     *
     * @return Pocket
     */
    protected function pocketWithHttpClient(array $responses): Pocket
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $pocket = $this->pocket($this->validKeys['consumer_key1']);
        $pocket->setHttpClient(new GuzzleClient(['handler' => $handler]));

        return $pocket;
    }

    /**
     * Consumer key and access token.
     *
     * @return array
     */
    protected function mainKeys(): array
    {
        return [
            'consumer_key' => $this->validKeys['consumer_key1'],
            'access_token' => $this->validKeys['access_token1'],
        ];
    }
}
