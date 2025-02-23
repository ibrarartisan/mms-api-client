<?php

namespace MmsApiClient;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use MmsApiClient\Handler\ValidationHandler;

class MmsApiClient
{
    private $httpClient;
    private $apiUrl;
    private $bearerToken;
    private $validationHandler;

    /**
     * MmsApiClient constructor.
     *
     * @param string $apiUrl The MMS API base URL.
     * @param string $bearerToken The authorization bearer token.
     */
    public function __construct(string $apiUrl, string $bearerToken)
    {
        // Initialize the ValidationHandler
        $this->validationHandler = new ValidationHandler();

        // Validate the API URL and Bearer Token using the handler
        $this->validationHandler->validateUrl($apiUrl);
        $this->validationHandler->validateBearerToken($bearerToken);

        $this->apiUrl = $apiUrl;
        $this->bearerToken = $bearerToken;

        // Initialize the HTTP client
        $this->httpClient = HttpClient::create([
            'base_uri' => $apiUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $bearerToken,
            ],
        ]);
    }

    /**
     * Factory method to create a new instance of MmsApiClient.
     *
     * @param string $apiUrl The MMS API base URL.
     * @param string $bearerToken The authorization bearer token.
     * @return MmsApiClient
     */
    public static function create(string $apiUrl, string $bearerToken): self
    {
        return new self($apiUrl, $bearerToken);
    }

    /**
     * Make an HTTP request to the MMS API.
     *
     * @param string $method The HTTP method (GET, POST, etc.).
     * @param string $endpoint The API endpoint.
     * @param array $options The request options (e.g., JSON body for POST).
     * @return array The response data.
     * @throws \InvalidArgumentException
     */
    public function request(string $method, string $endpoint, array $options = []): array
    {
        // If it's a POST or PUT request, we validate the data based on the required fields
        if (strtoupper($method) === 'POST' || strtoupper($method) === 'PUT') {
            if (isset($options['json'])) {
                // Dynamically validate the request data (can be extended later with entity-based validation)
                $this->validationHandler->validateRequestData($options['json'], ['title', 'description']);
            }
        }

        try {
            $response = $this->httpClient->request($method, $endpoint, $options);
            return $response->toArray();
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the request
            throw new \RuntimeException("Error making API request: " . $e->getMessage());
        }
    }
}
