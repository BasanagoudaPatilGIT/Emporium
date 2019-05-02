<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function add_product_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_product');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_product', $data);
	}
	public function get_max_product_id()
	{
		$this->db->select_max('id');
		$query = $this->db->get('tab_product');
		$row = $query->row();
		return $row->id;
	}
	
	public function update_product_details($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_product', $data);		
    }
	
	public function add_stock_h_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_stock_h');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_stock_h', $data);
	}
	
	public function get_max_stock_h_id()
	{
		$this->db->select_max('id');
		$query = $this->db->get('tab_stock_h');
		$row = $query->row();
		return $row->id;
	}
	
	public function update_stock_h_details($id,$productId, $data)
    {
    $this->db->where('id', $id);
	$this->db->where('product_id', $productId);
    $this->db->update('tab_stock_h', $data);		
    }
	
	
	public function add_stock_d_details($data)
	{
		//SELECT MAX ID
		$max_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_stock_d');
		$row = $query->row();
		if (isset($row))
		{
			$max_id = $row->id + 1;
		}
		
		$data['id'] = $max_id;
		return $this->db->insert('tab_stock_d', $data);
	}
	
	public function update_stock_d_details($id,$productId, $data)
    {
    $this->db->where('id', $id);
	$this->db->where('product_id', $productId);
	$this->db->where('stock_h_id', $productId);
    $this->db->update('tab_stock_h', $data);		
    }
	
	public function incriment_productcode_no($data,$entCode)
    {
	$this->db->where('series_name', 'Product Code');
	$this->db->where('ent_code', $entCode);
	$this->db->update('tab_series', $data);	
	}
	
	public function get_product_details($order_by = '',$entCode)
    {
    $this->db->select('p.*');
	$this->db->from('tab_product as p');
	$this->db->where('p.ent_code', $entCode);
    if($order_by != ''){
    $this->db->order_by('p.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function stock_details($order_by = '',$entCode)
    {
    $this->db->select('p.*,st.index_name as product_status_index_name,cat.category_index as category_index, cat.category_name as category_index_name,
	sc.sub_category_index as sub_category_index, sc.sub_category_name as sub_category_index_name,h.id as producthId,h.product_batch,h.packets_in_box,
	h.product_pack_date,h.product_exp_date,h.mrp,h.tax_precent,h.purchase_rate,h.sale_rate,h.purchase_qty,d.id as productdId, d.stock_qty,d.online_stock_qty, 
	d.offline_stock_qty,d.transit_qty,d.created_datetime');
	$this->db->from('tab_product as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('d.online_stock_qty > ', 0);
	$this->db->join('tab_stock_h as h', 'h.product_id = p.id','left');
	$this->db->join('tab_stock_d as d', 'd.stock_h_id = h.id','left');
	$this->db->join('tab_category as cat', 'cat.category_index = p.category_index','left');
	$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = p.sub_category_index','left');
	$this->db->join('tab_index as st', 'st.index_id = p.product_status_index','left');
    if($order_by != ''){
    $this->db->order_by('p.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function stock_details_by_id($order_by = '',$entCode,$id)
    {
	$this->db->select('p.*,st.index_name as product_status_index_name,cat.category_index as category_index, cat.category_name as category_index_name,
	sc.sub_category_index as sub_category_index, sc.sub_category_name as sub_category_index_name,h.id as producthId,h.product_batch,h.packets_in_box,
	h.product_pack_date,h.product_exp_date,h.mrp,h.tax_precent,h.purchase_rate,h.sale_rate,h.purchase_qty,d.id as productdId, d.stock_qty,d.online_stock_qty, 
	d.offline_stock_qty,d.transit_qty,d.created_datetime');	
	$this->db->from('tab_product as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('p.id', $id);
	$this->db->join('tab_stock_h as h', 'h.product_id = p.id','');
	$this->db->join('tab_stock_d as d', 'd.stock_h_id = h.id','left');
	$this->db->join('tab_category as cat', 'cat.category_index = p.category_index','left');
	$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = p.sub_category_index','left');
	$this->db->join('tab_index as st', 'st.index_id = p.product_status_index','left');
    if($order_by != ''){
    $this->db->order_by('p.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->row_array();
    }
	
	public function stock_details_by_batchno($entCode,$batchno)
    {
	$this->db->select('p.*,st.index_name as product_status_index_name,cat.category_index as category_index, cat.category_name as category_index_name,
	sc.sub_category_index as sub_category_index, sc.sub_category_name as sub_category_index_name,h.id as producthId,h.product_batch,h.packets_in_box,
	h.product_pack_date,h.product_exp_date,h.mrp,h.tax_precent,h.purchase_rate,h.sale_rate,h.purchase_qty,d.id as productdId, d.stock_qty,d.online_stock_qty, 
	d.offline_stock_qty,d.transit_qty,d.created_datetime');	
	$this->db->from('tab_product as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('h.product_batch', $batchno);
	$this->db->join('tab_stock_h as h', 'h.product_id = p.id','');
	$this->db->join('tab_stock_d as d', 'd.stock_h_id = h.id','left');
	$this->db->join('tab_category as cat', 'cat.category_index = p.category_index','left');
	$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = p.sub_category_index','left');
	$this->db->join('tab_index as st', 'st.index_id = p.product_status_index','left');
    
    $query = $this->db->get();		
    return $query->row_array();
    }
	
	public function product_details($order_by = '',$entCode)
    {
    $this->db->select('p.*,st.index_name as product_status_index_name,cat.category_index as category_index, cat.category_name as category_index_name,
	sc.sub_category_index as sub_category_index, sc.sub_category_name as sub_category_index_name,h.id as producthId,h.product_batch,h.packets_in_box,
	h.product_pack_date,h.product_exp_date,h.mrp,h.tax_precent,h.purchase_rate,h.sale_rate,h.purchase_qty,d.id as productdId, d.stock_qty,d.online_stock_qty, 
	d.offline_stock_qty,d.transit_qty,d.created_datetime');
	$this->db->from('tab_product as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->join('tab_stock_h as h', 'h.product_id = p.id','left');
	$this->db->join('tab_stock_d as d', 'd.stock_h_id = h.id','left');
	$this->db->join('tab_category as cat', 'cat.category_index = p.category_index','left');
	$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = p.sub_category_index','left');
	$this->db->join('tab_index as st', 'st.index_id = p.product_status_index','left');
    if($order_by != ''){
    $this->db->order_by('p.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
	
	public function product_details_by_id($order_by = '',$ProductCode,$entCode, $batchno)
    {
    $this->db->select('p.*,st.index_name as product_status_index_name,cat.category_index as category_index, cat.category_name as category_index_name,
	sc.sub_category_index as sub_category_index, sc.sub_category_name as sub_category_index_name,h.id as producthId,h.product_batch,h.packets_in_box,
	h.product_pack_date,h.product_exp_date,h.mrp,h.tax_precent,h.purchase_rate,h.sale_rate,h.purchase_qty,d.id as productdId, d.stock_qty,d.online_stock_qty, 
	d.offline_stock_qty,d.transit_qty,d.created_datetime');
	$this->db->from('tab_product as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('p.product_code', $ProductCode);
	$this->db->where('h.product_batch', $batchno);
	$this->db->join('tab_stock_h as h', 'h.product_id = p.id','left');
	$this->db->join('tab_stock_d as d', 'd.stock_h_id = h.id','left');
	$this->db->join('tab_category as cat', 'cat.category_index = p.category_index','left');
	$this->db->join('tab_sub_category as sc', 'sc.sub_category_index = p.sub_category_index','left');
	$this->db->join('tab_index as st', 'st.index_id = p.product_status_index','left');
    if($order_by != ''){
    $this->db->order_by('p.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->row_array();
    }

	
	public function low_stock_details($entCode)
    {
     $sql = "SELECT * FROM tab_product p JOIN (SELECT id AS producthId,product_id,product_batch,packets_in_box, product_pack_date, 
	 product_exp_date, mrp,tax_precent, purchase_rate,sale_rate,purchase_qty,MAX(created_datetime) 
	 latestCreation FROM (SELECT * FROM tab_stock_h ORDER BY id DESC) AS h GROUP BY product_id) t1 
	 ON(p.id = t1.product_id) LEFT JOIN (SELECT product_id,productdId, SUM(stock_qty) AS total_stock_qty ,SUM(online_stock_qty) AS total_online_stock_qty,
	 SUM(offline_stock_qty) AS total_offline_stock_qty,SUM(transit_qty) AS total_transit_qty FROM (SELECT d.id as productdId,d.stock_h_id, 
	 d.stock_qty,d.online_stock_qty,d.offline_stock_qty,d.transit_qty,d.created_datetime,d.product_id FROM tab_stock_d as d ORDER BY product_id DESC) 
	 sd GROUP BY product_id) AS de ON(p.id = de.product_id) JOIN (SELECT category_index, category_name AS category_index_name FROM tab_category) AS tc 
	 ON (p.category_index = tc.category_index) JOIN (SELECT sub_category_index, sub_category_name AS sub_category_index_name FROM tab_sub_category) AS ts 
	 ON (p.sub_category_index = ts.sub_category_index) JOIN (SELECT index_id, index_name AS product_status_index_name FROM tab_index) AS ti 
	 ON (p.product_status_index = ti.index_id) WHERE p.stock_qty_limit >= de.total_stock_qty AND p.ent_code= ? AND ti.product_status_index_name = ?";
    $query = $this->db->query($sql,array($entCode,'Active'));
    return $query->result_array();
	 }
	
	public function get_productcode($entCode)
    {
	$this->db->select('p.*');
	$this->db->from('tab_series as p');
	$this->db->where('p.ent_code', $entCode);
	$this->db->where('p.series_name', 'Product Code');
	$query = $this->db->get();
	
	return $query->row_array();
    }
	
	
	public function get_product_category()
    {
    $this->db->select('c.*,c.category_index as _id');
	$this->db->from('tab_category as c');
	$query = $this->db->get();		
    return $query->result_array();
    }
	
	public function get_product_sub_category()
    {
    $this->db->select('c.*,c.sub_category_index as _id');
	$this->db->from('tab_sub_category as c');
	$query = $this->db->get();		
    return $query->result_array();
    }

	public function get_uom_details()
    {
    $this->db->select('i.*,um.*,i.index_id as _id');
	$this->db->from('tab_index as i');
	$this->db->where('i.index_type','product_uom_index');
	$this->db->join('tab_uom_mapping as um', 'um.index_id = i.index_id','left');
	$query = $this->db->get();		
    return $query->result_array();
    }	

	public function get_uom_details_based_on_filters($productCategory,$productSubCategory)
    {
    $this->db->select('i.index_name,i.index_id as _id');
	$this->db->from('tab_index as i');
	$this->db->where('i.index_type','product_uom_index');
	$this->db->join('tab_uom_mapping as um', 'um.index_id = i.index_id','left');
	$this->db->where('um.category_id',$productCategory);
	$this->db->where('um.sub_category_id',$productSubCategory);
	$query = $this->db->get();		
    return $query->result_array();
    }		
	
	
	public function update_stock_details_by_batchno($entCode,$stockhId,$data)
    {
	$this->db->where('stock_h_id', $stockhId);
    $this->db->update('tab_stock_d', $data);		
    }	
	
 }