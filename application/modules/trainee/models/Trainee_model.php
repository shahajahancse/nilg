<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}

class Trainee_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // Gat all Public Representitive
    public function get_all_pr($limit=1000, $offset=0, $crrntOfficeID=NULL, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query
        $this->db->select('u.id, u.name_bn, ot.office_type_name, o.office_name AS current_office_name, dg.desig_name AS current_desig_name, u.nid, u.mobile_no, ut.upa_name_bn, uni.uni_name_bn, s.status_name');
        $this->db->from('users u');
        $this->db->join('office_type ot', 'ot.id=u.office_type', 'LEFT');
        $this->db->join('office o', 'o.id=u.crrnt_office_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');
        $this->db->join('data_status s', 's.id=u.status' , 'LEFT');

        // Filter                
        if($this->input->get('name') != NULL){
            $this->db->like('u.name_bn', $this->input->get('name'));
            $this->db->or_like('u.name_en', $this->input->get('name'));
        }
        if($this->input->get('nid')){
            $this->db->where('u.nid', bng2eng($this->input->get('nid')));
        }
        if($this->input->get('mobile')){
            $this->db->where('u.mobile_no', bng2eng($this->input->get('mobile')));
        }
        if($this->input->get('office')){
            $this->db->where('u.crrnt_office_id', $this->input->get('office'));
        }

        // Office Level
        if($crrntOfficeID){
            $this->db->where('u.crrnt_office_id', $crrntOfficeID);
        }
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
        $this->db->where('u.employee_type', 1);
        $this->db->where('u.is_verify', 1);
        $this->db->order_by('u.id', 'DESC');        
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // $result['rows'] = $query;

        // Count Query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');

        // Filter
        if($this->input->get('name') != NULL){
            $this->db->like('name_bn', $this->input->get('name'));
            $this->db->or_like('name_en', $this->input->get('name'));
        }
        if($this->input->get('nid')){
            $this->db->where('nid', bng2eng($this->input->get('nid')));
        }
        if($this->input->get('mobile')){
            $this->db->where('mobile_no', bng2eng($this->input->get('mobile')));
        }
        if($this->input->get('office')){
            $this->db->where('crrnt_office_id', $this->input->get('office'));
        }

        // Office Level
        if($crrntOfficeID){
            $this->db->where('crrnt_office_id', $crrntOfficeID);
        }
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
        $this->db->where('employee_type', 1);
        $this->db->where('is_verify', 1);

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    // Gat all Employee
    public function get_all_employee($limit=1000, $offset=0, $crrntOfficeID=NULL, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query
        $this->db->select('u.id, u.name_bn, ot.office_type_name, o.office_name AS current_office_name,  dg.desig_name AS current_desig_name, u.nid, u.mobile_no, ut.upa_name_bn, uni.uni_name_bn, s.status_name');
        $this->db->from('users u');
        $this->db->join('office_type ot', 'ot.id=u.office_type', 'LEFT');
        $this->db->join('office o', 'o.id=u.crrnt_office_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');
        $this->db->join('data_status s', 's.id=u.status' , 'LEFT');

        // Filter                
        if($this->input->get('name') != NULL){
            $this->db->like('u.name_bn', $this->input->get('name'));
            $this->db->or_like('u.name_en', $this->input->get('name'));
        }
        if($this->input->get('nid')){
            $this->db->where('u.nid', bng2eng($this->input->get('nid')));
        }
        if($this->input->get('mobile')){
            $this->db->where('u.mobile_no', bng2eng($this->input->get('mobile')));
        }
        if($this->input->get('office')){
            $this->db->where('u.crrnt_office_id', $this->input->get('office'));
        }
        
        // Office Level
        if($crrntOfficeID){
            $this->db->where('u.crrnt_office_id', $crrntOfficeID);
        }
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
        $this->db->where('u.employee_type !=', 1);
        $this->db->where('u.is_verify', 1);
        $this->db->order_by('u.id', 'DESC');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // $result['rows'] = $query;

        // Count Query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');

        // Filter
        if($this->input->get('name') != NULL){
            $this->db->like('name_bn', $this->input->get('name'));
            $this->db->or_like('name_en', $this->input->get('name'));
        }
        if($this->input->get('nid')){
            $this->db->where('nid', bng2eng($this->input->get('nid')));
        }
        if($this->input->get('mobile')){
            $this->db->where('mobile_no', bng2eng($this->input->get('mobile')));
        }
        if($this->input->get('office')){
            $this->db->where('crrnt_office_id', $this->input->get('office'));
        }

        // Office Level
        if($crrntOfficeID){
            $this->db->where('crrnt_office_id', $crrntOfficeID);
        }
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
        $this->db->where('employee_type !=', 1);
        $this->db->where('is_verify', 1);

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    public function get_details_info($id) {
        $query = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, oc.office_name, u.username, u.is_office, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.per_div_id, u.dis_id, u.per_dis_id, u.upa_id, u.per_upa_id, u.union_id, u.is_verify, u.status, u.is_applied, u.elected_times, u.crrnt_office_id, oc.office_name as current_office_name, u.crrnt_desig_id, cd.desig_name as current_desig_name, u.crrnt_elected_year, u.crrnt_attend_date, dept.dept_name, u.office_name as user_office_name, u.job_per_date, u.prl_date, u.retirement_date, u.profile_img, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.birth_place, u.signature, u.quota_id, u.religion_id, u.ms_id, u.first_office_id, u.first_desig_id, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, job_quota.quota_name, religion.religion_name, per_div.div_name_bn as per_div_bn, per_dis.dis_name_bn as per_dis_bn, per_upa.upa_name_bn as per_upa_bn,u.crrnt_dept_id, ds.status_name');
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
        // $this->db->select('nt.id, nt.nilg_course_id, nt.nilg_desig_id, c.course_title, d.desig_name, nt.nilg_batch_no, nt.nilg_training_start, nt.nilg_training_end');
        $this->db->select('
                nt.id, 
                nt.training_id, 
                nt.app_user_id, 
                nt.nilg_desig_id,
                c.course_title,
                d.desig_name, 
                t.course_id,
                t.participant_name,
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
        // dd($query['nilg_training']);
        

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

        // Leave
        /*$this->db->from('per_leave');
        $this->db->where('data_id', $id);
        $query['leave'] = $this->db->get()->result();  */

        // echo $this->db->last_query(); exit;
        return $query;
    }


    public function get_details_information($id) {
        $query = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, oc.office_name, u.username, u.is_office, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.per_div_id, u.dis_id, u.per_dis_id, u.upa_id, u.per_upa_id, u.union_id, u.is_verify, u.status, u.is_applied, u.elected_times, u.crrnt_office_id, oc.office_name as current_office_name, u.crrnt_desig_id, cd.desig_name as current_desig_name, u.crrnt_elected_year, u.crrnt_attend_date, dept.dept_name, u.office_name as user_office_name, u.job_per_date, u.prl_date, u.retirement_date, u.profile_img, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.birth_place, u.signature, u.quota_id, u.religion_id, u.ms_id, u.first_office_id, u.first_desig_id, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, job_quota.quota_name, religion.religion_name, per_div.div_name_bn as per_div_bn, per_dis.dis_name_bn as per_dis_bn, per_upa.upa_name_bn as per_upa_bn,u.crrnt_dept_id, ds.status_name');
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
        // $this->db->select('nt.id,nt.nilg_course_id, nt.nilg_desig_id, c.course_title, d.desig_name, nt.nilg_batch_no, nt.nilg_training_start, nt.nilg_training_end');
        $this->db->select('
                nt.id, 
                nt.training_id, 
                nt.app_user_id, 
                c.course_title,
                d.desig_name, 
                t.participant_name,
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

        // Leave
        /*$this->db->from('per_leave');
        $this->db->where('data_id', $id);
        $query['leave'] = $this->db->get()->result();  */

        // echo $this->db->last_query(); exit;
        return $query;
    }


    // Gat all Development Partner
    public function get_development_partner($limit=1000, $offset=0) {
        // result query
        $this->db->select('u.id, u.name_bn, u.nid, u.mobile_no, dg.desig_name as current_desig_name');
        $this->db->from('users u');
        // $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        // $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        // $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
        $this->db->where('u.office_type', 6);
        // $this->db->where('u.is_office', 0);
        // $this->db->where('u.employee_type !=', 1);
        $this->db->where('u.is_verify', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // $result['rows'] = $query;

        // Count Query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('office_type', 6);
        // $this->db->where('is_office', 0);
        // $this->db->where('employee_type !=', 1);
        $this->db->where('is_verify', 1);
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    // Gat all NILG Employee
    public function get_nilg_employee($limit=1000, $offset=0) {
        // result query
        $this->db->select('u.id, u.name_bn, u.nid, u.mobile_no, dg.desig_name as current_desig_name');
        $this->db->from('users u');
        // $this->db->join('office_type ot', 'ot.id=pd.office_type_id', 'LEFT');
        // $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        // $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        // $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
        $this->db->where('u.office_type', 7);
        // $this->db->where('u.is_office', 0);
        // $this->db->where('u.employee_type !=', 1);
        $this->db->where('u.is_verify', 1);
        $this->db->order_by('u.id', 'DESC');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // $result['rows'] = $query;

        // Count Query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('office_type', 7);
        // $this->db->where('is_office', 0);
        // $this->db->where('employee_type !=', 1);
        $this->db->where('is_verify', 1);
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    public function get_application_request($limit=1000, $offset=0, $crrntOfficeID=NULL, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query
        $this->db->select('u.id, u.name_bn, u.nid, u.mobile_no, et.employee_type_name, ut.upa_name_bn, uni.uni_name_bn, dg.desig_name as current_desig_name, ot.office_type_name');
        $this->db->from('users u');
        $this->db->join('employee_type et', 'et.id=u.employee_type', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type', 'LEFT');
        $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');

        // Office Level
        if($crrntOfficeID){
            $this->db->where('u.crrnt_office_id', $crrntOfficeID);
        }
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
        if($crrntOfficeID){
            $this->db->where('crrnt_office_id', $crrntOfficeID);
        }
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

    public function get_application_decline($limit=1000, $offset=0, $crrntOfficeID=NULL, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query
        $this->db->select('u.id, u.name_bn, u.nid, u.mobile_no, et.employee_type_name, ut.upa_name_bn, uni.uni_name_bn, dg.desig_name as current_desig_name, ot.office_type_name');
        $this->db->from('users u');
        $this->db->join('employee_type et', 'et.id=u.employee_type', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type', 'LEFT');
        $this->db->join('districts ds', 'ds.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=u.union_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');

        // Office Level
        if($crrntOfficeID){
            $this->db->where('u.crrnt_office_id', $crrntOfficeID);
        }
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
        $this->db->where('u.is_applied', 0);
        $this->db->where('u.is_verify', 2);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result();
        // $result['rows'] = $query;

        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');

        // Office Level
        if($crrntOfficeID){
            $this->db->where('crrnt_office_id', $crrntOfficeID);
        }
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
        $this->db->where('is_applied', 0);
        $this->db->where('is_verify', 2);

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_user_info($id){
        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.is_office, u.employee_type, u.nid, u.name_bn, u.nid, u.dob, u.mobile_no, u.email, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, oc.office_name, u.crrnt_office_id, oc.office_name as current_office_name, cd.desig_name as current_desig_name, u.office_name as user_office_name, u.created_on, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn');
        $this->db->from('users u');
        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type' , 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id' , 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id' , 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id' , 'LEFT');
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }


    public function get_info($id) {
        $query = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.is_office, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no,  u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, oc.office_name, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name,  u.office_name as user_office_name, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name');
        $this->db->from('users u');
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
        // $this->db->join('unions uinon', 'union.id=u.uni_id' , 'LEFT');
        $this->db->where('u.id', $id);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        //Education
        $this->db->select('ed.*, ex.exam_name, s.sub_name, b.board_name');
        $this->db->from('per_education ed');
        $this->db->join('exam_names ex', 'ex.id = ed.edu_exam_id', 'LEFT');
        $this->db->join('subjects s', 's.id = ed.edu_subject_id', 'LEFT');
        $this->db->join('boards b', 'b.id = ed.edu_board_id', 'LEFT');
        $this->db->where('ed.data_id', $id);
        $query['education'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        //Experience
        $this->db->select('e.*, o.org_name AS exp_org_name, dg.desig_name AS exp_desig_name');
        $this->db->from('per_experience e');
        $this->db->join('organizations o', 'o.id = e.exp_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = e.exp_desig_id', 'LEFT');
        $this->db->where('e.data_id', $id);
        $query['experience'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        //Promotion
        $this->db->select('p.*, o.org_name AS promo_org_name, dg.desig_name AS pro_desig_name');
        $this->db->from('per_promotion p');
        $this->db->join('organizations o', 'o.id = p.promo_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = p.promo_desig_id', 'LEFT');
        $this->db->where('p.data_id', $id);
        $query['promotion'] = $this->db->get()->result();

        //Leave
        $this->db->from('per_leave');
        $this->db->where('data_id', $id);
        $query['leave'] = $this->db->get()->result();

        // NILG Training
        $this->db->select('nt.*, t.course_title, t.course_duration, dg.desig_name AS nilg_training_desig_name');
        $this->db->from('per_nilg_training nt');
        $this->db->join('training_course t', 't.id = nt.nilg_course_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = nt.nilg_desig_id', 'LEFT');
        $this->db->where('nt.data_id', $id);
        $query['nilg_training'] = $this->db->get()->result();

        // Local Training
        $this->db->select('lot.*, t.course_title AS local_course_name');
        $this->db->from('per_local_org_training lot');
        $this->db->join('training_course t', 't.id = lot.local_course_id', 'LEFT');
        $this->db->where('lot.data_id', $id);
        $query['local_training'] = $this->db->get()->result();

        // Local Training
        $this->db->select('fot.*, t.course_title AS foreign_course_name');
        $this->db->from('per_foreign_org_training fot');
        $this->db->join('training_course t', 't.id = fot.foreign_course_id', 'LEFT');
        $this->db->where('fot.data_id', $id);
        $query['foreign_training'] = $this->db->get()->result();


        // echo $this->db->last_query(); exit;
        return $query;
    }




    /*
    public function get_all_data_sheet($limit=1000, $offset=0, $office_id=NULL, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query
        $this->db->select('pd.*, dt.data_type_name, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name, uni.uni_name_bn, TIMESTAMPDIFF(YEAR,pd.date_of_birth,CURDATE()) AS age, ot.office_type_name');
        $this->db->from('personal_datas pd');
        $this->db->join('data_type dt', 'dt.id=pd.data_sheet_type', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=pd.office_type_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id=pd.union_id', 'LEFT');
        $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');

        // Office Level
        if($office_id){
            $this->db->where('pd.office_type_id', $office_id);
        }
        if($div_id){
            $this->db->where('pd.division_id', $div_id);
        }
        if($dis_id){
            $this->db->where('pd.district_id', $dis_id);
        }
        if($upa_id){
            $this->db->where('pd.upa_tha_id', $upa_id);
        }
        if($union_id){
            $this->db->where('pd.union_id', $union_id);
        }

        // Filtering
        if($this->input->get('data_type')){
            $this->db->where('pd.data_sheet_type', $this->input->get('data_type'));
        }

        if($this->input->get('nid') != NULL){
            $this->db->where('pd.national_id', bng2eng($this->input->get('nid')));
        }

        if($this->input->get('mobile') != NULL){
            $this->db->where('pd.telephone_mobile', bng2eng($this->input->get('mobile')));
        }

        if($this->input->get('name') != NULL){
            $this->db->like('pd.name_bangla', $this->input->get('name'));
        }

        if($this->input->get('status') != NULL){
            $this->db->like('pd.status', $this->input->get('status'));
        }else{
            $this->db->where('pd.status', 1);
        }
        // if($this->input->get('designation') != NULL){
        //     $this->db->where('pd.curr_desig_id', $this->input->get('designation'));
        // }

        // if($this->input->get('gender') != NULL){
        //     $this->db->where('pd.gender', $this->input->get('gender'));
        // }
        // $this->db->where('pd.status', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result['rows']  = $this->db->get()->result_array();
        // $result['rows'] = $query;


        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('personal_datas');

        // Office Level
        if($office_id){
            $this->db->where('office_type_id', $office_id);
        }
        if($div_id){
            $this->db->where('division_id', $div_id);
        }
        if($dis_id){
            $this->db->where('district_id', $dis_id);
        }
        if($upa_id){
            $this->db->where('upa_tha_id', $upa_id);
        }
        if($union_id){
            $this->db->where('union_id', $union_id);
        }

        // Filtering
        if($this->input->get('data_type')){
            $this->db->where('data_sheet_type', $this->input->get('data_type'));
        }

        if($this->input->get('nid') != NULL){
            $this->db->where('national_id', bng2eng($this->input->get('nid')));
        }

        if($this->input->get('mobile') != NULL){
            $this->db->where('telephone_mobile', bng2eng($this->input->get('mobile')));
        }

        if($this->input->get('name') != NULL){
            $this->db->like('name_bangla', $this->input->get('name'));
        }

        if($this->input->get('status') != NULL){
            $this->db->like('status', $this->input->get('status'));
        }else{
           $this->db->where('status', 1);
       }

       $tmp = $this->db->get()->result();
       $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

       return $result;
   }

   public function get_all_archive_data($limit=1000, $offset=0, $office_id=NULL, $div_id=NULL, $dis_id=NULL, $upa_id=NULL, $union_id=NULL) {

        // result query
    $this->db->select('pd.*, dt.data_type_name, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name, uni.uni_name_bn, TIMESTAMPDIFF(YEAR,pd.date_of_birth,CURDATE()) AS age, ot.office_type_name');
    $this->db->from('personal_datas pd');
    $this->db->join('data_type dt', 'dt.id=pd.data_sheet_type', 'LEFT');
    $this->db->join('office_type ot', 'ot.id=pd.office_type_id', 'LEFT');
    $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
    $this->db->join('unions uni', 'uni.id=pd.union_id', 'LEFT');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');

    if($office_id){
        $this->db->where('pd.office_type_id', $office_id);
    }
    if($div_id){
        $this->db->where('pd.division_id', $div_id);
    }
    if($dis_id){
        $this->db->where('pd.district_id', $dis_id);
    }
    if($upa_id){
        $this->db->where('pd.upa_tha_id', $upa_id);
    }
    if($union_id){
        $this->db->where('pd.union_id', $union_id);
    }

    if($this->input->get('data_type')){
        $this->db->where('pd.data_sheet_type', $this->input->get('data_type'));
    }


    if($this->input->get('nid') != NULL){
        $this->db->where('pd.national_id', $this->input->get('nid'));
    }

    if($this->input->get('mobile') != NULL){
        $this->db->where('pd.telephone_mobile', $this->input->get('mobile'));
    }

    if($this->input->get('name') != NULL){
        $this->db->like('pd.name_bangla', $this->input->get('name'));
    }

    $this->db->where('pd.status', 7);
    $query = $this->db->get()->result_array();

        // echo $this->db->last_query(); exit;
    return $query;
}

public function get_all_data_by_org_type($typeID, $org_type_id) {

        // result query
        // $this->db->select('pd.id, pd.data_sheet_type, pd.name_bangla, pd.national_id, o.org_name, o.org_type_id, ot.type_name, dg.desig_name');
    $this->db->select('COUNT(*) as org_count');
    $this->db->from('personal_datas pd');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('organization_type ot', 'ot.id=o.org_type_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.data_sheet_type', $typeID);
    $this->db->where('o.org_type_id', $org_type_id);

    $query = $this->db->get()->result_array();
        // echo $this->db->last_query(); exit;
    return $query;
}

public function get_not_yet_training() {


        // result query
    $this->db->select('pd.id, pd.name_bangla, pd.national_id, pd.present_add, pd.gender, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name');
    $this->db->from('personal_datas pd');
    $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.id not in (SELECT data_sheet_id FROM `trainers` GROUP BY data_sheet_id)', NULL, FALSE);

    if($this->input->get('national_id') != NULL){
        $this->db->where('pd.national_id', $this->input->get('national_id'));
    }

    if($this->input->get('district') != NULL){
        $this->db->where('pd.district_id', $this->input->get('district'));
    }

    if($this->input->get('upazilas') > '0'){
        $this->db->where('pd.upa_tha_id', $this->input->get('upazilas'));
    }

    if($this->input->get('designation') != NULL){
        $this->db->where('pd.curr_desig_id', $this->input->get('designation'));
    }

    if($this->input->get('gender') != NULL){
        $this->db->where('pd.gender', $this->input->get('gender'));
    }

    $query = $this->db->get()->result_array();
        //echo $this->db->last_query(); exit;
    return $query;
}
public function got_training() {


        // result query
    $this->db->select('pd.id, pd.name_bangla, pd.national_id, pd.present_add, pd.gender, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name');
    $this->db->from('personal_datas pd');
    $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.id in (SELECT data_sheet_id FROM `trainers` GROUP BY data_sheet_id)', NULL, FALSE);

    if($this->input->get('national_id') != NULL){
        $this->db->where('pd.national_id', $this->input->get('national_id'));
    }

    if($this->input->get('district') != NULL){
        $this->db->where('pd.district_id', $this->input->get('district'));
    }

    if($this->input->get('upazilas') > '0'){
        $this->db->where('pd.upa_tha_id', $this->input->get('upazilas'));
    }

    if($this->input->get('designation') != NULL){
        $this->db->where('pd.curr_desig_id', $this->input->get('designation'));
    }

    if($this->input->get('gender') != NULL){
        $this->db->where('pd.gender', $this->input->get('gender'));
    }

    $query = $this->db->get()->result_array();
        //echo $this->db->last_query(); exit;
    return $query;
}

public function exam_count($id){
    $this->db->select('COUNT(*) as cnt');
    $this->db->from('per_education');
    $this->db->where('edu_exam_id', $id);
    $query = $this->db->get()->row();
    return $query->cnt;
}

public function exam_cnt(){
       // $query = $this->db->query('SELECT COUNT(id) as data_cnt, `edu_exam_id` FROM `per_education` WHERE 1 GROUP by edu_exam_id');
    $this->db->select('COUNT(per_education.id) as data_cnt, per_education.edu_exam_id, exam_names.exam_name');
    $this->db->from('per_education');
    $this->db->join('exam_names', 'exam_names.id = per_education.edu_exam_id', 'LEFT');
    $this->db->group_by('per_education.edu_exam_id');
    $query = $this->db->get()->result();
    return $query;
        // return $query;
}


public function get_all($select,$from,$where){
    $sql = "SELECT $select FROM $from where $where";

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
     return $query->result_array();
 }
}
public function get_cur_all($id, $from){

  $dt=$this->get_all('*',$from,'id='.$id);
  return $dt;
}
public function getcolumnlist(){
  $sql = "SHOW COLUMNS FROM personal_datas";

  $query = $this->db->query($sql);
  if ($query->num_rows() > 0) {
     return $query->result_array();
 }
}
public function get_districts_by_divisions(){
    $sql = "SELECT *, GROUP_CONCAT(id) as distids, GROUP_CONCAT(name_bn) as distnames FROM `districts` group by division_id ";

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
     return $query->result_array();
 }
}

    // public function get_district_by_div_id($id){
    //     $data['0'] = 'Select District';
    //     $this->db->select('id, dis_name_bn');
    //     $this->db->from('district');
    //     $this->db->where('div_id', $id);
    //     $this->db->where('status',1);
    //     $this->db->order_by('dis_name_bn', 'ASC');
    //     $query = $this->db->get();

    //     foreach ($query->result_array() AS $rows) {
    //         $data[$rows['id']] = $rows['dis_name_bn'];
    //     }

    //     return $data;
    // }

    // public function get_upa_tha_by_dis_id($id){
    //     $data['0'] = 'Select thana/upazila';
    //     $this->db->select('id, dis_id, upa_name_bn');
    //     $this->db->from('upazilas');
    //     $this->db->where('dis_id',$id);
    //     $this->db->where('status',1);
    //     $this->db->order_by('upa_name_bn', 'ASC');
    //     $query = $this->db->get();

    //     foreach ($query->result_array() AS $rows) {
    //         $data[$rows['id']] = $rows['upa_name_bn'];
    //     }

    //     return $data;
    // }

    public function get_organization_by_up_th_id($id){
        $data['0'] = 'Select Organization';
        $this->db->select('id, org_up_th_id, org_name');
        $this->db->from('organizations');
        $this->db->where('org_up_th_id', $id);
        $this->db->order_by('org_name', 'ASC');
        $query = $this->db->get();

            // echo $this->db->last_query(); exit;

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['org_name'];
        }
            // print_r($data); exit;
        return $data;
    }
    */

}
