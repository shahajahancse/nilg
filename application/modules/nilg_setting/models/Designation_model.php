<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Designation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('d.id, d.offices, d.desig_name, d.so, d.status, e.employee_type_name');
        $this->db->from('designations d');
        // $this->db->join('office_type ot', 'ot.id = d.office_type', 'LEFT');        
        $this->db->join('employee_type e', 'e.id = d.employee_type', 'LEFT');        
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('d.id', 'DESC');
        $this->db->order_by('d.so', 'ASC');
        // Filter
        if($this->input->get('office')){
            //$this->db->where_in('d.offices', ['5']);
            $this->db->where("FIND_IN_SET('".$this->input->get('office')."', d.offices)");
        }
        if($this->input->get('name')){
            $this->db->like('d.desig_name', $this->input->get('name'));
        }
        if($this->input->get('employee_type')){
            $this->db->where('d.employee_type', $this->input->get('employee_type'));
        }        

        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('designations');
        // Filter
        if($this->input->get('office')){
            //$this->db->where_in('d.offices', ['5']);
            $this->db->where("FIND_IN_SET('".$this->input->get('office')."', offices)");
        }
        if($this->input->get('name')){
            $this->db->like('desig_name', $this->input->get('name'));
        }
        if($this->input->get('employee_type')){
            $this->db->where('employee_type', $this->input->get('employee_type'));
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_info($id) {
        $query = $this->db->from('designations')->where('id', $id)->get()->row();
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
