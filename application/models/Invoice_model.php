<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function add_bill_h_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_bill_h');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_bill_h', $data);
	}
	public function get_max_bill_h_id()
	{
		$this->db->select_max('id');
		$query = $this->db->get('tab_bill_h');
		$row = $query->row();
		return $row->id;
	}
	
	public function add_bill_d_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_bill_d');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_bill_d', $data);
	}
	
	public function update_bill_h_status($entCode,$billNumber,$data)
    {
    $this->db->where('ent_code', $entCode);
    $this->db->where('bill_number', $billNumber);
    $this->db->update('tab_bill_h', $data);		
    }
	
	public function bill_details($order_by = '',$entCode)
    {
    $this->db->select('b.*,u.user_full_name,u.user_address, u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_bill_h as b');
	$this->db->where('b.ent_code', $entCode);
	$this->db->join('tab_user as u', 'u.id = b.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = b.bill_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('b.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function bill_details_by_status($order_by = '',$entCode,$billStatus)
    {
    $this->db->select('b.*,u.user_full_name,u.user_address, u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_bill_h as b');
	$this->db->where('b.ent_code', $entCode);
	$this->db->where('i.index_id', $billStatus);
	$this->db->join('tab_user as u', 'u.id = b.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = b.bill_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('b.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	
	public function customer_bill_details_by_status($order_by = '',$entCode,$billStatus,$userId,$userTypeId)
    {
    $this->db->select('b.*,u.user_full_name,u.user_address, u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_bill_h as b');
	$this->db->where('b.ent_code', $entCode);
	$this->db->where('u.id', $userId);
	$this->db->where('u.user_designation_index', $userTypeId);
	$this->db->where('i.index_id', $billStatus);
	$this->db->join('tab_user as u', 'u.id = b.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = b.bill_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('b.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	
	public function customer_bill_details_by_all_status($order_by = '',$entCode,$userId,$userTypeId)
    {
    $this->db->select('b.*,u.user_full_name,u.user_address, u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_bill_h as b');
	$this->db->where('b.ent_code', $entCode);
	$this->db->where('u.id', $userId);
	$this->db->where('u.user_designation_index', $userTypeId);
	$this->db->join('tab_user as u', 'u.id = b.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = b.bill_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('b.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
	
    }
	public function get_bill_number($entCode)
    {
	$this->db->select('p.*');
	$this->db->from('tab_series as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('p.series_name', 'Invoice');
	$query = $this->db->get();
	
	return $query->row_array();
    }
		
	public function get_bill_status_details()
    {
	$where = "i.index_type= 'invoice_status_index' or i.index_type='select_index'";
    $this->db->select('i.index_id,i.index_name');
	$this->db->from('tab_index as i');
	$this->db->where($where);
	$this->db->order_by('i.index_id','DESC');
	$query = $this->db->get();		
    return $query->result_array();
    }	
	
	public function incriment_bill_no($data,$entCode)
    {
	$this->db->where('series_id', '#In');
	$this->db->where('ent_code', $entCode);
	$this->db->update('tab_series', $data);	
    }
	
	public function get_bill_h_details($billNumber,$entCode)
    {
	$this->db->select('h.*,u.user_full_name,u.user_address,u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
    $this->db->from('tab_bill_h as h');
    $this->db->where('h.bill_number', $billNumber);
    $this->db->where('h.ent_code', $entCode);
	$this->db->join('tab_user as u', 'u.id = h.user_id', 'left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_bill_d_details($billhid,$entCode)
    {
	$this->db->select('d.*,id.index_name as product_uom_index_name');
    $this->db->from('tab_bill_d as d');
    $this->db->where('d.bill_h_id', $billhid);
	$this->db->join('tab_index as id', 'id.index_id = d.product_uom_index','left');
    $query = $this->db->get();
    return $query->result_array();
    }
	
	
		
 }