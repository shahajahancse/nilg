<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends Backend_Controller {

	public function __construct(){
		parent::__construct();	

        $this->data['module_title'] = 'রেজিস্ট্রেশন';
        $this->load->model('Common_model');
        $this->load->model('Registration_model');
    }    

    public function index(){

        if ($this->ion_auth->logged_in()) :
            redirect('dashboard');
        endif;       

        // Ion Auth Config
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // Default Value
        $empType = NULL;
        $unionID = NULL;
        $upazilaID = NULL;
        $districtID = NULL;
        $divisionID = NULL;


        // Parsonal Data Validation
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        if($identity_column !== 'email'){
            $this->form_validation->set_rules('nid', 'NID','required|trim|integer|min_length[10]|max_length[17]|is_unique['.$tables['users'].'.'.$identity_column.']');
        }        
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim|integer|min_length[11]|max_length[11]');
        // $this->form_validation->set_rules('email', 'email', 'trim|valid_email|callback_email_unique');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'password confirm', 'required|trim');
        
        // Office Data Validation
        $this->form_validation->set_rules('office_type', 'office type', 'required');
        $this->form_validation->set_rules('office', 'office', 'required');
        $this->form_validation->set_rules('designation', 'designation', 'required');


        if($this->input->post('office_type') == 1){
            // Union Parishad
            $this->form_validation->set_rules('division', 'division', 'required');
            $this->form_validation->set_rules('district', 'district', 'required');
            $this->form_validation->set_rules('upazila', 'upazila', 'required');
            $unionID = func_get_union_id($this->input->post('office')); 
        }elseif($this->input->post('office_type') == 2 || $this->input->post('office_type') == 3){
            // Upazila Parishad and Paurashava
            $this->form_validation->set_rules('division', 'division', 'required');
            $this->form_validation->set_rules('district', 'district', 'required');
            $upazilaID = func_get_upazila_id($this->input->post('office'));
        }elseif($this->input->post('office_type') == 4){
            // Zila Parishad
            $this->form_validation->set_rules('division', 'division', 'required');            
            $districtID = func_get_district_id($this->input->post('office'));   
            $divisionID = func_get_division_id($this->input->post('office'));     
        }elseif($this->input->post('office_type') == 5){
            // City Corporation
            $this->form_validation->set_rules('division', 'division', 'required');
            $divisionID = func_get_division_id($this->input->post('office'));        
        }elseif($this->input->post('office_type') == 6){
            // Development Partner
            // $this->form_validation->set_rules('dev_partner', 'development partner', 'required');
            // $this->form_validation->set_rules('dev_partner_designation', 'development partner designation', 'required');
        }elseif($this->input->post('office_type') == 7){
            // NILG Employee
            // $this->form_validation->set_rules('department', 'nilg department', 'required');
            // $this->form_validation->set_rules('designation', 'nilg designation', 'required');
        }

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){
            $email    = strtolower($this->input->post('email'));
            $nid = ($identity_column==='email') ? $email : $this->input->post('nid');
            $password = $this->input->post('password');
            $empType = func_get_emp_type_id($this->input->post('designation')); // Get employee type by Designation
            // Get union, upazila, district id by office table id
            /*if($this->input->post('office_type') == 1){
                $unionID = func_get_union_id($this->input->post('office')); 
            }elseif($this->input->post('office_type') == 2 || $this->input->post('office_type') == 3){
                $upazilaID = func_get_upazila_id($this->input->post('office'));
            }elseif($this->input->post('office_type') == 4 || $this->input->post('office_type') == 5){
                $districtID = func_get_district_id($this->input->post('office'));
            }*/

            $additional_data = array(
                'is_applied'        => 1,
                'office_type'       => $this->input->post('office_type'),
                'employee_type'     => $empType,
                'crrnt_office_id'   => $this->input->post('office'),
                'crrnt_desig_id'    => $this->input->post('designation'),
                'div_id'            => $divisionID != NULL ? $divisionID : $this->input->post('division'),
                'dis_id'            => $districtID != NULL ? $districtID : $this->input->post('district'),
                'upa_id'            => $upazilaID != NULL ? $upazilaID : $this->input->post('upazila'),
                'union_id'          => $unionID,
                'name_bn'           => $this->input->post('name'),                
                'nid'               => $this->input->post('nid'),
                'dob'               => date_db_format($this->input->post('dob')),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email')
                );
            // dd($additional_data);

            // Insert to DB
            $user_group = array('15'); // Guest User
            if ($insert_id = $this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){

                // check to see if the user is logging in
                // check for "remember me"
                if($this->ion_auth->login($this->input->post('nid'), $this->input->post('password'), 1)){
                    //if the login is successful
                    //redirect them back to the home page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('dashboard');
                    // redirect('registration/application_form');
                }else{
                    $this->session->set_flashdata('message', 'Something is wrong!');
                    redirect("login");    
                }

                // check to see if we are creating the user
                // redirect them back to the admin page
                /*
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("login");
                */
            }
        }

        // Display the create user form
        // Set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // Dropdown
        // $this->data['district'] = $this->Common_model->get_district();
        // $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        // $this->data['blood_group'] = $this->Common_model->get_blood_group(); 
        $this->data['office_type'] = $this->Common_model->get_office_type(); 
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['dev_partner'] = $this->Common_model->get_development_partner();
        // dd($this->data['district']);

        // View
        $this->data['meta_title'] = 'প্রশিক্ষণার্থী রেজিস্ট্রেশন';
        $this->data['subview'] = 'index';
        $this->load->view('login/_layout_main', $this->data);
    }    

    public function trainer(){
        redirect('login');
        
        if ($this->ion_auth->logged_in()) :
            redirect('login');
        endif;

        // Ion Auth Config
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // Default Value
        $empType = NULL;
        $unionID = NULL;
        $upazilaID = NULL;
        $districtID = NULL;

        // Parsonal Data Validation
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        if($identity_column !== 'email'){
            $this->form_validation->set_rules('nid', 'NID','required|trim|integer|min_length[10]|max_length[17]|is_unique['.$tables['users'].'.'.$identity_column.']');
        }        
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim|integer|min_length[11]|max_length[11]');
        // $this->form_validation->set_rules('email', 'email', 'trim|valid_email|callback_email_unique');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'password confirm', 'required|trim');
        
        // Office Data Validation
        // $this->form_validation->set_rules('office_type', 'office type', 'required');
        // $this->form_validation->set_rules('office', 'office', 'required');
        // $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('office_name', 'office_name', 'required');

        // if($this->input->post('office_type') == 1){
        //     $this->form_validation->set_rules('division', 'division', 'required');
        //     $this->form_validation->set_rules('district', 'district', 'required');
        //     $this->form_validation->set_rules('upazila', 'upazila', 'required');
        //     $unionID = func_get_union_id($this->input->post('office')); 
        // }elseif($this->input->post('office_type') == 2 || $this->input->post('office_type') == 3){
        //     $this->form_validation->set_rules('division', 'division', 'required');
        //     $this->form_validation->set_rules('district', 'district', 'required');
        //     // $upazilaID = func_get_upazila_id($this->input->post('office'));
        // }elseif($this->input->post('office_type') == 4 || $this->input->post('office_type') == 5){
        //     $this->form_validation->set_rules('division', 'division', 'required');
        //     // $districtID = func_get_district_id($this->input->post('office'));
        // }

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){
            $email    = strtolower($this->input->post('email'));
            $nid = ($identity_column==='email') ? $email : $this->input->post('nid');
            $password = $this->input->post('password');

            $additional_data = array(                
                'is_applied'        => 1,
                'name_bn'           => $this->input->post('name'),                
                'nid'               => $this->input->post('nid'),
                'dob'               => date_db_format($this->input->post('dob')),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),
                'office_name'       => $this->input->post('office_name'),
                'designation'       => $this->input->post('designation'),
                'height_education'  => $this->input->post('height_education'),
                'interested_subjects'=> $this->input->post('interested_subjects'),
                'present_address'   => $this->input->post('present_address'),
                );
            
            /*
            echo '<pre>';
            print_r($additional_data); exit;
            */            

            // Insert to DB
            $user_group = array('15'); // Guest User
            if ($insert_id = $this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){

                // check to see if the user is logging in
                // check for "remember me"
                if($this->ion_auth->login($this->input->post('nid'), $this->input->post('password'), 1)){
                    //if the login is successful
                    //redirect them back to the home page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('dashboard');
                    // redirect('registration/trainer_application_form');
                }else{
                    $this->session->set_flashdata('message', 'Something is wrong!');
                    redirect("login");    
                }

                // check to see if we are creating the user
                // redirect them back to the admin page
                /*
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("login");
                */
            }
        }

        // Display the create user form
        // Set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // Dropdown
        // $this->data['district'] = $this->Common_model->get_district();
        // $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        // $this->data['blood_group'] = $this->Common_model->get_blood_group(); 
        $this->data['office_type'] = $this->Common_model->get_office_type(); 
        $this->data['division'] = $this->Common_model->get_division();

        // echo '<pre>';
        // print_r($this->data['district']); exit;

        // View
        $this->data['meta_title'] = 'প্রশিক্ষক রেজিস্ট্রেশন';
        $this->data['subview'] = 'trainer';
        $this->load->view('login/_layout_main', $this->data);
    }    

    public function email_unique($str){
        // alpha_dash_space
        // return (!preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
        $exists = $this->Common_model->exists('users', 'email', $str);
        if ($exists) {
            $this->form_validation->set_message('email_unique', 'The %s already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    } 

    function ajax_exists_identity(){
        // echo 'true';
        $item = $_POST['inputData'];
        $result = $this->Common_model->exists('users', 'username', $item);        

        if ($result == 0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }

    /*

    public function submitted_information(){        
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Submitted Information'; exit;

        // Get user submitted information
        $this->data['info'] = $this->Common_model->get_user_submitted_info();

        // Change title and subbiew page
        if($this->data['info']->reg_type == 1){
        // If Trainee
            $title = 'প্রশিক্ষণার্থী হিসাবে দাখিলকৃত তথ্য';
            $page = 'submitted_information_trainee';
        }elseif($this->data['info']->reg_type == 2){
        // If Trainer
            $title = 'প্রশিক্ষক হিসাবে দাখিলকৃত তথ্য';
            $page = 'submitted_information_trainer';
        }


        // Load page       
        $this->data['meta_title'] = $title;
        $this->data['subview'] = $page;
        $this->load->view('backend/_layout_main', $this->data);
    }
    
    public function course(){
        // Results
        $this->data['results'] = $this->Registration_model->get_training_circular();
        // dd($this->data['results']);

        // View
        $this->data['meta_title'] = 'কোর্স রেজিস্ট্রেশন';
        $this->data['subview'] = 'course';
        $this->load->view('login/_layout_main', $this->data);
    }

    public function course_application($id){
        // Office Data Validation
        $this->form_validation->set_rules('nid', 'NID','required|trim|integer|min_length[10]|max_length[17]');
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('pin', 'pin', 'required');

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){

            $ip = $this->input->ip_address();
            $nid = $this->input->post('nid');
            $dob = date_db_format($this->input->post('dob'));
            $trainingID = $this->input->post('hide_training_id');
            $pin = $this->input->post('pin');

            // dd($this->Registration_model->check_is_applied(103, 114));

            // Check existes trainee NID
            if($this->Registration_model->exists_nid($nid) == true){
                // Match NID and DOB
                if($this->Registration_model->match_nid_dob($nid, $dob) == true){
                    // Match course ID and PIN
                    if($this->Registration_model->match_training_id_pin($trainingID, $pin) == true){
                        // Get applicant info
                        $user = $this->Registration_model->get_applicant_info($nid);
                        // dd($user);

                        // If application dropped before
                        if($this->Registration_model->check_is_applied($trainingID, $user->id) == true){
                            // Course apply
                            $this->session->set_flashdata('warning', 'এই কোর্সে আপনি পূর্বে আবেদন করেছেন!');
                        }else{
                            // Store application to database
                            $data = array(
                                'training_id'   => $trainingID,
                                'app_user_id'   => $user->id,
                                'app_date'      => date('Y-m-d H:i:s'),
                                'is_apply'      => 1,
                                'ip_address'    => $ip
                                );
                            if($this->Common_model->save('training_participant', $data)){
                            // Success
                                $this->session->set_flashdata('success', 'আপনার আবেদনটি সঠিকভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
                                redirect("registration/course_application_success");
                            }
                        }
                    }else{
                        // PIN not match
                        $this->session->set_flashdata('warning', 'পিন নম্বর সঠিক হয়নি!');
                    }
                }else{
                    // Not match NID and DOB
                    $this->session->set_flashdata('warning', 'এনআইডি অথবা জন্ম তারিখ সঠিক হয়নি!');
                }
            }else{
                // NID not found
                $this->session->set_flashdata('warning', 'এন আই ডি পাওয়া যাইনি!');
            }


            $form_data = array(
                'is_applied'    => 0,
                'is_verify'     => $this->input->post('verify_status')
                );            
            // print_r($id);exit();

            if($this->Common_model->edit('users', $id, 'id', $form_data)){

                // Change user group and message
                if($this->input->post('verify_status') == 1){
                    // Change user group 'guest' to 'trainee'
                    $this->ion_auth->remove_from_group('', $id);
                    $this->ion_auth->add_to_group('10', $id);
                    $message = 'আবেদনটি যাচাই করে প্রশিক্ষণার্থী হিসাবে নিবন্ধন করা হয়েছে';

                }elseif($this->input->post('verify_status') == 2){
                    $message = 'আবেদনটি বাতিল করা হয়েছে';
                }

                // echo $this->db->last_query(); exit;
                $this->session->set_flashdata('success', $message);
                redirect("trainee/all_pr");
            }
        }

        // Results
        $this->data['info'] = $this->Registration_model->get_course_info($id);
        // dd($this->data['results']);

        // View
        $this->data['meta_title'] = 'কোর্স রেজিস্ট্রেশনের জন্য আবেদন ফরম';
        $this->data['subview'] = 'course_application';
        $this->load->view('login/_layout_main', $this->data);
    }

    public function course_application_success(){
        // View
        $this->data['meta_title'] = 'কোর্সের আবেদন সফলভাবে সম্পন্ন হয়েছে';
        $this->data['subview'] = 'course_application_success';
        $this->load->view('login/_layout_main', $this->data);
    }

    public function trainer_application_form()
    {
        // echo "string"; exit();
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Information Form'; exit;

        // Get user information
        $this->data['info'] = $this->Common_model->get_user_info();
        $employeeType = $this->data['info']->employee_type;
        $userID = $this->data['info']->id;
        // dd($this->data['info']);

        // If not trainee 
        if($this->data['info']->reg_type != 2){
            redirect('registration/application_form');
        }

        $this->form_validation->set_rules('trainer_name', 'প্রশিক্ষকের নাম', 'required|trim');
        $this->form_validation->set_rules('name_en', 'প্রশিক্ষকের নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('trainer_desig', 'পদবি', 'required|trim');
        $this->form_validation->set_rules('trainer_org_name', 'প্রতিষ্ঠানের নাম', 'required|trim');
        $this->form_validation->set_rules('max_education', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা', 'required|trim');
        $this->form_validation->set_rules('mobile', 'মোবাইল নাম্বার', 'required|trim');   

        // Submit infromation of Public Representative, Emaployee
        //Validation
        // $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        // $this->form_validation->set_rules('name_en', 'name english', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_bn' => $this->input->post('trainer_name'),
                'name_en' => $this->input->post('name_en'),
                'designation'       => $this->input->post('trainer_desig'),
                'office_name' => $this->input->post('trainer_org_name'),
                'height_education' => $this->input->post('max_education'),
                'mobile_no' => $this->input->post('mobile'),
                'phone_office' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'present_add' => $this->input->post('present_address'),
                'interested_subjects' => $this->input->post('interested_subject'),
                'is_applied' => 1,
                'is_verify' => 0
                );
            // print_r($form_data); exit;
            if($this->Common_model->edit('users', $userID, 'id', $form_data)){                
                $this->session->set_flashdata('success', 'আপনার রেজিস্ট্রেশন আবেদনটি সফলভাবে আমাদের ডাটাবেজে সংরক্ষিত হয়েছে');
                // echo "successful"; exit();
                redirect('registration/submitted_information');
            }
        }        

        // Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        // $this->data['office'] = $this->Common_model->get_office();
        $this->data['designation'] = $this->Common_model->get_designations(1);

        $this->data['exams'] = $this->Common_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'boards', '1');
        $this->data['leave_type'] = $this->Common_model->get_leave_type();

        // Load page       
        $this->data['meta_title'] = 'প্রশিক্ষক রেজিস্ট্রেশনের আবেদন ফর্ম';
        $this->data['subview'] = 'trainer_application_form';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function application_form(){        
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Information Form'; exit;

        // Get user information
        $this->data['info'] = $this->Common_model->get_user_info();
        // dd($this->data['info']); exit;
        // echo $this->data['info']->reg_type; exit();
        $employeeType = $this->data['info']->employee_type;
        $userID = $this->data['info']->id;


        // If not trainer 
        if($this->data['info']->reg_type != 2){
            redirect('registration/trainer_application_form');
        }

        // Submit infromation of Public Representative, Emaployee
        if($employeeType == 1){
        // 1='Jonoprothinidhi'
            //Validation
            $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
            $this->form_validation->set_rules('name_en', 'name english', 'required|trim');

            if ($this->form_validation->run() == true)
            {

                $form_data = array(
                    'is_applied'            => 1, 
                    'name_bn'               => $this->input->post('name_bn'),
                    'name_en'               => strtoupper($this->input->post('name_en')),
                    'father_name'           => $this->input->post('father_name'),
                    'mother_name'           => $this->input->post('mother_name'),
                    'gender'                => $this->input->post('gender'),
                    'ms_id'                 => $this->input->post('ms_id'),
                    'son_no'                => $this->input->post('son_no'),
                    'daughter_no'           => $this->input->post('daughter_no'),
                    'present_add'           => $this->input->post('present_add'),
                    'per_div_id'            => $this->input->post('per_div_id'),
                    'per_dis_id'            => $this->input->post('per_dis_id'),
                    'per_upa_id'            => $this->input->post('per_upa_id'),
                    'per_road_no'           => $this->input->post('per_road_no'),
                    'permanent_add'         => $this->input->post('permanent_add'),
                    'per_pc'                => $this->input->post('per_pc'),
                    'per_po'                => $this->input->post('per_po'),
                    'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
                    'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                    'first_office_id'       => $this->input->post('first_office_id'),
                    'first_desig_id'        => $this->input->post('first_desig_id'),
                    'first_elected_year'    => $this->input->post('first_elected_year'),
                    'first_attend_date'     => $this->input->post('first_attend_date'),
                    'elected_times'         => $this->input->post('elected_times'),
                    'modified'              => date('Y-m-d H:i:s')
                    );

                if ($this->Common_model->edit('users', $userID, 'id', $form_data))
                {
                    // Experiance 
                    for ($i=0; $i<sizeof($_POST['exp_office_id']); $i++) {
                        $experience_data = array(
                            'data_id' => $userID,
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration' => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $experience_data);
                    }
                    // Education 
                    for ($i=0; $i<sizeof($_POST['edu_exam_id']); $i++) {
                        $education_data = array(
                            'data_id' => $userID,
                            'edu_exam_id' => $_POST['edu_exam_id'][$i],
                            'edu_pass_year' => $_POST['edu_pass_year'][$i],
                            'edu_subject_id' => $_POST['edu_subject_id'][$i],
                            'edu_board_id' => $_POST['edu_board_id'][$i],
                            );
                        $this->Common_model->save('per_education', $education_data);
                    }
                    // NILG training
                    for ($i=0; $i<sizeof($_POST['nilg_course_id']); $i++) {
                        $local_org_data = array(
                            'data_id' => $userID,
                            'nilg_course_id' => $_POST['nilg_course_title'][$i],
                            'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                            'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                            'nilg_training_start' => $_POST['nilg_training_start'][$i],
                            'nilg_training_end' => $_POST['nilg_training_end'][$i],
                            );
                        $this->Common_model->save('per_nilg_training', $local_org_data);
                    }
                    // Local organization training
                    for ($i=0; $i<sizeof($_POST['local_course_name']); $i++) {
                        $local_org_data = array(
                            'data_id' => $userID,
                            'local_course_name' => $_POST['local_course_name'][$i],
                            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                            'local_training_start' => $_POST['local_training_start'][$i],
                            'local_training_end' => $_POST['local_training_end'][$i],
                            );
                        $this->Common_model->save('per_local_org_training', $local_org_data);
                    }
                    // Foreign organization training
                    for ($i=0; $i<sizeof($_POST['foreign_course_name']); $i++) {
                        $foreign_org_data = array(
                            'data_id' => $userID,
                            'foreign_course_name' => $_POST['foreign_course_name'][$i],
                            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                            'foreign_training_start' => $_POST['foreign_training_start'][$i],
                            'foreign_training_end' => $_POST['foreign_training_end'][$i],
                            );
                        $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
                    }

                    // Message
                    $this->session->set_flashdata('success', 'আপনার রেজিস্ট্রেশন আবেদনটি সফলভাবে আমাদের ডাটাবেজে সংরক্ষিত হয়েছে');
                    redirect('registration/submitted_information');
                }
            }

        }elseif($employeeType == 2 || $employeeType == 3){
        // 2=কর্মকর্তা, 3=কর্মচারী
             //Validation
            $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
            $this->form_validation->set_rules('name_en', 'name english', 'required|trim');

            if ($this->form_validation->run() == true)
            {
                $form_data = array(
                    'is_applied'            => 1,
                    'name_bn'               => $this->input->post('name_bn'),
                    'name_en'               => strtoupper($this->input->post('name_en')),
                    'father_name'           => $this->input->post('father_name'),
                    'mother_name'           => $this->input->post('mother_name'),
                    'gender'                => $this->input->post('gender'),
                    'ms_id'                 => $this->input->post('ms_id'),
                    'son_no'                => $this->input->post('son_no'),
                    'daughter_no'           => $this->input->post('daughter_no'),
                    'present_add'           => $this->input->post('present_add'),
                    'per_div_id'            => $this->input->post('per_div_id'),
                    'per_dis_id'            => $this->input->post('per_dis_id'),
                    'per_upa_id'            => $this->input->post('per_upa_id'),
                    'per_road_no'           => $this->input->post('per_road_no'),
                    'permanent_add'         => $this->input->post('permanent_add'),
                    'per_pc'                => $this->input->post('per_pc'),
                    'per_po'                => $this->input->post('per_po'),
                    'first_office_id'       => $this->input->post('first_office_id'),
                    'crrnt_office_id'       => $this->input->post('crrnt_office_id'),
                    'first_desig_id'        => $this->input->post('first_desig_id'),
                    'crrnt_desig_id'        => $this->input->post('crrnt_desig_id'),
                    'first_attend_date'     => $this->input->post('first_attend_date'),
                    'crrnt_attend_date'     => $this->input->post('curr_attend_date'),
                    'job_per_date'          => $this->input->post('job_per_date'),
                    'retirement_date'       => $this->input->post('retirement_date'),
                    'prl_date'              => $this->input->post('retirement_prl_date'),
                    'modified'              => date('Y-m-d H:i:s')
                    );

                if($this->Common_model->edit('users', $userID, 'id', $form_data))
                {   
                     // Experiance 
                    for ($i=0; $i<sizeof($_POST['exp_office_id']); $i++)
                    {
                        $experience_data = array(
                            'data_id' => $userID,
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration' => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $experience_data);
                    }     
                     // promotion 
                    for ($i=0; $i<sizeof($_POST['promo_org_name']); $i++)
                    {
                        $promotion_data = array(
                            'data_id' => $userID,
                            'promo_org_name'     => $_POST['promo_org_name'][$i],
                            'promo_desig_id'     => $_POST['promo_desig_id'][$i],
                            'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                            'promo_comments'     => $_POST['promo_comments'][$i],
                            );
                        $this->Common_model->save('per_promotion', $promotion_data);
                    } 
                    // Education 
                    for ($i=0; $i<sizeof($_POST['edu_exam_id']); $i++) {
                        $education_data = array(
                            'data_id' => $userID,
                            'edu_exam_id' => $_POST['edu_exam_id'][$i],
                            'edu_pass_year' => $_POST['edu_pass_year'][$i],
                            'edu_subject_id' => $_POST['edu_subject_id'][$i],
                            'edu_board_id' => $_POST['edu_board_id'][$i],
                            );
                        $this->Common_model->save('per_education', $education_data);
                    }
                    // NILG training
                    for ($i=0; $i<sizeof($_POST['nilg_course_id']); $i++) {
                        $local_org_data = array(
                            'data_id' => $userID,
                            'nilg_course_id' => $_POST['nilg_course_title'][$i],
                            'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                            'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                            'nilg_training_start' => $_POST['nilg_training_start'][$i],
                            'nilg_training_end' => $_POST['nilg_training_end'][$i],
                            );
                        $this->Common_model->save('per_nilg_training', $local_org_data);
                    }
                    // Local organization training
                    for ($i=0; $i<sizeof($_POST['local_course_name']); $i++) {
                        $local_org_data = array(
                            'data_id' => $userID,
                            'local_course_name' => $_POST['local_course_name'][$i],
                            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                            'local_training_start' => $_POST['local_training_start'][$i],
                            'local_training_end' => $_POST['local_training_end'][$i],
                            );
                        $this->Common_model->save('per_local_org_training', $local_org_data);
                    }
                    // Foreign organization training
                    for ($i=0; $i<sizeof($_POST['foreign_course_name']); $i++) {
                        $foreign_org_data = array(
                            'data_id' => $userID,
                            'foreign_course_name' => $_POST['foreign_course_name'][$i],
                            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                            'foreign_training_start' => $_POST['foreign_training_start'][$i],
                            'foreign_training_end' => $_POST['foreign_training_end'][$i],
                            );
                        $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
                    }        
                    $this->session->set_flashdata('success', 'আপনার রেজিস্ট্রেশন আবেদনটি সফলভাবে আমাদের ডাটাবেজে সংরক্ষিত হয়েছে');
                    // echo "successful"; exit();
                    redirect('registration/submitted_information');
                }
                
            }

        }


        // Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['office'] = $this->Common_model->get_office();
        $this->data['designation'] = $this->Common_model->get_designations(1);

        $this->data['exams'] = $this->Common_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'boards', '1');
        $this->data['leave_type'] = $this->Common_model->get_leave_type();
        $this->data['employeeType'] = $employeeType;

        // Application Form Interface Public Representative (PR) and Empployee
        if($this->data['info']->employee_type == 1){
            $page = 'application_form_pr';
        }else{
            $page = 'application_form_employee';
        }


        // Load page       
        $this->data['meta_title'] = $this->data['info']->employee_type_name.'র রেজিস্ট্রেশনের আবেদন ফর্ম';
        $this->data['subview'] = $page;
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function employee_form(){        
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Information Form'; exit;

        // Get user information
        $this->data['info'] = $this->Common_model->get_user_info();
        // dd($this->data['info']);


        $employeeType = 'কর্মকর্তা / কর্মচারী';


        // Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['office'] = $this->Common_model->get_office();
        $this->data['designation'] = $this->Common_model->get_designations(1);

        $this->data['exams'] = $this->Common_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'boards', '1');
        $this->data['leave_type'] = $this->Common_model->get_leave_type();

        // Load page       
        $this->data['meta_title'] = $employeeType.' রেজিস্ট্রেশনের আবেদন ফর্ম';
        $this->data['subview'] = 'employee_form';
        $this->load->view('backend/_layout_main', $this->data);
    }
    */

}
