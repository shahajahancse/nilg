<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organizations extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'প্রতিষ্ঠান';
		$this->load->model('Common_model');
        $this->load->model('Organizations_model');
    }


    public function index($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->Organizations_model->get_data($limit, $offset);

        $this->data['data_list'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('organizations/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Load page
        $this->data['meta_title'] = 'সকল প্রতিষ্ঠান';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
	}

	public function add(){
		$this->form_validation->set_rules('org_name', 'প্রতিষ্ঠানের নাম', 'required');
        $this->form_validation->set_rules('org_type_id', 'প্রতিষ্ঠানের ধরণ', 'trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
            		'org_name' => $this->input->post('org_name'),
                    'org_type_id' => $this->input->post('org_type_id')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('organizations', $form_data)){                
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('organizations');
            }
        }

        // $this->data['districts'] = $this->Common_model->get_district();    
        $this->data['office_type'] = $this->Common_model->get_office_type();

		$this->data['meta_title'] = 'প্রতিষ্ঠানের নাম এন্ট্রি';
		$this->data['subview'] = 'add';
    	$this->load->view('backend/_layout_main', $this->data);
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

		$this->data['info'] = $this->Organizations_model->get_info($id);

		$this->data['meta_title'] = 'প্রতিষ্ঠানের তথ্য সম্পাদন';
		$this->data['subview'] = 'edit';
    	$this->load->view('backend/_layout_main', $this->data);
	}

    public function delete($dataID){
        //$thismodel=$this->this_model();
        //$id = $this->input->get('id'); 

        //$dataID = (int) decrypt_url($id); //exit;
        //if(!$this->Common_model->exists('personal_datas', 'id', $dataID)){
            //show_404('personal_datas - edit - exists', TRUE);
        //}
            
        if ($this->db->delete('organizations', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('organizations');
        }
    }

}