<?php
namespace App\Validations;

class ThAjaranValidation{

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