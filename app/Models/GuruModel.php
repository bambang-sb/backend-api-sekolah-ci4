<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'guru';
    protected $primaryKey       = 'id_guru';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nip','nama','jk','tgl_lahir','alamat','telp','email','is_active','user_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    // protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_masuk';
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

   public function biodata($id){
    $res = $this->select('nip,nama,alamat,jk,tgl_lahir,telp,email')
                  ->where('user_id',$id)
                  ->get()
                  ->getRow();
    return $res;
  }
  
  public function getAll(){
    $res = $this->select('id_guru,nip,nama,alamat,jk,tgl_lahir,telp,email,is_active,user_id')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getIdGuru($userId){
    $res = $this->select('id_guru')
                ->where('user_id',$userId)
                ->get()
                ->getRow();
    return $res;
  }

  public function getByUserId($userId){
    $res = $this->select('id_guru,nip,nama,alamat,jk,tgl_lahir,telp,email')
                  ->where('user_id',$userId)
                  ->get()
                  ->getRow();
    return $res;
  }

  //untuk cek exist data sebelum simpan
  public function getByguruNip($nip,$userId){
    $res = $this->select('nip')
                  ->where('nip',$nip)
                  ->where('user_id !=',$userId)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function createBiodata(array $data,int $userId){
    $this->insert([
      'nip'=>$data['nip'],
      'nama'=>$data['nama'],
      'jk'=>$data['jk'],
      'tgl_lahir'=>$data['tgl_lahir'],
      'alamat'=>$data['alamat'],
      'telp'=>$data['telp'],
      'email'=>$data['email'],
      'is_active'=>1,
      'user_id'=>$userId
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateBiodata($data,$userId){
    $this->set([
            'nip'=>$data['nip'],
            'nama'=>$data['nama'],
            'jk'=>$data['jk'],
            'tgl_lahir'=>$data['tgl_lahir'],
            'alamat'=>$data['alamat'],
            'telp'=>$data['telp'],
            'email'=>$data['email']
            ])
          ->where('user_id',$userId)
          ->update();
    return;
  }

  //delete ???

}
