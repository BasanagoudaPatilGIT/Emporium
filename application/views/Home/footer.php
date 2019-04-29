  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2016 <a href="<?php echo base_url()?>/Dashboard/index">TMT</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- SlimScroll -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url()?>LTE-Jar/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/fastclick/lib/fastclick.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>LTE-Jar/bower_components/morris.js/morris.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>LTE-Jar/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url()?>LTE-Jar/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()?>LTE-Jar/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>LTE-Jar/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>LTE-Jar/dist/js/demo.js"></script>
<script src="<?php echo base_url()?>LTE-Jar/jquery-ui-1.12.1/jquery1.12.4.js"></script>
<script src="<?php echo base_url()?>LTE-Jar/jquery-ui-1.12.1/jquery-ui.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url()?>LTE-Jar/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo base_url() ?>LTE-Jar/bower_components/dataTables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url() ?>LTE-Jar/bower_components/dataTables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script>

 $(function () {
    $('#example1').DataTable(
	);
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
	  "scrollX": true,
	  "columnDefs": [ { "width": "20%", "targets": 2},{ "width": "30%", "targets": 3},
					  { "width": "30%", "targets": 4},]
    })
	
});

</script>
<script>
$('#packdate').datepicker({
	format: 'yyyy-mm-dd',
	endDate: '0d',
	autoclose:true,
	showOnFocus:true,
	todayHighlight:true,
});
</script>

<script>
$('#expdate').datepicker({
	format: 'yyyy-mm-dd',
	startDate: '2d',
	autoclose:true,
	showOnFocus:true,
	todayHighlight:true,
});
</script>
<script>
//Template
$('#template').click( function(){
window.location="<?php echo base_url();?>Excel/medicine_template";
})
</script>

<script>
$(document).ready(function() {
$( "#productname" ).autocomplete({
  source: "<?php echo base_url()?>/Invoice/auto_search/?",
  select: function(event,ui){
if(ui.item.product_type === "Tablet"){
	 $('[name="productname"]').val(ui.item.label);
$('[name="batchno"]').val(ui.item.batchno);
$('[name="productid"]').val(ui.item.id);
$('[name="productcode"]').val(ui.item.prodcode);
$('[name="prodtype"]').val(ui.item.product_type);
$('[name="stock"]').val(ui.item.stock);
$('[name="salerate"]').val(ui.item.price);
$('[name="tax"]').val(ui.item.tax);
$('[name="stripsinbox"]').val(ui.item.stripsinbox);
$('[name="pcsinstrip"]').val(ui.item.pcsinstrip);
$('[name="bottlesinbox"]').val(ui.item.bottlesinbox);
$('[name="mlinbottle"]').val(ui.item.mlinbottle);
$('[name="stockinbox"]').val(ui.item.stockinbox);
$('[name="stockinstrip"]').val(ui.item.stockinstrips);
$('[name="botstockinbox"]').val(ui.item.botstockinbox);
$('[name="stockinbottle"]').val(ui.item.stockinbottle);
$('[name="stockinpcs"]').val(ui.item.stock);
$('[name="qty"]').val(1);
$('[name="lineamount"]').val($('#qty').val() * $('#salerate').val());
$('[name="linetaxamt"]').val($('#lineamount').val() * $('#tax').val() /100);
$('[name="cbo_uom"]').val("Pcs");
$("#cbo_uom option[value='Ml']").remove();
$("#cbo_uom option[value='Bottles']").remove();
	
}else if(ui.item.product_type === "Liquid"){
	 $('[name="productname"]').val(ui.item.label);
$('[name="batchno"]').val(ui.item.batchno);
$('[name="productid"]').val(ui.item.id);
$('[name="productcode"]').val(ui.item.prodcode);
$('[name="stock"]').val(ui.item.stock);
$('[name="prodtype"]').val(ui.item.product_type);
$('[name="salerate"]').val(ui.item.price);
$('[name="tax"]').val(ui.item.tax);
$('[name="stripsinbox"]').val(ui.item.stripsinbox);
$('[name="pcsinstrip"]').val(ui.item.pcsinstrip);
$('[name="bottlesinbox"]').val(ui.item.bottlesinbox);
$('[name="mlinbottle"]').val(ui.item.mlinbottle);
$('[name="stockinbox"]').val(ui.item.stockinbox);
$('[name="stockinstrip"]').val(ui.item.stockinstrips);
$('[name="botstockinbox"]').val(ui.item.botstockinbox);
$('[name="stockinbottle"]').val(ui.item.stockinbottle);
$('[name="stockinpcs"]').val(ui.item.stock);
$('[name="qty"]').val(1);
$('[name="lineamount"]').val($('#qty').val() * $('#salerate').val());
$('[name="linetaxamt"]').val($('#lineamount').val() * $('#tax').val() /100);
$('[name="cbo_uom"]').val("Ml");
$("#cbo_uom option[value='Pcs']").remove();
$("#cbo_uom option[value='Strips']").remove();
}

}
});
});
</script>

