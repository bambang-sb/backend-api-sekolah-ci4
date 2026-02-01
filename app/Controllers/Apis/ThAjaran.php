<?php
namespace App\Controllers\Apis;

use App\Services\ThAjaranService;

class ThAjaran extends ResponseHandle{

  protected $service;

  public function __construct(){
    $this->service = new ThAjaranService();
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
    $schemaRule = \App\Validations\ThAjaranValidation::$thAjaranRule;
    $validSchema =new ValidSchema($body,$schemaRule);

    $this->service->create($validSchema->value);
    
    return $this->created('create success');
  }

  public function update($id=null){
   
    $body = $this->request->getBody();
    if($body == null) return $this->bodyError();
    
    //cek schema body
    $schemaRule = \App\Validations\ThAjaranValidation::$thAjaranRule;
    $validSchema =new ValidSchema($body,$schemaRule);

    $this->service->update($id,$validSchema->value);
    
    return $this->updated();
  }

  // delete ???


  public function aktif($id){
    if($id==null){
      return $this->errorResponse('ID Th Ajaran harus diisi',null,400);
    }
    $this->service->aktif($id);

    return $this->updated('update success');
  }

  public function nonAktif($id){
    if($id==null){
      return $this->errorResponse('ID Th Ajaran harus diisi',null,400);
    }
    $this->service->nonAktif($id);

    return $this->updated('update success');
  }
  
}