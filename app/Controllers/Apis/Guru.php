<?php
namespace App\Controllers\Apis;

use App\Services\GuruService;

class Guru extends ResponseHandle{

  protected $service;

  public function __construct(){
    $this->service = new GuruService();
  }

  function biodata(){
    $data=$this->service->biodata();
    return $this->success('success',$data);
  }

  public function biodataSave(){
    $body = $this->request->getBody();
    if($body == null)return $this->bodyError();

    //cek schema body
    $schemaRule = \App\Validations\GuruValidation::$guruRule;
    $validSchema =$this->validSchema($body,$schemaRule);

    $this->service->createBiodata($validSchema->value);
    return $this->created('create success');
  }

  public function getAll(){
    $data=$this->service->getAll();
    return $this->success('success',$data);
  }

  // delete ???
}