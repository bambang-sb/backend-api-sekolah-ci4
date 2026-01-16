<?php

namespace App\Controllers\Apis;

// use CodeIgniter\HTTP\ResponseInterface;
use App\Services\UserService;

class Users extends ResponseHandle{

  private $service;

	public function __construct(){
		$this->service = new UserService();
	}

	// public function register(){
	// 	$body = $this->request->getJSON(true);//true=>ubah ke array

	// 	$res = $this->service->register($body);
		
	// 	return $this->success('register success',$res);
	// }

	public function login(){
		$body = $this->request->getJSON(true);//true=>ubah ke array

		$data = $this->service->login($body);
		
		return $this->success('login success',['token'=>$data,'token_type'=>'Bearer']);
	}

	public function logout(){
		$this->service->logout($this->request->user);
		
		return $this->success('Logout...');
	}

    
  
}
