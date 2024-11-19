<?php defined('BASEPATH') or exit('No direct script access allowed');

class Training extends Backend_Controller
{
    var $userSessID;
    var $qr_path;
    var $handbook_path;
    var $training_docs_path;

    public function __construct()
    {
        parent::__construct();
        // print_r($this->session->all_userdata());

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'প্রশিক্ষণ';
        $this->load->model('Common_model');
        $this->load->model('Training_model');
        $this->userSessID = $this->session->userdata('user_id');
        $this->qr_path = realpath(APPPATH . '../uploads/qrcode');
        $this->handbook_path = realpath(APPPATH . '../uploads/handbook');
        $this->voucher_path = realpath(APPPATH . '../uploads/voucher');
        $this->video_path = realpath(APPPATH . '../uploads/video');
        $this->training_docs_path = realpath(APPPATH . '../uploads/training_docs');
        $this->note_path = realpath(APPPATH . '../uploads/note');

        // auto off training schedule after 7 day
        training_participant_auto_off();
    }

    public function index($offset = 0)
    {
        //dd('this');
        // dd($_GET);
        $limit = 50;
        // Get Session User Data
        $office = $this->Common_model->get_office_info_by_session();
        $officeID = $office->crrnt_office_id;
        $this->data['results'] = 0;
        $this->data['total_rows'] = 0;
        // dd($office);

        // Check Auth
        if ($this->ion_auth->in_group('uz')) {
            $results = $this->Training_model->get_training_data($limit, $offset, $officeID);
        } elseif ($this->ion_auth->in_group('ddlg')) {
            $results = $this->Training_model->get_training_data($limit, $offset, $officeID);
        } elseif ($this->ion_auth->in_group('nilg')) {
            $results = $this->Training_model->get_training_data($limit, $offset, $officeID);
        } elseif ($this->ion_auth->in_group('cc')) {
            $results = $this->Training_model->get_coordinate_training($limit, $offset, $this->userSessID);
        } elseif ($this->ion_auth->is_admin()) {
            $results = $this->Training_model->get_training_data($limit, $offset);
        } else {
            redirect('dashboard');
        }
        // dd($_GET['course_id']);

        // Data Existes
        if ($results) {
            $this->data['results'] = $results['rows'];
            $this->data['total_rows'] = $results['num_rows'];
            // dd($this->data['results']);

            // Applicant Count
            foreach ($this->data['results'] as $k => $row) {
                $this->data['results'][$k]->app = $this->Training_model->get_application_by_training_id($row->id);
            }
        }
        // dd($this->data['results']);

        // Pagination
        $this->data['pagination'] = create_pagination('training/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();
        $this->data['divisions'] = $this->db->select('id, div_name_bn')->from('divisions')->get()->result();

        $this->data['meta_title'] = 'প্রশিক্ষণের তালিকা';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function ajax_training_list($offset = 0)
    {
        // dd($_GET);
        $limit = 50;
        // Get Session User Data
        $office = $this->Common_model->get_office_info_by_session();
        $officeID = $office->crrnt_office_id;
        $this->data['results'] = 0;
        $this->data['total_rows'] = 0;
        // dd($office);

        // Check Auth
        if ($this->ion_auth->in_group('uz')) {
            $results = $this->Training_model->get_training_data($limit, $offset, $officeID);
        } elseif ($this->ion_auth->in_group('ddlg')) {
            $results = $this->Training_model->get_training_data($limit, $offset, $officeID);
        } elseif ($this->ion_auth->in_group('nilg')) {
            $results = $this->Training_model->get_training_data($limit, $offset, $officeID);
        } elseif ($this->ion_auth->in_group('cc')) {
            //dd('cc');
            $results = $this->Training_model->get_coordinate_training($limit, $offset, $this->userSessID);
        } elseif ($this->ion_auth->is_admin()) {
            $results = $this->Training_model->get_training_data($limit, $offset);
        } else {
            redirect('dashboard');
        }
        // dd($results);

        // Data Existes
        if ($results) {
            $this->data['results'] = $results['rows'];
            $this->data['total_rows'] = $results['num_rows'];
            // dd($this->data['results']);

            // Applicant Count
            foreach ($this->data['results'] as $k => $row) {
                $this->data['results'][$k]->app = $this->Training_model->get_application_by_training_id($row->id);
            }
        }


        // Pagination
        $this->data['pagination'] = create_pagination('training/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['courses'] = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();
        $this->data['divisions'] = $this->db->select('id, div_name_bn')->from('divisions')->get()->result();

        $text = $this->load->view('ajax_training_list', $this->data, TRUE);
        set_output($text);
    }


    /********************************* Participant ****************************/
    /**************************************************************************/

    public function participant_list($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);

        // Load Page
        $this->data['meta_title'] = 'অংশগ্রহণকারী তালিকা';
        if (!empty($this->input->get('excel'))) {
            echo $this->load->view('participant_list_excel', $this->data, true);
            exit;
        } else {
            $this->data['subview'] = 'participant_list';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }

    public function participant_list_doc($id)
    {
        // Word Export
        // https://www.webslesson.info/2016/08/convert-or-export-html-text-to-ms-word-with-php-script.html

        // Excel Export
        // https://stackoverflow.com/questions/41919030/php-export-to-excel-from-mysql

        $this->data['training'] = $this->Training_model->get_training_info($id);
        // dd($this->data['info']); exit();
        $this->data['results'] = $this->Training_model->get_participant_list($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'দৈনিক হাজিরা ';

        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=" . rand() . ".doc");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $html = $this->load->view('word_participant', $this->data, true);
        exit;
    }

    public function participant_add($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        // dd($this->data['info']); exit();
        // $this->data['results'] = $this->Training_model->get_participant_list($id);

        // Validation
        $this->form_validation->set_rules('national_id', 'participant', 'required|trim');
        $this->form_validation->set_rules('so', 'sort order', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'training_id'   => $this->input->post('hide_training_id'),
                'app_user_id'   => $this->input->post('national_id'),
                'so'            => $this->input->post('so'),
                'is_verified'   => 1
            );
            // print_r($form_data); exit;
            if ($this->Common_model->save('training_participant', $form_data)) {
                $this->session->set_flashdata('success', 'প্রশিক্ষণার্থীকে প্রশিক্ষণ তালিকায় যুক্ত করা হয়েছে');
                redirect('training/participant_list/' . $id);
            }
        }

        // Load Page
        $this->data['meta_title'] = 'অংশগ্রহণকারী এন্ট্রি';
        $this->data['subview'] = 'participant_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function participant_edit($participantID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['participant'] = $this->Training_model->get_participant_info($participantID);
        // dd($this->data['participant']);
        $trainingID = $this->data['participant']->training_id;
        $this->data['training'] = $this->Training_model->get_training_info($trainingID);
        // $this->data['results'] = $this->Training_model->get_participant_list($id);

        // Validation
        $this->form_validation->set_rules('so', 'sort order', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'so' => $this->input->post('so')
            );
            // print_r($form_data); exit;
            if ($this->Common_model->edit('training_participant', $participantID, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'প্রশিক্ষণার্থীর তথ্য সংশোধন করা হয়েছে');
                redirect('training/participant_list/' . $trainingID);
            }
        }

        // Load Page
        $this->data['meta_title'] = 'অংশগ্রহণকারী সংশোধন';
        $this->data['subview'] = 'participant_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function participant_delete($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_participant_info($id);
        // dd($this->data['info']);
        if ($this->Training_model->get_delete_data('training_participant', $id)) {
            $this->session->set_flashdata('success', 'প্রশিক্ষণার্থীকে অংশগ্রহণকারীর তালিকা থেকে মুছে ফেলা হয়েছে');
            redirect('training/participant_list/' . $this->data['training']->training_id);
        } else {
            $this->session->set_flashdata('success', 'Something is wrong.');
            redirect('training/participant_list/' . $this->data['training']->training_id);
        }
    }

    public function pdf_attendance($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        // dd($this->data['training']);exit();
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        // dd($this->data['results']);exit();


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
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $form_data = array('tran_mgmt_id' => $id);
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        // dd($this->data['results']);exit();
        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'অংশগ্রহণকারীর তালিকা ';
        $html = $this->load->view('pdf_attendance_no', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function pdf_trainee_list($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // echo "string"; exit();
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);

        // dd($this->data['results']);exit();

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণার্থীর তালিকা';
        $html = $this->load->view('pdf_trainee_list', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function ajax_training_participant_list()
    {
        // echo 'hello'; exit;
        //$updateid = $this->input->get('hide_id');

        $form_data = array(
            'app_user_id' => $this->input->get('user_id'),
            'training_id' => $this->input->get('training_id')
        );
        // print_r($form_data); exit;
        $delete_id = $this->input->get('delete_id');

        if ($delete_id > 0) {
            if ($this->Training_model->get_delete_data('training_participant', $delete_id))
                echo 'Delete Success';
            else
                echo 'Delete Failed';
        } elseif ($this->input->get('user_id') > 0) {
            $validate_insert = $this->Training_model->get_participant_check_duplicate($form_data);
            if (empty($validate_insert)) {
                // User data
                $user_data = array(
                    'app_user_id' => $this->input->get('user_id'),
                    'training_id' => $this->input->get('training_id'),
                    'is_verified' => 1
                );
                if ($this->Common_model->save('training_participant', $user_data)) {
                    echo 'inserted';
                } else {
                    echo 'insert fail';
                }
            } else {
                echo 'duplicate';
            }
        }

        $alldt = $this->Training_model->get_participant_list($this->input->get('training_id'));
        echo '23432sdfg324';
        echo '<table class="table table-hover table-bordered  table-flip-scroll cf display" id="example">
        <thead class="cf">
            <tr>
                <th class="tg-71hr">ক্রম</th>
                <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                <th class="tg-71hr">এনআইডি</th>
                <th class="tg-71hr">পদবি</th>
                <th class="tg-71hr">মোবাইল নম্বর </th>
                <th class="tg-71hr" width="120">অ্যাকশন</th>
            </tr>
        </thead>
        <tbody>';
        for ($i = 0; $i < sizeof($alldt); $i++) {
            echo '
                <tr>
                    <td class="tg-031e">' . eng2bng(($i + 1)) . '.</td>
                    <td class="tg-031e">' . $alldt[$i]->name_bn . '</td>
                    <td class="tg-031e">' . eng2bng($alldt[$i]->nid) . '</td>
                    <td class="tg-031e">' . $alldt[$i]->desig_name . '</td>
                    <td class="tg-031e">' . $alldt[$i]->mobile_no . '</td>
                    <td class="tg-031e">
                        <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_participant(' . $alldt[$i]->id . ');">মুছে ফেলুন</button>
                    </td>
                </tr>
            </tbody>';
        }
        echo '</table>';
        exit;
    }

    function ajax_training_mark_item_del($id)
    {
        $this->Common_model->delete('training_mark', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_training_coordinator_del($id)
    {
        $this->Common_model->delete('training_coordinator', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_training_material_del($id)
    {
        $this->Common_model->delete('training_material', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }





    /********************************* Schedule *******************************/
    /**************************************************************************/

    public function schedule($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);

        // dd($this->data['info']); exit();
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();
        $this->data['results'] = $this->Training_model->count_schedule_by_date($id);
        // dd($this->data['results']);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচীর তালিকা';
        $this->data['subview'] = 'schedule';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function schedule_item_edit($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['schedule'] = $this->Training_model->get_schedule_item($id);
        $this->data['training'] = $this->Training_model->get_training_info($this->data['schedule']->training_id);
        // dd($this->data['training']);

        // Validation
        $this->form_validation->set_rules('program_date', 'তারিখ', 'required|trim');
        $this->form_validation->set_rules('time_start', 'শুরুর সময়', 'required|trim');
        $this->form_validation->set_rules('time_end', 'শেষের সময়', 'required|trim');
        $this->form_validation->set_rules('topic', 'আলোচনার বিষয়', 'required|trim');

        // Validate and Insert to DB
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'program_date'  => $this->input->post('program_date'),
                'time_start'    => date('H:i:s', strtotime($this->input->post('time_start'))),
                'time_end'      => date('H:i:s', strtotime($this->input->post('time_end'))),
                'session_no'    => $this->input->post('session_no'),
                'topic'         => $this->input->post('topic'),
                'speakers'      => $this->input->post('speakers'),
                'trainer_id'    => $this->input->post('trainer_id'),
                'honorarium'    => $this->input->post('honorarium'),
                'is_honorarium' => $this->input->post('is_honorarium')
            );
            // print_r($form_data); exit;
            if ($this->Common_model->edit('training_schedule', $id, 'id', $form_data)) {
                $this->session->set_flashdata('success', 'Update information successfully.');
                redirect('training/schedule/' . $this->data['schedule']->training_id);
            }
        }

        // Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী সংশোধন';
        $this->data['subview'] = 'schedule_item_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function schedule_add($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Validation
        $this->form_validation->set_rules('program_date', 'তারিখ', 'required|trim');
        $this->form_validation->set_rules('time_start', 'শুরুর সময়', 'required|trim');
        $this->form_validation->set_rules('time_end', 'শেষের সময়', 'required|trim');
        $this->form_validation->set_rules('topic', 'আলোচনার বিষয়', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'training_id'   => $this->input->post('hide_training_id'),
                'program_date'  => $this->input->post('program_date'),
                'time_start'    => date('H:i:s', strtotime($this->input->post('time_start'))),
                'time_end'      => date('H:i:s', strtotime($this->input->post('time_end'))),
                'session_no'    => $this->input->post('session_no'),
                'topic'         => $this->input->post('topic'),
                'speakers'      => $this->input->post('speakers'),
                'trainer_id'    => $this->input->post('trainer_id'),
                'honorarium'    => $this->input->post('honorarium'),
                'is_honorarium' => $this->input->post('is_honorarium')
            );
            // print_r($form_data); exit;
            if ($this->Common_model->save('training_schedule', $form_data)) {
                $this->session->set_flashdata('success', 'New record insert successfully.');
                redirect('training/schedule/' . $id);
            }
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী এন্ট্রি ফরম';
        $this->data['subview'] = 'schedule_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_schedule($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        // dd($this->data['info']); exit();
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();
        $this->data['results'] = $this->Training_model->count_schedule_by_date($id);
        // dd($this->data['results']);


        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণ কর্মসূচী';
        $html = $this->load->view('pdf_schedule', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function schedule_item_delete($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['info'] = $this->Training_model->get_schedule_item($id);
        if ($this->Training_model->get_delete_data('training_schedule', $id)) {
            $this->session->set_flashdata('success', 'Item delete successfully.');
            redirect('training/schedule/' . $this->data['info']->training_id);
        } else {
            $this->session->set_flashdata('success', 'Something is wrong.');
            redirect('training/schedule/' . $this->data['info']->training_id);
        }
    }





    /*************************** Allowance, Honorarium ************************/
    /**************************************************************************/

    public function allowance($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_allowance($id);
        // dd($this->data['results']);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ ভাতার তালিকা';
        $this->data['subview'] = 'allowance';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_allowance_changable($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Validation
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('days', 'দিন', 'required|trim');
        $this->form_validation->set_rules('amount', 'প্রশিক্ষণ ভাতা', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'training_id'   => $id,
                'start_date'    => $this->input->post('start_date'),
                'end_date'      => $this->input->post('end_date'),
                'days'          => $this->input->post('days'),
                'amount'        => $this->input->post('amount'),
                'total_amount'  => ($this->input->post('days') * $this->input->post('amount')),
                'created_by'    => $this->userSessID,
                'created_at'    => date('Y-m-d H:i:s'),
            );
            // print_r($form_data); exit;
            $tra_status = $this->db->where('id', $id)->get('training')->row()->tra_status;
            if ($tra_status == 1) {
                $this->session->set_flashdata('success', 'ইতিমধ্যে রেকর্ড সন্নিবেশ করা হয়েছে');
                redirect('training/allowance/' . $id);
            } else {
                if ($this->Common_model->save('training_allowance_change', $form_data)) {
                    $form_data = array(
                        'tra_status' => 1,
                    );
                    $this->Common_model->edit('training', $id, 'id', $form_data);

                    $this->session->set_flashdata('success', 'নতুন রেকর্ড সন্নিবেশ সফলভাবে সম্পন্ন হয়েছে.');
                    redirect('training/allowance/' . $id);
                }
            }
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        // dd($this->data['results']);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ ভাতা পরিবর্তন';
        $this->data['subview'] = 'training_allowance_changable';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_allowance_changableEdit($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Validation
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('days', 'দিন', 'required|trim');
        $this->form_validation->set_rules('amount', 'প্রশিক্ষণ ভাতা', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'training_id'   => $id,
                'start_date'    => $this->input->post('start_date'),
                'end_date'      => $this->input->post('end_date'),
                'days'          => $this->input->post('days'),
                'amount'        => $this->input->post('amount'),
                'total_amount'  => ($this->input->post('days') * $this->input->post('amount')),
                'created_by'    => $this->userSessID,
                'created_at'    => date('Y-m-d H:i:s'),
            );
            // print_r($form_data); exit;

            if ($this->Common_model->edit('training_allowance_change', $id, 'training_id', $form_data)) {
                $this->session->set_flashdata('success', 'রেকর্ড সম্পাদনা সফলভাবে সম্পন্ন হয়েছে.');
                redirect('training/allowance/' . $id);
            }
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->db->where('training_id', $id)->get('training_allowance_change')->row();
        // dd($this->data['results']);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ ভাতা পরিবর্তন';
        $this->data['subview'] = 'training_allowance_changableEdit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_allowance($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_allowance($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণ ভাতার তালিকা ';
        $html = $this->load->view('pdf_allowance', $this->data, true);

        // PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function allowance_dress($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_allowance($id);

        // Load Page
        $this->data['meta_title'] = 'পোষাক ভাতার তালিকা';
        $this->data['subview'] = 'allowance_dress';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_allowance_dress($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_allowance($id);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণ ভাতার তালিকা ';
        $html = $this->load->view('pdf_allowance_dress', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function material($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        $this->data['materials'] = $this->Training_model->get_material($id);
        // dd($this->data['materials']);

        //Load Page
        $this->data['meta_title'] = 'ট্রেনিং মেটেরিয়ালের তালিকা';
        $this->data['subview'] = 'material';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_material($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        $this->data['materials'] = $this->Training_model->get_material($id);
        // dd($this->data['materials']);

        //Load Page
        $this->data['headding'] = 'ট্রেনিং মেটেরিয়ালের তালিকা';
        $html = $this->load->view('pdf_material', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function honorarium($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_honorarium($id);
        // $this->data['info'] = $this->Training_model->get_schedule_item($id);
        // dd($this->data['training']);


        //Load Page
        $this->data['meta_title'] = 'সম্মানী ভাতার তালিকা';
        $this->data['subview'] = 'honorarium';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_allowance_honorarium($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_honorarium($id);
        // dd($this->data['results']);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'সম্মানী ভাতার তালিকা ';
        $html = $this->load->view('pdf_allowance_honorarium', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function pdf_honorarium_acknowledgement($trainingID, $scheduleID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($trainingID);
        $this->data['schedule'] = $this->Training_model->get_schedule_details($trainingID, $scheduleID);
        // $this->data['trainer'] = $this->Training_model->get_trainer($trainerID);
        // echo '<pre>';
        // dd($this->data['training']);

        $this->data['headding'] = 'প্রাপ্তি স্বীকার';
        $html = $this->load->view('pdf_honorarium_acknowledgement', $this->data, true);

        // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }


    public function marksheet($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        $this->data['subjects'] = $this->Training_model->get_training_mark($id);
        $this->data['totalMark'] = $this->Training_model->get_training_mark_total($id);
        // dd($this->data['totalMark']);

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণার্থীর মার্কশীট';
        $this->data['subview'] = 'marksheet';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function pdf_marksheet($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Get Data
        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        $this->data['subjects'] = $this->Training_model->get_training_mark($id);
        $this->data['totalMark'] = $this->Training_model->get_training_mark_total($id);
        // dd($this->data['subjects']);

        // print_r($this->data['results']); exit;
        $this->data['headding'] = 'প্রশিক্ষণার্থীর মার্কশীট';
        $html = $this->load->view('pdf_marksheet', $this->data, true);

        //PDF Generate
        $mpdf = new mPDF('', 'A4-L', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }


    /******************************* Certificate ******************************/
    /**************************************************************************/

    public function generate_certificate($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);

        // comment on 23/11/2022
        /*
        $participantList = $this->Training_model->get_participant_is_not_complete($id);
        foreach ($participantList as $value) {
            // $arr[] = $value->data_sheet_id;
            $form_data = array(
                'data_id' => $value->id,
                'nilg_desig_id' => $value->crrnt_desig_id,
                'nilg_course_id' => $this->data['training']->course_id,
                'nilg_batch_no' => $this->data['training']->batch_no,
                'nilg_training_start' => $this->data['training']->start_date,
                'nilg_training_end' => $this->data['training']->end_date
            );

            //Insert data to Datasheet NILG training
            if($this->Common_model->save('per_nilg_training', $form_data)){
                //Update participant list is_complete '1'
                $updae_data = array('is_complete' => '1');
                $this->Common_model->edit('training_participant', $value->id, 'id', $updae_data);
            }
        }
        */

        // $data = array('training_id' => $id);
        $this->data['results'] = $this->Training_model->get_participant_list($id);
        $this->data['subjects'] = $this->Training_model->get_training_mark($id);
        $this->data['totalMark'] = $this->Training_model->get_training_mark_total($id);
        // dd($this->data['results']);

        //Load Page
        $this->data['meta_title'] = 'জেনারেট সার্টিফিকেট';
        $this->data['subview'] = 'generate_certificate';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // working on 23/11/2022
    public function insert_per_training_participant($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $training = $this->Training_model->get_training_info($id);
        // echo "<pre>"; print_r($training); die();


        // Insert `per_nilg_training` Participant List
        $count_participant = count($this->input->post('participant_id'));
        if (!empty($count_participant)) {
            foreach ($this->input->post('participant_id') as $key => $value) {
                $get_data = $this->db->select('tp.*, u.crrnt_desig_id')->join('users u', 'u.id = tp.app_user_id', 'LEFT')->where('tp.id', $value)->get('training_participant as tp')->row();

                $get_data_id = $this->db->where('tp.data_id', $get_data->app_user_id)->where('tp.nilg_course_id', $training->course_id)->get('per_nilg_training as tp')->num_rows();


                $form_data = array(
                    // 'app_user_id' => $desig_id->app_user_id,
                    'data_id' => $get_data->app_user_id,
                    'nilg_desig_id' => $get_data->crrnt_desig_id,
                    'nilg_course_id' => $training->course_id,
                    'nilg_batch_no' => $training->batch_no,
                    'nilg_training_start' => $training->start_date,
                    'nilg_training_end' => $training->end_date
                );

                // echo "<pre>"; print_r($form_data); die();

                if ($get_data_id == 0) {
                    //Insert data to Datasheet NILG training
                    $this->Common_model->save('per_nilg_training', $form_data);
                    //Update participant list is_complete '1'
                    $updae_data = array('is_complete' => '1', 'nilg_desig_id' => $get_data->crrnt_desig_id);
                    $this->Common_model->edit('training_participant', $value, 'id', $updae_data);
                } else {
                    //update data to Datasheet NILG training
                    $this->db->where('data_id', $get_data->app_user_id)->where('nilg_course_id', $training->course_id)->update('per_nilg_training', $form_data);


                    //Update participant list is_complete '1'
                    $updae_data = array('is_complete' => '1', 'nilg_desig_id' => $get_data->crrnt_desig_id);
                    $this->Common_model->edit('training_participant', $value, 'id', $updae_data);
                }
            }
            echo json_encode(array('success' => true, 'message' => 'তথ্যটি সংরক্ষণ করা হয়েছে'));
            // return json_encode(array('success' => true,'message' => 'তথ্যটি সংরক্ষণ করা হয়েছে'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'কিছু ভুল হয়েছে, আবার চেষ্টা করুন'));
        }
    }


    public function get_certificate($id)
    {
        // $this->data['info'] = $this->Training_model->get_training_info($id);
        // $this->data['info'] = $this->Training_model->get_schedule_item($id);
        // $this->data['results'] = $this->Training_model->get_honorarium($id);

        // Load Page
        $this->data['meta_title'] = 'সার্টিফিকেট';
        $this->data['subview'] = 'get_certificate';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function pdf_certificate($participantID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['course_director'] = '';
        $this->data['dg'] = '';
        $this->data['jd'] = '';
        // Get Info
        $this->data['info'] = $this->Training_model->get_certificate($participantID);
        $trainingID = $this->data['info']->training_id;
        $this->data['subjects'] = $this->Training_model->get_training_mark($trainingID);
        $this->data['totalMark'] = $this->Training_model->get_training_mark_total($trainingID);
        // dd($this->data['totalMark']);
        // dd($this->data['info']);

        // Get Course Directory Name, Designation, Signature by User ID
        $this->data['course_director'] = $this->Training_model->get_course_director(30);
        // 83=মহাপরিচালক (অতিরিক্ত সচিব), 91=যুগ্ম-পরিচালক (প্রশিক্ষণ ও পরামর্শ)
        $this->data['dg'] = $this->Common_model->get_signature_by_designation(83);
        $this->data['jd'] = $this->Common_model->get_signature_by_designation(90);
        // dd($this->data['jd']);

        // Load View
        $this->data['headding'] = 'সনদপত্র';
        $html = $this->load->view('pdf_certificate', $this->data, true);
        // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

        // Generate PDF
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->useFixedNormalLineHeight = true;
        $mpdf->useFixedTextBaseline = true;
        $mpdf->adjustFontDescLineheight = 2.14;
        $mpdf->WriteHtml($html);
        $mpdf->output('Certificate.pdf', 'I');
    }

    public function pdf_certificate_landscape($participantID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['course_director'] = '';
        $this->data['dg'] = '';
        $this->data['jd'] = '';

        // Get Info
        $this->data['info'] = $this->Training_model->get_certificate($participantID);
        $trainingID = $this->data['info']->training_id;
        $this->data['subjects'] = $this->Training_model->get_training_mark($trainingID);
        $this->data['totalMark'] = $this->Training_model->get_training_mark_total($trainingID);
        // dd($this->data['info']);

        // Get Course Directory Name, Designation, Signature by User ID
        $this->data['course_director'] = $this->Training_model->get_course_director(30);
        // 83=মহাপরিচালক (অতিরিক্ত সচিব), 91=যুগ্ম-পরিচালক (প্রশিক্ষণ ও পরামর্শ)
        $this->data['dg'] = $this->Common_model->get_signature_by_designation(83);
        $this->data['jd'] = $this->Common_model->get_signature_by_designation(91);
        // dd($this->data['jd']);

        // Load View
        $this->data['headding'] = 'সনদপত্র';
        $html = $this->load->view('pdf_certificate_landscape', $this->data, true);

        // Generate PDF
        $mpdf = new mPDF('', 'A4-L', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->useFixedNormalLineHeight = true;
        $mpdf->useFixedTextBaseline = true;
        $mpdf->adjustFontDescLineheight = 2.14;
        $mpdf->WriteHtml($html);
        $mpdf->output('Certificate.pdf', 'I');
    }

    public function pdf_certificate_jica($participantID)
    {

        $this->data['course_director'] = '';
        $this->data['dg'] = '';
        $this->data['jd'] = '';

        // Get Info
        $this->data['info'] = $this->Training_model->get_certificate($participantID);
        $trainingID = $this->data['info']->training_id;
        $this->data['subjects'] = $this->Training_model->get_training_mark($trainingID);
        $this->data['totalMark'] = $this->Training_model->get_training_mark_total($trainingID);
        // dd($this->data['info']);

        // Get Course Directory Name, Designation, Signature by User ID
        $this->data['course_director'] = $this->Training_model->get_course_director(30);
        // 83=মহাপরিচালক (অতিরিক্ত সচিব), 91=যুগ্ম-পরিচালক (প্রশিক্ষণ ও পরামর্শ)
        $this->data['dg'] = $this->Common_model->get_signature_by_designation(83);
        $this->data['jd'] = $this->Common_model->get_signature_by_designation(91);
        // dd($this->data['jd']);

        // Load View
        $this->data['headding'] = 'সনদপত্র';
        $html = $this->load->view('pdf_certificate_jica', $this->data, true);

        // Generate PDF
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->useFixedNormalLineHeight = true;
        $mpdf->useFixedTextBaseline = true;
        $mpdf->adjustFontDescLineheight = 2.14;
        $mpdf->WriteHtml($html);
        $mpdf->output('Certificate.pdf', 'I');
    }






    /******************************** Trainer *********************************/
    /**************************************************************************/

    public function assigned_topic($offset = 0)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc', 'trainer'))) {
            redirect('dashboard');
        }

        $limit = 50;
        $results  = $this->Training_model->get_assigned_topic();
        // dd($results);

        // Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        // Pagination
        $this->data['pagination'] = create_pagination('training/assigned_topic/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Load page
        $this->data['meta_title'] = 'নির্ধারিত বিষয় সমূহ';
        $this->data['subview'] = 'assigned_topic';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // training_docs
    public function schedule_docs($scheduleID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc', 'trainer'))) {
            redirect('dashboard');
        }

        // Results
        $this->data['info']     = $this->Training_model->get_schedule_info($scheduleID);
        $this->data['training'] = $this->Training_model->get_training_info($this->data['info']->training_id);
        $this->data['documents'] = $this->Training_model->get_documents_by_schedule($scheduleID);
        // dd($this->data['info']);

        // $scheduleID  = $this->input->post('schedule_id');
        $trainingID     = $this->input->post('training_id');
        $courseID       = $this->input->post('course_id');
        $documentName   = $this->input->post('document_name');

        // Validate
        $this->form_validation->set_rules('document_name', 'document name', 'required|trim');
        // $this->form_validation->set_rules('userfile', 'file', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            // Upload
            if (!empty($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {
                $new_file_name = $scheduleID . '-' . time();

                /*$_FILES['userfile']['name']     = $value['name'][$s];
                $_FILES['userfile']['type']     = $value['type'][$s];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile']['error']    = $value['error'][$s];
                $_FILES['userfile']['size']     = $value['size'][$s];*/

                $config['upload_path']      = $this->training_docs_path;
                $config['allowed_types']    = 'gif|jpg|png|doc|docx|xls|xlsx|pdf';
                $config['max_size']         = '60000';
                $config['file_name']        = $new_file_name;
                //$config['max_width']        = '3000';
                //$config['max_height']       = '3000';
                // dd($new_file_name);
                $this->load->library('upload', $config);

                // Upload
                if ($this->upload->do_upload()) {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];

                    // Data Array
                    $file_data = array(
                        'document_name' => $documentName,
                        'file_name'     => $uploadedFile,
                        'training_id'   => $trainingID,
                        'schedule_id'   => $scheduleID,
                        'course_id'     => $courseID,
                        'uploader_id'   => $this->userSessID
                    );
                    // Save to DB
                    $this->Common_model->save('training_attachment', $file_data);
                }
            }

            // Success
            $this->session->set_flashdata('success', 'আপনার ফাইলটি সার্ভারে আপলোড করা হয়েছে');
            redirect("training/schedule_docs/" . $scheduleID);
        }

        /*$this->data['get_training'] = $this->Training_model->get_schedule_document_by_id($id, $schedule_id);
        $this->data['materials'] = $this->Common_model->get_materials_by_id($id, $schedule_id, $this->data['get_training']->course_id);*/
        // dd($this->data['materials']);

        $this->data['meta_title'] = 'ট্রেনিং ডকুমেন্ট';
        $this->data['subview'] = 'schedule_docs';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function schedule_docs_edit($documentID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc', 'trainer'))) {
            redirect('dashboard');
        }

        $this->data['document'] = $this->Training_model->get_documents_info($documentID);
        $scheduleID = $this->data['document']->schedule_id;
        // dd($document);
        // Results
        $this->data['info'] = $this->Training_model->get_schedule_info($scheduleID);
        // dd($this->data['info']);

        // Validate
        $this->form_validation->set_rules('document_name', 'document name', 'required|trim');

        // Validate Input Data
        if ($this->form_validation->run() == true) {
            $form_data = array('document_name' => $this->input->post('document_name'));

            if ($this->Common_model->edit('training_attachment', $documentID, 'id', $form_data)) {
                // Success
                $this->session->set_flashdata('success', 'আপনার ফাইলটি সার্ভারে আপলোড করা হয়েছে');
                redirect("training/schedule_docs/" . $scheduleID);
            }
        }

        /*$this->data['get_training'] = $this->Training_model->get_schedule_document_by_id($id, $schedule_id);
        $this->data['materials'] = $this->Common_model->get_materials_by_id($id, $schedule_id, $this->data['get_training']->course_id);*/
        // dd($this->data['materials']);

        $this->data['meta_title'] = 'ডকুমেন্টের  নাম সংশোধন';
        $this->data['subview'] = 'schedule_docs_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function schedule_docs_delete($documentID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc', 'trainer'))) {
            redirect('dashboard');
        }

        $info = $this->Training_model->get_documents_info($documentID);
        $path = base_url('uploads/training_docs/');
        // dd($path);

        // Delete from folder
        @unlink($path . $info->file_name);

        if ($this->Common_model->delete('training_attachment', 'id', $info->id)) {
            $this->session->set_flashdata('success', 'ফাইলটি সার্ভার থেকে মুছে ফেলা হয়েছে');
            redirect("training/schedule_docs/" . $info->schedule_id);
        } else {
            $this->session->set_flashdata('success', 'Something is wrong.');
            redirect("training/schedule_docs/" . $info->schedule_id);
        }
    }





    /********************************** Others ********************************/
    /**************************************************************************/

    public function search_course($offset = 0)
    {
        $limit = 50;
        $search = $this->input->post('search');
        if ($this->ion_auth->is_admin()) {
            $results = $this->Training_model->get_data_admin($limit, $offset);
        } elseif ($this->ion_auth->in_group('urt')) {
            $office = $this->Common_model->get_office_info_by_session();
            // dd($office);
            $results = $this->Training_model->get_data($limit, $offset, '', $office->upa_id, $search);
        } elseif ($this->ion_auth->in_group('ddlg')) {
            $office = $this->Common_model->get_office_info_by_session();
            // dd($office);
            $results = $this->Training_model->get_data($limit, $offset, $office->dis_id, '');
        }

        // dd($results); exit();
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        foreach ($this->data['results'] as $k => $row) {
            $this->data['results'][$k]->app = $this->Training_model->get_application_by_training_id($row->id);
        }

        // dd($this->data['results']);

        // Pagination
        $this->data['pagination'] = create_pagination('training/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // Load page
        $this->data['meta_title'] = 'প্রশিক্ষণ কোর্সের তালিকা';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function course_applicant($trainingID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $dataID = (int) decrypt_url($trainingID);
        // dd($dataID);

        // Check Exists
        if (!$this->Common_model->exists('training', 'id', $dataID)) {
            show_404('Training > course_applicant', TRUE);
        }

        $this->data['info'] = $this->Training_model->get_info($dataID);
        $this->data['applicants'] = $this->Training_model->get_applicant($dataID);
        // dd($this->data['applicants']);

        // Load page
        $this->data['meta_title'] = 'কোর্সে অংশগ্রহণকারী প্রশিক্ষণার্থীর তালিকা';
        $this->data['subview'] = 'course_applicant';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function applicant_verification($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $dataID = (int) decrypt_url($id); //exit;

        // Check Exists
        if (!$this->Common_model->exists('training_participant', 'id', $dataID)) {
            show_404('Training > applicant_verification', TRUE);
        }

        // Get applicant info
        $this->data['info'] = $this->Training_model->get_applicant_info($dataID);
        // dd($this->data['info']);

        // Validation
        // $this->form_validation->set_rules('verify_status', 'select verify status ', 'required|trim');

        // Validate and Input Data
        /*if ($this->form_validation->run() == true){
            $appID = $this->input->post('hide_app_id');
            $form_data = array(
                'is_verified'     => $this->input->post('verify_status')
                );
            // dd($form_data);

            if($this->Common_model->edit('training_participant', $appID, 'id', $form_data)){
                // echo $this->db->last_query(); exit;
                if($this->input->post('verify_status') == 1){
                    $this->session->set_flashdata('success', 'আবেদনটি গ্রহন করা হয়েছে');
                }elseif($this->input->post('verify_status') == 2){
                    $this->session->set_flashdata('success', 'আবেদনটি বাতিল করা হয়েছে');
                }
                redirect("training/course_applicant/".$this->data['info']->training_id);
            }
        }*/


        // print_r($this->data['info']); exit;
        // $this->data['verify_status'] = $this->Common_model->set_verification_status();
        // $this->data['participant_type'] = $this->Common_model->set_event_participant_type();

        //Load view
        $this->data['meta_title'] = 'প্রশিক্ষণার্থর তথ্য যাচাই';
        $this->data['subview'] = 'applicant_verification';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function accept($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $dataID = (int) decrypt_url($id);
        // dd($dataID);
        // Check Exists
        if (!$this->Common_model->exists('training_participant', 'id', $dataID)) {
            show_404('Training > accept', TRUE);
        }

        // Get applicant info
        $info = $this->Training_model->get_applicant_info($dataID);
        // dd($info);

        // Approve As Trainee
        // Get Groups
        $users_groups = $this->ion_auth_model->get_users_groups($info->app_user_id)->result();
        // dd($users_groups);
        // $groups_array = array();
        foreach ($users_groups as $group) {
            $groups_array[$group->id] = $group->name;
        }
        // $groups = implode(',', $groups_array);

        // Check existes 'guest' group
        if (in_array("guest", $groups_array)) {
            // echo "found";
            // Set Status
            if ($info->employee_type == 1) {
                $dataStatus = 2; // Public Representative
            } else {
                $dataStatus = 1; // Employee
            }

            $userData = array(
                'is_applied'     => 0,
                'is_verify'      => 1,
                'status'         => $dataStatus,
            );
            // dd($userData);
            // Update user table
            if ($this->Common_model->edit('users', $info->app_user_id, 'id', $userData)) {
                // Change user group 'guest' to 'trainee'
                $this->ion_auth->remove_from_group('', $info->app_user_id);
                $this->ion_auth->add_to_group('10', $info->app_user_id);
            }
        }
        // dd($groups_array);


        // Approve Training Participaint
        $form_data = array(
            'is_apply'    => 0,
            'is_verified' => 1
        );
        // print_r($id);exit();

        if ($this->Common_model->edit('training_participant', $dataID, 'id', $form_data)) {
            // Change user group 'guest' to 'trainee'
            // $this->ion_auth->remove_from_group('', $id);
            // $this->ion_auth->add_to_group('10', $id);

            // echo $this->db->last_query(); exit;
            $this->session->set_flashdata('success', 'আবেদনটি যাচাই করে প্রশিক্ষণার্থী হিসাবে নিবন্ধন করা হয়েছে');
            redirect("training/course_applicant/" . encrypt_url($info->training_id));
        }
    }

    public function decline($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $dataID = (int) decrypt_url($id);
        // dd($dataID);

        // Check Exists
        if (!$this->Common_model->exists('training_participant', 'id', $dataID)) {
            show_404('Training > decline', TRUE);
        }

        // Get applicant info
        $info = $this->Training_model->get_applicant_info($dataID);
        // dd($info);

        // Delete Applican from training participant list
        if ($this->Common_model->delete('training_participant', 'id', $dataID)) {
            $this->session->set_flashdata('success', 'আবেদনটি বাতিল করা হয়েছে');
            redirect("training/course_applicant/" . encrypt_url($info->training_id));
        }

        /*$form_data = array(
            'is_apply'    => 0
            );
            // print_r($id);exit();

        if($this->Common_model->edit('training_participant', $dataID, 'id', $form_data)){
            $this->session->set_flashdata('success', 'আবেদনটি বাতিল করা হয়েছে');
            redirect("training/course_applicant/".encrypt_url($info->training_id));
        }*/
    }

    public function individual_marksheet($trainingID, $userID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['info'] = $this->Training_model->get_info($trainingID);
        // $this->data['subjects'] = $this->Training_model->get_training_mark($trainingID);

        $this->data['user'] = $this->Training_model->get_user_info($userID);
        $this->data['marksheet'] = $this->Training_model->get_marksheet($trainingID, $userID);
        // dd($this->data['info']);

        // Load page
        $this->data['meta_title'] = 'ব্যক্তিগত মার্কশীট';
        $this->data['subview'] = 'individual_marksheet';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function user_mark($trainingID, $userID)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // $this->data['subjects'] = $this->Training_model->get_training_mark($trainingID);

        // $this->data['user'] = $this->Training_model->get_user_info($userID);
        $marksheet = $this->Training_model->get_marksheet($trainingID, $userID);

        $getMark = $totalMark = 0;
        foreach ($marksheet as $row) {
            $getMark += $row->mark;
            $totalMark += $row->set_training_mark;
        }
        // Mark Percent
        $resultPercent = ($getMark * 100) / $totalMark;
        $number = number_format($resultPercent, 2);
        // $grade = $this->gradeInWords($number);
        // dd($data);

        return $data = [$getMark, $totalMark, $number];
    }

    function gradeInWords($grade)
    {
        switch ($grade) {
            case $grade <= 50:
                echo 'অকৃতকার্য';
                break;
            case $grade <= 50.60 && $grade > 50:
                echo 'সি (চলতি মান)';
                break;
            case $grade <= 60.70 && $grade > 50.60:
                echo 'বি (উচ্চ চলতি মান)';
                break;
            case $grade <= 70.80 && $grade > 60.70:
                echo 'বি (সন্তোষজনক)';
                break;
            case $grade <= 80.85 && $grade > 70.80:
                echo 'বি+ (ভাল)';
                break;
            case $grade <= 85.90 && $grade > 80.85:
                echo 'এ (উত্তম)';
                break;
            case $grade <= 90.95 && $grade > 85.90:
                echo 'এ (অতি উত্তম)';
                break;
            case $grade <= 95 && $grade > 90.95:
                echo 'এ+ (অসাধারণ)';
                break;
            case $grade <= 100:
                echo 'এ+ (অসাধারণ)';
                break;
            default:
                echo '';
        }
    }


    /**************************** Training CRUD Start *************************/
    /**************************************************************************/

    public function details($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $this->data['training'] = $this->Training_model->get_training_info($id);
        $this->data['materials'] = $this->Training_model->get_training_material($id);
        $this->data['coordinators'] = $this->Training_model->get_course_coordinator($id);
        // dd($this->data['training']);
        $this->data['subjects'] = $this->Training_model->get_training_mark($id);

        // Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণের বিস্তারিত তথ্য';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create()
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // Default Value
        $divisionID = $districtID = $upazilaID = NULL;

        // Validation
        $this->form_validation->set_rules('participant_name', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্সের বিষয়', 'required|trim');
        $this->form_validation->set_rules('lgi_type', 'এলজিআই এর ধরণ', 'required|trim');
        $this->form_validation->set_rules('course_type', 'প্রশিক্ষণার্থীর ধরণ', 'required|trim');
        $this->form_validation->set_rules('batch_no', 'ব্যাচ নং', 'required|trim');
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('financing_id', 'অর্থায়নে', 'required|trim');
        // $this->form_validation->set_rules('chahida_potro', 'চাহিদা পত্র', 'required|trim');
        /*if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
        } */
        // Validata and Insert Data
        if ($this->form_validation->run() == true) {

            // Get office info
            $office = $this->Common_model->get_office_info_by_session();

            $officeID   = $office->crrnt_office_id;
            $officeType = $office->office_type;
            $divisionID = $office->div_id;
            $districtID = $office->dis_id;
            $upazilaID  = $office->upa_id;

            if (empty($office)) {
                $this->session->set_flashdata('success', 'দয়া করে, আগে লগইন করেন');
                redirect('login');
            }
            if (empty($this->userSessID)) {
                $this->session->set_flashdata('success', 'দয়া করে, আগে লগইন করেন');
                redirect('login');
            }

            $form_data = array(
                'participant_name'    => $this->input->post('participant_name'),
                'course_id'         => $this->input->post('course_id'),
                'batch_no'          => $this->input->post('batch_no'),
                'course_type'       => $this->input->post('course_type'),
                // 'type_id'           => $this->input->post('type_id'),
                'lgi_type'          => $this->input->post('lgi_type'),
                'reg_start_date'    => $this->input->post('reg_start_date'),
                'reg_end_date'      => $this->input->post('reg_end_date'),
                'start_date'        => $this->input->post('start_date'),
                'end_date'          => $this->input->post('end_date'),
                'ta'                => $this->input->post('ta'),
                'da'                => $this->input->post('da'),
                'tra_a'             => $this->input->post('tra_a'),
                'dress'             => $this->input->post('dress'),
                'signature'         => $this->input->post('signature'),
                'financing_id'      => $this->input->post('financing_id'),
                'certificate_id'    => $this->input->post('certificate_id'),
                'certificate_text'  => $this->input->post('certificate_text'),
                'user_id'           => $this->userSessID,
                'office_id'         => $officeID,
                // 'chahida_potro_id'  => $this->input->post('chahida_potro'),
                'division_id'       => $divisionID != NULL ? $divisionID : NULL,
                'district_id'       => $districtID != NULL ? $districtID : NULL,
                'upazila_id'        => $upazilaID != NULL ? $upazilaID : NULL,
                'created'           => date('Y-m-d H:i:s')
            );

            // Insert to DB
            if ($this->Common_model->save('training', $form_data)) {

                // Last training id
                $lastID = $this->db->insert_id();
                // $this->db->where('id', $this->input->post('chahida_potro'));
                // $this->db->update('budget_chahida_potro', array('training_id' => $lastID));
                // Generate QR Code
                $this->qrcode_generator($lastID, $this->input->post('lgi_type'));

                // Course Coordinator manage training
                if (isset($_POST['coordinator_id'])) {
                    for ($i = 0; $i < sizeof($_POST['coordinator_id']); $i++) {
                        $data_array = array(
                            'training_id'       => $lastID,
                            'user_id'           => $_POST['coordinator_id'][$i],
                            'course_desig_id'   => $_POST['course_desig_id'][$i]
                        );
                        $this->Common_model->save('training_coordinator', $data_array);
                    }
                }

                // Evaluation Training Mark
                if (isset($_POST['subject_id'])) {
                    for ($i = 0; $i < sizeof($_POST['subject_id']); $i++) {
                        $data_array = array(
                            'training_id'   => $lastID,
                            'subject_id'    => $_POST['subject_id'][$i],
                            'mark'          => $_POST['mark'][$i],
                            'emt_id'        => func_eva_mark_type_id($_POST['subject_id'][$i])
                        );
                        $this->Common_model->save('training_mark', $data_array);
                    }
                }

                // Training Material
                if (isset($_POST['tm_id'])) {
                    for ($i = 0; $i < sizeof($_POST['tm_id']); $i++) {
                        $data_array = array(
                            'training_id'   => $lastID,
                            'tm_id'         => $_POST['tm_id'][$i]
                        );
                        $this->Common_model->save('training_material', $data_array);
                    }
                }


                // Handbook Upload
                if ($_FILES['userfile']['size'][0] > 0) {

                    $this->load->library('upload');
                    $files = $_FILES;
                    $cpt = count($_FILES['userfile']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                        $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                        $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                        $file_name = time() . $i . '-' . $lastID;

                        $this->upload->initialize($this->set_upload_options($file_name, $this->handbook_path));

                        // $this->form_validation->set_rules('userfile', '', 'callback_file_check');
                        // if ($this->form_validation->run() == true){
                        if ($this->upload->do_upload('userfile')) {
                            $uploadData = $this->upload->data();

                            // print_r($uploadData);
                            // DB fields
                            $uploadedFile = $uploadData['file_name'];
                            $handbook = $this->db->where('id', $lastID)->get('training')->row()->handbook;

                            if ($handbook != '' && $handbook != null) {
                                if (is_array(json_decode($handbook))) {
                                    $user_data = json_decode($handbook);
                                    array_push($user_data, $uploadedFile);
                                } else {
                                    $user_data = array($handbook, $uploadedFile);
                                }
                            } else {
                                $user_data  = array($uploadedFile);
                            }

                            $file_data['handbook'] = json_encode($user_data);

                            $this->db->where('id', $lastID)->update('training', $file_data);
                        } else {
                            $this->data['message'] = $this->upload->display_errors();
                        }
                        // }
                    }
                }

                // dd('ok');
                // voucher Upload
                if ($_FILES['voucherfile']['size'] > 0) {

                    $this->load->library('upload');
                    $files = $_FILES;
                    $cpt = count($_FILES['voucherfile']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['voucherfile']['name'] = $files['voucherfile']['name'][$i];
                        $_FILES['voucherfile']['type'] = $files['voucherfile']['type'][$i];
                        $_FILES['voucherfile']['tmp_name'] = $files['voucherfile']['tmp_name'][$i];
                        $_FILES['voucherfile']['error'] = $files['voucherfile']['error'][$i];
                        $_FILES['voucherfile']['size'] = $files['voucherfile']['size'][$i];

                        $file_name = time() . $i . '-' . $lastID;

                        $this->upload->initialize($this->set_upload_options($file_name, $this->voucher_path));
                        if ($this->upload->do_upload('voucherfile')) {
                            $uploadData = $this->upload->data();

                            // print_r($uploadData);
                            // DB fields
                            $uploadedFile = $uploadData['file_name'];
                            $voucher = $this->db->where('id', $lastID)->get('training')->row()->voucher;

                            if ($voucher != '' && $voucher != null) {
                                if (is_array(json_decode($voucher))) {
                                    $user_data = json_decode($voucher);
                                    array_push($user_data, $uploadedFile);
                                } else {
                                    $user_data = array($voucher, $uploadedFile);
                                }
                            } else {
                                $user_data  = array($uploadedFile);
                            }

                            $file_data['voucher'] = json_encode($user_data);

                            $this->db->where('id', $lastID)->update('training', $file_data);
                        } else {
                            $this->data['message'] = $this->upload->display_errors();
                        }
                    }
                }

                // Video Upload
                if ($_FILES['videofile']['size'] > 0) {
                    $new_file_name = time() . '-' . $lastID;
                    $config['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
                    $config['upload_path']  = $this->video_path;
                    $config['file_name']    = $new_file_name;
                    $config['max_size']     = '';

                    $this->load->library('upload', $config);
                    //upload file to directory
                    if ($this->upload->do_upload('videofile')) {
                        $uploadData = $this->upload->data();
                        /*$uploadData = $this->upload->data();
                        $config = array(
                            'source_image' => $uploadData['full_path'],
                            'new_image' => $this->handbook_path,
                            'maintain_ratio' => TRUE,
                            'width' => 300,
                            'height' => 300
                            );
                        $this->load->library('image_lib',$config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();*/

                        // DB fields
                        $user_data  = array($uploadData['file_name']);
                        $file_data['video'] = json_encode($user_data);

                        $this->Common_model->edit('training', $lastID, 'id', $file_data);
                    } else {
                        $this->data['message'] = $this->upload->display_errors();
                    }
                }

                // Redirect and success message
                $this->session->set_flashdata('success', 'প্রশিক্ষণটি ডাটাবেজে সংরক্ষণ করা হয়েছে');
                redirect('training');
            }
        }

        // $this->data['user_info'] = $this->ion_auth->user()->row();
        // Dropdown
        $this->data['courses'] = $this->Common_model->get_course();
        $this->data['course_type'] = $this->Common_model->get_course_type();
        $this->data['course_designation'] = $this->Common_model->get_course_designation();
        $this->data['lgi_type'] = $this->Common_model->get_lg_institute_type();
        // $this->data['evaluation_subject'] = $this->Common_model->get_evaluation_subject();
        // $this->data['mark_entry_type'] = $this->Common_model->set_mark_entry_type();
        $this->data['financing_list'] = $this->Common_model->get_financing();
        $this->data['training_type'] = $this->Common_model->get_training_type();
        $this->data['certificate_templates'] = $this->Common_model->get_certificate_templates();
        $this->data['materials'] = $this->Common_model->get_material();
        // $this->data['coordinator'] = $this->Training_model->get_coordinator();

        // Load view
        $this->data['meta_title'] = 'প্রশিক্ষণ এন্ট্রি ফরম';
        $this->data['subview'] = 'create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id, $offset = null)
    {
        ini_set('memory_limit', '500M');
        ini_set('upload_max_filesize', '500M');
        ini_set('post_max_size', '500M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $offset = (int) decrypt_url($offset);

        // Get data
        $this->data['training'] = $this->Training_model->get_info($id);
        $this->data['training_marks'] = $this->Training_model->get_training_mark($id);
        $this->data['coordinators'] = $this->Training_model->get_course_coordinator($id);
        $this->data['training_materials'] = $this->Training_model->get_training_material($id);
        // dd($this->data['training']);

        // Validation
        // $this->form_validation->set_rules('training_title', 'ট্রেনিং কোর্সের শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('participant_name', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্সের বিষয়', 'required|trim');
        $this->form_validation->set_rules('course_type', 'প্রশিক্ষণার্থীর ধরণ', 'required|trim');
        $this->form_validation->set_rules('batch_no', 'ব্যাচ নং', 'required|trim');
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('financing_id', 'অর্থায়নে', 'required|trim');
        /*if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
        }
        if(@$_FILES['voucherfile']['size'] > 0){
            $this->form_validation->set_rules('voucherfile', '', 'callback_file_check');
        }*/

        // Validata and Insert Data
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'participant_name'  => $this->input->post('participant_name'),
                'course_id'         => $this->input->post('course_id'),
                'course_type'       => $this->input->post('course_type'),
                'batch_no'          => $this->input->post('batch_no'),
                'type_id'           => $this->input->post('type_id'),
                'reg_start_date'    => $this->input->post('reg_start_date'),
                'reg_end_date'      => $this->input->post('reg_end_date'),
                'start_date'        => $this->input->post('start_date'),
                'end_date'          => $this->input->post('end_date'),
                'ta'                => $this->input->post('ta'),
                'da'                => $this->input->post('da'),
                'tra_a'             => $this->input->post('tra_a'),
                'dress'             => $this->input->post('dress'),
                'it_deduction'      => $this->input->post('it_deduction'),
                'honorarium_text'   => $this->input->post('honorarium_text'),
                'signature'         => $this->input->post('signature'),
                'financing_id'      => $this->input->post('financing_id'),
                'certificate_id'    => $this->input->post('certificate_id'),
                'certificate_text'  => $this->input->post('certificate_text'),
                'is_published'      => $this->input->post('is_published'),
                'status'            => $this->input->post('status'),
                'updated'           => date('Y-m-d H:i:s')
            );
            // print_r($form_data); exit;

            if ($this->Common_model->edit('training', $id, 'id', $form_data)) {
                // dd($_POST);

                // Course Coordinator manage training
                if (isset($_POST['coordinator_id'])) {
                    for ($i = 0; $i < sizeof($_POST['coordinator_id']); $i++) {
                        //check exists data
                        @$data_exists = $this->Common_model->exists('training_coordinator', 'id', $_POST['hide_cc_row_id'][$i]);
                        if ($data_exists) {
                            $data = array(
                                'user_id'           => $_POST['coordinator_id'][$i],
                                'course_desig_id'   => $_POST['course_desig_id'][$i]
                            );
                            $this->Common_model->edit('training_coordinator', $_POST['hide_cc_row_id'][$i], 'id', $data);
                        } else {
                            $data = array(
                                'training_id'       => $id,
                                'user_id'           => $_POST['coordinator_id'][$i],
                                'course_desig_id'   => $_POST['course_desig_id'][$i]
                            );
                            $this->Common_model->save('training_coordinator', $data);
                        }
                    }
                }

                // Training mark new insert and update
                if (isset($_POST['subject_id'])) {
                    for ($i = 0; $i < count($_POST['subject_id']); $i++) {
                        //check exists data
                        @$data_exists = $this->Common_model->exists('training_mark', 'id', $_POST['hide_id'][$i]);
                        if ($data_exists) {
                            $data = array(
                                'subject_id' => $_POST['subject_id'][$i],
                                'mark'       => $_POST['mark'][$i],
                                'emt_id'     => func_eva_mark_type_id($_POST['subject_id'][$i])
                            );
                            $this->Common_model->edit('training_mark', $_POST['hide_id'][$i], 'id', $data);
                        } else {
                            $data = array(
                                'training_id' => $id,
                                'subject_id' => $_POST['subject_id'][$i],
                                'mark'       => $_POST['mark'][$i],
                                'emt_id'     => func_eva_mark_type_id($_POST['subject_id'][$i])
                            );
                            $this->Common_model->save('training_mark', $data);
                        }
                    }
                }

                // Training Material
                if (isset($_POST['tm_id'])) {
                    for ($i = 0; $i < sizeof($_POST['tm_id']); $i++) {
                        //check exists data
                        @$data_exists = $this->Common_model->exists('training_material', 'id', $_POST['hide_material_row_id'][$i]);
                        if ($data_exists) {
                            $data = array(
                                'tm_id'     => $_POST['tm_id'][$i]
                            );
                            $this->Common_model->edit('training_material', $_POST['hide_material_row_id'][$i], 'id', $data);
                        } else {
                            $data = array(
                                'training_id' => $id,
                                'tm_id'       => $_POST['tm_id'][$i]
                            );
                            $this->Common_model->save('training_material', $data);
                        }
                    }
                }

                // Handbook Upload
                if ($_FILES['userfile']['size'][0] > 0) {

                    $this->load->library('upload');
                    $files = $_FILES;
                    $cpt = count($_FILES['userfile']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                        $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                        $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                        $file_name = time() . $i . '-' . $id;

                        $this->upload->initialize($this->set_upload_options($file_name, $this->handbook_path));

                        // $this->form_validation->set_rules('userfile', '', 'callback_file_check');
                        // if ($this->form_validation->run() == true){
                        if ($this->upload->do_upload('userfile')) {
                            $uploadData = $this->upload->data();

                            // print_r($uploadData);
                            // DB fields
                            $uploadedFile = $uploadData['file_name'];
                            $handbook = $this->db->where('id', $id)->get('training')->row()->handbook;

                            if ($handbook != '' && $handbook != null) {
                                if (is_array(json_decode($handbook))) {
                                    $user_data = json_decode($handbook);
                                    array_push($user_data, $uploadedFile);
                                } else {
                                    $user_data = array($handbook, $uploadedFile);
                                }
                            } else {
                                $user_data  = array($uploadedFile);
                            }

                            $file_data['handbook'] = json_encode($user_data);

                            $this->db->where('id', $id)->update('training', $file_data);
                        } else {
                            $this->data['message'] = $this->upload->display_errors();
                        }
                        // }
                    }
                }

                // dd('ok');
                // voucher Upload
                if ($_FILES['voucherfile']['size'] > 0) {

                    $this->load->library('upload');
                    $files = $_FILES;
                    $cpt = count($_FILES['voucherfile']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['voucherfile']['name'] = $files['voucherfile']['name'][$i];
                        $_FILES['voucherfile']['type'] = $files['voucherfile']['type'][$i];
                        $_FILES['voucherfile']['tmp_name'] = $files['voucherfile']['tmp_name'][$i];
                        $_FILES['voucherfile']['error'] = $files['voucherfile']['error'][$i];
                        $_FILES['voucherfile']['size'] = $files['voucherfile']['size'][$i];

                        $file_name = time() . $i . '-' . $id;

                        $this->upload->initialize($this->set_upload_options($file_name, $this->voucher_path));
                        if ($this->upload->do_upload('voucherfile')) {
                            $uploadData = $this->upload->data();

                            // print_r($uploadData);
                            // DB fields
                            $uploadedFile = $uploadData['file_name'];
                            $voucher = $this->db->where('id', $id)->get('training')->row()->voucher;

                            if ($voucher != '' && $voucher != null) {
                                if (is_array(json_decode($voucher))) {
                                    $user_data = json_decode($voucher);
                                    array_push($user_data, $uploadedFile);
                                } else {
                                    $user_data = array($voucher, $uploadedFile);
                                }
                            } else {
                                $user_data  = array($uploadedFile);
                            }

                            $file_data['voucher'] = json_encode($user_data);

                            $this->db->where('id', $id)->update('training', $file_data);
                        } else {
                            $this->data['message'] = $this->upload->display_errors();
                        }
                    }
                }


                // video Upload
                if ($_FILES['videofile']['size'] > 0) {
                    $new_file_name = time() . '-' . $id;
                    $config['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
                    $config['upload_path']  = $this->video_path;
                    $config['file_name']    = $new_file_name;
                    $config['max_size']     = '';

                    $this->load->library('upload', $config);
                    //upload file to directory
                    if ($this->upload->do_upload('videofile')) {
                        $uploadData = $this->upload->data();
                        /*$config = array(
                            'source_image' => $uploadData['full_path'],
                            'new_image' => $this->video_path,
                            'maintain_ratio' => TRUE,
                            'width' => 300,
                            'height' => 300
                            );
                        $this->load->library('image_lib',$config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();*/

                        $uploadedFile = $uploadData['file_name'];
                        // print_r($uploadedFile);
                        // DB fields
                        $file_data['video'] = $uploadedFile;

                        if ($this->data['training']->video != '' && $this->data['training']->video != null) {
                            if (is_array(json_decode($this->data['training']->video))) {
                                $user_data = json_decode($this->data['training']->video);
                                array_push($user_data, $uploadedFile);
                            } else {
                                $user_data = array($this->data['training']->video, $uploadedFile);
                            }
                        } else {
                            $user_data  = array($uploadedFile);
                        }

                        $file_data['video'] = json_encode($user_data);


                        $this->Common_model->edit('training', $id, 'id', $file_data);
                    } else {
                        $this->data['message'] = $this->upload->display_errors();
                    }
                }

                // Redirct and success message
                $this->session->set_flashdata('success', 'প্রশিক্ষণের তথ্য সংশোধন করা হয়েছে');
                if ($offset != 0) {
                    redirect('training/index/' . $offset);
                }
                redirect('training');
            }
        }

        // Dropdown
        $this->data['courses'] = $this->Common_model->get_course();
        $this->data['course_type'] = $this->Common_model->get_course_type();
        $this->data['course_designation'] = $this->Common_model->get_course_designation();
        $this->data['evaluation_subject'] = $this->Common_model->get_evaluation_subject($this->data['training']->course_type);
        $this->data['mark_entry_type'] = $this->Common_model->set_mark_entry_type();
        $this->data['financing_list'] = $this->Common_model->get_financing();
        $this->data['training_type'] = $this->Common_model->get_training_type();
        $this->data['training_status'] = $this->Common_model->get_training_status();
        $this->data['certificate_templates'] = $this->Common_model->get_certificate_templates();
        $this->data['materials'] = $this->Common_model->get_material();

        // print_r($this->data['main_cc']); exit;

        //Load View
        $this->data['meta_title'] = 'প্রশিক্ষণের তথ্য সংশোধন';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


    //upload an image options
    private function set_upload_options($file_name, $path)
    {
        //upload an image options
        $config = array();
        $config['allowed_types'] = 'jpg|png|jpeg|pdf|xlsx|xls';
        $config['upload_path']  = $path;
        $config['file_name']    = $file_name;
        // $config['max_size']     = '104857600';
        $config['max_size'] = '1000000';
        $config['max_width']  = '1024000';
        $config['max_height']  = '768000';
        $config['overwrite']     = FALSE;

        return $config;
    }

    public function duplicate($id)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        // echo $id;
        $this->data['user_info'] = $this->ion_auth->user()->row();
        $this->data['course_list'] = $this->Common_model->get_nilg_course();
        $this->data['financing_list'] = $this->Common_model->get_financing();
        $this->data['training_type'] = $this->Common_model->get_training_type();
        $this->data['coordinator'] = $this->Training_model->get_coordinator();

        // Get Training Data
        $training = $this->Training_model->get_duplicate_info($id);
        $schedule = $this->Training_model->get_schedule($id);

        // Validation
        $this->form_validation->set_rules('participant_name', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('batch_no', 'ব্যাচ নং', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্সের বিষয়', 'required|trim');
        $this->form_validation->set_rules('start_date', 'শুরুর তারিখ', 'required|trim');
        $this->form_validation->set_rules('end_date', 'শেষের তারিখ', 'required|trim');
        $this->form_validation->set_rules('financing_id', 'অর্থায়নে', 'required|trim');

        // Inser DB
        if ($this->form_validation->run() == true || $this->form_validation->run() == false) {
            $form_data = array(
                'participant_name'  => $training['info']->participant_name,
                'course_id'         => $training['info']->course_id,
                'course_type'       => $training['info']->course_type,
                'batch_no'          => $training['info']->batch_no,
                'type_id'           => $training['info']->type_id,
                'course_no'         => $training['info']->course_no,
                'reg_start_date'    => $training['info']->reg_start_date,
                'reg_end_date'      => $training['info']->reg_end_date,
                'start_date'        => $training['info']->start_date,
                'end_date'          => $training['info']->end_date,
                'ta'                => $training['info']->ta,
                'da'                => $training['info']->da,
                'tra_a'             => $training['info']->tra_a,
                'tra_status'        => $training['info']->tra_status,
                'dress'             => $training['info']->dress,
                'financing_id'      => $training['info']->financing_id,
                'lgi_type'          => $training['info']->lgi_type,
                'is_manual_mark'    => $training['info']->is_manual_mark,
                'certificate_id'    => $training['info']->certificate_id,
                'certificate_text'  => $training['info']->certificate_text,
                'signature'         => $training['info']->signature,
                'handbook'          => $training['info']->handbook,
                'voucher'           => $training['info']->voucher,
                'video'             => $training['info']->video,
                'it_deduction'      => $training['info']->it_deduction,
                'honorarium_text'   => $training['info']->honorarium_text,
                'user_id'           => $this->userSessID,
                'office_id'         => $training['info']->office_id,
                'division_id'       => $training['info']->division_id,
                'district_id'       => $training['info']->district_id,
                'upazila_id'        => $training['info']->upazila_id,
                'created'           => date('Y-m-d H:i:s'),
                'training_title'    => $training['info']->training_title,
                'cd_name'           => $training['info']->cd_name,
                'cd_designation'    => $training['info']->cd_designation,
                'cc_name'           => $training['info']->cc_name,
                'cc_designation'    => $training['info']->cc_designation,
            );

            if ($this->Common_model->save('training', $form_data)) {

                // Last training management id
                $lastID = $this->db->insert_id();

                // Generate QR Code
                $this->qrcode_generator($lastID, $training['info']->lgi_type);

                // Course Coordinator manage training
                $coordinators = $this->db->where('training_id', $id)->get('training_coordinator');
                if ($coordinators->num_rows() > 0) {
                    foreach ($coordinators->result() as $key => $value) {
                        $data_array = array(
                            'training_id'        => $lastID,
                            'user_id'            => $value->user_id,
                            'course_desig_id'    => $value->course_desig_id,
                            'course_designation' => $value->course_designation,
                        );
                        $this->Common_model->save('training_coordinator', $data_array);
                    }
                }


                // Evaluation Training Mark
                $marks = $this->db->where('training_id', $id)->get('training_mark');
                if ($marks->num_rows() > 0) {
                    foreach ($marks->result() as $key => $value) {
                        $data_array = array(
                            'training_id'   => $lastID,
                            'subject_id'    => $value->subject_id,
                            'mark'          => $value->mark,
                            'emt_id'        => $value->emt_id,
                        );
                        $this->Common_model->save('training_mark', $data_array);
                    }
                }

                // Training Material
                $materials = $this->db->where('training_id', $id)->get('training_material');
                if ($materials->num_rows() > 0) {
                    foreach ($materials->result() as $key => $value) {
                        $data_array = array(
                            'training_id'   => $lastID,
                            'tm_id'         => $value->tm_id,
                        );
                        $this->Common_model->save('training_material', $data_array);
                    }
                }


                // Insert Schedule
                for ($i = 0; $i < count($schedule); $i++) {
                    $data = array(
                        'training_id'   => $lastID,
                        'program_date'  => $schedule[$i]->program_date,
                        'time_start'    => $schedule[$i]->time_start,
                        'time_end'      => $schedule[$i]->time_end,
                        'session_no'    => $schedule[$i]->session_no,
                        'topic'         => $schedule[$i]->topic,
                        'speakers'      => $schedule[$i]->speakers,
                        'trainer_id'    => $schedule[$i]->trainer_id,
                        'honorarium'    => $schedule[$i]->honorarium,
                        'is_honorarium' => $schedule[$i]->is_honorarium
                    );
                    $this->Common_model->save('training_schedule', $data);
                }

                // Insert to evaluation
                $evaluation = $this->db->where('training_id', $id)->get('evaluation');
                if ($evaluation->num_rows() > 0) {
                    foreach ($evaluation->result() as $key => $value) {
                        $evu_data = array(
                            'exam_type'        => $value->exam_type, // PRE
                            'exam_set'         => $value->exam_set,
                            'training_id'      => $lastID,
                            'course_id'        => $value->course_id,
                            'training_mark_id' => $value->training_mark_id,
                            'is_published'     => 0,
                            'created'          => date('Y-m-d H:i:s')
                        );

                        if ($this->Common_model->save('evaluation', $evu_data)) {
                            // Last insert id
                            $evaluaID = $this->db->insert_id();
                            $evaQS = $this->db->where('evaluation_id', $value->id)->get('evaluation_question');

                            // Insert to Question
                            foreach ($evaQS->result() as $key => $va) {
                                $data_array = array(
                                    'evaluation_id' => $evaluaID,
                                    'question_id' => $va->question_id,
                                );
                                $this->Common_model->save('evaluation_question', $data_array);
                            }
                        }
                    }
                }

                // Redirect and success message
                $this->session->set_flashdata('success', 'Training duplicate successfully!');
                redirect('training');
            } else {
                // Redirect and success message
                $this->session->set_flashdata('warning', 'Something is wrong!');
                redirect('training');
            }
        }
    }

    public function handbook_delete($trainingID, $delete_file = NULL)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $info = $this->Common_model->get_info('training', $trainingID);
        $path = $this->handbook_path . '/';
        // dd($info->handbook);

        // Delete from folder
        if ($delete_file != NULL) {

            @unlink($path . $delete_file);

            // dd($info->handbook);
            $array = json_decode($info->handbook);
            $key = array_search($delete_file, $array, true);
            unset($array[$key]);

            $data = array('handbook' => json_encode(array_values($array)));
            // dd($data);

        } else {
            @unlink($path . $info->handbook);
            $data = array('handbook' => NULL);
        }


        if ($this->Common_model->edit('training', $trainingID, 'id', $data)) {
            $this->session->set_flashdata('success', 'ফাইলটি সার্ভার থেকে মুছে ফেলা হয়েছে');
            redirect("training/edit/" . $trainingID);
        } else {
            $this->session->set_flashdata('success', 'Something is wrong.');
            redirect("training/edit/" . $trainingID);
        }
    }


    public function voucher_delete($trainingID, $delete_file = NULL)
    {
        // Check Auth
        if (!$this->ion_auth->in_group(array('admin', 'uz', 'ddlg', 'nilg', 'cc'))) {
            redirect('dashboard');
        }

        $info = $this->Common_model->get_info('training', $trainingID);
        $path = $this->voucher_path . '/';
        // dd($info->voucher);
        // dd($path.$delete_file);

        // Delete from folder
        if ($delete_file != NULL) {

            @unlink($path . $delete_file);

            // dd($info->voucher);
            $array = json_decode($info->voucher);
            $key = array_search($delete_file, $array, true);
            unset($array[$key]);

            $data = array('voucher' => json_encode(array_values($array)));
            // dd($data);

        } else {
            @unlink($path . $info->voucher);
            $data = array('voucher' => NULL);
        }


        if ($this->Common_model->edit('training', $trainingID, 'id', $data)) {
            $this->session->set_flashdata('success', 'ফাইলটি সার্ভার থেকে মুছে ফেলা হয়েছে');
            redirect("training/edit/" . $trainingID);
        } else {
            $this->session->set_flashdata('success', 'Something is wrong.');
            redirect("training/edit/" . $trainingID);
        }
    }

    public function delete_training($id)
    {
        // Check Auth
        if (!$this->ion_auth->is_admin()) {
            redirect('dashboard');
        }

        // Delete Training
        if ($this->db->delete('training', array('id' => $id))) {
            // Delete row from training_mark table .....
            $this->db->delete('training_mark', array('training_id' => $id));
            $this->db->delete('training_attachment', array('training_id' => $id));
            $this->db->delete('training_coordinator', array('training_id' => $id));
            $this->db->delete('training_material', array('training_id' => $id));
            $this->db->delete('training_participant', array('training_id' => $id));
            $this->db->delete('training_schedule', array('training_id' => $id));

            $this->session->set_flashdata('success', 'Deleted traning successful');
            redirect('training');
        }
    }


    /************************** Common Function ******************************
     ***************************************************************************/

    public function qrcode_generator($trainingID, $lgiType)
    {
        // LGI Office
        // 1=UP-Union Parishad; 2=PA-Paurashava; 3=UZ-Upazila Parishad; 4=ZP-Zila Parishad; 5=CC-City Corporation; 7=N-NILG
        // Get last course no from training table accourding to LGI office type then +1 with course na and concatnate prefix.

        // Get Batch Number
        $getBatch = $this->Training_model->get_batch_no($trainingID);
        $batchNo = str_pad($getBatch, 3, "0", STR_PAD_LEFT);
        // Get MAX Number accourding to LGI Type
        $getCourse = $this->Training_model->get_max_course_no($lgiType);
        $courseNo = str_pad($getCourse, 4, "0", STR_PAD_LEFT); //exit;
        // dd($courseNo);

        if ($lgiType == 1) {
            $preFix = 'UP';
        } elseif ($lgiType == 2) {
            $preFix = 'PA';
        } elseif ($lgiType == 3) {
            $preFix = 'UZ';
        } elseif ($lgiType == 4) {
            $preFix = 'ZP';
        } elseif ($lgiType == 5) {
            $preFix = 'CC';
        } elseif ($lgiType == 7) {
            $preFix = 'N';
        }

        // Generate PIN Code
        //$randomNumber = rand(000000, 999999);
        $pin = $preFix . $batchNo . $courseNo;  //$randomNumber;
        // exit;

        $codeContents = $pin; //'URL: '.$url."\n";

        $data['img_url'] = "";
        $this->load->library('ciqrcode');
        $qr_image = $trainingID . '.png';
        // print_r($codeContents); exit();
        // header("Content-Type: image/png");

        // Simple Configuration
        $params['data'] = $codeContents;
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = $this->qr_path . "/" . $qr_image;

        $data = array('qr_code' => $qr_image, 'pin' => $pin, 'course_no' => $courseNo);

        if ($this->ciqrcode->generate($params)) {
            $this->Training_model->set_qrcode($trainingID, $data);
            $data['img_url'] = $qr_image;
        }

        // Demo
        // https://github.com/dwisetiyadi/CodeIgniter-PHP-QR-Code
        $this->ciqrcode->generate($params);
        /*$data['img_url'] = $qr_image;
        $this->load->view('qrcode', $data);*/

        return true;
    }

    public function file_check($str)
    {
        $this->load->helper('file');
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'application/pdf', 'application/x-download');
        $mime = get_mime_by_extension($_FILES['userfile']['name']);
        $mime1 = get_mime_by_extension($_FILES['voucherfile']['name']);
        $file_size = 10485760; // Byte
        //$file_size = 104857600; // Byte
        $size_kb = '10 MB'; // 10 MB

        if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "") {
            if (!in_array($mime, $allowed_mime_type_arr)) {
                $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png, gif, pdf file.');
                return false;
            } elseif ($_FILES["userfile"]["size"] > $file_size) {
                $this->form_validation->set_message('file_check', 'Maximum file size ' . $size_kb);
                return false;
            } else {
                return true;
            }
        } else if (isset($_FILES['voucherfile']['name']) && $_FILES['voucherfile']['name'] != "") {
            if (!in_array($mime1, $allowed_mime_type_arr)) {
                $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png, gif, pdf file.');
                return false;
            } elseif ($_FILES["voucherfile"]["size"] > $file_size) {
                $this->form_validation->set_message('file_check', 'Maximum file size ' . $size_kb);
                return false;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }























    public function feedback_course_result($id)
    {
        $this->data['info'] = $this->Training_model->get_training_info($id);
        // dd($this->data['info']);
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();
        // $this->data['results'] = $this->Training_model->get_schedule_with_trainer($id);
        //echo '<pre>';
        // print_r($this->data['results']); exit;

        // foreach ($this->data['results'] as $item) {
        //     // print_r($item); exit;
        //     $dataArr[$item->id] = $this->Training_model->get_feedback_topic_result($id, $item->id);

        // }

        // print_r($dataArr); exit;

        // Dropdown
        // $this->data['participant_list'] = $this->Training_model->get_participant_dd($id);
        // print_r($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'কোর্স মূল্যায়ন ফলাফল';
        $this->data['subview'] = 'feedback_course_result';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_feedback_course($id)
    {
        $this->data['info'] = $this->Training_model->get_training_info($id);

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
            redirect('training/feedback_course_result/' . $id);
        }

        $this->data['info'] = $this->Training_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();
        // $this->data['results'] = $this->Training_model->get_schedule_with_trainer($id);

        // Dropdown
        $this->data['participant_list'] = $this->Training_model->get_participant_dd($id);
        // print_r($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'কোর্স মূল্যায়ন ফরম';
        $this->data['subview'] = 'feedback_course';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function pdf_feedback_topic($id)
    {
        $this->data['info'] = $this->Training_model->get_training_info($id);
        $this->data['results'] = $this->Training_model->get_schedule_with_trainer($id);


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
        $this->data['info'] = $this->Training_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();
        $this->data['results'] = $this->Training_model->get_schedule_with_trainer($id);

        // dd($this->data['results']); exit();
        //echo '<pre>';
        // print_r($this->data['results']); exit;

        // foreach ($this->data['results'] as $item) {
        //     // print_r($item); exit;
        //     $dataArr[$item->id] = $this->Training_model->get_feedback_topic_result($id, $item->id);

        // }

        // print_r($dataArr); exit;

        // Dropdown
        $this->data['participant_list'] = $this->Training_model->get_participant_dd($id);
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
            redirect('training/schedule/' . $id);
        }

        $this->data['info'] = $this->Training_model->get_training_info($id);
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();
        $this->data['results'] = $this->Training_model->get_schedule_with_trainer($id);

        // Dropdown
        $this->data['participant_list'] = $this->Training_model->get_participant_dd($id);
        // dd($this->data['participant_list']); exit;

        //Load Page
        $this->data['meta_title'] = 'বিষয়বস্তু মূল্যায়নের ফরম';
        $this->data['subview'] = 'feedback_topic';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /*
    public function schedule_item_clone($id)
    {
        // echo "string"; exit();
        $this->data['info'] = $this->Training_model->get_schedule_item($id);

        // dd($this->data['info']);
        $this->data['info_training'] = $this->Training_model->get_training_info($this->data['info']->training_id);

        // dd($this->data['info_training']);
        // $this->data['trainer_list'] = $this->Training_model->get_trainer_list();

        $form_data = array(
            'training_id'   => $this->data['info']->training_id,
            'program_date'  => $this->data['info']->program_date,
            'time_start'    => $this->data['info']->time_start,
            'time_end'      => $this->data['info']->time_end,
            'session_no'    => $this->data['info']->session_no,
            'topic'         => $this->data['info']->topic,
            'speakers'      => $this->data['info']->speakers,
            'honorarium'    => $this->data['info']->honorarium,
            'trainer_id'    => $this->data['info']->trainer_id
            );
            // print_r($form_data); exit;
        if($this->Common_model->save('training_schedule', $form_data)){
            $this->session->set_flashdata('success', 'Schedule Clone successfully.');
                // echo "success"; exit();
            redirect('training/schedule/'.$this->data['info']->training_id);
        }

        //Load Page
        $this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী সংশোধন';
        $this->data['subview'] = 'schedule_item_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function schedule_date_range_search()
    {
        // echo "string";
        $start_date  =  $this->input->post('start_date');
        $end_date    =  $this->input->post('end_date');
        $training_id =  $this->input->post('training_id');


        $this->data['start_date'] = $start_date;
        $this->data['end_date']   = $end_date;

        // $x = $this->Training_management_model->date_range_filter($a, $b, $c);


        $this->data['info'] = $this->Training_model->get_training_info($training_id);
        // $this->data['trainer_list'] = $this->Training_management_model->get_trainer_list();
        $this->data['results'] = $this->Training_model->date_range_filter($start_date, $end_date, $training_id);

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

    public function script_training_management_to_training(){
        // exit;
        // Default Value
        $message = '';
        $results = $this->Training_model->get_training_management();
        // dd($results);

        if(empty($results)){
            $message = 'No data found!';
            // exit;
        }

        foreach ($results as $row) {
            $form_data = array(
                'id'                => $row->id,
                'participant_name'  => $row->participant_name,
                'course_id'         => $row->course_id,
                'course_type'       => NULL,
                'batch_no'          => $row->batch_no,
                'type_id'           => $row->type_id,
                'start_date'        => $row->start_date,
                'end_date'          => $row->end_date,
                'ta'                => $row->ta,
                'da'                => $row->da,
                'tra_a'             => $row->tra_a,
                'dress'             => $row->dress,
                'signature'         => 0,
                'financing_id'      => $row->financing_id,
                'certificate_id'    => 1,
                'office_id'         => '125',
                'cd_name'           => $row->cd_name,
                'cd_designation'    => $row->cd_designation,
                'status'            => $row->status,
                'is_completed'      => $row->is_completed,
                'created'           => $row->created
                );
            // dd($form_data);

            // Insert to DB
            if($this->Common_model->save('training', $form_data)){
                $message[] = $row->id.' তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
            }else{
                $message[] = $row->id.' <span style="color:red">এই অফিসের ইউজারনেইম টি বিদ্যামান রয়েছে</span>';
            }
        }
        dd($message);
    }

    */

    public function uplodenote($id)
    {

        if ($_FILES['userfile']['size'][0] > 0) {

            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                $file_name = time() . $i . '-' . $id;


                $this->upload->initialize($this->set_upload_options($file_name, $this->note_path));

                if ($this->upload->do_upload('userfile')) {
                    $uploadData = $this->upload->data();


                    // print_r($uploadData);
                    // DB fields
                    $uploadedFile = $uploadData['file_name'];


                    // this is working

                    $note = $this->db->where('training_id', $id)->where('app_user_id', $this->userID)->get('training_participant')->row()->note;


                    if ($note != '' && $note != null) {
                        if (is_array(json_decode($note))) {
                            $user_data = json_decode($note);
                            array_push($user_data, $uploadedFile);
                        } else {
                            $user_data = array($note, $uploadedFile);
                        }
                    } else {
                        $user_data  = array($uploadedFile);
                    }

                    $file_data['note'] = json_encode($user_data);

                    $this->db->where('training_id', $id)->where('app_user_id', $this->userID)->update('training_participant', $file_data);
                    $this->session->set_flashdata('success', 'নোট ডাটাবেজে সংরক্ষণ করা হয়েছে');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('dashboard/my_training', 'refresh');
                }
                // }
            }
            redirect('dashboard/my_training', 'refresh');
        }
    }


    public function dellet_note($notename, $triningid)
    {

        $note = $this->db
            ->where('training_id', $triningid)
            ->where('app_user_id', $this->userID)
            ->get('training_participant')
            ->row()
            ->note;
        if ($note) {


            $note_array = json_decode($note);
            $key = array_search($notename, $note_array);

            if ($key !== false) {
                unset($note_array[$key]);
                $baseUrl = base_url();
                $fileToDelete = FCPATH . 'uploads/note/' . $notename;
                if (unlink($fileToDelete)) {
                    $file_data['note'] = json_encode(array_values($note_array));
                    $this->db->where('training_id', $triningid)->where('app_user_id', $this->userID)->update('training_participant', $file_data);
                    $this->session->set_flashdata('success', 'নোট ডাটাবেজ থেকে মুছে ফেলা হয়েছে');
                    redirect('dashboard/my_training', 'refresh');
                } else {

                    $this->session->set_flashdata('success', 'নোট ডাটাবেজে ডাটাবেজ থেকে মুছে ফেলা সম্ভব হয়নি');
                    redirect('dashboard/my_training', 'refresh');
                }
            } else {
                $this->session->set_flashdata('success', 'নোট ডাটাবেজে নেই');
                redirect('dashboard/my_training', 'refresh');
            }
        }
    }
}
