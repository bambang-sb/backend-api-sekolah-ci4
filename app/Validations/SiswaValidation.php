<?php
namespace App\Validations;

class SiswaValidation{

  // == siswa Validation ==
  public static $biodataRule = [
    'nisn'=>'required|numeric',
    'nama'=>'required',
    'tgl_lahir'=>'required',
    'alamat'=>'required',
    'telp'=>'required|numeric'
  ];
  public static $biodataMessage = [
    'nisn'=>[
      'required'=>'NISN siswa wajib diisi',
      'numeric'=>'NISN siswa harus angka'
    ],
    'nama'=>[
      'required'=>'Nama siswa wajib diisi'
    ],
    'tgl_lahir'=>[
      'required'=>'Tgl lahir siswa wajib diisi'
    ],
    'alamat'=>[
      'required'=>'Alamat siswa wajib diisi'
    ],
    'telp'=>[
      'required'=>'No Handphone siswa wajib diisi',
      'numeric'=>'No Handphone harus angka !!'
    ],
  ];
  //untuk id parameter
  public static $siswaIdRule = [
    'id'=>'required|numeric'
  ];
  public static $siswaIdMessage = [
    'id'=>[
      'required'=>'ID siswa wajib diisi',
      'numeric'=>'ID siswa harus angka'
    ]
  ];
  // == end siswa Validation ==


}