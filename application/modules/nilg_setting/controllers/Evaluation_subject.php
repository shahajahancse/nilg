<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation_subject extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'মূল্যায়নের বিষয়';
        $this->load->model('Common_model');
        $this->load->model('Evaluation_subject_model');
    }


    public function index($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Evaluation_subject_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        // pagination
        $this->data['pagination'] = create_pagination('nilg_setting/evaluation_subject/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Load page
        $this->data['meta_title'] = 'মূল্যায়নের সকল বিষয়';
        $this->data['subview'] = 'evaluation_subject/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        // Validation
        $this->form_validation->set_rules('subject_name', 'মূল্যায়নের বিষয়', 'required|trim');
        $this->form_validation->set_rules('mark_type_id', 'মার্কের ধরণ', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'subject_name' => $this->input->post('subject_name'),
                'mark_type_id'  => $this->input->post('mark_type_id')
                );
            // dd($form_data); exit;
            if($this->Common_model->save('evaluation_subject', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/evaluation_subject');
            }
        }

        // List
        $this->data['mark_type'] = $this->Common_model->get_evaluation_mark_type(); 
        
        // View
        $this->data['meta_title'] = 'মূল্যায়নের বিষয় এন্ট্রি';
        $this->data['subview'] = 'evaluation_subject/add';
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){
        // Get Info
        $this->data['info'] = $this->Evaluation_subject_model->get_info($id);

        // Validation
        $this->form_validation->set_rules('course_type[]', 'কোর্সের ধরণ', 'required|trim');
        $this->form_validation->set_rules('subject_name', 'মূল্যায়নের বিষয়', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'course_type'   => implode(',', $this->input->post('course_type')),
                'subject_name'  => $this->input->post('subject_name'),
                'mark_type_id'  => $this->input->post('mark_type_id')
                );
            // dd($form_data);
            if($this->Common_model->edit('evaluation_subject', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/evaluation_subject');
            }
        }

        // List
        $this->data['course_types'] = $this->Common_model->get_course_type_array();
        $this->data['mark_type'] = $this->Common_model->get_evaluation_mark_type(); 

        // View
        $this->data['meta_title'] = 'মূল্যায়নের বিষয় সম্পাদন';
        $this->data['subview'] = 'evaluation_subject/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*public function delete($dataID){
        //$thismodel=$this->this_model();
        //$id = $this->input->get('id'); 

        //$dataID = (int) decrypt_url($id); //exit;
        //if(!$this->Common_model->exists('personal_datas', 'id', $dataID)){
            //show_404('personal_datas - edit - exists', TRUE);
        //}

        if ($this->db->delete('designations', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('nilg_setting/dev_partner');
        }
    }*/

}