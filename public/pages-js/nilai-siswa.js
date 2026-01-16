
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
  var nameUri = 'siswa/nilai';

  

  

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
      if(doc.statusCode == 400){
        myNotify('warning !!',doc.message,'warning');
        return null;
      }
      let data = doc.data
      
      var row = [];
      data.forEach(item => {
        // var currentData = table.rows().data().toArray();
        row.push([
          null,
          item.th_ajaran,
          item.pelajaran,
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
      myNotify('Warning !!',error,'danger');
      console.error("Error:", error);
    });
  }

  getAllData();

  
  // $("#data-tabel").on('click','.btn-edit',function(){
  //   var id = $(this).data("set");
  //   fetch(API_URL+"/"+nameUri+"/"+id,{
  //     method:"GET",
  //     headers:{
  //       "Content-Type":"application/json",
  //       "Authorization":'Bearer '+TOKEN
  //     },
  //     credentials: "include",
  //   })
  //   .then(response => response.json())
  //   .then((data) => {
      
  //     $('#id-nilai').val(data.data.id_nilai);
  //     $('#thajaran').val(data.data.th_ajaran_id);
  //     $('#mata-pelajaran').val(data.data.mata_pelajaran_id);
  //     $('#siswa').val(data.data.siswa_id);
  //     $('#uts').val(data.data.nilai_uts);
  //     $('#uas').val(data.data.nilai_uas);
  //     $('#keterangan').val(data.data.keterangan);

  //     $('#title-modal').html("Form Update nilai");
  //     $('#btn-modal').html(btnModalUpdate);
  //     $('#form-modal').modal('show');
  //   })
  //   .catch(error => {
  //     console.error("Error:", error);
  //   });
  // })

  // $("#btn-modal").on('click','#btn-update',function(){
  //   // var dataForm = $('#myForm').serialize();
  //   fetch(API_URL+"/"+nameUri+"/"+$('#id-nilai').val(),{
  //     method:"PUT",
  //     headers:{
  //       "Content-Type":"application/json",
  //       "Authorization":'Bearer '+TOKEN
  //     },
  //     credentials: "include",
  //     body:JSON.stringify({
  //       "th_ajaran":$('#thajaran').val(),
  //       "mata_pelajaran":$('#mata-pelajaran').val(),
  //       "siswa":$('#siswa').val(),
  //       "nilai_uts":$('#uts').val(),
  //       "nilai_uas":$('#uas').val(),
  //       "keterangan":$('#keterangan').val(),
  //     })
  //   })
  //   .then(response => response.json())
  //   .then((data) => {
      
  //     if(data.message == 'Validation Failed'){
  //       var err = '';
  //       if(data.errors.th_ajaran !== undefined){
  //         data.errors.th_ajaran.forEach(el => {
  //           err += `${el} <br/>`;
  //         });
  //       }
  //       if(data.errors.mata_pelajaran !== undefined){
  //         data.errors.mata_pelajaran.forEach(el => {
  //           err += `${el} <br/>`;
  //         });
  //       }
  //       if(data.errors.siswa !== undefined){
  //         data.errors.siswa.forEach(el => {
  //           err += `${el} <br/>`;
  //         });
  //       }
  //       if(data.errors.nilai_uts !== undefined){
  //         data.errors.nilai_uts.forEach(el => {
  //           err += `${el} <br/>`;
  //         });
  //       }
  //       if(data.errors.nilai_uas !== undefined){
  //         data.errors.nilai_uas.forEach(el => {
  //           err += `${el} <br/>`;
  //         });
  //       }
  //       if(data.errors.keterangan !== undefined){
  //         data.errors.keterangan.forEach(el => {
  //           err += `${el} <br/>`;
  //         });
  //       }

  //       myNotify('Opss !!',err,'warning');
  //       return;
  //     }
  //     if(data.statusCode !==200){
  //       myNotify('Opss !!',`${data.message}`,'warning');
  //       return;
  //     }
      

  //     getAllData();
  //     resetForm();
  //     $("#form-modal").modal("hide");
  //     myNotify('Success','Perbaharui data berhasil','primary');
  //   })
  //   .catch(error => {
  //     console.error("Error:", error);
  //   });
  // })

  // $("#data-tabel").on('click','.btn-hapus',function(){
  //   var id = $(this).data("set");
  //   myNotify('Opss!!','fitur delete belum tersedia','warning');
  // });

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