<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_profile extends Backend_Controller {
	
    var $userSeessID;
    var $img_orginal_path;
    var $img_thumb_path;
    var $img_path;

    public function __construct(){
        parent::__construct();
        $this->data['module_title'] = 'মাই প্রোফাইল';

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('My_profile_model');        
        $this->userSeessID = $this->session->userdata('user_id');
        $this->img_orginal_path = realpath(APPPATH . '../uploads/temp_dir/');
        $this->img_thumb_path = realpath(APPPATH . '../uploads/temp_dir/_thumb/');
        $this->img_path = realpath(APPPATH . '../uploads/profile/');
        $this->signature_path = realpath(APPPATH . '../uploads/signature');
    }

    // change 07-03-2022
    /*
    public function index()
    {
        if($this->ion_auth->in_group('trainer')){
            $this->data['info'] = $this->Common_model->get_user_submitted_info();
            $page = 'index_trainer';

        }elseif($this->ion_auth->in_group('trainee')){

            // Get all information
            $results = $this->My_profile_model->get_trainee_all_data();
            // dd($results['info']);

            $this->data['info'] = $results['info'];        
            $this->data['experience'] = $results['experience'];
            $this->data['education'] = $results['education'];
            $this->data['nilg_training'] = $results['nilg_training'];
            $this->data['local_training'] = $results['local_training'];

            $this->data['promotion'] = $results['promotion'];
            // $this->data['leave'] = $results['leave'];
            $this->data['foreign_training'] = $results['foreign_training'];

            // Details of Public Representative (PR) and Empployee
            if($this->data['info']->employee_type == 1){
                $page = 'index_pr';
            }else{
                $page = 'index_employee';
            }
        }else{H
            redirect('dashboard');
        }

        // Load page       
        $this->data['meta_title'] = 'মাই প্রোফাইল';
        $this->data['subview'] = $page;
        $this->load->view('backend/_layout_main', $this->data);
    }
    */

    public function index(){
        //
        $this->data['experience'] = $this->data['education'] = $this->data['nilg_training'] = 0;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $this->userSeessID)) {
            show_404('Trainee - details - exists', TRUE);
        }


        // Get all information
        $results = $this->My_profile_model->get_details_info($this->userSeessID);
        // dd($results['info']);

        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['promotion'] = $results['promotion'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];
        $this->data['foreign_training'] = $results['foreign_training'];
        // $this->data['leave'] = $results['leave'];

        // Current role play
        $this->data['currentGroups'] = $this->ion_auth->get_users_groups($this->userSeessID)->result();
        // dd($this->data['currentGroups']);

        // Load Page
        $this->data['meta_title'] = 'মাই প্রোফাইল';

        if($this->ion_auth->in_group('trainee')){
            if($this->data['info']->employee_type == 1){ // Public Representative
                $this->data['subview'] = 'pr_details';
            }else{ // Employee (কর্মকর্তা/কর্মচারী)
                if ($results['info']->office_type == 7) { // NILG Employee
                    $this->data['subview'] = 'nilg_employee_details';
                }elseif ($results['info']->office_type == 6) { // Development Partner
                    $this->data['subview'] = 'partner_details';
                } else {
                    $this->data['subview'] = 'employee_details';
                }
            }
        }elseif($this->ion_auth->in_group('trainer')){
            $this->data['subview'] = 'index_trainer'; // Trainer
        }
        
        $this->load->view('backend/_layout_main', $this->data);
    }

    /**************************** Edit Trainee / pr ************************/
    /******************************************************************/
    // personal info
    public function edit_trainee_general_info($userID)
    {
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }
        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $get_user_type = $results['info']->employee_type;
        // dd($results['info']);

        // Validation
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name english', 'required|trim');

        // Validate and Insert Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
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
                'email'                 => $this->input->post('email'),
                'birth_place'           => $this->input->post('birth_place'),
                'quota_id'              => $this->input->post('quota_id'),
                'religion_id'           => $this->input->post('religion_id'),
                'status'                => $this->input->post('status'),
                'modified'              => date('Y-m-d H:i:s')
                );

            if ($this->Common_model->edit('users', $dataID, 'id', $form_data)) {
                // Copy image, rename and remove from temp directory
                if ($this->input->post('hide_img') != NULL) {
                    $file_name = $this->input->post('hide_img');
                    $tmp = explode('.', $file_name);
                    $file_extension = end($tmp);

                    //Copy file and rename
                    $file = $this->img_thumb_path . '/' . $this->input->post('hide_img');
                    // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                    $newfile = $dataID . '.' . $file_extension;

                    //Update table image field
                    if ($this->Common_model->set_profile_image($dataID, $newfile)) {
                        $saveDir = $this->img_path . '/' . $newfile;
                        if (copy($file, $saveDir)) {
                            // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                            @unlink($this->img_orginal_path . '\\' . $tmp[0] . '-original.png');
                            @unlink($this->img_orginal_path . '\\' . $tmp[0] . '-original.jpg');
                            @unlink($this->img_orginal_path . '\\' . $tmp[0] . '-original.jpeg');
                            @unlink($this->img_thumb_path . '\\' . $file_name);

                            //$this->session->set_flashdata('success', 'Image update successfully.');
                            //redirect('my_profile');
                        }
                    }
                }

                // dd($_FILES);
                // Signature Upload
                if(!empty($_FILES['signature']) && $_FILES['signature']['size'] > 0){
                 $new_file_name = time().'-'.$dataID;
                 $config['allowed_types']= 'jpg|png|jpeg';
                 $config['upload_path']  = $this->signature_path;
                 $config['file_name']    = $new_file_name;
                 $config['max_size']     = 600;

                 $this->load->library('upload', $config);
                       //upload file to directory
                 if($this->upload->do_upload('signature')){
                  $uploadData = $this->upload->data();
                  $config = array(
                   'source_image' => $uploadData['full_path'],
                   'new_image' => $this->signature_path,
                   'maintain_ratio' => TRUE,
                   'width' => 300,
                   'height' => 300
                   );
                  $this->load->library('image_lib',$config);
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();

                  $uploadedFile = $uploadData['file_name'];
                          // print_r($uploadedFile);
                          // DB fields
                  $form_data['signature'] = $uploadedFile;
                  $this->Common_model->edit('users', $dataID, 'id', $form_data);
              }else{
                  $this->data['message'] = $this->upload->display_errors();
              }
          }


                // Message
          $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
          redirect('my_profile');
      }
  }

        // load view data
  $this->data['info'] = $results['info'];
                // dd($this->data['info']);
                // Dropdown List
  $this->data['division'] = $this->Common_model->get_division();
  $this->data['district'] = $this->Common_model->get_district();
  $this->data['upazila'] = $this->Common_model->get_upazila_thana();
  $this->data['marital_status'] = $this->Common_model->get_marital_status();
  $this->data['quota'] =    $this->Common_model->get_quota();
  $this->data['religion'] = $this->Common_model->get_religion();
  $this->data['status'] = $this->Common_model->get_data_status();

                // Load page
  $this->data['meta_title'] = 'ব্যাক্তিগত বা সাধারণ তথ্য সংশোধন ফর্ম';
  $this->data['subview'] = 'edit_trainee_general_info';
  $this->load->view('backend/_layout_main', $this->data);
}    


    // pr Official info
