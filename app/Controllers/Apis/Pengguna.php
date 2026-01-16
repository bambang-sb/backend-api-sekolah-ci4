<?php
namespace App\Controllers\Apis;

use App\Services\PenggunaService;

class Pengguna extends ResponseHandle{

  protected $service;

  public function __construct(){
    $this->service = new PenggunaService();
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
    return $this->created('create success');
  }

  public function update($id=null){
    // if($id==null){
    //   return $this->errorResponse('ID Pengguna harus diisi',null,400);
    // }
    // $body = $this->request->getJSON(true);//true=>ubah ke array
    // $this->service->update($id,$body);
    // return $this->success('update success');
  }

  // delete ???
}