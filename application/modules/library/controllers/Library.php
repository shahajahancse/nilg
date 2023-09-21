<?php

class Library extends CI_Controller {

	function Library()
	{
		parent::__construct();
		ini_set('date.timezone', 'Asia/Dacca');
		$this->load->model('Processdb');
		$this->load->model('Search_model');
		$this->load->model('Common_model');
		$this->load->model('File_model');
		$this->load->helper(array('form', 'url', 'email'));
	}
	
	function index()
	{
		$data['title'] = "Welcome to Library";
		$data['main'] = 'mist_lib';
		$this->load->view('mist',$data);
	}
	
	function search_all()
	{
		$data['title'] = "Welcome to Search option";
		$data['main'] = 'search';
		$this->load->view('mist',$data);
	}
		
	
	
	function facilities()
	{
		$data['title'] = "Library Facilities";
		$data['main'] = 'facilities';
		$this->load->view('mist',$data);
	}
	
	function hours()
	{
		$data['title'] = "Library Operating Hours";
		$data['main'] = 'Operating_hours';
		$this->load->view('mist',$data);
	}
	
	function rules()
	{
		$data['title'] = "Library Rules & Regulation";
		$data['main'] = 'rules_regulation';
		$this->load->view('mist',$data);
	}
	function login()
	{
		$data['title'] = "NILG Library| Login ";
		$data['main'] = 'admin/login';
		$this->load->view('mist',$data);
	}
	
