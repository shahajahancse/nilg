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


    public function index($offset=0){ 

        $this->load->model('Common_model');
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];  
        // Manage list the users
        $limit = 50;
        
        if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Leave_model->get_data($limit, $offset, 2);
        } elseif (func_nilg_auth($userDetails->office_type) == 'employee') { 
            $results = $this->Leave_model->get_data($limit, $offset, null, $userDetails->id);
        }

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        // Dropdown List
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['info'] = $this->Leave_model->get_info('users',$this->session->userdata('user_id'));

        //Load page
        if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
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

    public function add(){
        $this->load->model('Common_model');
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails']; 
        // Validation
        $this->form_validation->set_rules('user_id', 'স্টাফ নাম', 'required|trim');
        $this->form_validation->set_rules('leave_type', 'ছুটির টাইপ', 'required|trim');
        $this->form_validation->set_rules('from_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('to_date', 'শেষ তারিখ', 'required|trim');
        // echo '<pre>';
        // print_r($_POST); exit;
        // Insert Data
        $uploadedFile = null;
        if ($this->form_validation->run() == true){
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

            $total_days = $this->Leave_model->GetDays($this->input->post('from_date'), $this->input->post('to_date'));

            $form_data = array( 
                'user_id'      => $this->input->post('user_id'),
                'leave_type'   => $this->input->post('leave_type'),
                'from_date'    => $this->input->post('from_date'),
                'to_date'      => $this->input->post('to_date'),
                'leave_days'   => count($total_days),
                'reason'       => $this->input->post('reason'),
                'status'       => 1,
                'file_name'    => $uploadedFile, 
                'created_date' => "Y-m-d", 
            );
            if($this->Common_model->save('employee_leave', $form_data)){
                $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা হয়েছে.');
                redirect('leave');
            } else {
                $this->session->set_flashdata('success', 'ছুটিটি সংরক্ষণ করা সম্ভব হচ্ছে না।.');
                redirect('leave/add');
            }
        }

        $this->data['users'] = $this->Leave_model->get_user('users');
        $this->data['leave_type'] = $this->Leave_model->get_leave_type();
        $this->data['info'] = $this->Leave_model->get_info('users',$this->session->userdata('user_id'));
        
        // View
        $this->data['meta_title'] = 'ছুটি যুক্ত করুন';
        if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $this->data['users'] = $this->Common_model->get_nilg_employee();
            $this->data['subview'] = 'add';
        } elseif (func_nilg_auth($userDetails->office_type) == 'employee') { 
            $results = $this->Leave_model->get_yearly_leave_count($userDetails->id);
            $this->data['total_leave'] = $results['total_leave'];
            $this->data['used_leave'] = $results['used_leave'];
            $this->data['subview'] = 'staff_add'; 
        }
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){

        $id = (int) decrypt_url($id);

        // Check Exists
        if (!$this->Common_model->exists('employee_leave', 'id', $id)) {
            redirect('dashboard');
        }
        // Validation
        $this->form_validation->set_rules('user_id', 'স্টাফ নাম', 'required|trim');
        $this->form_validation->set_rules('leave_type', 'ছুটির টাইপ', 'required|trim');
        $this->form_validation->set_rules('from_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('to_date', 'শেষ তারিখ', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            // dd($this->input->post('is_right'));

            $form_data = array( 
                'user_id'     => $this->input->post('user_id'),
                'leave_type'  => $this->input->post('leave_type'),
                'from_date'   => $this->input->post('from_date'),
                'to_date'     => $this->input->post('to_date'),
                'leave_days'  => count($total_days),
                'reason'      => $this->input->post('reason'),
            );               
            // dd($form_data); exit;
            
            if($this->Common_model->edit('employee_leave', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'সফলভাবে সংশোধন করা হয়েছে');
                redirect('leave');
            }
        }


        // Dropdown List        
        $this->data['row'] = $this->Leave_model->get_info('employee_leave', $id);
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['leave_type'] = $this->Leave_model->get_leave_type();
        $results = $this->Leave_model->get_yearly_leave_count($this->data['row']->user_id);
        $this->data['total_leave'] = $results['total_leave'];
        $this->data['used_leave'] = $results['used_leave'];

        // View
        $this->data['meta_title'] = 'সম্পাদনা করুন';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function change_status($id, $status = null){

        $id = (int) decrypt_url($id);
        // Check Exists
        if (!$this->Common_model->exists('employee_leave', 'id', $id)) {
            redirect('dashboard');
        }

        if (isset($_POST['submit']) && trim($_POST['submit']) == "সংরক্ষণ করুন") {
            if ($_POST['status'] == 2) {
                $message = 'সফলভাবে অনুমোদন করা হয়েছে ।';
            } elseif ($_POST['status'] == 3) {
                $message = 'সফলভাবে প্রত্যাখ্যাত করা হয়েছে ।';
            }
            $form_data = array( 
                'status'  => $_POST['status'],
            );               
            // dd($form_data); exit;
        
            if($this->Common_model->edit('employee_leave', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', $message);
                redirect('leave');
            }
        }

        // Dropdown List        
        $this->data['row'] = $this->Leave_model->get_info('employee_leave', $id);
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



    public function delete($dataID){
        $dataID = (int) decrypt_url($dataID);
        // Check Exists
        if (!$this->Common_model->exists('employee_leave', 'id', $dataID)) {
            redirect('dashboard');
        }
        if ($this->db->delete('employee_leave', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।'); 
            redirect('leave');
        }
    }

    public function pending_list($offset=0)
    {      
        // Manage list the users
        $limit = 50;
        
        $results = $this->Leave_model->get_data($limit, $offset, 1);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['info'] = $this->Leave_model->get_info('users',$this->session->userdata('user_id'));

        //Load page
        $this->data['subview'] = 'pending_list'; 
        $this->data['meta_title'] = 'অপেক্ষমাণ ছুটির তালিকা';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function rejected_list($offset=0)
    {      
        // Manage list the users
        $limit = 50;
        
        $results = $this->Leave_model->get_data($limit, $offset, 3);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('leave/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        $this->data['info'] = $this->Leave_model->get_info('users',$this->session->userdata('user_id'));

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

        if( $btn_submit == 'current_leave') {
            
            // Results
            $report_date  = date('Y-m-d');
            $this->data['results'] = $this->Leave_model->get_current_report(2, $report_date, $type);

            // Generate PDF
            $this->data['headding'] = 'ছুটির রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else if( $btn_submit == 'done_leave') {

            // Results
            $this->data['results'] = $this->Leave_model->get_report(2, $date_from, $date_to, $type);

            // Generate PDF
            $this->data['headding'] = ' সম্পন্ন ছুটির রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else if( $btn_submit == 'pending_leave') {

            // Results
            $this->data['results'] = $this->Leave_model->get_report(1, $date_from, $date_to, $type);

            // Generate PDF
            $this->data['headding'] = ' অপেক্ষমাণ ছুটি রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else if( $btn_submit == 'reject_leave') {

            // Results
            $this->data['results'] = $this->Leave_model->get_report(3, $date_from, $date_to, $type);

            // Generate PDF
            $this->data['headding'] = 'প্রত্যাখ্যাত ছুটি রিপোর্ট';
            $html = $this->load->view('pdf_leave_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }


        //Dropdown
        $this->data['users'] = $this->Leave_model->get_leave_type();
        // Load View 
        $this->data['meta_title'] = 'ছুটির রিপোর্ট সমূহ';
        $this->data['subview'] = 'leave_reports';
        $this->load->view('backend/_layout_main', $this->data);
    }   

}