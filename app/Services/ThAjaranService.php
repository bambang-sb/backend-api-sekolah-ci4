<?php
namespace App\Services;

use App\Models\ThAjaranModel;
use App\Validations\ThAjaranValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class ThAjaranService{

  private $model;

  public function __construct(){
    $this->model = new ThAjaranModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      ThAjaranValidation::$thAjaranIdRule,ThAjaranValidation::$thAjaranIdMessage
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
      ThAjaranValidation::$thAjaranRule,ThAjaranValidation::$thAjaranMessage
    );

    //cek data exist
    $exist = $this->model->getByThAjaranAndSemester($valid->value);
    if($exist !== null){
     throw new MyException('Th ajaran sudah ada',409);
    }

    //success
    $this->model->create($valid->value);
    return; 
  }

  public function update($id,array $data){

    //validation data
    $valid = new Validate(
      $data,
      ThAjaranValidation::$thAjaranRule,ThAjaranValidation::$thAjaranMessage
    );

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      ThAjaranValidation::$thAjaranIdRule,ThAjaranValidation::$thAjaranIdMessage
    );

    //cek exits kecuali diri sendiri
    $exist = $this->model->getByThAjaranForUpdate($valid->value,$validId->value['id']);
    if($exist !== null){
     throw new MyException('Th Ajaran sudah ada',409);
    }

    //success
    $this->model->updateThAjaran($validId->value['id'],$valid->value);
    return;
  }

  // delete thajaran ???


  public function aktif($id){

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      ThAjaranValidation::$thAjaranIdRule,ThAjaranValidation::$thAjaranIdMessage
    );

    //cek th ajaran aktif
    $exist = $this->model->getAktif2();
    if($exist !== null){
     throw new MyException('Th Ajaran ada yang aktif !',409);
    }

    //success
    $this->model->updateThAjaranAktif($validId->value['id']);
    return;
  }

  public function nonAktif($id){

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      ThAjaranValidation::$thAjaranIdRule,ThAjaranValidation::$thAjaranIdMessage
    );

    //success
    $this->model->updateThAjaranNonAktif($validId->value['id']);
    return;
  }

}