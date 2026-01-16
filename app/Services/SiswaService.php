<?php
namespace App\Services;

use App\Models\SiswaModel;
use App\Validations\SiswaValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class SiswaService{

  private $model;

  public function __construct(){
    $this->model = new SiswaModel();
  }

  public function biodata(){
    $id = auth_id();
    $data = $this->model->biodata($id);
    return $data;
  }

  public function biodataSave($data){
    $valid = new Validate(
      $data,
      SiswaValidation::$biodataRule,SiswaValidation::$biodataMessage
    );
    $loginId = auth_id();
    //cek data exist
    $exist = $this->model->getBySiswaNisn($valid->value['nisn'],$loginId);
    if($exist !== null){
     throw new MyException('NISN Siswa sudah ada',409);
    }

    //cek siswa sudah ada atau tidak
    
    $exist2 = $this->model->getByUserId($loginId);
    if($exist2 !== null){
      $this->model->updateBiodata($valid->value,$loginId);
      return;
    }

    //success return id
    $id = $this->model->createBiodata($valid->value,$loginId);
    session()->set('idPengguna',$id);
    
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }
  
  public function getNilai($idSiswa){
    $nilai = new \App\Models\NilaiModel;
    $data = $nilai->getNilaiBySiswa($idSiswa);
    return $data;
  }

  // public function getById($id){
  //   $valid = new Validate(
  //     ['id'=>$id],
  //     SiswaValidation::$siswaIdRule,SiswaValidation::$siswaIdMessage
  //   );
    
  //   //success
  //   $data = $this->model->getById($valid->value['id']);
  //   return $data;
  // }

  // delete level Siswa ???

}