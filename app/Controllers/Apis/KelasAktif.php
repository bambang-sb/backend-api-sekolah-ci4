<?php
namespace App\Controllers\Apis;

use App\Schemas\ValidSchema;
use App\Schemas\AppsSchema;
use App\Services\KelasAktifService;

class KelasAktif extends ResponseHandle{

  protected $service;

  public function __construct(){
    $this->service = new KelasAktifService();
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
    $validSchema =new ValidSchema($body,AppsSchema::$fieldKelasAktif);

    $this->service->create($validSchema->value);
    return $this->created('create success');
  }

  public function update($id=null){
   
    $body = $this->request->getBody();
    if($body == null)return $this->bodyError();

    //cek schema body
    $validSchema =new ValidSchema($body,AppsSchema::$fieldKelasAktif);

    $this->service->update($id,$validSchema->value);
    return $this->updated('update success');
  }

  // delete ???
}