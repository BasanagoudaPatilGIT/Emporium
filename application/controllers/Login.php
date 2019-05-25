<?php class Login extends CI_Controller {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Login_model');
	}
	
	function validate_login_credentials() {
		$userName = $this->input->post('userName');
		$userPhoneno = $this->input->post('userName');
		$userPassword = base64_encode($this->input->post('userPassword'));

		$data['login'] = $this->Login_model->get_user_detail($userName,$userPhoneno,$userPassword);
		if($data['login']['user_designation_index'] == 10018 || $data['login']['user_designation_index'] == 10015){
			$imei = 0;
		}else{
			$imei = $this->input->post('userIMEI');
		}
		
		$query = $this->Login_model->validate($userName,$userPhoneno,$userPassword,$imei);
		
		if ($query) {
			$todaysdate = date('Y-m-d');
			$exp = $this->Login_model->validate_expiry($imei,$todaysdate,$data['login']['user_phone_no']);
			
			if(!$exp){
				$login_failed_data[] = array(
				'message' => 'Your application service got expired'
				);
				
				print_r(json_encode($login_failed_data));
				
				return $login_failed_data;
			} else {
				$data['login'] = $this->Login_model->get_user_detail($userName,$userPhoneno,$userPassword);
				$mobilogin = 1;
				$userid = $data['login']['id'];
				$data = array(
					'user_login_status' => $mobilogin
				);
								
				$this->Login_model->update_logout($data,$userid);
				$data['login'] = $this->Login_model->get_user_detail($userName,$userPhoneno,$userPassword);
				$user_array[] = array(
					'userId' => $data['login']['id'],
					'entCode' => $data['login']['ent_code'],
					'name' => $data['login']['user_full_name'],
					'mobileNo' => $data['login']['user_phone_no'],
					'emailId' => $data['login']['user_email_id'],
					'imageName' => $data['login']['user_image'],
					'designationIndex' => $data['login']['user_designation_index'],
					'designation' => $data['login']['index_name'],
					'userAddress' => $data['login']['user_address'],
					'userFullName'=>$data['login']['user_full_name'],
					'userAddress'=>$data['login']['user_address'],
					'userPhoneNo'=>$data['login']['user_phone_no'],
					'flatNo'=>$data['login']['flat_no'],
					'wing'=>$data['login']['wing'],
					'apartmentName'=>$data['login']['apartment_name'],		
				);
				if($data['login']['index_name'] == 'Admin'){
				$menu_array[] = array(
					'entityDetails' => "Entity",
					'AddCategoryOrSubCategory' => "Add CategorySubCategory",
				);
				
				$main_menu_array[] = array(
					'getProductDetails' => "Stock",
					'invoiceDetails' => "Invoice",
					'getReport'=>"Expense Report",
					'mobiLogout' => "Logout"
				);	
				$dashboard_array[] = array(
					'availableVersion'=>'v1.0.0',
					'lowStockCount'=>2,
					'inStockCount'=>5,
				);
				
				
				}else if($data['login']['index_name'] == 'Owner'){
					$menu_array[] = array(
					'purchaseProductDetails' => "Purchase",
					'getProductDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceDetails' => "Invoice",
				);
				
				$main_menu_array[] = array(
					'purchaseProductDetails' => "Purchase",
					'getProductDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceDetails' => "Invoice",
					'loadUploadProducts' => "Upload Products",
					'employeeDetails' => "Employee",
					'getReport' => "Expense Report",
					'mobiLogout' => "Logout"
				);	
				$dashboard_array[] = array(
					'availableVersion'=>'v1.0.0',
					'lowStockCount'=>2,
					'inStockCount'=>5,
				);
				}else if($data['login']['index_name'] == 'Customer') {
					$menu_array[] = array(
					'getProductDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceDetails' => "Invoice",
					'getReport' => "Expence Report",
					);
					$main_menu_array[] = array(
					'getProductDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceDetails' => "Invoice",
					'getReport' => "Expense Report",
					'mobiLogout' => "Logout"
				);	
					$dashboard_array[] = array(
						'availableVersion'=>'v1.0.0',
						'lowStockCount'=>2,
						'inStockCount'=>5,
					);
				}
					
				$mobile_login_data[] = array(
					'userDetails' => $user_array,
					'menuDetails' => $menu_array,
					'mainMenuDetails' => $main_menu_array,
					'dashboardDetails' => $dashboard_array,
				);
				
				print_r(json_encode($mobile_login_data));
				//return $mobile_login_data;
			}
		} else {
			$login_failed_data[] = array(
				'message' => 'Invalid Credentials'
			);
			
			print_r(json_encode($login_failed_data));	
			//return $login_failed_data;
		}
	}
	
	function reloadHome() {
		$userId = $this->input->post('userId');
		//$userId =1;
		$data['login'] = $this->Login_model->get_user_detail_by_userId($userId);
		$user_array[] = array(
			'userId' => $data['login']['id'],
			'entCode' => $data['login']['ent_code'],
			'name' => $data['login']['user_full_name'],
			'mobileNo' => $data['login']['user_phone_no'],
			'emailId' => $data['login']['user_email_id'],
			'imageName' => $data['login']['user_image'],
			'designationIndex' => $data['login']['user_designation_index'],
			'designation' => $data['login']['index_name'],
			'userAddress' => $data['login']['user_address'],
			'userFullName'=>$data['login']['user_full_name'],
			'userAddress'=>$data['login']['user_address'],
			'userPhoneNo'=>$data['login']['user_phone_no'],
			'flatNo'=>$data['login']['flat_no'],
			'wing'=>$data['login']['wing'],
			'apartmentName'=>$data['login']['apartment_name'],		
		);
		if($data['login']['index_name'] == 'Admin'){
		$menu_array[] = array(
			'entityDetails' => "Entity",
			'AddCategoryOrSubCategory' => "Add CategorySubCategory",
		);
		
		$main_menu_array[] = array(
			'getProductDetails' => "Stock",
			'invoiceDetails' => "Invoice",
			'getReport'=>"Expense Report",
			'mobiLogout' => "Logout"
		);	
		$dashboard_array[] = array(
			'availableVersion'=>'v1.0.0',
			'lowStockCount'=>2,
			'inStockCount'=>5,
		);
		
		
		}else if($data['login']['index_name'] == 'Owner'){
			$menu_array[] = array(
			'purchaseProductDetails' => "Purchase",
			'getProductDetails' => "Stock",
			'orderDetails' => "Orders",
			'invoiceDetails' => "Invoice",
		);
		
		$main_menu_array[] = array(
			'purchaseProductDetails' => "Purchase",
			'getProductDetails' => "Stock",
			'orderDetails' => "Orders",
			'invoiceDetails' => "Invoice",
			'loadUploadProducts' => "Upload Products",
			'employeeDetails' => "Employee",
			'getReport' => "Expense Report",
			'mobiLogout' => "Logout"
		);	
		$dashboard_array[] = array(
			'availableVersion'=>'v1.0.0',
			'lowStockCount'=>2,
			'inStockCount'=>5,
		);
		}else if($data['login']['index_name'] == 'Customer') {
			$menu_array[] = array(
			'getProductDetails' => "Stock",
			'orderDetails' => "Orders",
			'invoiceDetails' => "Invoice",
			'getReport' => "Expence Report",
			);
			$main_menu_array[] = array(
			'getProductDetails' => "Stock",
			'orderDetails' => "Orders",
			'invoiceDetails' => "Invoice",
			'getReport' => "Expense Report",
			'mobiLogout' => "Logout"
		);	
			$dashboard_array[] = array(
				'availableVersion'=>'v1.0.0',
				'lowStockCount'=>2,
				'inStockCount'=>5,
			);
		}
			
		$mobile_login_data[] = array(
			'userDetails' => $user_array,
			'menuDetails' => $menu_array,
			'dashboardDetails' => $dashboard_array,
			'mainMenuDetails' => $main_menu_array
		);
		
		print_r(json_encode($mobile_login_data));

		
	}
	
        public function mobiLogout()
	{	
		$Mobilogout = 0;
		$userid = $this->input->post('userId');
		$data = array(
			'user_login_status' => $Mobilogout
		);
						
		$this->Login_model->update_logout($data,$userid);	
		session_destroy();
		redirect(base_url().'Login/index');
	}
}