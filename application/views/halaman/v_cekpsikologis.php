<h2 style="" class="text-center font-weight-bold mt-5">Cek Psikologis</h2>
	<div class="container" style="margin-bottom:200px" >
        <hr style="background-color:black">
        <span class="help-block-email text-success "><?php echo $this->session->userdata('msgbox'); ?></span>
        
        <h6 style="" class=" font-weight-bold mt-4">Silahkan Pilih Minimal 2 Gejala</h6><br>
        
        <form id="datagejala" action="<?php echo base_url()?>index.php/Diagnosa/tahapsatu/" method="post" class="p-3" >
        <div id="list_gejala" >
        <?php 
        $no=1;
        foreach ($gejala->result_array() as $items) {?>
        
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name='item[]' onclick="Ambil()" class="form-check-input "  value="<?php  echo $items['Id_Gejala']?>" id="Check1">
                       
                        <label class="form-check-label "  name='item[]' ><?php   echo $items['nama_gejala']?></label>
                    </div>
                 
                    <hr class="border-primary">
         
        <?php 
        $no++;
        } ?>
        </div>
        <button type="submit" id="btn-one"  class="btn btn-warning mt-4" >PROSES DIAGNOSA</button>
        </form>
        <div id="Hasil">

        </div>
        
    </div>
    <script type="text/javascript">
    
   
    </script>
    
  

    