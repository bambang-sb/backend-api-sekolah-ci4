<?php
namespace App\Services;

use App\Models\JadwalModel;
use App\Validations\JadwalValidation;
use App\Validations\Validate;
use App\Libraries\MyException;

class JadwalService{

  private $model;

  public function __construct(){
    $this->model = new JadwalModel();
  }

  public function getAll(){
    $data = $this->model->getAll();
    return $data;
  }

  // by jadwal id
  public function getById($id){
    $valid = new Validate(
      ['id'=>$id],
      JadwalValidation::$jadwalIdRule,JadwalValidation::$jadwalIdMessage
    );
    
    //cek data
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
      JadwalValidation::$jadwalRule,JadwalValidation::$jadwalMessage
    );

    // cek data exist
    // 1 mapel hanya boleh 1 sehari
    $exist = $this->model->getCekBeforeCreate($valid->value);
    if($exist !== null){
     throw new MyException('Jadwal sudah ada',409);
    }
    
    //jika jadwal tidak ada, cek jam masuk dan jam keluar
    helper('my');
    $getJamMulaiSelesai = $this->model->getJamMulaiSelesai($valid->value);
    if($getJamMulaiSelesai !== null){
      $cekBentrok = cekJadwalBentrok(
        $getJamMulaiSelesai,
        $valid->value['jam_mulai'],
        $valid->value['jam_selesai']
      );
      if($cekBentrok){
        throw new MyException('Jam Pelajaran Bentrok !!!',409);
      }
    }

    //success
    $this->model->create($valid->value);
    return;
  }

  public function update($id,array $data){

    //validation data
    $valid = new Validate(
      $data,
      JadwalValidation::$jadwalRule,JadwalValidation::$jadwalMessage
    );

    //validation id
    $validId = new Validate(
      ['id'=>$id],
      JadwalValidation::$jadwalIdRule,JadwalValidation::$jadwalIdMessage
    );

    //cek exist kecuali diri sendiri
    $exist = $this->model->getCekBeforeUpdate($valid->value,$validId->value['id']);
    if($exist !== null){
     throw new MyException('Jadwal sudah ada',409);
    }

    //jika jadwal tidak ada, cek jam masuk dan jam keluar
    helper('my');
    $getJamMulaiSelesai = $this->model->getJamMulaiSelesai($valid->value);
    if($getJamMulaiSelesai !== null){
      $cekBentrok = cekJadwalBentrok(
        $getJamMulaiSelesai,
        $valid->value['jam_mulai'],
        $valid->value['jam_selesai']
      );
      if($cekBentrok){
        throw new MyException('Jam Pelajaran Bentrok !!!',409);
      }
    }

    //success
    $this->model->updateJadwal($valid->value,$validId->value['id']);
    return;
  }

  public function delete($id){
    $validId = new Validate(
      ['id'=>$id],
      JadwalValidation::$jadwalIdRule,JadwalValidation::$jadwalIdMessage
    );

    $this->model->deleteJadwal($validId->value['id']);
    return;
  }

}