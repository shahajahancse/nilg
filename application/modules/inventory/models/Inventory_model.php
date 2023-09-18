<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


  public function get_requisition($limit=1000, $offset=0, $status=NULL, $user_id = null) {
      $this->db->select('r.*, u.name_bn, dp.dept_name, dg.desig_name');
      $this->db->from('requisitions r');
      $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
      $this->db->join('department dp', 'dp.id = u.crrnt_dept_id', 'LEFT');
      $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
      // $this->db->where('r.status !=', 6);
      if($status){
          $this->db->where('r.status', $status);
      }

      if($user_id != null){
          $this->db->where('r.user_id', $user_id);
      }
      if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
        $start_time = $_GET['start_date'];
        $end_time = $_GET['end_date'];
        $this->db->where("r.updated BETWEEN '$start_time' and '$end_time'");
      }

      $this->db->limit($limit, $offset);
      $this->db->order_by('r.id', 'DESC');
      $query = $this->db->get()->result();
      $result['rows'] = $query;
      // dd($query);

      // count query
      $q = $this->db->select('COUNT(*) as count');
      $this->db->from('requisitions'); 
      if($status){
          $this->db->where('status', $status);
      }      
      if($user_id != null){
          $this->db->where('user_id', $user_id);
      }      
      if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
        $start_time = $_GET['start_date'];
        $end_time = $_GET['end_date'];
        $this->db->where("updated BETWEEN '$start_time' and '$end_time'");
      }
      $query = $this->db->get()->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;
      
      return $result;
  }

  public function request_requisition_list($limit=1000, $offset=0, $status=NULL, $desk = NULL) {
      $this->db->select('r.*, u.name_bn, dp.dept_name, dg.desig_name');
      $this->db->from('requisitions r');
      $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
      $this->db->join('department dp', 'dp.id = u.crrnt_dept_id', 'LEFT');
      $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
      $this->db->where('r.status', $status);
      $this->db->where('r.current_desk', $desk);
      $this->db->order_by('r.id', 'DESC');
      $result['rows'] = $this->db->get()->result();

      // count query
      $q = $this->db->select('COUNT(*) as count');
      $this->db->from('requisitions r'); 
      $this->db->where('r.status', $status);
      $this->db->where('r.current_desk', $desk);
      $query = $this->db->get()->result();
      $result['num_rows'] = $query[0]->count;
      
      return $result;
  }


  public function get_unavailable_items($limit=100, $offset=0, $id = null, $status = null){
    $this->db->select('SQL_CALC_FOUND_ROWS u.name_bn, dp.dept_name, dg.desig_name, i.item_name, c.category_name, ri.qty_request, r.updated, iu.unit_name, ri.id, ri.requisition_id, ri.item_id, ri.item_cate_id, ri.item_sub_cate_id, sc.sub_cate_name, ri.remark', false);
    $this->db->from('requisitions r');
    $this->db->join('requisition_item ri', 'ri.requisition_id=r.id', 'LEFT');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.crrnt_dept_id', 'LEFT');
    $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
    $this->db->join('items i', 'i.id=ri.item_id', 'LEFT');
    $this->db->join('categories c', 'c.id=ri.item_cate_id', 'LEFT');
    $this->db->join('sub_categories sc', 'sc.id=ri.item_sub_cate_id', 'LEFT');
    $this->db->join('item_unit iu', 'iu.id=i.unit_id', 'LEFT');
    if ($status != null) {
      $this->db->where('ri.is_delete', $status);
    } else {
      $this->db->where('ri.is_delete', 2);
    }

    if ($id != null) {
      $this->db->where('ri.id', $id);
    }
    $this->db->limit($limit, $offset);
    $this->db->order_by('i.id', 'ASC');
    $query = $this->db->get();


    if ($id != null) {
      $result['row'] = $query->row();
    } else if($status != null) {
      $result['row'] = $query->row();
    } else {
      $result['rows'] = $query->result();
    }

    $result['num_rows'] = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;

    return $result;
  }

  public function again_requisition_list($user_id = null, $status = null){
    $this->db->select('SQL_CALC_FOUND_ROWS u.name_bn, dp.dept_name, dg.desig_name, i.item_name, c.category_name, ri.qty_request, r.updated, iu.unit_name, ri.id, ri.requisition_id', false);
    $this->db->from('requisitions r');
    $this->db->join('requisition_item ri', 'ri.requisition_id=r.id', 'LEFT');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.crrnt_dept_id', 'LEFT');
    $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
    $this->db->join('items i', 'i.id=ri.item_id', 'LEFT');
    $this->db->join('categories c', 'c.id=ri.item_cate_id', 'LEFT');
    $this->db->join('item_unit iu', 'iu.id=i.unit_id', 'LEFT');
    if ($user_id != null) {
      $this->db->where('ri.user_id', $user_id);
    }
    if ($status != null) {
      $this->db->where('ri.is_delete', $status);
    }

    $query = $this->db->get();

    $result['rows'] = $query->result();
    // $result['num_rows'] = $this->db->query("SELECT FOUND_ROWS() as count")->where('ri.user_id', $user_id)->where('ri.is_delete', $status)->row()->count;

    return $result;
  }

  public function get_items($limit=100, $offset=0){
    $this->db->select('SQL_CALC_FOUND_ROWS i.*, c.category_name, sc.sub_cate_name, u.unit_name', false);
    $this->db->from('items i');
    $this->db->join('categories c', 'c.id=i.cat_id', 'LEFT');
    $this->db->join('sub_categories sc', 'sc.id=i.sub_cate_id', 'LEFT');
    $this->db->join('item_unit u', 'u.id=i.unit_id', 'LEFT');
    $this->db->limit($limit, $offset);
    $this->db->order_by('c.id', 'ASC');
    $query = $this->db->get()->result();

    $result['rows'] = $query;
    $result['num_rows'] = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;

    return $result;
  }

  //========= will be carefull
  //========= hard delete record not found after deleting row
  function hard_delete($table,$id) {
      $this->db->where('id', $id);
      $this->db->delete($table);     
      return TRUE;
  }

  public function get_sub_category_by_cate_id($id){
    $data['0'] = '-Select Sub Category-';
    $this->db->select('id, sub_cate_name');
    $this->db->from('sub_categories');        
    $this->db->where('cate_id', $id);
    $query = $this->db->get();

    foreach ($query->result_array() AS $rows) {
       $data[$rows['id']] = $rows['sub_cate_name'];
    }
    return $data;
  }

  public function get_items_by_sub_cate_id($id){
    $data['0'] = '-Select Item-';
    $this->db->select('id, item_name');
    $this->db->from('items');        
    $this->db->where('sub_cate_id', $id);
    $query = $this->db->get();

    foreach ($query->result_array() AS $rows) {
       $data[$rows['id']] = $rows['item_name'];
    }
    return $data;
  }

  public function get_purchase($limit=1000, $offset=0) {
    $this->db->select('p.*');
    $this->db->from('purchase p');
    $this->db->limit($limit, $offset);
    $this->db->order_by('p.id', 'DESC');
    $query = $this->db->get()->result();
    $result['rows'] = $query;

      // count query
    $q = $this->db->select('COUNT(*) as count');
    $this->db->from('purchase'); 
    $query = $this->db->get()->result();
    $tmp = $query;
    $result['num_rows'] = $tmp[0]->count;

    return $result;
  }

  public function get_purchase_info($id) {
    $this->db->select('p.*, u.first_name');
    $this->db->from('purchase p');
    $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
    $this->db->where('p.id', $id);
    $query = $this->db->get()->row();

    return $query;
  }

  public function get_purchase_items($id) {
    $this->db->select('pi.*, i.item_name, iu.unit_name, c.category_name');
    $this->db->from('purchase_item pi');
    $this->db->join('items i', 'i.id = pi.pur_item_id', 'LEFT');
    $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
    $this->db->join('categories c', 'c.id = i.cat_id', 'LEFT');
    $this->db->where('pi.purchase_id', $id);
    $query = $this->db->get()->result();

    return $query;
  }

  public function get_requisition_by_id($id) {
    $this->db->select('r.*, u.name_bn, u.signature, dp.dept_name, dg.desig_name');
    $this->db->from('requisitions r');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.crrnt_dept_id', 'LEFT');
    $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
    $this->db->where('r.id', $id);
    $query = $this->db->get()->row();

    return $query;
  }

  public function get_requisition_items($id, $status = null) {
    $this->db->select('ri.*, i.item_name, i.quantity, i.order_level, iu.unit_name, c.category_name, sc.sub_cate_name');
    $this->db->from('requisition_item ri');
    $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
    $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
    $this->db->join('categories c', 'c.id = i.cat_id', 'LEFT');
    $this->db->join('sub_categories sc', 'sc.id=ri.item_sub_cate_id', 'LEFT');
    $this->db->where('ri.requisition_id', $id);
    if ($status == null) {
      $this->db->where_not_in('ri.is_delete', [1,2]);
    }
    $query = $this->db->get()->result();

    return $query;
  }

  public function get_requisition_status(){
     return array('' => '--Select One--', '2' => 'Approve', '3'=>'Reject');
  }

  public function get_users(){
    $data[''] = '-- Select User --';
    $this->db->select('u.id, u.first_name as text');
    $this->db->from('users u');
    $this->db->join('designation dg', 'dg.id = u.designation', 'LEFT');
    $query = $this->db->get();

    foreach ($query->result_array() AS $rows) {
      $data[$rows['id']] = $rows['text'];
    }
   return $data;
  } 

  public function get_requisition_report(array $inputs){
    $data = array();

    $this->db->select('r.*, u.name_bn as first_name, dp.dept_name, dg.desig_name');
    $this->db->from('requisitions r');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.crrnt_dept_id', 'LEFT');
    $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');

    if($inputs['dpt']){
      $this->db->where('r.department_id', $inputs['dpt']);
    }
    
    if($inputs['status']){
      $this->db->where('r.status', $inputs['status']);
    }

    if($inputs['start_date'] && $inputs['end_date']){
      $this->db->where('DATE(r.created) BETWEEN "'. $inputs['start_date']. '" AND "'. $inputs['end_date'].'"');
    }

    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key=>$value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('requisition_item ri');
      $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.requisition_id', $value->id);
      $data['details'][$key] = $this->db->get()->result();
    }

    return $data;
  }

  public function get_low_inventory_items(){
    $this->db->select('i.*, c.category_name, u.unit_name');
    $this->db->from('items i');
    $this->db->join('categories c', 'c.id=i.cat_id', 'LEFT');
    $this->db->join('item_unit u', 'u.id=i.unit_id', 'LEFT');
    $this->db->order_by('c.id', 'ASC');
    $this->db->where('quantity <= order_level');
    $query = $this->db->get()->result();
    // echo $this->db->last_query(); exit;

    return $query;
  } 

  public function get_my_requisition($limit=1000, $offset=0, $status=NULL) {
    $this->db->select('r.*, u.name_bn as first_name');
    $this->db->from('requisitions r');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->where('user_id', $this->session->userdata('user_id'));
    if($status){
       $this->db->where('status', $status);
    }
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get()->result();
    $result['rows'] = $query;

      // count query
    $q = $this->db->select('COUNT(*) as count');
    $this->db->from('requisitions'); 
    $this->db->where('user_id', $this->session->userdata('user_id'));
    if($status){
       $this->db->where('status', $status);
    }
    $query = $this->db->get()->result();
    $tmp = $query;
    $result['num_rows'] = $tmp[0]->count;

    return $result;
  } 

  public function get_department(){
    $data[''] = '-- Select Department --';
    $this->db->select('d.id, d.dept_name as text');
    $this->db->from('department d');
    $query = $this->db->get();

    foreach ($query->result_array() AS $rows) {
      $data[$rows['id']] = $rows['text'];
    }
   return $data;
  } 

}