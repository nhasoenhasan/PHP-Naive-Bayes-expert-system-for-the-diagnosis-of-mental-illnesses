
 <div class="container-fluid mt-4" >
    <div class="card">
        <div class="card-header ">
            Daftar Gejala
        </div>
        <div class="card-body"  >
           <div class="table-responsive" >
            <div align="right">
            <button  class="btn btn-success m-2 " onclick="V_Tambah()" >Tambah<span class="fas fa-plus ml-1"></span></button>
            </div>
             
                <table id="tabel-data" class="table table-striped "  cellspacing="0" style="width:100%">
                    <thead class="thead-dark">
                        <tr >
                            <th style="width:5%">No</th>
                            <th style="width:10%; text-align:center">Kode Gejala</th>
                            <th style="width:75%; text-align:center">Nama Gejala</th>
                            <th style="width:25%; text-align:center">Aksi</th>
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
      tampil_data_gejala();
      $('#tabel-data').DataTable();
    });
    
    function tampil_data_gejala() {
      $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo base_url()?>index.php/Gejala/data_gejala',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td>'+data[i].Id_Gejala+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].nama_gejala+'</td>'+
		                        '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-warning btn-xs item_edit fas fa-edit" data="'+data[i].Id_Gejala+'" ></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus fas fa-trash-alt" data="'+data[i].Id_Gejala+'"></a>'+
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
      $("#Add").modal("show");
    }

    //GET EDIT
    $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url : "<?php echo site_url('Gejala/get_edit_gejala')?>/" + id,
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                  $('[name="KodeGejala"]').val(data.Id_Gejala);
                  $('[name="NamaGejala"]').val(data.nama_gejala);
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

    

    function  V_Edit(id){
      $('#editform')[0].reset();  
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Gejala/get_edit_gejala')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id"]').val(data.Id_Gejala);
          $('[name="KodeGejala"]').val(data.Kode_Gejala);
          $('[name="NamaGejala"]').val(data.nama_gejala);
          $('#Edit').modal('show'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
    }

    function ubahgejala()
    { 
      var url;
      url = "<?php echo site_url('Gejala/ubah')?>";
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
                tampil_data_gejala();
              }
            else
              {
                $('.help-block-email').text('Email Sudah Di Gunakan');
              }
          }
        });
    }

    function tambahgejala()
    { 
      var url;
      url = "<?php echo site_url('Gejala/tambah')?>";
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
                tampil_data_gejala();
              }
            else
              {
                $('.help-block-gejala').text(data.Wkode);
                $('.help-block-nama').text(data.Wnama);

                document.getElementById("KodeGejala").className=data.csskgejala;
                document.getElementById("NamaGejala").className=data.cssnama;
              }
          }
        });
      }


      function hapusgejala()
      { 
        var url;
        url = "<?php echo site_url('Gejala/hapus')?>";
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
                  tampil_data_gejala();
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
            document.getElementById("KodeGejala").className=("form-control is-invalid");
            $('.help-block-gejala').text('Kode Gejala Harus Di Isi');
          }else{
            document.getElementById("KodeGejala").className=("form-control is-valid");
            $('.help-block-gejala').text('');
          }
        }

        function ceknama(data) {
          if(data==''){
            document.getElementById("NamaGejala").className=("form-control is-invalid");
            $('.help-block-nama').text('Nama Gejala Harus Di Isi');
          }else{
            document.getElementById("NamaGejala").className=("form-control is-valid");
            $('.help-block-nama').text('');
          }
        } 

        
</script>

<!----------------------------------------------------------------Modal ---------------------------------------------->
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Tambah Data Gejala</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="tambahform"  >
                <div class="form-group ">
                    <label  class="font-weight-bold">Kode Gejala</label>
                    <input type="text" class="form-control" id="KodeGejala" oninput="cekkode(this.value)"  name="KodeGejala" placeholder="Masukan Kode Gejala">
                    <span class="help-block-gejala text-danger"></span>
                </div>
                <div class="form-group ">
                    <label class="font-weight-bold">Nama Gejala</label>
                    <textarea type="text" class="form-control" id="NamaGejala" rows="4" oninput="ceknama(this.value)" name="NamaGejala" placeholder="Masukan Nama Gejala"></textarea>
                    <span class="help-block-nama text-danger"></span>
                </div>
                </div>
                <div class="modal-footer " >
                  <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button" onclick="tambahgejala()" class="btn btn-success" >Kirim</button>
              </div>
        </form>
    </div>
  </div>
</div>
<!----------------------------------------------------------------Modal ---------------------------------------------->
<div class="modal fade ModalEdit" id="Edit"  role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Ubah Data Gejala</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="editform"  >
                <input type="hidden"  type="text" class="form-control" id="KodeGejala"  name="KodeGejala" placeholder="Masukan Kode Gejala">
                <div class="form-group "> 
                    <label for="exampleInputEmail1" class="font-weight-bold">Nama Gejala</label>
                    <textarea type="text" class="form-control" id="NamaGejala" rows="4" name="NamaGejala" placeholder="Masukan Nama Gejala"></textarea>
                </div>
                </div>
                <div class="modal-footer " >
                  <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button"  onclick="ubahgejala()" class="btn btn-success" >Kirim</button>
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
      <button type="button" id="btnSave"  onclick="hapusgejala()" class="btn btn-danger">Hapus</button>
    </div>
    </div>
  </div>
</div>


 