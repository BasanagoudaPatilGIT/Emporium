<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list" style="font-size:16px;color:#3c8dbc"></i> Update Product :</h3>
      </div>
      <form method="post" action="<?php echo base_url()?>Product/updateproduct/<?php echo $product_row['id'] ?>" enctype="multipart/form-data" autocomplete="off">
        <div class="box-body">
          <div class="box-body col-md-4">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-database" style="font-size:16px;color:#3c8dbc"></i> Product Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="productcode">
                  Product Code
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="productcode" name="productcode" type="text" readonly=""
						 value="<?php echo $product_row['product_code'] ?>">
                  <?php echo form_error('productcode','<div style="color:#FF0000;">','</div>'); ?> </div>
                <div class="form-group col-md-12">
                  <label for="productname">
                  Product Name
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="productname" name="productname" type="text" placeholder="Product Name"
				 value="<?php echo $product_row['product_name'] ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('productname','<div style="color:#FF0000;">','</div>'); ?> 
				  </div>
				  <?php if($product_row['product_type'] == "Tablet") {?>
				  <div class="form-group col-md-12">
                  <label for="curqty">
                  Available Stock[In Pcs]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="curqty" name="curqty" type="text" readonly="" placeholder="Current Qty"  
				 value="<?php echo $product_row['product_qty'] ?>">
                </div>
				 <?php }else if($product_row['product_type'] == "Liquid") {?>
				<div class="form-group col-md-12">
                  <label for="curqty">
                  Available Stock[In Bottles]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="curqty" name="curqty" type="text" readonly="" placeholder="Current Qty"  
				 value="<?php echo (int)($product_row['product_qty'] / $product_row['mlinbottle'])  ?>">
                </div>
				  <?php }?>
				
				 <div class="form-group col-md-12">
                  <label for="batch">
                  Batch No.
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="batch" name="batch" type="text" readonly="" placeholder="Batch No."  
				 value="<?php echo $product_row['batchno'] ?>">
                </div>
				<div class="form-group col-md-12">
                  <label for="taxper">
                  Tax %
                  </label>
                  <input class="form-control" id="taxper" name="taxper" type="text" placeholder="Tax %"
				 value="<?php echo $product_row['tax_percent']?>">
				  <?php echo form_error('taxper','<div style="color:#FF0000;">','</div>'); ?> 
				  </div>
                <div class="form-group col-sm-12">
                  <label for="abtproduct">About Product </label>
                  <textarea class="form-control" rows="3" id="abtproduct" name="abtproduct" cols="10" placeholder="Enter About Product"
				style="width: 100%; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;"><?php echo $product_row['abtproduct'] ?></textarea>
                </div>
				 
				
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div class="box-body col-md-4">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-money" style="font-size:16px;color:#3c8dbc"></i> Amount Details</h3>
              </div>
              <div class="box-body">
				<?php if($product_row['product_type'] == "Tablet") {?>
                <div class="form-group col-md-12">
                  <label for="mrp">
                  MRP [For Pc/Bottle.]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="mrp" name="mrp" type="text" placeholder="MRP"
				 value="<?php echo $product_row['mrp'] ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('mrp','<div style="color:#FF0000;">','</div>'); ?> </div>
                <div class="form-group col-md-12">
                  <label for="purrate">
                  Purchase Rate [For Pc/Bottle.]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="purrate" name="purrate" type="text" placeholder="Purchase rate"
				 value="<?php echo $product_row['purrate'] ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('purrate','<div style="color:#FF0000;">','</div>'); ?> </div>
                <div class="form-group col-md-12">
                  <label for="salerate">
                  Sale Rate [For Pc/Bottle.]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="salerate" name="salerate" type="text" placeholder="Sale rate"
				 value="<?php echo $product_row['salerate'] ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('salerate','<div style="color:#FF0000;">','</div>'); ?> </div>
				  
				  <?php }else if($product_row['product_type'] == "Liquid") {?>
				  
				   <div class="form-group col-md-12">
                  <label for="mrp">
                  MRP [For Pc/Bottle.]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="mrp" name="mrp" type="text" placeholder="MRP"
				 value="<?php echo $product_row['MRP']?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('mrp','<div style="color:#FF0000;">','</div>'); ?> </div>
                <div class="form-group col-md-12">
                  <label for="purrate">
                  Purchase Rate [For Pc/Bottle.]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="purrate" name="purrate" type="text" placeholder="Purchase rate"
				 value="<?php echo $product_row['purchaseRate']  ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('purrate','<div style="color:#FF0000;">','</div>'); ?> </div>
                <div class="form-group col-md-12">
                  <label for="salerate">
                  Sale Rate [For Pc/Bottle.]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="salerate" name="salerate" type="text" placeholder="Sale rate"
				 value="<?php echo $product_row['saleRate']  ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('salerate','<div style="color:#FF0000;">','</div>'); ?> </div>
				  
				  <?php }?>
				  
                <div class="form-group col-md-12">
                  <label for="packdate">
                  Pack Date
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" data-date-format="yyyy-mm-dd" id="packdate" name="packdate" type="text" placeholder="yyyy-mm-dd"
				 value="<?php echo $product_row['packdate'] ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('packdate','<div style="color:#FF0000;">','</div>'); ?> </div>
                <div class="form-group col-md-12">
                  <label for="expdate">
                  Expiry Date
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" data-date-format="yyyy-mm-dd" id="expdate" name="expdate" type="text" placeholder="yyyy-mm-dd"
				 value="<?php echo $product_row['expirydate'] ?>" onKeyUp="isalphanum(this)">
                  <?php echo form_error('expdate','<div style="color:#FF0000;">','</div>'); ?> </div>
              </div>
            </div>
          </div>
          <div class="box-body col-md-4">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-crosshairs" style="font-size:16px;color:#3c8dbc"></i> UOM Details</h3>
              </div>
              <div class="box-body">
			  <?php if($product_row['product_type'] == "Tablet") {?>
               	<div class="form-group col-md-12">
                  <label for="batch">
                  Strips in box.
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="strips" name="strips" type="text" placeholder="Stripts in Box" 
				 value="<?php echo $product_row['stripsinbox'] ?>" onKeyUp="isnum(this)">
				 <?php echo form_error('strips','<div style="color:#FF0000;">','</div>'); ?>
                </div>
				<div class="form-group col-md-12">
                  <label for="batch">
                  Pcs in Strip.
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="pcs" name="pcs" type="text" placeholder="Pcs in Strip" 
				 value="<?php echo $product_row['pcsinstrip'] ?>" onKeyUp="isnum(this)">
				 <?php echo form_error('pcs','<div style="color:#FF0000;">','</div>'); ?>
                </div>
				<div class="form-group col-md-12">
                  <label for="qtylmt">
                  Quantity Limit[In Pcs]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="qtylmt" name="qtylmt" type="text" placeholder="Quantity Limit"
					 value="<?php echo $product_row['qtylimit'] ?>" onKeyUp="isnum(this)">
                  <?php echo form_error('productqty','<div style="color:#FF0000;">','</div>'); ?> 
				  </div>
				<div class="form-group col-md-12">
					<label for="uom">Product UOM </label> <label style="color:#FF0000"> *</label>
					<?php
							$cbo_uom = 
							 array(   
										'' => '- Select -',
										'Boxes' => 'Boxes',
										'Strips' =>'Strips',
										'Pcs' =>'Pcs'
									  
									);
							$attributes = 'class = "form-control" id = "cbo_uom"';
							echo form_dropdown('cbo_uom',$cbo_uom,set_value('cbo_uom'), $attributes);
					?>
					<?php echo form_error('cbo_uom','<div style="color:#FF0000;">','</div>'); ?>		   
							 
				  </div>
				<?php }else if($product_row['product_type'] == "Liquid") {?>
				 <div class="form-group col-md-12">
                  <label for="batch">
                  Bottles in Box.
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="botinbox" name="botinbox" type="text" placeholder="Bottles in Box" 
				 value="<?php echo $product_row['bottlesinbox']?>" onKeyUp="isnum(this)">
				 <?php echo form_error('botinbox','<div style="color:#FF0000;">','</div>'); ?>
                </div>
				<div class="form-group col-md-12">
                  <label for="batch">
                  ml in Bottle.
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="pcs" name="mlinbot" type="mlinbot" placeholder="ml in Bottle" 
				 value="<?php echo $product_row['mlinbottle']?>" onKeyUp="isnum(this)">
				 <?php echo form_error('mlinbot','<div style="color:#FF0000;">','</div>'); ?>
                </div>
				<div class="form-group col-md-12">
                  <label for="qtylmt">
                  Quantity Limit[In Bottles]
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="qtylmt" name="qtylmt" type="text" placeholder="Quantity Limit"
					 value="<?php echo $product_row['qtylimit']  ?>" onKeyUp="isnum(this)">
                  <?php echo form_error('qtylimit','<div style="color:#FF0000;">','</div>'); ?> 
				  </div>
				<div class="form-group col-md-12">
					<label for="uom">Product UOM </label> <label style="color:#FF0000"> *</label>
					<?php
							$cbo_uom_bot = 
							 array(   
										'' => '- Select - ',
										'Boxes' => 'Boxes',
										'Bottles' =>'Bottles'
									  
									);
							$attributes = 'class = "form-control" id = "cbo_uom_bot"';
							echo form_dropdown('cbo_uom_bot',$cbo_uom_bot,set_value('cbo_uom_bot'), $attributes);
					?>
					<?php echo form_error('cbo_uom_bot','<div style="color:#FF0000;">','</div>'); ?>		   
							 
				  </div>
				 <?php }?>
                <div class="form-group col-md-12">
                  <label for="productqty">
                  Product Qty
                  <label style="color:#FF0000"> *</label>
                  </label>
                  <input class="form-control" id="productqty" name="productqty" type="text" placeholder="Product Qty"
				 value="<?php echo set_value('productqty')?>" onKeyUp="isnum(this)">
                  <?php echo form_error('productqty','<div style="color:#FF0000;">','</div>'); ?> 
				  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer" align="right">
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
