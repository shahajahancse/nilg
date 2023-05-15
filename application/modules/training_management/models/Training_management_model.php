<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');  
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        // if(!$this->ion_auth->in_group('admin'))
            $this->db->where('tu.user_id', $this->userSessID);      
        
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('t.id', 'DESC');
        $this->db->group_by('t.id');
        // if($this->input->get('course_type')){
        //     $this->db->where('course_type', $this->input->get('course_type'));
        // }
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training_management t');  
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        // if(!$this->ion_auth->is_admin()){
            $this->db->where('tu.user_id', $this->userSessID);
        // }
        // if($this->input->get('course_type')){
        //     $this->db->where('course_type', $this->input->get('course_type'));
        // }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }    

    public function get_data_search($limit = 1000, $offset = 0, $search) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');  
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        // if(!$this->ion_auth->in_group('admin'))
            $this->db->where('tu.user_id', $this->userSessID);      
        
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('t.id', 'DESC');
        $this->db->group_by('t.id');
        $this->db->like('tc.course_title', $search);
        // if($this->input->get('course_type')){
        //     $this->db->where('course_type', $this->input->get('course_type'));
        // }
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training_management t');  
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        // if(!$this->ion_auth->is_admin()){
            $this->db->where('tu.user_id', $this->userSessID);
        // }
        // if($this->input->get('course_type')){
        //     $this->db->where('course_type', $this->input->get('course_type'));
        // }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }    


    public function get_data_admin($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('t.id', 'DESC');
        $this->db->group_by('t.id');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training_management t');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

     public function get_data_admin_search($limit = 1000, $offset = 0, $search) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('t.id', 'DESC');
        $this->db->group_by('t.id');
        $this->db->like('tc.course_title', $search);
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training_management t');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_info($id) {
        $result = array();
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');    
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');  
        $this->db->where('t.id', $id);
        $result['info'] =  $this->db->get()->row();
        

        $this->db->select('tu.*, u.office_name, u.designation');
        $this->db->from('training_users tu');        
        $this->db->join('users u', 'u.id = tu.user_id', 'LEFT');
        $this->db->where('tu.training_id', $id); 
        $this->db->where('tu.is_owner', 0);               
        $result['cc_list'] = $this->db->get()->result();

        return $result;
    }
    public function date_range_filter($start_date, $end_date, $training_id)
    {
        // $this->db->select('*');
        // $this->db->from('training_schedule');
        // $this->db->where('program_date >=' ,$a);   
        // $this->db->where('program_date <=' ,$b);   
        // $this->db->where('training_id', $c);   
        // $query =  $this->db->get()->result();

        //  return $query;



        $this->db->select('t.*, tr.trainer_name, tr.trainer_desig' );
        $this->db->from('training_schedule t');  
        $this->db->join('trainer_register tr', 'tr.id = t.trainer_id', 'LEFT');   
        $this->db->where('t.training_id', $training_id);
        $this->db->where('t.program_date >=' ,$start_date);   
        $this->db->where('t.program_date <=' ,$end_date);  
        $this->db->order_by('program_date', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_latest_id()
    {
       $this->db->select('t.*');
       $this->db->from('training_management t');
       $this->db->order_by('id', 'DESC');
       $result['info'] =  $this->db->get()->row();

       return $result;
    }

    public function get_training_info($trainingID){
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');      
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');  
        $this->db->where('t.id', $trainingID);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_course_coordinator($trainingID){
        $this->db->select('tu.*, u.office_name, u.designation');
        $this->db->from('training_users tu');        
        $this->db->join('users u', 'u.id = tu.user_id', 'LEFT');
        $this->db->where('tu.training_id', $trainingID);             
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_main_cc($trainingID) {
        $this->db->select('tu.*, u.office_name, u.designation');
        $this->db->from('training_users tu');
        $this->db->join('users u', 'u.id = tu.user_id', 'LEFT');
        $this->db->where('tu.training_id', $trainingID);
        $this->db->where('tu.is_owner', 1);
        $query = $this->db->get()->row();
        //echo $this->db->last_query();
        return $query;
    }

    public function get_participant_allowance($trainingID) {
        $this->db->select('tp.*, ds.national_id, ds.name_bangla, ds.office_type_id, o.org_name, dg.desig_name, div.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn, ds.telephone_mobile,');
        $this->db->from('training_participant tp');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->join('organizations o', 'o.id = ds.curr_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = ds.curr_desig_id', 'LEFT');
        $this->db->join('divisions div', 'div.id = ds.division_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = ds.district_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = ds.upa_tha_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = ds.union_id', 'LEFT');
        $this->db->where('tp.tran_mgmt_id', $trainingID);
        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        return $query;
    }

    public function get_participant_list($form_data) {
        $this->db->select('tp.*, ds.national_id, ds.name_bangla, ds.office_type_id, o.org_name, dg.desig_name, div.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn, pou.pou_name_bn, ds.telephone_mobile');
        $this->db->from('training_participant tp');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->join('organizations o', 'o.id = ds.curr_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = ds.curr_desig_id', 'LEFT');
        $this->db->join('divisions div', 'div.id = ds.division_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = ds.district_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = ds.upa_tha_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = ds.union_id', 'LEFT');
        $this->db->join('pourashava pou', 'pou.id = ds.pourashava_id', 'LEFT');
        $this->db->where('tp.tran_mgmt_id', $form_data['tran_mgmt_id']);
        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        return $query;
    }    

    public function get_participant_is_not_complete($trainingID) {
        $this->db->select('tp.*, ds.curr_desig_id');
        $this->db->from('training_participant tp');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->where('tp.tran_mgmt_id', $trainingID);
        $this->db->where('tp.is_complete', 0);
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_certificate($participantID) {
        $this->db->select('tp.*, ds.data_sheet_type, ds.name_bangla, ds.gender, ds.division_id, tm.participant_name, tm.course_id, tm.batch_no, tm.start_date, tm.end_date, tc.course_title, dg.desig_name, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn');
        $this->db->from('training_participant tp');
        $this->db->join('training_management tm', 'tm.id = tp.tran_mgmt_id', 'LEFT');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = ds.curr_desig_id', 'LEFT');
        // $this->db->join('divisions div', 'div.id = ds.division_id', 'LEFT'); div.div_name_bn,
        $this->db->join('districts dis', 'dis.id = ds.district_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = ds.upa_tha_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = ds.union_id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = tm.course_id', 'LEFT');
        // $this->db->where('tp.tran_mgmt_id', $trainingID);
        $this->db->where('tp.id', $participantID);
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        return $query;
    }
    
    public function get_participant_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('training_participant'); 
        $this->db->where('data_sheet_id', $form_data['data_sheet_id']);
        $this->db->where('tran_mgmt_id', $form_data['tran_mgmt_id']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_delete_data($table, $id) {
        $this->db->where('id', $id);
        $this->db->delete($table);
        return TRUE;
    }

    public function get_trainer_list(){
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('id, trainer_name');
        $this->db->from('trainer_register');
        $this->db->order_by('trainer_name', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['trainer_name'];
        }

        return $data;
    }

    public function get_trainer($id) {
        $this->db->select('*');
        $this->db->from('trainer_register');
        $this->db->where('id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_schedule($trainingID) {
        // result query
        $this->db->select('t.*, tr.trainer_name, tr.trainer_desig' );
        $this->db->from('training_schedule t');  
        $this->db->join('trainer_register tr', 'tr.id = t.trainer_id', 'LEFT');   
        $this->db->where('t.training_id', $trainingID);
        $this->db->order_by('program_date', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_schedule_with_trainer($trainingID) {
        // result query
        $this->db->select('t.*, tr.trainer_name, tr.trainer_desig' );
        $this->db->from('training_schedule t');  
        $this->db->join('trainer_register tr', 'tr.id = t.trainer_id', 'LEFT');   
        $this->db->where('t.training_id', $trainingID);
        $this->db->where('t.trainer_id !=', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_schedule_details($trainingID, $scheduleID) {
        // result query
        $this->db->select('t.*, tr.trainer_name, tr.trainer_desig, tr.trainer_org_name');
        $this->db->from('training_schedule t');  
        $this->db->join('trainer_register tr', 'tr.id = t.trainer_id', 'LEFT');   
        $this->db->where('t.training_id', $trainingID);
        $this->db->where('t.id', $scheduleID);
        $this->db->order_by('t.id', 'ASC');
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_honorarium($trainingID) {
        // result query
        $this->db->select('t.*, tr.id as trainer_id, tr.trainer_name, tr.trainer_desig');
        $this->db->from('training_schedule t');  
        $this->db->join('trainer_register tr', 'tr.id = t.trainer_id', 'LEFT');   
        // $this->db->join('training_management tm', 'tm.id = t.training_id', 'LEFT');   
        $this->db->where('t.trainer_id !=', 0);
        $this->db->where('t.training_id', $trainingID);
        $this->db->order_by('t.id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_schedule_item($id) {
        $this->db->select('ts.*, tr.trainer_name, tr.trainer_desig');
        $this->db->from('training_schedule ts');
        $this->db->join('trainer_register tr', 'tr.id = ts.trainer_id', 'LEFT');
        $this->db->where('ts.id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_participant_dd($trainingID){
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('ds.id, ds.name_bangla');
        $this->db->from('training_participant tp');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->where('tp.tran_mgmt_id', $trainingID);
        $this->db->order_by('ds.name_bangla', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['name_bangla'];
        }

        return $data;
    }

    public function get_feedback_course_result($trainingID) {
        // $this->db->select('*');        
        $this->db->select('*');
        $this->db->from('training_feedback_course');
        $this->db->where('training_id', $trainingID);
        $query =  $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_feedback_topic_result($trainingID, $topicID) {
        // $this->db->select('*');        
        $this->db->select('SUM(rate_concept_topic) AS concept_topic, SUM(rate_present_technique) AS present_technique, SUM(rate_use_tool) AS use_tool, SUM(rate_time_manage) AS time_manage, SUM(rate_que_ans_skill) AS skill, COUNT(id) as row_count');
        $this->db->from('training_feedback_topic');
        $this->db->where('training_id', $trainingID);
        $this->db->where('topic_id', $topicID);
        $query =  $this->db->get()->row();

        // echo $this->db->last_query(); exit;

        return $query;
    }


    public function get_coordinator(){
        $data[''] = '-- Select One --';
        $this->db->select('u.id, ug.group_id, CONCAT(u.office_name, " (", u.designation, ")") AS text');
        $this->db->join('users_groups ug', 'ug.user_id = u.id', 'left');
        $this->db->join('groups g', 'g.id = ug.user_id', 'left');
        // $this->db->where('ug.group_id', 9); 
        // $this->db->or_where_in('ug.group_id', 9);
        $this->db->having('ug.group_id', 9); 
        $this->db->having('u.id !=', $this->session->userdata('user_id'));
        // $this->db->or_like('u.office_name', $this->input->get("q")); 
        // $this->db->or_like('u.designation', $this->input->get("q")); 
        // $this->db->limit(15);            
        $query = $this->db->get("users u");

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['text'];
        }

        return $data;
    }

    // public function get_data_id($id) {
    //     return $this->db->select('id')->where('national_id', $id)->get('personal_datas')->row();
    // }

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
