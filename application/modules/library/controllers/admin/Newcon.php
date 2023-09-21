<?php

class Newcon extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		ini_set('date.timezone', 'Asia/Dacca');
		$this->load->model('admin/admin_model');	
	}
	function index()
	{
		if($this->session->userdata('admin_logged_in') == true)
		{		
			redirect("admin/member");
		}
		else
		{
			$this->load->view('admin/admin');
		}
		
	}
	
	
	function login()
	{
		
		$data = $this->admin_model->check_user_account();
		
		if ($data['admin_logged_in']==true)
		{
			$this->session->set_userdata($data);
		}
		redirect('admin');
		
		
	}
	
	function logout()
	{
		$session_data = array('admin' => $this->session->userdata('admin'),'admin_logged_in' => $this->session->userdata('admin_logged_in'));
		//$this->session->sess_destroy();
		$this->session->unset_userdata($session_data);
		redirect('admin');
	}
		
	//===========================================Authentication part for user===================================>>
	function login_process()
	{
		$user_id=$this->input->post('username');
		$password=$this->input->post('password');	
		if($user_id== "" || $password== "")
		{
			redirect("authentication");
		}
		
		$data = $this->admin_model->check_user_account_FE();
	
		if($data == FALSE)
		{
	
			return $this->expire_date_view();
		
		}
		$this->session->set_userdata($data);
		//print_r($data);
		if ($data['logged_in']==true)
		{
		//this->direction();
		redirect("payroll_con");
		}
		
	}
	
	function direction()
	{
		
			$level =$this->session->userdata('level');
			//echo $level;
			if($level == 1) //1 == Admin
			{
			redirect('payroll_con');
			}
			if($level == 2) //2 == Member
			{
			//echo "member";
				redirect("member_con");
			}
	}
	function expire_date_view()
	{
		$data['title'] = "NILG |Login";
		$data['main'] = 'admin/expire_date_view';
		$this->load->view('mist',$data);
		
	}
	
	function logout_FE()
	{
		$session_data = array(
					'username' => $this->session->userdata('username'),
					'logged_in' => $this->session->userdata('logged_in') ,
					'level' => $this->session->userdata('level')
					);
		//$this->session->sess_destroy();
		$this->session->unset_userdata($session_data);
		$base_url=base_url();
		redirect($base_url, 'refresh');
	}
	//===========================================Authentication part for user===================================<<
	
	
	
	
	
/***************...........NOT USE............***************/	
	
/*	function users_search(){
	if($this->session->userdata('admin') !='')
		{
	$this->load->model('book_model');
	if($this->input->post('accept') != '')
			{
				$this->admin_model->booking_request_update();
			}
			if($this->input->post('Release') != '')
			{
				$this->admin_model->booking_release();
			}
	$data['field']=$this->book_model->search_users();
	//print_r($data);
	//echo "output".$data['user_id']['0'];
	$data['title'] = "Search results";
	$data['main'] = 'admin/searchresult';
		//print_r($data);
	$this->load->view('admin/mist',$data);
	//$this->load->view('admin/searchresult',$data);
		}
		else
		{
			redirect();
		}
	}
	*/
	/*******...For Pagination....********/
	function users_search(){
		$data['message']="";
		$this->load->library('pagination');
		$this->load->model('book_model');
		//$data['field']=$this->book_model->search_users();
		$config['base_url'] =base_url()."/index.php/admin/users_search";
		$config['total_rows'] = $this->book_model->row_count();
		$config['per_page'] = '5'; 
		$config['uri_segment'] = '3';
		$this->pagination->initialize($config);
	if($this->session->userdata('admin') !=''||(count($data['field']['user_id'])>0))
		{
		$this->load->model('book_model');
				if($this->input->post('accept') != '')
				{
					$this->admin_model->booking_request_update();
				}
				if($this->input->post('Release') != '')
				{
					$this->admin_model->booking_release();
				}
		
				$data['field']=$this->book_model->search_users($this->uri->segment(3),$config['per_page']);
		//$data['field']=$this->book_model->users_search($this->uri->segment(3),$config['per_page']);
		
				$data['title'] = "Search results";
				$data['main'] = 'admin/searchresult';
					//print_r($data);
				$this->load->view('admin/mist',$data);
		}
		
	}
	
	
	
	
	
	function journals()
	{
		$data['title'] 			= "Add E-Book Details";
		$data['main'] 			= "admin/journals";
		$this->load->view('admin/mist',$data);
	}
	
	function add_member()
	{
		$data['title'] 			= "Add Member Details";
		$data['main'] 			= "admin/add_member";
		$this->load->view('admin/mist',$data);
	}
	
	function list_member()
	{
		$data['title'] 			= "List all user";
		$data['main'] 			= "admin/list_member";
		$data['values']         = $this->admin_model->list_member();
		$this->load->view('admin/mist',$data);
	}
	
	function add_member_process()
	{
		$data['main'] 			= "admin/upload_success";
		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
			
		$insert_data = array(
				   'id' 		=> '' ,
				   'id_number' 	=> $user_id ,
				   'password' 	=> $password ,
				   'level' 		=> $level
			);
			
			//print_r($insert_data);
			$this->db->insert('members', $insert_data);  
			$this->load->view('admin/mist',$data);
	}
	
	
}

/* End of file Library.php */
/* Location: ./system/application/controllers/Library.php */