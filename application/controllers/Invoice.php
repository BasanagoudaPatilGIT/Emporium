<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Product_model');
		
		
	}
	
	
	public function billDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$billStatusDetails = $this->Invoice_model->get_order_status_details();
		$bills = $this->Invoice_model->bill_details('ASC', $entCode);				
		
		if (count($bills) >0) {
			foreach($bills as $row)
				$all_order[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'userFullName'=>$row['user_full_name'],
					'userAddress'=>$row['user_address'],
					'userPhoneNo'=>$row['user_phone_no'],
					'orderNumber'=>$row['order_number'],
					'orderTotalAmt'=>$row['order_total_amount'],
					'orderTaxAmt'=>$row['order_tax_amount'],
					'orderNetAmt'=>$row['order_net_amount'],
					'orderStatus'=>$row['orderStatus'], 
					'orderStatusIndex'=>$row['order_status_index'],
					'orderViewStatus'=>$row['orderStatus'],
					'orderViewStatusIndex'=>$row['order_view_status'],
					'orderCreatedDatetime'=>$row['order_created_datetime'],
					'orderhId'=>$row['order_h_id'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productBatch'=>$row['product_batch'],
					'productUomIndex'=>$row['product_uom_index'],
					'productUom'=>$row['productUOM'],
					'orderQty'=>$row['order_qty'],
					'taxPercent'=>$row['tax_percent'],
					'saleRate'=>$row['sale_rate'],
					'productStockStatusIndex'=>$row['product_stock_status_index'],
					'productStockStatus'=>$row['productStockStatus'],
					'statusUpdatedDatetime'=>$row['status_updated_datetime']
				);
				
			
			$all_order_data[] = array(
				'getOrderNumber' => 'getOrderNumber', // on click of plus button
				'getEachOrderDetails' => 'getEachOrderDetails', // clikcing on each order 
				'orderDetailsBasedOnStatus' => 'orderDetailsBasedOnStatus', // on change of order status
				'orderDetails' => $all_order,
				'orderStatusDetails' => $orderStatusDetails,
			);
			//print_r(json_encode($all_order_data));
			
			echo"<pre>";
			print_r($all_order_data);
			echo"</pre>";
			
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
		$OrderStatus = $this->input->post('OrderStatus');
		$entCode = $this->input->post('entCode');
		//$orderStatus = 10002;
		//$entCode = 10002;
		$orderStatusDetails = $this->Order_model->get_order_status_details();
		$orders = $this->Order_model->order_details_by_status('ASC', $entCode,$orderStatus);				
		
		if (count($orders) >0) {
			foreach($orders as $row)
				$all_order[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'userId'=>$row['user_id'],
					'userFullName'=>$row['user_full_name'],
					'useraddress'=>$row['user_address'],
					'userPhoneNo'=>$row['user_phone_no'],
					'orderNumber'=>$row['order_number'],
					'orderTotalAmt'=>$row['order_total_amount'],
					'orderTaxAmt'=>$row['order_tax_amount'],
					'orderNetAmt'=>$row['order_net_amount'],
					'orderStatus'=>$row['orderStatus'], 
					'orderstatusIndex'=>$row['order_status_index'],
					'orderViewStatus'=>$row['orderStatus'],
					'orderViewStatusIndex'=>$row['order_view_status'],
					'orderCreatedDatetime'=>$row['order_created_datetime'],
					'orderHId'=>$row['order_h_id'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productBatch'=>$row['product_batch'],
					'productUomIndex'=>$row['product_uom_index'],
					'productUom'=>$row['productUOM'],
					'orderQty'=>$row['order_qty'],
					'taxPercent'=>$row['tax_percent'],
					'saleRate'=>$row['sale_rate'],
					'productStockStatusIndex'=>$row['product_stock_status_index'],
					'productStockStatus'=>$row['productStockStatus'],
					'statusUpdatedDatetime'=>$row['status_updated_datetime']
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
		);
		
		print_r(json_encode($order_data));
		
	}
	}
	
	public function createorder() { // need to test with mobile code...
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
			$OrderQty = $data1[$i]->{'OrderQty'};
			$prodTaxPer = $data1[$i]->{'productTaxPer'};	
			$prodSaleRate = $data1[$i]->{'productSaleRate'};
			$prodTaxAmt = $data1[$i]->{'productTaxAmt'};	
			$subTotal = $data1[$i]->{'subTotal'};
			
			$data = array(
				'order_h_id'=>$orderhId,
				'product_code'=>$prodCode,
				'product_name'=>$prodName,
				'batchno'=>$prodBatchNo,
				'product_uom_inddex'=>$prodUomIndex,
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
		
		foreach($orderdetails as $row)
			$each_order_details[] = array(
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
			
		$order_details[] = array(		
			'orderProducts' => $each_order_details,		
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
		
		$each_order_details[] = array(
			'orderheaderdetails' => $order_details,
			'cancelOrder' => 'Cancel',
			'approveOrder' => 'Approve',
			'getOrderDetailstoConvertintoBill' => 'Bill'
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
			$OrderQty = $data1[$i]->{'OrderQty'};		
							
		
		$productDetails = $this->Product_model->stock_details_by_batchno($entCode,$prodBatchNo);
		
		if($prodUomName == "Kg" ){
		   $transitQty =  $productDetails['transit_qty'] - ($OrderQty * 1000) ;
		   $stockQty =  $productDetails['stock_qty'] + ($OrderQty * 1000) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + ($OrderQty * 1000) ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Grams" || $prodUomName == "Packet" || $prodUomName == "Pcs"){
		   $transitQty =  $productDetails['transit_qty'] - $OrderQty ;
		   $stockQty =  $productDetails['stock_qty'] + $OrderQty ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + $OrderQty ;
		   
		   $data = array(
				'transit_qty'=>$transitQty,
				'stock_qty'=>$stockQty,
				'online_stock_qty'=>$onlineStockQty,
			);
		   
		   $this->Product_model->update_stock_details_by_batchno($entCode,$productDetails['producthId'],$data);
		}else if($prodUomName == "Boxes" ){
		   $transitQty =  $productDetails['transit_qty'] - ($OrderQty * $productDetails['packets_in_box']);
		   $stockQty =  $productDetails['stock_qty'] + ($OrderQty * $productDetails['packets_in_box']) ;
		   $onlineStockQty = $productDetails['online_stock_qty'] + ($OrderQty * $productDetails['packets_in_box']);
		   
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
	
	public function getOrderDetailstoConvertintoBill() {
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$orderNumber = $this->input->post('orderNumber');
		//$userId = 2;
		//$invoiceh_id = 1;
		$data['order_header'] = $this->Order_model->get_order_h_details($orderNumber,$entCode);
	
		$orderdetails = $this->Order_model->get_order_d_details($data['order_header']['id'],$entCode);
		
		foreach($orderdetails as $row)
			$each_order_details[] = array(
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
			
		$order_details[] = array(		
			'orderProducts' => $each_order_details,		
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
		
		$each_order_details[] = array(
			'orderheaderdetails' => $order_details,
			'createBill' => 'saveBill'
		);
		
		print_r(json_encode($each_order_details));	
	}
	
	
	public function createBill() { // need to test with mobile code...
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$userId = $this->input->post('userId');
		//$userId = 10002;
		$orderNumber = 0;
		//$orderNumber = 10002;
		$billCount = $this->input->post('billCount');
		//$orderNumber = 10002;
		$billTotalAmt = $this->input->post('billTotalAmt');
		//$orderTotalAmt = 10002;
		$billTaxAmt = $this->input->post('billTaxAmt');
		//$orderTaxAmt = 10002;
		$billNetAmt = $this->input->post('billNetAmt');
		//$orderNetAmt = 10002;
		
		$data = array(
			'ent_code'=>$entCode,
			'user_id'=>$userId,
			'order_number'=>$orderNumber,
			'bill_number'=>$orderNumber,
			'bill_total_amount'=>$orderTotalAmt,
			'bill_tax_amount'=>$orderTaxAmt,
			'bill_net_amount'=>$orderNetAmt,
			
		);
		
		$this->Order_model->add_order_h_details($data);
		
		$data = $this->input->post('billProductList');
		$data = json_decode($data);
		$linecount = count($data);

		$billhId = $this->Order_model->get_max_order_h_id();
		
		
		for ($i=0; $i < $linecount; $i++) 
		{
			$data1 = $this->input->post('orderProductList');
			$data1 = json_decode($data1);
				
			$prodCode = $data1[$i]->{'productCode'};
			$prodName = $data1[$i]->{'productName'};
			$prodBatchNo = $data1[$i]->{'productBatchNo'};	
			$prodUomIndex = $data1[$i]->{'productUOMIndex'};
			$prodUomName = $data1[$i]->{'productUOMName'};
			$OrderQty = $data1[$i]->{'OrderQty'};
			$prodTaxPer = $data1[$i]->{'productTaxPer'};	
			$prodSaleRate = $data1[$i]->{'productSaleRate'};
			$prodTaxAmt = $data1[$i]->{'productTaxAmt'};	
			$subTotal = $data1[$i]->{'subTotal'};
			$productBillStatus = $data1[$i]->{'productBillStatus'};
			
			$data = array(
				'order_h_id'=>$orderhId,
				'product_code'=>$prodCode,
				'product_name'=>$prodName,
				'batchno'=>$prodBatchNo,
				'product_uom_inddex'=>$prodUomIndex,
				'order_qty'=>$OrderQty,
				'tax_percent'=>$prodTaxPer,
				'tax_amount'=>$prodTaxAmt,
				'sale_rate'=>$prodSaleRate,
				'sub_total'=> round($subTotal),
				'product_bill_status'=> $productBillStatus,
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
	
	
}
