<?php

namespace App\Libraries;

// use CodeIgniter\Exceptions\ExceptionInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\ResponseTrait;

use App\Contracts\ApiExceptionInterface;

class ExceptionValidation extends \Exception implements ApiExceptionInterface
{
    use ResponseTrait;

    
    protected int $statusCode;
    protected array $errors=[];

    public function __construct(array $errors = [], $message = 'Validation Failed', $statusCode = 422)
    {
        parent::__construct($message, $statusCode);
        $this->errors = $errors;
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function response(): array
    {
        return [
            'statusCode'=>$this->statusCode,
            'message'=>$this->getMessage(),
            'errors'=>$this->errors
        ];
    }
}
