<?php

namespace MmsApiClient\Handler;

use MMS\MmsApiClient\Exceptions\UnauthorizedException;
use MMS\MmsApiClient\Exceptions\NotFoundException;
use MMS\MmsApiClient\Exceptions\BadRequestException;
use MMS\MmsApiClient\Exceptions\ServerException;
use MMS\MmsApiClient\Exceptions\GenericApiException;

class ExceptionHandler
{
    /**
     * Handles the exception based on the type.
     *
     * @param \Exception $exception
     * @return void
     */
    public static function handle(\Exception $exception)
    {
        echo self::getErrorMessage($exception);
    }

    /**
     * Provides custom error messages based on the exception type.
     *
     * @param \Exception $exception
     * @return string
     */
    private static function getErrorMessage(\Exception $exception): string
    {
        switch (get_class($exception)) {
            case UnauthorizedException::class:
                return "Unauthorized access: " . $exception->getMessage();
            case NotFoundException::class:
                return "Not found: " . $exception->getMessage();
            case BadRequestException::class:
                return "Bad request: " . $exception->getMessage();
            case ServerException::class:
                return "Server error: " . $exception->getMessage();
            case GenericApiException::class:
                return "API error: " . $exception->getMessage();
            default:
                return "An unknown error occurred: " . $exception->getMessage();
        }
    }
}
