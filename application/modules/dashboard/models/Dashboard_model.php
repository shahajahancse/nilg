<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}


    public function get_count_user($officeType=array(), $employeeType=NULL, $status=NULL, $gender=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('is_office', 0);
        $this->db->where('is_verify', 1);
        $this->db->where_not_in('office_type', array(8,9));
        $this->db->where('gender !=', NULL);
        $this->db->where('employee_type !=', NULL);

        if($officeType != NULL){
            $this->db->where_in('office_type', $officeType); 
        }
        if($employeeType != NULL){
            if($employeeType == 1){
                $this->db->where('employee_type', 1);    
            }elseif($employeeType == 2){
                $this->db->where('employee_type', 2);    
            }elseif($employeeType == 3){
                $this->db->where('employee_type', 3);    
            }elseif($employeeType == 'employee'){
                $this->db->where('employee_type !=', 1);    
            }
        }
        if($status != NULL){
            $this->db->where('status', $status);     
        }
        if($gender != NULL){
            $this->db->where('gender', $gender);     
        }
        $result = $this->db->get('users')->row();
        // echo $this->db->last_query(); exit;        
        return $result->count;
    }

    public function get_count_training($financing_id=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->where_not_in('financing_id', array(9));
        // $this->db->where('status', 3);

        if($financing_id != NULL){
            $this->db->where('financing_id', $financing_id); 
        }
        
        $result = $this->db->get('training')->row();
        // echo $this->db->last_query(); exit;        
        return $result->count;
    }

    public function get_count_office($officeType=NULL) {
        $this->db->select('COUNT(*) as count');
        // $this->db->where('is_published', 1);

        if($officeType != NULL){
            $this->db->where('office_type', $officeType); 
        }
        
        $result = $this->db->get('office')->row();
        // echo $this->db->last_query(); exit;        
        return $result->count;
    } 

    public function get_count_user_office($officeType=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('is_office', 1);

        if($officeType != NULL){
            $this->db->where('office_type', $officeType); 
        }
        
        $result = $this->db->get('users')->row();
        // echo $this->db->last_query(); exit;        
        return $result->count;
    }

    public function get_count_training_of_course() {
        $courseList = $this->db->get('course')->result();
        // dd($courseList);

        foreach ($courseList AS $value) {
            $data[$value->id] = array($value->course_title, $this->get_count_course($value->id));
        }
        // dd($data);

        return $data;
    }

    public function get_count_course($courseID) {
        $result = 0;

        $this->db->select('COUNT(*) as count');
        $this->db->where('is_published', 1);
        $this->db->where('course_id', $courseID);        
        $result = $this->db->get('training');
        // echo $this->db->last_query(); exit;   

        if($result->num_rows() > 0){
            return $result->row()->count;
        }

        return $result;
    }

    public function get_users($limit = 1000, $offset = 0) {
        // Result Query
        $this->db->select('u.id, u.username, u.name_bn, u.mobile_no, o.office_name, dg.desig_name, u.last_login, u.active, o.office_name, FROM_UNIXTIME(u.last_login) AS last_login');
        $this->db->from('users u');
        $this->db->join('office o', 'o.id=u.crrnt_office_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('u.id', 'DESC');        
        if($this->input->get('name') != NULL){
            $this->db->like('u.name_bn', $this->input->get('name'));
            $this->db->or_like('u.name_en', $this->input->get('name'));
        }
        if($this->input->get('mobile')){
            $this->db->where('u.mobile_no', bng2eng($this->input->get('mobile')));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        if($this->input->get('office') != NULL){
            $this->db->where('u.crrnt_office_id', $this->input->get('office')); 
        }
        $this->db->where('u.id !=', 3);

        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users u');
        if($this->input->get('name') != NULL){
            $this->db->like('name_bn', $this->input->get('name'));
            $this->db->or_like('name_en', $this->input->get('name'));
        }
        if($this->input->get('mobile')){
            $this->db->where('mobile_no', bng2eng($this->input->get('mobile')));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('username', $this->input->get('username')); 
        }
        if($this->input->get('username') != NULL){
            $this->db->where('username', $this->input->get('username')); 
        }
        if($this->input->get('office') != NULL){
            $this->db->where('crrnt_office_id', $this->input->get('office')); 
        }
        $this->db->where('u.id !=', 3); 
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }


    /*public function createViewCourse(){
        $this->db->query('CREATE VIEW view_name AS SELECT column_name(s) FROM table_name WHERE condition');    
    }*/

    

    /*
    public function get_all_reg_month_wise($datatype){
        $res = array(); 
        $sql = "SELECT MONTH(created) as month, count(*) as count_jono, data_sheet_type FROM personal_datas where data_sheet_type='$datatype' and YEAR(created)=".date('Y')." GROUP BY MONTH(created)"; //exit;
        $query = $this->db->query($sql);
        // echo $this->db->last_query(); exit;

        if ($query->num_rows() > 0) {
            $res=$query->result();
        }

        $returnarr=array();
        for($i=1;$i<=12;$i++){
            $returnarr[$i]=0;
        }

        for($i=0;$i<sizeof($res);$i++){
            $returnarr[$res[$i]->month]=$res[$i];
        } 

        return $returnarr;
    } 

    public function get_all_prosikjon_month_wise(){
        $sql = "SELECT MONTH(entry_date) as month,count(*) as count_prosikhon FROM `trainers` GROUP BY MONTH(entry_date)";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $res=$query->result();
        }

        $returnarr=array();
        for($i=1;$i<=12;$i++)
        {
            $returnarr[$i]=0;
        } 
        for($i=0;$i<sizeof($res);$i++)
        {
            $returnarr[$res[$i]->month]=$res[$i];
        }

        return $returnarr;
    }
    */    

    /********************** Course Registration ********************/
    /***************************************************************/

    public function get_course_info($id) {
        $this->db->select('t.id, t.training_title, t.start_date, t.end_date, t.reg_start_date, t.reg_end_date, c.course_title, o.office_name');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');      
        $this->db->join('office o', 'o.id = t.office_id', 'LEFT');
        $this->db->where('t.id', $id);
        $query = $this->db->get()->row();        

        return $query;
    }    

    public function get_training_circular() {
        $today = date('Y-m-d');

        $this->db->select('t.id, t.training_title, t.start_date, t.end_date, c.course_title, o.office_name');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
        $this->db->join('office o', 'o.id = t.office_id', 'LEFT');
        // $this->db->where('t.reg_start_date', $today);
        // $this->db->where('t.reg_start_date <=', $today);
        $this->db->where('t.reg_end_date >=', $today);
        $this->db->where('t.is_published', 1);
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;  

        return $query;
    }    

    public function get_my_registration_apply($trainingID){
        $result = $this->db->select('COUNT(*) as count')->where('training_id', $trainingID)->where('app_user_id', $this->userID)->get('training_participant')->row()->count;
        return $result > 0 ? true:false;
    }

    public function get_my_training() {
        $this->db->select('tp.*, t.start_date, t.end_date, t.handbook');
        $this->db->from('training_participant tp');
        $this->db->join('training t', 't.id = tp.training_id', 'RIGHT');   
        $this->db->where('tp.app_user_id', $this->userID);
        $this->db->where('tp.is_verified', 1);
        $this->db->order_by('t.id', 'DESC');
        $query = $this->db->get()->result();

        // echo $this->db->last_query(); exit;

        return $query;
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


    /**************************** Trainee **************************/
    /***************************************************************/

    public function get_trainee_all_data() {
        $id = $this->session->userdata('user_id');
        $query = array();
        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name,  u.office_name as user_office_name, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, u.job_per_date, u.prl_date, u.retirement_date');
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


    public function get_trainee_general_info(){
        $id = $this->session->userdata('user_id');

        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, u.per_div_id, u.per_dis_id, u.per_upa_id, u.ms_id, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, o.office_name, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name, u.office_name as user_office_name, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, u.job_per_date, u.prl_date, u.retirement_date');
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
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();        

        return $query;   
    }


    public function get_trainee_offical_data(){
        $id = $this->session->userdata('user_id');
        
        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.employee_type, et.employee_type_name, u.nid, u.name_bn, u.name_en, u.nid, u.dob, u.gender, u.mobile_no, u.email, u.father_name, u.mother_name, u.permanent_add, u.present_add, u.per_road_no, u.per_po, u.per_pc, u.ms_id, ms.marital_status_name, u.son_no, u.daughter_no, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, o.office_name, u.elected_times, u.crrnt_office_id, u.crrnt_elected_year, u.crrnt_attend_date, oc.office_name as current_office_name, cd.desig_name as current_desig_name,  u.office_name as user_office_name, u.created_on, u.modified, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name, u.job_per_date, u.prl_date, u.retirement_date');
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
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();        

        return $query;   
    }


    public function get_mandatory_info(){
        $id = $this->session->userdata('user_id');

        $this->db->select('name_en, nid, dob, gender, mobile_no, father_name, mother_name, permanent_add, present_add, per_pc, per_div_id, per_dis_id, per_upa_id, ms_id, crrnt_office_id, crrnt_desig_id');
        $this->db->from('users');
        $this->db->where('id', $id);

        $query = $this->db->get()->row(); 
        return $query;   
    }

    public function get_office_info() {
        $this->db->select('u.id, u.username, ot.office_type_name, u.office_type_id, u.crrnt_office_id, o.office_name, u.office_name as user_office_name, FROM_UNIXTIME(u.last_login) AS last_login, u.div_id, u.dis_id, u.upa_id, u.union_id, dv.div_name_bn, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn');
        $this->db->from('users u');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id = u.office_type', 'LEFT');
        $this->db->join('divisions dv', 'dv.id = u.div_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = u.union_id', 'LEFT');
        $this->db->where('u.id', $this->userID);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query;
    }


    /*
    public function get_statistics_data(){
        $this->db->select('*');
        $this->db->from('statistics');        
        $query = $this->db->get()->result();

        return $query;
    }
    
    public function get_count_training($financed_by) {
        $this->db->select('COUNT(*) as count');
        $this->db->from('training_management');
        $this->db->where('financing_id', $financed_by);         
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query->count;
    }

    public function get_count_datasheet($dataType, $officeType=NULL, $gender=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->from('personal_datas');
        $this->db->where('data_sheet_type', $dataType); 
        if($officeType != NULL){
            $this->db->where('office_type_id', $officeType);     
        }
        if($gender != NULL){
            $this->db->where('gender', $gender);     
        }
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query->count;
    }

    public function get_count_data($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {        
        $this->db->select('COUNT(*) as count');
        // $this->db->where('member_id !=', 0);
        // if($region_id != NULL){
        //     $this->db->where('sc_region_id', $region_id); 
        // }
        // if($sc_district_id != NULL){
        //     $this->db->where('sc_district_id', $sc_district_id);     
        // }
        // if($sc_upa_tha_id != NULL){
        //     $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);     
        // }
        // if($sc_group_id != NULL){
        //     $this->db->where('sc_group_id', $sc_group_id);     
        // }
        $tmp = $this->db->get('personal_datas')->result();
        // echo $this->db->last_query(); exit;        
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_by_data_type($memberType) {
        $result = array();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('personal_datas');
        $this->db->where('data_sheet_type', $memberType); 
        $q = $this->db->get()->result();

        $result = $q;
        $result['count'] = $result[0]->count;

        return $result;
    }    

    public function get_all($select,$from,$where){
        $sql = "SELECT $select FROM $from where $where";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    */

}
