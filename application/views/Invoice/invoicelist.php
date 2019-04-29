<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
	<!-- Default box -->
      <div class="box">
	  <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-money" style="font-size:16px;color:#3c8dbc"></i> Invoice List </h3>
		  <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' || strtoupper($_SESSION['USER_TYPE']) == 'DOCTOR'){?>
		  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>Invoice/createinvoice">
		  <i class="fa fa-plus fa-fw"></i>Add New</a>
		  <?php } ?>
        </div>
		<div style="color:#FF0000; padding:10px">
          <?php echo $this->session->flashdata('msg'); ?>
          </div>
        <div class="box-body">
          <div class="col-md-12" >
		  <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN'){ ?>
          <table id="example1" class="table table-bordered table-striped table-responsive table-hover">
            <thead>
              <tr><th>Sl No.</th>
                <th>Invoice Number</th>
				 <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Patient Gender</th>
                <th>Patient Age</th>
                <th>Patient Phone No</th>
               <th>Invoice Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php $slno = 0; ?>
              <?php foreach ($invoice as $row): ?>
              <?php $slno = $slno + 1; ?>
              <tr><td><?php echo $slno; ?></td>
				<td><a href="<?php echo base_url() ?>Invoice/invoiceview/<?php echo $row["id"] ?>" 
				title="Click to view details"><?php echo $row['invoice_no'];?></a></td>
                <td><?php echo $row['first_name'];?>&nbsp;<?php echo $row['last_name'];?></td>
                <td><?php echo $row['patient_name'];?></td>
				<td><?php echo $row['patient_gender'];?></td>
				<td><?php echo $row['age'];?></td>
				<td><?php echo $row['patient_phoneno'];?></td>
				<td><?php echo $row['invoice_amt'];?></td>
				  
              </tr>
              <?php endforeach ?>
			
          </table>
		  <?php }else{ ?>
		   <table id="example1" class="table table-bordered table-striped table-responsive table-hover">
            <thead>
              <tr><th>Sl No.</th>
                <th>Invoice Number</th>
                <th>Patient Name</th>
                <th>Patient Gender</th>
				<th>Patient Age</th>
                <th>Patient Phone No</th>
               <th>Invoice Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php $slno = 0; ?>
              <?php foreach ($invoice as $row): ?>
              <?php $slno = $slno + 1; ?>
              <tr><td><?php echo $slno; ?></td>
				<td><a href="<?php echo base_url() ?>Invoice/invoiceview/<?php echo $row["id"] ?>" 
				title="Click to view details"><?php echo $row['invoice_no'];?></a></td>
                <td><?php echo $row['patient_name'];?></td>
				<td><?php echo $row['patient_gender'];?></td>
				<td><?php echo $row['age'];?></td>
				<td><?php echo $row['patient_phoneno'];?></td>
				<td><?php echo $row['invoice_amt'];?></td>
				</tr>
              <?php endforeach ?>
			
          </table>
		  
		  
		  <?php } ?>
		  
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
	window.location="<?php echo base_url();?>Product/"+act+"/"+gotoid;
	}
	
	}
</script>

