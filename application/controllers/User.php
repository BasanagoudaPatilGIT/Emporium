<?php class User extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->model('User_model');
		$this->load->model('Entity_model');
		$this->load->model('Index_model');	
		$this->load->library('encryption');
	}
	
	public function getUserDetails()
	{
		//$entCode = $this->input->post('entCode');
		$entCode = 10002;
		$allUserDetails = $this->User_model->get_all_user_details($entCode);
		$UserCount = $this->User_model->user_count($entCode);
			
		if($UserCount > 1){
		$user_details[] = array(
					'allUserDetails' =>$allUserDetails,
					'addNewUser' => 'New User',
					'viewUser' =>'view User',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($user_details));
		}else{
		$user_details[] = array(
					'' =>'',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($user_details));
		}
		
	}
	
	public function addNewUser()
	{
		//$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		//$userDesignationIndex = 10015
		$userGender=  $this->Index_model->user_gender();
		$apartmentDetails = $this->Index_model->all_apartment_details();
		$wingDetails = $this->Index_model->all_wing_details();
		$flatDetails = $this->Index_model->all_flat_details();
		$entDetails = $this->Index_model->get_ent_details();
		
		$user_details[] = array(
					'userGender'=>$userGender,
					'addUser' =>'addUser',
					'apartmentDetails' => $apartmentDetails,
					'wingDetails' => $wingDetails,
					'flatDetails' => $flatDetails,
					'entDetails' => $entDetails,
				);
		
		
		//print_r($required_index);
		print_r(json_encode($user_details));
	}
	public function addUser()
	{
		$entCode = $this->input->post('entCode');
		$entCode = 10002;
		$data['auto_code'] = $this->User_model->get_user_number($entCode);
		$userId = $data['auto_code']['series_id'].''.$data['auto_code']['ent_code'].''.$data['auto_code']['continues_count'];
		$userNum = $data['auto_code']['continues_count'];
		
		
		//$entCode = 10002;
		
		$userPassword = base64_encode($this->input->post('userPassword'));
		/* $userGenderIndex=10019;
		$userAge=28;
		$userDOB="1990-04-01";
		$userPhoneNo="9087654321";
		$userEmailId="vijay@gmail.com";
		$userAddress="Address";
		$userAddressProf="Address proof";
		$userIMEI="645678765677879";
		$userDesignationIndex="10017"; */
				
		
		$imageString ='';
		//$imageString =$this->input->post('imageString');
		
		//Conveting of string to image need to be implemented.
		
		if($imageString == ''){
		$userPictureName ='Capture.jpg';	
		}else{
		$userPictureName = $this->input->post('userPictureName');
		}
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
				'user_flat_id'=>$this->input->post('userFlatId'),		
				'user_imei'=>$this->input->post('userIMEI'),	
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
			
			$new_user_added[] = array('message' => 'New User added successfully');

			print_r(json_encode($new_user_added));
			 
	}
	
	public function viewUser()
	{
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		/*$entCode = 10001;
		$userDesignationIndex = 10015;
		$empId = 1;*/
		
		$userGender=  $this->Index_model->user_gender();
		
		$eachUserDetails = $this->User_model->get_user_details_by_id($userId);
		
		$each_UserDetails[] = array(
				'entCode'=>$eachUserDetails['ent_code'],
				'userName'=>$eachUserDetails['user_name'],
				'userGender'=>$eachUserDetails['user_gender'],
				'userAge'=>$eachUserDetails['user_age'],
				'userDOB'=>$eachUserDetails['user_dob'],
				'userEmailId'=>$eachUserDetails['user_email_id'],
				'userIMEI'=>$eachUserDetails['user_imei'],	
				'userDesignation'=>$eachUserDetails['user_designation'],
				'userStatus'=>$eachUserDetails['user_status'],
				'userImage'=>$eachUserDetails['user_image'],
				'userId'=>$eachUserDetails['user_emp_id'],
				'userFullName'=>$eachUserDetails['user_full_name'],
				'userAddress'=>$eachUserDetails['user_address'],
				'userPhoneNo'=>$eachUserDetails['user_phone_no'],
				'flatNo'=>$eachUserDetails['flat_no'],
				'wing'=>$eachUserDetails['wing'],
				'apartmentName'=>$eachUserDetails['apartment_name'],
				);
		
		
	$user_details[] = array(
					'eachUserDetails'=>$each_UserDetails,
					'UpdateUser' =>'Update User',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($user_details));
	}
	
	public function updateUser()
	{
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$userStatus=  $this->Index_model->user_status();
		/*$entCode = 10001;
		$userDesignationIndex = 10015;
		$empId = 1;*/
		$imageString ='';
		
		if($imageString == ''){
		$userPictureName ='Capture.jpg';	
		}else{
		$userPictureName = $this->input->post('userPictureName');
		}
		
		$data =array
			(
				'user_full_name'=>$this->input->post('userFullName'),
				'user_dob'=>$this->input->post('userDOB'),
				'user_phone_no'=>$this->input->post('userPhoneNo'),
				'user_email_id'=>$this->input->post('userEmailId'),
				'user_address'=>$this->input->post('userAddress'),	
				//'user_address_prof'=>$this->input->post('userAddressProf'),	
				'user_imei'=>$this->input->post('userIMEI'),	
				'user_status_index'=>$this->input->post('userStatusIndex'),
				'user_image'=>$userPictureName
				
			);				
			$this->User_model->update_record($data,$userId);
			
			$update_user[] = array('message' => 'User updated successfully');

			print_r(json_encode($update_user));
	}
}
