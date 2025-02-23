<?php

namespace MmsApiClient\MmsUsers;

use MmsApiClient\Handler\ExceptionHandler;
use MmsApiClient\MmsApiClient;
use MmsApiClient\Handler\ValidationHandler;

class MmsUsers
{
    private $apiClient;

    /**
     * MmsUsers constructor.
     *
     * @param MmsApiClient $apiClient The MmsApiClient instance.
     */
    public function __construct(MmsApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Get a list of users with optional filter, top, skip, and orderby.
     *
     * @param array $filters An array of filters to apply to the query.
     * @param int $top Number of users to return.
     * @param int $skip Number of users to skip.
     * @param string $orderby The field to order by (e.g., 'createdAt desc').
     * @return array The response data.
     */
    public function getUsers(string $filter = null, int $top = 50, int $skip = 0, string $orderby = ''): array
    {
        try {
            // Start building the endpoint
            $endpoint = '/users';

            // Add filter query if provided
            $queryParams = [];
            if ($filter) {
                $queryParams[] = "$filter";
            }

            // Add $orderby query if provided
            if ($orderby) {
                $queryParams[] = "$orderby";
            }

            // Add $top query if provided
            if ($top) {
                $queryParams[] = "\$top={$top}";
            }

            // Add $skip query if provided
            if ($skip !== null) {
                $queryParams[] = "\$skip={$skip}";
            }

            // If there are any query parameters, join them with '&'
            if (!empty($queryParams)) {
                $endpoint .= '?' . implode('&', $queryParams);
            }

            // Normalize URL by trimming trailing slashes
            $apiUrl = rtrim($this->apiClient->getBaseUrl(), '/');
            $finalUrl = $apiUrl . $endpoint;  // Concatenate without adding extra slashes

            return $this->apiClient->request('GET', $finalUrl);
        } catch (\Exception $e) {
            // Handle all exceptions centrally via ExceptionHandler
            ExceptionHandler::handle($e);
            return [];
        }
    }

    /**
     * Get a single user by ID.
     *
     * @param int $userId The user ID.
     * @return array The response data.
     */
    public function getUserById(string $userId): array
    {
        try {
            // Normalize URL and make request
            $apiUrl = rtrim($this->apiClient->getBaseUrl(), '/');
            $endpoint = "/users/{$userId}";
            $finalUrl = $apiUrl . $endpoint;

            return $this->apiClient->request('GET', $finalUrl);
        } catch (\Exception $e) {
            // Handle all exceptions centrally via ExceptionHandler
            ExceptionHandler::handle($e);
            return [];
        }
    }

    /**
     * Create a new user.
     *
     * @param array $userData The data for the new user.
     * @return array The response data.
     */
    public function createUser(array $UserData): array
    {
        try {
            // Normalize URL and make request
            $apiUrl = rtrim($this->apiClient->getBaseUrl(), '/');
            $endpoint = '/users';
            $finalUrl = $apiUrl . $endpoint;

            return $this->apiClient->request('POST', $finalUrl, ['json' => $UserData]);
        } catch (\Exception $e) {
            // Handle all exceptions centrally via ExceptionHandler
            ExceptionHandler::handle($e);
            return [];
        }
    }

    /**
     * Update an existing user.
     *
     * @param int $userId The user ID.
     * @param array $userData The data to update.
     * @return array The response data.
     */
    public function updateUser(int $userId, array $userData): array
    {
        return $this->apiClient->request('PUT', "/users/{$userId}", ['json' => $userData]);
    }

    /**
     * Delete a user.
     *
     * @param int $userId The user ID.
     * @return array The response data.
     */
    public function deleteUser(int $userId): array
    {
        return $this->apiClient->request('DELETE', "/users/{$userId}");
    }
}
