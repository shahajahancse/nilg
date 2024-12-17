<?php

class Authentication extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('processdb');
		$this->load->helper('form');
		$this->load->model('admin/admin_model');
		
	}
	
	
	function index()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($this->session->userdata('logged_in')==true)
		{
			$this->direction();
			//redirect("payroll_con");
		}
		else
		{
			$data['title'] = "NILG Library| Login ";
			$data['main'] = 'admin/login';
			$this->load->view('mist',$data);
		}
	}
	
	function direction()
	{
		if($this->session->userdata('level') == 2)
		{		
			redirect("member_con");
		}
		elseif($this->session->userdata('level') == 1)
		{		
			redirect("payroll_con");
		}
		
	}
}