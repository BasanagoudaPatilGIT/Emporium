<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url() ?>upload/logo.JPG" type="image/x-icon" />
  <title>TMT - Forget Password</title>
  <!-- Bootstrap core CSS-->
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
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter Registered Email address and we will send your password to Entered email address.</p>
        </div>
        <form method="post" action="<?php echo base_url()?>Mailer/send_password" enctype="multipart/form-data">
		<p style="text-align:center; font-size:16px; font-weight:bolder; color:#FF0000;"><?php echo $this->session->flashdata('msg'); ?></p>
          <div class="form-group">
            <input class="form-control" name="email_id" id="email_id" type="email" aria-describedby="emailHelp" placeholder="Enter Email Address">
			<?php echo form_error('email_id','<div style="color:#FF0000;">','</div>'); ?> 
          </div>
		  
		<div class="form-group">
          <input type = "submit" class="btn btn-primary btn-block" value="Get Password"/>
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
