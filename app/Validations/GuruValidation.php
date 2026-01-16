<?php
namespace App\Validations;

class GuruValidation{

  // == guru Validation ==
  public static $guruRule = [
    'nip'=>'required|numeric',
    'nama'=>'required',
    'jk'=>'required',
    'alamat'=>'required',
    'tgl_lahir'=>'required',
    'telp'=>'required',
    'email'=>'required',
  ];
  public static $guruMessage = [
    'nip'=>[
      'required'=>'NIP Guru wajib diisi',
      'numeric'=>'NIP Guru harus angka'
    ],
    'nama'=>[
      'required'=>'Nama guru wajib diisi'
    ],
    'jk'=>[
      'required'=>'Jenis Kelamin wajib diisi'
    ],
    'tgl_lahir'=>[
      'required'=>'Tgl lahir wajib diisi'
    ],
    'alamat'=>[
      'required'=>'Alamat guru wajib diisi'
    ],
    'telp'=>[
      'required'=>'No Handphone guru wajib diisi'
    ],
    'email'=>[
      'required'=>'email guru wajib diisi'
    ],
  ];
  //untuk id parameter
  public static $guruIdRule = [
    'id'=>'required|numeric'
  ];
  public static $guruIdMessage = [
    'id'=>[
      'required'=>'ID guru wajib diisi',
      'numeric'=>'ID guru harus angka'
    ]
  ];
  // == end guru Validation ==


}