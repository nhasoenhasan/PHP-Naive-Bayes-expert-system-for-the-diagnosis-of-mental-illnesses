
 <div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header ">
            Daftar Penyakit
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <div align="right">
            <button  class="btn btn-success m-2 " onclick="V_Tambah()" >Tambah<span class="fas fa-plus ml-1"></span></button>
            </div>
             
                <table id="tabel-data" class="table table-striped " width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr >
                            <th style="width:5% display:block">No</th>
                            <th style="width:5%">Kode </th>
                            <th style="width:15%" class="text-center">Nama Penyakit</th>
                            <th style="width:23%" class="text-center">Informasi</th>
                            <th style="width:20%" class="text-center">Saran</th>
                            <th style="width:5%">Probabilitas</th>
                            <th style="width:13%" >Aksi</th>
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
      tampil_data_penyakit();
      $('#tabel-data').DataTable();
    });
    var i;
    function tampil_data_penyakit() {
      $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo base_url()?>index.php/penyakit/data_penyakit',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td>'+data[i].Id_Penyakit+'</td>'+
                            '<td style="word-break: break-all;"s>'+data[i].Nama_Penyakit+'</td>'+
		                        '<td style="word-break: break-all;">'+data[i].Informasi+'</td>'+
		                        '<td style="word-break: break-all;">'+data[i].Saran+'</td>'+
                            '<td>'+data[i].P_penyakit+'</td>'+
		                        '<td style="text-align:center;">'+
                                    '<a href="javascript:;" class="btn btn-warning btn-xs item_edit fas fa-edit" data="'+data[i].Id_Penyakit+'" ></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus fas fa-trash-alt" data="'+data[i].Id_Penyakit+'"></a>'+
                            '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }

		    });
    }


    //GET EDIT
    $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url : "<?php echo site_url('Penyakit/get_edit_penyakit')?>/" + id,
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                  $('[name="KodePenyakit"]').val(data.Id_Penyakit);
                  $('[name="NamaPenyakit"]').val(data.Nama_Penyakit);
                  $('[name="InformasiPenyakit"]').val(data.Informasi);
                  $('[name="SaranPenyakit"]').val(data.Saran);
                  $('[name="ProbabilitasPenyakit"]').val(data.P_penyakit);
                  $('#Edit').modal('show'); 
                }
            });
            return false;
        });

    
    //GET HAPUS
		$('#show_data').on('click','.item_hapus',function(){
            var id=$(this).attr('data');
            $('#hapus').modal('show');
            $('[name="id"]').val(id);
        });

   function  V_Tambah(){
      $('#tambahform')[0].reset();
      $('.text-danger').empty(); 
      $('.form-control').removeClass('is-invalid');
      $('.form-control').removeClass('is-valid');
      $("#Add").modal("show");
    }

    
    function ubahpenyakit()
    { 
      var url;
      url = "<?php echo site_url('Penyakit/ubah')?>";
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
                tampil_data_penyakit();
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
      url = "<?php echo site_url('Penyakit/tambah')?>";
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
                tampil_data_penyakit();
              }
            else
              {
                $('.help-block-kode').text(data.Wkode);
                $('.help-block-nama').text(data.Wnama);
                $('.help-block-informasi').text(data.Winformasi);
                $('.help-block-saran').text(data.Wsaran);
                $('.help-block-probabilitas').text(data.Wprobabilitas);

                document.getElementById("KodePenyakit").className=data.csskode;
                document.getElementById("NamaPenyakit").className=data.cssnama;
                document.getElementById("InformasiPenyakit").className=data.cssinformasi;
                document.getElementById("SaranPenyakit").className=data.csssaran;
                document.getElementById("ProbabilitasPenyakit").className=data.cssprobabilitas;
              }
          }
        });
      }


      function hapuspenyakit()
      { 
        var url;
        url = "<?php echo site_url('Penyakit/hapus')?>";
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
                  tampil_data_penyakit();
                }
              else
                {
                  $('.help-block-email').text('Email Sudah Di Gunakan');
                  
                }
            }
          });
      }

      function cekkode(data) {
        if(data==''){
          document.getElementById("KodePenyakit").className=("form-control is-invalid");
          $('.help-block-kode').text('Kode Penyakit Harus Di Isi');
        }else{
          document.getElementById("KodePenyakit").className=("form-control is-valid");
          $('.help-block-kode').text('');
        }
      }
      
      function ceknama(data) {
        if(data==''){
          document.getElementById("NamaPenyakit").className=("form-control is-invalid");
          $('.help-block-nama').text('Nama Penyakit Harus Di Isi');
        }else{
          document.getElementById("NamaPenyakit").className=("form-control is-valid");
          $('.help-block-nama').text('');
        }
      }

      function cekinformasi(data) {
        if(data==''){
          document.getElementById("InformasiPenyakit").className=("form-control is-invalid");
          $('.help-block-informasi').text('Informasi Penyakit Harus Di Isi');
        }else{
          document.getElementById("InformasiPenyakit").className=("form-control is-valid");
          $('.help-block-informasi').text('');
        }
      }

      function ceksaran(data) {
        if(data==''){
          document.getElementById("SaranPenyakit").className=("form-control is-invalid");
          $('.help-block-saran').text('Saran Penyakit Harus Di Isi');
        }else{
          document.getElementById("SaranPenyakit").className=("form-control is-valid");
          $('.help-block-saran').text('');
        }
      }


      function cekprobabilitas(data) {
        if(data==''){
          document.getElementById("ProbabilitasPenyakit").className=("form-control is-invalid");
          $('.help-block-probabilitas').text('Nilai Probabilitas Penyakit Harus Di Isi');
        }else{
          document.getElementById("ProbabilitasPenyakit").className=("form-control is-valid");
          $('.help-block-probabilitas').text('');
        }
      } 
