<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Version_model extends CI_Model
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
	$query = $this->db->get('tab_version');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	return $this->db->insert('tab_version', $data);
	}
	
	public function edit_record($id,$data)
	{
	$this->db->where('id', $id);
	$this->db->update('tab_version', $data);		
	}
	
	public function delete_record($id)
	{
	$this->db->where('id', $id);
	return $this->db->delete('tab_version');
	}
	
	public function view_record($order_by = '')
	{
	$this->db->select('v.*');
	$this->db->select('p.project_name,p.id as project_id');
	$this->db->from('tab_version as v');
	$this->db->join('tab_project as p','p.id = v.project_id', 'left');
	if($order_by != ''){
	$this->db->order_by('p.id',$order_by);
	}
	$query = $this->db->get();		
	return $query->result_array();
	}
	
	
	public function get_record_by_id($id)
	{
	$this->db->where('id', $id);
	$query = $this->db->get('tab_version');
	
	return $query->row_array();
	}
	
	public function version_count()
	{
	
	return $this->db->count_all_results('tab_version');
	}
	
	
	}