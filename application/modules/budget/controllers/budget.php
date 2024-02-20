<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends Backend_Controller {

	public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
          redirect('login');
      endif;

      $this->load->model('Common_model');
      $this->load->model('Budget_model');
      $this->data['module_name'] = 'বাজেট';
      $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
      $userDetails = $this->data['userDetails'];
      // $this->data['module_title'] = 'Inventory';
  }

  public function budget_list($offset=0){
      $limit = 15;
      $results = $this->budget_model->get_budget($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'রিকুইজিশনের তালিকা';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function requisition_create()
  {
    if (isset($_POST['submit']) && $_POST['submit'] == "Submit") {
      $user = $this->ion_auth->user()->row();

      $form_data = array(
        'user_id'   => $user->id,
        'department_id' => ($user->crrnt_dept_id !== null)?$user->crrnt_dept_id:0, 
        'designation_id' => ($user->crrnt_desig_id !== null)?$user->crrnt_desig_id:0,
        'f_year_id'   => 0,
        // 'current_desk'     => 1,
        'created'   => date('Y-m-d H:i:s'),
        'updated'   => date('Y-m-d H:i:s')
      );

      // dd($form_data); 
      if($this->Common_model->save('requisitions', $form_data)){     
        // Schedule Type Appointment
        $insert_id = $this->db->insert_id();
        // Insert Scout Unit under a group

        for ($i=0; $i<sizeof($_POST['item_id']); $i++) { 
           $form_data2 = array(
              'requisition_id'     => $insert_id,
              'item_cate_id'       => $_POST['item_cate_id'][$i],
              'item_sub_cate_id'   => $_POST['item_sub_cate_id'][$i],
              'item_id'            => $_POST['item_id'][$i],
              'dept_id'            => ($user->crrnt_dept_id !== null)?$user->crrnt_dept_id:0,
              'fiscal_year_id'     => 0,
              'qty_request'        => $_POST['qty_request'][$i],           
              'remark'             => $_POST['remark'][$i]
              );
           $this->Common_model->save('requisition_item', $form_data2);
        }

        $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
        redirect("inventory/index");
      }
    }

    //Dropdown
    $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
    $this->data['info'] = $this->Common_model->get_user_details();

    //Load view
    $this->data['meta_title'] = 'রিকুইজিশন এন্ট্রি করুন';
    $this->data['subview'] = 'requisition_create';
    $this->load->view('backend/_layout_main', $this->data);
  }

}