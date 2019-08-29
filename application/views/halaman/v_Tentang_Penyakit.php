   
   <h2  class="text-center font-weight-bold mt-5">Apa Itu Gangguan Psikologis?</h2>
      <div class="container"  >
      <br>
    
        <div class="row text-center" >
            <div class="col-lg-4">
                
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle"  src="<?php echo base_url(); ?>assets/images/atas.jpg" alt="Generic placeholder image" width="140" height="140"><br>
                
                <button type="button" class="btn mb-4 mt-4 far fa-eye btn-warning" data-toggle="modal" data-target="#exampleModalLong">
                Lihat
                </button>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
           
            
            </div><!-- /.col-lg-4 -->
        </div>
            <hr style="background-color:black">
            <div class="text-center mb-5 mt-5">
                <h2 class="mt-3">Macam Gangguan Psikologis</h2>
            </div>
             
            <div class="row text-center" >
                <?php
                foreach ($penyakit as $key => $value) 
                    {
                ?>
                
                <div class="col-lg-4">
                    <img class="rounded-circle" src="<?php echo base_url(); ?>assets/images/<?php echo $key?>.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2 class="mt-3"><?php echo $value['Nama_Penyakit'];?></h2>
                    <p class="text-center"><?php echo $value['Informasi'];?></p>
                </div><!-- /.col-lg-4 -->
                <?php
                    }
                ?>
            </div>
            
    </div>


        <!-- Modal Apa Itu Gangguan Psikologis-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Info Gangguan Psikologis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p class="text-justify"> 
                Gangguan psikologis adalah kondisi dimana seseorang memiliki cara berpikir, 
                perilaku, serta emosi yang abnormal. Biasanya hal ini terjadi karena berbagai faktor, 
                seperti trauma di masa lalu, depresi, maupun faktor genetik. Ada berbagai perilaku yang 
                seringkali disebut sebagai gangguan psikologis, sebut saja OCD, gangguan bipolar, maupun
                eating disorder. Namun tidak sebatas itu saja, masih ada lagi berbagai gangguan psikologis 
                yang perlu diwaspadai karena tampak umum dialami seseorang tapi secara tidak sadar bisa memberi 
                efek buruk jika kondisinya sudah parah
             </p>
            </div>
            </div>
        </div>
        </div>

        <!-- Modal Penyakit-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Info Gangguan Psikologis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p class="text-justify"> 
                Gangguan psikologis adalah kondisi dimana seseorang memiliki cara berpikir, 
                perilaku, serta emosi yang abnormal. Biasanya hal ini terjadi karena berbagai faktor, 
                seperti trauma di masa lalu, depresi, maupun faktor genetik. Ada berbagai perilaku yang 
                seringkali disebut sebagai gangguan psikologis, sebut saja OCD, gangguan bipolar, maupun
                eating disorder. Namun tidak sebatas itu saja, masih ada lagi berbagai gangguan psikologis 
                yang perlu diwaspadai karena tampak umum dialami seseorang tapi secara tidak sadar bisa memberi 
                efek buruk jika kondisinya sudah parah
             </p>
            </div>
            </div>
        </div>
        </div>
        
    
    
    
  
    
    
  