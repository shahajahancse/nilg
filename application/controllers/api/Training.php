<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

class Training extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // $this->lang->load('auth');
        $this->load->model('Common_model');
        $this->load->model('Api_model');
    }

    public function training_info_get(){
        // Params
        $trainingID = $this->get('training_id');

        // Get Data
        $data = $this->Api_model->get_training_info($trainingID);
        $results = (array) $data;        
        
        // Response
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

}
