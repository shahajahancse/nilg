<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_profile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**************************** Trainee **************************/
    /***************************************************************/
    // get info 07-03-2022
        public function get_details_info($id) {
        $query = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, oc.office_name, u.username, u.is_office, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.per_div_id, u.dis_id, u.per_dis_id, u.upa_id, u.per_upa_id, u.union_id, u.is_verify, u.status, u.is_applied, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name, dept.dept_name, u.office_name as user_office_name, u.job_per_date, u.prl_date, u.retirement_date, u.profile_img, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.crrnt_desig_id, u.birth_place, u.signature, u.quota_id, u.religion_id, u.ms_id, u.first_office_id, u.first_desig_id, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, job_quota.quota_name, religion.religion_name, per_div.div_name_bn as per_div_bn, per_dis.dis_name_bn as per_dis_bn, per_upa.upa_name_bn as per_upa_bn,u.crrnt_dept_id, ds.status_name, u.designation, u.interested_subjects');
        $this->db->from('users u');
        // $this->db->join('office o', 'o.id = u.office_id', 'LEFT');

        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('department dept', 'dept.id = u.crrnt_dept_id', 'LEFT');
        $this->db->join('office of', 'of.id = u.first_office_id', 'LEFT');
        $this->db->join('designations df', 'df.id = u.first_desig_id', 'LEFT');

        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('employee_type et', 'et.id=u.employee_type' , 'LEFT');
        $this->db->join('marital_status ms', 'ms.id=u.ms_id' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        $this->db->join('divisions per_div', 'per_div.id=u.per_div_id' , 'LEFT');
        $this->db->join('districts per_dis', 'per_dis.id=u.per_dis_id' , 'LEFT');
        $this->db->join('upazilas per_upa', 'per_upa.id=u.per_upa_id' , 'LEFT');
        $this->db->join('job_quota', 'job_quota.id=u.quota_id' , 'LEFT');
        $this->db->join('religion', 'religion.id=u.religion_id' , 'LEFT');
        $this->db->join('data_status ds', 'ds.id=u.status' , 'LEFT');
        // $this->db->join('unions uinon', 'union.id=u.uni_id' , 'LEFT');
        $this->db->where('u.id', $id);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;


        // Elected Times / Experience
        $this->db->select('e.id, e.data_id, e.exp_office_id, o.office_name, e.exp_design_id, d.desig_name, e.exp_duration ');
        $this->db->from('per_experience e');
        $this->db->join('office o', 'o.id = e.exp_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = e.exp_design_id', 'LEFT');
        $this->db->where('e.data_id', $id);
        $query['experience'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // Promotion
        $this->db->select('id, promo_org_name, promo_desig_name, promo_salary_ratio, promo_comments');
        $this->db->from('per_promotion');
        $this->db->where('data_id', $id);
        $query['promotion'] = $this->db->get()->result();

        // Education
        $this->db->select('ed.*, ex.exam_name, s.sub_name, b.board_name');
        $this->db->from('per_education ed');
        $this->db->join('exam_names ex', 'ex.id = ed.edu_exam_id', 'LEFT');
        $this->db->join('subjects s', 's.id = ed.edu_subject_id', 'LEFT');
        $this->db->join('boards b', 'b.id = ed.edu_board_id', 'LEFT');
        $this->db->where('ed.data_id', $id);
        $query['education'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // NILG Training
        $this->db->select('
                nt.id, 
                nt.training_id, 
                nt.app_user_id, 
                nt.nilg_desig_id, 
                c.course_title,
                d.desig_name, 
                t.participant_name,
                t.course_id,
                t.batch_no, 
                t.start_date, 
                t.end_date
            ');
        // $this->db->from('per_nilg_training nt');
        $this->db->from('training_participant nt');
        $this->db->join('training t', 't.id = nt.training_id', 'LEFT');
        $this->db->join('designations d', 'd.id = nt.nilg_desig_id', 'LEFT');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');

        $this->db->where('nt.app_user_id', $id);
        $this->db->where('nt.is_complete', 1);
        $query['nilg_training'] = $this->db->get()->result();
        

        // Local Training in Bangladesh
        $this->db->select('id, local_course_name, local_training_org_name_adds, local_training_start, local_training_end');
        $this->db->from('per_local_org_training');
        $this->db->where('data_id', $id);
        $query['local_training'] = $this->db->get()->result();

        // Foreign Training
        $this->db->select('id, foreign_course_name, foreign_training_org_name_adds, foreign_training_start, foreign_training_end');
        $this->db->from('per_foreign_org_training');
        $this->db->where('data_id', $id);
        $query['foreign_training'] = $this->db->get()->result();

        return $query;
    }

















    public function get_trainee_all_data() {
        $query = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, oc.office_name, u.username,  u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.per_div_id, u.dis_id, u.per_dis_id, u.upa_id, u.per_upa_id, u.union_id, u.is_verify, u.status, u.is_applied, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name, dept.dept_name, u.office_name as user_office_name, u.job_per_date, u.prl_date, u.retirement_date, u.profile_img, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name');
        $this->db->from('users u');
        // $this->db->join('office o', 'o.id = u.office_id', 'LEFT');
        
        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('department dept', 'dept.id = u.crrnt_dept_id', 'LEFT');
        $this->db->join('office of', 'of.id = u.first_office_id', 'LEFT');
        $this->db->join('designations df', 'df.id = u.first_desig_id', 'LEFT');

        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('employee_type et', 'et.id=u.employee_type' , 'LEFT');
        $this->db->join('marital_status ms', 'ms.id=u.ms_id' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        // $this->db->join('unions uinon', 'union.id=u.uni_id' , 'LEFT');
        $this->db->where('u.id', $this->userSeessID);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;    


        // Elected Times / Experience
        $this->db->select('e.id, e.data_id, e.exp_duration, o.office_name, d.desig_name');
        $this->db->from('per_experience e');        
        $this->db->join('office o', 'o.id = e.exp_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = e.exp_design_id', 'LEFT');        
        $this->db->where('e.data_id', $this->userSeessID);                
        $query['experience'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;          

        // Promotion
        $this->db->select('id, promo_org_name, promo_desig_name, promo_salary_ratio, promo_comments');
        $this->db->from('per_promotion');
        $this->db->where('data_id', $this->userSeessID);
        $query['promotion'] = $this->db->get()->result();  

        // Education
        $this->db->select('ed.*, ex.exam_name, s.sub_name, b.board_name');
        $this->db->from('per_education ed');
        $this->db->join('exam_names ex', 'ex.id = ed.edu_exam_id', 'LEFT');
        $this->db->join('subjects s', 's.id = ed.edu_subject_id', 'LEFT');        
        $this->db->join('boards b', 'b.id = ed.edu_board_id', 'LEFT');        
        $this->db->where('ed.data_id', $this->userSeessID);                
        $query['education'] = $this->db->get()->result();  
        // echo $this->db->last_query(); exit;        
        
        // NILG Training
        $this->db->select('nt.id, c.course_title, d.desig_name, nt.nilg_batch_no, nt.nilg_training_start, nt.nilg_training_end');
        $this->db->from('per_nilg_training nt');        
        $this->db->join('course c', 'c.id = nt.nilg_course_id', 'LEFT');
        $this->db->join('designations d', 'd.id = nt.nilg_desig_id', 'LEFT');        
        $this->db->where('nt.data_id', $this->userSeessID);                
        $query['nilg_training'] = $this->db->get()->result();

        // Local Training in Bangladesh
        $this->db->select('id, local_course_name, local_training_org_name_adds, local_training_start, local_training_end');
        $this->db->from('per_local_org_training');        
        $this->db->where('data_id', $this->userSeessID);                
        $query['local_training'] = $this->db->get()->result();

        // Foreign Training
        $this->db->select('id, foreign_course_name, foreign_training_org_name_adds, foreign_training_start, foreign_training_end');
        $this->db->from('per_foreign_org_training');
        $this->db->where('data_id', $this->userSeessID);
        $query['foreign_training'] = $this->db->get()->result();
   

        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_trainee_general_info(){
        // $id = $this->session->userdata('user_id');

        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, u.per_div_id, u.per_dis_id, u.per_upa_id, u.ms_id, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, u.office_id, o.office_name, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name, u.office_name as user_office_name, u.created_on, u.modified, u.profile_img, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, u.job_per_date, u.prl_date, u.retirement_date');
        $this->db->from('users u');
        $this->db->join('office o', 'o.id = u.office_id', 'LEFT');        
        $this->db->join('office of', 'of.id = u.first_office_id', 'LEFT');
        $this->db->join('designations df', 'df.id = u.first_desig_id', 'LEFT');
        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('employee_type et', 'et.id=u.employee_type' , 'LEFT');
        $this->db->join('marital_status ms', 'ms.id=u.ms_id' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        $this->db->where('u.id', $this->userSeessID);
        $query = $this->db->get()->row();        

        return $query;   
    }


    public function get_trainee_official_info(){
        $this->db->select('u.id, u.first_office_id, u.first_desig_id, u.first_elected_year, u.first_attend_date, u.crrnt_office_id, u.crrnt_desig_id, u.crrnt_elected_year, u.crrnt_attend_date, u.elected_times, of.office_name as first_office_name, df.desig_name as first_desig_name, oc.office_name, dc.desig_name');
        $this->db->from('users u');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');

        $this->db->join('office of', 'of.id = u.first_office_id', 'LEFT');
        $this->db->join('designations df', 'df.id = u.first_desig_id', 'LEFT');

        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations dc', 'dc.id = u.crrnt_desig_id', 'LEFT');

        // $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        // $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        // $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        // $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        // $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        $this->db->where('u.id', $this->userSeessID);
        $query = $this->db->get()->row();        

        return $query;   
    }


    public function set_profile_image($id, $fileName){
        $data = array(
            'profile_img' => $fileName
            );
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return true;
    }










    public function get_info($id=NULL) {
        $this->db->select('id, first_name, phone, created_on, last_login, email');
        $this->db->from('users');
        $this->db->where('id', $this->userSeessID);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_userid_from_nid($id) {
        $query = $this->db->from('personal_datas')->where('national_id', $id)->get()->row()->id;
        // echo $this->db->last_query(); exit;
        return $query;
    }

}
