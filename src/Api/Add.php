<?php
namespace ArianRashidi\PocketApi\Api;

/**
 * Class Add
 *
 * @package ArianRashidi\PocketApi\Api
 */
class Add extends Api
{
    /**
     * Add a single link to Pocket.
     *
     * @param string      $url
     * @param string|null $title
     * @param array|null  $tags
     * @param int|null    $tweetId
     *
     * @return mixed
     */
    public function single(string $url, string $title = null, array $tags = null, int $tweetId = null)
    {
        $data = $this->keys() + ['time' => time(), 'url' => utf8_encode($url)];
        if (!is_null($title)) {
            $data = $data + ['title' => utf8_encode($title)];
        }
        if (!is_null($tags)) {
            $data = $data + ['tags' => implode(',', $tags)];
        }
        if (!is_null($tweetId)) {
            $data = $data + ['tweet_id' => $tweetId];
        }

        $response = $this->request('/v3/add', $data);
        $responseData = json_decode($response->getBody());

        return $responseData;
    }
}
