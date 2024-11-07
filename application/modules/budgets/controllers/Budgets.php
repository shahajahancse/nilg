<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Budgets extends Backend_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->load->helper('bangla_converter');

        $this->load->model('Common_model');
        $this->load->model('Budgets_model');
        $this->data['module_name'] = 'বাজেট';
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        if (empty($this->data['userDetails']->crrnt_dept_id) && $this->data['userDetails']->office_type == 7) {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $this->vat_path = realpath(APPPATH . '../uploads/vat');
        $this->it_path = realpath(APPPATH . '../uploads/it');
        $this->obosisto_path = realpath(APPPATH . '../uploads/obosisto');
    }
    // Revenue Summary start
    // other department budget
    public function budget_nilg($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        if (empty($this->data['userDetails']->crrnt_dept_id)) {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }

        if ($this->ion_auth->in_group(array('ad')) && $dept_id == 2 ) {
            $results = $this->Budgets_model->get_budget($limit, $offset, null, $dept_id, null, 3);
        } else if ($this->ion_auth->in_group(array('ad'))) {
            $results = $this->Budgets_model->get_budget($limit, $offset, null, $dept_id, null, 1);
        } else if ($this->ion_auth->in_group(array('dd'))) {
            $arr = array(3);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('jd'))) {
            $arr = array(4);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $arr = array(5,6,7,8,9);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $arr = array(6,7,8,9);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Budgets_model->get_budget($limit, $offset);
        }

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_nilg/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = 'budget_nilg/budget_nilg';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_nilg_create()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'dept_id' => $user->crrnt_dept_id,
                'description' => $this->input->post('description'),
                'created_by' => $user->id,
            );
            $this->db->trans_start();
            if ($this->Common_model->save('budget_revenue_summary', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'revenue_summary_id' => $insert_id,
                        'head_id' => $_POST['head_id'][$i],
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'prev_amt' => $_POST['prev_amt'][$i],
                        'running_amt' => $_POST['running_amt'][$i],
                        'amount' => $_POST['amount'][$i],
                        'prokolpito_amt' => $_POST['prokolpito_amt'][$i],
                        'fcl_year' => $_POST['fcl_year'],
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_nilg");
            }
        }

        $this->db->select('
                            budget_head_sub.id,
                            budget_head_sub.bd_code,
                            budget_head_sub.name_bn,
                            budget_head_sub.prev_amt,
                            budget_head_sub.budget_amt,
                            budget_head.name_bn as budget_head_name,
                            budget_head.id as budget_head_id
                            ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_nilg/budget_nilg_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function add_new_row()
    {
      $id = $this->input->post('head_id');

      $this->db->select('
                budget_head_sub.id,
                budget_head_sub.name_bn,
                budget_head_sub.bd_code,
                budget_head_sub.budget_amt,
                budget_head_sub.prev_amt,
                budget_head_sub.amount,
                budget_head.name_bn as budget_head_name,
                budget_head.id as budget_head_id
            ');
      $this->db->from('budget_head_sub');
      $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
      $this->db->where('budget_head_sub.id', $id);
      echo json_encode($this->db->get()->row());
    }
    public function budget_nilg_details($encid)
    {
        $id = (int) decrypt_url($encid);
        $budget_nilg = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->data['budget_nilg'] = $budget_nilg;

        $this->db->select('asd.*,
                    asd.id as rmv_details_id,
                    budget_head_sub.name_bn,
                    budget_head_sub.bd_code,
                    budget_head.name_bn as budget_head_name,
                ');
        $this->db->from('budget_revenue_summary_details asd');
        $this->db->join('budget_head_sub', 'asd.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('asd.revenue_summary_id', $id);
        $budget_nilg_details = $this->db->get()->result();
        $this->data['budget_nilg_details'] = $budget_nilg_details;

        $this->db->select('budget_head_sub.id,budget_head_sub.bd_code, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_nilg']->created_by);

        $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        if ($this->ion_auth->in_group(array('ad'))) {
            // dd('rrrddd');
            $this->data['subview'] = 'budget_nilg/details_dept_head';
        } else if ($this->ion_auth->in_group(array('acc')) &&  in_array($this->data['budget_nilg']->desk, array(5,6))) {
            $this->data['subview'] = 'budget_nilg/details_acc_final';
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $this->data['subview'] = 'budget_nilg/details_acc';
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $this->data['subview'] = 'budget_nilg/details_dg';
        } else {
            $this->data['subview'] = 'budget_nilg/details';
        }
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_nilg_edit()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'description' => $this->input->post('description'),
            );
            $this->db->where('id', $this->input->post('budget_nilg_id'));
            if ($this->db->update('budget_revenue_summary', $form_data)) {
                $insert_id = $this->input->post('budget_nilg_id');
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'revenue_summary_id' => $insert_id,
                        'head_id' => $_POST['head_id'][$i],
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'prev_amt' => $_POST['prev_amt'][$i],
                        'running_amt' => $_POST['running_amt'][$i],
                        'amount' => $_POST['amount'][$i],
                        'prokolpito_amt' => $_POST['prokolpito_amt'][$i],
                        'fcl_year' => $_POST['fcl_year'],
                        'created_by' => $user->id,
                    );
                    if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                        $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                    } else {
                        $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                        $this->db->update('budget_revenue_summary_details', $form_data2);
                    }
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_nilg");
            } else {
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                redirect("budgets/budget_nilg");
            }
        }
    }
    public function other_dpt_forward($status,$encid){
        $id = (int) decrypt_url($encid);
        $this->db->trans_start();
        $this->db->where('id', $id);
        $data =  array('status' => $status);
        if ($this->db->update('budget_revenue_summary', $data)) {
            $this->db->trans_complete();
            if($status==7){
                $this->update_acc($id);
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/budget_nilg");
        } else {
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
        }
    }
    public function budget_nilg_dept_edit()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')=='ফরওয়ার্ড করুন') {
                $form_data = array(
                    'title' => $this->input->post('title'),
                    'amount' => $this->input->post('total_amount'),
                    'status' => 3,
                    'desk' => 2,
                    'fcl_year' => $this->input->post('fcl_year'),
                    'description' => $this->input->post('description'),
                    'update_at' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_revenue_summary', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'revenue_summary_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'amount' => $_POST['dpt_amt'][$i],
                        );
                        if ($_POST['rvm_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['rvm_details_id'][$i]);
                            $this->db->update('budget_revenue_summary_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }else{
                $user = $this->ion_auth->user()->row();
                $form_data = array(
                    'title' => $this->input->post('title'),
                    'amount' => $this->input->post('total_amount'),
                    'fcl_year' => $this->input->post('fcl_year'),
                    'description' => $this->input->post('description'),
                    'update_at' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_revenue_summary', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'revenue_summary_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'amount' => $_POST['dpt_amt'][$i],
                        );
                        if ($_POST['rvm_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['rvm_details_id'][$i]);
                            $this->db->update('budget_revenue_summary_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }
        }
    }
    function ajax_get_budget_details_nilg(){
      $id = $_POST['id'];
      $budget_nilg = $this->Common_model->get_single_data('budget_revenue_summary', $id);
      $items = $this->Budgets_model->get_budget_details_nilg($id);
        //   dd($budget_nilg);
      $data = array(
        'budget_info' => $budget_nilg,
        'budget_dtails' => $items,
      );
      header('Content-Type: application/x-json; charset=utf-8');
      echo json_encode($data);
    }
    public function budget_nilg_print($id)
    {
        $id = (int) decrypt_url($id);
        //Results
        $this->data['info'] = $this->Budgets_model->get_budget_nilg_info($id);
        // dd($this->data['info']);
        $this->data['items'] = $this->Budgets_model->temp_get_budget_details_nilg($id);  // temp
        // dd($this->data['items']);

        // Generate PDF
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg/budget_nilg_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    // other department budget end

    // training department budget
    // Training Budget start
    public function training_budgets($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        if ($this->ion_auth->in_group(array('ad'))) {
            $arr = array(2,3,4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null, 2);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $arr = array(3,4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $arr = array(4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Budgets_model->get_budget($limit, $offset);
        } else {
            $results = $this->Budgets_model->get_budget($limit, $offset, array(), $dept_id, $user_id, 2);
        }

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_nilg/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = 'budget_nilg/training_budgets';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function training_budgets_create()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $this->form_validation->set_rules('office_type', 'অফিস ধরণ', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্স নাম', 'required|trim');
        $this->form_validation->set_rules('trainee_type', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('title', 'বাজেট শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('course_day', 'মেয়াদ (দিন)', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        $this->form_validation->set_rules('trainee_number', 'প্রশিক্ষণার্থীর সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('batch_number', 'ব্যাচ সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('total_trainee', 'সর্বমোট প্রশিক্ষণার্থী', 'required|trim');
        $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');

        if ($this->form_validation->run() == true) {
            // dd($_POST);
            $this->db->trans_start();
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'dept_id' => $user->crrnt_dept_id,
                'type' => 2,  // training dpt create
                'status' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'desk' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'office_type' => $this->input->post('office_type'),
                'course_id' => $this->input->post('course_id'),
                'trainee_type' => $this->input->post('trainee_type'),
                'course_day' => $this->input->post('course_day'),
                'trainee_number' => $this->input->post('trainee_number'),
                'batch_number' => $this->input->post('batch_number'),
                'total_trainee' => $this->input->post('total_trainee'),
                'description' => $this->input->post('description'),
                'created_by' => $user->id,
            );
            // dd($_POST);

            if ($this->Common_model->save('budget_revenue_summary', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $head_id = $_POST['head_id'][$i];
                    $form_data2 = array(
                        'revenue_summary_id' => $insert_id,
                        'head_id' => $head_id,
                        'type' => 2,   // training dpt create
                        'amount' => isset($_POST['head_amt'][$i]) ? $_POST['head_amt'][$i] : 0,
                        'fcl_year' => $this->input->post('fcl_year'),
                        'status' => 1,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );

                    $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                    $sub_insert_id = $this->db->insert_id();
                    $sub_ids = $_POST[$head_id.'_sub_id'];
                    $sub_p = $_POST[$head_id.'_participants'];
                    $sub_d = $_POST[$head_id.'_days'];
                    $sub_a = $_POST[$head_id.'_amount'];
                    $sub_amt = $_POST[$head_id.'_subTotal'];
                    $fy = $this->input->post('fcl_year');
                    $this->training_sub_insert($sub_insert_id, $head_id, $sub_ids, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user);
                }
                $this->db->trans_complete();
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/training_budgets");
        }

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_nilg/training_budgets_create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_budget_delete($encid)
    {
        $user = $this->ion_auth->user()->row();
        $id = (int) decrypt_url($encid);
            try {
                $this->db->where('id',$id);
                if($this->db->delete('budget_revenue_summary')){
                    $this->db->where('revenue_summary_id',$id);
                    $details=$this->db->get('budget_revenue_summary_details')->result();
                    $this->db->where('revenue_summary_id',$id);
                    if($this->db->delete('budget_revenue_summary_details')){
                        foreach ($details as $key => $value) {
                            $this->db->where('rev_sum_details',$value->id);
                            $this->db->delete('budget_revenue_sub_details');
                        }
                    }
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে  ডিলিট করা হয়েছে.');
                redirect($_SERVER['HTTP_REFERER']);
            } catch (\Throwable $th) {
                $this->session->set_flashdata('success', $th->getMessage());
                redirect($_SERVER['HTTP_REFERER']);
            }
    }

    public function training_sub_insert($sub_insert_id, $head_id, $sub_ids, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user)
    {
        for ($i=0; $i < sizeof($sub_ids); $i++) {
            $sub_form[] = array(
                'rev_sum_details' => $sub_insert_id,
                'head_id' => $head_id,
                'head_sub_id' => $sub_ids[$i],
                'type' => 2,   // training dpt create
                'participants' => $sub_p[$i],
                'days' => $sub_d[$i],
                'amount' => $sub_a[$i],
                'total_amt' => $sub_amt[$i],
                'fcl_year' => $fy,
                'status' => 1,
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
        }
        // dd($sub_form);
        $this->db->insert_batch('budget_revenue_sub_details', $sub_form);
        return 1;
    }
    public function training_budgets_details($encid)
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $id = (int) decrypt_url($encid);
        $budget_nilg = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->data['budget_nilg'] = $budget_nilg;

        $this->db->select('ddd.*,
                    budget_head_training.name_bn,
                    budget_head_training.bd_code,
                ');
        $this->db->from('budget_revenue_summary_details ddd');
        $this->db->join('budget_head_training', 'ddd.head_id = budget_head_training.id');
        $this->db->where('ddd.revenue_summary_id', $id);
        $this->db->where('ddd.modify_soft_d', 1);
        $budget_nilg_details = $this->db->get()->result();
        $this->data['results'] = $budget_nilg_details;

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_nilg']->created_by);

        $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        $this->data['subview'] = 'budget_nilg/training_budgets_details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function training_budgets_edit($ided)
    {
        $id = decrypt_url($ided);
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $this->form_validation->set_rules('office_type', 'অফিস ধরণ', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্স নাম', 'required|trim');
        $this->form_validation->set_rules('trainee_type', 'অংশগ্রহণকারী ', 'required|trim');
        $this->form_validation->set_rules('title', 'বাজেট শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('course_day', 'মেয়াদ (দিন)', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        $this->form_validation->set_rules('trainee_number', 'প্রশিক্ষণার্থীর সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('batch_number', 'ব্যাচ সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('total_trainee', 'সর্বমোট প্রশিক্ষণার্থী', 'required|trim');
        $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');

        if ($this->form_validation->run() == true) {
            // dd($_POST);
            $this->db->trans_start();
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'type' => 2,  // training dpt create
                'office_type' => $this->input->post('office_type'),
                'course_id' => $this->input->post('course_id'),
                'trainee_type' => $this->input->post('trainee_type'),
                'course_day' => $this->input->post('course_day'),
                'trainee_number' => $this->input->post('trainee_number'),
                'batch_number' => $this->input->post('batch_number'),
                'total_trainee' => $this->input->post('total_trainee'),
                'description' => $this->input->post('description'),
            );

            $this->db->where('id', $id);
            if ($this->db->update('budget_revenue_summary', $form_data)) {

                for ($i = 0; $i < sizeof($_POST['sum_details_id']); $i++) {
                    $sum_detais_id = $_POST['sum_details_id'][$i];
                    $head_id = $_POST['head_id'][$i];
                    $form_data2 = array(
                        'revenue_summary_id' => $id,
                        'head_id' => $head_id,
                        'type' => 2,   // training dpt create
                        'amount' => isset($_POST['head_amt'][$i]) ? $_POST['head_amt'][$i] : 0,
                        'fcl_year' => $this->input->post('fcl_year'),
                        'status' => 1,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );

                    $check = $this->db->where('id', $sum_detais_id)->get('budget_revenue_summary_details')->row();
                    if (!empty($check)) {
                        $this->db->where('id', $sum_detais_id);
                        $this->db->update('budget_revenue_summary_details', $form_data2);
                        $set_id = $sum_detais_id;
                    } else {
                        $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                        $sum_detais_id = $this->db->insert_id();
                        $set_id = $head_id;
                    }
                    $sub_de_id = $_POST[$set_id.'_sub_de_id'];
                    $sub_ids = $_POST[$set_id.'_head_sub_id'];
                    $sub_p = $_POST[$set_id.'_participants'];
                    $sub_d = $_POST[$set_id.'_days'];
                    $sub_a = $_POST[$set_id.'_amount'];
                    $sub_amt = $_POST[$set_id.'_subTotal'];
                    $fy = $this->input->post('fcl_year');
                    $this->training_sub_update($sum_detais_id, $head_id, $sub_de_id, $sub_ids, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user);
                }
                $this->db->trans_complete();
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/training_budgets");
        }

        $this->db->select('
                    budget_head_sub.id,
                    budget_head_sub.bd_code,
                    budget_head_sub.name_bn,
                    budget_head.name_bn as budget_head_name,
                    budget_head.id as budget_head_id
                ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_nilg/training_budgets_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function training_sub_update($sum_detais_id, $head_id, $sub_de_id, $sub_ids, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user)
    {
        for ($i=0; $i < sizeof($sub_ids); $i++) {
            $sub_form = array(
                'rev_sum_details' => $sum_detais_id,
                'head_id' => $head_id,
                'head_sub_id' => $sub_ids[$i],
                'type' => 2,   // training dpt create
                'participants' => $sub_p[$i],
                'days' => $sub_d[$i],
                'amount' => $sub_a[$i],
                'total_amt' => $sub_amt[$i],
                'fcl_year' => $fy,
                'status' => 1,
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
            $check = $this->db->where('id', $sub_de_id[$i])->get('budget_revenue_sub_details')->row();
            if (!empty($check)) {
                $this->db->where('id', $sub_de_id[$i]);
                $this->db->update('budget_revenue_sub_details', $sub_form);
            } else {    // insert
                $this->Common_model->save('budget_revenue_sub_details', $sub_form);
            }
        }
        return 1;
    }
    public function training_budget_forward($id)
    {
        $id = (int) decrypt_url($id);
        $this->db->where('id', $id);
        $this->db->update('budget_revenue_summary', array('status' => 2));
        $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
        redirect("budgets/training_budgets");
    }
    public function training_budget_print($id)
    {
        $id = (int) decrypt_url($id);
        $budget_nilg = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->data['info'] = $budget_nilg;

        $this->db->select('ddd.*,
                    budget_head_training.name_bn,
                    budget_head_training.bd_code,
                ');
        $this->db->from('budget_revenue_summary_details ddd');
        $this->db->join('budget_head_training', 'ddd.head_id = budget_head_training.id');
        $this->db->where('ddd.revenue_summary_id', $id);
        $this->db->where('ddd.modify_soft_d', 1);
        $budget_nilg_details = $this->db->get()->result();
        $this->data['results'] = $budget_nilg_details;
        // Generate PDF
        // dd($this->data['results']);
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg/training_budget_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    public function training_nilg_remove_row()
    {
        $id = $this->input->post('id');
        $sum = $this->db->where('id', $id)->get('budget_revenue_summary_details')->row();
        $amt = $this->db->where('id', $sum->revenue_summary_id)->get('budget_revenue_summary')->row()->amount;
        $amt = $this->db->where('id', $sum->revenue_summary_id)->update('budget_revenue_summary', array('amount' => $amt - $sum->amount));

        $this->db->where('id', $id);
        if ($this->db->update('budget_revenue_summary_details', array('modify_soft_d' => 2))) {
            $this->db->where('rev_sum_details', $id)->update('budget_revenue_sub_details', array('modify_soft_d' => 2));
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }
    public function training_sub_remove_row()
    {
        $id = $this->input->post('id');
        $ss = $this->db->where('id', $id)->get('budget_revenue_sub_details')->row();
        $sum = $this->db->where('id', $ss->rev_sum_details)->get('budget_revenue_summary_details')->row();
        $this->db->where('id', $sum->id)->update('budget_revenue_summary_details', array('amount' => $sum->amount - $ss->total_amt));

        $row = $this->db->where('id', $sum->revenue_summary_id)->get('budget_revenue_summary')->row();
        $this->db->where('id', $row->id)->update('budget_revenue_summary', array('amount' => $row->amount - $ss->total_amt));

        $this->db->where('id', $id);
        if ($this->db->update('budget_revenue_sub_details', array('modify_soft_d' => 2))) {
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }
    public function training_budgets_create2()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $this->form_validation->set_rules('office_type', 'অফিস ধরণ', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্স নাম', 'required|trim');
        $this->form_validation->set_rules('trainee_type', 'অংশগ্রহণকারী ', 'required|trim');
        $this->form_validation->set_rules('title', 'বাজেট শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('course_day', 'মেয়াদ (দিন)', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        $this->form_validation->set_rules('trainee_number', 'প্রশিক্ষণার্থীর সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('batch_number', 'ব্যাচ সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('total_trainee', 'সর্বমোট প্রশিক্ষণার্থী', 'required|trim');
        $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->db->trans_start();
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'dept_id' => $user->crrnt_dept_id,
                'type' => 2,  // training dpt create
                'status' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'desk' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'office_type' => $this->input->post('office_type'),
                'course_id' => $this->input->post('course_id'),
                'trainee_type' => $this->input->post('trainee_type'),
                'course_day' => $this->input->post('course_day'),
                'trainee_number' => $this->input->post('trainee_number'),
                'batch_number' => $this->input->post('batch_number'),
                'total_trainee' => $this->input->post('total_trainee'),
                'description' => $this->input->post('description'),
                'created_by' => $user->id,
            );

            if ($this->Common_model->save('budget_nilg', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_sub_id']); $i++) {
                    $sub_id = $_POST['head_sub_id'][$i];
                    if(!empty($this->input->post($sub_id.'_subHead'))) {
                        $token = array(
                            'subHead' => $this->input->post($sub_id.'_subHead'),
                            'participants' => $this->input->post($sub_id.'_participants'),
                            'days' => $this->input->post($sub_id.'_days'),
                            'amount' => $this->input->post($sub_id.'_amount'),
                            'subTotal' => $this->input->post($sub_id.'_subTotal'),
                        );
                    } else {
                        $token = null;
                    }

                    $form_data2 = array(
                        'budget_nilg_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'type' => 2,   // training dpt create
                        'token' => !empty($token) ? json_encode($token) : null,
                        'participants' => $_POST['participants'][$i],
                        'days' => $_POST['days'][$i],
                        'amount' => (100 == $_POST['head_sub_id'][$i])? $_POST['total_amt'][$i] : $_POST['amount'][$i],
                        'total_amt' => $_POST['total_amt'][$i],
                        'fcl_year' => $this->input->post('fcl_year'),
                        'status' => 1,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_nilg_details', $form_data2);
                }
                $this->db->trans_complete();
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/training_budgets");
        }

        $this->db->select('
                    budget_head_sub.id,
                    budget_head_sub.bd_code,
                    budget_head_sub.name_bn,
                    budget_head.name_bn as budget_head_name,
                    budget_head.id as budget_head_id
                ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_nilg/training_budgets_create2';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function get_sub_row(){
        $head_id = $this->input->post('head_id');
        $this->db->where('head_id', $head_id);
        $sub = $this->db->get('budget_head_sub_training')->result();
        echo json_encode($sub);
    }
    public function get_sub_info(){
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $sub = $this->db->get('budget_head_sub_training')->row();
        echo json_encode($sub);
    }

    public function training_budgets_clone($encid)
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $id = (int) decrypt_url($encid);
        $row = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->db->where('revenue_summary_id', $id);
        $results = $this->db->get('budget_revenue_summary_details')->result();
        if ($this->ion_auth->in_group(array('ad'))) {
            $status = 2;
        } else {
            $status = 1;
        }

        $this->db->trans_start();
        if (!empty($row)) {
            $form_data = array(
                'title' => $row->title,
                'amount' => $row->amount,
                'dpt_amt' => $row->dpt_amt,
                'dpt_head_id' => $row->dpt_head_id,
                'acc_amt' => $row->acc_amt,
                'acc_head_id' => $row->acc_head_id,
                'dg_amt' => $row->dg_amt,
                'dg_user_id' => $row->dg_user_id,
                'revenue_amt' => $row->revenue_amt,
                'fcl_year' => $row->fcl_year,
                'status' => $status,
                'type' => $row->type,
                'desk' => $row->desk,
                'dept_id' => $user->crrnt_dept_id,
                'office_type' => $row->office_type,
                'course_id' => $row->course_id,
                'trainee_type' => $row->trainee_type,
                'course_day' => $row->course_day,
                'trainee_number' => $row->trainee_number,
                'batch_number' => $row->batch_number,
                'total_trainee' => $row->total_trainee,
                'description' => $row->description,
                'soft_delete' => $row->soft_delete,
                'created_by' => $user->id,
            );
            if ($this->Common_model->save('budget_revenue_summary', $form_data)) {
                $insert_id = $this->db->insert_id();
                foreach ($results as $key => $r) {
                    $sub_old_id = $r->id;
                    $form_data2 = array(
                        'revenue_summary_id' => $insert_id,
                        'head_id' => $r->head_id,
                        'head_sub_id' => $r->head_sub_id,
                        'amount' => $r->amount,
                        'prev_amt' => $r->prev_amt,
                        'running_amt' => $r->running_amt,
                        'prokolpito_amt' => $r->prokolpito_amt,
                        'dpt_amt' => $r->dpt_amt,
                        'acc_amt' => $r->acc_amt,
                        'dg_amt' => $r->dg_amt,
                        'revenue_amt' => $r->revenue_amt,
                        'fcl_year' => $r->fcl_year,
                        'status' => $status,
                        'type' => $r->type,
                        'token' => $r->token,
                        'days' => $r->days,
                        'participants' => $r->participants,
                        'total_amt' => $r->total_amt,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $r->created_by,
                    );

                    $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                    $sub_new_id = $this->db->insert_id();
                    $this->training_sub_clone_insert($sub_old_id, $sub_new_id);
                }
            }
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/training_budgets");
        }
        $this->session->set_flashdata('success', 'তথ্যটি ডাটাবেসে সংরক্ষণ করা সম্ভব হচ্ছে না.');
        redirect("budgets/training_budgets");
    }

    public function training_sub_clone_insert($sub_old_id, $sub_new_id)
    {
        $this->db->where('rev_sum_details', $sub_old_id);
        $results2 = $this->db->get('budget_revenue_sub_details')->result();
        foreach ($results2 as $key => $sub) {
            $sub_form[] = array(
                'rev_sum_details' => $sub_new_id,
                'head_id' => $sub->head_id,
                'head_sub_id' => $sub->head_sub_id,
                'fcl_year' => $sub->fcl_year,
                'trainee_type' => $sub->trainee_type,
                'status' => 1,
                'type' => $sub->type,
                'days' => $sub->days,
                'participants' => $sub->participants,
                'batch' => $sub->batch,
                'total_participants' => $sub->total_participants,
                'amount' => $sub->amount,
                'total_amt' => $sub->total_amt,
                'dept_id' => $sub->dept_id,
                'training_area' => $sub->training_area,
                'created_by' => $sub->created_by,
            );
        }
        $this->db->insert_batch('budget_revenue_sub_details', $sub_form);
        return 1;
    }
    public function check_rev_balance(){
        $fcl_year = $this->input->post('fcl_year');
        $rb = $this->db->where('id',35)->get('budget_head_sub')->row();
        $eb = $this->db->select('SUM(amount) as amount')->where('fcl_year',$fcl_year)->get('budget_field')->row();
        $val = $rb->budget_amt - $eb->amount;
        $cval = $val <= 0 ? 0 : $val;
        echo json_encode($val);
    }
    // Training Budget end
    // training department budget end
    // Manage Budget field list
    public function budget_field($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $office_id = $this->data['userDetails']->crrnt_office_id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $office_type = $this->data['userDetails']->office_type;
        if ($dept_id == '' && $office_type == 7) {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }

        if ($this->ion_auth->in_group(array('tdo'))) {
            $arr = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, $user_id, $dept_id);
        } else if ($this->ion_auth->in_group(array('ad'))) {
            $arr = array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('dd'))) {
            $arr = array(3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('jd'))) {
            $arr = array(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('director'))) {
            $arr = array(5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $arr = array(5,6,7,8,9,10,11,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('uz', 'ddlg'))) {
            $arr = array(9,10,11,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, $office_id, null, null);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $arr = array(7,8,9,10,11,22);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        }
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_field/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = 'budget_field/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_field_create()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("budgets/budget_field");
        }
        $this->form_validation->set_rules('office_type', 'অফিস ধরণ', 'required|trim');
        $this->form_validation->set_rules('office_id', 'অফিস নাম', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্স নাম', 'required|trim');
        $this->form_validation->set_rules('trainee_type', 'অংশগ্রহণকারী ', 'required|trim');
        $this->form_validation->set_rules('title', 'বাজেট শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('course_day', 'মেয়াদ (দিন)', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        $this->form_validation->set_rules('trainee_number', 'প্রশিক্ষণার্থীর সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('batch_number', 'ব্যাচ সংখ্যা', 'required|trim');
        // $this->form_validation->set_rules('total_trainee', 'সর্বমোট প্রশিক্ষণার্থী', 'required|trim');
        $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');

        if ($this->form_validation->run() == true) {
            // dd($_POST);
            $this->db->trans_start();
            $form_data = array(
                'office_type' => $this->input->post('office_type'),
                'office_id' => $this->input->post('office_id'),
                'course_id' => $this->input->post('course_id'),
                'trainee_type' => $this->input->post('trainee_type'),
                'title' => $this->input->post('title'),
                'batch_number' => $this->input->post('batch_number'),
                'fcl_year' => $this->input->post('fcl_year'),
                'trainee_number' => $this->input->post('trainee_number'),
                'total_trainee' => $this->input->post('trainee_number'),
                'course_day' => $this->input->post('course_day'),
                'amount' => $this->input->post('total_amount'),
                'total_amt' => ($this->input->post('total_amount') * $this->input->post('batch_number')),
                'dept_id' => $user->crrnt_dept_id,
                'type' => 2,  // training dpt create
                'status' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'desk' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'description' => $this->input->post('description'),
                'created_by' => $user->id,
            );
            if ($this->Common_model->save('budget_field', $form_data)) {
                $insert_id = $this->db->insert_id();
                $this->generator_qrcode($insert_id, $this->input->post('office_type'));
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $head_id = $_POST['head_id'][$i];
                    $form_data2 = array(
                        'budget_field_id' => $insert_id,
                        'head_id' => $head_id,
                        'office_type' => $this->input->post('office_type'),
                        'office_id' => $this->input->post('office_id'),
                        'type' => 2,   // training dpt create
                        'amount' => isset($_POST['head_amt'][$i]) ? $_POST['head_amt'][$i] : 0,
                        'fcl_year' => $this->input->post('fcl_year'),
                        'status' => 1,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );

                    $this->Common_model->save('budget_field_details', $form_data2);
                    $details_id = $this->db->insert_id();
                    $sub_ids = $_POST[$head_id.'_sub_id'];
                    $sub_cmd = $_POST[$head_id.'_cmd'];
                    $sub_p = $_POST[$head_id.'_participants'];
                    $sub_d = $_POST[$head_id.'_days'];
                    $sub_a = $_POST[$head_id.'_amount'];
                    $sub_amt = $_POST[$head_id.'_subTotal'];
                    $fy = $this->input->post('fcl_year');
                    $this->training_sub_clone($details_id, $head_id, $sub_ids, $sub_cmd, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user);
                }
                $this->db->trans_complete();
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/budget_field");
        }

        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_field/budget_field_create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function budget_field_delete($encid)
    {
        $user = $this->ion_auth->user()->row();
        $id = (int) decrypt_url($encid);
            try {
                $this->db->where('id',$id);
                if($this->db->delete('budget_field')){
                    $this->db->where('budget_field_id',$id);
                    $details=$this->db->get('budget_field_details')->result();
                    $this->db->where('budget_field_id',$id);
                    if($this->db->delete('budget_field_details')){
                        foreach ($details as $key => $value) {
                            $this->db->where('details_id',$value->id);
                            $this->db->delete('budget_field_sub_details');
                        }
                    }
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে  ডিলিট করা হয়েছে.');
                redirect($_SERVER['HTTP_REFERER']);
            } catch (\Throwable $th) {
                $this->session->set_flashdata('success', $th->getMessage());
                redirect($_SERVER['HTTP_REFERER']);
            }
    }

    public function training_sub_clone($details_id, $head_id, $sub_ids, $sub_cmd, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user)
    {
        for ($i=0; $i < sizeof($sub_ids); $i++) {
            $sub_form[] = array(
                'details_id' => $details_id,
                'head_id' => $head_id,
                'head_sub_id' => $sub_ids[$i],
                'head_modify' => $sub_cmd[$i],
                'type' => 2,   // training dpt create
                'participants' => $sub_p[$i],
                'days' => $sub_d[$i],
                'amount' => $sub_a[$i],
                'total_amt' => $sub_amt[$i],
                'fcl_year' => $fy,
                'status' => 1,
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
        }
        // dd($sub_form);
        $this->db->insert_batch('budget_field_sub_details', $sub_form);
        return 1;
    }
    public function budget_field_details($encid)
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("budgets/budget_field");
        }
        $id = (int) decrypt_url($encid);
        $this->data['budget_nilg'] = $this->Common_model->get_single_data('budget_field', $id);
        $this->form_validation->set_rules('office_type', 'অফিস ধরণ', 'required|trim');
        $this->form_validation->set_rules('office_id', 'অফিস নাম', 'required|trim');
        $this->form_validation->set_rules('course_id', 'কোর্স নাম', 'required|trim');
        $this->form_validation->set_rules('trainee_type', 'অংশগ্রহণকারী', 'required|trim');
        $this->form_validation->set_rules('title', 'বাজেট শিরোনাম', 'required|trim');
        $this->form_validation->set_rules('batch_number', 'ব্যাচ সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        $this->form_validation->set_rules('trainee_number', 'প্রশিক্ষণার্থীর সংখ্যা', 'required|trim');
        $this->form_validation->set_rules('course_day', 'মেয়াদ (দিন)', 'required|trim');
        $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->db->trans_start();
            $form_data = array(
                'title' => $this->input->post('title'),
                'office_type' => $this->input->post('office_type'),
                'office_id' => $this->input->post('office_id'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'course_id' => $this->input->post('course_id'),
                'trainee_type' => $this->input->post('trainee_type'),
                'course_day' => $this->input->post('course_day'),
                'trainee_number' => $this->input->post('trainee_number'),
                'batch_number' => $this->input->post('batch_number'),
                'total_trainee' => $this->input->post('total_trainee'),
                'description' => $this->input->post('description'),
            );

            $this->db->where('id', $id);
            if ($this->db->update('budget_field', $form_data)) {

                for ($i = 0; $i < sizeof($_POST['sum_details_id']); $i++) {
                    $sum_detais_id = $_POST['sum_details_id'][$i];
                    $head_id = $_POST['head_id'][$i];
                    $form_data2 = array(
                        'budget_field_id' => $id,
                        'head_id' => $head_id,
                        'type' => 2,   // training dpt create
                        'office_type' => $this->input->post('office_type'),
                        'office_id' => $this->input->post('office_id'),
                        'amount' => isset($_POST['head_amt'][$i]) ? $_POST['head_amt'][$i] : 0,
                        'fcl_year' => $this->input->post('fcl_year'),
                        'status' => 1,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );

                    $check = $this->db->where('id', $sum_detais_id)->get('budget_field_details')->row();
                    if (!empty($check)) {
                        $this->db->where('id', $sum_detais_id);
                        $this->db->update('budget_field_details', $form_data2);
                        $set_id = $sum_detais_id;
                    } else {
                        $this->Common_model->save('budget_field_details', $form_data2);
                        $sum_detais_id = $this->db->insert_id();
                        $set_id = $head_id;
                    }

                    $sub_de_id = $_POST[$set_id.'_sub_de_id'];
                    $sub_ids = $_POST[$set_id.'_head_sub_id'];
                    $sub_cmd = $_POST[$set_id.'_cmd'];
                    $sub_p = $_POST[$set_id.'_participants'];
                    $sub_d = $_POST[$set_id.'_days'];
                    $sub_a = $_POST[$set_id.'_amount'];
                    $sub_amt = $_POST[$set_id.'_subTotal'];
                    $fy = $this->input->post('fcl_year');
                    $this->field_sub_update($sum_detais_id, $head_id, $sub_de_id, $sub_ids, $sub_cmd, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user);
                }
                $this->db->trans_complete();
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/budget_field");
        }

        $this->db->select('dd.*, budget_head_training.name_bn');
        $this->db->from('budget_field_details as dd');
        $this->db->join('budget_head_training', 'dd.head_id = budget_head_training.id');
        $this->db->where('dd.budget_field_id', $id);
        $this->db->where('dd.modify_soft_d', 1);
        $this->data['results'] = $this->db->get()->result();
        // dd($this->data['results']);

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_nilg']->created_by);

        $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        $this->data['subview'] = 'budget_field/budget_field_details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_field_print($encid, $type=null)
    {
        $id = (int) decrypt_url($encid);
        $this->data['info'] = $this->Common_model->get_single_data('budget_field', $id);

        $this->db->select('bd.*, hd.name_bn');
        $this->db->from('budget_field_details bd');
        $this->db->join('budget_head_training as hd', 'hd.id = bd.head_id', 'left');
        // $this->db->join('session_year as sy', 'sy.id = bd.fcl_year', 'left');
        $this->db->where('bd.budget_field_id', $id);
        $this->db->where('bd.modify_soft_d !=', 2);
        $this->data['results'] = $this->db->get()->result();
        // dd($this->data['results']);

        //Load view
        $this->data['headding'] = 'বাজেট ';
        $html = $this->load->view('budget_field/print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    public function field_sub_update($details_id, $head_id, $sub_de_id, $sub_ids, $sub_cmd, $sub_p, $sub_d, $sub_a, $sub_amt, $fy, $user)
    {
        for ($i=0; $i < sizeof($sub_ids); $i++) {
            $sub_form = array(
                'details_id' => $details_id,
                'head_id' => $head_id,
                'head_sub_id' => $sub_ids[$i],
                'head_modify' => $sub_cmd[$i],
                'type' => 2,   // training dpt create
                'participants' => $sub_p[$i],
                'days' => $sub_d[$i],
                'amount' => $sub_a[$i],
                'total_amt' => $sub_amt[$i],
                'fcl_year' => $fy,
                'status' => 1,
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
            $check = $this->db->where('id', $sub_de_id[$i])->get('budget_field_sub_details')->row();
            if (!empty($check)) {
                $this->db->where('id', $sub_de_id[$i]);
                $this->db->update('budget_field_sub_details', $sub_form);
            } else {    // insert
                $this->Common_model->save('budget_field_sub_details', $sub_form);
            }
        }
        return 1;
    }
    public function field_nilg_remove_row()
    {
        $id = $this->input->post('id');
        $sum = $this->db->where('id', $id)->get('budget_field_details')->row();
        $amt = $this->db->where('id', $sum->budget_field_id)->get('budget_field')->row()->amount;
        $amt = $this->db->where('id', $sum->budget_field_id)->update('budget_field', array('amount' => $amt - $sum->amount));

        $this->db->where('id', $id);
        if ($this->db->update('budget_field_details', array('modify_soft_d' => 2))) {
            $this->db->where('details_id', $id)->update('budget_field_sub_details', array('modify_soft_d' => 2));
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }
    public function field_sub_remove_row()
    {
        $id = $this->input->post('id');
        $ss = $this->db->where('id', $id)->get('budget_field_sub_details')->row();
        $sum = $this->db->where('id', $ss->details_id)->get('budget_field_details')->row();
        $this->db->where('id', $sum->id)->update('budget_field_details', array('amount' => $sum->amount - $ss->total_amt));

        $row = $this->db->where('id', $sum->budget_field_id)->get('budget_field')->row();
        $this->db->where('id', $row->id)->update('budget_field', array('amount' => $row->amount - $ss->total_amt));

        $this->db->where('id', $id);
        if ($this->db->update('budget_field_sub_details', array('modify_soft_d' => 2))) {
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }
    public function budget_field_clone($encid)
    {
        $id = (int) decrypt_url($encid);
        $row = $this->Common_model->get_single_data('budget_field', $id);
        $this->db->where('budget_field_id', $id);
        $results = $this->db->get('budget_field_details')->result();
        $user = $this->ion_auth->user()->row();
        if ($this->ion_auth->in_group(array('ad'))) {
            $status = 2;
        } else {
            $status = 1;
        }
        $this->db->trans_start();
        if (!empty($row)) {
            $form_data = array(
                'title' => $row->title,
                'type' => $row->type,
                'course_id' => $row->course_id,
                'office_type' => $row->office_type,
                'trainee_type' => $row->trainee_type,
                'batch_number' => $row->batch_number,
                'trainee_number' => $row->trainee_number,
                'total_trainee' => $row->total_trainee,
                'course_day' => $row->course_day,
                'office_id' => $row->office_id,
                'amount' => $row->amount,
                'total_amt' => $row->total_amt,
                'balance' => $row->balance,
                'status' => $status,
                'desk' => $row->desk,
                'fcl_year' => $row->fcl_year,
                'description' => $row->description,
                'dept_id' => $user->crrnt_dept_id,
                'payment_for' => $row->payment_for,
                'total_overall_expense' => $row->total_overall_expense,
                'created_by' => $user->id,
                'office_note' => $row->office_note,
            );
            if ($this->Common_model->save('budget_field', $form_data)) {
                $insert_id = $this->db->insert_id();
                $this->generator_qrcode($insert_id, $row->office_type);
                foreach ($results as $key => $r) {
                    $sub_old_id = $r->id;
                    $form_data2 = array(
                        'budget_field_id' => $insert_id,
                        'office_type' => $r->office_type,
                        'head_id' => $r->head_id,
                        'type' => $r->type,
                        'amount' => $r->amount,
                        'days' => $r->days,
                        'participants' => $r->participants,
                        'total_amt' => $r->total_amt,
                        'balance' => $r->balance,
                        'status' => $status,
                        'fcl_year' => $r->fcl_year,
                        'office_id' => $r->office_id,
                        'dept_id' => $user->crrnt_dept_id,
                        'modify_soft_d' => $r->modify_soft_d,
                        'created_by' => $r->created_by
                    );
                    $this->Common_model->save('budget_field_details', $form_data2);
                    $sub_new_id = $this->db->insert_id();
                    $this->field_sub_clone_insert($sub_old_id, $sub_new_id);
                }
            }
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/budget_field");
        }
        $this->session->set_flashdata('success', 'তথ্যটি ডাটাবেসে সংরক্ষণ করা সম্ভব হচ্ছে না.');
        redirect("budgets/budget_field");
    }
    public function field_sub_clone_insert($sub_old_id, $sub_new_id)
    {
        $this->db->where('details_id', $sub_old_id);
        $results2 = $this->db->get('budget_field_sub_details')->result();
        foreach ($results2 as $key => $sub) {
            $sub_form[] = array(
                'details_id' => $sub_new_id,
                'head_id' => $sub->head_id,
                'head_sub_id' => $sub->head_sub_id,
                'head_modify' => $sub->head_modify,
                'type' => $sub->type,
                'amount' => $sub->amount,
                'days' => $sub->days,
                'participants' => $sub->participants,
                'expense_amt' => $sub->expense_amt,
                'vat' => $sub->vat,
                'it_kor' => $sub->it_kor,
                'total_amt' => $sub->total_amt,
                'balance' => $sub->balance,
                'status' => 1,
                'fcl_year' => $sub->fcl_year,
                'dept_id' => $sub->dept_id,
                'modify_soft_d' => $sub->modify_soft_d,
                'created_by' => $sub->created_by,
                'file' => $sub->file,
            );
        }
        $this->db->insert_batch('budget_field_sub_details', $sub_form);
        return 1;
    }
    public function budget_field_forward($status,$encid){
        $id = (int) decrypt_url($encid);
        $this->db->trans_start();
        $this->db->where('id', $id);
        $data =  array('status' => $status);
        if ($this->db->update('budget_field', $data)) {
            $this->db->trans_complete();
            // if($status==7){
            //     $this->update_acc($id);
            // }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/budget_field");
        } else {
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
            redirect("budgets/budget_field");
        }
    }

    public function field_statement_of_expenses($encid)
    {
        $id = (int) decrypt_url($encid);
        $user = $this->ion_auth->user()->row();
        $this->form_validation->set_rules('sp_total_amt', 'সর্বমোট পরিমান', 'required|trim');

        if ($this->form_validation->run() == true) {
            if($_FILES['vat_chalan_attach']['size'] > 0){
                $file_data = $this->file_upload_function($id, $this->vat_path, 'vat_chalan_attach', 'vat');
                $this->db->where('id', $id)->update('budget_field', ['vat_chalan_attach' => $file_data]);
            }
            if($_FILES['it_chalan_attach']['size'] > 0){
                $file_data = $this->file_upload_function($id, $this->it_path, 'it_chalan_attach', 'it');
                $this->db->where('id', $id)->update('budget_field', ['it_chalan_attach' => $file_data]);
            }
            if($_FILES['obs_chalan_attach']['size'] > 0){
                $file_data = $this->file_upload_function($id, $this->obosisto_path, 'obs_chalan_attach', 'obs');
                $this->db->where('id', $id)->update('budget_field', ['obs_chalan_attach' => $file_data]);
            }

            $this->db->trans_start();
            $form_data = array(
                'balance' => $this->input->post('total_obosistho'),
                'sp_total_amt' => $this->input->post('sp_total_amt'),

                'vat_total_amt' => $this->input->post('vat_total_amt'),
                'it_total_amt' => $this->input->post('it_total_amt'),
                'prokrito_bay_total' => $this->input->post('prokrito_bay_total'),

                'vat_chalan_no' => $this->input->post('vat_chalan_no'),
                'vat_chalan_date' => $this->input->post('vat_chalan_date'),
                'vat_chalan_bank' => $this->input->post('vat_chalan_bank'),

                'it_chalan_no' => $this->input->post('it_chalan_no'),
                'it_chalan_date' => $this->input->post('it_chalan_date'),
                'it_chalan_bank' => $this->input->post('it_chalan_bank'),

                'obs_chalan_no' => $this->input->post('obs_chalan_no'),
                'obs_chalan_date' => $this->input->post('obs_chalan_date'),
                'obs_chalan_bank' => $this->input->post('obs_chalan_bank'),
                'updated_by' => $user->id,
                'office_note' => $this->input->post('description'),
            );
            // dd($_POST);
            $this->db->where('id', $id);
            if ($this->db->update('budget_field', $form_data)) {
                for ($i = 0; $i < sizeof($_POST['details_id']); $i++) {
                    $details_id = $_POST['details_id'][$i];
                    $head_obosistho = $_POST['head_obosistho'][$i];
                    $head_amt = $_POST['head_amt'][$i];
                    $form_data2 = array(
                        'total_amt' => ($head_amt - $head_obosistho),
                        'balance' => $head_obosistho,
                    );

                    $check = $this->db->where('id', $details_id)->get('budget_field_details')->row();
                    if (!empty($check)) {
                        $this->db->where('id', $details_id);
                        $this->db->update('budget_field_details', $form_data2);
                    }

                    $de_id = $_POST[$details_id.'_sub_de_id'];
                    $exp_tot = $_POST[$details_id.'_sub_sp_amt'];
                    $vat = $_POST[$details_id.'_vat'];
                    $vat_amt = $_POST[$details_id.'_vat_amt'];
                    $it = $_POST[$details_id.'_it_kor'];
                    $it_kor_amt = $_POST[$details_id.'_it_kor_amt'];
                    $exp_amt = $_POST[$details_id.'_prokrito_bay'];
                    $bal = $_POST[$details_id.'_balance'];
                    $this->statement_sub_update($de_id, $exp_tot, $vat, $vat_amt, $it, $it_kor_amt, $exp_amt, $bal);
                }
                $this->db->trans_complete();
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/budget_field");
        }

        $this->db->select('
            budget_field.*,
            office.office_name,
            course.course_title,
            session_year.session_name
        ')
        ->from('budget_field')
        ->join('office', 'budget_field.office_id = office.id', 'left')
        ->join('course', 'budget_field.course_id = course.id', 'left')
        ->join('session_year', 'budget_field.fcl_year = session_year.id', 'left')
        ->where('budget_field.id', $id);
        $this->data['budget_field'] = $this->db->get()->row();
        // dd($this->data['budget_field']);

        $this->db->select('dd.*, budget_head_training.name_bn');
        $this->db->from('budget_field_details as dd');
        $this->db->join('budget_head_training', 'dd.head_id = budget_head_training.id', 'left');
        $this->db->where('dd.budget_field_id', $id);
        $this->db->where('dd.modify_soft_d', 1);
        $this->data['results'] = $this->db->get()->result();
        // dd($this->data['results']);

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_field']->created_by);

        $this->data['meta_title'] = 'বাজেট ব্যয় বিবরণী';
        $this->data['subview'] = 'budget_field/field_statement_of_expenses';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function file_upload_function($id, $path, $file_name, $shot_name) {
        $this->load->library('upload');
        $ex = explode('.', $_FILES[$file_name]['name']);
        $new_file_name = $shot_name.'-'.time().'.'.end($ex);
        $config = [
            'allowed_types' => 'pdf|jpg|png|jpeg',
            'upload_path' => $path,
            'file_name' => $new_file_name,
            'max_size' => 0
        ];

        $this->upload->initialize($config);
        // upload file to directory
        if ($this->upload->do_upload($file_name)) {
            $uploadData = $this->upload->data();
            return $uploadData['file_name'];
        } else {
            $this->data['success'] = $this->upload->display_errors();
            return false;
        }
    }

    public function statement_sub_update($de_id, $exp_tot, $vat, $vat_amt, $it, $it_kor_amt, $exp_amt, $bal)
    {
        for ($i=0; $i < sizeof($de_id); $i++) {
            $sub_form = array(
                'expense_amt' => $exp_tot[$i],
                'vat' => $vat[$i],
                'vat_amt' => $vat_amt[$i],
                'it_kor' => $it[$i],
                'it_kor_amt' => $it_kor_amt[$i],
                'prokito_bay' => $exp_amt[$i],
                'balance' => $bal[$i],
            );
            $check = $this->db->where('id', $de_id[$i])->get('budget_field_sub_details')->row();
            if (!empty($check)) {
                $this->db->where('id', $de_id[$i]);
                $this->db->update('budget_field_sub_details', $sub_form);
            }
        }
        return 1;
    }

    public function budget_field_statement_of_expenses_print($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->data['info'] = $this->Common_model->get_single_data('budget_field', $id);

        $this->db->select('dd.*, budget_head_training.name_bn');
        $this->db->from('budget_field_details as dd');
        $this->db->join('budget_head_training', 'dd.head_id = budget_head_training.id');
        $this->db->where('dd.budget_field_id', $id);
        $this->db->where('dd.modify_soft_d', 1);
        $this->data['results'] = $this->db->get()->result();
        // dd($this->data['results']);

        //Load view
        $this->data['headding'] = 'বাজেট ';
        $html = $this->load->view('budget_field/expenses_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    public function download_files_as_zip($encid) {
        // Load the Zip library
        $this->load->library('zip');
        $id = (int) decrypt_url($encid);
        $row = $this->Common_model->get_single_data('budget_field', $id);

        // Define file paths to be added to the zip
        $files = [
            $this->vat_path . '/'. $row->vat_chalan_attach,
            $this->it_path . '/'. $row->it_chalan_attach,
            $this->obosisto_path . '/'. $row->obs_chalan_attach,
        ];

        // Add files to the zip archive
        foreach ($files as $file) {
            if (file_exists($file)) {
                $this->zip->read_file($file);
            }
        }
        // Define the name of the zip file to be downloaded
        $zip_filename = 'statement_files.zip';
        // Download the zip file
        $this->zip->download($zip_filename);
        // Redirect to the download page
        return true;
    }

    function dpt_summary_training($offset = 0) {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        // $user = $this->ion_auth->user()->row();
        if ($dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }

        if ($this->ion_auth->in_group(array('ad'))) {
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset, null, $dept_id, null, null);
        } else if ($this->ion_auth->in_group(array('dd'))) {
            $type = array(1,3);
            $arr = array(2,3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset, $arr, null, $type, null);
        } else if ($this->ion_auth->in_group(array('jd'))) {
            $type = array(1,3);
            $arr = array(3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('director'))) {
            $type = array(1,3);
            $arr = array(4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $type = array(1,3);
            $arr = array(5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $type = array(1,3);
            $arr = array(6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Budgets_model->dpt_summary_training($limit, $offset);
        }
        $this->data['summary'] = $results;
        // dd($this->data['summary']);

        //Load view
        $this->data['meta_title'] = 'সামারী তালিকা';
        $this->data['subview'] = 'budget_nilg/dpt_summary_training';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function dpt_training_budgets($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        if ($this->ion_auth->in_group(array('ad'))) {
            $arr = array(2,3,4,5,6,7,8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('dd'))) {
            $arr = array(3,4,5,6,7,8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('jd'))) {
            $arr = array(4,5,6,7,8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('director'))) {
            $arr = array(5,6,7,8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $arr = array(6,7,8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        } else if ($this->ion_auth->in_group(array('uz', 'ddlg'))) {
            $arr = array(7,8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, $office_id, null, null);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $arr = array(8,9,10,11);
            $results = $this->Budgets_model->get_budget_field($limit, $offset, $arr, null, null, null);
        }

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        // dd($this->data['results']);
        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_nilg/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = 'budget_nilg/dpt_training_budgets';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function dpt_training_summary_create()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $ids = $this->input->post('id');
        if (empty($ids)) {
            // dd($_POST);
            $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');
            $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
            if ($this->form_validation->run() == true) {
                // dd($_POST);
                $form_data = array(
                    'amount' => $this->input->post('total_amount'),
                    'fcl_year' => $this->input->post('fcl_year'),
                    'update_ids' => $this->input->post('update_ids'),
                    'description' => $this->input->post('description'),
                    'dpt_head_id' => $user->crrnt_dept_id,
                    'dept_id' => $user->crrnt_dept_id,
                    'type' => 3, // training dpt marge
                    'status' => 1, // draft
                    'created_by' => $user->id,
                );

                $this->db->trans_start();
                if ($this->Common_model->save('budget_nilg', $form_data)) {
                    $insert_id = $this->db->insert_id();
                    for ($i = 0; $i < sizeof($_POST['office_type']); $i++) {
                        $head_id = $_POST['office_type'][$i];
                        $form_data2 = array(
                            'nilg_id' => $insert_id,
                            'head_id' => $head_id, // office type id
                            'type' => 3,   // training dpt marge and head_id replace to office type
                            'amount' => $_POST['office_amt'][$i],
                            'fcl_year' => $this->input->post('fcl_year'),
                            'status' => 1,
                            'dept_id' => $user->crrnt_dept_id,
                            'created_by' => $user->id,
                        );

                        $this->Common_model->save('budget_nilg_details', $form_data2);
                        $sub_it_id = $this->db->insert_id();
                        $sub_ids = $_POST[$head_id.'_course_id']; // course id
                        $type = $_POST[$head_id.'_trainee_type'];
                        $sub_d = $_POST[$head_id.'_course_day'];
                        $sub_p = $_POST[$head_id.'_participants'];
                        $base = $_POST[$head_id.'_batch_number'];
                        $tot_p = $_POST[$head_id.'_total_participants'];
                        $sub_amt = $_POST[$head_id.'_amount'];
                        $loc = $_POST[$head_id.'_location'];  // training location
                        $fy = $this->input->post('fcl_year');
                        $this->training_marge_insert($sub_it_id, $head_id, $sub_ids, $sub_d, $sub_p, $base, $tot_p, $sub_amt, $type, $fy, $user, $loc);
                    }

                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/dpt_summary_training");
                }
            }
        }

        //Dropdown
        $this->db->select('bd.*, SUM(bd.amount) as office_amt, oc.office_type_name as office');
        $this->db->from('budget_field bd');
        $this->db->join('office_type as oc', 'oc.id = bd.office_type', 'left');
        $this->db->where_in('bd.id', $ids);
        $this->db->order_by('oc.id','ASC')->group_by('oc.id');
        $this->data['summary'] = $this->db->get()->result();
        $this->data['ids'] = $ids;
        // dd($this->data['summary']);

        //Load view
        $this->data['meta_title'] = 'বাজেট সামারী ';
        $this->data['subview'] = 'budget_nilg/dpt_training_summary_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function dpt_training_summary_edit($encid)
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('description', 'নোট', 'required|trim');
        if ($this->form_validation->run() == true && $this->input->post('check') != '') {
            $form_data = array(
                'description' => $this->input->post('description'),
            );

            $this->db->trans_start();
            if ($this->db->where('id', $id)->update('budget_nilg', $form_data)) {
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/dpt_summary_training");
            } else {
                $this->session->set_flashdata('error', 'তথ্যটি ডাটাবেসে সংরক্ষণ করা সম্ভব হচ্ছে না.');
                redirect("budgets/dpt_summary_training");
            }
        }
        //Dropdown
        $this->data['info'] = $this->Common_model->get_single_data('budget_nilg', $id);
        $this->db->select('bd.*, sy.session_name, oc.office_type_name as office');
        $this->db->from('budget_nilg_details bd');
        $this->db->join('office_type as oc', 'oc.id = bd.head_id', 'left');
        $this->db->join('session_year as sy', 'sy.id = bd.fcl_year', 'left');
        $this->db->where('bd.nilg_id', $id);
        $this->db->where('bd.modify_soft_d !=', 2);
        $this->data['summary'] = $this->db->get()->result();

        //Load view
        $this->data['meta_title'] = 'সামারী সম্পাদনা';
        $this->data['subview'] = 'budget_nilg/dpt_training_summary_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function training_marge_insert($sub_it_id, $head_id, $sub_ids, $sub_d, $sub_p, $base, $tot_p, $sub_amt, $type, $fy, $user, $loc = null)
    {
        for ($i=0; $i < sizeof($sub_ids); $i++) {
            $sub_form[] = array(
                'rev_sum_details' => $sub_it_id,
                'head_id' => $head_id,   // office type id
                'head_sub_id' => $sub_ids[$i],  // course id
                'type' => 3,   // training dpt marge
                'days' => $sub_d[$i],
                'participants' => $sub_p[$i],
                'batch' => $base[$i],   // training dpt marge
                'total_participants' => $tot_p[$i],   // training dpt marge
                'amount' => $sub_amt[$i],
                'total_amt' => $sub_amt[$i],
                'trainee_type' => $type[$i],  // training participant
                'fcl_year' => $fy,
                'training_area' => $loc[$i],
                'status' => 1,
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
        }
        // dd($sub_form);
        $this->db->insert_batch('budget_nilg_sub_details', $sub_form);
        return 1;
    }
    public function dpt_training_summary_print($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->data['info'] = $this->Common_model->get_single_data('budget_nilg', $id);

        $this->db->select('bd.*, sy.session_name, oc.office_type_name as office');
        $this->db->from('budget_nilg_details bd');
        $this->db->join('office_type as oc', 'oc.id = bd.head_id', 'left');
        $this->db->join('session_year as sy', 'sy.id = bd.fcl_year', 'left');
        $this->db->where('bd.nilg_id', $id);
        $this->db->where('bd.modify_soft_d !=', 2);
        $this->data['summary'] = $this->db->get()->result();
        // dd($this->data['summary']);

        //Load view
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg/dpt_training_summary_print', $this->data, true);
        // exit();
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    public function training_summary_forward($status,$encid){
        $id = (int) decrypt_url($encid);
        $data =  array('status' => $status);
        $this->db->trans_start();
        $this->db->where('id', $id);
        if ($this->db->update('budget_nilg', $data)) {
            if ($status == 8 && $this->ion_auth->in_group(array('ad'))) {
                $ids = $this->db->where('id', $id)->get('budget_nilg')->row()->update_ids;
                $this->db->where_in('id', explode(',', $ids));
                $this->db->update('budget_field', array('status' => 9));
            }
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/dpt_summary_training");
        } else {
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
            redirect("budgets/dpt_summary_training");
        }
    }
    // Training Budget end
    // training office budget end

    function dpt_summary($offset = 0) {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        // $user = $this->ion_auth->user()->row();
        if ($dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }

        if ($this->ion_auth->in_group(array('ad')) && $dept_id == 2 ) {
            $type = array(3);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, null, $dept_id, $type, null);
        } else if ($this->ion_auth->in_group(array('ad'))) {
            $type = array(1);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, null, $dept_id, $type, null);
        } else if ($this->ion_auth->in_group(array('dd'))) {
            $type = array(1,3);
            $arr = array(2,3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, $arr, null, $type, null);
        } else if ($this->ion_auth->in_group(array('jd'))) {
            $type = array(1,3);
            $arr = array(3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, $arr, null, $type, null);
        } else if ($this->ion_auth->in_group(array('director'))) {
            $type = array(1,3);
            $arr = array(4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, $arr, null, $type, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $type = array(1,3);
            $arr = array(5,6,7,8,9,13,14,15,16,17,18,19,20,21,22);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, $arr, null, $type, null);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $type = array(1,3);
            $arr = array(6,7,8);
            $results = $this->Budgets_model->dpt_summary($limit, $offset, $arr, null, $type, null);
            // dd($results);
        } else if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Budgets_model->dpt_summary($limit, $offset);
        }
        $this->data['summary'] = $results;
        // dd($this->data['summary']);

        //Load view
        $this->data['meta_title'] = 'সামারী তালিকা';
        $this->data['subview'] = 'budget_nilg/dpt_summary';
        $this->load->view('backend/_layout_main', $this->data);
    }
    function dpt_summary_rev($offset = 0) {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        // $user = $this->ion_auth->user()->row();
        if ($dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $type = array(1,3);
        $arr = array(8);

        $results = $this->Budgets_model->dpt_summary($limit, $offset, $arr, null, $type, null);
        $this->data['summary'] = $results;
        // dd($this->data['summary']);

        //Load view
        $this->data['meta_title'] = 'সামারী তালিকা';
        $this->data['subview'] = 'budget_nilg/dpt_summary_rev';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function dpt_summary_rev_details($encid) {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $id = (int) decrypt_url($encid);
        // $user = $this->ion_auth->user()->row();
        if ($dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }

        $this->db->select('bhs.name_bn, bhs.bd_code, bd.*,
                SUM(CASE WHEN bd.type = 1 THEN bd.amount ELSE 0 END) AS first_amt,
                SUM(CASE WHEN bd.type = 2 THEN bd.amount ELSE 0 END) AS second_amt,
                SUM(CASE WHEN bd.type = 3 THEN bd.amount ELSE 0 END) AS third_amt,
                SUM(CASE WHEN bd.type = 4 THEN bd.amount ELSE 0 END) AS fou_amt,
            ');
        $this->db->from('budget_revenue_amt as bd');
        $this->db->join('budget_head_sub as bhs', 'bd.sub_head_id = bhs.id');
        $this->db->where('bd.rev_sum_id', $id);
        $this->db->group_by('bd.sub_head_id');
        $this->data['summary'] = $this->db->get()->result();
        $this->data['info'] = $this->Common_model->get_single_data('budget_revenue_summary', $id);

        //Load view
        $this->data['meta_title'] = 'বাজেট তালিকা';
        $this->data['subview'] = 'budget_nilg/dpt_summary_rev_details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    function dpt_summary_rev_details_print($encid) {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $id = (int) decrypt_url($encid);
        // $user = $this->ion_auth->user()->row();
        if ($dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }

        $this->db->select('bhs.name_bn, bhs.bd_code, bd.*,
                SUM(CASE WHEN bd.type = 1 THEN bd.amount ELSE 0 END) AS first_amt,
                SUM(CASE WHEN bd.type = 2 THEN bd.amount ELSE 0 END) AS second_amt,
                SUM(CASE WHEN bd.type = 3 THEN bd.amount ELSE 0 END) AS third_amt,
                SUM(CASE WHEN bd.type = 4 THEN bd.amount ELSE 0 END) AS fou_amt,
            ');
        $this->db->from('budget_revenue_amt as bd');
        $this->db->join('budget_head_sub as bhs', 'bd.sub_head_id = bhs.id');
        $this->db->where('bd.rev_sum_id', $id);
        $this->db->group_by('bd.sub_head_id');
        $this->data['summary'] = $this->db->get()->result();
        $this->data['info'] = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg/dpt_summary_rev_details_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }

    public function dpt_summary_rev_rajossho_entry($encid){
        $id = (int) decrypt_url($encid);
        $budget_nilg = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->data['budget_nilg'] = $budget_nilg;
        if($budget_nilg->dept_id == 2){
            $this->db->select('asd.*,
                        asd.id as rmv_details_id,
                        SUM(asd.amount) AS amount,
                        SUM(asd.prokolpito_amt) AS prokolpito_amt,
                    ');
            $this->db->from('budget_revenue_summary_details asd');
            $this->db->where('asd.revenue_summary_id', $id);
            $this->db->group_by('asd.revenue_summary_id');
            $ress = $this->db->get()->result();
            $ress[0]->head_sub_id = '35';
            $ress[0]->name_bn = 'প্রশিক্ষণ';
            $ress[0]->bd_code = '3231301';
        } else {
            $this->db->select('asd.*,
                        asd.id as rmv_details_id,
                        budget_head_sub.name_bn,
                        budget_head_sub.bd_code,
                        budget_head.name_bn as budget_head_name,
                    ');
            $this->db->from('budget_revenue_summary_details asd');
            $this->db->join('budget_head_sub', 'asd.head_sub_id = budget_head_sub.id');
            $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
            $this->db->where('asd.revenue_summary_id', $id);
            $ress = $this->db->get()->result();
        }
        $this->data['budget_nilg_details'] = $ress;

        $this->db->select('budget_head_sub.id,budget_head_sub.bd_code, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_nilg']->created_by);

        $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        $this->data['rev_sum_id'] = $id;
        $this->data['subview'] = 'budget_nilg/dpt_summary_rev_rajossho_entry';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function dpt_summary_rev_rajossho_entry_add(){

        $user = $this->ion_auth->user()->row();
        for ($i = 0; $i < sizeof($_POST['amount']); $i++) {
            $sub_head = $_POST['head_sub_id'][$i];
            $form_data2 = array(
                'rev_sum_id' => $_POST['rev_sum_id'],
                'sub_head_id' => $sub_head,
                'amount' => $_POST['amount'][$i],
                'fcl_year' => $_POST['fcl_year'],
                'type' => $_POST['type'],
                'created_by' => $user->id,
            );

            if ($this->Common_model->save('budget_revenue_amt', $form_data2)) {
                $row = $this->db->where('id', $sub_head)->get('budget_head_sub')->row();
                $amt = $_POST['amount'][$i] + $row->amount;
                $this->db->where('id', $sub_head)->update('budget_head_sub', array('amount' => $amt));
            }
        }
        redirect("budgets/dpt_summary_rev");
    }
    public function dpt_summary_create()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $ids = $this->input->post('id');
        if (empty($ids)) {
            $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');
            $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
            if ($this->form_validation->run() == true) {
                // dd($_POST);
                $form_data = array(
                    'amount' => $this->input->post('total_amount'),
                    'fcl_year' => $this->input->post('fcl_year'),
                    'description' => $this->input->post('description'),
                    'dpt_head_id' => $user->crrnt_dept_id,
                    'dept_id' => $user->crrnt_dept_id,
                    'type' => 3, // training dpt marge
                    'status' => 1, // pending
                    'created_by' => $user->id,
                );

                $this->db->trans_start();
                if ($this->Common_model->save('budget_revenue_summary', $form_data)) {
                    $insert_id = $this->db->insert_id();
                    for ($i = 0; $i < sizeof($_POST['office_type']); $i++) {
                        $head_id = $_POST['office_type'][$i];
                        $form_data2 = array(
                            'revenue_summary_id' => $insert_id,
                            'head_id' => $head_id, // office type id
                            'type' => 3,   // training dpt marge and head_id replace to office type
                            'amount' => $_POST['office_amt'][$i],
                            'fcl_year' => $this->input->post('fcl_year'),
                            'status' => 1,
                            'dept_id' => $user->crrnt_dept_id,
                            'created_by' => $user->id,
                        );

                        $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                        $sub_it_id = $this->db->insert_id();
                        $sub_ids = $_POST[$head_id.'_course_id']; // course id
                        $sub_d = $_POST[$head_id.'_course_day'];
                        $sub_p = $_POST[$head_id.'_participants'];
                        $base = $_POST[$head_id.'_batch_number'];
                        $tot_p = $_POST[$head_id.'_total_participants'];
                        $sub_amt = $_POST[$head_id.'_amount'];
                        $type = $_POST[$head_id.'_trainee_type'];
                        $loc = $_POST[$head_id.'_location'];  // training location
                        $fy = $this->input->post('fcl_year');
                        $this->dpt_marge_insert($sub_it_id, $head_id, $sub_ids, $sub_d, $sub_p, $base, $tot_p, $sub_amt, $type, $fy, $user, $loc);
                    }

                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/dpt_summary");
                }
            }
        }

        //Dropdown
        $this->db->select('bd.*, SUM(bd.amount) as office_amt, oc.office_type_name as office');
        $this->db->from('budget_revenue_summary bd');
        $this->db->join('office_type as oc', 'oc.id = bd.office_type', 'left');
        $this->db->where_in('bd.id', $ids);
        $this->db->order_by('oc.id','ASC')->group_by('oc.id');
        $this->data['summary'] = $this->db->get()->result();
        $this->data['ids'] = $ids;

        //Load view
        $this->data['meta_title'] = 'বাজেট সামারী ';
        $this->data['subview'] = 'budget_nilg/dpt_summary_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function dpt_marge_insert($sub_it_id, $head_id, $sub_ids, $sub_d, $sub_p, $base, $tot_p, $sub_amt, $type, $fy, $user, $loc = null)
    {
        for ($i=0; $i < sizeof($sub_ids); $i++) {
            $sub_form[] = array(
                'rev_sum_details' => $sub_it_id,
                'head_id' => $head_id,   // office type id
                'head_sub_id' => $sub_ids[$i],  // course id
                'type' => 3,   // training dpt marge
                'days' => $sub_d[$i],
                'participants' => $sub_p[$i],
                'batch' => $base[$i],   // training dpt marge
                'total_participants' => $tot_p[$i],   // training dpt marge
                'amount' => $sub_amt[$i],
                'total_amt' => $sub_amt[$i],
                'trainee_type' => $type[$i],  // training dpt marge
                'fcl_year' => $fy,
                'training_area' => $loc[$i],
                'status' => 1,
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
        }
        // dd($sub_form);
        $this->db->insert_batch('budget_revenue_sub_details', $sub_form);
        return 1;
    }
    public function dpt_summary_details($encid)
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $id = (int) decrypt_url($encid);
        $this->form_validation->set_rules('description', 'নোট', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'description' => $this->input->post('description'),
                'update_at' => date("Y-m-d H:i:s"),
            );
            $this->db->trans_start();
            $this->db->where('id', $id)->update('budget_revenue_summary', $form_data);
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/dpt_summary");
        }

        $info = $this->Common_model->get_single_data('budget_revenue_summary', $id);
        $this->db->select('bd.*, SUM(bd.amount) as office_amt, oc.office_type_name as office');
        $this->db->from('budget_revenue_summary bd');
        $this->db->join('office_type as oc', 'oc.id = bd.office_type', 'left');
        $this->db->where('bd.type', 2);
        $this->db->where('bd.fcl_year', $info->fcl_year);
        $this->db->order_by('oc.id','ASC')->group_by('oc.id');
        $this->data['summary'] = $this->db->get()->result();
        $this->data['info'] = $info;

        //Load view
        $this->data['meta_title'] = 'বাজেট সামারী';
        $this->data['subview'] = 'budget_nilg/dpt_summary_details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function dpt_marge_update($details_id, $sub_ids, $sub_d, $sub_p, $base, $tot_p, $sub_amt)
    {
        for ($i=0; $i < sizeof($details_id); $i++) {
            $sub_form = array(
                'days' => $sub_d[$i],
                'participants' => $sub_p[$i],
                'batch' => $base[$i],   // training dpt marge
                'total_participants' => $tot_p[$i],   // training dpt marge
                'amount' => $sub_amt[$i],
                'total_amt' => $sub_amt[$i],
            );
            // dd($sub_form);
            // $check = $this->db->where('id', $details_id[$i])->get('budget_revenue_sub_details')->row();
            if (isset($details_id[$i]) && $details_id[$i] != null) {
                $this->db->where('id', $details_id[$i]);
                $this->db->update('budget_revenue_sub_details', $sub_form);
            }
        }
        return 1;
    }
    public function dpt_summary_forward($status,$encid){
        $id = (int) decrypt_url($encid);
        $data =  array('status' => $status);
        $this->db->trans_start();
        $this->db->where('id', $id);
        if ($this->db->update('budget_revenue_summary', $data)) {
            $this->db->trans_complete();
            if ($status == 8) {
                $this->update_head_amt($id);
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/dpt_summary");
        } else {
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
            redirect("budgets/dpt_summary");
        }
    }

    function update_head_amt($id) {
        $check = $this->db->where('id', $id)->get('budget_revenue_summary')->row();
        if ($check->type == 3 && $check->dept_id == 2) {
            $this->db->where('id', 35)->update('budget_head_sub', array('budget_amt' => $check->amount));
        } else {
            $check = $this->db->where('id', $id)->get('budget_revenue_summary')->row();
            $this->db->where('asd.revenue_summary_id', $id);
            $ress = $this->db->get('budget_revenue_summary_details asd')->result();
            foreach ($ress as $key => $r) {
                $data = array(
                    'prev_amt' => $r->running_amt,
                    'budget_amt' => $r->amount,
                );
                $this->db->where('id', $r->head_sub_id)->update('budget_head_sub', $data);
            }
        }
        return true;
    }

    public function dpt_summary_revenue_amt($encid){
        $id = (int) decrypt_url($encid);
        $this->db->trans_start();
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        if ($this->form_validation->run() == true) {
            $this->db->where('id', $id);
            if ($this->db->update('budget_revenue_summary', $data)) {
                $this->db->trans_complete();
                $this->update_acc($id);
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/dpt_summary");
            } else {
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
            }
        }
        //Load view
        $this->data['meta_title'] = 'বাজেট সামারী ';
        $this->data['subview'] = 'budget_nilg/dpt_summary_create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function update_acc($id){
        $this->db->where('id', $id);
        $data = $this->db->get('budget_revenue_summary')->row();
        // dd($data);
        $b_data = array(
            'summary_id' => $id,
            'amount' => $data->amount,
            'fcl_year' => $data->fcl_year,
            'quarter' => 1,
            'type' => $data->type,
            'status' => 1,
            'created_by' => $data->created_by,
            'created_at' => $data->created_at,
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $check = $this->db->where('summary_id', $id)->get('budgets')->row();
        if (!empty($check)) {
            $this->db->where('summary_id', $id)->update('budgets', $b_data);
        } else {
            $this->db->insert('budgets', $b_data);
        }
         $this->sub_head_amount_update($data);

        $this->db->where('dept_id', $data->dept_id);
        $budgets_dept_account = $this->db->get('budgets_dept_account')->row();
        if (!empty($budgets_dept_account)) {
            $data= array(
                'amount_in' => $budgets_dept_account->amount_in + $data->amount,
                'balance' => $budgets_dept_account->balance + $data->amount,
            );
            $this->db->where('id', $budgets_dept_account->id);
            $this->db->update('budgets_dept_account', $data);
        }else{
            $data= array(
                'amount_in' => $data->amount,
                'balance' => $data->amount,
                'dept_id' => $data->dept_id
            );
            $this->db->insert('budgets_dept_account', $data);
        }
    }
    function sub_head_amount_update($data) {
        if ($data->type == 3) {
            $data = array('amount' => $data->amount, 'status' => 1, 'updated_at' => date('Y-m-d H:i:s'));
            $this->db->where('id', 35)->update('budgets', $data);
        }
    }
    public function dpt_summary_print($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->data['info'] = $this->Common_model->get_single_data('budget_revenue_summary', $id);

        $this->db->select('bd.*, sy.session_name, oc.office_type_name as office');
        $this->db->from('budget_revenue_summary_details bd');
        $this->db->join('office_type as oc', 'oc.id = bd.head_id', 'left');
        $this->db->join('session_year as sy', 'sy.id = bd.fcl_year', 'left');
        $this->db->where('bd.revenue_summary_id', $id);
        $this->db->where('bd.modify_soft_d !=', 2);
        $this->data['summary'] = $this->db->get()->result();
        // dd($this->data['summary']);

        //Load view
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg/dpt_summary_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    public function budgets_dpt_remove_row()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        if ($this->db->update('budget_revenue_summary_details', array('modify_soft_d' => 2))) {
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }
    // Revenue Summary section end

    // department wise marge start
    function acc_summary() {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $this->db->select('bd.*, bhs.session_name, d.dept_name');
        $this->db->from('budget_revenue_summary bd');
        $this->db->join('session_year as bhs', 'bhs.id = bd.fcl_year', 'left');
        $this->db->join('department as d', 'd.id = bd.dept_id', 'left');
        $this->db->where('bd.type', 2);

        $this->data['summary'] = $this->db->order_by('bd.id','desc')->get()->result();

        //Load view
        $this->data['meta_title'] = 'সামারী তালিকা';
        $this->data['subview'] = 'budget_nilg/acc_summary';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function acc_summary_create()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("my_profile");
        }
        $ids = $this->input->post('id');
        if (empty($ids)) {
            $this->form_validation->set_rules('total_amount', 'সর্বমোট পরিমান', 'required|trim');
            $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
            if ($this->form_validation->run() == true) {
                $form_data = array(
                    'dpt_amt' => $this->input->post('total_amount'),
                    'fcl_year' => $this->input->post('fcl_year'),
                    'acc_head_id' => $user->crrnt_dept_id,
                    'type' => 2,
                    'status' => 3,
                    'created_by' => $user->id,
                );

                $this->db->trans_start();
                if ($this->Common_model->save('budget_revenue_summary', $form_data)) {
                    $insert_id = $this->db->insert_id();
                    for ($i = 0; $i < sizeof($_POST['head_sub_id']); $i++) {
                        $form_data2 = array(
                            'revenue_summary_id' => $insert_id,
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'acc_amt' => $_POST['dpt_amt'][$i],
                            'fcl_year' => $_POST['fcl_year'],
                            'modify_soft_d' => 1,
                            'dpt_head_id' => $user->crrnt_dept_id,
                            'created_by' => $user->id,
                        );
                        $this->Common_model->save('budget_revenue_summary_details', $form_data2);
                    }
                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/acc_summary");
                }
            }
        }

        //Dropdown
        $this->db->select('
                        bd.id,
                        bd.head_sub_id,
                        SUM(bd.dpt_amt) as amount,
                        SUM(bd.acc_amt) as acc_amt,
                        SUM(bd.dg_amt) as dg_amt,
                        SUM(bd.revenue_amt) as revenue_amt,
                        bhs.name_bn,
                        bhs.bd_code,
                    ');
        $this->db->from('budget_revenue_summary_details bd');
        $this->db->join('budget_head_sub as bhs', 'bhs.id = bd.head_sub_id', 'left');
        $this->db->where_in('bd.revenue_summary_id', $ids);
        $this->db->where('bd.modify_soft_d !=', 2);
        $this->db->order_by('bd.head_sub_id','ASC')->group_by('bd.head_sub_id');
        $this->data['summary'] = $this->db->get()->result();

        //Load view
        $this->data['meta_title'] = 'বাজেট সামারী ';
        $this->data['subview'] = 'budget_nilg/acc_summary_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function acc_summary_print($encid)
    {
        $id = (int) decrypt_url($encid);
        $this->db->select('
                brs.*,
                dpt.name_en,
                dpt.dept_name,
                acu.name_bn as acu_h_name_bn,
                acu.name_en as acu_h_name_en,
                acu.signature as acu_h_signature,
                crt.name_bn as crt_by_name_bn,
                crt.name_en as crt_by_name_en,
                crt.signature as crt_by_signature,
            ');
        $this->db->from('budget_revenue_summary as brs');
        $this->db->join('department dpt', 'brs.dept_id = dpt.id', 'left');
        $this->db->join('users as acu', 'brs.acc_head_id = acu.id', 'left');
        $this->db->join('users as crt', 'brs.created_by = crt.id', 'left');
        $this->db->where('brs.id', $id);
        $this->data['info'] = $this->db->get()->row();


        $this->db->select('bd.*, sy.session_name, bhs.name_bn, bhs.bd_code');
        $this->db->from('budget_revenue_summary_details bd');
        $this->db->join('budget_head_sub as bhs', 'bhs.id = bd.head_sub_id', 'left');
        $this->db->join('session_year as sy', 'sy.id = bd.fcl_year', 'left');
        $this->db->where('bd.revenue_summary_id', $id);
        $this->db->where('bd.modify_soft_d !=', 2);
        $this->data['results'] = $this->db->get()->result();

        // Generate PDF
        $this->data['headding'] = 'বাজেট সামারী';
        $html = $this->load->view('budget_nilg/acc_summary_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    // department wise marge end









    public function field_statement_of_expenses2($encid)
    {
        $id = (int) decrypt_url($encid);
            $this->db->select('
                budget_field.*,
                office_type.office_type_name,
                office.office_name,
                session_year.session_name
            ')
            ->from('budget_field')
            ->join('office', 'budget_field.office_id = office.id', 'left')
            ->join('office_type', 'office.office_type = office_type.id', 'left')
            ->join('session_year', 'budget_field.fcl_year = session_year.id', 'left')
            ->where('budget_field.id', $id);
        $this->data['budget_field'] = $this->db->get()->row();
        // dd($budget_field);

        $this->db->select('dd.*, budget_head.name_bn');
        $this->db->from('budget_field_details as dd');
        $this->db->join('budget_head', 'dd.head_id = budget_head.id');
        $this->db->where('dd.budget_field_id', $id);
        $this->db->where('dd.modify_soft_d', 1);
        $this->data['results'] = $this->db->get()->result();

        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_field']->created_by);

        $this->data['meta_title'] = 'বাজেট ব্যয় বিবরণী ';
        $this->data['subview'] = 'budget_field/field_statement_of_expenses2';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_field_create2()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("budgets/budget_field");
        }

        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            $form_data = array(
                'title' => $this->input->post('title'),
                'office_type' => $this->input->post('office_type'),
                'amount' => $this->input->post('total_amount'),
                'status' => 1,
                'fcl_year' => $this->input->post('fcl_year'),
                'office_id' => $this->input->post('office_id'),
                'description' => $this->input->post('description'),
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
                'payment_for'=>$this->input->post('payment_for')
            );
            if ($this->Common_model->save('budget_field', $form_data)) {
                $insert_id = $this->db->insert_id();
                $this->generator_qrcode($insert_id, $this->input->post('office_type'));
                $custom=[];
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'budget_field_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'office_type' => $this->input->post('office_type'),
                        'type' => 1,
                        'token' => '',
                        'group_name' => $_POST['group_name'][$i],
                        'amount' => $_POST['token_amount'][$i],
                        'days' => $_POST['token_day'][$i],
                        'participants' => $_POST['token_participant'][$i],
                        'total_amt' => $_POST['amount'][$i],
                        'status' => 1,
                        'office_id' => $this->input->post('office_id'),
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );
                    $this->db->insert('budget_field_details', $form_data2);
                    $insert_id2 = $this->db->insert_id();
                    if($_POST['head_sub_id'][$i]==100){
                        $custom[]= $insert_id2;
                    }
                }
                if (!empty($custom)) {
                    for ($i=0; $i < sizeof($custom); $i++) {
                        $form_data3 = array(
                            'details_id'=>$custom[$i],
                            'name'=>$_POST['custom_m'][$i],
                        );
                        $this->db->insert('budget_custom_sub_head', $form_data3);
                    }
                    # code...
                }

                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_field");
            }

        }

        $this->db->select('
            budget_head_sub.id,
            budget_head_sub.bd_code,
            budget_head_sub.name_bn,
            budget_head.name_bn as budget_head_name,
            budget_head.id as budget_head_id
        ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_field/create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function budget_field_details_template($encid)
    {
        $id = (int) decrypt_url($encid);
        $budget_field = $this->Common_model->get_single_data('budget_field', $id);
        $this->data['budget_field'] = $budget_field;
        $this->db->select('budget_field_details.*,budget_field_details.id as budget_field_details_id,budget_head_sub.bd_code,budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
        $this->db->from('budget_field_details');
        $this->db->join('budget_head_sub', 'budget_field_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_field_details.budget_field_id', $id);
        $this->db->where('budget_field_details.modify_soft_d', 1);
        $this->db->order_by('budget_field_details.group_name','asc');

        $budget_field_details = $this->db->get()->result();
        $this->data['budget_field_details'] = $budget_field_details;

        $this->db->select('budget_head_sub.id,budget_head_sub.bd_code, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_field']->created_by);

        $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        $this->data['subview'] = 'budget_field/details';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function statement_of_expenses_create(){
        $this->db->where('budget_field_id', $this->input->post('budget_field_id'));
        $this->db->delete('budget_field_expenses');
        foreach ($this->input->post('head_sub_id') as $key => $value) {
            $data['budget_field_id'] = $this->input->post('budget_field_id');
            $data['budget_field_details_id'] = $this->input->post('budget_field_details_id')[$key];
            $data['head_sub_id'] = $value;
            $data['real_expense'] = $this->input->post('real_expense')[$key];
            $data['vat'] = $this->input->post('vat')[$key];
            $data['it_kor'] = $this->input->post('it_kor')[$key];
            $data['overall_expense'] = $this->input->post('overall_expense')[$key];
            $data['update_at'] = date('Y-m-d H:i:s');
            $this->db->insert('budget_field_expenses', $data);
        }
        $this->db->where('id', $this->input->post('budget_field_id'));
        $this->db->update('budget_field', array('total_overall_expense' => $this->input->post('total_overall_expense')));
        $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
        redirect("budgets/budget_field");
    }

    public function budget_field_edit()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            $form_data = array(
                'title' => $this->input->post('title'),
                'office_type' => $this->input->post('office_type'),
                'amount' => $this->input->post('total_amount'),
                'status' => 1,
                'fcl_year' => $this->input->post('fcl_year'),
                'office_id' => $this->input->post('office_id'),
                'description' => $this->input->post('description'),
                'dept_id' => $user->crrnt_dept_id,
                'created_by' => $user->id,
            );
            $this->db->where('id', $this->input->post('budget_field_id'));
            if ($this->db->update('budget_field', $form_data)) {
                $insert_id = $this->input->post('budget_field_id');
                $this->db->where('budget_field_id', $insert_id);
                $this->db->delete('budget_field_details');
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'budget_field_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'office_type' => $this->input->post('office_type'),
                        'type' => 1,
                        'token' => '',
                        'group_name' => $_POST['group_name'][$i],
                        'amount' => $_POST['token_amount'][$i],
                        'days' => $_POST['token_day'][$i],
                        'participants' => $_POST['token_participant'][$i],
                        'total_amt' => $_POST['amount'][$i],
                        'status' => 1,
                        'office_id' => $this->input->post('office_id'),
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );
                    $this->db->insert('budget_field_details', $form_data2);
                    $insert_id2 = $this->db->insert_id();
                    if($_POST['head_sub_id'][$i]==100){
                        $custom[]= $insert_id2;
                    }
                }
                if (!empty($custom)) {
                    for ($i=0; $i < sizeof($custom); $i++) {
                        $form_data3 = array(
                            'details_id'=>$custom[$i],
                            'name'=>$_POST['custom_m'][$i],
                        );
                        $this->db->insert('budget_custom_sub_head', $form_data3);
                    }
                    # code...
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_field");
            }
        }
    }

    public function budgets_field_remove_row()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        if ($this->db->update('budget_field_details', array('modify_soft_d' => 2))) {
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    public function get_office_id_by_type(){
        $type = $this->input->post('office_type');
        $office_id = $this->Common_model->get_office_id_by_type($type);
        echo json_encode($office_id);
    }

    public function add_new_row_field()
    {
        $id = $this->input->post('head_id');

        $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_head_sub.id', $id);
        echo json_encode($this->db->get()->row());

    }
    // End Budget field



    public function budget_nilg_copy($offset = 0)
    {
        $limit = 15;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        if ($this->ion_auth->in_group(array('ad'))) {
            $arr = array(2,3,4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, $dept_id);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $arr = array(3,4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('dg'))) {
            $arr = array(4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('admin', 'nilg'))) {
            $results = $this->Budgets_model->get_budget($limit, $offset);
        } else {
            $results = $this->Budgets_model->get_budget($limit, $offset, array(), $dept_id, $user_id);
        }


        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_nilg/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = 'budget_nilg/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_nilg_create_copy()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        $this->form_validation->set_rules('fcl_year', 'অর্থ বছর', 'required|trim');
        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'dept_id' => $user->crrnt_dept_id,
                'status' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'desk' => $this->ion_auth->in_group(array('ad')) ? 2 : 1,
                'description' => $this->input->post('description'),
                'created_by' => $user->id,
            );

            if ($this->Common_model->save('budget_nilg', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'budget_nilg_id' => $insert_id,
                        'head_id' => $_POST['head_id'][$i],
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'amount' => $_POST['amount'][$i],
                        'fcl_year' => $_POST['fcl_year'],
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_nilg_details', $form_data2);
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_nilg");
            }
        }

        $this->db->select('
                            budget_head_sub.id,
                            budget_head_sub.bd_code,
                            budget_head_sub.name_bn,
                            budget_head.name_bn as budget_head_name,
                            budget_head.id as budget_head_id
                            ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_nilg/budget_nilg_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_nilg_acc_edit()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')=='ফরওয়ার্ড করুন') {
                    $user = $this->ion_auth->user()->row();
                    $form_data = array(
                        'title' => $this->input->post('title'),
                        'acc_amt' => $this->input->post('total_amount'),
                        'status' => 4,
                        'acc_head_id' =>$this->ion_auth->user()->row()->id,
                        'desk' => 4,
                        'description' => $this->input->post('description'),
                        'update_at' => date("Y-m-d H:i:s"),
                    );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_nilg', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'budget_nilg_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'acc_amt' => $_POST['acc_amt'][$i],
                        );
                        if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_nilg_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                            $this->db->update('budget_nilg_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }else{
                $user = $this->ion_auth->user()->row();
                $form_data = array(
                    'title' => $this->input->post('title'),
                    'acc_amt' => $this->input->post('total_amount'),
                    'description' => $this->input->post('description'),
                    'update_at' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_nilg', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'budget_nilg_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'acc_amt' => $_POST['acc_amt'][$i],
                        );
                        if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_nilg_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                            $this->db->update('budget_nilg_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }
        }
    }
    public function budget_nilg_dg_edit()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')=='ফরওয়ার্ড করুন') {
                    $user = $this->ion_auth->user()->row();
                    $form_data = array(
                        'title' => $this->input->post('title'),
                        'dg_amt' => $this->input->post('total_amount'),
                        'status' => 5,
                        'dg_user_id' =>$this->ion_auth->user()->row()->id,
                        'desk' => 5,
                        'description' => $this->input->post('description'),
                        'update_at' => date("Y-m-d H:i:s"),
                    );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_nilg', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'budget_nilg_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'dg_amt' => $_POST['dg_amt'][$i],
                        );
                        if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_nilg_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                            $this->db->update('budget_nilg_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }else{
                $user = $this->ion_auth->user()->row();
                $form_data = array(
                    'title' => $this->input->post('title'),
                    'dg_amt' => $this->input->post('total_amount'),
                    'description' => $this->input->post('description'),
                    'update_at' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_nilg', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'budget_nilg_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'dg_amt' => $_POST['dg_amt'][$i],
                        );
                        if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_nilg_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                            $this->db->update('budget_nilg_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }
        }
    }
    public function budget_nilg_acc_final()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')=='ফরওয়ার্ড করুন') {
                    $user = $this->ion_auth->user()->row();
                    $form_data = array(
                        'title' => $this->input->post('title'),
                        'revenue_amt' => $this->input->post('total_amount'),
                        'acc_id' => $this->ion_auth->user()->row()->id,
                        'status' => 6,
                        'desk' => 6,
                        'description' => $this->input->post('description'),
                        'update_at' => date("Y-m-d H:i:s"),
                    );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_nilg', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'budget_nilg_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'revenue_amt' => $_POST['revenue_amt'][$i],
                        );
                        if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_nilg_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                            $this->db->update('budget_nilg_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }else{
                $user = $this->ion_auth->user()->row();
                $form_data = array(
                    'title' => $this->input->post('title'),
                    'revenue_amt' => $this->input->post('total_amount'),
                    'description' => $this->input->post('description'),
                    'update_at' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $this->input->post('budget_nilg_id'));
                if ($this->db->update('budget_nilg', $form_data)) {
                    $insert_id = $this->input->post('budget_nilg_id');
                    for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                        $form_data2 = array(
                            'budget_nilg_id' => $insert_id,
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'revenue_amt' => $_POST['revenue_amt'][$i],
                        );
                        if ($_POST['budget_nilg_details_id'][$i] == 'new') {
                            $this->Common_model->save('budget_nilg_details', $form_data2);
                        } else {
                            $this->db->where('id', $_POST['budget_nilg_details_id'][$i]);
                            $this->db->update('budget_nilg_details', $form_data2);
                        }
                    }
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                    redirect("budgets/budget_nilg");
                } else {
                    $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
                    redirect("budgets/budget_nilg");
                }
            }
        }
    }

    public function budgets_nilg_remove_row()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        if ($this->db->update('budget_nilg_details', array('modify_soft_d' => 2))) {
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    public function nilg_change_status($requisition_id = null){
        $id  = (int) decrypt_url($this->input->post('id'));
        $type  = $this->input->post('type');
        $info = $this->Budgets_model->get_budget_nilg_info($id);

        if ($type == 1 && !empty($info)) {
            if ($info->status == 1) {
                $status = 2;
                $desk = 2;
            } else if ($info->status == 2) {
                $status = 3;
                $desk = 3;
            } else if ($info->status == 3) {
                $status = 4;
                $desk = 4;
            } else if ($info->status == 4) {
                $desk = 5;
                $status = 5;
            } else if ($info->status == 5) {
                $desk = 6;
                $status = 6;
            } else {
                $desk = 7;
                $status = 7;
            }

            $form_data = array(
              'status'         => $status,
              'desk'           => $desk,
              'update_at'      => date('Y-m-d H:i:s')
            );

            if($this->Common_model->edit('budget_nilg',  $id, 'id', $form_data)){
              $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
              header('Content-Type: application/x-json; charset=utf-8');
              echo json_encode(array('status' => true));
            } else {
              echo json_encode(array('status' => false));
            }
        }
    }

    public function nilg_acc_summary_1st_not_used()
    {
        $fcy = $this->db->order_by('id','DESC')->get('session_year')->row();

        $this->db->select('b.id, b.title, b.acc_amt, dg_amt, b.revenue_amt, b.dept_id, dept.name_en, dept.dept_name');
        $this->db->from('budget_nilg b');

        $this->db->join('department as dept', 'dept.id = b.dept_id');
        $this->db->where('b.fcl_year', $fcy->id);
        $this->db->order_by('b.dept_id','ASC')->group_by('b.id');
        $this->data['summary'] = $this->db->get()->result();

        $this->data['meta_title'] = 'বাজেট সামারী ';
        $this->data['subview'] = 'budget_nilg/nilg_acc_summary';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function nilg_revenue_summary($arr = null)
    {
        $dept_id = $this->input->post('dept_id');
        $fcy = $this->db->order_by('id','DESC')->get('session_year')->row();

        $this->db->select('
                        bd.head_sub_id,
                        SUM(bd.acc_amt) as acc_amt,
                        SUM(bd.dg_amt) as dg_amt,
                        SUM(bd.revenue_amt) as revenue_amt,
                        bhs.name_bn,
                        bhs.bd_code,
                    ');
        $this->db->from('budget_nilg_details bd');
        $this->db->join('budget_nilg as b', 'b.id = bd.budget_nilg_id', 'left');
        $this->db->join('budget_head_sub as bhs', 'bhs.id = bd.head_sub_id', 'left');

        if (!empty( $dept_id)) {
            $this->db->where('b.dept_id', $dept_id);
        }
        $this->db->where('b.fcl_year', $fcy->id);
        $this->db->where_in('b.status', array(1,2,3,4,5,6));
        $this->db->order_by('bd.head_sub_id','ASC')->group_by('bd.head_sub_id');

        $this->data['summary'] = $this->db->get()->result();
        $this->data['fcl'] = $fcy;
        // dd($this->data['summary']);

        $this->data['meta_title'] = 'বাজেট সামারী ';
        $html = $this->load->view('budget_nilg/nilg_revenue_summary', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    // End Budget Nilg


    // Budget Entry part start
    public function budget_entry($offset = 0)
    {
        $limit = 15;
        $results = $this->Budgets_model->get_budget_entry($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_entry/budget_entry/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['meta_title'] = 'বাজেট এন্ট্রি';
        $this->data['subview'] = 'budget_entry/budget_entry';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_entry_create()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            // dd($this->input->post());
            $user = $this->ion_auth->user()->row();
            //	status 1=in, 2=out	created_by	created_at	updated_at

            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('budget_amount'),
                'fcl_year' => $this->input->post('fcl_year'),
                'quarter'=> $this->input->post('quarter'),
                'type' => $this->input->post('type'),
                'status' => 1,
            );
            if ($this->Common_model->save('budgets', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_sub_id']); $i++) {

                    $this->db->where('head_sub_id', $_POST['head_sub_id'][$i]);
                    $token = $this->db->get('budget_accounts')->row();
                    if (count($token) != 0) {
                        $form_data2 = array(
                            'amount'=> $_POST['amount'][$i]+$token->amount,
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->where('id', $token->id);
                        $this->db->update('budget_accounts', $form_data2);
                    }else{
                        $form_data2 = array(
                            'head_id' => $_POST['head_id'][$i],
                            'head_sub_id' => $_POST['head_sub_id'][$i],
                            'amount'=> $_POST['amount'][$i],
                            'status' => 1,
                            'created_by' => $user->id,
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('budget_accounts', $form_data2);
                    }

                    // id	budgets_id 	head_sub_id 	amount	type  status 1=in, 2=out	created_by	created_at	updated_at
                    $form_data3 = array(
                        'budgets_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'amount'=> $_POST['amount'][$i],
                        'status' => 1,
                        'type' => $this->input->post('type'),
                        'created_by' => $user->id,
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('budget_details', $form_data3);
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_entry");
            }
        }
        $this->db->select('budget_head_sub.id,budget_head_sub.bd_code, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'বাজেট তৈরি করুন';
        $this->data['subview'] = 'budget_entry/budget_entry_create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_entry_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,session_year.session_name');
        $this->db->from('budgets as q');
        $this->db->join('session_year','q.fcl_year=session_year.id','left');
        $this->db->where('q.id', $id);
        $this->data['budgets'] = $this->db->get()->row();

        $this->db->select('q.*,budget_head_sub.name_bn, budget_head.name_bn as budget_head_name, budget_head_sub.id as budget_head_sub_id');
        $this->db->from('budget_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('q.budgets_id', $id);
        $this->data['details'] = $this->db->get()->result();

         //Dropdown
         $this->data['info'] = $this->Common_model->get_user_details();
         //Load view
         $this->data['meta_title'] = 'বাজেট তৈরি করুন';
         $this->data['subview'] = 'budget_entry/budget_entry_details';
         $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_entry_print($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,session_year.session_name');
        $this->db->from('budgets as q');
        $this->db->join('session_year','q.fcl_year=session_year.id','left');
        $this->db->where('q.id', $id);
        $this->data['budgets'] = $this->db->get()->row();

        $this->db->select('q.*,budget_head_sub.name_bn, budget_head.name_bn as budget_head_name, budget_head_sub.id as budget_head_sub_id');
        $this->db->from('budget_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('q.budgets_id', $id);
        $this->data['details'] = $this->db->get()->result();

         //Dropdown
         $this->data['info'] = $this->Common_model->get_user_details();
         //Load view
         $this->data['info'] = $this->Common_model->get_user_details($this->data['budgets']->created_by);
        $this->data['headding'] = 'বাজেট';
        echo $html = $this->load->view('budget_entry/print', $this->data, true);
    }
    // Budget Entry part end

    /************************** Report Function  ******************************
    ***************************************************************************/
    public function budget_report(){
        $this->data['division'] = $this->Common_model->get_division();

        // $this->data['course_list'] = $this->Common_model->get_nilg_course();
        $this->data['course_list'] = $this->Common_model->get_course();
        // $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();
        $this->data['datasheet_status'] = $this->Common_model->get_data_status();

        //Load View
        $this->data['meta_title'] = 'বাজেট রিপোর্ট';
        $this->data['subview'] = 'budget_report/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    /************************** Report Function end ******************************
    ***************************************************************************/



    /************************** Common Function ******************************
    ***************************************************************************/
    public function generator_qrcode($id, $type)
    {
        // Get MAX Number accourding to LGI Type
        $code = str_pad($id,6,"0",STR_PAD_LEFT); //exit;

        if($type == 1){
            $preFix = 'UP';
        }elseif($type == 2){
            $preFix = 'PA';
        }elseif($type == 3){
            $preFix = 'UZ';
        }elseif($type == 4){
            $preFix = 'ZP';
        }elseif($type == 5){
            $preFix = 'CC';
        }elseif($type == 7){
            $preFix = 'N';
        }

        $pin = $preFix.$code;
        $this->db->where('id', $id)->update('budget_field', array('code' => $pin));
        return true;
    }

    /************************** Common Function end ******************************
    ***************************************************************************/

    public function chahida_potro(){
        $limit = 15;
        $offset = 0;
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        $results = $this->Budgets_model->get_chahida_potro($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        $this->data['pagination'] = create_pagination('budget/chahida_potro/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'চাহিদা পত্র এর তালিকা';
        $this->data['subview'] = 'chahida_potro/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function chahida_potro_create(){
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
            redirect("budgets/chahida_potro");
        }

        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            // dd($_POST);
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'status' => 1,
                'office_id' => ($user->office_id)? $user->office_id: 0,
                'description' => $this->input->post('description'),
                'dept_id' => $user->crrnt_dept_id,
                'fiscal_year' => $this->input->post('fiscal_year'),
                'created_by' => $user->id,
            );
            if ($this->Common_model->save('budget_chahida_potro', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'chahida_potro_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'amount' => $_POST['amount'][$i],
                        'group_name' => $_POST['group_name'][$i],
                        'office_id' => $user->office_id?: 0,
                        'dept_id' => $user->crrnt_dept_id?: 0,
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_chahida_potro_details', $form_data2);
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/chahida_potro");
            }
        }

        $this->db->select('
        budget_head_sub.id,
        budget_head_sub.bd_code,
         budget_head_sub.name_bn,
         budget_head.name_bn as budget_head_name,
         budget_head.id as budget_head_id
         ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['info'] = $this->Common_model->get_user_details();
        //Load view
        $this->data['meta_title'] = 'চাহিদা পত্র তৈরি করুন';
        $this->data['subview'] = 'chahida_potro/create';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_chahida_potro_details($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,office.office_name, department.name_en');
        $this->db->from('budget_chahida_potro as q');
        $this->db->join('office', 'q.office_id = office.id', 'left');
        $this->db->join('department', 'q.dept_id = department.id', 'left');
        $this->db->where('q.id', $id);
        $this->data['chahida_potro'] = $this->db->get()->row();

        $this->db->select('
                        q.*,
                        budget_head_sub.name_bn,
                        budget_head_sub.bd_code,
                        budget_head.name_bn as budget_head_name,
                        budget_head_sub.id as budget_head_sub_id
                        ');
        $this->db->from('budget_chahida_potro_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('q.chahida_potro_id', $id);
        $this->db->order_by('q.group_name', 'asc');

        $this->data['details'] = $this->db->get()->result();

        $this->data['info'] = $this->Common_model->get_user_details($this->data['chahida_potro']->created_by);

         //Load view
         $this->data['meta_title'] = 'চাহিদা পত্র তৈরি করুন';
         $this->data['subview'] = 'chahida_potro/details';
         $this->load->view('backend/_layout_main', $this->data);



    }

    public function budget_chahida_approve($encid){
        $id = (int) decrypt_url($encid);
        $this->db->where('id', $id);
        $this->db->update('budget_chahida_potro', array('status' => 2));
        $this->session->set_flashdata('success', 'অনুমোদন করা হয়েছে');
        redirect('budgets/chahida_potro');
    }
    public function budget_chahida_approve_partial($type,$encid){
        $id = (int) decrypt_url($encid);
        $this->db->where('id', $id);
        if ($type == 'jod') {
            $this->db->update('budget_chahida_potro', array('join_director_id' => $this->session->userdata('user_id'),'join_director_app_status'=>1));
            $this->session->set_flashdata('success', 'অনুমোদন করা হয়েছে');

        }elseif($type == 'dire'){
            $this->db->update('budget_chahida_potro', array('director_id' => $this->session->userdata('user_id'),'director_app_status'=>1));
            $this->session->set_flashdata('success', 'অনুমোদন করা হয়েছে');

        }elseif($type == 'acc'){
            $this->db->update('budget_chahida_potro', array('acc_id' => $this->session->userdata('user_id'),'acc_app_status'=>1));
            $this->session->set_flashdata('success', 'অনুমোদন করা হয়েছে');
        }else{
            $this->session->set_flashdata('error', 'অনুমোদন করা হয়নি');
        }
        redirect('budgets/chahida_potro');
    }
    public function budget_chahida_potro_print($encid){
        $id = (int) decrypt_url($encid);
        $this->db->select('q.*,office.office_name, department.name_en');
        $this->db->from('budget_chahida_potro as q');
        $this->db->join('office', 'q.office_id = office.id');
        $this->db->join('department', 'q.dept_id = department.id');
        $this->db->where('q.id', $id);
        $this->data['chahida_potro'] = $this->db->get()->row();

        $this->db->select('
                        q.*,
                        budget_head_sub.name_bn,
                        budget_head_sub.bd_code,
                        budget_head.name_bn as budget_head_name,
                        budget_head_sub.id as budget_head_sub_id
                        ');
        $this->db->from('budget_chahida_potro_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('q.chahida_potro_id', $id);
        $this->data['details'] = $this->db->get()->result();

        $this->data['info'] = $this->Common_model->get_user_details($this->data['chahida_potro']->created_by);

        $this->data['headding'] = 'চাহিদা পত্র';
        echo $html = $this->load->view('chahida_potro/print', $this->data, true);



    }
    public function budget_chahida_potro_edit($encid=null){
        if($encid == null){
            $id=$this->input->post('id');
        }else{
            $id = (int) decrypt_url($encid);
        }


        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            // dd($_POST);
            $form_data = array(
                'title' => $this->input->post('title'),
                'amount' => $this->input->post('total_amount'),
                'status' => 1,
                'description' => $this->input->post('description'),
            );
            if ($this->db->update('budget_chahida_potro', $form_data, array('id' => $id))) {
                $insert_id = $id;
                $this->db->delete('budget_chahida_potro_details', array('chahida_potro_id' => $insert_id));
                $user = $this->ion_auth->user($this->input->post('created_by'))->row();
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'chahida_potro_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'amount' => $_POST['amount'][$i],
                        'office_id' => $user->office_id,
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_chahida_potro_details', $form_data2);
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/chahida_potro");
            }
        }

        $this->db->select('
        budget_head_sub.id,
        budget_head_sub.bd_code,
         budget_head_sub.name_bn,
         budget_head.name_bn as budget_head_name,
         budget_head.id as budget_head_id
         ');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();





        $this->db->select('q.*,office.office_name, department.name_en');
        $this->db->from('budget_chahida_potro as q');
        $this->db->join('office', 'q.office_id = office.id');
        $this->db->join('department', 'q.dept_id = department.id');
        $this->db->where('q.id', $id);
        $this->data['chahida_potro'] = $this->db->get()->row();
        $this->db->select('
                        q.*,
                        budget_head_sub.name_bn,
                        budget_head_sub.bd_code,
                        budget_head.name_bn as budget_head_name,
                        budget_head.id as budget_head_id,
                        budget_head_sub.id as budget_head_sub_id
                        ');
        $this->db->from('budget_chahida_potro_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('q.chahida_potro_id', $id);
        $this->data['details'] = $this->db->get()->result();

        $this->data['info'] = $this->Common_model->get_user_details($this->data['chahida_potro']->created_by);

         //Load view
         $this->data['meta_title'] = 'চাহিদা পত্র তৈরি করুন';
         $this->data['subview'] = 'chahida_potro/edit';
         $this->load->view('backend/_layout_main', $this->data);

    }
    public function budget_chahida_potro_statement($encid=null){
        if($encid == null){
            $id=$this->input->post('id');
        }else{
            $id = (int) decrypt_url($encid);
        }


        $this->form_validation->set_rules('total_overall_expense', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {

            foreach ($this->input->post('chahida_potro_details_id') as $key => $value) {
                $form_data = array(
                    'chahida_potro_details_id' => $value,
                    'overall_expense' => $this->input->post('overall_expense')[$key],

                );
                $this->db->where('chahida_potro_details_id', $value);
                $pr=$this->db->get('budget_chahida_potro_expenses')->row();
                if(empty($pr)){
                    dd($pr);
                    $this->db->insert('budget_chahida_potro_expenses', $form_data);
                }else{
                    $this->db->update('budget_chahida_potro_expenses', $form_data, array('id' => $value));
                }
            }
            $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
            redirect("budgets/chahida_potro");

        }
        $this->db->select('q.*,office.office_name, department.name_en');
        $this->db->from('budget_chahida_potro as q');
        $this->db->join('office', 'q.office_id = office.id');
        $this->db->join('department', 'q.dept_id = department.id');
        $this->db->where('q.id', $id);
        $this->data['budget_field'] = $this->db->get()->row();

        $this->db->select('
                        q.*,
                        q.id as budget_chahida_potro_details_id,
                        budget_head_sub.name_bn,
                        budget_head_sub.bd_code,
                        budget_head.name_bn as budget_head_name,
                        budget_head_sub.id as budget_head_sub_id,
                        budget_chahida_potro_expenses.*
                        ');
        $this->db->from('budget_chahida_potro_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->join('budget_chahida_potro_expenses', 'q.id = budget_chahida_potro_expenses.chahida_potro_details_id', 'left');
        $this->db->where('q.chahida_potro_id', $id);
        $this->data['budget_field_details'] = $this->db->get()->result();

        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_field']->created_by);

         //Load view
         $this->data['meta_title'] = 'চাহিদা পত্র স্টেটমেন্ট তৈরি করুন';
         $this->data['subview'] = 'chahida_potro/statement';
         $this->load->view('backend/_layout_main', $this->data);


    }
    public function budget_chahida_potro_statement_print($encid=null){

            $id = (int) decrypt_url($encid);
        $this->db->select('q.*,office.office_name, department.name_en');
        $this->db->from('budget_chahida_potro as q');
        $this->db->join('office', 'q.office_id = office.id');
        $this->db->join('department', 'q.dept_id = department.id');
        $this->db->where('q.id', $id);
        $this->data['budget_field'] = $this->db->get()->row();

        $this->db->select('
                        q.*,
                        q.id as budget_chahida_potro_details_id,
                        budget_head_sub.name_bn,
                        budget_head_sub.bd_code,
                        budget_head.name_bn as budget_head_name,
                        budget_head_sub.id as budget_head_sub_id,
                        budget_chahida_potro_expenses.*
                        ');
        $this->db->from('budget_chahida_potro_details as q');
        $this->db->join('budget_head_sub', 'q.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->join('budget_chahida_potro_expenses', 'q.id = budget_chahida_potro_expenses.chahida_potro_details_id', 'left');
        $this->db->where('q.chahida_potro_id', $id);
        $this->data['budget_field_details'] = $this->db->get()->result();

        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_field']->created_by);

       echo $this->load->view('chahida_potro/statement_print', $this->data);


    }
}
