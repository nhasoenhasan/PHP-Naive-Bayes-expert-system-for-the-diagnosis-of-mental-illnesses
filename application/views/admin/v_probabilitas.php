
 <div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header ">
            Daftar Probabilitas
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <div align="right">
            <button  class="btn btn-success m-2 " onclick="V_Tambah()" >Tambah<span class="fas fa-plus ml-1"></span></button>
            </div>
             
                <table id="tabel-data" class="table table-striped " width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr >
                            <th style="width:5%" class="text-center">No</th>
                            <th style="width:25%" class="text-center">Kode Gejala</th>
                            <th style="width:25%" class="text-center">Kode Penyakit</th>
                            <th style="width:25%" class="text-center">Nilai Probabilitas</th>
                            <th style="width:25%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                
                    <tbody id="show_data">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
  
<!----------------------------------------------------------------Java Script---------------------------------------------->
<script type="text/javascript">
    $(document).ready(function(){
      tampil_data_probabilitas();
      $('#tabel-data').DataTable();
    });
    
    function tampil_data_probabilitas() {
      $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo base_url()?>index.php/probabilitas/data_probabilitas',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].Id_Gejala+'</td>'+
		                        '<td class="text-center">'+data[i].Id_Penyakit+'</td>'+
                            '<td class="text-center">'+data[i].nilai+'</td>'+
		                        '<td style="text-align:center;">'+
                                    '<a href="javascript:;" class="btn btn-warning btn-xs item_edit fas fa-edit" onclick="V_Edit('+data[i].Id_Probabilitas+')" ></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus fas fa-trash-alt" onclick="V_Hapus('+data[i].Id_Probabilitas+')"></a>'+
                                '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }
		    });
    }

   function  V_Tambah(){
      $('#tambahform')[0].reset();
      $('.text-danger').empty(); 
      $('.form-control').removeClass('is-invalid');
      $('.form-control').removeClass('is-valid');
      var data2= $.ajax({
          url : "<?php echo site_url('Probabilitas/tampil_data_penyakit')?>/" ,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            $('[name="KodePenyakit"]').empty();
            $('[name="KodePenyakit"]').append("<option selected> Pilih Penyakit</option>");
            $.each(data, function (i, item) {
                $('[name="KodePenyakit"]').append('<option value="' + data[i].Id_Penyakit+  '"  >' + data[i].Id_Penyakit + '</option>');

            });
            $('#Add').modal('show'); 
          }
        });
      var data1= $.ajax({
          url : "<?php echo site_url('Probabilitas/tampil_data_gejala')?>/" ,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            $('[name="KodeGejala"]').empty();
            $('[name="KodeGejala"]').append("<option selected> Pilih Gejala</option>");
            $.each(data, function (i, item) {
                $('[name="KodeGejala"]').append('<option value="' + data[i].Id_Gejala+  '"  >' + data[i].Id_Gejala + '</option>');

            });
            $('#Add').modal('show'); 
          }
        });
    }

    function  V_Hapus(id){
      $('#hapusform')[0].reset();
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Probabilitas/get_edit_probabilitas')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id"]').val(data.Id_Probabilitas);
          $('#hapus').modal('show'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
    }

    function  V_Edit(id){
      $('#editform')[0].reset();
      $('.text-danger').empty(); 
      $('.form-control').removeClass('is-invalid');
      $('.form-control').removeClass('is-valid');
      //Ajax Load data from ajax
      var a=$.ajax({
        url : "<?php echo site_url('Probabilitas/get_edit_probabilitas')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id"]').val(data.Id_Probabilitas);
          $('[name="KodePenyakit"]').empty();
          $('[name="KodeGejala"]').empty();
          $('[name="KodeGejala"]').append('<option value="' + data.Id_Gejala+  '" selected> ' + data.Id_Gejala + '</option>');
          $('[name="KodePenyakit"]').append('<option value="' + data.Id_Penyakit+  '"  >' + data.Id_Penyakit + '</option>');
          $('[name="Probabilitas"]').val(data.nilai);
          $.ajax({
            url : "<?php echo site_url('Probabilitas/tampil_data_gejala')?>/" ,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              $.each(data, function (i, item) {
                  $('[name="KodeGejala"]').append('<option value="' + data[i].Id_Gejala+  '"  >' + data[i].Id_Gejala + '</option>');
              });
              $.ajax({
                url : "<?php echo site_url('Probabilitas/tampil_data_penyakit')?>/" ,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                  $.each(data, function (i, item) {
                      $('[name="KodePenyakit"]').append('<option value="' + data[i].Id_Penyakit+  '"  >' + data[i].Id_Penyakit + '</option>');
                  });
                   
                }
              });
            
            }
          });
          
          
        }
      });
        $('#Edit').modal('show'); 
    }

    


    function ubahprobabilitas()
    { 
      var url;
      url = "<?php echo site_url('Probabilitas/ubah')?>";
      // ajax adding data to database
      var formData = new FormData($('#editform')[0]);
      $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
          {
            if(data.status) //if success close modal and reload ajax table
              {
                $("#Edit").modal("hide");
                tampil_data_probabilitas();
              }
            else
              {
                $('.help-block').text('Email Sudah Di Gunakan');
              }
          }
        });
    }

      function tambahpenyakit()
      {
        var url;
        url = "<?php echo site_url('Probabilitas/tambah')?>";
        // ajax adding data to database
        var formData = new FormData($('#tambahform')[0]);
        $.ajax({
          url : url,
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
            {
              if(data.status) //if success close modal and reload ajax table
                {
                  $("#Add").modal("hide");
                  tampil_data_probabilitas();
                }
              else
                {
                  $('.help-block-kodegejala').text(data.Wgejala);
                  $('.help-block-kodepenyakit').text(data.Wpenyakit);
                  $('.help-block-probabilitas').text(data.Wprobabilitas);

                  document.getElementById("KodeGejala").className=data.csskgejala;
                  document.getElementById("KodePenyakit").className=data.csskpenyakit;
                  document.getElementById("Probabilitas").className=data.cssprobabilitas;
                }
            }
          });
      }
      function hapusprobabilitas()
      { 
        var url;
        url = "<?php echo site_url('Probabilitas/hapus')?>";
        // ajax adding data to database
        var formData = new FormData($('#hapusform')[0]);
        $.ajax({
          url : url,
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
            {
              if(data.status) //if success close modal and reload ajax table
                {
                  $("#hapus").modal("hide");
                  tampil_data_probabilitas();
                }
              else
                {
                  $('.help-block-email').text('Email Sudah Di Gunakan');
                  
                }
            }
          });
      }

      function cekgejala(data) {
        if(data==''){
          document.getElementById("KodeGejala").className=("form-control is-invalid");
          $('.help-block-kodegejala').text('Kode Gejala Harus Di Isi');
        }
        if(data=='Pilih Gejala'){
          document.getElementById("KodeGejala").className=("form-control is-invalid");
          $('.help-block-kodegejala').text('Kode Gejala Harus Di Isi');
        }else{
          document.getElementById("KodeGejala").className=("form-control is-valid");
          $('.help-block-kodegejala').text('');
        }
      }

      function cekpenyakit(data) {
        if(data==''){
          document.getElementById("KodePenyakit").className=("form-control is-invalid");
          $('.help-block-kodepenyakit').text('Kode Penyakit Harus Di Isi');
        }
        if(data=='Pilih Penyakit'){
          document.getElementById("KodePenyakit").className=("form-control is-invalid");
          $('.help-block-kodepenyakit').text('Kode Penyakit Harus Di Isi');
        }else{
          document.getElementById("KodePenyakit").className=("form-control is-valid");
          $('.help-block-kodepenyakit').text('');
        }
      }

      function cekprobabilitas(data) {
        if(data==''){
          document.getElementById("Probabilitas").className=("form-control is-invalid");
          $('.help-block-probabilitas').text('Nilai Probabilitas Harus Di Isi');
        }else{
          document.getElementById("Probabilitas").className=("form-control is-valid");
          $('.help-block-probabilitas').text('');
        }
      }

      
