<?php
namespace App\Validations;

class NilaiValidation{
  public static $nilaiRule = [
    'siswa'=>'required|numeric',
    'th_ajaran'=>'required|numeric',
    'mata_pelajaran'=>'required|numeric',
    'nilai_uts'=>'numeric',
    'nilai_uas'=>'numeric',
  ];

  public static $nilaiMessage = [
    'siswa'=>[
      'required'=>'Siswa wajib diisi',
      'numeric'=>'input Siswa tidak valid'
    ],
    'th_ajaran'=>[
      'required'=>'Th Ajaran wajib diisi',
      'numeric'=>'input Th Ajaran tidak valid'
    ],
    'mata_pelajaran'=>[
      'required'=>'Mata Pelajaran wajib diisi',
      'numeric'=>'Input Mata Pelajaran tidak valid'
    ],
    'nilai_uts'=>[
      'numeric'=>'nilai uts tidak valid'
    ],
    'nilai_uas'=>[
      'numeric'=>'Nilai uas harus angka'
    ],
  ];

  //Jadwal ID
  public static $nilaiIdRule = [
    'id'=>'required|numeric'
  ];

  public static $nilaiIdMessage = [
    'id'=>[
      'required'=>'ID wajib diisi',
      'numeric'=>'ID harus angka'
    ]
  ];
  
}