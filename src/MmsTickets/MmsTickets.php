<?php

namespace MmsApiClient\MmsTickets;

use MmsApiClient\MmsApiClient;
use MmsApiClient\Handler\ExceptionHandler;

class MmsTickets
{
    private $apiClient;

    public function __construct(MmsApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Get a list of tickets with optional filters, ordering, and pagination.
     *
     * @param string|null $filter
     * @param string|null $orderby
     * @param int|null $top
     * @param int|null $skip
     * @return array
     */
    public function getTickets(string $filter = null, string $orderby = null, int $top = null, int $skip = null): array
    {
        try {
            // Start building the endpoint
            $endpoint = '/tickets';

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
     * Get a single ticket by ID.
     *
     * @param string $ticketId
     * @return array
     */
    public function getTicketById(string $ticketId): array
    {
        try {
            // Normalize URL and make request
            $apiUrl = rtrim($this->apiClient->getBaseUrl(), '/');
            $endpoint = "/tickets/{$ticketId}";
            $finalUrl = $apiUrl . $endpoint;

            return $this->apiClient->request('GET', $finalUrl);
        } catch (\Exception $e) {
            // Handle all exceptions centrally via ExceptionHandler
            ExceptionHandler::handle($e);
            return [];
        }
    }

    /**
     * Create a new ticket.
     *
     * @param array $ticketData
     * @return array
     */
    public function createTicket(array $ticketData): array
    {
        try {
            // Normalize URL and make request
            $apiUrl = rtrim($this->apiClient->getBaseUrl(), '/');
            $endpoint = '/tickets';
            $finalUrl = $apiUrl . $endpoint;

            return $this->apiClient->request('POST', $finalUrl, ['json' => $ticketData]);
        } catch (\Exception $e) {
            // Handle all exceptions centrally via ExceptionHandler
            ExceptionHandler::handle($e);
            return [];
        }
    }
}
