<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }    

    public function get_training_data($limit=1000, $offset=0, $officeID=NULL) {
        // result query
        // $this->db->select('t.id, t.training_title, t.batch_no, t.start_date, t.end_date, c.course_title, f.finance_name');
        $this->db->select('t.*, tt.training_type, c.course_title, f.finance_name, o.office_name');
        $this->db->from('training t');  
        $this->db->join('office o', 'o.id = t.office_id', 'LEFT');
        $this->db->join('training_type tt', 'tt.id = t.course_type', 'LEFT');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');        
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT'); 
        if($officeID != NULL){
            $this->db->where('t.office_id', $officeID);
        }

        //search
        if(!empty($_GET['course_id'])){
            $this->db->like('t.course_id', $_GET['course_id']);                      
        } 
        if(!empty($_GET['division_id'])){
            $this->db->like('t.division_id', $_GET['division_id']);                      
        }  
        if(!empty($_GET['district_id'])){
            $this->db->like('t.district_id', $_GET['district_id']);                      
        }  
        if(!empty($_GET['upazila_id'])){
            $this->db->like('t.upazila_id', $_GET['upazila_id']);                      
        }     
           

        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('t.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        // dd($result['rows']);

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training t');  
        if($officeID != NULL){
            $this->db->where('office_id', $officeID);            
        }

        //search
        if(!empty($_GET['course_id'])){
            $this->db->like('t.course_id', $_GET['course_id']);                      
        } 
        if(!empty($_GET['division_id'])){
            $this->db->like('t.division_id', $_GET['division_id']);                      
        }  
        if(!empty($_GET['district_id'])){
            $this->db->like('t.district_id', $_GET['district_id']);                      
        }  
        if(!empty($_GET['upazila_id'])){
            $this->db->like('t.upazila_id', $_GET['upazila_id']);                      
        }   

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }  

    public function get_data($limit=1000, $offset=0, $officeID=NULL, $district=NULL, $upazila=NULL, $search=NULL) {
        // result query
        // $this->db->select('t.id, t.training_title, t.batch_no, t.start_date, t.end_date, c.course_title, f.finance_name');
        $this->db->select('t.*, tt.training_type, c.course_title, f.finance_name, o.office_name');
        $this->db->from('training t');  
        $this->db->join('office o', 'o.id = t.office_id', 'LEFT');
        $this->db->join('training_type tt', 'tt.id = t.course_type', 'LEFT');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');        
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT'); 
         //search
        if($search != NULL){
            $this->db->like('c.course_title', $search);                      
        }
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('t.id', 'DESC');
        // $this->db->group_by('t.id');
        if($officeID != NULL){
            $this->db->where('t.office_id', $officeID);
        }
        if($district != NULL){
            $this->db->where('t.district_id', $district);            
        }
        if($upazila != NULL){
            $this->db->where('t.upazila_id', $upazila);
        }
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training t');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        if($officeID != NULL){
            $this->db->where('office_id', $officeID);            
        }
        if($district != NULL){
            $this->db->where('district_id', $district);            
        }
        if($upazila != NULL){
            $this->db->where('upazila_id', $upazila);
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }  

    public function get_training_info($trainingID){
        $this->db->select('t.*, c.course_title, ct.ct_name, f.finance_name, o.office_name, dis.dis_name_bn, upa.upa_name_bn, cert.template_title');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');      
        $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');      
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');  
        $this->db->join('districts dis', 'dis.id = t.district_id', 'LEFT');  
        $this->db->join('upazilas upa', 'upa.id = t.upazila_id', 'LEFT');  
        $this->db->join('certificate_template cert', 'cert.id = t.certificate_id', 'LEFT');  
        // $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');  
        $this->db->join('office o', 'o.id = t.office_id', 'LEFT');  
        $this->db->where('t.id', $trainingID);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_info($trainingID) {        
        $this->db->select('t.*, c.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');      
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');  
        $this->db->where('t.id', $trainingID);
        $result = $this->db->get()->row();                

        return $result;
    }

    public function get_training_material($trainingID) {        
        $this->db->select('t.*, m.material_name');
        $this->db->from('training_material t');
        $this->db->join('material m', 'm.id = t.tm_id', 'LEFT');    
        $this->db->where('t.training_id', $trainingID);
        $result = $this->db->get()->result();              

        return $result;
    }

    public function get_course_coordinator($trainingID){
        $this->db->select('tc.*, u.name_bn, d.course_designation_name');
        $this->db->from('training_coordinator tc');        
        $this->db->join('users u', 'u.id = tc.user_id', 'LEFT');
        $this->db->join('course_designation d', 'd.id = tc.course_desig_id', 'LEFT');
        $this->db->where('tc.training_id', $trainingID);             
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_duplicate_info($trainingID) {        
        $this->db->select('t.*, c.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');  
        $this->db->where('t.id', $trainingID);
        $result['info'] = $this->db->get()->row();                

        return $result;
    }

    // Participant List
    public function get_applicant($trainingID){
        // Applicant List
        $this->db->select('p.*, u.name_bn, u.nid');
        $this->db->from('training_participant p');
        $this->db->join('users u', 'u.id = p.app_user_id', 'LEFT');    
        $this->db->where('p.training_id', $trainingID);
        $this->db->order_by('p.so', 'ASC');
        // $this->db->where('p.is_apply', 1);
        // $this->db->where('p.app_user_id !=', NULL);
        $result = $this->db->get()->result();

        return $result;
    }

    public function get_participant_info($id){
        // Applicant List
        $this->db->select('p.*, u.name_bn, u.nid');
        $this->db->from('training_participant p');
        $this->db->join('users u', 'u.id = p.app_user_id', 'LEFT');    
        $this->db->where('p.id', $id);
        // $this->db->where('p.is_verified', 0);
        // $this->db->where('p.app_user_id !=', NULL);
        $result = $this->db->get()->row();

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

    public function get_applicant_info($id){
        $this->db->select('tp.*, t.batch_no, t.start_date, t.end_date, u.id as user_id,  u.username, u.is_office, u.office_type, u.employee_type, u.name_bn, u.name_en, u.father_name, u.mother_name, u.nid, u.mobile_no, u.email, u.dob, u.crrnt_office_id, u.crrnt_desig_id, u.div_id, u.dis_id, u.upa_id, u.union_id, u.created_on, u.modified, e.employee_type_name, dept.dept_name, oc.office_name as current_office_name, u.crrnt_desig_id, cd.desig_name as current_desig_name, u.crrnt_elected_year, u.crrnt_attend_date, u.job_per_date, u.prl_date, u.retirement_date, u.first_office_id, u.first_desig_id, u.first_elected_year, u.first_attend_date, of.office_name as first_office_name, df.desig_name as first_desig_name');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->join('training t', 't.id = tp.training_id', 'LEFT');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');

        $this->db->join('office oc', 'oc.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('department dept', 'dept.id = u.crrnt_dept_id', 'LEFT');
        $this->db->join('office of', 'of.id = u.first_office_id', 'LEFT');
        $this->db->join('designations df', 'df.id = u.first_desig_id', 'LEFT');

        $this->db->where('tp.id', $id);
        $query = $this->db->get()->row();        

        return $query;   
    }

    public function get_application_by_training_id($trainingID) {        
        $this->db->select('COUNT(*) as count');
        $this->db->where('training_id', $trainingID);
        $this->db->where('is_verified', 0);
        $tmp = $this->db->get('training_participant')->result();

        // echo $this->db->last_query(); exit;        
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_participant_list($trainingID) {
        // dd($trainingID);
        $this->db->select('tp.*, u.name_bn, u.nid, u.mobile_no, u.email, u.crrnt_office_id, o.office_name, d.desig_name, upa.upa_name_bn, dis.dis_name_bn');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        // $this->db->join('pourashava p', 'p.id = u.per_po', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = u.upa_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = u.dis_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
        if($this->input->get('office_id')){
            $this->db->where('u.crrnt_office_id', $this->input->get('office_id'));
        }
        $this->db->where('tp.is_verified', 1);
        $this->db->order_by('tp.so', 'ASC');
        // $this->db->order_by('u.dis_id', 'ASC');

        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        return $query;
    }  


    public function get_participant_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('training_participant'); 
        $this->db->where('app_user_id', $form_data['app_user_id']);
        $this->db->where('training_id', $form_data['training_id']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_training_mark($trainingID){
        // Applicant List
        $this->db->select('tm.*, es.subject_name');
        $this->db->from('training_mark tm');
        $this->db->join('evaluation_subject es', 'es.id = tm.subject_id', 'LEFT');    
        $this->db->where('tm.training_id', $trainingID);
        $result = $this->db->get()->result();

        return $result;
    }

    public function get_training_mark_total($trainingID){
        // Applicant List
        $result = $this->db->select('SUM(mark) AS total')->where('training_id', $trainingID)->get('training_mark')->row()->total;

        return $result;
    }

    public function get_marksheet($trainingID, $userID){
        // Applicant List
        $this->db->select('m.mark, es.subject_name, tm.mark as set_training_mark');
        $this->db->from('marksheet m');
        $this->db->join('evaluation_subject es', 'es.id = m.es_id', 'LEFT');    
        $this->db->join('training_mark tm', 'tm.id = m.tm_id', 'LEFT');    
        $this->db->where('m.training_id', $trainingID);
        $this->db->where('m.user_id', $userID);
        $this->db->order_by('es_id', 'ASC');
        $result = $this->db->get()->result();

        return $result;
    }    

    
    public function get_user_info($userID) {        
        $this->db->select('id, name_bn');
        $this->db->from('users');
        $this->db->where('id', $userID);
        $result = $this->db->get()->row();                

        return $result;
    }

    public function get_batch_no($trainingID) {        
        $this->db->select('id, batch_no');
        $this->db->from('training');
        $this->db->where('id', $trainingID);
        $result = $this->db->get()->row();                

        return $result->batch_no;
    }

    public function get_max_course_no($lgiType){

        $this->db->select_max('course_no');
        $this->db->where('lgi_type', $lgiType);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('training');

        // echo $this->db->last_query(); exit;

        if ($result->num_rows() > 0)
        {
            $result = $result->row();            
            return $result->course_no+1;
        }

        return 1;
    }

    public function get_trainer_topic_avarage($trainingID, $topicID){
        // Get Sum of Topic Total Avarage of all Trainee of this topic       
        $totalAvarage = 0;

        $this->db->select('COUNT(id) as count_ids, SUM(topic_avgrage) AS topic_avgrage', FALSE);
        $this->db->where('training_id', $trainingID);
        $this->db->where('topic_id', $topicID);
        $result = $this->db->get('evaluation_trainer');
        // echo $this->db->last_query(); exit;

        if($result->num_rows() > 0){
            $data = $result->row();
            // dd($data);
            @$totalAvarage = $data->topic_avgrage/$data->count_ids; //exit;            
            return number_format($totalAvarage, 2);        
        }else{
            return 0;            
        }
    }

    public function get_assigned_topic()
    {
        // Result query
        $this->db->select('ts.*, t.training_title');
        $this->db->from('training_schedule ts');
        $this->db->join('training t', 't.id = ts.training_id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->userSessID);
        $this->db->order_by('ts.program_date', 'DESC');
        $result['rows'] = $this->db->get()->result();

        // Count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training_schedule');
        $this->db->where('trainer_id', $this->userSessID);
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_schedule_info($scheduleID)
    {
        // Schedule Inof
        $this->db->select('ts.*, t.training_title, t.course_id, u.name_bn, u.mobile_no, d.desig_name');
        $this->db->from('training_schedule ts');
        $this->db->join('training t', 't.id = ts.training_id', 'LEFT');
        $this->db->join('users u', 'u.id = ts.trainer_id', 'LEFT');   
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');     
        $this->db->where('ts.id', $scheduleID);
        $result = $this->db->get()->row();

        return $result;
    }

    public function get_documents_by_schedule($scheduleID){
        // Training Document List
        $this->db->select('*');
        $this->db->from('training_attachment');
        // $this->db->where('ta.uploader_id', $this->session->userdata('user_id'));
        $this->db->where('schedule_id', $scheduleID);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get()->result();

        return $result;
    }

    public function get_documents_info($documentID){        
        $this->db->select('*');
        $this->db->from('training_attachment');
        $this->db->where('id', $documentID);
        $result = $this->db->get()->row();

        return $result;
    }

    public function set_qrcode($id, $data) {
        // $data = array('qr_code' => $filename);
        $this->db->where('id', $id);
        $this->db->update('training', $data); 

        return true;
    }

    public function get_coordinate_training($limit=1000, $offset=0, $userID) {
        // Get Coordinating Training IDs
        $trainingIDs=[];
        $this->db->select('training_id');
        $this->db->from('training_coordinator');
        $this->db->where('user_id', $userID);        
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0){
            // dd($query->result_array());
            foreach ($query->result_array() as $value) {
                $trainingIDs[]=$value['training_id'];
            }

            // result query        
            $this->db->select('t.*, tt.training_type, c.course_title, f.finance_name, o.office_name');
            $this->db->from('training t');  
            $this->db->join('office o', 'o.id = t.office_id', 'LEFT');
            $this->db->join('training_type tt', 'tt.id = t.course_type', 'LEFT');
            $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
            $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT'); 
            $this->db->limit($limit);
            $this->db->offset($offset);        
            $this->db->order_by('t.id', 'DESC');
            $this->db->where_in('t.id', $trainingIDs);
            $result['rows'] = $this->db->get()->result();
            // echo $this->db->last_query(); exit;

            // count query
            $q = $this->db->select('COUNT(*) as count');
            $this->db->from('training t');  
            $this->db->where_in('id', $trainingIDs);
            $tmp = $this->db->get()->result();
            $result['num_rows'] = $tmp[0]->count;

            return $result;
        }  

        return 0;      
        // dd($trainingIDs);         
    }




    /*************************** Allowance, Honourium ***************************/
    /****************************************************************************/

    public function get_allowance($trainingID) {
        $this->db->select('tp.*, u.name_bn, u.nid, u.mobile_no, u.crrnt_office_id, o.office_name, d.desig_name, upa.upa_name_bn, dis.dis_name_bn, t.ta, t.da, t.tra_a, t.dress');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = u.upa_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = u.dis_id', 'LEFT');
        $this->db->join('training t', 't.id = tp.training_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
        if($this->input->get('office_id')){
            $this->db->where('u.crrnt_office_id', $this->input->get('office_id'));
        }
        $this->db->where('tp.is_verified', 1);
        $this->db->order_by('tp.so', 'ASC');
        $this->db->order_by('u.dis_id', 'ASC');

        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        return $query;
    }


    public function get_material($id){
        // $data['0'] = lang('select_district');
        $data = [];
        $this->db->select('tm.id, m.material_name');
        $this->db->from('training_material tm');
        $this->db->join('material m', 'm.id = tm.tm_id', 'LEFT');
        $this->db->where('tm.training_id', $id);
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['material_name'];
        }

        return $data;
    }













    public function get_data_admin($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training t');  
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
        $this->db->from('training t');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    /*public function get_info($id) {
        $result = array();
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training t');
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
    }*/

    

    /*public function get_course_coordinator($trainingID){
        $this->db->select('tu.*, u.office_name, u.designation');
        $this->db->from('training_users tu');        
        $this->db->join('users u', 'u.id = tu.user_id', 'LEFT');
        $this->db->where('tu.training_id', $trainingID);             
        $query = $this->db->get()->result();

        return $query;
    }*/

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




    /*
    public function get_participant_allowance($trainingID) {
        $this->db->select('tp.*, ds.national_id, ds.name_bangla, ds.office_type_id, o.org_name, dg.desig_name, div.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn, ds.telephone_mobile, u.*');
        $this->db->from('training_participant tp');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        // $this->db->join('organizations o', 'o.id = ds.curr_org_id', 'LEFT');
        
        $this->db->join('divisions div', 'div.id = ds.division_id', 'LEFT');
        
        
        $this->db->join('unions uni', 'uni.id = ds.union_id', 'LEFT');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('organizations o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = u.per_upa_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = u.per_dis_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
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
    */    

    public function get_participant_is_not_complete($trainingID) {
        $this->db->select('tp.*, u.crrnt_desig_id');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
        $this->db->where('tp.is_verified', 1);
        $this->db->where('tp.is_complete', 0);
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_mark_by_subject($trainingID, $userID, $subjectID){
        // Applicant List
        $this->db->select('id, mark');
        $this->db->from('marksheet');
        $this->db->where('training_id', $trainingID);
        $this->db->where('user_id', $userID);
        $this->db->where('es_id', $subjectID);
        $result = $this->db->get();
        // echo $this->db->last_query(); exit;
        if ($result->num_rows() > 0){
            return $result->row()->mark;        
        }

        return 0;
    }

    /*
    public function get_user_mark($trainingID, $userID)
    {
        // $this->data['subjects'] = $this->Training_model->get_training_mark($trainingID);
        // $this->data['user'] = $this->Training_model->get_user_info($userID);            
        $marksheet = $this->get_marksheet($trainingID, $userID);  

        $getMark=$totalMark=$point=0;
        $grade='অকৃতকার্য';
        foreach ($marksheet as $row) { 
            $getMark += $row->mark;
            $totalMark += $row->set_training_mark;
        }
        // Mark Percent
        // echo $totalMark; exit;
        if($getMark){
            $resultPercent = ($getMark*100)/$totalMark;
            $point = number_format($resultPercent, 2);
            $grade = $this->gradeInWords($point);    
        }
        
        // dd($data);

        return $resutl = array('get_mark' => $getMark, 'total_mark' => $totalMark, 'point' => $point, 'grade' => $grade);
        // return $data = [$getMark, $totalMark, $point, $grade]; 
    }

    function gradeInWords($grade) {
        switch ($grade) {
            case $grade <= 50:
            return 'অকৃতকার্য';
            break;
            case $grade <= 50.60 && $grade > 50 :
            return 'সি (চলতি মান)';
            break;
            case $grade <= 60.70 && $grade > 50.60:
            return 'বি (উচ্চ চলতি মান)';
            break;
            case $grade <= 70.80 && $grade > 60.70:
            return 'বি (সন্তোষজনক)';
            break;
            case $grade <= 80.85 && $grade > 70.80:
            return 'বি+ (ভাল)';
            break;
            case $grade <= 85.90 && $grade > 80.85:
            return 'এ (উত্তম)';
            break;
            case $grade <= 90.95 && $grade > 85.90:
            return 'এ (অতি উত্তম)';
            break;
            case $grade <= 95 && $grade > 90.95:
            return 'এ+ (অসাধারণ)';
            break;
            case $grade <= 100:
            return 'এ+ (অসাধারণ)';
            break;
            default:
            return '';
        }
    }
    */

    public function get_certificate($participantID) {
        $this->db->select('
                tp.*, 
                t.training_title, 
                t.course_id, 
                t.batch_no, 
                t.start_date, 
                t.end_date, 
                c.course_title, 
                dg.desig_name, 
                div.div_name_bn, 
                dis.dis_name_bn, 
                upa.upa_name_bn, 
                uni.uni_name_bn, 
                u.name_bn, 
                u.office_type, 
                t.certificate_text,
                t.signature
            ');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->join('training t', 't.id = tp.training_id', 'LEFT');
        // $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('divisions div', 'div.id = u.div_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = u.dis_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = u.union_id', 'LEFT');        
        // $this->db->where('tp.tran_mgmt_id', $trainingID);

        $this->db->where('tp.id', $participantID);
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_course_director($userID) {
        $this->db->select('id, name_bn, designation, signature');
        $this->db->from('users'); 
        // $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('id', $userID);
        $result = $this->db->get()->row();
        return $result;
    }    
    
    /*
    public function get_participant_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('training_participant'); 
        $this->db->where('data_sheet_id', $form_data['data_sheet_id']);
        $this->db->where('tran_mgmt_id', $form_data['tran_mgmt_id']);
        $result = $this->db->get()->result();
        return $result;
    }
    */

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
        $this->db->select('t.*, u.name_bn, dg.desig_name, u.designation');
        $this->db->from('training_schedule t');  
        $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');   
        $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('t.training_id', $trainingID);
        if($this->input->get('start_date') != NULL){
            $this->db->where('t.program_date >=' , $this->input->get('start_date'));   
        }
        if($this->input->get('end_date') != NULL){
            $this->db->where('t.program_date <=' , $this->input->get('end_date'));   
        }
        $this->db->order_by('t.program_date', 'ASC');
        $this->db->order_by('t.session_no', 'ASC');
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
        $this->db->select('t.*, u.name_bn, d.desig_name, o.office_name');
        $this->db->from('training_schedule t');  
        $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');  
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');   
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->where('t.training_id', $trainingID);
        $this->db->where('t.id', $scheduleID);
        $this->db->order_by('t.id', 'ASC');
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_honorarium($trainingID) {
        // result query
        $this->db->select('t.*, u.name_bn, d.desig_name, u.designation, tr.it_deduction');
        $this->db->from('training_schedule t');  
        $this->db->join('training tr', 'tr.id = t.training_id', 'LEFT');   
        $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');   
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');   
        // $this->db->join('training tm', 'tm.id = t.training_id', 'LEFT');   
        $this->db->where('t.trainer_id !=', 0);
        $this->db->where('t.is_honorarium', 'Yes');
        $this->db->where('t.training_id', $trainingID);
        $this->db->order_by('t.id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_schedule_item($id) {
        $this->db->select('ts.*, u.name_bn');
        $this->db->from('training_schedule ts');
        $this->db->join('users u', 'u.id = ts.trainer_id', 'LEFT');
        $this->db->where('ts.id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_participant_dd($trainingID){
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('u.id, u.name_bn, u.name_en');
        $this->db->from('training_participant tp');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
        $this->db->order_by('ds.name_bangla', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['name_bn'];
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


    // User Insert Script
    /*
    public function get_training_management(){
        $this->db->select('*');
        $this->db->from('training_management');        
        // $this->db->where('is_create', 0); 
        $this->db->order_by('id', 'ASC');
        // $this->db->limit(300);

        return $this->db->get()->result();
    }
    */

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
