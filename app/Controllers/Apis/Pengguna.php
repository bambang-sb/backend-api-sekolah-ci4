<?php
namespace App\Controllers\Apis;

use App\Schemas\ValidSchema;
use App\Schemas\AppsSchema;
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
    $body = $this->request->getBody();
    if($body == null)return $this->bodyError();

    //cek schema body
    $validSchema =new ValidSchema($body,AppsSchema::$fieldPengguna);

    $this->service->create($validSchema->value);
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