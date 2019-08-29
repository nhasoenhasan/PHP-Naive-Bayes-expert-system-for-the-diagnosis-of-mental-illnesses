<div class="container-fluid mt-4 p">
    <div class="card ">
        <div class="card-header  ">
            Profil Admin
        </div>
        <div class="card-body p-5">


        <form id="dataadmin" action="<?php echo base_url()?>index.php/Admin/ubahdata/" method="post">
            <input type="hidden" class="form-control " id="Id" value="<?php echo $admin[0]['Id_admin']?>" name="Aid" >
            <div class="form-group row">
                <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-5">
                <input type="text" class="form-control " id="Nama" value="<?php echo $admin[0]['Nama']?>" name="Anama" >
                </div>
            </div>
            <div class="form-group row">
                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                <input type="email" aria-describedby="emailHelp" class="form-control " id="Email"  value="<?php echo $admin[0]['Email']?>" name="Aemail" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Password" class="col-sm-2 col-form-label">Password Lama</label>
                <div class="col-sm-5">
                <input type="password" class="form-control " id="Password" value="<?php echo $admin[0]['Pass']?>"  name="Apasswordold" >
                </div>
            </div>
            <div class="form-group row">
                <label for="Password" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-5">
                <input type="password" class="form-control " id="Passwordnew" name="Apasswordnew" >
                <span class="help-block-nama text-danger"><?php echo $this->session->flashdata('msgpass');?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="Password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                <div class="col-sm-5">
                <input type="password" class="form-control " id="Passwordc" name="Acpasswordnew" >
                <span class="help-block-konfirmasi"></span>
                </div>
            </div>
            <div class="form-group mt-5 ml-1 row">
                <button type="submit" class="btn btn-success" >Simpan</button>
                <button class="btn ml-3 btn-danger">Batal</button>
            </div>
        </form>

        </div>
    </div>
</div>
<script type="text/javascript">

    window.onload = function () {
        document.getElementById("Passwordnew").onchange = validatePassword;
        document.getElementById("Passwordc").onchange = validatePassword;
    }
            
    function validatePassword(){
        var pass2=document.getElementById("Passwordnew").value;
        var pass1=document.getElementById("Passwordc").value;
        if(pass1!=pass2)
            document.getElementById("Passwordc").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        
        else
            document.getElementById("Passwordc").setCustomValidity('');
    }
    

</script>