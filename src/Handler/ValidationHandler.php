<?php

namespace MmsApiClient\Handler;

use MmsApiClient\Validator;

class ValidationHandler
{
    /**
     * Validate the API URL.
     *
     * @param string $url The API base URL to validate.
     * @throws \InvalidArgumentException if the URL is invalid.
     */
    public function validateUrl(string $url): void
    {
        if (!Validator::validateUrl($url)) {
            throw new \InvalidArgumentException("Invalid API URL provided.");
        }
    }

    /**
     * Validate the Bearer Token.
     *
     * @param string $token The authorization bearer token.
     * @throws \InvalidArgumentException if the token is invalid.
     */
    public function validateBearerToken(string $token): void
    {
        if (!Validator::validateBearerToken($token)) {
            throw new \InvalidArgumentException("Invalid Bearer Token provided.");
        }
    }

    /**
     * General data validation for required fields.
     *
     * @param array $data The data to validate.
     * @param array $requiredFields The required fields for the data.
     * @throws \InvalidArgumentException if required fields are missing.
     */
    public function validateRequestData(array $data, array $requiredFields): void
    {
        if (!Validator::validateData($data, $requiredFields)) {
            throw new \InvalidArgumentException("Missing required fields in the request data.");
        }
    }
}
