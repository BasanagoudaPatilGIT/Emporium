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
	
	public function update_bill_h_status($entCode,$billNumber,$data)
    {
    $this->db->where('ent_code', $entCode);
    $this->db->where('bill_number', $billNumber);
    $this->db->update('tab_bill_h', $data);		
    }
	
	public function bill_details($order_by = '',$entCode)
    {
    $this->db->select('b.*,d.*,i.index_name as billStatus,id.index_name as productUOM,is.index_name as 
	productStockStatus,u.user_full_name,u.user_address,u.user_phone_no');
	$this->db->from('tab_bill_h as b');
	$this->db->where('o.ent_code', $entCode);
	$this->db->where('d.row_invalidated', 0);
	$this->db->join('tab_bill_d as d', 'd.order_h_id = o.id','left');
	$this->db->join('tab_user as u', 'u.id = o.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = o.order_status_index','left');
	$this->db->join('tab_index as id', 'id.index_id = d.product_uom_index','left');
	$this->db->join('tab_index as is', 'is.index_id = d.product_stock_status_index','left');
    if($order_by != ''){
    $this->db->order_by('o.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function order_details_by_status($order_by = '',$entCode,$orderStatus)
    {
    $this->db->select('o.*,d.*,o.*,i.index_name as orderStatus,id.index_name as productUOM,is.index_name as 
	productStockStatus,u.user_full_name,u.user_address,u.user_phone_no');
	$this->db->from('tab_bill_h as o');
	$this->db->where('o.ent_code', $entCode);
	$this->db->where('i.index_id', $orderStatus);
	$this->db->where('d.row_invalidated', 0);
	$this->db->join('tab_order_d as d', 'd.order_h_id = o.id','left');
	$this->db->join('tab_user as u', 'u.id = o.user_id','left');
	$this->db->join('tab_index as i', 'i.index_id = o.order_status_index','left');
	$this->db->join('tab_index as id', 'id.index_id = d.product_uom_index','left');
	$this->db->join('tab_index as is', 'is.index_id = d.product_stock_status_index','left');
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
		
	public function get_bill_status_details()
    {
    $this->db->select('i.index_id,i.index_name');
	$this->db->from('tab_index as i');
	$this->db->where('i.index_type','invoice_status_index');
	$query = $this->db->get();		
    return $query->result_array();
    }	
	
	public function incriment_order_no($data,$entCode)
    {
	$this->db->where('series_id', '#O');
	$this->db->where('ent_code', $entCode);
	$this->db->update('tab_series', $data);	
    }
	
	public function get_order_h_details($orderNumber,$entCode)
    {
	$this->db->select('h.*,u.user_full_name,u.user_address,u.user_phone_no');
    $this->db->from('tab_bill_h as h');
    $this->db->where('h.order_number', $orderNumber);
    $this->db->where('h.ent_code', $entCode);
	$this->db->join('tab_user as u', 'u.id = h.user_id', 'left');
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_order_d_details($orderhid,$entCode)
    {
	$this->db->select('d.*');
    $this->db->from('tab_order_d as d');
    $this->db->where('d.order_h_id', $orderhid);
    $this->db->where('d.row_invalidated', 0);
    $query = $this->db->get();
    return $query->result_array();
    }
	
	
		
 }