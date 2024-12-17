<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Budget_sub_head_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function training_get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('q.*,budget_head.id as budget_head_id, budget_head.name_en as budget_head_name_en, budget_head.name_bn as budget_head_name_bn');
        $this->db->from('budget_head_sub_training as q');
        $this->db->join('budget_head_training budget_head', 'budget_head.id = q.head_id');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('q.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_head_sub_training');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('q.*,budget_head.id as budget_head_id, budget_head.name_en as budget_head_name_en, budget_head.name_bn as budget_head_name_bn');
        $this->db->from('budget_head_sub as q');
        $this->db->join('budget_head', 'budget_head.id = q.head_id');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('q.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_head_sub');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_info($id) {
        $this->db->select('q.*');
        $this->db->from('budget_head_sub q');
        $this->db->where('q.id', $id);
        $query['info'] = $this->db->get()->row();
        return $query;
    }




}
