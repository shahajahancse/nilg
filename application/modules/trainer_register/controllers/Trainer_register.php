<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer_register extends Backend_Controller {
    var $userSessID;

    public function __construct(){
        parent::__construct();

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'প্রশিক্ষক নিবন্ধন';
        $this->load->model('Common_model');
        $this->load->model('Trainer_register_model');
        $this->userSessID = $this->session->userdata('user_id');
    }


    public function index($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->Trainer_register_model->get_data($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('trainer_register/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');
        
        //Load page
        $this->data['meta_title'] = 'প্রশিক্ষকদের তালিকা';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_generate(){
        $form_data = array(
                    'name' => $this->input->get('name'), 
                    'designation' => $this->input->get('designation'),
                    'mobile_no' => $this->input->get('mobile_no'),
                    'status' => $this->input->get('status')
                );        
        $this->data['results'] = $results = $this->Trainer_register_model->get_trainer_list($form_data);

        // print_r($this->data['results']); // exit;
        // $this->data['meta_title'] = 'প্রশিক্ষকদের তালিকা';
        // $this->data['subview'] = 'pdf_generate';
        // $this->load->view('backend/_layout_main', $this->data);
        
        // $this->load->view('pdf_generate', $this->data);
        // exit;

        $this->data['headding'] = 'প্রশিক্ষকদের তালিকা';
        $html = $this->load->view('pdf_generate', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function add(){        
        $this->form_validation->set_rules('trainer_name', 'প্রশিক্ষকের নাম', 'required|trim');
        $this->form_validation->set_rules('trainer_desig', 'পদবি', 'required|trim');
        $this->form_validation->set_rules('trainer_org_name', 'প্রতিষ্ঠানের নাম', 'required|trim');
        $this->form_validation->set_rules('max_education', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা', 'required|trim');
        $this->form_validation->set_rules('mobile', 'মোবাইল নাম্বার', 'required|trim');        

        if ($this->form_validation->run() == true){
            $form_data = array(
                'trainer_name' => $this->input->post('trainer_name'),
                'trainer_desig'       => $this->input->post('trainer_desig'),
                'trainer_org_name' => $this->input->post('trainer_org_name'),
                'max_education' => $this->input->post('max_education'),
                'mobile' => $this->input->post('mobile'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'present_address' => $this->input->post('present_address'),
                'interested_subject' => $this->input->post('interested_subject')
                );
            // print_r($form_data); exit;
            if($this->Common_model->save('trainer_register', $form_data)){                
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('trainer_register');
            }
        }

        // $this->data['course_list'] = $this->Common_model->get_nilg_course(); 

        //Load view
        $this->data['meta_title'] = 'প্রশিক্ষক এন্ট্রি ফরম';
        $this->data['subview'] = 'add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $this->form_validation->set_rules('trainer_name', 'প্রশিক্ষকের নাম', 'required|trim');
        $this->form_validation->set_rules('trainer_desig', 'পদবি', 'required|trim');
        $this->form_validation->set_rules('trainer_org_name', 'প্রতিষ্ঠানের নাম', 'required|trim');
        $this->form_validation->set_rules('max_education', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা', 'required|trim');
        $this->form_validation->set_rules('mobile', 'মোবাইল নাম্বার', 'required|trim');  

        if ($this->form_validation->run() == true){
            $form_data = array(
                'trainer_name' => $this->input->post('trainer_name'),
                'trainer_desig'       => $this->input->post('trainer_desig'),
                'trainer_org_name' => $this->input->post('trainer_org_name'),
                'max_education' => $this->input->post('max_education'),
                'mobile' => $this->input->post('mobile'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'present_address' => $this->input->post('present_address'),
                'interested_subject' => $this->input->post('interested_subject')
                );
            // print_r($form_data); exit;
            if($this->Common_model->edit('trainer_register', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('trainer_register');
            }
        }

        $this->data['info'] = $this->Trainer_register_model->get_info($id);

        //Load View
        $this->data['meta_title'] = 'প্রশিক্ষকের তথ্য সংশোধন';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function details($id){
        $this->data['info'] = $this->Trainer_register_model->get_info($id);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষকের বিস্তারিত তথ্য';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function participant_list($id){
        $this->data['info'] = $this->Trainer_register_model->get_info($id);

        //Load Page
        $this->data['meta_title'] = 'অংশগ্রহণকারী তালিকা';
        $this->data['subview'] = 'participant_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function program_badge_achievemen(){   
    // echo 'hello'; exit;     
        //$updateid = $this->input->get('hide_id');
        //echo $datasheet_id = $this->Trainer_register_model->get_data_id($this->input->get('national_id'))->id;
        $form_data = array(
          'data_sheet_id'   => $this->input->get('nid'),
          'tran_mgmt_id'    => $this->input->get('training_id')
          );
        // print_r($form_data); exit;
        $delete_id = $this->input->get('delete_id');

        if($delete_id > 0 ){
            if($this->Trainer_register_model->delete_prgram('training_participant', $delete_id))
                echo 'Delete Success';
            else
                echo 'Delete Failed';
        }elseif ($this->input->get('nid') > 0){
            $validate_insert=$this->Trainer_register_model->achievement_checkduplicate($form_data);
            if(empty($validate_insert)){
                if($this->Common_model->save('training_participant', $form_data)){
                    echo 'inserted';
                }else{
                    echo 'insert fail';
                }
            }else{
                echo 'duplicate';
            }

        }

        $alldt = $this->Trainer_register_model->get_badge_details_achievement($form_data);
        echo '23432sdfg324';
        echo '<table class="tg2">
        <tr>
            <th class="tg-71hr">ক্রম</th>
            <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
            <th class="tg-71hr">এনআইডি</th>
            <th class="tg-71hr">পদবি</th>
            <th class="tg-71hr">মোবাইল নম্বর </th>
            <th class="tg-71hr" width="120">অ্যাকশন</th>
        </tr>';
        for($i=0;$i<sizeof($alldt);$i++){
            echo '
            <tr>
                <td class="tg-031e">'.($i+1).'</td>
                <td class="tg-031e">'.$alldt[$i]->name_bangla.'</td>
                <td class="tg-031e">'.eng2bng($alldt[$i]->national_id).'</td>
                <td class="tg-031e">'.$alldt[$i]->desig_name.'</td>
                <td class="tg-031e">'.$alldt[$i]->telephone_mobile.'</td>
                <td class="tg-031e">
                    <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_achievemen('.$alldt[$i]->id.');">Delete</button>
                </td>
            </tr>
            ';
        }
        echo '</table>';
        exit;
    }



}