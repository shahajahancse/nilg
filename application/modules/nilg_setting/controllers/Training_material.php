<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Training_material extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'কোর্স';

        $this->load->model('Common_model');
        $this->load->model('Material_model');
    }


    public function index($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->Material_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/training_material/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');
        
        //Load page
        $this->data['meta_title'] = 'ট্রেনিং মেটেরিয়ালের তালিকা';
        $this->data['subview'] = 'training_material/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        $this->form_validation->set_rules('material_name', 'ট্রেনিং মেটেরিয়াল', 'required|trim');
        // $this->form_validation->set_rules('course_type', 'কোর্সের ধরণ', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'material_name' => $this->input->post('material_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('material', $form_data)){                
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('nilg_setting/training_material');
            }
        }

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');

        //Load view
        $this->data['meta_title'] = 'ট্রেনিং মেটেরিয়ালের তথ্য এন্ট্রি করুন';
        $this->data['subview'] = 'training_material/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $this->form_validation->set_rules('material_name', 'ট্রেনিং মেটেরিয়াল', 'required|trim');
        // $this->form_validation->set_rules('course_type', 'কোর্সের ধরণ', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'material_name' => $this->input->post('material_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->edit('material', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/training_material');
            }
        }
        
        // Get Data        
        $this->data['info'] = $this->Material_model->get_info($id);

        //Load View
        $this->data['meta_title'] = 'ট্রেনিং মেটেরিয়ালের তথ্য সংশোধন করুন';
        $this->data['subview'] = 'training_material/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($dataID){
        //$thismodel=$this->this_model();
        //$id = $this->input->get('id'); 

        //$dataID = (int) decrypt_url($id); //exit;
        //if(!$this->Common_model->exists('personal_datas', 'id', $dataID)){
            //show_404('personal_datas - edit - exists', TRUE);
        //}
            
        if ($this->db->delete('material', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('nilg_setting/training_material');
        }
    }

}