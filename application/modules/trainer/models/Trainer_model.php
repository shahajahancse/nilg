<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}

class Trainer_model extends CI_Model {    
    function __construct() {
        parent::__construct();        
    }
    
    public function get_all($limit=1000, $offset=0) {
        // result query        
        $this->db->select('u.id, u.name_bn, u.nid, u.mobile_no, u.email, dg.desig_name as current_desig_name, u.designation');
        $this->db->from('users u');
        $this->db->join('users_groups ug', 'ug.user_id = u.id', 'LEFT');
        $this->db->join('groups g', 'g.id = ug.group_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');   
        $this->db->where('ug.group_id', 11);
        $this->db->where('u.is_verify', 1);
        $this->db->order_by('u.id', 'DESC'); 
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // Count Query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users u');
        $this->db->join('users_groups ug', 'ug.user_id = u.id', 'LEFT');
        $this->db->join('groups g', 'g.id = ug.group_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');   
        $this->db->where('ug.group_id', 11);
        $this->db->where('u.is_verify', 1);

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    public function get_application_request($limit=1000, $offset=0, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query        
        $this->db->select('u.id, u.name_bn, u.nid, u.mobile_no, ut.upa_name_bn, uni.uni_name_bn, dg.desig_name as current_desig_name, u.designation');
        $this->db->from('users u');        
        $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');        
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');

        // Office Level
        if($div_id){
            $this->db->where('u.div_id', $div_id);
        }
        if($dis_id){
            $this->db->where('u.dis_id', $dis_id);
        }
        if($upa_id){
            $this->db->where('u.upa_id', $upa_id);
        }
        if($union_id){
            $this->db->where('u.union_id', $union_id);
        }

        $this->db->where('u.is_office', 0);
        $this->db->where('u.is_applied', 1);
        $this->db->order_by('u.id', 'DESC'); 
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // $result['rows'] = $query;

        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');        

        // Office Level
        if($div_id){
            $this->db->where('div_id', $div_id);
        }
        if($dis_id){
            $this->db->where('dis_id', $dis_id);
        }
        if($upa_id){
            $this->db->where('upa_id', $upa_id);
        }
        if($union_id){
            $this->db->where('union_id', $union_id);
        }

        $this->db->where('is_office', 0);
        $this->db->where('is_applied', 1);

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    public function get_user_info($id){
        $this->db->select('u.id, u.username, u.is_office, u.office_type, u.name_bn, u.name_en, u.nid, u.mobile_no, u.email, u.dob, u.office_name, u.designation, u.height_education, u.interested_subjects, u.present_add, u.created_on');
        $this->db->from('users u');
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();        

        return $query;   
    }


    public function get_info($id) {        
        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.is_office, u.employee_type, u.nid, u.name_bn, u.nid, u.dob, u.mobile_no, u.email, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, u.crrnt_office_id, oc.office_name as current_office_name, cd.desig_name as current_desig_name, u.office_name as user_office_name, u.created_on, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.office_name, u.designation, u.height_education, u.interested_subjects, u.present_add');
        $this->db->from('users u');        
        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();   
        // echo $this->db->last_query(); exit;
        return $query;
    }

}
