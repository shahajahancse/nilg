<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

class Dashboard extends REST_Controller {

   function __construct()
   {
      // Construct the parent class
      parent::__construct();
      // $this->load->model('Common_model');
      $this->load->model('Api_model');
   }

   public function total_summary_get(){
      // Total Summary
      $total['representative'] = $this->Api_model->get_count_by_data_type(1);   
      $total['kormokorta'] = $this->Api_model->get_count_by_data_type(2);   
      $total['kormocari'] = $this->Api_model->get_count_by_data_type(3);   
      $total['nilg_kormokorta'] = $this->Api_model->get_count_by_data_type(4);   
      $total['nilg_kormocari'] = $this->Api_model->get_count_by_data_type(5); 

      // Public Representative
      $pr['up'] = $this->Api_model->get_count_datasheet(1, 1);   
      $pr['paura'] = $this->Api_model->get_count_datasheet(1, 2);   
      $pr['uzp'] = $this->Api_model->get_count_datasheet(1, 3);   
      $pr['zp'] = $this->Api_model->get_count_datasheet(1, 4);   
      $pr['cc'] = $this->Api_model->get_count_datasheet(1, 5);

      // Kormokorta
      $kormokorta['up'] = $this->Api_model->get_count_datasheet(2, 1);   
      $kormokorta['paura'] = $this->Api_model->get_count_datasheet(2, 2);   
      $kormokorta['uzp'] = $this->Api_model->get_count_datasheet(2, 3);   
      $kormokorta['zp'] = $this->Api_model->get_count_datasheet(2, 4);   
      $kormokorta['cc'] = $this->Api_model->get_count_datasheet(2, 5); 

      // kormochari 
      $kormochari['up'] = $this->Api_model->get_count_datasheet(3, 1);   
      $kormochari['paura'] = $this->Api_model->get_count_datasheet(3, 2);   
      $kormochari['uzp'] = $this->Api_model->get_count_datasheet(3, 3);   
      $kormochari['zp'] = $this->Api_model->get_count_datasheet(3, 4);   
      $kormochari['cc'] = $this->Api_model->get_count_datasheet(3, 5); 

      // Training
      $training['revenue'] = $this->Api_model->get_count_training(1);   
      $training['jica'] = $this->Api_model->get_count_training(3);   
      $training['undp'] = $this->Api_model->get_count_training(2); 

      $data['summary'] = $total;
      $data['representative'] = $pr;
      $data['kormokorta'] = $kormokorta;
      $data['kormochari'] = $kormochari;
      $data['training'] = $training;
      
      $results = (array) $data;        

      if(count($results)){
         $this->response(array('status'=> 'true', 'message' => 'data found', 'result' => $results), REST_Controller::HTTP_OK);
      }else{
         $this->response(array('status'=> 'false', 'message' => 'data not found', 'result' => null), REST_Controller::HTTP_OK); 
      }
   }

}
