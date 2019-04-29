<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	function all_order_status()
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','order_status_index');
		$this->db->order_by('index_name', 'DESC');
        $query = $this->db->get();

        
        return $query->result_array();
    }
	
	function all_product_stock_status()
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','product_stock_status_index');
		$this->db->order_by('index_name', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function all_product_uom()
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','product_uom_index');
		$this->db->order_by('index_name', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function user_status()
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','user_status_index');
		$this->db->order_by('index_name', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function product_status()
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','user_status_index');
		$this->db->order_by('index_name', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function user_designation($userDesignationIndex)
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','user_designation_index');
		if($userDesignationIndex == '10016'){
		$this->db->where('index','10017');	
		}
		$this->db->order_by('index', 'ASC');
        $query = $this->db->get();

       return $query->result_array();
    }
	
	function user_gender()
    { 
        $this->db->select('index');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where('index_type','user_gender_index');
		$this->db->order_by('index_name', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function product_category_based_on_param($productCategoryName)
    { 
        $this->db->select('category_index');
        $this->db->from('tab_category');
        $this->db->where('category_name',$productCategoryName);
		$this->db->order_by('category_name', 'ASC');
        $query = $this->db->get();

        return $query->row_array();
    }
	
	function product_sub_category_based_on_param($productSubCategoryName,$categoryIndexId)
    { 
        $this->db->select('sub_category_index');
        $this->db->from('tab_sub_category');
        $this->db->where('sub_category_name',$productSubCategoryName);
        $this->db->where('category_index_id',$categoryIndexId);
		$this->db->order_by('sub_category_name', 'ASC');
        $query = $this->db->get();

        return $query->row_array();
    }
	
}
      