	function ask_librarian()
	{
		$data['title'] = "NILG Library| Ask Librarian ";
		$data['main'] = 'ask_librarian';
		$this->load->view('mist',$data);
	}
	function exchange_programme()
	{
		$data['title'] = "NILG Library| Exchange Programme";
		$data['main'] = 'exchange_programme';
		$this->load->view('mist',$data);
	}
	//======================Font Desk Digital Collection========================
	//==========================================================================
	function download()
	{
		$identification_id = $this->uri->segment(3);
		$this->session->set_userdata('identification_id',$identification_id);
		redirect("library/library_download");
		
	}
	function library_download()
	{
		$identification_id = $this->session->userdata('identification_id');
		
		$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/library_download/';
				$config['per_page'] = '3';
				$config['full_tag_open'] = '<div class="pagig_download">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->file_model->islamic_corner($config['per_page'],$this->uri->segment(3),$identification_id);
			
			if($data == "No data match")
			{
				$data1['type'] = $identification_id ;
				$data1['msg'] = "No Data Match";
				$data1['title'] = "NILG Library| Digital Collectio";
				$data1['main'] = 'digital_collection/islamic_corner';
				$this->load->view('mist',$data1);
			}
			else
			{
				$data['type'] = $identification_id ;
				$data['msg'] = "Data Match";
				$config['total_rows'] =  $data['num_rows'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Digital Collection";
				$data['main'] = 'digital_collection/islamic_corner';
				$this->load->view('mist',$data);
			}
	}
	
	
	
	//======================Font Desk Book Search===============================
	//==========================================================================
	function book_search()
	{
		$data['title'] = "NILG Library| Book Search ";
		$data['main'] = 'search/front_search/front_book_search_type_view';
		$this->load->view('mist',$data);
	}
	
	function book_guided_search()
	{
		$data['title'] = "NILG Library| Book Search ";
		$data['main'] = 'search/front_search/front_book_search_type_view';
		$data['guide_search'] = "guide";
		$this->load->view('mist',$data);
	}
	
	
	function book_guided_search_view_all()
	{
			$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/book_guided_search_view_all/';
				$config['per_page'] = '12';
				$config['full_tag_open'] = '<div id="pagig2">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->search_model->book_guided_search_view_all($config['per_page'],$this->uri->segment(3));
			if($data == "no data match")
			{
		
				$data1['msg'] = "No Data Match";
				$data1['guide_search'] = "guide";
				$data1['title'] = "NILG Library| Book Search ";
				$data1['main'] = "search/front_search/front_book_search_type_view";
				$this->load->view('mist',$data1);
			
			}
			else
			{
				$config['total_rows'] =  $data['num_rows1'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Book Search ";
				$data['main'] = 'search/front_search/front_book_show_all';
				$this->load->view('mist',$data);
			}
	}
	
	
	function book_keywords_search_view_all()
	{
			$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/book_keywords_search_view_all/';
				$config['per_page'] = '12';
				$config['full_tag_open'] = '<div id="pagig2">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->search_model->book_keywords_search_view_all($config['per_page'],$this->uri->segment(3));
			if($data == "no data match")
			{
		
				$data1['msg'] = "No Data Match";
				$data1['title'] = "NILG Library| Book Search ";
				$data1['main'] = "search/front_search/front_book_search_type_view";
				$this->load->view('mist',$data1);
			
			}
			else
			{
				
				$config['total_rows'] =  $data['num_rows1'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Book Search ";
				$data['main'] = 'search/front_search/front_book_show_all';
				$this->load->view('mist',$data);
			}
	}
	
	function book_details_all()
	{
		$data['value'] = $this->search_model->book_details();
		$data['title'] = "NILG Library| Book Details";
		$data['main'] = 'search/front_search/front_book_details_all';
		$this->load->view('mist',$data);
	}
	
	//======================End Font Desk Book Search===============================
	//==============================================================================
	
	
	//======================Font Desk Journal Search================================
	//==============================================================================
	function journal_search()
	{
		$data['title'] = "NILG Library| Journal Search ";
		$data['main'] = 'search/front_search/front_journal_search_type_view';
		$this->load->view('mist',$data);
	}
	function journal_guided_search()
	{
		$data['title'] = "NILG Library| Journal Search ";
		$data['main'] = 'search/front_search/front_journal_search_type_view';
		$data['guide_search'] = "guide";
		$this->load->view('mist',$data);
	}
	function journal_keywords_search_view_all()
	{
			$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/journal_keywords_search_view_all/';
				$config['per_page'] = '12';
				$config['full_tag_open'] = '<div id="pagig2">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->search_model->journal_keywords_search_view_all($config['per_page'],$this->uri->segment(3));
			if($data == "no data match")
			{
		
				$data1['msg'] = "No Data Match";
				$data1['title'] = "NILG Library| Journal Search ";
				$data1['main'] = "search/front_search/front_journal_search_type_view";
				$this->load->view('mist',$data1);
			
			}
			else
			{
				
				$config['total_rows'] =  $data['num_rows1'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Journal Search ";
				$data['main'] = 'search/front_search/front_journal_show_all';
				$this->load->view('mist',$data);
			}
	}
	
	function journal_guided_search_view_all()
	{
			$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/journal_guided_search_view_all/';
				$config['per_page'] = '12';
				$config['full_tag_open'] = '<div id="pagig2">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->search_model->journal_guided_search_view_all($config['per_page'],$this->uri->segment(3));
			if($data == "no data match")
			{
		
				$data1['msg'] = "No Data Match";
				$data1['guide_search'] = "guide";
				$data1['title'] = "NILG Library| Journal Search ";
				$data1['main'] = "search/front_search/front_journal_search_type_view";
				$this->load->view('mist',$data1);
			
			}
			else
			{
				$config['total_rows'] =  $data['num_rows1'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Journal Search ";
				$data['main'] = 'search/front_search/front_journal_show_all';
				$this->load->view('mist',$data);
			}
	}
	function journal_details_all()
	{
		$data['value'] = $this->search_model->journal_details();
		$data['title'] = "NILG Library| Journal Details";
		$data['main'] = 'search/front_search/front_journal_details_all';
		$this->load->view('mist',$data);
	}
	//======================End Font Desk Journal Search================================
	//==================================================================================
	
	//======================Font Desk Govt. Publication Search===============================
	//==========================================================================
	function gov_pub_search()
	{
		$data['title'] = "NILG Library| Govt. Publication Search";
		$data['main'] = 'search/front_search/front_gov_pub_search_type_view';
		$this->load->view('mist',$data);
	}
	
	function gov_pub_guided_search()
	{
		$data['title'] = "NILG Library| Govt. Publication Search";
		$data['main'] = 'search/front_search/front_gov_pub_search_type_view';
		$data['guide_search'] = "guide";
		$this->load->view('mist',$data);
	}
	
	
	function gov_pub_guided_search_view_all()
	{
			$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/gov_pub_guided_search_view_all/';
				$config['per_page'] = '12';
				$config['full_tag_open'] = '<div id="pagig2">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->search_model->gov_pub_guided_search_view_all($config['per_page'],$this->uri->segment(3));
			if($data == "no data match")
			{
		
				$data1['msg'] = "No Data Match";
				$data1['guide_search'] = "guide";
				$data1['title'] = "NILG Library| Govt. Publication Search";
				$data1['main'] = "search/front_search/front_gov_pub_search_type_view";
				$this->load->view('mist',$data1);
			
			}
			else
			{
				$config['total_rows'] =  $data['num_rows1'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Govt. Publication Search";
				$data['main'] = 'search/front_search/front_gov_pub_show_all';
				$this->load->view('mist',$data);
			}
	}
	
	
	function gov_pub_keywords_search_view_all()
	{
			$this->load->library('pagination');
				$config['base_url'] = base_url().'index.php/library/gov_pub_keywords_search_view_all/';
				$config['per_page'] = '12';
				$config['full_tag_open'] = '<div id="pagig2">';
				$config['full_tag_close'] = '</div>';
				
			$data = $this->search_model->gov_pub_keywords_search_view_all($config['per_page'],$this->uri->segment(3));
			if($data == "no data match")
			{
		
				$data1['msg'] = "No Data Match";
				$data1['title'] = "NILG Library| Govt. Publication Search";
				$data1['main'] = "search/front_search/front_gov_pub_search_type_view";
				$this->load->view('mist',$data1);
			
			}
			else
			{
				
				$config['total_rows'] =  $data['num_rows1'];
				$this->pagination->initialize($config);
				$data['title'] = "NILG Library| Govt. Publication Search";
				$data['main'] = 'search/front_search/front_gov_pub_show_all';
				$this->load->view('mist',$data);
			}
	}
	
	function gov_pub_details_all()
	{
		$data['value'] = $this->search_model->gov_pub_details();
		$data['title'] = "NILG Library| Govt. Publication Details";
		$data['main'] = 'search/front_search/front_gov_pub_details_all';
		$this->load->view('mist',$data);
	}
	
	//======================End Font Desk Book Search===============================
	//==============================================================================
	
	function digital_collecttion()
	{
		$data['title'] = "NILG Library| Digital Collecttion ";
		$data['main'] = 'digital_coll';
		$this->load->view('mist',$data);
	}
	
	function important_libraries()
	{
		$data['title'] = "NILG Library| Important Libraries ";
		$data['main'] = 'important_lib';
		$this->load->view('mist',$data);
	}
	function visit_us()
	{
		$data['title'] = "NILG Library| Visit Us";
		$data['main'] = 'visit_us';
		$this->load->view('mist',$data);
	}
	
	function library_galance()
	{
		$data['title'] = "NILG Library| About Library ";
		$data['main'] = 'about_lib/lib_galance';
		$this->load->view('mist',$data);
	}
	
	function lib_membership()
	{
		$data['title'] = "NILG Library| Library Membership ";
		$data['main'] = 'about_lib/membership_lib';
		$this->load->view('mist',$data);
	}
	
	function lib_rules()
	{
		$data['title'] = "NILG Library| Library Rules ";
		$data['main'] = 'about_lib/lib_rules';
		$this->load->view('mist',$data);
	}
	
	function book_arrang()
	{
		$data['title'] = "NILG Library| Book Arrangement ";
		$data['main'] = 'about_lib/book_arran';
		$this->load->view('mist',$data);
	}
	
	function stack_room()
	{
		$data['title'] = "NILG Library| Stack Room ";
		$data['main'] = 'about_lib/stack_room';
		$this->load->view('mist',$data);
	}
	
	function opening_hours()
	{
		$data['title'] = "NILG Library| Opening Hpors ";
		$data['main'] = 'about_lib/opening_hours';
		$this->load->view('mist',$data);
	}
	
	
	function floor_area()
	{
		$data['title'] = "NILG Library| Floor Area ";
		$data['main'] = 'about_lib/floor_area';
		$this->load->view('mist',$data);
	}
	
	function page()
	{
		$data['title'] = "NILG Library| Page ";
		$data['main'] = 'about_lib/page';
		$this->load->view('mist',$data);
	}
	
	function admin_mng()
	{
		$data['title'] = "NILG Library|Administration and  Management";
		$data['main'] = 'about_lib/admin_mng';
		$this->load->view('mist',$data);
	}
	
	function collection()
	{
		$data['title'] = "NILG Library|Collection";
		$data['main'] = 'about_lib/collection';
		$this->load->view('mist',$data);
	}
	function section_procurement()
	{
		$data['title'] = "NILG Library|Section & Procurement";
		$data['main'] = 'about_lib/section_procurement';
		$this->load->view('mist',$data);
	}
	function arrangement()
	{
		$data['title'] = "NILG Library|Arrangement";
		$data['main'] = 'about_lib/arrangement';
		$this->load->view('mist',$data);
	}
	function services()
	{
		$data['title'] = "NILG Library|Services";
		$data['main'] = 'about_lib/services';
		$this->load->view('mist',$data);
	}
	
	function personnel_dictionary()
	{
		$data['title'] = "NILG Library|Personnel Dictionary";
		$data['main'] = 'personnel_dictionary';
		$this->load->view('mist',$data);
	}
	function users()
	{
		$data['title'] = "NILG Library|Users";
		$data['main'] = 'about_lib/users';
		$this->load->view('mist',$data);
	}
	
	function others_link()
	{
		$data['title'] = "NILG Library|Others Link";
		$data['main'] = 'about_lib/others_link';
		$this->load->view('mist',$data);
	}
}



/* End of file Library.php */
/* Location: ./system/application/controllers/Library.php */