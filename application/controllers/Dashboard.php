<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		if (!isset( $_SESSION['IS_LOGGED_IN'] )) { 
			redirect(base_url()); 
		}
		$this->load->model('User_model');
		$this->load->model('Product_model');
		$this->load->model('Invoice_model');
		
		
		
	}
	
	public function index()
	{
		$data['title'] = "HealthCare - Dashboard";
		if($_SESSION['USER_TYPE'] == 'Admin'){ 
	 	$data['users'] = $this->User_model->user_count();
	 	$data['patient_count'] = $this->Invoice_model->patient_count($_SESSION['ID']);
		}else {
		$data['low_stock'] = count($this->Product_model->low_stock_details($_SESSION['ID']));
	 	$data['patient_count'] = $this->Invoice_model->patient_count($_SESSION['ID']);
	 	$data['all_stock'] = $this->Product_model->all_stock_count($_SESSION['ID']);
	 	$data['totalamount'] = ($this->Invoice_model->total_amount($_SESSION['ID']));
		$datestring = date('Y-m-d');
		$data['totdayamount'] = ($this->Invoice_model->todays_total_amount($_SESSION['ID'],$datestring));
		}
		
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Dashboard/dashboard',$data);
		$this->load->view('Home/footer');
	}
} 