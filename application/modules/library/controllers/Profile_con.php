<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */	
		$this->load->model('processdb');
		$this->load->model('acl_model');
		$this->load->library('form_validation');
		$this->load->library('grocery_CRUD');	
		$access_level = 8;
		$acl = $this->acl_model->acl_check($access_level);
	}
	
		
	function profile_edit_view($output = null)
	{
		$this->load->view('member/profile_edit_view',$output);
		//$this->load->view('library_log_view.php',$output);
		//return $result;
	}
	function profile_edit()
	{
		$mem_id= $this->session->userdata('mem_id');
		//echo $mem_id;
		$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->set_table('member');
		$this->grocery_crud->set_subject('Member Profile');
		$this->grocery_crud->where('mem_id',$mem_id);
		$this->grocery_crud->columns('first_name','last_name','present_add','mem_id','level','mob','email','image');
		$this->grocery_crud->edit_fields('first_name','last_name','present_add','mob','image','email');
		$this->grocery_crud->change_field_type('first_name', 'label');
		$this->grocery_crud->change_field_type('last_name', 'label');
		$this->grocery_crud->change_field_type('email', 'label');
		$this->grocery_crud->set_field_upload('image','uploads/mem_image');
		$this->grocery_crud->unset_add();
		$this->grocery_crud->unset_delete();
		$output = $this->grocery_crud->render();
		$this->profile_edit_view($output);
	}
	
	function member_paper_status()
	{
		$search_query = $this->processdb->member_paper_status();
		$this->load->view('member/member_status_view',$search_query);
	}
	
	
}