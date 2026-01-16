<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



//login
$routes->get('/login','Apps::login');
$routes->post('/api/user/login','Apis\Users::login');

//logout web app
// $routes->get('/logout','Apps::logout');


$routes->get('/', 'Apps::index',['filter'=>'authSession']);
$routes->get('/kelas', 'Apps::kelas',['filter'=>'authSession']);
$routes->get('/kelas/level', 'Apps::kelas_level',['filter'=>'authSession']);
$routes->get('/kelas/aktif', 'Apps::kelas_aktif',['filter'=>'authSession']);
$routes->get('/thajaran', 'Apps::thajaran',['filter'=>'authSession']);
$routes->get('/pelajaran', 'Apps::pelajaran',['filter'=>'authSession']);
$routes->get('/siswa', 'Apps::siswa',['filter'=>'authSession']);
$routes->get('/guru', 'Apps::guru',['filter'=>'authSession']);
$routes->get('/jadwal', 'Apps::jadwal',['filter'=>'authSession']);
$routes->get('/pengguna', 'Apps::pengguna',['filter'=>'authSession']);

//web guru
$routes->get('/guru/biodata', 'WebGuru::guruBiodata',['filter'=>'authSession']);
$routes->get('/guru/nilai', 'WebGuru::nilai',['filter'=>'authSession']);

//web siswa
$routes->get('/siswa/biodata', 'WebSiswa::siswaBiodata',['filter'=>'authSession']);
$routes->get('/siswa/nilai', 'WebSiswa::nilaiSiswa',['filter'=>'authSession']);

// === API ===
//logout api
$routes->get('api/user/logout','Apis\Users::logout',['filter' => 'auth']);
$routes->group('api',['filter' => 'auth'], function($r){
  
  //kelas level
  $r->get('kelas-level','Apis\KelasLevel::getAll');
  $r->get('kelas-level/(:segment)','Apis\KelasLevel::getById/$1');
  $r->post('kelas-level','Apis\KelasLevel::create');
  $r->put('kelas-level/(:segment)','Apis\KelasLevel::update/$1');

  //kelas
  $r->get('kelas','Apis\Kelas::getAll');
  $r->get('kelas/(:segment)','Apis\Kelas::getById/$1');
  $r->post('kelas','Apis\Kelas::create');
  $r->put('kelas/(:segment)','Apis\Kelas::update/$1');

  //kelas aktive
  $r->get('kelas-aktif','Apis\KelasAktif::getAll');
  $r->get('kelas-aktif/(:segment)','Apis\KelasAktif::getById/$1');
  $r->post('kelas-aktif','Apis\KelasAktif::create');
  $r->put('kelas-aktif/(:segment)','Apis\KelasAktif::update/$1');

  //thajaran
  $r->get('thajaran','Apis\ThAjaran::getAll');
  $r->get('thajaran/(:segment)','Apis\ThAjaran::getById/$1');
  $r->post('thajaran','Apis\ThAjaran::create');
  $r->put('thajaran/(:segment)','Apis\ThAjaran::update/$1');
  $r->put('thajaran/aktif/(:segment)','Apis\ThAjaran::aktif/$1');
  $r->put('thajaran/nonaktif/(:segment)','Apis\ThAjaran::nonAktif/$1');

  //Mata pelajaran
  $r->get('pelajaran','Apis\MataPelajaran::getAll');
  $r->get('pelajaran/(:segment)','Apis\MataPelajaran::getById/$1');
  $r->post('pelajaran','Apis\MataPelajaran::create');
  $r->put('pelajaran/(:segment)','Apis\MataPelajaran::update/$1');

  //Siswa
  $r->get('siswa','Apis\Siswa::getAll');
  $r->get('siswa/nilai','Apis\Siswa::getNilai');
  // $r->get('siswa/(:segment)','Apis\Siswa::getById/$1');
  // $r->post('siswa','Apis\Siswa::create');
  // $r->put('siswa/(:segment)','Apis\Siswa::update/$1');
  $r->get('siswa/biodata','Apis\Siswa::biodata');
  $r->post('siswa/biodata','Apis\Siswa::biodataSave');

  //Guru
  $r->get('guru','Apis\Guru::getAll');
  // $r->get('guru/(:segment)','Apis\Guru::getById/$1');
  // $r->post('guru','Apis\Guru::create');
  // $r->put('guru/(:segment)','Apis\Guru::update/$1');
  $r->get('guru/biodata','Apis\Guru::biodata');
  $r->post('guru/biodata','Apis\Guru::biodataSave');
  
  //Jadwal
  $r->get('jadwal','Apis\Jadwal::getAll');
  $r->get('jadwal/(:segment)','Apis\Jadwal::getById/$1');
  $r->post('jadwal','Apis\Jadwal::create');
  $r->put('jadwal/(:segment)','Apis\Jadwal::update/$1');
  $r->delete('jadwal/(:segment)','Apis\Jadwal::delete/$1');

  //Pengguna atau users
  $r->get('pengguna','Apis\Pengguna::getAll');
  $r->get('pengguna/(:segment)','Apis\Pengguna::getById/$1');
  $r->post('pengguna','Apis\Pengguna::create');

  // NILAI
  $r->get('nilai','Apis\Nilai::getNilaiByGuru');
  $r->get('nilai/(:segment)','Apis\Nilai::getById/$1');
  $r->post('nilai','Apis\Nilai::create');
  $r->put('nilai/(:segment)','Apis\Nilai::update/$1');
  
});

// ===
// untuk ambil kode query full
$routes->get('/q','Apps::queryCompile');
// ====

$routes->set404Override(function($e){
  response()->setStatusCode(404)
      ->setJSON([
          'statusCode'=>404,
          'message' => 'Opss !! permintaan request tidak ditemukan !'
      ])
      ->send(); // WAJIB send()
  exit; // hentikan eksekusi
});


// usahakan selesai buat documentasi agar langsung ke documentasi ecommerce