</script>

<!----------------------------------------------------------------Modal TAMBAH---------------------------------------------->
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Tambah Probabilitas</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="tambahform"  >
                <div class="form-group ">
                    <label  class="font-weight-bold">Kode Gejala</label>
                    <select class=" form-control" onchange="cekgejala(this.value)"  id="KodeGejala"  name="KodeGejala" required>
                    </select>
                    <span class="help-block-kodegejala text-danger"></span>
                </div>
                <div class="form-group ">
                    <label  class="font-weight-bold">Kode Penyakit</label>
                    <select class="form-control"  id="KodePenyakit" onchange="cekpenyakit(this.value)" name="KodePenyakit" required>
                    
                    </select>
                    <span class="help-block-kodepenyakit text-danger"></span>
                </div>
                <div class="form-group">
                    <label  class="font-weight-bold">Nilai Probabilitas</label>
                    <input class="form-control" id="Probabilitas" oninput="cekprobabilitas(this.value)" name="Probabilitas" placeholder="Masukan Nilai Probabilitas" required>
                    <span class="help-block-probabilitas text-danger"></span>
                </div>
                </div>
                <div class="modal-footer " >
                  <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button" onclick="tambahpenyakit()" class="btn btn-success" >Kirim</button>
              </div>
        </form>
    </div>
  </div>
</div>
<!----------------------------------------------------------------Modal EDIT ---------------------------------------------->
<div class="modal fade ModalEdit" id="Edit"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Ubah Data Probabilitas</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="editform"  >
                <input type="hidden" value="" name="id"/>
                <div class="form-group ">
                    <label  class="font-weight-bold">Kode Gejala</label>
                    <select class=" form-control"  id="Kode"  name="KodeGejala" required>
                    
                    </select>
                    <span class="help-block-kodegejala text-danger"></span>
                </div>
                <div class="form-group ">
                    <label  class="font-weight-bold">Kode Penyakit</label>
                    <select class="form-control"  id="KodePenyakit" onchange="cekpenyakit(this.value)" name="KodePenyakit" required>
                    
                    </select>
                    <span class="help-block-kodepenyakit text-danger"></span>
                </div>
                <div class="form-group">
                    <label  class="font-weight-bold">Nilai Probabilitas</label>
                    <input class="form-control is-invalid" id="Probabilitas" oninput="cekprobabilitas(this.value)" name="Probabilitas" placeholder="Masukan Nilai Probabilitas" required>
                    <span class="help-block-probabilitas text-danger"></span>
                </div>
                </div>
                <div class="modal-footer " >
                  <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button" onclick="ubahprobabilitas()" class="btn btn-success" >Kirim</button>
              </div>
        </form>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-sm" tabindex="-1" id="hapus" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header " >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="text-center modal-title"></h2> </div>
      <div class="modal-body form text-center">
      <h3 class=" modal-title " >Apakah Anda Yakin?</h3>
        <span class="fas fa-exclamation-triangle fa-5x"></span>
      <form action="#" id="hapusform" class="form-horizontal">
        <input  type="hidden" value="" name="id"/>
      </form>
    </div>
    <div class="modal-footer justify-content-between px-5" >
      <button type="button" class="btn btn-success"  style= "float: center;" data-dismiss="modal">Batal</button>
      <button type="button" id="btnSave" onclick="hapusprobabilitas()" class="btn btn-danger">Hapus</button>
    </div>
    </div>
  </div>
</div>


 