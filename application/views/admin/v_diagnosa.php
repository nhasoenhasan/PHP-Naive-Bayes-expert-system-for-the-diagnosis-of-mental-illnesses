<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" type='text/css' >
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker.en.js"></script>
 <div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header ">
            Daftar Diagnosa
        </div>
        <div class="card-body">

           <div class="table-responsive">

                <div class="row mb-3">

                </div>

                <table id="tabel-data" class="table table-striped " width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr >
                            <th style="width:5% display:block">No</th>
                            <th style="width:25%" class="text-center">Nama </th>
                            <th style="width:25%" class="text-center">Jenis Kelamin </th>
                            <th style="width:25%" class="text-center">Email</th>
                            <th style="width:20%" class="text-center">Aksi</th>
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

    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(document).ready(function(){
      tampil_data_diagnosa();
      $('#tabel-data').DataTable();
    });
    var i;
    function tampil_data_diagnosa() {
      $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo base_url()?>index.php/Hasil_Diagnosa/data_diagnosa',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].Nama+'</td>'+
		                        '<td style="word-break: break-all;" class="text-center">'+data[i].Jenis_Kelamin+'</td>'+
		                        '<td style="word-break: break-all;" class="text-center">'+data[i].Email+'</td>'+
		                        '<td style="text-align:center;">'+
                              '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus fas fa-trash-alt" data="'+data[i].Id_Diagnosa+'"></a>'+
                              '<a href="<?php echo base_url()?>index.php/Hasil_Diagnosa/detail_diagnosa/'+data[i].Id_Diagnosa+'" class="btn btn-primary ml-3 btn-xs  far fa-eye" ></a>'+
                            '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }

		    });
    }

    //GET HAPUS
		$('#show_data').on('click','.item_hapus',function(){
            var id=$(this).attr('data');
            $('#hapus').modal('show');
            $('[name="id"]').val(id);
        });

 
      function hapusdiagnosa()
      { 
        var url;
        url = "<?php echo site_url('Hasil_Diagnosa/hapus')?>";
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
                  tampil_data_diagnosa();
                }
              else
                {
                  $('.help-block-email').text('Email Sudah Di Gunakan');
                  
                }
            }
          });
      }

</script>



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
      <button type="button" id="btnSave" onclick="hapusdiagnosa()" class="btn btn-danger">Hapus</button>
    </div>
    </div>
  </div>
</div>


 