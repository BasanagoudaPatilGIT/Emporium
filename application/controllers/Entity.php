<?php class Entity extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->model('Entity_model');
		$this->load->model('Index_model');	
		$this->load->library('encryption');
	}
	
	public function entityDetials()
	{
		$allEntDetails = $this->Entity_model->get_all_entity_details();
			
		$ent_details[] = array(
					'allEntDetails' =>$allEntDetails,
					'addNewEntity' => 'New Entity',
					'UpdateEntity' =>'Update Entity',
				);
		
		
		//print_r($required_index);
		print_r(json_encode($ent_details));
		
	}
	
	public function addNewEntity()
	{
		$entVar = $this->Entity_model->get_entity_series_number();
		$entCode = $entVar['series_id'].'-'.$entVar['continues_count'];
					
			
		$required_details[] = array(
					'entCode'=>$entCode,
					'addEntity' =>'addEntity'
				);
		
		
		print_r(json_encode($required_details));
	}
	public function addEntity()
	{
		
		$data =array
			(
				'ent_code'=>$this->input->post('entCode'),
				'ent_name'=>$this->input->post('entName'),
				'enp_limit'=>$this->input->post('entLimit'),
				'service_expiry_date'=>$this->input->post('serviceExpiryDate')
				
				
			);				
			$this->Entity_model->add_record($data);
			
			$entVar = $this->Entity_model->get_entity_series_number();
			
			$data =array
			(
				'last_updated'=>mdate($datestring),
				'continues_count' => (int)$entVar['continues_count'] + 1
			);				
			$this->Entity_model->update_entity_series($data);
			
			$new_entity_added[] = array('message' => 'New Entity added successfully');

			print_r(json_encode($new_entity_added));
			
	}
	
	
}
