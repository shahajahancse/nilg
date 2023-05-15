<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'প্রতিষ্ঠান';
		$this->load->model('Common_model');
        $this->load->model('Designation_model');
    }


    public function index($offset=0){
        //Manage list the users
        $limit = 20;
        $results = $this->Designation_model->get_data($limit, $offset);

        $this->data['data_list'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('designation/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Load page
        $this->data['meta_title'] = 'সকল পদবি';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
	}

	public function add(){
		$this->form_validation->set_rules('desig_name', 'পদবির নাম', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
            		'desig_name' => $this->input->post('desig_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('designation', $form_data)){                
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('designation');
            }
        }

		$this->data['meta_title'] = 'পদবির নাম এন্ট্রি';
		$this->data['subview'] = 'add';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	public function edit($id){
		$this->form_validation->set_rules('desig_name', 'পদবির নাম', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
            		'desig_name' => $this->input->post('desig_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->edit('designation', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('designation');
            }
        }

		$this->data['info'] = $this->Designation_model->get_info($id);

		$this->data['meta_title'] = 'পদবির তথ্য সম্পাদন';
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
            
        if ($this->db->delete('designation', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('designation');
        }
    }

}