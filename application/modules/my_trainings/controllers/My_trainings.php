<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_trainings extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = lang('my_training');
		$this->load->model('Common_model');
        $this->load->model('My_trainings_model');
    }


    public function index(){
        // echo $this->session->userdata('username'); 
        $data_id = $this->My_trainings_model->get_data_id_from_nid($this->session->userdata('username')); 
        // print_r($data_id);
        $this->data['results'] = $this->My_trainings_model->get_data($data_id);

        //Load page
        $this->data['meta_title'] = lang('my_training');
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
	}

	public function certificate($id){
        
		$this->data['info'] = $this->My_trainings_model->get_certificate_info($id);

		$this->data['meta_title'] = 'সার্টিফিকেট ডাউনলোড';
		$this->data['subview'] = 'certificate';
    	$this->load->view('backend/_layout_main', $this->data);
	}

}