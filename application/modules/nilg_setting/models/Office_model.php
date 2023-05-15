<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Office_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('o.id, o.office_name, o.status, ot.office_type_name, div.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn');
        $this->db->from('office o');
        $this->db->join('office_type ot', 'ot.id=o.office_type', 'LEFT');
        $this->db->join('divisions div', 'div.id=o.division_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id=o.district_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=o.upazila_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=o.union_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('o.id', 'DESC');
        // Filter
        if($this->input->get('office_type')){
            $this->db->where('o.office_type', $this->input->get('office_type'));
        }
        if($this->input->get('name')){
            $this->db->like('o.office_name', $this->input->get('name'));
        }
        if($this->input->get('division')){
            $this->db->where('o.division_id', $this->input->get('division'));
        }
        if($this->input->get('district')){
            $this->db->where('o.district_id', $this->input->get('district'));
        }
        if($this->input->get('upazila')){
            $this->db->where('o.upazila_id', $this->input->get('upazila'));
        }
        if($this->input->get('union')){
            $this->db->where('o.union_id', $this->input->get('union'));
        }


        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office');
        // Filter
        if($this->input->get('office_type')){
            $this->db->where('office_type', $this->input->get('office_type'));
        }
        if($this->input->get('name')){
            $this->db->like('office_name', $this->input->get('name'));
        }
        if($this->input->get('division')){
            $this->db->where('division_id', $this->input->get('division'));
        }
        if($this->input->get('district')){
            $this->db->where('district_id', $this->input->get('district'));
        }
        if($this->input->get('upazila')){
            $this->db->where('upazila_id', $this->input->get('upazila'));
        }
        if($this->input->get('union')){
            $this->db->where('union_id', $this->input->get('union'));
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_info($id) {
        $query = $this->db->select('o.*, uni.uni_name_bn, upa.upa_name_bn')
        ->from('office o')
        ->join('unions uni', 'uni.id=o.union_id', 'LEFT')
        ->join('upazilas upa', 'upa.id=o.upazila_id', 'LEFT')
        ->where('o.id', $id)
        ->get()->row();
        
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
