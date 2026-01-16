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
    $body = $this->request->getJSON(true);//true=>ubah ke array
    if($body == null){
      return $this->bodyError();  
    }
    $this->service->create($body);
    return $this->created('create success');//last id
  }

  public function update($id=null){
    
    $body = $this->request->getJSON(true);//true=>ubah ke array
    if($body == null){
      return $this->bodyError();  
    }
    $this->service->update($id,$body);
    
    return $this->updated('update success');
  }

  // delete ???
}