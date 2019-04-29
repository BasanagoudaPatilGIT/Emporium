<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user-secret" style="font-size:18px;color:#3c8dbc"></i> Update User </h3>
        </div>
        <div class="box-body">
          <form method="post" action="<?php echo base_url()?>User/updateuser/<?php echo $user_row['id']?>" enctype="multipart/form-data">
          <div class="form-group col-sm-12">
				<div class="col-md-4 form-group">
                    <label>Profile Image </label>
                    <br />
                    <input type="hidden" name="displaypicture_hidden"  
                        value="<?php echo $user_row['img_name']?>"/>
                   <img class=" img-responsive col-md-6" 
                        src="<?php echo base_url() ?>upload/profile/<?php echo $user_row['img_name'] ?>"/>
                  </div>
			   
			  </div>
		  <div class="form-group col-sm-12">
              <div class="col-md-4">
                <label for="fisrtname">First Name </label> <label style="color:#FF0000">*</label>
                <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter First Name"
				 value="<?php echo $user_row['first_name']?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('firstname','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-4">
                <label for="middlename">Middle Name </label>
                <input class="form-control" id="middlename" name="middlename" type="text" placeholder="Enter Middle Name"
				 value="<?php echo $user_row['middle_name']?>" onKeyUp="isalpha(this)">
				  </div>
              <div class="col-md-4">
                <label for="lastname">Last Name </label> <label style="color:#FF0000">*</label>
                <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter Last Name"
				 value="<?php echo $user_row['last_name']?>" onKeyUp="isalpha(this)">
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
						echo form_dropdown('cbo_gender',$cbo_gender,$user_row['gender'], $attributes);
				?>
				<?php echo form_error('cbo_gender','<div style="color:#FF0000;">','</div>'); ?>		   
						 
			  </div>
			  <div class="col-md-4">
                <label for="usertype">User Type </label> <label style="color:#FF0000">*</label>
				<?php 
				$attributes = 'class = "form-control" id = "cbo_user_type" name = "cbo_user_type"';
				echo form_dropdown('cbo_user_type',$cbo_user_type,$user_row['user_type'] , $attributes);?>
				 <?php echo form_error('cbo_user_type','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  
			  <div class="col-md-4">
                <label for="speciality">Speciality </label> <label style="color:#FF0000"> *</label>
				<?php 
				$attributes = 'class = "form-control" id = "cbo_speciality" name = "cbo_speciality"';
				echo form_dropdown('cbo_speciality',$cbo_speciality,$user_row['speciality'] , $attributes);
				 ?><?php echo form_error('cbo_speciality','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
           </div>
		  <div class="form-group col-sm-12">
		  <div class="col-md-4">
                <label for="entid">User Id </label> <label style="color:#FF0000">*</label>
                <input class="form-control" name="entid" id="entid" type="text"
				 value="<?php echo $user_row['ent_id']?>" onKeyUp="isnum(this)" readonly="">
              </div>
              <div class="col-md-4">
                <label for="mobinum">Mobile Number </label> <label style="color:#FF0000">*</label>
                <input class="form-control" name="mobileno" id="mobileno" type="text" placeholder="Enter Mobile Number"
				 value="<?php echo $user_row['mobile_no']?>" onKeyUp="isnum(this)">
                  <?php echo form_error('mobileno','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  <div class="col-md-4">
                <label for="emailid">Email Id </label> <label style="color:#FF0000">*</label>
            	<input class="form-control" id="emailid" name="emailid" type="email" placeholder="Enter Email Address"
				 value="<?php echo $user_row['email_id']?>" onKeyUp="ValidateEmail(this)">
                  <?php echo form_error('emailid','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  
            </div>
          
		  <div class="form-group col-sm-12">
		  <div class="col-md-4">
                <label for="address">Address </label> <label style="color:#FF0000">*</label>
                <textarea class="textarea" rows="6" id="address" name="address" cols="10"
				style="width: 100%; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;"><?php echo $user_row['address']?></textarea>
				<?php echo form_error('address','<div style="color:#FF0000;">','</div>'); ?> 
				</div>
		  <div class="col-sm-4">
                <label for="displaypicture"> Profile Image </label>
                </br>
                <label class="customUpload btnUpload  btn btn-primary"  style="color: #ffffff;  margin-right: 10px;"> 
				<span class="logo-label"><i class="fa fa-upload" aria-hidden="true"></i> Choose Image </span>
                <input  class="upload" type="file" id="displaypicture" name="displaypicture" 
				value="<?php echo set_value('displaypicture')?>" accept="image/jpg, image/jpeg, image/png"/>
                </label>
                <p id="test" style="color:red"></p>
                <p class="help-block">* Only JPEG and JPG supported </p>
                <p class="help-block">* Max 3 MB Upload </p>
              </div>
			   
			   <div class="col-md-4 form-group">
                    <label for="Status">Status </label>
                    <?php
							$cbo_status = 
							 array(   
							 			'Active' => 'Active',
									    'InActive' =>'InActive'
									  
									);
							$attributes = 'class = "form-control" id = "cbo_status"';
							echo form_dropdown('cbo_status',$cbo_status, $user_row['status'], $attributes);
					?>
							   
							 
                  </div>
			  </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
              <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button> 
			  <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>User/userlist"> <i class="fa fa-arrow-left"></i> Back</a>
       
          </form>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

