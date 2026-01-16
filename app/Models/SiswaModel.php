<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nisn','nama','tgl_lahir','alamat','telp','status','user_id'];

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
    $res = $this->select('id_siswa,nisn,nama,alamat,telp,tgl_lahir')
                  ->where('user_id',$id)
                  ->get()
                  ->getRow();
    return $res;
  }
  
  public function getIdSiswa($idUser){
    $res = $this->select('id_siswa')
                  ->where('user_id',$idUser)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByUserId($id){
    $res = $this->select('id_siswa,nisn,nama,alamat,telp,tgl_lahir')
                  ->where('user_id',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function createBiodata(array $data,int $loginId){
    $this->insert([
      'nisn'=>$data['nisn'],
      'user_id'=>$loginId,
      'nama'=>$data['nama'],
      'tgl_lahir'=>$data['tgl_lahir'],
      'alamat'=>$data['alamat'],
      'telp'=>$data['telp'],
      'status'=>'aktif',
    ]);
    $id = $this->getInsertID();
    return $id;
  }

  public function getAll(){
    $res = $this->select('id_siswa,nisn,nama,alamat,telp,status,tgl_lahir')
                  ->get()
                  ->getResult();
    return $res;
  }

  //untuk cek exist data sebelum simpan
  public function getBysiswaNisn($nisn,$userId){
    $res = $this->select('nisn')
                  ->where('nisn',$nisn)
                  ->where('user_id !=',$userId)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function updateBiodata($data,$loginId){
    $this->set([
            'nisn'=>$data['nisn'],
            'nama'=>$data['nama'],
            'tgl_lahir'=>$data['tgl_lahir'],
            'alamat'=>$data['alamat'],
            'telp'=>$data['telp']
            ])
          ->where('user_id',$loginId)
          ->update();
  }

  //delete ???

}