<script type="text/javascript">
$('#fees').change(function(){
	$fees = $('#fees').val();
	$gross =  $('#totalgrossamt').val();
	$tax =  $('#totaltaxamt').val();
	//alert($gross);
	//alert($tax);
	if($fees != ''){
	$('#totalamt').val( Math.round((+$gross) + (+$tax) + (+$fees))+".00");
	}
});
</script>

<script type="text/javascript">
$('#producttypeLiquid').click(function(){
$('#stripsinbox').css("display", "none");
$('#bottlesinbox').css("display","");
$('#pcsinstrip').css("display", "none");
$('#mlinbottle').css("display","");
$('#pcsuom').css("display", "none");
$('#botuom').css("display","");
});
</script>

<script type="text/javascript">
$('#producttypeTablet').click(function(){
	$('#bottlesinbox').css("display","none");
	$('#stripsinbox').css("display", "");
	$('#pcsinstrip').css("display", "");
	$('#mlinbottle').css("display","none");
	$('#pcsuom').css("display", "");
	$('#botuom').css("display","none");
});
</script>

<script type="text/javascript">
$('#cbo_uom').change(function(){
	$stock = $('#stock').val();
	$('#qty').val('');
	$('#lineamount').val('');
	$('#linetaxamt').val('');
	if($stock == ''){
	alert('Select Product Fisrt');
	}else{
	if($('#cbo_uom').val() == 'Boxes'){
		
	if($('#prodtype').val() == "Tablet"){
		$('#stock').val($('#stockinbox').val());
	}else if($('#prodtype').val() == "Liquid"){
		$('#stock').val($('#botstockinbox').val());
	}
	
	}else if($('#cbo_uom').val() == 'Strips'){
	$('#stock').val($('#stockinstrip').val());
	}else if($('#cbo_uom').val() == 'Pcs'){
	$('#stock').val($('#stockinpcs').val());
	}else if($('#cbo_uom').val() === 'Bottles'){
	$('#stock').val($('#stockinbottle').val());
	}else if($('#cbo_uom').val() == 'Ml'){
	$('#stock').val($('#stockinpcs').val());
	}
	}
});
</script>


