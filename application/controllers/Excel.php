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

		 $objPHPExcel->getActiveSheet()->setTitle("Product Details");
		  $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
		  $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray(array('font'=>array('size'=>12)));
			  
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
				 $data['auto_code'] = $this->Product_model->get_productcode($entCode);
				 //print_r($data['auto_code']);
				 $prodcode = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].'-'.$data['auto_code']['continues_count'];
				 // print_r($prodcode);
				 $productcount = $data['auto_code']['continues_count'];
				 //print_r($productcount);
				 $productCategory= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
				 $productSubCategory = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				 
				 $categoryIndex = $this->Index_model->product_category_based_on_param($productCategory);
				 //print_r(count($categoryIndex['category_index']));
				 $SubCategoryIndex = $this->Index_model->product_sub_category_based_on_param($productSubCategory,$categoryIndex['category_index']);
				 //print_r(count($SubCategoryIndex['sub_category_index']));
				 $productName = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				//print_r($productName);
				
				if(count($categoryIndex['category_index']) == 1){
					 if(count($SubCategoryIndex['sub_category_index']) == 1){
						if($productName != ''){
						$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'upload_status_id' => 0,
						'upload_status' => "",
						);
				
						$this->Product_model->add_temp_product_details($data);
						
						//stock_h records
						//stock_d records
						$count = 1; 	
						}else{
						
						$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'upload_status_id' => 1,
						'upload_status' => "Invalid Or Empty Product",
					);
				
						$this->Product_model->add_temp_product_details($data);
						
						//stock_h records
						//stock_d records
						$count = 1; 						
						}
					
					}else{
						$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'upload_status_id' => 1,
						'upload_status' => "Invalid Or Empty Sub Category",
					);
				
                	$this->Product_model->add_temp_product_details($data);
						
						//stock_h records
						//stock_d records
					$count = 1;  
					 }
					 
					
				 }else{
					$data = array(
						'ent_code'=>$entCode,
						'product_name'=>$productName,
						'product_status_index'=>'10013',
						'category_index'=>$categoryIndex['_id'],
						'sub_category_index'=>$SubCategoryIndex['_id'],
						'upload_status_id' => 1,
						'upload_status' => "Invalid Or Empty Category",
					);
				
                	$this->Product_model->add_temp_product_details($data);
					
						//stock_h records
						//stock_d records
					$count = 1; 
				 }
				
				
				if($count == 0){
					$datestring = date('Y-m-d H:i:s');
					$data =array(
					'last_updated'=>mdate($datestring),
					'continues_count'=> (int)$productcount + 1
					);

					$this->Product_model->incriment_productcode_no($data,$entCode);

					$file_upload_data[] = array(
					'message' => 'Products Uploaded Successfully.'
					);

					print_r(json_encode($file_upload_data));
				}
				
					
				
				 
		};

			
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