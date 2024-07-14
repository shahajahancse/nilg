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
        $this->form_validation->set_rules('title[]', 'শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('amount[]', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $this->db->trans_start();
            $form_data = array(
                'voucher_no' => $this->input->post('voucher_no'),
                'amount' => $this->input->post('total'),
                'type' => $this->input->post('type'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'date' => $this->input->post('issue_date'),
                'create_by' => $user->id,
            );

            if ($this->Common_model->save('budget_j_hostel_register', $form_data)) {
                $insert_id = $this->db->insert_id();
                foreach ($_POST['amount'] as $key => $row) {
                    $data_details = array(
                        'hostel_register_id' => $insert_id ,
                        'title' => $_POST['title'][$key],
                        'remark' => $_POST['remark'][$key],
                        'amount' => $_POST['amount'][$key],
                    );
                    $this->db->insert('budget_j_hostel_register_details', $data_details);
                }
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
    public function hostel_entry_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,u.name_bn as create_by');
        $this->db->from('budget_j_hostel_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->where('q.id', $id);
        $this->data['row'] = $this->db->get()->row();

        $this->db->where('hostel_register_id', $id);
        $this->data['details'] = $this->db->get('budget_j_hostel_register_details')->result();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'হোস্টেল বিস্তারিত';
        $this->data['subview'] = 'hostel/details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function hostel_entry_edit($encid=null){
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('title[]', 'শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('amount[]', 'পরিমাণ', 'required|trim');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == true) {
            $this->db->trans_start();
            $form_data = array(
                'amount' => $this->input->post('total'),
                'type' => $this->input->post('type'),
                'reference' => $this->input->post('reference'),
                'description' => $this->input->post('description'),
                'date' => $this->input->post('issue_date'),
            );

            $this->db->where('id', $id);
            if ($this->db->update('budget_j_hostel_register', $form_data)) {
                foreach ($_POST['amount'] as $key => $row) {
                    $data_details = array(
                        'hostel_register_id' => $id ,
                        'title' => $_POST['title'][$key],
                        'remark' => $_POST['remark'][$key],
                        'amount' => $_POST['amount'][$key],
                    );
                    if (!empty($_POST['detail_id'][$key])) {
                        $this->db->where('id', $_POST['detail_id'][$key]);
                        $this->db->update('budget_j_hostel_register_details', $data_details);
                    } else {
                        $this->db->insert('budget_j_hostel_register_details', $data_details);
                    }
                }
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
    public function hostel_print($id)
    {
        $id = (int) decrypt_url($id);
        //Results
        $this->db->select('q.*, u.name_bn as create_by, u.signature, ac.signature as acc_signature, d.dept_name');
        $this->db->from('budget_j_hostel_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->join('users as ac', 'ac.id = q.acc_id', 'left');
        $this->db->join('department as d', 'd.id = u.crrnt_dept_id', 'left');
        $this->db->where('q.id', $id);
        $this->data['info'] = $this->db->get()->row();

        $this->db->where('hostel_register_id', $id);
        $this->data['items'] = $this->db->get('budget_j_hostel_register_details')->result();

        // Generate PDF
        $this->data['headding'] = 'হোস্টেল ভাউচার';
        $html = $this->load->view('hostel/hostel_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
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
    public function publication_entry_create($type)
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
                foreach ($_POST['price'] as $key => $row) {
                    $code='BS-PUB-'.$insert_id.''.$key.'-'.$_POST['book_id'][$key].''.time();
                    if ($this->input->post('type')==2) {
                        $type=$_POST['sell_type'][$key];
                    }elseif($this->input->post('type')==3){
                        $type=4;
                    }else{
                        $type=1;
                    }

                    $last_data=$this->db->where('book_id', $_POST['book_id'][$key])->limit(1)->order_by('id', 'desc')->get('budget_j_publication_register_details')->last_row();
                    if (!empty($last_data)) {
                        if($type==1){
                            $rest_qty = $last_data->rest_qty + $_POST['quantity'][$key];
                        }else{
                            $rest_qty = $last_data->rest_qty - $_POST['quantity'][$key];
                        }
                    } else {
                        if($type==1){
                        $rest_qty = $_POST['quantity'][$key];
                        }else{
                            $rest_qty =0- $_POST['quantity'][$key];
                        }
                    }
                    $data_details = array(
                        'publication_register_id' => $insert_id ,
                        'book_id' => $_POST['book_id'][$key],
                        'code' => $code,
                        'type' => $type,
                        'price' => $_POST['price'][$key],
                        'quantity' => $_POST['quantity'][$key],
                        'amount' => $_POST['amount'][$key],
                        'rest_qty' => $rest_qty,
                        'rest_amt' => $rest_qty * $_POST['price'][$key],
                    );
                    $this->db->insert('budget_j_publication_register_details', $data_details);
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্য সংরক্ষণ করা হয়েছে');
                redirect('journal_entry/publication_entry');
            }
        }

        $this->data['info'] = $this->Common_model->get_user_details();
        $this->data['type'] = $type;
        //Load view
        $this->data['meta_title'] = 'পাবলিকেশন রেজিস্টার';
        $this->data['subview'] = 'publication/entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function publication_entry_details($encid){
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
        $this->data['meta_title'] = 'পাবলিকেশন বিস্তারিত';
        $this->data['subview'] = 'publication/details';
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
        $this->data['meta_title'] = 'পাবলিকেশন তথ্য';
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
    public function publication_print($id)
    {
        $id = (int) decrypt_url($id);
        //Results
        $this->db->select('q.*, u.name_bn as create_by, u.signature, ac.signature as acc_signature, d.dept_name');
        $this->db->from('budget_j_publication_register as q');
        $this->db->join('users as u', 'u.id = q.create_by', 'left');
        $this->db->join('users as ac', 'ac.id = q.acc_id', 'left');
        $this->db->join('department as d', 'd.id = u.crrnt_dept_id', 'left');
        $this->db->where('q.id', $id);
        $this->data['info'] = $this->db->get()->row();

        $this->db->select('q.*,budget_j_publication_book.*,budget_j_publication_group.name_bn as group_name');
        $this->db->from('budget_j_publication_register_details as q');
        $this->db->join('budget_j_publication_book', 'budget_j_publication_book.id = q.book_id', 'left');
        $this->db->join('budget_j_publication_group', 'budget_j_publication_group.id = budget_j_publication_book.group_id', 'left');
        $this->db->where('publication_register_id', $id);
        $this->data['items'] = $this->db->get()->result();

        // Generate PDF
        $this->data['headding'] = 'পাবলিকেশন ভাউচার';
        $html = $this->load->view('publication/publication_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
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
                'type' => $this->input->post('type'),
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
            $this->data['headding'] = 'পাবলিকেশন এন্ট্রি স্লিপ';
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
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $book_name = $this->input->post('book_name');
            $btnsubmit = $this->input->post('btnsubmit');
            $s_array=explode(',', $btnsubmit);
            $btn=$s_array[0];
            $type=$s_array[1];

            // publication start
            if($btn == 'all_book' && empty($book_name)) {
                $this->data['results']= $this->Journal_entry_model->all_book($from_date, $to_date);

                // Generate PDF
                $this->data['headding'] = 'পাবলিকেশন সামারী রিপোর্ট';
                $html = $this->load->view('publication/publication_summary_print', $this->data, true);

                $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
                $mpdf->WriteHtml($html);
                $mpdf->output();
            } else if($btn == 'all_book' && !empty($book_name)) {
                $this->data['results'] = $this->Journal_entry_model->single_book_info($from_date, $to_date, $book_name);
                // dd($this->data['results']);
                // Generate PDF
                $this->data['headding'] = 'একটি বইইয়ের রিপোর্ট';
                $html = $this->load->view('publication/single_book_info', $this->data, true);

                $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
                $mpdf->WriteHtml($html);
                $mpdf->output();
            }
            // publication end





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
