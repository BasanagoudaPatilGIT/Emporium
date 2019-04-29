<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->library('encrypt');
		
		require(APPPATH . 'third_party/PHPExcel_1.8/Classes/PHPExcel.php');
		require(APPPATH . 'third_party/PHPExcel_1.8/Classes/PHPExcel/Writer/Excel2007.php');	
		
	}
	
	public function getProductDetails() { //working as expected. 
		//$entCode = $this->input->post('entCode');
		$entCode = 10002;
		$data['auto_code'] = $this->Product_model->get_productcode($entCode);
		$categoryList = $this->Product_model->get_product_category();
		$subCategoryList = $this->Product_model->get_product_sub_category();
		$UOMDetails = $this->Product_model->get_uom_details();
		$prodCode = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].'-'.$data['auto_code']['continues_count'];
						
		$products = $this->Product_model->product_details('ASC', $entCode);				
		
		if (count($products) >0) {
			foreach($products as $row)
				$prod_details[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productDescription'=>$row['product_description'],
					'productStatus'=>$row['product_status_index_name'],
					'productStatusIndex'=>$row['product_status_index'],
					'productCategory'=>$row['category_index_name'],
					'productCategoryIndex'=>$row['category_index'],
					'productSubCategory'=>$row['sub_category_index_name'],
					'productSubCategoryIndex'=>$row['sub_category_index'],
					'productHID' => $row['producthId'],
					'productBatch' => $row['product_batch'],
					'packetsInBox' => $row['packets_in_box'],
					'productPackDate' =>$row['product_pack_date'],
					'productExpDate' =>$row['product_exp_date'],
					'mrp' =>$row['mrp'],
					'taxPercent' =>$row['tax_precent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productDID' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineStockQty' =>$row['offline_stock_qty'],
					'previousStockQty' =>$row['stock_qty'],
					'previousOnlineStockQty' =>$row['online_stock_qty'],
					'previousOfflineStockQty' =>$row['offline_stock_qty'],
					'transitQty' =>$row['transit_qty'],
					'createdDatetime' =>$row['created_datetime']
				);
		
		$product_data[] = array(
			'addProduct' => 'Add/Update Product', // on click of save button on add new product screen
			'getSelectedProductDetails' => 'getSelectedProductDetails', // on click of each product call this method
			'productCode' => $prodCode,
			'productDetails' => $prod_details,
			'prodCategory' => $categoryList,
			'prodSubCategory' => $subCategoryList,
			'uomDetails' => $UOMDetails,
			'productCount' =>$data['auto_code']['continues_count']
		);
		
		print_r(json_encode($product_data));
	}
	}
	
	public function getSelectedProductDetails() {//working as expected. 
		$entCode = $this->input->post('entCode');
		$ProductCode = $this->input->post('prodcutCode');
		$batchno = $this->input->post('batchNo');
		
		
		$categoryList = $this->Product_model->get_product_category();
		$subCategoryList = $this->Product_model->get_product_sub_category();
		$UOMDetails = $this->Product_model->get_uom_details();			
		$products = $this->Product_model->product_details_by_id('ASC',$ProductCode, $entCode,$batchno);				
		
		$product_data[] = array(
			'addProduct' => 'Add/update Product', // on click of save button on add/Update product screen
			'productDetails' => $products,
			'prodCategory' => $categoryList,
			'prodSubCategory' => $subCategoryList,
			'uomDetails' => $UOMDetails,
		);
		
		print_r(json_encode($product_data));
	
	}
	
	public function details() //Need to test
	{
		$entCode = 10002;
		$productCode = '#P10002-101';
		$batchno  = "1234-1234";
		$products = $this->Product_model->product_details_by_id('ASC',$productCode, $entCode,$batchno);	
		
		echo"<pre>";
		print_r($products['stock_qty']);
	    echo"</pre>";
	}
	public function addProduct() //Need to test
	{
	    $entCode = $this->input->post('entCode');
		$productCode = $this->input->post('productCode');
		$productId = $this->input->post('productId');
		$producthId = $this->input->post('producthId');
		$productCategory = $this->input->post('productCategory');
		$productSubCategory = $this->input->post('productSubCategory');
		$uomType = $this->input->post('uomType');
		$data['auto_code'] = $this->Product_model->get_productcode($entCode);
		
		$prodCode = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].'-'.$data['auto_code']['continues_count'];
		
		
		$purchaseQty = $this->input->post('purchaseQty');
		$stockQty = $this->input->post('stockQty');
		$onlineQty = $this->input->post('onlinestockQty');
		$offlineQty = $this->input->post('offlinestockQty');
		$stockQty = $this->input->post('stockQty');
		$onlineQty = $this->input->post('onlinestockQty');
		$offlineQty = $this->input->post('offlinestockQty');
		
		$datestring = date('Y-m-d');
		$stockQtyLimit = $this->input->post('stockQtyLimit');
		
		//Quantity calculation
		if($uomType== "Kg"){
		$updatedpurchaseQty = ( $purchaseQty * 1000) +  $products['purchase_qty'];
		$updatedstockQty = ( $stockQty * 1000) + $products['stock_qty'];
		$updatedonlineQty = ( $onlineQty  * 1000) + $products['online_stock_qty'];
		$updatedofflineQty = ( $offlineQty  * 1000) + $products['offline_stock_qty'];
		$updatedstockQtyLimit     = ( $stockQtyLimit  * 1000);
		$mrp = (double)$this->input->post('mrp') / ( $purchaseQty * 1000);
		$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty * 1000);
		$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty * 1000);
		
		}else if($uomType== "Grams"){
		
		$updatedpurchaseQty = $purchaseQty  +  $products['purchase_qty'];
		$updatedstockQty = $stockQty  + $products['stock_qty'];
		$updatedonlineQty = $onlineQty + $products['online_stock_qty'];
		$updatedofflineQty = $offlineQty + $products['offline_stock_qty'];
		$updatedstockQtyLimit = $stockQtyLimit;
		$mrp = (double)$this->input->post('mrp') / ( $purchaseQty);
		$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty);
		$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty);
		
		}else if($uomType == "Bundle"){
		
		$updatedpurchaseQty = $purchaseQty  +  $products['purchase_qty'];
		$updatedstockQty = $stockQty  + $products['stock_qty'];
		$updatedonlineQty = $onlineQty + $products['online_stock_qty'];
		$updatedofflineQty = $offlineQty + $products['offline_stock_qty'];
		$updatedstockQtyLimit = $stockQtyLimit;
		$mrp = (double)$this->input->post('mrp') / ( $purchaseQty);
		$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty);
		$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty);
		
		}else if($uomType['index_name']= "Box"){
		}else if($uomType['index_name']= "Packet"){
		}else if($uomType['index_name']= "Pcs"){
		}
		
		$batchNo = $this->input->post('batchNo');
		$batchno = $prodcode.''.(String)$this->input->post('prodExpDate').''.(int)$mrp.''.(int)$purchaseRate.''.(int)$saleRate;
	
		if($prodCode != $productCode)
		{
			if($batchNo == $batchno)
			{
				$products = $this->Product_model->product_details_by_id('ASC',$productCode, $entCode,$batchno);	
				
			$data =array
			(
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$this->input->post('productName'),
				'product_description'=>$this->input->post('productDescription'),
				'product_status_index'=>$this->input->post('productStatus'),
				'category_index'=>$productCategory,
				'sub_category_index'=>$productSubCategory,
			);
		
		$this->Product_model->update_product_details($productId,$data);
		
		
		
		$data =array
			(	
				'product_id'=>$productId,
				'productBatch' => $batchno,
				'product_pack_date' =>$datestring,
				'product_exp_date' =>$datestring,
				'mrp' =>$mrp,
				'tax_precent' =>$this->input->post('taxPrecent'),
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$updatedpurchaseQty,
			);
			
		$this->Product_model->update_stock_h_details($producthId,$productId,$data);
		
		$data =array
			(		
				'stock_h_id'=>$stockhId,
				'product_id'=>$productId,
				'stock_qty' =>$updatedstockQty ,
				'stock_qty_limit' =>$updatedstockQtyLimit ,
				'online_stock_qty' =>$updatedonlineQty ,
				'offline_stock_qty' =>$updatedofflineQty,
				'transit_qty' =>$this->input->post('transitQty'),
			);	
			
			$this->Product_model->update_stock_d_details($data);
			
			$new_product_added[] = array('message' => 'Product updated successfully');

			print_r(json_encode($new_product_added));
		
			}
			else{
			
			if($uomType== "Kg"){
			$updatedpurchaseQty = ( $purchaseQty * 1000);
			$updatedstockQty = ( $stockQty * 1000);
			$updatedonlineQty = ( $onlineQty  * 1000);
			$updatedofflineQty = ( $offlineQty  * 1000);
			$updatedstockQtyLimit     = ( $stockQtyLimit  * 1000);
			$mrp = (double)$this->input->post('mrp') / ( $purchaseQty * 1000);
			$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty * 1000);
			$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty * 1000);
			
			}else if($uomType== "Grams"){
			
			$updatedpurchaseQty = $purchaseQty;
			$updatedstockQty = $stockQty;
			$updatedonlineQty = $onlineQty;
			$updatedofflineQty = $offlineQty;
			$updatedstockQtyLimit     = $stockQtyLimit;
			$mrp = (double)$this->input->post('mrp') / ( $purchaseQty);
			$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty);
			$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty);
			
			}else if($uomType == "Bundle"){
			
			$updatedpurchaseQty = $purchaseQty;
			$updatedstockQty = $stockQty;
			$updatedonlineQty = $onlineQty;
			$updatedofflineQty = $offlineQty;
			$updatedstockQtyLimit     = $stockQtyLimit;
			$mrp = (double)$this->input->post('mrp') / ( $purchaseQty);
			$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty);
			$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty);
			
			}else if($uomType['index_name']= "Box"){
			}else if($uomType['index_name']= "Packet"){
			}else if($uomType['index_name']= "Pcs"){
			}
			
			$data =array
			(
				
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$this->input->post('productName'),
				'product_description'=>$this->input->post('productDescription'),
				'product_status_index'=>$this->input->post('productStatus'),
				'category_index'=>$this->input->post('productCategory'),
				'sub_category_index'=>$this->input->post('productSubCategory'),
			);
		
		$this->Product_model->update_product_details($productId,$data);
		
		$data =array
			(	
				'product_id'=>$productId,
				'productBatch' => $batchno,
				'product_pack_date' =>$datestring,
				'product_exp_date' =>$datestring,
				'mrp' =>$mrp,
				'tax_precent' =>$this->input->post('taxPrecent'),
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$updatedpurchaseQty,
			);
			
		$this->Product_model->add_stock_h_details($data);
		$stockhId = $this->Product_model->get_max_stock_h_id();
		$data =array
			(		
				'stock_h_id'=>$stockhId,
				'product_id'=>$productId,
				'stock_qty' =>$this->input->post('stockQty') ,
				'stock_qty_limit' =>$updatedstockQtyLimit ,
				'online_stock_qty' =>$updatedonlineQty,
				'offline_stock_qty' =>$updatedofflineQty,
				'transit_qty' =>$this->input->post('transitQty'),
				
			);	
			
			$this->Product_model->add_stock_d_details($data);
			
			$new_product_added[] = array('message' => 'Product updated successfully');

			print_r(json_encode($new_product_added));
			
			}
			
		}else{
		$prodcount = (int)$data['auto_code']['continues_count'];
		
		if($uomType== "Kg"){
			$updatedpurchaseQty = ( $purchaseQty * 1000);
			$updatedstockQty = ( $stockQty * 1000);
			$updatedonlineQty = ( $onlineQty  * 1000);
			$updatedofflineQty = ( $offlineQty  * 1000);
			$updatedstockQtyLimit     = ( $stockQtyLimit  * 1000);
			$mrp = (double)$this->input->post('mrp') / ( $purchaseQty * 1000);
			$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty * 1000);
			$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty * 1000);
			
			}else if($uomType== "Grams"){
			
			$updatedpurchaseQty = $purchaseQty;
			$updatedstockQty = $stockQty;
			$updatedonlineQty = $onlineQty;
			$updatedofflineQty = $offlineQty;
			$updatedstockQtyLimit     = $stockQtyLimit;
			$mrp = (double)$this->input->post('mrp') / ( $purchaseQty);
			$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty);
			$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty);
			
			}else if($uomType == "Bundle"){
			
			$updatedpurchaseQty = $purchaseQty;
			$updatedstockQty = $stockQty;
			$updatedonlineQty = $onlineQty;
			$updatedofflineQty = $offlineQty;
			$updatedstockQtyLimit     = $stockQtyLimit;
			$mrp = (double)$this->input->post('mrp') / ( $purchaseQty);
			$purchaseRate = (double)$this->input->post('purchaseRate') / ( $purchaseQty);
			$saleRate = (double)$this->input->post('saleRate') / ( $purchaseQty);
			
			}else if($uomType['index_name']= "Box"){
			}else if($uomType['index_name']= "Packet"){
			}else if($uomType['index_name']= "Pcs"){
			}
			
		$data =array
			(
				
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$this->input->post('productName'),
				'product_description'=>$this->input->post('productDescription'),
				'product_status_index'=>10013,
				'category_index'=>$this->input->post('productCategory'),
				'sub_category_index'=>$this->input->post('productSubCategory'),
			);
		
		$this->Product_model->add_product_details($data);
		$productId = $this->Product_model->get_max_product_id();
		$data =array
			(	
				'product_id'=>$productId,
				'productBatch' => $batchno,
				'product_pack_date' =>$datestring,
				'product_exp_date' =>$datestring,
				'mrp' =>$mrp,
				'tax_precent' =>$this->input->post('taxPrecent'),
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$this->input->post('purchaseQty'),
			);
			
		$this->Product_model->add_stock_h_details($data);
		$stockhId = $this->Product_model->get_max_stock_h_id();
		$data =array
			(		
				'stock_h_id'=>$stockhId,
				'product_id'=>$productId,
				'stock_qty' =>$this->input->post('stockQty') ,
				'stock_qty_limit' =>$updatedstockQtyLimit,
				'online_stock_qty' =>$updatedonlineQty,
				'offline_stock_qty' =>$updatedofflineQty,
				'transit_qty' =>$this->input->post('transitQty')
				
			);	
			
			$this->Product_model->add_stock_d_details($data);
			
			$data =array
			(
				'last_updated'=>mdate($datestring),
				'continues_count'=> (int)$prodcount + 1
			);
		
			
			$this->Product_model->incriment_productcode_no($data,$entCode);
			
			$new_product_added[] = array('message' => 'Product added successfully');

			print_r(json_encode($new_product_added));
		}	
	}
	
	/* public function updateproduct() //Need to test
	{
		$entCode = $this->input->post('entCode');
		$productCode = $this->input->post('productCode');
		$productId = $this->input->post('productId');
		$producthId = $this->input->post('producthId');
		$data['auto_code'] = $this->Product_model->get_productcode($entCode);
		
		$prodCode = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].'-'.$data['auto_code']['continues_count'];
		
		$mrp = $this->input->post('mrp');
		$purchaseRate = $this->input->post('purchaseRate');
		$saleRate = $this->input->post('saleRate');
		$datestring = date('Y-m-d');
		$batchNo = $this->input->post('batchNo');
		$batchno = $prodcode.'-'.(String)$this->input->post('prodExpDate').'-'.(int)$this->input->post('mrp').'-'.(int)$this->input->post('purchaseRate').'-'.(int)$this->input->post('saleRate');
	
	
		if($batchNo == $batchno)
			{
			$data =array
			(
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$this->input->post('productName'),
				'product_description'=>$this->input->post('productDescription'),
				'product_status_index'=>$this->input->post('productStatus'),
				'category_index'=>$this->input->post('productCategory'),
				'sub_category_index'=>$this->input->post('productSubCategory'),
			);
		
		$this->Product_model->update_product_details($productId,$data);
		
		$data =array
			(	
				'product_id'=>$productId,
				'productBatch' => $batchno,
				'product_pack_date' =>$datestring,
				'product_exp_date' =>$datestring,
				'mrp' =>$mrp,
				'tax_precent' =>$this->input->post('taxPrecent'),
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$this->input->post('purchaseQty'),
			);
			
		$this->Product_model->update_stock_h_details($producthId,$productId,$data);
		$data =array
			(		
				'stock_h_id'=>$stockhId,
				'product_id'=>$productId,
				'stock_qty' =>$this->input->post('stockQty') ,
				'stock_qty_limit' =>$this->input->post('stockQtyLimit') ,
				'online_stock_qty' =>$this->input->post('onlineStockQty'),
				'offline_stock_qty' =>$this->input->post('offlineStockQty'),
				'transit_qty' =>$this->input->post('transitQty'),
				'created_datetime' =>$this->input->post('createdDatetime')
				
			);	
			
			$this->Product_model->update_stock_d_details($data);
			
			$new_product_added[] = array('message' => 'Product updated successfully');

			print_r(json_encode($new_product_added));
			}
			else{
			
			$data =array
			(
				
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$this->input->post('productName'),
				'product_description'=>$this->input->post('productDescription'),
				'product_status_index'=>$this->input->post('productStatus'),
				'category_index'=>$this->input->post('productCategory'),
				'sub_category_index'=>$this->input->post('productSubCategory'),
			);
		
		$this->Product_model->update_product_details($productId,$data);
		
		$data =array
			(	
				'product_id'=>$productId,
				'productBatch' => $batchno,
				'product_pack_date' =>$datestring,
				'product_exp_date' =>$datestring,
				'mrp' =>$mrp,
				'tax_precent' =>$this->input->post('taxPrecent'),
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$this->input->post('purchaseQty'),
			);
			
		$this->Product_model->add_stock_h_details($data);
		$stockhId = $this->Product_model->get_max_stock_h_id();
		$data =array
			(		
				'stock_h_id'=>$stockhId,
				'product_id'=>$productId,
				'stock_qty' =>$this->input->post('stockQty') ,
				'stock_qty_limit' =>$this->input->post('stockQtyLimit') ,
				'online_stock_qty' =>$this->input->post('onlineStockQty'),
				'offline_stock_qty' =>$this->input->post('offlineStockQty'),
				'transit_qty' =>$this->input->post('transitQty'),
				'created_datetime' =>$this->input->post('createdDatetime')
				
			);	
			
			$this->Product_model->add_stock_d_details($data);
			
			$new_product_added[] = array('message' => 'Product added successfully');

			print_r(json_encode($new_product_added));
			
			}
		
	} */
	
	public function stockDetails() { //working as expected. 
		//$entCode = $this->input->post('entCode');
		$entCode = 10002;
		$stock = $this->Product_model->stock_details('ASC', $entCode);				
		
		if (count($stock) >0) {
			foreach($stock as $row)
				$all_stock[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productDescription'=>$row['product_description'],
					'productStatus'=>$row['product_status_index_name'],
					'productStatusIndex'=>$row['product_status_index'],
					'productCategory'=>$row['category_index_name'],
					'productCategoryIndex'=>$row['category_index'],
					'productSubCategory'=>$row['sub_category_index_name'],
					'productSubCategoryIndex'=>$row['sub_category_index'],
					'productHID' => $row['producthId'],
					'productBatch' => $row['product_batch'],
					'packetsInBox' => $row['packets_in_box'],
					'productPackDate' =>$row['product_pack_date'],
					'productExpDate' =>$row['product_exp_date'],
					'mrp' =>$row['mrp'],
					'taxPercent' =>$row['tax_precent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productDID' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineStockQty' =>$row['offline_stock_qty'],
					'previousStockQty' =>$row['stock_qty'],
					'previousOnlineStockQty' =>$row['online_stock_qty'],
					'previousOfflineStockQty' =>$row['offline_stock_qty'],
					'transitQty' =>$row['transit_qty'],
					'createdDatetime' =>$row['created_datetime']
				);
				
				
			
			$all_stock_data[] = array(
				'getProductDetails' =>'getProductDetails',
				'stockDetails' => $all_stock,
			);
			print_r(json_encode($all_stock_data));
		 } else {
			$no_stock_data[] = array(
				'' => ''
			);
				
			print_r(json_encode($no_stock_data));
		}
	}
	
	public function purchaseProductDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$stock = $this->Product_model->low_stock_details($entCode);				
		
		if (count($stock) >0) {
			foreach($stock as $row)
				$all_stock[] = array(
					'id'=>$row['id'],
					'entCode'=>$row['ent_code'],
					'productCode'=>$row['product_code'],
					'productName'=>$row['product_name'],
					'productDescription'=>$row['product_description'],
					'productStatus'=>$row['product_status_index_name'],
					'productStatusIndex'=>$row['product_status_index'],
					'productCategory'=>$row['category_index_name'],
					'productCategoryIndex'=>$row['category_index'],
					'productSubCategory'=>$row['sub_category_index_name'],
					'productSubCategoryIndex'=>$row['sub_category_index'],
					'productHID' => $row['producthId'],
					'productBatch' => $row['product_batch'],
					'packetsInBox' => $row['packets_in_box'],
					'productPackDate' =>$row['product_pack_date'],
					'productExpDate' =>$row['product_exp_date'],
					'mrp' =>$row['mrp'],
					'taxPercent' =>$row['tax_precent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productDID' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineStockQty' =>$row['offline_stock_qty'],
					'previousStockQty' =>$row['stock_qty'],
					'previousOnlineStockQty' =>$row['online_stock_qty'],
					'previousOfflineStockQty' =>$row['offline_stock_qty'],
					'transitQty' =>$row['transit_qty'],
					'createdDatetime' =>$row['created_datetime']
				);
			
			$all_stock_data[] = array(
				'getProductDetails' =>'getProductDetails',
				'getSelectedProductDetails' => 'getSelectedProductDetails',
				'stockDetails' => $all_stock
			);		
			print_r(json_encode($all_stock_data));
		 } else {
			$no_stock_data[] = array(
				'' => ''
			);
				
			print_r(json_encode($no_stock_data));
		}
	}
	
	
	
}
