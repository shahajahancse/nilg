<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_setting extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('General_setting_model');

        $this->data['module_name'] = 'General Setting';
    }

    public function index(){
        redirect('general_setting/upazila_thana');
    }

    public function board($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_board_institute($limit, $offset);
        //echo "<pre>"; print_r($results); exit; 

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/board/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);        
        
        // Load page
        $this->data['meta_title'] = 'সকল বোর্ড / বিশ্ববিদ্যালয়ের তালিকা';
        $this->data['subview'] = 'board/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function board_add(){
        // Validation
        $this->form_validation->set_rules('board_institute_name', 'বোর্ড / বিশ্ববিদ্যালয়ের নাম', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'board_institute_name' => $this->input->post('board_institute_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('board_institute', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                redirect('general_setting/board');
            }
        }
        
        // Dropdown List        
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'বোর্ড / বিশ্ববিদ্যালয়ের নাম এন্ট্রি';
        $this->data['subview'] = 'board/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function board_edit($id){
        // Get Info
        $this->data['info'] = $this->General_setting_model->get_info('board_institute', $id);

        // Validation
        $this->form_validation->set_rules('board_institute_name', 'পরীক্ষার নাম', 'required|trim');        

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'board_institute_name' => $this->input->post('board_institute_name'),
                'status'    => $this->input->post('status')
                );
            // dd($form_data); exit;
            if($this->Common_model->edit('board_institute', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('general_setting/board');
            }
        }

        // Dropdown List
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'পরীক্ষার বিষয়ের তথ্য সম্পাদন';
        $this->data['subview'] = 'board/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function subject($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_subject($limit, $offset);
        //echo "<pre>"; print_r($results); exit; 

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/subject/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);        
        
        // Load page
        $this->data['meta_title'] = 'সকল পরীক্ষার বিষয়ের তালিকা';
        $this->data['subview'] = 'subject/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function subject_add(){
        // Validation
        $this->form_validation->set_rules('subject_name', 'পরীক্ষার বিষয়ের নাম', 'required|trim');

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'subject_name' => $this->input->post('subject_name')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('subject', $form_data)){                
                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে');
                redirect('general_setting/subject');
            }
        }
        
        // Dropdown List        
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'পরীক্ষার বিষয়ের নাম এন্ট্রি';
        $this->data['subview'] = 'subject/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function subject_edit($id){
        // Get Info
        $this->data['info'] = $this->General_setting_model->get_info('subject', $id);

        // Validation
        $this->form_validation->set_rules('subject_name', 'পরীক্ষার নাম', 'required|trim');        

        // Insert Data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'subject_name' => $this->input->post('subject_name'),
                'status'    => $this->input->post('status')
                );
            // dd($form_data); exit;
            if($this->Common_model->edit('subject', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('general_setting/subject');
            }
        }

        // Dropdown List
        // $this->data['org_type'] = $this->Common_model->get_dev_partner_org_type();
        // dd($this->data['org_type']);

        // View
        $this->data['meta_title'] = 'পরীক্ষার বিষয়ের তথ্য সম্পাদন';
        $this->data['subview'] = 'subject/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function exam($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_exam($limit, $offset);
        //echo "<pre>"; print_r($results); exit; 

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/exam/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);        
        
        // Load page
        $this->data['meta_title'] = 'সকল পরীক্ষার তালিকা';
        $this->data['subview'] = 'exam/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function exam_add(){
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
                redirect('general_setting/exam');
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

    public function exam_edit($id){
        // Get Info
        $this->data['info'] = $this->General_setting_model->get_info('exam', $id);

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
                redirect('general_setting/exam');
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

    public function pourashava($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_pourashava($limit, $offset);
        //echo "<pre>"; print_r($results); exit; 

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/pourashava/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // $this->data['upazilas'] = $this->Common_model->get_dropdown('upazilas', 'upa_name_bn', 'id');

        //echo "<pre>";  print_r($this->data['results']); exit;

        $this->data['division'] = $this->Common_model->get_division();
        
        // Load page
        $this->data['meta_title'] = 'All Pourashava';
        $this->data['subview'] = 'pourashava';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pourashava_add(){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('upazila', 'upazila', 'required|trim');
        $this->form_validation->set_rules('pou_name_bn', 'Pourashava Name English', 'required|trim');
        $this->form_validation->set_rules('pou_name_en', 'Pourashava Name Bangla', 'trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'pou_div_id'     => $this->input->post('division'),
                'pou_dis_id'     => $this->input->post('district'),
                'pou_upa_id'    => $this->input->post('upazila'),
                'pou_name_bn'    => $this->input->post('pou_name_bn'),
                'pou_name_en'    => $this->input->post('pou_name_en')
                );           
            // print_r($form_data); exit;
            if($this->Common_model->save('pourashava', $form_data)){
                $this->session->set_flashdata('success', 'Pourashava create successfully.');
                redirect('general_setting/pourashava');                
            }
        }

        $this->data['division'] = $this->Common_model->get_division();
        // $this->data['district'] = $this->Common_model->get_district();

        //Load View
        $this->data['meta_title'] = 'Add Pourashava';
        $this->data['subview'] = 'pourashava_add';
        $this->load->view('backend/_layout_main', $this->data);
    }    



    public function union($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_union($limit, $offset);
        //echo "<pre>"; print_r($results); exit; 

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/union/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['upazilas'] = $this->Common_model->get_dropdown('upazilas', 'upa_name_bn', 'id');

        //echo "<pre>";  print_r($this->data['results']); exit;

        $this->data['division'] = $this->Common_model->get_division();
        
        // Load page
        $this->data['meta_title'] = 'All Union';
        $this->data['subview'] = 'union';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function union_edit($id){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('upazila', 'upazila', 'required|trim');
        $this->form_validation->set_rules('uni_name_bn', 'Union Name English', 'required|trim');
        $this->form_validation->set_rules('uni_name_en', 'Union Name Bangla', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'uni_div_id'     => $this->input->post('division'),
                'uni_dis_id'     => $this->input->post('district'),
                'uni_upa_id'     => $this->input->post('upazila'),
                'uni_name_bn'    => $this->input->post('uni_name_bn'),
                'uni_name_en'    => $this->input->post('uni_name_en'),
                'status'         => $this->input->post('status')
                );           
            // print_r($form_data); exit;
            if($this->Common_model->edit('unions',$id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/union');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('unions', $id);

        //Dropdown
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();
        $this->data['upazila'] = $this->Common_model->get_upazila_thana();
        //Load View
        $this->data['meta_title'] = 'Update Union';
        $this->data['subview'] = 'union_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function union_add(){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('upazila', 'upazila', 'required|trim');
        $this->form_validation->set_rules('uni_name_bn', 'Union Name English', 'required|trim');
        $this->form_validation->set_rules('uni_name_en', 'Union Name Bangla', 'trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'uni_div_id'     => $this->input->post('division'),
                'uni_dis_id'     => $this->input->post('district'),
                'uni_upa_id'     => $this->input->post('upazila'),
                'uni_name_bn'    => $this->input->post('uni_name_bn'),
                'uni_name_en'    => $this->input->post('uni_name_en')
                );           
            // print_r($form_data); exit;
            if($this->Common_model->save('unions', $form_data)){
                $this->session->set_flashdata('success', 'Union create successfully.');
                // redirect('general_setting/union');
                
            }
        }

        $this->data['division'] = $this->Common_model->get_division();
        // $this->data['district'] = $this->Common_model->get_district();

        //Load View
        $this->data['meta_title'] = 'Add Union';
        $this->data['subview'] = 'union_add';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function upazila_thana($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_upazila_thana($limit, $offset);
        // echo $this->db->last_query(); exit;
        // print_r($results); exit;

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/upazila_thana/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['division'] = $this->Common_model->get_division();
        // $this->data['district'] = $this->Common_model->get_district();

        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Upazila Thana';
        $this->data['subview'] = 'upazila_thana';
        $this->load->view('backend/_layout_main', $this->data);
    }     

    public function upazila_thana_add(){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('upa_name_en', 'Upazila/Thana Name English', 'required|trim');
        $this->form_validation->set_rules('upa_name_bn', 'Upazila/Thana Name Bangla', 'trim');
        $this->form_validation->set_rules('upa_bbs_code', 'Upazila/Thana  GEO Code', 'min_length[2]|max_length[2]|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'upa_div_id'     => $this->input->post('division'),
                'upa_dis_id'     => $this->input->post('district'),
                'upa_name_en'    => $this->input->post('upa_name_en'),
                'upa_name_bn'    => $this->input->post('upa_name_bn'),
                'upa_bbs_code'   => $this->input->post('upa_bbs_code')?$this->input->post('upa_bbs_code'):NULL
                );           
            // print_r($form_data); exit;
            if($this->Common_model->save('upazilas', $form_data)){
                $this->session->set_flashdata('success', 'Upazila/Thana  create successfully.');
                redirect('general_setting/upazila_thana');
            }
        }

        $this->data['division'] = $this->Common_model->get_division();
        // $this->data['district'] = $this->Common_model->get_district();

        //Load View
        $this->data['meta_title'] = 'Add Upazila/Thana';
        $this->data['subview'] = 'upazila_thana_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function upazila_thana_edit($id){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('upa_name_en', 'Upazila/Thana Name English', 'required|trim');
        $this->form_validation->set_rules('upa_name_bn', 'Upazila/Thana Name Bangla', 'trim');
        $this->form_validation->set_rules('upa_bbs_code', 'Upazila/Thana  GEO Code', 'min_length[2]|max_length[2]|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'upa_div_id'     => $this->input->post('division'),
                'upa_dis_id'     => $this->input->post('district'),
                'upa_name_en'    => $this->input->post('upa_name_en'),
                'upa_name_bn'    => $this->input->post('upa_name_bn'),
                'upa_bbs_code'   => $this->input->post('upa_bbs_code')?$this->input->post('upa_bbs_code'):NULL,
                'status'         => $this->input->post('status')
                );           
            // print_r($form_data); exit;
            if($this->Common_model->edit('upazilas',$id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/upazila_thana');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('upazilas', $id);

        //Dropdown
        $this->data['division'] = $this->Common_model->get_division();
        $this->data['district'] = $this->Common_model->get_district();

        //Load View
        $this->data['meta_title'] = 'Update Upazila/Thana';
        $this->data['subview'] = 'upazila_thana_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function district($offset=0){
        //Manage list the users
        $limit = 20;
        $results = $this->General_setting_model->get_district($limit, $offset);
        // print_r($results); exit;

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/district/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['division'] = $this->Common_model->get_division();
        // print_r($this->data['results']); exit;

        // Load page
        $this->data['meta_title'] = 'All District';
        $this->data['subview'] = 'district';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function district_add(){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('dis_name_en', 'District Name English', 'trim');
        $this->form_validation->set_rules('dis_name_bn', 'District Name Bangla', 'required|trim');
        $this->form_validation->set_rules('district_geo', 'GEO Code', 'min_length[2]|max_length[2]|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'dis_div_id'    => $this->input->post('division'),
                'dis_name_en'   => $this->input->post('dis_name_en'),
                'dis_name_bn'   => $this->input->post('dis_name_bn'),
                'dis_bbs_code'  => $this->input->post('district_geo')?$this->input->post('district_geo'):NULL
                );           
            // print_r($form_data); exit;
            if($this->Common_model->save('districts', $form_data)){
                $this->session->set_flashdata('success', 'District create successfully.');
                redirect('general_setting/district');
            }
        }

        $this->data['division'] = $this->Common_model->get_division();

        // Load page
        $this->data['meta_title'] = 'Create District';
        $this->data['subview'] = 'district_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function district_edit($id){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('dis_name_en', 'District Name English', 'trim');
        $this->form_validation->set_rules('dis_name_bn', 'District Name Bangla', 'required|trim');
        // $this->form_validation->set_rules('district_geo', 'GEO Code', 'min_length[2]|max_length[2]|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'dis_div_id'    => $this->input->post('division'),
                'dis_name_en'   => $this->input->post('dis_name_en'),
                'dis_name_bn'   => $this->input->post('dis_name_bn'),
                'dis_bbs_code'  => $this->input->post('district_geo')?$this->input->post('district_geo'):NULL,
                'status'        => $this->input->post('status')
                );           
            // print_r($form_data); exit;
            if($this->Common_model->edit('districts',$id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/district');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('districts', $id);
        $this->data['division'] = $this->Common_model->get_division();
        // print_r($this->data); exit;

        // Load page
        $this->data['meta_title'] = 'Edit District';
        $this->data['subview'] = 'district_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // public function upazila_thana(){
    //     $this->data['results'] = $this->General_setting_model->get_upazila_thana(); 

    //     // print_r($this->data['results']); exit;
    //     // Load page
    //     $this->data['meta_title'] = 'All Upazila Thana';
    //     $this->data['subview'] = 'upazila_thana';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    // public function post_office(){
    //     $this->data['results'] = $this->General_setting_model->get_post_office(); 
    //     // print_r($this->data['results']); exit;
    //     // Load page
    //     $this->data['meta_title'] = 'All Post Office';
    //     $this->data['subview'] = 'post_office';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    // public function division(){
    //     $this->data['results'] = $this->General_setting_model->get_division(); 
    //     // print_r($this->data['results']); exit;
    //     // Load page
    //     $this->data['meta_title'] = 'All Division';
    //     $this->data['subview'] = 'division';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    public function division(){
        $this->data['results'] = $this->General_setting_model->get_division(); 
        $this->data['meta_title'] = 'All Division';
        $this->data['subview'] = 'division';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function division_add(){
        $this->form_validation->set_rules('div_name_en', 'Division Name English', 'required|trim');
        $this->form_validation->set_rules('div_name_bn', 'Division Name Bangla', 'trim');
        $this->form_validation->set_rules('div_geo_code', 'GEO Code', 'min_length[2]|max_length[2]|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'div_name_en'   => $this->input->post('div_name_en'),
                'div_name_bn'   => $this->input->post('div_name_bn'),
                'div_bbs_code'  =>  $this->input->post('div_geo_code')?$this->input->post('div_geo_code'):NULL
                );           

            // print_r($form_data); exit;
            if($this->Common_model->save('divisions', $form_data)){
                $this->session->set_flashdata('success', 'Division create successfully.');
                redirect('general_setting/division');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Division';
        $this->data['subview'] = 'division_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function division_edit($id){
        $this->form_validation->set_rules('div_name_en', 'Division Name English', 'required|trim');
        $this->form_validation->set_rules('div_name_bn', 'Division Name Bangla', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('div_geo_code', 'GEO Code', 'max_length[2]|min_length[2]|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'div_name_en'   => $this->input->post('div_name_en'),
                'div_name_bn'   => $this->input->post('div_name_bn'),
                'div_bbs_code'  =>  $this->input->post('div_geo_code')?$this->input->post('div_geo_code'):NULL,
                'status'        => $this->input->post('status'),
                );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('divisions',$id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/division');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('divisions', $id);
        // echo $this->db->last_query();
        // echo $id;
        // print_r($this->data['info']); exit;

        // Load page
        $this->data['meta_title'] = 'Edit Division';
        $this->data['subview'] = 'division_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function statistics(){
        $this->data['results'] = $this->General_setting_model->get_statistics(); 
        $this->data['meta_title'] = 'স্থানীয় সরকার প্রতিষ্ঠানের পরিসংখ্যান';
        $this->data['subview'] = 'statistics';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function statistics_edit($id){
        $this->form_validation->set_rules('city', 'city corporation', 'required|trim');
        // echo 'hello'; exit;
        if ($this->form_validation->run() == true){
            $form_data = array(
                'city'   => bng2eng($this->input->post('city')),
                'pourasava'   => bng2eng($this->input->post('pourasava')),
                'zila'   => bng2eng($this->input->post('zila')),
                'upazila'   => bng2eng($this->input->post('upazila')),
                'unionp'   => bng2eng($this->input->post('unionp'))
                );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('statistics',$id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/statistics');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('statistics', $id);
        // echo $this->db->last_query();
        // echo $id;
        // print_r($this->data['info']); exit;

        // Load page
        $this->data['meta_title'] = 'স্থানীয় সরকার প্রতিষ্ঠানের পরিসংখ্যান সংশোধন';
        $this->data['subview'] = 'statistics_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function financing(){
        $this->data['results'] = $this->General_setting_model->get_financing(); 
        $this->data['meta_title'] = 'All Financing Name';
        $this->data['subview'] = 'financing';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function financing_add(){
        $this->form_validation->set_rules('finance_name', 'Finance name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'finance_name'   => $this->input->post('finance_name')
                );           

            // print_r($form_data); exit;
            if($this->Common_model->save('financing', $form_data)){
                $this->session->set_flashdata('success', 'Data create successfully.');
                redirect('general_setting/financing');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Finance Name';
        $this->data['subview'] = 'financing_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function financing_edit($id){
        $this->form_validation->set_rules('finance_name', 'Finance name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'finance_name'   => $this->input->post('finance_name')
                );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('financing',$id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/financing');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('financing', $id);
        // echo $this->db->last_query();
        // echo $id;
        // print_r($this->data['info']); exit;

        // Load page
        $this->data['meta_title'] = 'Edit Finance Name';
        $this->data['subview'] = 'financing_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


    function division_delete($id) {

        $form_data = array(
            'is_delete' => 1        
            ); 
        $this->data['info'] = $this->Common_model->edit('division',$id,'id',$form_data);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/division');
    }

    function district_delete($id) {
        $form_data = array(
            'is_delete' => 1        
            ); 
        $this->data['info'] = $this->Common_model->edit('district',$id,'id',$form_data);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/district');
    }


    function upazila_thana_delete($id) {
        $form_data = array(
            'is_delete' => 1        
            ); 
        $this->data['info'] = $this->Common_model->edit('upazila_thana',$id,'id',$form_data);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/upazila_thana');
    }


 //    public function district(){
 //        $this->data['results'] = $this->General_setting_model->get_district(); 
 //        // print_r($this->data['results']); exit;
 //        // Load page
 //        $this->data['meta_title'] = 'All District';
 //        $this->data['subview'] = 'district';
 //        $this->load->view('backend/_layout_main', $this->data);
 //    }


 //    public function edit($id){

 //        $this->form_validation->set_rules('title', 'course title', 'required|trim');
 //        $this->form_validation->set_rules('slug', 'course slug', 'required|trim');
 //        $this->form_validation->set_rules('short_desc', 'course short description', 'required|max_length[1000]|trim');

 //        $this->data['info'] = $this->Scouts_setting_model->get_info($id);
 //        // print_r($this->data['info']); exit;

 //        if ($this->form_validation->run() == true){

 //            $form_data = array(
 //                'title' => $this->input->post('title'),
 //                'slug' => $this->input->post('slug'),
 //                'short_desc' => $this->input->post('short_desc'),
 //                'meta_keys' => $this->input->post('meta_keys')?$this->input->post('meta_keys'):NULL
 //            );           

 //            // print_r($form_data); exit;
 //            if($this->Common_model->edit('users', $id, 'id', $form_data)){
 //                $this->session->set_flashdata('success', 'Information update successfully.');
 //                redirect('all');
 //            }
 //        }

 //        $this->data['meta_title'] = 'Edit Scouts Member';
 //        $this->data['subview'] = 'edit';
 //        $this->load->view('backend/_layout_main', $this->data);
 //    }


	// public function unit_office_add(){
	// 	$this->form_validation->set_rules('title', 'course title', 'required|trim'); 
 //        $this->form_validation->set_rules('slug', 'course slug', 'required|trim');          
 //        $this->form_validation->set_rules('short_desc', 'course short description', 'required|max_length[1000]|trim');

 //        if ($this->form_validation->run() == true){

 //            $form_data = array(
 //                'title' => $this->input->post('title'),
 //                'slug' => $this->input->post('slug'),
 //                'short_desc' => $this->input->post('short_desc'),
 //                'meta_keys' => $this->input->post('meta_keys')?$this->input->post('meta_keys'):NULL           
 //            );          

 //            // print_r($form_data); exit;

 //            if($this->Common_model->save('users', $form_data)){                
 //                $this->session->set_flashdata('success', 'New scouts member insert successfully.');
 //               redirect("all");
 //            }
 //        }

	// 	$this->data['meta_title'] = 'Add';
	// 	$this->data['subview'] = 'unit_office_add';
 //    	$this->load->view('backend/_layout_main', $this->data);
	// }

 //    public function upazila_thana_add(){
 //        $this->form_validation->set_rules('division', 'division', 'required|trim'); 
 //        $this->form_validation->set_rules('district', 'district', 'required|trim');          
 //        $this->form_validation->set_rules('up_th_name', 'upazial/thana english', 'required|trim');
 //        $this->form_validation->set_rules('up_th_name_bn', 'upazial/thana bangla', 'required|trim');

 //        if ($this->form_validation->run() == true){

 //            $form_data = array(
 //                'div_id' => $this->input->post('division'),
 //                'dis_id' => $this->input->post('district'),
 //                'up_th_name' => $this->input->post('up_th_name'),
 //                'up_th_name_bn' => $this->input->post('up_th_name_bn')
 //            );

 //            // print_r($form_data); exit;

 //            if($this->Common_model->save('upazila_thana', $form_data)){
 //                $this->session->set_flashdata('success', 'New data insert successfully.');
 //               redirect("general_setting/upazila_thana");
 //            }
 //        }

 //        $this->data['divisions'] = $this->Common_model->get_division();         

 //        $this->data['meta_title'] = 'Add Upazila/Thana';
 //        $this->data['subview'] = 'upazila_thana_add';
 //        $this->load->view('backend/_layout_main', $this->data);
 //    }

 //    public function upazila_thana_edit($id){

 //        $this->form_validation->set_rules('division', 'division', 'required|trim'); 
 //        $this->form_validation->set_rules('district', 'district', 'required|trim');          
 //        $this->form_validation->set_rules('up_th_name', 'upazial/thana english', 'required|trim');
 //        $this->form_validation->set_rules('up_th_name_bn', 'upazial/thana bangla', 'required|trim');

 //        if ($this->form_validation->run() == true){

 //            $form_data = array(
 //                'div_id' => $this->input->post('division'),
 //                'dis_id' => $this->input->post('district'),
 //                'up_th_name' => $this->input->post('up_th_name'),
 //                'up_th_name_bn' => $this->input->post('up_th_name_bn')
 //            );

 //            // print_r($form_data); exit;
 //            if($this->Common_model->edit('upazila_thana', $id, 'id', $form_data)){
 //                $this->session->set_flashdata('success', 'Data update successfully.');
 //               redirect("general_setting/upazila_thana");
 //            }
 //        }

 //        $this->data['divisions'] = $this->Common_model->get_division();
 //        $this->data['districts'] = $this->Common_model->get_district();

 //        $this->data['info'] = $this->General_setting_model->get_up_th_info($id);      

 //        $this->data['meta_title'] = 'Update Upazila/Thana';
 //        $this->data['subview'] = 'upazila_thana_edit';
 //        $this->load->view('backend/_layout_main', $this->data);
 //    }


 //    function ajax_get_district($id){
 //        header('Content-Type: application/x-json; charset=utf-8');
 //        echo (json_encode($this->General_setting_model->get_district_by_div_id($id)));
 //    }

    // public function ajax_district_by_division($div_id){
    //     header('Content-Type: application/x-json; charset=utf-8');
    //     echo (json_encode($this->Common_model->get_dis_by_div_id($div_id)));
    // }

    // function delete($id) {
    //     $this->data['info'] = $this->Scouts_member_model->delete($id);
    //     $this->session->set_flashdata('success', 'Information delete successfully.');
    //     redirect('all');
    // }

    // category section
    public function categories(){
        $this->data['results'] = $this->General_setting_model->get_categories(); 
        $this->data['meta_title'] = 'ক্যাটাগরি তালিকা';
        $this->data['subview'] = 'categories';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function category_add(){
        $this->form_validation->set_rules('category_name', 'category Name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'category_name'      => $this->input->post('category_name'),
                'status'             => $this->input->post('status'),
                'is_delete'          => 0
            ); 

            if($this->Common_model->save('categories', $form_data)){
                $this->session->set_flashdata('success', 'ক্যাটাগরি যুক্ত করা হয়েছে.');
                redirect('general_setting/categories');
            }
        }

        $this->data['meta_title'] = 'ক্যাটাগরি এন্ট্রি করুন';
        $this->data['subview'] = 'category_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function category_edit($id){
        $this->form_validation->set_rules('category_name', 'category Name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'category_name' => $this->input->post('category_name'),
                'status'        => $this->input->post('status'),
            ); 

            if($this->Common_model->edit('categories',$id,'id',$form_data)){
                $this->session->set_flashdata('success', 'ক্যাটাগরি সম্পাদনা করা হয়েছে.');
                redirect('general_setting/categories');
            }
        }
        $this->data['rows'] = $this->General_setting_model->get_info('categories', $id);

        $this->data['meta_title'] = 'সাব ক্যাটাগরি এডিট করুন';
        $this->data['subview'] = 'category_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    // category section end

    // sub category section
    public function sub_categories(){
        $this->data['categories'] = $this->General_setting_model->get_categories();
        $this->data['results'] = $this->General_setting_model->get_sub_categories(); 
        $this->data['meta_title'] = 'সাব ক্যাটাগরি তালিকা';
        $this->data['subview'] = 'sub_categories';
        $this->load->view('backend/_layout_main', $this->data);
    } 

    public function sub_category_add(){
        $this->form_validation->set_rules('cate_id', 'select category', 'required|trim');
        $this->form_validation->set_rules('sub_cate_name', 'sub category Name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'cate_id'            => $this->input->post('cate_id'),
                'sub_cate_name'      => $this->input->post('sub_cate_name'),
                'status'      => $this->input->post('status'),
                'is_delete'          => 0
            ); 

            if($this->Common_model->save('sub_categories', $form_data)){
                $this->session->set_flashdata('success', 'সাব ক্যাটাগরি যুক্ত করা হয়েছে.');
                redirect('general_setting/sub_categories');
            }
        }

        $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
        $this->data['meta_title'] = 'সাব ক্যাটাগরি এন্ট্রি করুন';
        $this->data['subview'] = 'sub_category_add';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function sub_category_edit($id){
        $this->form_validation->set_rules('cate_id', 'select category', 'required|trim');
        $this->form_validation->set_rules('sub_cate_name', 'sub category Name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'cate_id'            => $this->input->post('cate_id'),
                'sub_cate_name'      => $this->input->post('sub_cate_name'),
                'status'      => $this->input->post('status'),
                'is_delete'          => 0
            ); 

            if($this->Common_model->edit('sub_categories',$id,'id',$form_data)){
                $this->session->set_flashdata('success', 'সাব ক্যাটাগরি সম্পাদনা করা হয়েছে.');
                redirect('general_setting/sub_categories');
            }
        }
        $this->data['rows'] = $this->General_setting_model->get_info('sub_categories', $id);
        $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');

        $this->data['meta_title'] = 'সাব ক্যাটাগরি এডিট করুন';
        $this->data['subview'] = 'sub_category_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function sub_category_delete($id)
    {
      $form_data = array(
            'is_delete' => 1        
            ); 
        $this->data['info'] = $this->Common_model->edit('sub_categories',$id,'id',$form_data);
        $this->session->set_flashdata('success', 'সাব ক্যাটাগরি সফলভাবে মুছে ফেলা হয়েছে.');
        redirect('general_setting/sub_categories');
    }
    //

    public function ajax_sub_category_list()
    {
        $this->db->select('sc.*, c.category_name');
        $this->db->from('sub_categories sc');
        $this->db->join('categories c', 'c.id=sc.cate_id');
        $this->db->where('sc.is_delete !=', 1);
        $this->db->where('sc.cate_id', $_GET['cate']);
        $this->data['results'] = $this->db->get()->result();

        $text = $this->load->view('ajax_sub_category_list', $this->data, TRUE);
        set_output($text); 
    }
    // sub category section end


    // item section here
    public function item_unit(){
      $this->data['results'] = $this->General_setting_model->get_item_unit(); 
      $this->data['meta_title'] = 'মালামালের একক তালিকা';
      $this->data['subview'] = 'item_unit';
      $this->load->view('backend/_layout_main', $this->data);
    }

    public function item_unit_add(){
        $this->form_validation->set_rules('unit_name', 'item Name', 'required|trim');
        if ($this->form_validation->run() == true){
            $form_data = array(
                'unit_name'      => $this->input->post('unit_name'),
                'status'         => $this->input->post('status'),
            ); 

            if($this->Common_model->save('item_unit', $form_data)){
                $this->session->set_flashdata('success', 'মালামালের একক যুক্ত করা হয়েছে.');
                redirect('general_setting/item_unit');
            }
        }

       $this->data['results'] = $this->General_setting_model->get_item_unit(); 
       $this->data['meta_title'] = 'মালামালের একক যুক্ত করুন';
       $this->data['subview'] = 'item_unit_add';
       $this->load->view('backend/_layout_main', $this->data);
    }

    public function item_unit_edit($id){
        $this->form_validation->set_rules('unit_name', 'item Name', 'required|trim');
        if ($this->form_validation->run() == true){
            $form_data = array(
                'unit_name'      => $this->input->post('unit_name'),
                'status'         => $this->input->post('status'),
            ); 

            if($this->Common_model->edit('item_unit',$id,'id',$form_data)){
                $this->session->set_flashdata('success', 'মালামালের একক সম্পাদনা করা হয়েছে.');
                redirect('general_setting/item_unit');
            }
        }

        $this->data['rows'] = $this->General_setting_model->get_info('item_unit', $id);
        $this->data['meta_title'] = 'মালামালের একক সম্পাদনা করুন';
        $this->data['subview'] = 'item_unit_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    // item section end

    // ============ start leave ====================
    // create leave type list
    
    public function leave_type(){
      $this->data['results'] = $this->General_setting_model->get_leave_type(); 
      $this->data['meta_title'] = 'ছুটির টাইপ';
      $this->data['subview'] = 'leave_type';
      $this->load->view('backend/_layout_main', $this->data);
    }

    public function leave_type_add(){
        $this->form_validation->set_rules('leave_name_bn', 'Leave Name Bangla', 'required|trim');
        $this->form_validation->set_rules('leave_name_en', 'Leave Name English', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'leave_name_bn'   => $this->input->post('leave_name_bn'),
                'leave_name_en'   => $this->input->post('leave_name_en'),
                'status'          => 1
                ); 

            if($this->Common_model->save('leave_type', $form_data)){
                $this->session->set_flashdata('success', 'Leave create successfully.');
                redirect('general_setting/leave_type');
            }
        }

        $this->data['meta_title'] = 'ছুটি এন্ট্রি করুন';
        $this->data['subview'] = 'leave_type_add';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function leave_type_edit($id){
        $this->form_validation->set_rules('leave_name_bn', 'Leave Name Bangla', 'required|trim');
        $this->form_validation->set_rules('leave_name_en', 'Leave Name English', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'leave_name_bn'   => $this->input->post('leave_name_bn'),
                'leave_name_en'   => $this->input->post('leave_name_en'),
                'status'          => $this->input->post('status'),
            ); 

            if($this->Common_model->edit('leave_type',$id,'id',$form_data)){
                $this->session->set_flashdata('success', 'Leave updated successfully.');
                redirect('general_setting/leave_type');
            }
        }

        $this->data['rows'] = $this->General_setting_model->get_info('leave_type', $id);
        $this->data['meta_title'] = 'ছুটি সংশোধন করুন';
        $this->data['subview'] = 'leave_type_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function leave_type_delete($id)
    {
        if ($this->db->delete('leave_type', array('id' => $id))) {
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/leave_type');
        }
    }

    // ============ end leave ====================

}
