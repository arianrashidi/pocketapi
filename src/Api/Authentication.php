<?php
namespace ArianRashidi\PocketApi\Api;

/**
 * Class Authentication
 *
 * @package ArianRashidi\PocketApi\Api
 */
class Authentication extends Api
{
    /**
     * Obtain the access token and the username.
     *
     * @param string $requestToken
     *
     * @return mixed
     */
    public function obtainAccess(string $requestToken)
    {
        $data = [
            'consumer_key' => $this->pocket->getConsumerKey(),
            'code'         => $requestToken,
        ];

        $response = $this->request('/v3/oauth/authorize', $data);
        $responseData = json_decode($response->getBody());

        return $responseData;
    }

    /**
     * Obtain the request token.
     *
     * @param string      $redirectUrl
     * @param string|null $state
     *
     * @return mixed
     */
    public function obtainRequestToken(string $redirectUrl, string $state = null)
    {
        $data = ['consumer_key' => $this->pocket->getConsumerKey(), 'redirect_uri' => $redirectUrl];
        if (!is_null($state)) {
            $data = $data + ['state' => $state];
        }

        $response = $this->request('/v3/oauth/request', $data);
        $responseData = json_decode($response->getBody());

        return $responseData;
    }

    /**
     * Create the authorization url.
     *
     * @param string $requestToken
     * @param string $redirectUrl
     *
     * @return string
     */
    public function authorizationUrl(string $requestToken, string $redirectUrl): string
    {
        return 'https://getpocket.com/auth/authorize?request_token=' . $requestToken . '&redirect_uri=' . $redirectUrl;
    }
}
