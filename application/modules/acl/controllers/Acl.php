<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acl extends Backend_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->data['module_title'] = lang('user_management');
        $this->load->model('Acl_model');
        $this->load->model('general_setting/General_setting_model');

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        } elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        }
    }    

    public function index($offset = 0)
    {
        //Manage list the users
        $limit = 50;
        $results = $this->Acl_model->get_users($limit, $offset);
        // print_r($results); exit;

        $this->data['users'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        //pagination
        $this->data['pagination'] = create_pagination('acl/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown
        // User Group remove some array element
        $allUserGroup = $this->ion_auth->groups()->result_array();
        // dd($allUserGroup);
        $this->data['groups'] = $this->array_except($allUserGroup, [0, 7, 12]);

        //Load page
        $this->data['meta_title'] = lang('user_management_list');
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    

    public function create_user()
    {
        // Initialize Variable
        $officeType = $officeID = $partnerID = $division = $district = $upazila = $union = NULL;
        // Ion Auth
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $group = $this->input->post('group'); // User Group

        // Validate form input
        $this->form_validation->set_rules('crrnt_office_id', 'office', 'required');
        $this->form_validation->set_rules('groups[]', 'ইউজার গ্রুপ', 'required');
        // $this->form_validation->set_rules('office_desk_name', 'অফিস/ডেস্কের নাম', 'required');
        
        // Username and Password
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

        // Validate and Save DB
        if ($this->form_validation->run() == true) {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $officeID = $this->input->post('crrnt_office_id') != NULL ? $this->input->post('crrnt_office_id') : NULL;
            // Get office information
            if ($officeID) {
                $office = $this->Common_model->get_office_info($officeID);
                // dd($office);
                $officeType = $office->office_type;
                $officeID   = $office->id;
                if ($officeType == 6) { // Development Partner
                    $partnerID = $office->partner_id;
                } else {
                    $division   = $office->division_id;
                    $district   = $office->district_id;
                    $upazila    = $office->upazila_id;
                    $union      = $office->union_id;
                }
            }

            // Array Data
            $additional_data = array(
                'is_office'       => 1,
                'office_type'     => $officeType,
                'partner_id'      => $partnerID,
                'name_bn'         => $this->input->post('name_bn'),
                'crrnt_office_id' => $officeID,
                'office_name'     => $this->input->post('office_desk_name'),
                'div_id'          => $division,
                'dis_id'          => $district,
                'upa_id'          => $upazila,
                'union_id'        => $union,
                'mobile_no'       => $this->input->post('mobile_no')
                );
        }
        // dd($_POST);

        // Select User Group ID
        // $groups_id = array($this->input->post('group'));
        // Checked Group IDs
        $groups_id = $this->input->post('groups');

        // print_r($additional_data); exit;
        if ($this->form_validation->run() == true && $this->ion_auth->register(strtolower($identity), $password, $email, $additional_data, $groups_id)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('acl');
        }

        // Dropdown list
        // $this->data['division'] = $this->Common_model->get_division_active();
        // $this->data['division_active'] = $this->Common_model->get_division_active();
        // $this->data['office_type'] = $this->Common_model->get_office_type();
        // User Group remove some array element
        $allUserGroup = $this->ion_auth->groups()->result_array();
        // dd($allUserGroup);
        $this->data['groups'] = $this->array_except($allUserGroup, [0, 7, 12]);
        // dd($allUserGroup);

        // display the create user form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        // Load Page
        $this->data['meta_title'] = lang('user_create');
        $this->data['subview'] = 'create_user';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_user($id)
    {
        // Decrypt Data        
        $id = (int) decrypt_url($id); //exit;
        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Acl > edit_user', TRUE);
        } 

        // Initialize Variable
        $officeType = $officeID = $partnerID = $division = $district = $upazila = $union = NULL;

        $user = $this->ion_auth->user($id)->row();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        // $groups = $this->ion_auth->groups()->result_array();
        // User Group remove some array element
        $allUserGroup = $this->ion_auth->groups()->result_array();
        // dd($allUserGroup);
        $groups = $this->array_except($allUserGroup, [0, 7, 12]);
        // dd($groups);

        // POST Data
        if (isset($_POST) && !empty($_POST)) {
            // validate form input
            $this->form_validation->set_rules('crrnt_office_id', 'office', 'required');
            $this->form_validation->set_rules('groups[]', 'ইউজার গ্রুপ', 'required');

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
            }

            // Vaidate and Insert to DB
            if ($this->form_validation->run() === TRUE) {
                $officeID = $this->input->post('crrnt_office_id') != NULL ? $this->input->post('crrnt_office_id') : NULL;
                // Get office information
                if ($officeID) {
                    $office = $this->Common_model->get_office_info($officeID);
                    // dd($office);
                    $officeType = $office->office_type;
                    $officeID   = $office->id;
                    if ($officeType == 6) { // Development Partner
                        $partnerID = $office->partner_id;
                    } else {
                        $division   = $office->division_id;
                        $district   = $office->district_id;
                        $upazila    = $office->upazila_id;
                        $union      = $office->union_id;
                    }
                } 
                // Array Data
                $data = array(
                    'office_type'     => $officeType,
                    'partner_id'      => $partnerID,
                    'name_bn'         => $this->input->post('name_bn'),
                    // 'username'        => $this->input->post('nid'),
                    // 'nid'             => $this->input->post('nid'),
                    // 'dob'             => $this->input->post('dob'),
                    'crrnt_office_id' => $officeID,
                    'office_name'     => $this->input->post('office_desk_name'),
                    'div_id'          => $division,
                    'dis_id'          => $district,
                    'upa_id'          => $upazila,
                    'union_id'        => $union,
                    'mobile_no'       => $this->input->post('mobile_no'),
                    'active'          => $this->input->post('active')
                    );
                // dd($data);

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {

                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');
                    if (isset($groupData) && !empty($groupData)) {
                        $this->ion_auth->remove_from_group('', $id);
                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                    
                    // $groupData = $this->input->post('groups');
                    /*if (isset($group) && !empty($group)) {
                        $this->ion_auth->remove_from_group('', $id);
                        $this->ion_auth->add_to_group($group, $id);
                    }*/
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('acl');
                    } else {
                        redirect('dashboard');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('all');
                    } else {
                        redirect('dashboard');
                    }
                }
            }
        }

        // display the edit user form
        // $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        // $this->data['currentGroup'] = $currentGroups[0]->id;
        // dd($this->data['currentGroups']);
        // dd($user);

        // Office Info
        $this->data['officeName'] = '';
        if ($user->crrnt_office_id) {
            $office = $this->Common_model->get_office_info($user->crrnt_office_id);
            // dd($office->office_name);
            $this->data['officeName'] = $office->office_name;
        }

        // Dropdown List
        /*$this->data['division_active'] = $this->Common_model->get_division_active();
        $this->data['district_active'] = $this->Common_model->get_district_active();
        $this->data['upazila_active'] = $this->Common_model->get_upazila_thana_active();
        $this->data['office_type'] = $this->Common_model->get_office_type();*/
        // dd($user);

        // Load Page
        $this->data['meta_title'] = 'ইউজারের তথ্য সংশোধন'; //lang('user_update');
        $this->data['subview'] = 'edit_user';
        $this->load->view('backend/_layout_main', $this->data);
    }


    function array_except($array, $keys)
    {
        // PHP Array Remove Multiple Elements by Key Example
        // https://hdtuto.com/article/php-array-remove-multiple-elements-by-key-example
        foreach ($keys as $key) {
            unset($array[$key]);
        }

        return $array;
    }





    /******************** Access Level *********************/
    public function access_level()
    {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_access_level();

        //Load page
        $this->data['meta_title'] = 'Access Level';
        $this->data['subview'] = 'access_level';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create_access_level()
    {
        // validate form input
        $this->form_validation->set_rules('task_register_id', 'select task register', 'required');
        $this->form_validation->set_rules('groups_id', 'select group', 'required');
        $this->form_validation->set_rules('groups_role_id', 'select group role', 'required');
        $this->form_validation->set_rules('groups_type_id', 'select group type', 'required');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'task_register_id' => $this->input->post('task_register_id'),
                'groups_id' => $this->input->post('groups_id'),
                'groups_role_id' => $this->input->post('groups_role_id'),
                'groups_type_id' => $this->input->post('groups_type_id')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->save('access_level', $form_data)) {
                $this->session->set_flashdata('success', 'New access insert successfully.');
                redirect('acl/access_level');
            }
        }

        // Dropdown
        $this->data['task_register'] = $this->Acl_model->get_dd_task_register();
        $this->data['groups'] = $this->Acl_model->get_dd_groups();
        $this->data['groups_role'] = $this->Acl_model->get_dd_groups_role();
        $this->data['groups_type'] = $this->Acl_model->get_dd_groups_type();

        // Load View
        $this->data['meta_title'] = 'Create Access Level';
        $this->data['subview'] = 'create_access_level';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_access_level($id)
    {
        // validate form input
        $this->form_validation->set_rules('task_register_id', 'select task register', 'required');
        $this->form_validation->set_rules('groups_id', 'select group', 'required');
        $this->form_validation->set_rules('groups_role_id', 'select group role', 'required');
        $this->form_validation->set_rules('groups_type_id', 'select group type', 'required');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'task_register_id' => $this->input->post('task_register_id'),
                'groups_id' => $this->input->post('groups_id'),
                'groups_role_id' => $this->input->post('groups_role_id'),
                'groups_type_id' => $this->input->post('groups_type_id')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->edit('access_level', $id, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/access_level');
            }
        }

        // Dropdown
        $this->data['task_register'] = $this->Acl_model->get_dd_task_register();
        $this->data['groups'] = $this->Acl_model->get_dd_groups();
        $this->data['groups_role'] = $this->Acl_model->get_dd_groups_role();
        $this->data['groups_type'] = $this->Acl_model->get_dd_groups_type();

        // Get details data
        $this->data['info'] = $this->Acl_model->get_access_level_info($id);

        // Load View
        $this->data['meta_title'] = 'Edit Access Level';
        $this->data['subview'] = 'edit_access_level';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** Task Register *********************/
    public function task_register()
    {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_task_register();

        //Load page
        $this->data['meta_title'] = 'Task_Register';
        $this->data['subview'] = 'task_register';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new Task Register
    public function create_task_register()
    {
        // validate form input
        $this->form_validation->set_rules('task_name_en', 'task name english', 'required');
        $this->form_validation->set_rules('task_name_bn', 'task name bangla', 'required');
        $this->form_validation->set_rules('controller_name', 'controller name', 'required');
        $this->form_validation->set_rules('controller_function', 'function name', 'required');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'task_name_en' => $this->input->post('task_name_en'),
                'task_name_bn' => $this->input->post('task_name_bn'),
                'controller_name' => $this->input->post('controller_name'),
                'controller_function' => $this->input->post('controller_function')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->save('task_register', $form_data)) {
                $this->session->set_flashdata('success', 'New task insert successfully.');
                redirect('acl/task_register');
            }
        }

        // echo '<pre>';
        $this->load->library('controllerlist');
        // print_r($this->controllerlist->getControllers());
        $this->data['controllers'] = $this->controllerlist->getControllers();

        $this->data['meta_title'] = 'Create Task Register';
        $this->data['subview'] = 'create_task_register';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new Task Register
    public function edit_task_register($id)
    {
        // validate form input
        $this->form_validation->set_rules('task_name_en', 'task name english', 'required');
        $this->form_validation->set_rules('task_name_bn', 'task name bangla', 'required');
        $this->form_validation->set_rules('controller_name', 'controller name', 'required');
        $this->form_validation->set_rules('controller_function', 'function name', 'required');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'task_name_en' => $this->input->post('task_name_en'),
                'task_name_bn' => $this->input->post('task_name_bn'),
                'controller_name' => $this->input->post('controller_name'),
                'controller_function' => $this->input->post('controller_function')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->edit('task_register', $id, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/task_register');
            }
        }

        // echo '<pre>';
        $this->load->library('controllerlist');
        // print_r($this->controllerlist->getControllers());
        $this->data['controllers'] = $this->controllerlist->getControllers();
        $this->data['info'] = $this->Acl_model->get_task_register_info($id);

        $this->data['meta_title'] = 'Edit Task Register';
        $this->data['subview'] = 'edit_task_register';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** User *********************/
    // create a new user



    /******************** GROUP TYPE *********************/
    public function group_type()
    {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_group_type();

        //Load page
        $this->data['meta_title'] = 'Group Type';
        $this->data['subview'] = 'group_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new ROLE group
    public function create_group_type()
    {

        // validate form input
        $this->form_validation->set_rules('group_type_en', 'group type', 'required');
        $this->form_validation->set_rules('group_type_bn', 'গ্রুপ টাইপ বাংলা', 'required');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'group_type_en' => $this->input->post('group_type_en'),
                'group_type_bn' => $this->input->post('group_type_bn'),
                'type_description' => $this->input->post('type_description')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->save('groups_type', $form_data)) {
                $this->session->set_flashdata('success', 'New group type insert successfully.');
                redirect('acl/group_type');
            }
        }

        $this->data['meta_title'] = 'Create Group Type';
        $this->data['subview'] = 'create_group_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_group_type($id)
    {

        $this->form_validation->set_rules('group_type_en', 'group type name', 'required');
        $this->form_validation->set_rules('group_type_bn', 'গ্রুপ টাইপ বাংলা', 'required');

        $this->data['info'] = $this->Acl_model->get_group_type_info($id);
        // print_r($this->data['info']); exit;

        if ($this->form_validation->run() == true) {

            $form_data = array(
                'group_type_en' => $this->input->post('group_type_en'),
                'group_type_bn' => $this->input->post('group_type_bn'),
                'type_description' => $this->input->post('type_description')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->edit('groups_type', $id, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/group_type');
            }
        }

        $this->data['meta_title'] = 'Edit Group Type';
        $this->data['subview'] = 'edit_group_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** ROLE GROUP *********************/
    public function role_group()
    {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_role_group();

        //Load page
        $this->data['meta_title'] = 'Role Group Name';
        $this->data['subview'] = 'role_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new ROLE group
    public function create_role_group()
    {

        // validate form input
        $this->form_validation->set_rules('role_name_en', 'role group english', 'required');
        $this->form_validation->set_rules('role_name_bn', 'role group bangla', 'required');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'role_name_en' => $this->input->post('role_name_en'),
                'role_name_bn' => $this->input->post('role_name_bn'),
                'role_description' => $this->input->post('role_description')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->save('groups_role', $form_data)) {
                $this->session->set_flashdata('success', 'New role insert successfully.');
                redirect('acl/role_group');
            }
        }

        // $this->data['info'] = $this->My_profile_model->get_info($this->id);

        $this->data['meta_title'] = 'Create Role Group';
        $this->data['subview'] = 'create_role_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_role_group($id)
    {

        $this->form_validation->set_rules('role_name_en', 'role group english', 'required');
        $this->form_validation->set_rules('role_name_bn', 'role group bangla', 'required');

        $this->data['info'] = $this->Acl_model->get_role_group_info($id);
        // print_r($this->data['info']); exit;

        if ($this->form_validation->run() == true) {

            $form_data = array(
                'role_name_en' => $this->input->post('role_name_en'),
                'role_name_bn' => $this->input->post('role_name_bn'),
                'role_description' => $this->input->post('role_description')
                );

            // print_r($form_data); exit;
            if ($this->Common_model->edit('groups_role', $id, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/role_group');
            }
        }

        $this->data['meta_title'] = 'Edit Role Group';
        $this->data['subview'] = 'edit_role_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** GROUP Name *********************/
    public function group_name()
    {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_group_name();

        //Load page
        $this->data['meta_title'] = 'Group Name';
        $this->data['subview'] = 'group_name';
        $this->load->view('backend/_layout_main', $this->data);
    }


    // create a new group
    public function create_group()
    {

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('acl/group_name');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name'  => 'group_name',
                'id'    => 'group_name',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('group_name'),
                );
            $this->data['description'] = array(
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('description'),
                );

            $this->data['meta_title'] = $this->lang->line('create_group_title');
            $this->data['subview'] = 'create_group';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }



    // edit a group
    public function edit_group($id)
    {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('dashboard');
        }

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('dashboard');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect('acl/group_name');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') || $this->config->item('default_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name'    => 'group_name',
            'id'      => 'group_name',
            'class'   => 'form-control input-sm',
            'type'    => 'text',
            'value'   => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
            );
        $this->data['group_description'] = array(
            'name'  => 'group_description',
            'id'    => 'group_description',
            'class' => 'form-control input-sm',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
            );

        $this->data['meta_title'] = $this->lang->line('edit_group_title');
        $this->data['subview'] = 'edit_group';
        $this->load->view('backend/_layout_main', $this->data);
    }


    // activate the user
    public function activate($id, $code = false)
    {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("acl");
        } else {
            // redirect them to the forgot password page
            // $this->session->set_flashdata('message', $this->ion_auth->errors());
            // redirect("login/forgot_password");

            redirect("acl");
        }
    }

    // deactivate the user
    public function deactivate($id = NULL)
    {
        // if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
        //     // redirect them to the home page because they must be an administrator to view this
        //     return show_error('You must be an administrator to view this page.');
        // }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            //Load Page
            $this->data['meta_title'] = 'Deactivate User';
            $this->data['subview'] = 'deactivate_user';
            $this->load->view('backend/_layout_main', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            // redirect them back to the auth page
            redirect('acl');
        }
    }

    public function delete_user($id)
    {
        // Decrypt Data        
        $id = (int) decrypt_url($id); //exit;
        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Acl > delete_user', TRUE);
        }

        // Check Access
        if ($this->ion_auth->is_admin()) {
            $this->Acl_model->destroy_user($id);
            $this->session->set_flashdata('success', 'Delete user successfully.');
            redirect("acl");
        } else {
            redirect('dashboard');
        }
    }


    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }



    /*
    public function script_create_office_users($officeType){
        // exit;
        $message = '';
        $results = $this->Acl_model->get_office($officeType);
        // dd($results);        

        if(empty($results)){
            $message = 'No data found!';
            // exit;
        }

        //$inserID = 16;

        foreach ($results as $row) {
            // Generate Username
            // $username = 'up@urkirchar--';
            // $username = 'up@urkirchar--';
            //$inserID++;

            // Get Office ID
            if($officeType==8){ // DDLG Office
                $zilaName = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($row->dis_name_en, ENT_QUOTES));
                $username = 'ddlg@'.strtolower($zilaName);
                $password   = 'ddlg@123';
                $user_group = array('14');

            }elseif($officeType==5){ // City Corp.
                $username = 'city@rangpur'; // Manual city@chattogram
                $password   = 'city@555';
                $user_group = array('3');

            }elseif($officeType==4){ // Zila Parishad                
                $zilaName = trim($row->dis_name_en);
                $username = 'zp@'.strtolower($zilaName);
                $password   = 'zp@12345';
                $user_group = array('4');

            }elseif($officeType==3){ // Upazila Parishad
                $upazilaName = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($row->upa_name_en, ENT_QUOTES));
                $username = 'uz@'.strtolower($upazilaName);
                $password   = 'uz@12345';
                $user_group = array('5');

            }elseif($officeType==2){ // Paurashava
                $paurashavaName = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($row->upa_name_en, ENT_QUOTES));
                $username = 'paura@'.strtolower($paurashavaName);
                $password   = 'paura@12345';
                $user_group = array('6');

            }elseif($officeType==1){ // Union Parishad
                $unionName = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($row->uni_name_en, ENT_QUOTES));
                $username = 'up@'.strtolower($unionName); //'up@urkirchar--'; 

                // Check for duplicate union username
                $exists = $this->Acl_model->exists_username($username);
                if(!$exists){
                    $upazilaName = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($row->upa_name_en, ENT_QUOTES));
                    $username = $username.'_'.strtolower($upazilaName);
                    // dd($username);
                }

                $password   = 'up@12345';
                $user_group = array('7');
            }

            // Array Data
            $additional_data = array(
                //'id'              => $inserID,
                'office_type'     => $row->office_type,
                'crrnt_office_id' => $row->id,
                'div_id'          => $row->division_id,
                'dis_id'          => $row->district_id,
                'upa_id'          => $row->upazila_id,
                'union_id'        => $row->union_id
                );
            // dd($additional_data);

            // If Exists
            $exists = $this->Acl_model->exists_username($username);
            // dd($exists);
            if($exists){
                // Data Insert
                if ($this->ion_auth->register($username, $password, '', $additional_data, $user_group)){
                    if($this->Common_model->edit('office', $row->id, 'id', array('is_create' => 1))){
                        $message[] = $row->id.' তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
                    }
                }
                // $message[] = $row->id.' Inserted'; 
            }else{
                $message[] = $row->id.' <span style="color:red">এই অফিসের ইউজারনেইম টি বিদ্যামান রয়েছে</span>';
            }
           
        }

        dd($message);
    }
    */
}
