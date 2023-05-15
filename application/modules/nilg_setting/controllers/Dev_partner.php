<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dev_partner extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'পদবি';
        $this->load->model('Common_model');
        $this->load->model('Dev_partner_model');
    }


    public function index($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Dev_partner_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/dev_partner/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Dropdown List
        // $this->data['office_type'] = $this->Common_model->get_office_type();
        $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();

        //Load page
        $this->data['meta_title'] = 'সকল সংস্থার তালিকা';
        $this->data['subview'] = 'dev_partner/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        // Validation
        $this->form_validation->set_rules('org_type', 'সংস্থার ধরণ ', 'required|trim');
        $this->form_validation->set_rules('partner_name_full_bn', 'সংস্থার পূর্ণ নাম (বাংলা)', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'org_type' => $this->input->post('org_type'),
                'partner_name_full_bn' => $this->input->post('partner_name_full_bn'),
                'partner_name_short_bn' => $this->input->post('partner_name_short_bn'),
                'partner_name_full_en' => $this->input->post('partner_name_full_en'),
                'partner_name_short_en' => $this->input->post('partner_name_short_en')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('development_partner', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/dev_partner');
            }
        }
        
        // Dropdown List        
        $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'সংস্থা এন্ট্রি';
        $this->data['subview'] = 'dev_partner/add';
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){
        // Get Info
        $this->data['info'] = $this->Dev_partner_model->get_info($id);

        // Validation
        $this->form_validation->set_rules('org_type', 'সংস্থার ধরণ ', 'required|trim');
        $this->form_validation->set_rules('partner_name_full_bn', 'সংস্থার পূর্ণ নাম (বাংলা)', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'org_type'              => $this->input->post('org_type'),
                'partner_name_full_bn'  => $this->input->post('partner_name_full_bn'),
                'partner_name_short_bn' => $this->input->post('partner_name_short_bn'),
                'partner_name_full_en'  => $this->input->post('partner_name_full_en'),
                'partner_name_short_en' => $this->input->post('partner_name_short_en'),
                'status'                => $this->input->post('status')
                );
            // dd($form_data); exit;
            if($this->Common_model->edit('development_partner', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/dev_partner');
            }
        }


        //Dropdown List
        $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'সংস্থার তথ্য সম্পাদন';
        $this->data['subview'] = 'dev_partner/edit';
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
            redirect('nilg_setting/dev_partner');
        }
    }

}