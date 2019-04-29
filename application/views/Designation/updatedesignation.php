<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-address-card" style="font-size:18px;color:#3c8dbc"></i> Update Designation</h3>
          </div>
          <form method="post" action="<?php echo base_url()?>Designation/updatedesignation/<?php echo $designation_row['id']?>" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group col-sm-12">
		  <div class="col-md-6">
                <label for="designation">Designation </label>
                <input class="form-control" id="designation" name="designation" type="text" placeholder="Enter Designation"
				 value="<?php echo $designation_row['designation']?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('designation','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  
          </div>
		 </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
            <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button> 
			<a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>Designation/designationlist"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
		</form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

