<?php
namespace ArianRashidi\PocketApi\Tests\Api;

use ArianRashidi\PocketApi\Pocket;
use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use ArianRashidi\PocketApi\Tests\Support\TestableApi;

/**
 * Class ApiTest
 *
 * @package ArianRashidi\PocketApi\Tests\Api
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    use SupportTrait;

    /**
     * Api::_construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(TestableApi::class, $this->api(new Pocket($this->validKeys['consumer_key1'])));
    }

    /**
     * Api::keys()
     */
    public function testKeys()
    {
        $api = $this->api(new Pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1']));
        $this->assertTrue(isset($api->testableKeys()['access_token']));
        $this->assertTrue(isset($api->testableKeys()['consumer_key']));
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
