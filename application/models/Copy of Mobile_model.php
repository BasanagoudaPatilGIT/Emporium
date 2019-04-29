<?php 

class Mobile_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('encrypt');
	}
	
	public function validate($mailid,$password,$imei)
	{
		$this->db->where('email_id', $mailid );
		$this->db->where('password', $password );
		$this->db->where('imei', $imei );
		$query= $this->db->get('tab_registration');
		//print_r( $query->row_array());
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function validate_expiry($imei,$todaysdate)
	{
		$this->db->where('imei',$imei);
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
	
	public function incriment_productcode_no($data,$userid)
    {
	$this->db->where('series_id', 'P');
	$this->db->where('user_id', $userid);
	$this->db->update('tab_series', $data);	
    }
	
	public function incriment_invoice_no($data,$userid)
    {
	$this->db->where('series_id', '#I');
	$this->db->where('user_id', $userid);
	$this->db->update('tab_series', $data);	
    }
	
	public function get_user_detail($email_id,$password)
	{
		$this->db->select('r.*,d.designation,s.speciality,s.abtspeciality');
		$this->db->from('tab_registration as r');
		$this->db->where('email_id', $email_id);
		$this->db->where('password', $password);
		$this->db->join('tab_designation as d', 'd.id = r.user_type','left');
		$this->db->join('tab_speciality as s', 's.id = r.speciality','left');
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
    $this->db->update('tab_registration', $data);		
    }
	
	public function low_stock_details($userid)
    {
    $sql = "select p.* from tab_product as p join tab_product as q on (p.id = q.id) where p.product_qty <= q.qtylimit and p.user_id = ? and p.status = ?";
    $query = $this->db->query($sql,array($userid,'Active'));
    return $query->result_array();
    }
	
	public function exp_stock_details($date, $userid)
    {
    $sql = "select p.* from tab_product as p where p.expirydate < ? and p.user_id = ? and p.status = ?";
    $query = $this->db->query($sql,array($date, $userid,'Active'));
    return $query->result_array();
    }
	
	public function update_product_status($prodid,$userId,$data)
    {
    $this->db->where('id', $prodid);
    $this->db->where('user_id', $userId);
    $this->db->update('tab_product', $data);		
    }
	
	public function stock_details($order_by = '',$userid)
    {
    $this->db->select('p.*');
	$this->db->from('tab_product as p');
	$this->db->where('p.user_id', $userid);
    if($order_by != ''){
    $this->db->order_by('p.product_qty',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function all_stock_count($id)
    {
    $this->db->where('user_id', $id);
    $this->db->where('product_qty !=', 0);
	return $this->db->count_all_results('tab_product');	
    }
	
	public function auto_featch_low_stock($prodname,$userid)
    {
	$this->db->select('*');
	$this->db->like('product_name',$prodname,'BOTH');
    $this->db->where('user_id', $userid);
    $this->db->where('product_qty >', 0);
	$this->db->order_by('product_qty','ASC');
    return $this->db->get('tab_product')->result();
	
	
    }
	
	public function get_invoicecode($userid)
    {
	$this->db->select('p.*');
	$this->db->from('tab_series as p');
	$this->db->join('tab_registration as r', 'r.ent_id = p.user_id','left');
	$this->db->where('r.id', $userid);
	$this->db->where('p.series_id', '#I');
	$query = $this->db->get();
	
	return $query->row_array();
    }
	
	public function view_invoice_details($order_by = '',$userId)
    {
    $this->db->select('h.*,p.*');
    $this->db->from('tab_invoice_h as h');
	$this->db->where('p.user_id', $userId);
	$this->db->join('tab_patients as p', 'p.id = h.patient_id', 'left');
    if($order_by != ''){
    $this->db->order_by('h.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function add_invoice_record($data)
    {
    //SELECT MAX ID
    $max_id = 1;
	$invoice_id = 1;
    $this->db->select_max('id');
    $query = $this->db->get('tab_invoice_d');
    $row = $query->row();
    if (isset($row))
    {
    $max_id = $row->id + 1;
    }
	$this->db->select_max('id');
	$query1 = $this->db->get('tab_invoice_h');
    $row1 = $query1->row();
    if (isset($row1))
    {
    $invoice_id = $row1->id;
    }
    
    $data['id'] = $max_id;
	$data['invoiceh_id']= $invoice_id;
    return $this->db->insert('tab_invoice_d', $data);
    }
	
	public function add_patient_record($data)
    {
    //SELECT MAX ID
    $max_id = 1;
    $this->db->select_max('id');
    $query = $this->db->get('tab_patients');
    $row = $query->row();
    if (isset($row))
    {
    $max_id = $row->id + 1;
    }
    
    $data['id'] = $max_id;
    return $this->db->insert('tab_patients', $data);
    }
	
	public function update_patient_status($patient_id,$userId,$data)
    {
    $this->db->where('id', $patient_id);
    $this->db->where('user_id', $userId);
    $this->db->update('tab_patients', $data);		
    }
	public function get_patient_max_id()
    {
    //SELECT MAX ID
    $max_id = 1;
    $this->db->select_max('id');
    $query = $this->db->get('tab_patients');
    $row = $query->row();
    return $row->id;
    }
	
	public function add_invoice_main_record($data)
    {
    //SELECT MAX ID
    $max_id = 1;
    $this->db->select_max('id');
    $query = $this->db->get('tab_invoice_h');
    $row = $query->row();
    if (isset($row))
    {
    $max_id = $row->id + 1;
    }
    
    $data['id'] = $max_id;
    return $this->db->insert('tab_invoice_h', $data);
    }
	
	public function get_prod_details_by_batch($prodBatchNo)
    {
	$this->db->select('p.*');
	$this->db->from('tab_product as p');
	$this->db->where('p.batchno', $prodBatchNo);
	$query = $this->db->get();
	
	return $query->row_array();
    }
	
	public function get_patient_details($userId)
    {
    $this->db->select('id,patient_name, patient_gender, patient_phoneno, patient_address, age');
    $this->db->from('tab_patients');
	$this->db->where('user_id', $userId);
	$this->db->group_by('patient_name', 'patient_gender', 'patient_phoneno', 'patient_address', 'age');
    $this->db->order_by('patient_name','asc');
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function get_selected_product_report($userid,$fromdate,$todate,$prodname)
    {
    $sql = "SELECT *  FROM tab_product where user_id = ?  and  createddatetime BETWEEN ? AND ? and product_name = ? and status = ?";
    $query = $this->db->query($sql,array($userid,$fromdate,$todate,$prodname,'Active'));
    return $query->result_array();
    }
	
	public function get_all_product_report($userid,$fromdate,$todate)
    {
    $sql = "SELECT *  FROM tab_product where user_id = ?  and  createddatetime BETWEEN ? AND ?  and status = ?";
    $query = $this->db->query($sql,array($userid,$fromdate,$todate,'Active'));
    return $query->result_array();
    }
	
	public function cbo_product($userid)
    {
    $sql = "SELECT product_name FROM tab_product where user_id = ?";
    $query = $this->db->query($sql,array($userid));
    return $query->result_array();
    }	
}