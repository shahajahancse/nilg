<?php
class Processdb extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
	}
	
	function search_bookreport()
	{
		$value = $this->uri->segment(3);
		$key = $this->uri->segment(4);
		$this->db->select('*');
		//echo $value;
		//echo $key;
		if($key == "radioValue_null" || $value == "check_key_name_null")
		{
			$query = $this->db->get('lib_books');
		}
		else
		{
			$this->db->like($key,$value);
			$query = $this->db->get('lib_books');
		}	
		$num_rows = $query->num_rows();
		if($num_rows)
		{	
			foreach ($query->result() as $row)
			{		
				$data["author"][]= $row->author;
				$data["subject"][]=$row->subject;
				$data["title"][]=$row->title;
				$data["isbn"][]=$row->isbn ;
				$edition = $row->edition;
				$edt_result = $this->find_edition($edition);
				$data["edition"][]=$edt_result;
				$data["price"][]=$row->price;
				$language = $row->language;
				$lang_result = $this->find_language($language);
				$data["language"][]=$lang_result ;
				$data["year_publication"][]=$row->year_publication ;
				$source=$row->source;
				$src_result = $this->find_source($source);
				$data["source"][]=$src_result;
			}
		return $data;
		}
		else
		{
			return "No data match";
		}	
	}
	
	function find_edition($edition)
	{
		$this->db->select('edition_name');
		$this->db->where('id',$edition);
		$query = $this->db->get('lib_edition');
		foreach ($query->result() as $row)
		{
			$edt_result = $row->edition_name;
			return $edt_result;
		}
	}
	
	function find_language($language)
	{
		$this->db->select('language_name');
		$this->db->where('id',$language);
		$query = $this->db->get('lib_language');
		foreach ($query->result() as $row)
		{
			$lang_result = $row->language_name;
			return $lang_result;
		}
	}
	
	function find_source($source)
	{
		$this->db->select('source_name');
		$this->db->where('id',$source);
		$query = $this->db->get('lib_source');
		foreach ($query->result() as $row)
		{
			$src_result = $row->source_name;
			return $src_result;
		}
	}

	function idcard_grid()
	{
		$this->db->select('*');
		$this->db->from('lib_member_type');
		$query = $this->db->get();
		$data1 = array();
		$data2 = array();
		foreach ($query->result() as $row)
		{
			$data1[] = $row->id;
			$data2[] = $row->mem_name;
		}
		$mem_typ_id = implode('***', $data1);
		$mem_name = implode('***', $data2);			
		$mem_typ_id_name = "$mem_typ_id===$mem_name";
		return $mem_typ_id_name;
	}
	
	function paper_issue_db($mem_id,$group_no,$acc_no,$issue_acc_no,$paper_id)  //used for somthing issue
	{
		$issued = "Issued";
		$requesting = "Requesting";
		$user_name = $this->session->userdata('mem_id');
		$mem_type_id = $this->member_check($mem_id);
		if($issue_acc_no=="")
		{
			return "Fill in the Issue Acc No";
		}
		//check the member if he issue this 
		$existing_issue_check = $this->existing_status_check($mem_id,$issued,$group_no);
		if($existing_issue_check > 0)
		{
			return "You are already Issued this";
		}
		
		//New Acc No group no check
		$table_name = $this->find_table($acc_no);
		
		$group_no_check = $this->group_no_check($issue_acc_no,$group_no,$table_name);
		if($group_no_check == "false")
		{
			return "Invalid Barcode";
		}
		
		/*if($acc_no!=$issue_acc_no)
		{
			return "Acc No Missmatch";
		}*/
		
		$issue_acc_no_issued_check = $this->issue_acc_no_issued_check($issued,$issue_acc_no);
		if($issue_acc_no_issued_check > 0)
		{
			return "This are already Issued";
		}
		
		$issue_acc_no_request_check = $this->issue_acc_no_request_check($mem_id,$requesting,$issue_acc_no);
		if($issue_acc_no_request_check > 0)
		{
			return "This are already Requesting";
		}
		//check the member if he request this 
		$existing_request_check = $this->existing_status_check($mem_id,$requesting,$group_no);

		$query = $this->find_rules($mem_type_id);
		foreach ($query->result() as $row)
		{
			$iss_rules = $row->mbooki;
			$req_rules = $row->mbookr ;
		}

		//get number of issued	
		$no_issued = $this->status_check($mem_id,$issued);
		//get number of request	
		$no_req = $this->status_check($mem_id,$requesting);
		$total_iss_req = $no_issued + $no_req;
		//echo $no_req;
		//echo $no_issued;
		//echo $total_iss_req;
		//echo $iss_rules;
		if($total_iss_req >= $iss_rules)
		{
			//echo "not";
			return "not allow";
		}
		else if($existing_request_check > 0)
		{
			//echo "update";
			$issued_date =  date("Y-m-d H:i:s");
			$data = array(
			'acc_no' => $issue_acc_no,
			'issued_date' => $issued_date,
			'status' => $issued,
			'user_name' => $user_name,
			'sys_date' => $issued_date
			);
			
			$this->db->where('mem_id', $mem_id);
			$this->db->where('group_no', $group_no);
			$this->db->where('acc_no', $acc_no);
			$this->db->where('status', $requesting);
			$this->db->update('lib_booking', $data);
			return "suceessfully Issued";
		}
		else
		{
			$issued_date =  date("Y-m-d H:i:s");
			$data = array(
			'mem_id' => $mem_id,
			'group_no' => $group_no,
			'acc_no' => $acc_no,
			'issued_date' => $issued_date,
			'status' => $issued,
			'paper_id' => $paper_id,
			'user_name' => $user_name,
			'sys_date' => $issued_date
			);
			
			$this->db->insert('lib_booking', $data);
			return "suceessfully Issued"; 
		}
	}
	
	function req_cancel($mem_id,$group_no,$acc_no)
	{
		$cancel = "Cancel";
		$requesting = "Requesting";
		$user_name = $this->session->userdata('mem_id');
		
		
			$cancel_date =  date("Y-m-d H:i:s");
			$data = array(
			'mem_id' => $mem_id,
			'group_no' => $group_no,
			'acc_no' => $acc_no,
			'cancel_date' => $cancel_date,
			'status' => $cancel,
			'user_name' => $user_name,
			'sys_date' => $cancel_date,
			);
			//echo $mem_id;
			$this->db->where('mem_id', $mem_id);
			$this->db->where('group_no', $group_no);
			$this->db->where('acc_no', $acc_no);
			$this->db->where('status', $requesting);
			$this->db->update('lib_booking', $data);
			return "suceessfully Cancel"; 
		
	}
	
	function available_accno($booking_acc_no,$group_no,$table)
	{
		if($table == "lib_book" || $table == "lib_gov_publicaton")
		{
			$group_name = "isbn";
		}
		else if($table == "lib_journal")
		{
			$group_name = "issn";
		}
		$this->db->select_min('acc_no');
		$this->db->where($group_name,$group_no);
		$this->db->where_not_in('acc_no', $booking_acc_no);
		$query = $this->db->get($table);
		foreach ($query->result() as $row)
		{
			$data = $row->acc_no;
		}
		return $data;
	}
	
	function booking_acc_no($mem_id,$group_no)
	{
		$this->db->where('mem_id',$mem_id);
		$this->db->where('group_no',$group_no);
		$query = $this->db->get('lib_booking');
		$data = array();
		foreach ($query->result() as $row)
		{
			$data[] = $row->acc_no;
			
		}
		return $data;
	
	}
	
	function existing_status_check($mem_id,$status,$isbn_or_issn)
	{
		//echo $isbn_or_issn;
		$this->db->where('group_no',$isbn_or_issn);
		$this->db->where('mem_id',$mem_id);
		$this->db->where('status',$status);
		$this->db->from('lib_booking');
		$status =  $this->db->count_all_results();
		return $status;
	}
	
	function issue_acc_no_request_check($mem_id,$status,$issue_acc_no)
	{
		//echo $isbn_or_issn;
		$this->db->where_not_in('mem_id',$mem_id);
		$this->db->where('acc_no',$issue_acc_no);
		$this->db->where('status',$status);
		$this->db->from('lib_booking');
		$status =  $this->db->count_all_results();
		return $status;
	}
	
	function issue_acc_no_issued_check($status,$issue_acc_no)
	{
		//echo $isbn_or_issn;
		$this->db->where('acc_no',$issue_acc_no);
		$this->db->where('status',$status);
		$this->db->from('lib_booking');
		$status =  $this->db->count_all_results();
		return $status;
	}
	
	
	function find_rules($mem_type_id)
	{
		$this->db->select('*');
		$this->db->where('id',$mem_type_id);
		$query = $this->db->get('lib_member_type');
		return $query;
	}
	function member_check($mem_id)
	{
		$this->db->select('mem_type');
		$this->db->where('mem_id',$mem_id);
		$query = $this->db->get('lib_member');
		foreach ($query->result() as $row)
		{
			$mem_type_id = $row->mem_type;
		}
		return $mem_type_id;
	}

	function status_check($mem_id,$status)
	{
		//$mem_id = $this->session->userdata('mem_id');
		$this->db->where('mem_id',$mem_id);
		$this->db->where('status',$status);
		$this->db->from('lib_booking');
		$no_status =  $this->db->count_all_results();
		return $no_status;
	}
	function check_iss_book()
	{
		$mem_id = $this->session->userdata('mem_id');
		$book_issued = "Issued";
		$this->db->select('*');
		$this->db->where('mem_id',$mem_id);
		$this->db->where('status',$book_issued);
		$query = $this->db->get('lib_booking');
		return $query;
	}
	
	function renew_paper($mem_id,$acc_no,$book_iss_id,$fine_receipt_no,$paper_id)
	{
		$group_no = $this->input->post('group_no');
		//echo $call_no;
		$this->release_paper($mem_id,$acc_no,$book_iss_id,$fine_receipt_no);
		$renewed = $this->paper_issue_db($mem_id,$group_no,$acc_no,$acc_no,$paper_id);
		return $renewed;
	}
	function release_paper($mem_id,$acc_no,$book_iss_id,$fine_receipt_no)
	{
		//$query = $this->check_issued_book($mem_id,$acc_no);
			$release = "Release";
			$issued = "Issued";
			$release_date =  date("Y-m-d H:i:s");
			$user_name = $this->session->userdata('mem_id');
			if($fine_receipt_no != null)
			{
				//echo $fine_receipt_no."hello";
				//fine receipt check
				$fine_rcpt_check = $this->fine_receipt_check($fine_receipt_no);
				if($fine_rcpt_check->num_rows() > 0)
				{
					return "You Enter Duplicate Receipt No";
				}
				
				$fine_data = array(
				'fine_received_date' => date("Y-m-d H:i:s"),
				'fine_recetpt_no' => $fine_receipt_no
				);
				$this->db->where('mem_id', $mem_id);
				$this->db->where('acc_no', $acc_no);
				$this->db->where('book_iss_id', $book_iss_id);
				$this->db->update('lib_fine_table', $fine_data);
			}
			$data = array(
			'release_date' => $release_date,
			'status' => $release,
			'user_name' => $user_name,
			'sys_date' => $release_date
			);
			
			$this->db->where('mem_id', $mem_id);
			//$this->db->where('acc_no', $acc_no);
			$this->db->where('id', $book_iss_id);
			$this->db->where('status', $issued);
			$this->db->update('lib_booking', $data);
			return "Successfully Release";
			
	}
	function fine_receipt_check($fine_receipt_no)
	{
		$this->db->select('*');
		$this->db->where('fine_recetpt_no',$fine_receipt_no);
		$query = $this->db->get('fine_table');
		return $query;
	}
	
	function manual_issue() //this function only used for  checki the issued view loaded, not for issue
	{
	/* 1. check member. if true then get member data.
	2. check accession no  and take call no
	3. check if the memeber issue this book past(note. amember only issue one call no. if true then return message) 
	4. check if this book already issued or requesting*/
	 $mem_id = $this->input->post('mem_id');
	 $acc_no = $this->input->post('acc_no');
	 $selected_radio = $this->input->post('radioValue');
	// $is_no = "jj";
	 if($selected_radio == "lib_book")
	 {
	 	//echo "book";
		$is_no = "isbn";
		$data["paper_id"] = "1";
	 }
	 else if ($selected_radio == "lib_journal")
	 {
	 	//echo "journal";
		$is_no ="issn";
		$data["paper_id"] = "2";
	 }

	 //member transactional and personal info and member validation check
	 $mem_data = $this->member_info($mem_id);
	 
		if($mem_data->num_rows() == 0) //member validity check
		 {
			return "Member not found";
		 }
		 
		foreach ($mem_data->result() as $row)
		{
			$f_name = $row->first_name ;
			$l_name = $row->last_name ;
		}
		$data["f_name"] =$f_name ;
		$data["l_name"] =$l_name ;
	 
		$release = "Release";
		$request = "Requesting"; 
		$issued = "Issued";
		$data["trans_request"] = $this->trans_data($mem_id,$request);
		$data["trans_issued"] = $this->trans_data($mem_id,$issued);
		
	//find call no and accession no validation check
	//$call_no = $this->call_no($acc_no,$selected_radio);
	$isbn_or_issn = $this->isbn_or_issn($acc_no,$selected_radio,$is_no);

		if($isbn_or_issn =="Invalid Acc no") //accession no validity check
		{
			return "Invalid Barcode";
		}
		$data["group_no"] = $isbn_or_issn;
		$this->db->where("$is_no",$isbn_or_issn);
		$this->db->from($selected_radio);
		$no_copy =  $this->db->count_all_results();
	//echo $isbn_or_issn ;
	//return;
	//check the member if he issue this book
	$mem_issue_paper =$this->existing_status_check($mem_id,$issued,$isbn_or_issn);
		if($mem_issue_paper > 0)
		{
			//echo "issued";
			return "You are already Issued this";
		}
		
	//accession number requesting and issued check	
	$request = "Requesting";
	$no_of_acc_request = $this->no_of_acc_status($acc_no,$request);
		if($no_of_acc_request->num_rows() > 0) //accession no check by request in booking table
		 {
			//echo "request";
			return "This is Already Requesting";
		 }
	$issued = "Issued";
	$no_of_acc_issued = $this->no_of_acc_status($acc_no,$issued);
		if($no_of_acc_issued->num_rows() > 0) //accession no check by issue in booking table
		 {
			//echo "issued";
			return "This Book Already Issued";
		 }
		 
	
	//book info
	 $paper_data = $this->paper_info($isbn_or_issn,$selected_radio);
			foreach ($paper_data->result() as $row)
			{	
				$subject=$row->first_subject;
				$title=$row->title;
			}
			$data["subject"] =$subject ;
			$data["title"] =$title ;
			$data["copy_no"] =$no_copy ;
		
			$no_iss = $this->book_iss_req($isbn_or_issn,$issued);
			$no_req = $this->book_iss_req($isbn_or_issn,$request);
			$available = ($no_copy-1) - ($no_iss + $no_req);
			$data["available"] = $available ;
			$data["transfer"] ="transfer" ;
			return $data;
	}
	//status check by requesting or issued or cancel
	function no_of_acc_status($acc_no,$status)
	{
		$this->db->select('*');
		$this->db->where('acc_no',$acc_no);
		$this->db->where('status',$status);
		$query = $this->db->get('lib_booking');
		return $query;
	}
	function paper_info($isbn_or_issn,$selected_radio)
	{
		$this->db->select('*');
	if($selected_radio == "lib_book")
	 {
		$is_no = "isbn";
	 }
	 else if ($selected_radio == "lib_journal")
	 {
		$is_no ="issn";
	 }
		$this->db->where($is_no,$isbn_or_issn);
		$query = $this->db->get($selected_radio);
		return $query;
	}
	
	function call_no($acc_no,$selected_radio)
	{
		$this->db->select('call_no');
		$this->db->where('acc_no',$acc_no);
		$query = $this->db->get($selected_radio);
		if($query->num_rows())
		{
			foreach ($query->result() as $row)
			{	
				$call_no = $row->call_no;
			}
			return $call_no;
		}
		else
		{
		 return "Invalid Acc no";
		}
		
	}
	
	function isbn_or_issn($acc_no,$selected_radio,$is_no)
	{
		$this->db->select('*');
		$this->db->where('acc_no',$acc_no);
		$query = $this->db->get($selected_radio);
		if($query->num_rows())
		{
			foreach ($query->result() as $row)
			{	
				$is_no = $row->$is_no;
			}
			return $is_no;
		}
		else
		{
		 return "Invalid Acc no";
		}
		
	}
	
	
	function book_iss_req($isbn_or_issn,$book_text)
	{
			$this->db->where('group_no',$isbn_or_issn);
			$this->db->where('status',$book_text);
			$this->db->from('lib_booking');
			$book_text =  $this->db->count_all_results();
			return $book_text;
	}
	
	function book_info($call_no)
	{
		$this->db->select('*');
		$this->db->where('call_no',$call_no);
		$query = $this->db->get('lib_book');
		return $query;
	}
	
	function trans_data($mem_id,$trans_request)
	{
	 $this->db->select('*')->from('booking')->where('mem_id', $mem_id)->where('status', $trans_request);
	 $trans_request = $this->db->get();
	 if($trans_request->num_rows())
	 {
	 return $trans_request->num_rows();
	 }
	 else
	 {
	 return 0;
	 }
	}
	
	function member_info($mem_id)
	{
	 $this->db->select('*')->from('lib_member')->where('mem_id', $mem_id);
	 $mem_info = $this->db->get();
	 return $mem_info;
	}
	
	function send_mail($mem_id,$call_no)
	{
		$member_info = $this->member_info($mem_id);
		foreach ($member_info->result() as $row)
		{
			$f_name = $row->first_name ;
			$l_name = $row->last_name ;
		$email = $row->email ;
		}
			$book_info =$this-> book_info($call_no);
			foreach ($book_info->result() as $row)
		{	
			$author = $row->first_author;
			$subject=$row->first_subject;
			$title=$row->title;
		}
		echo $f_name." ".$email." ".$subject;
		$from ="admin@gmail.com";
		echo "<br/>";
		$to = $email;
		$subject = "Test mail";
		$message = "Hello! This is a simple email message.";
		$from = "someonelse@example.com";
		$headers = "From:" . $from;
		mail($to,$subject,$message,$headers);
		echo "Mail Sent.";
	}
	
	//renew and fine calculation
	function fine_calc()
	{
		$mem_id = $this->input->post('mem_id');
		$acc_no = $this->input->post('acc_no');
		$selected_radio = $this->input->post('radioValue');
		//echo $mem_id;
		
		//member id validity check
		$mem_data = $this->member_info($mem_id);
		if($mem_data->num_rows() == 0) //member validity check
		 {
			return "Member not found";
		 }
		 
		
		if($selected_radio == "lib_book")
	 	{
	 	//echo "book";
			$is_no = "isbn";
	 	}
	 	else if ($selected_radio == "lib_journal")
	 	{
	 	//echo "journal";
			$is_no ="issn";
	 	}
		
		$isbn_or_issn = $this->isbn_or_issn($acc_no,$selected_radio,$is_no);

		if($isbn_or_issn =="Invalid Acc no") //accession no validity check
		{
			return "Invalid Barcode";
		}
		
		$query = $this->check_issued_book($mem_id,$acc_no);
		if($query->num_rows() == 0)
		{
			return "This is not your issued paper";
		}

		foreach ($query->result() as $row)
		{	
			//$id = $row->id;
			$iss_date = $row->issued_date;
			$iss_id = $row->id ;
			$group_no = $row->group_no ;
			$paper_id = $row->paper_id ;
			
			$date = trim(substr($iss_date,0,10));
			//echo $date;
			//echo "<br />";
			//get the member type id
			$mem_type_id = $this->member_check($mem_id);
			//echo $mem_type_id;
			
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
				//get the actual return date
				$ret_date = $this->get_ret_date($date,$max_day_iss);
				
				$cur_date = date('Y-m-d');
				if($cur_date < $ret_date)
				{
					$data["id"]=$iss_id;
					$data["memid"]=$mem_id;
					$data["acc_no"] = $acc_no;
					$data["group_no"]=$group_no;
					$data["iss_date"]=$date;
					$data["paper_id"]=$paper_id;
					return $data;
				}
				else
				{
					$getdays = $this->diff_date_days($ret_date,$cur_date);
					//echo $getdays ;
			
					// fine tester
					$first_week = 7;
					$second_week = 14;
					$fine = $this->fine_imposed($getdays,$daily_fine_fw,$daily_fine_sw,$daily_fine_tw);
					//echo  $fine;
					$past_fine_test = $this->past_fine_test($iss_id);
					//echo $past_fine_test;
					
					if($past_fine_test == 1)//1 for insert
					{
						$insert = $this->fine_data($mem_id,$acc_no,$group_no,$iss_id,$iss_date,$getdays,$fine);
						$this->db->insert('lib_fine_table', $insert); 
						//echo "insert succesfull";
					}
					else
					{
						$update = $this->fine_data($mem_id,$acc_no,$group_no,$iss_id,$iss_date,$getdays,$fine);
						$this->db->where('book_iss_id',$iss_id);
						$this->db->update('lib_fine_table', $update);
						//echo "Update succesfull"; 
					}
					$data["id"]=$iss_id;
					$data["memid"]=$mem_id;
					$data["group_no"]=$group_no;
					$data["getdays"]=$getdays;
					$data["iss_date"]=$date;
					$data["fine"]=$fine;
					$data["paper_id"]=$paper_id;
					return $data;
				}
			}
		}
	}
	
	function check_issued_book($mem_id,$acc_no)
	{
		$book_issued = "Issued";
		$this->db->select('*');
		$this->db->where('mem_id',$mem_id);
		$this->db->where('acc_no',$acc_no);
		$this->db->where('status',$book_issued);
		$query = $this->db->get('lib_booking');
		return $query;
	}
	
	function get_ret_date($date,$max_day_iss)
	{
		$get_ret_date = strtotime(date("Y-m-d", strtotime($date)) . " +$max_day_iss day");
		$ret_date = date('Y-m-d',$get_ret_date);
		return $ret_date ;
	}
	
	function diff_date_days($start_date,$end_date)
	{
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		$datediff = $end_date - $start_date;
		$days =  floor($datediff/(60*60*24));
		return $days;
	}
	
	function all_request_list()
	{
		$book_request = "Requesting";
		$table_book = "lib_booking";
		$query = $this->collect_list($book_request,$table_book);
		foreach ($query->result() as $row)
		{ 
			$mem_id = $row->mem_id;
			$group_no = $row->group_no;
			$acc_no = $row->acc_no;
			$requesting_date = $row->requesting_date;
			$paper_id = $row->paper_id;
			//echo $mem_id;
			//echo "</br>"; 
			$member_info = $this->member_info($mem_id);
			foreach ($member_info->result() as $row)
			{
				$f_name = $row->first_name ;
				$l_name = $row->last_name ;
			}
			
			
			//find the table
			$table_name = $this->find_table($acc_no);
		
			$paper_info =$this->paper_infowith_acc($acc_no,$table_name);
			foreach ($paper_info->result() as $row)
			{
				/*$author = $row->first_author;*/
				$subject=$row->first_subject;
				$title=$row->title;
				$call_no=$row->call_no;
			}
		
			$data["mem_id"][] =$mem_id ;
			$data["group_no"][] =$group_no;
			$data["acc_no"][] =$acc_no ;
			$data["f_name"][] =$f_name ;
			$data["l_name"][] =$l_name ;
			$data["requesting_date"][] =$requesting_date;
			$data["subject"][] =$subject;
			$data["call_no"][] =$call_no ;
			$data["title"][] =$title ;
			$data["paper_id"][] =$paper_id ;
		}
		if(isset($data))
		{
		return $data;
		}
		
	}
	function collect_list($status,$table_name)
	{
		$this->db->select('*');
		$this->db->where('status',$status);
		$query = $this->db->get($table_name);
		return $query ;
	}
	
	function barcode_generator_db()
	{
		$acc_first 	= $this->input->post('acc_first');
		$acc_last	= $this->input->post('acc_last');
		$radioValue	= $this->input->post('radioValue');
		
			$where = "acc_no BETWEEN $acc_first and $acc_last";
			$this->db->select('acc_no');
			$this->db->where($where);
			$query = $this->db->get($radioValue);
			//echo $this->db->last_query();
			if($query->num_rows > 0)
			{
				//echo "valid";
				$data1 = array();
				foreach ($query->result() as $row)
				{
					$data1[] = $row->acc_no;
				}
				
				
				$data1 = implode("==",$data1);
				$data2 = $query->num_rows;
				echo "$data1***$data2";
			}
			else
			{
				echo "not exist";
			}
	
	}
	
	function find_designation($designation_id)
	{
		$this->db->select('designation');
		$this->db->where('id',$designation_id);
		$query = $this->db->get('lib_designation');
		foreach ($query->result() as $row)
		{
			$designation_name = $row->designation;
			return $designation_name;
		}
		
	}
	function collectpaper_list($status,$table_name,$mem_id)
	{
		$this->db->select('*');
		$this->db->where('status',$status);
		$this->db->where('mem_id',$mem_id);
		$query = $this->db->get($table_name);
		return $query ;
	}
	function paper_infowith_acc($acc_no,$selected_radio)
	{
		$this->db->select('*');
		$this->db->where('acc_no',$acc_no);
		$query = $this->db->get($selected_radio);
		return $query;
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
		$this->db->where('acc_no', $acc_no);
		$this->db->from('lib_gov_publicaton');
		$table = $this->db->count_all_results();
		if($table)
		{
			$table_name = "lib_gov_publicaton";
		}
		
		$this->db->where('acc_no', $acc_no);
		$this->db->from('lib_report');
		$table = $this->db->count_all_results();
		if($table)
		{
			$table_name = "lib_report";
		}
		return $table_name;
	}
	
	function member_paper_status()
	{
		$mem_id= $this->session->userdata('mem_id');
		$request = "Requesting";
		$requestins_sts= $this->member_status($mem_id,$request);
		$issued = "Issued";
		$issued_sts = $this->member_status($mem_id,$issued);
		if($issued_sts->num_rows())
		{
			foreach ($issued_sts->result() as $row)
			{
				$acc_no = $row->acc_no;
				$table_name = $this->find_table($acc_no);
				$paper_info =$this->paper_infowith_acc($acc_no,$table_name);
				foreach ($paper_info->result() as $row)
				{
						$title = $row->title ;
						$first_subject = $row->first_subject ;
						$paper_image = $row->image ;
						//echo $paper_image;
				}
				//$data["call_no"][] =$call_no;
				$data["acc_no"][] =$acc_no;
				$data["title"][] =$title ;
				$data["first_subject"][] =$first_subject ;
				$data["image"][] =$paper_image ;
				
			}
		}
		$data['requestins_sts'] = $requestins_sts;
		
		return $data;
	}
	
	function member_status($mem_id,$status)
	{
		$this->db->select('*')->from('lib_booking')->where('mem_id', $mem_id)->where('status', $status);
		$query = $this->db->get();
		return $query;
		
	}
	
	function getbook_search($searchkey,$radival)
	{
		$this->db->like($radival,$searchkey);
		$this->db->group_by($radival); 
		$query = $this->db->get('lib_book');
		if ($query->num_rows() > 0) {
			$output = '<ul>';
			foreach ($query->result() as $publication_info) {
					$output .= '<li>' . $publication_info->$radival . '</li>';
			}
			$output .= '</ul>';
			return $output;
		} else {
			return '<p>Sorry, no results returned.</p>';
		}
	}
	
	function getjournal_search($searchkey,$radival)
	{
		$this->db->like($radival,$searchkey);
		$this->db->group_by($radival); 
		$query = $this->db->get('lib_journal');
		if ($query->num_rows() > 0) {
			$output = '<ul>';
			foreach ($query->result() as $publication_info) {
					$output .= '<li>' . $publication_info->$radival . '</li>';
			}
			$output .= '</ul>';
			return $output;
		} else {
			return '<p>Sorry, no results returned.</p>';
		}
	}
	//=====================================Fine Function ===========================================
	//==============================================================================================
	function all_fine_calc()
	{
		//echo "hello";
		$book_issued = 'Issued';
		$this->db->select('*');
		$this->db->where('status',$book_issued);
		$query = $this->db->get('lib_booking');
		foreach ($query->result() as $row)
		{	
			$book_iss_id = $row->id;
			$mem_id = $row->mem_id;
			$group_no = $row->group_no;
			$acc_no = $row->acc_no;
			$iss_date = $row->issued_date;
			$date = trim(substr($iss_date,0,10));
			
			//get the member type id
			$mem_type_id = $this->member_check($mem_id);
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
					//echo "hello";
					break;
				}
				else
				{
					$getdays = $this->diff_date_days($ret_date,$cur_date);
					//echo $getdays ;
			
					// fine tester
					$first_week = 7;
					$second_week = 14;
					$fine = $this->fine_imposed($getdays,$daily_fine_fw,$daily_fine_sw,$daily_fine_tw);
					//echo  $fine;
					$past_fine_test = $this->past_fine_test($book_iss_id);
					//echo $past_fine_test;
					
					if($past_fine_test == 1)//1 for insert
					{
						$insert = $this->fine_data($mem_id,$acc_no,$group_no,$book_iss_id,$iss_date,$getdays,$fine);
						$this->db->insert('lib_fine_table', $insert); 
						//echo "insert succesfull";
					}
					else
					{
						$update = $this->fine_data($mem_id,$acc_no,$group_no,$book_iss_id,$iss_date,$getdays,$fine);
						$this->db->where('book_iss_id',$book_iss_id);
						$this->db->update('lib_fine_table', $update);
						//echo "Update succesfull"; 
					}
					
					//$mail = $this->send_mail($mem_id,$call_no);
				
				}
			}
		}
	}
	
	function fine_imposed($getdays,$daily_fine_fw,$daily_fine_sw,$daily_fine_tw)
	{
		$first_week = 7;
		$second_week = 14;
		if($getdays <= $first_week)
		{
			//echo "first week fine";
			//echo "<br />";
			$fine = $getdays * $daily_fine_fw;
		}
		
		else if ($getdays <= $second_week)
		{
			//echo "2nd week fine";
			$first_week_fine = $daily_fine_fw * $first_week;
			$seccond_week_fine = $daily_fine_sw *($getdays - $first_week);
			$fine = $first_week_fine + $seccond_week_fine;
		}
		else if ($getdays > $second_week)
		{
			//echo "3rd week fine";
			$first_week_fine = $daily_fine_fw * $first_week;
			$seccond_week_fine = $daily_fine_sw * $first_week;
			$third_week_fine = $daily_fine_tw *($getdays - $second_week);
			$fine = $first_week_fine + $seccond_week_fine + $third_week_fine;
		}
		return $fine;
	}
	
	function fine_data($grid_emp_id,$acc_no,$group_no,$book_iss_id,$iss_date,$getdays,$fine)
	{
	$cur_date = date('Y-m-d');
	$data = array(
		'mem_id' => $grid_emp_id ,
		'acc_no' => $acc_no ,
		'group_no' => $group_no ,
		'book_iss_id' => $book_iss_id,
		'issued_date' => $iss_date,
		'current_date' => $cur_date,
		'fine_day' => $getdays,
		'fine' => $fine,
		'fine_recetpt_no' => 0
		);
	return $data;
	
	}
	function past_fine_test($book_iss_id)
	{
		$insert = 1;
		$this->db->where('book_iss_id',$book_iss_id);
		$query = $this->db->get('lib_fine_table');
		if($query->num_rows() == 0)
		{
			return $insert;
		}
	
	}
	function fine_reportdb()
	{
		$this->db->select('*');
		$this->db->where('fine_recetpt_no',0);
		$query = $this->db->get('lib_fine_table');
		foreach ($query->result() as $row)
		{
			$mem_id = $row->mem_id ;
			$acc_no = $row->acc_no ;
			$issued_date = $row->issued_date ;
			$fine_day  = $row->fine_day  ;
			$fine = $row->fine ;
			//echo $title;
			$data["mem_id"][] =$mem_id;
			$data["acc_no"][] =$acc_no;
			$data["issued_date"][] =$issued_date ;
			$data["fine_day"][] =$fine_day ;
			$data["fine"][] =$fine ;
		}
		
		if(isset($data))
		{
			return $data;
		}
		else
		{
		 	echo "Requested List is empty";
		}
	}
	
	function ongoing_request()
	{
		$mem_id 	= $this->input->post('mem_id');
		//$radioValue	= $this->input->post('radioValue');
		//echo $mem_id." ".$radioValue;
		$mem_data = $this->member_info($mem_id);
		if($mem_data->num_rows())
		{
			foreach ($mem_data->result() as $row)
			{
				$f_name = $row->first_name ;
				$l_name = $row->last_name ;
				$designation_id = $row->designation;
				$designation = $this->find_designation($designation_id);
				$email = $row->email ;
				$mem_image = $row->image ;
			}
			$data["f_name"] =$f_name ;
			$data["l_name"] =$l_name ;
			$data["email"] =$email ;
			$data["designation"] =$designation ;
			$data["image"] =$mem_image ;
			$book_request = "Requesting";
			$table_book = "lib_booking";
			$query = $this->collectpaper_list($book_request,$table_book,$mem_id);
			if($query->num_rows()==0)
			{
				return "No Requesting Book";
			}
			foreach ($query->result() as $row)
			{ 
				$acc_no = $row->acc_no;
				$group_no = $row->group_no;
				$requesting_date = $row->requesting_date;
				$paper_id = $row->paper_id;
				//find the table
				$table_name = $this->find_table($acc_no);
			
				$paper_info =$this->paper_infowith_acc($acc_no,$table_name);
				foreach ($paper_info->result() as $row)
				{
					$title = $row->title ;
					$first_subject = $row->first_subject ;
					$paper_image = $row->image ;
					//echo $title;
				}
				$data["group_no"][] =$group_no;
				$data["acc_no"][] =$acc_no;
				$data["title"][] =$title ;
				$data["first_subject"][] =$first_subject ;
				$data["paper_image"][] =$paper_image ;
				$data["paper_id"][] =$paper_id ;
			}
			return $data;
		}
		else
		{
			return "not exists";
		}
	}
	
	function group_no_check($issue_acc_no,$group_no,$table_name)
	{
		if($table_name == "lib_book")
	 	{
	 	//echo "book";
			$is_no = "isbn";
	 	}
	 	else if ($table_name == "lib_journal")
	 	{
	 	//echo "journal";
			$is_no ="issn";
	 	}
		$this->db->select('*');
		$this->db->where('acc_no',$issue_acc_no);
		$this->db->where($is_no,$group_no);
		$query = $this->db->get($table_name);
		$num_rows = $query->num_rows();
		if($num_rows>0)
		{
			return "true";	
		}
		else
		{
			return "false";
		}
	}
}
?>