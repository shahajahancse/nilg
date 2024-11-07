<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Office_profile extends Backend_Controller {

    // var $img_path;

    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = lang('office_profile');
        $this->load->model('Common_model');
        $this->load->model('Office_profile_model');
        $this->userSessionID = $this->session->userdata('user_id');
        // $this->load->model('personal_datas/Personal_datas_model');
        // $this->img_path = realpath(APPPATH . '../profile_img');
    }

    public function index(){
        // dd($this->userSessionID);
        $this->data['info'] = $this->Office_profile_model->get_info($this->userSessionID);
        dd($this->data['info']);
        // echo $this->db->last_query();
        // echo '<pre>';
        // print_r($this->data['info']); exit;

        //Load page
        $this->data['meta_title'] = 'অফিসের বিস্তারিত তথ্য';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // change password
    public function change_password(){
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false){
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id'   => 'old',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Old Password',
            );
            $this->data['new_password'] = array(
                'name'    => 'new',
                'id'      => 'new',
                'type'    => 'password',
                'class' => 'form-control',
                'placeholder' => 'New password',
                'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name'    => 'new_confirm',
                'id'      => 'new_confirm',
                'type'    => 'password',
                'class' => 'form-control',
                'placeholder' => 'New confirm password',
                'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
            );
            $this->data['user_id'] = array(
                'name'  => 'user_id',
                'id'    => 'user_id',
                'type'  => 'hidden',
                'value' => $user->id,
            );

            //Load page
            $this->data['meta_title'] = 'পাসোর্য়াড পরিবর্তন';
            $this->data['subview'] = 'change_password';
            $this->load->view('backend/_layout_main', $this->data);

        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change){
                //if the password was successfully changed
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                // $this->logout();
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('success', $this->ion_auth->errors());
                redirect('office_profile/change_password');
            }
        }
    }


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
