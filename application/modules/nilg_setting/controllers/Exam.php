<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'পরীক্ষা';
        $this->load->model('Common_model');
        $this->load->model('Exam_model');
    }


    public function index($offset=0){        
        // Manage list the users
        $limit = 50;
        
        $results = $this->Exam_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/exam/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Dropdown List
        // $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();

        //Load page
        $this->data['meta_title'] = 'সকল পরীক্ষার তালিকা';
        $this->data['subview'] = 'exam/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        // Validation
        $this->form_validation->set_rules('exam_name', 'পরীক্ষার নাম', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'exam_name' => $this->input->post('exam_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('exam', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                redirect('nilg_setting/exam');
            }
        }
        
        // Dropdown List        
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'পরীক্ষার নাম এন্ট্রি';
        $this->data['subview'] = 'exam/add';
        $this->load->view('backend/_layout_main', $this->data);
    }       

    public function edit($id){
        // Get Info
        $this->data['info'] = $this->Exam_model->get_info($id);

        // Validation
        $this->form_validation->set_rules('exam_name', 'পরীক্ষার নাম', 'required|trim');        

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'exam_name' => $this->input->post('exam_name'),
                'status'    => $this->input->post('status')
                );
            // dd($form_data); exit;
            if($this->Common_model->edit('exam', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/exam');
            }
        }

        // Dropdown List
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'পরীক্ষার তথ্য সম্পাদন';
        $this->data['subview'] = 'exam/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*
    public function delete($dataID){
        //$thismodel=$this->this_model();
        //$id = $this->input->get('id'); 

        //$dataID = (int) decrypt_url($id); //exit;
        //if(!$this->Common_model->exists('personal_datas', 'id', $dataID)){
            //show_404('personal_datas - edit - exists', TRUE);
        //}

        if ($this->db->delete('exam', array('id' => $dataID))) {
            $this->session->set_flashdata('success', 'Deleted Successful'); 
            redirect('nilg_setting/exam');
        }
    }
    */

}