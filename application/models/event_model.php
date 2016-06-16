<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class event_model extends CI_Model {
	public function __construct()
	{
		parent::__construct(); 
	}
	
	
	function first_name($event_id)
	{		
		
			$this->db->select('*');	
			$this->db->where('event_id',$event_id);						
			$this->db->from('event_detail');
			$query = $this->db->get();
			$result = $query->result_array(); 
			return $result;	
		
	}
	
	function event_details($result){
			
			foreach($result as $key=>$val){
			
				$event_id = $val['event_id'];

				$result[$key]['event_details'] = $this->first_name($val['event_id']);
				
			}
			
			return $result;
	}
	
	function event_count($result){
			
			foreach($result as $key=>$val){
			
				$talent_id = $val['talent_id'];
				
				$this->db->select('count(*) as events_hired');	
				$this->db->where('talent_id',$talent_id);				
				$this->db->where('status',3);				
				$this->db->from('invite_talent_to_event');
				$query = $this->db->get();
				$invite_count = $query->result_array();
				$result[$key]['events_hired'] = $invite_count[0]['events_hired']; 
				
			}
			
			return $result;
	}
	
	function event_detail_client($event_id,$myuser_id)
	{		
		
			$this->db->select('*');	
			$this->db->where('event_id',$event_id);						
			$this->db->where('client_id',$myuser_id);						
			$this->db->from('event_detail');
			$query = $this->db->get();
			$result = $query->result_array(); 
			return $result;	
		
	}
	
	function event_detail_talent($event_id)
	{		
		
			$this->db->select('*');	
			$this->db->where('event_id',$event_id);			
			$this->db->from('event_detail');
			$query = $this->db->get();
			$result = $query->result_array(); 
			return $result;	
		
	}
	
	function closed($event_id)
	{		
		
			$this->db->select('event_detail.first_name,event_detail.event_id,event_detail.event_name,event_detail.start_datetime,event_detail.end_datetime
			,event_detail.location,event_detail.number_of_guests,event_detail.status,event_detail.launch_status,event_detail.event_pic');	
			$this->db->where('event_id',$event_id);
			//$this->db->where('status',1);						
			$this->db->from('event_detail');
			$query = $this->db->get();
			$result = $query->result_array(); 
			return $result;	
		
	}
	
	function timesheet($event_id,$client_id,$talent_id)
	{		
			$this->db->select('*');	
			$this->db->where('event_id',$event_id);
			$this->db->where('client_id',$client_id);
			$this->db->where('talent_id',$talent_id);				
			$this->db->from('timeline');
			$query = $this->db->get();
			$result = $query->result_array(); 
			return $result;	
		
	}
	
	function closed_event_details($result){
			
			foreach($result as $key=>$val){
			
				$event_id = $val['event_id'];
				$client_id = $val['client_id'];
				$talent_id = $val['talent_id'];

				$result[$key]['event_details'] = $this->closed($val['event_id']);
				//$result[$key]['timesheet_details'] = $this->timesheet($event_id,$client_id,$talent_id);
				$result[$key]['checkin_details_talent'] = $this->last_name($event_id,$client_id,$talent_id);
				
			}
			
			return $result;
	}
	
	function last_name($event_id,$client_id,$talent_id)
	{		
		
			$this->db->select('*');	
			$this->db->where('event_id',$event_id);						
			$this->db->where('client_id',$client_id);						
			$this->db->where('talent_id',$talent_id);						
			$this->db->from('checkin');
			$query = $this->db->get();
			$result = $query->result_array(); 
			return $result;	
		
	}
	
	function check_details_talent($result){
			
			foreach($result as $key=>$val){
			
				$event_id = $val['event_id'];
				$client_id = $val['client_id'];
				$talent_id = $val['talent_id'];

				$result[$key]['check_details_talent'] = $this->last_name($event_id,$client_id,$talent_id);
				
			}
			
			return $result;
	}
	
}
	