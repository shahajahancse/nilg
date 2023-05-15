<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('c.*, s.session_name');
        $this->db->from('calendar c');
        $this->db->join('session_year s', 's.id=c.session_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('s.session_name', 'DESC');
        // Filter
        if($this->input->get('session_id')){
            $this->db->where('c.session_id', $this->input->get('session_id'));
        }
        if($this->input->get('name')){
            $this->db->where('c.traniee_type', $this->input->get('traniee_type'));
        }

        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('calendar');
        // Filter
        if($this->input->get('session_id')){
            $this->db->where('session_id', $this->input->get('session_id'));
        }
        if($this->input->get('name')){
            $this->db->where('traniee_type', $this->input->get('traniee_type'));
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_info($id) {
        $query = $this->db->select('c.*, s.session_name')
        ->from('calendar c')
        ->join('session_year s', 's.id=c.session_id', 'LEFT')
        ->where('c.id', $id)
        ->get()->row();
        
        return $query;
    }
    

}
