<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-medkit" style="font-size:18px;color:#3c8dbc"></i> Add Speciality</h3>
          </div>
          <form method="post" action="<?php echo base_url()?>Speciality/addspeciality" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group col-sm-12">
		  <div class="col-md-6">
                <label for="speciality">Speciality <label style="color:#FF0000"> *</label></label>
                <input class="form-control" id="speciality" name="speciality" type="text" placeholder="Enter Speciality"
				 value="<?php echo set_value('speciality')?>" onKeyUp="isalpha(this)">
                  <?php echo form_error('speciality','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			 
          </div>
		  <div class="form-group col-sm-12">
		  <div class="col-md-6">
                <label for="abtspeciality">About Speciality <label style="color:#FF0000"> *</label></label>
                <textarea class="form-control" rows="6" id="abtspeciality" name="abtspeciality" cols="10" placeholder="Enter About Speciality"
				style="width: 100%; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('abtspeciality')?></textarea>
                  <?php echo form_error('abtspeciality','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  
          </div>
		 </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
            <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button> 
			<a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>Speciality/specialitylist"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
		</form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

