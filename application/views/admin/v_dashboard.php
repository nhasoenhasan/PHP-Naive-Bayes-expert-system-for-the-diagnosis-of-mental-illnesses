
 <div class="container-fluid p-5" >
        
 <div class="card-deck ">
 <div class="card  mb-3 " style="max-width: 18rem; max-height: 10rem;">
  <div class="card-body " id="carduser">
      <div class="row">
        <div class="col">
            <img src="<?php echo base_url(); ?>assets/images/man.png" alt="" style="width:60px; ">
        </div>
        <div clas="col ml-5">
            <h5 class="pr-5 mr-4"><?php echo '' . $userr ;?></h5>
            <h5 class="pr-5 mr-4 ">Pengguna</h5>
        </div>
      </div>
  </div>
  <div class="card-footer text-white " id="cardfot1"><a href="<?php echo base_url().'index.php/User/'?>" style="color: black">Lihat Detail</a></div>
</div>
<div class="card   mb-3" style="max-width: 18rem; max-height: 10rem;">
<div class="card-body " id="carduser">
      <div class="row">
        <div class="col">
            <img src="<?php echo base_url(); ?>assets/images/medical-records.png" alt="" style="width:60px; ">
        </div>
        <div clas="col ml-5">
            <h5 class="pr-5 mr-4"><?php echo '' . $diagnosa ;?></h5>
            <h5 class="pr-5 mr-4 ">Diagnosa</h5>
        </div>
      </div>
  </div>

  <div class="card-footer  " id="cardfot2"><a href="<?php echo base_url().'index.php/Hasil_Diagnosa/'?>" style="color: black">Lihat Detail</a></div>
</div>
<div class="card  mb-3" style="max-width: 18rem; max-height: 10rem;">
    <div class="card-body " id="carduser">
        <div class="row">
            <div class="col">
                <img src="<?php echo base_url(); ?>assets/images/headache.png" alt="" style="width:60px; ">
            </div>
            <div clas="col ml-5">
                <h5 class="pr-5 mr-4"><?php echo '' . $penyakit ;?></h5>
                <h5 class="pr-5 mr-4 ">Penyakit</h5>
            </div>
        </div>
    </div>
  <div class="card-footer" id="cardfot"><a href="<?php echo base_url().'index.php/Penyakit/'?>" style="color: black">Lihat Detail</a></div>
</div>
<div class="card  mb-3" style="max-width: 18rem; max-height: 10rem;">
    <div class="card-body " id="carduser">
        <div class="row">
            <div class="col">
                <img src="<?php echo base_url(); ?>assets/images/clinic-history.png" alt="" style="width:60px; ">
            </div>
            <div clas="col ml-5">
                <h5 class="pr-5 mr-4"><?php echo '' . $gejala ;?></h5>
                <h5 class="pr-5 mr-4 ">Gejala</h5>
            </div>
        </div>
    </div>
  <div class="card-footer" id="cardfot"> <a href="<?php echo base_url().'index.php/Gejala/'?>" style="color: black">Lihat Detail</a></div>
</div>
  
</div>

<br>
<br>

<h3 class="text-center mb-4 ">Data Pasien Terdiagnosa</h3>
<canvas id="myChart"></canvas>
<script>
var ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                
                    foreach ($nama_penyakit as $key => $value) {
                        echo "'".$value['Nama_Penyakit']."'".",";
                    }    
                ?>
            ],
            datasets: [{
                label: '',
                data: [
                    <?php
                    $persen=100;
                        foreach ($chart as $value) {
                            echo ($value/$detaildiagnosa)*$persen.",";
                        }
                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(tick) {
                        return tick.toString() + '%';
                        }
                    }
                }]
            }
        }
    });
</script>
</div>