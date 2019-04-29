 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Main content -->
    <section class="content">
	<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title"><i class="fa fa-heartbeat" style="font-size:18px;color:#3c8dbc"></i> DashBoard :</h4>
          </div>
		  <?php if($_SESSION['USER_TYPE'] == 'Admin'){ ?>
		  <div class="box-body" style="min-height: 450px;">
			 <div class="col-md-12">
			<div class="col-md-3 col-sm-3 col-xs-12" >
			  <div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>
		
				<div class="info-box-content">
				  <span class="info-box-text">Users</span>
				  <span class="info-box-number"><?php echo $users; ?></span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-3 col-xs-12" >
			  <div class="info-box">
				<span class="info-box-icon bg-red"><i class="ion ion-android-apps"></i></span>
		
				<div class="info-box-content">
				  <span class="info-box-text">Patients</span>
				  <span class="info-box-number"><?php echo $patient_count; ?></span>
				  
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
		
			<div class="col-md-3 col-sm-3 col-xs-12" >
			  <div class="info-box">
				<span class="info-box-icon bg-green"><i class="ion ion-android-archive"></i></span>
		
				<div class="info-box-content">
				  <span class="info-box-text">Invoices</span>
				  <span class="info-box-number"><?php echo $patient_count; ?></span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-3 col-xs-12" >
			  <div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="ion ion-folder"></i></span>
		
				<div class="info-box-content">
				  <span class="info-box-text">Beds</span>
				<!--  <span class="info-box-number"></span> -->
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			
			
			
			  </div>
			
			</div>
		  <?php } else { ?>
        <div class="box-body" style="min-height: 450px;">
          <div class="col-md-6">
			  <div class="chart" id="sales-chart"  style="min-height: 300px;" ></div>
			</div>
		  <div class="col-md-6">
        <!-- /.col -->
        <div class="col-md-12 col-sm-12 col-xs-12" >
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-android-apps"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Patients</span>
			  <span class="info-box-number"><?php echo $patient_count; ?></span>
			  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-12 col-sm-12 col-xs-12" >
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-android-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Invoices</span>
			  <span class="info-box-number"><?php echo $patient_count; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12 col-sm-12 col-xs-12" >
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-folder"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Amount</span>
			  <span class="info-box-number"><?php echo round($totalamount['amount']); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<div class="col-md-12 col-sm-12 col-xs-12" >
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-folder"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today's Total Amount</span>
			  <span class="info-box-number"><?php echo round($totdayamount['amount']); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
		
		  </div>
		
		</div>  
	 	<?php }  ?>
		
		
      </div>
      <!-- /.box -->

	
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

