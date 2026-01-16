<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kelas_level_id','nama_kelas'];

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
    $res = $this->select('id_kelas,level,nama_kelas')
                ->join('kelas_level','kelas.kelas_level_id=kelas_level.id_kelas_level','left')
                  ->orderBy('kelas_level.level','ASC')
                  ->orderBy('kelas.nama_kelas','ASC')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('id_kelas,kelas_level_id,nama_kelas')
                  ->where('id_kelas',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByKelasAndLevel($kelas,$level){
    $res = $this->select('nama_kelas')
                  ->where('nama_kelas',$kelas)
                  ->where('kelas_level_id',$level)
                  ->get()
                  ->getRow();
    return $res;
  }
  public function getByKelasForUpdate($kelas,$id){
    $res = $this->select('nama_kelas')
                  ->where('kelas_level_id',$kelas['kelas_level'])
                  ->where('nama_kelas',$kelas['nama_kelas'])
                  ->where('id_kelas !=',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data){
    $this->insert([
      'kelas_level_id'=>$data['kelas_level'],
      'nama_kelas'=>$data['nama_kelas']
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateKelas($id,$data){
    $this->set([
            'nama_kelas'=>$data['nama_kelas'],
            'kelas_level_id'=>$data['kelas_level']
            ])
          ->where('id_kelas',$id)
          ->update();
    return;
  }

  //delete ???

}
