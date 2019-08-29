<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
        text-align: center;
        padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
        background-color:#fff019;
        color: black;
        }
        /*layout*/
        
        /* Create two equal columns that floats next to each other */
       

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /*FOOTER*/
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: right;
            margin-top:15px;
        }
    </style>
</head>
<body>



    

    <div class="row">
        <div  style=" float: left;width: 20%; height: 1px;">
            <img src="<?php echo base_url(); ?>assets/images/cek.png" alt="" style="width:100px; ">
        </div>
        <div   style=" float: center; width: 60%; height: 1px;" >
            <h1 align="center">MH Check</h1>
            <h4 align="center">Laporan Hasil Diagnosa</h4>
        </div>
    </div>



    <hr stytle="width:1px; height:2px;  background-color:black;" >
    <br>
    <br>
    <div class="row">
        <div  style=" float: left;width: 16%; height: 1px;">
            <h4>Nama</h4>
        </div>
        <div  style=" float: left;width: 16%; height: 1px;" >
            <h4>:&nbsp;<?php echo $user[0]['Nama']?></h4>
        </div>
    </div>
    <div class="row">
        <div  style=" float: left;width: 16%; height: 1px;" >
            <h4>Umur</h4>
        </div>
        <div  style=" float: left;width: 16%; height: 1px;" >
            <h4>:&nbsp;<?php echo $user[0]['Usia']?></h4>
        </div>
    </div>
    <div class="row">
        <div  style=" float: left;width: 16%; height: 1px;" >
            <h4>Umur</h4>
        </div>
        <div  style=" float: left;width: 16%; height: 1px;">
            <h4>:&nbsp;<?php echo $user[0]['Jenis_Kelamin']?></h4>
        </div>
    </div>
   <br><br>
     <table>
        <tr>
            <th style="width:22%" >Tanggal Diagnosa</th>
            <th style="width:13%">Terdiagnosa Gangguan Psikologis</th>
            <th style="width:15%">Presentase</th>
            <th>Gejala</th>
            <th>Diagnosa Gangguan LainLain</th>
            <th>Presentase Lain</th>
        </tr>
        <?php
            foreach ($hasil as $key => $value) {
           ?>
        <tr>
            <td><?php  echo $value['Tanggal'];?></td>
            <td><?php  echo $value['Nama_Penyakit'];?></td>
            <td><?php  echo $value['presentase'];?></td>
            <td style="word-break: break-all;" class="text-left"><?php  echo str_replace('|', '<br/><br/>', $value['Nama_Gejala']);?></td>
            <td style="word-break: break-all;" class="text-left"><?php  echo str_replace('|', '<br/><br/>', $value['Nama_Penyakit_lain']);?></td>
            <td style="word-break: break-all;" class="text-left"><?php  echo str_replace('|', '<br/><br/>', $value['presentase_lain']);?></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <div class="footer">
            <h4 style="margin-right:15px">Admin</h4><br><br><br>
            <h4>Nur Hasan</h4>
    </div>
</body>
</html>