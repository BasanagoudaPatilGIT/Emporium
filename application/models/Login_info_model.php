<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_info_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('encrypt');
	}
	
	public function validate($username,$password)
	{
		
		
		$this->db->where('username', $username );
		$this->db->where('password', $password );
		$query= $this->db->get('tab_registration');
		//print_r( $query->row_array() );
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function validate_expiry($username,$todaysdate)
	{
		$this->db->where('username',$username);
		$this->db->where('service_expiry_Date >=', $todaysdate);
		$query= $this->db->get('tab_registration');
		//print_r( $query->row_array() );
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function get_user_detail($username,$password)
	{
		$this->db->select('r.*,d.designation');
		$this->db->from('tab_registration as r');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->join('tab_designation as d', 'd.id = r.user_type','left');
		$query = $this->db->get();
		
		return $query->row_array();
	}
	
	public function send_mail($email_id)
	{
		$this->db->select('r.*,d.designation');
		$this->db->from('tab_registration as r');
		$this->db->where('email_id', $email_id);
		$this->db->join('tab_designation as d', 'd.id = r.user_type','left');
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	
	
	
	
		public function add_record($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_basic');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_basic', $data);
	}
	
	public function get_id($user_id)
	{
		$this->db->select_max('id');
		
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('tab_basic');
		
		return $query->row_array();
	}
	public function get_record($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('tab_basic');
		
		return $query->row_array();
	}
	
	public function delete_record($id,$user_id)
	{
		
		$this->db->where('id<', $id);
		$this->db->where('user_id', $user_id);
		return $this->db->delete('tab_basic');
	}
	
	public function get_record_by_email($email_id)
	{
		$this->db->where('email_id', $email_Id);
		$query = $this->db->get('tab_registration');
		
		return $query->row_array();
	}
	
	public function update_logout($data,$id)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_registration', $data);		
    }
	
 }