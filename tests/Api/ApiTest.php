<?php
namespace ArianRashidi\PocketApi\Tests\Api;

use ArianRashidi\PocketApi\Pocket;
use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use ArianRashidi\PocketApi\Tests\Support\TestableApi;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiTest
 *
 * @package ArianRashidi\PocketApi\Tests\Api
 */
class ApiTest extends TestCase
{
    use SupportTrait;

    /**
     * Api::_construct
     */
    public function testConstructor()
    {
        self::assertInstanceOf(TestableApi::class, $this->api(new Pocket($this->validKeys['consumer_key1'])));
    }

    /**
     * Api::keys()
     */
    public function testKeys()
    {
        $api = $this->api(new Pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']));
        self::assertTrue(isset($api->testableKeys()['access_token']));
        self::assertTrue(isset($api->testableKeys()['consumer_key']));
    }

    /**
     * @param Pocket $pocket
     *
     * @return TestableApi
     */
    protected function api(Pocket $pocket)
    {
        return new TestableApi($pocket);
    }
}
