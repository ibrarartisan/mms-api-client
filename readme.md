# MmsApiClient

MmsApiClient is a modular PHP library for interacting with the MMS API using Symfony HttpClient. It provides an easy way to interact with the MMS service, including support for ticket management and other services.

## Installation

You can install the library via Composer:

```bash
composer require mms/mms-api-client
```

## Usage
Initialize MmsApiClient
To use MmsApiClient, initialize it by providing the base API URL and an authorization bearer token. Here's an example:

```php
use MmsApiClient\MmsApiClient;

$apiUrl = 'https://demoapi.mms-portal.eu/index.php/MmsApi/v1';  // MMS API base URL
$bearerToken = 'your-bearer-token';  // Replace with your actual bearer token

$apiClient = MmsApiClient::create($apiUrl, $bearerToken);
```