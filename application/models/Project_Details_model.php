<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Project_Details_model extends CI_Model
	{
	public function __construct()
	{
	$this->load->database();
	}
	
	public function add_record($data)
	{
	//SELECT MAX ID
	$max_id = 1;
	$this->db->select_max('id');
	$query = $this->db->get('tab_project');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	return $this->db->insert('tab_project', $data);
	}
	
	public function edit_record($id,$data)
	{
	$this->db->where('id', $id);
	$this->db->update('tab_project', $data);		
	}
	
	public function delete_record($id)
	{
	$this->db->where('id', $id);
	return $this->db->delete('tab_project');
	}
	
	public function view_record($order_by = '')
	{
	$this->db->select('p.*');
	$this->db->select('r.first_name as mfirst_name,r.last_name as mlast_name');
	$this->db->from('tab_project as p');
	$this->db->join('tab_registration as r','r.id = p.project_manager_id', 'left');
	if($order_by != ''){
	$this->db->order_by('p.id',$order_by);
	}
	$query = $this->db->get();		
	return $query->result_array();
	}
	
	public function user_view_record()
	{
	$this->db->select('r.*,se.gender_type,c.country_name,s.state_name,d.district_name,ci.city_name,a.area_name');
	$this->db->from('tab_registration as r');
	
	$this->db->join('tab_country as c','c.id = r.country_id', 'left');
	$this->db->join('tab_state as s','s.id = r.state_id', 'left');
	$this->db->join('tab_district as d','d.id = r.district_id', 'left');
	$this->db->join('tab_city as ci','ci.id = r.city_id', 'left');
	$this->db->join('tab_area as a','a.id = r.area_id', 'left');
	$this->db->join('tab_sex as se','se.id = r.gender_id', 'left');
	
	$query = $this->db->get();		
	return $query->result_array();
	}
	
	public function get_record_by_id($id)
	{
	$this->db->select('p.*');
	$this->db->select('CONCAT(r.first_name," ",r.last_name ) as manager_name');
	$this->db->from('tab_project as p');
	$this->db->join('tab_registration as r','r.id = p.project_manager_id', 'left');
	$this->db->where('p.id', $id);
	$query = $this->db->get();
	return $query->row_array();
	}
	
	public function get_current_version($id)
	{
	
	//$this->db->select_max('v.id');
	$this->db->select_max('v.version');
	$this->db->from('tab_version as v');
	$this->db->where('v.project_id', $id);
	$this->db->where('v.status', 'Active');
	$query = $this->db->get();
	
	return $query->row_array();
	}
	
	
	
	public function project_count()
	{
	return $this->db->count_all_results('tab_project');
	}
	
	
	}