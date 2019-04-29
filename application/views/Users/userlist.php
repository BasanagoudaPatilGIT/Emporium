<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
	<!-- Default box -->
      <div class="box">
	  <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user-secret" style="font-size:18px;color:#3c8dbc"></i> Users List</h3>
		  <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' ){?>
		  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>User/adduser">
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
                <th>User Name</th>
                <th>Speciality</th>
                <th>User Id</th>
                <th>Mobile Number</th>
                <th>Status</th>
                 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' ){ ?>
                <th>Actions</th>
				<?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $slno = 0; ?>
              <?php foreach ($user as $row): ?>
              <?php $slno = $slno + 1; ?>
              <tr><td><?php echo $slno; ?></td>
                <td><a href="<?php echo base_url() ?>User/user_view/<?php echo $row["id"] ?>" title="Click to view user details">
				<?php echo $row['first_name'];?>&nbsp; <?php echo $row['last_name'];?></a></td>
				<td><?php echo $row['speciality'];?></td>
				<td><?php echo $row['ent_id']; ?></td>
                <td><?php echo $row['mobile_no']; ?></td>
                <?php if(strtoupper($row['status']) != 'INACTIVE'   ){?>
                 <td class="text-center"><span class="label" style="background-color:#3cb371; padding:5px; 
				 color:#fff"><?php echo $row['status'];?></span></td>
                 <?php }elseif(strtoupper($row['status']) != 'ACTIVE'  ){?>
                 <td class="text-center"><span class="label" style="background-color:#ff6347; padding:5px; 
				 color:#fff"><?php echo $row['status'];?></span></td>
                <?php }?>
                 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' ){ ?>
                <td align="center"><a class="btn btn-warning btn-sm" href="<?php echo base_url() ?>index.php/User/updateuser/<?php echo $row["id"] ?>" title="Click to Update this TestCase"><i class="fa fa-edit"></i></a>
                  <?php /*?><a class="btn btn-danger btn-sm" href="" onClick="show_confirm('delete_record','<?php echo $row["id"] ?>')" title="Click to Delete this TestCase"><i class="fa fa-trash fa-fw fa-lg"></i></a><?php */?>
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
	window.location="<?php echo base_url();?>index.php/Project/"+act+"/"+gotoid;
	}
	
	}
</script>

