<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Invoice_model extends CI_Model
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
    $query = $this->db->get('tab_temp_invoice');
    $row = $query->row();
    if (isset($row))
    {
    $max_id = $row->id + 1;
    }
    
    $data['id'] = $max_id;
    return $this->db->insert('tab_temp_invoice', $data);
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
    
	public function patient_count($id)
    {
    $this->db->where('user_id', $id);
	return $this->db->count_all_results('tab_invoice_h');	
    }
	public function incriment_invoice_no($data,$userid)
    {
	$this->db->where('series_id','#I');
	$this->db->where('user_id', $userid);
	$this->db->update('tab_series', $data);		
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
	
    
    public function edit_record($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_testcase', $data);		
    }
    
    
    
    public function delete_record($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('tab_temp_invoice');
	}
    
	 public function delete_all_record($userid)
	{
		$this->db->where('user_id', $userid);
		return $this->db->delete('tab_temp_invoice');
	}
    public function view_record($order_by = '')
    {
    $this->db->select('t.*');
    $this->db->from('tab_temp_invoice as t');
	$this->db->where('user_id', $_SESSION['ID']);
    if($order_by != ''){
    $this->db->order_by('t.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
    
	public function view_invoice_details($order_by = '')
    {
    $this->db->select('h.*,p.*,r.first_name,r.last_name');
    $this->db->from('tab_invoice_h as h');
	$this->db->where('h.user_id', $_SESSION['ID']);
	$this->db->join('tab_registration as r', 'r.id = h.user_id', 'left');
	$this->db->join('tab_patients as p', 'p.id = h.patient_id', 'left');
    if($order_by != ''){
    $this->db->order_by('h.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function view_invoice_details_admin($order_by = '')
    {
    $this->db->select('h.*,p.*,r.first_name,r.last_name');
    $this->db->from('tab_invoice_h as h');
	$this->db->join('tab_registration as r', 'r.id = h.user_id', 'left');
	$this->db->join('tab_patients as p', 'p.id = h.patient_id', 'left');
    if($order_by != ''){
    $this->db->order_by('h.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
    
    public function get_total_amount($id)
    {
	$this->db->select('sum(sub_total) as grossamt');
    $this->db->from('tab_temp_invoice');
    $this->db->where('user_id', $id);
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_total_tax_percent($id)
    {
	$this->db->select('sum(tax_percent) as totaltax');
    $this->db->from('tab_temp_invoice');
    $this->db->where('user_id', $id);
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_total_tax_amt($id)
    {
	$this->db->select('sum(tax_amount) as totaltaxamt');
    $this->db->from('tab_temp_invoice');
    $this->db->where('user_id', $id);
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_total_amt($id)
    {
	$this->db->select('sum(total) as totalamt');
    $this->db->from('tab_temp_invoice');
    $this->db->where('user_id', $id);
    $query = $this->db->get();
    return $query->row_array();
    }
    
    public function products_count($id)
    {
	$this->db->where('user_id', $id);
    return $this->db->count_all_results('tab_temp_invoice');
    }
    
    public function auto_featch($prodname,$id)
    {
	$this->db->select('*');
	$this->db->like('product_name',$prodname,'BOTH');
    $this->db->where('user_id', $id);
    $this->db->where('product_qty >', 0);
	$this->db->order_by('product_qty','ASC');
    return $this->db->get('tab_product')->result();
    }
	
	
	public function get_invoice_header_details_to_view($invoiceh_id,$userId)
    {
	$this->db->select('h.*,p.*');
    $this->db->from('tab_invoice_h as h');
    $this->db->where('h.id', $invoiceh_id);
    $this->db->where('h.user_id', $userId);
	$this->db->join('tab_patients as p', 'p.id = h.patient_id', 'left');
    $query = $this->db->get();
    return $query->row_array();
    }
	
	public function get_invoice_product_details_to_view($invoiceh_id,$userId)
    {
	$this->db->select('d.*');
    $this->db->from('tab_invoice_d as d');
    $this->db->where('d.invoiceh_id', $invoiceh_id);
	$this->db->where('d.user_id', $userId);
    $query = $this->db->get();
    return $query->result_array();
    }
	public function total_amount($userid)
    {
    $sql = "select SUM(invoice_amt) as amount from tab_invoice_h  where  user_id = ?";
    $query = $this->db->query($sql,array($userid));
    return $query->row_array();
    }
	
	public function todays_total_amount($userid,$datestring)
    {
    $sql = "select SUM(invoice_amt) as amount from tab_invoice_h  where user_id = ? and created_date =?";
    $query = $this->db->query($sql,array($userid,$datestring));
    return $query->row_array();
    }
	public function get_product_based_on_batch($batch)
    {
	$this->db->select('p.*');
	$this->db->from('tab_product as p');
	$this->db->where('p.batchno', $batch);
	$query = $this->db->get();
	
	return $query->row_array();
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
	
	public function get_patient_max_id()
    {
    //SELECT MAX ID
    $max_id = 1;
    $this->db->select_max('id');
    $query = $this->db->get('tab_patients');
    $row = $query->row();
    return $row->id;
    }
}