<?php
namespace App\Controllers\Apis;

use App\Services\KelasService;

class Kelas extends ResponseHandle{

  protected $service;

  public function __construct(){
    $this->service = new KelasService();
  }

  public function getAll(){
    $data=$this->service->getAll();
    return $this->success('success',$data);
  }

  public function getById($id){
    $data=$this->service->getById($id);
    return $this->success('success',$data);
  }

  public function create(){
    $body = $this->request->getBody();
    if($body == null)return $this->bodyError();

    //cek schema body
    $schemaRule = \App\Validations\KelasValidation::$kelasRule;
    $validSchema = $this->validSchema($body,$schemaRule);

    $this->service->create($validSchema->value);
    return $this->created('create success');
  }

  public function update($id=null){
    
    $body = $this->request->getBody();
    if($body == null)return $this->bodyError();

    //cek schema body
    $schemaRule = \App\Validations\KelasValidation::$kelasRule;
    $validSchema = $this->validSchema($body,$schemaRule);

    $this->service->update($id,$validSchema->value);
    
    return $this->updated('update success');
  }

  // delete ???
}