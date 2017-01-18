<?php
namespace ArianRashidi\PocketApi\Tests\Support;

use ArianRashidi\PocketApi\Api\Api;

/**
 * Class TestableApi
 *
 * @package ArianRashidi\PocketApi\Tests\Support
 */
class TestableApi extends Api
{
    /**
     * @return array
     */
    public function testableKeys()
    {
        return $this->keys();
    }
}
