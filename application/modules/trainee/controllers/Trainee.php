<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Trainee extends Backend_Controller
{
    function __construct(){
        parent::__construct();
        $this->data['module_title'] = 'প্রশিক্ষর্ণাথী';

        if (!$this->ion_auth->logged_in()) :
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('Trainee_model');

        $this->userSeessID = $this->session->userdata('user_id');
        $this->img_orginal_path = realpath(APPPATH . '../uploads/temp_dir/');
        $this->img_thumb_path = realpath(APPPATH . '../uploads/temp_dir/_thumb/');
        $this->img_path = realpath(APPPATH . '../uploads/profile/');
        $this->signature_path = realpath(APPPATH . '../uploads/signature');
        $this->order_path = realpath(APPPATH . '../uploads/transfer');
    }

    public function index(){
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        redirect('trainee/all_pr');
    }


    /******** Public Representitave (PR) ADD, ALL, Details ************/
    /******************************************************************/

    public function add_pr()
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Default Value
        $officeType = $divisionID = $districtID = $upazilaID = $unionID = $division = $district = $upazila = $pourashava = $union = NULL;

        if(!$this->ion_auth->is_admin()){
            // Get office user information
            $this->data['info'] = $this->Common_model->get_office_info_by_session();

            // dd($this->data['info']);
            $officeType     = $this->data['info']->office_type;
            $officeID       = $this->data['info']->crrnt_office_id;
            $divisionID     = $this->data['info']->div_id;
            $districtID     = $this->data['info']->dis_id;
            $upazilaID      = $this->data['info']->upa_id;
            $unionID        = $this->data['info']->union_id;
        }

        // Validation
        // General Info
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
        $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
        $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
        $this->form_validation->set_rules('nid', 'national id', 'required|trim|integer|min_length[10]|max_length[17]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim|integer|min_length[11]|max_length[11]');
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

        // Official Info
        if($this->ion_auth->is_admin()){
            $this->form_validation->set_rules('crrnt_office_id', 'current office', 'required|trim');
        }
        $this->form_validation->set_rules('crrnt_desig_id', 'current designation', 'required|trim');
        $this->form_validation->set_rules('crrnt_elected_year', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Check Authentication Access
        if($this->ion_auth->in_group('up')){
            // Union Parishad (Group=7) (Office Type=1)
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $this->form_validation->set_rules('district', 'district', 'required');
            // $this->form_validation->set_rules('upazila', 'upazila', 'required');

        }elseif($this->ion_auth->in_group('paura')){
            // Paurashava (Group=6) (Office Type=2)
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $this->form_validation->set_rules('district', 'district', 'required');

        }elseif($this->ion_auth->in_group('uz')){
            // Upazila Parishad  (Group=5) (Office Type=3)
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $this->form_validation->set_rules('district', 'district', 'required');

        }elseif($this->ion_auth->in_group('zp')){
            // Zila Parishad (Group=4) (Office Type=4)
            // dd($office);
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $districtID = func_get_district_id($this->input->post('office'));

        }elseif($this->ion_auth->in_group('city')){
            // City Corporation (Group=3) (Office Type=5)
            /*$this->form_validation->set_rules('division', 'division', 'required');
            $divisionID = func_get_division_id($this->input->post('office'));  */

        }elseif($this->ion_auth->in_group('partner')){
            // Development Partner (Group=12) (Office Type=6)
            // $this->form_validation->set_rules('dev_partner', 'development partner', 'required');
            // $this->form_validation->set_rules('dev_partner_designation', 'development partner designation', 'required');

        }elseif($this->ion_auth->in_group('nilg')){
            // NILG (Group=2) (Office Type=7)
            // $this->form_validation->set_rules('department', 'nilg department', 'required');
            // $this->form_validation->set_rules('designation', 'nilg designation', 'required');
        }else{
            redirect('dashboard');
        }        

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){
            $nid        = $this->input->post('nid');
            $password   = $this->input->post('password');
            $email      = strtolower($this->input->post('email'));
            // Get Employee Type from post current designation
            $empType    = func_get_emp_type_id($this->input->post('crrnt_desig_id'));

            if($this->ion_auth->is_admin()){
                $officeInfo     = $this->Common_model->get_office_info($this->input->post('crrnt_office_id'));
                $officeType     = $officeInfo->office_type;
                $officeID       = $officeInfo->id;
                $divisionID     = $officeInfo->division_id;
                $districtID     = $officeInfo->district_id;
                $upazilaID      = $officeInfo->upazila_id;
                $unionID        = $officeInfo->union_id;
            }

            // Make Array Data
            $additional_data = array(
                'is_verify'         => 1,                
                'office_type'       => $officeType,
                'employee_type'     => $empType,
                'crrnt_office_id'   => $officeID,
                'crrnt_desig_id'    => $this->input->post('crrnt_desig_id'),
                'div_id'            => $divisionID != NULL ? $divisionID : NULL,
                'dis_id'            => $districtID != NULL ? $districtID : NULL,
                'upa_id'            => $upazilaID != NULL ? $upazilaID : NULL,
                'union_id'          => $unionID != NULL ? $unionID : NULL,

                'name_bn'           => $this->input->post('name_bn'),
                'name_en'           => strtoupper($this->input->post('name_en')),
                'father_name'       => $this->input->post('father_name'),
                'mother_name'       => $this->input->post('mother_name'),
                'nid'               => $this->input->post('nid'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),
                'dob'               => $this->input->post('dob'),
                'gender'            => $this->input->post('gender'),
                'ms_id'             => $this->input->post('ms_id'),
                'son_no'            => $this->input->post('son_no'),
                'daughter_no'       => $this->input->post('daughter_no'),

                'birth_place'       => $this->input->post('birth_place'),
                'quota_id'          => $this->input->post('quota_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'present_add'       => $this->input->post('present_add'),
                'per_div_id'        => $this->input->post('per_div_id'),
                'per_dis_id'        => $this->input->post('per_dis_id'),
                'per_upa_id'        => $this->input->post('per_upa_id'),
                'per_road_no'       => $this->input->post('per_road_no'),
                'permanent_add'     => $this->input->post('permanent_add'),
                'per_po'            => $this->input->post('per_po'),
                'per_pc'            => $this->input->post('per_pc'),

                'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
                'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                'first_office_id'       => $this->input->post('first_office_id'),
                'first_desig_id'        => $this->input->post('first_desig_id'),
                'first_elected_year'    => $this->input->post('first_elected_year'),
                'first_attend_date'     => $this->input->post('first_attend_date'),
                'elected_times'         => $this->input->post('elected_times'),
                'status'                => 2
                );
            // dd($_POST);

            // Insert to DB Create User Access with NID
            // User Group (trainee=10)
            $user_group = array('10');
            if ($insert_id = $this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){
                //last personal data id
                $lastID = $insert_id; //$this->db->insert_id();

                // Insert other data
                // Experiance / Multiple Elected
                if (isset($_POST['exp_office_id'])) {
                    for ($i = 0; $i < sizeof($_POST['exp_office_id']); $i++) {
                        $experienceData = array(
                            'data_id'       => $lastID,
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration'  => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $experienceData);
                    }
                }

                // Education
                if (isset($_POST['edu_exam_id'])) {
                    for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
                        $educationData = array(
                            'data_id'       => $lastID,
                            'edu_exam_id'   => $_POST['edu_exam_id'][$i],
                            'edu_subject_id'=> $_POST['edu_subject_id'][$i],
                            'edu_pass_year' => $_POST['edu_pass_year'][$i],
                            'edu_board_id'  => $_POST['edu_board_id'][$i],
                            );
                        $this->Common_model->save('per_education', $educationData);
                    }
                }

                // NILG training
                if (isset($_POST['nilg_course_id'])) {
                    for ($i = 0; $i < sizeof($_POST['nilg_course_id']); $i++) {
                        $nilgTraininData = array(
                            'data_id' => $lastID,
                            'nilg_course_id' => $_POST['nilg_course_id'][$i],
                            'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                            'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                            'nilg_training_start' => $_POST['nilg_training_start'][$i] != NULL ? $_POST['nilg_training_start'][$i] : NULL,
                            'nilg_training_end' => $_POST['nilg_training_end'][$i] != NULL ? $_POST['nilg_training_end'][$i] : NULL,
                            );
                        $this->Common_model->save('per_nilg_training', $nilgTraininData);
                    }
                }

                // Local organization training
                if (isset($_POST['local_course_name'])) {
                    for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
                        $local_org_data = array(
                            'data_id' => $lastID,
                            'local_course_name' => $_POST['local_course_name'][$i],
                            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                            'local_training_start' => $_POST['local_training_start'][$i] != NULL ? $_POST['local_training_start'][$i] : NULL,
                            'local_training_end' => $_POST['local_training_end'][$i] != NULL ? $_POST['local_training_end'][$i] : NULL,
                            );
                        $this->Common_model->save('per_local_org_training', $local_org_data);
                    }
                }

                // Foreign organization training
                if (isset($_POST['foreign_course_name'])) {
                    for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
                        $foreign_org_data = array(
                            'data_id' => $lastID,
                            'foreign_course_name' => $_POST['foreign_course_name'][$i],
                            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                            'foreign_training_start' => $_POST['foreign_training_start'][$i],
                            'foreign_training_end' => $_POST['foreign_training_end'][$i],
                            );
                        $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
                    }
                }

                // Copy image, rename and remove from temp directory
                if ($this->input->post('hide_img') != NULL) {
                    $file_name = $this->input->post('hide_img');
                    $tmp = explode('.', $file_name);
                    $file_extension = end($tmp);

                    //Copy file and rename
                    $file = $this->img_thumb_path . '/' . $this->input->post('hide_img');
                    // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                    $newfile = $lastID . '.' . $file_extension;

                    //Update table image field
                    if ($this->Common_model->set_profile_image($lastID, $newfile)) {
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

                // Copy image, rename and remove from temp directory
                // if(!empty($this->input->post('signature'))){
                //     $this->do_upload($lastID);
                // }

                // Success Message
                $this->session->set_flashdata('success', 'আপনার প্রদত্ত তথ্য ডাটাবেজে সফলভাবে সংরক্ষিত হয়েছে');
                redirect('trainee/all_pr/');
            }
        }

        // Dropdown
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($officeType, 'pr');
        $this->data['quota'] =  $this->Common_model->get_quota();
        $this->data['religion'] = $this->Common_model->get_religion();
        $this->data['exams'] = $this->Common_model->get_all('*', 'exam', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subject', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'board_institute', '1');
        $this->data['courses'] = $this->Common_model->get_all('*', 'course', '1');
        // dd($this->data['exam_data']);

        // View
        $this->data['meta_title'] = 'জনপ্রতিনিধি এন্ট্রি করুন';
        $this->data['subview'] = 'add_pr';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function all_pr($offset = 0)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        $limit = 25;

        // Get Login office user information
        $office = $this->Common_model->get_office_info_by_session();
        // dd($office);

        // Check Auth
        if ($this->ion_auth->in_group('up')) {
            // Union Parishad (Group=7) (Office Type=1)
            $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('paura')) {
            // Paurashava (Group=6) (Office Type=2)
            $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('uz')) {
            // Upazila Parishad  (Group=5) (Office Type=3)
            // $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);
            $results = $this->Trainee_model->get_all_pr($limit, $offset,  null, $office->div_id, $office->dis_id, $office->upa_id);

        } elseif ($this->ion_auth->in_group('zp')) {
            // Zila Parishad (Group=4) (Office Type=4)
            // $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);
            $results = $this->Trainee_model->get_all_pr($limit, $offset,  null, $office->div_id, $office->dis_id);

        } elseif ($this->ion_auth->in_group('ddlg')) {
            // Zila Parishad (Group=4) (Office Type=4)
            $results = $this->Trainee_model->get_all_pr($limit, $offset, null, $office->div_id, $office->dis_id);

        } elseif ($this->ion_auth->in_group('city')) {
            // City Corporation (Group=3) (Office Type=5)
            $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('partner')){
            // Development Partner (Group=12) (Office Type=6)
            $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('nilg')) {
            // NILG (Group=2) (Office Type=7)
            $results = $this->Trainee_model->get_all_pr($limit, $offset);

        // } elseif ($this->ion_auth->in_group('nilg_staff')) {
        //     // NILG Staff (Group=8) (Office Type=7)
        //     $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('cc')) {
            // NILG (Group=2) (Office Type=7) 
            if ($office->office_type == 7) {
                $results = $this->Trainee_model->get_all_pr($limit, $offset);
            } else {
                $results = $this->Trainee_model->get_all_pr($limit, $offset, $office->crrnt_office_id);
            }
        } else {
            $results = $this->Trainee_model->get_all_pr($limit, $offset);
        }

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        // dd($this->data['results']);

        // Pagination
        $this->data['pagination'] = create_pagination('trainee/all_pr/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        // $this->data['data_type'] = $this->Common_model->get_data_type();
        // $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'জনপ্রতিনিধির তালিকা';
        $this->data['subview'] = 'all_pr';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details_pr($id){
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        //
        $this->data['experience'] = $this->data['education'] = $this->data['nilg_training'] = 0;

        // Decrypt Data
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee > details_pr', TRUE);
        }

        // Get all information
        $results = $this->Trainee_model->get_details_info($dataID);
        // dd($results['info']);

        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];

        $this->data['promotion'] = $results['promotion'];
        // $this->data['leave'] = $results['leave'];
        $this->data['foreign_training'] = $results['foreign_training'];
        // Current role play
        $this->data['currentGroups'] = $this->ion_auth->get_users_groups($dataID)->result();
        // print_r($this->data['currentGroups']); exit;


        // Load Page
        $this->data['meta_title'] = 'জনপ্রতিনিধির বিস্তারিত তথ্য';
        $this->data['subview'] = 'details_pr';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /****************** Employee ADD, ALL, Details ********************/
    /******************************************************************/

    public function add_employee()
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Default Value
        $officeType = $divisionID = $districtID = $upazilaID = $unionID = $division = $district = $upazila = $pourashava = $union = NULL;

        if(!$this->ion_auth->is_admin()){
            // Get office user information
            $this->data['info'] = $this->Common_model->get_office_info_by_session();
            // dd($this->data['info']);
            $officeType     = $this->data['info']->office_type;
            $officeID       = $this->data['info']->crrnt_office_id;
            $divisionID     = $this->data['info']->div_id;
            $districtID     = $this->data['info']->dis_id;
            $upazilaID      = $this->data['info']->upa_id;
            $unionID        = $this->data['info']->union_id;
        }

        // Validation
        // General Info
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
        $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
        $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
        $this->form_validation->set_rules('nid', 'national id', 'required|trim|integer|min_length[10]|max_length[17]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim|integer|min_length[11]|max_length[11]');
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

        // Official Info
        if($this->ion_auth->is_admin()){
            $this->form_validation->set_rules('crrnt_office_id', 'current office', 'required|trim');
        }
        $this->form_validation->set_rules('crrnt_desig_id', 'current designation', 'required|trim');
        // $this->form_validation->set_rules('crrnt_elected_year', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        if(@$_FILES['signature']['size'] > 0){
            $this->form_validation->set_rules('signature', '', 'callback_file_check');
        }


        // Check Authentication Access
        if($this->ion_auth->in_group('up')){
            // Union Parishad (Group=7) (Office Type=1)
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $this->form_validation->set_rules('district', 'district', 'required');
            // $this->form_validation->set_rules('upazila', 'upazila', 'required');

        }elseif($this->ion_auth->in_group('paura')){
            // Paurashava (Group=6) (Office Type=2)
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $this->form_validation->set_rules('district', 'district', 'required');

        }elseif($this->ion_auth->in_group('uz')){
            // Upazila Parishad  (Group=5) (Office Type=3)
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $this->form_validation->set_rules('district', 'district', 'required');

        }elseif($this->ion_auth->in_group('zp')){
            // Zila Parishad (Group=4) (Office Type=4)
            // dd($office);
            // $this->form_validation->set_rules('division', 'division', 'required');
            // $districtID = func_get_district_id($this->input->post('office'));

        }elseif($this->ion_auth->in_group('city')){
            // City Corporation (Group=3) (Office Type=5)
            /*$this->form_validation->set_rules('division', 'division', 'required');
            $divisionID = func_get_division_id($this->input->post('office'));  */

        }elseif($this->ion_auth->in_group('partner')){
            // Development Partner (Group=12) (Office Type=6)
            // $this->form_validation->set_rules('dev_partner', 'development partner', 'required');
            // $this->form_validation->set_rules('dev_partner_designation', 'development partner designation', 'required');

        }elseif($this->ion_auth->in_group('nilg')){
            // NILG (Group=2) (Office Type=7)
            // $this->form_validation->set_rules('department', 'nilg department', 'required');
            // $this->form_validation->set_rules('designation', 'nilg designation', 'required');
        }

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){
            $nid        = $this->input->post('nid');
            $password   = $this->input->post('password');
            $email      = strtolower($this->input->post('email'));
            $crrnt_dept_id = $this->input->post('crrnt_dept_id');
            // Get Employee Type from post current designation
            $empType    = func_get_emp_type_id($this->input->post('crrnt_desig_id'));

            if($this->ion_auth->is_admin()){
                $officeInfo     = $this->Common_model->get_office_info($this->input->post('crrnt_office_id'));
                $officeType     = $officeInfo->office_type;
                $officeID       = $officeInfo->id;
                $divisionID     = $officeInfo->division_id;
                $districtID     = $officeInfo->district_id;
                $upazilaID      = $officeInfo->upazila_id;
                $unionID        = $officeInfo->union_id;
            }

            // Make Array Data
            $additional_data = array(
                'is_verify'         => 1,
                'user_type'         => 2,
                'office_type'       => $officeType,
                'employee_type'     => $empType,
                'crrnt_office_id'   => $officeID,
                'crrnt_desig_id'    => $this->input->post('crrnt_desig_id'),
                'crrnt_dept_id'     => $crrnt_dept_id != NULL ? $crrnt_dept_id : NULL,
                'div_id'            => $divisionID != NULL ? $divisionID : NULL,
                'dis_id'            => $districtID != NULL ? $districtID : NULL,
                'upa_id'            => $upazilaID != NULL ? $upazilaID : NULL,
                'union_id'          => $unionID != NULL ? $unionID : NULL,

                'name_bn'           => $this->input->post('name_bn'),
                'name_en'           => strtoupper($this->input->post('name_en')),
                'father_name'       => $this->input->post('father_name'),
                'mother_name'       => $this->input->post('mother_name'),
                'nid'               => $this->input->post('nid'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),
                'dob'               => $this->input->post('dob'),
                'gender'            => $this->input->post('gender'),
                'ms_id'             => $this->input->post('ms_id'),
                'son_no'            => $this->input->post('son_no'),
                'daughter_no'       => $this->input->post('daughter_no'),

                'birth_place'       => $this->input->post('birth_place'),
                'quota_id'          => $this->input->post('quota_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'present_add'       => $this->input->post('present_add'),
                'per_div_id'        => $this->input->post('per_div_id'),
                'per_dis_id'        => $this->input->post('per_dis_id'),
                'per_upa_id'        => $this->input->post('per_upa_id'),
                'per_road_no'       => $this->input->post('per_road_no'),
                'permanent_add'     => $this->input->post('permanent_add'),
                'per_po'            => $this->input->post('per_po'),
                'per_pc'            => $this->input->post('per_pc'),

                'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
                'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                'first_office_id'       => $this->input->post('first_office_id'),
                'first_desig_id'        => $this->input->post('first_desig_id'),
                'first_elected_year'    => $this->input->post('first_elected_year'),
                'first_attend_date'     => $this->input->post('first_attend_date'),
                'elected_times'         => $this->input->post('elected_times'),
                'job_per_date'          => $this->input->post('job_per_date'),
                'prl_date'              => $this->input->post('prl_date'),
                'retirement_date'       => $this->input->post('retirement_date'),
                'status'                => 1
                );
            // dd($additional_data);

            // Insert to DB Create User Access with NID
            // User Group (trainee=10)
            $user_group = array('10');
            if ($insert_id = $this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){
                //last personal data id
                $lastID = $insert_id; //$this->db->insert_id();

                // Insert other data
                // Experiance / Multiple Elected
                if (isset($_POST['exp_office_id'])) {
                    for ($i = 0; $i < sizeof($_POST['exp_office_id']); $i++) {
                        $experienceData = array(
                            'data_id'       => $lastID,
                            'exp_office_id' => $_POST['exp_office_id'][$i],
                            'exp_design_id' => $_POST['exp_design_id'][$i],
                            'exp_duration'  => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $experienceData);
                    }
                }

                // Promotion
                if (isset($_POST['promo_org_name'])) {
                    for ($i = 0; $i < sizeof($_POST['promo_org_name']); $i++) {
                        $promotion_data = array(
                            'data_id' => $lastID,
                            'promo_org_name' => $_POST['promo_org_name'][$i],
                            'promo_desig_name' => $_POST['promo_desig_name'][$i],
                            'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                            'promo_comments' => $_POST['promo_comments'][$i],
                            );
                        $this->Common_model->save('per_promotion', $promotion_data);
                    }
                }

                // Education
                if (isset($_POST['edu_exam_id'])) {
                    for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
                        $educationData = array(
                            'data_id'       => $lastID,
                            'edu_exam_id'   => $_POST['edu_exam_id'][$i],
                            'edu_subject_id'=> $_POST['edu_subject_id'][$i],
                            'edu_pass_year' => $_POST['edu_pass_year'][$i],
                            'edu_board_id'  => $_POST['edu_board_id'][$i],
                            );
                        $this->Common_model->save('per_education', $educationData);
                    }
                }

                // NILG training
                if (isset($_POST['nilg_course_id'])) {
                    for ($i = 0; $i < sizeof($_POST['nilg_course_id']); $i++) {
                        $nilgTraininData = array(
                            'data_id' => $lastID,
                            'nilg_course_id' => $_POST['nilg_course_id'][$i],
                            'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                            'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                            'nilg_training_start' => $_POST['nilg_training_start'][$i] != NULL ? $_POST['nilg_training_start'][$i] : NULL,
                            'nilg_training_end' => $_POST['nilg_training_end'][$i] != NULL ? $_POST['nilg_training_end'][$i] : NULL,
                            );
                        $this->Common_model->save('per_nilg_training', $nilgTraininData);
                    }
                }

                // Local organization training
                if (isset($_POST['local_course_name'])) {
                    for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
                        $local_org_data = array(
                            'data_id' => $lastID,
                            'local_course_name' => $_POST['local_course_name'][$i],
                            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                            'local_training_start' => $_POST['local_training_start'][$i] != NULL ? $_POST['local_training_start'][$i] : NULL,
                            'local_training_end' => $_POST['local_training_end'][$i] != NULL ? $_POST['local_training_end'][$i] : NULL,
                            );
                        $this->Common_model->save('per_local_org_training', $local_org_data);
                    }
                }

                // Foreign organization training
                if (isset($_POST['foreign_course_name'])) {
                    for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
                        $foreign_org_data = array(
                            'data_id' => $lastID,
                            'foreign_course_name' => $_POST['foreign_course_name'][$i],
                            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                            'foreign_training_start' => $_POST['foreign_training_start'][$i],
                            'foreign_training_end' => $_POST['foreign_training_end'][$i],
                            );
                        $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
                    }
                }

                // Copy image, rename and remove from temp directory
                if($this->input->post('hide_img') != NULL){
                    $file_name = $this->input->post('hide_img');
                    $tmp = explode('.', $file_name);
                    $file_extension = end($tmp);

                    //Copy file and rename
                    $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                    // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                    $newfile = $lastID.'.'.$file_extension;

                    //Update table image field
                    if($this->Common_model->set_profile_image($lastID, $newfile)){
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

                // Signature Upload
                if($_FILES['signature']['size'] > 0){
                    $new_file_name = time().'-'.$lastID;
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
                        $this->Common_model->edit('users', $lastID, 'id', $form_data);
                    }else{
                        $this->data['message'] = $this->upload->display_errors();
                    }
                }

                // Success Message
                $this->session->set_flashdata('success', 'আপনার প্রদত্ত তথ্য ডাটাবেজে সফলভাবে সংরক্ষিত হয়েছে');
                redirect('trainee/all_employee/');
            }
        }

        // Dropdown
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] =  $this->Common_model->get_upazila_thana();
        $this->data['quota'] =    $this->Common_model->get_quota();
        $this->data['religion'] = $this->Common_model->get_religion();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($officeType, 'employee');
        $this->data['department'] = $this->Common_model->get_department_list_by_filter();
        $this->data['exams'] = $this->Common_model->get_all('*', 'exam', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subject', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'board_institute', '1');
        $this->data['courses'] = $this->Common_model->get_all('*', 'course', '1');
        // dd($this->data['exam_data']);

        // View
        $this->data['meta_title'] = 'কর্মকর্তা / কর্মচারী এন্ট্রি করুন';
        $this->data['subview'] = 'add_employee';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function all_employee($offset = 0)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        $limit = 25;

        // Get Login office user information
        $office = $this->Common_model->get_office_info_by_session();
        // dd($office);

        // Check Auth
        if ($this->ion_auth->in_group('up')) {
            // Union Parishad (Group=7) (Office Type=1)
            $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('paura')) {
            // Paurashava (Group=6) (Office Type=2)
            $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);

        } elseif ($this->ion_auth->in_group('uz')) {
            // Upazila Parishad  (Group=5) (Office Type=3)
            // $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);
            $results = $this->Trainee_model->get_all_employee($limit, $offset,  null, $office->div_id, $office->dis_id, $office->upa_id);

        } elseif ($this->ion_auth->in_group('zp')) {
            // Zila Parishad (Group=4) (Office Type=4)
            // $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);
            $results = $this->Trainee_model->get_all_employee($limit, $offset,  null, $office->div_id, $office->dis_id);

        } elseif ($this->ion_auth->in_group('ddlg')) {
            // Zila Parishad (Group=14) (Office Type=8)
            $results = $this->Trainee_model->get_all_employee($limit, $offset, null, $office->div_id, $office->dis_id);

        }elseif ($this->ion_auth->in_group('city')) {
            // City Corporation (Group=3) (Office Type=5)
            $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);

        }elseif($this->ion_auth->in_group('partner')){
            // Development Partner (Group=12) (Office Type=6)
            $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);

        }elseif ($this->ion_auth->in_group('nilg')) {
            // NILG (Group=2) (Office Type=7)
            $results = $this->Trainee_model->get_all_employee($limit, $offset);

        /*} elseif ($this->ion_auth->in_group('nilg_staff')) {
            // NILG Staff (Group=8) (Office Type=7)
            $results = $this->Trainee_model->get_all_employee($limit, $offset);*/

        } elseif ($this->ion_auth->in_group('cc')) {
            // NILG (Group=2) (Office Type=7) 
            if ($office->office_type == 7) {
                $results = $this->Trainee_model->get_all_employee($limit, $offset);
            } else {
                $results = $this->Trainee_model->get_all_employee($limit, $offset, $office->crrnt_office_id);
            }
        } else {
            $results = $this->Trainee_model->get_all_employee($limit, $offset);
        }

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainee/all_employee/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        // $this->data['data_type'] = $this->Common_model->get_data_type();
        // $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'কর্মকর্তা / কর্মচারীর তালিকা';
        $this->data['subview'] = 'all_employee';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function details_employee($id){
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        //
        $this->data['experience'] = $this->data['education'] = $this->data['nilg_training'] = 0;

        // Decrypt Data
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee > details_employee', TRUE);
        }

        // Get all information
        $results = $this->Trainee_model->get_details_information($dataID);
        // dd($results);

        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['promotion'] = $results['promotion'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];
        $this->data['foreign_training'] = $results['foreign_training'];
        // $this->data['leave'] = $results['leave'];

        // Current role play
        $this->data['currentGroups'] = $this->ion_auth->get_users_groups($dataID)->result();

        // Load Page
        $this->data['meta_title'] = 'কর্মকর্তা / কর্মচারীর বিস্তারিত তথ্য';
        if($this->ion_auth->in_group('partner')) {
            $this->data['subview'] = 'details_partner';
        } elseif ($this->ion_auth->is_admin() || $this->ion_auth->in_group('nilg')) {
            $this->data['subview'] = 'details_employee_nilg';
        } else {
            $this->data['subview'] = 'details_employee';
        }

        $this->load->view('backend/_layout_main', $this->data);
    }


    /************* Development Partner Add, List **********************/
    /******************************************************************/

    public function add_partner() {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Default Value
        $officeType = $divisionID = $districtID = $upazilaID = $unionID = $division = $district = $upazila = $pourashava = $union = NULL;

        // Get office user information
        $this->data['info'] = $this->Common_model->get_office_info_by_session();
        // dd($this->data['info']);
        $officeType     = $this->data['info']->office_type;
        $officeID       = $this->data['info']->crrnt_office_id;
        $divisionID     = $this->data['info']->div_id;
        $districtID     = $this->data['info']->dis_id;
        $upazilaID      = $this->data['info']->upa_id;
        $unionID        = $this->data['info']->union_id;

        // Validation
        // General Info
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
        $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
        $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
        $this->form_validation->set_rules('nid', 'national id', 'required|trim|integer|min_length[10]|max_length[17]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim|integer|min_length[11]|max_length[11]');
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

        // Official Info
        $this->form_validation->set_rules('crrnt_desig_id', 'current designation', 'required|trim');
        // $this->form_validation->set_rules('crrnt_elected_year', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){
            $nid        = $this->input->post('nid');
            $password   = $this->input->post('password');
            $email      = strtolower($this->input->post('email'));
            // Get Employee Type from post current designation
            $empType    = func_get_emp_type_id($this->input->post('crrnt_desig_id'));

            // Make Array Data
            $additional_data = array(
                'is_verify'         => 1,
                'user_type'         => 2,
                'office_type'       => $officeType,
                'employee_type'     => $empType,
                'crrnt_office_id'   => $officeID,
                'crrnt_desig_id'    => $this->input->post('crrnt_desig_id'),
                'div_id'            => $divisionID != NULL ? $divisionID : NULL,
                'dis_id'            => $districtID != NULL ? $districtID : NULL,
                'upa_id'            => $upazilaID != NULL ? $upazilaID : NULL,
                'union_id'          => $unionID != NULL ? $unionID : NULL,

                'name_bn'           => $this->input->post('name_bn'),
                'name_en'           => strtoupper($this->input->post('name_en')),
                'father_name'       => $this->input->post('father_name'),
                'mother_name'       => $this->input->post('mother_name'),
                'nid'               => $this->input->post('nid'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),
                'dob'               => $this->input->post('dob'),
                'gender'            => $this->input->post('gender'),
                'ms_id'             => $this->input->post('ms_id'),
                'son_no'            => $this->input->post('son_no'),
                'daughter_no'       => $this->input->post('daughter_no'),

                'present_add'       => $this->input->post('present_add'),
                'per_div_id'        => $this->input->post('per_div_id'),
                'per_dis_id'        => $this->input->post('per_dis_id'),
                'per_upa_id'        => $this->input->post('per_upa_id'),
                'per_road_no'       => $this->input->post('per_road_no'),
                'permanent_add'     => $this->input->post('permanent_add'),
                'per_po'            => $this->input->post('per_po'),
                'per_pc'            => $this->input->post('per_pc'),

                'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
                'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
                // 'first_office_id'       => $this->input->post('first_office_id'),
                // 'first_desig_id'        => $this->input->post('first_desig_id'),
                // 'first_elected_year'    => $this->input->post('first_elected_year'),
                // 'first_attend_date'     => $this->input->post('first_attend_date'),
                // 'elected_times'         => $this->input->post('elected_times'),
                'status'                => 1
                );
                // dd($additional_data);

                // Insert to DB Create User Access with NID
                // User Group (trainee=10)
            $user_group = array('10');
            if ($insert_id = $this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){
                //last personal data id
                $lastID = $insert_id; //$this->db->insert_id();

                // Insert other data
                // Experiance / Multiple Elected
                // for ($i = 0; $i < sizeof($_POST['exp_office_id']); $i++) {
                //     $experienceData = array(
                //         'data_id'       => $lastID,
                //         'exp_office_id' => $_POST['exp_office_id'][$i],
                //         'exp_design_id' => $_POST['exp_design_id'][$i],
                //         'exp_duration'  => $_POST['exp_duration'][$i],
                //         );
                //     $this->Common_model->save('per_experience', $experienceData);
                // }

                // Promotion
                // for ($i = 0; $i < sizeof($_POST['promo_org_name']); $i++) {
                //     $promotion_data = array(
                //         'data_id' => $lastID,
                //         'promo_org_name' => $_POST['promo_org_name'][$i],
                //         'promo_desig_name' => $_POST['promo_desig_name'][$i],
                //         'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                //         'promo_comments' => $_POST['promo_comments'][$i],
                //         );
                //     $this->Common_model->save('per_promotion', $promotion_data);
                // }

                // Education
                for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
                    $educationData = array(
                        'data_id'       => $lastID,
                        'edu_exam_id'   => $_POST['edu_exam_id'][$i],
                        'edu_subject_id'=> $_POST['edu_subject_id'][$i],
                        'edu_pass_year' => $_POST['edu_pass_year'][$i],
                        'edu_board_id'  => $_POST['edu_board_id'][$i],
                        );
                    $this->Common_model->save('per_education', $educationData);
                }

                // NILG training
                for ($i = 0; $i < sizeof($_POST['nilg_course_id']); $i++) {
                    $nilgTraininData = array(
                        'data_id' => $lastID,
                        'nilg_course_id' => $_POST['nilg_course_id'][$i],
                        'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                        'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                        'nilg_training_start' => $_POST['nilg_training_start'][$i] != NULL ? $_POST['nilg_training_start'][$i] : NULL,
                        'nilg_training_end' => $_POST['nilg_training_end'][$i] != NULL ? $_POST['nilg_training_end'][$i] : NULL,
                        );
                    $this->Common_model->save('per_nilg_training', $nilgTraininData);
                }

                // Local organization training
                for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
                    $local_org_data = array(
                        'data_id' => $lastID,
                        'local_course_name' => $_POST['local_course_name'][$i],
                        'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                        'local_training_start' => $_POST['local_training_start'][$i] != NULL ? $_POST['local_training_start'][$i] : NULL,
                        'local_training_end' => $_POST['local_training_end'][$i] != NULL ? $_POST['local_training_end'][$i] : NULL,
                        );
                    $this->Common_model->save('per_local_org_training', $local_org_data);
                }

                // Foreign organization training
                for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
                    $foreign_org_data = array(
                        'data_id' => $lastID,
                        'foreign_course_name' => $_POST['foreign_course_name'][$i],
                        'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                        'foreign_training_start' => $_POST['foreign_training_start'][$i],
                        'foreign_training_end' => $_POST['foreign_training_end'][$i],
                        );
                    $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
                }

                // Copy image, rename and remove from temp directory
                if($this->input->post('hide_img') != NULL){
                    $file_name = $this->input->post('hide_img');
                    $tmp = explode('.', $file_name);
                    $file_extension = end($tmp);

                    //Copy file and rename
                    $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                    // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                    $newfile = $lastID.'.'.$file_extension;

                    //Update table image field
                    if($this->Common_model->set_profile_image($lastID, $newfile)){
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

                // Success Message
                $this->session->set_flashdata('success', 'আপনার প্রদত্ত তথ্য ডাটাবেজে সফলভাবে সংরক্ষিত হয়েছে');
                redirect('trainee/all_employee/');
            }
        }

        // Dropdown
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($officeType, 'employee');
        $this->data['exams'] = $this->Common_model->get_all('*', 'exam', '1');
        $this->data['subjects'] = $this->Common_model->get_all('*', 'subject', '1');
        $this->data['boards'] = $this->Common_model->get_all('*', 'board_institute', '1');
        $this->data['courses'] = $this->Common_model->get_all('*', 'course', '1');
        // dd($this->data['exam_data']);

        // View
        $this->data['meta_title'] = 'কর্মকর্তা / কর্মচারী এন্ট্রি করুন';
        $this->data['subview'] = 'add_partner';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function development_partner($offset = 0)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        $limit = 25;

        $results = $this->Trainee_model->get_development_partner($limit, $offset);
        // dd($results);

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainee/development_partner/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        $this->data['data_type'] = $this->Common_model->get_data_type();
        $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'ডেভেলপমেন্ট পার্টনারের তালিকা';
        $this->data['subview'] = 'development_partner';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /************************ Edit PR / Employee **********************/
    /******************************************************************/
    // Personal Info
    public function edit_trainee_general_info($userID)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > edit_trainee_general_info', TRUE);
        }

        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
        $get_user_type = $results['info']->employee_type;

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

            if($this->ion_auth->is_admin()){
                $form_data['username'] = $this->input->post('nid');
                $form_data['nid'] = $this->input->post('nid');
                $form_data['dob'] = $this->input->post('dob');
                $form_data['mobile_no'] = $this->input->post('mobile_no');
            }

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
                if ($get_user_type == 1) {
                    redirect('trainee/details_pr/' . encrypt_url($dataID));
                } else {
                    redirect('trainee/details_employee/' . encrypt_url($dataID));
                }
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

    // PR Official Info
    public function edit_trainee_pr_official($userID)
    {
        // Check Auth
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > edit_trainee_pr_official', TRUE);
        }

        // Validation
        if($this->ion_auth->is_admin()){
            $this->form_validation->set_rules('crrnt_office_id', 'current office', 'required|trim');
        }        
        $this->form_validation->set_rules('crrnt_elected_year', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Validate and Insert Data
        // dd($_POST);
        if ($this->form_validation->run() == true) {
            if($this->ion_auth->is_admin()){
                $officeInfo     = $this->Common_model->get_office_info($this->input->post('crrnt_office_id'));
                $officeID       = $officeInfo->id;
                $divisionID     = $officeInfo->division_id;
                $districtID     = $officeInfo->district_id;
                $upazilaID      = $officeInfo->upazila_id;
                $unionID        = $officeInfo->union_id;
            }

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

            if($this->ion_auth->is_admin()){
                $form_data['crrnt_office_id'] = $officeID;
                $form_data['div_id'] = $divisionID != NULL ? $divisionID : NULL;
                $form_data['dis_id'] = $districtID != NULL ? $districtID : NULL;
                $form_data['upa_id'] = $upazilaID != NULL ? $upazilaID : NULL;
                $form_data['union_id'] = $unionID != NULL ? $unionID : NULL;
            }

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
            redirect('trainee/details_pr/' . encrypt_url($dataID));
        }


        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        // dd($this->data['info']);
        // Dropdown List
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($this->data['info']->office_type, 'pr');


        // Load page
        $this->data['meta_title'] = 'জনপ্রতিনিধির দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_trainee_pr_official';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // Employee Official Info
    public function edit_employee_official($userID)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > edit_employee_official', TRUE);
        }

        // Validation
        if($this->ion_auth->is_admin()){
            $this->form_validation->set_rules('crrnt_office_id', 'current office', 'required|trim');
        }
        $this->form_validation->set_rules('crrnt_desig_id', 'current elected year', 'required|trim');
        $this->form_validation->set_rules('crrnt_attend_date', 'current attend date', 'required|trim');

        // Validate and Insert Data
        // dd($_POST);
        if ($this->form_validation->run() == true) {

            if($this->ion_auth->is_admin()){
                $officeInfo     = $this->Common_model->get_office_info($this->input->post('crrnt_office_id'));
                $officeType     = $officeInfo->office_type;
                $officeID       = $officeInfo->id;
                $divisionID     = $officeInfo->division_id;
                $districtID     = $officeInfo->district_id;
                $upazilaID      = $officeInfo->upazila_id;
                $unionID        = $officeInfo->union_id;
            }

            $form_data = array(
                'crrnt_desig_id'        => $this->input->post('crrnt_desig_id'),
                'crrnt_dept_id'         => $this->input->post('crrnt_dept_id'),
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

            if($this->ion_auth->is_admin()){
                $form_data['crrnt_office_id'] = $officeID;
                $form_data['div_id'] = $divisionID != NULL ? $divisionID : NULL;
                $form_data['dis_id'] = $districtID != NULL ? $districtID : NULL;
                $form_data['upa_id'] = $upazilaID != NULL ? $upazilaID : NULL;
                $form_data['union_id'] = $unionID != NULL ? $unionID : NULL;
            }

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
            redirect('trainee/details_employee/' . encrypt_url($dataID));
        }


        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['department'] = $this->Common_model->get_department_list_by_filter();
        // Dropdown List
        $this->data['dasignation'] = $this->Common_model->get_designation_list_by_filter($this->data['info']->office_type, 'employee');

        // dd($this->data['info']);

        // Load page
        $this->data['meta_title'] = 'অফিসিয়াল বা দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_employee_official';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // Education
    public function edit_trainee_education($userID )
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > edit_trainee_education', TRUE);
        }


        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
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
            if ($get_user_type == 1) {
                redirect('trainee/details_pr/' . encrypt_url($dataID));
            } else {
                redirect('trainee/details_employee/' . encrypt_url($dataID));
            }
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
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > edit_nilg_training', TRUE);
        }


        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
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
            if ($get_user_type == 1) {
                redirect('trainee/details_pr/' . encrypt_url($dataID));
            } else {
                redirect('trainee/details_employee/' . encrypt_url($dataID));
            }
        }
        // Message
        
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

    // Local Training
    public function edit_local_training($userID)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > edit_local_training', TRUE);
        }


        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
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
            if ($get_user_type == 1) {
                redirect('trainee/details_pr/' . encrypt_url($dataID));
            } else {
                redirect('trainee/details_employee/' . encrypt_url($dataID));
            }
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
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('trainee > edit_forien_training', TRUE);
        }


        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);
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
            if ($get_user_type == 1) {
                redirect('trainee/details_pr/' . encrypt_url($dataID));
            } else {
                redirect('trainee/details_employee/' . encrypt_url($dataID));
            }
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

    // Promotion 
    public function edit_trainee_promotion($userID)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($userID); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {            
            show_404('trainee > edit_trainee_promotion', TRUE);
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
            redirect('trainee/details_employee/' . encrypt_url($dataID));
        }

        // load view data
        $results = $this->Trainee_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['promotions'] = $results['promotion'];
        // dd($this->data['promotions']);

        // Load page
        $this->data['meta_title'] = 'পদোন্নতি সংক্রান্ত তথ্য সম্পাদন ফর্ম';
        $this->data['subview'] = 'edit_trainee_promotion';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /************ Request / Verification / Decline List ***************/
    /******************************************************************/

    public function request($offset = 0)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        $limit = 25;
        // $id = (int) decrypt_url($id);
        // Trainee_model = $this->this_model();  //exit;
        //$this->data['printcolumn'] = array('name_bangla', 'national_id', 'data_type_name', 'office_type_name', 'dis_name_bn', 'upa_name_bn', 'uni_name_bn', 'desig_name');
        // printr($this->data['printcolumn']); exit;
        // printr($this->data['printcolumn']);

        // Get Login office user information
        $office = $this->Common_model->get_office_info_by_session();
        // dd($office);
        $officeID = $office->crrnt_office_id;

        // Check Auth
        if ($this->ion_auth->in_group('up')) {
            $results = $this->Trainee_model->get_application_request($limit, $offset, $officeID);
            // $results = $this->Trainee_model->get_application_request($limit, $offset, '', '', '', $office->union_id);

        } elseif ($this->ion_auth->in_group('paura')) {
            $results = $this->Trainee_model->get_application_request($limit, $offset, $officeID);

        } elseif ($this->ion_auth->in_group('uz')) {
            // $results = $this->Trainee_model->get_application_request($limit, $offset, $officeID);
            $results = $this->Trainee_model->get_application_request($limit, $offset,  null, $office->div_id, $office->dis_id, $office->upa_id);

        } elseif ($this->ion_auth->in_group('zp')) {
            // $results = $this->Trainee_model->get_application_request($limit, $offset, $officeID);
            $results = $this->Trainee_model->get_application_request($limit, $offset,  null, $office->div_id, $office->dis_id);

        } elseif ($this->ion_auth->in_group('city')) {
            $results = $this->Trainee_model->get_application_request($limit, $offset,  $officeID);

        } elseif ($this->ion_auth->in_group('ddlg')) {
            $results = $this->Trainee_model->get_application_request($limit, $offset,  null, $office->div_id, $office->dis_id);

        } elseif ($this->ion_auth->in_group('partner')) {
            $results = $this->Trainee_model->get_application_request($limit, $offset,  $officeID);

        } elseif ($this->ion_auth->in_group('nilg')) {
            $results = $this->Trainee_model->get_application_request($limit, $offset);
            
        } elseif ($this->ion_auth->in_group('cc')) {
            if ($office->office_type == 7) {
                $results = $this->Trainee_model->get_application_request($limit, $offset);
            } else {
                $results = $this->Trainee_model->get_application_request($limit, $offset, $officeID);
            }
            
        } else {
            $results = $this->Trainee_model->get_application_request($limit, $offset);
            // count($this->data['results']);
        }

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainee/request/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        // $this->data['data_type'] = $this->Common_model->get_data_type();
        // $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'আবেদনের তালিকা';
        $this->data['subview'] = 'request';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function decline_list($offset = 0)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        $limit = 25;
        // $id = (int) decrypt_url($id);
        // Trainee_model = $this->this_model();  //exit;
        //$this->data['printcolumn'] = array('name_bangla', 'national_id', 'data_type_name', 'office_type_name', 'dis_name_bn', 'upa_name_bn', 'uni_name_bn', 'desig_name');
        // printr($this->data['printcolumn']); exit;
        // printr($this->data['printcolumn']);

        // Get Login office user information
        $office = $this->Common_model->get_office_info_by_session();
        // dd($office);
        $officeID = $office->crrnt_office_id;

        // Check Auth
        if ($this->ion_auth->in_group('up')) {
            $results = $this->Trainee_model->get_application_decline($limit, $offset, $officeID);
            // $results = $this->Trainee_model->get_application_decline($limit, $offset, '', '', '', $office->union_id);

        } elseif ($this->ion_auth->in_group('paura')) {
            $results = $this->Trainee_model->get_application_decline($limit, $offset, $officeID);

        } elseif ($this->ion_auth->in_group('uz')) {
            $results = $this->Trainee_model->get_application_decline($limit, $offset, $officeID);

        } elseif ($this->ion_auth->in_group('zp')) {
            $results = $this->Trainee_model->get_application_decline($limit, $offset,  $officeID);

        } elseif ($this->ion_auth->in_group('city')) {
            $results = $this->Trainee_model->get_application_decline($limit, $offset,  $officeID);

        } elseif ($this->ion_auth->in_group('nilg')) {
            $results = $this->Trainee_model->get_application_decline($limit, $offset);

        } else {
            $results = $this->Trainee_model->get_application_decline($limit, $offset);
            // count($this->data['results']);
        }

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainee/decline_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        // $this->data['data_type'] = $this->Common_model->get_data_type();
        // $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'বাতিলকৃত আবেদনের তালিকা';
        $this->data['subview'] = 'decline_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function request_verification($id){
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        $id = (int) decrypt_url($id);
        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainee > request_verification', TRUE);
        }

        // Get Information
        $this->data['info'] = $this->Trainee_model->get_user_info($id);
        // dd($this->data['info']);
        $userType = $this->data['info']->employee_type;

        // Validation
        $this->form_validation->set_rules('verify_status', 'select verify status ', 'required|trim');

        // Validate and Input Data
        if ($this->form_validation->run() == true){
            // Set Status
            /*if($userType == 1){
                $dataStatus = 2; // Public Representative
            }else{
                $dataStatus = 1; // Employee 
            }*/

            $form_data = array(
                'is_applied'     => 0,
                'is_verify'      => $this->input->post('verify_status'),
                'status'         => $this->input->post('status'),
                'decline_reason' => $this->input->post('decline_reason'),
                );

            if($this->Common_model->edit('users', $id, 'id', $form_data)){

                if($this->input->post('verify_status') == 1){
                    // Change user group 'guest' to 'trainee'
                    $this->ion_auth->remove_from_group('', $id);
                    $this->ion_auth->add_to_group('10', $id);
                    // Success Message
                    $this->session->set_flashdata('success', 'আবেদনকারীকে ডাটাবেজে অন্তর্ভুক্ত করা হয়েছে');
                }else{
                    $this->session->set_flashdata('success', 'আবেদনটি বাতিল করা হয়েছে');
                }
                
                // Redirect
                if ($userType == 1) {
                    redirect('trainee/all_pr');
                } else {
                    redirect('trainee/all_employee');
                }
            }
        }

        // Dropdown
        $this->data['verify_status'] = $this->Common_model->set_verification_status();
        $this->data['status'] = $this->Common_model->get_data_status();

        // Load View
        $this->data['meta_title'] = 'প্রশিক্ষণার্থীর তথ্য যাচাই';
        $this->data['subview'] = 'request_verification';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /*************** Transfer Employee / Change Password **************/
    /******************************************************************/
    public function transfer_employee($id)
    {
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }

        // Decrypt Data        
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            // redirect('dashboard');
            show_404('trainee > request_verification', TRUE);
        }

        // Get user information
        $results = $this->Trainee_model->get_details_info($dataID);

        // Validation
        $this->form_validation->set_rules('crrnt_office_id', 'office name', 'required|trim');
        $this->form_validation->set_rules('transfer_join_date', 'transfer joining date', 'required|trim');
        if ($this->form_validation->run() == true){
            // new data
            $crrnt_office_id = $this->input->post('crrnt_office_id');
            $row = $this->db->select('*')->from('office')->where('id', $crrnt_office_id)->get()->row();

            // Make Array Data
            $transfer_data = array(
                'user_id'             => $dataID,
                'office_id'           => $results['info']->crrnt_office_id,
                'transfer_office_id'  => $this->input->post('crrnt_office_id'),
                'transfer_join_date'  => $this->input->post('transfer_join_date'),
                'transfer_order_file' => $this->input->post('transfer_order_file'),
                'created_date'        => date('Y-m-d'),
                );

            $last_id = $this->db->insert_id();

            // Make Array Data
            $office_type = $this->db->where('id', $this->input->post('crrnt_office_id'))->get('office')->row();
            $user_data = array(
                'office_type'       => $office_type->office_type,
                'crrnt_office_id'   => $this->input->post('crrnt_office_id'),
                'div_id'            => $row->div_id != NULL ? $row->div_id : NULL,
                'dis_id'            => $row->dis_id != NULL ? $row->dis_id : NULL,
                'upa_id'            => $row->upa_id != NULL ? $row->upa_id : NULL,
                'union_id'          => $row->union_id != NULL ? $row->union_id : NULL,
                );
            $this->Common_model->edit('users', $dataID, 'id', $user_data);

            // order Upload
            if(!empty($_FILES['transfer_order_file']) && $_FILES['transfer_order_file']['size'] > 0){
                $new_file_name = time().'-'.$last_id;
                $config['allowed_types']= 'pdf';
                $config['upload_path']  = $this->order_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 600;

                $this->load->library('upload', $config);
                   //upload file to directory
                if($this->upload->do_upload('transfer_order_file')){
                    $uploadData = $this->upload->data();
                    $config = array(
                        'source_image' => $uploadData['full_path'],
                        'new_image' => $this->order_path,
                        'maintain_ratio' => TRUE,
                        'width' => 800,
                        'height' => 800
                        );
                    $this->load->library('image_lib',$config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $uploadedFile = $uploadData['file_name'];
                    // DB fields
                    $form_data['transfer_order_file'] = $uploadedFile;
                    $this->Common_model->edit('per_transfer', $last_id, 'id', $form_data);
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }


            // Success Message
            $this->session->set_flashdata('success', 'আপনার প্রদত্ত তথ্য ডাটাবেজে সফলভাবে সংরক্ষিত হয়েছে');
            redirect('trainee/all_employee');
        }

        // load view data
        $this->data['info'] = $results['info'];

        // Load View
        $this->data['meta_title'] = ' কর্মকর্তা / কর্মচারীর বদলি ফর্ম';
        $this->data['subview'] = 'transfer_employee';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function change_user_group($id){
        if (!($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('nilg','uz','cc')))){
            redirect('dashboard');
        }

        // Decrypt Data
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee > change_user_group', TRUE);
        }

        // $user = $this->ion_auth->user($dataID)->row();
        // $groups = $this->ion_auth->groups()->result_array();
        // $currentGroups = $this->ion_auth->get_users_groups($dataID)->result();
        // dd($currentGroups);

        // Get all information
        $results = $this->Trainee_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $userType = $this->data['info']->employee_type;
        // dd($this->data['info']);

        // Validation
        $this->form_validation->set_rules('groups[]', 'Group', 'required');

        // Validate
        if ($this->form_validation->run() === TRUE){

            // Update the groups user belongs to
            $groupData = $this->input->post('groups');
            if (isset($groupData) && !empty($groupData)) {
                $this->ion_auth->remove_from_group('', $dataID);
                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $dataID);
                }

                // Message
                $this->session->set_flashdata('success', 'ইউজার রোল সফলভাবে পরিবর্তন করা হয়েছে');
                if ($userType == 1) 
                {
                    redirect('trainee/all_pr');
                } else {
                    redirect('trainee/all_employee');
                }
            }
        }

        // User Group remove some array element
        $allUserGroup = $this->ion_auth->groups()->result_array();
        // dd($allUserGroup);
        if($this->ion_auth->in_group('uz')){
            $this->data['groups'] = func_array_except($allUserGroup, [0,1,2,3,4,5,6,7,11,12,13,14,15,16,17,18]);
        }else{
            $this->data['groups'] = func_array_except($allUserGroup, [0,1,2,3,4,5,6,7,11,12,13,14,18]);
        }
        // dd($allUserGroup);
        // $this->data['groups'] = $this->ion_auth->groups()->result_array();
        $this->data['currentGroups'] = $this->ion_auth->get_users_groups($dataID)->result();
        
        // Load Page
        $this->data['meta_title'] = 'ইউজার রোল পরিবর্তন';
        $this->data['subview'] = 'change_user_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function change_password($id){
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }
        
        // Decrypt Data
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee > change_password', TRUE);
        }

        // Get all information
        $results = $this->Trainee_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $userType = $this->data['info']->employee_type;
        // dd($this->data['info']);

        //validation
        $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE){
            // finally change the password
            $identity = $this->data['info']->{$this->config->item('identity', 'ion_auth')}; //exit;

            $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
            if ($change){
                // if the password was successfully changed
                $this->session->set_flashdata('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে');
                if ($userType == 1) 
                {
                    redirect('trainee/all_pr');
                } else {
                    redirect('trainee/all_employee');
                }
            }
        }

        // view
        // $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
        $this->data['new_password'] = array(
            'name'    => 'new',
            'id'      => 'new',
            'type'    => 'text',
            'class'   => 'form-control input-sm font-opensans',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
        $this->data['new_password_confirm'] = array(
           'name'    => 'new_confirm',
           'id'      => 'new_confirm',
           'type'    => 'text',
           'class'   => 'form-control input-sm font-opensans',
           'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
           );
        
        // Load Page
        $this->data['meta_title'] = 'পাসওয়ার্ড পরিবর্তন';
        $this->data['subview'] = 'change_password';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function type_change_emp_pr($id){
        // Check Auth
        if(!$this->ion_auth->in_group(array('admin', 'nilg', 'city', 'zp', 'ddlg', 'uz', 'paura', 'up', 'partner', 'cc'))){
            redirect('dashboard');
        }
        
        // Decrypt Data
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee > type change emp pr', TRUE);
        }

        // Get all information
        $results = $this->Trainee_model->get_details_info($dataID);
        $this->data['info'] = $results['info'];
        $this->data['office_desig'] = $this->Common_model->get_desig_by_type($this->data['info']->office_type);
        // dd($this->data['office_type']);

        // Validation
        $this->form_validation->set_rules('employee_type', 'employee type', 'required|trim');
        $this->form_validation->set_rules('crrnt_desig_id', 'designation name', 'required|trim');
        if ($this->form_validation->run() == true){
            // Make Array Data
            $form_data = array(
                'employee_type'   => $this->input->post('employee_type'),
                'crrnt_desig_id'  => $this->input->post('crrnt_desig_id'),
            );

            if ($this->Common_model->edit('users', $dataID, 'id', $form_data)){
                // if the password was successfully changed
                $this->session->set_flashdata('success', 'সফলভাবে পরিবর্তন করা হয়েছে');
                if (in_array($this->data['info']->employee_type, array(2,3))) 
                {
                    redirect('trainee/all_pr');
                } else {
                    redirect('trainee/all_employee');
                }
            }
        }

        // Load Page
        $this->data['meta_title'] = 'পদবি পরিবর্তন';
        $this->data['subview'] = 'type_change_emp_pr';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*public function accept($id){
        $id = (int) decrypt_url($id);
        // $this->ion_auth->remove_from_group('', $id);
        // $this->ion_auth->add_to_group('12', $id);
        // dd('change guest');

        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainee - accept - exists', TRUE);
        }

        // Get Information
        $result = $this->Trainee_model->get_user_info($id);
        if($result->employee_type == 1){
            $status = 2; // নির্বাচিত
        }else{
            $status = 1; // কর্মরত
        }

        $form_data = array(
            'is_applied'    => 0,
            'is_verify'     => 1,
            'status'        => $status

            );*/
        // print_r($id);exit();

        //if($this->Common_model->edit('users', $id, 'id', $form_data)){
            /*$this->ion_auth->add_to_group('10', $id);
            dd('sdfds');*/
            // Change user group 'guest' to 'trainee'
            /*$this->ion_auth->remove_from_group('', $id);
            $this->ion_auth->add_to_group('10', $id);*/
            // $message = 'আবেদনটি যাচাই করে প্রশিক্ষণার্থী হিসাবে নিবন্ধন করা হয়েছে';

            // echo $this->db->last_query(); exit;
            /*$this->session->set_flashdata('success', 'আবেদনটি যাচাই করে প্রশিক্ষণার্থী হিসাবে নিবন্ধন করা হয়েছে');
            if($result->employee_type == 1){
                redirect("trainee/all_pr");
            }else{
                redirect("trainee/all_employee");
            }
        }*/

        /*// Validation
        $this->form_validation->set_rules('verify_status', 'select verify status ', 'required|trim');

        // Validate and Input Data
        if ($this->form_validation->run() == true){

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
        }*/
    //}

    /*
    public function decline($id){
        $id = (int) decrypt_url($id);

        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainee - decline - exists', TRUE);
        }

        $form_data = array(
            'is_applied'    => 0,
            'is_verify'     => 2
            );
        // print_r($id);exit();

        if($this->Common_model->edit('users', $id, 'id', $form_data)){
            $message = 'আবেদনটি বাতিল করা হয়েছে';

            $this->session->set_flashdata('success', $message);
            redirect("trainee/decline_list");
        }
    }
    */

    function ajax_get_district_by_div($id)
    {
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Trainee_model->get_district_by_div_id($id)));
    }

    function ajax_get_upa_tha_by_dis($dis_id)
    {
        // echo $dis_id; exit;
        header('Content-Type: application/x-json; charset=utf-8');
        // print_r($this->Trainee_model->get_upa_tha_by_dis_id($dis_id));

        echo (json_encode($this->Trainee_model->get_upa_tha_by_dis_id($dis_id)));
    }

    function ajax_get_organization_by_up_th_id($id)
    {
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Trainee_model->get_organization_by_up_th_id($id)));
    }

    function ajax_experiance_del($id)
    {
        $this->Common_model->delete('per_experience', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_leave_del($id)
    {
        $this->Common_model->delete('per_leave', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_promotion_del($id)
    {
        $this->Common_model->delete('per_promotion', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_education_del($id)
    {
        $this->Common_model->delete('per_education', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_nilg_training_del($id)
    {
        $this->Common_model->delete('per_nilg_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_local_training_del($id)
    {
        $this->Common_model->delete('per_local_org_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }
    function ajax_foreign_training_del($id)
    {
        $this->Common_model->delete('per_foreign_org_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_get_national_nid()
    {
        // echo 'true';
        $id = $_POST['nid'];
        echo $this->Common_model->national_id_exists($id);
    }

    public function file_check($str){
        $this->load->helper('file');
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['signature']['name']);
        $file_size = 1050000; 
        $size_kb = '1 MB';

        if(isset($_FILES['signature']['name']) && $_FILES['signature']['name']!=""){
            if(!in_array($mime, $allowed_mime_type_arr)){                
                $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png, gif file.');
                return false;
            }elseif($_FILES["signature"]["size"] > $file_size){
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

    /*public function details($id){
        $dataID = (int) decrypt_url($id); //exit;
        // Check Exists
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee - details - exists', TRUE);
        }

       
        $id = (int) decrypt_url($id);
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainee - request_verification - exists', TRUE);
        }
        $this->data['info'] = $this->Trainee_model->get_user_info($id);
   

        // Get all information
        $results = $this->Trainee_model->get_details_info($dataID);
        // dd($results['info']);

        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['promotion'] = $results['promotion'];
        $this->data['leave'] = $results['leave'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];
        $this->data['foreign_training'] = $results['foreign_training'];


        // Load Page
        $this->data['meta_title'] = 'জনপ্রতিনিধির বিস্তারিত তথ্য';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }*/

    /*public function archive($offset = 0)
    {
        $limit = 25;
        // Trainee_model = $this->this_model();

        $this->data['printcolumn'] = array('name_bangla', 'national_id', 'data_type_name', 'office_type_name', 'dis_name_bn', 'upa_name_bn', 'uni_name_bn', 'desig_name');

        if ($this->ion_auth->in_group('city')) {
            $office = $this->Office_profile_model->get_info($this->userSeessID);
            $this->data['results'] = $this->Trainee_model->get_all_archive_data($limit, $offset, '', '', $office->dis_id);
        } elseif ($this->ion_auth->in_group('zp')) {
            $office = $this->Office_profile_model->get_info($this->userSeessID);
            $this->data['results'] = $this->Trainee_model->get_all_archive_data($limit, $offset, '', '', $office->dis_id);
        } elseif ($this->ion_auth->in_group('uz')) {
            $office = $this->Office_profile_model->get_info($this->userSeessID);
            $this->data['results'] = $this->Trainee_model->get_all_archive_data($limit, $offset, $office->office_type_id, '', '', $office->upa_id);
        } elseif ($this->ion_auth->in_group('paura')) {
            $office = $this->Office_profile_model->get_info($this->userSeessID);
            $this->data['results'] = $this->Trainee_model->get_all_archive_data($limit, $offset, $office->office_type_id, '', '', $office->upa_id);
        } elseif ($this->ion_auth->in_group('up')) {
            $office = $this->Office_profile_model->get_info($this->userSeessID);
            $this->data['results'] = $this->Trainee_model->get_all_archive_data($limit, $offset, $office->office_type_id, '', '', '', $office->union_id);
        } else {
            $this->data['results'] = $this->Trainee_model->get_all_archive_data($limit, $offset);
        }

        $this->data['data_type'] = $this->Common_model->get_data_type();

        $this->data['meta_title'] = ' ব্যাক্তিগত ডাটার আর্কাইভ';
        $this->data['subview'] = 'archive';
        $this->load->view('backend/_layout_main', $this->data);
    }*/

    /*public function add()
    {
        //Validation
        $this->form_validation->set_rules('name_bangla', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_english', 'name english', 'required|trim');
        $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
        $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
        $this->form_validation->set_rules('date_of_birth', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('gender', 'gender', 'required|trim');
        $this->form_validation->set_rules('permanent_add', 'permanent address', 'required|trim');
        $this->form_validation->set_rules('per_div_id', 'division', 'required|trim');
        $this->form_validation->set_rules('per_dis_id', 'district', 'required|trim');
        $this->form_validation->set_rules('per_upa_id', 'upazila/thana', 'required|trim');
        $this->form_validation->set_rules('national_id', 'national id', 'required|trim|is_unique[personal_datas.national_id]');
        $this->form_validation->set_rules('telephone_mobile', 'phone number', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'valid_email|trim');
        $this->form_validation->set_rules('marital_status_id', 'marital status', 'required|trim');
        // $this->form_validation->set_rules('present_add', 'present address', 'required|trim');

        $this->form_validation->set_rules('data_sheet_type', 'data sheet type', 'required|trim');
        $this->form_validation->set_rules('office_type_id', 'office type', 'trim');
        $this->form_validation->set_rules('division_id', 'division ', 'trim');
        $this->form_validation->set_rules('district_id', 'district ', 'trim');
        $this->form_validation->set_rules('upa_tha_id', 'upazila/thana', 'trim');
        $this->form_validation->set_rules('union_id', 'union', 'trim');
        $this->form_validation->set_rules('first_org_name', 'first organization', 'required|trim');
        $this->form_validation->set_rules('first_desig_name', 'first designation', 'required|trim');
        $this->form_validation->set_rules('first_election_year', 'election year', 'trim');
        $this->form_validation->set_rules('first_attend_date', 'first attend date', 'required|trim');
        $this->form_validation->set_rules('curr_org_name', 'current organization', 'required|trim');
        $this->form_validation->set_rules('curr_desig_name', 'current designation', 'required|trim');
        $this->form_validation->set_rules('curr_election_year', 'election year', 'trim');
        $this->form_validation->set_rules('curr_attend_date', 'current attend date', 'required|trim');

        $office_type = NULL;
        $division   = NULL;
        $district   = NULL;
        $upazila    = NULL;
        $union      = NULL;
        $pourashava = NULL;

        if ($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uz')) {
            $office_info = $this->Office_profile_model->get_info($this->session->userdata('user_id'));
            $office_type = $office_info->office_type_id;
            $division   = $office_info->div_id;
            $district   = $office_info->dis_id;
            $upazila    = $office_info->upa_id;
            //$union      = $office_info->union_id;

            $this->data['office_type_info'] = $this->Common_model->get_info('office_type', $office_type);
            $this->data['division_info'] = $this->Common_model->get_info('divisions', $division);
            $this->data['district_info'] = $this->Common_model->get_info('districts', $district);
            $this->data['upazila_info'] = $this->Common_model->get_info('upazilas', $upazila);
            //$this->data['union_info'] = $this->Common_model->get_info('unions', $union);

        } elseif ($this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')) {
            $office_info = $this->Office_profile_model->get_info($this->session->userdata('user_id'));
            $office_type = $office_info->office_type_id;
            $division   = $office_info->div_id;
            $district   = $office_info->dis_id;
            $upazila    = $office_info->upa_id;
            $union      = $office_info->union_id;

            $this->data['office_type_info'] = $this->Common_model->get_info('office_type', $office_type);
            $this->data['division_info'] = $this->Common_model->get_info('divisions', $division);
            $this->data['district_info'] = $this->Common_model->get_info('districts', $district);
            $this->data['upazila_info'] = $this->Common_model->get_info('upazilas', $upazila);
            $this->data['union_info'] = $this->Common_model->get_info('unions', $union);
        }

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'data_sheet_type' => $this->input->post('data_sheet_type'),
                'office_type_id' => $office_type != NULL ? $office_type : $this->input->post('office_type_id'),
                'name_bangla' => $this->input->post('name_bangla'),
                'name_english' => $this->input->post('name_english'),
                'father_name' => $this->input->post('father_name'),
                'mother_name' => $this->input->post('mother_name'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'permanent_add' => $this->input->post('permanent_add'),
                'per_div_id' => $this->input->post('per_div_id'),
                'per_dis_id' => $this->input->post('per_dis_id'),
                'per_upa_id' => $this->input->post('per_upa_id'),
                'per_pc' => $this->input->post('per_pc'),
                'per_po' => $this->input->post('per_po'),
                'per_road_no' => $this->input->post('per_road_no'),
                'present_add' => $this->input->post('present_add'),
                'national_id' => $this->input->post('national_id'),
                'marital_status_id' => $this->input->post('marital_status_id'),
                'son_number' => $this->input->post('son_number'),
                'daughter_number' => $this->input->post('daughter_number'),
                'division_id' => $division != NULL ? $division : $this->input->post('division_id'),
                'district_id' => $district != NULL ? $district : $this->input->post('district_id'),
                'upa_tha_id' => $upazila != NULL ? $upazila : $this->input->post('upa_tha_id'),
                'union_id' => $union != NULL ? $union : $this->input->post('union_id'),
                'pourashava_id' => $pourashava != NULL ? $pourashava : $this->input->post('pourashava_id'),
                'telephone_mobile' => $this->input->post('telephone_mobile'),
                'email' => $this->input->post('email'),
                'first_election_year' => $this->input->post('first_election_year'),
                'first_org_id' =>  $this->organization_id($this->input->post('first_org_name')),
                'first_desig_id' => $this->designation_id($this->input->post('first_desig_name')),
                'first_attend_date' => $this->input->post('first_attend_date'),
                'curr_org_id' => $this->organization_id($this->input->post('curr_org_name')),
                'curr_desig_id' => $this->designation_id($this->input->post('curr_desig_name')),
                'curr_election_year' => $this->input->post('curr_election_year'),
                'curr_attend_date' => $this->input->post('curr_attend_date'),
                'how_much_elected' => $this->input->post('how_much_elected'),
                'job_per_date' => $this->input->post('job_per_date'),
                'retirement_prl_date' => $this->input->post('retirement_prl_date'),
                'retirement_date' => $this->input->post('retirement_date'),
                'created' => date('Y-m-d')
                );
            // print_r($form_data); exit;

            if ($this->Common_model->save('personal_datas', $form_data)) {
                //last personal data id
                $lastID = $this->db->insert_id();

                // Experiance
                for ($i = 0; $i < sizeof($_POST['exp_org_name']); $i++) {
                    $experience_data = array(
                        'data_id' => $lastID,
                        'exp_org_id' => $this->organization_id($_POST['exp_org_name'][$i]),
                        'exp_desig_id' => $this->designation_id($_POST['exp_desig_id'][$i]),
                        'exp_duration' => $_POST['exp_duration'][$i],
                        );
                    $this->Common_model->save('per_experience', $experience_data);
                }
                // Promotion
                for ($i = 0; $i < sizeof($_POST['promo_org_name']); $i++) {
                    $promotion_data = array(
                        'data_id' => $lastID,
                        'promo_org_id' => $this->organization_id($_POST['promo_org_name'][$i]),
                        'promo_desig_id' => $this->designation_id($_POST['promo_desig_id'][$i]),
                        'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                        'promo_comments' => $_POST['promo_comments'][$i],
                        );
                    $this->Common_model->save('per_promotion', $promotion_data);
                }
                // Leave
                for ($i = 0; $i < sizeof($_POST['leave_type_id']); $i++) {
                    $leave_data = array(
                        'data_id' => $lastID,
                        'leave_type_id' => $_POST['leave_type_id'][$i],
                        'leave_app' => $_POST['leave_app'][$i],
                        'leave_from' => $_POST['leave_from'][$i],
                        'leave_to' => $_POST['leave_to'][$i],
                        );
                    $this->Common_model->save('per_leave', $leave_data);
                }
                // Education
                for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
                    $education_data = array(
                        'data_id' => $lastID,
                        'edu_exam_id' => $_POST['edu_exam_id'][$i],
                        'edu_pass_year' => $_POST['edu_pass_year'][$i],
                        'edu_subject_id' => $_POST['edu_subject_id'][$i],
                        'edu_board_id' => $_POST['edu_board_id'][$i],
                        );
                    $this->Common_model->save('per_education', $education_data);
                }
                // NILG training
                for ($i = 0; $i < sizeof($_POST['nilg_course_title']); $i++) {
                    $local_org_data = array(
                        'data_id' => $lastID,
                        'nilg_course_id' => $this->training_nilg_id($_POST['nilg_course_title'][$i]),
                        'nilg_desig_id' => $this->designation_id($_POST['nilg_desig_id'][$i]),
                        'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                        'nilg_training_start' => $_POST['nilg_training_start'][$i],
                        'nilg_training_end' => $_POST['nilg_training_end'][$i],
                        );
                    $this->Common_model->save('per_nilg_training', $local_org_data);
                }
                // Local organization training
                for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
                    $local_org_data = array(
                        'data_id' => $lastID,
                        'local_course_id' => $this->training_other_id($_POST['local_course_name'][$i]),
                        'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                        'local_training_start' => $_POST['local_training_start'][$i],
                        'local_training_end' => $_POST['local_training_end'][$i],
                        );
                    $this->Common_model->save('per_local_org_training', $local_org_data);
                }
                // Foreign organization training
                for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
                    $foreign_org_data = array(
                        'data_id' => $lastID,
                        'foreign_course_id' => $this->training_foreign_id($_POST['foreign_course_name'][$i]),
                        'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                        'foreign_training_start' => $_POST['foreign_training_start'][$i],
                        'foreign_training_end' => $_POST['foreign_training_end'][$i],
                        );
                    $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
                }

                // Success Message
                $this->session->set_flashdata('success', 'New presonal data insert successfully.');
                redirect($this->this_table() . '/all/' . $this->input->post('data_sheet_type'));
            }
        }

        //Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['division_active'] = $this->Common_model->get_division_active();
        $this->data['district_active'] = $this->Common_model->get_district_active();
        $this->data['upazila_active'] = $this->Common_model->get_upazila_thana_active();
        $this->data['union_active'] = $this->Common_model->get_union_active();
        $this->data['pouroshova'] = $this->Common_model->get_pouroshova();

        $this->data['data_type'] = $this->Common_model->get_data_type();
        $this->data['office_type'] = $this->Common_model->get_office_type();

        $this->data['organization_type'] = $this->Common_model->get_organization_type();
        $this->data['organizations'] = $this->Common_model->get_organizations();
        $this->data['designation'] = $this->Common_model->get_designation();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['nilg_trainings'] = $this->Common_model->get_nilg_trainings();

        $this->data['exams'] = $this->Exam_names_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Exam_names_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Exam_names_model->get_all('*', 'boards', '1');
        $this->data['leave_type'] = $this->Common_model->get_leave_type();

        // View
        $this->data['meta_title'] = lang('personal_data_sheet_add');
        $this->data['subview'] = 'add';
        $this->load->view('backend/_layout_main', $this->data);
    }*/

    /*public function edit($id)
    {
        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('personal_datas', 'id', $dataID)) {
            show_404('personal_datas - edit - exists', TRUE);
        }

        $results = $this->Trainee_model->get_info($dataID);

        //Validation
        $this->form_validation->set_rules('name_bangla', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_english', 'name english', 'required|trim');
        $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
        $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
        $this->form_validation->set_rules('date_of_birth', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('gender', 'gender', 'required|trim');
        $this->form_validation->set_rules('permanent_add', 'permanent address', 'required|trim');
        $this->form_validation->set_rules('per_div_id', 'division', 'required|trim');
        $this->form_validation->set_rules('per_dis_id', 'district', 'required|trim');
        $this->form_validation->set_rules('per_upa_id', 'upazila/thana', 'required|trim');
        $this->form_validation->set_rules('telephone_mobile', 'phone number', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'valid_email|trim');
        $this->form_validation->set_rules('marital_status_id', 'marital status', 'required|trim');
        // $this->form_validation->set_rules('present_add', 'present address', 'required|trim');

        $this->form_validation->set_rules('data_sheet_type', 'data sheet type', 'required|trim');
        $this->form_validation->set_rules('office_type_id', 'office type', 'trim');
        $this->form_validation->set_rules('division_id', 'division', 'trim');
        $this->form_validation->set_rules('district_id', 'district', 'trim');
        $this->form_validation->set_rules('upa_tha_id', 'upazila/thana', 'trim');
        $this->form_validation->set_rules('union_id', 'union', 'trim');
        $this->form_validation->set_rules('first_org_name', 'first organization', 'required|trim');
        $this->form_validation->set_rules('first_desig_name', 'first designation', 'required|trim');
        $this->form_validation->set_rules('first_election_year', 'election year', 'trim');
        $this->form_validation->set_rules('first_attend_date', 'first attend date', 'required|trim');
        $this->form_validation->set_rules('curr_org_name', 'current organization', 'required|trim');
        $this->form_validation->set_rules('curr_desig_name', 'current designation', 'required|trim');
        $this->form_validation->set_rules('curr_election_year', 'election year', 'trim');
        $this->form_validation->set_rules('curr_attend_date', 'current attend date', 'required|trim');

        if ($this->input->post('national_id') != $results['info']->national_id) {
            $is_unique =  '|is_unique[personal_datas.national_id]';
        } else {
            $is_unique =  '';
        }
        // $this->form_validation->set_rules('user_name', 'User Name', 'required|trim|xss_clean'.$is_unique);
        $this->form_validation->set_rules('national_id', 'national id', 'required|trim' . $is_unique, 'This national id already exists.');

        $office_type = NULL;
        $division   = NULL;
        $district   = NULL;
        $upazila    = NULL;
        $union      = NULL;
        $pourashava = NULL;


        if ($this->form_validation->run() == true) {
            // echo $first_org_id = $this->organization_id($this->input->post('first_org_name')); exit;
            $form_data = array(
                'data_sheet_type' => $this->input->post('data_sheet_type'),
                'national_id' => $this->input->post('national_id'),
                'office_type_id' => $office_type != NULL ? $office_type : $this->input->post('office_type_id'),
                'name_bangla' => $this->input->post('name_bangla'),
                'name_english' => $this->input->post('name_english'),
                'father_name' => $this->input->post('father_name'),
                'mother_name' => $this->input->post('mother_name'),
                'status' => $this->input->post('status'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'permanent_add' => $this->input->post('permanent_add'),
                'per_div_id' => $this->input->post('per_div_id'),
                'per_dis_id' => $this->input->post('per_dis_id'),
                'per_upa_id' => $this->input->post('per_upa_id'),
                'per_pc' => $this->input->post('per_pc'),
                'per_po' => $this->input->post('per_po'),
                'per_road_no' => $this->input->post('per_road_no'),
                'present_add' => $this->input->post('present_add'),
                'marital_status_id' => $this->input->post('marital_status_id'),
                'son_number' => $this->input->post('son_number'),
                'daughter_number' => $this->input->post('daughter_number'),
                'division_id' => $division != NULL ? $division : $this->input->post('division_id'),
                'district_id' => $district != NULL ? $district : $this->input->post('district_id'),
                'upa_tha_id' => $upazila != NULL ? $upazila : $this->input->post('upa_tha_id'),
                'union_id' => $union != NULL ? $union : $this->input->post('union_id'),
                'pourashava_id' => $pourashava != NULL ? $pourashava : $this->input->post('pourashava_id'),
                'telephone_mobile' => bng2eng($this->input->post('telephone_mobile')),
                'email' => $this->input->post('email'),
                'first_election_year' => $this->input->post('first_election_year'),
                'first_org_id' =>  $this->organization_id($this->input->post('first_org_name')),
                'first_desig_id' => $this->designation_id($this->input->post('first_desig_name')),
                'first_attend_date' => $this->input->post('first_attend_date'),
                'curr_org_id' => $this->organization_id($this->input->post('curr_org_name')),
                'curr_desig_id' => $this->designation_id($this->input->post('curr_desig_name')),
                'curr_election_year' => $this->input->post('curr_election_year'),
                'curr_attend_date' => $this->input->post('curr_attend_date'),
                'how_much_elected' => $this->input->post('how_much_elected'),
                'job_per_date' => $this->input->post('job_per_date'),
                'retirement_prl_date' => $this->input->post('retirement_prl_date'),
                'retirement_date' => $this->input->post('retirement_date'),
                'modified' => date('Y-m-d')
                );

            // echo '<pre>';
            // print_r($form_data); exit;

            if ($this->Common_model->edit('personal_datas', $dataID, 'id', $form_data)) {
                // Experiance
                for ($i = 0; $i < count($_POST['exp_org_name']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_experience', 'id', $_POST['hide_exp_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'exp_org_id' => $this->organization_id($_POST['exp_org_name'][$i]),
                            'exp_desig_id' => $this->designation_id($_POST['exp_desig_id'][$i]),
                            'exp_duration' => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->edit('per_experience', $_POST['hide_exp_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'exp_org_id' => $this->organization_id($_POST['exp_org_name'][$i]),
                            'exp_desig_id' => $this->designation_id($_POST['exp_desig_id'][$i]),
                            'exp_duration' => $_POST['exp_duration'][$i],
                            );
                        $this->Common_model->save('per_experience', $data);
                    }
                }

                // Promotion
                for ($i = 0; $i < sizeof($_POST['promo_org_name']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_promotion', 'id', $_POST['hide_promo_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'promo_org_id' => $this->organization_id($_POST['promo_org_name'][$i]),
                            'promo_desig_id' => $this->designation_id($_POST['promo_desig_id'][$i]),
                            'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                            'promo_comments' => $_POST['promo_comments'][$i],
                            );
                        $this->Common_model->edit('per_promotion', $_POST['hide_promo_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'promo_org_id' => $this->organization_id($_POST['promo_org_name'][$i]),
                            'promo_desig_id' => $this->designation_id($_POST['promo_desig_id'][$i]),
                            'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                            'promo_comments' => $_POST['promo_comments'][$i],
                            );
                        $this->Common_model->save('per_promotion', $data);
                    }
                }

                // Leave
                for ($i = 0; $i < sizeof($_POST['leave_type_id']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_leave', 'id', $_POST['hide_leave_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'leave_type_id' => $_POST['leave_type_id'][$i],
                            'leave_app' => $_POST['leave_app'][$i],
                            'leave_from' => $_POST['leave_from'][$i],
                            'leave_to' => $_POST['leave_to'][$i],
                            );
                        $this->Common_model->edit('per_leave', $_POST['hide_leave_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'leave_type_id' => $_POST['leave_type_id'][$i],
                            'leave_app' => $_POST['leave_app'][$i],
                            'leave_from' => $_POST['leave_from'][$i],
                            'leave_to' => $_POST['leave_to'][$i],
                            );
                        $this->Common_model->save('per_leave', $data);
                    }
                }

                // Education
                for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_education', 'id', $_POST['hide_edu_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'edu_exam_id' => $_POST['edu_exam_id'][$i],
                            'edu_pass_year' => $_POST['edu_pass_year'][$i],
                            'edu_subject_id' => $_POST['edu_subject_id'][$i],
                            'edu_board_id' => $_POST['edu_board_id'][$i],
                            );
                        $this->Common_model->edit('per_education', $_POST['hide_edu_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'edu_exam_id' => $_POST['edu_exam_id'][$i],
                            'edu_pass_year' => $_POST['edu_pass_year'][$i],
                            'edu_subject_id' => $_POST['edu_subject_id'][$i],
                            'edu_board_id' => $_POST['edu_board_id'][$i],
                            );
                        $this->Common_model->save('per_education', $data);
                    }
                }

                // NILG Training
                for ($i = 0; $i < sizeof($_POST['nilg_course_title']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_nilg_training', 'id', $_POST['hide_nilg_training_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'nilg_course_id' => $this->training_nilg_id($_POST['nilg_course_title'][$i]),
                            'nilg_desig_id' => $this->designation_id($_POST['nilg_desig_id'][$i]),
                            'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                            'nilg_training_start' => $_POST['nilg_training_start'][$i],
                            'nilg_training_end' => $_POST['nilg_training_end'][$i],
                            );
                        $this->Common_model->edit('per_nilg_training', $_POST['hide_nilg_training_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'nilg_course_id' => $this->training_nilg_id($_POST['nilg_course_title'][$i]),
                            'nilg_desig_id' => $this->designation_id($_POST['nilg_desig_id'][$i]),
                            'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
                            'nilg_training_start' => $_POST['nilg_training_start'][$i],
                            'nilg_training_end' => $_POST['nilg_training_end'][$i],
                            );
                        $this->Common_model->save('per_nilg_training', $data);
                    }
                }

                // Local Training
                for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_local_org_training', 'id', $_POST['hide_local_training_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'local_course_id' => $this->training_other_id($_POST['local_course_name'][$i]),
                            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                            'local_training_start' => $_POST['local_training_start'][$i],
                            'local_training_end' => $_POST['local_training_end'][$i],
                            );
                        $this->Common_model->edit('per_local_org_training', $_POST['hide_local_training_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'local_course_id' => $this->training_other_id($_POST['local_course_name'][$i]),
                            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                            'local_training_start' => $_POST['local_training_start'][$i],
                            'local_training_end' => $_POST['local_training_end'][$i],
                            );
                        $this->Common_model->save('per_local_org_training', $data);
                    }
                }

                // Foreign Training
                for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('per_foreign_org_training', 'id', $_POST['hide_foreign_training_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'foreign_course_id' => $this->training_foreign_id($_POST['foreign_course_name'][$i]),
                            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                            'foreign_training_start' => $_POST['foreign_training_start'][$i],
                            'foreign_training_end' => $_POST['foreign_training_end'][$i],
                            );
                        $this->Common_model->edit('per_foreign_org_training', $_POST['hide_foreign_training_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'data_id' => $dataID,
                            'foreign_course_id' => $this->training_foreign_id($_POST['foreign_course_name'][$i]),
                            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                            'foreign_training_start' => $_POST['foreign_training_start'][$i],
                            'foreign_training_end' => $_POST['foreign_training_end'][$i],
                            );
                        $this->Common_model->save('per_foreign_org_training', $data);
                    }
                }

                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('personal_datas/details/' . encrypt_url($dataID));
            }
        }

        $this->data['info'] = $results['info'];
        $this->data['experience'] = $results['experience'];
        $this->data['promotion'] = $results['promotion'];
        $this->data['leave'] = $results['leave'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];
        $this->data['foreign_training'] = $results['foreign_training'];

        //Dropdown List
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        $this->data['division_active'] = $this->Common_model->get_division_active();
        $this->data['district_active'] = $this->Common_model->get_district_active();
        $this->data['upazila_active'] = $this->Common_model->get_upazila_thana_active();
        $this->data['union_active'] = $this->Common_model->get_union_active();
        $this->data['office_type'] = $this->Common_model->get_office_type();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->data['data_type'] = $this->Common_model->get_data_type();
        // $this->data['office_type'] = $this->Common_model->get_office_type();
        $this->data['pouroshova'] = $this->Common_model->get_pouroshova();

        // $this->data['organization_type'] = $this->Common_model->get_organization_type();
        $this->data['organizations'] = $this->Common_model->get_organizations();
        $this->data['designation'] = $this->Common_model->get_designation();
        $this->data['nilg_trainings'] = $this->Common_model->get_nilg_trainings();
        $this->data['leave_type'] = $this->Common_model->get_leave_type();

        $this->data['exams_2'] = $this->Common_model->get_exams();
        $this->data['subjects_2'] = $this->Common_model->get_subjects();
        $this->data['boards_2'] = $this->Common_model->get_boards();

        $this->data['exams'] = $this->Exam_names_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Exam_names_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Exam_names_model->get_all('*', 'boards', '1');

        $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        if ($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uz')) {
            $office_info = $this->Office_profile_model->get_info($this->session->userdata('user_id'));
            $office_type = $office_info->office_type_id;
            $division   = $office_info->div_id;
            $district   = $office_info->dis_id;
            $upazila    = $office_info->upa_id;
            //$union      = $office_info->union_id;

            $this->data['office_type_info'] = $this->Common_model->get_info('office_type', $office_type);
            $this->data['division_info'] = $this->Common_model->get_info('divisions', $division);
            $this->data['district_info'] = $this->Common_model->get_info('districts', $district);
            $this->data['upazila_info'] = $this->Common_model->get_info('upazilas', $upazila);
            //$this->data['union_info'] = $this->Common_model->get_info('unions', $union);

        } elseif ($this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')) {
            $office_info = $this->Office_profile_model->get_info($this->session->userdata('user_id'));
            $office_type = $office_info->office_type_id;
            $division   = $office_info->div_id;
            $district   = $office_info->dis_id;
            $upazila    = $office_info->upa_id;
            $union      = $office_info->union_id;

            $this->data['office_type_info'] = $this->Common_model->get_info('office_type', $office_type);
            $this->data['division_info'] = $this->Common_model->get_info('divisions', $division);
            $this->data['district_info'] = $this->Common_model->get_info('districts', $district);
            $this->data['upazila_info'] = $this->Common_model->get_info('upazilas', $upazila);
            $this->data['union_info'] = $this->Common_model->get_info('unions', $union);
        }

        // View
        $this->data['meta_title'] = lang('personal_data_sheet_edit');
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }*/


    // public function nilg_employee($offset = 0)
    // {
    //     $limit = 25;

    //     $results = $this->Trainee_model->get_nilg_employee($limit, $offset);
    //     // dd($results);

    //     // Results
    //     $this->data['results'] = $results['rows'];
    //     $this->data['total_rows'] = $results['num_rows'];

    //     // Pagination
    //     $this->data['pagination'] = create_pagination('trainee/nilg_employee/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

    //     // Dropdown
    //     $this->data['data_type'] = $this->Common_model->get_data_type();
    //     $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

    //     // View
    //     $this->data['meta_title'] = 'এনাইএলজি কর্মকর্তা / কর্মচারীর তালিকা';
    //     $this->data['subview'] = 'nilg_employee';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    // public function organization_id($post_item)
    // {
    //     $data_id = $this->Common_model->exists_organization_id(trim($post_item));
    //     if (!$data_id) {
    //         $data = array('org_name' => trim($post_item));
    //         $this->Common_model->save('organizations', $data);
    //         $data_id = $this->db->insert_id();
    //     }
    //     return $data_id;
    // }

    // public function designation_id($post_item)
    // {
    //     $data_id = $this->Common_model->exists_designation_id(trim($post_item));
    //     if (!$data_id) {
    //         $data = array('desig_name' => trim($post_item));
    //         $this->Common_model->save('designation', $data);
    //         $data_id = $this->db->insert_id();
    //     }
    //     return $data_id;
    // }

    // public function training_nilg_id($post_item)
    // {
    //     $data_id = $this->Common_model->exists_training_course_id(trim($post_item));
    //     if (!$data_id) {
    //         $data = array('course_title' => trim($post_item), 'course_type' => 'NILG');
    //         $this->Common_model->save('training_course', $data);
    //         $data_id = $this->db->insert_id();
    //     }
    //     return $data_id;
    // }

    // public function training_other_id($post_item)
    // {
    //     $data_id = $this->Common_model->exists_training_course_id(trim($post_item));
    //     if (!$data_id) {
    //         $data = array('course_title' => trim($post_item), 'course_type' => 'Other');
    //         $this->Common_model->save('training_course', $data);
    //         $data_id = $this->db->insert_id();
    //     }
    //     return $data_id;
    // }

    // public function training_foreign_id($post_item)
    // {
    //     $data_id = $this->Common_model->exists_training_course_id(trim($post_item));
    //     if (!$data_id) {
    //         $data = array('course_title' => trim($post_item), 'course_type' => 'Foreign');
    //         $this->Common_model->save('training_course', $data);
    //         $data_id = $this->db->insert_id();
    //     }
    //     return $data_id;
    // }

    /*public function get_columns()
    {
        // Trainee_model = $this->this_model();
        $columslist = $this->Trainee_model->getcolumnlist();
        $filtercolumns = array();
        for ($i = 0; $i < sizeof($columslist); $i++) {
            if ($columslist[$i]['Field'] == 'id') continue;
            $filtercolumns[] = $columslist[$i];
        }
        return $filtercolumns;
    }

    public function this_model()
    {
        return ucwords($this->uri->segment(1)) . '_model';
    }

    public function this_table()
    {
        return $this->uri->segment(1);
    }*/










    // public function jonoprothinidhi_report()
    // {
    //     $data['userDetails'] = $this->Common_model->get_user_details();
    //     // Trainee_model = $this->this_model();

    //     $typid = 1;

    //     $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

    //     // $search_data = array(''); , $search_data = NULL

    //     $data['all_list'] = $this->Trainee_model->get_all_data_sheet($typid);
    //     $data['districts'] = $this->General_setting_model->get_district();
    //     $data['designation'] = $this->Common_model->get_designation();

    //     $data['meta_title'] = lang('jonoprothinidhi_report');

    //     $data['subview'] = 'jonoprothinidhi_report';
    //     $this->load->view('backend/_layout_main', $data);
    // }

    // public function individual_report()
    // {
    //     $data['userDetails'] = $this->Common_model->get_user_details();
    //     Trainee_model=$this->this_model();

    //     $typid=1;

    //     $data['printcolumn']=array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'how_much_elected', 'age', 'gender');

    //     // $search_data = array(''); , $search_data = NULL

    //     $data['all_list'] = $this->Trainee_model->get_all_data_sheet($typid);
    //     $data['districts'] = $this->General_setting_model->get_district();
    //     $data['designation'] = $this->Common_model->get_designation();

    //     $data['meta_title'] = 'Individual Report';

    //     $data['subview'] = 'individual_report';
    //     $this->load->view('backend/_layout_main', $data);
    // }

    /*public function no_training_yet()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        // Trainee_model = $this->this_model();

        $typid = 1;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->Trainee_model->get_not_yet_training();
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('no_training_yet');

        $data['subview'] = 'no_training_yet';
        $this->load->view('backend/_layout_main', $data);
    }*/
    /*public function got_training()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        // Trainee_model = $this->this_model();

        $typid = 1;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->Trainee_model->got_training();
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('got_training');

        $data['subview'] = 'no_training_yet';
        $this->load->view('backend/_layout_main', $data);
    }*/

    /*public function kormokorta_report()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        // Trainee_model = $this->this_model();

        $typid = 2;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->Trainee_model->get_all_data_sheet($typid);
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('kormokorta_report');

        $data['subview'] = 'kormokorta_report';
        $this->load->view('backend/_layout_main', $data);
    }*/

    /*public function exam_report()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        // Trainee_model = $this->this_model();

        $cnt = $this->Trainee_model->get_all('count(*) as cnt', 'personal_datas', '1');
        $data['total_data'] = $cnt[0]['cnt'];

        $cnt = $this->Trainee_model->get_all('count(*) as cnt', 'personal_datas', '1');
        $data['total_data'] = $cnt[0]['cnt'];

        $data['exams'] = $this->Trainee_model->get_all('*', 'exam_names', 1);
        $data['exam_cnt'] = $this->Trainee_model->exam_cnt();

        $exam_count[] = '';
        for ($i = 0; $i < count($data['exam_cnt']); $i++) {
            $exam_count[] = $data['exam_cnt'][$i]->data_cnt;
        }

        //echo $data['total_data_count'] = $exam_count;// exit;

        $data['meta_title'] = 'শিক্ষা ভিত্তিক রিপোর্ট';

        $data['subview'] = 'exam_report';
        $this->load->view('backend/_layout_main', $data);
    }*/

    /*public function dbdateformat($dt)
    {
        $tmpdt = $dt;
        $dt = explode('-', $dt);
        if (sizeof($dt) > 1)
            return $dt[2] . '-' . $dt[1] . '-' . $dt[0];
        else
            return $tmpdt;
        }*/
    /*public function getpostdate()
    {
        // Trainee_model = $this->this_model();
        $data['allcolumns'] = $this->Trainee_model->getcolumnlist();

        $accountInfo = array();
        for ($i = 0; $i < sizeof($data['allcolumns']); $i++) {
            if ($data['allcolumns'][$i]['Type'] == 'date')
                $accountInfo[$data['allcolumns'][$i]['Field']] = $this->dbdateformat($this->input->post($data['allcolumns'][$i]['Field'], TRUE));
            else
                $accountInfo[$data['allcolumns'][$i]['Field']] = $this->input->post($data['allcolumns'][$i]['Field'], TRUE);
        }
        //print_r($accountInfo);exit;
        return $accountInfo;
    }*/

    //This function is use for Listing all account head.
    /*public function return_columnsonly()
    {
        // Trainee_model = $this->this_model();
        $columns = $this->Trainee_model->getcolumnlist();
        $colarray = array();
        for ($i = 0; $i < sizeof($columns); $i++) {
            $colarray[] = $columns[$i]['Field'];
        }
        return $colarray;
    }*/

    /*public function delete()
    {
        // Trainee_model = $this->this_model();
        $id = $this->input->get('id');

        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('personal_datas', 'id', $dataID)) {
            show_404('personal_datas - edit - exists', TRUE);
        }

        if ($this->db->delete($this->this_table(), array('id' => $dataID))) {
            $this->session->set_flashdata('message', 'Deleted Successful');
            redirect($this->this_table() . '/all');
        }
    }*/

    /*function ajax_get_nid()
    {
        // echo 'true';
        $id = $_POST['nid'];
        echo $this->Common_model->exists_national_id($id);
    }*/

    

    //**********************************************************************************//
    // Setup my profile
    //**********************************************************************************//
    /*function ajax_question_by_id($id){
        $results = $this->Trainee_model->get_details_info($id);
        // dd($results['info']);
        $this->data['info'] = $results['info'];

        $this->data['experience'] = $results['experience'];
        $this->data['promotion'] = $results['promotion'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];
        $this->data['foreign_training'] = $results['foreign_training'];

        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        $this->data['marital_status'] = $this->Common_model->get_marital_status();
        $this->load->view('ajax_general_details', $this->data);
    }*/

    /*function ajax_personal_update(){
        echo "string";
    }*/

}
