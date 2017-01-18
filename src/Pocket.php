<?php
namespace ArianRashidi\PocketApi;

use ArianRashidi\PocketApi\Api\Add;
use ArianRashidi\PocketApi\Api\Authentication;
use ArianRashidi\PocketApi\Api\Modify;
use ArianRashidi\PocketApi\Api\Retrieve;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Pocket
 *
 * @package ArianRashidi\PocketApi
 */
class Pocket
{
    /**
     * Consumer key.
     *
     * @var string
     */
    protected $consumerKey;

    /**
     * Access token.
     *
     * @var string|null
     */
    protected $accessToken = null;

    /**
     * Http client.
     *
     * @var GuzzleClient|null
     */
    protected $httpClient = null;

    /**
     * Pocket's authentication api.
     *
     * @var Authentication|null
     */
    protected $authenticationApi = null;

    /**
     * Pocket's add api.
     *
     * @var Add|null
     */
    protected $addApi = null;

    /**
     * Pocket's modify api.
     *
     * @var Modify|null
     */
    protected $modifyApi = null;

    /**
     * Pocket's retrieve api.
     *
     * @var Retrieve|null
     */
    protected $retrieveApi = null;

    /**
     * Pocket constructor.
     *
     * @param string            $consumerKey
     * @param string|null       $accessToken
     * @param GuzzleClient|null $httpClient
     */
    public function __construct(string $consumerKey, string $accessToken = null, GuzzleClient $httpClient = null)
    {
        $this->checkKey($consumerKey, 'Consumer key');

        if (!is_null($accessToken)) {
            $this->checkKey($accessToken, 'Access token');
        }

        $this->consumerKey = $consumerKey;
        $this->accessToken = $accessToken;
        $this->setHttpClient($httpClient);
    }

    /**
     * Pocket's authentication api.
     *
     * @return Authentication
     */
    public function authenticationApi(): Authentication
    {
        if (is_null($this->authenticationApi)) {
            $this->authenticationApi = new Authentication($this);
        }

        return $this->authenticationApi;
    }

    /**
     * Pocket's add api.
     *
     * @return Add
     */
    public function addApi(): Add
    {
        $this->checkAccessToken();

        if (is_null($this->addApi)) {
            $this->addApi = new Add($this);
        }

        return $this->addApi;
    }

    /**
     * Pocket's modify api.
     *
     * @return Modify
     */
    public function modifyApi(): Modify
    {
        $this->checkAccessToken();

        if (is_null($this->modifyApi)) {
            $this->modifyApi = new Modify($this);
        }

        return $this->modifyApi;
    }

    /**
     * Pocket's retrieve api.
     *
     * @return Retrieve
     */
    public function retrieveApi(): Retrieve
    {
        $this->checkAccessToken();

        if (is_null($this->retrieveApi)) {
            $this->retrieveApi = new Retrieve($this);
        }

        return $this->retrieveApi;
    }

    /**
     * Get the consumer key.
     *
     * @return string
     */
    public function getConsumerKey(): string
    {
        $this->checkKey($this->consumerKey, 'Consumer key');
        return $this->consumerKey;
    }

    /**
     * Set the consumer key.
     *
     * @param string $consumerKey
     */
    public function setConsumerKey(string $consumerKey)
    {
        $this->checkKey($consumerKey, 'Consumer key');
        $this->consumerKey = $consumerKey;
    }

    /**
     * Get the access token.
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        $this->checkKey($this->accessToken, 'Access token');
        return $this->accessToken;
    }

    /**
     * Set the access token.
     *
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->checkKey($accessToken, 'Access token');
        $this->accessToken = $accessToken;
    }

    /**
     * Get the Guzzle http client.
     *
     * @return GuzzleClient
     */
    public function getHttpClient(): GuzzleClient
    {
        return $this->httpClient;
    }

    /**
     * Set the Guzzle http client.
     *
     * @param GuzzleClient|null $httpClient
     */
    public function setHttpClient(GuzzleClient $httpClient = null)
    {
        if (is_null($httpClient)) {
            $httpClient = new GuzzleClient(['base_uri' => 'https://getpocket.com']);
        }

        $this->httpClient = $httpClient;
    }

    /**
     * Check a key.
     *
     * @param        $key
     * @param string $name
     *
     * @throws PocketException
     */
    protected function checkKey($key, string $name)
    {
        if (empty($key)) {
            throw new PocketException($name . ' is not defined.');
        }

        if (strlen($key) < 30) {
            throw new PocketException($name . ' is to short.');
        }
    }

    /**
     * Check if the access token is set.
     *
     * @throws PocketException
     */
    protected function checkAccessToken()
    {
        if (is_null($this->accessToken)) {
            throw new PocketException('No Access Token is set. Use setAccessToken().');
        }
    }
}