public function edit_trainee_pr_official($userID)
{
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }

        // Validation
        $this->form_validation->set_rules('crrnt_elected_year', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Validate and Insert Data
        // dd($_POST);
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'crrnt_desig_id'        => $this->input->post('crrnt_desig_id'),
                'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
                'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                'first_office_id'       => $this->input->post('first_office_id'),
                'first_desig_id'        => $this->input->post('first_desig_id'),
                'first_elected_year'    => $this->input->post('first_elected_year'),
                'first_attend_date'     => $this->input->post('first_attend_date'),
                'elected_times'         => $this->input->post('elected_times'),
                'modified'              => date('Y-m-d H:i:s')
                );

            $this->Common_model->edit('users', $dataID, 'id', $form_data);

            // Data Updata and Insert to DB
            if (isset($_POST['exp_office_id'])) {
                for ($i = 0; $i < count($_POST['exp_office_id']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_experience', 'id', $_POST['hide_exp_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration'  => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->edit('per_experience', $_POST['hide_exp_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration'  => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $data);
                    }
                }
            }

            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }


        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        // dd($this->data['experience']);
        // Dropdown List
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($this->data['info']->office_type, 'pr');


        // Load page
        $this->data['meta_title'] = 'দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_trainee_pr_official';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // employee Official info
    public function edit_employee_official($userID)
    {
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }

        // Validation
        $this->form_validation->set_rules('crrnt_desig_id', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Validate and Insert Data
        // dd($_POST);
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'crrnt_dept_id'         => $this->input->post('crrnt_dept_id'),
                'crrnt_desig_id'        => $this->input->post('crrnt_desig_id'),
                'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                'first_office_id'       => $this->input->post('first_office_id'),
                'first_desig_id'        => $this->input->post('first_desig_id'),
                'first_elected_year'    => $this->input->post('first_elected_year'),
                'first_attend_date'     => $this->input->post('first_attend_date'),
                'elected_times'         => $this->input->post('elected_times'),
                'job_per_date'          => $this->input->post('job_per_date'),
                'prl_date'              => $this->input->post('prl_date'),
                'retirement_date'       => $this->input->post('retirement_date'),
                'modified'              => date('Y-m-d H:i:s')
                );

            $this->Common_model->edit('users', $dataID, 'id', $form_data);

            // Data Updata and Insert to DB
            if (isset($_POST['exp_office_id'])) {
                for ($i = 0; $i < count($_POST['exp_office_id']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_experience', 'id', $_POST['hide_exp_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration'  => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->edit('per_experience', $_POST['hide_exp_id'][$i], 'id', $data);
                    } else {
                        $experienceData = array(
                            'data_id'       => $dataID,
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration'  => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $experienceData);
                    }
                }
            }

            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }


        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['department'] = $this->Common_model->get_department_list_by_filter();
        // Dropdown List
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($this->data['info']->office_type, 'employee');

        // Load page
        $this->data['meta_title'] = 'অফিসিয়াল বা দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_employee_official';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // Education
    public function edit_trainee_education($userID )
    {
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }
        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $get_user_type = $results['info']->employee_type;

         // Data Updata and Insert to DB
        if (isset($_POST['edu_exam_id'])) {
            for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
                //check exists data
                @$data_exists = $this->Common_model->exists('per_education', 'id', $_POST['hide_edu_id'][$i]);
                if ($data_exists) {
                    $data = array(
                        'edu_exam_id' => $_POST['edu_exam_id'][$i],
                        'edu_subject_id' => $_POST['edu_subject_id'][$i],
                        'edu_pass_year' => $_POST['edu_pass_year'][$i],
                        'edu_board_id' => $_POST['edu_board_id'][$i],
                        );
                    $this->Common_model->edit('per_education', $_POST['hide_edu_id'][$i], 'id', $data);
                } else {
                    $data = array(
                        'data_id' => $dataID,
                        'edu_exam_id' => $_POST['edu_exam_id'][$i],
                        'edu_subject_id' => $_POST['edu_subject_id'][$i],
                        'edu_pass_year' => $_POST['edu_pass_year'][$i],
                        'edu_board_id' => $_POST['edu_board_id'][$i],
                        );
                    $this->Common_model->save('per_education', $data);
                }
            }

            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }


        // load view data
        $this->data['info'] = $results['info'];
        $this->data['education'] = $results['education'];
        $this->data['exams'] = $this->Common_model->get_all('*', 'exam', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subject', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'board_institute', '1');
        // dd($this->data['boards']);

        // Load page
        $this->data['meta_title'] = 'শিক্ষাগত যোগ্যতার তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_trainee_education';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // NILG Training
    public function edit_nilg_training($userID)
    {   
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }
        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $get_user_type = $results['info']->employee_type;

        // Data Updata and Insert to DB
        if (isset($_POST['nilg_course_id'])) {
            for ($i = 0; $i < sizeof($_POST['nilg_course_id']); $i++) {
                //check exists data
                @$data_exists = $this->Common_model->exists('per_nilg_training', 'id', $_POST['hide_row_id'][$i]);
                if ($data_exists) {
                    $data = array(
                        'nilg_course_id' => $_POST['nilg_course_id'][$i],
                        'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                        'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                        'nilg_training_start' => $_POST['nilg_training_start'][$i] != NULL ? $_POST['nilg_training_start'][$i] : NULL,
                        'nilg_training_end' => $_POST['nilg_training_end'][$i] != NULL ? $_POST['nilg_training_end'][$i] : NULL,
                        );
                    $this->Common_model->edit('per_nilg_training', $_POST['hide_row_id'][$i], 'id', $data);
                } else {
                    $data = array(
                        'data_id' => $dataID,
                        'nilg_course_id' => $_POST['nilg_course_id'][$i],
                        'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                        'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                        'nilg_training_start' => $_POST['nilg_training_start'][$i] != NULL ? $_POST['nilg_training_start'][$i] : NULL,
                        'nilg_training_end' => $_POST['nilg_training_end'][$i] != NULL ? $_POST['nilg_training_end'][$i] : NULL,
                        );
                    $this->Common_model->save('per_nilg_training', $data);
                }
            }

            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }
        
        // load view data
        $this->data['info'] = $results['info'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['courses'] = $this->Common_model->get_all('*', 'course', '1');
        // dd($this->data['courses']);

        // Load page
        $this->data['meta_title'] = 'এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_nilg_training';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // local Training
    public function edit_local_training($userID)
    {
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }
        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $get_user_type = $results['info']->employee_type;

        // Data Updata and Insert to DB
        if (isset($_POST['local_course_name'])) {
            for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
                //check exists data
                @$data_exists = $this->Common_model->exists('per_local_org_training', 'id', $_POST['hide_local_id'][$i]);
                if ($data_exists) {
                    $data = array(
                        'local_course_name' => $_POST['local_course_name'][$i],
                        'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                        'local_training_start' => $_POST['local_training_start'][$i],
                        'local_training_end' => $_POST['local_training_end'][$i],
                        );
                    $this->Common_model->edit('per_local_org_training', $_POST['hide_local_id'][$i], 'id', $data);
                } else {
                    $data = array(
                        'data_id' => $dataID,
                        'local_course_name' => $_POST['local_course_name'][$i],
                        'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                        'local_training_start' => $_POST['local_training_start'][$i],
                        'local_training_end' => $_POST['local_training_end'][$i],
                        );
                    $this->Common_model->save('per_local_org_training', $data);
                }
            }

            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }

        // load view data
        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        // dd($this->data['experience']);
        $this->data['local_training'] = $results['local_training'];

        // Load page
        $this->data['meta_title'] = 'দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষণ তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_local_training';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // Forien Training
    public function edit_forien_training($userID)
    {
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }
        // Get user information
        $results = $this->My_profile_model->get_details_info($dataID);
        $get_user_type = $results['info']->employee_type;

        // Data Updata and Insert to DB
        if (isset($_POST['foreign_course_name'])) {
            for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
                //check exists data
                @$data_exists = $this->Common_model->exists('per_foreign_org_training', 'id', $_POST['hide_foreign_training_id'][$i]);
                if ($data_exists) {
                    $data = array(
                        'foreign_course_name' => $_POST['foreign_course_name'][$i],
                        'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                        'foreign_training_start' => $_POST['foreign_training_start'][$i],
                        'foreign_training_end' => $_POST['foreign_training_end'][$i],
                        );
                    $this->Common_model->edit('per_foreign_org_training', $_POST['hide_foreign_training_id'][$i], 'id', $data);
                } else {
                    $data = array(
                        'data_id' => $dataID,
                        'foreign_course_name' => $_POST['foreign_course_name'][$i],
                        'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                        'foreign_training_start' => $_POST['foreign_training_start'][$i],
                        'foreign_training_end' => $_POST['foreign_training_end'][$i],
                        );
                    $this->Common_model->save('per_foreign_org_training', $data);
                }
            }

            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }

        // load view data
        $this->data['info'] = $results['info'];
        $this->data['foreign_training'] = $results['foreign_training'];
        // dd($this->data['experience']);

        // Load page
        $this->data['meta_title'] = 'বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_forien_training';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // promotion 
    public function edit_trainee_promotion($userID)
    {
        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;

        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            redirect('dashboard');
            // show_404('trainee - edit_nilg_training - exists', TRUE);
        }

        // Data Updata and Insert to DB
        if (isset($_POST['promo_org_name'])) {

            for ($i = 0; $i < sizeof($_POST['promo_org_name']); $i++) {
                //check exists data
                @$data_exists = $this->Common_model->exists('per_promotion', 'id', $_POST['hide_promo_id'][$i]);
                if ($data_exists) {
                    $data = array(
                        'promo_org_name' => $_POST['promo_org_name'][$i],
                        'promo_desig_name' => $_POST['promo_desig_name'][$i],
                        'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                        'promo_comments' => $_POST['promo_comments'][$i],
                        );
                    $this->Common_model->edit('per_promotion', $_POST['hide_promo_id'][$i], 'id', $data);
                } else {
                    $promotion_data = array(
                        'data_id' => $dataID,
                        'promo_org_name' => $_POST['promo_org_name'][$i],
                        'promo_desig_name' => $_POST['promo_desig_name'][$i],
                        'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                        'promo_comments' => $_POST['promo_comments'][$i],
                        );
                    $this->Common_model->save('per_promotion', $promotion_data);
                }
            }


            // Message
            $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
            redirect('my_profile');
        }

        // load view data
        $results = $this->My_profile_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['promotions'] = $results['promotion'];
        // dd($this->data['promotions']);

        // Load page
        $this->data['meta_title'] = 'পদোন্নতি সংক্রান্ত তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_trainee_promotion';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /**************************** End Edit Trainee / pr ************************/
    /******************************************************************/
    


    /**************************** Edit Trainee ************************/
    /******************************************************************/
    /*
    public function edit_trainee_general_info(){        
        // Submit general infromation of Public Representative
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Information Form'; exit;

        // Get user information
        $this->data['info'] = $this->My_profile_model->get_trainee_general_info();
        // dd($this->data['info']); exit;
        // echo $this->data['info']->user_type; exit();
        // $employeeType = $this->data['info']->employee_type;
        $userID = $this->data['info']->id;

        // If not trainer 
        /*if($this->data['info']->user_type != 2){
            redirect('registration/trainer_application_form');
        }*/
        /*
        // Validation
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name english', 'required|trim');

        // Validate and Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(                    
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
                'modified'              => date('Y-m-d H:i:s')
                );

            if ($this->Common_model->edit('users', $userID, 'id', $form_data)){

                // Copy image, rename and remove from temp directory
                if($this->input->post('hide_img') != NULL){
                    $file_name = $this->input->post('hide_img');
                    $tmp = explode('.', $file_name);
                    $file_extension = end($tmp);                          

                    //Copy file and rename 
                    $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                    // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                    $newfile = $userID.'.'.$file_extension;

                    //Update table image field
                    if($this->My_profile_model->set_profile_image($userID, $newfile)){
                        $saveDir = $this->img_path.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                            // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                            @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                            @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                            @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                            @unlink($this->img_thumb_path.'\\'.$file_name);

                            //$this->session->set_flashdata('success', 'Image update successfully.');
                            //redirect('my_profile');
                        }
                    }
                }

                // Message
                $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
                redirect('my_profile');
            }
        }

        // Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        // $this->data['office'] = $this->Common_model->get_office();
        // $this->data['designation'] = $this->Common_model->get_designations(1);

        // Load page       
        $this->data['meta_title'] = 'ব্যাক্তিগত বা সাধারণ তথ্য সংশোধন ফর্ম';
        $this->data['subview'] = 'edit_trainee_general_info';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_trainee_pr_official(){        
        // Submit general infromation of Public Representative
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Information Form'; exit;

        // Get user information
        $this->data['info'] = $this->My_profile_model->get_trainee_official_info();
        // $this->data['info'] = $this->Dashboard_model->get_trainee_offical_data();
        // dd($this->data['info']); exit;
        // echo $this->data['info']->user_type; exit();
        // $employeeType = $this->data['info']->employee_type;
        $userID = $this->data['info']->id;

        // If not trainer 
        /*if($this->data['info']->user_type != 2){
            redirect('registration/trainer_application_form');
        }*/
        /*
        // Validation
        $this->form_validation->set_rules('crrnt_elected_year', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Validate and Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(                    
                'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
                'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                'first_office_id'       => $this->input->post('first_office_id'),
                'first_desig_id'        => $this->input->post('first_desig_id'),
                'first_elected_year'    => $this->input->post('first_elected_year'),
                'first_attend_date'     => $this->input->post('first_attend_date'),
                'elected_times'         => $this->input->post('elected_times'),                  
                'modified'              => date('Y-m-d H:i:s')
                );

            if ($this->Common_model->edit('users', $userID, 'id', $form_data)){
            // Message
                $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
                redirect('my_profile');
            }
        }

        // Dropdown List
        // $this->data['division'] = $this->Common_model->get_division();
        // $this->data['marital_status'] = $this->Common_model->get_marital_status();
        // $this->data['office'] = $this->Common_model->get_office();
        $this->data['designation'] = $this->Common_model->get_designations(1);

        // Load page       
        $this->data['meta_title'] = 'দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_trainee_pr_official';
        $this->load->view('backend/_layout_main', $this->data);
    }



    public function edit_trainer_general_info(){        
        // Submit general infromation of Public Representative
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        // echo 'Information Form'; exit;

        // Get user information
        $this->data['info'] = $this->Common_model->get_user_info();
        // dd($this->data['info']); exit;
        // echo $this->data['info']->user_type; exit();
        // $employeeType = $this->data['info']->employee_type;
        // $userID = $this->data['info']->id;

        // If not trainer 
        if($this->data['info']->user_type != 3){
            redirect('registration/trainee_application_form');
        }

        // Validation
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name english', 'required|trim');

        // Validate and Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(                    
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
                'modified'              => date('Y-m-d H:i:s')
                );

            if ($this->Common_model->edit('users', $userID, 'id', $form_data)){
                // Copy image, rename and remove from temp directory
                if($this->input->post('hide_img') != NULL){
                    $file_name = $this->input->post('hide_img');
                    $tmp = explode('.', $file_name);
                    $file_extension = end($tmp);                          

                    //Copy file and rename 
                    $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                    // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                    $newfile = $userID.'.'.$file_extension;

                    //Update table image field
                    if($this->My_profile_model->set_profile_image($userID, $newfile)){
                        $saveDir = $this->img_path.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                            // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                            @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                            @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                            @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                            @unlink($this->img_thumb_path.'\\'.$file_name);

                            //$this->session->set_flashdata('success', 'Image update successfully.');
                            //redirect('my_profile');
                        }
                    }
                }

                // Message
                $this->session->set_flashdata('success', 'সংশোধিত তথ্য সফলভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
                redirect('dashboard');
            }
        }

        // Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        // $this->data['office'] = $this->Common_model->get_office();
        // $this->data['designation'] = $this->Common_model->get_designations(1);

        // Load page       
        $this->data['meta_title'] = 'ব্যাক্তিগত বা সাধারণ তথ্য সংশোধন ফর্ম';
        $this->data['subview'] = 'edit_trainer_general_info';
        $this->load->view('backend/_layout_main', $this->data);
    }    

*/













    public function update(){
        $this->form_validation->set_message('required', 'এই তথ্যটি আবশ্যক।');

        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('phone', 'mobile number', 'trim|required');
        $this->form_validation->set_rules('dob', 'date of birth', 'trim|required');
        $this->form_validation->set_rules('gender', 'gender', 'trim|required');        
        $this->form_validation->set_rules('present_add', 'present address', 'trim|required');
        $this->form_validation->set_rules('permanent_add', 'permanent address', 'trim|required');

        if ($this->form_validation->run() == true){
            $form_data = array(
              'first_name' => $this->input->post('first_name'),
              'phone' => $this->input->post('phone'),
              'dob' => $this->input->post('dob'),
              'gender' => $this->input->post('gender'),
              'designation' => $this->input->post('designation'),
              'present_add' => $this->input->post('present_add'),
              'permanent_add' => $this->input->post('permanent_add')
              );
            // print_r($form_data); exit;
            if($this->Common_model->edit('users', $this->id, 'id', $form_data)){
                $this->session->set_flashdata('success', lang('update_successfully'));
                redirect('my_profile');
            }
        }

        $this->data['info'] = $this->My_profile_model->get_info($this->id);

        $this->data['meta_title'] = lang('update_profile');
        $this->data['subview'] = 'update';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function change_image(){

        $this->form_validation->set_rules('userfile', 'profile image required', 'required|trim');

        $this->data['info'] = $this->My_profile_model->get_info($this->id);
        // print_r($this->data['info']); exit;

        if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
        }

        if ($this->form_validation->run() == true){

            if($_FILES['userfile']['size'] > 0){

                if(file_exists($this->img_path.'/'.$this->data['info']->profile_img)){
                 unlink($this->img_path.'/'.$this->data['info']->profile_img);
             }

             $new_file_name = time().'-'.$_FILES["userfile"]['name'];

             $config['allowed_types']= 'jpg|png|jpeg|gif';
             $config['upload_path']  = $this->img_path;
             $config['file_name']    = $new_file_name;
             $config['max_size']     = 500;

             $this->load->library('upload', $config);
                //upload file to directory
             if($this->upload->do_upload()){
                $uploadData = $this->upload->data();
                $config = array(
                    'source_image' => $uploadData['full_path'],
                    'new_image' => $this->img_path,
                    'maintain_ratio' => TRUE,
                    'width' => 300,
                    'height' => 300
                    );
                $this->load->library('image_lib',$config);
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);

                $form_data = array( 'profile_img' => $uploadedFile );
                if($this->Common_model->edit('users', $this->id, 'id', $form_data)){
                    $this->session->set_flashdata('success', 'Image update successfully.');
                    redirect('my_profile');
                }

                    //$this->data['message'] = 'Image has been uploaded successfully.';
            }else{
                $this->data['message'] = $this->upload->display_errors();
            }
        }          
    }

    $this->data['meta_title'] = lang('change_image');
    $this->data['subview'] = 'change_image';
    $this->load->view('backend/_layout_main', $this->data);
}


public function file_check($str){
    $this->load->helper('file');
    $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
    $mime = get_mime_by_extension($_FILES['userfile']['name']);
    $file_size = 1050000; 
    $size_kb = '1 MB';

    if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
        if(!in_array($mime, $allowed_mime_type_arr)){                
            $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png, gif file.');
            return false;
        }elseif($_FILES["userfile"]["size"] > $file_size){
            $this->form_validation->set_message('file_check', 'Maximum file size '.$size_kb);
            return false;
        }else{
            return true;
        }
    }else{
        $this->form_validation->set_message('file_check', 'Please choose a image file to upload.');
        return false;
    }
}

}