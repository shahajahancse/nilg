<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acl_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }    

    public function get_users($limit = 1000, $offset = 0) {
        // Result Query
        $this->db->select('u.id, u.username, u.mobile_no, u.last_login, u.office_name as org_office_name, u.active, o.office_name, FROM_UNIXTIME(u.last_login) AS last_login');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');

        /*
        // $this->db->join('office_type ot', 'ot.id = o.office_type', 'LEFT'); // ot.office_type_name
        // div.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn
        $this->db->join('divisions div', 'div.id = u.div_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = u.dis_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = u.union_id', 'LEFT');
        */

        $this->db->from('users u');
        // $this->db->where('u.user_type', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('u.id', 'DESC');
        // join and then run a where_in against the group ids
        // if (isset($groups) && !empty($groups))
        if($this->input->get('group') != NULL){
            $this->db->distinct();
            $this->db->join('users_groups ug', 'ug.user_id=u.id', 'inner');
            $this->db->where_in('ug.group_id', $this->input->get('group'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        if($this->input->get('office_id') != NULL){
            $this->db->where('u.crrnt_office_id', $this->input->get('office_id')); 
        }
        $this->db->where('u.id !=', 3);

        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users u');
        // $this->db->where('u.user_type', 1);
        // join and then run a where_in against the group ids
        // if (isset($groups) && !empty($groups))
        if($this->input->get('group') != NULL){
            $this->db->distinct();
            $this->db->join('users_groups ug', 'ug.user_id=u.id', 'inner');
            $this->db->where_in('ug.group_id', $this->input->get('group'));
        }     
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        if($this->input->get('office_id') != NULL){
            $this->db->where('u.crrnt_office_id', $this->input->get('office_id')); 
        }
        $this->db->where('u.id !=', 3); 
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_user_data($id) {
        $query = $this->db->select('u.id, u.password, u.email, u.created_on, u.last_login, u.first_name, u.last_name, u.company, u.phone, ug.group_id, g.description ')
        ->join('users_groups ug', 'ug.user_id = u.id', 'left')
        ->join('groups g', 'g.id = ug.user_id', 'left')
        ->limit(1)
        ->order_by('u.id', 'ASC')
        ->get_where('users u', array('u.id' => $id));
        return $query->row();
    }

    public function destroy_user($id) {
        $query = $this->db->delete('users', array('id' => $id));
        return $query;
    } 

    public function get_group_name() {
        // count query
        $this->db->select('id, name, description');
        $this->db->from('groups');
        $query = $this->db->get()->result();

        return $query;
    }    

    public function exists_username($item)
    {
        $this->db->from('users');
        $this->db->where('username', $item);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    

    // User Insert Script    
    /*
    public function get_office($officeType){
        $this->db->select('o.*, div.div_name_en, dis.dis_name_en, upa.upa_name_en, uni.uni_name_en');
        $this->db->from('office o');        
        $this->db->join('divisions div', 'div.id = o.division_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = o.district_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = o.upazila_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = o.union_id', 'LEFT');        
        // $this->db->where('o.id', '12');
        $this->db->where('o.office_type', $officeType); 
        $this->db->where('o.is_create', 0); 
        $this->db->order_by('o.id', 'ASC');
        $this->db->limit(300);

        return $this->db->get()->result();
    }
    */
  



    // public function get_members_count() {
    //     // count query
    //     $this->db->select('COUNT(*) as count');
    //     $this->db->from('members');
    //     $q = $this->db->get()->result();

    //     $tmp = $q;
    //     $ret['num_rows'] = $tmp[0]->count;

    //     return $ret;
    // }

}
