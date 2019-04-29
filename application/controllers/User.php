<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		if (!isset( $_SESSION['IS_LOGGED_IN'] )) { 
			redirect(base_url()); 
		}
		
		$this->load->model('User_model');
		$this->load->model('Combo_model');	
		$this->load->library('encryption');
	}
	
	public function index()
	{
		redirect(base_url().'Users/userlist'); 
	}
	
	
	public function adduser()
	{
		$data['cbo_user_type'] = $this->Combo_model->cbo_designation();
		$data['cbo_speciality'] = $this->Combo_model->cbo_speciality();
	    // Field Validation
		$this->form_validation->set_rules('firstname','First Name','required');
		$this->form_validation->set_rules('lastname','Last Name','required');
		$this->form_validation->set_rules('email_id','Email Id','required|valid_email|is_unique[tab_registration.email_id]');
		$this->form_validation->set_rules('password','Passowrd','required|max_length[12]|min_length[8]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|max_length[12]|min_length[8]|matches[password]');
		$this->form_validation->set_rules('mobileno','Phone Number','required');
		$this->form_validation->set_rules('cbo_user_type','User Type','required');
		$this->form_validation->set_rules('cbo_speciality','Speciality','required');
		$this->form_validation->set_rules('cbo_gender','Gender','required');
		$this->form_validation->set_rules('address','Address','required');
		
		
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "HealthCare - Add Users";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Users/adduser',$data);
		$this->load->view('Home/footer');
		//print_r("hi");
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
			}
			$password = base64_encode($this->input->post('password'));
		$data =array
			(
				'status'=>'Active',
				'user_type'=>$this->input->post('cbo_user_type'),
				'speciality'=>$this->input->post('cbo_speciality'),
				'gender'=>$this->input->post('cbo_gender'),
				'first_name'=>$this->input->post('firstname'),
				'middle_name'=>$this->input->post('middlename'),
				'last_name'=>$this->input->post('lastname'),
				'email_id'=>$this->input->post('email_id'),
				'mobile_no'=>$this->input->post('mobileno'),
				'password'=>$password,
				'address'=>$this->input->post('address'),
				'img_name'=>$displaypicture
				
			);				
			$this->User_model->add_record($data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Added Successfully.
                  </div>
				  ');
			
			redirect(base_url().'User/userlist'); 

		}
	}
	
	
	
	public function updateuser()
	{
	
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
		
		$data['cbo_user_type'] = $this->Combo_model->cbo_designation();
		$data['cbo_speciality'] = $this->Combo_model->cbo_speciality();
		//GET DATA FROM TABLE
		$data['user_row'] = $this->User_model->get_record_by_id($id);
		
	    // Field Validation
		$this->form_validation->set_rules('firstname','First Name','required');
		$this->form_validation->set_rules('lastname','Last Name','required');
		$this->form_validation->set_rules('emailid','Email Id','required|valid_email');
		$this->form_validation->set_rules('mobileno','Phone Number','required');
		$this->form_validation->set_rules('cbo_user_type','User Type','required');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('cbo_user_type','User Type','required');
		$this->form_validation->set_rules('cbo_speciality','Speciality','required');
		$this->form_validation->set_rules('cbo_gender','Gender','required');
		
		
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "HealthCare - Update Users";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Users/updateuser',$data);
		$this->load->view('Home/footer');
		}
		else
		{
		
		//UPLOAD STARTS
			$config['upload_path'] = './upload/Profile/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			//$config['max_size'] = '';
			
			$this->load->library('upload', $config);
			
			//IMAGE UPLOAD
			$displaypicture =$this->input->post('displaypicture_hidden');
			if( !$this->upload->do_upload('displaypicture') ){
				//echo "n";
				print_r($this->upload->display_errors());
			}else{
				//echo "y";
				$displaypicture = $_FILES['displaypicture']['name'];
			}
		
			
		$data =array
			(
				'status'=>$this->input->post('cbo_status'),
				'speciality'=>$this->input->post('cbo_speciality'),
				'gender'=>$this->input->post('cbo_gender'),
				'user_type'=>$this->input->post('cbo_user_type'),
				'first_name'=>$this->input->post('firstname'),
				'middle_name'=>$this->input->post('middlename'),
				'last_name'=>$this->input->post('lastname'),
				'email_id'=>$this->input->post('emailid'),
				'mobile_no'=>$this->input->post('mobileno'),
				'ent_id'=>$this->input->post('entid'),
				'address'=>$this->input->post('address'),
				'img_name'=>$displaypicture,
				
			);		
			//print_r($data);		
			$this->User_model->edit_record($id,$data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Updated Successfully.
                  </div>
				  ');
			
			redirect(base_url().'User/userlist'); 

		}
	}
	
	public function userlist()
	{
		//GET DATA FROM TABLE
		$order_by = 'DESC';	
		//$usertype = 'Admin';	
		$data['user'] = $this->User_model->view_record('');
		
		$data['title'] = "HealthCare - Users List";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Users/userlist',$data);
		$this->load->view('Home/footer');	
	}
	
	public function delete_record($id=0)
	{
		$id = $this->uri->segment(3);
	
		if ($id==0)
		{
			$this->index();			
		}	
				
		$this->User_model->delete_record($id);
		
		
		$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-trash-o"></i> Record Deleted Successfully.
                  </div>
				  ');
		
		redirect(base_url().'User/userlist'); 
	}
	
	public function user_view()
	{
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
		
		//GET DATA FROM TABLE
		$data['user_row'] = $this->User_model->get_record_by_id($id);
		
		$data['title'] = "HealthCare - view Users";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Users/userview',$data);
		$this->load->view('Home/footer');	
	}
	
	
	
}
