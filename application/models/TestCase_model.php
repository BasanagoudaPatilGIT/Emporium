<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class TestCase_model extends CI_Model
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
    $query = $this->db->get('tab_testcase');
    $row = $query->row();
    if (isset($row))
    {
    $max_id = $row->id + 1;
    }
    
    $data['id'] = $max_id;
    return $this->db->insert('tab_testcase', $data);
    }
    
    public function insert($data)
    {
    
    $this->db->insert_batch('tab_testcase', $data);
    }
    
    public function edit_record($id,$data)
    {
    $this->db->where('id', $id);
    $this->db->update('tab_testcase', $data);		
    }
    
    public function edit_scenario_record($id,$projid,$data)
    {
    $this->db->where('id', $id);
    $this->db->where('project_id', $projid);
    $this->db->update('tab_testcase', $data);		
    }
    
    public function delete_record($id)
    {
    $this->db->where('id', $id);
    return $this->db->delete('tab_testcase');
    }
    
    public function view_record($order_by = '',$id)
    {
    $this->db->select('t.*,p.id as project_id,p.project_name');
    $this->db->from('tab_testcase as t');
    $this->db->join('tab_project as p', 'p.id = t.project_id','left');
    if($id > 0){
    $this->db->where('t.project_id',$id);
    }
    if($order_by != ''){
    $this->db->order_by('p.id',$order_by);
    }
    $query = $this->db->get();		
    return $query->result_array();
    }
    
    
    public function get_record_by_id($id)
    {
    $this->db->where('id', $id);
    $query = $this->db->get('tab_testcase');
    
    return $query->row_array();
    }
    
    public function get_record_by_selected_id($id)
    {
    $this->db->select('id as testcase_id,module_name,feature_name,high_level_scenario,checkpoints,execution_steps,expected_result');
    $this->db->where('id', $id);
    $query = $this->db->get('tab_testcase');
    
    return $query->row_array();
    }
    
    public function get_record_case_id($id)
    {
    $this->db->select('t.*');
    $this->db->from('tab_testcase as t');
    $this->db->where('id',$id);
    
    $query = $this->db->get();		
    return $query->row_array();
    }
    
    public function get_record_by_project_id($id)
    {
    $this->db->where('project_id', $id);
    $this->db->where('status', 'Active');
    $query = $this->db->get('tab_testcase');
    
    return $query->result_array();
    }
    
    
    public function get_record_by_project_testcase_id($proid,$repid)
    {
    $sql = "select t.* from tab_testcase t left join tab_testreport_d d on (d.testcase_id = t.id) left join tab_testreport_h h on (t.project_id = h.project_id)
	where t.project_id = ? and (d.report_id not in (?) or d.report_id is null) and t.status = ?";
    $query = $this->db->query($sql,array($proid,$repid,'Active'));
    return $query->result_array();
    }
     
    public function TestCase_count()
    {
    return $this->db->count_all_results('tab_testcase');
    }
    
    
    }