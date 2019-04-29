<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-book"></i> Add Version :</h3>
          </div>
          <form method="post" action="<?php echo base_url()?>Version/addversion" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group col-sm-12">
		  <div class="col-md-4">
                <label for="projectmanager">Project name :</label>
				  <?php $attributes = 'class = "form-control" id = "cbo_project" name = "cbo_project"';
                        echo form_dropdown('cbo_project',$cbo_project,set_value('project_id'), $attributes);
                   ?>
                 <?php echo form_error('cbo_project','<div style="color:#FF0000;">','</div>'); ?>
				  </div>
             <div class="col-md-4">
                <label for="version">Project version :</label>
                <input class="form-control" id="version" name="version" type="text" placeholder="Enter Version"
				 value="<?php echo set_value('version')?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('version','<div style="color:#FF0000;">','</div>'); ?> 
              </div>
			  
          </div>
		 
		  
          </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
            <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button> 
			<a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>Version/versionlist"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
		</form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

