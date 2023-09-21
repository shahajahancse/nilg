<?php
class Acl_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
	}
	
	
	
	function acl_check($access_level)
	{
		$group_id = $this->session->userdata('level');
		$acl = $this->get_acl_list($group_id);
		if(in_array($access_level,$acl))
		{
			return true;
		}
		else
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
			exit;
		}
	}
	
	/*function get_user_id($username)
	{
		$this->db->select("id");
		$this->db->where('id_number ',$username);
		$query = $this->db->get('members');
		$row = $query->row();
		return $user_id = $row->id;
	}*/
	
	function get_acl_list($group_id)
	 {
	 	$data = array();
		$this->db->select("acl_id");
		$this->db->where('group_id',$group_id);
		$query = $this->db->get('member_acl_level');
		foreach($query->result() as $rows)
		{
			$data[] = $rows->acl_id;	
		}
		return $data;
	 }
}
?>