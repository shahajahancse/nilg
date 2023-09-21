<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_con_all extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('processdb');
		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */	
		$this->load->model('acl_model');
		$this->load->library('grocery_CRUD');	
	}
	
	function lib_output($output = null)
	{
		$this->load->view('admin/setup.php',$output);	
	}
	
	
	
	function search_book_all()
	{
		$search_key=$this->input->post('search_key');
		$radio=$this->input->post('radio');
		
		$this->db->select('*');
		if($radio == "isbn")
		{
			$this->db->like('isbn', $search_key);
		}
		else if ($radio == "title")
		{
			$this->db->like('title', $search_key);
		}
		else if ($radio == "publisher")
		{
			$this->db->like('publisher', $search_key);
		}
		else if ($radio == "first_author")
		{
			$this->db->like('first_author', $search_key);
		}
		else if ($radio == "first_subject")
		{
			$this->db->like('first_subject', $search_key);
		}
		else if ($radio == "snd_subject")
		{
			$this->db->like('snd_subject', $search_key);
		}
		$this->db->group_by('isbn');
		$query = $this->db->get('lib_book');
		
		
		echo "<html><head>
			<script type='text/javascript' src='<?php echo base_url();?>js/dynamic.js'></script>
			</head>
			<body>
			<table width='50%'  class='sal' cellpadding='1' bordercolor='black'; border='1' cellspacing='0' align='center' style='font-size:14px; text-align:center;color:white; background:#DDDDDD;border:2px solid black;border-collapse:collapse;'>
			<tr style='height:30px;' >
			<th width='10%' style='background:black'>ISBN</th>
			<th width='15%' style='background:black'>Title</th>
			<th width='15%' style='background:black'>Subject</th>
			<th width='10%'style='background:black'>Author</th>   
			</tr>";
			foreach($query->result() as $rows)
			{
				
				echo "<tr  style='color:#000011;font-size:13px'>
				<td><a  style='text-decoration:none;' href='index.php/search_con_all/book_details/$rows->isbn'>$rows->isbn</td>
				<td>$rows->title</td>
				<td>$rows->first_subject</td>
				<td>$rows->first_author</td>";
				echo "</tr>";
			}
			echo "</table></body></html>";
	}
	
	function book_details()
	{
		$search_query['value'] = $this->processdb->book_details();
		$search_query['title'] = "Library book details";
		$search_query['main'] = 'search/book_details_all';
		$this->load->view('mist',$search_query);
	}
}