<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

class Trainee extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // $this->lang->load('auth');
        $this->load->model('Common_model');
        $this->load->model('Api_model');
    }

    public function training_list_by_user_course_evaluation_get(){
        // Params
        $userID = $this->get('user_id');

        // Get Data
        $data = $this->Api_model->get_training_list_by_user($userID);
        // Add KEY for given trainer evaluation
        foreach ($data as $key => $row) {
            // dd($row);
            $data[$key]->is_answared = $this->Api_model->is_answerd_course_evaluation($row->id, $userID)['count'];
        }
        $results = (array) $data;        
        
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function course_evaluation_answer_by_user_get(){
        // Params
        $trainingID = $this->get('training_id');
        $userID = $this->get('user_id');

        // Get Data
        $data = $this->Api_model->answerd_course_evaluation_by_user($trainingID, $userID);
        $results = (array) $data; 
        
        // Response
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function submit_course_evaluation_by_trainee_post(){
        // Params
        $trainingID = $this->post('training_id');
        $userID = $this->post('user_id');
        $q1_course_topic = $this->post('q1_course_topic');
        $q1_if_not_course_topic_related = $this->post('q1_if_not_course_topic_related');
        $q2_participant_helpful = $this->post('q2_participant_helpful');
        $q2_if_not_participant_helpful = $this->post('q2_if_not_participant_helpful');
        $q3_professional_helpful = $this->post('q3_professional_helpful');
        $q3_if_not_professional_helpful = $this->post('q3_if_not_professional_helpful');
        $q4_course_duration = $this->post('q4_course_duration');
        $q5_use_tool_opinion = $this->post('q5_use_tool_opinion');
        $q6_course_topic_add_sub = $this->post('q6_course_topic_add_sub');
        $q7_accommodation_opinion = $this->post('q7_accommodation_opinion');
        $q8_dining_opinion = $this->post('q8_dining_opinion');
        $q9_course_manage_opinion = $this->post('q9_course_manage_opinion');

        // POST Data
        $form_data = array(
            'training_id' => $trainingID,
            'participant_id' => $userID,
            'q1_course_topic'   => $q1_course_topic,
            'q1_if_not_course_topic_related'=> $q1_if_not_course_topic_related,
            'q2_participant_helpful'        => $q2_participant_helpful,
            'q2_if_not_participant_helpful' => $q2_if_not_participant_helpful,
            'q3_professional_helpful'       => $q3_professional_helpful,
            'q3_if_not_professional_helpful'=> $q3_if_not_professional_helpful,
            'q4_course_duration'        => $q4_course_duration,
            'q5_use_tool_opinion'       => $q5_use_tool_opinion,
            'q6_course_topic_add_sub'   => $q6_course_topic_add_sub,
            'q7_accommodation_opinion'  => $q7_accommodation_opinion,
            'q8_dining_opinion'         => $q8_dining_opinion,
            'q9_course_manage_opinion'  => $q9_course_manage_opinion,
            'created'                   => date('Y-m-d H:i:s')
            );

        // Save to DB
        if($this->Common_model->save('evaluation_course', $form_data)){
            $this->response(array('status'=> 'true', 'message' => 'Data insert successfully'), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'Something is wrong!'), REST_Controller::HTTP_OK);
        }        
    }

    public function training_list_by_user_get(){
        // Params
        $userID = $this->get('user_id');

        // Get Data
        $data = $this->Api_model->get_training_list_by_user($userID);
        $results = (array) $data;        
        
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function training_schedule_list_get(){
        // Params
        $trainingID = $this->get('training_id');
        $userID = $this->get('user_id');

        // Get Data
        $data = $this->Api_model->get_training_schedule_with_trainer($trainingID);
        // Add KEY for given trainer evaluation
        foreach ($data as $key => $row) {
            // dd($row);
            $data[$key]->is_answared = $this->Api_model->is_answerd_trainer_evaluation($row->id, $userID)['count'];
        }
        $results = (array) $data;        
        
        // Response
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }


    public function trainer_topic_evaluation_get(){
        // Params
        $topicID = $this->get('topic_id');

        // Get Data
        $data = $this->Api_model->get_training_schedule_info_by_id($topicID);
        $results = (array) $data;        
        
        // Response
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }

    public function submit_trainer_evaluation_by_trainee_post(){
        // Params
        $trainingID = $this->post('training_id');
        $topicID = $this->post('topic_id');
        $userID = $this->post('user_id');
        $rate_concept_topic = $this->post('rate_concept_topic');
        $rate_concept_topic_comment = $this->post('rate_concept_topic_comment');
        $rate_present_technique = $this->post('rate_present_technique');
        $rate_present_technique_comment = $this->post('rate_present_technique_comment');
        $rate_use_tool = $this->post('rate_use_tool');
        $rate_use_tool_comment = $this->post('rate_use_tool_comment');
        $rate_time_manage = $this->post('rate_time_manage');
        $rate_time_manage_comment = $this->post('rate_time_manage_comment');
        $rate_que_ans_skill = $this->post('rate_que_ans_skill');
        $rate_que_ans_skill_comment = $this->post('rate_que_ans_skill_comment');

        // POST Data
        $form_data = array(
            'training_id' => $trainingID,
            'topic_id' => $topicID,
            'participant_id' => $userID,
            'rate_concept_topic' => $rate_concept_topic,
            'rate_concept_topic_comment' => $rate_concept_topic_comment,
            'rate_present_technique' => $rate_present_technique,
            'rate_present_technique_comment' => $rate_present_technique_comment,
            'rate_use_tool' => $rate_use_tool,
            'rate_use_tool_comment' => $rate_use_tool_comment, 
            'rate_time_manage' => $rate_time_manage,
            'rate_time_manage_comment' => $rate_time_manage_comment,
            'rate_que_ans_skill' => $rate_que_ans_skill,
            'rate_que_ans_skill_comment' => $rate_que_ans_skill_comment,
            'created' => date('Y-m-d H:i:s')
            );

        $subTotal = $rate_concept_topic+$rate_present_technique+$rate_use_tool+$rate_time_manage+$rate_que_ans_skill;

        $form_data['topic_avgrage'] = $subTotal/5;
        // dd($form_data);

        // Save to DB
        if($this->Common_model->save('evaluation_trainer', $form_data)){
            $this->response(array('status'=> 'true', 'message' => 'Data insert successfully'), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'Something is wrong!'), REST_Controller::HTTP_OK);
        }        
    }


    public function trainer_evaluation_answer_sheet_get(){
        // Params
        $trainingID = $this->get('training_id');
        $userID = $this->get('user_id');

        // Get Data
        $data = $this->Api_model->get_trainer_evaluation_result_by_user($trainingID, $userID);
        $results = (array) $data; 
        
        // Response
        if(count($results)){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'data not found', 'result'  => null), REST_Controller::HTTP_OK); 
        }
    }
}
