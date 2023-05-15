<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'পদবি';
        $this->load->model('Common_model');
        $this->load->model('Designation_model');
    }


    public function index($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Designation_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/designation/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        $this->data['employee_type'] = $this->Common_model->get_employee_type();

        //Load page
        $this->data['meta_title'] = 'সকল পদবির তালিকা';
        $this->data['subview'] = 'designation/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        // Validation
        $this->form_validation->set_rules('office_type[]', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('desig_name', 'অফিসের নাম', 'required|trim');
        $this->form_validation->set_rules('employee_type', 'এমপ্লয়ীর ধরণ', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                // 'office_type' => $this->input->post('office_type'),
                'offices' => implode(',', $this->input->post('office_type')),
                'desig_name' => $this->input->post('desig_name'),
                'employee_type' => $this->input->post('employee_type')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('designations', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/designation');
            }
        }
        
        // Dropdown List
        $this->data['offices'] = $this->Common_model->get_office_type_array();
        // dd($this->data['offices']);
        $this->data['employee_type'] = $this->Common_model->get_employee_type();
        // $this->data['office_type'] = (array) $this->Common_model->get_office_type();

        // View
        $this->data['meta_title'] = 'পদবি এন্ট্রি';
        $this->data['subview'] = 'designation/add';
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){
        // Get Info
        $this->data['info'] = $this->Designation_model->get_info($id);

        // Validation
        $this->form_validation->set_rules('office_type[]', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('desig_name', 'অফিসের নাম', 'required|trim');
        $this->form_validation->set_rules('employee_type', 'এমপ্লয়ীর ধরণ', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'offices' => implode(',', $this->input->post('office_type')),
                'desig_name' => $this->input->post('desig_name'),
                'so' => $this->input->post('so'),
                'employee_type' => $this->input->post('employee_type')
                );
            // dd($form_data); exit;
            if($this->Common_model->edit('designations', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/designation');
            }
        }


        //Dropdown List
        $this->data['offices'] = $this->Common_model->get_office_type_array();
        // dd($this->data['offices']);
        $this->data['employee_type'] = $this->Common_model->get_employee_type();

        // View
        $this->data['meta_title'] = 'পদবি সম্পাদন';
        $this->data['subview'] = 'designation/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($dataID){
        //$thismodel=$this->this_model();
        //$id = $this->input->get('id'); 

        //$dataID = (int) decrypt_url($id); //exit;
        //if(!$this->Common_model->exists('personal_datas', 'id', $dataID)){
            //show_404('personal_datas - edit - exists', TRUE);
        //}

        if ($this->db->delete('designations', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('nilg_setting/designation');
        }
    }

}