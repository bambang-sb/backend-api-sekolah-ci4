<?php
namespace App\Services;

use App\Models\PenggunaModel;
use App\Validations\PenggunaValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class PenggunaService{

  private $model;

  public function __construct(){
    $this->model = new PenggunaModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      PenggunaValidation::$penggunaIdRule,PenggunaValidation::$penggunaIdMessage
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
      PenggunaValidation::$penggunaRule,PenggunaValidation::$penggunaMessage
    );

    //cek data exist
    $exist = $this->model->getByUsername($valid->value['username']);
    if($exist !== null){
     throw new MyException('username sudah ada',409);
    }

    //hash pass
    $valid->value['password'] = password_hash($valid->value['password'],PASSWORD_DEFAULT);

    //success return id
    $this->model->create($valid->value);
    return; //return last id
  }

  public function update($id,array $data){
    // ???
  }

  // delete level Pengguna ???

}