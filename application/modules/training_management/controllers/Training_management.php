<?php defined('BASEPATH') or exit('No direct script access allowed');

class Training_management extends Backend_Controller
{
    var $userSessID;

    public function __construct()
    {
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'প্রশিক্ষণ ব্যবস্থাপনা';
        $this->load->model('Common_model');
        $this->load->model('Training_management_model');
        $this->userSessID = $this->session->userdata('user_id');
    }


    public function index($offset = 0)
    {
        //Manage list the users
        $limit = 50;
        if ($this->ion_auth->is_admin()) {
            $results = $this->Training_management_model->get_data_admin($limit, $offset);
        } elseif ($this->ion_auth->in_group('cc')) {
            $results = $this->Training_management_model->get_data($limit, $offset);
        }
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('training_management/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');

        //Load page
        $this->data['meta_title'] = 'প্রশিক্ষণ কোর্সের তালিকা';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function duplicate($id)
    {
        // echo $id;
        $this->data['user_info'] = $this->ion_auth->user()->row();
        $this->data['course_list'] = $this->Common_model->get_nilg_course();
        $this->data['financing_list'] = $this->Common_model->get_financing();
        $this->data['training_type'] = $this->Common_model->get_training_type();
        $this->data['coordinator'] = $this->Training_management_model->get_coordinator();


        $a = $this->Training_management_model->get_info($id);


        // echo  $a['info']->type_id; exit();
        // dd($editable['info']->id); exit();

        $this->form_validation->set_rules('participant_name', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('batch_no', 'ব্যাচ নং', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্সের বিষয়', 'required|trim');
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('financing_id', 'অর্থায়নে', 'required|trim');
        $this->form_validation->set_rules('cd_name', 'কোর্স পরিচালকের নাম', 'required|trim');
        $this->form_validation->set_rules('cd_designation', 'কোর্স পরিচালকের পদবি', 'required|trim');

        if ($this->form_validation->run() == true || $this->form_validation->run() == false) {
            $form_data = array(
                'type_id'          => $a['info']->type_id,
                'participant_name' => $a['info']->participant_name,
                'course_id'     => $a['info']->course_id,
                'batch_no'      => $a['info']->batch_no,
                'start_date'    => $a['info']->start_date,
                'end_date'      => $a['info']->end_date,
                'financing_id'  => $a['info']->financing_id,
                'ta'            => $a['info']->ta,
                'da'            => $a['info']->da,
                'tra_a'         => $a['info']->tra_a,
                'dress'         => $a['info']->dress,
                'cd_name'       => $a['info']->cd_name,
                'cd_designation' => $a['info']->cd_designation,
                'created' => date('Y-m-d')
            );
            // print_r($form_data); exit;

            if ($this->Common_model->save('training_management', $form_data)) {

                // Last training management id
                $lastID = $this->db->insert_id();
                // Inser default coordinator with ownership
                $form_data2 = array('user_id' => $this->data['user_info']->id, 'training_id' => $lastID, 'is_owner' => 1);
                $this->Common_model->save('training_users', $form_data2);
                //echo sizeof(@$_POST['coordinator_id']); exit;
                // Insert if multiple coordinator manage training               
                if (sizeof($a['cc_list']) > 0) {
                    for ($i = 0; $i < sizeof($a['cc_list']); $i++) {
                        $data_array = array(
                            'training_id' => $lastID,
                            'user_id' => $a['cc_list'][$i]->user_id
                        );
                        $this->Common_model->save('training_users', $data_array);
                    }
                }




                //Redirect and success message
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('training_management');
            } else {
                echo "no";
            }
        } else {
            echo "great no";
        }
    }

    public function schedule_date_range_search()
    {
        // echo "string";
        $start_date  =  $this->input->post('start_date');
        $end_date    =  $this->input->post('end_date');
        $training_id =  $this->input->post('training_id');

        // $x = $this->Training_management_model->date_range_filter($a, $b, $c);


        $this->data['info'] = $this->Training_management_model->get_training_info($training_id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        $this->data['results'] = $this->Training_management_model->date_range_filter($start_date, $end_date, $training_id);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী এন্ট্রি ফরম';
        $this->data['subview'] = 'schedule';
        $this->load->view('backend/_layout_main', $this->data);
        // dd($c);
        // dd($x);
        // $this->data['info'] = $this->Training_management_model->get_training_info($id);
        // // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        // $this->data['results'] = $this->Training_management_model->date_range_filter($a, $b, $c);

        // //Load Page
        // $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী এন্ট্রি ফরম';
        // $this->data['subview'] = 'schedule';
        // $this->load->view('backend/_layout_main', $this->data);
    }

    public function search_course($offset = 0)
    {
        $limit = 50;
        $search = $this->input->post('search');
        if ($this->ion_auth->is_admin()) {
            $results = $this->Training_management_model->get_data_admin_search($limit, $offset, $search);
        } elseif ($this->ion_auth->in_group('cc')) {
            $results = $this->Training_management_model->get_data_search($limit, $offset, $search);
        }
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('training_management/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //$this->data['course_type'] = array('' => '--Select One--', 'NILG' => 'NILG Course', 'Other' => 'Other Course', 'Foreign' => 'Foreign Course');

        //Load page
        $this->data['meta_title'] = 'প্রশিক্ষণ কোর্সের তালিকা';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_allowance($id)
    {
        $form_data = array('tran_mgmt_id' => $id);
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        $this->data['results'] = $this->Training_management_model->get_participant_allowance($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণ ভাতার তালিকা ';
        $html = $this->load->view('pdf_allowance', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function allowance($id)
    {
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        // print_r($this->data['training']); exit;
        // $this->data['info'] = $this->Training_management_model->get_schedule_item($id);
        // $this->data['results'] = $this->Training_management_model->get_honorarium($id);
        $this->data['results'] = $this->Training_management_model->get_participant_allowance($id);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ ভাতার তালিকা';
        $this->data['subview'] = 'allowance';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_allowance_dress($id)
    {
        $form_data = array('tran_mgmt_id' => $id);
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        $this->data['results'] = $this->Training_management_model->get_participant_allowance($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণ ভাতার তালিকা ';
        $html = $this->load->view('pdf_allowance_dress', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function allowance_dress($id)
    {
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        // print_r($this->data['training']); exit;
        // $this->data['info'] = $this->Training_management_model->get_schedule_item($id);
        // $this->data['results'] = $this->Training_management_model->get_honorarium($id);
        $this->data['results'] = $this->Training_management_model->get_participant_allowance($id);

        //Load Page
        $this->data['meta_title'] = 'পোষাক ভাতার তালিকা';
        $this->data['subview'] = 'allowance_dress';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_honorarium_acknowledgement($trainingID, $scheduleID)
    {
        $this->data['training'] = $this->Training_management_model->get_training_info($trainingID);
        $this->data['schedule'] = $this->Training_management_model->get_schedule_details($trainingID, $scheduleID);
        // $this->data['trainer'] = $this->Training_management_model->get_trainer($trainerID);
        // echo '<pre>';
        // print_r($this->data['schedule']); exit;

        $this->data['headding'] = 'প্রাপ্তি স্বীকার';
        $html = $this->load->view('pdf_honorarium_acknowledgement', $this->data, true);

        // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function honorarium($id)
    {
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        // $this->data['info'] = $this->Training_management_model->get_schedule_item($id);
        $this->data['results'] = $this->Training_management_model->get_honorarium($id);

        //Load Page
        $this->data['meta_title'] = 'সম্মানী ভাতার তালিকা';
        $this->data['subview'] = 'honorarium';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function feedback_course_result($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        $this->data['results'] = $this->Training_management_model->get_schedule_with_trainer($id);
        // echo '<pre>';
        // print_r($this->data['results']); exit;

        foreach ($this->data['results'] as $item) {
            // print_r($item); exit;
            $dataArr[$item->id] = $this->Training_management_model->get_feedback_topic_result($id, $item->id);
        }

        // print_r($dataArr); exit;

        // Dropdown
        $this->data['participant_list'] = $this->Training_management_model->get_participant_dd($id);
        // print_r($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'কোর্স মূল্যায়ন ফলাফল';
        $this->data['subview'] = 'feedback_course_result';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_feedback_course($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'কোর্স মূল্যায়ন ফলাফল';
        $html = $this->load->view('pdf_feedback_course', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function feedback_course($id)
    {
        // echo $id; exit;
        $this->form_validation->set_rules('participant_id', 'participant name', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'participant_id' => $this->input->post('participant_id'),
                'training_id' => $this->input->post('hide_training_id'),
                'topic_related' => $this->input->post('topic_related'),
                'if_not_topic_related' => $this->input->post('if_not_topic_related'),
                'responsibility_helpful' => $this->input->post('responsibility_helpful'),
                'if_not_responsibility_helpful' => $this->input->post('if_not_responsibility_helpful'),
                'professional_change' => $this->input->post('professional_change'),
                'if_not_professional_change' => $this->input->post('if_not_professional_change'),
                'course_duration' => $this->input->post('course_duration'),
                'use_tool_opinion' => $this->input->post('use_tool_opinion'),
                'course_topic_add_sub' => $this->input->post('course_topic_add_sub'),
                'accommodation_opinion' => $this->input->post('accommodation_opinion'),
                'dining_opinion' => $this->input->post('dining_opinion'),
                'course_manage_opinion' => $this->input->post('course_manage_opinion'),
            );
            // print_r($form_data); exit;

            $this->Common_model->save('training_feedback_course', $form_data);
            // }
            // Success Message
            $this->session->set_flashdata('success', 'Feedback on course evaluate value insert successfully.');
            redirect('training_management/feedback_course_result/' . $id);
        }

        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        // $this->data['results'] = $this->Training_management_model->get_schedule_with_trainer($id);

        // Dropdown
        $this->data['participant_list'] = $this->Training_management_model->get_participant_dd($id);
        // print_r($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'কোর্স মূল্যায়ন ফরম';
        $this->data['subview'] = 'feedback_course';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_feedback_topic($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        $this->data['results'] = $this->Training_management_model->get_schedule_with_trainer($id);


        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'বিষয়বস্তু মূল্যায়নের গড় ফলাফল';
        $html = $this->load->view('pdf_feedback_topic', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function feedback_topic_result($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        $this->data['results'] = $this->Training_management_model->get_schedule_with_trainer($id);
        //echo '<pre>';
        // print_r($this->data['results']); exit;

        // foreach ($this->data['results'] as $item) {
        //     // print_r($item); exit;
        //     $dataArr[$item->id] = $this->Training_management_model->get_feedback_topic_result($id, $item->id);

        // }

        // print_r($dataArr); exit;

        // Dropdown
        $this->data['participant_list'] = $this->Training_management_model->get_participant_dd($id);
        // print_r($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'বিষয়বস্তু মূল্যায়নের গড় ফলাফল';
        $this->data['subview'] = 'feedback_topic_result';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function feedback_topic($id)
    {
        $this->form_validation->set_rules('participant_id', 'participant name', 'required|trim');

        if ($this->form_validation->run() == true) {
            // echo '<pre>';
            // print_r($_POST); //exit;
            // echo sizeof($_POST['hide_topic_id']); exit;
            for ($i = 0; $i < sizeof($_POST['hide_topic_id']); $i++) {
                $topicID = $_POST['hide_topic_id'][$i];
                $form_data = array(
                    'participant_id' => $this->input->post('participant_id'),
                    'training_id' => $this->input->post('hide_training_id'),
                    'topic_id' => $topicID,
                    'rate_concept_topic' => $_POST['rate_concept_topic_' . $topicID],
                    'rate_present_technique' => $_POST['rate_present_technique_' . $topicID],
                    'rate_use_tool' => $_POST['rate_use_tool_' . $topicID],
                    'rate_time_manage' => $_POST['rate_time_manage_' . $topicID],
                    'rate_que_ans_skill' => $_POST['rate_que_ans_skill_' . $topicID],
                );
                $subTotal = $_POST['rate_concept_topic_' . $topicID] + $_POST['rate_present_technique_' . $topicID] + $_POST['rate_use_tool_' . $topicID] + $_POST['rate_time_manage_' . $topicID] + $_POST['rate_que_ans_skill_' . $topicID];

                $form_data['topic_avgrage'] = $subTotal / 5;
                // print_r($form_data); exit;

                $this->Common_model->save('training_feedback_topic', $form_data);
            }
            // Success Message
            $this->session->set_flashdata('success', 'Feedback on topic evaluate value insert successfully.');
            redirect('training_management/schedule/' . $id);
        }

        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        $this->data['results'] = $this->Training_management_model->get_schedule_with_trainer($id);

        // Dropdown
        $this->data['participant_list'] = $this->Training_management_model->get_participant_dd($id);
        // print_r($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'বিষয়বস্তু মূল্যায়নের ফরম';
        $this->data['subview'] = 'feedback_topic';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_schedule($id)
    {
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        $this->data['results'] = $this->Training_management_model->get_schedule($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণ কর্মসূচী';
        $html = $this->load->view('pdf_schedule', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function schedule_item_edit($id)
    {
        $this->data['info'] = $this->Training_management_model->get_schedule_item($id);
        $this->data['info_training'] = $this->Training_management_model->get_training_info($this->data['info']->training_id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();

        $this->form_validation->set_rules('program_date', 'তারিখ', 'required|trim');
        $this->form_validation->set_rules('time_start', 'শুরুর সময়', 'required|trim');
        $this->form_validation->set_rules('time_end', 'শেষের সময়', 'required|trim');
        $this->form_validation->set_rules('topic', 'আলোচনার বিষয়', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'program_date'  => $this->input->post('program_date'),
                'time_start'    => date('H:i:s', strtotime($this->input->post('time_start'))),
                'time_end'      => date('H:i:s', strtotime($this->input->post('time_end'))),
                'session_no'    => $this->input->post('session_no'),
                'topic'         => $this->input->post('topic'),
                'speakers'      => $this->input->post('speakers'),
                'honorarium'    => $this->input->post('honorarium'),
                'trainer_id'    => $this->input->post('trainer_id')
            );
            // print_r($form_data); exit;
            if ($this->Common_model->edit('training_schedule', $id, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('training_management/schedule/' . $this->data['info']->training_id);
            }
        }

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী সংশোধন';
        $this->data['subview'] = 'schedule_item_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function schedule($id)
    {
        $this->form_validation->set_rules('program_date', 'তারিখ', 'required|trim');
        $this->form_validation->set_rules('time_start', 'শুরুর সময়', 'required|trim');
        $this->form_validation->set_rules('time_end', 'শেষের সময়', 'required|trim');
        $this->form_validation->set_rules('topic', 'আলোচনার বিষয়', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'training_id'   => $this->input->post('hide_training_id'),
                'program_date'  => $this->input->post('program_date'),
                'time_start'    => date('H:i:s', strtotime($this->input->post('time_start'))),
                'time_end'      => date('H:i:s', strtotime($this->input->post('time_end'))),
                'session_no'    => $this->input->post('session_no'),
                'topic'         => $this->input->post('topic'),
                'speakers'      => $this->input->post('speakers'),
                'honorarium'    => $this->input->post('honorarium'),
                'trainer_id'    => $this->input->post('trainer_id')
            );
            // print_r($form_data); exit;
            if ($this->Common_model->save('training_schedule', $form_data)) {
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('training_management/schedule/' . $id);
            }
        }

        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        $this->data['results'] = $this->Training_management_model->get_schedule($id);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী এন্ট্রি ফরম';
        $this->data['subview'] = 'schedule';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_attendance($id)
    {
        $form_data = array('tran_mgmt_id' => $id);
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        $this->data['results'] = $this->Training_management_model->get_participant_list($form_data);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'দৈনিক হাজিরা ';
        $html = $this->load->view('pdf_attendance', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function pdf_attendance_no($id)
    {
        $form_data = array('tran_mgmt_id' => $id);
        $this->data['training'] = $this->Training_management_model->get_training_info($id);
        $this->data['results'] = $this->Training_management_model->get_participant_list($form_data);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'অংশগ্রহণকারীর তালিকা ';
        $html = $this->load->view('pdf_attendance_no', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function pdf_certificate($participantID)
    {
        // $this->data['training'] = $this->Training_management_model->get_training_info($trainingID);
        // $this->data['schedule'] = $this->Training_management_model->get_schedule_details($trainingID, $scheduleID);
        // $this->data['trainer'] = $this->Training_management_model->get_trainer($trainerID);
        // echo '<pre>';
        // print_r($this->data['schedule']); exit;

        $this->data['info'] = $this->Training_management_model->get_certificate($participantID);

        // print_r($this->data['info']); exit;

        $this->data['headding'] = 'সনদপত্র';
        $html = $this->load->view('pdf_certificate', $this->data, true);

        // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->useFixedNormalLineHeight = true;
        $mpdf->useFixedTextBaseline = true;
        $mpdf->adjustFontDescLineheight = 2.14;
        $mpdf->WriteHtml($html);
        $mpdf->output('Certificate.pdf', 'I');
    }


    public function get_certificate($id)
    {
        // $this->data['info'] = $this->Training_management_model->get_training_info($id);
        // $this->data['info'] = $this->Training_management_model->get_schedule_item($id);
        // $this->data['results'] = $this->Training_management_model->get_honorarium($id);

        //Load Page
        $this->data['meta_title'] = 'সার্টিফিকেট';
        $this->data['subview'] = 'get_certificate';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function generate_certificate($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        $participantList = $this->Training_management_model->get_participant_is_not_complete($id);
        // echo '<pre>';
        // print_r($this->data['info']);
        // print_r($participantList); //exit;
        foreach ($participantList as $value) {
            // $arr[] = $value->data_sheet_id;
            $form_data = array(
                'data_id' => $value->data_sheet_id,
                'nilg_desig_id' => $value->curr_desig_id,
                'nilg_course_id' => $this->data['info']->course_id,
                'nilg_batch_no' => $this->data['info']->batch_no,
                'nilg_training_start' => $this->data['info']->start_date,
                'nilg_training_end' => $this->data['info']->end_date
            );

            //Insert data to Datasheet NILG training
            if ($this->Common_model->save('per_nilg_training', $form_data)) {
                //Update participant list is_complete '1'
                $updae_data = array('is_complete' => '1');
                $this->Common_model->edit('training_participant', $value->id, 'id', $updae_data);
            }
        }
        // $this->db->update_batch('per_nilg_training', $data, 'id'); 
        // print_r($form_data); exit;

        $data = array('tran_mgmt_id' => $id);
        $this->data['results'] = $this->Training_management_model->get_participant_list($data);
        // print_r($this->data['results']); exit;

        //Load Page
        $this->data['meta_title'] = 'জেনারেট সার্টিফিকেট';
        $this->data['subview'] = 'generate_certificate';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function participant_list($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);

        //Load Page
        $this->data['meta_title'] = 'অংশগ্রহণকারী তালিকা';
        $this->data['subview'] = 'participant_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id)
    {
        $this->data['info'] = $this->Training_management_model->get_training_info($id);
        $this->data['cc_list'] = $this->Training_management_model->get_course_coordinator($id);
        //print_r($this->data); exit;

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কোর্সের বিস্তারিত তথ্য';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('participant_name', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('batch_no', 'ব্যাচ নং', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্সের বিষয়', 'required|trim');
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('financing_id', 'অর্থায়নে', 'required|trim');
        $this->form_validation->set_rules('cd_name', 'কোর্স পরিচালকের নাম', 'required|trim');
        $this->form_validation->set_rules('cd_designation', 'কোর্স পরিচালকের পদবি', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'type_id'       => $this->input->post('type_id'),
                'participant_name' => $this->input->post('participant_name'),
                'course_id'     => $this->input->post('course_id'),
                'batch_no'      => $this->input->post('batch_no'),
                'start_date'    => $this->input->post('start_date'),
                'end_date'      => $this->input->post('end_date'),
                'financing_id'  => $this->input->post('financing_id'),
                'ta'            => $this->input->post('ta'),
                'da'            => $this->input->post('da'),
                'tra_a'         => $this->input->post('tra_a'),
                'dress'         => $this->input->post('dress'),
                'cd_name'       => $this->input->post('cd_name'),
                'cd_designation' => $this->input->post('cd_designation'),
            );
            // print_r($form_data); exit;
            if ($this->Common_model->edit('training_management', $id, 'id', $form_data)) {

                // Coordinator new insert and update
                for ($i = 0; $i < count($_POST['coordinator_id']); $i++) {
                    //check exists data
                    @$data_exists = $this->Common_model->exists('training_users', 'id', $_POST['hide_cc_id'][$i]);
                    if ($data_exists) {
                        $data = array('user_id' => $_POST['coordinator_id'][$i]);
                        $this->Common_model->edit('training_users', $_POST['hide_cc_id'][$i], 'id', $data);
                    } else {
                        $data = array(
                            'training_id' => $id,
                            'user_id' => $_POST['coordinator_id'][$i]
                        );
                        $this->Common_model->save('training_users', $data);
                    }
                }

                //Redirct and success message                
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('training_management');
            }
        }

        $results = $this->Training_management_model->get_info($id);
        $this->data['info'] = $results['info'];
        $this->data['cc_list'] = $results['cc_list'];
        $this->data['main_cc'] = $this->Training_management_model->get_main_cc($id);
        $this->data['financing_list'] = $this->Common_model->get_financing();
        $this->data['course_list'] = $this->Common_model->get_nilg_course();
        $this->data['training_type'] = $this->Common_model->get_training_type();
        // print_r($this->data['main_cc']); exit;

        //Load View
        $this->data['meta_title'] = 'প্রশিক্ষণ কোর্স সংশোধন';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add()
    {
        $this->data['user_info'] = $this->ion_auth->user()->row();
        $this->data['course_list'] = $this->Common_model->get_nilg_course();
        $this->data['financing_list'] = $this->Common_model->get_financing();
        $this->data['training_type'] = $this->Common_model->get_training_type();
        $this->data['coordinator'] = $this->Training_management_model->get_coordinator();

        // echo $user['user_info']->id;
        //print_r($user); 
        // exit;

        $this->form_validation->set_rules('participant_name', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('batch_no', 'ব্যাচ নং', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্সের বিষয়', 'required|trim');
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('financing_id', 'অর্থায়নে', 'required|trim');
        $this->form_validation->set_rules('cd_name', 'কোর্স পরিচালকের নাম', 'required|trim');
        $this->form_validation->set_rules('cd_designation', 'কোর্স পরিচালকের পদবি', 'required|trim');

        if ($this->form_validation->run() == true) {
            $form_data = array(
                'type_id'       => $this->input->post('type_id'),
                'participant_name' => $this->input->post('participant_name'),
                'course_id'     => $this->input->post('course_id'),
                'batch_no'      => $this->input->post('batch_no'),
                'start_date'    => $this->input->post('start_date'),
                'end_date'      => $this->input->post('end_date'),
                'financing_id'  => $this->input->post('financing_id'),
                'ta'            => $this->input->post('ta'),
                'da'            => $this->input->post('da'),
                'tra_a'         => $this->input->post('tra_a'),
                'dress'         => $this->input->post('dress'),
                'cd_name'       => $this->input->post('cd_name'),
                'cd_designation' => $this->input->post('cd_designation'),
                'created' => date('Y-m-d')
            );
            // print_r($form_data); exit;

            if ($this->Common_model->save('training_management', $form_data)) {

                // Last training management id
                $lastID = $this->db->insert_id();
                // Inser default coordinator with ownership
                $form_data2 = array('user_id' => $this->data['user_info']->id, 'training_id' => $lastID, 'is_owner' => 1);
                $this->Common_model->save('training_users', $form_data2);
                //echo sizeof(@$_POST['coordinator_id']); exit;
                // Insert if multiple coordinator manage training               
                if (sizeof(@$_POST['coordinator_id']) > 0) {
                    for ($i = 0; $i < sizeof($_POST['coordinator_id']); $i++) {
                        $data_array = array(
                            'training_id' => $lastID,
                            'user_id' => $_POST['coordinator_id'][$i]
                        );
                        $this->Common_model->save('training_users', $data_array);
                    }
                }


                //Redirect and success message
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('training_management');
            }
        }


        //Load view
        $this->data['meta_title'] = 'প্রশিক্ষণ কোর্স এন্ট্রি ফরম';
        $this->data['subview'] = 'add';
        $this->load->view('backend/_layout_main', $this->data);
    }













    public function schedule_item_delete($id)
    {
        $this->data['info'] = $this->Training_management_model->get_schedule_item($id);
        if ($this->Training_management_model->get_delete_data('training_schedule', $id)) {
            $this->session->set_flashdata('success', 'Item delete successfully.');
            redirect('training_management/schedule/' . $this->data['info']->training_id);
        } else {
            $this->session->set_flashdata('success', 'Something is wrong.');
            redirect('training_management/schedule/' . $this->data['info']->training_id);
        }
    }





    public function ajax_training_participant_list()
    {
        // echo 'hello'; exit;     
        //$updateid = $this->input->get('hide_id');

        $form_data = array(
            'data_sheet_id'   => $this->input->get('nid'),
            'tran_mgmt_id'    => $this->input->get('training_id')
        );
        // print_r($form_data); exit;
        $delete_id = $this->input->get('delete_id');

        if ($delete_id > 0) {
            if ($this->Training_management_model->get_delete_data('training_participant', $delete_id))
                echo 'Delete Success';
            else
                echo 'Delete Failed';
        } elseif ($this->input->get('nid') > 0) {
            $validate_insert = $this->Training_management_model->get_participant_check_duplicate($form_data);
            if (empty($validate_insert)) {
                if ($this->Common_model->save('training_participant', $form_data)) {
                    echo 'inserted';
                } else {
                    echo 'insert fail';
                }
            } else {
                echo 'duplicate';
            }
        }

        $alldt = $this->Training_management_model->get_participant_list($form_data);
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
        for ($i = 0; $i < sizeof($alldt); $i++) {
            echo '
            <tr>
                <td class="tg-031e">' . eng2bng(($i + 1)) . '.</td>
                <td class="tg-031e">' . $alldt[$i]->name_bangla . '</td>
                <td class="tg-031e">' . eng2bng($alldt[$i]->national_id) . '</td>
                <td class="tg-031e">' . $alldt[$i]->desig_name . '</td>
                <td class="tg-031e">' . $alldt[$i]->telephone_mobile . '</td>
                <td class="tg-031e">
                    <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_participant(' . $alldt[$i]->id . ');">মুছে ফেলুন</button>
                </td>
            </tr>
            ';
        }
        echo '</table>';
        exit;
    }

    function ajax_course_cordinator_del($id)
    {
        $this->Common_model->delete('training_users', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    public function delete_training($id)
    {
        // $thismodel=$this->this_model();
        // $id = $this->input->get('id'); 
        if ($this->db->delete('training_management', array('id' => $id))) {
            $this->session->set_flashdata('success', 'Deleted traning successful');
            redirect('training_management');
        }
    }
}
