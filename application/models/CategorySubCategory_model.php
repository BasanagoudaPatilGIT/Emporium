<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategorySubCategory_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function add_category_record($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_category');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_category', $data);
	}
	
	public function add_sub_category_record($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_sub_category');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_sub_category', $data);
	}
	
	public function add_uom_mapping_record($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_uom_mapping');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_sub_category', $data);
	}
	
	
	
 }