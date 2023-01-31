<?php

namespace Onetoweb\Povis;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use Onetoweb\Povis\Token;
use DateTime;

/**
 * Povis Api Client
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 */
class Client
{
    const BASE_HREF = 'https://api.povis.nl';
    const VERSION = 1;
    
    /**
     * Methods
     */
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';
    
    /**
     * @var string
     */
    private $apiKey;
    
    /**
     * @var string
     */
    private $clientId;
    
    /**
     * @var string
     */
    private $clientSecret;
    
    /**
     * @var string
     */
    private $posId;
    
    /**
     * @var bool
     */
    private $testModus;
    
    /**
     * @var int
     */
    private $version;
    
    /**
     * @var Token
     */
    private $token;
    
    /**
     * @var callable
     */
    private $updateTokenCallback;
    
    /**
     * @param string $apiKey
     * @param string $clientId
     * @param string $clientSecret
     * @param string $posId
     * @param bool $testModus = false
     * @param int $version = self::VERSION
     */
    public function __construct(string $apiKey, string $clientId, string $clientSecret, string $posId, bool $testModus = false, int $version = self::VERSION)
    {
        $this->apiKey = $apiKey;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->posId = $posId;
        $this->testModus = $testModus;
        $this->version = $version;
    }
    
    /**
     * @param string $posId
     * 
     * @return Client
     */
    public function setPosId(string $posId): self
    {
        $this->posId = $posId;
        
        return $this;
    }
    
    /**
     * @param callable $updateTokenCallback
     * 
     * @return void
     */
    public function setUpdateTokenCallback(callable $updateTokenCallback): void
    {
        $this->updateTokenCallback = $updateTokenCallback;
    }
    
    /**
     * @param Token $token
     * 
     * @return void
     */
    public function setToken(Token $token): void
    {
        $this->token = $token;
    }
    
    /**
     * @return Token
     */
    public function getToken(): ?Token
    {
        return  $this->token;
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * 
     * @return array|null
     */
    public function get(string $endpoint, array $query = []): ?array
    {
        return $this->request(self::METHOD_GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function post(string $endpoint, array $data = []): ?array
    {
        return $this->request(self::METHOD_POST, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function put(string $endpoint, array $data = []): ?array
    {
        return $this->request(self::METHOD_PUT, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function patch(string $endpoint, array $data = []): ?array
    {
        return $this->request(self::METHOD_PATCH, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return array|null
     */
    public function delete(string $endpoint): ?array
    {
        return $this->request(self::METHOD_DELETE, $endpoint);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return string
     */
    private function getUrl(string $endpoint): string
    {
        return implode('/' , array_filter([
            self::BASE_HREF,
            $this->testModus ? 'test' : 'v'.$this->version,
            $this->posId,
            $endpoint
        ]));
    }
    
    /**
     * @return void
     */
    private function getAccessToken(): void
    {
        // build options
        $options = [
            RequestOptions::AUTH => [
                $this->clientId,
                $this->clientSecret
            ],
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
            ]
        ];
        
        $response = (new GuzzleCLient())->request(self::METHOD_POST, 'https://povisapi.auth.eu-central-1.amazoncognito.com/oauth2/token', $options);
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        $accessToken = json_decode($contents, true);
        
        // set token
        $expires = (new DateTime())->setTimestamp((time() + $accessToken['expires_in']) - 10);
        $this->token = new Token($accessToken['access_token'], $expires);
        
        // update token callback
        if ($this->updateTokenCallback) {
            ($this->updateTokenCallback)($this->token);
        }
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|null
     */
    private function request(string $method, string $endpoint, array $data = [], array $query = []): ?array
    {
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::QUERY => $query,
            RequestOptions::HEADERS => [
                'x-api-key' => $this->apiKey
            ],
        ];
        
        // request token
        if ($this->token === null or $this->token->isExpired()) {
            
            $this->getAccessToken();
        }
        
        // add bearer token to request
        if ($this->token) {
            
            $options[RequestOptions::HEADERS]['Authorization'] = 'Bearer '.$this->token->getValue();
        }
        
        // add data to request
        if (count($data) > 0) {
            
            $options[RequestOptions::JSON] = $data;
        }
        
        // make request
        $response = (new GuzzleCLient())->request($method, $this->getUrl($endpoint), $options);
        
        $contents = $response->getBody()->getContents();
        
        return json_decode($contents, true);
    }
}