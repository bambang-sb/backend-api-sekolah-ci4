<?php

namespace App\Controllers;

class WebGuru extends BaseController{

  public function guruBiodata(): string{
		return view($this->pgGuru.'biodata');
	}

	public function nilai():string{
		$thajaran = new \App\Models\ThAjaranModel();
		$guru = new \App\Models\GuruModel();
		$matapelajaran = new \App\Models\MataPelajaranModel();
		$siswa = new \App\Models\SiswaModel();
		$data = [
			'thajaran'=>$thajaran->getAktif(),
			'pelajaran'=>$matapelajaran->getAll(),
			'siswa'=>$siswa->getAll(),
			'guru'=>$guru->getAll(),
		];
		return view($this->pgGuru.'nilai-siswa',$data);
	}

}