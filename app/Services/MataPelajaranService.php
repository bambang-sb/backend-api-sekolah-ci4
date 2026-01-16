<?php
namespace App\Services;

use App\Models\MataPelajaranModel;
use App\Validations\MataPelajaranValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class MataPelajaranService{

  private $model;

  public function __construct(){
    $this->model = new MataPelajaranModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      MataPelajaranValidation::$mataPelajaranIdRule,MataPelajaranValidation::$mataPelajaranIdMessage
    );
    
    //cek
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
      MataPelajaranValidation::$mataPelajaranRule,MataPelajaranValidation::$mataPelajaranMessage
    );

    //cek data exist
    $exist = $this->model->getByNamaMataPelajaran($valid->value['nama']);
    if($exist !== null){
     throw new MyException('Mata Pelajaran sudah ada',409);
    }

    //success return id
    $this->model->create($valid->value);
    return; //return last id
  }

  public function update($id,array $data){

    //validation data
    $valid = new Validate(
      $data,
      MataPelajaranValidation::$mataPelajaranRule,MataPelajaranValidation::$mataPelajaranMessage
    );

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      MataPelajaranValidation::$mataPelajaranIdRule,MataPelajaranValidation::$mataPelajaranIdMessage
    );

    //cek exits kecuali diri sendiri
    $exist = $this->model->getByNamaMataPelajaranForUpdate($valid->value,$validId->value['id']);
    if($exist !== null){
     throw new MyException('Mata Pelajaran sudah ada',409);
    }

    //success
    $this->model->updateMataPelajaran($validId->value['id'],$valid->value);
    return;
  }

  // delete level MataPelajaran ???

}