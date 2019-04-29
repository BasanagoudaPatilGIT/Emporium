<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Combo_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	function combo_base()
    { 
        $this->db->select('id');
        $this->db->select('zone');
        $this->db->from('tab_zone');
		$this->db->order_by('zone', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->value);
        }
        return $result_combo = array_combine($id, $value);
    }
	function cbo_sex()
    { 
        $this->db->select('id');
        $this->db->select('gender_type');
        $this->db->from('tab_sex');
		$this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->gender_type);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	
	
	function cbo_allproject_versions()
    { 
        $this->db->select('id');
        $this->db->select('version');
        $this->db->from('tab_version');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->version);
        }
        return $result_combo = array_combine($id, $value);
    }
		
	function cbo_project_versions()
    { 
        $this->db->select('id');
        $this->db->select('version');
        $this->db->from('tab_version');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->version);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_managers($usertype=array('Manager','Developer Manager'),$status='Active')
    { 
        $this->db->select('r.id');
        $this->db->select('r.first_name,r.last_name');
        $this->db->from('tab_registration r');
		$this->db->join('tab_designation as d','d.id = r.user_type', 'left');
		if($usertype != ''){
			$this->db->where_in('d.designation',$usertype);
			$this->db->where('status',$status);
		}
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
			array_push($value, $result[$i]->first_name . ' ' . $result[$i]->last_name);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_Testers($usertype=array('Tester','Testing Manager'),$status='Active')
    { 
        $this->db->select('r.id');
        $this->db->select('r.first_name,r.last_name');
        $this->db->from('tab_registration r');
		$this->db->join('tab_designation as d','d.id = r.user_type', 'left');
		if($usertype != ''){
			$this->db->where_in('d.designation',$usertype);
			$this->db->where('status',$status);
		}
        $query = $this->db->get();
        $result = $query->result();

        $id = array('0');
        $value = array('N/A');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
			array_push($value, $result[$i]->first_name . ' ' .$result[$i]->last_name);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_support($usertype='Support',$status='Active')
    { 
       $this->db->select('r.id');
        $this->db->select('r.first_name,r.last_name');
        $this->db->from('tab_registration r');
		$this->db->join('tab_designation as d','d.id = r.user_type', 'left');
		if($usertype != ''){
			$this->db->where_in('d.designation',$usertype);
			$this->db->where('status',$status);
		}
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
			array_push($value, $result[$i]->first_name . ' ' .$result[$i]->last_name);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_Developer($usertype=array('Developer','Developer Manager'),$status='Active')
    { 
        $this->db->select('r.id');
        $this->db->select('r.first_name,r.last_name');
        $this->db->from('tab_registration r');
		$this->db->join('tab_designation as d','d.id = r.user_type', 'left');
		if($usertype != ''){
			$this->db->where_in('d.designation',$usertype);
			$this->db->where('status',$status);
		}
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
			array_push($value, $result[$i]->first_name . ' ' .$result[$i]->last_name);
        }
        return $result_combo = array_combine($id, $value);
    }
	function cbo_Assigned($usertype=array('Developer','Developer Manager'),$status='Active')
    { 
        $this->db->select('r.id');
        $this->db->select('r.first_name,r.last_name');
        $this->db->from('tab_registration r');
		$this->db->join('tab_designation as d','d.id = r.user_type', 'left');
		if($usertype != ''){
			$this->db->where_in('d.designation',$usertype);
			$this->db->where('status',$status);
		}
        $query = $this->db->get();
        $result = $query->result();

        $id = array('0');
        $value = array('N/A');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
			array_push($value, $result[$i]->first_name . ' ' .$result[$i]->last_name);
        }
        return $result_combo = array_combine($id, $value);
    }	
	
	function cbo_country()
    { 
        $this->db->select('id');
        $this->db->select('country_name');
        $this->db->from('tab_country');
		$this->db->order_by('country_name', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->country_name);
        }
        return $result_combo = array_combine($id, $value);
    }

	function cbo_designation()
    { 
        $this->db->select('id');
        $this->db->select('designation');
        $this->db->from('tab_designation');
		$this->db->order_by('designation', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->designation);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_speciality()
    { 
        $this->db->select('id');
        $this->db->select('speciality');
        $this->db->from('tab_speciality');
		$this->db->order_by('speciality', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->speciality);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	
	
	function cbo_usertype()
    { 
        $this->db->select('id');
        $this->db->select('usertype');
        $this->db->from('tab_usertype');
		$this->db->order_by('usertype', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->usertype);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_project()
    { 
        $this->db->select('id');
        $this->db->select('project_name');
        $this->db->from('tab_project');
        $query = $this->db->get();
        $result = $query->result();

        $id = array('SELECT');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($value, $result[$i]->project_name);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	function cbo_doctor($usertype='2')
    { 
       $this->db->select('r.id');
        $this->db->select('r.first_name,r.last_name');
        $this->db->from('tab_registration r');
		$this->db->where('user_type',$usertype);
        $query = $this->db->get();
        $result = $query->result();

        $id = array('');
        $value = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->id);
			array_push($value, 'Dr. '.$result[$i]->first_name . ' ' .$result[$i]->last_name);
        }
        return $result_combo = array_combine($id, $value);
    }
	
	
}
      