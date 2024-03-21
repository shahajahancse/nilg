<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Journal_entry_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists ($limit, $offset,$table) {
        $this->db->select('b.*');
        $this->db->from($table.' as b');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('b.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query

        $this->db->select('COUNT(*) as count');
        $this->db->from($table.' as q');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }
}
