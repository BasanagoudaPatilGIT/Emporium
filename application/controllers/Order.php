<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Order_model');
		$this->load->model('Product_model');
		$this->load->model('User_model');
		
		
	}
	
	
	public function orderDetails() { //working as expected. 
		//$entCode = $this->input->post('entCode');
		//$userId = $this->input->post('userId');
		//$userTypeId = $this->input->post('userTypeId');
		$entCode = 10002;
		$userId = 6;
		$userTypeId = 10018;
		$orderStatusDetails = $this->Order_model->get_order_status_details();
		$orders = $this->Order_model->order_details('ASC', $entCode);				
		
		if (count($orders) >0) {
			foreach($orders as $row)
				$all_order[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'orderNumber'=>$row['order_number'],
					'orderTotalAmt'=>$row['order_total_amount'],
					'orderTaxAmt'=>$row['order_tax_amount'],
					'orderNetAmt'=>$row['order_net_amount'],
					'orderStatus'=>$row['orderStatus'], 
					'orderStatusIndex'=>$row['order_status_index'],
					'orderViewStatus'=>$row['orderStatus'],
					'orderViewStatusIndex'=>$row['order_view_status'],
					'orderCreatedDatetime'=>$row['order_created_datetime'],
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
				//'orderDetails' => $all_order,
				'orderStatusDetails' => $orderStatusDetails,
			);
			print_r(json_encode($all_order_data));
			
			
			
			
		 } else {
			$no_order_data[] = array(
				'' => '',
				'getOrderNumber' => 'getOrderNumber',
				'orderStatusDetails' => $orderStatusDetails,
			);
				
			print_r(json_encode($no_order_data));
		}
	}
	
	public function orderDetailsBasedOnStatus() { //working as expected. 
		//$OrderStatus = $this->input->post('orderStatus');
		//$entCode = $this->input->post('entCode');
		//$userId = $this->input->post('userId');
		//$userTypeId = $this->input->post('userTypeId');
		$orderStatus = 10025;
		$entCode = 10002;
		$userId = 6;
		$userTypeId = 10018;
		$orderStatusDetails = $this->Order_model->get_order_status_details();
		
		if($userTypeId == 10018){
				if($orderStatus != 10025){
					$orders = $this->Order_model->customer_order_details_by_status($order_by = '',$entCode,$orderStatus,$userId,$userTypeId);
				}else{
					$orders = $this->Order_model->customer_order_details_by_all_status($order_by = '',$entCode,$userId,$userTypeId);
				}
		}else{
			if($orderStatus != 10025){
					$orders = $this->Order_model->order_details_by_status($order_by = '',$entCode,$orderStatus);
				}else{
					$orders = $this->Order_model->order_details($order_by = '',$entCode);
				}
		}
		
		
		if (count($orders) >0) {
			foreach($orders as $row)
				$all_order[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'orderNumber'=>$row['order_number'],
					'orderTotalAmt'=>$row['order_total_amount'],
					'orderTaxAmt'=>$row['order_tax_amount'],
					'orderNetAmt'=>$row['order_net_amount'],
					'orderStatus'=>$row['orderStatus'], 
					'orderstatusIndex'=>$row['order_status_index'],
					'orderViewStatus'=>$row['orderStatus'],
					'orderViewStatusIndex'=>$row['order_view_status'],
					'orderCreatedDatetime'=>$row['order_created_datetime'],
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
			);
			
			print_r(json_encode($all_order_data));
		 } else {
			$no_order_data[] = array(
				'' => '',
				'getOrderNumber' => 'getOrderNumber',
				'orderStatusDetails' => $orderStatusDetails,
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
		$flatDetails = $this->Index_model->flat_details($entCode);
		$products = $this->Product_model->stock_details('ASC', $entCode);	
		$orderNumber = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
		$orderCount = $data['auto_code']['continues_count'];
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
		$order_data[] = array(
			'createOrder' => 'createOrder', // clicking on save button
			'orderNumber' => $orderNumber,
			'orderCount' => $orderCount,
			'productDetails' => $prod_details,
			'uomDetails' => $UOMDetails,
			'apartmentDetails' => $apartmentDetails,
			'wingDetails' => $wingDetails,
			'flatDetails' => $flatDetails,
		);
		
		print_r(json_encode($order_data));
		
	}
	}
	
	public function createOrder() { // need to test with mobile code...
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$userId = $this->input->post('userId');
		//$userId = 10002;
		$orderNumber = $this->input->post('orderNumber');
		//$orderNumber = 10002;
		$orderCount = $this->input->post('orderCount');
		//$orderNumber = 10002;
		$orderTotalAmt = $this->input->post('orderTotalAmt');
		//$orderTotalAmt = 10002;
		$orderTaxAmt = $this->input->post('orderTaxAmt');
		//$orderTaxAmt = 10002;
		$orderNetAmt = $this->input->post('orderNetAmt');
		//$orderNetAmt = 10002;
		
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
			'order_number'=>$orderNumber,
			'order_total_amount'=>$orderTotalAmt,
			'order_tax_amount'=>$orderTaxAmt,
			'order_net_amount'=>$orderNetAmt,
			'order_status_index'=>10001,
			'order_view_status'=>10001,
		);
		
		$this->Order_model->add_order_h_details($data);
		
		$data = $this->input->post('orderProductList');
		$data = json_decode($data);
		$linecount = count($data);

		$orderhId = $this->Order_model->get_max_order_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) 
		{
			$data1 = $this->input->post('orderProductList');
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
				'batchno'=>$prodBatchNo,
				'product_uom_index'=>$prodUomIndex,
				'order_qty'=>$OrderQty,
				'tax_percent'=>$prodTaxPer,
				'tax_amount'=>$prodTaxAmt,
				'sale_rate'=>$prodSaleRate,
				'sub_total'=> round($subTotal),
				'product_stock_status_index'=> 10007,
			);
			
			$this->Order_model->add_order_d_record($data);
			
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
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"){
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
	
		$datestring = date('Y-m-d');			
		$data = array(
			'last_updated'=>mdate($datestring),
			'continues_count' => (int)$orderCount + 1 
		);
		
		$this->Order_model->incriment_order_no($data,$entCode);
		
		
	$new_order_generated = array(
			'message' => 'Order saved successfully'
		);
			
		print_r(json_encode($new_order_generated));
	}
	
	
	public function getEachOrderDetails() {
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
			'cancelOrder' => 'Cancel',
			'approveOrder' => 'Approve',
			'orderToBill' => 'Bill'
		);
		
		print_r(json_encode($each_order_details));	
	}
	
		
	public function cancelOrder() {
	//$entCode = 10002;
	//$orderNumber = "#O-120001" ;
	$entCode = $this->input->post('entCode');
	$orderNumber = $this->input->post('orderNumber');
		
		$data = array(
			'order_status_index'=>10005,
			'order_view_status'=>10005,
		);
	
	$this->Order_model->update_order_h_status($entCode,$orderNumber,$data);
	
	$data = $this->input->post('orderProductList');
		$data = json_decode($data);
		$linecount = count($data);
		

		$orderhId = $this->Order_model->get_max_order_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) {
			$data1 = $this->input->post('orderProductList');
			$data1 = json_decode($data1);
				
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$orderQty = $data1[$i]->{'orderQty'};		
							
		
		$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
		
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
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"){
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
	
	$order_cancallation = array(
			'message' => 'Order Cancelled successfully'
		);
			
		print_r(json_encode($order_cancallation));
	
	
	}
	
}
