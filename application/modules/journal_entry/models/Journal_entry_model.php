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
    public function all_journal($type,$from_date, $to_date,$status=null){
        $this->db->select('*');
        if(!empty($status)){
        $this->db->where('status',$status);
        }
        if ($type == 'revenue') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_gov_revenue_register')->result();
        }elseif ($type == 'publication') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_publication_register')->result();
        }elseif ($type == 'miscellaneous') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_miscellaneous_register')->result();
        }elseif ($type == 'pension') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_pension_register')->result();
            
        }elseif ($type == 'hostel') {
            $this->db->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $this->db->get('budget_j_hostel_register')->result();
        }elseif ($type == 'gpf') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_gpf_register')->result();
            
        }elseif ($type == 'cheque') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_cheque_register')->result();
        }
        return $data;
    }
}
