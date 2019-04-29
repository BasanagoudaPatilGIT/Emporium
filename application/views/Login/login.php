<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url() ?>upload/logo.JPG" type="image/x-icon" />
  <title>HealthCare - Login</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url()?>css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form role="form" method="post" action="<?php echo base_url()?>login/validate_credentials">
		 <p style="text-align:center; font-size:16px; font-weight:bolder; color:#FF0000;"><?php echo $this->session->flashdata('msg'); ?></p>
		
          <div class="form-group">
            <input class="form-control" name="username" id="username" type="text"  placeholder="UserName" required>
		  </div>
          <div class="form-group">
            <input class="form-control" name="password" id="password" type="password" placeholder="Password" required>
          </div>
           
		  <button type="submit" class="btn btn-primary btn-block" style="font-weight:bolder;">Login</button>
		  <div class="text-right" style="display:none" >
         <a class="d-block small mt-3" style="visibility: hidden" href="<?php echo base_url()?>Login/forgot_password">Forgot Password?</a>
          <a class="d-block small" style="visibility: hidden" href="<?php echo base_url()?>Login/registration">Register an Account</a>
        </div>
        </form>
     </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>js/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>js/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
