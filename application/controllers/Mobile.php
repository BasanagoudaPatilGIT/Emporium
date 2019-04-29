<?php class Mobile extends CI_Controller{

	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->library('../controllers/Login.php');
	}
	
	
	
	function login_verification_and_userdetails() {
			
		//$userName = $this->input->post('user_name');
		//$imei = $this->input->post('imei');
		//$password = base64_encode($this->input->post('password'));
		$userName = "raghuram";
		$imei = 0;
		$userPassword = base64_encode("raghuram");
		$rerult = $this->Login->validate_login_credentials($userName,$userPassword,$imei);
		print_r($rerult);
		
	}
	
}
