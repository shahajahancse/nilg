<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Trainer extends Backend_Controller
{
    var $userID;

    function __construct(){
        parent::__construct();
        $this->data['module_title'] = 'প্রশিক্ষক';

        if (!$this->ion_auth->logged_in()) :
            redirect('login');
        endif;

        $this->userID = $this->session->userdata('user_id');
        $this->load->model('Trainer_model');
        $this->load->model('Common_model');
        // $this->load->model('general_setting/General_setting_model');
        // $this->load->model('exam_names/Exam_names_model');
    }

    public function index(){
        redirect('trainer/request');
    }

    public function all($offset = 0)
    {
        $limit = 25;
        // echo 'hello'; exit;
        $results = $this->Trainer_model->get_all($limit, $offset);
        // count($this->data['results']);     

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainer/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        $this->data['data_type'] = $this->Common_model->get_data_type();
        $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'প্রশিক্ষকের তালিকা';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function all_email($offset = 0)
    {
        $limit = 25;
        // echo 'hello'; exit;
        $results = $this->Trainer_model->get_all($limit, $offset);
        // count($this->data['results']);     

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainer/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        $this->data['data_type'] = $this->Common_model->get_data_type();
        $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'প্রশিক্ষকের তালিকা';
        $this->data['subview'] = 'all_email';
        $this->load->view('backend/_layout_main', $this->data);
    }

    
    public function add_trainer()
    {
        // Ion Auth Config
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // Default Value
        $empType = NULL;

        // Parsonal Data Validation
        $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
        $this->form_validation->set_rules('name_en', 'name bangla', 'required|trim');
        if($identity_column !== 'email'){
            $this->form_validation->set_rules('nid', 'NID','required|trim|integer|min_length[10]|max_length[17]|is_unique['.$tables['users'].'.'.$identity_column.']');
        }        
        $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim|integer|min_length[11]|max_length[11]');
        // $this->form_validation->set_rules('email', 'email', 'trim|valid_email|callback_email_unique');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
        // $this->form_validation->set_rules('password_confirm', 'password confirm', 'required|trim');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('office_name', 'office_name', 'required');

        // Validate and Insert to DB
        if ($this->form_validation->run() == true){
            $email    = strtolower($this->input->post('email'));
            $nid = ($identity_column==='email') ? $email : $this->input->post('nid');
            $password = $this->input->post('password');

            $additional_data = array(                
                'is_applied'        => 0,
                'name_bn'           => $this->input->post('name_bn'),                
                'name_en'           => strtoupper($this->input->post('name_en')),
                'nid'               => $this->input->post('nid'),
                'dob'               => date_db_format($this->input->post('dob')),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),
                'office_name'       => $this->input->post('office_name'),
                'designation'       => $this->input->post('designation'),
                'height_education'  => $this->input->post('height_education'),
                'interested_subjects'=> $this->input->post('interested_subjects'),
                'present_add'       => $this->input->post('present_add'),
                'created'           => date('Y-m-d')
                );            
            // dd($additional_data);     

            // Insert to DB
            $user_group = array('11'); // Guest User
            if ($this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){
                redirect("trainer/all");    
            }
        }

        // View
        $this->data['meta_title'] = 'প্রশিক্ষক এন্ট্রি করুন';
        $this->data['subview'] = 'add_trainer';
        $this->load->view('backend/_layout_main', $this->data);
    }
    

    public function request($offset = 0)
    {
        $limit = 25;

        $results = $this->Trainer_model->get_application_request($limit, $offset);

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('trainer/request/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Dropdown
        // $this->data['data_type'] = $this->Common_model->get_data_type();
        // $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        // View
        $this->data['meta_title'] = 'প্রশিক্ষক আবেদনের তালিকা';
        $this->data['subview'] = 'request';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function request_verification($id){
        $id = (int) decrypt_url($id);
                // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainee - request_verification', TRUE);
        }

        // Validation
        $this->form_validation->set_rules('verify_status', 'select verify status ', 'required|trim');

        // Validate and Input Data
        if ($this->form_validation->run() == true){

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
                    $this->ion_auth->add_to_group('11', $id);
                    // Success Message
                    $this->session->set_flashdata('success', 'আবেদনকারীকে ডাটাবেজে অন্তর্ভুক্ত করা হয়েছে');
                }else{
                    $this->session->set_flashdata('success', 'আবেদনটি বাতিল করা হয়েছে');
                }

                // Redirect
                redirect('trainer/all');

            }
        }

        // Get Information
        $this->data['info'] = $this->Trainer_model->get_user_info($id);
        $this->data['verify_status'] = $this->Common_model->set_verification_status();
        $this->data['status'] = $this->Common_model->get_data_status();
        
        // Load view
        $this->data['meta_title'] = 'প্রশিক্ষকের তথ্য যাচাই';
        $this->data['subview'] = 'request_verification';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /*public function request_verification($id){
        $id = (int) decrypt_url($id);

        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainee - request_verification - exists', TRUE);
        }        

        $this->data['info'] = $this->Trainer_model->get_user_info($id);
        // print_r($this->data['info']); exit;
        $this->data['verify_status'] = $this->Common_model->set_verification_status();
        // $this->data['participant_type'] = $this->Common_model->set_event_participant_type();

        //Load view
        $this->data['meta_title'] = 'প্রশিক্ষণার্থর তথ্য যাচাই';
        $this->data['subview'] = 'request_verification';
        $this->load->view('backend/_layout_main', $this->data);
    } */


    public function accept($id){
        $id = (int) decrypt_url($id);

        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainer - accept - exists', TRUE);
        }

        $form_data = array(
            'is_applied'    => 0,
            'is_verify'     => 1
            );            
        // print_r($id);exit();

        if($this->Common_model->edit('users', $id, 'id', $form_data)){
            // Change user group 'guest' to 'trainee'
            $this->ion_auth->remove_from_group('', $id);
            $this->ion_auth->add_to_group('11', $id);
            $message = 'আবেদনটি যাচাই করে প্রশিক্ষক হিসাবে নিবন্ধন করা হয়েছে';
            
            // echo $this->db->last_query(); exit;
            $this->session->set_flashdata('success', $message);
            redirect("trainer/all");
        }

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
                    $this->ion_auth->add_to_group('11', $id);
                    $message = 'আবেদনটি যাচাই করে প্রশিক্ষণার্থী হিসাবে নিবন্ধন করা হয়েছে';
                }elseif($this->input->post('verify_status') == 2){
                    $message = 'আবেদনটি বাতিল করা হয়েছে';
                }

                // echo $this->db->last_query(); exit;
                $this->session->set_flashdata('success', $message);
                redirect("trainer/all");
            }
        }*/
    }


    public function decline($id){
        $id = (int) decrypt_url($id);

        // Check Exists
        if(!$this->Common_model->exists('users', 'id', $id)){
            show_404('Trainer - decline - exists', TRUE);
        }

        $form_data = array(
            'is_applied'    => 0
            );            
        // print_r($id);exit();

        if($this->Common_model->edit('users', $id, 'id', $form_data)){            
            $message = 'আবেদনটি বাতিল করা হয়েছে';
            
            $this->session->set_flashdata('success', $message);
            redirect("trainer/all");
        }
    }


    public function details($id){
        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('users', 'id', $dataID)) {
            show_404('Trainee - details - exists', TRUE);
        }

        // Get all information
        $this->data['info'] = $this->Trainer_model->get_user_info($dataID);
        // dd($this->data['info']);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষকের বিস্তারিত তথ্য';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*public function delete()
    {
        // Trainer_model = $this->this_model();
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
    }

    function ajax_get_district_by_div($id)
    {
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Trainer_model->get_district_by_div_id($id)));
    }

    function ajax_get_upa_tha_by_dis($dis_id)
    {
        // echo $dis_id; exit;
        header('Content-Type: application/x-json; charset=utf-8');
        // print_r($this->Trainer_model->get_upa_tha_by_dis_id($dis_id));

        echo (json_encode($this->Trainer_model->get_upa_tha_by_dis_id($dis_id)));
    }

    function ajax_get_organization_by_up_th_id($id)
    {
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Trainer_model->get_organization_by_up_th_id($id)));
    }

    function ajax_experiance_del($id)
    {
        $this->Common_model->delete('per_experience', 'id', $id);
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
    }*/

    
}
