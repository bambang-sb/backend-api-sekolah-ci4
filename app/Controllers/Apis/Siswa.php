<?php
namespace App\Controllers\Apis;

use App\Services\SiswaService;

class Siswa extends ResponseHandle{

  protected $service;

  public function __construct(){
    $this->service = new SiswaService();
  }

  public function biodata(){
    $data=$this->service->biodata();
    return $this->success('success',$data);
  }
  public function biodataSave(){
    $body = $this->request->getBody();
    if($body == null)return $this->bodyError();

    //cek schema body
    $schemaRule = \App\Validations\SiswaValidation::$biodataRule;
    $validSchema = $this->validSchema($body,$schemaRule);

    $data=$this->service->biodataSave($validSchema->value);
    return $this->created('success',);
  }

  public function getAll(){
    $data=$this->service->getAll();
    return $this->success('success',$data);
  }
  public function getNilai(){
    $idSiswa = auth_pengguna();
    if($idSiswa == null){
      return $this->errorResponse('Lengkapi biodata terlebih dahulu !!',[],400);  
    }
    $data=$this->service->getNilai($idSiswa);
    return $this->success('success',$data);
  }

  // public function getById($id){
  //   $data=$this->service->getById($id);
  //   return $this->success('success',$data);
  // }


  // delete ???
}