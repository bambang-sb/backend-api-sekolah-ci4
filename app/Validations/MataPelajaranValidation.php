<?php
namespace App\Validations;

class MataPelajaranValidation{

  // == mataPelajaran Validation ==
  public static $mataPelajaranRule = [
    'nama'=>'required',
    'deskripsi'=>'required'
  ];
  public static $mataPelajaranMessage = [
    'nama'=>[
      'required'=>'Mata Pelajaran wajib diisi !'
    ],
    'deskripsi'=>[
      'required'=>'Deskripsi wajib diisi !'
    ]
  ];

  //untuk id parameter
  public static $mataPelajaranIdRule = [
    'id'=>'required|numeric'
  ];
  public static $mataPelajaranIdMessage = [
    'id'=>[
      'required'=>'ID Mata Pelajaran wajib diisi !',
      'numeric'=>'ID Mata Pelajaran harus angka !'
    ]
  ];
  
}