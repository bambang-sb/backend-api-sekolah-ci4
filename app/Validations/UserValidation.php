<?php

namespace App\Validations;

class UserValidation{
  
  public static $loginRule = [
    'username' => 'required|min_length[3]|max_length[20]',
    'password' => 'required|min_length[3]',
  ];
  
  public static $loginMessage = [
    'username' => [
        'required' => 'Username wajib diisi',
        'min_length' => 'Username minimal 3 karakter',
        'max_length' => 'Username maksimal 20 karakter'
    ],
    'password' => [
        'required' => 'Password wajib diisi',
        'min_length' => 'Password minimal 3 karakter'
    ]
  ];
  
}