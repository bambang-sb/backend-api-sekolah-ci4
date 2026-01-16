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
    $body = $this->request->getJSON(true);//true=>ubah ke array
    if($body == null){
      return $this->bodyError();  
    }
    $this->service->create($body);
    // return $this->success('create success',$body);//testing
    
    return $this->created('create success');
  }

  public function update($id=null){
    // if($id==null){
    //   return $this->errorResponse('ID Th Ajaran Level harus diisi',null,400);
    // }
    $body = $this->request->getJSON(true);//true=>ubah ke array
    if($body == null){
      return $this->bodyError();  
    }
    $this->service->update($id,$body);
    
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