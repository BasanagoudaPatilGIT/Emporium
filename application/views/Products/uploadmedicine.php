<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list" style="font-size:16px;color:#3c8dbc"></i> Upload Medicine:</h3>
      </div>
      <form method="post" action="<?php echo base_url()?>Excel/uploadmedicine" enctype="multipart/form-data" autocomplete="off">
        <div class="box-body">
          <div class="box-body col-md-8">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-database" style="font-size:16px;color:#3c8dbc"></i> Medicine </h3>
				
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group col-md-6">
					<label for="uom">Doctor</label></br>
						<?php $attributes = 'class = "form-control" id = "cbo_doctor"';
							  echo form_dropdown('cbo_doctor',$cbo_doctor,set_value('cbo_doctor'), $attributes);
					        ?>
						<?php echo form_error('cbo_doctor','<div style="color:#FF0000;">','</div>'); ?> 							
				  </div>
				<div class="form-group col-md-6">
                  <label for="productcode">
                  Select file
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="upload" type="file" id="file" name="file" accept=".xls,.xlsx"/>
                  <?php echo form_error('file','<div style="color:#FF0000;">','</div>'); ?> </div>
                <a id="template"><strong>Download Template</strong></a>
				
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer" align="center">
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
          <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button>
          <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>Product/productlist"> <i class="fa fa-arrow-left"></i> Back</a> </div>
      </form>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
