<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

class Directories extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->lang->load('auth');
        // $this->load->model('Common_model');
		$this->load->model('Api_model');
        // $this->load->model('My_profile_model');

        // $this->smsUser = new SMSClient('1587652994', '^Rl:_w=[', 'http://www.sms4bd.net');
        // $this->load->helper('string');
    }

    public function users_quick_search_get(){
        $terms = $this->get('terms'); 
        
        $data = $this->Api_model->get_users_quick_search($terms);
        $results = (array) $data;
        
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function users_by_office_get(){
        $officeID = $this->get('office_id'); 
        $designationID = $this->get('designation_id');         
        
        $data = $this->Api_model->get_users_by_office($officeID, $designationID);
        $results = (array) $data;
        
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function office_list_get(){
        $officeType = $this->get('office_type'); 
        $division = $this->get('division'); 
        $district = $this->get('district'); 
        $upazila = $this->get('upazila'); 
        
        $data = $this->Api_model->get_office_list_by_filter($officeType, $division, $district, $upazila);
        $results = (array) $data;
        
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function designation_list_get(){
        $officeType = $this->get('office_type'); 
        
        $data = $this->Api_model->get_designation_list_by_filter($officeType);
        $results = (array) $data;
        
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function upazila_get(){
        $districtID = $this->get('district_id'); 
        
        $data = $this->Api_model->get_upa_tha_by_dis_id($districtID);
        $results = (array) $data;

        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function district_get(){
        $divisionID = $this->get('division_id'); 
        
        $data = $this->Api_model->get_district_by_div_id($divisionID);
        $results = (array) $data;

        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function division_get(){
        
        $data = $this->Api_model->get_division();
        $results = (array) $data;

        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }



}
