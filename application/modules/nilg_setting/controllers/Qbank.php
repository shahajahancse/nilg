<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qbank extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'প্রশ্ন ব্যাংক';
        $this->load->model('Common_model');
        $this->load->model('Qbank_model');
    }


    public function index($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Qbank_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/qbank/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['course'] = $this->Common_model->get_course();


        //Load page
        $this->data['meta_title'] = 'সকল প্রশ্নের তালিকা';
        $this->data['subview'] = 'qbank/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){
        // Get Info
        $results = $this->Qbank_model->get_info($id);
        $this->data['info'] = $results['info'];
        $this->data['options'] = $results['options'];
        // echo $this->data['info']->question_type; exit;

        // View
        $this->data['meta_title'] = 'প্রশ্নের বিস্তারিত';
        $this->data['subview'] = 'qbank/details';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function add(){
        // Validation
        $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('question', 'প্রশ্ন', 'required|is_unique[qbank.question_title]|trim');
        $this->form_validation->set_message('is_unique', 'এই %sটি ডাটাবেজে সংরক্ষিত আছে');
        $this->form_validation->set_rules('question_type', 'প্রশ্নের ধরণ', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_type'    => $this->input->post('office_type'),
                'question_title' => $this->input->post('question'),
                'question_type'  => $this->input->post('question_type'),
                'qnumber'        => $this->input->post('qnumber'),
            );
            // print_r($form_data); exit;
            if($this->Common_model->save('qbank', $form_data)){
                // Last insert ID
                $lastID = $this->db->insert_id();

                // Multiple Option 
                for ($i = 0; $i < sizeof($_POST['option_name']); $i++) {
                    $question_data = array(
                        'qbank_id' => $lastID,
                        'option_name' => $_POST['option_name'][$i],
                        );
                    $this->Common_model->save('qbank_option', $question_data);
                }

                $this->session->set_flashdata('success', 'প্রশ্ন ব্যাংকে প্রশ্নটি সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/qbank');
            }
        }
        
        // Dropdown List        
        // $this->data['course'] = $this->Common_model->get_course();
        $this->data['office_type'] = $this->Common_model->get_office_type();
        $this->data['question_type'] = $this->Common_model->get_question_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'প্রশ্ন এন্ট্রি';
        $this->data['subview'] = 'qbank/add';
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){
        // Get Info
        $results = $this->Qbank_model->get_info($id);
        $this->data['info'] = $results['info'];
        $this->data['options'] = $results['options'];
        // dd($this->data['info']->question_title);

        if($this->input->post('question') != $this->data['info']->question_title) {
           $is_unique =  '|is_unique[qbank.question_title]';
       } else {
           $is_unique =  '';
       }

        // Validation
       $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
       $this->form_validation->set_rules('question', 'প্রশ্ন', 'required|trim'.$is_unique);
        // $this->form_validation->set_rules('question_type', 'প্রশ্নের ধরণ', 'required|trim');



        // Insert Data
       if ($this->form_validation->run() == true){
            // dd($this->input->post('is_right'));

            // Update answer value
            /*if($this->data['info']->question_type == 3){
                $answer = $this->input->post('is_right');
            }elseif ($this->data['info']->question_type == 4) {
                $inputCheck = $this->input->post('is_right');
                $answer = implode(',', $inputCheck);            
                // dd($imp);
            }else{
                $answer = $this->input->post('answer_text');
            }*/

            $form_data = array(
                'office_type' => $this->input->post('office_type'),
                'question_title' => $this->input->post('question'),
                'qnumber' => $this->input->post('qnumber'),
            );                
            // dd($form_data); exit;
            
            if($this->Common_model->edit('qbank', $id, 'id', $form_data)){
                // Question Option 
                for ($i=0; $i<count($_POST['option_name']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('qbank_option', 'id', $_POST['hide_id'][$i]);
                    if ($data_exists) {
                        $data = array(
                            'option_name' => $_POST['option_name'][$i]
                            );
                        $this->Common_model->edit('qbank_option', $_POST['hide_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'qbank_id'    => $id,
                            'option_name' => $_POST['option_name'][$i]
                            );
                        $this->Common_model->save('qbank_option', $data);

                        // If new option is right answer
                        // if($this->input->post('is_right')){
                            // Get qbank_option last id
                            // $lastID = $this->db->insert_id();                            
                            // Update to qbank answer field                            
                        // }
                    }
                }

                $this->session->set_flashdata('success', 'প্রশ্ন ব্যাংকে প্রশ্নটি সংশোধন করা হয়েছে');
                redirect('nilg_setting/qbank');
            }
        }


        // Dropdown List        
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['course'] = $this->Common_model->get_course();
        $this->data['question_type'] = $this->Common_model->get_question_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'প্রশ্নের তথ্য সম্পাদন';
        $this->data['subview'] = 'qbank/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function ajax_question_option_del($id)
    {
        $this->Common_model->delete('qbank_option', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    public function delete($dataID){
        if (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
        }
        
        if($this->Common_model->exists('evaluation_question', 'question_id', $dataID)){
            $this->session->set_flashdata('danger', 'এই প্রশ্নটি দিয়ে মূল্যায়ন প্রশ্নপত্র তৈরি করা হয়েছে, তাই ডাটাবেজ থেকে মুছে ফেলা যাচ্ছে না'); 
            redirect('nilg_setting/qbank');
        }else{
            if ($this->db->delete('qbank', array('id' => $dataID))) {
                $this->session->set_flashdata('success', 'এই প্রশ্নটি ডাটাবেজ থেকে মুছে ফেলা হয়েছে'); 
                redirect('nilg_setting/qbank');
            }
        }
    }


   public function qbank_pdf($offset = 0)
   {    
      // Get Result
        $results = $this->Qbank_model->get_data(1000, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
      // dd($this->data['info']);

      // Load View
      $this->data['headding'] = 'প্রশ্নের তালিকা';
      $html = $this->load->view('qbank/qbank_pdf', $this->data, true);
      // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        // Generate PDF
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      // $mpdf->useFixedNormalLineHeight = true;
      // $mpdf->useFixedTextBaseline = true;
      // $mpdf->adjustFontDescLineheight = 2.14;
      $mpdf->WriteHtml($html);
      $mpdf->output('Pre-Exam-'.time().rand().'.pdf', 'I');
   }



    //*******************************************************************************************//
    // Setup Answer
    //*******************************************************************************************//
    function ajax_question_by_id($id){
        $results = $this->Qbank_model->get_info($id);
        $this->data['info'] = $results['info'];
        $this->data['options'] = $results['options'];

        $this->load->view('qbank/ajax_question_details', $this->data);
    }

    function ajax_answer_update($id){
        // Get question information
        $results = $this->Qbank_model->get_info($id); 
        $this->data['info'] = $results['info'];
        // dd($this->data['info']->question_type);      
        $answer = NULL;

        // Update answer value
        if($this->data['info']->question_type == 3){
            $this->form_validation->set_rules('is_right', 'সঠিক উত্তর নিইরবাচন করুন', 'trim');
            $answer = $this->input->post('is_right');
        }elseif($this->data['info']->question_type == 4) {
            $this->form_validation->set_rules('is_right[]', 'সঠিক উত্তর নিইরবাচন করুন', 'trim');
            $inputCheck = $this->input->post('is_right');
            $answer = implode(',', $inputCheck);            
            // dd($imp);
        }else{
            $this->form_validation->set_rules('answer_text', 'সম্ভ্যাব্য উত্তর প্রদান করুন', 'trim');
            $answer = $this->input->post('answer_text');
        }

        // Validate and Insert to DB
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'answer' => $answer,
                'qnumber' => $this->input->post('qnumber'),  // question number update or set   
            );   
            // dd($form_data); exit;

            if($this->Common_model->edit('qbank', $id, 'id', $form_data)){
                echo json_encode(array('status' => 1, 'msg' => 'প্রশ্নটির উত্তর সংশোধন করা হয়েছে'));
                $this->session->set_flashdata('success', 'প্রশ্নটির উত্তর সংশোধন করা হয়েছে');
            }else{
                echo json_encode(array('status' => 0, 'msg' => 'Something is wrong!!!'));
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => validation_errors()));
        }

    }

}