<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Budget_head_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data_training($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('q.*');
        $this->db->from('budget_head_training as q');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->order_by('q.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_head_training');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('q.*');
        $this->db->from('budget_head as q');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('q.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_head');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_info($id) {
        $this->db->select('q.*');
        $this->db->from('budget_head q');
        $this->db->where('q.id', $id);
        $query['info'] = $this->db->get()->row();
        return $query;
    }


    public function get_description($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('*');
        $this->db->from('budget_description');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_description');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }




}
