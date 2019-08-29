
<span id="mce_marker" data-mce-type="bookmark" data-mce-fragment="1">​</span>
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header ">
            Detail Diagnosa
        </div>
                <div class="card-body">
                
                    <form method="POST" action="<?php echo base_url()?>index.php/Hasil_Diagnosa/cetak/">
                        <div class="table-responsive ">

                           <div class="row mb-3">

                                <div class="col col-md-2 text-center">
                                    <input class="form-control" name="awal" data-toggle="datepicker" placeholder="Dari Tanggal">
                                </div>
                                <div class="col col-md-2 text-center">
                                    <input class="form-control"  name="akhir" data-toggle="datepicker" placeholder="Sampai Tanggal">
                                </div>
                              
                                <input type="hidden" name="id_diagnosa" value="<?php echo $id_diagnosa?>" >
                                
                                <div class="col col-md-3 ">
                                    <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top"  >Cetak<span class="fas fa-print ml-1"></span></button>
                                </div>

                           </div>
                           <p class="help-block-saran text-danger"> <?php echo $this->session->userdata('Tanggal');?></p>
                    </form>
             
                <table id="tabel-data" class="table table-striped " width="100%" cellspacing="0">
                    <thead class="thead-dark">
                    <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tangggal Diagnosa</th>
                                <th scope="col">Terdiagnosa Gangguan Psikologis</th>
                                <th scope="col">Presentase</th>
                                <th style="width:40%"  scope="col">Gejala</th>
                                <th style="width:40%"  scope="col">Gangguan Psikolohis Lain</th>
                                <th style="width:40%"  scope="col">Persentase</th>
                                <th scope="col">Aksi</th>
                                </tr>
                    </thead>
                
                    <tbody id="show_data">
                    <?php
                                    foreach ($hasil as $key => $value) 
                                    
                                    

                                    {?>
                                    
                                    <tr>
                                        <th scope="row"><?php echo $key+1?></th>
                                        <td><?php echo $value['Tanggal'];?></td>
                                        <td><?php echo $value['Nama_Penyakit'];?></td>
                                        <td><?php echo $value['presentase'];?>%</td>
                                      
                                        <td style="word-break: break-all;" class="text-left"><?php  echo str_replace('|', '<br/><br/>', $value['Nama_Gejala']);?></td>
                                        <td style="word-break: break-all;" class="text-left"><?php  echo str_replace('|', '<br/><br/>', $value['Nama_Penyakit_lain']);?></td>
                                        <td style="word-break: break-all;" class="text-left"><?php  echo str_replace('|', '<br/><br/>', $value['presentase_lain']);?></td>
                                        <td class="text-center">
                                            <a href="javascript:;" class="btn btn-danger btn-xs item_hapus fas fa-trash-alt " data="<?php echo $value['id_detail_diagnosa'];?>"  >
                                            </a>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(document).ready(function(){
      $('#tabel-data').DataTable();
    });
    
    
    $('#show_data').on('click','.item_hapus',function(){    
            var id=$(this).attr('data');
            $('#hapus').modal('show');
            $('[name="id"]').val(id);
        });

    function hapuspenyakit()
      { 
        var url;
        url = "<?php echo site_url('Hasil_Diagnosa/hapus_detail')?>";
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
                  location.reload(); 
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
      <button type="button" id="btnSave" onclick="hapuspenyakit()" class="btn btn-danger">Hapus</button>
    </div>
    </div>
  </div>
</div>