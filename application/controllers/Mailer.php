<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		require(APPPATH . 'PHPMailer\phpmailer\PHPMailerAutoload.php');
		
		
	}
	
	
	public function send_password()
	{
		$this->load->model('Login_info_model');	
	    // Field Validation
		$this->form_validation->set_rules('email_id','Email Id','required|valid_email');
		
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "TMT - send Password";
		
		$this->load->view('Login/forgot-password');
		}
		else
		{
		$mailid = $this->input->post('email_id');
		$url = 
		//print_r($mailid);
		$query = $this->Login_info_model->send_mail($mailid);
		if($query){
		$data['details'] = $this->Login_info_model->send_mail($mailid);
		print_r($mailid);
		print_r(base64_decode($data['details']['password']));
		$mail = new PHPMailer();                              
		$mail->SMTPDebug =4;                            
			$mail->isSMTP();                                    
			$mail->Host = 'smtp.gmail.com'; 
			$mail->SMTPAuth = true;                              
			$mail->Username = 'basupatil71@gmail.com';               
			$mail->Password = '7259999282';                          
			$mail->SMTPSecure = 'ssl';                          
			$mail->Port = 465;                                 
		
			$mail->setFrom('basupatil71@gmail.com', 'Admin');
			$mail->addAddress($mailid);   
			
			$mail->isHTML(true);                                  
			$mail->Subject = 'Login Credentials';
			$mail->Body    = 'UserName : '.$mailid.'<br/> 
							  Password : '.base64_decode($data['details']['password']);
		
			$mail->send();
			redirect(base_url().'Login/forget_password_success');
		
		}else{
			$this->session->set_flashdata('msg','You have entered an Invalid Mail id ...!');
			redirect(base_url().'Login/forgot_password');		
		}
		}	
		}	
	
}
