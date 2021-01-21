<?php
namespace ArianRashidi\PocketApi\Tests\Api;

use ArianRashidi\PocketApi\Tests\Support\SupportTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class AuthenticationTest
 *
 * @package ArianRashidi\PocketApi\Tests\Api
 */
class AuthenticationTest extends TestCase
{
    use SupportTrait;

    /**
     * Authentication::obtainRequestToken()
     */
    public function testObtainRequestToken()
    {
        $responseBody = json_encode(['code' => $this->validKeys['request_token'], 'state' => $this->validKeys['state']]);
        $pocket = $this->pocketWithHttpClient([new Response(200, [], $responseBody)]);
        $result = $pocket->authenticationApi()->obtainRequestToken(
            'https://pocket.com',
            $this->validKeys['state']
        );

        self::assertEquals($this->validKeys['request_token'], $result->code);
        self::assertEquals($this->validKeys['state'], $result->state);
    }

    /**
     * Authentication::authorizationUrl()
     */
    public function testAuthorizationUrl()
    {
        $expectedUrl = 'https://getpocket.com/auth/authorize?request_token=';
        $expectedUrl .= $this->validKeys['request_token'];
        $expectedUrl .= '&redirect_uri=https://pocket.com';
        $result = $this->authenticationApi()->authorizationUrl($this->validKeys['request_token'], 'https://pocket.com');

        self::assertEquals($expectedUrl, $result);
    }

    /**
     * Authentication::obtainAccess()
     */
    public function testObtainAccess()
    {
        $expectedUsername = 'pocketuser';
        $responseBody = json_encode([
            'access_token' => $this->validKeys['access_token1'],
            'username'     => $expectedUsername,
            'state'        => $this->validKeys['state'],
        ]);
        $pocket = $this->pocketWithHttpClient([new Response(200, [], $responseBody)]);
        $result = $pocket->authenticationApi()->obtainAccess($this->validKeys['request_token']);

        $this->assertEquals($this->validKeys['access_token1'], $result->access_token);
        $this->assertEquals($expectedUsername, $result->username);
        $this->assertEquals($this->validKeys['state'], $result->state);
    }

    /**
     * @return \ArianRashidi\PocketApi\Api\Authentication
     */
    protected function authenticationApi()
    {
        return $this->pocket($this->validKeys['consumer_key1'], $this->validKeys['access_token1'])->authenticationApi();
    }
}
