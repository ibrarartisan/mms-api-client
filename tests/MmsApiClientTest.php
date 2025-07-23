<?php

use PHPUnit\Framework\TestCase;
use MmsApiClient\MmsApiClient;

class MmsApiClientTest extends TestCase
{
    private $apiClient;

    protected function setUp(): void
    {
        // Instantiate the client with a sample URL and token
        $this->apiClient = new MmsApiClient(
            'https://demoapi.mms-portal.eu/index.php/MmsApi/v1',
            'your-bearer-token'
        );
    }

    public function testClientInitialization()
    {
        // Ensure that the MmsApiClient is initialized properly
        $this->assertInstanceOf(MmsApiClient::class, $this->apiClient);
    }

}
