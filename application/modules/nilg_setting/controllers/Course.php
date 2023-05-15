<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'কোর্স';

        $this->load->model('Common_model');
        $this->load->model('Course_model');
    }


    public function index($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->Course_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/course/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');
        
        //Load page
        $this->data['meta_title'] = 'কোর্সের তালিকা';
        $this->data['subview'] = 'course/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        $this->form_validation->set_rules('course_title', 'কোর্সের নাম', 'required|trim');
        // $this->form_validation->set_rules('course_type', 'কোর্সের ধরণ', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'course_title' => $this->input->post('course_title'),
                // 'course_type' => $this->input->post('course_type')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('course', $form_data)){                
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('nilg_setting/course');
            }
        }

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');

        //Load view
        $this->data['meta_title'] = 'প্রশিক্ষণের তথ্য';
        $this->data['subview'] = 'course/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $this->form_validation->set_rules('course_title', 'কোর্সের নাম', 'required|trim');
        // $this->form_validation->set_rules('course_type', 'কোর্সের ধরণ', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'course_title' => $this->input->post('course_title')
                );
            // print_r($form_data); exit;
            if($this->Common_model->edit('course', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/course');
            }
        }
        
        // Get Data        
        $this->data['info'] = $this->Course_model->get_info($id);

        //Load View
        $this->data['meta_title'] = 'কোর্সের তথ্য সম্পাদন';
        $this->data['subview'] = 'course/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($dataID){
        //$thismodel=$this->this_model();
        //$id = $this->input->get('id'); 

        //$dataID = (int) decrypt_url($id); //exit;
        //if(!$this->Common_model->exists('personal_datas', 'id', $dataID)){
            //show_404('personal_datas - edit - exists', TRUE);
        //}
            
        if ($this->db->delete('course', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('nilg_setting/course');
        }
    }

}