
<div class="container">
    <br>
    <div class="card " id="kartu">
        <div class="card-header font-weight-bold" style="background-color:black;color:white;">
            Hasil Diagnosa
        </div>
        <div class="card-body" >
        <p class="font-weight-bold">Gejala Yang Di Masukan :</p>
            <?php
                
                foreach ($input as $key => $value) {?>
                    <p><?php echo $key+1;?>. <?php echo $value [0]['nama_gejala'] ?></p>
                    

               <?php }
            
            ?>
        <hr class="border-dark">
        <form action="<?php echo base_url()?>index.php/Diagnosa/diagnosa_user/" method="post">



        <?php
                
                foreach ($input as $key => $value) {?>
                 
                    <input type="hidden" name='gejala[]' value="<?php echo $value [0]['Id_Gejala'] ?>">
                    

               <?php }
            
        ?>


        <p class="font-weight-bold">Hasil Diagnosa :</p>
            <?php
            foreach ($penyakit as $key => $value) {
                $persen[$key]=round($persen[$key], 2);
                $max= max($persen);
                $indexpersen=array_search($max,$persen);
                ?>
                <label for="progress"><?php echo $value['Nama_Penyakit']?></label>
                <input type="hidden" name="nama_setiap_penyakit[]" value="<?php echo $value['Nama_Penyakit']?>">
                <input type="hidden" name="persen_setiap_penyakit[]" value="<?php echo $persen[$key];?>">

                
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:<?php echo $persen[$key];?>%;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $persen[$key];?>%</div>
                </div><br>
                    
            <?php
            }
           ?>
           <hr class="border-dark">
           <p class="font-weight-bold">Kesimpulan :</p>
           <p>Penyakit &ensp;&ensp;&ensp;= &ensp;<?php echo $penyakit[$indexpersen]['Nama_Penyakit'];?></p>
           <p>Presentase &ensp;= &ensp;<?php echo $persen[$indexpersen]?>%</p>
           <hr class="border-dark">
           <p class="font-weight-bold">Informasi Penyakit :</p>
           <p><?php echo $penyakit[$indexpersen]['Informasi'];?></p>
           <p class="font-weight-bold">Saran :</p>
           <p><?php echo $penyakit[$indexpersen]['Saran'];?></p>
        </div>
        <div class="card-footer bg-transparent border-dark">
        <button type="submit" class="btn btn-success">Simpan Data</button><a type="button" href="<?php echo base_url('index.php/Halaman/Cek_Psikologis');?>" class="btn btn-warning ml-2">Diagnosa Lagi</a>
        </div>
        <input type="hidden" name="IdPenyakit"class="form-control" value="<?php echo $penyakit[$indexpersen]['Id_Penyakit']?>">
        <input type="hidden" name="IdUser"class="form-control" value="<?php echo $this->session->userdata('ses_IdUser');?>">
        <input type="hidden" name="Persentase"class="form-control" value="<?php echo $persen[$indexpersen];?>">
        </form>
    </div>
    <br>
</div>

