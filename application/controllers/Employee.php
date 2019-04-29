<?php class Employee extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->model('Employee_model');
		$this->load->model('Entity_model');
		$this->load->model('Index_model');	
		$this->load->library('encryption');
	}
	
	public function employeeDetials()
	{
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$allEmpDetails = $this->Employee_model->get_all_employee_details($entCode);
		$EmployeeCount = $this->Employee_model->employee_count($entCode);
			
		if($EmployeeCount > 1){
		$emp_details[] = array(
					'allEmployeeDetails' =>$allEmpDetails,
					'addNewEmployee' => 'New Employee',
					'viewEmployee' =>'view Employee',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($emp_details));
		}else{
		$emp_details[] = array(
					'' =>'',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($emp_details));
		}
		
	}
	
	public function addNewEmployee()
	{
		$entCode = $this->input->post('entCode');
		$userDesignationIndex = $this->input->post('userDesignationIndex');
		//$entCode = 10001;
		//$userDesignationIndex = 10015;
		
		
		$userDesignation =  $this->Index_model->user_designation($userDesignationIndex);
		$userGender=  $this->Index_model->user_gender();
		
		if (count($userDesignation) >0) {
			foreach($userDesignation as $row)
				$user_designation[] = array(
					'index'=>$row['index'],
					'index_name' =>$row['index_name'],
				);
		}

		if (count($userGender) >0) {
			foreach($userGender as $row)
				$all_userGender[] = array(
					'index'=>$row['index'],
					'index_name' =>$row['index_name'],
				);
		}			
			
		$required_details[] = array(
					'allUserGender'=>$all_userGender,
					'UserDesignation' =>$user_designation,
					'addEmployee' =>'addEmployee'
				);
		
		
		//print_r($required_index);
		print_r(json_encode($required_details));
	}
	public function addEmployee()
	{
			
		$entCode = $this->input->post('entCode');
		//$entCode = 10002;
		$EmployeeCount = $this->Employee_model->employee_count($entCode);
		$Employeelimit = $this->Entity_model->employee_limit($entCode);
		
			
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
				
		
		if($EmployeeCount['EmployeeCount'] < $Employeelimit['EmployeeLimit'] ){
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
				'ent_code'=>$this->input->post('entCode'),
				'user_full_name'=>$this->input->post('userFullName'),
				'user_name'=>$this->input->post('userName'),
				'user_password'=>$userPassword,
				'user_gender_index'=>$this->input->post('userGenderIndex'),
				'user_age'=>$this->input->post('userAge'),
				'user_dob'=>$this->input->post('userDOB'),
				'user_phone_no'=>$this->input->post('userPhoneNo'),
				'user_email_id'=>$this->input->post('userEmailId'),
				'user_address'=>$this->input->post('userAddress'),	
				'user_address_prof'=>$this->input->post('userAddressProf'),	
				'user_imei'=>$this->input->post('userIMEI'),	
				'user_designation_index'=>$this->input->post('userDesignationIndex'),
				'user_status_index'=>'10013',
				'user_image'=>$userPictureName
				
			);				
			$this->Employee_model->add_record($data);
			
			$new_employee_added[] = array('message' => 'New Employee added successfully');

			print_r(json_encode($new_employee_added));
			}else{
				$new_employee_added[] = array('message' => 'Your Employee limit exceeded, Please Contact System Admin');

			print_r(json_encode($new_employee_added));
			} 
	}
	
	public function viewEmployee()
	{
		$entCode = $this->input->post('entCode');
		$userDesignationIndex = $this->input->post('userDesignationIndex');
		$empId = $this->input->post('empId');
		/*$entCode = 10001;
		$userDesignationIndex = 10015;
		$empId = 1;*/
		
		$userDesignation =  $this->Index_model->user_designation($userDesignationIndex);
		$userGender=  $this->Index_model->user_gender();
		
		$eachEmpDetails = $this->Employee_model->get_employee_details_by_id($empId);
		
		$each_EmpDetails[] = array(
				'entCode'=>$eachEmpDetails['ent_code'],
				'userFullName'=>$eachEmpDetails['user_full_name'],
				'userName'=>$eachEmpDetails['user_name'],
				'userGender'=>$eachEmpDetails['user_gender'],
				'userAge'=>$eachEmpDetails['user_age'],
				'userDOB'=>$eachEmpDetails['user_dob'],
				'userPhoneNo'=>$eachEmpDetails['user_phone_no'],
				'userEmailId'=>$eachEmpDetails['user_email_id'],
				'userAddress'=>$eachEmpDetails['user_address'],	
				'userIMEI'=>$eachEmpDetails['user_imei'],	
				'userDesignation'=>$eachEmpDetails['user_designation'],
				'userStatus'=>$eachEmpDetails['user_status'],
				'userImage'=>$eachEmpDetails['user_image']
				);
		
		if (count($userDesignation) >0) {
			foreach($userDesignation as $row)
				$user_designation[] = array(
					'index'=>$row['index'],
					'index_name' =>$row['index_name'],
				);
		}

		if (count($userGender) >0) {
			foreach($userGender as $row)
				$all_userGender[] = array(
					'index'=>$row['index'],
					'index_name' =>$row['index_name'],
				);
		}			
			
		$required_details[] = array(
					'eachEmpDetails'=>$each_EmpDetails,
					'allUserGender'=>$all_userGender,
					'UserDesignation' =>$user_designation,
					'UpdateEmployee' =>'Update Employee',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($required_details));
	}
	
	public function updateEmployee()
	{
		$entCode = $this->input->post('entCode');
		$empId = $this->input->post('empId');
		$userStatus=  $this->Index_model->user_status();
		/*$entCode = 10001;
		$userDesignationIndex = 10015;
		$empId = 1;*/
		
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
			$this->Employee_model->update_record($data,$empId);
			
			$new_employee_added[] = array('message' => 'Employee updated successfully');

			print_r(json_encode($new_employee_added));
	}
}
