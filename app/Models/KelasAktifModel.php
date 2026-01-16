<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasAktifModel extends Model
{
    protected $table            = 'kelas_aktif';
    protected $primaryKey       = 'id_kelas_aktif';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['siswa_id','th_ajaran_id','kelas_id'];

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
    $res = $this->select('id_kelas_aktif,nama,th_ajaran,nama_kelas,level,semester')
                ->join('siswa','kelas_aktif.siswa_id=siswa.id_siswa','left')
                ->join('kelas','kelas_aktif.kelas_id=kelas.id_kelas','left')
                ->join('kelas_level','kelas.kelas_level_id=kelas_level.id_kelas_level','left')
                ->join('th_ajaran','kelas_aktif.th_ajaran_id=th_ajaran.id_th_ajaran','left')
                ->get()
                ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('id_kelas_aktif,kelas_id,siswa_id,th_ajaran_id')
                  ->where('id_kelas_aktif',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  //cek sebelum simpan
  public function getByKelasAjaranAndSiswa($kelas,$ajaran,$siswa){
    $res = $this->select('siswa_id')
                  ->where('th_ajaran_id',$ajaran)
                  ->where('siswa_id',$siswa)
                  ->get()
                  ->getRow();
    return $res;
  }

  //cek sebelum update kecuali data id diri sendiri
  public function getByKelasAktifForUpdate($data,$id){
    $res = $this->select('kelas_id')
                  ->where('kelas_id',$data['kelas'])
                  ->where('th_ajaran_id',$data['thajaran'])
                  ->where('siswa_id',$data['siswa'])
                  ->where('id_kelas_aktif !=',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data){
    $this->insert([
      'kelas_id'=>$data['kelas'],
      'th_ajaran_id'=>$data['thajaran'],
      'siswa_id'=>$data['siswa']
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateKelasAktif($id,$data){
    $this->set([
            'kelas_id'=>$data['kelas'],
            'th_ajaran_id'=>$data['thajaran'],
            'siswa_id'=>$data['siswa']
            ])
          ->where('id_kelas_aktif',$id)
          ->update();
    return;
  }

  //delete ???

}
