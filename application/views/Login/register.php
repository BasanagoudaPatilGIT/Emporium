<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url() ?>upload/logo.JPG" type="image/x-icon" />
  <title>TMT - Registration</title>
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
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="post" action="<?php echo base_url()?>Registartion/userregistration" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter First Name"
				 value="<?php echo set_value('firstname')?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('firstname','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-4">
                <input class="form-control" id="middlename" name="middlename" type="text" placeholder="Enter Middle Name"
				 value="<?php echo set_value('middlename')?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('middlename','<div style="color:#FF0000;">','</div>'); ?> 
				  </div>
              <div class="col-md-4">
                <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter Last Name"
				 value="<?php echo set_value('lastname')?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('lastname','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
            </div>
          </div>
		  <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <input class="form-control" name="empid" id="empid" type="text" placeholder="Enmployee ID"
				 value="<?php echo set_value('empid')?>" onKeyUp="isnum(this)">
                  <?php echo form_error('empid','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-6">
				<?php 
				$attributes = 'class = "form-control" id = "cbo_user_type" name = "cbo_user_type"';
				echo form_dropdown('cbo_user_type',$cbo_user_type,set_value('cbo_user_type') , $attributes);
				 ?><?php echo form_error('cbo_user_type','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
            </div>
          </div>
		  <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <input class="form-control" name="mobileno" id="mobileno" type="text" placeholder="Enter Mobile Number"
				 value="<?php echo set_value('mobileno')?>" onKeyUp="isnum(this)">
                  <?php echo form_error('mobileno','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-6">
            <input class="form-control" id="email_id" name="email_id" type="email" placeholder="Enter Email Address"
				 value="<?php echo set_value('email_id')?>" onKeyUp="isnum(this)">
                  <?php echo form_error('email_id','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
				 <input type="password" class="form-control" id="password" name="password" placeholder="Password" 
				  value="<?php echo set_value('password')?>" onKeyUp="isalphanum(this)">
				  <?php echo form_error('password','<div style="color:#FF0000;">','</div>'); ?>
				  
              </div>
              <div class="col-md-6">
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" 
				  value="<?php echo set_value('cpassword')?>" onKeyUp="isalphanum(this)">
				  <?php echo form_error('cpassword','<div style="color:#FF0000;">','</div>'); ?>
              </div>
            </div>
          </div>
		  
		  <div class="form-group">
		  <div class="form-row">
				<div class="col-md-6">
                <textarea class="textarea" rows="6" id="address" name="address" cols="10" placeholder="Enter Address"
				style="width: 100%; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('address')?></textarea>
				<?php echo form_error('address','<div style="color:#FF0000;">','</div>'); ?> 
				</div>
		  		<div class="col-md-6" style="border:1px solid #dddddd">
                
				<span class="logo-label"><i class="fa fa-upload" aria-hidden="true"></i> Choose Profile Image </span>
                <input  class="upload" type="file" id="displaypicture" name="displaypicture" 
				value="<?php echo set_value('displaypicture')?>" accept="image/jpg, image/jpeg, image/png"/>
               
                <h6 id="test" style="color:red">Note :</h6>
                <p><span style="color:red">*</span> Only JPEG and JPG supported </p>
                <p><span style="color:red">*</span> Max 3 MB Upload </p>
              </div>
			</div>
			</div>
			
		  <input type="submit" class="btn btn-primary btn-block" value="Register"/>
		  </form>
		  
		<div class="form-group">
         <div class="form-row">
		<div class="text-right col-md-10">
		<span class="d-block small mt-2"><strong> Already a Member -</strong> </span>
		</div>
        <div class="text-left col-md-2">
		<a class="d-block small mt-2" href="<?php echo base_url()?>Login/index">Click to Login</a>
        </div>
		</div>
		</div>
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
