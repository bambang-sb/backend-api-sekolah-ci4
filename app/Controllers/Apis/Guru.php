<?php
namespace App\Controllers\Apis;

use App\Schemas\ValidSchema;
use App\Schemas\AppsSchema;
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
    $validSchema =new ValidSchema($body,AppsSchema::$fieldGuru);

    $this->service->createBiodata($validSchema->value);
    return $this->created('create success');
  }

  public function getAll(){
    $data=$this->service->getAll();
    return $this->success('success',$data);
  }

  // delete ???
}