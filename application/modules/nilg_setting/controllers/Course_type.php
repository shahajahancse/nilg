<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Course_type extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'কোর্স';

        $this->load->model('Common_model');
    }


    public function index($offset=0){
        //Manage list the users
        $limit = 50;
        $this->data['results'] = $this->db->limit($limit)->offset($offset)->order_by('id', 'ASC')->get('course_type')->result();

        // count query
        $q = $this->db->select('COUNT(*) as count')->get('course_type')->result();
        $this->data['total_rows'] = $q[0]->count;

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/course_type/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        //Load page
        $this->data['meta_title'] = 'কোর্সের তালিকা';
        $this->data['subview'] = 'course_type/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        $this->form_validation->set_rules('ct_name', 'কোর্সের টাইপ', 'required|trim');
        // $this->form_validation->set_rules('course_type', 'কোর্সের ধরণ', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'ct_name' => $this->input->post('ct_name'),
            );

            if($this->Common_model->save('course_type', $form_data)){                
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('nilg_setting/course_type');
            }
        }

        //Load view
        $this->data['meta_title'] = 'কোর্সের টাইপ';
        $this->data['subview'] = 'course_type/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $this->form_validation->set_rules('ct_name', 'কোর্সের টাইপ', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'ct_name' => $this->input->post('ct_name')
            );

            if($this->Common_model->edit('course_type', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/course_type');
            }
        }
        
        // Get Data        
        $this->data['info'] = $this->db->where('id', $id)->get('course_type')->row();

        //Load View
        $this->data['meta_title'] = 'কোর্সের টাইপ সম্পাদন';
        $this->data['subview'] = 'course_type/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($dataID){
        if ($this->db->delete('course_type', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('nilg_setting/course_type');
        }
    }

}