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

        $this->load->model('Common_model');
        $this->load->model('Budgets_model');
        $this->data['module_name'] = 'বাজেট';
        $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
        $userDetails = $this->data['userDetails'];
        // $this->data['module_title'] = 'Inventory';
    }

    public function budget_nilg($offset = 0)
    {
        $limit = 15;
        $results = $this->Budgets_model->get_budget($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_nilg/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = 'budget_nilg/index';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function budget_nilg_create()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
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

        $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
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

    public function budget_nilg_details($encid)
    {
        $id = (int) decrypt_url($encid);
        $budget_nilg = $this->Common_model->get_single_data('budget_nilg', $id);
        $this->data['budget_nilg'] = $budget_nilg;
        $this->db->select('budget_nilg_details.*,budget_nilg_details.id as budget_nilg_details_id,budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
        $this->db->from('budget_nilg_details');
        $this->db->join('budget_head_sub', 'budget_nilg_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_nilg_details.budget_nilg_id', $id);
        $this->db->where('budget_nilg_details.modify_soft_d', 1);
        $budget_nilg_details = $this->db->get()->result();
        $this->data['budget_nilg_details'] = $budget_nilg_details;
        $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
        $this->db->from('budget_head_sub');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_nilg']->created_by);

        $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        $this->data['subview'] = 'budget_nilg/details';
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

            if ($this->db->update('budget_nilg', $form_data)) {
                $insert_id = $this->input->post('budget_nilg_id');
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {
                    $form_data2 = array(
                        'budget_nilg_id' => $insert_id,
                        'head_id' => $_POST['head_id'][$i],
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'amount' => $_POST['amount'][$i],
                        'fcl_year' => $_POST['fcl_year'],
                        'created_by' => $user->id,
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
    public function add_new_row()
    {
      $id = $this->input->post('head_id');

      $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
      $this->db->from('budget_head_sub');
      $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
      $this->db->where('budget_head_sub.id', $id);
      echo json_encode($this->db->get()->row());
    }
    function ajax_get_budget_details_nilg(){
      $id = (int) decrypt_url($_POST['id']);
      $budget_nilg = $this->Common_model->get_single_data('budget_nilg', $id);
      $items = $this->Budgets_model->get_budget_details_nilg($id);
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
        $this->data['items'] = $this->Budgets_model->get_budget_details_nilg($id);
        // dd($this->data['info']);

        // Generate PDF
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }
    // End Budget Nilg

    // Manage Budget field list
    public function budget_field($offset = 0)
    {
        $limit = 15;
        $results = $this->Budgets_model->get_budget_field($limit, $offset);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('budget/budget_field/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'বাজেট এর তালিকা';
        $this->data['subview'] = '/budget_field/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function budget_field_create()
    {
        $user = $this->ion_auth->user()->row();
        if ($user->crrnt_dept_id == '') {
            $this->session->set_flashdata('error', 'Please update your profile first');
                redirect("budgets/budget_field");
        }

        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            // dd($_POST);
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
            if ($this->Common_model->save('budget_field', $form_data)) {
                $insert_id = $this->db->insert_id();
                for ($i = 0; $i < sizeof($_POST['head_id']); $i++) {

                    //     dept_id    created_by
                    $token = [];
                    foreach ($_POST['token-' . $_POST['head_sub_id'][$i]] as $key => $value) {
                        $token[$key] = [
                            'token' => $value,
                            'amount' => $_POST['token_amount-' . $_POST['head_sub_id'][$i]][$key],
                        ];
                    }
                    $form_data2 = array(
                        'budget_field_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'office_type' => $this->input->post('office_type'),
                        'type' => 1,
                        'token' => json_encode($token),
                        'amount' => '',
                        'days' => '',
                        'participants' => '',
                        'total_amt' => $_POST['amount'][$i],
                        'status' => 1,
                        'office_id' => $this->input->post('office_id'),
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_field_details', $form_data2);
                }
                $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
                redirect("budgets/budget_field");
            }

        }

        $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
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

    public function budget_field_details($encid)
    {
        $id = (int) decrypt_url($encid);
        $budget_field = $this->Common_model->get_single_data('budget_field', $id);
        $this->data['budget_field'] = $budget_field;
        $this->db->select('budget_field_details.*,budget_field_details.id as budget_field_details_id,budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
        $this->db->from('budget_field_details');
        $this->db->join('budget_head_sub', 'budget_field_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_field_details.budget_field_id', $id);
        $this->db->where('budget_field_details.modify_soft_d', 1);
        $budget_field_details = $this->db->get()->result();
        $this->data['budget_field_details'] = $budget_field_details;

        $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
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
                    $token = [];
                    foreach ($_POST['token-' . $_POST['head_sub_id'][$i]] as $key => $value) {
                        $token[$key] = [
                            'token' => $value,
                            'amount' => $_POST['token_amount-' . $_POST['head_sub_id'][$i]][$key],
                        ];
                    }
                    $form_data2 = array(
                        'budget_field_id' => $insert_id,
                        'head_sub_id' => $_POST['head_sub_id'][$i],
                        'office_type' => $this->input->post('office_type'),
                        'type' => 1,
                        'token' => json_encode($token),
                        'amount' => '',
                        'days' => '',
                        'participants' => '',
                        'total_amt' => $_POST['amount'][$i],
                        'status' => 1,
                        'office_id' => $this->input->post('office_id'),
                        'dept_id' => $user->crrnt_dept_id,
                        'created_by' => $user->id,
                    );
                    $this->Common_model->save('budget_field_details', $form_data2);
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
 // id	head_id budget_head table id	head_sub_id budget_head_sub table id	amount	status 1=in, 2=out	created_by	created_at	updated_at
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
        $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
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
    // Budget Entry part end

}
