<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entity_model extends CI_Model
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
		$query = $this->db->get('tab_entity');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_entity', $data);
	}
	
	
	public function edit_record($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_entity', $data);		
    }
	
	public function update_password($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_entity', $data);		
    }
	
	public function verify_password($email_id,$opassword)
	{
		$this->db->select('*');
		$this->db->from('tab_registration as r');
		$this->db->where('email_id', $email_id);
		$this->db->where('password', $opassword);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function get_all_entity_details()
    {
    $this->db->select('*');
	$this->db->from('tab_entity as e');
	$this->db->join('tab_user as u','u.ent_code = e.ent_code');
	$this->db->where('u.user_designation_index', 10016);
	$this->db->order_by('e.id','DESC');
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function get_entity_details_by_id($id)
    {
	$this->db->select('e.*');
	$this->db->from('tab_entity as e');
	$this->db->where('e.id', $id);
	$query = $this->db->get();
	
	return $query->row_array();
    }
	
	public function delete_record($id)
	{
		
		$this->db->where('id', $id);
		return $this->db->delete('tab_entity');
	}
	
	public function employee_limit($entCode)
    {
	$this->db->select('emp_limit as EmployeeLimit');
	$this->db->from('tab_entity');
	$this->db->where('ent_code', $entCode);
	$query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_entity_series_number()
    {
	$this->db->select('*');
	$this->db->from('tab_series');
	$this->db->where('series_name', 'Entity');
	$this->db->where('ent_code', 0);
	$query = $this->db->get();
    return $query->row_array();
    }
	public function update_entity_series($data)
    {
    $this->db->where('series_name', 'Entity');
    $this->db->update('tab_series', $data);		
    }
	
	
	
 }