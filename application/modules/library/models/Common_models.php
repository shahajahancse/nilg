<?php
class Common_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
	}
	
	function get_page_content($id)
	 {
	 	$data = array();
		$this->db->select("*");
		$this->db->where('id',$id);
		$query = $this->db->get('lib_front_page_content');
		foreach($query->result() as $rows)
		{
			$data["content"] = $rows->content;	
			$data["image"] = $rows->image;	
		}
		return $data;
	 }
}
?>