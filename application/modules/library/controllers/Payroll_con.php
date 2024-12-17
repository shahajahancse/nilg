<?php

class Payroll_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('processdb');
		$this->load->helper('form');
		set_time_limit(0);
		ini_set("memory_limit","512M");
		
		if($this->session->userdata('logged_in')==FALSE)
		{
			redirect("authentication");
		}
		$this->load->model('acl_model');
	}
	
	function index()
	{
		$this->load->view('home');
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
		$this->load->view('utree');
	}
	
	function first_body()
	{
		$this->load->view('id_proxi_ins');
	}
	
	function footer()
	{
		$this->load->view('footer');
	}
	function idcard_grid()
	{
		$result = $this->processdb->idcard_grid();
		echo $result;
	}
	
}

