<?php

namespace MmsApiClient;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MmsApiClient
{
    private $httpClient;
    private $apiUrl;

    public function __construct(string $apiUrl, string $bearerToken, HttpClientInterface $httpClient = null)
    {
        $this->apiUrl = $apiUrl;
        $this->httpClient = $httpClient ?: HttpClient::create([
            'base_uri' => $apiUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $bearerToken,
            ],
        ]);
    }

    public static function create(string $apiUrl, string $bearerToken): self
    {
        return new self($apiUrl, $bearerToken);
    }

    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * Get the base URL for the API
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->apiUrl;
    }

    public function request(string $method, string $endpoint, array $options = [])
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, $options);
            return $response->toArray();
        } catch (\Exception $e) {
            // Handle exceptions
            throw $e;
        }
    }
}
