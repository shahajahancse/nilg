<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation_report extends Backend_Controller {
   var $userSessID;
   var $qr_path;

   public function __construct(){
      parent::__construct();
      // print_r($this->session->all_userdata());

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'প্রশিক্ষণ মূল্যায়ন';
      $this->load->model('Common_model');
      $this->load->model('evaluation/Evaluation_model');
      $this->load->model('Evaluation_report_model');
      $this->userSessID = $this->session->userdata('user_id');
      $this->qr_path = realpath(APPPATH . '../uploads/qrcode');
   }    


   /*************************** Trainer Evaluation ****************************
   ***************************************************************************/
   // trainer evaluation result
   public function trainer_evaluation($excel = NULL){
      $start_date = $this->input->post('h_start_date');
      $end_date   = $this->input->post('h_end_date');
      $course_id  = $this->input->post('h_course_id');
      if($start_date == NULL && $end_date == NULL){
         redirect('evaluation/trainer_evaluation');
      }

      $results = $this->Evaluation_report_model->trainer_evaluation($start_date, $end_date, $course_id);
      // dd($results); exit();
      $this->data['results'] = $results;
      $this->data['start_date'] = $start_date;
      $this->data['end_date'] = $end_date;
      $this->data['course_id'] = $course_id;
      // dd($this->data['results']);

      // Load page
     if ($excel != NULL && $excel == 1) {
         $this->data['headding'] = 'প্রশিক্ষক মূল্যায়নের তালিকা';
         $this->load->view('trainer_evaluation_excel', $this->data);
         return true;
      } else {
         $this->data['meta_title'] = 'প্রশিক্ষক মূল্যায়ন';
         $this->data['subview'] = 'trainer_evaluation';
         $this->load->view('backend/_layout_main', $this->data);
      }
   }   

   // Training wise evaluation
   public function trainer_evaluation_result($trainingID, $excel = NULL){
      if(!$this->ion_auth->in_group(array('admin', 'nilg'))){
         redirect('dashboard');
      }

      $results = $this->Evaluation_report_model->trainer_evaluation_result($trainingID);
      // dd($results); exit();

      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);
      $this->data['results'] = $results;
      // dd($this->data['results']);

      // Load page
      if ($excel != NULL && $excel == 1) {
         $this->data['headding'] = 'প্রশিক্ষক মূল্যায়নের তালিকা';
         $this->load->view('trainer_evaluation_result_excel', $this->data);
         return true;
      } else {
         $this->data['meta_title'] = 'প্রশিক্ষক মূল্যায়নের তালিকা';
         $this->data['subview'] = 'trainer_evaluation_result';
         $this->load->view('backend/_layout_main', $this->data);
      }
   }

   /*********************** END ****************************
   *******************************************************************/   

}