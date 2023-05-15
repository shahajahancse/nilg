<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_course_info($id) {
        $this->db->select('t.id, t.participant_name, t.batch_no, t.start_date, t.end_date, c.course_title');
        $this->db->from('training t');
        $this->db->join('training_course c', 'c.id = t.course_id', 'LEFT');        
        $this->db->where('t.id', $id);
        $query = $this->db->get()->row();        

        return $query;
    }

    public function get_training_circular() {
        $today = date('Y-m-d');

        $this->db->select('t.id, t.participant_name, t.batch_no, t.start_date, t.end_date, c.course_title');
        $this->db->from('training t');
        $this->db->join('training_course c', 'c.id = t.course_id', 'LEFT');        
        // $this->db->where('t.reg_start_date', $today);
        // $this->db->where('t.reg_start_date <=', $today);
        $this->db->where('t.reg_end_date >=', $today);
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;  

        return $query;
    }

    public function exists_nid($item) {       
        $this->db->from('users');
        $this->db->where('nid', $item);
        $query = $this->db->get();

        // echo $this->db->last_query(); exit;

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() >= 1) {
            return true;
        }else{
            return false;
        }
    }

    public function match_nid_dob($nid, $dob) {       
        $this->db->from('users');
        $this->db->where('nid', $nid);
        $this->db->where('dob', $dob);
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        // return ($query->num_rows() >= 1);
        if ($query->num_rows() >= 1) {
            return true;
        }else{
            return false;
        }
    }


    public function match_training_id_pin($trainingID, $pin) {       
        $this->db->from('training');
        $this->db->where('id', $trainingID);
        $this->db->where('pin', $pin);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() >= 1) {
            return true;
        }else{
            return false;
        }
    }

    public function check_is_applied($trainingID, $appUserID) {       
        $this->db->from('training_participant');
        $this->db->where('training_id', $trainingID);
        $this->db->where('app_user_id', $appUserID);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() >= 1) {
            return true;
        }else{
            return false;
        }
    }

    public function get_applicant_info($nid) {
        $this->db->select('id, nid');
        $this->db->from('users');
        $this->db->where('nid', $nid);
        $query = $this->db->get()->row();        
    
        return $query;
    }










    
    public function get_user_details() {
        // , u.office_type_id
        $this->db->select('u.id, u.username, u.is_office, u.office_type, u.employee_type, u.name_bn, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, u.crrnt_office_id, o.office_name, u.office_name as user_office_name');
        $this->db->from('users u');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();        
    
        return $query;
    }

    public function get_user_info(){
        $this->db->select('u.id, u.username, u.is_office, u.office_type, u.employee_type, u.name_bn, u.nid, u.mobile_no, u.email, u.dob, u.crrnt_office_id, u.crrnt_desig_id, u.div_id, u.dis_id, u.upa_id, u.union_id, e.employee_type_name, o.office_name, d.desig_name, u.designation, u.office_name, ot.office_type_name, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, o.office_name');
        $this->db->from('users u');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();        
    
        return $query;   
    }

    
    public function get_user_submitted_info(){
        $this->db->select('u.id, u.username, u.is_office, u.office_type, u.employee_type, u.name_bn, u.name_en, u.father_name, u.mother_name, u.nid, u.mobile_no, u.email, u.dob, u.crrnt_office_id, u.crrnt_desig_id, u.div_id, u.dis_id, u.upa_id, u.union_id, u.created_on, u.modified, e.employee_type_name, o.office_name, d.desig_name, u.designation, u.office_name, u.present_add, u.interested_subjects');
        $this->db->from('users u');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();        
    
        return $query;   
    }

    public function get_office_info_by_session() {
        $this->db->select('u.id, u.username, u.office_type, ot.office_type_name, u.div_id, u.dis_id, u.upa_id, u.union_id, dv.div_name_bn, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn, FROM_UNIXTIME(u.last_login) AS last_login,');
        $this->db->from('users u');
        $this->db->join('office_type ot', 'ot.id = u.office_type');
        $this->db->join('divisions dv', 'dv.id = u.div_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = u.union_id', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();

        return $query;
    }

}
