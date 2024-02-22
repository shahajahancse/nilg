<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_head extends Backend_Controller {
	
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


    public function index($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Budget_head_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/budget_head/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['course'] = $this->Common_model->get_course();


        //Load page
        $this->data['meta_title'] = 'বাজেট হেড';
        $this->data['subview'] = 'budget_head/index';
        $this->load->view('backend/_layout_main', $this->data);
    }




    public function add(){
        // Validation
        // id	name_en	name_bn	bd_code	amount	type	status 1=active, 2=inactive	created_at

        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('bd_code', 'বিঃডিঃ কোড', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'bd_code'    => $this->input->post('bd_code'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->save('budget_head', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট হেড সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/budget_head');
            }
        }
        $this->data['meta_title'] = 'বাজেট হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_head/add';
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){
        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('bd_code', 'বিঃডিঃ কোড', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'bd_code'    => $this->input->post('bd_code'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->edit('budget_head', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট হেড সংশোধন করা হয়েছে');
                redirect('nilg_setting/budget_head');


            }
        }

        $results = $this->Budget_head_model->get_info($id);
        $this->data['info'] = $results['info'];
 

        $this->data['meta_title'] = 'বাজেট হেড সংশোধন করুন';
        $this->data['subview'] = 'budget_head/edit';
        $this->load->view('backend/_layout_main', $this->data);

    }

  

    public function delete($dataID){
      
            if ($this->db->delete('budget_head', array('id' => $dataID))) {
                $this->session->set_flashdata('success', 'এই প্রশ্নটি ডাটাবেজ থেকে মুছে ফেলা হয়েছে'); 
                redirect('nilg_setting/budget_head');
            }

    }


   public function budget_head_pdf($offset = 0)
   {    
      // Get Result
        $results = $this->Budget_head_model->get_data(100000, $offset);
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


   // description
    public function budget_description($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Budget_head_model->get_description($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];


        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/budget_head/budget_description/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        

        $this->data['meta_title'] = 'বাজেট হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_head/budget_description';
        $this->load->view('backend/_layout_main', $this->data);
   }   

   // description
   public function budget_description_add()
   {
        // dd($_POST);

        $this->form_validation->set_rules('title', 'টাইটেল', 'required|trim');
        $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('details', 'বর্ণনা', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'title'         => $this->input->post('title'),
                'office_type'   => $this->input->post('office_type'),
                'details'       => $this->input->post('details'),
                'status'        => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->save('budget_description', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট হেড সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/budget_head/budget_description');
            }
        }

        $this->data['meta_title'] = 'বাজেট হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_head/budget_description_add';
        $this->load->view('backend/_layout_main', $this->data);
   }   

   // description
   public function budget_description_edit()
   {
        $this->form_validation->set_rules('name_en', 'নাম (ইংরেজী)', 'required|trim');
        $this->form_validation->set_rules('name_bn', 'নাম (বাংলা)', 'required|trim');
        $this->form_validation->set_rules('bd_code', 'বিঃডিঃ কোড', 'required|trim');
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name_en'    => $this->input->post('name_en'),
                'name_bn'    => $this->input->post('name_bn'),
                'bd_code'    => $this->input->post('bd_code'),
                'status'     => $this->input->post('status'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->save('budget_head', $form_data)){
                $this->session->set_flashdata('success', 'বাজেট হেড সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/budget_head');
            }
        }
        $this->data['meta_title'] = 'বাজেট হেড সংরক্ষণ করুন';
        $this->data['subview'] = 'budget_head/budget_description';
        $this->load->view('backend/_layout_main', $this->data);
   }
}