<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_sub_head extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'বাজেট সাব হেড';
        $this->load->model('Common_model');
        $this->load->model('Budget_head_model');
        $this->load->model('Budget_sub_head_model');

    }

    public function training($offset=0){
        // Manage list the users
        $limit = 50;

        $results = $this->Budget_sub_head_model->training_get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/budget_sub_head/training/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['course'] = $this->Common_model->get_course();


        //Load page
        $this->data['meta_title'] = 'বাজেট সাব হেড';
        $this->data['subview'] = 'budget_sub_head/training';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_add(){
        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim|callback_name_en_unique');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim|callback_name_bn_unique');
        $this->form_validation->set_rules('head_id', 'বাজেট হেড', 'required|trim');
        $this->form_validation->set_rules('vat', 'ভ্যাট', 'required');

        if ($this->form_validation->run() == true){
            $query = $this->db->where('id', $this->input->post('head_id'))->get('budget_head_training')->row();
            $query1 = $this->db->where('head_id', $_POST['head_id'])->order_by('id', 'DESC')->get('budget_head_sub_training')->row();
            if (empty($query1)) {
                $bd_code = $query->bd_code.'001';
            } else {
                $bd_code = $query1->bd_code + 1;
            }

            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'head_id'    => $this->input->post('head_id'),
                'bd_code'    => $bd_code,
                'vat_head'    => $this->input->post('vat'),
                'status'     => $this->input->post('status'),
            );

            if($this->Common_model->save('budget_head_sub_training', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট সাব হেড সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/budget_sub_head/training');
            }
        }
        $this->data['budget_heads'] = $this->Budget_head_model->get_data_training();
        $this->data['meta_title'] = 'বাজেট সাব হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_sub_head/training_add';
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
                'vat_head'    => $this->input->post('vat'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->edit('budget_head_sub_training', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট সাব হেড সংশোধন করা হয়েছে');
                redirect('nilg_setting/budget_sub_head/training');


            }
        }

        $this->data['info'] = $this->db->where('id', $id)->get('budget_head_sub_training')->row();
        $this->data['meta_title'] = 'বাজেট সাব হেড সংশোধন করুন';
        $this->data['subview'] = 'budget_sub_head/training_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function name_en_unique($name_en) {
        $this->db->where('name_en', $name_en);
        $query = $this->db->get('budget_head_sub_training');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('name_en_unique', 'The {field} must be unique.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function name_bn_unique($name_bn) {
        $this->db->where('name_bn', $name_bn);
        $query = $this->db->get('budget_head_sub_training');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('name_bn_unique', 'The {field} must be unique.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function ajax_add_sub_head($id) {

        $query = $this->db->where('id', $id)->get('budget_head_training')->row();
        $query1 = $this->db->where('head_id', $id)->order_by('id', 'DESC')->get('budget_head_sub_training')->row();
        if (empty($query1)) {
            $bd_code = $query->bd_code.'001';
        } else {
            $bd_code = $query1->bd_code + 1;
        }

        $form_data = array(
            'name_en'    => $this->input->post('add_name_en'),
            'name_bn'    => $this->input->post('add_name_bn'),
            'head_id'    => $id,
            'bd_code'    => $bd_code,
            'vat_head'   => 0,
            'status'     => 1,
        );
        if($this->Common_model->save('budget_head_sub_training', $form_data)){
            echo json_encode(array('status' => 1, 'msg' => 'বাজেট সাব হেড সংরক্ষণ করা হয়েছে'));
            $this->session->set_flashdata('success', 'বাজেট সাব হেড সংরক্ষণ করা হয়েছে');
        }else{
            echo json_encode(array('status' => 0, 'msg' => 'Something is wrong!!!'));
        }
    }

    public function index($offset=0){
        // Manage list the users
        $limit = 50;

        $results = $this->Budget_sub_head_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/budget_sub_head/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['course'] = $this->Common_model->get_course();


        //Load page
        $this->data['meta_title'] = 'বাজেট সাব হেড';
        $this->data['subview'] = 'budget_sub_head/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        // Validation
        // id	name_en	name_bn	bd_code	amount	type	status 1=active, 2=inactive	created_at

        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('bd_code', 'বিঃডিঃ কোড', 'required|trim');
        $this->form_validation->set_rules('head_id', 'বাজেট হেড', 'required|trim');
        $this->form_validation->set_rules('vat', 'ভ্যাট', 'required');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'head_id'    => $this->input->post('head_id'),
                'bd_code'    => $this->input->post('bd_code'),
                'vat_head'    => $this->input->post('vat'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->save('budget_head_sub', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট সাব হেড সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/budget_sub_head');
            }
        }
        $this->data['budget_heads'] = $this->Budget_head_model->get_data();
        $this->data['meta_title'] = 'বাজেট সাব হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_sub_head/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('bd_code', 'বিঃডিঃ কোড', 'required|trim');
        $this->form_validation->set_rules('head_id', 'বাজেট হেড', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'head_id'    => $this->input->post('head_id'),
                'bd_code'    => $this->input->post('bd_code'),
                'amount'     => $this->input->post('amount'),
                'vat_head'   => $this->input->post('vat'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->edit('budget_head_sub', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট সাব হেড সংশোধন করা হয়েছে');
                redirect('nilg_setting/budget_sub_head');


            }
        }

        $results = $this->Budget_sub_head_model->get_info($id);
        $this->data['info'] = $results['info'];
        $this->data['budget_heads'] = $this->Budget_head_model->get_data();


        $this->data['meta_title'] = 'বাজেট সাব হেড সংশোধন করুন';
        $this->data['subview'] = 'budget_sub_head/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($dataID){
            if ($this->db->delete('budget_head_sub', array('id' => $dataID))) {
                $this->session->set_flashdata('success', 'এই প্রশ্নটি ডাটাবেজ থেকে মুছে ফেলা হয়েছে');
                redirect('nilg_setting/budget_sub_head');
            }
    }


   public function budget_head_pdf($offset = 0)
   {
      // Get Result
        $results = $this->Budget_sub_head_model->get_data(100000, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
      // dd($this->data['info']);

      // Load View
      $this->data['headding'] = 'প্রশ্নের তালিকা';
      $html = $this->load->view('budget_head/qbank_pdf', $this->data, true);
      // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        // Generate PDF
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      // $mpdf->useFixedNormalLineHeight = true;
      // $mpdf->useFixedTextBaseline = true;
      // $mpdf->adjustFontDescLineheight = 2.14;
      $mpdf->WriteHtml($html);
      $mpdf->output('Pre-Exam-'.time().rand().'.pdf', 'I');
   }
}
