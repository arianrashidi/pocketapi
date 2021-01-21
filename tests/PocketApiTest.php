<?php
namespace ArianRashidi\PocketApi\Tests;

use ArianRashidi\PocketApi\Pocket;
use ArianRashidi\PocketApi\Api\Add;
use ArianRashidi\PocketApi\Api\Authentication;
use ArianRashidi\PocketApi\Api\Modify;
use ArianRashidi\PocketApi\Api\Retrieve;
use ArianRashidi\PocketApi\PocketException;
use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\TestCase;
use \TypeError;

/**
 * Class PocketApiTest
 *
 * @package ArianRashidi\PocketApi\Tests
 */
class PocketApiTest extends TestCase
{
    use SupportTrait;

    /**
     *  Pocket::_construct()
     */
    public function testValidConstruct()
    {
        $pocket = $this->pocket(
            $this->validKeys['consumer_key1'],
            $this->validKeys['access_token1'],
            new GuzzleClient()
        );
        self::assertInstanceOf(Pocket::class, $pocket);
    }

    /**
     * Pocket::_construct()
     */
    public function testInvalidEmptyConsumerKeyConstruct()
    {
        $this->assertException('Consumer key is not defined.');
        $this->pocket('');
    }

    /**
     * Pocket::_construct()
     */
    public function testInvalidShortConsumerKeyConstruct()
    {
        $this->assertException('Consumer key is to short.');
        $this->pocket(substr($this->validKeys['consumer_key1'], 0, 10));
    }

    /**
     * Pocket::_construct()
     */
    public function testInvalidEmptyAccessTokenConstruct()
    {
        $this->assertException('Access token is not defined.');
        $this->pocket($this->validKeys['consumer_key1'], '');
    }

    /**
     * Pocket::_construct()
     */
    public function testInvalidShortAccessTokenConstruct()
    {
        $this->assertException('Access token is to short.');
        $this->pocket($this->validKeys['consumer_key1'], substr($this->validKeys['access_token1'], 0, 10));
    }

    /**
     * Pocket::_construct()
     */
    public function testInvalidHttpClientConstruct()
    {
        $this->expectException(TypeError::class);
        $this->pocket(
            $this->validKeys['consumer_key1'],
            $this->validKeys['access_token1'],
            new Pocket($this->validKeys['consumer_key1'])
        );
    }

    /**
     * Pocket::getConsumerKey()
     */
    public function testGetConsumerKey()
    {
        $pocket = $this->pocket($this->validKeys['consumer_key1']);
        $this->assertEquals($this->validKeys['consumer_key1'], $pocket->getConsumerKey());
    }

    /**
     * Pocket::setConsumerKey()
     */
    public function testSetValidConsumerKey()
    {
        $pocket = $this->pocket($this->validKeys['consumer_key1']);
        $pocket->setConsumerKey($this->validKeys['consumer_key2']);
        self::assertNotEquals($this->validKeys['consumer_key1'], $pocket->getConsumerKey());
        self::assertEquals($this->validKeys['consumer_key2'], $pocket->getConsumerKey());
    }

    /**
     * Pocket::setConsumerKey()
     */
    public function testSetInvalidEmptyConsumerKey()
    {
        $this->assertException('Consumer key is not defined.');
        $pocket = $this->pocket($this->validKeys['consumer_key1']);
        $pocket->setConsumerKey('');
    }

    /**
     * Pocket::setConsumerKey()
     */
    public function testSetInvalidShortConsumerKey()
    {
        $this->assertException('Consumer key is to short.');
        $pocket = $this->pocket($this->validKeys['consumer_key1']);
        $pocket->setConsumerKey(substr($this->validKeys['consumer_key1'], 0, 10));
    }

    /**
     * Pocket::getAccessToken()
     */
    public function testGetAccessToken()
    {
        $pocket = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']);
        $this->assertEquals($this->validKeys['access_token1'], $pocket->getAccessToken());
    }

    /**
     * Pocket::setAccessToken()
     */
    public function testSetValidAccessToken()
    {
        $pocket = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']);
        $pocket->setAccessToken($this->validKeys['access_token2']);
        $this->assertNotEquals($this->validKeys['access_token1'], $pocket->getAccessToken());
        $this->assertEquals($this->validKeys['access_token2'], $pocket->getAccessToken());
    }

    /**
     * Pocket::setAccessToken()
     */
    public function testSetInvalidEmptyAccessToken()
    {
        $this->assertException('Access token is not defined.');
        $pocket = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']);
        $pocket->setAccessToken('');
    }

    /**
     * Pocket::setAccessToken()
     */
    public function testSetInvalidShortAccessToken()
    {
        $this->assertException('Access token is to short.');
        $pocket = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']);
        $pocket->setAccessToken(substr($this->validKeys['access_token1'], 0, 10));
    }

    /**
     * Pocket::getHttpClient()
     */
    public function testGetHttpClient()
    {
        $pocket = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']);
        $this->assertInstanceOf(GuzzleClient::class, $pocket->getHttpClient());
    }

    /**
     * Pocket::setHttpClient()
     */
    public function testSetValidHttpClient()
    {
        $google = 'https://google.com';
        $googleDe = 'https://google.de';
        $pocket = $this->pocket($this->validKeys['consumer_key1'], null, new GuzzleClient(['base_uri' => $google]));
        $this->assertEquals($pocket->getHttpClient()->getConfig('base_uri'), $google);
        $pocket->setHttpClient(new GuzzleClient(['base_uri' => $googleDe]));
        $this->assertEquals($pocket->getHttpClient()->getConfig('base_uri'), $googleDe);
    }

    /**
     * Pocket::setHttpClient()
     */
    public function testSetInvalidHttpClient()
    {
        $this->expectException(TypeError::class);
        $pocket = $this->pocket($this->validKeys['consumer_key1']);
        $pocket->setHttpClient(new Pocket($this->validKeys['consumer_key1']));
    }

    /**
     * Pocket::addApi()
     */
    public function testAddApi()
    {
        $add = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1'])->addApi();
        $this->assertInstanceOf(Add::class, $add);
        $this->assertException('No Access Token is set. Use setAccessToken().');
        $this->pocket($this->validKeys['consumer_key1'])->addApi();
    }

    /**
     * Pocket::authenticationApi()
     */
    public function testAuthenticationApi()
    {
        $authentication = $this->pocket($this->validKeys['consumer_key1'])->authenticationApi();
        $this->assertInstanceOf(Authentication::class, $authentication);
    }

    /**
     * Pocket::modifyApi()
     */
    public function testModifyApi()
    {
        $modify = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1'])->modifyApi();
        self::assertInstanceOf(Modify::class, $modify);
        $this->assertException('No Access Token is set. Use setAccessToken().');
        $this->pocket($this->validKeys['consumer_key1'])->modifyApi();
    }

    /**
     * Pocket::retrieveApi()
     */
    public function testRetrieveApi()
    {
        $retrieve = $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1'])->retrieveApi();
        self::assertInstanceOf(Retrieve::class, $retrieve);
        $this->assertException('No Access Token is set. Use setAccessToken().');
        $this->pocket($this->validKeys['consumer_key1'])->retrieveApi();
    }

    /**
     * @param string $message
     */
    protected function assertException(string $message)
    {
        $this->expectException(PocketException::class);
        $this->expectExceptionMessage($message);
    }
}
