<?php

namespace App\Controllers;

class Apps extends BaseController{

	public function index(): string{
		// return base_url('assets');
		// return session()->get('id_user');
		return view('pages/home');
	}

	//ok
	public function kelas(): string{
		$level = new \App\Models\KelasLevelModel();
		$data = [
			'kelasLevel' => $level->getAll()
		];
		return view($this->pgAdmin.'kelas/kelas',$data);
	}
	
	//ok
	public function kelas_level(): string{
		return view($this->pgAdmin.'kelas/kelas-level');
	}
	
	//ok
	public function kelas_aktif(): string{
		$thajaran = new \App\Models\ThAjaranModel();
		$kelas = new \App\Models\KelasModel();
		$siswa = new \App\Models\SiswaModel();
		$data = [
			'thajaran'=>$thajaran->getAktif(),
			'kelas'=>$kelas->getAll(),
			'siswa'=>$siswa->getAll(),
		];
		return view($this->pgAdmin.'kelas/kelas-aktif',$data);
	}

	//ok
	public function thajaran(): string{
		return view($this->pgAdmin.'th-ajaran/index');
	}
	
	//ok
	public function pelajaran(): string{
		return view($this->pgAdmin.'/mata-pelajaran/index');
	}

	//ok
	public function siswa(): string{
		return view($this->pgAdmin.'siswa/index');
	}
	

	//ok
	public function guru(): string{
		return view($this->pgAdmin.'guru/index');
	}

	// ok
	public function jadwal():string{
		$thajaran = new \App\Models\ThAjaranModel();
		$guru = new \App\Models\GuruModel();
		$matapelajaran = new \App\Models\MataPelajaranModel();
		$kelasaktif = new \App\Models\KelasAktifModel();
		$data = [
			'thajaran'=>$thajaran->getAktif(),
			'pelajaran'=>$matapelajaran->getAll(),
			'kelas'=>$kelasaktif->getAll(),
			'guru'=>$guru->getAll(),
		];
		return view($this->pgAdmin.'jadwal/index',$data);
	}
	

	//ok
	public function pengguna(){
		return view($this->pgAdmin.'pengguna/index');
	}

	//ok
	public function login(){	
		return view('pages/login');
	}

	//ok
	// public function logout(){
	// 	$user = new \App\Models\UserModel();
	// 	$username = $this->request->user->username;
	// 	$user->_updateToken($username,null);
	// 	session()->destroy();
	// 	return service('response')->setStatusCode(204);
		
	// }

	// untuk ambil full query syntax
	public function queryCompile(){
		$db = \Config\Database::connect();
		$builder = $db->table('nilai')
									->select('
                    id_nilai,
                    th_ajaran,
                    siswa.nama as nama_siswa,
                    mata_pelajaran.nama as pelajaran,
                    nilai_uts,
                    nilai_uas,
                    keterangan')
                  ->where('nilai.siswa_id','19')
                  ->join('siswa','nilai.siswa_id=siswa.id_siswa','left')
                  ->join('th_ajaran','nilai.th_ajaran_id=th_ajaran.id_th_ajaran','left')
                  ->join('mata_pelajaran','nilai.mata_pelajaran_id=mata_pelajaran.id_mata_pelajaran','left');
                  

	// echo $builder->getCompiledSelect();

	}

}
