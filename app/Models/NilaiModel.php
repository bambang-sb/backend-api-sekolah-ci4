<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table            = 'nilai';
    protected $primaryKey       = 'id_nilai';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'siswa_id',
      'th_ajaran_id',
      'mata_pelajaran_id',
      'guru_id',
      'nilai_uts',
      'nilai_uas',
      'nilai_akhir',
      'keterangan',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created';
    protected $updatedField  = 'updated';
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

  public function getNilaiByGuru($guruId){
    $res = $this->select('
                    id_nilai,
                    th_ajaran,
                    siswa.nama as nama_siswa,
                    guru.nama as nama_guru,
                    mata_pelajaran.nama as pelajaran,
                    nilai_uts,
                    nilai_uas,
                    keterangan')
                  ->where('nilai.guru_id',$guruId)
                  ->join('siswa','nilai.siswa_id=siswa.id_siswa','left')
                  ->join('th_ajaran','nilai.th_ajaran_id=th_ajaran.id_th_ajaran','left')
                  ->join('mata_pelajaran','nilai.mata_pelajaran_id=mata_pelajaran.id_mata_pelajaran','left')
                  ->join('guru','nilai.guru_id=guru.id_guru','left')
                  ->get()
                  ->getResult();
    return $res;
  }


  public function getNilaiBySiswa($siswaId){
    $res = $this->select('
                    id_nilai,
                    th_ajaran,
                    siswa.nama as nama_siswa,
                    mata_pelajaran.nama as pelajaran,
                    nilai_uts,
                    nilai_uas,
                    keterangan')
                  ->where('nilai.siswa_id',$siswaId)
                  ->join('siswa','nilai.siswa_id=siswa.id_siswa','left')
                  ->join('th_ajaran','nilai.th_ajaran_id=th_ajaran.id_th_ajaran','left')
                  ->join('mata_pelajaran','nilai.mata_pelajaran_id=mata_pelajaran.id_mata_pelajaran','left')
                  ->get()
                  ->getResult();
    return $res;
  }

  //id nilai
  public function getById($id){
    $res = $this->select('
                    id_nilai,
                    th_ajaran_id,
                    mata_pelajaran_id,
                    siswa_id,
                    guru_id,
                    nilai_uts,
                    nilai_uas,
                    keterangan')
                  ->where('id_nilai',$id)
                  ->get()
                  ->getRow();
    return $res;
  }

  //untuk cek exist data sebelum simpan
  public function getCekBeforeCreate($data,$guruId){
    $res = $this->select('id_nilai')
                  ->where('th_ajaran_id',$data['th_ajaran'])
                  ->where('siswa_id',$data['siswa'])
                  ->where('mata_pelajaran_id',$data['mata_pelajaran'])
                  ->where('guru_id',$guruId)
                  ->get()
                  ->getRow();
    return $res;
  }

  public function create(array $data,int $guruId){
    // Hari dimulai nomor 1 Senin
    $this->insert([
      'th_ajaran_id'=>$data['th_ajaran'],
      'guru_id'=>$guruId,
      'mata_pelajaran_id'=>$data['mata_pelajaran'],
      'siswa_id'=>$data['siswa'],
      'nilai_uts'=>$data['nilai_uts'],
      'nilai_uas'=>$data['nilai_uas'],
      'keterangan'=>$data['keterangan']
    ]);
    // $lastId = $this->getInsertID();
    return;
  }

  public function updateNilai($data,$id,$guruId){
    $this->set([
            'th_ajaran_id'=>$data['th_ajaran'],
            'guru_id'=>$guruId,
            'mata_pelajaran_id'=>$data['mata_pelajaran'],
            'siswa_id'=>$data['siswa'],
            'nilai_uts'=>$data['nilai_uts'],
            'nilai_uas'=>$data['nilai_uas'],
            'keterangan'=>$data['keterangan']
            ])
          ->where('id_nilai',$id)
          ->update();
    return;
  }

}
