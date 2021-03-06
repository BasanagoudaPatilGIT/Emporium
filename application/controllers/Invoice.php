<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Product_model');
		$this->load->model('User_model');
		$this->load->model('Index_model');
		$this->load->model('Order_model');
		$this->load->model('Notification_model');
		
		
	}
	
	public function billDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$billStatusDetails = $this->Invoice_model->get_bill_status_details();
		$bills = $this->Invoice_model->bill_details('ASC', $entCode);				
		$allUserDetails = $this->User_model->get_all_user_details_for_transaction($entCode);
		if (count($bills) >0) {
			foreach($bills as $row)
				$all_bills[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'transactionNumber'=>$row['bill_number'],
					'transactionNetAmt'=>$row['bill_net_amount'],
					'transactionCreatedDatetime'=>$row['bill_created_datetime'],
					'transactionStatus'=>$row['billStatus'],
					'transactionStatusIndex'=>$row['bill_status_index'],
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
				'allUserDetails' => $allUserDetails,
			);
			print_r(json_encode($all_bill_data));
			
			
			
		 } else {
			$no_bill_data[] = array(
				'' => '',
				'getBillNumber' => 'getBillNumber', // on click of plus button
				'billStatusDetails' => $billStatusDetails,
				'allUserDetails' => $allUserDetails,
			);
				
			print_r(json_encode($no_bill_data));
			
			
		}
	}
	
	public function billDetailsBasedOnStatus() { //working as expected. 
		$billStatus = $this->input->post('billStatus');
		$entCode = $this->input->post('entCode');
		//$billStatus = 10023;
		//$entCode = 10002;
		$billStatusDetails = $this->Invoice_model->get_bill_status_details();
		$bills = $this->Invoice_model->bill_details_by_status('ASC', $entCode,$billStatus);				
		$allUserDetails = $this->User_model->get_all_user_details_for_transaction($entCode);
		if (count($bills) >0) {
			foreach($bills as $row)
				$all_bills[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'transactionNumber'=>$row['bill_number'],
					'transactionNetAmt'=>$row['bill_net_amount'],
					'transactionCreatedDetetime'=>$row['bill_created_datetime'],
					'transactionStatus'=>$row['billStatus'],
					'transactionStatusIndex'=>$row['bill_status_index'],
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
				'allUserDetails' => $allUserDetails,
			);
			
			print_r(json_encode($all_order_data));
		 } else {
			$no_order_data[] = array(
				'' => '',
				'getBillNumber' => 'getBillNumber', // on click of plus button
				'billStatusDetails' => $billStatusDetails,
				'allUserDetails' => $allUserDetails,
			);
				
			print_r(json_encode($no_order_data));
		}
	}
	
	
	public function getBillNumber() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$data['auto_code'] = $this->Invoice_model->get_bill_number($entCode);
		$UOMDetails = $this->Product_model->get_uom_details();
		$apartmentDetails = $this->Index_model->apartment_details($entCode);
		$wingDetails = $this->Index_model->wing_details($entCode);
		$allUserDetails = $this->User_model->get_all_user_details_for_transaction($entCode);
		$flatDetails = $this->Index_model->flat_details($entCode);			
		$billNumber = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
		$billCount = $data['auto_code']['continues_count'];
		$bill_data[] = array(
			'createBill' => 'createBill', // clicking on save button
			'billNumber' => $billNumber,
			'billCount' => $billCount,
			'apartmentDetails' => $apartmentDetails,
			'wingDetails' => $wingDetails,
			'flatDetails' => $flatDetails,
			'allUserDetails' => $allUserDetails,
		);
		
		print_r(json_encode($bill_data));
		
	
	}
	
	public function createBill() { // need to test with mobile code...
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$billNumber = $this->input->post('billNumber');
		$billCount = $this->input->post('billCount');
		$transactionTotalAmt = $this->input->post('transactionTotalAmt');
		$transactionTaxAmt = $this->input->post('transactionTaxAmt');
		$transactionNetAmt = $this->input->post('transactionNetAmt');
		$delCharges = $this->input->post('delCharges');
		$userPhoneNo = $this->input->post('userPhoneNo');
		$userPassword = base64_encode($userPhoneNo);
		$ownerDetails = $this->User_model->get_owner_id($entCode);
		
	if($userId == 0){
			
			$data['auto_code'] = $this->User_model->get_user_number($entCode);
			$userId = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
			$userNum = $data['auto_code']['continues_count'];
			$userPictureName ='Capture.jpg';
			
			$data =array
			(
				'ent_code'=>$entCode,
				'user_name'=>$userPhoneNo,
				'user_password'=>$userPassword,
				'user_gender_index'=>10019,
				'user_phone_no'=>$this->input->post('userPhoneNo'),
				'user_flat_id'=>1,		
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
			
		}
		
		$data = array(
			'ent_code'=>$entCode,
			'user_id'=>$userId,
			'bill_number'=>$billNumber,
			'bill_total_amount'=>$transactionTotalAmt,
			'bill_tax_amount'=>$transactionTaxAmt,
			'delivery_charges'=>$delCharges,
			'bill_net_amount'=>round($transactionNetAmt),
			'order_id'=>0,
			'bill_status_index'=>10022,
		);
		
		$this->Invoice_model->add_bill_h_details($data);
		
		$data = $this->input->post('transactionProductList');
		$data = json_decode($data);
		$linecount = count($data);
		//$linecount = 1;

		$billhId = $this->Invoice_model->get_max_bill_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) 
		{
			$data1 = $this->input->post('transactionProductList');
			$data1 = json_decode($data1);
				
			$prodCode = $data1[$i]->{'productCode'};
			$prodName = $data1[$i]->{'productName'};
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$BillQty = $data1[$i]->{'billQty'};
			$prodTaxPer = $data1[$i]->{'productTaxPer'};	
			$prodSaleRate = $data1[$i]->{'productSaleRate'};
			$prodTaxAmt = $data1[$i]->{'productTaxAmt'};	
			$subTotal = $data1[$i]->{'subTotal'};
			
			
			$data = array(
				'bill_h_id'=>$billhId,
				'product_code'=>$prodCode,
				'product_name'=>$prodName,
				'product_batch'=>$prodBatchNo,
				'product_uom_index'=>$prodUomIndex,
				'order_qty'=>0,
				'bill_qty'=>$BillQty,
				'tax_percent'=>$prodTaxPer,
				'tax_amount'=>$prodTaxAmt,
				'sale_rate'=>$prodSaleRate,
				'sub_total'=> $subTotal,
				'product_status_index'=> '10006'
			);
			
			$this->Invoice_model->add_bill_d_details($data);
			
			$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
			
		if($prodUomName == "Kg" ){
		   $stockQty =  $productDetails['stock_qty'] - ($BillQty * 1000) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] - ($BillQty * 1000) ;
		   
		   $data = array(
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs" || $prodUomName == "Bundle"){
		   $stockQty =  $productDetails['stock_qty'] - $BillQty ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] - $BillQty ;
		   
		   $data = array(
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
	
		$datestring = date('Y-m-d H:i:s');			
		$data = array(
			'last_updated'=>mdate($datestring),
			'continues_count' => (int)$billCount + 1 
		);
		
		$this->Invoice_model->incriment_bill_no($data,$entCode);
		
		$data = array(
			'notification_type'=>'Bill',
			'display_message'=>'Bill generated with Bill number: '.$billNumber.',click to view details',
			'ent_code' => $entCode,
			'created_by' => $ownerDetails['id'],
			'recieved_by' => $userId,
			'read_status'=>0,
			'transaction_number'=>$billNumber
		);
		
		$this->Notification_model->add_notification_details($data);
		
		
	$new_bill_generated = array(
			'message' => 'Bill Generated Successfully'
		);
			
		print_r(json_encode($new_bill_generated));
	}
	
	
	public function getEachBillDetails() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$billNumber = $this->input->post('billNumber');
		//$billNumber = "#In10002130001";
		$viewType = $this->input->post('viewType');
		
		$notification = $this->Notification_model->get_notification_details_by_transaction_number($billNumber);
		
		if($viewType == 1 && $notification['read_status' == 0]){
		$data = array(
			'read_status'=>1,
		);
		
		$this->Notification_model->update_notification_status($billNumber,$data);
		}
		
		$data['bill_header'] = $this->Invoice_model->get_bill_h_details($billNumber,$entCode);
	
		
		$billdetails = $this->Invoice_model->get_bill_d_details($data['bill_header']['id'],$entCode);
		
		foreach($billdetails as $row)
		{
			$bill_details[] = array(
					'id'=>$row['id'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productBatch'=>$row['product_batch'],
					'orderQty'=>$row['order_qty'],
					'selectedQty'=>$row['bill_qty'],
					'taxPercent'=>$row['tax_percent'],
					'saleRate'=>$row['sale_rate'],
					'productUOMIndex'=>$row['product_uom_index'],
					'productUOM'=>$row['product_uom_index_name'],
					'isSelected'=>1,
			);
			
		}
		
		$bill_header_details[] = array(		
			'id'=>$data['bill_header']['id'],
            'entCode'=>$data['bill_header']['ent_code'],
            'userId'=>$data['bill_header']['user_id'],
            'billNumber'=>$data['bill_header']['bill_number'],
            'transactionTotalAmt'=>$data['bill_header']['bill_total_amount'],
            'transactionTaxAmt'=>$data['bill_header']['bill_tax_amount'],
            'delCharges'=>$data['bill_header']['delivery_charges'],
            'transactionNetAmt'=>$data['bill_header']['bill_net_amount'],
			'transactionCreatedDatetime'=>$data['bill_header']['bill_created_datetime'],
			'userFullName'=>$data['bill_header']['user_full_name'],
			'userAddress'=>$data['bill_header']['user_address'],
			'userPhoneNo'=>$data['bill_header']['user_phone_no'],
			'flatNo'=>$data['bill_header']['flat_no'],
			'wing'=>$data['bill_header']['wing'],
			'apartmentName'=>$data['bill_header']['apartment_name'],
			'transactionProducts' => $bill_details,
		);
		
		
		
		$each_bill_details[] = array(
			'billheaderdetails' => $bill_header_details,
			'cancelBill' => 'Cancel'
		);
		
		
		
	print_r(json_encode($each_bill_details));	
	}
	
		
	
	
	public function orderToBillConversion() {
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$billNumber = $this->input->post('billNumber');
		$orderNumber = $this->input->post('orderNumber');
		$billCount = $this->input->post('billCount');
		$transactionTotalAmt = $this->input->post('transactionTotalAmt');
		$transactionTaxAmt = $this->input->post('transactionTaxAmt');
		$transactionNetAmt = $this->input->post('transactionNetAmt');
		$delCharges = $this->input->post('delCharges');
		
		$ownerDetails = $this->User_model->get_owner_id($entCode);
		
		$data = array(
			'ent_code'=>$entCode,
			'user_id'=>$userId,
			'bill_number'=>$billNumber,
			'bill_total_amount'=>$transactionTotalAmt,
			'bill_tax_amount'=>$transactionTaxAmt,
			'delivery_charges'=>$delCharges,
			'bill_net_amount'=>round($transactionNetAmt),
			'order_id'=>$orderNumber,
			'bill_status_index'=>10022,
		);
		
		$this->Invoice_model->add_bill_h_details($data);
		
		$data = $this->input->post('transactionProductList');
		$data = json_decode($data);
		$linecount = count($data);
		//$linecount = 1;

		$billhId = $this->Invoice_model->get_max_bill_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) 
		{
			$data1 = $this->input->post('transactionProductList');
			$data1 = json_decode($data1);
				
			$prodCode = $data1[$i]->{'productCode'};
			$prodName = $data1[$i]->{'productName'};
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$billQty = $data1[$i]->{'billQty'};
			$prodTaxPer = $data1[$i]->{'productTaxPer'};	
			$prodSaleRate = $data1[$i]->{'productSaleRate'};
			$prodTaxAmt = $data1[$i]->{'productTaxAmt'};	
			$subTotal = $data1[$i]->{'subTotal'};
			
			
			$data = array(
				'bill_h_id'=>$billhId,
				'product_code'=>$prodCode,
				'product_name'=>$prodName,
				'product_batch'=>$prodBatchNo,
				'product_uom_index'=>$prodUomIndex,
				'order_qty'=>$billQty,
				'bill_qty'=>$billQty,
				'tax_percent'=>$prodTaxPer,
				'tax_amount'=>$prodTaxAmt,
				'sale_rate'=>$prodSaleRate,
				'sub_total'=> $subTotal,
				'product_status_index'=> '10006'
			);
			
			$this->Invoice_model->add_bill_d_details($data);
			
			$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
			
		if($prodUomName == "Kg" ){
		   $transitQty =  $productDetails['tarnsit_qty'] - ($BillQty * 1000) ;
		   
		   $data = array(
				'tarnsit_qty'=>$transitQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs" || $prodUomName == "Bundle"){
		   $transitQty =  $productDetails['tarnsit_qty'] - $BillQty ;
		   
		   $data = array(
				'tarnsit_qty'=>$transitQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $transitQty =  $productDetails['tarnsit_qty'] - ($BillQty * $productDetails['packets_in_box']) ;
		   
		   $data = array(
				'tarnsit_qty'=>$transitQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}
		
	  }
	
		$datestring = date('Y-m-d H:i:s');			
		$data = array(
			'last_updated'=>mdate($datestring),
			'continues_count' => (int)$billCount + 1 
		);
		
		$this->Invoice_model->incriment_bill_no($data,$entCode);
		
		$data = array(
			'order_status_index'=>10003,
			'order_view_status'=>10003,
		);
	
	$this->Order_model->update_order_h_status($entCode,$orderNumber,$data);
	
	$data = array(
			'notification_type'=>'Bill',
			'display_message'=>'Your Order is converted to bill with Bill number: '.$billNumber.',click to view details',
			'ent_code' => $entCode,
			'created_by' => $ownerDetails['id'],
			'recieved_by' => $userId,
			'read_status'=>0,
			'transaction_number'=>$billNumber
		);
		
		$this->Notification_model->add_notification_details($data);
	
	$new_bill_generated = array(
			'message' => 'Bill Generated Successfully'
		);
			
		print_r(json_encode($new_bill_generated));
	
	}
	
	public function promocalculate() {
	}
	
	public function cancelBill() {
	//$entCode = 10002;
	//$orderNumber = "#O-120001" ;
	$entCode = $this->input->post('entCode');
	$billNumber = $this->input->post('billNumber');
	$orderNumber = $this->input->post('orderNumber');
	$ownerDetails = $this->User_model->get_owner_id($entCode);	
		$data = array(
			'bill_status_index'=>10023,
		);
	
	$this->Invoice_model->update_bill_h_status($entCode,$billNumber,$data);
	
	$data = $this->input->post('transactionProductList');
		$data = json_decode($data);
		$linecount = count($data);
		

		$orderhId = $this->Invoice_model->get_max_order_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) {
			$data1 = $this->input->post('transactionProductList');
			$data1 = json_decode($data1);
			$prodCode = $data1[$i]->{'productCode'};
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$orderQty = $data1[$i]->{'orderQty'};			
							
		$productSubCat = $this->Product_model->get_subCategory($entCode,$prodCode);
		
		if($productSubCat['sub_category_index'] !=20004){
			$productDetails = $this->Product_model->stock_details_by_prodCode($entCode,$prodCode);
		}else{
			$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
		}
		
		if(orderNumber != 0){
		if($prodUomName == "Kg" ){
		   $stockQty =  $productDetails['stock_qty'] + ($orderQty * 1000) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + ($orderQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"|| $prodUomName == "Bundle"){
		   $stockQty =  $productDetails['stock_qty'] + $orderQty ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + $orderQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $stockQty =  $productDetails['stock_qty'] + ($orderQty * $productDetails['packets_in_box']) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + ($orderQty * $productDetails['packets_in_box']);
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}
		}else{
		if($prodUomName == "Kg" ){
		   $stockQty =  $productDetails['stock_qty'] + ($orderQty * 1000) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] + ($orderQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"|| $prodUomName == "Bundle"){
		   $stockQty =  $productDetails['stock_qty'] + $orderQty ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] + $orderQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $stockQty =  $productDetails['stock_qty'] + ($orderQty * $productDetails['packets_in_box']) ;
		   $offlineStockQty = $productDetails['offline_stock_qty'] + ($orderQty * $productDetails['packets_in_box']);
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'offline_stock_qty'=>$offlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}	
		}
	}
	
	$data = array(
			'notification_type'=>'Bill',
			'display_message'=>'Your Invoice number:'.$billNumber.' is cancelled by Owner',
			'ent_code' => $entCode,
			'created_by' => $ownerDetails['id'],
			'recieved_by' => $userId,
			'read_status'=>0,
			'transaction_number'=>$billNumber
		);
		
		$this->Notification_model->add_notification_details($data);
	
	$invoice_cancallation = array(
			'message' => 'Invoice Cancelled Successfully'
		);
			
		print_r(json_encode($invoice_cancallation));
	
	
	}
	
	public function orderToBill() {
		$entCode = $this->input->post('entCode');
		//$entCode =10002;
		$orderNumber = $this->input->post('orderId');
		//$orderNumber = '1';
		$data['auto_code'] = $this->Invoice_model->get_bill_number($entCode);			
		$billNumber = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
		$billCount = $data['auto_code']['continues_count'];
		
		$data['order_header'] = $this->Order_model->get_order_h_details($orderNumber,$entCode);
		//print_r($data['order_header']);
		$orderdetails = $this->Order_model->get_order_d_details($data['order_header']['id'],$entCode);
		
		foreach($orderdetails as $row)
		{
			$order_details[] = array(
				'id'=>$row['id'],
				'orderhId'=>$row['order_h_id'],
				'productCode'=>$row['product_code'],
				'productName'=>$row['product_name'],
				'productBatch'=>$row['product_batch'],
				'productUOMIndex'=>$row['product_uom_index'],
				'productUOM'=>$row['product_uom_index_name'],
				'selectedQty'=>$row['order_qty'],
				'taxPercent'=>$row['tax_percent'],
				'taxAmount'=>$row['tax_amount'],
				'saleRate'=>$row['sale_rate'],
				'subTotal'=>$row['sub_total'],
				'rowInvalidated'=>$row['row_invalidated'],
				'statusUpdatedDatetime'=>$row['status_updated_datetime'],
			);
		}
		
		$order_header_details[] = array(				
			'id'=>$data['order_header']['id'],
            'entCode'=>$data['order_header']['ent_code'],
            'userId'=>$data['order_header']['user_id'],
            'orderNumber'=>$data['order_header']['order_number'],
            'transactionTotalAmt'=>$data['order_header']['order_total_amount'],
            'transactionTaxAmt'=>$data['order_header']['order_tax_amount'],
            'transactionNetAmt'=>$data['order_header']['order_net_amount'],
            'transactionStatusIndex'=>$data['order_header']['order_status_index'],
            'transactionStatusIndexName'=>$data['order_header']['order_status_index_name'],
			'transactionCreatedDatetime'=>$data['order_header']['order_created_datetime'],
			'userFullName'=>$data['order_header']['user_full_name'],
			'userAddress'=>$data['order_header']['user_address'],
			'userPhoneNo'=>$data['order_header']['user_phone_no'],
			'transactionProducts'=>$order_details,
			'billNumber' => $billNumber,
		);
		
		
		
		$each_order_details[] = array(
			'transactionHeaderDetails' => $order_header_details,
			'createBill' => 'createBill',
			'promocalculate' => 'calculate',
			'billCount' => $billCount,
			
		);
		
		print_r(json_encode($each_order_details));	
	}
	
	
	
}
