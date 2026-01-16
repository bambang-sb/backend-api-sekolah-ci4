
$(document).ready(function () {
  var table = $('#table-data').DataTable({
            columnDefs: [{
              className:'dt-center',
              targets: 0, // Kolom nomor (indeks 0)
              render: function(data, type, row, meta) {
                  return meta.row + 1; // Nomor berurut dari 1 berdasarkan posisi baris
              }
            },{
              className:'dt-left',
              targets: 1,// Kolom 2
              
            }
        ],
        paging: true, // Opsional: Nonaktifkan paging jika ingin semua data terlihat
        searching: true // Opsional: Sesuaikan fitur lainnya
  });
  
  //nama endpoint
  var nameUri = 'jadwal';

  function resetForm(){
    $("#id-jadwal, #mata-pelajaran, #guru, #kelas, #jam-mulai, #jam-selesai").val('');
    $("input[name=hari]:checked").prop('checked',false)
  }

  var myModal = document.getElementById('form-modal');
    myModal.addEventListener('hidden.bs.modal', function () {
      // Reset semua input di modal
      $("input[name=hari]:checked").prop('checked',false)
      $("#mata-pelajaran, #guru, #kelas").val('n');
      $("#id-jadwal").val('');
      myModal.querySelectorAll('input[type=text],input[type=hidden],input[type=time]').forEach(function(input) {
        input.value = '';
      });
  });

  var btnModalCreate = `<button
                      type="button"
                      id="btn-simpan"
                      class="btn btn-primary btn-sm rounded-2"
                    >
                      Simpan
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm rounded-2"
                      data-bs-dismiss="modal"
                    >
                      Batal
                    </button>`;
  var btnModalUpdate = `<button
                      type="button"
                      id="btn-update"
                      class="btn btn-primary btn-sm rounded-2"
                    >
                      Perbaharui
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm rounded-2"
                      data-bs-dismiss="modal"
                    >
                      Batal
                    </button>`;

  function action(id){
    var action = `<div class="form-button">
      <button
        style="border:none; background:none;color:#1572e8"
        title=""
        class="btn-edit"
        data-set='${id}'
        >
        <i class="fa fa-edit perbaharui" style="font-size:20px"></i>
      </button>
      &nbsp;
      <button
        style="border:none; background:none;color:#1572e8"
        class="btn-hapus"
        data-set="${id}"
        data-bs-toggle="tooltip"
        title=""
        data-original-title="Remove"
        >
        <i class="fa fa-trash hapus" style="font-size:20px;"></i>
      </button>
    </div>`;
    return action;
  }

  $("#btn-tambah").click(function(){
    $('#title-modal').html("Form Tambah Jadwal");
    $('#btn-modal').html(btnModalCreate);
    $('#form-modal').modal('show');
  });

  //Simpan Data
  $("#btn-modal").on('click','#btn-simpan',(function () {
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
        "th_ajaran":$('#thajaran').val(),
        "guru":$('#guru').val(),
        "mata_pelajaran":$('#mata-pelajaran').val(),
        "kelas_aktif":$('#kelas').val(),
        "hari":$('input[name=hari]:checked').val(),
        "jam_mulai":$('#jam-mulai').val(),
        "jam_selesai":$('#jam-selesai').val(),
      })
    })
    .then(response => response.json())
    .then((data) => {
      
      if(data.message == 'Validation Failed'){
        var err = '';
        if(data.errors.th_ajaran !== undefined){
          data.errors.th_ajaran.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.mata_pelajaran !== undefined){
          data.errors.mata_pelajaran.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.guru !== undefined){
          data.errors.guru.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.kelas !== undefined){
          data.errors.kelas.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.hari !== undefined){
          data.errors.hari.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.jam_mulai !== undefined){
          data.errors.jam_mulai.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.jam_selesai !== undefined){
          data.errors.jam_selesai.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }

      if(data.statusCode !==201){
        // var inputFM = $('#nip').val();
        myNotify('Opss !!',`${data.message}`,'warning');
        return;
      }
      $("#form-modal").modal("hide");
      //tambah data ke tabel
      var currentData = table.rows().data().toArray();
      currentData.unshift([
        null,
        $('#thajaran option:selected').text(),
        $('#mata-pelajaran option:selected').text(),
        $('#kelas option:selected').text(),
        $('#guru option:selected').text(),
        hariFormat($('input[name=hari]:checked').val()),
        $('#jam-mulai').val(),
        $('#jam-selesai').val(),
        action(data.data.id)]); // null untuk kolom nomor, yang akan dirender otomatis
      
      table.clear();
      table.rows.add(currentData);
      table.draw();
      resetForm();
      myNotify('Success','Simpan data berhasil','primary');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  }));

  //getAll Data
  function getAllData() {
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
      var row = [];
      data.forEach(item => {
        // var currentData = table.rows().data().toArray();
        row.push([
          null,
          item.th_ajaran,
          item.pelajaran,
          item.level+''+item.nama_kelas,
          item.nama_guru,
          hariFormat(item.hari),
          item.jam_mulai,
          item.jam_selesai,
          action(item.id_jadwal)
        ]); // null untuk kolom nomor, yang akan dirender otomatis
      });
      table.clear();
      table.rows.add(row);
      table.draw();
        
    })
    .catch(error => {
      console.error("Error:", error);
    });
  }

  getAllData();

  
  $("#data-tabel").on('click','.btn-edit',function(){
    var id = $(this).data("set");
    fetch(API_URL+"/"+nameUri+"/"+id,{
      method:"GET",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
    })
    .then(response => response.json())
    .then((data) => {
      
      $('#id-jadwal').val(data.data.id_jadwal);
      $('#thajaran').val(data.data.th_ajaran_id);
      $('#mata-pelajaran').val(data.data.mata_pelajaran_id);
      $('#kelas').val(data.data.kelas_aktif_id);
      $('#guru').val(data.data.guru_id);
      $('input[name=hari][value="'+data.data.hari+'"]').prop('checked',true);
      $('#jam-mulai').val(data.data.jam_mulai);
      $('#jam-selesai').val(data.data.jam_selesai);

      $('#title-modal').html("Form Update Jadwal");
      $('#btn-modal').html(btnModalUpdate);
      $('#form-modal').modal('show');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  })

  $("#btn-modal").on('click','#btn-update',function(){
    // var dataForm = $('#myForm').serialize();
    fetch(API_URL+"/"+nameUri+"/"+$('#id-jadwal').val(),{
      method:"PUT",
      headers:{
        "Content-Type":"application/json"
      },
      credentials: "include",
      body:JSON.stringify({
        "th_ajaran":$('#thajaran').val(),
        "guru":$('#guru').val(),
        "mata_pelajaran":$('#mata-pelajaran').val(),
        "kelas_aktif":$('#kelas').val(),
        "hari":$('input[name=hari]:checked').val(),
        "jam_mulai":$('#jam-mulai').val(),
        "jam_selesai":$('#jam-selesai').val(),
      })
    })
    .then(response => response.json())
    .then((data) => {
      if(data.message == 'Validation Failed'){
        var err = '';
        if(data.errors.th_ajaran !== undefined){
          data.errors.th_ajaran.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.mata_pelajaran !== undefined){
          data.errors.mata_pelajaran.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.guru !== undefined){
          data.errors.guru.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.kelas !== undefined){
          data.errors.kelas.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.hari !== undefined){
          data.errors.hari.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.jam_mulai !== undefined){
          data.errors.jam_mulai.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.jam_selesai !== undefined){
          data.errors.jam_selesai.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }
      if(data.statusCode !==200){
        myNotify('Opss !!',`Jadwal Bentrok ! `,'warning');
        return;
      }
      

      getAllData();
      resetForm();
      $("#form-modal").modal("hide");
      myNotify('Success','Perbaharui data berhasil','primary');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  })

  $("#data-tabel").on('click','.btn-hapus',function(){
    var id = $(this).data("set");
    var row = $(this).closest('tr');
     
    if(confirm('Hapus Jadwal ini ??')){
      fetch(API_URL+'/'+nameUri+'/'+id,{
        method:'DELETE',
        headers:{
          "Content-Type":"application/json",
          "Authorization":'Bearer '+TOKEN
        },
        credentials: "include",
      })
      .then(res=>res.json())
      .then(data=>{
        console.log(data)
        table.row(row).remove().draw(false);
        myNotify('success','delete data berhasil...','primary')
      })
      .catch(e=>{
        myNotify('FAIL','Terjadi kesalahan !!','danger')
      })
    }
     
  });

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
});