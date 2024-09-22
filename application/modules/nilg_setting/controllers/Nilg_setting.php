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

    // bank account
    public function bank_account($offset = 0)
    {
        $limit = 15;
        $results = $this->Nilg_setting_model->lists($limit, $offset, 'budget_bank_name');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/bank_account/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'অ্যাকাউন্ট এর তালিকা';
        $this->data['subview'] = 'bank_account/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function bank_account_create()
    {
        $this->form_validation->set_rules('name_bn', 'ব্যাংক নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'ব্যাংক নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('account_no', 'অ্যাকাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('address_bn', 'ব্যাংক ঠিকানা (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('address_en', 'ব্যাংক ঠিকানা (ইংরেজী)', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'account_no'  => $this->input->post('account_no'),
                'address_bn'  => $this->input->post('address_bn'),
                'address_en'  => $this->input->post('address_en'),
                'type'        => $this->input->post('type'),
            );
            if ($this->Common_model->save('budget_bank_name', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/bank_account');
            }
        }

        //Load view
        $this->data['meta_title'] = 'অ্যাকাউন্ট তৈরি করুন';
        $this->data['subview'] = 'bank_account/create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function bank_account_edit($encid=null){
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('name_bn', 'ব্যাংক নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'ব্যাংক নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('account_no', 'অ্যাকাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('address_bn', 'ব্যাংক ঠিকানা (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('address_en', 'ব্যাংক ঠিকানা (ইংরেজী)', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'account_no'  => $this->input->post('account_no'),
                'address_bn'  => $this->input->post('address_bn'),
                'address_en'  => $this->input->post('address_en'),
                'status'      => $this->input->post('status'),
                'type'        => $this->input->post('type'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('budget_bank_name', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন করা হয়েছে');
                redirect('nilg_setting/bank_account');
            }
        }
        $this->data['row'] = $this->db->select('q.*')->where('id', $id)->get('budget_bank_name as q')->row();
        //Load view
        $this->data['meta_title'] = 'অ্যাকাউন্ট টাইপ বিস্তারিত';
        $this->data['subview'] = 'bank_account/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    //  bank account
    // medical start
        public function medical($offset = 0)
    {
        $limit = 15;
        $results = $this->Nilg_setting_model->lists($limit, $offset, 'budget_medical');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/medical/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'চিকিৎসা ভাতা তালিকা';
        $this->data['subview'] = 'medical/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function medical_create()
    {
        $this->form_validation->set_rules('name_bn', 'ব্যাংক নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'ব্যাংক নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'amount'      => $this->input->post('amount'),
                'type'        => $this->input->post('type'),
            );
            if ($this->Common_model->save('budget_medical', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/medical');
            }
        }

        //Load view
        $this->data['meta_title'] = 'চিকিৎসা ভাতা';
        $this->data['subview'] = 'medical/create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function medical_edit($encid = null)
    {
        $this->form_validation->set_rules('name_bn', 'ব্যাংক নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'ব্যাংক নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $id = (int) decrypt_url($encid);
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'amount'      => $this->input->post('amount'),
                'type'        => $this->input->post('type'),
                'status'      => $this->input->post('status'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('budget_medical', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন করা হয়েছে');
                redirect('nilg_setting/medical');
            }
        }

        //Load view
        $this->data['row'] = $this->db->select('q.*')->where('id', $id)->get('budget_medical as q')->row();
        $this->data['meta_title'] = 'চিকিৎসা ভাতা';
        $this->data['subview'] = 'medical/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    // medical end

    // festival start
    public function festival($offset = 0)
    {
        $limit = 15;
        $results = $this->Nilg_setting_model->lists($limit, $offset, 'budget_festival');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/festival/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'উৎসব ভাতা তালিকা';
        $this->data['subview'] = 'festival/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function festival_create()
    {
        $this->form_validation->set_rules('name_bn', 'ব্যাংক নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'ব্যাংক নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'amount'      => $this->input->post('amount'),
                'type'        => $this->input->post('type'),
            );
            if ($this->Common_model->save('budget_festival', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/festival');
            }
        }

        //Load view
        $this->data['meta_title'] = 'উৎসব ভাতা';
        $this->data['subview'] = 'festival/create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function festival_edit($encid = null)
    {
        $this->form_validation->set_rules('name_bn', 'ব্যাংক নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('name_en', 'ব্যাংক নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $id = (int) decrypt_url($encid);
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'name_bn'     => $this->input->post('name_bn'),
                'name_en'     => $this->input->post('name_en'),
                'amount'      => $this->input->post('amount'),
                'type'        => $this->input->post('type'),
                'status'      => $this->input->post('status'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('budget_festival', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন করা হয়েছে');
                redirect('nilg_setting/festival');
            }
        }

        //Load view
        $this->data['row'] = $this->db->select('q.*')->where('id', $id)->get('budget_festival as q')->row();
        $this->data['meta_title'] = 'উৎসব ভাতা';
        $this->data['subview'] = 'festival/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    // festival end




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


    public function publication_group_setting()
    {
        $this->data['result'] = $this->db->get('budget_j_publication_group')->result_array();
        $this->data['meta_title'] = 'প্রকাশনা গ্রুপ সেটিংস';
        $this->data['subview'] = 'publication_group_setting/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_group_create()
    {
        $this->form_validation->set_rules('name_bn', 'প্রকাশনা গ্রুপ নাম (বাংলা)', 'trim|required');
        $this->form_validation->set_rules('name_en', 'প্রকাশনা গ্রুপ নাম (ইংরেজী)', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $form_data = array(
                'id' => null,
                'name_bn' => $this->input->post('name_bn'),
                'name_en' => $this->input->post('name_en'),
                'description' => $this->input->post('description'),
                'created_at' => date('Y-m-d H:i:s'),
                'create_by' => $this->data['userDetails']->id,
            );

            if ($this->db->insert('budget_j_publication_group', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/publication_group_setting');
            }
        } else {
            $this->data['result'] = $this->db->get('budget_j_publication_group')->result_array();
            $this->data['meta_title'] = 'প্রকাশনা গ্রুপ সেটিংস';
            $this->data['subview'] = 'publication_group_setting/index';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }
    public function publication_group_setting_update($id){
        // $id = $this->input->post('id');
        $this->form_validation->set_rules('name_bn', 'প্রকাশনা গ্রুপ নাম (বাংলা)', 'trim|required');
        $this->form_validation->set_rules('name_en', 'প্রকাশনা গ্রুপ নাম (ইংরেজী)', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $form_data = array(
                'name_bn' => $this->input->post('name_bn'),
                'name_en' => $this->input->post('name_en'),
                'description' => $this->input->post('description'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('budget_j_publication_group', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/publication_group_setting');
            }
        } else {
            $this->db->where('id', $id);
            $result= $this->db->get('budget_j_publication_group')->row();
            echo json_encode($result);
        }
    }

    public function publication_book_list()
    {
        $this->data['group'] = $this->db->get('budget_j_publication_group')->result();
        $this->db->select('budget_j_publication_book.*, budget_j_publication_group.name_bn as group_name');
        $this->db->from('budget_j_publication_book');
        $this->db->join('budget_j_publication_group', 'budget_j_publication_book.group_id = budget_j_publication_group.id', 'left');
        $this->data['result'] = $this->db->get()->result();
        $this->data['meta_title'] = 'প্রকাশনা বই সেটিংস';
        $this->data['subview'] = 'publication_book_add/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_book_add()
    {
        $this->data['group'] = $this->db->get('budget_j_publication_group')->result();
        $this->form_validation->set_rules('name_bn', 'প্রকাশনা গ্রুপ নাম (বাংলা)', 'trim|required');
        $this->form_validation->set_rules('name_en', 'প্রকাশনা গ্রুপ নাম (ইংরেজী)', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $form_data = array(
                'name_bn' => $this->input->post('name_bn'),
                'name_en' => $this->input->post('name_en'),
                'isbn_number' => $this->input->post('isbn_number'),
                'prokash_kal' => $this->input->post('prokash_kal'),
                'group_id' => $this->input->post('group_id'),
                'price' => $this->input->post('price'),
                'status' => 1,
                'description' => $this->input->post('description'),
                'create_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($this->db->insert('budget_j_publication_book', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/publication_book_list');
            }
        } else {
            $this->db->select('budget_j_publication_book.*, budget_j_publication_group.name_bn as group_name');
            $this->db->from('budget_j_publication_book');
            $this->db->join('budget_j_publication_group', 'budget_j_publication_book.group_id = budget_j_publication_group.id', 'left');
            $this->data['result'] = $this->db->get()->result();
            $this->data['meta_title'] = 'প্রকাশনা বই সেটিংস';
            $this->data['subview'] = 'publication_book_add/index';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }
    public function publication_book_delete($id){
        $this->db->where('book_id', $id);
        $p_data=$this->db->get('budget_j_publication_register_details')->result();
        if(!empty($p_data)){
            $this->session->set_flashdata('error', 'দুঃখিত! এই প্রকাশনা ব্যবহার করা হয়েছে');
            redirect('nilg_setting/publication_book_list');
        }else{
            $this->db->where('id', $id);
            $this->db->delete('budget_j_publication_book');
            $this->session->set_flashdata('success', 'প্রকাশনা গ্রুপ মুছে ফেলা হয়েছে');
            redirect('nilg_setting/publication_book_list');
        }
    }
    public function hostel_room_list()
    {
        $this->data['result'] = $this->db->get('budget_j_hostel_room')->result_array();
        $this->data['meta_title'] = 'কক্ষ  সেটিংস';
        $this->data['subview'] = 'hostel_room_list/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function hostel_room_create()
    {
        $this->form_validation->set_rules('name', 'কক্ষ  নাম (বাংলা)', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $form_data = array(
                'id' => null,
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'status' => 1,
            );

            if ($this->db->insert('budget_j_hostel_room', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/hostel_room_list');
            }
        } else {
            $this->data['result'] = $this->db->get('budget_j_hostel_room')->result_array();
            $this->data['meta_title'] = 'কক্ষ  সেটিংস';
            $this->data['subview'] = 'hostel_room_list/index';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }
    public function hostel_room_list_update($id){
        // $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'কক্ষ  নাম (বাংলা)', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $form_data = array(
               'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'status' => 1,
            );
            $this->db->where('id', $id);
            if ($this->db->update('budget_j_hostel_room', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/hostel_room_list');
            }
        } else {
            $this->db->where('id', $id);
            $result= $this->db->get('budget_j_hostel_room')->row();
            echo json_encode($result);
        }
    }



    public function hostel_seat_list()
    {
        $this->data['room'] = $this->db->get('budget_j_hostel_room')->result();
        $this->db->select('budget_j_hostel_seat.*, budget_j_hostel_room.name as room_name');
        $this->db->from('budget_j_hostel_seat');
        $this->db->join('budget_j_hostel_room', 'budget_j_hostel_seat.room_id = budget_j_hostel_room.id', 'left');
        $this->data['result'] = $this->db->get()->result();
        $this->data['meta_title'] = 'হোস্টেল  সিট সেটিংস';
        $this->data['subview'] = 'hostel_seat_list/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function hostel_seat_add()
    {
        $this->data['room'] = $this->db->get('budget_j_hostel_room')->result();
        $this->form_validation->set_rules('name', 'সিট নাম (বাংলা)', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            // id	name	room_id	amount	status 1=active, 2=inactive

            $form_data = array(
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'room_id' => $this->input->post('room_id'),
                'status' => 1,
            );
            if ($this->db->insert('budget_j_hostel_seat', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/hostel_seat_list');
            }
        } else {
            $this->data['room'] = $this->db->get('budget_j_hostel_room')->result();
            $this->db->select('budget_j_hostel_seat.*, budget_j_hostel_room.name as room_name');
            $this->db->from('budget_j_hostel_seat');
            $this->db->join('budget_j_hostel_room', 'budget_j_hostel_seat.room_id = budget_j_hostel_room.id', 'left');
            $this->data['result'] = $this->db->get()->result();
            $this->data['meta_title'] = 'হোস্টেল  সিট সেটিংস';
            $this->data['subview'] = 'hostel_seat_list/index';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }
    public function hostel_seat_delete($id){
        // $this->db->where('seat_id', $id);
        // $p_data=$this->db->get('budget_j_hostel_register_details')->result();
        // if(!empty($p_data)){
        //     $this->session->set_flashdata('error', 'দুঃখিত! এই হোস্টেল  ব্যবহার করা হয়েছে');
        //     redirect('nilg_setting/hostel_seat_list');
        // }else{
            $this->db->where('id', $id);
            $this->db->delete('budget_j_hostel_seat');
            $this->session->set_flashdata('success', 'কক্ষ  মুছে ফেলা হয়েছে');
            redirect('nilg_setting/hostel_seat_list');
        //}
    }




}
