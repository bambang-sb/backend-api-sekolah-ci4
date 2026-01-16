<?php
namespace App\Services;

use App\Models\KelasAktifModel;
use App\Validations\KelasValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class KelasAktifService{

  private $model;

  public function __construct(){
    $this->model = new KelasAktifModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  // by id kelas aktif
  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      KelasValidation::$kelasAktifIdRule,KelasValidation::$kelasAktifIdMessage
    );
    
    $data = $this->model->getById($valid->value['id']);

    //data tidak ditemukan
    if($data == null){
      throw new MyException('Data tidak ditemukan !!',404);
    }

    //success
    return $data;
  }

  public function create(array $data){
    $valid = new Validate(
      $data,
      KelasValidation::$kelasAktifRule,KelasValidation::$kelasAktifMessage
    );

    //cek data exist
    $exist = $this->model->getByKelasAjaranAndSiswa(
      $valid->value['kelas'],
      $valid->value['thajaran'],
      $valid->value['siswa']
    );
    if($exist !== null){
     throw new MyException('Data sudah ada',409);
    }

    //success

    $this->model->create($valid->value);
    return;
  }

  public function update($id,array $data){

    //validation data
    $valid = new Validate(
      $data,
      KelasValidation::$kelasAktifRule,KelasValidation::$kelasAktifMessage
    );

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      KelasValidation::$kelasAktifIdRule,KelasValidation::$kelasAktifIdMessage
    );

    //cek exits kecuali diri sendiri
    $exist = $this->model->getByKelasAktifForUpdate(
      $valid->value,
      $validId->value['id']);
    if($exist !== null){
     throw new MyException('Data sudah ada',409);
    }

    //success
    $this->model->updateKelasAktif($validId->value['id'],$valid->value);
    return;
  }

  // delete level KelasAktif ???

}