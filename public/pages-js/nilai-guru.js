
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
  var nameUri = 'nilai';

  function resetForm(){
    $("#id-jadwal,#thajaran, #mata-pelajaran, #siswa, #uts, #uas").val('');
    $("textarea[name=keterangan]").val('');
  }

  var myModal = document.getElementById('form-modal');
    myModal.addEventListener('hidden.bs.modal', function () {
      // Reset semua input di modal
      $("textarea[name=keterangan]").val('');
      myModal.querySelectorAll('input[type=text],input[type=hidden],input[type=number]').forEach(function(input) {
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
    $('#title-modal').html("Form Tambah Nilai");
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
        "mata_pelajaran":$('#mata-pelajaran').val(),
        "siswa":$('#siswa').val(),
        "keterangan":$('#keterangan').val(),
        "nilai_uts":$('#uts').val(),
        "nilai_uas":$('#uas').val()
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
        if(data.errors.siswa !== undefined){
          data.errors.siswa.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nilai_uts !== undefined){
          data.errors.nilai_uts.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nilai_uas !== undefined){
          data.errors.nilai_uas.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.keterangan !== undefined){
          data.errors.keterangan.forEach(el => {
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
        $('#siswa option:selected').text(),
        $('#uts').val(),
        $('#uas').val(),
        (parseInt($('#uts').val()) + parseInt($('#uas').val()) )/2,
        $('#keterangan').val(),

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
          item.nama_siswa,
          item.nilai_uts,
          item.nilai_uas,
          (parseInt(item.nilai_uts) + parseInt(item.nilai_uas)) / 2,
          item.keterangan,
          action(item.id_nilai)
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
      
      $('#id-nilai').val(data.data.id_nilai);
      $('#thajaran').val(data.data.th_ajaran_id);
      $('#mata-pelajaran').val(data.data.mata_pelajaran_id);
      $('#siswa').val(data.data.siswa_id);
      $('#uts').val(data.data.nilai_uts);
      $('#uas').val(data.data.nilai_uas);
      $('#keterangan').val(data.data.keterangan);

      $('#title-modal').html("Form Update nilai");
      $('#btn-modal').html(btnModalUpdate);
      $('#form-modal').modal('show');
    })
    .catch(error => {
      console.error("Error:", error);
    });
  })

  $("#btn-modal").on('click','#btn-update',function(){
    // var dataForm = $('#myForm').serialize();
    fetch(API_URL+"/"+nameUri+"/"+$('#id-nilai').val(),{
      method:"PUT",
      headers:{
        "Content-Type":"application/json",
        "Authorization":'Bearer '+TOKEN
      },
      credentials: "include",
      body:JSON.stringify({
        "th_ajaran":$('#thajaran').val(),
        "mata_pelajaran":$('#mata-pelajaran').val(),
        "siswa":$('#siswa').val(),
        "nilai_uts":$('#uts').val(),
        "nilai_uas":$('#uas').val(),
        "keterangan":$('#keterangan').val(),
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
        if(data.errors.siswa !== undefined){
          data.errors.siswa.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nilai_uts !== undefined){
          data.errors.nilai_uts.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.nilai_uas !== undefined){
          data.errors.nilai_uas.forEach(el => {
            err += `${el} <br/>`;
          });
        }
        if(data.errors.keterangan !== undefined){
          data.errors.keterangan.forEach(el => {
            err += `${el} <br/>`;
          });
        }

        myNotify('Opss !!',err,'warning');
        return;
      }
      if(data.statusCode !==200){
        myNotify('Opss !!',`${data.message}`,'warning');
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
    myNotify('Opss!!','fitur delete belum tersedia','warning');
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