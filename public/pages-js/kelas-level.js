
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
    $("#level, #id-level").val('');
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
    $('#title-modal').html("Form Tambah Kelas Level");
    $('#btn-modal').html(btnModalCreate);
    $('#form-modal').modal('show');
  });

  //Simpan Data
  $("#btn-modal").on('click','#btn-simpan',(function () {
    
    // getAllData();
    //simpan data ke server
    fetch(API_URL+"/kelas-level",{
      method:"POST",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "level":$('#level').val()
      })
    })
    .then(response => response.json())
    .then((data) => {
      if(data.message == 'Validation Failed'){
        var err = '';
        data.errors.level.forEach(element => {
          err += element + '<br>';
        });
        myNotify('Opss !!',err,'warning');
        return;
      }
      if(data.statusCode !==201){
        myNotify('Opss !!',data.message,'warning');
        return;
      }
      $("#form-modal").modal("hide");
      //tambah data ke tabel
      var currentData = table.rows().data().toArray();
      currentData.unshift([null, $('#level').val(),action(data.id)]); // null untuk kolom nomor, yang akan dirender otomatis
      
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
    fetch(API_URL+"/kelas-level",{
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
        row.push([null, item.level,action(item.id_kelas_level)]); // null untuk kolom nomor, yang akan dirender otomatis
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
    fetch(API_URL+"/kelas-level/"+id,{
      method:"GET",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
    })
    .then(response => response.json())
    .then((data) => {
      
      $('#id-level').val(data.data.id_kelas_level);
      $('#level').val(data.data.level);
      $('#title-modal').html("Form Update Kelas Level");
      $('#btn-modal').html(btnModalUpdate);
      $('#form-modal').modal('show');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  })

  $("#btn-modal").on('click','#btn-update',function(){
    fetch(API_URL+"/kelas-level/"+$('#id-level').val(),{
      method:"PUT",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "level":$('#level').val()
      })
    })
    .then(response => response.json())
    .then((data) => {
      
      if(data.statusCode !==200){
        alert(data.message);
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