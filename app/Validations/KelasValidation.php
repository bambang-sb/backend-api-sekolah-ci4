<?php
namespace App\Validations;

class KelasValidation{

  // == Kelas Validation ==
  public static $kelasRule = [
    'kelas_level'=>'required|numeric|in_list[10,11,12]',
    'nama_kelas'=>'required'
  ];
  public static $kelasMessage = [
    'kelas_level'=>[
      'required'=>'ID Kelas wajib diisi',
      'numeric'=>'ID Kelas harus angka',
      'in_list'=>'Level Kelas harus 10, 11, atau 12'
    ],
    'nama_kelas'=>[
      'required'=>'Nama Kelas wajib diisi',
    ]
  ];
  //untuk id parameter
  public static $kelasIdRule = [
    'id'=>'required|numeric'
  ];
  public static $kelasIdMessage = [
    'id'=>[
      'required'=>'ID Kelas wajib diisi',
      'numeric'=>'ID Kelas harus angka'
    ]
  ];
  // == end Kelas Validation ==

  // == Kelas Level Validation ==
  //untuk id parameter
  public static $kelasLevelIdRule = [
    'id' => 'required|numeric',
  ];
  public static $kelasLevelIdMessage = [
    'id' => [
        'required' => 'ID Kelas Level wajib diisi',
        'numeric' => 'ID Kelas Level harus angka'
    ]
  ];
  public static $kelasLevelRule = [
    'level' => 'required|numeric|in_list[10,11,12]',
  ];
  
  public static $kelasLevelMessage = [
    'level' => [
        'required' => 'Level wajib diisi',
        'numeric' => 'Level harus angka',
        'in_list'=>'Level Kelas harus 10, 11, atau 12'
    ]
  ];

  // == Kelas Active Validation ==
  public static $kelasAktifIdRule = [
    'id'=>'required|numeric'
  ];
  public static $kelasAktifIdMessage = [
    'id'=>[
      'required' => 'ID wajib diisi',
      'numeric' => 'Input ID Salah !!'
    ]
  ];
  public static $kelasAktifRule = [
    'siswa'=>'required|numeric',
    'thajaran'=>'required|numeric',
    'kelas'=>'required|numeric',
  ];

  public static $kelasAktifMessage = [
    'siswa'=>[
      'required' => 'Siswa wajib diisi',
      'numeric' => 'Input Siswa Salah !!'
    ],
    'thajaran'=>[
      'required' => 'Th Ajaran wajib diisi',
      'numeric' => 'Input Th Ajaran Salah !!'
    ],
    'kelas'=>[
      'required' => 'Kelas wajib diisi',
      'numeric' => 'Input Kelas Salah !!'
    ],
  ];

}