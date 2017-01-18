<?php
namespace ArianRashidi\PocketApi\Api;

/**
 * Class Modify
 *
 * @package ArianRashidi\PocketApi\Api
 */
class Modify extends Api
{
    /**
     * Modify saved Pocket items.
     *
     * @param array $actions
     *
     * @return mixed
     */
    public function send(array $actions)
    {
        $data = $this->keys() + ['actions' => json_encode($actions)];

        $response = $this->request('/v3/send', $data, 'x-www-form-urlencoded');
        $responseData = json_decode($response->getBody());

        return $responseData;
    }
}
