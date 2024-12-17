<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_head extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'বাজেট হেড';
        $this->load->model('Common_model');
        $this->load->model('Budget_head_model');
    }

    public function training($offset=0){
        // Manage list the users
        $limit = 50;

        $results = $this->Budget_head_model->get_data_training($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/training_head/training/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['course'] = $this->Common_model->get_course();

        //Load page
        $this->data['meta_title'] = 'বাজেট হেড';
        $this->data['subview'] = 'budget_head/training';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_add(){
        // Validation
        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $query = $this->db->order_by('id', 'DESC')->get('budget_head_training')->row();
            if (empty($query)) {
                $bd_code = 101;
            } else {
                $bd_code = $query->bd_code + 1;
            }

            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'bd_code'    => $bd_code,
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->save('budget_head_training', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট হেড সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/training_head/training');
            }
        }
        $this->data['meta_title'] = 'বাজেট হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_head/training_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_edit($id){
        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->edit('budget_head_training', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট হেড সংশোধন করা হয়েছে');
                redirect('nilg_setting/training_head/training');
            }
        }

        $this->data['info'] = $this->db->where('id', $id)->get('budget_head_training')->row();

        $this->data['meta_title'] = 'বাজেট হেড সংশোধন করুন';
        $this->data['subview'] = 'budget_head/training_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

}
