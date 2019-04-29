<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
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
		$query = $this->db->get('tab_registration');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$ent_id = 1001;
		$this->db->select_max('ent_id');
		$query = $this->db->get('tab_registration');
		$row1 = $query->row();
		if (isset($row1))
		{
			$ent_id = $row1->ent_id + 1;
		}
		
		$data['id'] = $max_id;
		$data['ent_id'] = $ent_id;
		return $this->db->insert('tab_registration', $data);
	}
	
	
	public function edit_record($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_registration', $data);		
    }
	
	public function update_password($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_registration', $data);		
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
	
	
	
	
	public function view_record($order_by = '')
    {
    $this->db->select('r.*,s.speciality,s.abtspeciality');
	$this->db->from('tab_registration as r');
	$this->db->join('tab_speciality as s', 's.id = r.speciality','left');
    if($order_by != ''){
    $this->db->order_by('r.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function get_record_by_id($id)
    {
	$this->db->select('r.*,d.designation,s.speciality,s.abtspeciality');
	$this->db->from('tab_registration as r');
	$this->db->where('r.id', $id);
	$this->db->join('tab_designation as d', 'd.id = r.user_type','left');
	$this->db->join('tab_speciality as s', 's.id = r.speciality','left');
	$query = $this->db->get();
	
	
	
    return $query->row_array();
    }
	
	public function delete_record($id)
	{
		
		$this->db->where('id', $id);
		return $this->db->delete('tab_registration');
	}
	
	public function get_record_by_email($email_Id)
	{
		$this->db->where('email_Id', $email_Id);
		$query = $this->db->get('tab_registration');
		
		return $query->row_array();
	}
	public function user_count()
    {
    return $this->db->count_all_results('tab_registration');
    }
	
 }