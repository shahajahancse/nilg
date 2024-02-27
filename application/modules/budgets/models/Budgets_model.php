<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Budgets_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    // Manage Budget nilg list
    public function get_budget($limit, $offset) {

      // result query
      $this->db->select('q.*,session_year.session_name');
      $this->db->from('budget_nilg as q');
      $this->db->join('session_year','q.fcl_year=session_year.id','left');
      $this->db->limit($limit);
      $this->db->offset($offset);        
      $this->db->order_by('q.id', 'DESC');
      $result['rows'] = $this->db->get()->result();
      // count query
      $this->db->select('COUNT(*) as count');
      $this->db->from('budget_nilg');
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;
      return $result; 
    }
    public function get_budget_sub_head($id){
      $data['0'] = '-- Select Item --';
      $this->db->select('id, name_bn');
      $this->db->from('budget_head_sub');        
      $this->db->where('head_id', $id);
      $query = $this->db->get();
  
      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['item_name'];
      }
      return $data;
    }
    // End Manage Budget nilg list

    // Manage Budget nilg data
    public function get_budget_details_nilg($id) {
        $this->db->select('
                budget_nilg_details.*,
                budget_head_sub.name_bn,
                budget_head.name_bn as budget_head_name,
            ');
        $this->db->from('budget_nilg_details');
        $this->db->join('budget_head_sub', 'budget_nilg_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_nilg_details.budget_nilg_id', $id);
        $this->db->where('budget_nilg_details.modify_soft_d', 1);
        return $this->db->get()->result();
    }
    // End Manage Budget nilg list


    // Manage Budget office list
    public function get_budget_field($limit, $offset) {

      // result query
      // $this->db->select('q.*,session_year.session_name');
      $this->db->select('q.*');
      $this->db->from('budget_field as q');
      // $this->db->join('session_year','q.fcl_year=session_year.id','left');
      $this->db->limit($limit);
      $this->db->offset($offset);        
      $this->db->order_by('q.id', 'DESC');
      $result['rows'] = $this->db->get()->result();
      // count query
      $this->db->select('COUNT(*) as count');
      $this->db->from('budget_field');
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;
      return $result; 
    }
    public function get_budget_sub_head_office($id){
      $data['0'] = '-- Select Item --';
      $this->db->select('id, name_bn');
      $this->db->from('budget_head_sub');        
      $this->db->where('head_id', $id);
      $query = $this->db->get();
  
      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['item_name'];
      }
      return $data;
    }
    // End Manage Budget office list
}