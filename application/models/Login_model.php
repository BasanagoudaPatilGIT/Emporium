<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('encrypt');
	}
	
	public function validate($userName,$userpassword,$userIMEI)
	{
		$this->db->where('user_name', $userName );
		$this->db->where('user_password', $userpassword );
		$this->db->where('user_imei', $userIMEI );
		$query= $this->db->get('tab_user');
		//print_r( $query->row_array());
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function validate_expiry($userIMEI,$todaysdate)
	{
		$this->db->from('tab_user as u');
		$this->db->where('u.user_imei',$userIMEI);
		$this->db->where('e.service_expiry_date >=', $todaysdate);
		$this->db->join('tab_entity as e', 'e.ent_code = u.ent_code','left');
		$query= $this->db->get();
		//print_r( $query->row_array() );
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function get_user_detail($userName,$userpassword)
	{
		$this->db->select('u.*,i.index_name,e.ent_name,e.ent_code,fl.flat_no,w.wing,a.apartment_name');
		$this->db->from('tab_user as u');
		$this->db->where('user_name', $userName);
		$this->db->where('user_password', $userpassword);
		$this->db->join('tab_index as i', 'i.index_id = u.user_designation_index','left');
		$this->db->join('tab_entity as e', 'e.ent_code = u.ent_code','left');
		$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
		$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
		$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
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
	
	public function update_logout($data,$id)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_user', $data);		
    }
 }