<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation_subject_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('s.*, m.mark_type_name');
        $this->db->from('evaluation_subject s');
        $this->db->join('evaluation_mark_type m', 'm.id = s.mark_type_id', 'LEFT');        
        $this->db->limit($limit);
        $this->db->offset($offset); 
        // $this->db->order_by('id', 'DESC');
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation_subject');
        // Filter        
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_info($id) {
        $query = $this->db->from('evaluation_subject')->where('id', $id)->get()->row();
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
