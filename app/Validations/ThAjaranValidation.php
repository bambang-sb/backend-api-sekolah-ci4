<?php
namespace App\Validations;

class ThAjaranValidation{

  // 0 Genap, 1 Ganjil
  public static $thAjaranRule = [
    'thajaran' => 'required',
    'semester' => 'required|in_list[0,1]'
  ];

  public static $thAjaranMessage = [
    'thajaran' => [
      'required' => 'Tahun Ajaran harus diisi'
    ],
    'semester' => [
      'required' => 'Semester harus diisi',
      'in_list'=> 'Semester harus Ganjil(1) Genap(0)'
    ]
  ];

  public static $thAjaranIdRule = [
    'id' => 'required|numeric'
  ];

  public static $thAjaranIdMessage = [
    'id' => [
      'required' => 'ID Th Ajaran harus diisi',
      'numeric' => 'ID Th Ajaran harus berupa angka'
    ]
  ];

}