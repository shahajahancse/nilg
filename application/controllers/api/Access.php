<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// include 'classes/SMSClient.php';

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

class Access extends REST_Controller {
    // var $smsUser;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->lang->load('auth');
        // $this->load->model('My_profile_model');

        // $this->load->model('my_profile/My_profile_model');
		// $this->load->model('Common_model');

        // $this->smsUser = new SMSClient('1587652994', '^Rl:_w=[', 'http://www.sms4bd.net');
        $this->load->helper('string');
    }

    public function login_post(){
        if (empty($this->post('identity'))) {
            $this->response(array('status' => 'false', 'result' => NULL, 'message' =>'Required Username'));
        }

        if (empty($this->post('password'))) {
            $this->response(array('status' => 'false', 'result' => NULL, 'message' =>'Required Password'));
        }

        // $this->response(array('status'=> 'true', 'message' => $this->post('password')), REST_Controller::HTTP_OK);

        // login_apps
        if ($user = $this->ion_auth->login_apps($this->post('identity'), $this->post('password'), 1)){


            // print_r($user); exit;
            // Get User Groups
            $users_groups = $this->ion_auth->get_users_groups($user->id)->result();
            $groups_array = array();
            foreach ($users_groups as $group){
                // $groups_array[$group->id] = $group->description;
                $groups_array['group_id'][]= $group->id;
            }

            // dd($groups_array['group_id']);
            // $result = array('login_info' => $user, 'group_info' => $groups_array);
            $user = (array) $user;
            $user['group_id'] = implode(',', $groups_array['group_id']); //$groups_array['group_id'];

            $result = $user;
            //print_r($user); //exit;


            $this->response(array('status'=> 'true', 'result' => $result, 'message' => 'Success'), REST_Controller::HTTP_OK);
        }else{
            $this->response(['status' => 'false', 'result' => NULL, 'message' => 'Your login credential is wrong'], REST_Controller::HTTP_OK);
        }
        // $this->set_response($message, REST_Controller::HTTP_CREATED);
    }

    /*
    	purpose: this method create for storing trainer evaluatio data
		Creator: Imdadul Haque
		Method: Post
		params: trainer_id, training_id, topic_id, evaluationData(List)
    */
    public function storeEvaluationData_post(){

        if (empty($this->post('evaluation_data'))) {
            $this->response(array('status' => 'false', 'message' =>'Required Evaluation data arrayList'));
        }

        $evData = $this->post('evaluation_data');

         $field_data_array ="participant_id,
                            training_id,
                            topic_id,
                            rate_concept_topic,
                            rate_present_technique,
                            rate_use_tool,
                            rate_time_manage,
                            rate_que_ans_skill,
                            topic_avgrage";


          $field_value_array = '';
          for($i=0; $i<count($evData); $i++){

            $item = $evData[$i];

            $participant_id      = $item['userId'];
            $training_id     = $item['trainingId'];
            $topic_id     = $item['topicId'];
            $rate_concept_topic     = $item['ideaAboutContent'];
            $rate_present_technique     = $item['presentationTechnique'];
            $rate_use_tool     = $item['toolsUsed'];
            $rate_time_manage       = $item['timeMgt'];
            $rate_que_ans_skill = $item['questionAnswerAbility'];

            $totalMark = $rate_concept_topic + $rate_present_technique + $rate_use_tool + $rate_time_manage + $rate_que_ans_skill;

            $avarageRate = $totalMark/5;

            if ($i != 0) $field_value_array .=",";

              $field_value_array .="(".$participant_id.",
                                  ".$training_id.",
                                  ".$topic_id.",
                                  ".$rate_concept_topic.",
                                  ".$rate_present_technique.",
                                  ".$rate_use_tool.",
                                  ".$rate_time_manage.",
                                  ".$rate_que_ans_skill.",
                                  ".$avarageRate.")";


          }

          $sql1 = "INSERT INTO evaluation_trainer (".$field_data_array.") VALUES ".$field_value_array;
          $results = $this->db->query($sql1);

        if($results){
            $this->response(array('status'=> 'true', 'message' => 'Data inserted successfully'), REST_Controller::HTTP_OK);
     	}else{
        	$this->response(array('status'=> 'true', 'message' => 'Data insertion failed'), REST_Controller::HTTP_OK);
    	}
	}

    public function trainingTopicList_get(){

        $userId = $this->get('user_id');

        $this->db->select('ts.*, t.training_title');
        $this->db->from('training_schedule ts');
        $this->db->join('training t', 't.id = ts.training_id', 'LEFT');
        $this->db->where('ts.trainer_id', $userId);
        $this->db->order_by('ts.program_date', 'DESC');
        $result = $this->db->get()->result();

        /*$this->db->select('training_schedule ts');
        $this->db->from('ts.*, t.training_title');
        $this->db->join('training t', 't.id = ts.training_id', 'LEFT');
        $this->db->where('ts.trainer_id', $userId);
        $this->db->order_by('ts.program_date', 'DESC');
        $result = $this->db->get()->result();*/

        if(count($result)>0){
            foreach ($result as $key => $value) {
                $this->db->select('*');
                $this->db->from('evaluation_trainer');
                $this->db->where('training_id', $value->training_id);
                $this->db->where('topic_id', $value->id);
                $data = $this->db->get()->result();

                if(count($data)>0){
                    $result[$key]->is_evaluated = 1;
                }else{
                    $result[$key]->is_evaluated = 0;
                }

                $result[$key]->training_time = date('h:i a', strtotime($value->time_start)).' - '.date('h:i a', strtotime($value->time_end));
                $result[$key]->training_date = date_bangla_calender_format($value->program_date);
            }
        }

        if(count($result)>0){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $result), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'no data found', 'result'  => null), REST_Controller::HTTP_OK);
        }


    }


    public function myProfile_get(){

        $id = $this->get('id');

        $results = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, oc.office_name, u.username,  u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.per_div_id, u.dis_id, u.per_dis_id, u.upa_id, u.per_upa_id, u.union_id, u.is_verify, u.status, u.is_applied, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name, dept.dept_name, u.office_name as user_office_name, u.job_per_date, u.prl_date, u.retirement_date, u.profile_img, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name');
        $this->db->from('users u');
        // $this->db->join('office o', 'o.id = u.office_id', 'LEFT');

        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('department dept', 'dept.id = u.crrnt_dept_id', 'LEFT');
        $this->db->join('office of', 'of.id = u.first_office_id', 'LEFT');
        $this->db->join('designations df', 'df.id = u.first_desig_id', 'LEFT');

        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('employee_type et', 'et.id=u.employee_type' , 'LEFT');
        $this->db->join('marital_status ms', 'ms.id=u.ms_id' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        // $this->db->join('unions uinon', 'union.id=u.uni_id' , 'LEFT');
        $this->db->where('u.id', $id);
        $results = $this->db->get()->row();

        if($results){
            $this->response(array('status'=> 'true', 'message' => 'Data inserted successfully', 'result' => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(array('status'=> 'false', 'message' => 'Data insertion failed', 'result' => null), REST_Controller::HTTP_OK);
        }

    }

    /*public function trainingResultList_get(){

        $trainingId = $this->get('training_id');
        $topicId = $this->get('topic_id');

        $this->db->select('*');
        $this->db->from('evaluation_trainer');
        $this->db->where('training_id', $trainingId);
        $this->db->where('topic_id', $topicId);
        $results = $this->db->get()->result();

        if(count($results)>0){
            $this->response(array('status'=> 'true', 'message' => 'data found', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
           $this->response(array('status'=> 'false', 'message' => 'no data found', 'result'  => null), REST_Controller::HTTP_OK);
        }


    }*/


    public function change_password_post(){
      $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
      $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

          // $user = $this->ion_auth->user()->row();
          // print_r($this->input->post()); exit;
      $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      if ($this->form_validation->run() == true){
         $identity = $this->input->post('identity');

         $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

         if ($change){
                //if the password was successfully changed
                // $this->session->set_flashdata('success', $this->ion_auth->messages());
            $this->response(array('status'=> 'true', 'result'  => 'Password change successfully.'), REST_Controller::HTTP_OK);
                // $this->logout();
        } else {
                // $this->session->set_flashdata('success', $this->ion_auth->errors());
            $this->response(['status' => 'false', 'result' => 'Your old password is wrong.'], REST_Controller::HTTP_OK);
        }

        }else {
                // $this->session->set_flashdata('success', $this->ion_auth->errors());
            $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
                // redirect('my_profile');
        }
          // display the form
          // set the flash data error message if there is one

          // $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');

    }


    public function receive_profile_img_post()
    {
     if (!empty($this->input->post('image'))) {
         $profile_id=$this->input->post('image_name');
         $dt=array('profile_img'=>$profile_id.'.jpg');

         $realpath=$this->img_path = realpath(APPPATH . '../profile_img/');

    			//echo $realpath.$dt['profile_img'];exit;
         $ifp = fopen($realpath.'/'.$dt['profile_img'], "w+" );
         fwrite( $ifp, base64_decode($this->input->post('image')) );
         fclose( $ifp );

         $this->Common_model->edit('users', $profile_id, 'id', $dt);

         $this->response(array('status'=> 'true', 'result'  => 'yes'), REST_Controller::HTTP_OK);
     }
     else
         $this->response(array('status'=> 'true', 'result'  => 'no'), REST_Controller::HTTP_OK);
    }

    public function registration_post(){
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

            // validate form input
        $this->form_validation->set_rules('full_name', 'full name', 'required');
        if($identity_column!=='email'){
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique['.$tables['users'].'.'.$identity_column.']', array(
                'required'      => 'Email or username field is required.',
                'is_unique'     => 'This email or username already exists! Try another.'));
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        }else{
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }

        $this->form_validation->set_rules('dob', 'date of birth', 'trim');
        $this->form_validation->set_rules('gender', 'gender', 'trim');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

            //$this->form_validation->set_message('rule', 'Error Message');

        if ($this->form_validation->run() == true){
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name'    => $this->input->post('full_name'),
                'dob'           => $this->input->post('dob'),
                'gender'        => $this->input->post('gender'),
                'phone'         => $this->input->post('phone')
                );
        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)){
                // check to see if we are creating the user
                // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->response(array('status'=> 'true', 'result'  => 'Registration successfully.'), REST_Controller::HTTP_OK);
                // redirect("login");
        }else{
                // display the create user form
                // set the flash data error message if there is one
            $message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                // print_r($this->data['district']); exit;

            $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
        }
    }

    public function forgot_password_post(){

        if($this->config->item('identity', 'ion_auth') != 'email'){
           $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
       }else{
           $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
       }

       $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

       if ($this->form_validation->run() == true){
                // $identity_column = $this->config->item('identity','ion_auth');
        $identity=$this->input->post('identity');
        $where="username='$identity' OR scout_id='$identity'";
        $userinfo = $this->ion_auth->where($where)->users()->row();


        if(!empty($userinfo->phone)){

            $phone ='+88'.$userinfo->phone;
            $code  = random_string('numeric', 6);
            $message='Your Verify Code: '.$code .' (Bangladesh Scouts)';

            $response = $this->smsUser->SendSMS("softheaven", $phone, $message, date('Y-m-d H:i:s'), SMSType::UCS2);
            $result = $response->StatusMessage;

            if($result = 'Accepted'){
                $newdata = array(
                   'forget_id'  => $userinfo->id,
                   'verify_code' => $code
                   );
                $form_data = array(
                   'verify_code' => $code
                   );

                $this->session->set_userdata($newdata);
                $this->Common_model->edit('users', $userinfo->id, 'id', $form_data);

                $this->response(array('status'=> 'true', 'identity'  => $identity, 'verifycode' => $code, 'result'  => 'SMS send successfully.'), REST_Controller::HTTP_OK);
            }else{
                $this->response(array('status'=> 'false', 'result'  => 'Sorry: SMS Not Send.'), REST_Controller::HTTP_OK);
            }

        }else{
            if($this->config->item('identity', 'ion_auth') != 'email'){
                $this->response(array('status'=> 'false', 'result'  => 'forgot_password_identity_not_found.'), REST_Controller::HTTP_OK);
            }else{
               $this->response(array('status'=> 'false', 'result'  => 'forgot_password_email_not_found.'), REST_Controller::HTTP_OK);
           }
       }
        }else {
                    // $this->session->set_flashdata('success', $this->ion_auth->errors());
            $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
                    // redirect('my_profile');
        }
    }

    public function verifycode_to_change_password_post(){
        $this->form_validation->set_rules('identity', 'Identity', 'trim|required');
        $this->form_validation->set_rules('verify_code', 'Varify Code', 'trim|required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        if ($this->form_validation->run() == true){

            $identity=$this->input->post('identity');
            $where="username='$identity' OR scout_id='$identity'";
            $userinfo = $this->ion_auth->where($where)->users()->row();
            if(!empty($userinfo)){
                $forget_id      = $userinfo->id;
                $verify_code    = $this->session->userdata('verify_code');

                if($userinfo->verify_code==$this->input->post('verify_code')){
                    if($this->input->post('new')==$this->input->post('new_confirm')){
                        $change = $this->ion_auth->forget_change_password($forget_id, $this->input->post('new'));

                        if ($change){

                            $this->response(array('status'=> 'true', 'result'  => 'Password change successfully.'), REST_Controller::HTTP_OK);
                        } else {
                            $this->response(array('status'=> 'false', 'result'  => $this->ion_auth->errors()), REST_Controller::HTTP_OK);
                        }
                    }else{
                        $this->response(array('status'=> 'false', 'result'  => 'Confirm password no match.'), REST_Controller::HTTP_OK);
                    }
                }else{
                    $this->response(array('status'=> 'false', 'result'  => 'Verification code no match.'), REST_Controller::HTTP_OK);
                }
            }else{
                $this->response(array('status'=> 'false', 'result'  => 'Your identity not found.'), REST_Controller::HTTP_OK);
            }


        }else {
                // $this->session->set_flashdata('success', $this->ion_auth->errors());
            $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
                // redirect('my_profile');
        }
    }

}