</script>

<!----------------------------------------------------------------Modal TAMBAH---------------------------------------------->
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Tambah Data Penyakit</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="tambahform"  >
                <div class="form-group ">
                    <label  class="font-weight-bold">Kode Penyakit</label>
                    <input type="text" class="form-control " id="KodePenyakit" oninput="cekkode(this.value)" name="KodePenyakit" placeholder="Masukan Kode Penyakit" required>
                    <span class="help-block-kode text-danger"></span>
                </div>
                <div class="form-group ">
                    <label for="exampleInputEmail1" class="font-weight-bold">Nama Penyakit</label>
                    <input type="text" class="form-control " id="NamaPenyakit" oninput="ceknama(this.value)" name="NamaPenyakit" placeholder="Masukan Nama Penyakit" required>
                    <span class="help-block-nama text-danger"></span>
                </div>
                <div class="form-group">
                    <label  class="font-weight-bold">Probabilitas</label>
                    <input class="form-control" id="ProbabilitasPenyakit" oninput="cekprobabilitas(this.value)" name="ProbabilitasPenyakit"   aria-label="With textarea"placeholder="Masukan Nilai Probabilitas" required>
                    <span class="help-block-probabilitas text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Informasi Penyakit</label>
                    <textarea class="form-control" rows="4"  id="InformasiPenyakit" oninput="cekinformasi(this.value)" name="InformasiPenyakit" aria-label="With textarea"placeholder="Masukan Informasi Penyakit" required></textarea>
                    <span class="help-block-informasi text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Saran Penyakit</label>
                    <textarea class="form-control" rows="4" id="SaranPenyakit" oninput="ceksaran(this.value)" name="SaranPenyakit" aria-label="With textarea"placeholder="Masukan Saran Penyakit" required></textarea>
                    <span class="help-block-saran text-danger"></span>
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
<!----------------------------------------------------------------Modal ---------------------------------------------->
<div class="modal fade ModalEdit" id="Edit"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Ubah Data Penyakit</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="editform"  >
                <div class="form-group ">
                    <input type="hidden" value="" name="KodePenyakit"/> 
                    <label class="font-weight-bold">Nama Penyakit</label>
                    <input type="text" class="form-control " id="NamaPenyakit" oninput="ceknama(this.value)" name="NamaPenyakit" placeholder="Masukan Nama Penyakit" required>
                    <span class="help-block-nama text-danger"></span>
                </div>
                <div class="form-group">
                    <label  class="font-weight-bold">Probabilitas</label>
                    <input class="form-control" id="ProbabilitasPenyakit" oninput="cekprobabilitas(this.value)" name="ProbabilitasPenyakit"   aria-label="With textarea"placeholder="Masukan Nilai Probabilitas" required>
                    <span class="help-block-probabilitas text-danger"></span>
                </div>
                <div class="form-group">
                    <label  class="font-weight-bold">Informasi Penyakit</label>
                    <textarea class="form-control" rows="4" name="InformasiPenyakit" oninput="cekinformasi(this.value)" aria-label="With textarea"placeholder="Masukan Informasi Penyakit"></textarea>
                    <span class="help-block-informasi text-danger"></span>
                </div>
                <div class="form-group">
                    <label  class="font-weight-bold">Saran Penyakit</label>
                    <textarea class="form-control" rows="4" name="SaranPenyakit" oninput="ceksaran(this.value)" aria-label="With textarea"placeholder="Masukan Saran Penyakit"></textarea>
                    <span class="help-block-saran text-danger"></span>
                </div>
                </div>
                <div class="modal-footer " >
                  <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button"  onclick="ubahpenyakit()" class="btn btn-success" >Kirim</button>
              </div>
        </form>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-sm " tabindex="-1" id="hapus" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content ">
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
      <button type="button" id="btnSave" onclick="hapuspenyakit()" class="btn btn-danger">Hapus</button>
    </div>
    </div>
  </div>
</div>


 