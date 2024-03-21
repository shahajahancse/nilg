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
    public function revenue_entry_details(){



        
    }
    public function revenue_entry_edit(){




    }
    public function revenue_entry_delete(){




    }
    // end revenew
}

