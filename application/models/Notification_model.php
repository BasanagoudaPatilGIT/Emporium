<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function add_notification_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_notification');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_notification', $data);
	}
	
	
	public function update_notification_status($tranNumber,$data)
    {
    $this->db->where('transaction_number', $tranNumber);
    $this->db->update('tab_notification', $data);		
    }
	
	
	
	public function get_pending_notification_details($order_by = 'DESC',$entCode,$userId)
    {
    $this->db->select('n.*');
	$this->db->from('tab_notification as n');
	$this->db->where('n.ent_code', $entCode);
	$this->db->where('n.recieved_by',$userId);
	$this->db->where('n.read_status', 0);
    if($order_by != ''){
    $this->db->order_by('n.id',$order_by);
    }
	$query = $this->db->get();			
    return $query->result_array();
    }
	
	public function get_order_notification_details($order_by = 'DESC',$entCode,$userId)
    {
    $this->db->select('n.*');
	$this->db->from('tab_notification as n');
	$this->db->where('n.ent_code', $entCode);
	$this->db->where('n.recieved_by',$recievedBy);
	$this->db->where('n.notification_type', 'Order');
    if($order_by != ''){
    $this->db->order_by('n.id',$order_by);
    }
	$query = $this->db->get();			
    return $query->result_array();
    }
	
	public function get_bill_notification_details($order_by = 'DESC',$entCode,$userId)
    {
    $this->db->select('n.*');
	$this->db->from('tab_notification as n');
	$this->db->where('n.ent_code', $entCode);
	$this->db->where('n.recieved_by',$recievedBy);
	$this->db->where('n.notification_type', 'Bill');
    if($order_by != ''){
    $this->db->order_by('n.id',$order_by);
    }
	$query = $this->db->get();			
    return $query->result_array();
    }
	
	public function get_notification_details_by_transaction_number($transactionNumber)
    {
    $this->db->select('n.*');
	$this->db->from('tab_notification as n');
	$this->db->where('n.transaction_number',$transactionNumber);
	$query = $this->db->get();			
    return $query->row_array();
    }
	
 }