<script type="text/javascript">
$('#qty').change(function(){
	if($('#productname').val() == ''){
		alert('Please select product and then try');
		$('#qty').val('');
	}else{
	$stockinbox = $('#stockinbox').val();
	$stockinstrip = $('#stockinstrip').val();
	$stockinpcs = $('#stockinpcs').val();
	$stockinbottle = $('#stockinbottle').val();
	$botstockinbox = $('#botstockinbox').val();
	$mlinbottle = $('#mlinbottle').val();
	$bottlesinbox = $('#bottlesinbox').val();
	
	if($('#cbo_uom').val() == 'Boxes'){
	if($('#qty').val() > $stockinbox ){
	alert("Entered Qty is more than stock");
	$('#qty').val('');
	$('#lineamount').val('');
	$('#linetaxamt').val('');
	}else{
		
	if($('#prodtype').val() == "Tablet"){
	$amt = $('#qty').val() * $('#stripsinbox').val() * $('#pcsinstrip').val() * $('#salerate').val();
	$tax = $amt * $('#tax').val() /100;
	$('#linetaxamt').val($tax);
	$('#lineamount').val($amt);
	}else if($('#prodtype').val() == "Liquid"){
	$amt = $('#qty').val() * $('#bottlesinbox').val() * $('#mlinbottle').val() * $('#salerate').val();
	$tax = $amt * $('#tax').val() /100;
	$('#linetaxamt').val($tax);
	$('#lineamount').val($amt);
	}
		
	}
	}else if($('#cbo_uom').val() == 'Strips'){
	
	if($('#qty').val() > $stockinstrip ){
	alert("Entered Qty is more than stock");
	$('#qty').val('');
	$('#lineamount').val('');
	$('#linetaxamt').val('');
	}else{
	$amt = $('#qty').val() * $('#pcsinstrip').val() * $('#salerate').val();
	$tax = $amt * $('#tax').val() /100;
	$('#linetaxamt').val($tax);
	$('#lineamount').val($amt);
	}
	}else if($('#cbo_uom').val() == 'Pcs'){
	
	if($('#qty').val() > $stockinpcs ){
	alert("Entered Qty is more than stock");
	$('#qty').val('');
	$('#lineamount').val('');
	$('#linetaxamt').val('');
	}else{
	$amt = $('#qty').val() * $('#salerate').val();
	$tax = $amt * $('#tax').val() /100;
	$('#linetaxamt').val($tax);
	$('#lineamount').val($amt);
	}
	}else if($('#cbo_uom').val() == 'Bottles'){
			if($('#qty').val() > $stockinbottle ){
			alert("Entered Qty is more than stock");
			$('#qty').val('');
			$('#lineamount').val('');
			$('#linetaxamt').val('');
			}else{
			$amt = $('#qty').val() * $('#mlinbottle').val() * $('#salerate').val();
			$tax = $amt * $('#tax').val() /100;
			$('#linetaxamt').val($tax);
			$('#lineamount').val($amt);
			}
	}else if($('#cbo_uom').val() == 'Ml'){
			$qty = $('#qty').val(); 
			if($qty > $stockinpcs ){
			alert($('#qty').val());
			alert($stockinpcs);
			$total =$stockinpcs + $qty; 
			alert($total);
			alert("Entered Qty is more than stock");
			$('#qty').val('');
			$('#lineamount').val('');
			$('#linetaxamt').val('');
			}else{
			$amt = $('#qty').val() * $('#salerate').val();
			$tax = $amt * $('#tax').val() /100;
			$('#linetaxamt').val($tax);
			$('#lineamount').val($amt);
			}
	}
	}
});
</script>
  
 






<script>
 //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#ff6347","#3cb371"],
      data: [
        {label: "Low stock", value: <?php echo $low_stock; ?>},
        {label: "In Stock", value: <?php echo $all_stock - $low_stock;?>}
      ],
      hideHover: 'auto'
    });
	
</script>




<script>
//date_picker

$('#Doj').datepicker({
autoclose:true,
format:'dd-mm-dd'

});

//date_picker

$('#Dol').datepicker({
autoclose:true,
format:'yyyy-mm-dd'

});

//Date picker
$('#Dob').datepicker({
autoclose:true,
format:'yyyy-mm-dd'
});

//Date picker
$('.datepicker').datepicker({
autoclose: true,
format:'yyyy-mm-dd'
});

//Timepicker
$('.timepicker').timepicker({
showInputs: false
});

</script>



</body>
</html>

