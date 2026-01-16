<?php

namespace App\Models;

use CodeIgniter\Model;

class MataPelajaranModel extends Model
{
    protected $table            = 'mata_pelajaran';
    protected $primaryKey       = 'id_mata_pelajaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','deskripsi','is_active'];

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
    $res = $this->select('id_mata_pelajaran,nama,deskripsi')
                  ->orderBy('nama','ASC')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('id_mata_pelajaran,nama,deskripsi')
                  ->where('id_mata_pelajaran',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByNamaMataPelajaran($pelajaran){
    $res = $this->select('nama')
                  ->where('nama',$pelajaran)
                  ->get()
                  ->getRow();
    return $res;
  }
  public function getByNamaMataPelajaranForUpdate($pelajaran,$id){
    $res = $this->select('nama')
                  ->where('nama',$pelajaran['nama'])
                  ->where('id_mata_pelajaran !=',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data){
    $this->insert([
      'nama'=>$data['nama'],
      'deskripsi'=>$data['deskripsi'],
      'is_active'=>1
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateMataPelajaran($id,$data){
    $this->set([
            'nama'=>$data['nama'],
            'deskripsi'=>$data['deskripsi']
            ])
          ->where('id_mata_pelajaran',$id)
          ->update();
    return;
  }

  //delete ???

}
