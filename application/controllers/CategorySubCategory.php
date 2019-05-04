<?php class CategorySubCategory extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->model('CategorySubCategory_model');
		$this->load->model('Index_model');	
		$this->load->library('encryption');
	}
	
	public function mappingDetials()
	{
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		if($entCode = " "){
		$uomMappingDetails = $this->Index_model->get_uom_mapping_details_admin();	
		}else{
		$uomMappingDetails = $this->Index_model->get_uom_mapping_details($entCode);
		
		}
		$entDetails = $this->Index_model->get_ent_details();
		$allProductUom = $this->Index_model->all_product_uom();
		$categoryDetails = $this->Index_model->category_details();
		$maxCategoryId = $this->Index_model->max_category_id() + 1;
		$maxSubCategoryId = $this->Index_model->max_sub_category_id() + 1;
		if(count($uomMappingDetails) > 1){
		$mapping_details[] = array(
					'uomMappingDetails' =>$uomMappingDetails,
					'addCategory' => 'Add Category',
					'addSubCategory' => 'Add Sub Category',
					'$entDetails'=>$entDetails,
					'allProductUom'=>$allProductUom,
					'categoryDetails'=>$categoryDetails,
					'maxCategoryId'=>$maxCategoryId,
					'maxSubCategoryId'=>$maxSubCategoryId
					
				);
		
		print_r(json_encode($mapping_details));
		}else{
		$mapping_details[] = array(
					'' =>'',
					'addCategory' => 'Add Category',
					'addSubCategoryandMap' => 'Add Sub Category',
				);
		
		
		print_r(json_encode($mapping_details));
		}
		
	}
	
	public function addCategory()
	{
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		
		$categoryid = $this->input->post('categoryId');
		$categoryName = $this->input->post('categoryName');
		
		$data =array
			(
				'ent_code'=>$entCode, 
				'category_index'=>$categoryid,
				'category_name'=>$categoryName,
				'is_valid'=>1,
			);				
			$this->CategorySubCategory_model->add_category_record($data);
		
		$category_message[] = array('message' => 'Category added successfully');

		print_r(json_encode($category_message));
		
		
	}
	
	public function addSubCategoryandMap()
	{
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		
		$categoryid = $this->input->post('categoryId');
		$subCategoryid = $this->input->post('subCategoryId');
		$subCategoryName = $this->input->post('subCategoryName');
		$uom_arr = $this->input->post('uom_array');
		
		$uomcount = count($uom_arr) + 1;
		$data =array
			(
				'category_index_id'=>$categoryid ,
				'sub_category_index'=>$subCategoryid ,
				'sub_category_name'=>$this->input->post('subCategoryName'),
				'is_valid'=>1,
			$this->CategorySubCategory_model->add_category_record($data);
		
		for($i=0; $i < $uomcount; $i++)
			{
				$data =array(
				'category_id'=>$categoryid,
				'sub_category_id'=>$subCategoryid ,
				'index_id'=>$uom_arr[$i],
				'ent_code'=>$entCode);				
			$this->CategorySubCategory_model->add_uom_mapping_record($data);
			}
			
			
		
		$sub_category_message[] = array('message' => 'Sub Category added and mapped successfully');

		print_r(json_encode($sub_category_message));
		
		
	}
}
