<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Budgets_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
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
}