
    <div class="container">
        

            <div class="row mb-5">
                <div class="col">

                    <div class="card mt-5 mb-5 w-30 h-70" id="kartu">
                        <div class="card-body p-4">
                        
                         
                            <h3 class="text-center">Profil</h3>
                            <hr style="background-color:black">
                            
                            <form id="datauser" class="mt-5" action="<?php echo base_url()?>index.php/Profil/ubahdata/" method="post">
                                
                                    <?php foreach ($profil as $key => $value) {
                                        $select_perempuan = '';
                                        $select_laki_laki = '';
                                        if ( $value['Jenis_Kelamin']=== 'Laki-Laki' ) { 
                                            $select_laki_laki = 'selected';
                                        }if($value['Jenis_Kelamin']=== 'Perempuan'){
                                            $select_perempuan = 'selected';    
                                        }    
                                    ?>
                                       

                                    <div class="form-group row">
                                        <label for="inputNama" class="col-sm-2 col-form-label font-weight-bold">Nama</label>
                                        <div class="col-sm-5">
                                        <input class="form-control"  name="Nama" value="<?php echo $value['Nama']?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputSex" class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                                        <div class="col-sm-5">
                                        <select class="custom-select" name="Sex" id="inputGroupSelect01">
                                            <option id="" value="Perempuan"  <?php echo $select_perempuan?> >Perempuan</option>
                                            <option id="" value="Laki-Laki"  <?php  echo $select_laki_laki?> >Laki-laki</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputNama" class="col-sm-2 col-form-label font-weight-bold">Tanggal Lahir</label>
                                        <div class="col-sm-5">
                                        <input class="form-control" type="date" name="Tanggal" value="<?php echo $value['Tgl_Lahir']?>" id="example-date-input">
                                        </div>
                                    </div>  

                                    <?php } ?>


                            <hr style="background-color:black" class="mt-5 mb-5">
                           
                                <div class="row mt-2 ml-1">
                                    <button type="submit" class="btn btn-warning mt-2">Ubah Informasi</button>
                                    </form>
                                    <button type="button" class="btn btn-danger ml-2 mt-2" data-toggle="modal" onclick="V_ModalPassword()">Ganti Password</button>
                                    
                                </div>
                       
                        </div>
                    </div>
                </div>

                
            </div>      
    
</div>
<script type="text/javascript">

    function V_ModalPassword(){
          $('#passwordform')[0].reset(); // reset form on modals
          $('.text-danger').empty(); 
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string
          $('#ModalPassword').modal('show'); // show bootstrap modal
    }

    
    function ganti()
    {
        var url;
        url = "<?php echo site_url('Profil/gantipassword')?>";
        var formData = new FormData($('#passwordform')[0]);
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
                        $('#ModalPassword').modal('hide');
                    }else{
                        $('.help-block-pass').text(data.Wpass);
                    }
                }
        });
        
    }

    


</script>
<!-- Modal Ganti Password-->
<div class="modal fade" id="ModalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">Ganti Password</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="passwordform"  >
                <div class="form-group">
                    <label for="exampleInputPassword1">Masukan Password Baru</label>
                    <input type="password"onclick name="Password" id="Password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    <span class="help-block-pass text-danger"></span>
                </div>
                </div>
                <div class="modal-footer " >
                  <button type="button" style="background-color:black" class="btn text-white" data-dismiss="modal">Close</button>
                  <button type="button" id="btn-pass"onclick="ganti()" class="btn btn-warning " >Simpan</button>
              </div>
        </form>
      
      
    </div>
  </div>
</div>