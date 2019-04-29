<?php class Login extends CI_Controller {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Login_model');
	}
	
	function validate_login_credentials() {
		//$userName = "raghuram";
		$imei = 0;
		//$userPassword = base64_encode("raghuram");
		
		$userName = $this->input->post('userName');
		//$imei = $this->input->post('imei');
		$userPassword = base64_encode($this->input->post('userPassword'));
		
		$query = $this->Login_model->validate($userName,$userPassword,$imei);
		
		if ($query) {
			$todaysdate = date('Y-m-d');
			$exp = $this->Login_model->validate_expiry($imei,$todaysdate);
			
			if(!$exp){
				$login_failed_data[] = array(
				'message' => 'Your application service got expired'
				);
				
				print_r(json_encode($login_failed_data));
				
				return $login_failed_data;
			} else {
				$data['login'] = $this->Login_model->get_user_detail($userName,$userPassword);
				$mobilogin = 1;
				$userid = $data['login']['id'];
				$data = array(
					'user_login_status' => $mobilogin
				);
								
				$this->Login_model->update_logout($data,$userid);
				$data['login'] = $this->Login_model->get_user_detail($userName,$userPassword);
				$user_array[] = array(
					'userId' => $data['login']['id'],
					'entCode' => $data['login']['ent_code'],
					'name' => $data['login']['user_full_name'],
					'mobileNo' => $data['login']['user_phone_no'],
					'emailId' => $data['login']['user_email_id'],
					'imageName' => $data['login']['user_image'],
					'designation' => $data['login']['index_name'],
					'userAddress' => $data['login']['user_address'],		
				);
				if($data['login']['index_name'] == 'Admin'){
				$menu_array[] = array(
					'addEntity' => "Entity",
					'addOwner' => "Owners",
					'AddCategoryOrSubCategory' => "Add CategorySubCategory",
				);
				
				$main_menu_array[] = array(
					'stockDetails' => "Stock",
					'invoiceList' => "Bills",
					'getReport'=>"Expence Report",
					'getExpiredStockDetails'=>"Exp.Medicine",
					'mobiLogout' => "Logout"
				);	
				}else if($data['login']['index_name'] == 'Owner'){
					$menu_array[] = array(
					'purchaseProductDetails' => "Purchase",
					'stockDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceList' => "Bills",
				);
				
				$main_menu_array[] = array(
					'purchaseProductDetails' => "Purchase",
					'stockDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceList' => "Bills",
					'loadUploadProducts' => "Upload Products",
					'getReport' => "Expence Report",
					'mobiLogout' => "Logout"
				);	
				}else{
					$menu_array[] = array(
					'stockDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceList' => "Bills",
					);
					$main_menu_array[] = array(
					'stockDetails' => "Stock",
					'orderDetails' => "Orders",
					'invoiceList' => "Bills",
					'loadUploadProducts' => "Upload Products",
					'getReport' => "Expence Report",
					'mobiLogout' => "Logout"
				);	
				}
					
				$mobile_login_data[] = array(
					'userDetails' => $user_array,
					'menuDetails' => $menu_array,
					'availableVersion'=>'v1.0.0',
					'mainMenuDetails' => $main_menu_array
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
	
        public function mobiLogout()
	{
		$this->load->model('Login_model');	
		$Mobilogout = 0;
		$userid = $_SESSION['ID'];
		$data = array(
			'user_login_status' => $Mobilogout
		);
						
		$this->Login_model->update_logout($data,$userid);	
		session_destroy();
		redirect(base_url().'Login/index');
	}
}