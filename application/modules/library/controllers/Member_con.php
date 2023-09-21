<?php

class Member_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('processdb');
		$this->load->helper('form');
		set_time_limit(0);
		ini_set("memory_limit","512M");
		$this->load->library('grocery_CRUD');	
		if($this->session->userdata('logged_in')==FALSE)
		{
			redirect("authentication");
		}
		elseif($this->session->userdata('level')!=2)
		redirect("authentication");
	}
	
	function index()
	{
		//echo $this->session->userdata('level');
		//$this->processdb->fine_cal();
		$this->load->view('member/member_home');
	}
	
	function main_header()
	{
		$this->load->view('header');
	}
	function sub_header()
	{
		$this->load->view('header_below');
	}
	
	function utree()
	{
		$this->load->view('member/mem_utree');
	}
	
	function first_body()
	{
		$this->load->view('id_proxi_ins');
	}
	
	function footer()
	{
		$this->load->view('footer');
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
	
	
	
}