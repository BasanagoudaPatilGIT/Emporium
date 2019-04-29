<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
	<!-- Default box -->
      <div class="box">
	  <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-list" style="font-size:16px;color:#3c8dbc"></i> Products List </h3>
		 
		  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>Product/addproduct">
		  <i class="fa fa-plus fa-fw"></i>Add New</a>
		   
		  <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' ){?>
		  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>Excel/uploadmedicine">
		  <i class="fa fa-plus fa-fw"></i>Upload Medicine</a>
		  <?php } ?>
        </div>
		<div style="color:#FF0000; padding:10px">
          <?php echo $this->session->flashdata('msg'); ?>
          </div>
        <div class="box-body">
          <div class="col-md-12"  style="padding:10px" >
		   <span><b>Template Link: </b></span><a href="<?php echo base_url(); ?>Product/medicine_template" id="template">
		   <strong>Download Template</strong></a>
		   </div>
		   <div class="col-md-12" >
		  <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN'){ ?>
          <table id="example1" class="table table-bordered table-striped table-responsive table-hover">
            <thead>
              <tr><th>Sl No.</th>
                <th>User Name</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Batch Number</th>
                <th>MRP[In pcs/bottle.]</th>
                <th>Purchase Rate[In pcs/ml.]</th>
                <th>Sale Rate[In pcs/ml.]</th>
                <th>Product Qty [In pcs/bottle.]</th>
                <th>Expiry Date</th>
                 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' || strtoupper($_SESSION['USER_TYPE']) == 'DOCTOR'){ ?>
                <th>Actions</th>
				<?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $slno = 0; ?>
              <?php foreach ($product_admin as $row): ?>
              <?php $slno = $slno + 1; ?>
              <tr><td><?php echo $slno; ?></td>
                <td><?php echo $row['first_name'];?></td>
                <td><?php echo $row['product_code'];?></td>
                <td title="<?php echo $row['abtproduct'];?>"><?php echo $row['product_name'];?></td>
                <td><?php echo $row['product_type'];?></td>
                <td><?php echo $row['batchno'];?></td>
                <td align="center"><?php echo $row['mrp'];?></td>
                <td align="center"><?php echo $row['purrate']?></td>
                <td align="center"><?php echo $row['salerate']?></td>
				
				<?php if($row['product_type'] == "Tablet"){ ?>
				<?php if($row['product_qty'] > $row['qtylimit']){ ?>
                <td align="center"><?php echo $row['product_qty'];?></td>
                <?php }else{ ?>
				<td title="This product have low stock" class="text-red" align="center"><b><?php echo $row['product_qty'];?></b></td>
				<?php } ?>
				 <?php }else if($row['product_type'] == "Liquid"){ ?>
				<?php if($row['product_qty'] > $row['qtylimit']){ ?>
                <td align="center"><?php echo (int)($row['product_qty']/$row['mlinbottle'])?></td>
                <?php }else{ ?>
				<td title="This product have low stock" class="text-red" align="center"><b><?php echo (int)($row['product_qty']/$row['mlinbottle'])?></b></td>
				<?php } ?>
				<?php } ?>
				
				
				
				<?php if($row['expirydate'] >= date('Y-m-d')){ ?>
                <td align="center"><?php echo $row['expirydate'];?></td>
				<?php }else{ ?>
				<td title="This product has been expired" class="text-red" align="center"><b><?php echo $row['expirydate'];?></b></td>
				<?php } ?>
				 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN'  || strtoupper($_SESSION['USER_TYPE']) == 'DOCTOR'){ ?>
                <td align="center"><a class="btn btn-warning btn-sm" href="<?php echo base_url() ?>Product/updateproduct/<?php echo $row["id"] ?>" 
				title="Click to Update this Record"><i class="fa fa-edit"></i></a>
                  </td>
                  <?php } ?>
                
              </tr>
              <?php endforeach ?>
			
          </table>
		  <?php }else{ ?>
		  <table id="example1" class="table table-bordered table-striped table-responsive table-hover">
            <thead>
              <tr><th>Sl No.</th>
                <th>Product Code</th>
                <th>Product Name</th>
				<th>Product Type</th>
                <th>Batch Number</th>
                <th>MRP[In pcs/bottle.]</th>
                <th>Purchase Rate[In pcs/ml.]</th>
                <th>Sale Rate[In pcs/ml.]</th>
                <th>Product Qty [In pcs/bottle.]</th>
                <th>Expiry Date</th>
                 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN' || strtoupper($_SESSION['USER_TYPE']) == 'DOCTOR'){ ?>
                <th>Actions</th>
				<?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $slno = 0; ?>
              <?php foreach ($product as $row): ?>
              <?php $slno = $slno + 1; ?>
              <tr><td><?php echo $slno; ?></td>
                <td><?php echo $row['product_code'];?></td>
                <td title="<?php echo $row['abtproduct'];?>"><?php echo $row['product_name'];?></td>
				<td><?php echo $row['product_type'];?></td>
                <td><?php echo $row['batchno'];?></td> 
                <td align="center"><?php echo $row['mrp'];?></td>
                <td align="center"><?php echo $row['purrate']?></td>
                <td align="center"><?php echo $row['salerate']?></td>
				
				<?php if($row['product_type'] == "Tablet"){ ?>
				<?php if($row['product_qty'] > $row['qtylimit']){ ?>
                <td align="center"><?php echo $row['product_qty'];?></td>
                <?php }else{ ?>
				<td title="This product have low stock" class="text-red" align="center"><b><?php echo $row['product_qty'];?></b></td>
				<?php } ?>
				 <?php }else if($row['product_type'] == "Liquid"){ ?>
				<?php if($row['product_qty'] > $row['qtylimit']){ ?>
                <td align="center"><?php echo (int)($row['product_qty']/$row['mlinbottle'])?></td>
                <?php }else{ ?>
				<td title="This product have low stock" class="text-red" align="center"><b><?php echo (int)($row['product_qty']/$row['mlinbottle'])?></b></td>
				<?php } ?>
				<?php } ?>
				<?php if($row['expirydate'] >= date('Y-m-d')){ ?>
                <td align="center"><?php echo $row['expirydate'];?></td>
				<?php }else{ ?>
				<td title="This product has been expired" class="text-red" align="center"><b><?php echo $row['expirydate'];?></b></td>
				<?php } ?>
				 <?php if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN'  || strtoupper($_SESSION['USER_TYPE']) == 'DOCTOR'){ ?>
                <td align="center"><a class="btn btn-warning btn-sm" href="<?php echo base_url() ?>Product/updateproduct/<?php echo $row["id"] ?>" 
				title="Click to Update this Record"><i class="fa fa-edit"></i></a>
                  </td>
                  <?php } ?>
                
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

