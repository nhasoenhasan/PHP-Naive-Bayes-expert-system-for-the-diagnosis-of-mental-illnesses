
 <div class="container-fluid mt-4" >
    <div class="card">
        <div class="card-header ">
            Daftar User
        </div>
        <div class="card-body"  >
           <div class="table-responsive" >
            <div align="right">
            </div>
             
                <table id="tabel-data" class="table table-striped "  cellspacing="0" >
                    <thead class="thead-dark">
                        <tr >
                            <th style="width:5%">No</th>
                            <th style="width:25%; text-align:center">Nama</th>
                            <th style="width:25%; text-align:center">Jenis Kelamin</th>
                            <th style="width:25%; text-align:center">Usia</th>
                            <th style="width:25%; text-align:center">Email</th>
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
      tampil_data_user();
      $('#tabel-data').DataTable();
    });
    
    function tampil_data_user() {
      $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo base_url()?>index.php/User/data_user',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td class="text-center" >'+data[i].Nama+'</td>'+
                            '<td class="text-center">'+data[i].Jenis_Kelamin+'</td>'+
                            '<td class="text-center">'+data[i].Usia+"Tahun"+'</td>'+
                            '<td class="text-center">'+data[i].Email+'</td>'+
		                        '<td style="text-align:center;">'+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus fas fa-trash-alt" onclick="V_Hapus('+data[i].Id_User+')"></a>'+
                                    
                                '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }

		    });
    }

   

    function  V_Hapus(id){
      $('#hapusform')[0].reset();
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('User/get_edit_user')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id"]').val(data.Id_User);
          $('#hapus').modal('show'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
    }
    
      function hapususer()
      { 
        var url;
        url = "<?php echo site_url('User/hapus')?>";
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
                  tampil_data_user();
                }
              else
                {
                  $('.help-block-email').text('Email Sudah Di Gunakan');
                }
            }
          });
        }
   
</script>

<!----------------------------------------------------------------Modal Hapus---------------------------------------------->


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
      <button type="button" id="btnSave" onclick="hapususer()" class="btn btn-danger">Hapus</button>
    </div>
    </div>
  </div>
</div>


 