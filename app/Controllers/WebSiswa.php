<?php

namespace App\Controllers;

class WebSiswa extends BaseController{

  public function siswaBiodata(): string{
		return view($this->pgSiswa.'biodata');
	}

	public function nilaiSiswa():string{
		return view($this->pgSiswa.'nilai');
	}

}