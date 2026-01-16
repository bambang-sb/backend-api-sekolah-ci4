<?php

namespace App\Models;

use CodeIgniter\Model;

class ThAjaranModel extends Model
{
    protected $table            = 'th_ajaran';
    protected $primaryKey       = 'id_th_ajaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['th_ajaran','semester','is_active'];

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
    $res = $this->select('id_th_ajaran,th_ajaran,semester,is_active')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('id_th_ajaran,th_ajaran,semester')
                  ->where('id_th_ajaran',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByThAjaranAndSemester($data){
    $res = $this->select('th_ajaran,semester')
                  ->where('th_ajaran',$data['thajaran'])
                  ->where('semester',$data['semester'])
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getByThAjaranForUpdate($data,$id){
    $res = $this->select('th_ajaran,semester')
                  ->where('th_ajaran',$data['thajaran'])
                  ->where('semester',$data['semester'])
                  ->where('id_th_ajaran !=',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data){
    $this->insert([
      'th_ajaran'=>$data['thajaran'],
      'semester'=>$data['semester']
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateThAjaran($id,$data){
    $this->set([
            'th_ajaran'=>$data['thajaran'],
            'semester'=>$data['semester']
            ])
          ->where('id_th_ajaran',$id)
          ->update();
    return;
  }

  //delete ???


  public function getAktif(){
    $res = $this->select('id_th_ajaran,th_ajaran,semester')
                ->where('is_active','t')
                ->get()
                ->getRow();
    
    return $res;
  }

  public function getAktif2(){
    $res = $this->select('is_active')
                ->where('is_active','t')
                ->get()
                ->getRow();
    return $res;
  }

  public function updateThAjaranAktif($id){
    $this->set([
            'is_active'=>'t'
            ])
          ->where('id_th_ajaran',$id)
          ->update();
    return;
  }

  public function updateThAjaranNonAktif($id){
    $this->set([
            'is_active'=>'f'
            ])
          ->where('id_th_ajaran',$id)
          ->update();
    return;
  }
}
