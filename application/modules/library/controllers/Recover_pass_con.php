<?php

class Recover_pass_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('processdb');
		$this->load->helper('form');
		set_time_limit(0);
		ini_set("memory_limit","512M");
		$this->load->library('grocery_CRUD');	
		$this->load->library('session');
	}
	
	function index()
	{
		//echo $this->session->userdata('level');
		//$this->processdb->fine_cal();
		$this->load->view('member/member_home');
	}
	function recover_password()
	{
		$data['title'] = "NILG |Recover Password";
		$data['main'] = 'admin/recover_password_view';
		$this->load->view('mist',$data);
	}
	
	
	function recover_password_process()
	{
		$memid = $this->input->post('memid');
		$email = $this->input->post('email');
		$this->form_validation->set_rules('memid', 'User Name', 'callback_username_check');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			return $this->recover_password();
		}

		$member_data = $this->member_info_bymem_id($memid);
		foreach ($member_data->result() as $row)
		{	
			$first_name= $row->first_name;
			$last_name= $row->last_name;
		}
		$varification_code = $this->password_generator();
		$this->insert_varification_code($varification_code,$memid);
	
		$this->pass_recovery_email_send($first_name,$last_name,$email,$varification_code);
		
		redirect('recover_pass_con/recover_password');
	}
	
	function username_check($str)
	{		
		$email = $this->input->post('email');
		$num_row = $this->db->where('mem_id',$str)->get('member')->num_rows();
		if ($num_row >= 1)
		{
			$num_row1 = $this->db->where('mem_id',$str)->where('email',$email)->get('member')->num_rows();
			if($num_row1 >= 1)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('username_check', "Invalid Entry");
				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('username_check', "Invalid Entry");
			return FALSE;
		}
	}
	
	
	function password_generator()
  	{
		$length = 10;
		$code = "";
		$possible = "123467890abcdfghjkmnpqrtvwxyzABCDFGHJKLMNPQRTVWXYZ";
		$maxlength = strlen($possible);
		if ($length > $maxlength) {
		  $length = $maxlength;
		}
		
		$i = 0; 
		while ($i < $length) { 
		  $char = substr($possible, mt_rand(0, $maxlength-1), 1);
		  if (!strstr($code, $char)) { 
			$code .= $char;
			$i++;
		  }
	
		}
		return $code;
		$result = $this->password_existance_check($code);
		if($result == false)
		{
			$again = $this->password_generator();
			return $again;
		}
		else
		{
			return $code;
		}

  	}
	
	function password_existance_check($code)
	{
		$this->db->select('varification_code');
		$this->db->where('varification_code', $code);
		$query = $this->db->get("member");
		if($query->num_rows() > 0 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function insert_varification_code($varification_code,$memid)
	{
		$data = array(
               'varification_code' => $varification_code,
			   'varify_status' =>1
            );
		$this->db->where('mem_id',$memid);
		$this->db->update('member', $data); 
	}
	
	function pass_recovery_email_send($first_name,$last_name,$email,$varification_code)
	{
		$base_url = base_url();
		$url =$base_url."index.php/recover_pass_con/password_reset/".$varification_code;
		$from ="nilg_admin@gmail.com";
		$to = $email;
		$subject = "NILG: Reset your password";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$message =  "<html>
			<head>
			<title>NILG: Reset your password</title>
			</head>
			
			<body>
			<div align='left' style='width:800px; height:auto; overflow:hidden; padding:10px; '>
			Dear $first_name   $last_name , <br><br>
			<p>Please <a target='_blank' href='$url'>click here </a>to reset your password.</p>
			<p>Kind regards<br>
			  NILG </p>
			</div>
			</body>
			</html><br>";
		$headers .= 'From: <nilg_admin@gmail.com>' . "\r\n";
		 mail($to,$subject,$message,$headers);
	}
	
	
	function member_info_bymem_id($mem_id)
	{
		$this->db->select('first_name,last_name');
		$this->db->where('mem_id',$mem_id);
		$query = $this->db->get('member');
		return $query;
		
	}
	
	function password_reset()
	{
		
    	$vf_code['varification_code'] = $this->uri->segment(3);
		$check = $this->varificationcode_enable_check($this->uri->segment(3));
		if($check == true)
		{
			$data = array(
			   'varify_status' =>2
            );
			$this->db->where('varification_code',$this->uri->segment(3));
			$this->db->update('member', $data); 
			$this->load->view('admin/reset_password_view',$vf_code);
		}
		else
		{
			echo "Sorry!This Link use only one time.";
		}
		
	}
	
	function varificationcode_enable_check($code)
	{
		$this->db->select('varification_code');
		$this->db->where('varification_code', $code);
		$this->db->where('varify_status',"1");
		$query = $this->db->get("member");
		if($query->num_rows() == 1 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function reset_password_process()
	{
		//$forget_pass_memid = $this->session->userdata('forget_pass_memid');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]|matches[password_confirm]');
		//$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return $this->load->view('admin/reset_password_view');
		}
		$password = $this->input->post('password');
		$vfcode = $this->input->post('vf_code');
		$md_password = md5($password);
		
		$data = array(
               'mem_pass' => $md_password
            );
		$this->db->where('varification_code',$vfcode);
		$this->db->update('member', $data); 
		$this->load->view('admin/reset_password_succesfull');

	}
}