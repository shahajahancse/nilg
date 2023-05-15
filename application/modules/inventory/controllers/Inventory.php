<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends Backend_Controller {

	public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
          redirect('login');
      endif;

      $this->load->model('Common_model');
      $this->load->model('inventory_model');
      $this->data['module_name'] = 'ইনভেন্টরি';
      $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
      $userDetails = $this->data['userDetails'];
      // $this->data['module_title'] = 'Inventory';
  }

  public function index($offset=0){
      $limit = 15;
      $results = $this->inventory_model->get_requisition($limit, $offset); 
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
        'current_desk'     => 1,
        'created'   => date('Y-m-d H:i:s'),
        'updated'   => date('Y-m-d H:i:s')
      );

      // print_r($form_data); exit;
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

  public function pending_list($offset=0){
      $limit = 25;
      $results = $this->inventory_model->get_requisition($limit, $offset, '1'); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/pending_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'পেন্ডিং রিকুইজিশন তালিকা';
      $this->data['subview'] = 'pending_list';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function requisition_details($id)
  {
    $dataID = (int) decrypt_url($id); //exit;
    if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
       show_404('inventory - details - exitsts', TRUE);
    }

    $this->data['info'] = $this->inventory_model->get_requisition_by_id($dataID);
    $this->data['items'] = $this->inventory_model->get_requisition_items($dataID); 

    // Load page
    $this->data['meta_title'] = 'রিকুইজিশন বর্ণনা';
    $this->data['subview'] = 'requisition_details';
    $this->load->view('backend/_layout_main', $this->data);
  }


  public function again_requisition_create($item_id = null){
    if ($item_id) {
       $item_id = (int) decrypt_url($item_id);
    } else {
      $item_id;
    }
    // dd($item_id);
    $results = $this->inventory_model->get_unavailable_items(null, null, $item_id, 3);
    $this->data['row'] = $results['row'];

    if (isset($_POST['submit']) && $_POST['submit'] == "সংরক্ষন করুন") {
      //  old data delete
      $form_data = array(
         'user_id'   => null,
         'is_delete' => 1,
      );
      $this->Common_model->edit('requisition_item',  $item_id, 'id', $form_data);

      // new data insert
      $user = $this->ion_auth->user()->row();
      $form_data = array(
        'user_id'   => $user->id,
        'department_id' => ($user->crrnt_dept_id !== null)?$user->crrnt_dept_id:0, 
        'designation_id' => ($user->crrnt_desig_id !== null)?$user->crrnt_desig_id:0,
        'f_year_id'   => 0,
        'current_desk'     => 1,
        'created'   => date('Y-m-d H:i:s'),
        'updated'   => date('Y-m-d H:i:s')
      );

      // print_r($form_data); exit;
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

    // Load view
    $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
    // dd($this->data['categories']);
    $this->data['info'] = $this->Common_model->get_user_details();
    $this->data['meta_title'] = 'রিকুইজিশন এন্ট্রি করুন';
    $this->data['subview'] = 'again_requisition_create';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function again_requisition($id)
  {
    $limit = 15;
    $dataID = (int) decrypt_url($id); //exit;
    if (!$this->Common_model->exists('requisition_item', 'id', $dataID)) { 
       show_404('inventory - details - exitsts', TRUE);
    }
    // check item & user info
    $results = $this->inventory_model->get_unavailable_items($limit, null, $dataID); 
    $this->data['info'] = $this->inventory_model->get_requisition_by_id($results['row']->requisition_id);

    //Validation
    $this->form_validation->set_rules('user_id', 'User id', 'required|trim');
    $this->form_validation->set_rules('submit', 'Submit', 'required|trim');

    if ($this->form_validation->run() == true){
      $form_data = array(
        'user_id'      => $this->data['info']->user_id,
        'comments'     => $this->input->post('comments'),
        'is_delete'    => 3,
      );           

       // message
       if($this->Common_model->edit('requisition_item', $dataID, 'id', $form_data)){
          $this->session->set_flashdata('success', 'তথ্যটি সফলভাবে ডাটাবেসে সংরক্ষণ করা হয়েছে.');
          redirect('inventory');
       }
    }

    // Load page
    $this->data['item'] = $results['row'];
    $this->data['meta_title'] = 'পুনরায় রিকুইজিশন করুণ';
    $this->data['subview'] = 'again_requisition';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function again_requisition_list($user_id = null){
      $limit = 25;
      if ($user_id) {
         $user_id = (int) decrypt_url($user_id);
      } else {
        $user_id;
      }

      $results = $this->inventory_model->again_requisition_list($user_id, 3);
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'পুনরায় রিকুইজিশন তালিকা';
      $this->data['subview'] = 'again_requisition_list';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function change_requisition_status($id)
  {
      $this->load->model('Common_model');
      $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
      $userDetails = $this->data['userDetails'];

      if(!(func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'sk')){
          redirect('dashboard');
      }

      // $dataID = $id; //exit;
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
        show_404('inventory - update - exitsts', TRUE);
      }

      $this->data['info'] = $this->inventory_model->get_requisition_by_id($dataID);
      //Validation      
      $this->form_validation->set_rules('status', ' status','required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){

          if($this->input->post('status') == 2){
              $this->load->helper('string');
              $pinCode = random_string('alnum',5);
              $form_data = array(
                 'approve_reject_user' => $this->userSessID,
                 'current_desk'       => 2,
                 'status'       => 2,
                 'pin_code'     => $pinCode,
                 'updated'      => date('Y-m-d H:i:s')
              );

              // Send Mail
              /*$q = $this->db->select('id, email')->where('id', $this->data['info']->user_id)->get('users');
              if($q->num_rows() > 0){
                 $email = $q->row()->email;          
                 if($email != ''){
                    // Send Mail
                    $message = 'Hello, <br><br>Your requisition item(s) has been approved/processed. Please do the needful to collect your items. Please authorised the delivery with the confirmation code sent your email.<br><br><br>Your secrate PIN code is : '.$pinCode.'<br><br>Remember your secrate pin code and get your products. <br><br><br>';
                    $this->email->clear();
                    $this->email->from('testingemail9400@gmail.com', 'NILG Inventory');
                    $this->email->to($email);
                    $this->email->subject('NILG - Requisition PIN Code');
                    $this->email->message($message);
                    $this->email->send();
                 }
              }*/
          }else{
              $form_data = array(
                 'approve_reject_user' => $this->userSessID,
                 'status'    => 3,
                 'updated'   => date('Y-m-d H:i:s')
              );
          }

          // print_r($form_data); exit;
          if($this->Common_model->edit('requisitions',  $dataID, 'id', $form_data)){

              // Requisition Data 
              for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
                 //check exists data
                 @$data_exists = $this->Common_model->exists('requisition_item', 'id', $_POST['hide_id'][$i]);
                 if($data_exists){
                    $data = array(
                       'sm_qty_approve'  => $_POST['qty_approve'][$i]
                       ); 
                    $this->Common_model->edit('requisition_item', $_POST['hide_id'][$i], 'id', $data);
                 }
              }

              $this->session->set_flashdata('success', 'Update information successfully.');
              redirect("inventory");
          }
      }

      //Dropdown
      $this->data['status'] = $this->inventory_model->get_requisition_status(); 
      //Results
      $this->data['items'] = $this->inventory_model->get_requisition_items($dataID);  

      //Load view
      $this->data['meta_title'] = 'অ্যাপ্রভ স্ট্যাটাস';
      $this->data['subview'] = 'change_requisition_status';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function request_requisition_list($offset=0){
      $this->load->model('Common_model');
      $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
      $userDetails = $this->data['userDetails'];

      $status = 0;
      $desk = 0;
      $limit = 25;
      $results = array();

      if (func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'jd') {
          $status = 2;
          $desk = 2;
      } else if (func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'dg') {
          $status = 2;
          $desk = 3;
      } else {
          redirect('dashboard');
      }
      
      $results = $this->inventory_model->request_requisition_list($limit, $offset, $status, $desk); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/request_requisition_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'রিকুয়েস্ট রিকুইজিশন তালিকা';
      $this->data['subview'] = 'request_requisition_list';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function verify_requisition_status($id)
  {
      $this->load->model('Common_model');
      $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
      $userDetails = $this->data['userDetails'];

      if (func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'jd') {
          $status = 2;
          $desk = 2;
      } else if (func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'dg') {
          $status = 2;
          $desk = 3;
      } else {
          redirect('dashboard');
      }

      // $dataID = $id; //exit;
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
        show_404('inventory - update - exitsts', TRUE);
      }

      $this->data['info'] = $this->inventory_model->get_requisition_by_id($dataID);
      //Validation      
      $this->form_validation->set_rules('status', ' status','required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
          if ($this->input->post('status') == 2 && func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'jd') {
              $current_desk = 3;
              $status = 2;
          } else if ($this->input->post('status') == 2 && func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'dg') {
              $current_desk = 4;
              $status = 4;
          }

          if($this->input->post('status') == 2){
              $form_data = array(
                 'approve_reject_user' => $this->userSessID,
                 'current_desk'       => $current_desk,
                 'status'       => $status,
                 'updated'      => date('Y-m-d H:i:s')
              );
          }else{
              $form_data = array(
                 'approve_reject_user' => $this->userSessID,
                 'status'    => 3,
                 'updated'   => date('Y-m-d H:i:s')
              );
          }

          // print_r($form_data); exit;
          if($this->Common_model->edit('requisitions',  $dataID, 'id', $form_data)){

              // Requisition Data 
              if (func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'jd') {
                for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
                   //check exists data
                   @$data_exists = $this->Common_model->exists('requisition_item', 'id', $_POST['hide_id'][$i]);
                   if($data_exists){
                      $data = array(
                         'jd_qty_approve'     => $_POST['qty_approve'][$i]
                         ); 
                      $this->Common_model->edit('requisition_item', $_POST['hide_id'][$i], 'id', $data);
                   }
                }
              } else {
                for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
                   //check exists data
                   @$data_exists = $this->Common_model->exists('requisition_item', 'id', $_POST['hide_id'][$i]);
                   if($data_exists){
                      $data = array(
                         'qty_approve'     => $_POST['qty_approve'][$i]
                         ); 
                      $this->Common_model->edit('requisition_item', $_POST['hide_id'][$i], 'id', $data);
                   }
                }
              }

              $this->session->set_flashdata('success', 'Update information successfully.');
              redirect("inventory/request_requisition_list");
          }
      }

      //Dropdown
      // $this->data['status'] = $this->inventory_model->get_requisition_status(); 
      //Results
      $this->data['items'] = $this->inventory_model->get_requisition_items($dataID);  

      //Load view
      $this->data['meta_title'] = 'Approval Status';
      $this->data['subview'] = 'verify_requisition_status';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function approve_list($offset=0){
      $limit = 25;
      $results = $this->inventory_model->get_requisition($limit, $offset, '4'); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/approve_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      // $this->data['meta_title'] = 'Approved Requisition List';
      $this->data['meta_title'] = 'অ্যাপ্রোভ রিকুইজিশন তালিকা';
      $this->data['subview'] = 'approve_list';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function delivery_product($id){
    $this->load->model('Common_model');
    $this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
    $userDetails = $this->data['userDetails'];
    if(!(func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'sk')){
       redirect('dashboard');
    }

    // $dataID = $id; //exit;
    $dataID = (int) decrypt_url($id); //exit;
    if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
       show_404('inventory - delivery_product - exitsts', TRUE);
    }

    $this->data['info'] = $this->inventory_model->get_requisition_by_id($dataID);


    $this->form_validation->set_rules('comment', ' Comments','required|trim');

    //Validate and input data
    if ($this->form_validation->run() == true){
        $form_data = array(
            'status' => 5,
            'comment' => $this->input->post('comment'),
            'is_delivered' => 1,
            'updated'   => date('Y-m-d H:i:s')
        );

        // print_r($form_data); exit;
        if($this->Common_model->edit('requisitions',  $dataID, 'id', $form_data)){

            $items = $this->inventory_model->get_requisition_items($dataID);  
            foreach($items as $item){          
               $this->db->query("UPDATE items SET quantity = quantity - $item->qty_approve where id =$item->item_id");
            }

            $this->session->set_flashdata('success', 'Product delivery successfully.');
            redirect("inventory/delivered_list");
        }
    }


    //Results
    $this->data['items'] = $this->inventory_model->get_requisition_items($dataID);
    
    //Load view
    $this->data['meta_title'] = 'ডেলিভেরি আইটেম';
    $this->data['subview'] = 'delivery_product';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function delivered_list($offset=0){
    $limit = 25;
    $results = $this->inventory_model->get_requisition($limit, $offset, 5); 
    $this->data['results'] = $results['rows'];
    $this->data['total_rows'] = $results['num_rows'];

    //pagination
    $this->data['pagination'] = create_pagination('inventory/delivered_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

    // Load view
    $this->data['meta_title'] = 'ডেলিভারড তালিকা';
    $this->data['subview'] = 'delivered_list';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function rejected_list($offset=0){
      $limit = 25;
      $results = $this->inventory_model->get_requisition($limit, $offset, '3'); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/rejected_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'রিজেক্ট তালিকা';
      $this->data['subview'] = 'rejected_list';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function unavailable_list($offset=0){
      $limit = 25;
      $results = $this->inventory_model->get_unavailable_items($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/unavailable_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'আন-অ্যাভেলেবল রিকুইজিশন তালিকা';
      $this->data['subview'] = 'unavailable_list';
      $this->load->view('backend/_layout_main', $this->data);
  }

  public function item_setup($offset = 0)
  {
    $limit = 10;
    $results = $this->inventory_model->get_items($limit, $offset);
    $this->data['results'] = $results['rows'];
    $this->data['total_rows'] = $results['num_rows'];

    //pagination
    $this->data['pagination'] = create_pagination('inventory/item_setup/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);


    $this->data['meta_title'] = 'আইটেম তালিকা';
    $this->data['subview'] = 'item_setup';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function item_create(){
    //Validation
    $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
    $this->form_validation->set_rules('sub_cate_id', 'select sub category', 'required|trim');
    $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
    $this->form_validation->set_rules('item_name', 'item name', 'required|trim');

    //Validate and input data
    if ($this->form_validation->run() == true){
       $form_data = array(
          'cat_id'        => $this->input->post('cat_id'),
          'sub_cate_id'   => $this->input->post('sub_cate_id'),
          'unit_id'       => $this->input->post('unit_id'),
          'item_name'     => $this->input->post('item_name'),
          'quantity'      => $this->input->post('quantity'),
          'order_level'   => $this->input->post('order_level')
          );           

       if($this->Common_model->save('items', $form_data)){
          $this->session->set_flashdata('success', 'Item create successfully.');
          redirect('inventory/item_setup');
       }
    }

    //Dropdown
    $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
    $this->data['units'] = $this->Common_model->get_dropdown('item_unit', 'unit_name', 'id');

    // Load page
    $this->data['meta_title'] = 'আইটেম এন্ট্রি';
    $this->data['subview'] = 'item_create';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function item_edit($id){
    $dataID = (int) decrypt_url($id); //exit;
    if (!$this->Common_model->exists('items', 'id', $dataID)) { 
       show_404('items - edit - exitsts', TRUE);
    }

    //Validation
    $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
    $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
    $this->form_validation->set_rules('sub_cate_id', 'select sub category', 'required|trim');    
    $this->form_validation->set_rules('item_name', 'item name', 'required|trim');
    $this->form_validation->set_rules('status', 'Status', 'required|trim');

    if ($this->form_validation->run() == true){
       $form_data = array(
          'cat_id'      => $this->input->post('cat_id'),
          'sub_cate_id'   => $this->input->post('sub_cate_id'),
          'unit_id'     => $this->input->post('unit_id'),
          'item_name'   => $this->input->post('item_name'),
          'quantity'    => $this->input->post('quantity'),
          'order_level' => $this->input->post('order_level'),
          'status'      => $this->input->post('status')
          );           

       // print_r($form_data); exit;
       if($this->Common_model->edit('items', $dataID, 'id', $form_data)){
          $this->session->set_flashdata('success', 'Informatioin update successfully.');
          redirect('inventory/item_setup');
       }
    }

    //Dropdown
    $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
    $this->data['sub_categories'] = $this->Common_model->get_dropdown('sub_categories', 'sub_cate_name', 'id');
    $this->data['units'] = $this->Common_model->get_dropdown('item_unit', 'unit_name', 'id');

    $this->data['info'] = $this->Common_model->get_info('items', $dataID);

    // Load page
    $this->data['meta_title'] = 'আইটেম এডিট';
    $this->data['subview'] = 'item_edit';
    $this->load->view('backend/_layout_main', $this->data);
  }

  function item_delete($id) {
    if(!$this->ion_auth->is_admin()){
       redirect('dashboard');
    }
    $this->data['info'] = $this->inventory_model->hard_delete('items',$id);

    $this->session->set_flashdata('success', 'Item delete successfully.');
    redirect('inventory/item_setup');     
  }

    public function item_purchase_list($offset=0)
    {
      $limit = 25;

      //Results
      $results = $this->inventory_model->get_purchase($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/item_purchase_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'পার্সেস তালিকা';
      $this->data['subview'] = 'purchase_list';
      $this->load->view('backend/_layout_main', $this->data);
    }    

    public function item_purchase_create()
    {
        //Validation
        $this->form_validation->set_rules('title', 'title','required|trim|max_length[255]');

        //Validate and input data
        if ($this->form_validation->run() == true){
            $user = $this->ion_auth->user()->row();

            $form_data = array(
                'user_id'         => $user->id,            
                'supplier_name'   => $this->input->post('title'),
                'f_year_id'       => 0,
                'created'         => date('Y-m-d H:i:s')
            );

            if($this->Common_model->save('purchase', $form_data)){     

                // Schedule Type Appointment
                $insert_id = $this->db->insert_id();
                // Insert Scout Unit under a group

                for ($i=0; $i<sizeof($_POST['pur_item_id']); $i++) { 
                    $form_data2 = array(
                        'purchase_id'        => $insert_id,
                        'pur_item_id'        => $_POST['pur_item_id'][$i],
                        'pur_quantity'       => $_POST['pur_quantity'][$i],                             
                        'pur_fiscal_year_id' => 0,
                        'pur_remark'         => $_POST['pur_remark'][$i]
                    );
                    $this->Common_model->save('purchase_item', $form_data2);

                    $pur_item = $_POST['pur_item_id'][$i];
                    $pur_quantity = $_POST['pur_quantity'][$i];

                    $this->db->query("UPDATE items SET quantity = quantity + $pur_quantity where id = $pur_item");
                }

                $this->session->set_flashdata('success', 'Purchase Create successfully.');
                redirect("inventory/item_purchase_list");
            }
        } 


        //Dropdown
        $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
        $this->data['info'] = $this->ion_auth->user()->row();

        //Load view
        $this->data['meta_title'] = 'আইটেম পার্সেস';
        $this->data['subview'] = 'item_purchase_create';
        $this->load->view('backend/_layout_main', $this->data);
    } 

    public function purchase_details($id)
    {
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('purchase', 'id', $dataID)) { 
         show_404('Purchase - details - exitsts', TRUE);
      }      

      //Results
      $this->data['info'] = $this->inventory_model->get_purchase_info($dataID);
      $this->data['items'] = $this->inventory_model->get_purchase_items($dataID); 

      // Load page
      $this->data['meta_title'] = 'আইটেম পার্সেস বিস্তারিত';
      $this->data['subview'] = 'purchase_details';
      $this->load->view('backend/_layout_main', $this->data); 
    }

    public function my_requisition($offset=0)
    {
      $limit = 25;

      //Results
      $results = $this->inventory_model->get_my_requisition($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('inventory/my_requisition/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'রিকুইজিশন তালিকা';
      $this->data['subview'] = 'my_requisition';
      $this->load->view('backend/_layout_main', $this->data);      
    }


    public function my_requisition_create(){

        //Validate and input data
        // echo "<pre>"; print_r($_POST); exit;
         if (isset($_POST['save']) && $_POST['save'] == "সংরক্ষণ করুন") {
            $user = $this->ion_auth->user()->row();
           
            $form_data = array(
                'user_id'   => $user->id,
                'department_id' => $user->crrnt_dept_id, 
                'designation_id' => $user->crrnt_desig_id, 
                // 'title'     => $this->input->post('title'),
                'current_desk'     => 1,
                'created'   => date('Y-m-d H:i:s'),
                'updated'   => date('Y-m-d H:i:s')
            );


            if($this->Common_model->save('requisitions', $form_data)){     
                $insert_id = $this->db->insert_id();
                   // Insert Scout Unit under a group

                for ($i=0; $i<sizeof($_POST['item_id']); $i++) { 
                   $form_data2 = array(
                      'requisition_id'     => $insert_id,
                      'item_cate_id'       => $_POST['item_cate_id'][$i],
                      'item_sub_cate_id'   => $_POST['item_sub_cate_id'][$i],
                      'item_id'            => $_POST['item_id'][$i],
                      'dept_id'            => $user->crrnt_dept_id,
                      'qty_request'        => $_POST['qty_request'][$i],           
                      'remark'             => $_POST['remark'][$i]
                      );
                   $this->Common_model->save('requisition_item', $form_data2);
                }

                $this->session->set_flashdata('success', 'তথ্যটি সংরক্ষণ করা হয়েছে.');
                redirect("inventory/my_requisition");
            }
        }

        //Dropdown
        $this->data['categories'] = $this->Common_model->get_dropdown('categories', 'category_name', 'id');
        $this->data['info'] = $this->Common_model->get_user_details();

        //Load view
        $this->data['meta_title'] = 'রিকুইজিশন যুক্ত করুন';
        $this->data['subview'] = 'my_requisition_create';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function my_requisition_details($id)
    {
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
         show_404('inventory/my_requisition - details - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->inventory_model->get_requisition_by_id($dataID);
      $this->data['items'] = $this->inventory_model->get_requisition_items($dataID);

      // Load page
      $this->data['meta_title'] = 'রিকুইজিশন বর্ণনা';
      $this->data['subview'] = 'my_requisition_details';
      $this->load->view('backend/_layout_main', $this->data);
    }


    public function my_requisition_print($id)
    {
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
         show_404('inventory/my_requisition - details - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->inventory_model->get_requisition_by_id($dataID);
      $this->data['items'] = $this->inventory_model->get_requisition_items($dataID);
      // 83=মহাপরিচালক (অতিরিক্ত সচিব), 91=যুগ্ম-পরিচালক (প্রশিক্ষণ ও পরামর্শ), 106  store kipper
      $this->data['dg'] = $this->Common_model->get_signature_by_designation(83);
      $this->data['jd'] = $this->Common_model->get_signature_by_designation(91);
      $this->data['sk'] = $this->Common_model->get_signature_by_designation(106);
      // dd($this->data['info']);

      // Generate PDF
      $this->data['headding'] = 'চাহিদা পত্র';
      $html = $this->load->view('my_requisition_print', $this->data, true);

      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
    }

    function ajax_get_sub_category_by_category($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->inventory_model->get_sub_category_by_cate_id($id)));
    }

    function ajax_get_item_by_sub_category($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->inventory_model->get_items_by_sub_cate_id($id)));
    }

  public function delete_requisition_item()
  {
    $id = $this->input->post('id');
    $data = array(
     'is_delete'     => $this->input->post('type'),
    ); 
    if ($this->Common_model->edit('requisition_item', $id, 'id', $data)) {
      echo true;
    } else {
      echo false;
    }
  }

  //========= Inventory system report here  =============//
  public function inventory_reports(){
    // Input Data
    $btn_submit = $this->input->post('btnsubmit');

    if( $btn_submit == 'item_report') {
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');        

        // Results
        $this->data['results'] = $this->inventory_model->get_items();
        // echo "<pre>"; print_r($this->data['results']); 
        // exit($btn_submit);

        // Generate PDF
        $this->data['headding'] = 'আইটেম রিপোর্ট';
        $html = $this->load->view('pdf_item_report', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();

    }else if( $btn_submit == 'request_requisition') {
        $this->data['dis_type'] = $this->input->post('dis_type');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('dpt'=>$this->data['dis_type'], 'status' => 1, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->inventory_model->get_requisition_report($arrayInput);

        // Generate PDF
        $this->data['headding'] = 'পেন্ডিং রিপোর্ট';
        $html = $this->load->view('pdf_inventory_report', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();

    }else if( $btn_submit == 'approve_requisition') {
        $this->data['dis_type'] = $this->input->post('dis_type');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('dpt'=>$this->data['dis_type'], 'status' => 4, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->inventory_model->get_requisition_report($arrayInput);

        // Generate PDF
        $this->data['headding'] = 'অ্যাপ্রোভ রিপোর্ট';
        $html = $this->load->view('pdf_inventory_report', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();

    }else if( $btn_submit == 'rejected_requisition') {
        $this->data['dis_type'] = $this->input->post('dis_type');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('dpt'=>$this->data['dis_type'], 'status' => 3, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->inventory_model->get_requisition_report($arrayInput);

        // Generate PDF
        $this->data['headding'] = 'রিজেক্ট রিপোর্ট';
        $html = $this->load->view('pdf_inventory_report', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();

    }else if( $btn_submit == 'delivered_requisition') {
        $this->data['dis_type'] = $this->input->post('dis_type');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('dpt'=>$this->data['dis_type'], 'status' => 5, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->inventory_model->get_requisition_report($arrayInput);

        // Generate PDF
        $this->data['headding'] = 'ডেলিভেরি রিপোর্ট';
        $html = $this->load->view('pdf_inventory_report', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();

    }else if( $btn_submit == 'low_inventory') {
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        // Results
        $this->data['results'] = $this->inventory_model->get_low_inventory_items();

        // Generate PDF
        $this->data['headding'] = 'লো-ইনভেন্টরি আইটেম রিপোর্ট';
        $html = $this->load->view('pdf_low_inventory_item', $this->data, true);

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
    }


    //Dropdown
    $this->data['users'] = $this->inventory_model->get_department();
    // echo "<pre>"; print_r($this->data['users']);exit;
    // Load View 
    $this->data['meta_title'] = 'ইনভেন্টরি রিপোর্ট';
    $this->data['subview'] = 'inventory_reports';
    $this->load->view('backend/_layout_main', $this->data);
  }  

  public function ajax_requisition_del($id)
  {
    $form_data = array(
       'user_id'   => null,
       'is_delete' => 1,
    );
    $this->Common_model->edit('requisition_item',  $id, 'id', $form_data);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
  } 

}