<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends Backend_Controller {
	
	public function __construct(){
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'প্রতিষ্ঠান';
        $this->load->model('Common_model');
        $this->load->model('Office_model');
    }


    public function index($offset=0){        
        //Manage list the users
        $limit = 50;
        
        $results = $this->Office_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        /*echo '<pre>';
        print_r($this->data['results']); exit;*/

        //pagination
        $this->data['pagination'] = create_pagination('nilg_setting/office/index/', $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type(); 
        // $this->data['office_type'][10] = 'জেলা রিসোর্স টিম';        
        $this->data['division'] = $this->Common_model->get_division();

        //Load page
        $this->data['meta_title'] = 'সকল অফিসের তালিকা';
        $this->data['subview'] = 'office/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add(){
        /*
        // Validation
        $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('office_name', 'অফিসের নাম', 'required|trim');

        // Based on office type validation
        if($this->input->post('office_type') == 1){
            // Union Parishad
            $this->form_validation->set_rules('division_id', 'division', 'required');
            $this->form_validation->set_rules('district_id', 'district', 'required');
            $this->form_validation->set_rules('upazila_id', 'upazila', 'required');            
            $this->form_validation->set_rules('union_id', 'union', 'required');            
        }elseif($this->input->post('office_type') == 2 || $this->input->post('office_type') == 3){
            // Upazila Parishad and Paurashava
            $this->form_validation->set_rules('division_id', 'division', 'required');
            $this->form_validation->set_rules('district_id', 'district', 'required');    
            $this->form_validation->set_rules('upazila_id', 'upazila', 'required');            
        }elseif($this->input->post('office_type') == 4){
            // Zila Parishad
            $this->form_validation->set_rules('division_id', 'division', 'required'); 
            $this->form_validation->set_rules('district_id', 'district', 'required');   
        }elseif($this->input->post('office_type') == 5){
            // City Corporation
            $this->form_validation->set_rules('division_id', 'division', 'required'); 
        }elseif($this->input->post('office_type') == 6){
            // Development Partner
            $this->form_validation->set_rules('dev_partner', 'উন্নয়ন সহযোগী', 'required|trim');
        }

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_type' => $this->input->post('office_type'),
                'office_name' => trim($this->input->post('office_name')),
                'division_id' => $this->input->post('division_id'),
                'district_id' => $this->input->post('district_id'),
                'upazila_id'  => $this->input->post('upazila_id'),
                'union_id'    => $this->input->post('union_id'),
                'partner_id'  => $this->input->post('dev_partner'),
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('office', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                // redirect('nilg_setting/office');
            }
        }
        */
        
        //Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['office_type'][10] = 'জেলা রিসোর্স টিম'; 
        // dd($this->data['office_type']);
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['dev_partner'] = $this->Common_model->get_development_partner();

        // View
        $this->data['meta_title'] = 'অফিস এন্ট্রি';
        $this->data['subview'] = 'office/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add_ajax(){
        // echo 'Hello'; exit;
        // Validation
        $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('office_name', 'অফিসের নাম', 'required|trim');

        // Based on office type validation
        if($this->input->post('office_type') == 1){
            // Union Parishad
            $this->form_validation->set_rules('division_id', 'division', 'required');
            $this->form_validation->set_rules('district_id', 'district', 'required');
            $this->form_validation->set_rules('upazila_id', 'upazila', 'required');            
            $this->form_validation->set_rules('union_id', 'union', 'required');            
        }elseif($this->input->post('office_type') == 2 || $this->input->post('office_type') == 3){
            // Upazila Parishad and Paurashava
            $this->form_validation->set_rules('division_id', 'division', 'required');
            $this->form_validation->set_rules('district_id', 'district', 'required');    
            $this->form_validation->set_rules('upazila_id', 'upazila', 'required');            
        }elseif($this->input->post('office_type') == 4){
            // Zila Parishad
            $this->form_validation->set_rules('division_id', 'division', 'required'); 
            $this->form_validation->set_rules('district_id', 'district', 'required');   
        }elseif($this->input->post('office_type') == 5){
            // City Corporation
            $this->form_validation->set_rules('division_id', 'division', 'required'); 
        }elseif($this->input->post('office_type') == 6){
            // Development Partner
            $this->form_validation->set_rules('dev_partner', 'উন্নয়ন সহযোগী', 'required|trim');
        }

        $message='';
        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_type' => $this->input->post('office_type'),
                'office_name' => trim($this->input->post('office_name')),
                'office_name_en' => $this->input->post('office_name_en'),
                'division_id' => $this->input->post('division_id'),
                'district_id' => $this->input->post('district_id'),
                'upazila_id'  => $this->input->post('upazila_id'),
                'union_id'    => $this->input->post('union_id'),
                'partner_id'  => $this->input->post('dev_partner'),
                );
            // $message = 'Ok';
            // print_r($form_data); exit;
            if($this->Common_model->save('office', $form_data)){     
                $message = '<div class="alert alert-success">প্রদত্ত তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে</div>';
                // $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                // redirect('nilg_setting/office');
            }
        }

        echo $message = (validation_errors()) ? validation_errors() : $message;
    }   

    public function edit($id){
        // Get Result
        $this->data['info'] = $this->Office_model->get_info($id);
        // dd($this->data['info']);

        // Validation
        $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('office_name', 'অফিসের নাম', 'required|trim');

        // Based on office type validation
        if($this->input->post('office_type') == 1){
            // Union Parishad
            $this->form_validation->set_rules('division_id', 'division', 'required');
            $this->form_validation->set_rules('district_id', 'district', 'required');
            $this->form_validation->set_rules('upazila_id', 'upazila', 'required');            
            $this->form_validation->set_rules('union_id', 'union', 'required');            
        }elseif($this->input->post('office_type') == 2 || $this->input->post('office_type') == 3){
            // Upazila Parishad and Paurashava
            $this->form_validation->set_rules('division_id', 'division', 'required');
            $this->form_validation->set_rules('district_id', 'district', 'required');    
            $this->form_validation->set_rules('upazila_id', 'upazila', 'required');            
        }elseif($this->input->post('office_type') == 4){
            // Zila Parishad
            $this->form_validation->set_rules('division_id', 'division', 'required'); 
            $this->form_validation->set_rules('district_id', 'district', 'required');   
        }elseif($this->input->post('office_type') == 5){
            // City Corporation
            $this->form_validation->set_rules('division_id', 'division', 'required'); 
        }elseif($this->input->post('office_type') == 6){
            // Development Partner
            $this->form_validation->set_rules('dev_partner', 'উন্নয়ন সহযোগী', 'required|trim');
        }

        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_type' => $this->input->post('office_type'),
                'office_name' => $this->input->post('office_name'),                
                'office_name_en' => $this->input->post('office_name_en'),                
                'division_id' => $this->input->post('division_id'),
                'district_id' => $this->input->post('district_id'),
                'upazila_id'  => $this->input->post('upazila_id'),
                'union_id'    => $this->input->post('union_id'),
                'partner_id'  => $this->input->post('dev_partner'),
                );
            
            if($this->Common_model->edit('office', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('nilg_setting/office');
            }
        }

        //Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        // $this->data['office_type'][10] = 'জেলা রিসোর্স টিম'; 
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        // $this->data['unions'] = $this->Common_model->get_union();
        $this->data['dev_partner'] = $this->Common_model->get_development_partner();


        $this->data['meta_title'] = 'প্রতিষ্ঠানের তথ্য সম্পাদন';
        $this->data['subview'] = 'office/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add_multi(){
        // Validation
        $this->form_validation->set_rules('office_type', 'অফিসের ধরণ', 'required|trim');
        $this->form_validation->set_rules('office_name[]', 'অফিসের নাম', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            /*echo '<pre>';
            print_r($_POST); exit;*/

            // Dynamic Row 
            for ($i = 0; $i < sizeof($_POST['office_name']); $i++) {
                $data = array(
                    'office_type' => $this->input->post('office_type'),
                    'office_name' => $_POST['office_name'][$i],
                    'division_id' => $this->input->post('division_id'),
                    'district_id' => $_POST['district_id'][$i],
                    'upazila_id' => $_POST['upazila_id'][$i],
                    'union_id' => $_POST['union_id'][$i]
                    );
                // print_r($data); exit;
                $this->Common_model->save('per_promotion', $data);
            }
            // Message
            $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
            redirect('nilg_setting/office');
        }
        
        //Dropdown List
        $this->data['office_type'] = $this->Common_model->get_office_type();
        $this->data['division'] = $this->Common_model->get_division();

        // View
        $this->data['meta_title'] = 'অফিস এন্ট্রি';
        $this->data['subview'] = 'office/add_multi';
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