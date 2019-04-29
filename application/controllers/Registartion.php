<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registartion extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Combo_model');
		$this->load->model('Login_info_model');	
		$this->load->library('encrypt');	
		
	}
	
	public function index()
	{
		redirect(base_url().'Registartion/userregistration'); 
	}
	
	public function userregistration()
	{
		$data['cbo_user_type'] = $this->Combo_model->cbo_designation();
	    // Field Validation
		$this->form_validation->set_rules('firstname','First Name','required');
		$this->form_validation->set_rules('lastname','Last Name','required');
		$this->form_validation->set_rules('email_id','Email Id','required|valid_email|is_unique[tab_registration.email_id]');
		$this->form_validation->set_rules('password','Passowrd','required|max_length[12]|min_length[8]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|max_length[12]|min_length[8]|matches[password]');
		$this->form_validation->set_rules('mobileno','Phone Number','required');
		$this->form_validation->set_rules('empid','Employee ID','required|is_unique[tab_registration.emp_id]');
		$this->form_validation->set_rules('cbo_user_type','User Type','required');
		$this->form_validation->set_rules('address','Address','required');
		
		
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "TMT - Registration";
		$this->load->view('Login/register',$data);
		}
		else
		{
		
		//UPLOAD STARTS
			$config['upload_path'] = './upload/Profile/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			//$config['max_size'] = '';
			
			$this->load->library('upload', $config);
			
			$displaypicture ='Capture.jpg';
			//echo($displaypicture);
			if( !$this->upload->do_upload('displaypicture') ){
				print_r($this->upload->display_errors());
			}else{
				$displaypicture = $_FILES['displaypicture']['name'];
			};
			$password = base64_encode($this->input->post('password'));
		$data =array
			(
				'status'=>'Active',
				'user_type'=>$this->input->post('cbo_user_type'),
				'first_name'=>$this->input->post('firstname'),
				'middle_name'=>$this->input->post('middlename'),
				'last_name'=>$this->input->post('lastname'),
				'email_id'=>$this->input->post('email_id'),
				'mobile_no'=>$this->input->post('mobileno'),
				'password'=>$password,
				'emp_id'=>$this->input->post('empid'),
				'address'=>$this->input->post('address'),
				'img_name'=>$displaypicture
				
			);				
			$this->User_model->add_record($data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Added Successfully.
                  </div>
				  ');
			
			redirect(base_url().'Registartion/success'); 

		}
	}
	
	public function success()
	{
		$this->load->view('Login/registrationSuccess');
	}
	
	
	
	
	
	
}
