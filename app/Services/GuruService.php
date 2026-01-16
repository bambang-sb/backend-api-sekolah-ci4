<?php
namespace App\Services;

use App\Models\GuruModel;
use App\Validations\GuruValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class GuruService{

  private $model;

  public function __construct(){
    $this->model = new GuruModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  public function biodata(){
    $id = auth_id();
    $data = $this->model->biodata($id);
    return $data;
  }

  public function createBiodata(array $data){
    $valid = new Validate(
      $data,
      GuruValidation::$guruRule,GuruValidation::$guruMessage
    );
    $userId = auth_id();
    //cek data exist
    $exist = $this->model->getByGuruNip($valid->value['nip'],$userId);
    if($exist !== null){
     throw new MyException('NIP Guru sudah ada',409);
    }

    //cek data biodata exist
    $exist = $this->model->getByUserId($userId);
    if($exist !== null){
      $data = $this->updateBiodata($valid->value,$userId);
      return;
    }

    //success return id
    $res = $this->model->createBiodata($valid->value,$userId);
    session()->set('idPengguna',$res->id_guru);
    
  }

  public function updateBiodata(array $data,int $userId){

    $this->model->updateBiodata($data,$userId);

  }

  // delete level Guru ???

}