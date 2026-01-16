<?php
namespace App\Services;

use App\Models\NilaiModel;
use App\Validations\NilaiValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class NilaiService{

  private $model;

  public function __construct(){
    $this->model = new NilaiModel();
  }

  // untuk guru
  public function getNilaiByGuru(){
    $guruId = auth_pengguna();
    $data = $this->model->getNilaiByGuru($guruId);
    return $data;
  }

  // by id nilai
  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      NilaiValidation::$nilaiIdRule,NilaiValidation::$nilaiIdMessage
    );
    
    // cek
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
      NilaiValidation::$nilaiRule,NilaiValidation::$nilaiMessage
    );
    $guruId = auth_pengguna();
    // cek data exist
    $exist = $this->model->getCekBeforeCreate($valid->value,$guruId);
    if($exist !== null){
     throw new MyException('Data Nilai Siswa sudah ada',409);
    }

    //success return id
    $this->model->create($valid->value,$guruId);
    return; //return last id
  }

  public function update($id,array $data){

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      NilaiValidation::$nilaiIdRule,NilaiValidation::$nilaiIdMessage
    );

    //validation data
    $valid = new Validate(
      $data,
      NilaiValidation::$nilaiRule,NilaiValidation::$nilaiMessage
    );

    //cek exist kecuali diri sendiri
    // $exist = $this->model->getCekBeforeUpdate($valid->value,$validId->value['id']);
    // if($exist !== null){
    //  throw new MyException('Nilai sudah ada',400);
    // }

    //success
    $guruId = auth_pengguna();
    $this->model->updateNilai($valid->value,$validId->value['id'],$guruId);
    return;
  }

  // DELETE ???

}