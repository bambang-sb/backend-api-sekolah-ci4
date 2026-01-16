<?php
namespace App\Validations;

class PenggunaValidation{

  // == pengguna Validation ==
  public static $penggunaRule = [
    'username'=>'required|min_length[3]',
    'password'=>'required|min_length[3]'
  ];
  public static $penggunaMessage = [
    'username'=>[
      'required'=>'Username wajib diisi !',
      'min_length' => 'Username minimal 3 karakter',
    ],
    'password'=>[
      'required'=>'Password wajib diisi !',
      'min_length' => 'Password minimal 3 karakter',
    ]
  ];

  //username
  public static $usernameRule = [
    'username'=>'required'
  ];
  public static $usernameMessage = [
    'password'=>[
      'required'=>'Password wajib diisi !',
    ]
  ];
  //password
  public static $passwordRule = [
    'password'=>'required'
  ];
  public static $passwordMessage = [
    'password'=>[
      'required'=>'Password wajib diisi !',
    ]
  ];

  //untuk id parameter
  public static $penggunaIdRule = [
    'id'=>'required|numeric'
  ];
  public static $penggunaIdMessage = [
    'id'=>[
      'required'=>'ID Pengguna wajib diisi !',
      'numeric'=>'ID Pengguna harus angka !'
    ]
  ];
  
}