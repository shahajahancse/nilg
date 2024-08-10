<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Journal_entry_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists ($type, $limit, $offset,$table) {
        $this->db->select('b.*');
        $this->db->from($table.' as b');
        $this->db->where('type', $type);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('b.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query

        $this->db->select('COUNT(*) as count');
        $this->db->from($table.' as q');
        $this->db->where('type', $type);
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
            $data=$this->db->get('budget_j_hostel_register')->result();
        }elseif ($type == 'gpf') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_gpf_register')->result();

        }elseif ($type == 'cheque') {
            $this->db->where('issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
            $data=$this->db->get('budget_j_cheque_register')->result();
        }
        return $data;
    }

    // 1=book entry, 2=book out, 3=give, 4=sell by kg
    public function all_book($from_date, $to_date, $book=null){
        $this->db->select('pb.id, pb.name_bn, pb.name_en, prd.price,
                SUM(CASE WHEN prd.type = 1 THEN prd.quantity ELSE 0 END) as book_in,
                SUM(CASE WHEN prd.type = 2 THEN prd.quantity ELSE 0 END) as book_sale,
                SUM(CASE WHEN prd.type = 3 THEN prd.quantity ELSE 0 END) as book_give,
                SUM(CASE WHEN prd.type = 4 THEN prd.quantity ELSE 0 END) as sell_by_kg,

                SUM(CASE WHEN prd.type = 1 THEN prd.amount ELSE 0 END) as book_in_amt,
                SUM(CASE WHEN prd.type = 2 THEN prd.amount ELSE 0 END) as book_sale_amt,
                SUM(CASE WHEN prd.type = 3 THEN prd.amount ELSE 0 END) as book_give_amt,
                SUM(CASE WHEN prd.type = 4 THEN prd.amount ELSE 0 END) as sell_by_kg_amt,
            ');
        $this->db->from('budget_j_publication_book as pb');
        $this->db->join('budget_j_publication_register_details as prd', 'pb.id=prd.book_id', 'left');

        if (!empty($from_date) && !empty($to_date)) {
            $this->db->join('budget_j_publication_register as pr', 'prd.publication_register_id=pr.id', 'left');
            $this->db->where('pr.issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
        }

        $this->db->where('pb.status', 1);
        $this->db->group_by('prd.book_id');
        $data = $this->db->get()->result();
        return $data;
    }

    public function group_book_info($from_date, $to_date, $group_id=null){
        $this->db->select('pb.id, pg.name_bn, pg.name_en, prd.price,
                SUM(CASE WHEN prd.type = 1 THEN prd.quantity ELSE 0 END) as book_in,
                SUM(CASE WHEN prd.type = 2 THEN prd.quantity ELSE 0 END) as book_sale,
                SUM(CASE WHEN prd.type = 3 THEN prd.quantity ELSE 0 END) as book_give,
                SUM(CASE WHEN prd.type = 4 THEN prd.quantity ELSE 0 END) as sell_by_kg,

                SUM(CASE WHEN prd.type = 1 THEN prd.amount ELSE 0 END) as book_in_amt,
                SUM(CASE WHEN prd.type = 2 THEN prd.amount ELSE 0 END) as book_sale_amt,
                SUM(CASE WHEN prd.type = 3 THEN prd.amount ELSE 0 END) as book_give_amt,
                SUM(CASE WHEN prd.type = 4 THEN prd.amount ELSE 0 END) as sell_by_kg_amt,
            ');
        $this->db->from('budget_j_publication_register_details as prd');
        $this->db->join('budget_j_publication_book as pb', 'prd.book_id=pb.id', 'left');
        $this->db->join('budget_j_publication_group as pg', 'pb.group_id=pg.id', 'left');

        if (!empty($from_date) && !empty($to_date)) {
            $this->db->join('budget_j_publication_register as pr', 'prd.publication_register_id=pr.id', 'left');
            $this->db->where('pr.issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
        }

        if (!empty($group_id)) {
            $this->db->where('pg.id', $group_id);
        }
        $this->db->where('pb.status', 1);
        $this->db->group_by('pb.group_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function single_book_info($from_date, $to_date, $book_id = null ){
        $this->db->select('pb.id, pb.name_bn, pb.name_en, prd.price, prd.*, pr.issue_date');
        $this->db->from('budget_j_publication_book as pb');
        $this->db->join('budget_j_publication_register_details as prd', 'pb.id=prd.book_id', 'left');
        $this->db->join('budget_j_publication_register as pr', 'prd.publication_register_id=pr.id', 'left');

        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('pr.issue_date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
        }

        $this->db->where('prd.book_id', $book_id);
        $this->db->where('pb.status', 1);
        $this->db->group_by('prd.id');
        $data = $this->db->get()->result();
        return $data;
    }
    // 1=book entry, 2=book out, 3=give, 4=sell by kg
}
