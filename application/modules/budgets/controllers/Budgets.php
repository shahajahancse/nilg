<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budgets extends Backend_Controller {

	public function __construct(){
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

  public function budget_nilg($offset=0){
      $limit = 15;
      $results = $this->Budgets_model->get_budget($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('budget/budget_nilg/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'বাজেট এর তালিকা';
      $this->data['subview'] = '/budget_nilg/index';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function budget_nilg_create()
  {
    $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
    if ($this->form_validation->run() == true){
      $user = $this->ion_auth->user()->row();
      $form_data = array(
        'title'   => $this->input->post('title'),
        'amount'   => $this->input->post('total_amount'),
        'fcl_year'   => $this->input->post('fcl_year'),
        'description'   => $this->input->post('description'),
        'created_by'   => $user->id
      );
      if($this->Common_model->save('budget_nilg', $form_data)){     
        $insert_id = $this->db->insert_id();
        for ($i=0; $i<sizeof($_POST['head_id']); $i++) { 
           $form_data2 = array(
              'budget_nilg_id'     => $insert_id,
              'head_id'       => $_POST['head_id'][$i],
              'head_sub_id'       => $_POST['head_sub_id'][$i],
              'amount'       => $_POST['amount'][$i],
              'fcl_year'       => $_POST['fcl_year'],
              'created_by'   => $user->id
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
    $this->data['subview'] = 'budget_nilg/create';
    $this->load->view('backend/_layout_main', $this->data);
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
  public function budget_nilg_details($encid){
    $id = (int) decrypt_url($encid);
    $budget_nilg = $this->Common_model->get_single_data('budget_nilg', $id);
    $this->data['budget_nilg'] = $budget_nilg;
    $this->db->select('budget_nilg_details.*,budget_head_sub.id, budget_head_sub.name_bn,budget_head.name_bn as budget_head_name,budget_head.id as budget_head_id');
    $this->db->from('budget_nilg_details');
    $this->db->join('budget_head_sub', 'budget_nilg_details.head_sub_id = budget_head_sub.id');

    $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
    $this->db->where('budget_nilg_details.budget_nilg_id', $id);
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
  public function budget_nilg_edit(){
//     dd($this->input->post());
//     Array
// (
//     [budget_nilg_id] => 1
//     [title] => test titlewewer
//     [fcl_year] => 5
//     [head] => 1
//     [total_amount] => 179
//     [head_id] => Array
//         (
//             [0] => 2
//             [1] => 2
//         )

//     [head_sub_id] => Array
//         (
//             [0] => 1
//             [1] => 1
//         )

//     [amount] => Array
//         (
//             [0] => 89.00
//             [1] => 90.00
//         )

//     [description] => 
// sdfgsdgsgdsg

// sa
// gh

//     [submit] => সংরক্ষণ করুন
// )
  $this->form_validation->set_rules('title', 'বাজেট নাম', 'required|trim');
    if ($this->form_validation->run() == true){
      $user = $this->ion_auth->user()->row();
      $form_data = array(
        'title'   => $this->input->post('title'),
        'amount'   => $this->input->post('total_amount'),
        'fcl_year'   => $this->input->post('fcl_year'),
        'description'   => $this->input->post('description'),
      );
      $this->db->where('id', $this->input->post('budget_nilg_id'));
      
      if($this->db->update('budget_nilg', $form_data)){
        
        $insert_id = $this->input->post('budget_nilg_id');
        $this->db->where('budget_nilg_id', $insert_id);
        $this->db->delete('budget_nilg_details');
        for ($i=0; $i<sizeof($_POST['head_id']); $i++) { 
          $form_data2 = array(
              'budget_nilg_id'     => $insert_id,
              'head_id'       => $_POST['head_id'][$i],
              'head_sub_id'       => $_POST['head_sub_id'][$i],
              'amount'       => $_POST['amount'][$i],
              'fcl_year'       => $_POST['fcl_year'],
              'created_by'   => $user->id
              );
          $this->Common_model->save('budget_nilg_details', $form_data2);
        }
        $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
        redirect("budgets/budget_nilg");
      }else{
        $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়নি');
        redirect("budgets/budget_nilg");
      }

    }
    
  }

}