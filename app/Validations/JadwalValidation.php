<?php
namespace App\Validations;

class JadwalValidation{
  public static $jadwalRule = [
    'th_ajaran'=>'required|numeric',
    'guru'=>'required|numeric',
    'mata_pelajaran'=>'required|numeric',
    'kelas_aktif'=>'required|numeric',
    'hari'=>'required|numeric|in_list[1,2,3,4,5,6]',
    'jam_mulai'=>'required',
    'jam_selesai'=>'required',
  ];

  public static $jadwalMessage = [
    'th_ajaran'=>[
      'required'=>'Th Ajaran wajib diisi',
      'numeric'=>'input Th Ajaran tidak valid'
    ],
    'guru'=>[
      'required'=>'Guru wajib diisi',
      'numeric'=>'Input guru tidak valid'
    ],
    'mata_pelajaran'=>[
      'required'=>'Mata Pelajaran wajib diisi',
      'numeric'=>'Input Mata Pelajaran tidak valid'
    ],
    'kelas_aktif'=>[
      'required'=>'Kelas wajib diisi',
      'numeric'=>'input Kelas tidak valid'
    ],
    'hari'=>[
      'required'=>'Hari wajib diisi',
      'numeric'=>'Hari harus angka',
      'in_list'=>'Hari tidak valid !'
    ],
    'jam_mulai'=>[
      'required'=>'Jam Mulai wajib diisi',
    ],
    'jam_selesai'=>[
      'required'=>'Jam Selesai wajib diisi'
    ],
  ];

  //Jadwal ID
  public static $jadwalIdRule = [
    'id'=>'required|numeric'
  ];

  public static $jadwalIdMessage = [
    'id'=>[
      'required'=>'ID wajib diisi',
      'numeric'=>'ID harus angka'
    ]
  ];
  
}