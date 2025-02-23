<?php

namespace MmsApiClient;

class Validator
{
    /**
     * Validate the API URL to ensure it's a valid URL.
     *
     * @param string $url The API base URL to validate.
     * @return bool Returns true if the URL is valid, otherwise false.
     */
    public static function validateUrl(string $url): bool
    {
        // Check if the URL is valid and starts with http or https
        return filter_var($url, FILTER_VALIDATE_URL) && (strpos($url, 'http') === 0);
    }

    /**
     * Validate the Bearer Token to ensure it is not empty and follows a basic format.
     *
     * @param string $token The API bearer token to validate.
     * @return bool Returns true if the token is valid, otherwise false.
     */
    public static function validateBearerToken(string $token): bool
    {
        // A basic check for a token format (adjust based on your token structure)
        return !empty($token) && strlen($token) > 10;  // You can refine this to match a specific token pattern
    }

    /**
     * Validate that the provided data is an array and has required keys.
     *
     * @param array $data The data to validate.
     * @param array $requiredKeys The required keys for the data.
     * @return bool Returns true if the data contains all required keys, otherwise false.
     */
    public static function validateData(array $data, array $requiredKeys): bool
    {
        // Check if all required keys are present in the data array
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return false;
            }
        }
        return true;
    }
}
