<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
	<!-- Default box -->
      <div class="box">
	  <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-address-card" style="font-size:18px;color:#3c8dbc"></i> Designation List</h3>
		  <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN'){?>
		  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>Designation/adddesignation">
		  <i class="fa fa-plus fa-fw"></i>Add New</a>
		  <?php } ?>
        </div>
		<div style="color:#FF0000; padding:10px">
          <?php echo $this->session->flashdata('msg'); ?>
          </div>
        <div class="box-body">
          <div class="col-sm-12" >
          <table id="example1" class="table table-bordered table-striped table-responsive table-hover">
            <thead>
              <tr><th>Sl No</th>
                <th>Designation</th>
                 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' ){ ?>
                <th>Actions</th>
				<?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $slno = 0; ?>
              <?php foreach ($designation as $row): ?>
              <?php $slno = $slno + 1; ?>
              <tr><td><?php echo $slno; ?></td>
                <td><?php echo $row['designation'];?></td>
				 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' ){ ?>
                <td align="center"><a class="btn btn-warning btn-sm" href="<?php echo base_url() ?>Designation/updatedesignation/<?php echo $row["id"] ?>" 
				title="Click to Update this Record"><i class="fa fa-edit fa-fw fa-sm"></i></a>
                  
                  <?php } ?>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <!-- table end-->
        </div>
        </div>
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- /.content-wrapper -->
<script type="text/javascript">
	function show_confirm(act,gotoid)
	{
	if(act=="edit")
	var r=confirm("Do you really want to edit?");
	else
	var r=confirm("Do you really want to delete?");
	
	if (r==true){
	window.location="<?php echo base_url();?>Designation/"+act+"/"+gotoid;
	}
	
	}
</script>

