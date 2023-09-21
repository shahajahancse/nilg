<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */	
		$this->load->model('processdb');
		$this->load->library('form_validation');
		$this->load->library('grocery_CRUD');	
		/*if($this->session->userdata('logged_in')==FALSE)
		{
			redirect("authentication");
		}
		elseif($this->session->userdata('level')!=1)
		redirect("authentication");*/
		$this->load->model('processdb');
		$this->load->model('acl_model');
		$access_level = 4;
		// $acl = $this->acl_model->acl_check($access_level);
	}
	
	function report()
	{
		$this->load->view('report/report_view');	
	}
	
	function fine_report()
	{
		$data['value'] = $this->processdb->fine_reportdb();
		$this->load->view('report/fine_report',$data);	
	}
}