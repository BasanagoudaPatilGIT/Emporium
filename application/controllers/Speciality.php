<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Speciality extends CI_Controller {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		if (!isset( $_SESSION['IS_LOGGED_IN'] )) { 
			redirect(base_url()); 
		}
		
		$this->load->model('Speciality_model');
	}
	
	function index()
	{
		redirect(base_url().'Speciality/specialitylist'); 
	}
	
	
	function addspeciality()
	{
		$data['title'] = "HealthCare - Add Speciality";
		$this->form_validation->set_rules('speciality','Speciality','required|is_unique[tab_speciality.speciality]', 
		array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
		$this->form_validation->set_rules('abtspeciality','About Speciality','required');
		if(($this->form_validation->run())==false)
		{
			$this->load->view('Home/header',$data);
			$this->load->view('Home/menu');
			$this->load->view('Speciality/addspeciality');
			$this->load->view('Home/footer');
		}
		else
		{
		$data =array
			(
				'speciality'=>$this->input->post('speciality'),
				'abtspeciality'=>$this->input->post('abtspeciality')
			);				
			$this->Speciality_model->add_record($data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Added Successfully.
                  </div>
				  ');
			
			redirect(base_url().'Speciality/specialitylist'); 

		}
		
	}
	
	function updatespeciality()
	{
		$data['title'] = "HealthCare - Update Speciality";
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
		
		
		//GET DATA FROM TABLE
		$data['speciality_row'] = $this->Speciality_model->get_record_by_id($id);
		
		
		$this->form_validation->set_rules('speciality','Speciality','required');
		$this->form_validation->set_rules('abtspeciality','About Speciality','required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('Home/header',$data);
			$this->load->view('Home/menu');
			$this->load->view('Speciality/updatespeciality',$data);
			$this->load->view('Home/footer');
		}
		else
		{			
			$data =array
			(
				'speciality'=>$this->input->post('speciality'),
				'abtspeciality'=>$this->input->post('abtspeciality')
			);
			$this->Speciality_model->edit_record($id,$data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Updated Successfully.
                  </div>
				  ');
				  
			redirect(base_url().'Speciality/specialitylist'); 			
		}		
	}
	
	function specialitylist()
	{
		$data['title'] = "HealthCare - Speciality List";
		//GET DATA FROM TABLE
		$order_by = 'DESC';	
		//$usertype = 'Admin';	
		$data['speciality'] = $this->Speciality_model->view_record($order_by);
				
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Speciality/specialitylist',$data);
		$this->load->view('Home/footer');	
	}
	
	function delete_record($id=0)
	{
		$id = $this->uri->segment(3);
	
		if ($id==0)
		{
			$this->index();			
		}	
				
		$this->Speciality_model->delete_record($id);
		
		//$this->edit_form();
		$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				
				<i class="icon fa fa-trash-o"></i> Record Deleted Successfully.
			  </div>
			  ');
		
		redirect(base_url().'Speciality/specialitylist'); 
	}
	
	
	
}
