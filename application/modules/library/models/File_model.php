<?php
class File_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
		$this->load->model('processdb');
	}

	function islamic_corner($num, $offset,$identification_id)
	{
		$this->db->select('*');
		$this->db->where('type',$identification_id); 
		$query = $this->db->get('lib_download',$num, $offset);
		$num_rows = $query->num_rows();
		//echo $offset."--".$identification_id;
		
		$this->db->where('type',$identification_id);
		$query1 = $this->db->get('lib_download');
		$num_rows1 = $query1->num_rows();
		//echo $num_rows1;
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["is_title"][]= $row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["author"][]=$row->author;
				$data["subject"][]=$row->subject;
				$edition = $row->edition;
				$edt_result = $this->processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["entry_date"][]=$row->entry_date;
				$data["type"][]=$row->type;
				$data["file"][]=$row->file;
			}
			
			$data["num_rows"]=$num_rows1;
			//print_r($data);
			return $data;
		}
		else
		{
			return "No data match";
		}
	}	
	
	function library_collection($num, $offset)
	{
		$this->db->select('*');
		$this->db->where('type',"Islamic Corner"); 
		$query = $this->db->get('lib_download',$num, $offset);
		$num_rows = $query->num_rows();
		//echo $num_rows;
		
		$this->db->where('type',"Islamic Corner");
		$query1 = $this->db->get('lib_download');
		$num_rows1 = $query1->num_rows();
		//echo $num_rows1;
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["is_title"][]= $row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["author"][]=$row->author;
				$data["subject"][]=$row->subject;
				$edition = $row->edition;
				$edt_result = $this->processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["entry_date"][]=$row->entry_date;
				$data["file"][]=$row->file;
			}
			
			$data["num_rows"]=$num_rows1;
			return $data;
		}
		else
		{
			return "No data match";
		}
	}	
}
?>