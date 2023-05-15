<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Qbank_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('q.*, ot.office_type_name');
        $this->db->from('qbank q');
        // $this->db->join('course c', 'c.id = q.course_id', 'LEFT');        
        $this->db->join('office_type ot', 'ot.id = q.office_type', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('q.id', 'DESC');
        // Filter        
        if($this->input->get('office') != NULL){
            $this->db->where('q.office_type', $this->input->get('office'));
        }        
        if($this->input->get('question') != NULL){
            $this->db->like('q.question_title', $this->input->get('question'));
        }   
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('qbank');
        // Filter
        if($this->input->get('office') != NULL){
            $this->db->where('office_type', $this->input->get('office'));
        }
        if($this->input->get('question') != NULL){
            $this->db->like('question_title', $this->input->get('question'));
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_info($id) {
        $this->db->select('q.*, ot.office_type_name');
        $this->db->from('qbank q');
        $this->db->join('office_type ot', 'ot.id = q.office_type', 'LEFT');
        $this->db->where('q.id', $id);
        $query['info'] = $this->db->get()->row();

        // Question Options
        $this->db->select('id, option_name');
        $this->db->from('qbank_option');        
        $this->db->where('qbank_id', $id);                
        $query['options'] = $this->db->get()->result();

        return $query;
    }

    // public function get_user_data($id) {
    //     $query = $this->db->select('u.id, u.password, u.email, u.created_on, u.last_login, u.first_name, u.last_name, u.company, u.phone, ug.group_id, g.description ')
    //             ->join('users_groups ug', 'ug.user_id = u.id', 'left')
    //             ->join('groups g', 'g.id = ug.user_id', 'left')
    //             ->limit(1)
    //             ->order_by('u.id', 'ASC')
    //             ->get_where('users u', array('u.id' => $id));
    //     return $query->row();
    // }

    

}
