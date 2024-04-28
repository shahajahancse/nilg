<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journal_entry extends Backend_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('Journal_entry_model');
        $this->data['module_name'] = 'জার্নাল এন্ট্রি';
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        // $this->data['module_title'] = 'Inventory';
    }


    // start revenew

    public function revenue_entry($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_gov_revenue_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'রাজস্ব এর তালিকা';
        $this->data['subview'] = 'revenue/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function revenue_entry_create()
    {
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
            $form_data = array(
                'voucher_no' => $this->input->post('voucher_no'),
                'amount' => $this->input->post('amount'),
                'type' => 1,
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => $this->input->post('issue_date'),
                'create_by' => $user->id,
            );
            if ($this->Common_model->save('budget_j_gov_revenue_register', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/revenue_entry');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'রাজস্ব তৈরি করুন';
        $this->data['subview'] = 'revenue/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function revenue_entry_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_gov_revenue_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['budget_j_gov_revenue_register'] = $this->db->get()->row();
         //Dropdown
         $this->data['info'] = $this->Common_model->get_user_details();
         //Load view
         $this->data['meta_title'] = 'রাজস্ব বিস্তারিত';
         $this->data['subview'] = 'revenue/details';
         $this->load->view('backend/_layout_main', $this->data);
    }
    public function revenue_entry_edit($encid=null){
        if ($encid==null) {
            $id = $this->input->post('id');
        }else{
            $id = (int) decrypt_url($encid);
        }
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
            $form_data = array(
                'amount' => $this->input->post('amount'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => $this->input->post('issue_date'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('budget_j_gov_revenue_register', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                redirect('journal_entry/revenue_entry');
            }
        }
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_gov_revenue_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['budget_j_gov_revenue_register'] = $this->db->get()->row();
         //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'রাজস্ব বিস্তারিত';
        $this->data['subview'] = 'revenue/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function revenue_entry_delete($encid){
        $id = (int) decrypt_url($encid);
        $this->db->where('id', $id);
        if ($this->db->delete('budget_j_gov_revenue_register')) {
            $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
            redirect('journal_entry/revenue_entry');
        }else{
            $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
            redirect('journal_entry/revenue_entry');
        }
    }
    // end revenew
    // start cheque

    public function cheque_entry($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_cheque_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'চেক এর তালিকা';
        $this->data['subview'] = 'cheque/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function cheque_entry_create()
    {
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();

            $form_data = array(
                'cheque_no' => $this->input->post('cheque_no'),
                'amount' => $this->input->post('amount'),
                'type' => 1,
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => $this->input->post('issue_date'),
                'create_by' => $user->id,
            );
            if ($this->Common_model->save('budget_j_cheque_register', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/cheque_entry');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'চেক তৈরি করুন';
        $this->data['subview'] = 'cheque/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function cheque_entry_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_cheque_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['budget_j_cheque_register'] = $this->db->get()->row();
         //Dropdown
         $this->data['info'] = $this->Common_model->get_user_details();
         //Load view
         $this->data['meta_title'] = 'চেক বিস্তারিত';
         $this->data['subview'] = 'cheque/details';
         $this->load->view('backend/_layout_main', $this->data);
    }
    public function cheque_entry_edit($encid=null){
        if ($encid==null) {
            $id = $this->input->post('id');
        }else{
            $id = (int) decrypt_url($encid);
        }
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
            $form_data = array(
                'amount' => $this->input->post('amount'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => $this->input->post('issue_date'),
            );
           $this->db->where('id', $id);
            if ($this->db->update('budget_j_cheque_register', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                redirect('journal_entry/cheque_entry');
            }
        }
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_cheque_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['budget_j_cheque_register'] = $this->db->get()->row();
         //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'চেক বিস্তারিত';
        $this->data['subview'] = 'cheque/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function cheque_entry_delete($encid){
        $id = (int) decrypt_url($encid);
        $this->db->where('id', $id);
        if ($this->db->delete('budget_j_cheque_register')) {
            $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
            redirect('journal_entry/cheque_entry');
        }else{
            $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
            redirect('journal_entry/cheque_entry');
        }
    }
    // end cheque
       // start hostel
       public function hostel_entry($offset = 0)
       {
           $limit = 15;
           $user_id = $this->data['userDetails']->id;
           $dept_id = $this->data['userDetails']->crrnt_dept_id;
           $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_hostel_register');
           $this->data['results'] = $results['rows'];
           $this->data['total_rows'] = $results['num_rows'];
           //pagination
           $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
           // Load view
           $this->data['meta_title'] = 'হোস্টেল এর তালিকা';
           $this->data['subview'] = 'hostel/index';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function hostel_entry_create()
       {
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               $user = $this->ion_auth->user()->row();
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'voucher_no' => $this->input->post('voucher_no'),
                   'amount' => $this->input->post('amount'),
                   'type' => 1,
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'date' => $this->input->post('issue_date'),
                   'create_by' => $user->id,
               );
               if ($this->Common_model->save('budget_j_hostel_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                   redirect('journal_entry/hostel_entry');
               }
           }
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'হোস্টেল তৈরি করুন';
           $this->data['subview'] = 'hostel/entry';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function hostel_entry_details($encid){
           $id = (int) decrypt_url($encid);
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_hostel_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_hostel_register'] = $this->db->get()->row();
            //Dropdown
            $this->data['info'] = $this->Common_model->get_user_details();
            //Load view
            $this->data['meta_title'] = 'হোস্টেল বিস্তারিত';
            $this->data['subview'] = 'hostel/details';
            $this->load->view('backend/_layout_main', $this->data);
       }
       public function hostel_entry_edit($encid=null){
           if ($encid==null) {
               $id = $this->input->post('id');
           }else{
               $id = (int) decrypt_url($encid);
           }
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'amount' => $this->input->post('amount'),
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'date' => $this->input->post('issue_date'),
               );
              $this->db->where('id', $id);
               if ($this->db->update('budget_j_hostel_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                   redirect('journal_entry/hostel_entry');
               }
           }
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_hostel_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_hostel_register'] = $this->db->get()->row();
            //Dropdown
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'হোস্টেল বিস্তারিত';
           $this->data['subview'] = 'hostel/edit';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function hostel_entry_delete($encid){
           $id = (int) decrypt_url($encid);
           $this->db->where('id', $id);
           if ($this->db->delete('budget_j_hostel_register')) {
               $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
               redirect('journal_entry/hostel_entry');
           }else{
               $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
               redirect('journal_entry/hostel_entry');
           }
       }
       // end hostel
       // start budget_j_publication_register
       public function publication_entry($offset = 0)
       {
           $limit = 15;
           $user_id = $this->data['userDetails']->id;
           $dept_id = $this->data['userDetails']->crrnt_dept_id;
           $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_publication_register');
           $this->data['results'] = $results['rows'];
           $this->data['total_rows'] = $results['num_rows'];
           //pagination
           $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
           // Load view
           $this->data['meta_title'] = 'পাবলিকেশন এর তালিকা';
           $this->data['subview'] = 'publication/index';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function publication_entry_create()
       {
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               $user = $this->ion_auth->user()->row();
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'voucher_no' => $this->input->post('voucher_no'),
                   'amount' => $this->input->post('amount'),
                   'type' => 1,
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
                   'create_by' => $user->id,
               );
               if ($this->Common_model->save('budget_j_publication_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                   redirect('journal_entry/publication_entry');
               }
           }
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'পাবলিকেশন তৈরি করুন';
           $this->data['subview'] = 'publication/entry';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function publication_entry_details($encid){
           $id = (int) decrypt_url($encid);
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_publication_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_publication_register'] = $this->db->get()->row();
            //Dropdown
            $this->data['info'] = $this->Common_model->get_user_details();
            //Load view
            $this->data['meta_title'] = 'পাবলিকেশন বিস্তারিত';
            $this->data['subview'] = 'publication/details';
            $this->load->view('backend/_layout_main', $this->data);
       }
       public function publication_entry_edit($encid=null){
           if ($encid==null) {
               $id = $this->input->post('id');
           }else{
               $id = (int) decrypt_url($encid);
           }
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'amount' => $this->input->post('amount'),
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
               );
              $this->db->where('id', $id);
               if ($this->db->update('budget_j_publication_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                   redirect('journal_entry/publication_entry');
               }
           }
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_publication_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_publication_register'] = $this->db->get()->row();
            //Dropdown
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'পাবলিকেশন বিস্তারিত';
           $this->data['subview'] = 'publication/edit';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function publication_entry_delete($encid){
           $id = (int) decrypt_url($encid);
           $this->db->where('id', $id);
           if ($this->db->delete('budget_j_publication_register')) {
               $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
               redirect('journal_entry/publication_entry');
           }else{
               $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
               redirect('journal_entry/publication_entry');
           }
       }
       // end budget_j_publication_register
       // start budget_j_pension_register
       public function pension_entry($offset = 0)
       {
           $limit = 15;
           $user_id = $this->data['userDetails']->id;
           $dept_id = $this->data['userDetails']->crrnt_dept_id;
           $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_pension_register');
           $this->data['results'] = $results['rows'];
           $this->data['total_rows'] = $results['num_rows'];
           //pagination
           $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
           // Load view
           $this->data['meta_title'] = 'পেনশন  এর তালিকা';
           $this->data['subview'] = 'pension/index';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function pension_entry_create()
       {
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               $user = $this->ion_auth->user()->row();
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'voucher_no' => $this->input->post('voucher_no'),
                   'amount' => $this->input->post('amount'),
                   'type' => 1,
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
                   'create_by' => $user->id,
               );
               if ($this->Common_model->save('budget_j_pension_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                   redirect('journal_entry/pension_entry');
               }
           }
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'পেনশন  তৈরি করুন';
           $this->data['subview'] = 'pension/entry';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function pension_entry_details($encid){
           $id = (int) decrypt_url($encid);
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_pension_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_pension_register'] = $this->db->get()->row();
            //Dropdown
            $this->data['info'] = $this->Common_model->get_user_details();
            //Load view
            $this->data['meta_title'] = 'পেনশন  বিস্তারিত';
            $this->data['subview'] = 'pension/details';
            $this->load->view('backend/_layout_main', $this->data);
       }
       public function pension_entry_edit($encid=null){
           if ($encid==null) {
               $id = $this->input->post('id');
           }else{
               $id = (int) decrypt_url($encid);
           }
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'amount' => $this->input->post('amount'),
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
               );
              $this->db->where('id', $id);
               if ($this->db->update('budget_j_pension_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                   redirect('journal_entry/pension_entry');
               }
           }
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_pension_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_pension_register'] = $this->db->get()->row();
            //Dropdown
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'পেনশন  বিস্তারিত';
           $this->data['subview'] = 'pension/edit';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function pension_entry_delete($encid){
           $id = (int) decrypt_url($encid);
           $this->db->where('id', $id);
           if ($this->db->delete('budget_j_pension_register')) {
               $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
               redirect('journal_entry/pension_entry');
           }else{
               $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
               redirect('journal_entry/pension_entry');
           }
       }
       // end budget_j_pension_register
       // start budget_j_gpf_register
       public function gpf_entry($offset = 0)
       {
           $limit = 15;
           $user_id = $this->data['userDetails']->id;
           $dept_id = $this->data['userDetails']->crrnt_dept_id;
           $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_gpf_register');
           $this->data['results'] = $results['rows'];
           $this->data['total_rows'] = $results['num_rows'];
           //pagination
           $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
           // Load view
           $this->data['meta_title'] = 'জিপিএফ  এর তালিকা';
           $this->data['subview'] = 'gpf/index';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function gpf_entry_create()
       {
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               $user = $this->ion_auth->user()->row();
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'voucher_no' => $this->input->post('voucher_no'),
                   'amount' => $this->input->post('amount'),
                   'type' => 1,
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
                   'create_by' => $user->id,
               );
               if ($this->Common_model->save('budget_j_gpf_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                   redirect('journal_entry/gpf_entry');
               }
           }
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'জিপিএফ  তৈরি করুন';
           $this->data['subview'] = 'gpf/entry';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function gpf_entry_details($encid){
           $id = (int) decrypt_url($encid);
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_gpf_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_gpf_register'] = $this->db->get()->row();
            //Dropdown
            $this->data['info'] = $this->Common_model->get_user_details();
            //Load view
            $this->data['meta_title'] = 'জিপিএফ  বিস্তারিত';
            $this->data['subview'] = 'gpf/details';
            $this->load->view('backend/_layout_main', $this->data);
       }
       public function gpf_entry_edit($encid=null){
           if ($encid==null) {
               $id = $this->input->post('id');
           }else{
               $id = (int) decrypt_url($encid);
           }
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'amount' => $this->input->post('amount'),
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
               );
              $this->db->where('id', $id);
               if ($this->db->update('budget_j_gpf_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                   redirect('journal_entry/gpf_entry');
               }
           }
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_gpf_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_gpf_register'] = $this->db->get()->row();
            //Dropdown
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'জিপিএফ  বিস্তারিত';
           $this->data['subview'] = 'gpf/edit';
           $this->load->view('backend/_layout_main', $this->data);
       }
       public function gpf_entry_delete($encid){
           $id = (int) decrypt_url($encid);
           $this->db->where('id', $id);
           if ($this->db->delete('budget_j_gpf_register')) {
               $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
               redirect('journal_entry/gpf_entry');
           }else{
               $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
               redirect('journal_entry/gpf_entry');
           }
       }
       // end budget_j_gpf_register


       // start budget_j_miscellaneous_register
       public function miscellaneous_entry($offset = 0)
       {
           $limit = 15;
           $user_id = $this->data['userDetails']->id;
           $dept_id = $this->data['userDetails']->crrnt_dept_id;
           $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_miscellaneous_register');
           $this->data['results'] = $results['rows'];
           $this->data['total_rows'] = $results['num_rows'];
           //pagination
           $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
           // Load view
           $this->data['meta_title'] = 'বিবিধ  এর তালিকা';
           $this->data['subview'] = 'miscellaneous/index';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function miscellaneous_entry_create()
       {
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               $user = $this->ion_auth->user()->row();
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'voucher_no' => $this->input->post('voucher_no'),
                   'amount' => $this->input->post('amount'),
                   'type' => 1,
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
                   'create_by' => $user->id,
               );
               if ($this->Common_model->save('budget_j_miscellaneous_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                   redirect('journal_entry/miscellaneous_entry');
               }
           }
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'বিবিধ  তৈরি করুন';
           $this->data['subview'] = 'miscellaneous/entry';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function miscellaneous_entry_details($encid)
       {
           $id = (int) decrypt_url($encid);
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_miscellaneous_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_miscellaneous_register'] = $this->db->get()->row();
            //Dropdown
            $this->data['info'] = $this->Common_model->get_user_details();
            //Load view
            $this->data['meta_title'] = 'বিবিধ  বিস্তারিত';
            $this->data['subview'] = 'miscellaneous/details';
            $this->load->view('backend/_layout_main', $this->data);
       }
       public function miscellaneous_entry_edit($encid=null)
       {
           if ($encid==null) {
               $id = $this->input->post('id');
           }else{
               $id = (int) decrypt_url($encid);
           }
           $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
           $user = $this->ion_auth->user()->row();
           if ($this->form_validation->run() == true) {
               // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
               $form_data = array(
                   'amount' => $this->input->post('amount'),
                   'reference' => $this->input->post('reference'),
                   'description' => $this->input->post('description'),
                   'issue_date' => $this->input->post('issue_date'),
               );
              $this->db->where('id', $id);
               if ($this->db->update('budget_j_miscellaneous_register', $form_data)) {
                   $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                   redirect('journal_entry/miscellaneous_entry');
               }
           }
           $this->db->select('q.*,u.name_bn as create_by');
           $this->db->from('budget_j_miscellaneous_register as q');
           $this->db->join('users as u', 'u.id = q.create_by', 'left');
           $this->db->where('q.id', $id);
           $this->data['budget_j_miscellaneous_register'] = $this->db->get()->row();
            //Dropdown
           $this->data['info'] = $this->Common_model->get_user_details();
           //Load view
           $this->data['meta_title'] = 'বিবিধ  বিস্তারিত';
           $this->data['subview'] = 'miscellaneous/edit';
           $this->load->view('backend/_layout_main', $this->data);
       }

       public function miscellaneous_entry_delete($encid){
           $id = (int) decrypt_url($encid);
           $this->db->where('id', $id);
           if ($this->db->delete('budget_j_miscellaneous_register')) {
               $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
               redirect('journal_entry/miscellaneous_entry');
           }else{
               $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
               redirect('journal_entry/miscellaneous_entry');
           }
       }
       // end budget_j_miscellaneous_register
       public function chenge_status($type,$encid)
       {
        $id = (int) decrypt_url($encid);
        if ($type == 'revenue') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_gov_revenue_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
            redirect('journal_entry/revenue_entry');

        }elseif ($type == 'publication') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_publication_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');

            redirect('journal_entry/publication_entry');

        }elseif ($type == 'miscellaneous') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_miscellaneous_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');

            redirect('journal_entry/miscellaneous_entry');

        }elseif ($type == 'pension') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_pension_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');

            redirect('journal_entry/pension_entry');

        }elseif ($type == 'hostel') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_hostel_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
            redirect('journal_entry/hostel_entry');
        }elseif ($type == 'gpf') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_gpf_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
            redirect('journal_entry/gpf_entry');
        }elseif ($type == 'cheque') {
            $this->db->where('id', $id);
            $this->db->update('budget_j_cheque_register', array('status' => 2));
            $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
            redirect('journal_entry/cheque_entry');
        }
       }

       //entry Report 
        public function entry_report()
        {
            $this->data['meta_title'] = 'রিপোর্ট';
            $this->data['mudule_title'] = 'রিপোর্ট';
            $this->data['subview'] = 'entry_report';
            $this->load->view('backend/_layout_main', $this->data);
        }
        public function entry_report_view()
        {

            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $btnsubmit = $this->input->post('btnsubmit');
            $s_array=explode(',', $btnsubmit);
            $btn=$s_array[0];
            $type=$s_array[1];
            if($btn == 'all_pending') {
                $this->data['results']= $this->Journal_entry_model->all_journal($type,$from_date, $to_date,1);
            } 
            if($btn == 'all_approved') {
                $this->data['results']= $this->Journal_entry_model->all_journal($type,$from_date, $to_date,2);
            } 
            if($btn == 'all_entry') {
                $this->data['results']= $this->Journal_entry_model->all_journal($type,$from_date, $to_date);
            } 

            $this->data['headding'] = 'বাজেট এন্ট্রি রিপোর্ট';
            $html = $this->load->view('all_journal_report', $this->data, true);
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();


        // }
            
        }

        













}