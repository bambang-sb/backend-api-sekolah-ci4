<?php
namespace App\Services;

use App\Models\KelasModel;
use App\Validations\KelasValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class KelasService{

  private $model;

  public function __construct(){
    $this->model = new KelasModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      KelasValidation::$kelasIdRule,KelasValidation::$kelasIdMessage
    );
    
    //get
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
      KelasValidation::$kelasRule,KelasValidation::$kelasMessage
    );

    //valid level
    // $v = ['A','B','C','D'];
    // if(!in_array($valid->value['nama_kelas'],$v)){
    //   throw new MyException('Nama Kelas harus A, B, C atau D',422);
    // }

    //cek data exist
    $exist = $this->model->getByKelasAndLevel($valid->value['nama_kelas'],$valid->value['kelas_level']);
    if($exist !== null){
     throw new MyException('Kelas sudah ada',409);
    }

    //success return id

    $this->model->create($valid->value);
    return ; //return last id
  }

  public function update($id,array $data){

    //validation data
    $valid = new Validate(
      $data,
      KelasValidation::$kelasRule,KelasValidation::$kelasMessage
    );

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      KelasValidation::$kelasIdRule,KelasValidation::$kelasIdMessage
    );

    //cek exits kecuali diri sendiri
    $exist = $this->model->getByKelasForUpdate($valid->value,$validId->value['id']);
    if($exist !== null){
     throw new MyException('Kelas sudah ada',409);
    }

    //success
    $this->model->updateKelas($validId->value['id'],$valid->value);
    return;
  }

  // delete level kelas ???

}