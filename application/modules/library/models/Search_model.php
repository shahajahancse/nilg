<?php
class Search_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
		$this->load->model('Processdb');
	}

	function search_book($num, $offset)
	{
		$value =$this->session->userdata('search_value');
		$key = $this->session->userdata('search_key');
		//echo $value;
		
		$this->db->select('*');
		$this->db->like($key,$value);
		$this->db->group_by("title"); 
		$query = $this->db->get('lib_book',$num, $offset);
		$num_rows = $query->num_rows();
		//echo $num_rows;
		
		
		$this->db->like($key,$value);
		$this->db->group_by("title"); 
		$query1 = $this->db->get('lib_book');
		$num_rows1 = $query1->num_rows();
	
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["isbn"][]=$row->isbn;
				$data["language"][]=$row->language;
				$data["first_author"][]=$row->first_author;
				$data["snd_author"][]=$row->snd_author;
				$data["editor"][]=$row->editor;
				$data["compiler"][]=$row->compiler;
				$data["title"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["series"][]=$row->series;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows1;
			return $data;
		}
		else
		{
			return "No data match";
		}
	}	
	
	function search_journal($num, $offset)
	{
		$value =$this->session->userdata('search_value');
		$key = $this->session->userdata('search_key');
		//echo $value;
		
		$this->db->select('*');
		$this->db->like($key,$value);
		$this->db->group_by("title"); 
		$query = $this->db->get('lib_journal',$num, $offset);
		$num_rows = $query->num_rows();
		//echo $num_rows;
	
		if($num_rows > 0)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["issn"][]=$row->issn;
				$data["language"][]=$row->language;
				$data["trans_co_author"][]=$row->trans_co_author;
				$data["title"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["volume"][]=$row->volume;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}

			$this->db->like($key,$value);
			$this->db->group_by("title"); 
			$query1 = $this->db->get('lib_journal');
			$num_rows1 = $query1->num_rows();

			$data["num_rows"]=$num_rows1;
			return $data;
		}
		else
		{
			return "No data match";
		}
	}
	function search_gov_pub($num, $offset)
	{
		$value =$this->session->userdata('search_value');
		$key = $this->session->userdata('search_key');
		//echo $value;
		
		$this->db->select('*');
		$this->db->like($key,$value);
		$this->db->group_by("title"); 
		$query = $this->db->get('lib_gov_publicaton',$num, $offset);
		$num_rows = $query->num_rows();
		//echo $num_rows;
		
		
		$this->db->like($key,$value);
		$this->db->group_by("title"); 
		$query1 = $this->db->get('lib_gov_publicaton');
		$num_rows1 = $query1->num_rows();
	
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["isbn"][]=$row->isbn;
				$data["language"][]=$row->language;
				$data["first_author"][]=$row->first_author;
				$data["snd_author"][]=$row->snd_author;
				$data["editor"][]=$row->editor;
				$data["compiler"][]=$row->compiler;
				$data["title"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["translator"][]=$row->translator;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows1;
			return $data;
		}
		else
		{
			return "No data match";
		}
	}		
	
	function book_details()
	{
		$value = $this->uri->segment(4);
		
		$this->db->select('*');
		$this->db->where('isbn',$value);
		$query = $this->db->get('lib_book');
		//echo $value."--".$query->num_rows();
		foreach ($query->result() as $row)
		{	
				$data["id"]= $row->id;
				$data["acc_no"]= $row->acc_no;
				$data["date_of_entry"]=$row->date_of_entry;
				$data["call_no"]=$row->call_no;
				$data["isbn"]=$row->isbn;
				$data["language"]=$row->language;
				$data["first_author"]=$row->first_author;
				$data["snd_author"]=$row->snd_author;
				$data["editor"]=$row->editor;
				$data["compiler"]=$row->compiler;
				$data["title"]=$row->title;
				$data["subtitle"]=$row->subtitle;
				$data["first_subject"]=$row->first_subject;
				$data["snd_subject"]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"]=$src_result;
				$data["place"]=$row->place;
				$data["publisher"]=$row->publisher;
				$data["y_of_pub"]=$row->y_of_pub;
				$data["series"]=$row->series;
				$data["cd"]=$row->cd;
				$data["currency"]=$row->currency;
				$data["price"]=$row->price;
				$data["image"]=$row->image;
		}
		return $data;	
	}
	
	function journal_details()
	{
		$value = $this->uri->segment(4);
		$this->db->select('*');
		$this->db->where('issn',$value);
		$query = $this->db->get('lib_journal');

		foreach ($query->result() as $row)
		{	
			$data["id"]= $row->id;
				$data["acc_no"]= $row->acc_no;
				$data["date_of_entry"]=$row->date_of_entry;
				$data["call_no"]=$row->call_no;
				$data["issn"]=$row->issn;
				$data["language"]=$row->language;
				$data["title"]=$row->title;
				$data["subtitle"]=$row->subtitle;
				$data["first_subject"]=$row->first_subject;
				$data["snd_subject"]=$row->snd_subject;
				$data["trans_co_author"]=$row->trans_co_author;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"]=$src_result;
				$data["place"]=$row->place;
				$data["publisher"]=$row->publisher;
				$data["y_of_pub"]=$row->y_of_pub;
				$data["volume"]=$row->volume;
				$data["cd"]=$row->cd;
				$data["currency"]=$row->currency;
				$data["price"]=$row->price;
				$data["image"]=$row->image;
		}
		return $data;	
	}
	
	function gov_pub_details()
	{
		$value = $this->uri->segment(4);
		$this->db->select('*');
		$this->db->where('isbn',$value);
		$query = $this->db->get('lib_gov_publicaton');

		foreach ($query->result() as $row)
		{	
				$data["id"]= $row->id;
				$data["acc_no"]= $row->acc_no;
				$data["date_of_entry"]=$row->date_of_entry;
				$data["call_no"]=$row->call_no;
				$data["isbn"]=$row->isbn;
				$data["language"]=$row->language;
				$data["first_author"]=$row->first_author;
				$data["snd_author"]=$row->snd_author;
				$data["editor"]=$row->editor;
				$data["compiler"]=$row->compiler;
				$data["title"]=$row->title;
				$data["subtitle"]=$row->subtitle;
				$data["first_subject"]=$row->first_subject;
				$data["snd_subject"]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"]=$src_result;
				$data["place"]=$row->place;
				$data["publisher"]=$row->publisher;
				$data["y_of_pub"]=$row->y_of_pub;
				$data["translator"]=$row->translator;
				$data["cd"]=$row->cd;
				$data["currency"]=$row->currency;
				$data["price"]=$row->price;
				$data["image"]=$row->image;
		}
		return $data;	
	}
	function for_booking()
	{
		$group_no = $this->input->post('group_no');
		$table = $this->input->post('table');
		$paper_id = $this->input->post('paper_id');
		$mem_id = $this->session->userdata('mem_id');

		$requesting = "Requesting";	
		$issued = "Issued";	
		$mem_type_id = $this->Processdb->member_check($mem_id);
		$existing_issue_check = $this->Processdb->existing_status_check($mem_id,$issued,$group_no);
		if($existing_issue_check > 0)
		{
			echo "You are already Issued this";
			return;
		}

		$existing_request_check = $this->Processdb->existing_status_check($mem_id,$requesting,$group_no);
		if($existing_request_check > 0)
		{
			echo "You are already Request this";
			return;
		}

		//find rules
		$query = $this->Processdb->find_rules($mem_type_id);
		$iss_rules = $query->row()->mbooki;
		$req_rules = $query->row()->mbookr ;

		
		//get number of request	
		$book_issued = "Issued";	
		$no_issued = $this->Processdb->status_check($mem_id,$book_issued);
		//get number of request
		$book_req = "Requesting";	
		$no_req = $this->Processdb->status_check($mem_id,$book_req);
		$total_iss_req = $no_issued + $no_req;
		//echo $total_iss_req;
		if($total_iss_req >= $iss_rules)
		{
			echo "Not allow";
			return;
		}
		else
		{
			$requesting_date =  date("Y-m-d H:i:s");
			//collect acc no which are booked by member from booking table
			$booking_acc_no = $this->Processdb->booking_acc_no($mem_id,$group_no);
			$no_booking_acc_no = count($booking_acc_no);
			
			if($no_booking_acc_no == 0)
			{
			 	$booking_acc_no = 0;
			}
			//collect available acc no
			$available_accno = $this->Processdb->available_accno($booking_acc_no,$group_no,$table);

			$data = array(
			'mem_id' => $mem_id,
			'acc_no' => $available_accno,
			'group_no' => $group_no,
			'requesting_date' => $requesting_date,
			'status' => $requesting,
			'paper_id' => $paper_id
			);
			
			$this->db->insert('lib_booking', $data);
			echo "Suceessfully Booking"; 
			return;
		}
	}
	//======================Front Desk Search========================================
	//===============================================================================
	function book_guided_search_view_all($num, $offset)
	{
		$title			= $this->input->post('title');
		$first_author 	= $this->input->post('first_author');
		//$edition 		= $this->input->post('edition');
		$year 			= $this->input->post('year');
		$publisher 		= $this->input->post('publisher');
		$isbn 			= $this->input->post('isbn');
		$subject 		= $this->input->post('subject');
		$place 		= $this->input->post('place');
		
		//echo $title;
		
		$this->db->select('*');
		if($title)
		{
			$this->db->like('title',$title);
		}
		if($first_author)
		{
			$this->db->like('first_author', $first_author);
		}
		if($place)
		{
			$this->db->like('place', $place);
		}
		if($year)
		{
			$this->db->like('y_of_pub', $year);
		}
		if($publisher)
		{
			$this->db->like('publisher', $publisher);
		}
		if($isbn)
		{
			$this->db->like('isbn', $isbn);
		}
		if($subject)
		{
			$this->db->like('first_subject', $subject);
			$this->db->or_like('snd_subject',$subject);
			$this->db->or_like('thrd_subject',$subject);
			$this->db->or_like('forth_subject',$subject);
			$this->db->or_like('fifth_subject',$subject);
		}
		$this->db->group_by("isbn"); 
		$query = $this->db->get('lib_book',$num, $offset);
		$num_rows = $query->num_rows();
		
		
		
		if($title)
		{
			$this->db->like('title',$title);
		}
		if($first_author)
		{
			$this->db->like('first_author', $first_author);
		}
		if($place)
		{
			$this->db->like('place', $place);
		}
		if($year)
		{
			$this->db->like('y_of_pub', $year);
		}
		if($publisher)
		{
			$this->db->like('publisher', $publisher);
		}
		if($isbn)
		{
			$this->db->like('isbn', $isbn);
		}
		if($subject)
		{
			$this->db->like('first_subject', $subject);
			$this->db->or_like('snd_subject',$subject);
			$this->db->or_like('thrd_subject',$subject);
			$this->db->or_like('forth_subject',$subject);
			$this->db->or_like('fifth_subject',$subject);
		}
		$this->db->group_by("isbn");  
		$query1 = $this->db->get('lib_book');
		$num_rows1 = $query1->num_rows();
		
		
		//echo $num_rows ;
		
		
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["isbn"][]=$row->isbn;
				$data["language"][]=$row->language;
				$data["first_author"][]=$row->first_author;
				$data["snd_author"][]=$row->snd_author;
				$data["editor"][]=$row->editor;
				$data["compiler"][]=$row->compiler;
				$data["btitle"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["series"][]=$row->series;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows;
			$data["num_rows1"]=$num_rows1;
			$data["search_type"]="guided";
			return $data;
		}
		else
		{
			return "no data match";
		}
	}
	
	function book_keywords_search_view_all($num, $offset)
	{
		$keywords	= $this->input->post('keywords');

		
		//echo $title;
		
		$this->db->select('*');
		if($keywords)
		{
			$this->db->like('acc_no',$keywords);
			$this->db->or_like('date_of_entry',$keywords);
			$this->db->or_like('call_no',$keywords);
			$this->db->or_like('isbn',$keywords);
			$this->db->or_like('language',$keywords);
			$this->db->or_like('first_author',$keywords);
			$this->db->or_like('snd_author',$keywords);
			$this->db->or_like('thrd_author',$keywords);
			$this->db->or_like('editor',$keywords);
			$this->db->or_like('compiler',$keywords);
			$this->db->or_like('title',$keywords);
			
			
			$this->db->or_like('subtitle',$keywords);
			$this->db->or_like('first_subject',$keywords);
			$this->db->or_like('snd_subject',$keywords);
			$this->db->or_like('thrd_subject',$keywords);
			$this->db->or_like('forth_subject',$keywords);
			$this->db->or_like('fifth_subject',$keywords);
			$this->db->or_like('publisher',$keywords);
			//$this->db->or_like('y_of_pub',$keywords);
			
			
			
		}
		$this->db->group_by("isbn"); 
		$query = $this->db->get('lib_book',$num, $offset);
		$num_rows = $query->num_rows();
		
		
		
		if($keywords)
		{
			$this->db->like('acc_no',$keywords);
			$this->db->or_like('date_of_entry',$keywords);
			$this->db->or_like('call_no',$keywords);
			$this->db->or_like('isbn',$keywords);
			$this->db->or_like('language',$keywords);
			$this->db->or_like('first_author',$keywords);
			$this->db->or_like('snd_author',$keywords);
			$this->db->or_like('thrd_author',$keywords);
			$this->db->or_like('editor',$keywords);
			$this->db->or_like('compiler',$keywords);
			$this->db->or_like('title',$keywords);
			
			
			$this->db->or_like('subtitle',$keywords);
			$this->db->or_like('first_subject',$keywords);
			$this->db->or_like('snd_subject',$keywords);
			$this->db->or_like('thrd_subject',$keywords);
			$this->db->or_like('forth_subject',$keywords);
			$this->db->or_like('fifth_subject',$keywords);
			$this->db->or_like('publisher',$keywords);
			
			//$acc_first_old = $this->db->where("id",$id)->get('lib_book')->row()->acc_first;
			
			//$this->db->or_like('y_of_pub',$keywords);
		}
		
		$this->db->group_by("isbn");  
		$query1 = $this->db->get('lib_book');
		$num_rows1 = $query1->num_rows();
		
		
		//echo $num_rows ;
		
		
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]				= $row->id;
				$data["acc_no"][]			= $row->acc_no;
				$data["date_of_entry"][]	= $row->date_of_entry;
				$data["call_no"][]			= $row->call_no;
				$data["isbn"][]				= $row->isbn;
				$data["language"][]			= $row->language;
				$data["first_author"][]		= $row->first_author;
				$data["snd_author"][]		= $row->snd_author;
				$data["editor"][]			= $row->editor;
				$data["compiler"][]			= $row->compiler;
				$data["btitle"][]			= $row->title;
				$data["subtitle"][]			= $row->subtitle;
				$data["first_subject"][]	= $row->first_subject;
				$data["snd_subject"][]		= $row->snd_subject;
				$edition 					= $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["series"][]=$row->series;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows;
			$data["num_rows1"]=$num_rows1;
			$data["search_type"]="keywords";
			return $data;
		}
		else
		{
			return "no data match";
		}
	}
	
	function journal_keywords_search_view_all($num, $offset)
	{
		$keywords	= $this->input->post('keywords');

		
		//echo $title;
		
		$this->db->select('*');
		if($keywords)
		{
			$this->db->like('title',$keywords);
		}
		$this->db->group_by("issn"); 
		$query = $this->db->get('lib_journal',$num, $offset);
		$num_rows = $query->num_rows();
		
		
		
		if($keywords)
		{
			$this->db->like('title',$keywords);
		}
		
		$this->db->group_by("issn"); 
		$query1 = $this->db->get('lib_journal');
		$num_rows1 = $query1->num_rows();
		
		
		//echo $num_rows ;
		
		
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["issn"][]=$row->issn;
				$data["language"][]=$row->language;
				$data["trans_co_author"][]=$row->trans_co_author;
				$data["jtitle"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["volume"][]=$row->volume;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows;
			$data["num_rows1"]=$num_rows1;
			$data["search_type"]="keywords";
			return $data;
		}
		else
		{
			return "no data match";
		}
	}
	
	function journal_guided_search_view_all($num, $offset)
	{
		$title			= $this->input->post('title');
		$trans_co_author 	= $this->input->post('trans_co_author');
		$year 			= $this->input->post('year');
		$publisher 		= $this->input->post('publisher');
		$issn 			= $this->input->post('issn');
		$subject 		= $this->input->post('subject');
		
		
		//echo $title;
		
		$this->db->select('*');
		if($title)
		{
			$this->db->like('title',$title);
		}
		if($trans_co_author)
		{
			$this->db->like('trans_co_author', $trans_co_author);
		}
		if($year)
		{
			$this->db->like('y_of_pub', $year);
		}
		if($publisher)
		{
			$this->db->like('publisher', $publisher);
		}
		if($issn)
		{
			$this->db->like('issn', $issn);
		}
		if($subject)
		{
			$this->db->like('first_subject', $subject);
		}
		$this->db->group_by("issn"); ; 
		$query = $this->db->get('lib_journal',$num, $offset);
		$num_rows = $query->num_rows();
		
		
		
		if($title)
		{
			$this->db->like('title',$title);
		}
		if($trans_co_author)
		{
			$this->db->like('trans_co_author', $trans_co_author);
		}
		if($year)
		{
			$this->db->like('y_of_pub', $year);
		}
		if($publisher)
		{
			$this->db->like('publisher', $publisher);
		}
		if($issn)
		{
			$this->db->like('issn', $issn);
		}
		if($subject)
		{
			$this->db->like('first_subject', $subject);
		}
		$this->db->group_by("issn"); 
		$query1 = $this->db->get('lib_journal');
		$num_rows1 = $query1->num_rows();
		
		//echo $num_rows ;
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["issn"][]=$row->issn;
				$data["language"][]=$row->language;
				$data["trans_co_author"][]=$row->trans_co_author;
				$data["jtitle"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["volume"][]=$row->volume;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows;
			$data["num_rows1"]=$num_rows1;
			$data["search_type"]="guided";
			return $data;
		}
		else
		{
			return "no data match";
		}
	}
	
	function gov_pub_keywords_search_view_all($num, $offset)
	{
		$keywords	= $this->input->post('keywords');

		
		//echo $title;
		
		$this->db->select('*');
		if($keywords)
		{
			$this->db->like('title',$keywords);
		}
		$this->db->group_by("isbn"); 
		$query = $this->db->get('lib_gov_publicaton',$num, $offset);
		$num_rows = $query->num_rows();
		
		
		
		if($keywords)
		{
			$this->db->like('title',$keywords);
		}
		
		$this->db->group_by("isbn");  
		$query1 = $this->db->get('lib_gov_publicaton');
		$num_rows1 = $query1->num_rows();
		
		
		//echo $num_rows ;
		
		
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["isbn"][]=$row->isbn;
				$data["language"][]=$row->language;
				$data["first_author"][]=$row->first_author;
				$data["snd_author"][]=$row->snd_author;
				$data["editor"][]=$row->editor;
				$data["compiler"][]=$row->compiler;
				$data["btitle"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["translator"][]=$row->translator;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows;
			$data["num_rows1"]=$num_rows1;
			$data["search_type"]="keywords";
			return $data;
		}
		else
		{
			return "no data match";
		}
	}
	
	function gov_pub_guided_search_view_all($num, $offset)
	{
		$title			= $this->input->post('title');
		$first_author 	= $this->input->post('first_author');
		//$edition 		= $this->input->post('edition');
		$year 			= $this->input->post('year');
		$publisher 		= $this->input->post('publisher');
		$isbn 			= $this->input->post('isbn');
		$subject 		= $this->input->post('subject');
		$place 		= $this->input->post('place');
		
		//echo $title;
		
		$this->db->select('*');
		if($title)
		{
			$this->db->like('title',$title);
		}
		if($first_author)
		{
			$this->db->like('first_author', $first_author);
		}
		if($place)
		{
			$this->db->like('place', $place);
		}
		if($year)
		{
			$this->db->like('y_of_pub', $year);
		}
		if($publisher)
		{
			$this->db->like('publisher', $publisher);
		}
		if($isbn)
		{
			$this->db->like('isbn', $isbn);
		}
		if($subject)
		{
			$this->db->like('first_subject', $subject);
		}
		$this->db->group_by("isbn"); 
		$query = $this->db->get('lib_gov_publicaton',$num, $offset);
		$num_rows = $query->num_rows();
		
		
		
		if($title)
		{
			$this->db->like('title',$title);
		}
		if($first_author)
		{
			$this->db->like('first_author', $first_author);
		}
		if($place)
		{
			$this->db->like('place', $place);
		}
		if($year)
		{
			$this->db->like('y_of_pub', $year);
		}
		if($publisher)
		{
			$this->db->like('publisher', $publisher);
		}
		if($isbn)
		{
			$this->db->like('isbn', $isbn);
		}
		if($subject)
		{
			$this->db->like('first_subject', $subject);
		}
		$this->db->group_by("isbn");  
		$query1 = $this->db->get('lib_gov_publicaton');
		$num_rows1 = $query1->num_rows();
		
		
		//echo $num_rows ;
		
		
		if($num_rows)
		{
			foreach ($query->result() as $row)
			{	
				$data["id"][]= $row->id;
				$data["acc_no"][]= $row->acc_no;
				$data["date_of_entry"][]=$row->date_of_entry;
				$data["call_no"][]=$row->call_no;
				$data["isbn"][]=$row->isbn;
				$data["language"][]=$row->language;
				$data["first_author"][]=$row->first_author;
				$data["snd_author"][]=$row->snd_author;
				$data["editor"][]=$row->editor;
				$data["compiler"][]=$row->compiler;
				$data["btitle"][]=$row->title;
				$data["subtitle"][]=$row->subtitle;
				$data["first_subject"][]=$row->first_subject;
				$data["snd_subject"][]=$row->snd_subject;
				$edition = $row->edition;
				$edt_result = $this->Processdb->find_edition($edition);
				$data["edition"][]=$edt_result;
				$source=$row->source;
				$src_result = $this->Processdb->find_source($source);
				$data["source"][]=$src_result;
				$data["place"][]=$row->place;
				$data["publisher"][]=$row->publisher;
				$data["y_of_pub"][]=$row->y_of_pub;
				$data["translator"][]=$row->translator;
				$data["cd"][]=$row->cd;
				$data["currency"][]=$row->currency;
				$data["price"][]=$row->price;
				$data["image"][]=$row->image;
			}
			//print_r($data);
			$data["num_rows"]=$num_rows;
			$data["num_rows1"]=$num_rows1;
			$data["search_type"]="guided";
			return $data;
		}
		else
		{
			return "no data match";
		}
	}

}
?>