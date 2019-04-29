<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user-secret" style="font-size:18px;color:#3c8dbc"></i> Add User :</h3>
          </div>
          <form method="post" action="<?php echo base_url()?>User/adduser" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group col-sm-12">
              <div class="col-md-4">
                <label for="fisrtname">First Name </label> <label style="color:#FF0000"> *</label>
                <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter First Name"
				 value="<?php echo set_value('firstname')?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('firstname','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-4">
                <label for="middlename">Middle Name </label>
                <input class="form-control" id="middlename" name="middlename" type="text" placeholder="Enter Middle Name"
				 value="<?php echo set_value('middlename')?>" onKeyUp="isalpha(this)">				 
			 </div>
              <div class="col-md-4">
                <label for="lastname">Last Name </label> <label style="color:#FF0000"> *</label>
                <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter Last Name"
				 value="<?php echo set_value('lastname')?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('lastname','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
          </div>
		  <div class="form-group col-sm-12">
		  <div class="col-md-4 form-group">
				<label for="gender">Gender </label> <label style="color:#FF0000"> *</label>
				<?php
						$cbo_gender = 
						 array(   
									'' => 'Select',
									'Male' => 'Male',
									'Female' =>'Female',
									'Other' =>'Other'
								  
								);
						$attributes = 'class = "form-control" id = "cbo_gender"';
						echo form_dropdown('cbo_gender',$cbo_gender, set_value('cbo_gender'), $attributes);
				?>
				<?php echo form_error('cbo_gender','<div style="color:#FF0000;">','</div>'); ?>		   
						 
			  </div>
			  <div class="col-md-4">
                <label for="usertype">User Type </label> <label style="color:#FF0000"> *</label>
				<?php 
				$attributes = 'class = "form-control" id = "cbo_user_type" name = "cbo_user_type"';
				echo form_dropdown('cbo_user_type',$cbo_user_type,set_value('cbo_user_type') , $attributes);
				 ?><?php echo form_error('cbo_user_type','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-4">
                <label for="speciality">Speciality </label> <label style="color:#FF0000"> *</label>
				<?php 
				$attributes = 'class = "form-control" id = "cbo_speciality" name = "cbo_speciality"';
				echo form_dropdown('cbo_speciality',$cbo_speciality,set_value('cbo_speciality') , $attributes);
				 ?><?php echo form_error('cbo_speciality','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
           </div>
		  <div class="form-group col-sm-12">
              <div class="col-md-6">
                <label for="mobileno">Mobile Number </label> <label style="color:#FF0000"> *</label>
                <input class="form-control" name="mobileno" id="mobileno" type="text" placeholder="Enter Mobile Number"
				 value="<?php echo set_value('mobileno')?>" onKeyUp="isnum(this)">
                  <?php echo form_error('mobileno','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-6">
                <label for="emailid">Email Id </label> <label style="color:#FF0000"> *</label>
            	<input class="form-control" id="email_id" name="email_id" type="email" placeholder="Enter Email Address"
				 value="<?php echo set_value('email_id')?>" onKeyUp="ValidateEmail(this)">
                  <?php echo form_error('email_id','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
            </div>
          <div class="form-group col-sm-12">
              <div class="col-md-6">
                <label for="pass">Password </label> <label style="color:#FF0000"> *</label>
				 <input type="password" class="form-control" id="password" name="password" placeholder="Password" 
				  value="<?php echo set_value('password')?>" onKeyUp="isalphanum(this)" data-toggle="password">
				  <?php echo form_error('password','<div style="color:#FF0000;">','</div>'); ?>
				  
              </div>
              <div class="col-md-6">
                <label for="cpass">Confirm Password </label> <label style="color:#FF0000"> *</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" 
				  value="<?php echo set_value('cpassword')?>" onKeyUp="isalphanum(this)">
				  <?php echo form_error('cpassword','<div style="color:#FF0000;">','</div>'); ?>
              </div>
            </div>
			
			
		  <div class="form-group col-sm-12">
				<div class="col-md-6">
                <label for="address">Address </label> <label style="color:#FF0000"> *</label>
                <textarea class="textarea" rows="6" id="address" name="address" cols="10"
				style="width: 100%; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('address')?></textarea>
				<?php echo form_error('address','<div style="color:#FF0000;">','</div>'); ?> 
				</div>
		  		<div class="col-sm-4">
                <label for="displaypicture"> Profile Image </label>
                </br>
                <label class="customUpload btnUpload  btn btn-primary"  style="color #ffffff;  margin-right 10px;"> 
				<span class="logo-label"><i class="fa fa-upload" aria-hidden="true"></i> Choose Image </span>
                <input  class="upload" type="file" id="displaypicture" name="displaypicture" 
				value="<?php echo set_value('displaypicture')?>" accept="image/jpg, image/jpeg, image/png"/>
                </label>
                <p id="test" style="colorred"></p>
                <p class="help-block">* Only JPEG and JPG supported </p>
                <p class="help-block">* Max 3 MB Upload </p>
              </div>
			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
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

