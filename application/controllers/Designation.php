<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CI_Controller {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		if (!isset( $_SESSION['IS_LOGGED_IN'] )) { 
			redirect(base_url()); 
		}
		
		$this->load->model('Designation_model');
	}
	
	function index()
	{
		redirect(base_url().'Designation/designationlist'); 
	}
	
	
	function adddesignation()
	{
		$data['title'] = "HealthCare - Add Designation";
		$this->form_validation->set_rules('designation','Designation','required|is_unique[tab_designation.designation]', 
		array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
		if(($this->form_validation->run())==false)
		{
			$this->load->view('Home/header',$data);
			$this->load->view('Home/menu');
			$this->load->view('Designation/adddesignation');
			$this->load->view('Home/footer');
		}
		else
		{
		$data =array
			(
				'designation'=>$this->input->post('designation'),
			);				
			$this->Designation_model->add_record($data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Added Successfully.
                  </div>
				  ');
			
			redirect(base_url().'Designation/designationlist'); 

		}
		
	}
	
	function updatedesignation()
	{
		$data['title'] = "HealthCare - Update Designation";
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
		
		
		//GET DATA FROM TABLE
		$data['designation_row'] = $this->Designation_model->get_record_by_id($id);
		
		
		$this->form_validation->set_rules('designation','Designation','required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('Home/header',$data);
			$this->load->view('Home/menu');
			$this->load->view('Designation/updatedesignation',$data);
			$this->load->view('Home/footer');
		}
		else
		{			
			$data =array
			(
				'designation'=>$this->input->post('designation'),
			);
			$this->Designation_model->edit_record($id,$data);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Updated Successfully.
                  </div>
				  ');
				  
			redirect(base_url().'Designation/designationlist'); 			
		}		
	}
	
	function designationlist()
	{
		$data['title'] = "HealthCare - Designation List";
		//GET DATA FROM TABLE
		$order_by = 'DESC';	
		//$usertype = 'Admin';	
		$data['designation'] = $this->Designation_model->view_record('');
				
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Designation/designationlist',$data);
		$this->load->view('Home/footer');	
	}
	
	function delete_record($id=0)
	{
		$id = $this->uri->segment(3);
	
		if ($id==0)
		{
			$this->index();			
		}	
				
		$this->Designation_model->delete_record($id);
		
		//$this->edit_form();
		$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				
				<i class="icon fa fa-trash-o"></i> Record Deleted Successfully.
			  </div>
			  ');
		
		redirect(base_url().'Designation/designationlist'); 
	}
	
	
	
}
