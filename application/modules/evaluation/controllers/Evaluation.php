<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends Backend_Controller {
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
      $this->load->model('Evaluation_model');
      $this->userSessID = $this->session->userdata('user_id');
      $this->qr_path = realpath(APPPATH . '../uploads/qrcode');
   }    

   public function index($offset=0){
      redirect('evaluation/pre_exam');
   }

   /*************************** Delete Evaluation Question *******************
   ***************************************************************************/
   public function delete_evaluation_question($id, $type = NULL)
   {
      if ($this->db->where('id', $id)->delete('evaluation')){
         $this->db->where('evaluation_id', $id)->delete('evaluation_question');
         $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে মুছে ফেলা হয়েছে');
         
         if ($type == 1) {
            redirect('evaluation/pre_exam');
         } else if ($type == 2) {
            redirect('evaluation/post_exam');
         }  else if ($type == 3) {
            redirect('evaluation/module_exam');
         } else {
            redirect('evaluation');
         }
      }
   }

   /*************************** Trainer Evaluation ****************************
   ***************************************************************************/
   public function trainer_evaluation($offset=0){
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      $this->data['results'] = 0;
      $this->data['total_rows'] = 0;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_upcomming_training_coordinate($limit, $offset);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset);
      }else{
         redirect('dashboard');
      }
      
      // dd($results); exit();
      $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/trainer_evaluation/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষক মূল্যায়নের তালিকা';
      $this->data['subview'] = 'trainer_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function trainer_evaluation_form($trainingID){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Get Info
      $this->form_validation->set_rules('participant_id', 'প্রশিক্ষণার্থী', 'required|trim');      

      if ($this->form_validation->run() == true){
         $userID = $this->input->post('participant_id');
         // Check exists answer
         $resultExists = $this->Evaluation_model->exists_trainer_evaluation_by_user($trainingID, $userID);

         if($resultExists === false){
            // echo sizeof($_POST['hide_topic_id']); exit;
            for ($i=0; $i<sizeof($_POST['hide_topic_id']); $i++) { 
               $topicID = $_POST['hide_topic_id'][$i];
               $form_data = array(
                  'participant_id'    => $this->input->post('participant_id'),
                  'training_id'       => $trainingID,
                  'topic_id'          => $topicID,
                  'rate_concept_topic'=> $_POST['rate_concept_topic_'.$topicID],
                  'rate_present_technique' => $_POST['rate_present_technique_'.$topicID],
                  'rate_use_tool'     => $_POST['rate_use_tool_'.$topicID],
                  'rate_time_manage'  => $_POST['rate_time_manage_'.$topicID],
                  'rate_que_ans_skill'=> $_POST['rate_que_ans_skill_'.$topicID],
                  );

               $subTotal = $_POST['rate_concept_topic_'.$topicID]+$_POST['rate_present_technique_'.$topicID]+$_POST['rate_use_tool_'.$topicID]+$_POST['rate_time_manage_'.$topicID]+$_POST['rate_que_ans_skill_'.$topicID];

               $form_data['topic_avgrage'] = $subTotal/5;
               // print_r($form_data); exit;

               $this->Common_model->save('evaluation_trainer', $form_data);
            }

            // Success Message
            $this->session->set_flashdata('success', 'প্রশিক্ষক মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('evaluation/trainer_evaluation_form/'.$trainingID);

         }else{
            // Warning Message
            $this->session->set_flashdata('warning', 'এই প্রশিক্ষণার্থীর প্রশিক্ষক মূল্যায়ন পূর্বে করা হয়েছে।');
            redirect('evaluation/trainer_evaluation_form/'.$trainingID);
         }         
      }

      // Results
      $this->data['participants'] = $this->Evaluation_model->get_participant_dd($trainingID);
      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);
      $this->data['results'] = $this->Evaluation_model->get_training_schedule_with_trainer($trainingID);
      // dd($this->data['info']);
      // $trainingID = $this->data['info']->id;
      // $this->data['subjects'] = $this->Training_model->get_training_mark($id);
      // pre_exam, post_exam, module, manual
      // $this->data['training_mark'] = $this->Evaluation_model->get_training_mark_by_training_id($trainingID, 'manual');
      // dd($this->data['participants']);

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষক মূল্যায়ন ফরম';
      $this->data['subview'] = 'trainer_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }


   /*************************** Team Evaluation *******************************
   ***************************************************************************/
   public function team_evaluation($offset=0){
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      $this->data['results'] = 0;
      $this->data['total_rows'] = 0;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_upcomming_training_coordinate($limit, $offset);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset);
      }else{
         redirect('dashboard');
      }      
      // dd($results); exit();

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/team_evaluation/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      // Load page
      $this->data['meta_title'] = 'টিম কর্তৃক মূল্যায়নের তালিকা';
      $this->data['subview'] = 'team_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function team_evaluation_form($trainingID){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }
      // Get Info
      // $this->form_validation->set_rules('q1_course_topic', 'কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?', 'required|trim');

      if ($this->input->post('submit')){
         // Training Manual Mark Status Update 1
         $this->Common_model->edit('training', $trainingID, 'id', array('is_manual_mark' => 1));

         // Manual Mark Insert to Marksheet
         $marks = $this->input->post('mark');
         foreach ($marks as $keyUserID => $markValues) {
            // User
            foreach ($markValues as $keyTM => $mark) {
               $form_data = array(
                  'training_id'  => $trainingID,
                  'user_id'      => $keyUserID,
                  'es_id'        => $this->Evaluation_model->get_subject_id($keyTM),
                  'tm_id'        => $keyTM,
                  'mark'         => $mark
                  );
               // dd($form_data);
               $this->Common_model->save('marksheet', $form_data);
            }
         }
         // dd($marks);
         
         // Success Message
         $this->session->set_flashdata('success', 'কোর্স মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে');
         redirect('evaluation/team_evaluation');
      }

      // Results
      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);
      // dd($this->data['info']);
      // $trainingID = $this->data['info']->id;
      // $this->data['subjects'] = $this->Training_model->get_training_mark($id);
      // pre_exam, post_exam, module, manual
      $this->data['training_mark'] = $this->Evaluation_model->get_manual_mark_by_training($trainingID); 
      $this->data['participants'] = $this->Evaluation_model->get_participant_list($trainingID);
      // dd($this->data['training_mark']);

      // Load Page
      $this->data['meta_title'] = 'টিম কর্তৃক মূল্যায়ন ফরম';
      $this->data['subview'] = 'team_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function team_evaluation_details($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Get Info
      // $this->form_validation->set_rules('q1_course_topic', 'কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?', 'required|trim');

      if ($this->input->post('submit')){
         $marks = $this->input->post('mark');
         foreach ($marks as $keyUserID => $markValues) {
            // User
            foreach ($markValues as $keyTM => $mark) {
               $form_data = array(
                  'training_id'  => $id,
                  'user_id'      => $keyUserID,
                  'es_id'        => $this->Evaluation_model->get_subject_id($keyTM),
                  'tm_id'        => $keyTM,
                  'mark'         => $mark
                  );
               // dd($form_data);
               $this->Common_model->save('marksheet', $form_data);
            }
         }
         // dd($marks);
         
         // Success Message
         $this->session->set_flashdata('success', 'কোর্স মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে');
         redirect('evaluation/team_evaluation');
      }

      // Results
      $this->data['info'] = $this->Evaluation_model->get_training_info($id);
      $trainingID = $this->data['info']->id;
      // $this->data['subjects'] = $this->Training_model->get_training_mark($id);
      // pre_exam, post_exam, module, manual
      $this->data['training_mark'] = $this->Evaluation_model->get_training_mark_by_training_id($trainingID, 'manual');
      $this->data['participants'] = $this->Evaluation_model->get_participant_list($trainingID);
      // Get Manual Evaluation Mark by Training ID, Training Mark ID, User ID from Marksheet Table
      // $tmIDs = implode(',', array_keys($this->data['training_mark']));
      // $this->data['results'] = $this->Evaluation_model->get_marks($trainingID, $tmIDs);
      // dd($this->data['results']);


      // Load Page
      $this->data['meta_title'] = 'টিম কর্তৃক মূল্যায়নের বিস্তারিত';
      $this->data['subview'] = 'team_evaluation_details';
      $this->load->view('backend/_layout_main', $this->data);
   }   


   /************************* Course Evaluation *******************************
   ***************************************************************************/

   public function course_evaluation($offset=0){      
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      $this->data['results'] = 0;
      $this->data['total_rows'] = 0;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_upcomming_training_coordinate($limit, $offset);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_upcomming_training($limit, $offset);
      }else{
         redirect('dashboard');
      }
      // dd($results); exit();

      // Data existes
      if($results){
         $this->data['results'] = $results['rows'];
         $this->data['total_rows'] = $results['num_rows'];

         foreach ($this->data['results'] as $k => $row){
            // dd($row); 
            $this->data['results'][$k]->user = $this->Evaluation_model->get_participant_course_evaluation_by_training_id($row->id);
         }
      }
      // dd($this->data['results']);

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/course_evaluation/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      // Load page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের তালিকা';
      $this->data['subview'] = 'course_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function course_evaluation_participant($trainingID){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Get Info
      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);
      $this->data['participants'] = $this->Evaluation_model->get_course_evaluation_participants($trainingID);    
      // dd($this->data['participants']);

      // Load page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নে অংশগ্রহণকারীর তালিকা';
      $this->data['subview'] = 'course_evaluation_participant';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function course_evaluation_answer($trainingID, $userID){
      // Get Course Evaluation
      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);        
      $this->data['ans'] = $this->Evaluation_model->get_course_evaluation_by_user($trainingID, $userID);
      // dd($this->data['info']);

      // Load Page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের উওর';
      $this->data['subview'] = 'course_evaluation_answer';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function course_evaluation_answer_delete($trainingID, $id){
      $this->db->where('id', $id)->delete('evaluation_course');
      $this->session->set_flashdata('success', 'ডেটাবেজ থেকে তথ্যটি সফলভাবে মুছে ফেলা হয়েছে।');
      redirect('evaluation/course_evaluation_participant/'.$trainingID);
   }

   public function course_evaluation_question($trainingID){

      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);
      //$this->data['participants'] = $this->Evaluation_model->get_course_evaluation_participants($trainingID);    
      // dd($this->db->list_fields('evaluation_course'));


      // Load page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের প্রশ্ন';
      $this->data['subview'] = 'course_evaluation_question';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function course_evaluation_answer_by_question($trainingID, $question){
      $this->data['info'] = $this->Evaluation_model->get_training_info($trainingID);        

      if($question == 'q1_course_topic'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?';
            // dd($this->data['answers']);
         $page = 'course_evaluation_answer_by_question_q1';

      }elseif($question == 'q2_participant_helpful'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে?';
         $page = 'course_evaluation_answer_by_question_q2';

      }elseif($question == 'q3_professional_helpful'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন?';
         $page = 'course_evaluation_answer_by_question_q3';

      }elseif($question == 'q4_course_duration'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?';
         $page = 'course_evaluation_answer_by_question_q4';

      }elseif($question == 'q5_use_tool_opinion'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-';
         $page = 'course_evaluation_answer_by_question_q5';

      }elseif($question == 'q6_course_topic_add_sub'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'ভবিষ্যত এ ধরনের কোর্সে আর কি কি বিষয় অন্তর্ভুক্ত করা যায় এবং কি কি বিষয় বাদ দেওয়া যায় বলে আপনি মনে করেন?';
         $page = 'course_evaluation_answer_by_question_q6';

      }elseif($question == 'q7_accommodation_opinion'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)';
         $page = 'course_evaluation_answer_by_question_q7';

      }elseif($question == 'q8_dining_opinion'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'ডাইনিং ব্যবস্থাপনা  সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)';
         $page = 'course_evaluation_answer_by_question_q8';

      }elseif($question == 'q9_course_manage_opinion'){
         $this->data['answers'] = $this->Evaluation_model->get_course_evaluation_answer_by_question($trainingID, $question);
         $this->data['ques'] = 'কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত';
         $page = 'course_evaluation_answer_by_question_q9';
      }

      // Load page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের প্রশ্ন ভিত্তিক উত্তর';
      $this->data['subview'] = $page;
      $this->load->view('backend/_layout_main', $this->data);
   }

   /**************************** My Evaluation ********************************
   ***************************************************************************/

   public function my_trainer_evaluation(){
      // Check Auth
      if(!$this->ion_auth->in_group(array('trainee'))){
         redirect('dashboard');
      }

      // Results
      $this->data['results'] = $this->Evaluation_model->get_my_training();
      // dd($this->data['results']);

      // View
      $this->data['meta_title'] = 'আলোচক মূল্যায়ন';
      $this->data['subview'] = 'my_trainer_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_trainer_topic_evaluation_form($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('trainee'))){
         redirect('dashboard');
      }

      // Decrypt Data        
      $dataID = (int) decrypt_url($id); //exit;
      // Check Exists
      if (!$this->Common_model->exists('training_schedule', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('dashboard > my_trainer_topic_evaluation_form', TRUE);
      }

      // Get Info
      if (isset($_POST) && !empty($_POST)){
         $trainingID = decrypt_url($_POST['hide_training_id']);
         $topicID = decrypt_url($_POST['hide_topic_id']);
         $topic_trainer_id = decrypt_url($_POST['hide_topic_trainer_id']);

         $form_data = array(
            'participant_id' => $this->userSessID,
            'training_id' => $trainingID,
            'topic_id' => $topicID,
            'topic_trainer_id' => $topic_trainer_id,
            'rate_concept_topic' => $_POST['rate_concept_topic'],
            'rate_present_technique' => $_POST['rate_present_technique'],
            'rate_use_tool' => $_POST['rate_use_tool'],
            'rate_time_manage' => $_POST['rate_time_manage'],
            'rate_que_ans_skill' => $_POST['rate_que_ans_skill'],
            );
         $subTotal = $_POST['rate_concept_topic']+$_POST['rate_present_technique']+$_POST['rate_use_tool']+$_POST['rate_time_manage']+$_POST['rate_que_ans_skill'];

         $form_data['topic_avgrage'] = $subTotal/5;
         // dd($form_data); exit;

         // Save to DB
         $this->Common_model->save('evaluation_trainer', $form_data);
         
         // Success Message
         $this->session->set_flashdata('success', 'কোর্স মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে');
         redirect('evaluation/my_trainer_evaluation_details/'.encrypt_url($trainingID));  
      }

      // Get Data
      $this->data['info'] = $this->Evaluation_model->get_training_schedule_info_by_id($dataID);
      // dd($this->data['info']);

      // Load Page
      $this->data['meta_title'] = 'আলোচ্য বিষয়ের মূল্যায়ন ফরম';
      $this->data['subview'] = 'my_trainer_topic_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*public function my_trainer_evaluation_form($id){
      // Get Info
      // echo $id; exit;

      if (isset($_POST) && !empty($_POST)){
         for ($i=0; $i<sizeof($_POST['hide_topic_id']); $i++) { 
            $topicID = $_POST['hide_topic_id'][$i];
            $form_data = array(
               'participant_id' => $this->userSessID,
               'training_id' => $id,
               'topic_id' => $topicID,
               'rate_concept_topic' => $_POST['rate_concept_topic_'.$topicID],
               'rate_present_technique' => $_POST['rate_present_technique_'.$topicID],
               'rate_use_tool' => $_POST['rate_use_tool_'.$topicID],
               'rate_time_manage' => $_POST['rate_time_manage_'.$topicID],
               'rate_que_ans_skill' => $_POST['rate_que_ans_skill_'.$topicID],
               );
            $subTotal = $_POST['rate_concept_topic_'.$topicID]+$_POST['rate_present_technique_'.$topicID]+$_POST['rate_use_tool_'.$topicID]+$_POST['rate_time_manage_'.$topicID]+$_POST['rate_que_ans_skill_'.$topicID];

            $form_data['topic_avgrage'] = $subTotal/5;
            // print_r($form_data); exit;

            $this->Common_model->save('evaluation_trainer', $form_data);
         }
         
         // Success Message
         $this->session->set_flashdata('success', 'কোর্স মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে');
         redirect('evaluation/my_trainer_evaluation_details/'.$id);  
      }

      // $results = $this->Evaluation_model->get_evaluation_details($id);
      // $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_training_info($id);
      // dd($this->data['info']);
      $this->data['results'] = $this->Evaluation_model->get_training_schedule_with_trainer($id);
      // dd($this->data['results']);

      // Load Page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের ফরম';
      $this->data['subview'] = 'my_trainer_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }*/

   public function my_trainer_evaluation_details($trainingID){
      // Decrypt Data        
      $dataID = (int) decrypt_url($trainingID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('training', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('dashboard > my_training_schedule', TRUE);
      }
      
      // Get Course Evaluation
      $this->data['info'] = $this->Evaluation_model->get_training_info($dataID);
      $this->data['results'] = $this->Evaluation_model->get_training_schedule_with_trainer($dataID);     
      // dd($this->data['results']);

      // Load Page
      $this->data['meta_title'] = 'আলোচক মূল্যায়নের উত্তরপত্র';
      $this->data['subview'] = 'my_trainer_evaluation_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_training_topic_list($trainingID){
      // Decrypt Data        
      $dataID = (int) decrypt_url($trainingID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('training', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('dashboard > my_training_topic_list', TRUE);
      }

      // Get Course Evaluation
      $this->data['info'] = $this->Evaluation_model->get_training_info($dataID);
      $this->data['results'] = $this->Evaluation_model->get_training_schedule_with_trainer($dataID);

      // Add KEY for given trainer evaluation
      foreach ($this->data['results'] as $key => $row) {
         $this->data['results'][$key]->is_answared = $this->Evaluation_model->is_answerd_trainer_evaluation($row->id)['count'];
      }
      // dd($this->data['results']);

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণে আলোচ্য বিষয়ের তালিকা';
      $this->data['subview'] = 'my_training_topic_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_course_evaluation(){
      // Results
      $this->data['results'] = $this->Evaluation_model->get_my_training();
      // dd($this->data['results']);

      // View
      $this->data['meta_title'] = 'কোর্স মূল্যায়ন';
      $this->data['subview'] = 'my_course_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_course_evaluation_form($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('trainee'))){
         redirect('dashboard');
      }

      // Decrypt Data        
      $dataID = (int) decrypt_url($id); //exit;
      // Check Exists
      if (!$this->Common_model->exists('training', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('dashboard > my_course_evaluation_form', TRUE);
      }

      // Get Info
      // echo $id; exit;
      $this->form_validation->set_rules('q1_course_topic', 'কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?', 'required|trim');
      $this->form_validation->set_rules('q2_participant_helpful', 'কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে?', 'required|trim');
      $this->form_validation->set_rules('q3_professional_helpful', 'এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন?', 'required|trim');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'training_id'       => $dataID, //$this->input->post('hide_training_id'),
            'participant_id'    => $this->userSessID, // $this->input->post('participant_id'),
            'q1_course_topic'   => $this->input->post('q1_course_topic'),
            'q1_if_not_course_topic_related'=> $this->input->post('q1_if_not_course_topic_related'),
            'q2_participant_helpful'        => $this->input->post('q2_participant_helpful'),
            'q2_if_not_participant_helpful' => $this->input->post('q2_if_not_participant_helpful'),
            'q3_professional_helpful'       => $this->input->post('q3_professional_helpful'),
            'q3_if_not_professional_helpful'=> $this->input->post('q3_if_not_professional_helpful'),
            'q4_course_duration'        => $this->input->post('q4_course_duration'),
            'q5_use_tool_opinion'       => $this->input->post('q5_use_tool_opinion'),
            'q6_course_topic_add_sub'   => $this->input->post('q6_course_topic_add_sub'),
            'q7_accommodation_opinion'  => $this->input->post('q7_accommodation_opinion'),
            'q8_dining_opinion'         => $this->input->post('q8_dining_opinion'),
            'q9_course_manage_opinion'  => $this->input->post('q9_course_manage_opinion'),
            // 'created'                   => date('Y-m-d H:i'),
            );
            // print_r($form_data); exit;

         $this->Common_model->save('evaluation_course', $form_data);
         // Success Message
         $this->session->set_flashdata('success', 'কোর্স মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে');

         $json = array(
            'status' => true,
            'success' => 'কোর্স মূল্যায়নের তথ্য ডাটাবেজে সংরক্ষণ করা হয়েছে',
            'training_id' => encrypt_url($dataID),
         );

         return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($json));
         redirect('evaluation/my_course_evaluation_details/'.encrypt_url($dataID));
      }

      // $results = $this->Evaluation_model->get_evaluation_details($id);
      // $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_training_info($dataID);
      // dd($this->data['info']);
      // $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);
      // dd($this->data['info']);

      // Load Page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের ফরম';
      $this->data['subview'] = 'my_course_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_course_evaluation_details($trainingID){
      // Decrypt Data        
      $dataID = (int) decrypt_url($trainingID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('training', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('dashboard > my_course_evaluation_details', TRUE);
      }

      // Get Course Evaluation
      $this->data['info'] = $this->Evaluation_model->get_training_info($dataID);
      $this->data['ans'] = $this->Evaluation_model->get_course_evaluation_by_user($dataID, $this->userSessID);
      // echo $this->db->last_query(); 
      // dd($this->data['info']);

      // Load Page
      $this->data['meta_title'] = 'কোর্স মূল্যায়নের উত্তরপত্র';
      $this->data['subview'] = 'my_course_evaluation_details';
      $this->load->view('backend/_layout_main', $this->data);
   }


   /*************************** Module Exam ***********************************
   ***************************************************************************/
   public function module_exam($offset=0){
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 3, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 3, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 3, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_evaluation_coordinate($limit, $offset, 3);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 3);
      }else{
         redirect('dashboard');
      }      
      // dd($results); exit();

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/module_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();

      // Load page
      $this->data['meta_title'] = 'মডিউল ভিত্তিক মূল্যায়ন প্রশ্নপত্রের তালিকা';
      $this->data['subview'] = 'module_exam';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function module_exam_create(){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('training_id', 'কোর্সের নাম', 'required');
      $this->form_validation->set_rules('training_mark_id', 'মূল্যায়নের বিষয়', 'required');
      $this->form_validation->set_rules('exam_date', 'পরীক্ষার তারিখ', 'required');
      $this->form_validation->set_rules('exam_start_time', 'পরীক্ষা শুরু', 'required');
      $this->form_validation->set_rules('exam_duration', 'পরীক্ষার সময়', 'required');

      if ($this->form_validation->run() == true){
         $courseID = $this->Evaluation_model->get_course_from_training($this->input->post('training_id'));
         $form_data = array(
            'exam_type'          => 3, // pre_exam, post_exam, module, manual
            'training_id'        => $this->input->post('training_id'),
            'course_id'          => $courseID->course_id,
            'training_mark_id'   => $this->input->post('training_mark_id'),
            'is_published'       => 0,
            'exam_date'       => $this->input->post('exam_date'),
            'exam_start_time' => $this->input->post('exam_start_time'),
            'exam_duration'   => $this->input->post('exam_duration'),
            'created'            => date('Y-m-d H:i:s')                
         );
         // dd($form_data);

         // Insert to DB            
         if($this->Common_model->save('evaluation', $form_data)){  
            // Last insert id
            $lastID = $this->db->insert_id(); 

            // Question 
            for ($i = 0; $i < sizeof($_POST['hideid']); $i++) {
               $data_array = array(
                  'evaluation_id' => $lastID,                        
                  'question_id' => $_POST['hideid'][$i],
                  'qnumber' => $_POST['hidenumber'][$i],
               );
               $this->Common_model->save('evaluation_question', $data_array);
            }

            $this->session->set_flashdata('success', 'নতুন মূল্যায়ন ফরম তৈরি করা হয়েছে');
            redirect('evaluation/module_exam');
         }
      }

      // Dropdown
      $this->data['training'] = $this->Evaluation_model->get_training_not_completed();
      $this->data['office_type'] = $this->Common_model->get_office_type();
      // $this->data['courses'] = $this->Common_model->get_course();
      // $this->data['questions'] = $this->Evaluation_model->get_questions(1);

      // dd($this->data['questions']);

      //Load view
      $this->data['meta_title'] = 'মডিউল ভিত্তিক মূল্যায়ন ফরম তৈরি করুন';
      $this->data['subview'] = 'module_exam_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function module_exam_edit($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('training_id', 'কোর্সের নাম', 'required');
      $this->form_validation->set_rules('training_mark_id', 'মূল্যায়নের বিষয়', 'required');
      $this->form_validation->set_rules('exam_date', 'পরীক্ষার তারিখ', 'required');
      $this->form_validation->set_rules('exam_start_time', 'পরীক্ষা শুরু', 'required');
      $this->form_validation->set_rules('exam_duration', 'পরীক্ষার সময়', 'required');

      if ($this->form_validation->run() == true){
         $courseID = $this->Evaluation_model->get_course_from_training($this->input->post('training_id'));
         $form_data = array(
            // 'exam_type' => 1, // PRE
            // 'exam_set' => $this->input->post('exam_set'),
            'training_id'        => $this->input->post('training_id'),
            'course_id'          => $courseID->course_id,
            'training_mark_id'   => $this->input->post('training_mark_id'),
            'is_published'       => $this->input->post('is_published'),
            'exam_date'       => $this->input->post('exam_date'),
            'exam_start_time' => $this->input->post('exam_start_time'),
            'exam_duration'   => $this->input->post('exam_duration'),
            'updated'            => date('Y-m-d H:i:s')                
         );

         // Insert to DB            
         if($this->Common_model->edit('evaluation', $id, 'id', $form_data)){

            // Question 
            for ($i = 0; $i < sizeof($_POST['hideid']); $i++) {
               $check = $this->db->where('evaluation_id', $id)->where('question_id', $_POST['hideid'][$i])->get('evaluation_question')->row();
               $data_array = array(
                  'evaluation_id' => $id,                        
                  'question_id' => $_POST['hideid'][$i],
                  'qnumber' => $_POST['hidenumber'][$i],
               );

               if (!empty($check)) {
                  $this->db->where('evaluation_id', $id)->where('question_id', $_POST['hideid'][$i]);
                  $this->db->update('evaluation_question', $data_array);
               } else {
                  $this->Common_model->save('evaluation_question', $data_array);
               }
            }

            $this->session->set_flashdata('success', 'প্রশিক্ষণপূর্ব মূল্যায়ন সম্পাদন করা হয়েছে');
            redirect('evaluation/module_exam');
         }
      }

      // Get Info
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);

      // Dropdown
      $this->data['training'] = $this->Evaluation_model->get_training_not_completed();
      $this->data['office_type'] = $this->Common_model->get_office_type();
      // Traing Marking Type
      // 1=pre_exam, 2=post_exam, 3=module, 4=manual
      $this->data['training_mark'] = $this->Evaluation_model->get_training_mark_by_training_id($this->data['info']->training_id, 3);
      // dd($this->data['training_mark']);

      //Load view
      $this->data['meta_title'] = 'মডিউল ভিত্তিক প্রশ্নপত্র সম্পাদন ফরম';
      $this->data['subview'] = 'module_exam_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function module_exam_evaluation_form($id){
      // Get Info
      // $results = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      // dd($this->data['info']);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);
      // dd($this->data['info']);

      // Load Page
      $this->data['meta_title'] = 'মডিউল ভিত্তিক মূল্যায়ন ফরম';
      $this->data['subview'] = 'module_exam_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }    

   /***************************** Pre Exam ************************************
   ***************************************************************************/

   public function pre_exam($offset=0){
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 1, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 1, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 1, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_evaluation_coordinate($limit, $offset, 1);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 1);
      }else{
         redirect('dashboard');
      }
      // dd($results);

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/pre_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণপূর্ব মূল্যায়ন প্রশ্নপত্রের তালিকা';
      $this->data['subview'] = 'pre_exam';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function ajax_evaluation_list($type, $offset=0){
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, $type, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, $type, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, $type, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_evaluation_coordinate($limit, $offset, $type);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, $type);
      }else{
         redirect('dashboard');
      }
      // dd($results);

      $this->data['results'] = $results['rows'];  
      $this->data['total_rows'] = $results['num_rows'];      
      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/pre_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();

      // Load page
      $text = $this->load->view('ajax_evaluation_list', $this->data, TRUE);
      set_output($text); 
   }
   

   public function pre_exam_participant($id){
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['results'] = $this->Evaluation_model->get_exam_participant($id);
      // dd($this->data['info']);

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণ মূল্যায়নে অংশগ্রহনকারীর তালিকা';
      $this->data['subview'] = 'pre_exam_participant';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pre_exam_create(){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('training_id', 'কোর্সের নাম', 'required');
      $this->form_validation->set_rules('training_mark_id', 'মূল্যায়নের বিষয়', 'required');
      $this->form_validation->set_rules('exam_date', 'পরীক্ষার তারিখ', 'required');
      $this->form_validation->set_rules('exam_start_time', 'পরীক্ষা শুরু', 'required');
      $this->form_validation->set_rules('exam_duration', 'পরীক্ষার সময়', 'required');

      if ($this->form_validation->run() == true){
         $courseID = $this->Evaluation_model->get_course_from_training($this->input->post('training_id'));
         $form_data = array(
            'exam_type'        => 1, // PRE
            'exam_set'         => $this->input->post('exam_set'),
            'training_id'      => $this->input->post('training_id'),
            'course_id'        => $courseID->course_id,
            'training_mark_id' => $this->input->post('training_mark_id'),
            'is_published'     => 0,
            'exam_date'       => $this->input->post('exam_date'),
            'exam_start_time' => $this->input->post('exam_start_time'),
            'exam_duration'   => $this->input->post('exam_duration'),
            'created'          => date('Y-m-d H:i:s')                
         );
            // dd($form_data);

         // Insert to DB            
         if($this->Common_model->save('evaluation', $form_data)){  
            // Last insert id
            $lastID = $this->db->insert_id(); 

            // Question 
            for ($i = 0; $i < sizeof($_POST['hideid']); $i++) {
               $data_array = array(
                  'evaluation_id' => $lastID,                        
                  'question_id' => $_POST['hideid'][$i],
                  'qnumber' => $_POST['hidenumber'][$i],
               );
               $this->Common_model->save('evaluation_question', $data_array);
            }

            $this->session->set_flashdata('success', 'নতুন মূল্যায়ন ফরম তৈরি করা হয়েছে');
            redirect('evaluation/pre_exam');
         }
      }

      // Dropdown
      $this->data['training'] = $this->Evaluation_model->get_training_not_completed();      
      $this->data['office_type'] = $this->Common_model->get_office_type();
      // dd($this->data['questions']);

      // Load view
      $this->data['meta_title'] = 'প্রশিক্ষণপূর্ব মূল্যায়ন ফরম';
      $this->data['subview'] = 'pre_exam_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pre_exam_edit($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('training_id', 'কোর্সের নাম', 'required');
      $this->form_validation->set_rules('training_mark_id', 'মূল্যায়নের বিষয়', 'required');
      $this->form_validation->set_rules('exam_date', 'পরীক্ষার তারিখ', 'required');
      $this->form_validation->set_rules('exam_start_time', 'পরীক্ষা শুরু', 'required');
      $this->form_validation->set_rules('exam_duration', 'পরীক্ষার সময়', 'required');

      if ($this->form_validation->run() == true){
         $courseID = $this->Evaluation_model->get_course_from_training($this->input->post('training_id'));
         $form_data = array(
            // 'exam_type' => 1, // PRE
            'exam_set'        => $this->input->post('exam_set'),
            'training_id'     => $this->input->post('training_id'),
            'course_id'       => $courseID->course_id,
            'training_mark_id'=> $this->input->post('training_mark_id'),
            'is_published'    => $this->input->post('is_published'),
            'exam_date'       => $this->input->post('exam_date'),
            'exam_start_time' => $this->input->post('exam_start_time'),
            'exam_duration'   => $this->input->post('exam_duration'),
            'updated'         => date('Y-m-d H:i:s')                
         );
            // dd($form_data);

         // Insert to DB            
         if($this->Common_model->edit('evaluation', $id, 'id', $form_data)){
            // Last insert id
            // $lastID = $this->db->insert_id(); 

            // Question 
            for ($i = 0; $i < sizeof($_POST['hideid']); $i++) {
               $check = $this->db->where('evaluation_id', $id)->where('question_id', $_POST['hideid'][$i])->get('evaluation_question')->row();
               $data_array = array(
                  'evaluation_id' => $id,                        
                  'question_id' => $_POST['hideid'][$i],
                  'qnumber' => $_POST['hidenumber'][$i],
               );
               if (!empty($check)) {
                  $this->db->where('evaluation_id', $id)->where('question_id', $_POST['hideid'][$i]);
                  $this->db->update('evaluation_question', $data_array);
               } else {
                  $this->Common_model->save('evaluation_question', $data_array);
               }
            }

            $this->session->set_flashdata('success', 'প্রশিক্ষণপূর্ব মূল্যায়ন সম্পাদন করা হয়েছে');
            redirect('evaluation/pre_exam');
         }
      }

      // Get Info
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);

      // Dropdown
      $this->data['training'] = $this->Evaluation_model->get_training_not_completed();
      $this->data['office_type'] = $this->Common_model->get_office_type();
      // Traing Marking Type
      // 1=pre_exam, 2=post_exam, 3=module, 4=manual
      $this->data['training_mark'] = $this->Evaluation_model->get_training_mark_by_training_id($this->data['info']->training_id, 1);
      // dd($this->data['questions']);

      // Load view
      $this->data['meta_title'] = 'প্রশিক্ষণপূর্ব মূল্যায়ন সম্পাদন ফরম';
      $this->data['subview'] = 'pre_exam_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pre_evaluation_form($id){
      // Get Info
      // $results = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);
      // dd($this->data['info']);

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ পূর্ব মূল্যায়ন ফরমের নমুনা';
      $this->data['subview'] = 'pre_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pre_evaluation_word($id)
   {
      // Get Result
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);
      // dd($this->data['info']);
      
      $this->data['headding'] = 'প্রশিক্ষণপূর্ব ';

      header("Content-type: application/vnd.ms-word");  
      header("Content-Disposition: attachment;Filename=Pre-Exam-".time().rand().".doc");  
      header("Pragma: no-cache");  
      header("Expires: 0"); 

      echo $html = $this->load->view('word_pre_evaluation', $this->data, true);
      exit;
   }

   public function pre_evaluation_pdf($id)
   {    
      // Get Result
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);
      // dd($this->data['info']);

      // Load View
      $this->data['headding'] = 'সনদপত্র';
      $html = $this->load->view('pre_evaluation_pdf', $this->data, true);
      // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        // Generate PDF
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      // $mpdf->useFixedNormalLineHeight = true;
      // $mpdf->useFixedTextBaseline = true;
      // $mpdf->adjustFontDescLineheight = 2.14;
      $mpdf->WriteHtml($html);
      $mpdf->output('Pre-Exam-'.time().rand().'.pdf', 'I');
   }


   /***************************** Post Exam **********************************
   ***************************************************************************/
   public function post_exam($offset=0){
      $limit = 50;

      // Get Session User Data
      $office = $this->Common_model->get_office_info_by_session();
      $officeID = $office->crrnt_office_id;
      // dd($office);

      // Check Auth
      if($this->ion_auth->in_group('uz')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 2, $officeID);
      }elseif($this->ion_auth->in_group('ddlg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 2, $officeID);
      }elseif($this->ion_auth->in_group('nilg')){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 2, $officeID);
      }elseif($this->ion_auth->in_group('cc')){
         $results = $this->Evaluation_model->get_evaluation_coordinate($limit, $offset, 2);
      }elseif($this->ion_auth->is_admin()){
         $results = $this->Evaluation_model->get_evaluation($limit, $offset, 2);
      }else{
         redirect('dashboard');
      }
      // dd($results); exit();

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/post_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণ পরবর্তী মূল্যায়ন প্রশ্নপত্রের তালিকা';
      $this->data['subview'] = 'post_exam';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function post_exam_participant($id){
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['results'] = $this->Evaluation_model->get_exam_participant($id);
      // dd($this->data['info']);

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণ মূল্যায়নে অংশগ্রহনকারীর তালিকা';
      $this->data['subview'] = 'post_exam_participant';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function post_exam_create(){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('training_id', 'কোর্সের নাম', 'required');
      $this->form_validation->set_rules('training_mark_id', 'মূল্যায়নের বিষয়', 'required');
      $this->form_validation->set_rules('exam_date', 'পরীক্ষার তারিখ', 'required');
      $this->form_validation->set_rules('exam_start_time', 'পরীক্ষা শুরু', 'required');
      $this->form_validation->set_rules('exam_duration', 'পরীক্ষার সময়', 'required');

      if ($this->form_validation->run() == true){
         $courseID = $this->Evaluation_model->get_course_from_training($this->input->post('training_id'));
         $form_data = array(
            'exam_type'        => 2, // PRE
            'exam_set'         => $this->input->post('exam_set'),
            'training_id'      => $this->input->post('training_id'),
            'course_id'        => $courseID->course_id,
            'training_mark_id' => $this->input->post('training_mark_id'),
            'is_published'     => 0,
            'exam_date'       => $this->input->post('exam_date'),
            'exam_start_time' => $this->input->post('exam_start_time'),
            'exam_duration'   => $this->input->post('exam_duration'),
            'created'          => date('Y-m-d H:i:s')                
         );
         // dd($form_data);

         // Insert to DB            
         if($this->Common_model->save('evaluation', $form_data)){  
            // Last insert id
            $lastID = $this->db->insert_id(); 

            // Question 
            for ($i = 0; $i < sizeof($_POST['hideid']); $i++) {
               $data_array = array(
                  'evaluation_id' => $lastID,                        
                  'question_id' => $_POST['hideid'][$i],
                  'qnumber' => $_POST['hidenumber'][$i],
               );
               $this->Common_model->save('evaluation_question', $data_array);
            }

            $this->session->set_flashdata('success', 'নতুন মূল্যায়ন ফরম তৈরি করা হয়েছে');
            redirect('evaluation/post_exam');
         }
      }

      // Dropdown
      $this->data['training'] = $this->Evaluation_model->get_training_not_completed();
      $this->data['office_type'] = $this->Common_model->get_office_type();
      // $this->data['courses'] = $this->Common_model->get_course();
      // $this->data['questions'] = $this->Evaluation_model->get_questions(1);

      // dd($this->data['questions']);

      // Load view
      $this->data['meta_title'] = 'প্রশিক্ষণ পরবর্তী মূল্যায়ন ফরম';
      $this->data['subview'] = 'post_exam_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function post_exam_edit($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('training_id', 'কোর্সের নাম', 'required');
      $this->form_validation->set_rules('training_mark_id', 'মূল্যায়নের বিষয়', 'required');
      $this->form_validation->set_rules('exam_date', 'পরীক্ষার তারিখ', 'required');
      $this->form_validation->set_rules('exam_start_time', 'পরীক্ষা শুরু', 'required');
      $this->form_validation->set_rules('exam_duration', 'পরীক্ষার সময়', 'required');

      if ($this->form_validation->run() == true){
         $courseID = $this->Evaluation_model->get_course_from_training($this->input->post('training_id'));
         $form_data = array(
            // 'exam_type' => 1, // PRE
            'exam_set'        => $this->input->post('exam_set'),
            'training_id'     => $this->input->post('training_id'),
            'course_id'       => $courseID->course_id,
            'training_mark_id'=> $this->input->post('training_mark_id'),
            'is_published'    => $this->input->post('is_published'),
            'exam_date'       => $this->input->post('exam_date'),
            'exam_start_time' => $this->input->post('exam_start_time'),
            'exam_duration'   => $this->input->post('exam_duration'),
            'updated'         => date('Y-m-d H:i:s')                
         );
         // dd($form_data);

         // Insert to DB            
         if($this->Common_model->edit('evaluation', $id, 'id', $form_data)){
            // Last insert id
            // $lastID = $this->db->insert_id(); 

            // Question 
            for ($i = 0; $i < sizeof($_POST['hideid']); $i++) {

               $check = $this->db->where('evaluation_id', $id)->where('question_id', $_POST['hideid'][$i])->get('evaluation_question')->row();
               $data_array = array(
                  'evaluation_id' => $id,                        
                  'question_id' => $_POST['hideid'][$i],
                  'qnumber' => $_POST['hidenumber'][$i],
               );
               if (!empty($check)) {
                  $this->db->where('evaluation_id', $id)->where('question_id', $_POST['hideid'][$i]);
                  $this->db->update('evaluation_question', $data_array);
               } else {
                  $this->Common_model->save('evaluation_question', $data_array);
               }
            }

            $this->session->set_flashdata('success', 'প্রশিক্ষণপূর্ব মূল্যায়ন সম্পাদন করা হয়েছে');
            redirect('evaluation/post_exam');
         }
      }

      // Get Info
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);

      // Dropdown
      $this->data['training'] = $this->Evaluation_model->get_training_not_completed();
      $this->data['office_type'] = $this->Common_model->get_office_type();
      // Traing Marking Type
      // 1=pre_exam, 2=post_exam, 3=module, 4=manual
      $this->data['training_mark'] = $this->Evaluation_model->get_training_mark_by_training_id($this->data['info']->training_id, 2);
      // dd($this->data['training_mark']);

      // Load view
      $this->data['meta_title'] = 'প্রশিক্ষণ পরবর্তী মূল্যায়ন সম্পাদন ফরম';
      $this->data['subview'] = 'post_exam_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // pre exam clone
   public function pre_exam_clone($id){
      // Check Auth
      if(!$this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){
         redirect('dashboard');
      }

      // Insert
      $ev = $this->Evaluation_model->get_evaluation_details($id);
      $form_data = array(
         'exam_type'        => 2, // POST
         'exam_set'         => $ev->exam_set,
         'training_id'      => $ev->training_id,
         'course_id'        => $ev->course_id,
         'training_mark_id' => $ev->training_mark_id,
         'is_published'     => $ev->is_published,
         'created'          => date('Y-m-d H:i:s')                
      );

      // Insert to DB            
      $qs = $this->db->select('*')->where('eq.evaluation_id', $id)->get('evaluation_question eq')->result(); 
      if($this->Common_model->save('evaluation', $form_data)){  
         // Last insert id
         $lastID = $this->db->insert_id(); 
         // Question 
         foreach ($qs as $q) {
            $data_array = array(
               'evaluation_id' => $lastID,                        
               'question_id' => $q->question_id,
               'qnumber' => $q->qnumber,
            );
            $this->Common_model->save('evaluation_question', $data_array);
         }
         $this->session->set_flashdata('success', 'প্রশিক্ষণপূর্ব মূল্যায়ন তৈরি করা হয়েছে');
         redirect('evaluation/post_exam');
      }
      redirect('evaluation/pre_exam');
   }


   public function post_evaluation_form($id){
      // Get Info
      // $results = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      // dd($this->data['info']);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($id);
      // dd($this->data['info']);

      //Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ পরবর্তী মূল্যায়ন ফরম';
      $this->data['subview'] = 'post_evaluation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }   


   /**************************** Trainee Panel *******************************
   ***************************************************************************/
   public function my_pre_exam($offset=0){
      $limit = 50;
      $examType = 1;
      $results = $this->Evaluation_model->get_my_evaluation($limit, $offset, $examType);
      // dd($results);

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/my_pre_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণ পূর্ব মূল্যায়ন প্রশ্নপত্রের তালিকা';
      $this->data['subview'] = 'my_pre_exam';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_pre_exam_form($evaID){
      // Check Auth
      if(!$this->ion_auth->in_group(array('trainee'))){
         redirect('dashboard');
      }
      
      // Decrypt Data        
      $dataID = (int) decrypt_url($evaID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('evaluation', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('Evaluation > my_pre_exam_form', TRUE);
      }
      $dataArr = [];
      // echo $this->auto_answer_examine(36, 13);

      // Get Result
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($dataID);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($dataID);

      $trainingID = $this->data['info']->training_id;
      $tmID = $this->data['info']->training_mark_id;

      // Submit Answer
      if($this->input->post('submit')){
         $inputText = $this->input->post('input_text');
         $inputTextarea = $this->input->post('input_textarea');
         $inputRadio = $this->input->post('input_radio');
         $inputCheck = $this->input->post('input_check');
         $answer_mark = $this->input->post('answer_mark');
         $question_type = $this->input->post('question_type');

         $hideid       = $this->input->post('hideid');
         $keysText     = array();
         $keysTextarea = array();
         $keysRadio    = array();
         $keysCheck    = array();


         // Insert Text Input | Type 1
         if(!empty($inputText)){
            $keysText = array_keys($inputText);
            foreach ($inputText as $key => $value) {
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 1,
                     'answer' => $value,
                     'question_mark' => $answer_mark[$key],
                     'answer_mark' => 0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Textarea Input | Type 2
         if(!empty($inputTextarea)){
            $keysTextarea = array_keys($inputTextarea);
            foreach ($inputTextarea as $key => $value) {
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 2,
                     'answer' => $value,
                     'question_mark' => $answer_mark[$key],
                     'answer_mark' => 0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Radio Input | Type 3
         if(!empty($inputRadio)){          
            $keysRadio = array_keys($inputRadio);
            foreach ($inputRadio as $key => $value) {
               $is_right = $this->auto_answer_examine($key, $value);  // return '1', '0'
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id'      => $dataID,
                     'que_id'      => $key,
                     'que_type'    => 3,
                     'answer'      => $value,
                     'question_mark' => $answer_mark[$key],
                     'is_right'    => $is_right, 
                     'answer_mark' => ($is_right == 1)? $answer_mark[$key]:0,
                     'user_id'     => $this->userSessID,
                     'created'     => date('Y-m-d H:i:s')
                  );
                  // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Checkbox Input | Type 4
         if(!empty($inputCheck)){
            $keysCheck = array_keys($inputCheck);
            foreach ($inputCheck as $key => $value) {
               $imp = implode(',', (array) $value);   
               $is_right = $this->auto_answer_examine($key, $imp);  // return '1', '0'
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 4,
                     'answer' => $imp,
                     'question_mark' => $answer_mark[$key],
                     'is_right'    => $is_right, 
                     'answer_mark' => ($is_right == 1)? $answer_mark[$key]:0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }                    
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert to Answer Sheet Table
         /*for ($i=0; $i<sizeof($dataArr); $i++) {                
            $this->Common_model->save('evaluation_question_answer', $dataArr[$i]);    
         }*/
         $diff_arr1 = array_diff($hideid, $keysText);
         $diff_arr2 = array_diff($diff_arr1, $keysTextarea);
         $diff_arr3 = array_diff($diff_arr2, $keysRadio);
         $diff_arr  = array_diff($diff_arr3, $keysCheck);
         // Insert not answer question
         if(!empty($diff_arr)){
            foreach ($diff_arr as $key => $value) {
               $dataArrs[] = array(
                  'eva_id' => $dataID,
                  'que_id' => $value,
                  'que_type' => $question_type[$value],
                  'answer' => NULL,
                  'is_right' => 3,
                  'question_mark' => $answer_mark[$value],
                  'answer_mark' => 0,
                  'user_id' => $this->userSessID,
                  'created' => date('Y-m-d H:i:s')
               );
               // $this->Common_model->save('evaluation_question_answer', $dataArr);                
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArrs);
         }

         // Mark Insert to Makrsheet Table
         if($this->save_mark($trainingID, $dataID, $tmID, $this->userSessID)){
            $this->session->set_flashdata('success', 'প্রশ্নের উত্তর ডাটাবেজে সংরক্ষণ করা হয়েছে');
            // Redirect 
            redirect('evaluation/my_pre_exam');
         }

      }      

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ পূর্ব মূল্যায়ন প্রশ্নপত্রের ফরম';
      $this->data['subview'] = 'my_pre_exam_form';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function my_post_exam($offset=0){
      $limit = 50;
      $examType = 2;
      $results = $this->Evaluation_model->get_my_evaluation($limit, $offset, $examType);

      // dd($results); exit();
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/my_post_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণ পরবর্তী মূল্যায়ন প্রশ্নপত্রের তালিকা';
      $this->data['subview'] = 'my_post_exam';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_post_exam_form($evaID){
      // Check Auth
      if(!$this->ion_auth->in_group(array('trainee'))){
         redirect('dashboard');
      }

      // Decrypt Data        
      $dataID = (int) decrypt_url($evaID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('evaluation', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('Evaluation > my_post_exam_form', TRUE);
      }
      $dataArr = [];

      // echo $this->auto_answer_examine(36, 13);
      // exit('hello');

      // Get Result
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($dataID);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($dataID);

      $trainingID = $this->data['info']->training_id;
      $tmID = $this->data['info']->training_mark_id;

      // Get Info
      if($this->input->post('submit')){
         $inputText = $this->input->post('input_text');
         $inputTextarea = $this->input->post('input_textarea');
         $inputRadio = $this->input->post('input_radio');
         $inputCheck = $this->input->post('input_check');
         $answer_mark = $this->input->post('answer_mark');
         $question_type = $this->input->post('question_type');

         $hideid       = $this->input->post('hideid');
         $keysText     = array();
         $keysTextarea = array();
         $keysRadio    = array();
         $keysCheck    = array();


         // Insert Text Input | Type 1
         if(!empty($inputText)){
            $keysText = array_keys($inputText);
            foreach ($inputText as $key => $value) {
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 1,
                     'answer' => $value,
                     'question_mark' => $answer_mark[$key],
                     'answer_mark' => 0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Textarea Input | Type 2
         if(!empty($inputTextarea)){
            $keysTextarea = array_keys($inputTextarea);
            foreach ($inputTextarea as $key => $value) {
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 2,
                     'answer' => $value,
                     'question_mark' => $answer_mark[$key],
                     'answer_mark' => 0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Radio Input | Type 3
         if(!empty($inputRadio)){          
            $keysRadio = array_keys($inputRadio);
            foreach ($inputRadio as $key => $value) {
               $is_right = $this->auto_answer_examine($key, $value);  // return '1', '0'
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id'      => $dataID,
                     'que_id'      => $key,
                     'que_type'    => 3,
                     'answer'      => $value,
                     'question_mark' => $answer_mark[$key],
                     'is_right'    => $is_right, 
                     'answer_mark' => ($is_right == 1)? $answer_mark[$key]:0,
                     'user_id'     => $this->userSessID,
                     'created'     => date('Y-m-d H:i:s')
                  );
                  // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Checkbox Input | Type 4
         if(!empty($inputCheck)){
            $keysCheck = array_keys($inputCheck);
            foreach ($inputCheck as $key => $value) {
               $imp = implode(',', (array) $value);   
               $is_right = $this->auto_answer_examine($key, $imp);  // return '1', '0'
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 4,
                     'answer' => $imp,
                     'question_mark' => $answer_mark[$key],
                     'is_right'    => $is_right, 
                     'answer_mark' => ($is_right == 1)? $answer_mark[$key]:0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }                    
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert to Answer Sheet Table
         /*for ($i=0; $i<sizeof($dataArr); $i++) {                
            $this->Common_model->save('evaluation_question_answer', $dataArr[$i]);    
         } */     
         $diff_arr1 = array_diff($hideid, $keysText);
         $diff_arr2 = array_diff($diff_arr1, $keysTextarea);
         $diff_arr3 = array_diff($diff_arr2, $keysRadio);
         $diff_arr  = array_diff($diff_arr3, $keysCheck);
         // Insert not answer question
         if(!empty($diff_arr)){
            foreach ($diff_arr as $key => $value) {
               $dataArrs[] = array(
                  'eva_id' => $dataID,
                  'que_id' => $value,
                  'que_type' => $question_type[$value],
                  'answer' => NULL,
                  'is_right' => 3,
                  'question_mark' => $answer_mark[$value],
                  'answer_mark' => 0,
                  'user_id' => $this->userSessID,
                  'created' => date('Y-m-d H:i:s')
               );
               // $this->Common_model->save('evaluation_question_answer', $dataArr);                
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArrs);
         }

         // Mark Insert to Makrsheet Table
         if($this->save_mark($trainingID, $dataID, $tmID, $this->userSessID)){
            $this->session->set_flashdata('success', 'প্রশ্নের উত্তর ডাটাবেজে সংরক্ষণ করা হয়েছে');
            // Redirect 
            redirect('evaluation/my_post_exam');
         }        
      }      

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ পরবর্তী মূল্যায়ন প্রশ্নপত্রের ফরম';
      $this->data['subview'] = 'my_post_exam_form';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_module_exam($offset=0){
      $limit = 50;
      $examType = 3;
      $results = $this->Evaluation_model->get_my_evaluation($limit, $offset, $examType);

      // dd($results); exit();
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('evaluation/my_module_exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      // Load page
      $this->data['meta_title'] = 'মডিউল ভিত্তিক মূল্যায়ন প্রশ্নপত্রের তালিকা';
      $this->data['subview'] = 'my_module_exam';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function my_module_exam_form($evaID){
      // Check Auth
      if(!$this->ion_auth->in_group(array('trainee')) || empty($evaID)){
         redirect('dashboard');
      }
      
      // Decrypt Data        
      $dataID = (int) decrypt_url($evaID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('evaluation', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('Evaluation > my_post_exam_form', TRUE);
      }
      $dataArr = [];
      
      // echo $this->auto_answer_examine(36, 13);
      // exit('hello');
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($dataID);
      $this->data['questions'] = $this->Evaluation_model->get_question_by_evaluation($dataID);
      // dd($this->data['info']);

      $trainingID = $this->data['info']->training_id;
      $tmID = $this->data['info']->training_mark_id;

      // Get Info
      // Get Info
      if($this->input->post('submit')){
         $inputText = $this->input->post('input_text');
         $inputTextarea = $this->input->post('input_textarea');
         $inputRadio = $this->input->post('input_radio');
         $inputCheck = $this->input->post('input_check');
         $answer_mark = $this->input->post('answer_mark');
         $question_type = $this->input->post('question_type');

         $hideid       = $this->input->post('hideid');
         $keysText     = array();
         $keysTextarea = array();
         $keysRadio    = array();
         $keysCheck    = array();


         // Insert Text Input | Type 1
         if(!empty($inputText)){
            $keysText = array_keys($inputText);
            foreach ($inputText as $key => $value) {
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 1,
                     'answer' => $value,
                     'question_mark' => $answer_mark[$key],
                     'answer_mark' => 0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Textarea Input | Type 2
         if(!empty($inputTextarea)){
            $keysTextarea = array_keys($inputTextarea);
            foreach ($inputTextarea as $key => $value) {
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 2,
                     'answer' => $value,
                     'question_mark' => $answer_mark[$key],
                     'answer_mark' => 0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Radio Input | Type 3
         if(!empty($inputRadio)){          
            $keysRadio = array_keys($inputRadio);
            foreach ($inputRadio as $key => $value) {
               $is_right = $this->auto_answer_examine($key, $value);  // return '1', '0'
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id'      => $dataID,
                     'que_id'      => $key,
                     'que_type'    => 3,
                     'answer'      => $value,
                     'question_mark' => $answer_mark[$key],
                     'is_right'    => $is_right, 
                     'answer_mark' => ($is_right == 1)? $answer_mark[$key]:0,
                     'user_id'     => $this->userSessID,
                     'created'     => date('Y-m-d H:i:s')
                  );
                  // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }             
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert Checkbox Input | Type 4
         if(!empty($inputCheck)){
            $keysCheck = array_keys($inputCheck);
            foreach ($inputCheck as $key => $value) {
               $imp = implode(',', (array) $value);   
               $is_right = $this->auto_answer_examine($key, $imp);  // return '1', '0'
               if($value != NULL){ 
                  $dataArr[] = array(
                     'eva_id' => $dataID,
                     'que_id' => $key,
                     'que_type' => 4,
                     'answer' => $imp,
                     'question_mark' => $answer_mark[$key],
                     'is_right'    => $is_right, 
                     'answer_mark' => ($is_right == 1)? $answer_mark[$key]:0,
                     'user_id' => $this->userSessID,
                     'created' => date('Y-m-d H:i:s')
                  );
                     // $this->Common_model->save('evaluation_question_answer', $dataArr);    
               }                    
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArr);
         }

         // Insert to Answer Sheet Table
         /*for ($i=0; $i<sizeof($dataArr); $i++) {                
            $this->Common_model->save('evaluation_question_answer', $dataArr[$i]);    
         } */     
         $diff_arr1 = array_diff($hideid, $keysText);
         $diff_arr2 = array_diff($diff_arr1, $keysTextarea);
         $diff_arr3 = array_diff($diff_arr2, $keysRadio);
         $diff_arr  = array_diff($diff_arr3, $keysCheck);
         // Insert not answer question
         if(!empty($diff_arr)){
            foreach ($diff_arr as $key => $value) {
               $dataArrs[] = array(
                  'eva_id' => $dataID,
                  'que_id' => $value,
                  'que_type' => $question_type[$value],
                  'answer' => NULL,
                  'is_right' => 3,
                  'question_mark' => $answer_mark[$value],
                  'answer_mark' => 0,
                  'user_id' => $this->userSessID,
                  'created' => date('Y-m-d H:i:s')
               );
               // $this->Common_model->save('evaluation_question_answer', $dataArr);                
            }
            $this->db->insert_batch('evaluation_question_answer', $dataArrs);
         }

         // Mark Insert to Makrsheet Table
         if($this->save_mark($trainingID, $dataID, $tmID, $this->userSessID)){
            $this->session->set_flashdata('success', 'প্রশ্নের উত্তর ডাটাবেজে সংরক্ষণ করা হয়েছে');
            // Redirect 
            redirect('evaluation/my_post_exam');
         }        
      }   

      // Load Page
      $this->data['meta_title'] = 'মডিউল ভিত্তিক মূল্যায়ন প্রশ্নপত্রের ফরম';
      $this->data['subview'] = 'my_module_exam_form';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function my_answer_sheet($evaID){
      // Decrypt Data        
      $dataID = (int) decrypt_url($evaID); //exit;
      // Check Exists
      if (!$this->Common_model->exists('evaluation', 'id', $dataID)) {
         // redirect('dashboard');
         show_404('Evaluation > my_answer_sheet', TRUE);
      }

      // $results = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($dataID);
      $this->data['que_ans_list'] = $this->Evaluation_model->get_question_answer_by_evaluation($dataID);
      // dd($this->data['info']);

      // Evaluation Result
      $this->data['result_right'] = $this->Evaluation_model->get_question_answer_by_user($dataID, $this->userSessID, 1);
      $this->data['result_wrong'] = $this->Evaluation_model->get_question_answer_by_user($dataID, $this->userSessID, 2);
      $this->data['result_not_examin'] = $this->Evaluation_model->get_question_answer_by_user($dataID, $this->userSessID);

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ মূল্যায়নের  উত্তরপত্র';
      $this->data['subview'] = 'my_answer_sheet';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /************************ Exam Function ****************************
   *******************************************************************/
   public function module_exam_participant($id){
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['results'] = $this->Evaluation_model->get_exam_participant($id);
      // dd($this->data['info']);

      // Load page
      $this->data['meta_title'] = 'প্রশিক্ষণ মূল্যায়নে অংশগ্রহনকারীর তালিকা';
      $this->data['subview'] = 'module_exam_participant';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function answer_sheet($evaluationID, $userID){
      // $results = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($evaluationID);
      $this->data['que_ans_list'] = $this->Evaluation_model->get_answer_sheet_by_user($evaluationID, $userID);

      // Evaluation Result
      $evas = $this->Evaluation_model->get_question_answer_by_user($evaluationID, $userID);
      $this->data['que_ans']      = count($this->data['que_ans_list']);
      $this->data['result_right'] = $evas->is_right;
      $this->data['result_wrong'] = $evas->is_wrong;
      $this->data['result_not_examin'] = $this->data['que_ans'] - $evas->is_right - $evas->is_wrong;

      // Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ মূল্যায়নের উত্তরপত্র';
      $this->data['subview'] = 'answer_sheet';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function examine_answer($evaluationID, $type, $userID){
      // $results = $this->Evaluation_model->get_evaluation_details($id);
      $this->data['info'] = $this->Evaluation_model->get_evaluation_details($evaluationID);
      $this->data['que_ans_list'] = $this->Evaluation_model->get_answer_sheet_by_user($evaluationID, $userID);
      // dd($this->data['info']);     

      $trainingID = $this->data['info']->training_id;
      $tmID = $this->data['info']->training_mark_id;
      /*if($this->input->post('submit')){
         dd($this->input->post());
      }*/

      $this->form_validation->set_rules('is_right[]', 'Yes/No', 'required');

      if ($this->form_validation->run() == true){
         $inputRadio = $this->input->post('is_right');
         $answer_mark = $this->input->post('answer_mark');
         // $inputCheck = $this->input->post('input_check');

         // Insert Text Input
         if(!empty($inputRadio)){
            foreach ($inputRadio as $key => $value) {
               $dataArr = array(
                  'is_right' => $value,
                  'answer_mark' => $answer_mark[$key]
               );
               $this->Common_model->edit('evaluation_question_answer', $key, 'id', $dataArr);
            }
         }

         // Check Marksheet Data Exists by Training ID, User ID and Training Mark ID
         $marksheet = $this->Evaluation_model->exists_marksheet_info($trainingID, $userID, $tmID);
         // dd($marksheet);
         if($type == 1) {
            $url = 'evaluation/pre_exam_participant/'.$evaluationID;
         } elseif ($type == 2) {
            $url = 'evaluation/post_exam_participant/'.$evaluationID;
         } else {
            $url = 'evaluation/module_exam_participant/'.$evaluationID;
         }

         if($this->save_mark($trainingID, $evaluationID, $tmID, $userID)){
            $this->session->set_flashdata('success', 'প্রশ্নপত্রের উত্তর যাচাই করে প্রাপ্ত নম্বর ডাটাবেজে সংরক্ষন করা হয়েছে');
            redirect($url);
         }

         /*if($marksheet === false){
            // Insert New Row into Marsheet Table
            if($this->save_mark($trainingID, $evaluationID, $tmID, $userID)){
               $this->session->set_flashdata('success', 'প্রশ্নপত্রের উত্তর যাচাই করে প্রাপ্ত নম্বর ডাটাবেজে সংরক্ষন করা হয়েছে');
               // Redirect 
               redirect($url);
            }
         }else{
            // Update Marksheet Table Row 
            // dd($marksheet);            
            if($this->update_mark($marksheet->id, $evaluationID, $userID)){            
               $this->session->set_flashdata('success', 'প্রশ্নপত্রের উত্তর যাচাই করে প্রাপ্ত নম্বর ডাটাবেজে সংরক্ষন করা হয়েছে');
               // Redirect 
               redirect($url);
            }
         }*/
      }

      //Load Page
      $this->data['meta_title'] = 'প্রশিক্ষণ মূল্যায়নের উত্তরপত্র';
      $this->data['subview'] = 'examine_answer';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function auto_answer_examine($questionID, $givenAnswer){
      // Get answer form question
      $rightAnswer = $this->Evaluation_model->get_answer_by_question($questionID)->answer;
      // dd($rightAnswer);

      // Cross matche Question Answer between Given Answer
      if($rightAnswer == $givenAnswer){
         return 1;
      }else{
         return 2;
      }
   }


   /*********************** Cmmon Function ****************************
   *******************************************************************/   

   function ajax_marksheet_mark_update($id){
      // Get question information
      // $results = $this->Qbank_model->get_info($id); 
      // $this->data['info'] = $results['info'];
      // dd($this->data['info']->question_type);      
      // $answer = NULL;

        // Update answer value        
      $this->form_validation->set_rules('mark', 'নম্বর প্রদন করুন', 'trim');

      // Validate and Insert to DB
      if ($this->form_validation->run() == true) {
         $form_data = array('mark' => $this->input->post('mark'));                
         // dd($form_data); exit;

         if($this->Common_model->edit('marksheet', $id, 'id', $form_data)){
            echo json_encode(array('status' => 1, 'msg' => 'নম্বর সংশোধন করা হয়েছে'));
            $this->session->set_flashdata('success', 'নম্বর সংশোধন করা হয়েছে');
         }else{
            echo json_encode(array('status' => 0, 'msg' => 'Something is wrong!!!'));
         }
      } else {
         echo json_encode(array('status' => 0, 'msg' => validation_errors()));
      }

   }

   function ajax_mark_by_id($id){
      $this->data['info'] = $this->Evaluation_model->get_mark_info($id);
      $this->load->view('ajax_mark', $this->data);
   }

   function ajax_training_mark_by_training_id($trainingID, $type=NULL){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Evaluation_model->get_training_mark_by_training_id($trainingID, $type)));
   }

   public function ajax_question_by_office($id, $evaID = NULL){
      $getEvId = array();
      if ($evaID != NULL) {
         $results = $this->db->select('question_id')->where('evaluation_id', $evaID)->get('evaluation_question')->result();

         if (!empty($results)) {
            foreach ($results as $row) {
               $getEvId[] = $row->question_id;
            }
            $questions = $this->Evaluation_model->get_questions($id, $getEvId);
         } else {
            $questions = $this->Evaluation_model->get_questions($id);
         }

      } else {
         $questions = $this->Evaluation_model->get_questions($id);
      }

      $data = '';
      //$sl=0;
      foreach ($questions as $value) { 
         //$sl++;
         $data .= '<li class="list-group-item grab">
         <h6 class="semi-bold"><i class="fa fa-arrows" aria-hidden="true"></i> '.$value->question_title.'<span style="color:blue; margin-left:5px;">  '  .eng2bng($value->qnumber). '</span></h6>';
         $data .= '<input type="hidden" name="hideid[]" value="'.$value->id.'">';
         $data .= '<input type="hidden" name="hidenumber[]" value="'.$value->qnumber.'">';

         /*
         if($value->question_type == 1){
            $data .= '<input type="text" name="input_text" class="form-control input-sm">';
         }elseif($value->question_type == 2){
            $data .= '<textarea name="input_textarea" class="form-control input-sm"></textarea>';
         }elseif($value->question_type == 3){
            foreach ($value->options as $row) {
               $data .= '<div class="form-check" style="margin-left: 30px;">                
               <label class="form-check-label" for="exampleRadios1">
                  <input class="form-check-input" type="radio" name="input_radios" id="exampleRadios1">
                  <b>'.$row->option_name.'</b>
               </label></div>';
            }
         }elseif($value->question_type == 4){
            foreach ($value->options as $row) {
               $data .= '<div class="form-check" style="margin-left: 30px;">
               <label class="form-check-label" for="defaultCheck1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <b>'.$row->option_name.'</b>
               </label></div>';
            }
         }
         */
         $data .= '</li>';
      }


      //$data = 'Hello-'.$id;
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($data));
   }

   function ajax_evaluation_question_del($id){
      $this->Common_model->delete('evaluation_question', 'id', $id);
      echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
   }

   public function save_mark($trainingID, $evaID, $tmID, $userID){
      $row = $this->Evaluation_model->get_question_answer_by_user($evaID, $userID);
      $form_data = array(
         'training_id'   => $trainingID,
         'user_id'       => $userID,
         'tm_id'         => $tmID,
         'es_id'         => $this->Evaluation_model->get_subject_id($tmID),
         'question_mark' => $row->question_mark,
         'answer_mark'   => $row->answer_mark,
         'mark'          => $row->is_right,
         'pre_question'  => 2,
      );
      // dd($form_data);
      $check = $this->db->where('training_id', $trainingID)->where('user_id', $userID)->where('tm_id', $tmID)->get('marksheet')->row();
      if(empty($check)) {
         $this->Common_model->save('marksheet', $form_data);
      } else {
         $this->db->where('training_id', $trainingID)->where('user_id', $userID)->where('tm_id', $tmID)->update('marksheet', $form_data);
      }
      return true;
   }

   public function update_mark($id, $evaID, $userID){
      $form_data = array(
         'mark' => $this->Evaluation_model->get_question_answer_by_user($evaID, $userID, 1)
         );
      // dd($form_data);
      if($this->Common_model->edit('marksheet', $id, 'id', $form_data)){
         return true;
      }
   }


   /************************** Test Code ******************************
   *******************************************************************/
   public function test(){
      // Load view
      $this->data['meta_title'] = 'প্রশিক্ষণপূর্ব মূল্যায়ন ফরম';
      $this->data['subview'] = 'test2';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function test_drag(){
      //Load view
      $this->data['meta_title'] = 'প্রশিক্ষণপূর্ব মূল্যায়ন ফরম';
      $this->data['subview'] = 'test';
      $this->load->view('backend/_layout_main', $this->data);
   }

   function send_sms($mobile, $message){
      // $api_key = "C20019945dde54c4697d80.43761214";
      $contacts = $mobile;
      // $senderid = '8804445629106';
      $senderid = '8801847121242';
      $sms = $message;
      $username = 'halda';
      $password = 'Dhaka@2021';

      // $URL = "http://sms.nanoitworld.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($senderid)."&msg=".urlencode($sms);
      $URL = "https://api.mobireach.com.bd/SendTextMessage?Username=".urlencode($username)."&Password=".$password."&From=".urlencode($senderid)."&To=".urlencode($contacts)."&Message=".urlencode($sms); 
      // exit;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$URL);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_POST, 0);
      try{
         $output = $content=curl_exec($ch);
         echo '<pre>';
         print_r($output); exit;
      }catch(Exception $ex){
         $output = "-100";
      }
      return $output; 
   }

   function test_sms(){
      $number  = "8801813291011";
      // $number .=$tresults[0]->mobile;
      $msg= "Hello";

      $url = "https://api.mobireach.com.bd";
      $data= array(
         'username'=>"halda",
         'password'=>"Dhaka@2021",
         'number'=>$number,
         'message'=>$msg
         );

      $ch = curl_init(); // Initialize cURL
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $smsresult = curl_exec($ch);
      print_r($smsresult); exit;
      $p = explode("|",$smsresult);
      return $sendstatus = $p[0];
   }


}