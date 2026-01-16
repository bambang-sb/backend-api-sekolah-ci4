<?php

if(!function_exists('cekJadwalBentrok')){
  function cekJadwalBentrok($dataJamDB,$jamMasukNew,$jamKeluarNew){
    $masukNew = strtotime($jamMasukNew);
    $keluarNew = strtotime($jamKeluarNew);

    foreach($dataJamDB as $j){
      if($masukNew < strtotime($j->jam_selesai) && $keluarNew > strtotime($j->jam_mulai)){
        return true;
      }
    }
    
    //tidak bentrok
    return false;
  }
}

//id user
function auth_id(){
  return session()->get('id_user');
}

function role(){
  return session()->get('role');
}

function auth_pengguna(){
  return session()->get('idPengguna');
}