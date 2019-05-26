<?php class Entity  extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->model('Entity_model');
		$this->load->model('Index_model');	
		$this->load->model('User_model');	
		$this->load->library('encryption');
	}
	
	public function entityDetails()
	{
		$allEntDetails = $this->Entity_model->get_all_entity_details();
			
		$ent_details[] = array(
					'allEntDetails' =>$allEntDetails,
					'getEntityCode' => 'New Entity',
					'UpdateEntity' =>'Update Entity',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($ent_details));
		
	}
	
	public function getEntityCode()
	{
		$entVar = $this->Entity_model->get_entity_series_number();
		$entCode = $entVar['continues_count'];
		$userGender=  $this->Index_model->user_gender();			
			
		$required_details[] = array(
					'entCode'=>$entCode,
					'addNewEntity' =>'addEntity',
					'userGender'=>$userGender
				);
		
		
		print_r(json_encode($required_details));
	}
	
	public function addNewEntity()
	{
		$entCode = $this->input->post('entCode');
		$data =array
			(
				'ent_code'=>$entCode,
				'ent_name'=>$this->input->post('entName'),
				'emp_limit'=>$this->input->post('empLimit'),
				'service_expiry_date'=>$this->input->post('serviceExpiryDate')
				
				
			);				
			$this->Entity_model->add_record($data);
			
			
		$data =array
			(
				'last_updated'=>mdate($datestring),
				'continues_count' => (int)$entVar['continues_count'] + 1
			);				
			$this->Entity_model->update_entity_series($data);

			
		$imageString ='';
		//$imageString =$this->input->post('imageString');
		
		//Conveting of string to image need to be implemented.
		
		if($imageString == ''){
		$userPictureName ='Capture.jpg';	
		}else{
		$userPictureName = $this->input->post('userPictureName');
		}
		$userPassword = base64_encode($this->input->post('userPassword'));
		$data =array
			(
				'ent_code'=>$entCode,
				'user_full_name'=>$this->input->post('userFullName'),
				'user_name'=>$this->input->post('userName'),
				'user_password'=>$userPassword,
				'user_gender_index'=>$this->input->post('userGenderIndex'),
				'user_dob'=>$this->input->post('userDOB'),
				'user_phone_no'=>$this->input->post('userPhoneNo'),
				'user_email_id'=>$this->input->post('userEmailId'),
				'user_flat_id'=>1,		
				'user_imei'=>$this->input->post('userIMEI'),
				'user_address'=>$this->input->post('userAddress'),				
				'user_designation_index'=>10016,
				'user_status_index'=>'10013',
				'user_image'=>$userPictureName,	
				
			);				
			$this->User_model->add_record($data);
			
			$new_entity_added[] = array('message' => 'New Entity added successfully');

			print_r(json_encode($new_entity_added));
			
	}
	
	
}
