<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->model('Index_model');
		$this->load->model('Product_model');
		require(APPPATH . 'third_party/PHPExcel_1.8/Classes/PHPExcel.php');
		require(APPPATH . 'third_party/PHPExcel_1.8/Classes/PHPExcel/Writer/Excel2007.php');
	}
	
       function generateProductTemplate()
	{
		$objPHPExcel = new PHPExcel();
		
		  $objPHPExcel->setActiveSheetIndex(0);
		
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','Category');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Sub Category');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Product Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Product Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Stock Limit');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Pack Date(dd-mm-yyyy)');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Exp Date(dd-mm-yyyy)');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','UOM');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','MRP');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Pur Rate');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Sale Rate');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','Tax %');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','Pc/Pack In Box');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','Stock Qty');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1','Online Qty');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1','Offline Qty');

		  $objPHPExcel->getActiveSheet()->setTitle("Product Details");
		  $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getAlignment()->setHorizontal('center');
		  $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->applyFromArray(array('font'=>array('size'=>12)));
			  
		 $filename = "ProductsUploadTemplate.xlsx"; 
 		  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		  header('Content-Disposition: attachment;filename="'.$filename.'"');
		  header('Cache-Control: max-age=0');
		  $writer = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

		  $writer->save('php://output');
		  exit;
	}
	
	function uploadProducts()
	{
		//$entCode = $this->input->post('ent_code');
		$entCode = '10002';
		//UPLOAD STARTS
			$config['upload_path'] = './upload/File/';
			$config['allowed_types'] = 'xls|xlsx';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$uploadedFile = "ProductsUploadTemplate.xlsx";
			$object =  PHPExcel_IOFactory::load($config['upload_path'].$uploadedFile);
				
                foreach($object->getWorksheetIterator() as $worksheet)
   				{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				
				if($highestRow > 1){
				for($row=2; $row<=$highestRow; $row++)
				{
				
				 $productCategory= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
				 $productSubCategory = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				 
				 $categoryIndex = $this->Index_model->product_category_based_on_param($productCategory);
				 $SubCategoryIndex = $this->Index_model->product_sub_category_based_on_param($productSubCategory,$categoryIndex['_id']);
				 $productName = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				 $productDescription = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
				 $stockQtyLimit = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
				 $packDate = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
				 $expDate = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
				 
				 if($packDate == "")
				 {
					$packDate = date('Y-m-d');
										
				 }
				 if($expDate == "")
				 {
					$expDate = date('Y-m-d', strtotime('+1 month', strtotime($packDate)));
				 }
				 $uom = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
				 
				 $uomType = $this->Index_model->get_uom_index_by_name($uom);
				 
				 $mrp = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
				 $purchaseRate = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
				 $saleRate = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
				 $taxPer = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
				 $packInBox = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
				 $stockQty = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
				 $onlineStockQty = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
				 $offlineStockQty = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
				 
				 
				 if($uomType['_id'] == 10009)
				 {
					$updatedpurchaseQty = $stockQty *1000;
					$updatedstockQty = $stockQty *1000;
					$updatedonlineQty = $onlineStockQty *1000;
					$updatedofflineQty = $offlineStockQty *1000;
					$updatedstockQtyLimit  = ( $stockQtyLimit  * 1000);
					$mrp = (double)$mrp / 1000;
					$purchaseRate = (double)$purchaseRate / 1000;
					$saleRate = (double)$saleRate / 1000;
					
				}else if($uomType['_id'] == 10008){
					
					$updatedpurchaseQty = $stockQty;
					$updatedstockQty = $stockQty;
					$updatedonlineQty = $onlineStockQty;
					$updatedofflineQty = $offlineStockQty;
					$updatedstockQtyLimit = $stockQtyLimit;
					$mrp = (double)$mrp;
					$purchaseRate = (double)$purchaseRate;
					$saleRate = (double)$saleRate;
					
				}else if($uomType['_id'] == 10010){
					
					$updatedpurchaseQty = $stockQty;
					$updatedstockQty = $stockQty;
					$updatedonlineQty = $onlineStockQty;
					$updatedofflineQty = $offlineStockQty;
					$updatedstockQtyLimit = $stockQtyLimit;
					$mrp = (double)$mrp;
					$purchaseRate = (double)$purchaseRate;
					$saleRate = (double)$saleRate;
					
				}else if($uomType['_id'] == 10024){
					$updatedpurchaseQty = $purchaseQty * $packInBox;
					$updatedstockQty = $stockQty * $packInBox;
					$updatedonlineQty = $onlineStockQty * $packInBox;
					$updatedofflineQty = $offlineStockQty * $packInBox;
					$updatedstockQtyLimit  = ( $stockQtyLimit  * $packInBox);
					$mrp = (double)$mrp / $packInBox;
					$purchaseRate = (double)$purchaseRate / $packInBox;
					$saleRate = (double)$saleRate / $packInBox;
					
				}else if($uomType['_id'] == 10011){
					
					$updatedpurchaseQty = $purchaseQty;
					$updatedstockQty = $stockQty;
					$updatedonlineQty = $onlineStockQty;
					$updatedofflineQty = $offlineStockQty;
					$updatedstockQtyLimit = $stockQtyLimit;
					$mrp = (double)$mrp;
					$purchaseRate = (double)$purchaseRate;
					$saleRate = (double)$saleRate;
					
				}else if($uomType['_id'] == 10012){
					
					$updatedpurchaseQty = $purchaseQty;
					$updatedstockQty = $stockQty;
					$updatedonlineQty = $onlineStockQty;
					$updatedofflineQty = $offlineStockQty;
					$updatedstockQtyLimit = $stockQtyLimit;
					$mrp = (double)$mrp;
					$purchaseRate = (double)$purchaseRate;
					$saleRate = (double)$saleRate;
				}
				 
				
				if(count($categoryIndex['_id']) == 1){
					 if(count($SubCategoryIndex['_id']) == 1){
						if($productName != ''){
						$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'product_description'=>$productDescription,
						'stock_qty_limit'=>$updatedstockQtyLimit,
						'upload_status_id' => 0,
						'upload_status' => "",
						);
				
						$this->Product_model->add_temp_product_details($data);
						
						
						$productId = $this->Product_model->get_max_temp_product_id();
						$data =array
							(	
								'product_id'=>$productId,
								'product_pack_date' =>$packDate,
								'product_exp_date' =>$expDate,
								'mrp' =>$mrp,
								'tax_precent' =>$taxPer,
								'purchase_rate' =>$purchaseRate,
								'sale_rate' =>$saleRate,
								'purchase_qty' =>$updatedpurchaseQty,
								'ent_code'=>$entCode,
							);
							
						$this->Product_model->add_temp_stock_h_details($data);
						$stockhId = $this->Product_model->get_max_temp_stock_h_id();
						$data =array
							(		
								'stock_h_id'=>$stockhId,
								'product_id'=>$productId,
								'stock_qty' =>$updatedstockQty ,
								'online_stock_qty' =>$updatedonlineQty,
								'offline_stock_qty' =>$updatedofflineQty,
								'ent_code'=>$entCode,
								
							);	
							
							$this->Product_model->add_temp_stock_d_details($data);
						
						
						
						$count = 0; 	
						}else{
						
						$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'product_description'=>$productDescription,
						'stock_qty_limit'=>$updatedstockQtyLimit,
						'upload_status_id' => 1,
						'upload_status' => "Invalid Product",
					);
				
						$this->Product_model->add_temp_product_details($data);
						
						$productId = $this->Product_model->get_max_temp_product_id();
						$data =array
							(	
								'product_id'=>$productId,
								'product_pack_date' =>$packDate,
								'product_exp_date' =>$expDate,
								'mrp' =>$mrp,
								'tax_precent' =>$taxPer,
								'purchase_rate' =>$purchaseRate,
								'sale_rate' =>$saleRate,
								'purchase_qty' =>$updatedpurchaseQty,
								'ent_code'=>$entCode,
							);
							
						$this->Product_model->add_temp_stock_h_details($data);
						$stockhId = $this->Product_model->get_max_temp_stock_h_id();
						$data =array
							(		
								'stock_h_id'=>$stockhId,
								'product_id'=>$productId,
								'stock_qty' =>$updatedstockQty ,
								'online_stock_qty' =>$updatedonlineQty,
								'offline_stock_qty' =>$updatedofflineQty,
								'ent_code'=>$entCode,
								
							);	
							
							$this->Product_model->add_temp_stock_d_details($data);
						$count = 1; 						
						}
					
					}else{
						$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'product_description'=>$productDescription,
						'stock_qty_limit'=>$updatedstockQtyLimit,
						'upload_status_id' => 1,
						'upload_status' => "Invalid Sub Category",
					);
				
                	$this->Product_model->add_temp_product_details($data);
						
						$productId = $this->Product_model->get_max_temp_product_id();
						$data =array
							(	
								'product_id'=>$productId,
								'product_pack_date' =>$packDate,
								'product_exp_date' =>$expDate,
								'mrp' =>$mrp,
								'tax_precent' =>$taxPer,
								'purchase_rate' =>$purchaseRate,
								'sale_rate' =>$saleRate,
								'purchase_qty' =>$updatedpurchaseQty,
								'ent_code'=>$entCode,
							);
							
						$this->Product_model->add_temp_stock_h_details($data);
						$stockhId = $this->Product_model->get_max_temp_stock_h_id();
						$data =array
							(		
								'stock_h_id'=>$stockhId,
								'product_id'=>$productId,
								'stock_qty' =>$updatedstockQty ,
								'online_stock_qty' =>$updatedonlineQty,
								'offline_stock_qty' =>$updatedofflineQty,
								'ent_code'=>$entCode,
								
							);	
							
							$this->Product_model->add_temp_stock_d_details($data);
					$count = 1;  
					 }
					 
					
				 }else{
					$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'product_description'=>$productDescription,
						'stock_qty_limit'=>$updatedstockQtyLimit,
						'upload_status_id' => 1,
						'upload_status' => "Invalid Category",
					);
				
                	$this->Product_model->add_temp_product_details($data);
					
						$productId = $this->Product_model->get_max_temp_product_id();
						$data =array
							(	
								'product_id'=>$productId,
								'product_pack_date' =>$packDate,
								'product_exp_date' =>$expDate,
								'mrp' =>$mrp,
								'tax_precent' =>$taxPer,
								'purchase_rate' =>$purchaseRate,
								'sale_rate' =>$saleRate,
								'purchase_qty' =>$updatedpurchaseQty,
								'ent_code'=>$entCode,
							);
							
						$this->Product_model->add_temp_stock_h_details($data);
						$stockhId = $this->Product_model->get_max_temp_stock_h_id();
						$data =array
							(		
								'stock_h_id'=>$stockhId,
								'product_id'=>$productId,
								'stock_qty' =>$updatedstockQty ,
								'online_stock_qty' =>$updatedonlineQty,
								'offline_stock_qty' =>$updatedofflineQty,
								'ent_code'=>$entCode,
								
							);	
							
							$this->Product_model->add_temp_stock_d_details($data);
					$count = 1; 
				 }
				
				};

			
		}
     }
	 if($count == 0)
		{
			
			$proddetails = $this->Product_model->temp_stock_details('ASC',$entCode);
			$linecount = count($proddetails);
			for($i=0; $i < $linecount ; $i++){
				
				$data['auto_code'] = $this->Product_model->get_productcode($entCode);
					//print_r($data['auto_code']);
				$productCode = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].'-'.$data['auto_code']['continues_count'];
				$productcount = $data['auto_code']['continues_count'];
				$batchno = $productCode.''.$proddetails[$i]['product_exp_date'].''.$proddetails[$i]['purchase_qty'].''.$proddetails[$i]['sale_rate'];
				
				$proddetails = $this->Product_model->temp_stock_details('ASC',$entCode);
				
				$data =array
						(
							
							'ent_code'=>$proddetails[$i]['ent_code'],
							'product_code'=>$productCode,
							'product_name'=>$proddetails[$i]['product_name'],
							'product_description'=>$proddetails[$i]['product_description'],
							'product_status_index'=>10013,
							'category_index'=>$proddetails[$i]['category_index'],
							'sub_category_index'=>$proddetails[$i]['sub_category_index'],
							'stock_qty_limit' =>$proddetails[$i]['stock_qty_limit'],
						);
					
					$this->Product_model->add_product_details($data);
					$productId = $this->Product_model->get_max_product_id();
					$data =array
						(	
							'product_id'=>$productId,
							'product_batch' => $batchno,
							'product_pack_date' =>$proddetails[$i]['product_pack_date'],
							'product_exp_date' =>$proddetails[$i]['product_exp_date'],
							'mrp' =>$proddetails[$i]['mrp'],
							'tax_precent' =>$proddetails[$i]['tax_precent'],
							'purchase_rate' =>$proddetails[$i]['purchase_rate'],
							'sale_rate' =>$proddetails[$i]['sale_rate'],
							'purchase_qty' =>$proddetails[$i]['purchase_qty'],
						);
						
					$this->Product_model->add_stock_h_details($data);
					$stockhId = $this->Product_model->get_max_stock_h_id();
					$data =array
						(		
							'stock_h_id'=>$stockhId,
							'product_id'=>$productId,
							'stock_qty' =>$proddetails[$i]['stock_qty'],
							'online_stock_qty' =>$proddetails[$i]['online_stock_qty'],
							'offline_stock_qty' =>$proddetails[$i]['offline_stock_qty']
							
						);	
						
					$this->Product_model->add_stock_d_details($data);
				
				
					
					$datestring = date('Y-m-d H:i:s');
					$data =array(
					'last_updated'=>mdate($datestring),
					'continues_count'=> (int)$productcount + 1
					);

					$this->Product_model->incriment_productcode_no($data,$entCode);
				
				
			}	
			 
			$this->Product_model->delete_records_from_tab_temp_product($entCode);
			$this->Product_model->delete_records_from_tab_temp_stock_h($entCode);
			$this->Product_model->delete_records_from_tab_temp_stock_d($entCode);
			
			$product_message[] = array('message' => 'Product added successfully');
			print_r(json_encode($product_message));
		}		
	}				
    
	function file_check($str){
        $allowed_mime_type_arr = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        
		if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only XLS/XLSX file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
	
	function loadUploadProducts() {
			$file_data[] = array('' => '');
			print_r(json_encode($file_data));
		}
}	