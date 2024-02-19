<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilg_setting extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('Nilg_setting_model');

        $this->data['module_name'] = 'এনআইএলজি সেটিংস';
    }

    public function index(){
        redirect('general_setting/upazila_thana');
    }
   
    
}