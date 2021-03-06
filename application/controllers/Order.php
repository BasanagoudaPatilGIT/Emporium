<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Order_model');
		$this->load->model('Product_model');
		$this->load->model('User_model');
		$this->load->model('Index_model');
		$this->load->model('Notification_model');
		
		
	}
	
	
	public function orderDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$orderStatusDetails = $this->Order_model->get_order_status_details();
		$orders = $this->Order_model->order_details('ASC', $entCode);				
		$allUserDetails = $this->User_model->get_all_user_details_for_transaction($entCode);
		if (count($orders) >0) {
			foreach($orders as $row)
				$all_order[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'orderNumber'=>$row['order_number'],
					'transactionTotalAmt'=>$row['order_total_amount'],
					'transactionTaxAmt'=>$row['order_tax_amount'],
					'transactionNetAmt'=>$row['order_net_amount'],
					'transactionStatus'=>$row['orderStatus'], 
					'transactionStatusIndex'=>$row['order_status_index'],
					'transactionCreatedDatetime'=>$row['order_created_datetime'],
					'userFullName'=>$row['user_full_name'],
					'userAddress'=>$row['user_address'],
					'userPhoneNo'=>$row['user_phone_no'],
					'flatNo'=>$row['flat_no'],
					'wing'=>$row['wing'],
					'apartmentName'=>$row['apartment_name'],
					
				);
				
			
			$all_order_data[] = array(
				'getOrderNumber' => 'getOrderNumber', // on click of plus button
				'getEachOrderDetails' => 'getEachOrderDetails', // clikcing on each order 
				'orderDetailsBasedOnStatus' => 'orderDetailsBasedOnStatus', // on change of order status
				'orderDetails' => $all_order,
				'orderStatusDetails' => $orderStatusDetails,
				'allUserDetails' => $allUserDetails,
			);
			print_r(json_encode($all_order_data));
			
			
			
			
		 } else {
			$no_order_data[] = array(
				'' => '',
				'getOrderNumber' => 'getOrderNumber',
				'orderStatusDetails' => $orderStatusDetails,
				'allUserDetails' => $allUserDetails,
			);
				
			print_r(json_encode($no_order_data));
		}
	}
	
	public function orderDetailsBasedOnStatus() { //working as expected. 
		$orderStatus = $this->input->post('orderStatus');
		$entCode = $this->input->post('entCode');
		//$orderStatus = 10002;
		//$entCode = 10002;
		$orderStatusDetails = $this->Order_model->get_order_status_details();
		if($orderStatus != 10025){
		$orders = $this->Order_model->order_details_by_status('ASC', $entCode,$orderStatus);	
		}else{
			$orders = $this->Order_model->order_details('ASC', $entCode);
		}
		if (count($orders) >0) {
			foreach($orders as $row)
				$all_order[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'orderNumber'=>$row['order_number'],
					'transactionTotalAmt'=>$row['order_total_amount'],
					'transactionTaxAmt'=>$row['order_tax_amount'],
					'transactionNetAmt'=>$row['order_net_amount'],
					'transactionStatus'=>$row['orderStatus'], 
					'transactionStatusIndex'=>$row['order_status_index'],
					'transactionCreatedDatetime'=>$row['order_created_datetime'],
					'userFullName'=>$row['user_full_name'],
					'userAddress'=>$row['user_address'],
					'userPhoneNo'=>$row['user_phone_no'],
					'flatNo'=>$row['flat_no'],
					'wing'=>$row['wing'],
					'apartmentName'=>$row['apartment_name'],
				);
				
			
			$all_order_data[] = array(
				'getOrderNumber' => 'getOrderNumber', // on click of plus button
				'getEachOrderDetails' => 'getEachOrderDetails', // clikcing on each order 
				'orderDetails' => $all_order,
				'orderStatusDetails' => $orderStatusDetails,
				'allUserDetails' => $allUserDetails,
			);
			
			print_r(json_encode($all_order_data));
		 } else {
			$no_order_data[] = array(
				'' => '',
				'getOrderNumber' => 'getOrderNumber',
				'orderStatusDetails' => $orderStatusDetails,
				'allUserDetails' => $allUserDetails,
			);
				
			print_r(json_encode($no_order_data));
		}
	}
	
	
	public function getOrderNumber() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$data['auto_code'] = $this->Order_model->get_order_number($entCode);
		$UOMDetails = $this->Product_model->get_uom_details();
		$apartmentDetails = $this->Index_model->apartment_details($entCode);
		$wingDetails = $this->Index_model->wing_details($entCode);
		$allUserDetails = $this->User_model->get_all_user_details_for_transaction($entCode);
		$flatDetails = $this->Index_model->flat_details($entCode);
		$orderNumber = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
		$orderCount = $data['auto_code']['continues_count'];
		
		$order_data[] = array(
			'createOrder' => 'createOrder', // clicking on save button
			'orderNumber' => $orderNumber,
			'orderCount' => $orderCount,
			'uomDetails' => $UOMDetails,
			'apartmentDetails' => $apartmentDetails,
			'wingDetails' => $wingDetails,
			'flatDetails' => $flatDetails,
			'allUserDetails' => $allUserDetails,
		);
		
		print_r(json_encode($order_data));
		
	
	}
	
	public function createOrder() { // need to test with mobile code...
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$userId = $this->input->post('userId');
		//$userId = 7;
		$orderNumber = $this->input->post('orderNumber');
		//$orderNumber = '#O10002120001';
		$orderCount = $this->input->post('orderCount');
		//$orderNumber = 10002;
		$transactionTotalAmt = $this->input->post('transactionTotalAmt');
		//$transactionTotalAmt = '10.02';
		$transactionTaxAmt = $this->input->post('transactionTaxAmt');
		//$transactionTaxAmt = '0.301';
		$transactionNetAmt = $this->input->post('transactionNetAmt');
		//$transactionNetAmt = '10.321';
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
			'order_number'=>$orderNumber,
			'order_total_amount'=>$transactionTotalAmt,
			'order_tax_amount'=>$transactionTaxAmt,
			'order_net_amount'=>round($transactionNetAmt),
			'order_status_index'=>10001,
			'order_view_status'=>10001,
		);
		
		$this->Order_model->add_order_h_details($data);
		
		$data = $this->input->post('transactionProductList');
		$data = json_decode($data);
		$linecount = count($data);

		$orderhId = $this->Order_model->get_max_order_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) 
		{
			$data1 = $this->input->post('transactionProductList');
			$data1 = json_decode($data1);
			$prodCode = $data1[$i]->{'productCode'};
			$prodName = $data1[$i]->{'productName'};
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$OrderQty = $data1[$i]->{'orderQty'};
			$prodTaxPer = $data1[$i]->{'productTaxPer'};	
			$prodSaleRate = $data1[$i]->{'productSaleRate'};
			$prodTaxAmt = $data1[$i]->{'productTaxAmt'};	
			$subTotal = $data1[$i]->{'subTotal'};
			
			$data = array(
				'order_h_id'=>$orderhId,
				'product_code'=>$prodCode,
				'product_name'=>$prodName,
				'product_batch'=>$prodBatchNo,
				'product_uom_index'=>$prodUomIndex,
				'order_qty'=>$OrderQty,
				'tax_percent'=>$prodTaxPer,
				'tax_amount'=>$prodTaxAmt,
				'sale_rate'=>$prodSaleRate,
				'sub_total'=> $subTotal,
				'product_stock_status_index'=> 10007,
			);
			
			$this->Order_model->add_order_d_details($data);
			
		$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
			
		 if($prodUomName == "Kg" ){
		   $transitQty =  $productDetails['transit_qty'] + ($OrderQty * 1000) ;
		   $stockQty =  $productDetails['stock_qty'] - ($OrderQty * 1000) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] - ($OrderQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}
		else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs" || $prodUomName == "Bundle"){
		   $transitQty =  $productDetails['transit_qty'] + $OrderQty ;
		   $stockQty =  $productDetails['stock_qty'] - $OrderQty ;
		   $onlineStockQty = $productDetails['online_stock_qty'] - $OrderQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $transitQty =  $productDetails['transit_qty'] + ($OrderQty * $productDetails['packets_in_box']);
		   $stockQty =  $productDetails['stock_qty'] - ($OrderQty * $productDetails['packets_in_box']) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] - ($OrderQty * $productDetails['packets_in_box']);
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}  
		
	  }
	
		$datestring = date('Y-m-d H:i:s');			
		$data = array(
			'last_updated'=>mdate($datestring),
			'continues_count' => (int)$orderCount + 1 
		);
		
		$this->Order_model->incriment_order_no($data,$entCode);
		
		$data = array(
			'notification_type'=>'Order',
			'display_message'=>'One Order Requested by Customer with order number: '.$orderNumber,
			'ent_code' => $entCode,
			'created_by' => $userId,
			'recieved_by' => $ownerDetails['id'],
			'read_status'=>0,
			'transaction_number'=>$orderNumber
		);
		
		$this->Notification_model->add_notification_details($data);
		
		
		
		
	$new_order_generated = array(
			'message' => 'Order saved successfully'
		);
			
		print_r(json_encode($new_order_generated));
	}
	
	
	public function getEachOrderDetails() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$orderNumber = $this->input->post('orderNumber');
		//$orderId = 1;
		$viewType = $this->input->post('viewType');
		
		$notification = $this->Notification_model->get_notification_details_by_transaction_number($orderNumber);
		
		if($viewType == 1 && $notification['read_status' == 0]){
		$data = array(
			'read_status'=>1,
		);
		
		$this->Notification_model->update_notification_status($orderNumber,$data);
		}
		$data['order_header'] = $this->Order_model->get_order_h_details($orderNumber,$entCode);
	
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
				'taxAmt'=>$row['tax_amount'],
				'saleRate'=>$row['sale_rate'],
				'subTotal'=>$row['sub_total'],
				'rowInvalidated'=>$row['row_invalidated'],
				'statusUpdatedDatetime'=>$row['status_updated_datetime'],
				'isSelected'=>1,
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
            'transactionStatus'=>$data['order_header']['order_status_index_name'],
			'transactionCreatedDatetime'=>$data['order_header']['order_created_datetime'],
			'userFullName'=>$data['order_header']['user_full_name'],
			'userAddress'=>$data['order_header']['user_address'],
			'userPhoneNo'=>$data['order_header']['user_phone_no'],
			'flatNo'=>$data['order_header']['flat_no'],
			'wing'=>$data['order_header']['wing'],
			'apartmentName'=>$data['order_header']['apartment_name'],
			'transactionProducts'=>$order_details,
		);
		
		$each_order_details[] = array(
			'transactionHeaderDetails' => $order_header_details,
			'cancelOrder' => 'Cancel',
			'approveOrder' => 'Approve',
			'orderToBill' => 'Bill'
		);
		
		print_r(json_encode($each_order_details));	
	}
	
		
	public function cancelOrder() {
	//$entCode = 10002;
	//$orderNumber = "#O-120001" ;
	$userId = $this->input->post('userId');
	$entCode = $this->input->post('entCode');
	$orderNumber = $this->input->post('orderNumber');
	$$ownerDetails = $this->User_model->get_owner_id($entCode);	
		$data = array(
			'order_status_index'=>10005,
			'order_view_status'=>10005,
		);
	
	$this->Order_model->update_order_h_status($entCode,$orderNumber,$data);
	
	$data = $this->input->post('transactionProductList');
		$data = json_decode($data);
		$linecount = count($data);
		
		
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
		if($prodUomName == "Kg" ){
		   $transitQty =  $productDetails['transit_qty'] - ($orderQty * 1000) ;
		   $stockQty =  $productDetails['stock_qty'] + ($orderQty * 1000) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + ($orderQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"|| $prodUomName == "Bundle"){
		   $transitQty =  $productDetails['transit_qty'] - $orderQty ;
		   $stockQty =  $productDetails['stock_qty'] + $orderQty ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + $orderQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $transitQty =  $productDetails['transit_qty'] - ($orderQty * $productDetails['packets_in_box']);
		   $stockQty =  $productDetails['stock_qty'] + ($orderQty * $productDetails['packets_in_box']) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + ($orderQty * $productDetails['packets_in_box']);
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}
	}
	$tranDetails = $this->Notification_model->get_notification_details_by_transaction_number($orderNumber);
	
	
	if($tranDetails['created_by'] == $userId){
	$data = array(
			'notification_type'=>'Order',
			'display_message'=>'Order number: '.$orderNumber.' is cancelled by Customer',
			'ent_code' => $entCode,
			'created_by' => $userId,
			'recieved_by' => $ownerDetails['id'],
			'read_status'=>0,
			'transaction_number'=>$orderNumber
		);
		
		$this->Notification_model->add_notification_details($data);
	}else{
		$data = array(
			'notification_type'=>'Order',
			'display_message'=>'Your Order number: '.$orderNumber.' is cancelled by Owner',
			'ent_code' => $entCode,
			'created_by' => $ownerId,
			'recieved_by' => $userId,
			'read_status'=>0,
			'transaction_number'=>$orderNumber
		);
		
		$this->Notification_model->add_notification_details($data);
	}
	$order_cancallation = array(
			'message' => 'Order Cancelled Successfully'
		);
			
		print_r(json_encode($order_cancallation));
	
	}
	
	public function details() {
		$orderNumber = '#O100022001';
		$tranDetails = $this->Notification_model->get_notification_details_by_transaction_number($orderNumber);
		
		print_r($tranDetails);
		
	}
	
	
}
