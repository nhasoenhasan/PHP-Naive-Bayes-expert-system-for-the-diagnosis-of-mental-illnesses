<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/personal.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type='text/css' >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>LOGIN</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center " >
        <div class="col-md-4 p-4 bg-black rounded shadow-lg" style=" background-color:black; color:white; height:500px; margin-top:100px ">
            <form action="<?php echo base_url().'index.php/Admin/auth'?>" method="post">
                <div class="form-group mb-4 mt-2">
                    <div align="center">
                    <i class="far fa-user-circle fa-5x text-center"></i>   
                    </div> 
                </div>
                <div class="form-group mb-4 ">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="Password" placeholder="Password">
                    <span class="help-block-saran text-danger"> <?php echo $this->session->userdata('message');?></span>
                </div>
                
            <hr style="background-color:white;  margin-top:70px">
            <div class="text-center mt-4">
                <button type="submit" style="width:150px; height:50px" class="btn btn-warning">LOGIN</button>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>



