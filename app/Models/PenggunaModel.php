<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_users';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username','password','role','token'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

  public function getAll(){
    $res = $this->select('id_user,username,password,role')
                  ->orderBy('username','ASC')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('id_user,username,role')
                  ->where('id_user',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByUsername($username){
    $res = $this->select('username')
                  ->where('username',$username)
                  ->get()
                  ->getRow();
    return $res;
  }
  // public function getByUsernameForUpdate($data,$id){
  //   $res = $this->select('username')
  //                 ->where('username',$data['username'])
  //                 ->where('id_user !=',$id)
  //                 ->get()
  //                 ->getRow();
  //   return $res;
  // }

  public function create(array $data){
    $this->insert([
      'username'=>$data['username'],
      'password'=>$data['password'],
      'role'=>$data['role']
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateUser($id,$data){
    // $this->set([
    //         'username'=>$data['username'],
    //         'password'=>$data['password']
    //         ])
    //       ->where('id_user',$id)
    //       ->update();
    // return;
  }

  //delete ???

}
