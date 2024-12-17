<?php
class Grid_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		ini_set('date.timezone', 'Asia/Dacca');
	}
	
	function grid_mem_profile($grid_emp_id)
	{
		$this->db->select("*");
		$this->db->where_in("mem_id", $grid_emp_id);
		$this->db->from("member");
		$query = $this->db->get();
		//print_r($query->result());
		if($query->num_rows() == 0)
		{
				return "Requested list is empty";
		}
		return $query;
	}
	
	function grid_expire_issued($grid_emp_id)
	{
		$this->db->select("*");
		$this->db->where_in("mem_id", $grid_emp_id);
		$this->db->from("member");
		$query = $this->db->get();
		//print_r($query->result());
		if($query->num_rows() == 0)
		{
				return "Requested list is empty";
		}
		
		foreach($query->result() as $rows)
		{
			$mem_id = $rows->mem_id;
			$first_name = $rows->first_name;
			$mem_type_id = $rows->mem_type;
			
			$find_rules = $this->find_rules($mem_type_id);
			foreach ($find_rules->result() as $row)
			{   
				$max_day_iss = $row->mdayi;
			}
			
			$issue_details = $this->check_iss_book($mem_id);
			foreach ($issue_details->result() as $row)
			{
				$acc_no = $row->acc_no;
				$group_no = $row->group_no;
				$iss_date = $row->issued_date ;
				$book_iss_id = $row->id ;
				$date = trim(substr($iss_date,0,10));
				echo $mem_id."--".$max_day_iss."--".$acc_no."--".$date."<br>";
			}
			
				
				
		}
	}
	
	//fine calculation
	function fine_cal($grid_emp_id)
	{
		
		//$grid_emp_id = "admin123";
		//check issued book
		$query = $this->check_iss_book($grid_emp_id);
		
		if($query->num_rows() == 0)
		{
			echo "Requested list is empty";
		}
		
		foreach ($query->result() as $row)
		{
			$acc_no = $row->acc_no;
			$iss_date = $row->issued_date ;
			$book_iss_id = $row->id ;
			$date = trim(substr($iss_date,0,10));
			//echo $date;
			echo "<br />";
			
			//get the member type id
			$mem_type_id = $this->find_mem_type($grid_emp_id);
			
			//get the policies for member type id
			$find_rules = $this->find_rules($mem_type_id);
			
			if($find_rules->num_rows() == 0)
			{
				echo "Requested list is empty";
			}
			
			foreach ($find_rules->result() as $row)
			{   
				$max_day_iss = $row->mdayi;
				$daily_fine_fw = $row->dffw;
				$daily_fine_sw = $row->dfsw;
				$daily_fine_tw = $row->dftw;
				$max_day_iss = $max_day_iss - 1;
				//get the return date
				$ret_date = $this->get_ret_date($date,$max_day_iss);
				
				$cur_date = date('Y-m-d');
				if($cur_date < $ret_date)
				{
					echo "date not expired";
				}
				else
				{
					$getdays = $this->diff_date_days($ret_date,$cur_date);
					echo $getdays ;
				}
				
				// fine tester
				$first_week = 7;
				$second_week = 14;
				if($getdays <= $max_day_iss)
				{
					echo "no fine";
				}
				else
				{
					$fine = $this->fine_imposed($getdays,$daily_fine_fw,$daily_fine_sw,$daily_fine_tw);
					echo  $fine;
					$past_fine_test = $this->past_fine_test($book_iss_id);
					echo $past_fine_test;
					
					if($past_fine_test == 1)
					{
						$insert = $this->fine_data($grid_emp_id,$book_id,$book_iss_id,$iss_date,$getdays,$fine);
						$this->db->insert('fine_table', $insert); 
						echo "insert succesfull";
					}
					else
					{
						$update = $this->fine_data($grid_emp_id,$book_id,$book_iss_id,$iss_date,$getdays,$fine);
						$this->db->where('book_iss_id',$book_iss_id);
						$this->db->update('fine_table', $update);
						echo "Update succesfull"; 
					}
				}
				
			}
		}
		
	}
	function fine_data($grid_emp_id,$book_id,$book_iss_id,$iss_date,$getdays,$fine)
	{
	$cur_date = date('Y-m-d');
	$data = array(
		'mem_id' => $grid_emp_id ,
		'book_id' => $book_id ,
		'book_iss_id' => $book_iss_id,
		'issued_date' => $iss_date,
		'current_date' => $cur_date,
		'fine_day' => $getdays,
		'fine' => $fine
		);
	return $data;
	
	}
	function past_fine_test($book_iss_id)
	{
		$insert = 1;
		$this->db->where('book_iss_id',$book_iss_id);
		$query = $this->db->get('fine_table');
		if($query->num_rows() == 0)
		{
			return $insert;
		}
	
	}
	function fine_imposed($getdays,$daily_fine_fw,$daily_fine_sw,$daily_fine_tw)
	{
		$first_week = 7;
		$second_week = 14;
		if($getdays <= $first_week)
		{
			echo "first week fine";
			echo "<br />";
			$fine = $getdays * $daily_fine_fw;
		}
		
		else if ($getdays <= $second_week)
		{
			echo "2nd week fine";
			$first_week_fine = $daily_fine_fw * $first_week;
			$seccond_week_fine = $daily_fine_sw *($getdays - $first_week);
			$fine = $first_week_fine + $seccond_week_fine;
		}
		else if ($getdays > $second_week)
		{
			echo "3rd week fine";
			$first_week_fine = $daily_fine_fw * $first_week;
			$seccond_week_fine = $daily_fine_sw * $first_week;
			$third_week_fine = $daily_fine_tw *($getdays - $second_week);
			$fine = $first_week_fine + $seccond_week_fine + $third_week_fine;
		}
		return $fine;
	}
	
	function diff_date_days($start_date,$end_date)
	{
		$end_date = strtotime($end_date);
		$start_date = strtotime($start_date);
		$datediff = $end_date - $start_date;
		$days =  floor($datediff/(60*60*24));
		return $days;
	}
	
	function get_ret_date($date,$max_day_iss)
	{
	$get_ret_date = strtotime(date("Y-m-d", strtotime($date)) . " +$max_day_iss day");
	$ret_date = date('Y-m-d',$get_ret_date);
	return $ret_date ;
	
	}
	
	function find_mem_type($grid_emp_id)
	{
		$this->db->select('mem_type');
		$this->db->where_in('mem_id',$grid_emp_id);
		$query = $this->db->get('member');
		foreach ($query->result() as $row)
		{
		$mem_type_id = $row->mem_type;
		}
		//print_r($mem_type_id);
		return $mem_type_id;
	}
	
	function find_rules($mem_type_id)
	{
		$this->db->select('*');
		$this->db->where_in('id',$mem_type_id);
		$query = $this->db->get('member_type');
		return $query;
	}
	function check_iss_book($grid_emp_id)
	{
		$book_issued = "Issued";
		$this->db->select('*');
		$this->db->where_in('mem_id',$grid_emp_id);
		$this->db->where('status',$book_issued);
		$query = $this->db->get('booking');
		return $query;
	}
	function grid_inventory_report()
	{
		$this->db->select('*');
		$query = $this->db->get("library_accessories");
		foreach($query->result() as $rows)
		{
			$accessories = $rows->accessories_name;
			$total = $rows->total;
			$last_updated = $rows->last_updated;
			$remarks = $rows->remarks;
			$data["accessories"][] = $accessories;
			$data["total"][] = $total;
			$data["last_updated"][] = $last_updated;
			$data["remarks"][] = $remarks;
		}
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	
	}
	function grid_daily_status_report($year, $month, $date, $grid_emp_id,$grid_status)
	{
		$day = $year."-".$month."-".$date;
		//echo $day;
		//print_r($grid_emp_id);
		//$where ="trim(substr(issued_date ,1,10)) = '$day'";
		$status_date = "issued_date";
		if($grid_status == "Release")
		{
			$where ="trim(substr(release_date ,1,10)) = '$day'";
			$status_date = "release_date";
		}
		else if($grid_status == "Cancel")
		{
			$where ="trim(substr(cancel_date ,1,10)) = '$day'";
			$status_date = "cancel_date";
		}
		else if($grid_status == "Issued")
		{
			$where ="trim(substr(issued_date ,1,10)) = '$day'";
			$status_date = "issued_date";
		}
		
		$select = '*';
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where_in('mem_id', $grid_emp_id);
		$this->db->where('status', $grid_status);
		
		$this->db->where($where);
		$this->db->order_by('mem_id');
		$query = $this->db->get();
		//print_r($query);
		//echo $query->num_rows();
		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}
		foreach($query->result() as $rows)
		{
			$mem_id = $rows->mem_id;
			$acc_no = $rows->acc_no;
			
			if($grid_status == "Release")
			{
				$status_date = $rows->release_date;
				echo $status_date;
			}
			else if($grid_status == "Cancel")
			{
				$status_date = $rows->cancel_date;
			}
			else if ($grid_status == "Issued")
			{
				$status_date = $rows->issued_date;
			}
			$member_details = $this->member_details($mem_id);
			//echo $mem_id;
			foreach($member_details->result() as $rows)
			{
				$first_name = $rows->first_name;
				$last_name = $rows->last_name;
				$level = $rows->level;
				$group_name = $this->get_groupname($level);
				
				//echo $title;
			}
			
			//find the table
			$table_name = $this->find_table($acc_no);
			//echo $table_name;
			
			$paper_info =$this->paper_infowith_acc($acc_no,$table_name);
		
			foreach($paper_info->result() as $rows)
			{
				$subject = $rows->first_subject;
				$title = $rows->title;
			//echo $title;
			}
			$data["mem_id"][] = $mem_id;
			$data["acc_no"][] = $acc_no;
			$data["first_name"][] = $first_name;
			$data["last_name"][] = $last_name;
			$data["level"][] = $group_name;
			$data["subject"][] = $subject;
			$data["title"][] = $title;
			$data["status_date"][] = $status_date;
		}
		if(isset($data))
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function get_groupname($group_id)
	{
		$this->db->select('group_name');
		$this->db->where('id',$group_id);
		$query = $this->db->get('member_group');
		if($query->num_rows() == 0)
		{
			return "Error";
		}
		foreach($query->result() as $rows)
		{
			$group_name = $rows->group_name;
		}
		return $group_name;
	}
	
	function find_table($acc_no)
	{
		$this->db->where('acc_no', $acc_no);
		$this->db->from('lib_book');
		$table = $this->db->count_all_results();
		if($table)
		{
			$table_name = "lib_book";
		}
		$this->db->where('acc_no', $acc_no);
		$this->db->from('lib_journal');
		$table = $this->db->count_all_results();
		if($table)
		{
			$table_name = "lib_journal";
		}
		return $table_name;
	}
	
	function paper_infowith_acc($acc_no,$selected_radio)
	{
		$this->db->select('*');
		$this->db->where('acc_no',$acc_no);
		$query = $this->db->get($selected_radio);
		return $query;
	}
	
	function grid_daily_log_report($year, $month, $date)
	{
		$day = $year."-".$month."-".$date;
		//echo $day;

		$this->db->select('*');
		$this->db->from("lib_log");
		$where ="trim(substr(in_time ,1,10)) = '$day'";
		$this->db->where($where);
		$query = $this->db->get();
		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}
		foreach($query->result() as $rows)
		{
			$id_name = $rows->id_name;
			$designation = $rows->designation;
			$type = $rows->type;
			$address 	 = $rows->organizational_address ;
			$gender = $rows->gender;
			$in_time = $rows->in_time;
			$out_time = $rows->out_time;
			if($type != "visitor")
			{
				$member_details = $this->member_details($id_name);
				foreach($member_details->result() as $rows)
				{
					$designation_id = $rows->designation;
					$designation = $this->find_designation($designation_id);
				}
			}
			
			$data["id_name"][] = $id_name;
			$data["designation"][] = $designation;
			$data["type"][] = $type;
			$data["address"][] = $address;
			$data["gender"][] = $gender;
			$data["in_time"][] = $in_time;
			$data["out_time"][] = $out_time;
		}
		if(isset($data))
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	function grid_monthly_log_report($year_month)
	{		//echo $day;

		$this->db->select('*');
		$this->db->from("lib_log");
		$where ="trim(substr(in_time ,1,7)) = '$year_month'";
		$this->db->where($where);
		$query = $this->db->get();
		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}
		foreach($query->result() as $rows)
		{
			$id_name = $rows->id_name;
			$designation = $rows->designation;
			$type = $rows->type;
			$address 	 = $rows->organizational_address ;
			$gender = $rows->gender;
			$in_time = $rows->in_time;
			$out_time = $rows->out_time;
			if($type != "visitor")
			{
				$member_details = $this->member_details($id_name);
				foreach($member_details->result() as $rows)
				{
					$designation_id = $rows->designation;
					$designation = $this->find_designation($designation_id);
				}
			}
			
			$data["id_name"][] = $id_name;
			$data["designation"][] = $designation;
			$data["type"][] = $type;
			$data["address"][] = $address;
			$data["gender"][] = $gender;
			$data["in_time"][] = $in_time;
			$data["out_time"][] = $out_time;
		}
		if(isset($data))
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_monthly_status_report($year_month, $grid_memid,$grid_status)
	{
		$year= trim(substr($year_month,0,4));
		$month = trim(substr($year_month,5,2));
		$att_month = $year."-".$month;
		$status_date = "issued_date";
		$where ="trim(substr(issued_date ,1,7)) = '$att_month'";
		$select = "booking.mem_id,booking.acc_no,booking.$status_date";
		if($grid_status == "Release")
		{
			$where ="trim(substr(release_date ,1,7)) = '$att_month'";
			$status_date = "release_date";
		}
		else if($grid_status == "Cancel")
		{
			$where ="trim(substr(cancel_date ,1,7)) = '$att_month'";
			$status_date = "cancel_date";
		}
		else if($grid_status == "Issued")
		{
			$where ="trim(substr(issued_date ,1,7)) = '$att_month'";
			$status_date = "issued_date";
		}
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from("booking");
		$this->db->where_in("booking.mem_id", $grid_memid);
		$this->db->where("booking.status", $grid_status);
		
		$this->db->where($where);
		$this->db->order_by("booking.mem_id");
		$query = $this->db->get();
		//print_r($query->result_array());
		
	 	foreach ($query->result() as $id_mem)
		{
			$member_id = $id_mem->mem_id;
			$acc_no = $id_mem->acc_no;
			//echo $status_date;
			if($grid_status == "Release")
			{
				$status_date = $id_mem->release_date;
				//echo $status_date;
			}
			else if($grid_status == "Cancel")
			{
				$status_date = $id_mem->cancel_date;
			}
			else if ($grid_status == "Issued")
			{
				$status_date = $id_mem->issued_date;
			}
			//find member details
			$member_details = $this->member_details($member_id);
			foreach($member_details->result() as $rows)
			{
				$first_name = $rows->first_name;
				$last_name = $rows->last_name;
				$level = $rows->level;
				$group_name = $this->get_groupname($level);
				$designation_id = $rows->designation;
				$designation = $this->find_designation($designation_id);
			}
			//find the table
			$table_name = $this->find_table($acc_no);
			//echo $table_name;
			
			$paper_info =$this->paper_infowith_acc($acc_no,$table_name);
		
			foreach($paper_info->result() as $rows)
			{
				$subject = $rows->first_subject;
				$title = $rows->title;
			//echo $title;
			}
			
			
			$data["mem_id"][]=$member_id;
			$data["first_name"][]=$first_name;
			$data["last_name"][]=$last_name;
			$data["level"][]=$group_name;
			$data["designation"][]=$designation;
			$data["subject"][] = $subject;
			$data["title"][] = $title;
			$data["status_date"][] = $status_date;
		
	  	}
		if(isset($data))
		{
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_continuous_log_report($grid_firstdate,$grid_seconddate)
	{
		list($fdate, $fmonth, $fyear) = explode('-', trim($grid_firstdate));
		list($sdate, $smonth, $syear) = explode('-', trim($grid_seconddate));
		$fday = $fyear."-".$fmonth."-".$fdate;
		$sday = $syear."-".$smonth."-".$sdate;
		
		$this->db->select('*');
		$this->db->from("lib_log");
		//$where ="trim(substr(in_time ,1,7)) = '$year_month'";
		//$this->db->where($where);
		$this->db->where("trim(substr(in_time ,1,10)) BETWEEN '$fday' AND '$sday'");
		$query = $this->db->get();
		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}
		foreach($query->result() as $rows)
		{
			$id_name = $rows->id_name;
			$designation = $rows->designation;
			$type = $rows->type;
			$address = $rows->organizational_address ;
			$gender = $rows->gender;
			$in_time = $rows->in_time;
			$out_time = $rows->out_time;
			if($type != "visitor")
			{
				$member_details = $this->member_details($id_name);
				foreach($member_details->result() as $rows)
				{
					$designation_id = $rows->designation;
					$designation = $this->find_designation($designation_id);
				}
			}
			
			$data["id_name"][] = $id_name;
			$data["designation"][] = $designation;
			$data["type"][] = $type;
			$data["address"][] = $address;
			$data["gender"][] = $gender;
			$data["in_time"][] = $in_time;
			$data["out_time"][] = $out_time;
		}
		if(isset($data))
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_continuous_status_report($grid_firstdate,$grid_seconddate,$grid_memid,$grid_status)
	{
		//list($fdate, $fmonth, $fyear) = explode('-', trim($grid_firstdate));
		//list($sdate, $smonth, $syear) = explode('-', trim($grid_seconddate));
		$fday = date('Y-m-d', strtotime($grid_firstdate));
		$sday = date('Y-m-d', strtotime($grid_seconddate));
		//$fday = $fyear."-".$fmonth."-".$fdate;
		//$sday = $syear."-".$smonth."-".$sdate;
		$status_date = "issued_date";
		if($grid_status == "Release")
		{
			$status_date = "release_date";
		}
		else if($grid_status == "Cancel")
		{
			$status_date = "cancel_date";
		}
		$select = "booking.mem_id,booking.acc_no,booking.$status_date";
		$this->db->distinct();
		$this->db->select($select);
		$this->db->from("booking");
		$this->db->where_in("booking.mem_id", $grid_memid);
		$this->db->where("booking.status", $grid_status);
		//$where ="trim(substr(issued_date ,1,7)) = '$att_month'";
		if($grid_status == "Issued")
		{
			$this->db->where("trim(substr(issued_date ,1,10)) BETWEEN '$fday' AND '$sday'");
		}
		else if($grid_status == "Release")
		{
			$this->db->where("trim(substr(release_date ,1,10)) BETWEEN '$fday' AND '$sday'");
		}
		else if($grid_status == "Cancel")
		{
			$this->db->where("trim(substr(cancel_date ,1,10)) BETWEEN '$fday' AND '$sday'");
		}
		$this->db->order_by("booking.mem_id");
		$query = $this->db->get();
		if($query->num_rows()< 1)
		{
			return "Requested list is empty";
		}
		foreach ($query->result() as $id_mem)
		{
			$member_id = $id_mem->mem_id;
			$acc_no = $id_mem->acc_no;
			if($grid_status == "Release")
			{
				$status_date = $id_mem->release_date;
				//echo $status_date;
			}
			else if($grid_status == "Cancel")
			{
				$status_date = $id_mem->cancel_date;
			}
			else if ($grid_status == "Issued")
			{
				$status_date = $id_mem->issued_date;
			}
			//find member details
			$member_details = $this->member_details($member_id);
			foreach($member_details->result() as $rows)
			{
				$first_name = $rows->first_name;
				$last_name = $rows->last_name;
				$level = $rows->level;
				$mem_type_id = $rows->mem_type;
				$group_name = $this->get_groupname($level);
				$designation_id = $rows->designation;
				$designation = $this->find_designation($designation_id);
			}
			//find the table
			$table_name = $this->find_table($acc_no);
			//echo $table_name;
			
			$paper_info =$this->paper_infowith_acc($acc_no,$table_name);
		
			foreach($paper_info->result() as $rows)
			{
				$subject = $rows->first_subject;
				$title = $rows->title;
			//echo $title;
			}
			
			$find_rules = $this->find_rules($mem_type_id);
			foreach ($find_rules->result() as $row)
			{   
				$max_day_iss = $row->mdayi;
			}
			//echo $max_day_iss;
			
			$data["mem_id"][]=$member_id;
			$data["first_name"][]=$first_name;
			$data["last_name"][]=$last_name;
			$data["level"][]=$group_name;
			$data["designation"][]=$designation;
			$data["acc_no"][]=$acc_no;
			$data["subject"][] = $subject;
			$data["title"][] = $title;
			$data["status_date"][] = $status_date;
			$data["max_day_iss"][] = $max_day_iss;
		
	  	}
		if(isset($data))
		{
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function find_designation($designation_id)
	{
		$this->db->select('designation');
		$this->db->where('id', $designation_id);
		$query = $this->db->get("lib_designation");
		foreach($query->result() as $rows)
		{
			$designation =  $rows->designation;
		}
		return $designation;
	}
	
	
	function member_details($mem_id)
	{
		$this->db->select('*');
		$this->db->where("mem_id", $mem_id);
		$query = $this->db->get("member");
		return $query;
	}
	function book_details($acc_no)
	{
		$this->db->select('*');
		$this->db->where("acc_no", $acc_no);
		$query = $this->db->get("lib_book");
		return $query;
	}	
}
?>