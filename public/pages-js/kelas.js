
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

  
  function resetForm(){
    $("#kelas, #id-kelas").val('');
    $("#kelas-level").val('n');
  }

  var myModal = document.getElementById('form-modal');
    myModal.addEventListener('hidden.bs.modal', function () {
      // Reset semua input di modal
      myModal.querySelectorAll('input').forEach(function(input) {
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
    $('#title-modal').html("Form Tambah Kelas");
    $('#btn-modal').html(btnModalCreate);
    $('#form-modal').modal('show');
  });

  //Simpan Data
  $("#btn-modal").on('click','#btn-simpan',(function () {
    
    // getAllData();
    //simpan data ke server
    fetch(API_URL+"/kelas",{
      method:"POST",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "nama_kelas":$('#kelas').val(),
        "kelas_level":$('#kelas-level').val()
      })
    })
    .then(response => response.json())
    .then((data) => {
      
      if(data.message == 'Validation Failed'){
        var err = '';
        if(data.errors.kelas_level !== undefined){
          data.errors.kelas_level.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nama_kelas !== undefined){
          data.errors.nama_kelas.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }

      if(data.statusCode !==201){
        myNotify('Opss !!',`Kelas ${$('#kelas-level option:selected').text()+$('#kelas').val()} Sudah ada ! `,'warning');
        return;
      }
      $("#form-modal").modal("hide");
      //tambah data ke tabel
      var currentData = table.rows().data().toArray();
      currentData.unshift([null,$('#kelas-level option:selected').text() ,$('#kelas').val(),action(data.data.id)]); // null untuk kolom nomor, yang akan dirender otomatis
      
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
    console.log(TOKEN)
    fetch(API_URL+"/kelas",{
      method:"GET",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      
    })
    .then(response => response.json())
    .then(doc => {
      let data = doc.data
      var row = [];
      data.forEach(item => {
        // var currentData = table.rows().data().toArray();
        row.push([null,item.level, item.nama_kelas,action(item.id_kelas)]); // null untuk kolom nomor, yang akan dirender otomatis
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
    fetch(API_URL+"/kelas/"+id,{
      method:"GET",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
    })
    .then(response => response.json())
    .then((data) => {
      console.log(data);
      // PERBAIKI EDIT SEBELUM UPDATE
      $('#id-kelas').val(data.data.id_kelas);
      $('#kelas').val(data.data.kelas);
      $('#kelas-level').val(data.data.kelas_level_id);
      $('#title-modal').html("Form Update Kelas");
      $('#btn-modal').html(btnModalUpdate);
      $('#form-modal').modal('show');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  })

  $("#btn-modal").on('click','#btn-update',function(){
    fetch(API_URL+"/kelas/"+$('#id-kelas').val(),{
      method:"PUT",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "nama_kelas":$('#kelas').val(),
        "kelas_level":$('#kelas-level').val()
      })
    })
    .then(response => response.json())
    .then((data) => {
      if(data.message == 'Validation Failed'){
        var err = '';
        if(data.errors.kelas_level !== undefined){
          data.errors.kelas_level.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nama_kelas !== undefined){
          data.errors.nama_kelas.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }
      if(data.statusCode !==200){
        myNotify('Opss !!',`Kelas ${$('#kelas-level option:selected').text()+$('#kelas').val()} Sudah ada ! `,'warning');
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
    myNotify('Opps!','Fitur Hapus belum tersedia','warning');
     
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