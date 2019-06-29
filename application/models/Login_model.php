<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('encrypt');
	}
	
	public function validate($userName,$userPhoneno,$userpassword,$userIMEI)
	{
		
		$sql = "SELECT * FROM tab_user where (user_name= ? or user_phone_no=?) and user_password= ? and user_imei= ?";
    	$query = $this->db->query($sql,array($userName,$userPhoneno,$userpassword,$userIMEI));
    	 $query->row_array();
		//print_r( $query->row_array() );
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function validate_expiry($userIMEI,$todaysdate,$userPhoneno)
	{
		$this->db->from('tab_user as u');
		$this->db->where('u.user_imei',$userIMEI);
		$this->db->where('e.service_expiry_date >=', $todaysdate);
		$this->db->where('u.user_phone_no', $userPhoneno);
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
	
	public function get_user_detail($userName,$userPhoneno,$userpassword)
	{
		$sql= "select u.*,i.index_name,e.ent_name,e.ent_code,e.app_current_version,fl.flat_no,w.wing,a.apartment_name from tab_user as u 
		left join tab_index as i on (i.index_id = u.user_designation_index) left join tab_entity as e on (e.ent_code = u.ent_code)
		left join tab_flat_no as fl on (fl.id = u.user_flat_id) left join tab_wing as w on (w.id = fl.wing_id)	
		left join tab_apartment as a on (a.id = w.apartment_id) where (u.user_name= ? or u.user_phone_no = ?) and u.user_password = ?";
		$query = $this->db->query($sql,array($userName,$userPhoneno,$userpassword));
		
		return $query->row_array();
	}
	
	public function get_user_detail_by_userId($userId)
	{
		$sql= "select u.*,i.index_name,e.ent_name,e.ent_code,e.app_current_version,fl.flat_no,w.wing,a.apartment_name from tab_user as u 
		left join tab_index as i on (i.index_id = u.user_designation_index) left join tab_entity as e on (e.ent_code = u.ent_code)
		left join tab_flat_no as fl on (fl.id = u.user_flat_id) left join tab_wing as w on (w.id = fl.wing_id)	
		left join tab_apartment as a on (a.id = w.apartment_id) where u.id= ? ";
		$query = $this->db->query($sql,array($userId));
		
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
	
	public function get_new_app_version()
	{
		$sql= "SELECT * FROM tab_app_version ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($sql);
		
		return $query->row_array();
	}
	
 }