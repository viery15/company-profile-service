<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CommonException extends Exception
{
    protected $message;
    protected $errorCode;
    protected $statusCode;

    public function __construct($message, $errorCode, $statusCode = 0, Throwable $previous = null)
    {
        $this->errorCode = $errorCode;
        $this->statusCode = $statusCode;

        parent::__construct($message, $statusCode, $previous);
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
