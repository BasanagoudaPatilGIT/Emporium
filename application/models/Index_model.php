<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	function get_uom_mapping_details($entCode)
    { 
        $this->db->select('GROUP_CONCAT(i.index_name) AS indexName,c.category_index as catIndex,c.category_name, sc.sub_category_index as subCatIndex,sc.sub_category_name');
        $this->db->from('tab_uom_mapping um');
		$this->db->where('um.ent_code',$entCode);
		$this->db->join('tab_index as i', 'i.index_id = um.index_id','left');
		$this->db->join('tab_category as c', 'c.category_index = um.category_id','left');
		$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = um.sub_category_id','left');
		//$this->db->order_by('um.id', 'ASC');
		$this->db->group_by('sc.sub_category_index');
        $query = $this->db->get();
		return $query->result_array();
    }
	
	function get_uom_mapping_details_admin()
    { 
        $this->db->select('GROUP_CONCAT(i.index_name) AS indexName,c.category_index as catIndex,c.category_name, sc.sub_category_index as subCatIndex,sc.sub_category_name,um.ent_code');
        $this->db->from('tab_uom_mapping um');
		$this->db->join('tab_index as i', 'i.index_id = um.index_id','left');
		$this->db->join('tab_category as c', 'c.category_index = um.category_id','left');
		$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = um.sub_category_id','left');
		//$this->db->order_by('um.id', 'ASC');
		$this->db->group_by('sc.sub_category_index,um.ent_code');
        $query = $this->db->get();
		return $query->result_array();
    }
	
	
	function get_ent_details()
    { 
        $this->db->select('ent_code as _id,ent_name as entName');
        $this->db->from('tab_entity');
		$this->db->order_by('_id', 'ASC');
        $query = $this->db->get();

        
        return $query->result_array();
    }
	
	function all_order_status()
    { 
		$where = "i.index_type= 'order_status_index' or i.index_type='select_index'";
        $this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index');
        $this->db->where($where);
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

        
        return $query->result_array();
    }
	
	function all_product_stock_status()
    { 
        $where = "i.index_type= 'product_stock_status_index' or i.index_type='select_index'";
		$this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index as i');
        $this->db->where($where);
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function all_product_uom()
    { 
        $where = "i.index_type= 'product_uom_index' or i.index_type='select_index'";
		$this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index as i');
        $this->db->where($where);
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function category_details()
    { 
        $this->db->select('category_index as _id,category_name');
        $this->db->from('tab_category');
		$this->db->order_by('category_name', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	public function max_category_id()
	{
		
		$this->db->select_max('category_index');
		$query = $this->db->get('tab_category');
		$row = $query->row();
		return $row->category_index;
	}
	
	public function max_sub_category_id()
	{
		
		$this->db->select_max('sub_category_index');
		$query = $this->db->get('tab_sub_category');
		$row = $query->row();
		return $row->sub_category_index;
	}
	
	function get_uom_index_by_name($uom)
    { 
        $this->db->select('index_id as _id');
        $this->db->from('tab_index');
        $this->db->where('index_name',$uom);
        $query = $this->db->get();
		return $query->row_array();
    }
	
	function user_status()
    { 
        $where = "i.index_type= 'user_status_index' or i.index_type='select_index'";
		$this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index as i');
        $this->db->where($where);
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function product_status()
    { 
        $where = "i.index_type= 'user_status_index' or i.index_type='select_index'";
		$this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index as i');
        $this->db->where($where);
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function user_designation($userDesignationIndex)
    { 
        $where = "i.index_type= 'user_designation_index' or i.index_type='select_index'";
		$this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index as i');
        $this->db->where($where);
		if($userDesignationIndex == '10016'){
		$this->db->where('index_id','10017');	
		}
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

       return $query->result_array();
    }
	
	function user_gender()
    { 
		$where = "i.index_type= 'user_gender_index' or i.index_type='select_index'";
        $this->db->select('index_id as _id');
        $this->db->select('index_name');
        $this->db->from('tab_index as i');
        $this->db->where($where);
		$this->db->order_by('_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function product_category_based_on_param($productCategoryName)
    { 
        $this->db->select('category_index as _id');
        $this->db->from('tab_category');
        $this->db->where('category_name',$productCategoryName);
		$this->db->order_by('category_name', 'ASC');
        $query = $this->db->get();

        return $query->row_array();
    }
	
	function product_sub_category_based_on_param($productSubCategoryName,$categoryIndexId)
    { 
        $this->db->select('sub_category_index as _id');
        $this->db->from('tab_sub_category');
        $this->db->where('sub_category_name',$productSubCategoryName);
        $this->db->where('category_index_id',$categoryIndexId);
		$this->db->order_by('sub_category_name', 'ASC');
        $query = $this->db->get();

        return $query->row_array();
    }
	
	function apartment_details($entCode)
    { 
    $sql = "SELECT *,id as _id FROM tab_apartment where ent_code in (1,?)";
    $query = $this->db->query($sql,array($entCode));
    return $query->result_array();
    }
	
	function wing_details($entCode)
    { 
    $sql = "SELECT *,id as _id FROM tab_wing where ent_code in (1,?)";
    $query = $this->db->query($sql,array($entCode));
    return $query->result_array();
    }
	
	function flat_details($entCode)
    { 
    $sql = "SELECT *,id as _id FROM tab_flat_no where ent_code in (1,?)";
    $query = $this->db->query($sql,array($entCode));
    return $query->result_array();
    }
	
	
	function all_apartment_details()
    { 
    $sql = "SELECT *,id as _id FROM tab_apartment order by _id ASC";
    $query = $this->db->query($sql,array());
    return $query->result_array();
    }
	
	function all_wing_details()
    { 
    $sql = "SELECT *,id as _id FROM tab_wing order by _id ASC";
    $query = $this->db->query($sql,array());
    return $query->result_array();
    }
	
	function all_flat_details()
    { 
    $sql = "SELECT *,id as _id FROM tab_flat_no order by _id ASC";
    $query = $this->db->query($sql,array());
    return $query->result_array();
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
      