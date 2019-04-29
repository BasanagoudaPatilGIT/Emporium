


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user-secret" style="font-size:18px;color:#3c8dbc"></i> User Details</h3>
			  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>User/userlist"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="box-body">
		  <div class="col-md-4">
           <!-- Profile Image -->
          <div class="box box-default" style="border:1px solid #ddd">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>upload/profile/<?php echo $user_row['img_name'] ?>" 
			  alt="User profile picture">

              <h3 class="profile-username text-center">
			  <?php echo $user_row['first_name'] ?>&nbsp;<?php echo $user_row['last_name'] ?></h3>

              <p class="text-muted text-center"><?php echo $user_row['speciality'] ?></p>

              <ul class="list-group list-group-unbordered" >
			  <li class="list-group-item">
                  <b>User ID</b> <a class="pull-right"><?php echo $user_row['ent_id'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Mobiile Number</b> <a class="pull-right"><?php echo $user_row['mobile_no'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email ID</b> <a class="pull-right"><?php echo $user_row['email_id'] ?></a>
                </li>
				<?php if(strtoupper($user_row['status']) == 'INACTIVE'   ){?>
                <li class="list-group-item">
                  <b>Status</b> <span class="label pull-right" style="background-color:#ff6347; padding:5px; 
				 color:#fff"><?php echo $user_row['status'];?></span>
                </li>
				<?php }elseif(strtoupper($user_row['status']) == 'ACTIVE'   ){?>
				<li class="list-group-item">
                  <b>Status</b> <span class="label pull-right" style="background-color:#3cb371; padding:5px; 
				 color:#fff"><?php echo $user_row['status'];?></span>
                </li>
				<?php }?>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
		  </div>
        
		<div class="col-md-8">
		 <!-- Profile Image -->
          <div class="box box-default" style="border:1px solid #ddd">
            <div class="box-body box-profile">
				<ul class="list-group list-group-unbordered" >
			  <li class="list-group-item">
                  <b>Speciality </b> <pre><b><u><?php echo $user_row['speciality'] ?></u></b> - <?php echo $user_row['abtspeciality'] ?></pre>
                </li>
              </ul>

            </div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered" >
			  <li class="list-group-item">
                  <b>Address </b> <pre><?php echo $user_row['address'] ?></pre>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>

		</div>
		</div>
        
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

