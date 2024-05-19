<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilg_setting extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('Nilg_setting_model');

        $this->data['module_name'] = 'এনআইএলজি সেটিংস';
    }

    public function index(){
        redirect('general_setting/upazila_thana');
    }

    public function session_year($offset = 0)
    {
        $limit = 15;
        $results = $this->Nilg_setting_model->lists($limit, $offset, 'session_year');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/session_year/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'অর্থ বছর এর তালিকা';
        $this->data['subview'] = 'fcl_year/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function fcl_create()
    {
        $this->form_validation->set_rules('session_name', 'অর্থ বছর', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'session_name' => $this->input->post('session_name'),
                'status' => $this->input->post('status'),
            );
            if ($this->Common_model->save('session_year', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/session_year');
            }
        }

        //Load view
        $this->data['meta_title'] = 'অর্থ বছর তৈরি করুন';
        $this->data['subview'] = 'fcl_year/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function fcl_edit($encid=null){
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('session_name', 'অর্থ বছর', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'session_name' => $this->input->post('session_name'),
                'status' => $this->input->post('status'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('session_year', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন করা হয়েছে');
                redirect('nilg_setting/session_year');
            }
        }
        $this->data['row'] = $this->db->select('q.*')->where('id', $id)->get('session_year as q')->row();
        //Load view
        $this->data['meta_title'] = 'অর্থ বছর বিস্তারিত';
        $this->data['subview'] = 'fcl_year/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function account_types($offset = 0)
    {
        $limit = 15;
        $results = $this->Nilg_setting_model->lists($limit, $offset, 'budget_accounts_type');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/account_types/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'অ্যাকাউন্ট টাইপ এর তালিকা';
        $this->data['subview'] = 'account_type/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function account_type_create()
    {
        $this->form_validation->set_rules('name_bn', 'নাম টাইপ (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'নাম টাইপ (ইংরেজী)', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'description' => $this->input->post('description'),
                'status'      => $this->input->post('status'),
            );
            if ($this->Common_model->save('budget_accounts_type', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/account_types');
            }
        }

        //Load view
        $this->data['meta_title'] = 'অ্যাকাউন্ট টাইপ তৈরি করুন';
        $this->data['subview'] = 'account_type/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function account_type_edit($encid=null){
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('name_bn', 'নাম টাইপ (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'নাম টাইপ (ইংরেজী)', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'description' => $this->input->post('description'),
                'status'      => $this->input->post('status'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('budget_accounts_type', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন করা হয়েছে');
                redirect('nilg_setting/account_types');
            }
        }
        $this->data['row'] = $this->db->select('q.*')->where('id', $id)->get('budget_accounts_type as q')->row();
        //Load view
        $this->data['meta_title'] = 'অ্যাকাউন্ট টাইপ বিস্তারিত';
        $this->data['subview'] = 'account_type/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function chahida_potro_approval(){
        
        $this->data['row'] = $this->db->get('budget_chahida_potro_settings')->row();
        $this->data['meta_title'] = 'চাহিদা পত্র অনুমোদন সেটিংস';
        $this->data['subview'] = 'budget_chahida_potro_settings';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_chahida_potro_settings_update(){
        $form_data = array(
            'acc_app' => $this->input->post('acc_app')?'1':'0',
            'join_director_app' => $this->input->post('join_director_app')?'1':'0',
            'director_app' => $this->input->post('director_app')?'1':'0',
        );
        $this->db->where('id', 1);
        if ($this->db->update('budget_chahida_potro_settings', $form_data)) {
            $this->session->set_flashdata('success', 'তথ্য সংশোধন করা হয়েছে');
            redirect('nilg_setting/chahida_potro_approval');
        }
    }

}
