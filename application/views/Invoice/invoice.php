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
        <div class="col-md-3 invoice-col">
          From,
          <address>
            <strong><?php echo $_SESSION['USER_FULL_NAME'] ?></strong><br>
            <?php echo $_SESSION['ADDRESS'] ?><br>
            <b>Phone:</b> <?php echo $_SESSION['PHONE_NO'] ?><br>
            <b>Email:</b> <?php echo $_SESSION['EMAIL_ID'] ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-md-9 invoice-col text-right">
          <b>Invoice No: <?php echo $auto_code['series_id'];echo $auto_code['user_id'];echo "-"; echo $auto_code['continues_count']?></b><br>
          <b>Invoice Date:</b> <?php $datestring = date('d-m-Y');
        $time = time(); echo  mdate($datestring, $time)?><br>
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
					  <th class="text-center" width="5%">Action</th>
					</tr>
					</thead>
					<tbody>
					
					<form  method="post" action="<?php echo base_url()?>Invoice/createinvoice" enctype="multipart/form-data">
					<tr>
					<input class="form-control" id="productid" name="productid" type="hidden">
					<input class="form-control" id="productcode" name="productcode" type="hidden">
					<input class="form-control" id="stripsinbox" name="stripsinbox" type="hidden">
					<input class="form-control" id="pcsinstrip" name="pcsinstrip" type="hidden">
					
					<input class="form-control" id="bottlesinbox" name="bottlesinbox" type="hidden">
					<input class="form-control" id="mlinbottle" name="mlinbottle" type="hidden">
					
					<input class="form-control" id="prodtype" name="prodtype" type="hidden">
					<input class="form-control" id="stockinbox" name="stockinbox" type="hidden">
					<input class="form-control" id="stockinstrip" name="stockinstrip" type="hidden">
					<input class="form-control" id="botstockinbox" name="botstockinbox" type="hidden">
					<input class="form-control" id="stockinbottle" name="stockinbottle" type="hidden">
					<input class="form-control" id="stockinpcs" name="stockinpcs" type="hidden">
					  <td><input class="form-control" id="productname" name="productname" type="text" placeholder="Search Product" onKeyUp="isalphanum(this)">
						  <?php echo form_error('productname','<div style="color:#FF0000;">','</div>'); ?> 
						  <?php echo form_error('prodcount','<div style="color:#FF0000;">','</div>'); ?>
						  </td>
					  <td><input class="form-control" id="batchno" name="batchno" type="text" readonly=""></td>
					  <td><input class="form-control text-center" id="stock" name="stock" type="text" readonly=""></td>
					 <td><input class="form-control text-center" id="salerate" name="salerate" type="text" readonly=""></td>
					 <td><input class="form-control text-center" id="tax" name="tax" type="text" readonly=""></td>
					  <td><?php
									$cbo_uom = 
									 array(   
												'Pcs' =>'Pcs',
												'Boxes' => 'Boxes',
												'Strips' =>'Strips',
												'Bottles' =>'Bottles',
												'Ml' =>'Ml'
												
											  
											);
									$attributes = 'class = "form-control" id = "cbo_uom"';
									echo form_dropdown('cbo_uom',$cbo_uom,set_value('cbo_uom'), $attributes);
							?>
							<?php echo form_error('cbo_uom','<div style="color:#FF0000;">','</div>'); ?></td>
					  <td><input class="form-control" id="qty" name="qty" type="number" placeholder="Qty" autocomplete="off" min="1" 
								 value="<?php echo set_value('qty')?>" onKeyUp="isnum(this)" width="10%">
								 <?php echo form_error('qty','<div style="color:#FF0000;">','</div>'); ?> </td>
					  <td><input class="form-control text-center" id="lineamount" name="lineamount" type="text" placeholder="Total" readonly="" /></td>
					  <td><input class="form-control text-center" id="linetaxamt" name="linetaxamt" type="text" placeholder="Tax" readonly="" /></td>
					  <td align="center" style="padding-top: 10px;">
					  <button type="submit" id="productadd" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button>
					  </td>
					</tr>
					</form>
					
					<?php foreach ($lineinvoice as $row): ?>
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
					  <td align="center">
					  <a  class="btn btn-primary btn-sm" onClick="show_confirm('delete_record','<?php echo $row["id"] ?>')" 
                                    title="Delete"><i class="fa fa-trash fa-sm"></i></a></td>
					</tr>
					 <?php endforeach ?>
					</tbody>
					</table>
		
		<form  method="post" action="<?php echo base_url()?>Invoice/saveinvoice" enctype="multipart/form-data">
		 <div class="box-body" style="padding:0px">
		<div class="col-md-8" style="padding:0px">
		<div class="box" style="min-height:280px">
			<div class="box-header with-border">
			  <h4 class="box-title">Patient Details :</h4>
			  </div>
			  <div class="box-body">
		<div class="col-md-6  form-group">
				<label for="name">Patient Name </label> <label style="color:#FF0000"> *</label>
				<input class="form-control" id="prodcount" name="prodcount" type="hidden" value="<?php echo count($lineinvoice)?>">
					<input class="form-control" id="invoiceno" name="invoiceno" type="hidden" value="<?php echo $auto_code['series_id']; echo $auto_code['continues_count']?>">
				<input class="form-control" id="patientname" name="patientname" type="text" placeholder="Enter Patient Name"
				 value="<?php echo set_value('patientname')?>" onKeyUp="isalpha(this)">
				  <?php echo form_error('patientname','<div style="color:#FF0000;">','</div>'); ?> 
		</div>
			
		<div class="col-md-6  form-group">
				<label for="gender">Gender </label> <label style="color:#FF0000"> *</label>
				<?php
						$cbo_gender = 
						 array(   
									'' => 'Select',
									'Male' => 'Male',
									'Female' =>'Female',
									'Other' =>'Other'
								  
								);
						$attributes = 'class = "form-control" id = "cbo_gender"';
						echo form_dropdown('cbo_gender',$cbo_gender, set_value('cbo_gender'), $attributes);
				?>
				<?php echo form_error('cbo_gender','<div style="color:#FF0000;">','</div>'); ?>		
		</div>
		<div class="col-md-4  form-group">
				<label for="phoneno">Phone Number </label> <label style="color:#FF0000"> *</label>
				<input class="form-control" id="patientphoneno" name="patientphoneno" type="text" placeholder="Enter Phone Number"
				 value="<?php echo set_value('patientphoneno')?>" onKeyUp="isnum(this)" maxlength="10">
				  <?php echo form_error('patientphoneno','<div style="color:#FF0000;">','</div>'); ?> 
		</div>
		<div class="col-md-2  form-group">
				<label for="age">Age </label> <label style="color:#FF0000"> *</label>
				<input class="form-control" id="age" name="age" type="text" placeholder="Enter Age"
				 value="<?php echo set_value('age')?>" onKeyUp="isnum(this)" maxlength="3">
				  <?php echo form_error('age','<div style="color:#FF0000;">','</div>'); ?> 
		</div>
		
			<div class="col-md-6  form-group">
				<label for="address">Address </label> <label style="color:#FF0000"> *</label>
				<textarea class="textarea" rows="6" id="address" name="address" cols="10"
				style="width: 100%; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('address')?></textarea>
				<?php echo form_error('address','<div style="color:#FF0000;">','</div>'); ?> 
				
			</div>	
			</div>
		</div>
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
						<?php if($Mainsubtotal['grossamt'] == ''){?>
						<td width="25%"><input class="form-control text-center"  type="text"  readonly=""
				 		value="0.00"></td>
						<?php }else {?>
						<td  width="25%">
						<input class="form-control text-center" id="totalgrossamt" name="totalgrossamt" type="text" readonly=""
				 		value="<?php echo $Mainsubtotal['grossamt'];?>">
						</td>
						<?php }?>
					  </tr>
					  <tr>
						<th style="padding-top: 20px;">Tax:</th>
						<?php if($Mainsubtotal['grossamt'] == ''){?>
						<td width="25%"><input class="form-control text-center" type="text" readonly=""
				 		value="0.00"></td>
						<?php }else {?>
						<td width="25%">
						<input class="form-control text-center" id="totaltaxamt" name="totaltaxamt" type="text"  readonly=""
				 		value="<?php echo $MaintaxAmt['totaltaxamt'];?>">
						
						</td>
						<?php }?></td>
						
					  </tr>
					  <tr>
						<th style="padding-top: 20px;">Fees:</th>
						<td width="25%">
						<input class="form-control text-center" id="fees" name="fees" type="number" min="0" placeholder="0" 
				 		value="<?php echo set_value('fees');?>">
						<?php echo form_error('fees','<div style="color:#FF0000;">','</div>'); ?> 
						</td>
						
					  </tr>
					  
					  <tr>
						<th style="padding-top: 20px;">Total:</th>
						<?php if($Mainsubtotal['grossamt'] == ''){?>
						<td width="25%"><input class="form-control text-center" type="text" readonly=""
				 		value="0.00"></td>
						<?php }else {?>
						<td width="25%">
						<input class="form-control text-center" id="totalamt" name="totalamt" type="text"  readonly=""
				 		value="<?php echo $MainAmt['totalamt'];?>">
						</td>
						<?php }?></td>
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
            <button type="submit" id="savbtn" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
            <button type="reset" class="btn btn-primary btn-sm"> <i class="fa fa-repeat" aria-hidden="true"></i> Reset</button> 
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
























