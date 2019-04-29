<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class TestReport_model extends CI_Model
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
	$query = $this->db->get('tab_testreport_h');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	return $this->db->insert('tab_testreport_h', $data);
	}
	
	public function add_report_record($data)
	{
	//SELECT MAX ID
		$report_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_testreport_h');
		$row = $query->row();
		if (isset($row))
		{
			$report_id = $row->id;
		}
	
	//SELECT MAX ID
	$max_id = 1;
	$this->db->select_max('id');
	$query = $this->db->get('tab_testreport_d');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	$data['report_id'] = $report_id;
	$data['test_status']='Not Completed';
	$data['bug_id']='N/A';
	$data['bug_status']='N/A';
	$data['comments']='N/A';
	$data['tested_by']='N/A';
	$data['assigned_to']='N/A';
	$data['developer_status']='N/A';
					
	return $this->db->insert('tab_testreport_d', $data);
	}
	
    public function add_app_login_record($data)
	{
	//SELECT MAX ID
		$report_id = 1;
		$this->db->select_max('id');
		$query = $this->db->get('tab_testreport_h');
		$row = $query->row();
		if (isset($row))
		{
			$report_id = $row->id;
		}
	
	//SELECT MAX ID
	$max_id = 1;
	$this->db->select_max('id');
	$query = $this->db->get('tab_app_login_details');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	$data['report_id'] = $report_id;
	
	return $this->db->insert('tab_app_login_details', $data);
	}
	
	public function update_app_login_record($data)
	{
	//SELECT MAX ID
	$max_id = 1;
	$this->db->select_max('id');
	$query = $this->db->get('tab_app_login_details');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	
	return $this->db->insert('tab_app_login_details', $data);
	}
	
	public function delete_app_record($id)
	{
		$this->db->where('report_id', $id);
		return $this->db->delete('tab_app_login_details');
	}
	
	
	
	public function add_comment_record($data)
	{
	//SELECT MAX ID
	$max_id = 1;
	$this->db->select_max('id');
	$query = $this->db->get('tab_comments');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	
	$data['id'] = $max_id;
	return $this->db->insert('tab_comments', $data);
	}
	
	
	
	public function update_report_record($data)
	{
	//SELECT MAX ID
	$max_id = 1;
	$this->db->select_max('id');
	$query = $this->db->get('tab_testreport_d');
	$row = $query->row();
	if (isset($row))
	{
	$max_id = $row->id + 1;
	}
	$data['report_id'] = $_SESSION['REPORTID'];
	$data['id'] = $max_id;
	$data['test_status']='Not Completed';
	$data['bug_id']='N/A';
	$data['bug_status']='N/A';
	$data['comments']='N/A';
	$data['tested_by']='N/A';
	$data['assigned_to']='N/A';
	$data['developer_status']='N/A';
					
	return $this->db->insert('tab_testreport_d', $data);
	}
	
	public function edit_record($id,$data)
	{
	$this->db->where('id', $id);
	$this->db->update('tab_testreport_h', $data);		
	}
	
	public function edit_status_record($id,$repid,$data)
	{
	$this->db->where('id', $id);
	$this->db->where('report_id', $repid);
	$this->db->update('tab_testreport_d', $data);		
	}
	
	public function delete_record($id)
	{
	$this->db->where('id', $id);
	return $this->db->delete('tab_testreport_d');
	}
	
	public function view_record($order_by='DESC',$id)
	{
	$this->db->select('t.*,p.project_name');
	$this->db->from('tab_testreport_h as t');
	$this->db->join('tab_project as p', 'p.id = t.project_id','left');
	if($id > 0){
	$this->db->where('t.project_id',$id);
		}
	if($order_by != ''){
	$this->db->order_by('t.created_datetime',$order_by);
	}
	$query = $this->db->get();		
	return $query->result_array();
	}
	
	
	public function get_record_by_id($id)
	{
	$this->db->select('h.*,p.project_name');
	$this->db->from('tab_testreport_h as h');
	$this->db->join('tab_project as p','p.id = h.project_id', 'left');
	$this->db->where('h.id', $id);
	$query = $this->db->get();
	
	return $query->row_array();
	}
	
	public function get_reportdesc_by_id($id)
	{
	$this->db->select('h.report_description');
	$this->db->from('tab_testreport_h as h');
	$this->db->where('id', $id);
	$query = $this->db->get();
	
	return $query->row_array();
	}
	
	public function get_record_case_id($id)
	{
		$this->db->select('t.*');
		$this->db->from('tab_testreport_d as t');
		$this->db->where('id',$id);
		$query = $this->db->get();		
		return $query->row_array();
	}
	
	public function get_comments($id,$repid)
	{
		$this->db->select('c.*');
		$this->db->from('tab_comments as c');
		$this->db->where('scenario_id',$id);
		$this->db->where('report_id',$repid);
		$this->db->order_by('c.id','DESC');
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	
	public function get_record_by_report_id($id)
	{
		$this->db->select('d.*,h.report_description');
		$this->db->select('CONCAT(r.first_name," ",r.last_name) as assigned_to');
		$this->db->select('CONCAT(t.first_name," ",t.last_name) as tested_by');
		$this->db->from('tab_testreport_d as d');
		$this->db->join('tab_registration as t','t.id = d.tested_by', 'left');
		$this->db->join('tab_registration as r','r.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->where('d.report_id', $id);
		$this->db->order_by('d.testcase_id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	public function get_app_login_details_report_id($id)
	{
		$this->db->select('d.*,CONCAT(r.first_name," ",r.last_name) as db_recived_by');
		$this->db->select('CONCAT(f.first_name," ",f.last_name) as warfile_recived_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as apk_recived_by');
		$this->db->from('tab_app_login_details as d');
		$this->db->join('tab_registration as r','r.id = d.db_recived', 'left');
		$this->db->join('tab_registration as f','f.id = d.warfile_recived', 'left');
		$this->db->join('tab_registration as a','a.id = d.apk_recived', 'left');
		$this->db->where('report_id', $id);
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	
	public function fetch_data_by_report_id($id)
	{
		$this->db->select('d.*,
		CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		$this->db->where('report_id', $id);
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->order_by('d.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	
	public function pending_task_dev_list()
	{
		$dev_status = array('REOPENED','ASSIGNED','NEEDINFO');
		$this->db->select('d.*,h.report_description,p.project_name,
						   CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		$this->db->where('d.assigned_to', $_SESSION['ID']);
		$this->db->where_IN('d.developer_status',$dev_status);
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->join('tab_project as p','p.id = h.project_id', 'left');
		$this->db->order_by('h.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	public function pending_task_testing_list()
	{
		$dev_status = array('CLOSED','ONHOLD','NEEDINFO');
		$this->db->select('d.*,h.report_description,p.project_name,
		CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		//$this->db->where('d.assigned_to', $_SESSION['ID']);
		$this->db->where_IN('d.developer_status',$dev_status);
		$this->db->where('d.test_status!=','PASSED');
		$this->db->where('d.bug_status!=','CLOSED');
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->join('tab_project as p','p.id = h.project_id', 'left');
		$this->db->order_by('h.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	public function all_dev_task_list()
	{
		$this->db->select('d.*,h.report_description,p.project_name,
		CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		$this->db->where('d.assigned_to', $_SESSION['ID']);
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->join('tab_project as p','p.id = h.project_id', 'left');
		$this->db->order_by('h.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	public function all_test_task_list()
	{
		$this->db->select('d.*,h.report_description,p.project_name,
		CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		$this->db->where('d.tested_by', $_SESSION['ID']);
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->join('tab_project as p','p.id = h.project_id', 'left');
		$this->db->order_by('h.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	
	
	public function pending_issue_list()
	{
		$this->db->select('d.*,h.report_description,p.project_name,
		CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		$this->db->where('d.test_status!=','PASSED');
		$this->db->where('d.bug_status!=','CLOSED');
		$this->db->where('d.bug_id!=','N/A');
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->join('tab_project as p','p.id = h.project_id', 'left');
		$this->db->order_by('h.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	public function all_issue_list()
	{
		$this->db->select('d.*,h.report_description,p.project_name,
		CONCAT(r.first_name," ",r.last_name) as nameof_tested_by');
		$this->db->select('CONCAT(a.first_name," ",a.last_name) as nameof_assigned_to');
		$this->db->from('tab_testreport_d as d');
		$this->db->where('d.bug_id!=','N/A');
		$this->db->join('tab_registration as r','r.id = d.tested_by', 'left');
		$this->db->join('tab_registration as a','a.id = d.assigned_to', 'left');
		$this->db->join('tab_testreport_h as h','h.id = d.report_id', 'left');
		$this->db->join('tab_project as p','p.id = h.project_id', 'left');
		$this->db->order_by('h.id','ASC');
		$query = $this->db->get();
	
	return $query->result_array();
	}
	
	public function Testreport_count($status,$repid)
	{
		   $this->db->where('report_id', $repid);
		   $this->db->where('test_status', $status);	
	       return $this->db->count_all_results('tab_testreport_d');
	}
	
	public function AllTestReport_count()
	{
	return $this->db->count_all_results('tab_testreport_h');
	}
	
	
	
	}