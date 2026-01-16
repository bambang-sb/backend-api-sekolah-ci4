<?php

namespace App\Controllers\Apis;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ResponseHandle extends ResourceController{

  protected $format = 'json';

  protected function successResponse(string $message, $data = null, int $code = 200){
    return $this->respond([
        'statusCode'    => $code,
        'message' => $message,
        'data'    => $data
    ], $code);
    // exit;
  }

  protected function errorResponse(string $message, $errors = null,int $code = 400){
    return $this->respond([
        'statusCode'    => $code,
        'message' => $message,
        'errors'  => $errors
    ], $code);
    // exit;
  }

  protected function success(string $message = 'Success',$data=[]){
      return $this->successResponse($message, $data, 200);
  }

  protected function created(string $message = 'Success create',$data=[]){
      return $this->successResponse($message, $data, 201);
  }

  protected function updated(){
    return $this->successResponse('update ok',[], 200);
    
    // gunakan 204 untuk update data
    // untuk sementara pakai 200 dulu
    // return $this->respond(null,204);
    
  }

  // ==========================
  // Helper ERROR
  // ==========================

  protected function bodyError(string $message='Body Invalid !!!',$code=400){
    return $this->respond([
        'statusCode'    => $code,
        'message' => $message
    ], $code);
  }

  // protected function validationError($errors)
  // {
  //     return $this->errorResponse('Validasi gagal', $errors,422);
  // }

  // protected function notFound(string $message = 'request tidak valid')
  // {
  //     return $this->errorResponse($message,null, 404);
  // }

  // protected function unauthorized(string $message = 'Unauthorized')
  // {
  //     return $this->errorResponse($message,null, 401);
  // }

}