<?php

namespace MmsApiClient\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $errorCode;
    protected $errorMessage;

    public function __construct(string $errorMessage, int $errorCode = 0)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        parent::__construct($errorMessage, $errorCode);
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
