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


}
