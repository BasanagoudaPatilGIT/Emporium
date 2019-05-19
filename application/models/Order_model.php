<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function add_order_h_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_order_h');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_order_h', $data);
	}
	public function get_max_order_h_id()
	{
		$this->db->select_max('id');
		$query = $this->db->get('tab_order_h');
		$row = $query->row();
		return $row->id;
	}
	
	public function update_order_h_status($entCode,$orderNumber,$data)
    {
    $this->db->where('ent_code', $entCode);
    $this->db->where('order_number', $orderNumber);
    $this->db->update('tab_order_h', $data);		
    }
	
	public function order_details($order_by = '',$entCode)
    {
    $this->db->select('o.*,i.index_name as orderStatus,u.user_full_name,u.user_address,u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_order_h as o');
	$this->db->where('o.ent_code', $entCode);
	$this->db->join('tab_user as u', 'u.id = o.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = o.order_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('o.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	
	public function order_details_by_status($order_by = '',$entCode,$orderStatus)
    {
    $this->db->select('o.*,i.index_name as orderStatus,u.user_full_name,u.user_address,u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_order_h as o');
	$this->db->where('o.ent_code', $entCode);
	$this->db->where('i.index_id', $orderStatus);
	$this->db->join('tab_user as u', 'u.id = o.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = o.order_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('o.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function customer_order_details_by_status($order_by = '',$entCode,$orderStatus,$userId,$userTypeId)
    {
    $this->db->select('o.*,i.index_name as orderStatus,u.user_full_name,u.user_address,u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_order_h as o');
	$this->db->where('o.ent_code', $entCode);
	$this->db->where('i.index_id', $orderStatus);
	$this->db->where('u.id', $userId);
	$this->db->where('u.user_designation_index', $userTypeId);
	$this->db->join('tab_user as u', 'u.id = o.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = o.order_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('o.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function customer_order_details_by_all_status($order_by = '',$entCode,$userId,$userTypeId)
    {
    $this->db->select('o.*,i.index_name as orderStatus,u.user_full_name,u.user_address,u.user_phone_no,fl.flat_no,w.wing,a.apartment_name');
	$this->db->from('tab_order_h as o');
	$this->db->where('o.ent_code', $entCode);
	$this->db->where('u.id', $userId);
	$this->db->where('u.user_designation_index', $userTypeId);
	$this->db->join('tab_user as u', 'u.id = o.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = o.order_status_index','left');
	$this->db->join('tab_flat_no as fl', 'fl.id = u.user_flat_id','left');
	$this->db->join('tab_wing as w', 'w.id = fl.wing_id','left');
	$this->db->join('tab_apartment as a', 'a.id = w.apartment_id','left');
    if($order_by != ''){
    $this->db->order_by('o.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function get_order_number($entCode)
    {
	$this->db->select('p.*');
	$this->db->from('tab_series as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('p.series_name', 'Orders');
	$query = $this->db->get();
	
	return $query->row_array();
    }
		
	public function get_order_status_details()
    {
	$where = "(i.index_type= 'order_status_index' or i.index_type='select_index') and i.is_valid = 1";
    $this->db->select('i.index_id as _id,i.index_name');
	$this->db->from('tab_index as i');
	$this->db->where($where);
	$this->db->order_by('i.index_id','DESC');
	$query = $this->db->get();		
    return $query->result_array();
    }	
	
	public function incriment_order_no($data,$entCode)
    {
	$this->db->where('series_id', '#O');
	$this->db->where('ent_code', $entCode);
	$this->db->update('tab_series', $data);	
    }
	
	public function get_order_h_details($orderId,$entCode)
    {
	$this->db->select('h.*,u.user_full_name,u.user_address,u.user_phone_no');
    $this->db->from('tab_order_h as h');
    $this->db->where('h.id', $orderId);
    $this->db->where('h.ent_code', $entCode);
	$this->db->join('tab_user as u', 'u.id = h.user_id', 'left');
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_order_d_details($orderhid,$entCode)
    {
	$this->db->select('d.*,i.index_name as product_uom_index_name');
    $this->db->from('tab_order_d as d');
    $this->db->where('d.order_h_id', $orderhid);
    $this->db->where('d.row_invalidated', 0);
	$this->db->join('tab_index as id', 'id.index_id = d.product_uom_index','left');
    $query = $this->db->get();
    return $query->result_array();
    }
	
	
	
	
	
	
	
	
	
		
 }