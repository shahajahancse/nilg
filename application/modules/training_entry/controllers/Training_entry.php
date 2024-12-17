<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Training_entry extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'প্রশিক্ষণ রেজিস্ট্রেশন';
        $this->load->model('Common_model');
        $this->load->model('Training_entry_model');
        $this->load->model('personal_datas/Personal_datas_model');
    }

    public function index(){
        redirect(base_url('Training_entry/add'));
    }

    public function add(){

        if($this->input->get('submit')){
            if($this->Common_model->exists('personal_datas', 'national_id', $this->input->get('national_id'))){
                $data_id = $this->Training_entry_model->get_data_id($this->input->get('national_id'));
                $results = $this->Personal_datas_model->get_info($data_id);
                $this->data['info'] = $results['info'];
                $this->data['nilg_training'] = $results['nilg_training'];
            }else{
                $this->data['info'] = 0;
            }
        }else{
            $this->data['info'] = 0;
        }

        // Add training info
        //if ($this->input->post('Save')) {
          // submit button pressed
            //printr($this->input->post());
        //}

        $this->data['nilg_course'] = $this->Common_model->get_nilg_course();
        $this->data['designation'] = $this->Common_model->get_designation();

        $this->data['meta_title'] = 'এনআইএলজি থেকে প্রাপ্ত কোর্স অর্ন্তভুক্তি করণ';
        $this->data['subview'] = 'add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function ajax_nilg_training_add(){
        $message='';
        $this->form_validation->set_rules('course_id', 'course name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(                
                'data_id' => $this->input->post('hide_data_id'),
                'nilg_course_id' => $this->input->post('course_id'),
                'nilg_desig_id' => $this->input->post('desig_id'),
                'nilg_batch_no' => $this->input->post('nilg_batch_no'),
                'nilg_training_start' => $this->input->post('nilg_training_start'),
                'nilg_training_end' => $this->input->post('nilg_training_end')
                );    

            if($this->Common_model->save('per_nilg_training', $form_data)){   
                //$message = '<div class="alert alert-success">প্রদত্ত তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে</div>';
                $results = $this->Personal_datas_model->get_info($this->input->post('hide_data_id'));
                // $this->data['info'] = $results['info'];
                // $this->data['nilg_training'] = $results['nilg_training'];
                $message = '<table width="100%">';
                $message = '<tr><td><u>কোর্সের নাম</u></td><td width="50"><u>ব্যাচ নং</u></td><td width="80"><u>শুরুর তারিখ</u></td><td width="80"><u>শেষের তারিখ</u></td></tr>';
                foreach ($results['nilg_training'] as $row) {
                    
                    $batch_no = $row->nilg_batch_no != NULL ? $row->nilg_batch_no:'';
                    $training_start = $row->nilg_training_start != '0000-00-00' ? $row->nilg_training_start:''; 
                    $training_end = $row->nilg_training_end != '0000-00-00' ? $row->nilg_training_end:'';

                    $message .= '<tr> 
                                <td> <i class="fa fa-check"></i> <strong>'. $row->course_title .'</strong></td> <td>'.$batch_no.'</td> <td>'.$training_start.'</td> <td>'.$training_end.'</td></tr>';
                }
                $message .= '</table>';
            }
        }
        // echo $message = (validation_errors()) ? validation_errors() : $message;
        echo $message;

    }

public function edit($id){
    $this->form_validation->set_rules('org_name', 'প্রতিষ্ঠানের নাম', 'required');
    $this->form_validation->set_rules('org_type_id', 'প্রতিষ্ঠানের ধরণ', 'trim');

    if ($this->form_validation->run() == true){
        $form_data = array(
            'org_name' => $this->input->post('org_name'),
            'org_type_id' => $this->input->post('org_type_id')
            );
            // print_r($form_data); exit;
        if($this->Common_model->edit('organizations', $id, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Update information successfully.');
            redirect('organizations');
        }
    }

    $this->data['office_type'] = $this->Common_model->get_office_type();


    $this->data['meta_title'] = 'প্রতিষ্ঠানের তথ্য সম্পাদন';
    $this->data['subview'] = 'edit';
    $this->load->view('backend/_layout_main', $this->data);
}

}