<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Product_model');
		
		
	}
	
	public function details(){
		$entCode = 10002;
		$billStatusDetails = $this->Invoice_model->get_bill_status_details();
		echo"<pre>";
		print_r($billStatusDetails);
		echo"</pre>";
	}
	public function billDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$userTypeId = $this->input->post('userTypeId');
		/* $entCode = 10002;
		$userId = 6;
		$userTypeId = 10018; */
		$billStatusDetails = $this->Invoice_model->get_bill_status_details();
		if($userTypeId == 10018){
		$bills = $this->Invoice_model->customer_bill_details($order_by = '',$entCode,$userId,$userTypeId);
		}else{
		$bills = $this->Invoice_model->bill_details('ASC', $entCode);
		}
		if (count($bills) >0) {
			foreach($bills as $row)
				$all_bills[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'billNumber'=>$row['bill_number'],
					'billTotalAmt'=>$row['bill_total_amount'],
					'billTaxAmt'=>$row['bill_tax_amount'],
					'delCharges'=>$row['delivery_charges'],
					'billNetAmt'=>$row['bill_net_amount'],
					'billCreatedDetetime'=>$row['bill_created_datetime'],
					'orderId'=>$row['order_id'],
					'billStatusIndex'=>$row['bill_status_index'],
					'userFullName'=>$row['user_full_name'],
					'userAddress'=>$row['user_address'],
					'userPhoneNo'=>$row['user_phone_no'],
					'flatNo'=>$row['flat_no'],
					'wing'=>$row['wing'],
					'apartmentName'=>$row['apartment_name'],
				);
				
			
			$all_bill_data[] = array(
				'getBillNumber' => 'getBillNumber', // on click of plus button
				'getEachBillDetails' => 'getEachBillDetails', // clikcing on each order 
				'billDetailsBasedOnStatus' => 'billDetailsBasedOnStatus', // on change of order status
				'billDetails' => $all_bills,
				'billStatusDetails' => $billStatusDetails,
			);
			print_r(json_encode($all_bill_data));
			
			
			
		 } else {
			$no_bill_data[] = array(
				'' => '',
				'getBillNumber' => 'getBillNumber', // on click of plus button
				'billStatusDetails' => $billStatusDetails,
			);
				
			print_r(json_encode($no_bill_data));
			
			
		}
	}
	
	public function billDetailsBasedOnStatus() { //working as expected. 
		$billStatus = $this->input->post('billStatus');
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$userTypeId = $this->input->post('userTypeId');
		/* $entCode = 10002;
		$billStatus =10024;
		$userId = 6;
		$userTypeId = 10018; */
		$billStatusDetails = $this->Invoice_model->get_bill_status_details();
		
		if($userTypeId == 10018){
				if($billStatus != 10025){
					$bills = $this->Invoice_model->customer_bill_details_by_status($order_by = '',$entCode,$billStatus,$userId,$userTypeId);
				}else{
					$bills = $this->Invoice_model->customer_bill_details_by_all_status($order_by = '',$entCode,$userId,$userTypeId);
				}
		}else{
			if($billStatus != 10025){
					$bills = $this->Invoice_model->bill_details_by_status($order_by = '',$entCode,$billStatus);
				}else{
					$bills = $this->Invoice_model->bill_details($order_by = '',$entCode);
				}
		}		
		
		if (count($bills) >0) {
			foreach($bills as $row)
				$all_bills[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'billNumber'=>$row['bill_number'],
					'billTotalAmt'=>$row['bill_total_amount'],
					'billTaxAmt'=>$row['bill_tax_amount'],
					'delCharges'=>$row['delivery_charges'],
					'billNetAmt'=>$row['bill_net_amount'],
					'billCreatedDetetime'=>$row['bill_created_datetime'],
					'orderId'=>$row['order_id'],
					'userFullName'=>$row['user_full_name'],
					'userAddress'=>$row['user_address'],
					'userPhoneNo'=>$row['user_phone_no'],
					'flatNo'=>$row['flat_no'],
					'wing'=>$row['wing'],
					'apartmentName'=>$row['apartment_name'],
				);
				
			
			$all_order_data[] = array(
				'getBillNumber' => 'getBillNumber', // on click of plus button
				'getEachBillDetails' => 'getEachBillDetails', // clikcing on each order 
				'billDetails' => $all_bills,
				'billStatusDetails' => $billStatusDetails,
			);
			
			print_r(json_encode($all_order_data));
		 } else {
			$no_order_data[] = array(
				'' => '',
				'getBillNumber' => 'getBillNumber', // on click of plus button
				'billStatusDetails' => $billStatusDetails,
			);
				
			print_r(json_encode($no_order_data));
		}
	}
	
	
	public function getBillNumber() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$data['auto_code'] = $this->Invoice_model->get_bill_number($entCode);
		$UOMDetails = $this->Product_model->get_uom_details();
		$products = $this->Product_model->stock_details('ASC', $entCode);	
		$billNumber = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
		$billCount = $data['auto_code']['continues_count'];
		if (count($products) >0) {
			foreach($products as $row)
				$prod_details[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productDescription'=>$row['product_description'],
					'productStatus'=>$row['product_status_index_name'],
					'productStatusindex'=>$row['product_status_index'],
					'productCategory'=>$row['category_index_name'],
					'productCategoryIndex'=>$row['category_index'],
					'productSubCategory'=>$row['sub_category_index_name'],
					'productSubCategoryIndex'=>$row['sub_category_index'],
					'producthId' => $row['producthId'],
					'productBatch' => $row['product_batch'],
					'packetsInBox' => $row['packets_in_box'],
					'productPackDate' =>$row['product_pack_date'],
					'productExpDate' =>$row['product_exp_date'],
					'mrp' =>$row['mrp'],
					'taxPrecent' =>$row['tax_precent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productdId' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineStockQty' =>$row['offline_stock_qty'],
					'transitQty' =>$row['transit_qty'],
					'createdDatetime' =>$row['created_datetime']
				);
		$bill_data[] = array(
			'createBill' => 'createBill', // clicking on save button
			'billNumber' => $billNumber,
			'billCount' => $billCount,
			'productDetails' => $prod_details,
			'uomDetails' => $UOMDetails,
		);
		
		print_r(json_encode($bill_data));
		
	}
	}
	
	public function createBill() { // need to test with mobile code...
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$billNumber = $this->input->post('billNumber');
		$orderNumber = $this->input->post('orderNumber');
		$billCount = $this->input->post('billCount');
		$billTotalAmt = $this->input->post('billTotalAmt');
		$billTaxAmt = $this->input->post('billTaxAmt');
		$billNetAmt = $this->input->post('billNetAmt');
		$delCharges = $this->input->post('delCharges');
		
		if($userId == 0){
		$userId = $this->User_model->get_max_user_id();
		$userPictureName ='Capture.jpg';
		$userPassword = base64_encode($this->input->post('userPhoneno'));		
		$data =array
			(
				'ent_code'=>$entCode,
				'user_name'=>$this->input->post('userPhoneno'),
				'user_password'=>$userPassword,
				'user_phone_no'=>$this->input->post('userPhoneNo'),
				'user_flat_id'=>$this->input->post('userFlatId'),		
				'user_imei'=>0,	
				'user_designation_index'=>10018,
				'user_status_index'=>'10013',
				'user_image'=>$userPictureName,
				'user_id'=>$userId,	
				
			);				
			$this->User_model->add_record($data);

			$data = array(
				'continues_count' => (int)$userNum + 1 
			);
			
			$this->User_model->incriment_user_no($data,$entCode);

			
		}else{
			$userId = $this->input->post('userId');
		}
		
		$data = array(
			'ent_code'=>$entCode,
			'user_id'=>$userId,
			'bill_number'=>$billNumber,
			'bill_total_amount'=>$billTotalAmt,
			'bill_tax_amount'=>$billTaxAmt,
			'delivery_charges'=>$delCharges,
			'bill_tax_amount'=>$billTaxAmt,
			'order_id'=>$orderNumber,
			'bill_status_index'=>10022,
		);
		
		$this->Invoice_model->add_invoice_h_details($data);
		
		$data = $this->input->post('invoiceProductList');
		$data = json_decode($data);
		$linecount = count($data);

		$billhId = $this->Invoice_model->get_max_bill_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) 
		{
			$data1 = $this->input->post('billProductList');
			$data1 = json_decode($data1);
				
			$prodCode = $data1[$i]->{'productCode'};
			$prodName = $data1[$i]->{'productName'};
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$BillQty = $data1[$i]->{'billQty'};
			$mrp = $data1[$i]->{'mrp'};
			$prodTaxPer = $data1[$i]->{'productTaxPer'};	
			$prodSaleRate = $data1[$i]->{'productSaleRate'};
			$prodTaxAmt = $data1[$i]->{'productTaxAmt'};	
			$subTotal = $data1[$i]->{'subTotal'};
			
			$data = array(
				'bill_h_id'=>$billhId,
				'product_code'=>$prodCode,
				'product_name'=>$prodName,
				'batchno'=>$prodBatchNo,
				'product_uom_index'=>$prodUomIndex,
				'order_qty'=>0,
				'bill_qty'=>$BillQty,
				'mrp'=>$mrp,
				'tax_percent'=>$prodTaxPer,
				'tax_amount'=>$prodTaxAmt,
				'sale_rate'=>$prodSaleRate,
				'sub_total'=> round($subTotal),
				'product_status_index'=> '10006'
			);
			
			$this->Bill_model->add_bill_d_record($data);
			
			$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
			
		if($prodUomName == "Kg" ){
		   $stockQty =  $productDetails['stock_qty'] - ($BillQty * 1000) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] - ($BillQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"){
		   $stockQty =  $productDetails['stock_qty'] - $BillQty ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] - $BillQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $stockQty =  $productDetails['stock_qty'] - ($BillQty * $productDetails['packets_in_box']) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] - ($BillQty * $productDetails['packets_in_box']);
		   
		   $data = array(
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}
		
	  }
	
		$datestring = date('Y-m-d');			
		$data = array(
			'last_updated'=>mdate($datestring),
			'continues_count' => (int)$billCount + 1 
		);
		
		$this->Invoice_model->incriment_bill_no($data,$entCode);
		
		
	$new_bill_generated = array(
			'message' => 'Bill saved successfully'
		);
			
		print_r(json_encode($new_bill_generated));
	}
	
	
	public function getEachBillDetails() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$billNumber = $this->input->post('billNumber');
		//$billNumber = "#In-10002130001";
		$data['bill_header'] = $this->Invoice_model->get_bill_h_details($billNumber,$entCode);
	
		$bill_header_details[] = array(		
			'id'=>$data['bill_header']['id'],
            'entCode'=>$data['bill_header']['ent_code'],
            'userId'=>$data['bill_header']['user_id'],
            'billNumber'=>$data['bill_header']['bill_number'],
            'orderTotalAmount'=>$data['bill_header']['bill_total_amount'],
            'orderTaxAmount'=>$data['bill_header']['bill_tax_amount'],
            'delCharges'=>$data['bill_header']['delivery_charges'],
            'billNetAmt'=>$data['bill_header']['bill_net_amount'],
			'billCreatedDatetime'=>$data['bill_header']['bill_created_datetime'],
			'userFullName'=>$data['bill_header']['user_full_name'],
			'userAddress'=>$data['bill_header']['user_address'],
			'userPhoneNo'=>$data['bill_header']['user_phone_no'],
			'flatNo'=>$data['bill_header']['flat_no'],
			'wing'=>$data['bill_header']['wing'],
			'apartmentName'=>$data['bill_header']['apartment_name'],
		);
		$billdetails = $this->Invoice_model->get_bill_d_details($data['bill_header']['id'],$entCode);
		
		foreach($billdetails as $row)
		{
			$each_bill_details[] = array(
					'id'=>$row['id'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'batchNo'=>$row['batch_no'],
					'orderQty'=>$row['order_qty'],
					'billQty'=>$row['bill_qty'],
					'mrp'=>$row['mrp'],
					'taxPercent'=>$row['tax_percent'],
					'saleRate'=>$row['sale_rate'],
					'productUomIndex'=>$row['product_uom_index'],
					'productUOM'=>$row['product_uom_index_name'],
			);
			
		}
		
		
		
		$bill_details[] = array(
			'billheaderdetails' => $bill_header_details,
			'billProducts' => $each_bill_details,
			'cancelBill' => 'Cancel'
		);
		
		/* echo"<pre>";
		print_r($bill_details);
		echo"</pre>"; */
		
		
	print_r(json_encode($bill_details));	
	}
	
		
	public function cancelBill() {
	//$entCode = 10002;
	//$orderNumber = "#O-120001" ;
	$entCode = $this->input->post('entCode');
	$billNumber = $this->input->post('billNumber');
		
		$data = array(
			'bill_status_index'=>10023,
		);
	
	$this->Invoice_model->update_bill_h_status($entCode,$billNumber,$data);
	
	$data = $this->input->post('billProductList');
		$data = json_decode($data);
		$linecount = count($data);
		

		$orderhId = $this->Order_model->get_max_order_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) {
			$data1 = $this->input->post('billProductList');
			$data1 = json_decode($data1);
				
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$billQty = $data1[$i]->{'billQty'};		
							
		
		$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
		
		if($prodUomName == "Kg" ){
		   $stockQty =  $productDetails['stock_qty'] + ($billQty * 1000) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] + ($billQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"){
		   $stockQty =  $productDetails['stock_qty'] + $billQty ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] + $billQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $stockQty =  $productDetails['stock_qty'] + ($billQty * $productDetails['packets_in_box']) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] + ($billQty * $productDetails['packets_in_box']);
		   
		   $data = array(
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}
	}
	
	$bill_cancallation = array(
			'message' => 'Bill Cancelled successfully'
		);
			
		print_r(json_encode($bill_cancallation));
	
	
	}
	
	public function getOrderDetailstoConvertintoBill() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$orderNumber = $this->input->post('orderNumber');
		//$userId = 2;
		//$invoiceh_id = 1;
		$data['order_header'] = $this->Order_model->get_order_h_details($orderNumber,$entCode);
	
		$orderdetails = $this->Order_model->get_order_d_details($data['order_header']['id'],$entCode);
		
		$order_header_details[] = array(				
			'id'=>$data['order_header']['id'],
            'entCode'=>$data['order_header']['ent_code'],
            'userId'=>$data['order_header']['user_id'],
            'orderNumber'=>$data['order_header']['order_number'],
            'orderTotalAmount'=>$data['order_header']['order_total_amount'],
            'orderTaxAmount'=>$data['order_header']['order_tax_amount'],
            'orderNetAmount'=>$data['order_header']['order_net_amount'],
            'orderStatusIndex'=>$data['order_header']['order_status_index'],
            'orderStatusIndexName'=>$data['order_header']['order_status_index_name'],
            'orderViewStatus'=>$data['order_header']['order_view_status'],
			'orderViewStatusName'=>$data['order_header']['order_view_status_name'],
			'orderCreatedDatetime'=>$data['order_header']['order_created_datetime'],
			'userFullName'=>$data['order_header']['user_full_name'],
			'userAddress'=>$data['order_header']['user_address'],
			'userPhoneNo'=>$data['order_header']['user_phone_no'],
		);
		
		foreach($orderdetails as $row)
		{
			$order_details[] = array(
				'id'=>$row['id'],
				'orderhId'=>$row['order_h_id'],
				'productCode'=>$row['product_code'],
				'productName'=>$row['product_name'],
				'productBatch'=>$row['product_batch'],
				'productUomIndex'=>$row['product_uom_index'],
				'productUomIndexName'=>$row['product_uom_index_name'],
				'orderQty'=>$row['order_qty'],
				'taxPercent'=>$row['tax_percent'],
				'taxAmount'=>$row['tax_amount'],
				'saleRate'=>$row['sale_rate'],
				'subTotal'=>$row['sub_total'],
				'productStockStatusIndex'=>$row['product_stock_status_index'],
				'productStockStatusIndexName'=>$row['product_stock_status_index_name'],
				'rowInvalidated'=>$row['row_invalidated'],
				'statusUpdatedDatetime'=>$row['status_updated_datetime'],
			);
		}
		
		$each_order_details[] = array(
			'orderheaderdetails' => $order_header_details,
			'orderDetails'=>$order_details,
			'createBill' => 'Bill',
			'promocalculate' => 'calculate',
		);
		
		print_r(json_encode($each_order_details));	
	}
	
	public function promocalculate() {
	}
	
	
	
	
	
}
