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
        $user_id = $this->data['userDetails']->id;
        $dept_id = $this->data['userDetails']->crrnt_dept_id;
        if ($this->ion_auth->in_group(array('bdh'))) {
            $arr = array(2,3,4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, $dept_id);
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $arr = array(3,4,5,6,7,8);
            $results = $this->Budgets_model->get_budget($limit, $offset, $arr, null, null);
        } else if ($this->ion_auth->in_group(array('bdg'))) {
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
    public function add_new_row()
    {
      $id = $this->input->post('head_id');

      $this->db->select('
                budget_head_sub.id,
                budget_head_sub.name_bn,
                budget_head_sub.bd_code,
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
        $budget_nilg = $this->Common_model->get_single_data('budget_nilg', $id);
        $this->data['budget_nilg'] = $budget_nilg;

        $this->db->select('budget_nilg_details.*,
                    budget_nilg_details.id as budget_nilg_details_id,
                    budget_head_sub.id,
                    budget_head_sub.name_bn,
                    budget_head_sub.bd_code,
                    budget_head.name_bn as budget_head_name,
                    budget_head.id as budget_head_id
                ');
        $this->db->from('budget_nilg_details');
        $this->db->join('budget_head_sub', 'budget_nilg_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_nilg_details.budget_nilg_id', $id);
        $this->db->where('budget_nilg_details.modify_soft_d', 1);
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
        if ($this->ion_auth->in_group(array('bdh'))) {
            $this->data['subview'] = 'budget_nilg/details_dept_head';
        } else if ($this->ion_auth->in_group(array('acc')) &&  in_array($this->data['budget_nilg']->desk, array(5,6))) {
            $this->data['subview'] = 'budget_nilg/details_acc_final';
        } else if ($this->ion_auth->in_group(array('acc'))) {
            $this->data['subview'] = 'budget_nilg/details_acc';
        } else if ($this->ion_auth->in_group(array('bdg'))) {
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
            if ($this->input->post('submit')=='ফরওয়ার্ড করুন') {
                $user = $this->ion_auth->user()->row();
                $form_data = array(
                    'title' => $this->input->post('title'),
                    'amount' => $this->input->post('total_amount'),
                    'fcl_year' => $this->input->post('fcl_year'),
                     'status' => 2,
                    'desk' => 2,
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

            } else {
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
    }
    public function budget_nilg_dept_edit()
    {
        $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')=='ফরওয়ার্ড করুন') {
                    $user = $this->ion_auth->user()->row();
                    $form_data = array(
                        'title' => $this->input->post('title'),
                        'dpt_amt' => $this->input->post('total_amount'),
                        'status' => 3,
                        'dpt_head_id' =>$this->ion_auth->user()->row()->id,
                        'desk' => 3,
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
                            'dpt_amt' => $_POST['dpt_amt'][$i],
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
                    'dpt_amt' => $this->input->post('total_amount'),
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
                            'dpt_amt' => $_POST['dpt_amt'][$i],
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
        // dd($this->data['items']);

        // Generate PDF
        $this->data['headding'] = 'বাজেট';
        $html = $this->load->view('budget_nilg/budget_nilg_print', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
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


    public function nilg_revenue_summary()
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
        $this->db->join('budget_nilg as b', 'b.id = bd.budget_nilg_id');
        $this->db->join('budget_head_sub as bhs', 'bhs.id = bd.head_sub_id');

        if (!empty( $dept_id)) {
            $this->db->where('b.dept_id', $dept_id);
        }
        $this->db->where('b.fcl_year', $fcy->id);
        $this->db->where_in('b.status', array(3,4,5,6));
        $this->db->order_by('bd.head_sub_id','ASC')->group_by('bd.head_sub_id');

        $this->data['summary'] = $this->db->get()->result();
        $this->data['fcl'] = $fcy;

        $this->data['meta_title'] = 'বাজেট সামারী ';
        $html = $this->load->view('budget_nilg/nilg_revenue_summary', $this->data, true);

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
                $this->generator_qrcode($insert_id, $this->input->post('office_type'));

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

        $this->db->select('budget_head_sub.id,budget_head_sub.bd_code, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
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
        $this->db->select('budget_field_details.*,budget_field_details.id as budget_field_details_id,budget_head_sub.bd_code,budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
        $this->db->from('budget_field_details');
        $this->db->join('budget_head_sub', 'budget_field_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_field_details.budget_field_id', $id);
        $this->db->where('budget_field_details.modify_soft_d', 1);
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
    public function budget_field_print($encid)
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
        $budget_field_details = $this->db->get()->result();
        $this->data['budget_field_details'] = $budget_field_details;

        // $this->db->select('budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name');
        // $this->db->from('budget_head_sub');
        // $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        // $this->data['budget_head_sub'] = $this->db->get()->result();
        //Dropdown
        // $this->data['budget_head'] = $this->Common_model->get_dropdown('budget_head', 'name_bn', 'id');
        $this->data['info'] = $this->Common_model->get_user_details($this->data['budget_field']->created_by);
        $this->data['headding'] = 'বাজেট';
       echo $html = $this->load->view('budget_field/print', $this->data, true);
        // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        // $mpdf->WriteHtml($html);
        // $mpdf->output();
        // $this->data['meta_title'] = 'বাজেট বিস্তারিত';
        // $this->data['subview'] = 'budget_field/details';
        // $this->load->view('backend/_layout_main', $this->data);
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




}

