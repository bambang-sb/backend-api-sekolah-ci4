<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id_jadwal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'th_ajaran_id',
      'guru_id',
      'mata_pelajaran_id',
      'kelas_aktif_id',
      'hari',
      'jam_mulai',
      'jam_selesai'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'tgl_masuk';
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
    $res = $this->select('
                    id_jadwal,
                    th_ajaran,
                    guru.nama as nama_guru,
                    mata_pelajaran.nama as pelajaran,
                    nama_kelas,
                    level,
                    hari,
                    jam_mulai,
                    jam_selesai')
                  ->join('th_ajaran','jadwal.th_ajaran_id=th_ajaran.id_th_ajaran','left')
                  ->join('guru','jadwal.guru_id=guru.id_guru','left')
                  ->join('mata_pelajaran','jadwal.mata_pelajaran_id=mata_pelajaran.id_mata_pelajaran','left')
                  ->join('kelas_aktif','jadwal.kelas_aktif_id=kelas_aktif.id_kelas_aktif','left')
                  ->join('kelas','kelas_aktif.kelas_id=kelas.id_kelas','left')
                  ->join('kelas_level','kelas.kelas_level_id=kelas_level.id_kelas_level','left')
                  ->get()
                  ->getResult();
    return $res;
  }

  public function getById($id){
    $res = $this->select('
                    id_jadwal,
                    th_ajaran_id,
                    mata_pelajaran_id,
                    kelas_aktif_id,
                    guru_id,
                    hari,
                    jam_mulai,
                    jam_selesai')
                  ->where('id_jadwal',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  //untuk cek exist data sebelum simpan
  //th ajaran, guru, mata pelajaran, kelas aktif
  public function getCekBeforeCreate($data){
    $res = $this->select('id_jadwal,jam_mulai,jam_selesai')
                  ->where('hari',$data['hari'])
                  ->where('th_ajaran_id',$data['th_ajaran'])
                  ->where('mata_pelajaran_id',$data['mata_pelajaran'])
                  ->where('guru_id',$data['guru'])
                  ->where('kelas_aktif_id',$data['kelas_aktif'])
                  ->get()
                  ->getRow();
    return $res;
  }

  public function getJamMulaiSelesai($data){
    $res = $this->select('jam_mulai,jam_selesai')
                ->where('hari',$data['hari'])
                ->where('th_ajaran_id',$data['th_ajaran'])
                ->where('kelas_aktif_id',$data['kelas_aktif'])
                ->get()
                ->getResult();
    return $res;
  }

  //cek exist data sebelum update kecuali id sekarang
  //th ajaran, guru, mata pelajaran, kelas aktif
  public function getCekBeforeUpdate($data,$id){
    $res = $this->select('id_jadwal')
                  ->where('th_ajaran_id',$data['th_ajaran'])
                  ->where('mata_pelajaran_id',$data['mata_pelajaran'])
                  ->where('guru_id',$data['guru'])
                  ->where('kelas_aktif_id',$data['kelas_aktif'])
                  ->where('id_jadwal !=',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data){
    // Hari dimulai nomor 1 Senin
    $this->insert([
      'th_ajaran_id'=>$data['th_ajaran'],
      'guru_id'=>$data['guru'],
      'mata_pelajaran_id'=>$data['mata_pelajaran'],
      'kelas_aktif_id'=>$data['kelas_aktif'],
      'hari'=>$data['hari'],
      'jam_mulai'=>$data['jam_mulai'],
      'jam_selesai'=>$data['jam_selesai']
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updatejadwal($data,$id){
    $this->set([
            'th_ajaran_id'=>$data['th_ajaran'],
            'guru_id'=>$data['guru'],
            'mata_pelajaran_id'=>$data['mata_pelajaran'],
            'kelas_aktif_id'=>$data['kelas_aktif'],
            'hari'=>$data['hari'],
            'jam_mulai'=>$data['jam_mulai'],
            'jam_selesai'=>$data['jam_selesai']
            ])
          ->where('id_jadwal',$id)
          ->update();
    return;
  }

  public function deleteJadwal($id){
    $this->where('id_jadwal',$id)->delete();
  }

}
