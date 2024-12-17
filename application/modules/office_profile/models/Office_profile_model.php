<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Office_profile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_info($id) {
        $this->db->select('u.id, u.username, ot.office_type_name, u.office_type_id, u.office_name, FROM_UNIXTIME(u.last_login) AS last_login, u.div_id, u.dis_id, u.upa_id, u.union_id, dv.div_name_bn, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn');
        $this->db->from('users u');
        $this->db->join('office_type ot', 'ot.id = u.office_type_id');
        $this->db->join('divisions dv', 'dv.id = u.div_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = u.union_id', 'LEFT');
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();

        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_userid_from_nid($id) {
        $query = $this->db->from('personal_datas')->where('national_id', $id)->get()->row()->id;
        // echo $this->db->last_query(); exit;
        return $query;
    }

}
