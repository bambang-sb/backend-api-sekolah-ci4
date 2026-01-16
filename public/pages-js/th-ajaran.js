
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
    $("#thajaran, #id-thajaran").val('');
    $("input[name=semester]").prop('checked',false);
  }

  var myModal = document.getElementById('form-modal');
    myModal.addEventListener('hidden.bs.modal', function () {
      // Reset semua input di modal
      $("input[name='semester']").prop('checked',false);
      myModal.querySelectorAll('input[type=text]').forEach(function(input) {
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

  var nameUri = 'thajaran';

  $("#btn-tambah").click(function(){
    $('#title-modal').html("Form Tambah Th Ajaran");
    $('#btn-modal').html(btnModalCreate);
    $('#form-modal').modal('show');
  });

  //aktifkan th ajaran semster
  function thAjaranSemesterAktif(isAktive,id,thajaran,semester){
    
    return `<button
            data-aktif-id=${id}
            data-aktif=${isAktive}
            data-thajaran=${thajaran}
            data-semester=${semester}
            class='badge ${isAktive=="t"?"bg-primary":"bg-danger"} btn-${isAktive}-thajaran'
            >${activeFormat(isAktive)}</button>`;
  }

  //untuk non aktifkan th ajaran
  $('#data-tabel').on('click','.btn-t-thajaran',(function(e){
    e.preventDefault();
    var idThajaran = $(this).data('aktif-id');
    var thajaran = $(this).data('thajaran');
    var semester = $(this).data('semester');
    var confirmAktif = window.confirm(`Non Aktifkan Th Ajaran ${thajaran} - ${semester} ?`)
    if(confirmAktif){
      fetch(API_URL+"/"+nameUri+"/nonaktif/"+idThajaran,{
        method:"PUT",
        headers:{
          "Content-Type":"application/json",
          "Authorization":'Bearer '+TOKEN
        },
        credentials: "include",
      })
      .then(res=>res.json())
      .then(data=>{
        getAllData();
      })
      .catch(e=>{
        console.log('gagal '+e)
      }) 
    }
  }))

  //untuk aktifkan th ajaran
  $('#data-tabel').on('click','.btn-f-thajaran',(function(e){
    e.preventDefault();
    var idThajaran = $(this).data('aktif-id');
    var thajaran = $(this).data('thajaran');
    var semester = $(this).data('semester');
    var confirmAktif = window.confirm(`Aktifkan Th Ajaran ${thajaran} - ${semester} ?`)
    if(confirmAktif){
      fetch(API_URL+"/"+nameUri+"/aktif/"+idThajaran,{
        method:"PUT",
        headers:{
          "Content-Type":"application/json",
          "Authorization":'Bearer '+TOKEN
        },
        credentials: "include",
      })
      .then(res=>res.json())
      .then(data=>{
        if(data.statusCode == 409){
          myNotify('Opss !!',`${data.message}`,'warning');
          return;
        }
        getAllData();
      })
      .catch(e=>{
        console.log('gagal '+e)
      }) 
    }
  }))

  //Simpan Data
  $("#btn-modal").on('click','#btn-simpan',(function () {
    
    // getAllData();
    //simpan data ke server
    fetch(API_URL+"/"+nameUri,{
      method:"POST",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "thajaran":$('#thajaran').val(),
        "semester":$('input[name="semester"]:checked').val()
      })
    })
    .then(response => response.json())
    .then((data) => {
      
      if(data.message == 'Validation Failed'){
        var err = '';
        if(data.errors.thajaran !== undefined){
          data.errors.thajaran.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.semester !== undefined){
          data.errors.semester.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }

      if(data.statusCode !==201){
        // var inputData = $('#thajaran').val()+" \ "+semesterFormat($('input[name="semester"]:checked').val());
        myNotify('Opss !!',`${data.message}`,'warning');
        return;
      }
      $("#form-modal").modal("hide");
      //tambah data ke tabel langsung
      // var currentData = table.rows().data().toArray();
      // currentData.unshift([
      //   null,
      //   $('#thajaran').val()
      //   ,$('input[name="semester"]:checked').val()==0?'Ganjil':'Genap',
      //   thAjaranSemesterAktif(
      //     'f',
      //     data.data.id,
      //     $('#thajaran').val(),
      //     $('input[name="semester"]:checked').text()
      //   ),
      //   action(data.data.id)]); // null untuk kolom nomor, yang akan dirender otomatis
      
      // table.clear();
      // table.rows.add(currentData);
      // table.draw();

      resetForm();
      myNotify('Success','Simpan data berhasil','primary');
      getAllData()
    })
    .catch(error => {
      console.error("Error:", error);
    });
  }));

  //getAll Data
  function getAllData() {
    fetch(API_URL+"/thajaran",{
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
          semesterFormat(item.semester),
          thAjaranSemesterAktif(
            item.is_active,
            item.id_th_ajaran,
            item.th_ajaran,
            semesterFormat(item.semester)
          ),
          action(item.id_th_ajaran)
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
    fetch(API_URL+"/thajaran/"+id,{
      method:"GET",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
    })
    .then(response => response.json())
    .then((data) => {
      
      $('#id-thajaran').val(data.data.id_th_ajaran);
      $('#thajaran').val(data.data.th_ajaran);
      $('input[name="semester"][value="'+data.data.semester+'"]').prop('checked',true);
      $('#title-modal').html("Form Update Update Th Ajaran");
      $('#btn-modal').html(btnModalUpdate);
      $('#form-modal').modal('show');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  })

  $("#btn-modal").on('click','#btn-update',async function(){
    const res = await fetch(API_URL+"/thajaran/"+$('#id-thajaran').val(),{
      method:"PUT",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "thajaran":$('#thajaran').val(),
        "semester":$('input[name="semester"]:checked').val()
      })
    });
    
    if(res.status === 200){
      getAllData();
      resetForm();
      $("#form-modal").modal("hide");
      myNotify('Success','Perbaharui data berhasil','primary');
      return null;
    }

    var data = await res.json();
    
    if(res.status === 422){
      var err = '';
      if(data.errors.thajaran !== undefined){
          data.errors.thajaran.forEach(el => {
            err += `${el} <br/>`;
          });
      }
      if(data.errors.semester !== undefined){
        data.errors.semester.forEach(el => {
          err += `${el} <br/>`;
        });
      }
      myNotify('Opss !!',err,'warning');
      return null;
    }

    if(res.status === 409){
      myNotify('Opss !!',`${data.message}`,'warning');
      return null;
    }
    
    if(!res.ok){
      $("#form-modal").modal("hide");
      myNotify('Opss!!','Something wrong!!','danger');
      return null;
    }
   
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