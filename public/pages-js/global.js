const API_URL = "http://localhost:8080/api";
const URL = "http://localhost:8080";
const TOKEN = localStorage.getItem('token');

var logout = document.getElementById('logout');
if(logout !== null){

  logout.addEventListener('click',async function(){
    try {
      
      await fetch(API_URL+'/user/logout',{
        method:"GET",
        headers:{
          "Content-Type":"application/json",
          "Authorization":'Bearer '+TOKEN
        },
        credentials: "include",
      });
      localStorage.removeItem('token');
      location.href=URL
    } catch (error) {
      alert('err');
    }
  })
}

function semesterFormat(value) {
  return value == 1 ? "Ganjil" : "Genap";
}

function activeFormat(value) {
  return value == 't' ? "Active" : "Non Active";
}

function hariFormat(value){
  var hr = ['Senin','Selasa','Rabu','Kamis','Jum`at','Sabtu'];
  return hr[value-1];
}

function myNotify(title,message, type) {
  var content = {};
      content.message = message;
      content.title = title;
      content.icon = "fa fa-bell";
  $.notify(content, {
    type: type,
    placement: {
      from: 'top',
      align: 'right',
    },
    z_index: 99999,
    time: 1000,
    delay: 2000,
  });
} 