<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_con extends Backend_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) :
			redirect('login');
		endif;

        // $this->load->model('Common_model');
		$this->load->model('Search_model');
		// $this->load->model('Grid_model');
		$this->load->model('Acl_model');
		$this->load->library('grocery_CRUD');	
		// $access_level = 3;
		// $acl = $this->acl_model->acl_check($access_level);
	}

	/*
		//------------------------------------------------------------------------------------------
		// Search Setup Section
		//-------------------------------------------------------------------------------------------
	*/
	//-----------------------------------  Book  Search Start   ---------------------------------------
	function lib_output($output = null)
	{
		$this->load->view('backend/page_header', $this->data); 
		$this->load->view('admin/setup',$data['output']);
		$this->load->view('backend/page_footer');	
	}

	// Book Search 
	function book_search_view()
	{	
		$value = $this->input->post('check_key_name');
		$key = $this->input->post('radioValue');
	
		$data = array( "search_key" => $key, "search_value" => $value);
		$this->session->set_userdata($data);

		if($value && $key )
		{
			$this->data['search_query'] = $this->book_show();
		}

		// $this->load->view('search/book_search_view');
		$this->data['meta_title'] = 'বই অনুসন্ধান';
		$this->data['subview'] = 'search/book_search_view';
		$this->load->view('backend/_layout_main', $this->data);

	}

	// get book 
	function book_show()
	{

		// $this->load->view('search/book_search_view');
		$this->load->library('pagination');
		$config['base_url'] = base_url().'library/search_con/book_show/';
		$config['per_page'] = '3';
		$config['full_tag_open'] = '<div id="pagig">';
		$config['full_tag_close'] = '</div>';

		$search_query = $this->Search_model->search_book($config['per_page'],$this->uri->segment(4));

		if(is_string($search_query))
		{
			// echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('No Data Match');</SCRIPT>";
			$this->session->set_flashdata('error', 'No Data Match.');
			return false;
		}
		else
		{	
			$config['total_rows'] =  $search_query['num_rows'];
			$this->pagination->initialize($config);
			return $search_query;
		}
	}

	// book details
	function book_details()
	{
		$this->data['value'] = $this->Search_model->book_details();
		$this->data['meta_title'] = 'বই';
		$this->data['subview'] = 'search/book_details';
		$this->load->view('backend/_layout_main', $this->data);
		// $this->load->view('search/book_details',$search_query);
	}
	//-----------------------------------  Book  Search End   ---------------------------------------
	//-----------------------------------------------------------------------------------------------


	// ==========================  journal search start ==================================
	function journal_search_view()
	{
		$value = $this->input->post('check_key_name');
		$key = $this->input->post('radioValue');
		
		$data = array( "search_key" => $key, "search_value" => $value);
		$this->session->set_userdata($data);

		if($value && $key )
		{
			$this->data['search_query'] = $this->journal_show();
		}

		// $this->load->view('search/journal_search_view');
		$this->data['meta_title'] = 'জার্নাল অনুসন্ধান';
		$this->data['subview'] = 'search/journal_search_view';
		$this->load->view('backend/_layout_main', $this->data);
	}

	// get journal
	function journal_show()
	{
		// $this->load->view('search/journal_search_view');
		$this->load->library('pagination');
		$config['base_url'] = base_url().'library/search_con/journal_show/';
		$config['per_page'] = '3';
		$config['full_tag_open'] = '<div id="pagig">';
		$config['full_tag_close'] = '</div>';	
		$search_query = $this->Search_model->search_journal($config['per_page'],$this->uri->segment(4));

		if(is_string($search_query))
		{
			// echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('No Data Match');</SCRIPT>";
			$this->session->set_flashdata('error', 'No Data Match.');
			return false;
		}
		else
		{
			$config['total_rows'] =  $search_query['num_rows'];
			$this->pagination->initialize($config);
			$this->session->set_flashdata('success', '');
			return $search_query;
		}
	}

	// journal details
	function journal_details()
	{
		$this->data['value'] = $this->Search_model->journal_details();
		$this->data['meta_title'] = 'জার্নাল';
		$this->data['subview'] = 'search/journal_details';
		$this->load->view('backend/_layout_main', $this->data);
		// $this->load->view('search/journal_details',$search_query);
	}
	// ==========================  journal search end ==================================


	//====================================Start Govt. Publocation Search=================================
	//===================================================================================================
	function govt_pub_search_view()
	{
		$value = $this->input->post('check_key_name');
		$key = $this->input->post('radioValue');
	
		$data = array( "search_key" => $key, "search_value" => $value);
		$this->session->set_userdata($data);

		if($value && $key )
		{
			$this->data['search_query'] = $this->gov_pub_show();
		}

		$this->data['meta_title'] = 'সরকারি প্রকাশনা অনুসন্ধান';
		$this->data['subview'] = 'search/gov_pub_search_view';
		$this->load->view('backend/_layout_main', $this->data);

	}
	
	// get gov. pub.
	function gov_pub_show()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/search_con/gov_pub_show/';
		$config['per_page'] = '3';
		$config['full_tag_open'] = '<div id="pagig">';
		$config['full_tag_close'] = '</div>';
		$search_query = $this->Search_model->search_gov_pub($config['per_page'],$this->uri->segment(4));

		if(is_string($search_query))
		{
			// echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('No Data Match');</SCRIPT>";
			$this->session->set_flashdata('error', 'No Data Match.');
			return false;
		}
		else
		{
			$config['total_rows'] =  $search_query['num_rows'];
			$this->pagination->initialize($config);
			return $search_query;
		}
	}
	
	// gov. pub. details
	function gov_pub_details()
	{
		$this->data['value'] = $this->Search_model->gov_pub_details();
		$this->data['meta_title'] = 'সরকারি প্রকাশনা অনুসন্ধান';
		$this->data['subview'] = 'search/gov_pub_details';
		$this->load->view('backend/_layout_main', $this->data);
		// $this->load->view('search/gov_pub_details',$search_query);
	}

	// book/journal/govt.pub. booking
	function for_booking()
	{
		$search_query['value'] = $this->Search_model->for_booking();
	}










	function configuration()
	{
		// $this->load->view('form/configuration');
			$this->data['subview'] = 'search/configuration';
		
	}
	

	function book_ajaxsearch()
	{
		$searchkey = $this->input->post('check_key_name');
		$radival = $this->uri->segment(4);
		//echo $radival;
		//echo $search;
		echo $this->Processdb->getbook_search($searchkey,$radival);
	}
	
	function journal_ajaxsearch()
	{
		$searchkey = $this->input->post('check_key_name');
		$radival = $this->uri->segment(4);
		//echo $radival;
		//echo $search;
		echo $this->Processdb->getjournal_search($searchkey,$radival);
	}

}