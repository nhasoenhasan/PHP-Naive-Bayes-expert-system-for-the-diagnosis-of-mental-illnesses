<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MHcheck</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/personal.css" >
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type='text/css' >
  <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body  >
<header class="sticky-top">
<nav class="navbar navbar-expand-lg navbar-light bg-black static-top">
    <a class="navbar-brand text-white font-weight-bold" style="font-size: 35px;" href="<?php echo base_url('index.php/Halaman/index');?>">
              <img src="<?php echo base_url(); ?>assets/images/cek.png" alt="" style="width:80px; ">
              MHcheck
        </a>
    <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" ></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-white "  href="<?php echo base_url('index.php/Halaman/index');?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Gangguan Psikologis</a>
              <div class="dropdown-menu ">
              <a class="dropdown-item"  href="<?php echo base_url('index.php/Halaman/Tentang_Penyakit');?>">Info Gangguan Psikologis</a>
              <a class="dropdown-item"  href="<?php echo base_url('index.php/Halaman/podcast');?>">Podcast</a>
              </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" href="<?php echo base_url('index.php/Halaman/Cek_Psikologis');?>">Cek Psikologis</a>
        </li>
        <li class="nav-item">
              <a class="nav-link active text-white" href="<?php echo base_url('index.php/Halaman/Tentang_Kami');?>">Tentang Kami</a>
            </li>
      </ul>
      <form class="form-inline my-2 my-lg-0  ">
        <div class="dropdown">
            <a class="  dropdown-toggle  fas fa-user-circle fa-1.9x text-white" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $this->session->userdata('ses_nama');?>
            </a>
            <div class="dropdown-menu  dropdown-menu-lg-right" aria-labelledby="dropdownMenu2">

            <?php
              if ($this->session->userdata('ses_nama')==FALSE){
                echo('
                    <a class="dropdown-item" href="#" data-toggle="modal" onclick="V_ModalLogin()">Login</a>
                    <a class="dropdown-item" href="#"  data-toggle="modal" onclick="V_ModalDaftar()">Daftar  </a>
                  ');
              }
              else{
                echo('
                    <a class="dropdown-item" href="'.base_url().'index.php/Profil/index'.'"  >Profil</a>
                    <a class="dropdown-item" href="'.base_url().'index.php/Profil/riwayat_diagnosa'.'"  >Hasil </a>
                    <a class="dropdown-item" href="'.base_url().'index.php/Login/logout'.'" >Logout  </a>
                    ');
              }
            ?>

            </div>
        </div>
      </form>
    </div>
    </nav>
</header> 








<!-- Modal LOGIN-->
<div class="modal fade" id="ModalMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">LOGIN</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="loginform" >
                <div class="form-group ">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="Email" class="form-control" oninput="email_login(this.value)" id="EmailLogin" aria-describedby="emailHelp" name="Email" placeholder="Enter email">
                    <span class="help-block-email-login text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="Password" oninput="pass_login(this.value)" id="PasswordLogin" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <span class="help-block-pass-login text-danger"></span><br>
                    <span class="help-block-auth text-danger"></span><br>
                </div>
               
                    <a href="<?php echo site_url('Lupa_password/index')?>" class="badge badge-danger">Lupa Password</a>
               
                </div>
                <div class="modal-footer border-dark " >
                  <button type="button" style="background-color:black" class="btn text-white" data-dismiss="modal">Close</button>
                  <button type="button" onclick="login()" class="btn btn-warning" >Masuk</button>
              </div>
        </form>
      
      
    </div>
  </div>
</div>

<!-- Modal DAFTAR-->
<div class="modal fade" id="ModalDaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class=" modal-header " style="background-color:black">
        <h3 class=" modal-title text-white text-center" id="exampleModalLongTitle">DAFTAR</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="daftarform" >  
                <div class="form-group ">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" oninput="ceknama(this.value)" id="Nama" name="Nama" aria-describedby="emailHelp" placeholder="Masukan Nama Anda">
                    <span id="warning" class="help-block-nama text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="example-date-input" >Tanggal Lahir</label>
                    <input class="form-control" type="date" name="Tanggal" value="2011-08-19" id="example-date-input">
                </div>
                <div class="form-group ">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <select class="form-control" name="JKelamin" id="exampleSelect1">
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" oninput="cekemail(this.value)" class="form-control" id="Emaill"  aria-describedby="emailHelp" name="Email" placeholder="Enter email">
                    <span id="warning" class="help-block-email text-danger"></span>
                    <span id="warning" class="help-block-email-cek text-danger"></span>
                </div>
                <div class="form-group ">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" oninput="cekpass(this.value)" class="form-control" id="Passwordd" name="Password" placeholder="Masukan Password">
                    <span id="warning" class="help-block-pass text-danger"></span>
                </div>
        </form>
      </div>
      <div class="modal-footer " >
        <button type="button" style="background-color:black" class="btn text-white" data-dismiss="modal">Close</button>
        <button type="button" onclick="daftar()" class="btn btn-warning">Daftar</button>
      </div>
    </div>
  </div>
</div>




<!---Function Javascript-->

<script  type="text/javascript">
      

      function V_ModalLogin(){
          $('#loginform')[0].reset(); // reset form on modals
          $('.form-control').removeClass('is-invalid'); // clear error class
          $('.text-danger').empty(); // clear error string
          $('#ModalMasuk').modal('show'); // show bootstrap modal
        }

        function  V_ModalDaftar(){
            $('.text-danger').empty(); 
            $('#daftarform')[0].reset(); // reset form on modals
            $('.form-control').removeClass('is-invalid');
            $('#ModalDaftar').modal('show') ; // show bootstrap modal
        }

        function login()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;
            url = "<?php echo site_url('Login/auth')?>";
            // ajax adding data to database
            var formData = new FormData($('#loginform')[0]);
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
                      $('.help-block-email-login').text(data.Wemail);
                      $('.help-block-pass-login').text(data.Wpass);
                      $('.help-block-auth').text(data.Wauth);

                      document.getElementById("EmailLogin").className=data.cssemail;
                      document.getElementById("PasswordLogin").className=data.csspass;
                    }
                }
            });
        }

        function daftar()
        {
           //set button disable 
            var url;
            url = "<?php echo site_url('Daftar/daftar')?>";
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

      function ceknama(data) {
        if(data==''){
          document.getElementById("Nama").className=("form-control is-invalid");
          $('.help-block-nama').text('Nama Harus Di Isi');
        }else{
          document.getElementById("Nama").className=("form-control ");
          $('.help-block-nama').text('');
        }
      }

      function cekemail(data) {
        if(data==''){
          document.getElementById("Emaill").className=("form-control is-invalid");
          $('.help-block-email').text('Email Harus Di Isi');
          $('.help-block-email-cek').text('');
        }
        else{
          document.getElementById("Emaill").className=("form-control ");
          $('.help-block-email').text('');
        }
      }

      function cekpass(data) {
        if(data==''){
          document.getElementById("Passwordd").className=("form-control is-invalid");
          $('.help-block-pass').text('Password Harus Di Isi');
        }
        else{
          document.getElementById("Passwordd").className=("form-control ");
          $('.help-block-pass').text('');
        }
      }

      function email_login(data) {
        if(data==''){
          document.getElementById("EmailLogin").className=("form-control is-invalid");
          $('.help-block-email-login').text('Email Harus Di Isi');
        }
        else{
          document.getElementById("EmailLogin").className=("form-control ");
          $('.help-block-email-login').text('');
        }
      }

      function pass_login(data) {
        if(data==''){
          document.getElementById("PasswordLogin").className=("form-control is-invalid");
          $('.help-block-pass-login').text('Password Harus Di Isi');
          $('.help-block-auth').text('');
        }
        else{
          document.getElementById("PasswordLogin").className=("form-control ");
          $('.help-block-pass-login').text('');
        }
      }

</script>