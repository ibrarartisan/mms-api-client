<?php

use PHPUnit\Framework\TestCase;
use MmsApiClient\MmsApiClient;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MmsApiClientTest extends TestCase
{
    private $apiClient;

    protected function setUp(): void
    {
        // Mock the HTTP client to avoid actual API calls
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse->method('toArray')->willReturn(['status' => 'success', 'data' => []]);

        $mockHttpClient = $this->createMock(MockHttpClient::class);
        $mockHttpClient->method('request')->willReturn($mockResponse);

        // Create a mock API client with the mocked HTTP client
        $this->apiClient = new MmsApiClient('https://demoapi.mms-portal.eu/index.php/MmsApi/v1', 'your-bearer-token', $mockHttpClient);
    }

    public function testClientInitialization()
    {
        // Ensure that the MmsApiClient is initialized properly
        $this->assertInstanceOf(MmsApiClient::class, $this->apiClient);
    }

}
