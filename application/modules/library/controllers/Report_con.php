<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_con extends Backend_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) :
			redirect('login');
		endif;

        $this->load->model('Common_model');
		$this->load->model('Processdb');
		$this->load->model('Acl_model');
		$this->load->library('form_validation');
		$this->load->library('grocery_CRUD');	
		$access_level = 1;
		// $acl = $this->Acl_model->acl_check($access_level);
	}


	
	function report()
	{	

		$this->data['meta_title'] = 'Report';
    	$this->data['subview'] = 'report/report_view';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	
	function fine_report()
	{
		$data['value'] = $this->processdb->fine_reportdb();
		$this->load->view('report/fine_report',$data);	
	}
}