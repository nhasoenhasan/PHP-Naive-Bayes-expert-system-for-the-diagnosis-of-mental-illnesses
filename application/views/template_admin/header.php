<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/personal.css" >
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type='text/css' >
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datatables.min.css" type='text/css' >
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" type='text/css' >

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script  src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker.js"></script>
  
 
</head>
<body  >
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="border-right text-white bg-dark" id="sidebar-wrapper">
	  <div id="nama">
		<div class="sidebar-heading "><img src="<?php echo base_url(); ?>assets/images/cek.png" alt="" style="width:50px; ">ADMIN</div>
	  </div>
    
    <div class="list-group" id="menu-admin">
        <a href="<?php echo base_url().'index.php/Admin/Dashboard'?>" class="list-group-item list-group-item-action bg-dark text-white" ><span class="fas fa-tachometer-alt mr-2"></span>Dashboard</a>
        <a  class="list-group-item list-group-item-action bg-dark text-white" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" ><span class="fas fa-square-root-alt mr-1 "></span>Perhitungan<span class="fas fa-caret-down ml-2"> </span></a>
        <div class="collapse" id="collapseExample" >
          <a href="<?php echo base_url().'index.php/Penyakit/'?>" class="list-group-item  bg-dark text-white " id="submenu" ><span class="fas fa-book-medical mr-2 ml-3"></span>Daftar Penyakit</a>
          <a href="<?php echo base_url().'index.php/Gejala/'?>" class="list-group-item  bg-dark text-white " id="submenu"><span class="fas fa-diagnoses mr-2 ml-3"></span>Data Gejala</a>
          <a href="<?php echo base_url().'index.php/Probabilitas/'?>" class="list-group-item  bg-dark text-white " id="submenu"><span class="fas fa-percent mr-2 ml-3" ></span>Data Probabilitas</a>
        </div>
        <a href="<?php echo base_url().'index.php/User/'?>" class="list-group-item list-group-item-action bg-dark text-white" ><span class="fas fa-users mr-2"></span>Data User</a>
        <a href="<?php echo base_url().'index.php/Hasil_Diagnosa/'?>" class="list-group-item list-group-item-action bg-dark text-white" ><span class="fas fa-poll-h mr-2"></span>Daftar Diagnosa</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg   " style="background-color:#fee001">
        <i class="btn fas fa-bars fa-2x" id="menu-toggle"></i>
        <div class="dropdown ml-auto mt-2 mt-lg-0">
        
        <a class="dropdown-toggle  fas fa-user-circle fa-1x" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $this->session->userdata('ses_namaadmin');?>
        </a>
        <div class="dropdown-menu dropdown-menu-right "  aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item " href="<?php echo base_url().'index.php/Admin/profil'?>">Profil</a>
          <a class="dropdown-item " href="<?php echo base_url().'index.php/Admin/logout'?>">Logout</a>
        </div>
        </div>
      </nav>

      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });


       

        function daftar()
        {
           //set button disable 
            var url;
            url = "<?php echo site_url('Daftar/baru')?>";
            // ajax adding data to database
            var formData = new FormData($('#daftarform')[0]);
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
                      window.location.href = "<?php echo site_url('Halaman/Diagnosa')?>";
                    }
                    else
                    {
                      $('.help-block-nama').text(data.Wnama);
                      $('.help-block-email').text(data.Wemail);
                      $('.help-block-pass').text(data.Wpass);
                      $('.help-block-email-cek').text(data.Wemailcek);

                      document.getElementById("Nama").className=data.cssnama;
                      document.getElementById("Emaill").className=data.cssemail;
                      document.getElementById("Passwordd").className=data.csspass;
                    }
                }
            });
        }
  </script>

