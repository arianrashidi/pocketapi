<?php
namespace ArianRashidi\PocketApi\Api;

use ArianRashidi\PocketApi\Pocket;

/**
 * Class Api
 *
 * @package ArianRashidi\PocketApi\Api
 */
abstract class Api
{
    /**
     * Pocket instance.
     *
     * @var Pocket
     */
    protected $pocket;

    /**
     * Api constructor.
     *
     * @param Pocket $pocket
     */
    public function __construct(Pocket $pocket)
    {
        $this->pocket = $pocket;
    }

    /**
     * Consumer key and access token.
     *
     * @return array
     */
    protected function keys(): array
    {
        return [
            'consumer_key' => $this->pocket->getConsumerKey(),
            'access_token' => $this->pocket->getAccessToken(),
        ];
    }

    /**
     * Send a post request.
     *
     * @param string $urlPath
     * @param array  $data
     * @param string $contentType
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function request(string $urlPath, array $data, string $contentType = 'json')
    {
        $options = [
            'protocols'       => ['https'],
            'connect_timeout' => 15,
            'headers'         => [
                'Content-Type' => 'application/' . $contentType . '; charset=UTF8',
                'X-Accept'     => 'application/json',
            ],
        ];

        switch ($contentType) {
            case 'json':
                $options = $options + ['body' => json_encode($data)];
                break;
            case 'x-www-form-urlencoded':
                $options = $options + ['form_params' => $data];
                break;
        }

        $response = $this->pocket->getHttpClient()->post($urlPath, $options);

        return $response;
    }
}
