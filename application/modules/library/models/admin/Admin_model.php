<?php
class Admin_model extends CI_Model {

    function __construct()
	{
		parent::__construct();
		ini_set('date.timezone', 'Asia/Dacca');
    }
	
	 
	function check_user_account_FE()
	{
		//echo date('Y-m-d');
		$cur = date('Y-m-d');
		
		
			$user_id=$this->input->post('username');
		
			$password=$this->input->post('password');
			$password = md5($password);
			
			/*$data["mem_id"] = "tofayel";
			$pass = "tofayel123";
			$pass = md5($pass);	
			$data["mem_pass"] = $pass;
			$data["level"] = "1";
			//$this->db->where("mem_id","tofayel");
			$this->db->insert("member",$data);
			*/
			
			$this->db->select("*");
			$this->db->where('mem_id',$user_id);
			$this->db->where('mem_pass',$password);
			
			$query = $this->db->get('member');
			
				if ($query->num_rows() > 0)
				{
				 	foreach($query->result() as $row)
					{
						$mem_id = $row->mem_id;
						$active_date = $row->active_date;
						$end_date = $row->end_date;
						$level = $row->level;
						
					}
					if($cur > $end_date)
					{
				
					return FALSE;
					
					}
					else
					{
					$log_data = array('mem_id' => $mem_id, 'level' => $level, 'logged_in' => TRUE);
					return $log_data;
					}
					
			    }
			    else
			    {
					redirect("authentication");
			    }
		
				
     }
	 
	function check_username($str)
	{
		$this->db->select('mem_id');
		$this->db->where('mem_id', $str);
		$query = $this->db->get('member');
		
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function password_check($str)
	{
		//$mem_id = $this->session->userdata('username');
		$password = md5($str);
		$this->db->select('mem_pass');
		//$this->db->where('mem_id', $mem_id);
		$this->db->where('mem_pass', $password);
		$query = $this->db->get('member');
		
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
}
	
?>