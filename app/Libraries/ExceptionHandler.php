<?php

namespace App\Libraries;

use CodeIgniter\Debug\BaseExceptionHandler;
use CodeIgniter\Debug\ExceptionHandlerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Throwable;

class ExceptionHandler extends BaseExceptionHandler implements ExceptionHandlerInterface
{
    // You can override the view path.
    // protected ?string $viewPath = APPPATH . 'Views/errors/';

    public function handle(
        Throwable $exception,
        RequestInterface $request,
        ResponseInterface $response,
        int $statusCode,
        int $exitCode,
    ): void {
       
        
      service('response')
        ->setStatusCode($exception->getStatusCode())
        ->setJSON($exception->response())
        ->send();

    // exit; // WA

        exit($exitCode);
    }
}