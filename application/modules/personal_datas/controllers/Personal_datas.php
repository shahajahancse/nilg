<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Personal_datas extends Backend_Controller
{
    var $userID;

    function __construct()
    {
        parent::__construct();
        $this->data['module_title'] = 'ব্যাক্তিগত ডাটা সীট';
        if (!$this->ion_auth->logged_in()) :
            redirect('login');
        endif;
        $this->userID = $this->session->userdata('user_id');
        $this->load->model('Personal_datas_model');
        $this->load->model('Common_model');
        $this->load->model('general_setting/General_setting_model');
        $this->load->model('exam_names/Exam_names_model');
    }

    public function index()
    {
        redirect('personal_datas/all');
    }

    public function all($offset = 0)
    {
        $limit = 25;
        $thismodel = $this->this_model();  //exit;   

        $this->data['printcolumn'] = array('name_bangla', 'national_id', 'data_type_name', 'office_type_name', 'dis_name_bn', 'upa_name_bn', 'uni_name_bn', 'desig_name');
        // printr($this->data['printcolumn']); exit;
        // printr($this->data['printcolumn']);

        if ($this->ion_auth->in_group('city')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset, '', '', $office->dis_id);
        } elseif ($this->ion_auth->in_group('zp')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset, '', '', $office->dis_id);
        } elseif ($this->ion_auth->in_group('uzp')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset, $office->office_type_id, '', '', $office->upa_id);
        } elseif ($this->ion_auth->in_group('paura')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset, $office->office_type_id, '', '', $office->upa_id);
        } elseif ($this->ion_auth->in_group('up')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset, $office->office_type_id, '', '', '', $office->union_id);
        } elseif ($this->ion_auth->in_group('nilg_staff')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset, $office->office_type_id, '', '', '', '');
        } else {
            // echo 'hello'; exit;
            $results = $this->$thismodel->get_all_data_sheet($limit, $offset);
            // count($this->data['results']);     
        }

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('personal_datas/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        $this->data['data_type'] = $this->Common_model->get_data_type();
        $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = lang('personal_datas_list');
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function archive($offset = 0)
    {
        $limit = 25;
        $thismodel = $this->this_model();

        $this->data['printcolumn'] = array('name_bangla', 'national_id', 'data_type_name', 'office_type_name', 'dis_name_bn', 'upa_name_bn', 'uni_name_bn', 'desig_name');

        if ($this->ion_auth->in_group('city')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $this->data['results'] = $this->$thismodel->get_all_archive_data($limit, $offset, '', '', $office->dis_id);
        } elseif ($this->ion_auth->in_group('zp')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $this->data['results'] = $this->$thismodel->get_all_archive_data($limit, $offset, '', '', $office->dis_id);
        } elseif ($this->ion_auth->in_group('uzp')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $this->data['results'] = $this->$thismodel->get_all_archive_data($limit, $offset, $office->office_type_id, '', '', $office->upa_id);
        } elseif ($this->ion_auth->in_group('paura')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $this->data['results'] = $this->$thismodel->get_all_archive_data($limit, $offset, $office->office_type_id, '', '', $office->upa_id);
        } elseif ($this->ion_auth->in_group('up')) {
            $office = $this->Office_profile_model->get_info($this->userID);
            $this->data['results'] = $this->$thismodel->get_all_archive_data($limit, $offset, $office->office_type_id, '', '', '', $office->union_id);
        } else {
            $this->data['results'] = $this->$thismodel->get_all_archive_data($limit, $offset);
        }

        $this->data['data_type'] = $this->Common_model->get_data_type();

        $this->data['meta_title'] = ' ব্যাক্তিগত ডাটার আর্কাইভ';
        $this->data['subview'] = 'archive';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id)
    {
        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('personal_datas', 'id', $dataID)) {
            show_404('personal_datas - details - exists', TRUE);
        }

        $results = $this->Personal_datas_model->get_info($dataID);

        $this->data['info'] = $results['info'];
        // print_r($this->data[s'info']); exit;
        $this->data['experience'] = $results['experience'];
        $this->data['promotion'] = $results['promotion'];
        $this->data['leave'] = $results['leave'];
        $this->data['education'] = $results['education'];
        $this->data['nilg_training'] = $results['nilg_training'];
        $this->data['local_training'] = $results['local_training'];
        $this->data['foreign_training'] = $results['foreign_training'];

        //Load Page
        $this->data['meta_title'] = 'বাক্তিগত ডাটা সীটের বিস্তারিত তথ্য';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add()
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

        // print_r($this->session->all_userdata()); exit;

        if ($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uzp')) {
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
            // echo 'hello'; exit;
            $office_type = @$office_info->office_type_id;
            $division   = @$office_info->div_id;
            $district   = @$office_info->dis_id;
            $upazila    = @$office_info->upa_id;
            $union      = @$office_info->union_id;

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
        // $this->data['nilg_trainings'] = $this->Common_model->get_nilg_trainings();

        $this->data['exams'] = $this->Exam_names_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Exam_names_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Exam_names_model->get_all('*', 'boards', '1');
        $this->data['leave_type'] = $this->Common_model->get_leave_type();

        // View
        $this->data['meta_title'] = lang('personal_data_sheet_add');
        $this->data['subview'] = 'add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id)
    {
        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('personal_datas', 'id', $dataID)) {
            show_404('personal_datas - edit - exists', TRUE);
        }

        $results = $this->Personal_datas_model->get_info($dataID);

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
        // $this->data['nilg_trainings'] = $this->Common_model->get_nilg_trainings();
        $this->data['leave_type'] = $this->Common_model->get_leave_type();

        $this->data['exams_2'] = $this->Common_model->get_exams();
        $this->data['subjects_2'] = $this->Common_model->get_subjects();
        $this->data['boards_2'] = $this->Common_model->get_boards();

        $this->data['exams'] = $this->Exam_names_model->get_all('*', 'exam_names', '1');
        $this->data['subjects'] = $this->Exam_names_model->get_all('*', 'subjects', '1');
        $this->data['boards'] = $this->Exam_names_model->get_all('*', 'boards', '1');

        $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        if ($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uzp')) {
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
    }

    public function organization_id($post_item)
    {
        $data_id = $this->Common_model->exists_organization_id(trim($post_item));
        if (!$data_id) {
            $data = array('org_name' => trim($post_item));
            $this->Common_model->save('organizations', $data);
            $data_id = $this->db->insert_id();
        }
        return $data_id;
    }

    public function designation_id($post_item)
    {
        $data_id = $this->Common_model->exists_designation_id(trim($post_item));
        if (!$data_id) {
            $data = array('desig_name' => trim($post_item));
            $this->Common_model->save('designation', $data);
            $data_id = $this->db->insert_id();
        }
        return $data_id;
    }

    public function training_nilg_id($post_item)
    {
        $data_id = $this->Common_model->exists_training_course_id(trim($post_item));
        if (!$data_id) {
            $data = array('course_title' => trim($post_item), 'course_type' => 'NILG');
            $this->Common_model->save('training_course', $data);
            $data_id = $this->db->insert_id();
        }
        return $data_id;
    }

    public function training_other_id($post_item)
    {
        $data_id = $this->Common_model->exists_training_course_id(trim($post_item));
        if (!$data_id) {
            $data = array('course_title' => trim($post_item), 'course_type' => 'Other');
            $this->Common_model->save('training_course', $data);
            $data_id = $this->db->insert_id();
        }
        return $data_id;
    }

    public function training_foreign_id($post_item)
    {
        $data_id = $this->Common_model->exists_training_course_id(trim($post_item));
        if (!$data_id) {
            $data = array('course_title' => trim($post_item), 'course_type' => 'Foreign');
            $this->Common_model->save('training_course', $data);
            $data_id = $this->db->insert_id();
        }
        return $data_id;
    }

    public function get_columns()
    {
        $thismodel = $this->this_model();
        $columslist = $this->$thismodel->getcolumnlist();
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
    }










    public function jonoprothinidhi_report()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel = $this->this_model();

        $typid = 1;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('jonoprothinidhi_report');

        $data['subview'] = 'jonoprothinidhi_report';
        $this->load->view('backend/_layout_main', $data);
    }

    // public function individual_report()
    // {
    //     $data['userDetails'] = $this->Common_model->get_user_details();
    //     $thismodel=$this->this_model();

    //     $typid=1;

    //     $data['printcolumn']=array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'how_much_elected', 'age', 'gender');

    //     // $search_data = array(''); , $search_data = NULL

    //     $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
    //     $data['districts'] = $this->General_setting_model->get_district();
    //     $data['designation'] = $this->Common_model->get_designation();

    //     $data['meta_title'] = 'Individual Report';

    //     $data['subview'] = 'individual_report';
    //     $this->load->view('backend/_layout_main', $data);
    // }

    public function no_training_yet()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel = $this->this_model();

        $typid = 1;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->$thismodel->get_not_yet_training();
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('no_training_yet');

        $data['subview'] = 'no_training_yet';
        $this->load->view('backend/_layout_main', $data);
    }
    public function got_training()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel = $this->this_model();

        $typid = 1;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->$thismodel->got_training();
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('got_training');

        $data['subview'] = 'no_training_yet';
        $this->load->view('backend/_layout_main', $data);
    }

    public function kormokorta_report()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel = $this->this_model();

        $typid = 2;

        $data['printcolumn'] = array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('kormokorta_report');

        $data['subview'] = 'kormokorta_report';
        $this->load->view('backend/_layout_main', $data);
    }

    public function exam_report()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel = $this->this_model();

        $cnt = $this->$thismodel->get_all('count(*) as cnt', 'personal_datas', '1');
        $data['total_data'] = $cnt[0]['cnt'];

        $cnt = $this->$thismodel->get_all('count(*) as cnt', 'personal_datas', '1');
        $data['total_data'] = $cnt[0]['cnt'];

        $data['exams'] = $this->$thismodel->get_all('*', 'exam_names', 1);
        $data['exam_cnt'] = $this->$thismodel->exam_cnt();

        $exam_count[] = '';
        for ($i = 0; $i < count($data['exam_cnt']); $i++) {
            $exam_count[] = $data['exam_cnt'][$i]->data_cnt;
        }

        //echo $data['total_data_count'] = $exam_count;// exit;

        $data['meta_title'] = 'শিক্ষা ভিত্তিক রিপোর্ট';

        $data['subview'] = 'exam_report';
        $this->load->view('backend/_layout_main', $data);
    }



    //   public function jonoprothinidhi_report_summ()
    //   {
    //       $data['userDetails'] = $this->Common_model->get_user_details();
    //       $thismodel=$this->this_model();

    //       $typid=1;

    //       $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 1);
    //       $data['union'] = $org_counter[0]['org_count'];

    //       $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 2);
    //       $data['upazila'] = $org_counter[0]['org_count'];

    //       $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 3);
    //       $data['zila'] = $org_counter[0]['org_count'];

    //       $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 4);
    //       $data['pouroshova'] = $org_counter[0]['org_count'];

    //       $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 5);
    //       $data['city_corporation'] = $org_counter[0]['org_count'];

    //       $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1"');
    //       $data['total_data']=$cnt[0]['cnt'];

    //       $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=1');
    //       $data['total_charman']=$cnt[0]['cnt'];

    //       $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=6');
    //       $data['total_mayor']=$cnt[0]['cnt'];

    //       $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=2');
    //       $data['total_member_normal']=$cnt[0]['cnt'];

    //       $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=4');
    //       $data['vice_charirman']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=18');
    //       $data['office_sohokari']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=27');
    //       $data['com_mudrakhorik']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=12');
    //       $data['union_somajkormi']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=17');
    //       $data['upo_sohokari_prokusoli']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=46');
    //       $data['upzela_ekhademic_super']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=31');
    //       $data['upzela_ekhademic_supervisor']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=33');
    //       $data['upzela_nirbahi_officer']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=29');
    //       $data['upzela_poriber_porikolpona_sohokari']=$cnt[0]['cnt'];

    //       $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=37');
    //       $data['upzela_polli_unnoyon']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=20');
    //       $data['ten']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=24');
    //       $data['eleven']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=30');
    //       $data['twelve']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=42');
    //       $data['tharteen']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=25');
    //       $data['fourteen']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=21');
    //       $data['fiften']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=51');
    //       $data['sixten']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=45');
    //       $data['seventeen']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=10');
    //       $data['eighteen']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=8');
    //       $data['nineteen']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=7');
    //       $data['twenty']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=14');
    //       $data['twentyone']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=26');
    //       $data['twentytwo']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=1');
    //       $data['twentythree']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=48');
    //       $data['twentyfour']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=28');
    //       $data['twentyfive']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=22');
    //       $data['twentysix']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=44');
    //       $data['twentyseven']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=15');
    //       $data['twentyeight']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=11');
    //       $data['twentynine']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=47');
    //       $data['tharty']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=34');
    //       $data['thartyone']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=13');
    //       $data['thartytwo']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=43');
    //       $data['thartythree']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=5');
    //       $data['thartyfour']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=4');
    //       $data['thartyfive']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=6');
    //       $data['thartysix']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=50');
    //       $data['thartyseven']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=9');
    //       $data['thartyeight']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=3');
    //       $data['thartynine']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=32');
    //       $data['fourtyone']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=49');
    //       $data['fourtytwo']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=40');
    //       $data['fourtythree']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=16');
    //       $data['fourtyfour']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=41');
    //       $data['fourtyfive']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=23');
    //       $data['fourtysix']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=19');
    //       $data['fourtyseven']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=35');
    //       $data['fourtyeight']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=36');
    //       $data['fourtynine']=$cnt[0]['cnt'];

    // $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=39');
    //       $data['fifty']=$cnt[0]['cnt'];

    //       $data['meta_title'] = lang('jonoprothinidhi_report_summ'); 

    //       $data['subview'] = 'jonoprothinidhi_report_summ';
    //       $this->load->view('backend/_layout_main', $data);
    //   }

    // public function kormokorta_report_summ()
    //    {
    //        $data['userDetails'] = $this->Common_model->get_user_details();
    //        $thismodel=$this->this_model();

    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2"');
    //        $data['total_data']=$cnt[0]['cnt'];

    //        $typid=2;

    //        $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 1);
    //        $data['union'] = $org_counter[0]['org_count'];

    //        $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 2);
    //        $data['upazila'] = $org_counter[0]['org_count'];

    //        $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 3);
    //        $data['zila'] = $org_counter[0]['org_count'];

    //        $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 4);
    //        $data['pouroshova'] = $org_counter[0]['org_count'];

    //        $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 5);
    //        $data['city_corporation'] = $org_counter[0]['org_count'];

    //        // Other's data
    //        $data['other_data'] = $data['total_data'] - ($data['union']+$data['upazila']+$data['zila']+$data['pouroshova']+$data['city_corporation']);


    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2"');
    //        $data['total_data']=$cnt[0]['cnt'];

    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=1');
    //        $data['total_charman']=$cnt[0]['cnt'];

    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=6');
    //        $data['total_mayor']=$cnt[0]['cnt'];

    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=2');
    //        $data['total_member_normal']=$cnt[0]['cnt'];

    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=4');
    //        $data['vice_charirman']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=18');
    //        $data['office_sohokari']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=27');
    //        $data['com_mudrakhorik']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=12');
    //        $data['union_somajkormi']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=17');
    //        $data['upo_sohokari_prokusoli']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=46');
    //        $data['upzela_ekhademic_super']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=31');
    //        $data['upzela_ekhademic_supervisor']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=33');
    //        $data['upzela_nirbahi_officer']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=29');
    //        $data['upzela_poriber_porikolpona_sohokari']=$cnt[0]['cnt'];

    //        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=37');
    //        $data['upzela_polli_unnoyon']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=20');
    //        $data['ten']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=24');
    //        $data['eleven']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=30');
    //        $data['twelve']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=42');
    //        $data['tharteen']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=25');
    //        $data['fourteen']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=21');
    //        $data['fiften']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=51');
    //        $data['sixten']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=45');
    //        $data['seventeen']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=10');
    //        $data['eighteen']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=8');
    //        $data['nineteen']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=7');
    //        $data['twenty']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=14');
    //        $data['twentyone']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=26');
    //        $data['twentytwo']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=1');
    //        $data['twentythree']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=48');
    //        $data['twentyfour']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=28');
    //        $data['twentyfive']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=22');
    //        $data['twentysix']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=44');
    //        $data['twentyseven']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=15');
    //        $data['twentyeight']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=11');
    //        $data['twentynine']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=47');
    //        $data['tharty']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=34');
    //        $data['thartyone']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=13');
    //        $data['thartytwo']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=43');
    //        $data['thartythree']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=5');
    //        $data['thartyfour']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=4');
    //        $data['thartyfive']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=6');
    //        $data['thartysix']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=50');
    //        $data['thartyseven']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=9');
    //        $data['thartyeight']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=3');
    //        $data['thartynine']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=32');
    //        $data['fourtyone']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=49');
    //        $data['fourtytwo1']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=40');
    //        $data['fourtythree']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=16');

    //        $data['fourtyfour']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=41');
    //        $data['fourtyfive']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=23');
    //        $data['fourtysix']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=19');
    //        $data['fourtyseven']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=35');
    //        $data['fourtyeight']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=36');
    //        $data['fourtynine']=$cnt[0]['cnt'];

    // 	$cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=39');
    //        $data['fifty']=$cnt[0]['cnt'];

    //        $data['meta_title'] = 'কর্মকর্তা/কর্মচারীর সামারি রিপোর্ট'; 

    //        $data['subview'] = 'kormokorta_report_summ';
    //        $this->load->view('backend/_layout_main', $data);
    //    }


    public function dbdateformat($dt)
    {
        $tmpdt = $dt;
        $dt = explode('-', $dt);
        if (sizeof($dt) > 1)
            return $dt[2] . '-' . $dt[1] . '-' . $dt[0];
        else
            return $tmpdt;
    }
    public function getpostdate()
    {
        $thismodel = $this->this_model();
        $data['allcolumns'] = $this->$thismodel->getcolumnlist();

        $accountInfo = array();
        for ($i = 0; $i < sizeof($data['allcolumns']); $i++) {
            if ($data['allcolumns'][$i]['Type'] == 'date')
                $accountInfo[$data['allcolumns'][$i]['Field']] = $this->dbdateformat($this->input->post($data['allcolumns'][$i]['Field'], TRUE));
            else
                $accountInfo[$data['allcolumns'][$i]['Field']] = $this->input->post($data['allcolumns'][$i]['Field'], TRUE);
        }
        //print_r($accountInfo);exit;
        return $accountInfo;
    }

    //This function is use for Listing all account head.
    public function return_columnsonly()
    {
        $thismodel = $this->this_model();
        $columns = $this->$thismodel->getcolumnlist();
        $colarray = array();
        for ($i = 0; $i < sizeof($columns); $i++) {
            $colarray[] = $columns[$i]['Field'];
        }
        return $colarray;
    }

    public function delete()
    {
        $thismodel = $this->this_model();
        $id = $this->input->get('id');

        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('personal_datas', 'id', $dataID)) {
            show_404('personal_datas - edit - exists', TRUE);
        }

        if ($this->db->delete($this->this_table(), array('id' => $dataID))) {
            $this->session->set_flashdata('message', 'Deleted Successful');
            redirect($this->this_table() . '/all');
        }
    }

    function ajax_get_nid()
    {
        // echo 'true';
        $id = $_POST['nid'];
        echo $this->Common_model->exists_national_id($id);
    }

    function ajax_get_district_by_div($id)
    {
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Personal_datas_model->get_district_by_div_id($id)));
    }

    function ajax_get_upa_tha_by_dis($dis_id)
    {
        // echo $dis_id; exit;
        header('Content-Type: application/x-json; charset=utf-8');
        // print_r($this->$thismodel->get_upa_tha_by_dis_id($dis_id));

        echo (json_encode($this->Personal_datas_model->get_upa_tha_by_dis_id($dis_id)));
    }

    function ajax_get_organization_by_up_th_id($id)
    {
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Personal_datas_model->get_organization_by_up_th_id($id)));
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
}
