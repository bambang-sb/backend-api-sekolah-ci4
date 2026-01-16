<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasLevelModel extends Model
{
    protected $table            = 'kelas_level';
    protected $primaryKey       = 'id_kelas_level';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['level'];

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
    $res = $this->select('id_kelas_level,level')
                  ->orderBy('level','ASC')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('id_kelas_level,level')
                  ->where('id_kelas_level',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByLevel($level){
    $res = $this->select('level')
                  ->where('level',$level)
                  ->get()
                  ->getRow();
    return $res;
  }
  public function getByLevelForUpdate($level,$id){
    $res = $this->select('level')
                  ->where('level',$level)
                  ->where('id_kelas_level !=',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data){
    $this->insert($data);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateKelasLevel($id,$data){
    $this->set(['level'=>$data['level']])
          ->where('id_kelas_level',$id)
          ->update();
    return;
  }

  //delete ???

}
