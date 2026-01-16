<?php

namespace App\Libraries;

use Exception;
use App\Contracts\ApiExceptionInterface;

class MyException extends Exception implements ApiExceptionInterface
{
    protected int $statusCode;
    protected array $errors;
    

    /**
     * Konstruktor untuk ApiException.
     *
     * @param string $message Pesan error.
     * @param int $statusCode Kode status HTTP (default: 400).
     * @param array $errors Array tambahan untuk detail error (opsional).
     * @param Throwable|null $previous Exception sebelumnya (opsional).
     */
    public function __construct(string $message = "", int $statusCode = 400, array $errors = [], Throwable $previous = null)
    {
        parent::__construct($message,$statusCode, $previous);
        $this->statusCode = $statusCode;
        $this->errors = $errors;
        $this->msg = $message;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function response():array{
        return [
            'statusCode'=>$this->statusCode,
            'message'=>$this->msg
        ];
    }
}   
