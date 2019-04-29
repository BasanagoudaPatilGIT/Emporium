<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-book"></i> Update Version :</h3>
          </div>
          <form method="post" action="<?php echo base_url()?>Version/updateversion/<?php echo $version_row['id']?>" 
		  enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group col-sm-12">
		  <div class="col-md-4">
                <label for="projectmanager">Project name :</label>
				  
				  <?php $attributes = 'class = "form-control" id = "cbo_project" name = "cbo_project"';
                        echo form_dropdown('cbo_project',$cbo_project,$version_row['project_id'], $attributes);
                   ?>
                 <?php echo form_error('cbo_project','<div style="color:#FF0000;">','</div>'); ?>
				  </div>
              <div class="col-md-4">
                <label for="version">Project version :</label>
                <input class="form-control" id="version" name="version" type="text" placeholder="Enter Version"
				 value="<?php echo $version_row['version']?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('version','<div style="color:#FF0000;">','</div>'); ?> 
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
							echo form_dropdown('cbo_status',$cbo_status, $version_row['status'], $attributes);
					?>
							   
							 
                  </div>
             
          </div>
		 
         </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
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

