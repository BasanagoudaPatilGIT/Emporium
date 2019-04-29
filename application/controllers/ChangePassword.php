<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChangePassword extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		if (!isset( $_SESSION['IS_LOGGED_IN'] )) { 
			redirect(base_url()); 
		}
		$this->load->model('User_model');
		
	}
	
	function changepassword()
	{	
		
		$this->form_validation->set_rules('opassword','Old Password','required');
		$this->form_validation->set_rules('password','New Password','required|max_length[12]|min_length[8]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|max_length[12]|min_length[8]|matches[password]');
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "TMT - Change Password";
		
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('ChangePassword/changepassword');
		$this->load->view('Home/footer');
		}
		else
		{
		$mailid = $this->input->post('email_id');
		$opassword = base64_encode($this->input->post('opassword'));
		
		$query = $this->User_model->verify_password($mailid,$opassword);
		$data['details'] = $this->User_model->verify_password($mailid,$opassword);
			//print_r($details['id']);
			
		if($query){
			$data['id'] = $this->User_model->verify_password($mailid,$opassword);
			
			$id = $data['id']['id'];
			//print_r($id);
			$data =array
			(
				'password'=>base64_encode($this->input->post('password')),
				
			);		
			//print_r($data);		
			$this->User_model->update_password($id,$data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Updated Successfully.
                  </div>
				  ');
				  
			redirect(base_url().'User/userlist'); 
			
		}else{
			$this->session->set_flashdata('msg','Old Password Not Matching');
			redirect(base_url().'ChangePassword/changepassword');		
		}
		
		
		}	
		
	}
	
	
	

	
}