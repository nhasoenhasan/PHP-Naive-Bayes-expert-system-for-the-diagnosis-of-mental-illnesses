<div class="container mx-auto">
  <div class="row justify-content-md-center">
  
  <div class="card m-5 border-dark" id="kartu"style="width: 50rem; height:30rem">
    <div class="card-body ">
    <form method="POST" action="<?php echo base_url()?>index.php/Lupa_password/cekemail/">

        <div class="row">
            <div class="col">
                <p class="mt-5 text-weight-bold">Silahkan Maaukan Email untuk mendapatkan reset password</p>
            </div>
            
        </div>
        <div class="row">
            
            <div class="col col-md-5 ">
                <input type="email" class="form-control " name="user_email"  aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            
        </div>
        <div class="row mt-3">
            
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Reset Password</button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p class="mt-1 font-weight-bold"><span class="help-block-email text-danger "><?php echo $this->session->userdata('msg'); ?></span></p>
                <p class="mt-1 font-weight-bold"><span class="help-block-email text-success "><?php echo $this->session->userdata('msgs'); ?></span></p>
            </div>
            
        </div>
    </form>
    </div>
 </div>

  </div>
  
</div>