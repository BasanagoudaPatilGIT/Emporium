<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-key"></i> Change Password :</h3>
          </div>
          <form method="post" action="<?php echo base_url()?>ChangePassword/changepassword" enctype="multipart/form-data">
        <div class="box-body">
          
		  <div class="form-group col-sm-12">
              <div class="col-md-4">
                <label for="emailid">Email Id :</label>
            	<input class="form-control" id="email_id" name="email_id" type="email" placeholder="Enter Email Address"
				 value="<?php echo $_SESSION['EMAIL_ID']?>" onKeyUp="ValidateEmail(this)" readonly>
              </div>
            </div>
			<div class="form-group col-sm-12">
              <div class="col-md-4">
                <label for="pass">Old Password :</label> <label style="color:#FF0000">*</label>
				 <input type="password" class="form-control" id="opassword" name="opassword" placeholder="Old Password" 
				  value="<?php echo set_value('opassword')?>" onKeyUp="isalphanum(this)" data-toggle="password">
				  <?php echo form_error('opassword','<div style="color:#FF0000;">','</div>'); ?>
				  <p style="font-size:13px; color:#FF0000;"><?php echo $this->session->flashdata('msg'); ?></p>
              </div>
              </div>
			  
          <div class="form-group col-sm-12">
              <div class="col-md-4">
                <label for="pass">New Password :</label> <label style="color:#FF0000">*</label>
				 <input type="password" class="form-control" id="password" name="password" placeholder="New Password" 
				  value="<?php echo set_value('password')?>" onKeyUp="isalphanum(this)" data-toggle="password">
				  <?php echo form_error('password','<div style="color:#FF0000;">','</div>'); ?>
				  
              </div>
              </div>
			  <div class="form-group col-sm-12">
              <div class="col-md-4">
                <label for="cpass">Confirm Password :</label> <label style="color:#FF0000">*</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" 
				  value="<?php echo set_value('cpassword')?>" onKeyUp="isalphanum(this)">
				  <?php echo form_error('cpassword','<div style="color:#FF0000;">','</div>'); ?>
              </div>
            </div>
			
        </div>
        <!-- /.box-body -->
        <div class="box-footer" align="center">
         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
		  <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button> 
		  <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>User/userlist"> <i class="fa fa-arrow-left"></i> Back</a>
       </div>
		
		</form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

