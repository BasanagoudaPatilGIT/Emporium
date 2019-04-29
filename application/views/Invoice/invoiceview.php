  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Main content -->
    <section class="content">
	<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title"><i class="fa fa-money" style="font-size:18px;color:#3c8dbc"></i> Invoice :</h4>
          </div>
        <div class="box-body">
		<div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">User Details :</h4>
          </div>
         <div class="box-body">  
	
      <div class="invoice-info">
        <div class="col-md-4 invoice-col">
          From,
          <address>
            <strong><?php echo $_SESSION['USER_FULL_NAME'] ?></strong><br>
            <?php echo $_SESSION['ADDRESS'] ?><br>
            <b>Phone:</b> <?php echo $_SESSION['PHONE_NO'] ?><br>
            <b>Email:</b> <?php echo $_SESSION['EMAIL_ID'] ?>
          </address>
        </div>
		<!-- /.col -->
        <div class="col-md-4 invoice-col">
          To,
          <address>
			<b>Name:</b> <?php echo $invoice_header['patient_name'] ?><br>
			<b>Gender:</b> <?php echo $invoice_header['patient_gender'] ?><br>
			<b>Age:</b> <?php echo $invoice_header['age'] ?><br>
			<b>Address:</b> <?php echo $invoice_header['patient_address'] ?><br>
            <b>Phone:</b> <?php echo $invoice_header['patient_phoneno'] ?>
           </address>
        </div>
        <!-- /.col -->
        <div class="col-md-4 invoice-col text-right">
          <b>Invoice No: <?php echo $invoice_header['invoice_no'] ?></b><br>
          <b>Invoice Date:</b> <?php echo $invoice_header['created_datetime'] ?> <br>
        </div>
        <!-- /.col -->
      </div>

	</div>
	</div>
				  <table class="table table-bordered text-left" style="border: 3px solid #d2d6de;">
					<thead>
					<tr>
					  <th width="30%">Product Name</th>
					  <th class="text-center" width="15%">BatchNo</th>
					  <th class="text-center" width="6%">Stock</th>
					  <th class="text-center" width="6%">SaleRate</th>
					  <th class="text-center" width="6%">Tax[%]</th>
					  <th class="text-center" width="8%">UOM</th>
					  <th class="text-center" width="7%">Qty</th>
					  <th class="text-center" width="9%">Gross Amount</th>
					  <th class="text-center" width="6%">Tax[Rs.]</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($invoice_body as $row): ?>
					<tr>
					  <td style="padding-left:15px"><?php echo $row['product_name'];?></td>
					  <td align="center"><?php echo $row['batchno'];?></td>
					  <td align="center"><?php echo $row['stock'];?></td>
					  <td align="center"><?php echo $row['sale_rate'];?></td>
					  <td align="center"><?php echo $row['tax_percent'];?></td>
					  <td align="center"><?php echo $row['product_uom'];?></td>
					  <td align="center"><?php echo $row['product_qty'];?></td>
					  <td align="center"><?php echo $row['sub_total'];?></td>
					  <td align="center"><?php echo $row['tax_amount'];?></td>
					</tr>
					 <?php endforeach ?>
					</tbody>
					</table>
		
		<form  method="post" action="<?php echo base_url()?>Invoice/saveinvoice" enctype="multipart/form-data">
		 <div class="box-body">
		<div class="col-md-8" style="padding:0px">
		
		</div>
		<div class="col-md-4" style="padding:0px;">
		<div class="box" style="min-height:280px">
			<div class="box-header with-border">
			  <h4 class="box-title">Total Amount Details:</h4>
			  </div>
			  <div class="box-body">
			  <div class="col-md-12">
				<div class="table-responsive ">
					<table class="table table-bordered text-center">
					 <tr>
						<th width="38%" style="padding-top: 20px;">Gross: </th>
						<td  width="25%">
						<input class="form-control text-center" id="grossamt" name="grossamt" type="text" readonly=""
				 		value="<?php echo $invoice_header['total_gross_amt'];?>">
						</td>
						
					  </tr>
					  <tr>
						<th style="padding-top: 20px;">Tax:</th>
						<td width="25%">
						<input class="form-control text-center" id="totaltax" name="totaltax" type="text" readonly=""
				 		value="<?php echo $invoice_header['total_tax_amt'];?>">
						
						</td>
						
						
					  </tr>
					  <tr>
						<th style="padding-top: 20px;">Fees:</th>
						<td width="25%">
						<input class="form-control text-center" id="fees" name="fees" type="text" readonly=""
				 		value="<?php echo $invoice_header['fees'];?>">
						</td>
						
					  </tr>
					  <tr>
						<th style="padding-top: 20px;">Total:</th>
						<td width="25%">
						<input class="form-control text-center" id="totalamt" name="totalamt" type="text" readonly=""
				 		value="<?php echo $invoice_header['invoice_amt'];?>">
						</td>
					  </tr>
					</table>
				</div>
			  </div>
			  </div>
		</div>
		</div>
		</div>
		  <!-- this row will not appear when printing -->
       <div class="box-footer" align="right"> 
			<a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>Invoice/invoicelist"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>  
		
		<!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
 
<script type="text/javascript">
	function show_confirm(act,gotoid)
	{
		if(act=="edit")
			var r=confirm("Do you really want to edit?");
		else
			var r=confirm("Do you really want to delete?");
		
		if (r==true){
			window.location="<?php echo base_url();?>Invoice/"+act+"/"+gotoid;
		}
	
	}
</script>
























