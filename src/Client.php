<?php

namespace Onetoweb\Povis;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use Onetoweb\Povis\Token;
use Onetoweb\Povis\Config\Method;
use DateTime;
use Closure;

/**
 * Povis Api Client
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 */
class Client
{
    /**
     * @var string
     */
    public const BASE_HREF = 'https://api.povis.nl';
    
    /**
     * @var integer
     */
    public const VERSION = 1;
    
    /**
     * @var Token
     */
    private ?Token $token = null;
    
    /**
     * @var Closure
     */
    private ?Closure $updateTokenCallback = null;
    
    /**
     * @param string $apiKey
     * @param string $clientId
     * @param string $clientSecret
     * @param string $posId
     * @param bool $testModus = false
     * @param int $version = self::VERSION
     */
    public function __construct(
        
        #[\SensitiveParameter]
        private string $apiKey,
        
        #[\SensitiveParameter]
        private string $clientId,
        
        #[\SensitiveParameter]
        private string $clientSecret,
        
        #[\SensitiveParameter]
        private string $posId,
        
        private bool $testModus = false,
        private int $version = self::VERSION
    ) {
        
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
     * @param Closure $updateTokenCallback
     * 
     * @return void
     */
    public function setUpdateTokenCallback(Closure $updateTokenCallback): void
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
        return $this->request(Method::GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function post(string $endpoint, array $data = []): ?array
    {
        return $this->request(Method::POST, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function put(string $endpoint, array $data = []): ?array
    {
        return $this->request(Method::PUT, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function patch(string $endpoint, array $data = []): ?array
    {
        return $this->request(Method::PATCH, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return array|null
     */
    public function delete(string $endpoint): ?array
    {
        return $this->request(Method::DELETE, $endpoint);
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
        
        $response = (new GuzzleCLient())->post('https://povisapi.auth.eu-central-1.amazoncognito.com/oauth2/token', $options);
        
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
     * @param Method $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|null
     */
    private function request(Method $method, string $endpoint, array $data = [], array $query = []): ?array
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
        $response = (new GuzzleCLient())->request($method->value, $this->getUrl($endpoint), $options);
        
        $contents = $response->getBody()->getContents();
        
        return json_decode($contents, true);
    }
}
