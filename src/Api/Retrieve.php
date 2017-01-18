<?php
namespace ArianRashidi\PocketApi\Api;

/**
 * Class Retrieve
 *
 * @package ArianRashidi\PocketApi\Api
 */
class Retrieve extends Api
{
    /**
     * Get saved Pocket items.
     *
     * @param array $parameters
     *
     * @return mixed
     */
    public function get(array $parameters = [])
    {
        $data = $this->keys() + $parameters;

        $response = $this->request('/v3/get', $data);
        $responseData = json_decode($response->getBody());

        return $responseData;
    }
}
