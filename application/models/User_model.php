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
		$query = $this->db->get('tab_user');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_user', $data);
	}
	
	public function get_user_number($entCode)
    {
	$this->db->select('p.*');
	$this->db->from('tab_series as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('p.series_name', 'User Id');
	$query = $this->db->get();
	
	return $query->row_array();
    }
	
	
	
	public function edit_record($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_user', $data);		
    }
	
	public function update_password($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_user', $data);		
    }
	
	public function verify_password($email_id,$opassword)
	{
		$this->db->select('*');
		$this->db->from('tab_user as r');
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
	
	public function get_all_user_details($entCode)
    {
    $this->db->select('u.*,i.index_name');
	$this->db->from('tab_user as u');
	$this->db->join('tab_index as i', 'i.index_id = u.user_designation_index','left');
	if($entCode != '10001'){
	$this->db->where('u.ent_code', $entCode);
	$this->db->where('u.user_designation_index','10018');
	$this->db->where('i.index_type','user_designation_index');
	}else{
	$this->db->where('u.user_designation_index','10018');
	$this->db->where('i.index_type','user_designation_index');
	}
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    $this->db->order_by('u.id','DESC');
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function get_user_details_by_id($userId)
    {
	$this->db->select('u.*,des.index_name as user_designation,st.index_name as user_status,gen.index_name as user_gender');
	$this->db->from('tab_user as u');
	$this->db->join('tab_index as des', 'des.index = u.user_designation_index','left');
	$this->db->join('tab_index as st', 'st.index = u.user_status_index','left');
	$this->db->join('tab_index as gen', 'gen.index = u.user_gender_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
	$this->db->where('u.user_id', $userId);
	$query = $this->db->get();
	
	return $query->row_array();
    }
	
	public function delete_record($id)
	{
		
		$this->db->where('id', $id);
		return $this->db->delete('tab_user');
	}
	
	public function get_record_by_email($email_Id)
	{
		$this->db->where('email_Id', $email_Id);
		$query = $this->db->get('tab_user');
		
		return $query->row_array();
	}
	public function user_count($entCode)
    {
	$this->db->select('count(*) as EmployeeCount');
	$this->db->from('tab_user');
	$this->db->where('ent_code', $entCode);
	$this->db->where('user_designation_index','10017');
	$query = $this->db->get();
    return $query->row_array();
    }
	
	public function incriment_user_no($data,$entCode)
    {
	$this->db->where('series_id', '#U');
	$this->db->where('ent_code', $entCode);
	$this->db->update('tab_series', $data);	
    }
	
 }