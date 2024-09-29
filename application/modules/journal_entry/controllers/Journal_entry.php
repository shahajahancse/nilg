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
        $this->load->helper('bangla_converter');
        $this->load->model('Common_model');
        $this->load->model('Journal_entry_model');
        $this->data['module_name'] = 'জার্নাল এন্ট্রি';
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        // $this->data['module_title'] = 'Inventory';
    }

    // start cheque

    public function cheque_entry($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists(null, $limit, $offset, 'budget_j_cheque_register');
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
                'type' => $this->input->post('type'),
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

    // start budget_j_cash_out_register
    public function cash_out($offset = 0)
    {
        $limit = 25;
        $this->db->select('b.*,budget_head_sub.name_bn');
        $this->db->from('budget_j_cash_out_register as b');
        $this->db->join('budget_head_sub', 'budget_head_sub.id = b.sub_head_id', 'left');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('b.id', 'DESC');
        $this->data['results'] = $this->db->get()->result();
        // count query

        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_j_pension_emp as q');
        $tmp = $this->db->get()->result();
        $this->data['total_rows'] = $tmp[0]->count;
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/pension_emp/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'কাশ আউট রেজিস্টার';
        $this->data['subview'] = 'cash_out/cash_out';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function cash_out_create()
    {
        $this->form_validation->set_rules('sub_head_id', 'খাতের নাম', 'required|trim');
        $this->form_validation->set_rules('bill_no', 'বিল নং', 'required|trim');
        $this->form_validation->set_rules('bill_date', 'বিল তারিখ', 'required|trim');
        $this->form_validation->set_rules('amount', 'বিল পরিমাণ', 'required|trim');

        // $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            $r = $this->db->order_by('id', 'DESC')->get('budget_j_cash_out_register')->row();
            $h_id = $this->input->post('sub_head_id');
            $amt = $this->input->post('amount');
            $form_data = array(
                'sub_head_id' => $h_id,
                'date' => date('Y-m-d'),
                'biboron' => $this->input->post('biboron'),
                'bill_no' => $this->input->post('bill_no'),
                'bill_date' => $this->input->post('bill_date'),
                'token_no' =>  $this->input->post('token_no'),
                'token_date' =>  $this->input->post('token_date'),

                'amount' => $amt,
                'total_amt' => $r->total_amt + $amt,
                'description' => $this->input->post('description'),
                'create_by' => $user->id,
            );

            if ($this->Common_model->save('budget_j_cash_out_register', $form_data)) {
                $h = $this->db->where('id', $h_id)->get('budget_head_sub')->row();
                $this->db->where('id', $h_id)->update('budget_head_sub', array('amount' => $h->amount - $amt));
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/cash_out');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->db->where('status', 4)->get('users')->result();
        // dd($this->data['users']);
        //Load view
        $this->data['meta_title'] = 'কাশ আউট রেজিস্টার';
        $this->data['subview'] = 'cash_out/cash_out_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function cash_out_edit($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim');
        $this->form_validation->set_rules('basic_salary', 'মূল বেতন', 'required|trim');
        $this->form_validation->set_rules('percent', 'বেতন বৃদ্ধি %', 'required|trim');
        $this->form_validation->set_rules('medical_amt', 'চিকিৎসা', 'required|trim');
        $this->form_validation->set_rules('account', 'একাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('acc_address', 'একাউন্ট ঠিকানা বাংলা', 'required|trim');
        // $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $ex = explode(',', trim($this->input->post('medical_amt')));
            // dd($ex);
            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'receiver' => $this->input->post('receiver'),
                'basic_salary' => $this->input->post('basic_salary'),
                'nit_amt' =>  $this->input->post('nit_amt'),
                'medical_amt' => $ex[0],
                'total_amt' => $this->input->post('total_amt'),
                'percent' => $this->input->post('percent'),
                'account' => $this->input->post('account'),
                'acc_address' => $this->input->post('acc_address'),
                'remark' => $this->input->post('remark'),
            );

            if ($this->db->where('id', $id)->update('budget_j_pension_emp', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/pension_emp');
            }
        }

        $this->data['row'] = $this->db->where('id', $id)->get('budget_j_pension_emp')->row();
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        // dd($this->data['users']);
        //Load view
        $this->data['meta_title'] = 'পেনশন কর্মকর্তা/কর্মচারী তৈরি';
        $this->data['subview'] = 'pension/pension_emp_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    // end budget_j_cash_out_register

    // start budget_j_pension_register
    public function pension_emp($offset = 0)
    {
        $limit = 25;
        $this->db->select('b.*, u.name_bn, m.amount medical_amt');
        $this->db->from('budget_j_pension_emp as b');
        $this->db->join('users as u', 'u.id = b.user_id', 'left');
        $this->db->join('budget_medical as m', 'm.id = b.medical_amt', 'left');

        // $this->db->where('b.status', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('b.id', 'DESC');
        $this->data['results'] = $this->db->get()->result();
        // count query

        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_j_pension_emp as q');
        $tmp = $this->db->get()->result();
        $this->data['total_rows'] = $tmp[0]->count;
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/pension_emp/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'পেনশন কর্মকর্তা/কর্মচারী তালিকা';
        $this->data['subview'] = 'pension/pension_emp';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function pension_emp_create()
    {
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim');
        $this->form_validation->set_rules('basic_salary', 'মূল বেতন', 'required|trim');
        $this->form_validation->set_rules('percent', 'বেতন বৃদ্ধি %', 'required|trim');
        $this->form_validation->set_rules('medical_amt', 'চিকিৎসা', 'required|trim');
        $this->form_validation->set_rules('account', 'একাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('acc_address', 'একাউন্ট ঠিকানা বাংলা', 'required|trim');
        // $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $ex = explode(',', trim($this->input->post('medical_amt')));
            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'receiver' => $this->input->post('receiver'),
                'basic_salary' => $this->input->post('basic_salary'),
                'nit_amt' =>  $this->input->post('nit_amt'),
                'medical_amt' => $ex[0],
                'total_amt' => $this->input->post('total_amt'),
                'percent' => $this->input->post('percent'),
                'account' => $this->input->post('account'),
                'acc_address' => $this->input->post('acc_address'),
                'remark' => $this->input->post('remark'),
            );
            if ($this->Common_model->save('budget_j_pension_emp', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/pension_emp');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->db->where('status', 4)->get('users')->result();
        // dd($this->data['users']);
        //Load view
        $this->data['meta_title'] = 'পেনশন কর্মকর্তা/কর্মচারী তৈরি';
        $this->data['subview'] = 'pension/pension_emp_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function pension_emp_edit($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim');
        $this->form_validation->set_rules('basic_salary', 'মূল বেতন', 'required|trim');
        $this->form_validation->set_rules('percent', 'বেতন বৃদ্ধি %', 'required|trim');
        $this->form_validation->set_rules('medical_amt', 'চিকিৎসা', 'required|trim');
        $this->form_validation->set_rules('account', 'একাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('acc_address', 'একাউন্ট ঠিকানা বাংলা', 'required|trim');
        // $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $ex = explode(',', trim($this->input->post('medical_amt')));
            // dd($ex);
            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'receiver' => $this->input->post('receiver'),
                'basic_salary' => $this->input->post('basic_salary'),
                'nit_amt' =>  $this->input->post('nit_amt'),
                'medical_amt' => $ex[0],
                'total_amt' => $this->input->post('total_amt'),
                'percent' => $this->input->post('percent'),
                'account' => $this->input->post('account'),
                'acc_address' => $this->input->post('acc_address'),
                'remark' => $this->input->post('remark'),
            );

            if ($this->db->where('id', $id)->update('budget_j_pension_emp', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/pension_emp');
            }
        }

        $this->data['row'] = $this->db->where('id', $id)->get('budget_j_pension_emp')->row();
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        // dd($this->data['users']);
        //Load view
        $this->data['meta_title'] = 'পেনশন কর্মকর্তা/কর্মচারী তৈরি';
        $this->data['subview'] = 'pension/pension_emp_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function pension_from(){
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'পেনশন হিদাব';
        $this->data['subview'] = 'pension/pension_from';
        $this->load->view('backend/_layout_main', $this->data);
    }
    function get_pension_ajax() {
		$this->db->select('e.user_id, u.name_bn');
        $this->db->from('budget_j_pension_emp as e');
        $this->db->join('users as u', 'u.id = e.user_id', 'left');
        $this->db->where('e.status', 1);
        $data = $this->db->get()->result();
        echo json_encode($data);
    }
    function pension_process() {
        $process_date = date("Y-m-01", strtotime($this->input->post('process_date')));
        $emp_id = array();
        if (!empty($this->input->post('sql'))) {
            $emp_id = explode(',', trim($this->input->post('sql')));
        }
        $festival = $this->input->post('festival');
        $bvata = $this->input->post('bvata');

        $this->db->trans_start();
        $this->Journal_entry_model->pension_process($process_date, $emp_id, $festival, $bvata);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            echo "Process failed";
        } else {
            echo "Process completed sucessfully";
        }
    }
    function pension_lock() {
        $process_date = date("Y-m-01", strtotime($this->input->post('process_date')));
        $this->db->trans_start();
        $data = array(
            'month' => $process_date,
            'created_by' => $this->data['userDetails']->id,
            'status' => 1
        );
        $this->db->insert('budget_j_pension_lock', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            echo "Process failed";
        } else {
            echo "Lock completely successful";
        }
    }
    public function pension_report_view()
    {
        $this->load->helper('bangla_converter');
        $date = date("Y-m-01", strtotime($this->input->post('fdate')));
        $sdate = date("Y-m-01", strtotime($this->input->post('sdate')));
        $btn = $this->input->post('pension');
        $user_id = array();
        if (!empty($this->input->post('user_id'))) {
            $user_id = explode(',', trim($this->input->post('user_id')));
        }

        if($btn == 'pension_sheet') {
            $this->db->select('r.*, u.name_bn, d.desig_name');
            $this->db->from('budget_j_pension_register as r');
            $this->db->join('users as u', 'u.id = r.user_id', 'left');
            $this->db->join('designations as d', 'd.id = u.crrnt_desig_id', 'left');
            $this->db->where('r.month', $date);
            if (!empty($user_id)) {
                $this->db->where_in('r.user_id', $user_id);
            }
            $this->data['results'] = $this->db->get()->result();
            // dd($this->data['results']);

            // Generate PDF
            $this->data['headding'] = 'পেনশন শিট';
            $html = $this->load->view('pension/pension_sheet_print', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }

        if($btn == 'single_pension') {
            $this->db->select('r.*, u.name_bn, d.desig_name');
            $this->db->from('budget_j_pension_register as r');
            $this->db->join('users as u', 'u.id = r.user_id', 'left');
            $this->db->join('designations as d', 'd.id = u.crrnt_desig_id', 'left');
            $this->db->where('r.month', $date);
            if (!empty($user_id)) {
                $this->db->where_in('r.user_id', $user_id);
            }
            $this->data['results'] = $this->db->get()->result();

            // Generate PDF
            $this->data['headding'] = 'পেনশন শিট';
            $html = $this->load->view('pension/pension_sheet_print', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }
    }
    // end budget_j_pension_register


    // start budget_j_gpf_register
    public function gpf_emp($offset = 0)
    {
        $limit = 25;
        $this->db->select('b.*, u.name_bn, m.desig_name');
        $this->db->from('budget_j_gpf_emp as b');
        $this->db->join('users as u', 'u.id = b.user_id', 'left');
        $this->db->join('designations as m', 'm.id = u.crrnt_desig_id', 'left');

        // $this->db->where('b.status', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('b.id', 'DESC');
        $this->data['results'] = $this->db->get()->result();
        // count query

        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_j_gpf_emp as q');
        $tmp = $this->db->get()->result();
        $this->data['total_rows'] = $tmp[0]->count;
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/pension_emp/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'জিপিএফ কর্মকর্তা/কর্মচারী তালিকা';
        $this->data['subview'] = 'gpf/gpf_emp';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function gpf_emp_create()
    {
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim');
        $this->form_validation->set_rules('account_no', 'একাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('pre_year_amt', 'পূর্ববর্তী পরিমাণ', 'required|trim');
        $this->form_validation->set_rules('loan_amt', 'ঋণের পরিমাণ', 'required|trim');
        $this->form_validation->set_rules('balance', 'অবশিষ্ট পরিমাণ', 'required|trim');
        // $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'account_no' => $this->input->post('account_no'),
                'pre_year_amt' => $this->input->post('pre_year_amt'),
                'loan_amt' => $this->input->post('loan_amt'),
                'balance' => $this->input->post('balance'),
            );
            if ($this->Common_model->save('budget_j_gpf_emp', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/gpf_emp');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->Common_model->get_nilg_employee();
        // dd($this->data['users']);
        //Load view
        $this->data['meta_title'] = 'জিপিএফ কর্মকর্তা/কর্মচারী তৈরি';
        $this->data['subview'] = 'gpf/gpf_emp_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function gpf_emp_edit($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim');
        $this->form_validation->set_rules('account_no', 'একাউন্ট নং', 'required|trim');
        $this->form_validation->set_rules('pre_year_amt', 'পূর্ববর্তী পরিমাণ', 'required|trim');
        $this->form_validation->set_rules('loan_amt', 'ঋণের পরিমাণ', 'required|trim');
        $this->form_validation->set_rules('balance', 'অবশিষ্ট পরিমাণ', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'account_no' => $this->input->post('account_no'),
                'pre_year_amt' => $this->input->post('pre_year_amt'),
                'loan_amt' => $this->input->post('loan_amt'),
                'balance' => $this->input->post('balance'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('budget_j_gpf_emp', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/gpf_emp');
            }
        }

        $this->data['row'] = $this->db->where('id', $id)->get('budget_j_gpf_emp')->row();
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->Common_model->get_nilg_employee();

        //Load view
        $this->data['meta_title'] = 'জিপিএফ কর্মকর্তা/কর্মচারী তৈরি';
        $this->data['subview'] = 'gpf/gpf_emp_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function gpf_entry($offset = 0)
    {
        $limit = 25;
        $this->db->select('b.*, u.name_bn, m.desig_name');
        $this->db->from('budget_j_gpf_register as b');
        $this->db->join('users as u', 'u.id = b.user_id', 'left');
        $this->db->join('designations as m', 'm.id = u.crrnt_desig_id', 'left');

        // $this->db->where('b.status', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('b.id', 'DESC');
        $this->data['results'] = $this->db->get()->result();
        // count query

        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_j_gpf_register as q');
        $tmp = $this->db->get()->result();
        $this->data['total_rows'] = $tmp[0]->count;
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/pension_emp/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'জিপিএফ তালিকা';
        $this->data['subview'] = 'gpf/gpf_entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function gpf_create()
    {
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim|callback_check_unique');

         $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'fcl_year' => $this->input->post('fcl_year'),
                'pbalance' => $this->input->post('pbalance'),
                'curr_amt' => $this->input->post('total_curr_amt'),
                'adv_amt' => $this->input->post('total_adv_amt'),
                'adv_withdraw' => $this->input->post('total_adv_withdraw'),
                'balance' => $this->input->post('total_balance'),
                'description' => $this->input->post('description'),
                'status' => 1,
                'created_at' => date('Y-m-d'),
                'create_by' => $user->id,
            );
            if ($this->db->insert('budget_j_gpf_register', $form_data)) {
                $insert_id = $this->db->insert_id();
                foreach($_POST['month'] as $key => $value) {
                    $data2 = array(
                        'gpf_reg_id' => $insert_id,
                        'month' =>  $value,
                        'curr_amt' => $_POST['curr_amt'][$key],
                        'adv_amt' => $_POST['adv_amt'][$key],
                        'adv_withdraw' => $_POST['adv_withdraw'][$key],
                        'balance' => $_POST['balance'][$key],
                        'description' => $_POST['comment'][$key],
                        'status' => 1
                    );
                    $this->db->insert('budget_j_gpf_register_details', $data2);
                }

                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/gpf_entry');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        // dd($this->data['users']);
        //Load view
        $this->data['meta_title'] = 'জিপিএফ তৈরি';
        $this->data['subview'] = 'gpf/gpf_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function gpf_edit($encid=null)
    {
        if ($encid==null) {
            $id= $_POST['id'];
        }else{
            $id = (int) decrypt_url($encid);
        }
        $this->form_validation->set_rules('user_id', 'নাম', 'required|trim');


        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {

            $form_data = array(
                'user_id' => $this->input->post('user_id'),
                'fcl_year' => $this->input->post('fcl_year'),
                'pbalance' => $this->input->post('pbalance'),
                'curr_amt' => $this->input->post('total_curr_amt'),
                'adv_amt' => $this->input->post('total_adv_amt'),
                'adv_withdraw' => $this->input->post('total_adv_withdraw'),
                'balance' => $this->input->post('total_balance'),
                'description' => $this->input->post('description'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('budget_j_gpf_register', $form_data)) {
                $this->db->where('gpf_reg_id', $id);
                $this->db->delete('budget_j_gpf_register_details');
                foreach($_POST['month'] as $key => $value) {
                    $data2 = array(
                        'gpf_reg_id' => $id,
                        'month' =>  $value,
                        'curr_amt' => $_POST['curr_amt'][$key],
                        'adv_amt' => $_POST['adv_amt'][$key],
                        'adv_withdraw' => $_POST['adv_withdraw'][$key],
                        'balance' => $_POST['balance'][$key],
                        'description' => $_POST['comment'][$key],
                        'status' => 1
                    );
                    $this->db->insert('budget_j_gpf_register_details', $data2);
                }
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/gpf_entry');
            }
        }

        $this->data['row'] = $this->db->where('id', $id)->get('budget_j_gpf_register')->row();
        $this->db->select('budget_j_gpf_register_details.*,session_month.month_bn');
        $this->db->from('budget_j_gpf_register_details');
        $this->db->join('session_month', 'session_month.id = budget_j_gpf_register_details.month', 'left');
        $this->db->where('gpf_reg_id', $id);
        $this->data['details'] = $this->db->get()->result();
        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['users'] = $this->Common_model->get_nilg_employee();

        //Load view
        $this->data['meta_title'] = 'জিপিএফ কর্মকর্তা/কর্মচারী তৈরি';
        $this->data['subview'] = 'gpf/gpf_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function gpf_form(){
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'জিপিএফ রিপোর্ট';
        $this->data['subview'] = 'gpf/gpf_form';
        $this->load->view('backend/_layout_main', $this->data);
    }
    function get_gpf_ajax() {
		$this->db->select('e.user_id, u.name_bn');
        $this->db->from('budget_j_gpf_emp as e');
        $this->db->join('users as u', 'u.id = e.user_id', 'left');
        $this->db->where('e.status', 1);
        $data = $this->db->get()->result();
        echo json_encode($data);
    }
    public function gpf_report_view()
    {
        $this->load->helper('bangla_converter');
        $user_id = $this->input->post('user_id');
        $fcl_year = $this->input->post('fcl_year');
        $btn = $this->input->post('gpf');
        if($btn == 'gpf_sheet') {
            $this->db->select('r.*, u.name_bn, d.desig_name,session_year.session_name');
            $this->db->from('budget_j_gpf_register as r');
            $this->db->join('users as u', 'u.id = r.user_id', 'left');
            $this->db->join('designations as d', 'd.id = u.crrnt_desig_id', 'left');
            $this->db->join('session_year', 'r.fcl_year = session_year.id', 'left');
            $this->db->where('r.user_id', $user_id);
            $this->db->where('r.fcl_year', $fcl_year);
            $this->data['row'] = $this->db->get()->row();

            $this->db->select('budget_j_gpf_register_details.*,session_month.month_bn');
            $this->db->from('budget_j_gpf_register_details');
            $this->db->join('session_month', 'session_month.id = budget_j_gpf_register_details.month', 'left');
            $this->db->where('gpf_reg_id', $this->data['row']->id);
            $this->data['details'] = $this->db->get()->result();

            // Generate PDF
            $this->data['headding'] = 'জিপিএফ শিট';
            $html = $this->load->view('gpf/gpf_sheet_print', $this->data, true);


            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }
    }

    public function check_unique($str = null) {
        $user_id = $this->input->post('user_id'); // Assuming user ID is passed in the form
        $fcl_year = $this->input->post('fcl_year'); // Assuming fci year is passed in the form

        $this->db->where('user_id', $user_id);
        $this->db->where('fcl_year', $fcl_year); // Exclude the current user from the check
        $query = $this->db->get('budget_j_gpf_register');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique', 'The value already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // end budget_j_gpf_register




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
                'type' => $this->input->post('type'),
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

    // start bank
    public function bank_entry($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists($limit, $offset, 'budget_j_bank_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'ব্যাংক  এর তালিকা';
        $this->data['subview'] = 'bank/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function bank_entry_create()
    {
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();

            $form_data = array(
                'bank_no' => $this->input->post('bank_no'),
                'amount' => $this->input->post('amount'),
                'type' => $this->input->post('type'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => $this->input->post('issue_date'),
                'create_by' => $user->id,
            );
            if ($this->Common_model->save('budget_j_bank_register', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/bank_entry');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'ব্যাংক  তৈরি করুন';
        $this->data['subview'] = 'bank/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function bank_entry_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_bank_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['budget_j_bank_register'] = $this->db->get()->row();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'ব্যাংক  বিস্তারিত';
        $this->data['subview'] = 'bank/details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function bank_entry_edit($encid=null){
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
            if ($this->db->update('budget_j_bank_register', $form_data)) {
                $this->session->set_flashdata('success', 'তথ্য সংশোধন  করা হয়েছে');
                redirect('journal_entry/bank_entry');
            }
        }
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_bank_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['budget_j_bank_register'] = $this->db->get()->row();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'ব্যাংক  বিস্তারিত';
        $this->data['subview'] = 'bank/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function bank_entry_delete($encid){
        $id = (int) decrypt_url($encid);
        $this->db->where('id', $id);
        if ($this->db->delete('budget_j_bank_register')) {
            $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
            redirect('journal_entry/bank_entry');
        }else{
            $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
            redirect('journal_entry/bank_entry');
        }
    }
    // end bank

    // start hostel register entry
    public function hostel_entry($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists(1, $limit, $offset, 'budget_j_hostel_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/hostel_entry/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'হোস্টেল এর তালিকা';
        $this->data['subview'] = 'hostel/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function hostel_entry_create()
    {
        $this->form_validation->set_rules('name', 'নাম', 'required|trim');
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $session_year = $this->db->order_by('id', 'desc')->get('session_year')->row()->session_name;
            $this->db->trans_start();
            $form_data = array(
                'voucher_no' => $this->input->post('voucher_no'),
                'amount' => $this->input->post('amount'),
                'type' => 1,
                'session_year' => $session_year,
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'create_by' => $user->id,
            );

            if ($this->Common_model->save('budget_j_hostel_register', $form_data)) {
                $insert_id = $this->db->insert_id();
                $data_details = array(
                    'hostel_register_id' => $insert_id,
                    'title' => $_POST['name'],
                    'nid'  => $_POST['nid'],
                    'mobile' => $_POST['mobile'],
                    'room_id' => $_POST['room_id'],
                    'seat_id' => $_POST['seat_id'],
                    'start_date' => $_POST['start_date'],
                    'end_date' => $_POST['end_date'],
                    'amount'   => $_POST['amount'],
                    'session_year' => $session_year,
                );
                $this->db->insert('budget_j_hostel_register_details', $data_details);

                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/hostel_entry');
            }
        }
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'হোস্টেল তথ্য এন্ট্রি করুন';
        $this->data['subview'] = 'hostel/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function hostel_entry_edit($encid=null){
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('name', 'নাম', 'required|trim');
        $this->form_validation->set_rules('amount', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $this->db->trans_start();
            $form_data = array(
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
            );

            $this->db->where('id', $id);
            if ($this->db->update('budget_j_hostel_register', $form_data)) {

                $data_details = array(
                    'title' => $_POST['name'],
                    'nid' => $_POST['nid'],
                    'mobile' => $_POST['mobile'],
                    'room_id' => $_POST['room_id'],
                    'seat_id' => $_POST['seat_id'],
                    'start_date' => $_POST['start_date'],
                    'end_date' => $_POST['end_date'],
                    'amount' => $_POST['amount'],
                );
                $this->db->where('id', $_POST['detail_id']);
                $this->db->update('budget_j_hostel_register_details', $data_details);

                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/hostel_entry');
            }
        }

        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_hostel_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->data['row'] = $this->db->where('q.id', $id)->get()->row();

        $this->db->where('hostel_register_id', $id);
        $this->data['details'] = $this->db->get('budget_j_hostel_register_details')->result();

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'হোস্টেল এন্ট্রি ফর্ম';
        $this->data['subview'] = 'hostel/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function hostel_entry_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_hostel_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['row'] = $this->db->get()->row();

        $this->db->select('d.*, s.name as seat');
        $this->db->where('d.hostel_register_id', $id);
        $this->db->from('budget_j_hostel_register_details as d');
        $this->db->join('budget_j_hostel_seat as s', 's.id = d.seat_id', 'left');
        $this->data['details'] = $this->db->get()->result();

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'হোস্টেল বিস্তারিত';
        $this->data['subview'] = 'hostel/details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function getSeat(){
        $room_id = $this->input->post('room_id');
        $this->db->select('*');
        $this->db->where('room_id', $room_id);
        $json = $this->db->get('budget_j_hostel_seat')->result();
        echo json_encode($json);
        exit();
    }
    public function getAmount_hostel(){
        $seat_id=$this->input->post('seat_id');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
        $this->db->select('amount');
        $this->db->where('id', $seat_id);
        $data = $this->db->get('budget_j_hostel_seat')->row();
        $amount=$data->amount;
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);
        $interval = $date1->diff($date2);
        $date_diff = $interval->format('%a')+1;
        echo $amount * $date_diff;
    }
    public function hostel_entry_delete($encid){
        $id = (int) decrypt_url($encid);
        $this->db->where('id', $id);
        if ($this->db->delete('budget_j_hostel_register')) {
            $this->db->where('hostel_register_id', $id);
            $this->db->delete('budget_j_hostel_register_details');
            $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
            redirect('journal_entry/hostel_entry');
        }else{
            $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
            redirect('journal_entry/hostel_entry');
        }
    }
    public function hostel_print($id)
    {
        $this->load->helper('bangla_converter');
        $id = (int) decrypt_url($id);
        //Results
        $this->db->select('q.*, u.name_bn as create_by, u.signature');
        $this->db->from('budget_j_hostel_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['info'] = $this->db->get()->row();

        $this->db->select('d.*, s.name as seat');
        $this->db->where('d.hostel_register_id', $id);
        $this->db->from('budget_j_hostel_register_details as d');
        $this->db->join('budget_j_hostel_seat as s', 's.id = d.seat_id', 'left');
        $this->data['details'] = $this->db->get()->result();

        // Generate PDF
        $this->data['headding'] = 'হোস্টেল ভাউচার';
        $html = $this->load->view('hostel/hostel_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function hostel_removeItem($id){
        $this->db->where('id', $id);
        $prd = $this->db->get('budget_j_hostel_register_details')->row();
        $main_id = $prd->hostel_register_id;

        $this->db->where('id', $main_id);
        $pr = $this->db->get('budget_j_hostel_register')->row();

        $data = array(
            'amount' => ($pr->amount - $prd->amount),
        );
        $this->db->where('id', $main_id)->update('budget_j_hostel_register', $data);

        $this->db->where('id', $id);
        $this->db->delete('budget_j_hostel_register_details');
        $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
        return true;
        exit();
    }
    // end hostel register entry

    // start budget_j_publication_register
    // publication entry start
    public function publication_entry_list($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists(1, $limit, $offset, 'budget_j_publication_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'প্রকাশনা এন্ট্রি এর তালিকা';
        $this->data['subview'] = 'publication/publication_entry_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_entry_create()
    {
        $this->form_validation->set_rules('book_id[]', 'বই নাম', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {

            $this->db->trans_start();
            $form_data = array(
                'voucher_no' => $this->input->post('voucher_no'),
                'amount' => $this->input->post('total'),
                'type' => $this->input->post('type'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => date('Y-m-d', strtotime($this->input->post('issue_date'))),
                'create_by' => $user->id,
            );

            if ($this->Common_model->save('budget_j_publication_register', $form_data)) {
                $insert_id = $this->db->insert_id();
                $code='BS-PUB-'.$insert_id.''.$key.'-'.$_POST['book_id'][$key].''.time();
                foreach ($_POST['price'] as $key => $row) {

                    $last_data=$this->db->where('book_id', $_POST['book_id'][$key])->limit(1)->order_by('id', 'desc')->get('budget_j_publication_register_details')->last_row();

                    if (!empty($last_data)) {
                        $rest_qty = $last_data->rest_qty + $_POST['quantity'][$key];
                    } else {
                        $rest_qty = $_POST['quantity'][$key];
                    }

                    $data_details = array(
                        'publication_register_id' => $insert_id ,
                        'book_id' => $_POST['book_id'][$key],
                        'code' => $code,
                        'type' => $this->input->post('type'),
                        'price' => $_POST['price'][$key],
                        'quantity' => $_POST['quantity'][$key],
                        'amount' => $_POST['amount'][$key],
                        'rest_qty' => $rest_qty,
                        'rest_amt' => $rest_qty * $_POST['price'][$key],
                    );
                    $this->db->insert('budget_j_publication_register_details', $data_details);

                    $this->db->where('id', $_POST['book_id'][$key]);
                    $this->db->update('budget_j_publication_book', array('quantity' => $rest_qty));
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/publication_entry_list');
            }
        }

        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['type'] = 1;
        //Load view
        $this->data['meta_title'] = 'প্রকাশনা এন্ট্রি ফর্ম';
        $this->data['subview'] = 'publication/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_entry_details($encid, $type = null){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_publication_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['row'] = $this->db->get()->row();

        $this->db->select('q.*,budget_j_publication_book.*,budget_j_publication_group.name_bn as group_name');
        $this->db->from('budget_j_publication_register_details as q');
        $this->db->join('budget_j_publication_book', 'budget_j_publication_book.id = q.book_id', 'left');
        $this->db->join('budget_j_publication_group', 'budget_j_publication_group.id = budget_j_publication_book.group_id', 'left');
        $this->db->where('publication_register_id', $id);
        $this->data['details'] = $this->db->get()->result();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'প্রকাশনা এন্ট্রি বিস্তারিত';
        $this->data['subview'] = 'publication/entry_details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_entry_delete($encid){
        $id = (int) decrypt_url($encid);
        $this->db->trans_start();
        $this->db->where('id', $id);
        if ($this->db->delete('budget_j_publication_register')) {

            $this->db->where('publication_register_id', $id);
            $rows = $this->db->get('budget_j_publication_register_details')->result();
            foreach ($rows as $key => $row) {
                $book = $this->db->where('id', $row->book_id)->get('budget_j_publication_book')->row();
                if (!empty($book)) {
                    $rest_qty = $book->quantity - $row->quantity;
                    $this->db->where('id', $book->id);
                    $this->db->update('budget_j_publication_book', array('quantity' => $rest_qty));
                }
            }

            $this->db->where('publication_register_id', $id);
            $this->db->delete('budget_j_publication_register_details');
            $this->db->trans_complete();

            $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
            redirect('journal_entry/publication_entry_list');
        }else{
            $this->session->set_flashdata('error', 'তথ্য মুছে ফেলা হয়নি');
            redirect('journal_entry/publication_entry_list');
        }
    }
    // publication entry end

    // publication bikri start
    public function publication_bikri_list($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists(2, $limit, $offset, 'budget_j_publication_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'প্রকাশনা বিক্রি এর তালিকা';
        $this->data['subview'] = 'publication/publication_bikri_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_bikri_create($type = null)
    {
        $this->form_validation->set_rules('book_id[]', 'বই নাম', 'required|trim');
        $this->form_validation->set_rules('name', 'নাম', 'required|trim');
        $this->form_validation->set_rules('mobile', 'মোবাইল', 'required|trim');
        $this->form_validation->set_rules('address', 'ঠিকানা', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {

            $this->db->trans_start();
            $form_data = array(
                'voucher_no' => $this->input->post('voucher_no'),
                'amount' => $this->input->post('total'),
                'commission' => $this->input->post('total') - $this->input->post('pay_total'),
                'pay_amount' => $this->input->post('pay_total'),
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => date('Y-m-d', strtotime($this->input->post('issue_date'))),
                'create_by' => $user->id,
            );

            if ($this->Common_model->save('budget_j_publication_register', $form_data)) {
                $insert_id = $this->db->insert_id();
                $code='BS-PUB-'.$insert_id.''.$key.'-'.$_POST['book_id'][$key].''.time();
                foreach ($_POST['price'] as $key => $row) {
                    $type = $_POST['sell_type'][$key];

                    $last_data=$this->db->where('book_id', $_POST['book_id'][$key])->limit(1)->order_by('id', 'desc')->get('budget_j_publication_register_details')->last_row();

                    if (!empty($last_data)) {
                        $rest_qty = $last_data->rest_qty - $_POST['quantity'][$key];
                    } else {
                        $rest_qty = $_POST['quantity'][$key];
                    }

                    $data_details = array(
                        'publication_register_id' => $insert_id,
                        'book_id' => $_POST['book_id'][$key],
                        'code' => $code,
                        'type' => $type,
                        'price' => $_POST['price'][$key],
                        'quantity' => $_POST['quantity'][$key],
                        'amount' => $_POST['amount'][$key],
                        'commission' => $_POST['commission'][$key],
                        'pay_amount' => $_POST['pay_amount'][$key],
                        'rest_qty' => $rest_qty,
                        'rest_amt' => $rest_qty * $_POST['price'][$key],
                    );
                    $this->db->insert('budget_j_publication_register_details', $data_details);

                    $this->db->where('id', $_POST['book_id'][$key]);
                    $this->db->update('budget_j_publication_book', array('quantity' => $rest_qty));
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/publication_bikri_list');
            }
        }

        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['type'] = 2;
        //Load view
        $this->data['meta_title'] = 'প্রকাশনা বিক্রয় ফর্ম';
        $this->data['subview'] = 'publication/bikri_form';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_bikri_details($encid, $type = null){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_publication_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['row'] = $this->db->get()->row();

        $this->db->select('q.*, b.name_bn, b.isbn_number');
        $this->db->from('budget_j_publication_register_details as q');
        $this->db->join('budget_j_publication_book as b', 'b.id = q.book_id', 'left');
        $this->db->where('q.publication_register_id', $id);
        $this->data['details'] = $this->db->get()->result();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'প্রকাশনা বিক্রয় বিস্তারিত';
        $this->data['subview'] = 'publication/publication_bikri_details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function get_preview_pub(){
        // dd($_POST);
        $this->load->helper('bangla_converter');
        if (empty($_POST['price'])) {
            echo 'Please Select Book';
            exit;
        }
        $form_data = array(
            'voucher_no' => $this->input->post('voucher_no'),
            'amount' => $this->input->post('total'),
            'commission' => $this->input->post('total') - $this->input->post('pay_total'),
            'pay_amount' => $this->input->post('pay_total'),
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'mobile' => $this->input->post('mobile'),
            'address' => $this->input->post('address'),
            'reference' => $this->input->post('reference'),
            'description' => $this->input->post('description'),
            'issue_date' => date('Y-m-d', strtotime($this->input->post('issue_date'))),
        );

        $data_details = array();
        foreach ($_POST['price'] as $key => $row) {
            $type = $_POST['sell_type'][$key];
            $data_details[] = array(
                'book_id' => $_POST['book_id'][$key],
                'type' => $type,
                'price' => $_POST['price'][$key],
                'quantity' => $_POST['quantity'][$key],
                'amount' => $_POST['amount'][$key],
                'commission' => $_POST['commission'][$key],
                'pay_amount' => $_POST['pay_amount'][$key],
            );
        }

        $this->data['info'] = $form_data;
        $this->data['items'] = $data_details;

        $this->data['headding'] = 'প্রকাশনা ভাউচার';
        $html = $this->load->view('publication/publication_preview', $this->data, true);
        echo $html;
    }

    public function publication_print($id)
    {
        $this->load->helper('bangla_converter');
        $id = (int) decrypt_url($id);
        //Results

        $this->db->select('q.*, u.name_bn as create_by, u.signature, ac.signature as acc_signature, d.dept_name');
        $this->db->from('budget_j_publication_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->join('users as ac', 'ac.id = q.acc_id', 'left');
        $this->db->join('department as d', 'd.id = u.crrnt_dept_id', 'left');
        $this->db->where('q.id', $id);
        $this->data['info'] = $this->db->get()->row();

        $this->db->select('q.*, b.name_bn, b.isbn_number');
        $this->db->from('budget_j_publication_register_details as q');
        $this->db->join('budget_j_publication_book as b', 'b.id = q.book_id', 'left');
        $this->db->where('q.publication_register_id', $id);
        $this->data['details'] = $this->db->get()->result();

        // Generate PDF
        $this->data['headding'] = 'প্রকাশনা ভাউচার';
        $html = $this->load->view('publication/publication_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    // End publication bikri


    public function publication_entry($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Journal_entry_model->lists(3, $limit, $offset, 'budget_j_publication_register');
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('journal_entry/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'প্রকাশনা ডিজপোজাল এর তালিকা';
        $this->data['subview'] = 'publication/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_entry_edit($encid=null){
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('book_name[]', 'বই নাম', 'required|trim');
        $this->form_validation->set_rules('sbn_no[]', 'এসবিএন নং', 'required|trim');
        $this->form_validation->set_rules('price[]', 'বইয়ের মূল্য', 'required|trim');
        $this->form_validation->set_rules('quantity[]', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            // id	voucher_no	amount	type 1=cash in, 2=cash out	status	reference	description	issue_date	created_at
            $this->db->trans_start();
            $form_data = array(
                'amount' => $this->input->post('total'),
                'type' => $this->input->post('type'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'issue_date' => date('Y-m-d', strtotime($this->input->post('issue_date'))),
                'create_by' => $user->id,
            );

            $this->db->where('id', $id);
            if ($this->db->update('budget_j_publication_register', $form_data)) {
                foreach ($_POST['price'] as $key => $row) {
                    $data_details = array(
                        'publication_register_id' => $id,
                        'book_name' => $_POST['book_name'][$key],
                        'sbn_no' => $_POST['sbn_no'][$key],
                        'price' => $_POST['price'][$key],
                        'quantity' => $_POST['quantity'][$key],
                        'amount' => $_POST['amount'][$key],
                    );
                    if (!empty($_POST['detail_id'][$key])) {
                        $this->db->where('id', $_POST['detail_id'][$key]);
                        $this->db->update('budget_j_publication_register_details', $data_details);
                    } else {
                        $this->db->insert('budget_j_publication_register_details', $data_details);
                    }
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/publication_entry');
            }
        }

        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_publication_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->data['row'] = $this->db->where('q.id', $id)->get()->row();

        $this->db->where('publication_register_id', $id);
        $this->data['details'] = $this->db->get('budget_j_publication_register_details')->result();

            //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'প্রকাশনা তথ্য';
        $this->data['subview'] = 'publication/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_removeItem($id){
        $this->db->where('id', $id);
        $prd = $this->db->get('budget_j_publication_register_details')->row();
        $main_id = $prd->publication_register_id;

        $this->db->where('id', $main_id);
        $pr = $this->db->get('budget_j_publication_register')->row();

        $data = array(
            'amount' => ($pr->amount - $prd->amount),
        );
        $this->db->where('id', $main_id)->update('budget_j_publication_register', $data);

        $this->db->where('id', $id);
        $this->db->delete('budget_j_publication_register_details');
        $this->session->set_flashdata('success', 'তথ্য মুছে ফেলা হয়েছে');
        return true;
        exit();
    }
    public function publication_entry_deletes($encid){
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

    // start budget_j_gpf_register
    public function gpf_entry2($offset = 0)
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
                'type' => $this->input->post('type'),
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
                'type' => $this->input->post('type'),
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

    public function print_singal($type,$encid)
    {
        $id = (int) decrypt_url($encid);
        if ($type == 'revenue') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_gov_revenue_register')->row();
            $this->data['headding'] = 'রাজস্ব এন্ট্রি স্লিপ';
        }elseif ($type == 'publication') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_publication_register')->row();
            $this->data['headding'] = 'প্রকাশনা এন্ট্রি স্লিপ';
        }elseif ($type == 'miscellaneous') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_miscellaneous_register')->row();
            $this->data['headding'] = 'বিবিধ  এন্ট্রি স্লিপ';
        }elseif ($type == 'pension') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_pension_register')->row();
            $this->data['headding'] = 'পেনশন  এন্ট্রি স্লিপ';
        }elseif ($type == 'hostel') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_hostel_register')->row();
            $this->data['headding'] = 'হোস্টেল  এন্ট্রি স্লিপ';
        }elseif ($type == 'gpf') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_gpf_register')->row();
            $this->data['headding'] = 'GPF  এন্ট্রি স্লিপ';
        }elseif ($type == 'cheque') {
            $this->db->where('id', $id);
            $data=$this->db->get('budget_j_cheque_register')->row();
            $this->data['headding'] = 'চেক এন্ট্রি স্লিপ';
        }
        $this->data['data'] = $data;
        echo $this->load->view('print_singal', $this->data);
        // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        // $mpdf->WriteHtml($html);
        // $mpdf->output();
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
        $this->load->helper('bangla_converter');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $book_name = $this->input->post('book_name');
        $btnsubmit = $this->input->post('btnsubmit');
        $s_array=explode(',', $btnsubmit);
        $btn=$s_array[0];
        if (!empty($s_array[1])) {
            $type=$s_array[1];
        } else {
            $type=null;
        }

        if($btn == 'cash_out_register') {
            $head_id = $this->input->post('head_id');
            $this->data['row'] = $this->db->where('id', $head_id)->get('budget_head_sub')->row();
            $this->data['results'] = $this->db->where('sub_head_id', $head_id)->get('budget_j_cash_out_register')->result();

            // Generate PDF
            $this->data['headding'] = 'কাশ আউট রেজিস্টার';
            $html = $this->load->view('cash_out/cash_out_register_print', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }

        if($btn == 'cheque_register') {
            $this->data['results'] = $this->db->get('budget_j_cheque_register')->result();

            // Generate PDF
            $this->data['headding'] = 'চেক রেজিস্টার';
            $html = $this->load->view('cash_out/cheque_register_print', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }

        // dd($_POST);

        // publication start
        if($btn == 'single_book' && !empty($book_name)) {
            $this->data['results'] = $this->Journal_entry_model->single_book_info($from_date, $to_date, $book_name);
            // dd($this->data['results']);
            // Generate PDF
            $this->data['headding'] = 'স্টোর মজুত লেজার';
            $html = $this->load->view('publication/single_book_info', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            exit;
        } else if($btn == 'all_book') {
            $this->data['results']= $this->Journal_entry_model->all_book($from_date, $to_date);

            // Generate PDF
            if ($type == 'number') {
                $this->data['headding'] = 'প্রকাশনা সংখ্যা ভিত্তিক রিপোর্ট';
                $html = $this->load->view('publication/publication_number_print', $this->data, true);
            } else if ($type == 'total') {
                $this->data['headding'] = 'প্রকাশনা মজুদ রিপোর্ট';
                $html = $this->load->view('publication/publication_total_print', $this->data, true);
            } else if ($type == 'bikroy') {
                $this->data['headding'] = 'প্রকাশনা বিক্রয় রিপোর্ট';
                $html = $this->load->view('publication/publication_bikroy_print', $this->data, true);
            } else if ($type == 'soujony') {
                $this->data['headding'] = 'প্রকাশনা সৌজন্য রিপোর্ট';
                $html = $this->load->view('publication/publication_soujony_print', $this->data, true);
            } else {
                $this->data['headding'] = 'প্রকাশনা পরিমাণ ভিত্তিক রিপোর্ট';
                $html = $this->load->view('publication/publication_amount_print', $this->data, true);
            }
            $html;

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            exit;
        } else if($btn == 'group_book') {
            $group_id = $this->input->post('group_name');
            $this->data['results'] = $this->Journal_entry_model->group_book_info($from_date, $to_date, $group_id);
            // dd($this->data['results']);
            // Generate PDF
            $this->data['headding'] = 'গ্রুপ ভিত্তিক রিপোর্ট';
            $html = $this->load->view('publication/group_book_info', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            exit;
        } else if($btn == 'excel_sheet') {
            $this->data['results'] = $this->Journal_entry_model->all_book($from_date, $to_date);
            // dd($this->data['results']);

            //Load View
            $this->data['headding'] = 'এক্সেল শীট';
            $this->data['meta_title'] = 'এক্সেল শীট';
            $this->load->view('publication/excel_sheet', $this->data);
            return true; exit;
        }
        // publication end

        if($btn == 'hostel_entry_report') {
            $this->data['results'] = $this->Journal_entry_model->hostel_entry_report($from_date, $to_date);
            // dd($this->data['results']);
            // Generate PDF
            $this->data['from_date'] = $from_date;
            $this->data['to_date'] = $to_date;
            $this->data['headding'] = 'হোস্টেল রিপোর্ট';
            $html = $this->load->view('hostel/hostel_entry_report', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }

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
        echo $html = $this->load->view('all_journal_report', $this->data, true);
    }

}
