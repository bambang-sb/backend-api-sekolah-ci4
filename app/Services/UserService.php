<?php
namespace App\Services;

use Codeigniter\Cookie\Cookie;
use App\Validations\Validate;
use App\Validations\UserValidation;
use App\Libraries\MyException;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use App\Models\UserModel;

class UserService{

  // public function register(array $data){
  //   //validasi
  //   $valid = new Validate($data,UserValidation::$registerRule,UserValidation::$registerMessage);
    
  //   $user = new UserModel();
  //   //cek username db
  //   $cek = $user->_getByUsername($valid->value['username']);
  //   if($cek !== null) throw new MyException('Username sudah ada!!',400,['username'=>$valid->value['username']]);

  //   //hash pass
  //   $valid->value['password'] = password_hash($valid->value['password'],PASSWORD_DEFAULT);

  //   //save data
  //   $user->_insert($valid->value);
    
  //   return $cek;
  // }

  public function login(array $data){
    //validasi
    $valid = new Validate($data,UserValidation::$loginRule,UserValidation::$loginMessage);

    $user = new UserModel();

    //cek username db
    $cek = $user->_getByUsernameAndPassword($valid->value['username']);
    if($cek == null) throw new MyException('Username atau password salah!!',401,['username'=>$valid->value['username']]);

    //cek password
    $isPass = password_verify($valid->value['password'],$cek->password);
    if(!$isPass) throw new MyException('Username atau password salah!!',401,['username'=>$valid->value['username']]);

    //role guru
    $idPengguna = null;
    if($cek->role == 'guru'){
      $idPengguna = $this->infoLoginGuru($cek->id_user);
    }
    if($cek->role == 'siswa'){
      $idPengguna = $this->infoLoginSiswa($cek->id_user);
    }

    //role siswa

    //==success==
    // Payload JWT
    $now = time();
    $payload = [
        'iat' => $now,
        'exp' => $now + 3600,
        'id_user' => $cek->id_user,
        'username' => $cek->username,
        'role' => $cek->role
    ];
    //buat token
    $token = 'passwordRahasiaSangatRahasiaDanSuperRahasia';
    $jwt = JWT::encode($payload,$token, 'HS256');

    $res = $user->_updateToken($cek->username,$jwt);
    if(!$res) throw new MyException('Gagal membuat token',401);

    session()->set([
      'id_user'=>$cek->id_user,
      'role'=>$cek->role,
      'idPengguna'=>$idPengguna,
      'logged'=>true
    ]);
    
    
    return $jwt;
    
  }

  function logout($requestUser){
    $user = new UserModel();
    $res = $user->_updateToken($requestUser->username,null);
    session()->destroy();
  }

  function infoLoginGuru($idUser){
    $guru = new \App\Models\GuruModel();

    $res = $guru->getIdGuru($idUser);
    if($res !== null){
      return $res->id_guru;
    }
    return null;
  }

  function infoLoginSiswa($idUser){
    $siswa = new \App\Models\SiswaModel();

    $res = $siswa->getIdSiswa($idUser);
    if($res !== null){
      return $res->id_siswa;
    }
    return null;
  }

}