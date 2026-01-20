<?php

namespace App\Schemas;

class AppsSchema{
  public static $fieldThajaran=[
    'thajaran','semester'
  ];
  public static $fieldGuru=[
    'nip','nama','alamat','tgl_lahir','telp','jk','email'
  ];
  public static $fieldJadwal=[
    'th_ajaran','guru','mata_pelajaran','kelas_aktif','hari','jam_mulai','jam_selesai'
  ];
  public static $fieldKelasAktif=[
    'th_ajaran','kelas','siswa'
  ];
  public static $fieldKelasLevel=['level'];

  public static $fieldKelas=['nama_kelas','level'];

  public static $fieldLogin=['username','password'];

  public static $fieldMataPelajaran=['nama','deskripsi'];

  public static $fieldNilai=[
    'th_ajaran','mata_pelajaran','siswa','keterangan','nilai_uts','nilai_uas'
  ];

  public static $fieldPengguna=['username','password','role'];
  
  public static $fieldSiswa=['nisn','nama','alamat','tgl_lahir','telp'];

}