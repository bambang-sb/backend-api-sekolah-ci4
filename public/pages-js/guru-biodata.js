
$(document).ready(function () {
  
  //nama endpoint
  var nameUri = 'guru/biodata';

  //Simpan Data
  $("#btn-simpan").click(function () {
    //simpan data ke server
    
    // var dataForm = $('#myForm').serialize();
    fetch(API_URL+"/"+nameUri,{
      method:"POST",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "nip":$('#nip').val(),
        "nama":$('#nama').val(),
        "alamat":$('#alamat').val(),
        "tgl_lahir":$('#tgl-lahir').val(),
        "telp":$('#telp').val(),
        "jk":$('input[name=jk]:checked').val(),
        "email":$('#email').val(),
      })
    })
    .then(response => response.json())
    .then((data) => {
      if(data.message == 'Validation Failed'){
        var err = '';
        if(data.errors.nisn !== undefined){
          data.errors.nisn.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nama !== undefined){
          data.errors.nama.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.tgl_lahir !== undefined){
          data.errors.tgl_lahir.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        
        if(data.errors.alamat !== undefined){
          data.errors.alamat.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.telp !== undefined){
          data.errors.telp.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }

      if(data.statusCode !==201){
        
        myNotify('Opss !!',`${data.message}`,'warning');
        return;
      }
      
      myNotify('Success','biodata diperbaharui','primary');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  });

  //getAll Data
  function getBiodata() {
    fetch(API_URL+"/"+nameUri,{
      method:"GET",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
    })
    .then(response => response.json())
    .then(doc => {
      let data = doc.data
      if(data !== null){
        $('#nip').val(data.nip);
        $('#nama').val(data.nama);
        $('#alamat').val(data.alamat);
        $('#tgl-lahir').val(data.tgl_lahir);
        $('input[name=jk][value="'+data.jk+'"]').prop('checked',true);
        $('#telp').val(data.telp);
        $('#email').val(data.email);
      }
    })
    .catch(error => {
      console.error("Error:", error);
    });
  }

  getBiodata();

});