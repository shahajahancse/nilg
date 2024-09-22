<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'ছুটির ব্যাবস্তাপনা';
        $this->load->model('Common_model');
        $this->load->model('Leave_model');
        $this->img_orginal_path = realpath(APPPATH . '../uploads/temp_dir/');
        $this->img_thumb_path = realpath(APPPATH . '../uploads/temp_dir/_thumb/');
        $this->img_path = realpath(APPPATH . '../uploads/leave/');
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
    }

    public function index($status = null){
        $offset=0;
        $this->load->model('Common_model');
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        // Manage list the users
        $limit = 50;

        if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Leave_model->get_data($limit, $offset, $status);
        } elseif (func_nilg_auth($userDetails->office_type) == 'employee') {
            $results = $this->Leave_model->get_data($limit, $offset, null, $userDetails->id);
        }

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        // Dropdown List
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['info'] = $this->Leave_model->get_user('users',$this->session->userdata('user_id'));

        //Load page
        if ($this->ion_auth->in_group(array('admin', 'nilg', 'leave_admin'))) {
            $this->data['meta_title'] = 'অনুমোদিত ছুটির তালিকা';
            $this->data['subview'] = 'index';
        } elseif (func_nilg_auth($userDetails->office_type) == 'employee') {
            $results = $this->Leave_model->get_yearly_leave_count($userDetails->id);
            $this->data['total_leave'] = $results['total_leave'];
            $this->data['used_leave'] = $results['used_leave'];
            $this->data['meta_title'] = 'ছুটির তালিকা';
            $this->data['subview'] = 'staff_index';
        }
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function form_print($uid){
        $id = (int) decrypt_url($uid);
        $this->data['row'] = $this->Leave_model->get_user('leave_employee', $id);
        $this->load->view('leave/form' , $this->data);
    }

    public function add(){
        if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            redirect('leave');
        }
        $this->load->model('Common_model');
        $userDetails = $this->data['userDetails'];
        $this->data['division'] = $this->Common_model->get_division();

        // Validation
        $this->form_validation->set_rules('user_id', 'স্টাফ নাম', 'required|trim');
        $this->form_validation->set_rules('leave_type', 'ছুটির টাইপ', 'required|trim');
        $this->form_validation->set_rules('assign_person', 'বিকল্প কর্মকর্তা', 'required|trim');
        if ($this->input->post('leave_type') == 12) {
            $this->form_validation->set_rules('first_day', 'প্রথম দিন', 'required|trim');
        } else {
            $this->form_validation->set_rules('from_date', 'শুরুর তারিখ', 'required|trim');
            $this->form_validation->set_rules('to_date', 'শেষ তারিখ', 'required|trim');
        }
        // Insert Data
        $uploadedFile = null;
        if ($this->form_validation->run() == true){
            if ($this->input->post('assign_person') == 'bikolpo') {
                $bikolpo = 'বিকল্প কর্মকর্তা নেই ।';
                $assign_person = null;
            } else {
                $bikolpo = null;
                $assign_person = $this->input->post('assign_person');
            }

            $user_info = $this->db->where('id', $this->input->post('user_id'))->get('users')->row();
            if (!empty($user_info->crrnt_dept_id) && !empty($user_info->crrnt_desig_id)) {
                if ($this->ion_auth->in_group(array('leave_admin'))) {
                    $types = 1;
                } else {
                    $types = $user_info->employee_type;
                }

                if($_FILES['userfile']['size'] > 0){

                   $new_file_name = time().'-'.$_FILES["userfile"]['name'];

                   $config['allowed_types']= 'pdf';
                   $config['upload_path']  = $this->img_path;
                   $config['file_name']    = $new_file_name;
                   $config['max_size']     = 0;

                   $this->load->library('upload', $config);
                    //upload file to directory
                   if($this->upload->do_upload()){
                        $uploadData = $this->upload->data();
                        $uploadedFile = $uploadData['file_name'];
                    }else{
                        $this->data['success'] = $this->upload->display_errors();
                    }
                }
                $leave_address_arr=[
                    'father_name' => $this->input->post('father_name'),
                    'division_id' => $this->input->post('division_id'),
                    'district_id' => $this->input->post('district_id'),
                    'upazila_id'  => $this->input->post('upazila_id'),
                    'village'     => $this->input->post('village'),
                    'post_office' => $this->input->post('post_office'),
                    'mobile_number'=> $this->input->post('mobile_number')
                ];
                $leave_address = json_encode($leave_address_arr);

                if ($this->input->post('leave_type') == 8) {
                    $total_days = $this->Leave_model->GetDays($this->input->post('from_date'), $this->input->post('to_date'));
                    $form_data = array(
                        'user_id'       => $this->input->post('user_id'),
                        'dept_id'       => $user_info->crrnt_dept_id,
                        'desig_id'      => $user_info->crrnt_desig_id,
                        'leave_type'    => $this->input->post('leave_type'),
                        'assign_person' => $assign_person,
                        'bikolpo'       => $bikolpo,
                        'control_person'=> ($this->input->post('control_person'))?$this->input->post('control_person'):null,
                        'from_date'     => $this->input->post('from_date'),
                        'to_date'       => $this->input->post('to_date'),
                        'leave_days'    => count($total_days),
                        'leave_address' => $leave_address,
                        'reason'        => $this->input->post('reason'),
                        'employee_type' => $types,
                        'status'        => 1,
                        'file_name'     => $uploadedFile,
                        'created_date'  => date("Y-m-d"),
                    );

                    if($this->Common_model->save('leave_employee', $form_data)){
                        $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা হয়েছে.');
                        redirect('leave');
                    } else {
                        $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা সম্ভব হচ্ছে না।.');
                        redirect('leave/add');
                    }
                } else {
                    if (!empty($this->input->post('first_day'))) {
                        $form_data1 = array(
                            'user_id'      => $this->input->post('user_id'),
                            'dept_id'      => $user_info->crrnt_dept_id,
                            'desig_id'     => $user_info->crrnt_desig_id,
                            'leave_type'   => $this->input->post('leave_type'),
                            'assign_person'=> $assign_person,
                            'bikolpo'      => $bikolpo,
                            'control_person'=> ($this->input->post('control_person'))?$this->input->post('control_person'):null,
                            'from_date'    => $this->input->post('first_day'),
                            'to_date'      => $this->input->post('first_day'),
                            'leave_days'   => 1,
                            'leave_address'=> $leave_address,
                            'reason'       => $this->input->post('reason'),
                            'status'       => 1,
                            'file_name'    => $uploadedFile,
                            'created_date' => date("Y-m-d"),
                        );
                        $this->db->where('from_date', $this->input->post('first_day'));
                        $this->db->where('user_id', $this->input->post('user_id'));
                        $first = $this->db->get('leave_employee')->row();
                        if (empty($first)) {
                            $this->Common_model->save('leave_employee', $form_data1);
                            $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা হয়েছে.');
                        }
                    }

                    if (!empty($this->input->post('second_day'))) {
                        $form_data2 = array(
                            'user_id'      => $this->input->post('user_id'),
                            'dept_id'      => $user_info->crrnt_dept_id,
                            'desig_id'     => $user_info->crrnt_desig_id,
                            'leave_type'   => $this->input->post('leave_type'),
                            'assign_person'=> $assign_person,
                            'bikolpo'      => $bikolpo,
                            'control_person'=> ($this->input->post('control_person'))?$this->input->post('control_person'):null,
                            'from_date'    => $this->input->post('second_day'),
                            'to_date'      => $this->input->post('second_day'),
                            'leave_days'   => 1,
                            'leave_address'=> $leave_address,
                            'reason'       => $this->input->post('reason'),
                            'status'       => 1,
                            'file_name'    => $uploadedFile,
                            'created_date' => date("Y-m-d"),
                        );
                        $this->db->where('from_date', $this->input->post('second_day'));
                        $this->db->where('user_id', $this->input->post('user_id'));
                        $second = $this->db->get('leave_employee')->row();
                        if (empty($second)) {
                            $this->Common_model->save('leave_employee', $form_data2);
                            $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা হয়েছে.');
                        }
                    }

                    if (!empty($this->input->post('third_day'))) {
                        $form_data3 = array(
                            'user_id'      => $this->input->post('user_id'),
                            'dept_id'      => $user_info->crrnt_dept_id,
                            'desig_id'     => $user_info->crrnt_desig_id,
                            'leave_type'   => $this->input->post('leave_type'),
                            'assign_person'=> $assign_person,
                            'bikolpo'      => $bikolpo,
                            'control_person'=> ($this->input->post('control_person'))?$this->input->post('control_person'):null,
                            'from_date'    => $this->input->post('third_day'),
                            'to_date'      => $this->input->post('third_day'),
                            'leave_days'   => 1,
                            'leave_address'=> $leave_address,
                            'reason'       => $this->input->post('reason'),
                            'status'       => 1,
                            'file_name'    => $uploadedFile,
                            'created_date' => date("Y-m-d"),
                        );
                        $this->db->where('from_date', $this->input->post('third_day'));
                        $this->db->where('user_id', $this->input->post('user_id'));
                        $third = $this->db->get('leave_employee')->row();
                        if (empty($third)) {
                            $this->Common_model->save('leave_employee', $form_data3);
                            $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা হয়েছে.');
                        }
                    }
                    redirect('leave');
                }

            } else {
                $this->session->set_flashdata('error', 'Please update profile first');
                redirect('my_profile');
            }
        }

        $this->data['leave_type'] = $this->Leave_model->get_leave_type();
        $this->data['info'] = $this->Leave_model->get_user('users',$this->session->userdata('user_id'));

        $results = $this->Leave_model->get_yearly_leave_count($userDetails->id);
        $this->data['users'] = $this->Common_model->get_nilg_employee($this->data['info']->crrnt_dept_id, $this->data['info']->employee_type);
        $this->data['bikolpo'] = $this->Common_model->get_nilg_employee(null, $this->data['info']->employee_type);
        // dd($this->data['users']);
        if ($this->data['info']->employee_type == 3) {
            $rs = $this->db->select('id, name_bn')->where('office_type', 7)->where_in('crrnt_desig_id', array(116,244))->get('users')->result();
            foreach ($rs as $key => $r) {
                $this->data['users'][$r->id] = $r->name_bn;
            }
        }
        // View
        $this->data['meta_title'] = 'ছুটি যুক্ত করুন';
        $this->data['total_leave'] = $results['total_leave'];
        $this->data['used_leave'] = $results['used_leave'];
        $this->data['subview'] = 'staff_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $id = (int) decrypt_url($id);
        // Check Exists
        if (!$this->Common_model->exists('leave_employee', 'id', $id)) {
            redirect('dashboard');
        }
        // Validation
        $this->form_validation->set_rules('user_id', 'স্টাফ নাম', 'required|trim');
        $this->form_validation->set_rules('leave_type', 'ছুটির টাইপ', 'required|trim');
        $this->form_validation->set_rules('assign_person', 'বিকল্প কর্মকর্তা', 'required|trim');
        $this->form_validation->set_rules('from_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('to_date', 'শেষ তারিখ', 'required|trim');

        // Insert Data
        $uploadedFile = null;
        if ($this->form_validation->run() == true){
            if ($this->input->post('assign_person') == 'bikolpo') {
                $bikolpo = 'বিকল্প কর্মকর্তা নেই ।';
                $assign_person = null;
            } else {
                $bikolpo = null;
                $assign_person = $this->input->post('assign_person');
            }

            $user_info = $this->db->where('id', $this->input->post('user_id'))->get('users')->row();
            if (!empty($user_info->crrnt_dept_id) && !empty($user_info->crrnt_desig_id)) {

                $leave_address_arr=[
                    'father_name' => $this->input->post('father_name'),
                    'division_id' => $this->input->post('division_id'),
                    'district_id' => $this->input->post('district_id'),
                    'upazila_id' => $this->input->post('upazila_id'),
                    'village' => $this->input->post('village'),
                    'post_office' => $this->input->post('post_office'),
                    'mobile_number'=> $this->input->post('mobile_number')
                ];
                $leave_address = json_encode($leave_address_arr);

                // file upload
                if($_FILES['userfile']['size'] > 0){
                    $new_file_name = time().'-'.$_FILES["userfile"]['name'];
                    $config['allowed_types']= 'pdf';
                    $config['upload_path']  = $this->img_path;
                    $config['file_name']    = $new_file_name;
                    $config['max_size']     = 0;

                    $this->load->library('upload', $config);
                    //upload file to directory
                    if($this->upload->do_upload()){
                        $uploadData = $this->upload->data();
                        $uploadedFile = $uploadData['file_name'];
                    }else{
                        $this->data['success'] = $this->upload->display_errors();
                    }
                }
                // file upload end

                $total_days = $this->Leave_model->GetDays($this->input->post('from_date'), $this->input->post('to_date'));
                $form_data = array(
                    'user_id'       => $this->input->post('user_id'),
                    'from_date'     => $this->input->post('from_date'),
                    'to_date'       => $this->input->post('to_date'),
                    'control_person'=> ($this->input->post('control_person'))?$this->input->post('control_person'):null,
                    'assign_person' => $assign_person,
                    'bikolpo'       => $bikolpo,
                    'leave_days'    => count($total_days),
                    'leave_address' => $leave_address,
                    'reason'        => $this->input->post('reason'),
                    'file_name'     => $uploadedFile,
                );

                // dd($form_data); exit;
                if($this->Common_model->edit('leave_employee', $id, 'id', $form_data)){
                    $this->session->set_flashdata('success', 'সফলভাবে সংশোধন করা হয়েছে');
                    redirect('leave');
                } else {
                    $this->session->set_flashdata('success', 'ছুটিটি সংশোধন করা সম্ভব হচ্ছে না।.');
                    redirect('leave');
                }
            } else {
                $this->session->set_flashdata('error', 'Please update profile first');
                redirect('my_profile');
            }
        }

        // Dropdown List
        $this->data['row'] = $this->Leave_model->get_info($id);
        $this->data['users'] = $this->Common_model->get_nilg_employee($this->data['row']->dept_id, $this->data['row']->employee_type);
        $this->data['bikolpo'] = $this->Common_model->get_nilg_employee(null, $this->data['row']->employee_type);
        if ($this->data['row']->employee_type == 3) {
            $rs = $this->db->select('id, name_bn')->where('office_type', 7)->where_in('crrnt_desig_id', array(116,244))->get('users')->result();
            foreach ($rs as $key => $r) {
                $this->data['users'][$r->id] = $r->name_bn;
            }
        }

        $this->data['leave_type'] = $this->Leave_model->get_leave_type();
        $results = $this->Leave_model->get_yearly_leave_count($this->data['row']->user_id);
        $this->data['total_leave'] = $results['total_leave'];
        $this->data['used_leave'] = $results['used_leave'];
        $this->data['division'] = $this->Common_model->get_division();
        // View
        $this->data['meta_title'] = 'সম্পাদনা করুন';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function forward_change($id, $status = null){
        $id = (int) decrypt_url($id);
        // Check Exists
            $form_data = array(
                'status'      => $status,
            );
        if($this->Common_model->edit('leave_employee', $id, 'id', $form_data)){
            $this->session->set_flashdata('success', 'সফলভাবে সংশোধন করা হয়েছে');
            redirect('leave');
        }
    }

    public function change_status($id, $status = null){
        $id = (int) decrypt_url($id);
        // Check Exists
        if (!$this->Common_model->exists('leave_employee', 'id', $id)) {
            redirect('dashboard');
        }

        if (isset($_POST['submit']) && trim($_POST['submit']) == "সংরক্ষণ করুন") {
            if ($_POST['status'] == 4) {
                $message = 'সফলভাবে সংশোধন করা হয়েছে ।';
            } elseif ($_POST['status'] == 5) {
                $message = 'সফলভাবে প্রত্যাখ্যাত করা হয়েছে ।';
            }

            $total_days = $this->Leave_model->GetDays($this->input->post('from_date'), $this->input->post('to_date'));

            $form_data = array(
                'from_date'  => $_POST['from_date'],
                'to_date'  => $_POST['to_date'],
                'leave_days'   => count($total_days),
                'control_remark'  => $_POST['control_remark'],
                'status'          => $_POST['status'],
                'approve_person'  => $this->data['userDetails']->id,
            );
            // dd($form_data); exit;

            if($this->Common_model->edit('leave_employee', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', $message);
                redirect('leave/pending_list');
            }
        }

        // Dropdown List
        $this->data['row'] = $this->Leave_model->get_info($id);
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['leave_type'] = $this->Leave_model->get_leave_type();
        $results = $this->Leave_model->get_yearly_leave_count($this->data['row']->user_id);
        $this->data['total_leave'] = $results['total_leave'];
        $this->data['used_leave'] = $results['used_leave'];

        // View
        $this->data['meta_title'] = 'সম্পাদনা করুন';
        $this->data['subview'] = 'change_status';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function assign_list($offset=0){
        $offset=0;
        $this->load->model('Common_model');
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        // Manage list the users
        $limit = 50;
        $assign=$userDetails->id;

        $results = $this->Leave_model->get_data($limit = 1000, $offset = 0, $status = null, $user = null,$assign);
        $this->data['users'] = $this->Common_model->get_nilg_employee();


        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('leave/assign_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['meta_title'] = 'অনুমোদিত ছুটির তালিকা';
        $this->data['subview'] = 'assign_list';

        $this->load->view('backend/_layout_main', $this->data);
    }
    public function ass_edit($uid){
        $uid = (int) decrypt_url($uid);
        $this->data['row'] = $this->Leave_model->get_user('leave_employee', $uid);
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['leave_type'] = $this->Leave_model->get_leave_type();
        $results = $this->Leave_model->get_yearly_leave_count($this->data['row']->user_id);
        $this->data['total_leave'] = $results['total_leave'];
        $this->data['used_leave'] = $results['used_leave'];
        $this->data['info'] = $this->Leave_model->get_user('users',$this->data['row']->user_id);

        // View
        $this->data['meta_title'] = 'সম্পাদনা করুন';
        $this->data['subview'] = 'ass_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function ass_update(){
        $id = $this->input->post('id');
        $form_data = array(
            'leave_type'  => $this->input->post('leave_type'),
            'from_date'  => $this->input->post('from_date'),
            'to_date'  => $this->input->post('to_date'),
            'leave_days'  => $this->input->post('leave_days'),
            'reason'  => $this->input->post('reason'),
            'control_remark'  => $this->input->post('control_remark'),
            'status'  =>2,
        );
        $this->db->where('id', $id);
        if($this->db->update('leave_employee', $form_data)){
            $this->session->set_flashdata('success', 'সফলভাবে পরিবর্তন করা হয়েছে ।');
            redirect('leave/assign_list');
        }else{
            $this->session->set_flashdata('error', 'দুঃখিত, পরিবর্তন হয়নি ।');
        }
    }

    public function approved_list($offset=0)
    {
        $this->load->model('Common_model');
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        // Manage list the users
        $limit = 50;
        $results = $this->Leave_model->get_data($limit, $offset, 4, null, $userDetails->id);
        // dd($results);

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        // Dropdown List
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['info'] = $this->Leave_model->get_user('users',$this->session->userdata('user_id'));

        //Load page
        if ($this->ion_auth->in_group(array('admin', 'nilg', 'leave_admin'))) {
            $this->data['meta_title'] = 'অনুমোদিত ছুটির তালিকা';
            $this->data['subview'] = 'index';
        } elseif (func_nilg_auth($userDetails->office_type) == 'employee') {
            $results = $this->Leave_model->get_yearly_leave_count($userDetails->id);
            $this->data['total_leave'] = $results['total_leave'];
            $this->data['used_leave'] = $results['used_leave'];
            $this->data['meta_title'] = 'ছুটির তালিকা';
            $this->data['subview'] = 'staff_index';
        }
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pending_list($offset=0)
    {
        // Manage list the users
        $limit = 50;
        $desig_array = array();
        $dept_id = $this->data['userDetails']->crrnt_dept_id;

        if (!empty($dept_id) && !empty($this->data['userDetails']->crrnt_desig_id) || $this->ion_auth->is_admin()) {
            if ($this->ion_auth->in_group(array('leave_admin'))) {
                $results = $this->Leave_model->get_list($limit, $offset, array(3));
            } else if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
                $results = $this->Leave_model->get_list($limit, $offset, array(2, 3));
            } else {
                $results = $this->Leave_model->get_list_assign($limit, $offset, $this->data['userDetails']->id, 2);
            }

            $this->data['results'] = $results['rows'];
            $this->data['total_rows'] = $results['num_rows'];

            //pagination
            $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            // Dropdown List
            $this->data['users'] = $this->Common_model->get_nilg_employee();
            $this->data['info'] = $this->Leave_model->get_user('users',$this->session->userdata('user_id'));
            //Load page
            $this->data['subview'] = 'pending_list';
            $this->data['meta_title'] = 'অপেক্ষমাণ ছুটির তালিকা';
            $this->load->view('backend/_layout_main', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Please update profile first');
            redirect('my_profile');
        }
    }

    public function rejected_list($offset=0)
    {
        // Manage list the users
        $limit = 50;
        if ($this->ion_auth->in_group(array('admin', 'nilg', 'leave_admin'))) {
            $results = $this->Leave_model->get_data($limit, $offset, 5);
        } elseif (func_nilg_auth($userDetails->office_type) == 'employee') {
            $results = $this->Leave_model->get_data($limit, $offset, 5, $userDetails->id);
        }
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['info'] = $this->Leave_model->get_user('users',$this->session->userdata('user_id'));

        //Load page
        $this->data['subview'] = 'rejected_list';
        $this->data['meta_title'] = 'প্রত্যাখ্যাত ছুটির তালিকা';
        $this->load->view('backend/_layout_main', $this->data);
    }

    //========= leave system report here  =============//
    public function leave_reports(){
        // Input Data
        $btn_submit = $this->input->post('btnsubmit');
        $date_from  = $this->input->post('date_from');
        $date_to    = $this->input->post('date_to');
        $type       = $this->input->post('leave_type');

        if($btn_submit == 'current_leave_report') {
            // Results
            $this->data['results'] = $this->Leave_model->get_current_report(4, $date_from, $date_to);

            // Generate PDF
            $this->data['headding'] = 'ছুটিতে আছে তার তালিকা';
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;
            $html = $this->load->view('pdf_current_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else if($btn_submit == 'done_leave') {

            // Results
            $this->data['results'] = $this->Leave_model->get_report(4, $date_from, $date_to, $type);

            // Generate PDF
            $this->data['headding'] = ' সম্পন্ন ছুটির রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else if($btn_submit == 'pending_leave') {

            // Results
            $this->data['results'] = $this->Leave_model->get_report(array(2,3), $date_from, $date_to, $type);

            // Generate PDF
            $this->data['headding'] = ' অপেক্ষমাণ ছুটি রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else if($btn_submit == 'reject_leave') {
            // Results
            $this->data['results'] = $this->Leave_model->get_report(5, $date_from, $date_to, $type);

            // Generate PDF
            $this->data['headding'] = 'প্রত্যাখ্যাত ছুটি রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }else if($btn_submit == 'specific_officer_leave') {
            // Results
            $user_id = $this->input->post('user');
            $results = $this->Leave_model->get_yearly_leave_count($user_id);
            $this->data['total_leave'] = $results['total_leave'];
            $this->data['used_leave'] = $results['used_leave'];
            $this->data['info'] = $this->Leave_model->get_user_info($user_id);
            // dd($this->data['info']);

            // Generate PDF
            $this->data['headding'] = 'নির্দিষ্ট কর্মকর্তার ছুটির রিপোর্ট';
            $html = $this->load->view('pdf_specific_officer_leave', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        } else if($btn_submit == 'enjoyed_leave_report') {
            // Results
            $user_id = $this->input->post('user');
           $this->data['results'] = $this->Leave_model->get_enjoyed_leave_report($date_from, $date_to, 4);

            // Generate PDF
            $this->data['headding'] = 'ভোগকৃত ছুটির রিপোর্ট';
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;
            $html = $this->load->view('pdf_enjoyed_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }


        //Dropdown
        $this->data['leave_types'] = $this->Leave_model->get_leave_type();
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        // Load View
        $this->data['meta_title'] = 'ছুটির রিপোর্ট সমূহ';
        $this->data['subview'] = 'leave_reports';
        $this->load->view('backend/_layout_main', $this->data);
    }

}
