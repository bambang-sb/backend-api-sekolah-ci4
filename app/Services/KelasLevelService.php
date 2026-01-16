<?php
namespace App\Services;

use App\Models\KelasLevelModel;
use App\Validations\KelasValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class KelasLevelService{

  private $model;

  public function __construct(){
    $this->model = new KelasLevelModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  // by id kelas level
  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      KelasValidation::$kelasLevelIdRule,KelasValidation::$kelasLevelIdMessage
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
      KelasValidation::$kelasLevelRule,KelasValidation::$kelasLevelMessage
    );

    //cek data exist
    $exist = $this->model->getByLevel($valid->value['level']);
    if($exist !== null){
     throw new MyException('Level Kelas sudah ada',409);
    }

    //success
    $this->model->create($valid->value);
    return;
  }

  public function update($id,array $data){

    //validation data
    $valid = new Validate(
      $data,
      KelasValidation::$kelasLevelRule,KelasValidation::$kelasLevelMessage
    );

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      KelasValidation::$kelasLevelIdRule,KelasValidation::$kelasLevelIdMessage
    );

    //cek id exist
    // $cekId = $this->model->getById($validId->value['id']);
    // if($cekId === null){
    //  throw new MyException('Request tidak ditemukan !',404); 
    // }

    //cek exits level kecuali id diri sendiri
    $exist = $this->model->getByLevelForUpdate($valid->value,$validId->value['id']);
    if($exist !== null){
     throw new MyException('Level Kelas sudah ada',409);
    }

    //success
    $this->model->updateKelasLevel($validId->value['id'],$valid->value);
    return;
  }

  // delete level kelas ???

}