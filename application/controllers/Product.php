<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller 
{

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Index_model');
		$this->load->library('encrypt');
		
		require(APPPATH . 'third_party/PHPExcel_1.8/Classes/PHPExcel.php');
		require(APPPATH . 'third_party/PHPExcel_1.8/Classes/PHPExcel/Writer/Excel2007.php');	
		
	}
	
	public function getProductDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$data['auto_code'] = $this->Product_model->get_productcode($entCode);
		$categoryList = $this->Product_model->get_product_category($entCode);
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
					'taxPercent' =>$row['tax_percent'],
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
					'previousofflineQty' =>$row['offline_stock_qty'],
					'transitQty' =>$row['transit_qty'],
					'createdDatetime' =>$row['created_datetime']
				);
		
		$all_stock_data[] = array(
			'addUpdateProduct' => 'Add/Update Product', // on click of save button on add new product screen
			'getSelectedProductDetails' => 'getSelectedProductDetails', // on click of each product call this method
			'productCode' => $prodCode,
			'productDetails' => $prod_details,
			'prodCategory' => $categoryList,
			'prodSubCategory' => $subCategoryList,
			'uomDetails' => $UOMDetails,
			'productCount' =>$data['auto_code']['continues_count']
		);
		
		print_r(json_encode($all_stock_data));
		
		
	}
	}
	
	public function getSelectedProductDetails() {//working as expected. 
		$entCode = $this->input->post('entCode');
		$ProductCode = $this->input->post('prodcutCode');
		$batchno = $this->input->post('batchNo');
		
		
		$categoryList = $this->Product_model->get_product_category($entCode);
		$subCategoryList = $this->Product_model->get_product_sub_category();
		$UOMDetails = $this->Product_model->get_uom_details();			
		$products = $this->Product_model->product_details_by_id('ASC',$ProductCode, $entCode,$batchno);				
		
		$product_data[] = array(
			'addUpdateProduct' => 'Add/update Product', // on click of save button on add/Update product screen
			'productDetails' => $products,
			'prodCategory' => $categoryList,
			'prodSubCategory' => $subCategoryList,
			'uomDetails' => $UOMDetails,
		);
		
		print_r(json_encode($product_data));
	
	}
	
	
	public function stockDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
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
					'taxPercent' =>$row['tax_percent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productDID' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineQty' =>$row['offline_stock_qty'],
					'previousStockQty' =>$row['stock_qty'],
					'previousOnlineStockQty' =>$row['online_stock_qty'],
					'previousofflineQty' =>$row['offline_stock_qty'],
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
					'taxPercent' =>$row['tax_percent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productDID' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineQty' =>$row['offline_stock_qty'],
					'previousStockQty' =>$row['stock_qty'],
					'previousOnlineStockQty' =>$row['online_stock_qty'],
					'previousofflineQty' =>$row['offline_stock_qty'],
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
	
	

	public function addUpdateproduct() //Need to test
	{
		$entCode = $this->input->post('entCode');
		$productCode = $this->input->post('productCode');
		$productName =$this->input->post('productName');
		$productId = $this->input->post('productId');
		$producthId = $this->input->post('producthId');
		$productCategory = $this->input->post('productCategory');
		$productSubCategory = $this->input->post('productSubCategory');
		$uomType = $this->input->post('productUOM');
		$tabUomDetails = $this->Product_model->get_uom_details_based_on_filters($productCategory,$productSubCategory);
		$packDate = $this->input->post('productPackDate');
		$prodExpDate = $this->input->post('productExpDate');
		$stockQtyLimit = (int)$this->input->post('stockQtyLimit');
		$packInBox = (int)$this->input->post('packetsInBox');
		$purchaseQty = (int)$this->input->post('purchaseQty');
		$stockQty = (int)$this->input->post('purchaseQty');
		$onlineQty = (int)$this->input->post('onlineQty');
		$offlineQty = (int)$this->input->post('offlineQty'); 
		$mrp = (double)$this->input->post('mrp');
		$purchaseRate = (double)$this->input->post('purchaseRate');
		$saleRate = (double)$this->input->post('saleRate');
		$taxPercent = (double)$this->input->post('taxPercent');
		$prodCount = (int)$this->input->post('productCount');
		$uomcount = count($tabUomDetails);
		
		$count = 0;
		
		for($i = 0; $i<$uomcount; $i++ )
		{
			if($tabUomDetails[$i]['_id'] == 10008  ||$tabUomDetails[$i]['_id'] == 10009 ||$tabUomDetails[$i]['_id'] == 10010){
				$count = 1;
				break;
				
			}else if($tabUomDetails[$i]['_id'] == 10024 ||$tabUomDetails[$i]['_id'] == 10011||$tabUomDetails[$i]['_id'] == 10012 )
			{
				$count = 2;
			    break;				
			}
		}
		$data['auto_code'] = $this->Product_model->get_productcode($entCode);
	
		$prodCode = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].'-'.$data['auto_code']['continues_count'];
			
		
		//print_r($prodCode);
		
		
		if($count == 1)//Kg and //Gram //Bundle
		{
		if($prodCode == $productCode)
		{
			//Quantity calculation
		if($uomType== 10009){
		$updatedpurchaseQty = $purchaseQty *1000;
		$updatedstockQty = $stockQty *1000;
		$updatedonlineQty = $onlineQty *1000;
		$updatedofflineQty = $offlineQty *1000;
		$updatedstockQtyLimit  =  $stockQtyLimit  * 1000;
		$mrp = (double)$mrp / 1000;
		$purchaseRate = (double)$purchaseRate / 1000;
		$saleRate = (double)$saleRate / 1000;
		
		}else if($uomType== 10008){
		
		$updatedpurchaseQty = $purchaseQty;
		$updatedstockQty = $stockQty;
		$updatedonlineQty = $onlineQty;
		$updatedofflineQty = $offlineQty;
		$updatedstockQtyLimit = $stockQtyLimit;
		$mrp = (double)$mrp;
		$purchaseRate = (double)$purchaseRate;
		$saleRate = (double)$saleRate;
		
		}else if($uomType == 10010){
		
		$updatedpurchaseQty = $purchaseQty;
		$updatedstockQty = $stockQty;
		$updatedonlineQty = $onlineQty;
		$updatedofflineQty = $offlineQty;
		$updatedstockQtyLimit = $stockQtyLimit;
		$mrp = (double)$mrp;
		$purchaseRate = (double)$purchaseRate;
		$saleRate = (double)$saleRate;
		}
		
		$batchno = $productCode.''.$prodExpDate.''.$purchaseRate.''.$saleRate;
		$data =array
			(
				
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$productName,
				'product_status_index'=>10013,
				'category_index'=>$productCategory,
				'sub_category_index'=>$productSubCategory,
				'stock_qty_limit' =>$updatedstockQtyLimit,
			);
		
		$this->Product_model->add_product_details($data);
		$productId = $this->Product_model->get_max_product_id();
		$data =array
			(	
				'product_id'=>$productId,
				'product_batch' => $batchno,
				'product_pack_date' =>$packDate,
				'product_exp_date' =>$prodExpDate,
				'mrp' =>$mrp,
				'tax_percent' =>$taxPercent,
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$updatedpurchaseQty,
			);
			
		$this->Product_model->add_stock_h_details($data);
		$producthId = $this->Product_model->get_max_stock_h_id();
		$data =array
			(		
				'stock_h_id'=>$producthId,
				'product_id'=>$productId,
				'stock_qty' =>$updatedstockQty ,
				'online_stock_qty' =>$updatedonlineQty,
				'offline_stock_qty' =>$updatedofflineQty
				
			);	
			
			$this->Product_model->add_stock_d_details($data);
			
			$datestring = date('Y-m-d');
			$data =array
			(
				'last_updated'=>mdate($datestring),
				'continues_count'=> (int)$prodCount + 1
			);
		
			
			$this->Product_model->incriment_productcode_no($data,$entCode);
			
			$product_message[] = array('message' => 'Product Added Successfully');

			print_r(json_encode($product_message));
			
		}else
		{
			$oldBatchNo = $this->input->post('oldBatchNo');
			$products = $this->Product_model->product_details_by_id('ASC',$productCode, $entCode,$oldBatchNo);	
			//Quantity calculation
			if($uomType== 10009){
			$updatedpurchaseQty = ( $purchaseQty * 1000) +  $products['purchase_qty'];
			$updatedstockQty = ( $stockQty * 1000) + $products['stock_qty'];
			$updatedonlineQty = ( $onlineQty  * 1000);
			$updatedofflineQty = ( $offlineQty  * 1000);
			$updatedstockQtyLimit  = ( $stockQtyLimit  * 1000);
			$mrp = (double)$mrp / 1000;
			$purchaseRate = (double)$purchaseRate / 1000;
			$saleRate = (double)$saleRate / 1000;
			
			}else if($uomType== 10008){
			
			$updatedpurchaseQty = $purchaseQty  +  $products['purchase_qty'];
			$updatedstockQty = $stockQty  + $products['stock_qty'];
			$updatedonlineQty = $onlineQty;
			$updatedofflineQty = $offlineQty;
			$updatedstockQtyLimit = $stockQtyLimit;
			$mrp = (double)$mrp;
			$purchaseRate = (double)$purchaseRate;
			$saleRate = (double)$saleRate;
			
			}else if($uomType == 10010){
			
			$updatedpurchaseQty = $purchaseQty  +  $products['purchase_qty'];
			$updatedstockQty = $stockQty  + $products['stock_qty'];
			$updatedonlineQty = $onlineQty ;
			$updatedofflineQty = $offlineQty ;
			$updatedstockQtyLimit = $stockQtyLimit;
			$mrp = (double)$mrp;
			$purchaseRate = (double)$purchaseRate;
			$saleRate = (double)$saleRate;
			
			}
			
			$batchno = $productCode.''.$prodExpDate.''.$purchaseRate.''.$saleRate;
			$data =array
			(
			'product_status_index'=>10013,
			'stock_qty_limit'=>$updatedstockQtyLimit,
			);
			 $this->Product_model->update_product_details($productId,$data);
			 
			 
			 $data =array
			(	
			'product_id'=>$productId,
			'product_batch' => $batchno,
			'product_pack_date' =>$packDate,
			'product_exp_date' =>$prodExpDate,
			'mrp' =>$mrp,
			'tax_percent' =>$taxPercent,
			'purchase_rate' =>$purchaseRate,
			'sale_rate' =>$saleRate,
			'purchase_qty' =>$updatedpurchaseQty,
			);
		
			$this->Product_model->update_stock_h_details($producthId,$productId,$data);
			
			$data =array
				(		
					'stock_h_id'=>$producthId,
					'product_id'=>$productId,
					'stock_qty' =>$updatedstockQty ,
					'online_stock_qty' =>$updatedonlineQty ,
					'offline_stock_qty' =>$updatedofflineQty
				);	
				
				$this->Product_model->update_stock_d_details($producthId,$productId,$data);
				
				$product_message[] = array('message' => 'Product Updated Successfully');

				print_r(json_encode($product_message));
			
		}
		  
		}else if($count == 2)//Box and //Packet and //Pcs
		{
			
			
			if($prodCode == $productCode){
			
			$oldBatchNo = $this->input->post('oldBatchNo');
			/* $products = $this->Product_model->product_details_by_id('ASC',$productCode, $entCode,$oldBatchNo);		
			if($uomType== 10024)
				{
						$updatedpurchaseQty = ( $purchaseQty * $packInBox) +  $products['purchase_qty'];
						$updatedstockQty = ( $stockQty * $packInBox) + $products['stock_qty'];
						$updatedonlineQty = ( $onlineQty  * $packInBox) + $products['online_stock_qty'];
						$updatedofflineQty = ( $offlineQty  * $packInBox) + $products['offline_stock_qty'];
						$updatedstockQtyLimit  = ( $stockQtyLimit  * $packInBox);
						$mrp = (double)$mrp / $packInBox;
						$purchaseRate = (double)$purchaseRate / $packInBox;
						$saleRate = (double)$saleRate / $packInBox;
						
				}else if($uomType== 10011){
						
						$updatedpurchaseQty = $purchaseQty  +  $products['purchase_qty'];
						$updatedstockQty = $stockQty  + $products['stock_qty'];
						$updatedonlineQty = $onlineQty + $products['online_stock_qty'];
						$updatedofflineQty = $offlineQty + $products['offline_stock_qty'];
						$updatedstockQtyLimit = $stockQtyLimit;
						$mrp = (double)$mrp;
						$purchaseRate = (double)$purchaseRate;
						$saleRate = (double)$saleRate;
						
				}else if($uomType == 10012){
						
						$updatedpurchaseQty = $purchaseQty  +  $products['purchase_qty'];
						$updatedstockQty = $stockQty  + $products['stock_qty'];
						$updatedonlineQty = $onlineQty + $products['online_stock_qty'];
						$updatedofflineQty = $offlineQty + $products['offline_stock_qty'];
						$updatedstockQtyLimit = $stockQtyLimit;
						$mrp = (double)$mrp;
						$purchaseRate = (double)$purchaseRate;
						$saleRate = (double)$saleRate;
						
				} */
			$batchno = $productCode.''.$prodExpDate.''.$purchaseRate.''.$saleRate;	
		if($oldBatchNo == $batchno)
		{
			echo "<pre>";
			print_r(3);
			echo "</pre>";
			
			/* $data =array
			(
			'product_status_index'=>10013,
			'stock_qty_limit'=>$updatedstockQtyLimit,
			);
			 $this->Product_model->update_product_details($productId,$data);
			 
			 
			 $data =array
			(	
			'product_id'=>$productId,
			'product_batch' => $batchno,
			'product_pack_date' =>$packDate,
			'product_exp_date' =>$prodExpDate,
			'mrp' =>$mrp,
			'tax_percent' =>$taxPercent,
			'purchase_rate' =>$purchaseRate,
			'sale_rate' =>$saleRate,
			'purchase_qty' =>$updatedpurchaseQty,
			);

			$this->Product_model->update_stock_h_details($producthId,$productId,$data);
			
			$data =array
				(		
					'stock_h_id'=>$producthId,
					'product_id'=>$productId,
					'stock_qty' =>$updatedstockQty ,
					'online_stock_qty' =>$updatedonlineQty ,
					'offline_stock_qty' =>$updatedofflineQty
				);	

			$this->Product_model->update_stock_d_details($producthId,$productId,$data);
			
			$product_message[] = array('message' => 'Product updated successfully');

			print_r(json_encode($product_message)); */
		}else{
				
				echo "<pre>";
			print_r(4);
			echo "</pre>";
				
				/* if($uomType== 10024){
				$updatedpurchaseQty = $purchaseQty * $packInBox;
				$updatedstockQty = $stockQty * $packInBox;
				$updatedonlineQty = $onlineQty * $packInBox;
				$updatedofflineQty = $offlineQty * $packInBox;
				$updatedstockQtyLimit  = ( $stockQtyLimit  * $packInBox);
				$mrp = (double)$mrp / $packInBox;
				$purchaseRate = (double)$purchaseRate / $packInBox;
				$saleRate = (double)$saleRate / $packInBox;
				
				}else if($uomType== 10011){
				
				$updatedpurchaseQty = $purchaseQty;
				$updatedstockQty = $stockQty;
				$updatedonlineQty = $onlineQty;
				$updatedofflineQty = $offlineQty;
				$updatedstockQtyLimit = $stockQtyLimit;
				$mrp = (double)$mrp;
				$purchaseRate = (double)$purchaseRate;
				$saleRate = (double)$saleRate;
				
				}else if($uomType == 10012){
				
				$updatedpurchaseQty = $purchaseQty;
				$updatedstockQty = $stockQty;
				$updatedonlineQty = $onlineQty;
				$updatedofflineQty = $offlineQty;
				$updatedstockQtyLimit = $stockQtyLimit;
				$mrp = (double)$mrp;
				$purchaseRate = (double)$purchaseRate;
				$saleRate = (double)$saleRate;
				
				}
				$data =array
				(
				'product_status_index'=>10013,
				'stock_qty_limit'=>$updatedstockQtyLimit,
				);
				$this->Product_model->update_product_details($productId,$data);
				
				
				$data =array
				(	
				'product_id'=>$productId,
				'product_batch' => $batchno,
				'product_pack_date' =>$packDate,
				'product_exp_date' =>$prodExpDate,
				'mrp' =>$mrp,
				'tax_percent' =>$taxPercent,
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$updatedpurchaseQty,
				);
				$this->Product_model->add_stock_h_details($data);
				
				$producthId = $this->Product_model->get_max_stock_h_id();
				
				$data =array
					(		
						'stock_h_id'=>$producthId,
						'product_id'=>$productId,
						'stock_qty' =>$updatedstockQty ,
						'online_stock_qty' =>$updatedonlineQty,
						'offline_stock_qty' =>$updatedofflineQty
						
					);	
					
					$this->Product_model->add_stock_d_details($data);
					
					$product_message[] = array('message' => 'Product updated successfully');

					print_r(json_encode($product_message)); */
			}			
				
			}else
			{
			echo "<pre>";
			print_r(5);
			echo "</pre>";
			//Quantity calculation
				/* if($uomType== 10024){
				$updatedpurchaseQty = $purchaseQty * $packInBox;
				$updatedstockQty = $stockQty * $packInBox;
				$updatedonlineQty = $onlineQty * $packInBox;
				$updatedofflineQty = $offlineQty * $packInBox;
				$updatedstockQtyLimit  = ( $stockQtyLimit  * $packInBox);
				$mrp = (double)$mrp / $packInBox;
				$purchaseRate = (double)$purchaseRate / $packInBox;
				$saleRate = (double)$saleRate / $packInBox;
				
				}else if($uomType== 10011){
				
				$updatedpurchaseQty = $purchaseQty;
				$updatedstockQty = $stockQty;
				$updatedonlineQty = $onlineQty;
				$updatedofflineQty = $offlineQty;
				$updatedstockQtyLimit = $stockQtyLimit;
				$mrp = (double)$mrp;
				$purchaseRate = (double)$purchaseRate;
				$saleRate = (double)$saleRate;
				
				}else if($uomType == 10012){
				
				$updatedpurchaseQty = $purchaseQty;
				$updatedstockQty = $stockQty;
				$updatedonlineQty = $onlineQty;
				$updatedofflineQty = $offlineQty;
				$updatedstockQtyLimit = $stockQtyLimit;
				$mrp = (double)$mrp;
				$purchaseRate = (double)$purchaseRate;
				$saleRate = (double)$saleRate;
				}
				
				$batchno = $prodcode.''.$prodExpDate.''.$purchaseRate.''.$saleRate;	
				$data =array
				(
				'ent_code'=>$entCode,
				'product_code'=>$productCode,
				'product_name'=>$productName,
				'product_status_index'=>10013,
				'category_index'=>$productCategory,
				'sub_category_index'=>$productSubCategory,
				'stock_qty_limit' =>$updatedstockQtyLimit,
				);
				
				$this->Product_model->add_product_details($data);
				$productId = $this->Product_model->get_max_product_id();
				$data =array
				(	
				'product_id'=>$productId,
				'product_batch' => $batchno,
				'product_pack_date' =>$packDate,
				'product_exp_date' =>$prodExpDate,
				'mrp' =>$mrp,
				'tax_percent' =>$taxPercent,
				'purchase_rate' =>$purchaseRate,
				'sale_rate' =>$saleRate,
				'purchase_qty' =>$updatedpurchaseQty,
				);
					
				$this->Product_model->add_stock_h_details($data);
				$producthId = $this->Product_model->get_max_stock_h_id();
				$data =array
				(		
				'stock_h_id'=>$producthId,
				'product_id'=>$productId,
				'stock_qty' =>$updatedstockQty ,
				'online_stock_qty' =>$updatedonlineQty,
				'offline_stock_qty' =>$updatedofflineQty
				);	
				$this->Product_model->add_stock_d_details($data);
				
				$datestring = date('Y-m-d');
				$data =array
				(
					'last_updated'=>mdate($datestring),
					'continues_count'=> (int)$prodCount + 1
				);
			
				$this->Product_model->incriment_productcode_no($data,$entCode);
				
				$product_message[] = array('message' => 'Product added successfully');

				print_r(json_encode($product_message)); */
					
				
			}
		}
	}
		
	
	public function stockMovementTansaction() { 
	
	$entCode = $this->input->post('entCode');
	//$entCode = 10002;
	$UOMDetails = $this->Product_model->get_uom_details();
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
					'taxPercent' =>$row['tax_percent'],
					'purchaseRate' =>$row['purchase_rate'],
					'saleRate' =>$row['sale_rate'],
					'purchaseQty' =>$row['purchase_qty'],
					'productDID' => $row['productdId'],
					'stockQty' =>$row['stock_qty'],
					'stockQtyLimit' =>$row['stock_qty_limit'],
					'onlineStockQty' =>$row['online_stock_qty'],
					'offlineQty' =>$row['offline_stock_qty'],
					'previousStockQty' =>$row['stock_qty'],
					'previousOnlineStockQty' =>$row['online_stock_qty'],
					'previousofflineQty' =>$row['offline_stock_qty'],
					'transitQty' =>$row['transit_qty'],
					'createdDatetime' =>$row['created_datetime']
				);
				
				
			
			$all_trnas_data[] = array(
				'stockMovement' =>'stockMovement',
				'stockDetails' => $all_stock,
				'UOMDetails' => $UOMDetails,
			);
			print_r(json_encode($all_trnas_data));
		 } else {
			$no_stock_data[] = array(
				'' => ''
			);
				
			print_r(json_encode($no_stock_data));
		}
		
	}	
	
	public function stockMovement() 
	{ 
		$entCode = $this->input->post('entCode');
		$batchNo = $this->input->post('batchNo');
		$transId = $this->input->post('transId');
		$uomType = $this->input->post('uomType');
		$onlineStock = $this->input->post('onlineStock');
		$offlineStock = $this->input->post('offlineStock');
		$transferQty = $this->input->post('transferQty'); 
		
		
		
		 if($uomType == 10009)
				 {
					$updatedonlineQty = $onlineStock *1000;
					$updatedofflineQty = $offlineStock *1000;
					$updatedtransferQty  = $transferQty  * 1000;
					
				}else if($uomType == 10008){
					
					$updatedonlineQty = $onlineStock;
					$updatedofflineQty = $offlineStock;
					$updatedtransferQty  = $transferQty;
					
				}else if($uomType == 10010){
					
					$updatedonlineQty = $onlineStock;
					$updatedofflineQty = $offlineStock;
					$updatedtransferQty  = $transferQty;
					
				}else if($uomType == 10024){
					$updatedpurchaseQty = $purchaseQty * $packInBox;
					$updatedstockQty = $stockQty * $packInBox;
					$updatedonlineQty = $onlineStockQty * $packInBox;
					$updatedofflineQty = $offlineQty * $packInBox;
					$updatedstockQtyLimit  = ( $stockQtyLimit  * $packInBox);
					$mrp = (double)$mrp / $packInBox;
					$purchaseRate = (double)$purchaseRate / $packInBox;
					$saleRate = (double)$saleRate / $packInBox;
					
					$updatedonlineQty = $onlineStock * $packInBox;
					$updatedofflineQty = $offlineStock * $packInBox;
					$updatedtransferQty  = $transferQty * $packInBox;
					
				}else if($uomType == 10011){
					
					$updatedonlineQty = $onlineStock;
					$updatedofflineQty = $offlineStock;
					$updatedtransferQty  = $transferQty;
					
				}else if($uomType == 10012){
					
					$updatedonlineQty = $onlineStock;
					$updatedofflineQty = $offlineStock;
					$updatedtransferQty  = $transferQty;
				}
		
		
		if($transId == 10026){
			$data =array
			(		
			'online_stock_qty' =>$updatedonlineQty + $updatedtransferQty,
			'offline_stock_qty' =>$updatedofflineQty - $updatedtransferQty
			);
			$this->Product_model->update_stock_movement_details($data,$productDID);
		}else if($transId == 10027){
			$data =array
			(		
			'online_stock_qty' =>$updatedonlineQty - $updatedtransferQty,
			'offline_stock_qty' =>$updatedofflineQty + $updatedtransferQty
			);
			$this->Product_model->update_stock_movement_details($data,$productDID);	
			
		}
		
					
		
					
					
	}	
		
	
}
