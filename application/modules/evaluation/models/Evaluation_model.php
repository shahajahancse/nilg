<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function exists_trainer_evaluation_by_user($trainingID, $userID) {
        $this->db->select('id');
        $this->db->from('evaluation_trainer');
        $this->db->where('training_id', $trainingID);
        $this->db->where('participant_id', $userID);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        }else{
            return false;
        }
    }


    public function exists_marksheet_info($trainingID, $userID, $tmID) {
        $this->db->select('id, mark');
        $this->db->from('marksheet');
        $this->db->where('training_id', $trainingID);
        $this->db->where('user_id', $userID);
        $this->db->where('tm_id', $tmID);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function get_mark_info($id) {
        $this->db->select('m.id, m.mark, u.name_bn, es.subject_name');
        $this->db->from('marksheet m');
        $this->db->join('users u', 'u.id = m.user_id', 'LEFT');
        $this->db->join('evaluation_subject es', 'es.id = m.es_id', 'LEFT');
        $this->db->where('m.id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    /**************************** Trainee Panel *******************************
    ***************************************************************************/

    public function get_my_evaluation($limit=1000, $offset=0, $examType=NULL) {
        // comment 25-01-23
        /*$ids = [];
        // Get Trainee Training List
        $trainings = $this->get_my_trainings();
        // dd($trainings);
        foreach ($trainings as $value) {
            $ids[$value->id] = $value->training_id;
        }*/
        // comment 25-01-23
        // dd($ids);

        // result query
        $this->db->select('e.*, t.training_title, t.start_date, t.end_date, ct.ct_name, es.subject_name');

        $this->db->from('evaluation e');
        $this->db->join('training t', 't.id = e.training_id', 'LEFT');
        $this->db->join('training_participant tp', 'tp.training_id = e.training_id', 'LEFT'); // add new code  25-01-23

        $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');
        $this->db->join('training_mark tm', 'tm.id = e.training_mark_id', 'LEFT');
        $this->db->join('evaluation_subject es', 'es.id = tm.subject_id', 'LEFT');

        // $this->db->where_in('e.training_id', $ids); // comment 25-01-23

        $this->db->where('tp.is_verified', 1); // add new code 25-01-23
        $this->db->where('tp.app_user_id', $this->userID); // add new code 25-01-23
        $this->db->where('e.is_published', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        if($examType != NULL){
            $this->db->where('e.exam_type', $examType); // 1=PRE, 2=POST
        }
        $this->db->order_by('e.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation e');
        $this->db->join('training_participant tp', 'tp.training_id = e.training_id', 'LEFT'); // add new code 25-01-23
        // $this->db->where_in('training_id', $ids); // comment 25-01-23
        $this->db->where('tp.is_verified', 1); // add new code 25-01-23
        $this->db->where('tp.app_user_id', $this->userID); // add new code 25-01-23
        if($examType != NULL){
            $this->db->where('e.exam_type', $examType); // 1=PRE, 2=POST
        }
        $this->db->where('e.is_published', 1);
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    /*public function get_my_training() {
        $query = $this->db->select('training_id')->where('app_user_id', $this->userSessID)->where('is_verified', 1)->get('training_participant')->result();
        return $query;
    }*/

    public function get_my_training() {
        $this->db->select('tp.*, t.start_date, t.end_date');
        $this->db->from('training_participant tp');
        $this->db->join('training t', 't.id = tp.training_id', 'RIGHT');
        // $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT'); , ct.ct_name
        //$this->db->join('training_course c', 'c.id = t.course_id', 'LEFT'); //c.course_title
        $this->db->join('training_schedule ts', 'ts.training_id = tp.training_id', 'LEFT'); //ts.trainer_id != null
        $this->db->where('tp.app_user_id', $this->userID);
        $this->db->where('tp.is_verified', 1);
        $this->db->where('ts.trainer_id !=', 0);
        $this->db->order_by('t.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_my_trainings() {
        $this->db->select('id, training_id');
        $this->db->from('training_participant');
        $this->db->where('app_user_id', $this->userID);
        $this->db->where('is_verified', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        // dd($this->userID);

        echo $this->db->last_query(); exit;

        return $query;
    }


    public function get_training_not_completed() {
        // Get Session User Info
        $office = $this->Common_model->get_office_info_by_session();
        $officeID = $office->crrnt_office_id;
        // Training Coordinatior Group Role
        if($this->ion_auth->in_group('cc')){
            $trainingIDs = func_training_ids_cc($this->userSessID);
        }

        // Dorpdown List
        $data[''] = lang('select');
        $this->db->select('t.id, t.training_title, ct.ct_name');
        $this->db->from('training t');
        $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');
        $this->db->where('t.status !=', 3);
        if($this->ion_auth->in_group(array('uz', 'ddlg', 'nilg', 'admin'))){
            $this->db->where('t.office_id', $officeID);
        }
        if($this->ion_auth->in_group('cc')){
            if($trainingIDs){
                $this->db->where_in('t.id', $trainingIDs);
            }
        }
        $this->db->order_by('t.id', 'DESC');
        $query =  $this->db->get();
        // echo $this->db->last_query(); exit;

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = func_training_title($rows['id']); //$rows['training_title'].' ('.$rows['ct_name'].')';
        }

        return $data;
    }

    public function is_answer($evaluationID){
        // dd($evaluationID .' = '. $this->userSessID);
        $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation_question_answer');
        $this->db->where('eva_id', $evaluationID);
        $this->db->where('user_id', $this->userSessID);
        $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }

    public function is_answerd_course_evaluation($trainingID){
        $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation_course');
        $this->db->where('training_id', $trainingID);
        $this->db->where('participant_id', $this->userSessID);
        $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }

    public function get_evaluation($limit=1000, $offset=0, $examType=NULL, $officeID=NULL, $upa=NULL, $dis=NULL, $div=NULL) {
        // result query
        $this->db->select('e.*, t.training_title, t.start_date, t.end_date, ct.ct_name, es.subject_name, t.division_id, t.district_id, t.upazila_id');
        $this->db->from('evaluation e');
        $this->db->join('training t', 't.id = e.training_id', 'LEFT');
        $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');
        $this->db->join('training_mark tm', 'tm.id = e.training_mark_id', 'LEFT');
        $this->db->join('evaluation_subject es', 'es.id = tm.subject_id', 'LEFT');
        // $this->db->join('course c', 'c.id = e.course_id', 'LEFT'); // c.course_title
        $this->db->limit($limit);
        $this->db->offset($offset);

        $this->db->where_in('t.course_id', array(1,2,3,4, 7,8,11, 13,14,16, 18,19,21, 22,23,24));
        if(!empty($_GET['course_id'])){
            $this->db->where('e.course_id', $_GET['course_id']);
        }

        if($examType != NULL){
            $this->db->where('e.exam_type', $examType); // 1=PRE, 2=POST
        }
        if($officeID != NULL){
            $this->db->where('t.office_id', $officeID);
        }
        if($div != NULL){
            $this->db->where('t.division_id', $div);
        }
        if($dis != NULL){
            $this->db->where('t.district_id', $dis);
        }
        if($upa != NULL){
            $this->db->where('t.upazila_id', $upa);
        }
        $this->db->order_by('e.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation e');
        $this->db->join('training t', 't.id = e.training_id', 'LEFT');

        $this->db->where_in('t.course_id', array(1,2,3, 7,8,11, 13,14,16, 18,19,21, 22,23,24));
        if(!empty($_GET['course_id'])){
            $this->db->where('e.course_id', $_GET['course_id']);
        }

        if($examType != NULL){
            $this->db->where('e.exam_type', $examType); // 1=PRE, 2=POST
        }
        if($officeID != NULL){
            $this->db->where('t.office_id', $officeID);
        }
        if($div != NULL){
            $this->db->where('t.division_id', $div);
        }
        if($dis != NULL){
            $this->db->where('t.district_id', $dis);
        }
        if($upa != NULL){
            $this->db->where('t.upazila_id', $upa);
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }


    public function get_evaluation_coordinate($limit=1000, $offset=0, $examType=NULL) {
        // Get training IDs
        $trainingIDs = func_training_ids_cc($this->userSessID);

        if($trainingIDs){
            // result query
            $this->db->select('e.*, t.training_title, t.start_date, t.end_date, ct.ct_name, es.subject_name, t.division_id, t.district_id, t.upazila_id');
            $this->db->from('evaluation e');
            $this->db->join('training t', 't.id = e.training_id', 'LEFT');
            $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');
            $this->db->join('training_mark tm', 'tm.id = e.training_mark_id', 'LEFT');
            $this->db->join('evaluation_subject es', 'es.id = tm.subject_id', 'LEFT');
            // $this->db->join('course c', 'c.id = e.course_id', 'LEFT'); // c.course_title
            $this->db->limit($limit);
            $this->db->offset($offset);
            if($examType != NULL){
                $this->db->where('e.exam_type', $examType); // 1=PRE, 2=POST
            }
            $this->db->where_in('e.training_id', $trainingIDs);
            $this->db->order_by('e.id', 'DESC');
            $result['rows'] = $this->db->get()->result();
            // echo $this->db->last_query(); exit;

            // count query
            $q = $this->db->select('COUNT(*) as count');
            $this->db->from('evaluation');
            // $this->db->join('training t', 't.id = e.training_id', 'LEFT');
            if($examType != NULL){
                $this->db->where('exam_type', $examType); // 1=PRE, 2=POST
            }
            $this->db->where_in('training_id', $trainingIDs);
            $tmp = $this->db->get()->result();
            $result['num_rows'] = $tmp[0]->count;

            return $result;
        }

        return 0;
    }


    public function get_questions($id, $getEvId = NULL) {
        $this->db->select('*');
        $this->db->from('qbank');
        $this->db->where('office_type', $id);
        if ($getEvId != NULL) {
            $this->db->where_not_in('id', $getEvId);
        }
        if (!empty($_GET['hideid'])) {
           $this->db->where_not_in('id', $_GET['hideid']);
        }

        $q = $this->db->get();
        $questions = $q->result();

        $i=0;
        foreach($questions as $value){
            $questions[$i]->options = $this->q_option($value->id);
            $i++;
        }

        return $questions;
    }

    public function q_option($id){
        // Question Options
        $this->db->select('id, option_name');
        $this->db->from('qbank_option');
        $this->db->where('qbank_id', $id);
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_evaluation_details($id) {
        $this->db->select('e.*, t.training_title, t.start_date, t.end_date');
        $this->db->from('evaluation e');
        $this->db->join('training t', 't.id = e.training_id', 'LEFT');
        // $this->db->join('course c', 'c.id = e.course_id', 'LEFT'); //c.course_title
        $query = $this->db->where('e.id', $id)->get()->row();

        /*// Question Options
        $this->db->select('qo.id, qo.option_name');
        $this->db->from('evaluation_question eq');
        $this->db->join('qbank_option qo', 'qo.id = eq.question_id', 'LEFT');
        $this->db->where('eq.evaluation_id', $id);
        $query['options'] = $this->db->get()->result();*/

        return $query;
    }

    public function get_question_by_evaluation($id) {
        $this->db->select('q.id, q.question_type, q.question_title, eq.id as eq_id, eq.qnumber');
        $this->db->from('evaluation_question eq');
        $this->db->join('qbank q', 'q.id = eq.question_id', 'LEFT');
        $this->db->where('eq.evaluation_id', $id);
        $q = $this->db->get();
        $questions = $q->result();

        $i=0;
        $eq=0;
        foreach($questions as $value){
            $questions[$i]->options = $this->q_option($value->id);
            $i++;
            $eq = $eq + $value->qnumber;
        }

        return array('sum' => $eq, 'qs' => $questions);
    }

    public function get_question_answer_by_evaluation($id) {
        $this->db->select('eqa.id, eqa.que_id, eqa.que_type, eqa.answer, eqa.answer_mark, eqa.is_right, q.question_title, q.answer as right_answer');
        $this->db->from('evaluation_question_answer eqa');
        $this->db->join('qbank q', 'q.id = eqa.que_id', 'LEFT');
        $this->db->where('eqa.eva_id', $id);
        $this->db->where('user_id', $this->userSessID);
        $q = $this->db->get();
        $questions = $q->result();

        $i=0;
        foreach($questions as $value){
            $questions[$i]->options = $this->q_answer($value->que_id);
            $i++;
        }

        return $questions;
    }

    public function get_exam_participant($id) {
        $this->db->select('eqa.eva_id, eqa.created, u.id, u.name_bn, u.nid');
        $this->db->from('evaluation_question_answer eqa');
        $this->db->join('users u', 'u.id = eqa.user_id', 'LEFT');
        $this->db->where('eqa.eva_id', $id);
        $this->db->group_by('eqa.user_id');
        // $this->db->where('eqa.user_id', $this->userSessID);
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_answer_sheet_by_user($evaluationID, $userID) {
        $this->db->select('eqa.id, eqa.eva_id, eqa.que_id, eqa.que_type, eqa.answer, eqa.question_mark, eqa.answer_mark, eqa.is_right, q.question_title, q.answer as right_answer');
        $this->db->from('evaluation_question_answer eqa');
        $this->db->join('qbank q', 'q.id = eqa.que_id', 'LEFT');
        $this->db->where('eqa.eva_id', $evaluationID);
        $this->db->where('user_id', $userID);
        $questions = $this->db->get()->result();

        $i=0;
        foreach($questions as $value){
            $questions[$i]->options = $this->q_answer($value->que_id);
            $i++;
        }

        return $questions;
    }

    public function q_answer($id){
        // Question Options
        $this->db->select('id, option_name');
        $this->db->from('qbank_option');
        $this->db->where('qbank_id', $id);
        return $this->db->get()->result();
    }

    public function get_question_answer_by_user($evaID, $userID, $isRight=NULL){
        $this->db->select('
            SUM(question_mark) as question_mark,
            SUM(answer_mark) as answer_mark,
            SUM(CASE WHEN is_right = 1 THEN 1 ELSE 0 END ) AS is_right,
            SUM(CASE WHEN is_right = 2 THEN 1 ELSE 0 END ) AS is_wrong,
        ');
        $this->db->from('evaluation_question_answer');
        $this->db->where('eva_id', $evaID);
        $this->db->where('user_id', $userID);
        /*if ($isRight != NULL) {
            $this->db->where('is_right', $isRight);
        }*/
        $tmp = $this->db->get()->row();
        // $result = $tmp[0]->count;

        return $tmp;
    }

    public function get_answer_by_question($id){
        return $this->db->select('answer')->from('qbank')->where('id', $id)->get()->row();
    }

    public function get_training_mark_by_training_id($id, $markingType=NULL){
        // $data[''] = '--নির্বাচন করুন--';
        $data = [];
        $this->db->select('tm.id, es.subject_name');
        $this->db->from('training_mark tm');
        $this->db->join('evaluation_subject es', 'es.id = tm.subject_id', 'LEFT');
        $this->db->where('tm.training_id', $id);
        if($markingType != NULL){
            $this->db->where('tm.emt_id', $markingType);
        }
        $this->db->order_by('tm.id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['subject_name'];
        }

        return $data;
    }

    public function get_manual_mark_by_training($id){
        $data = [];
        $this->db->select('tm.id, es.subject_name');
        $this->db->from('training_mark tm');
        $this->db->join('evaluation_subject es', 'es.id = tm.subject_id', 'LEFT');
        $this->db->where('tm.training_id', $id);
        $this->db->where('tm.emt_id', 4);
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['subject_name'];
        }

        return $data;
    }

    public function get_course_evaluation_by_user($trainingID, $userID){
        // $userID != NULL? $userID : $this->userSessID;
        return $this->db->select('e.*, u.name_bn')
        ->from('evaluation_course e')
        ->join('users u', 'u.id = e.participant_id', 'LEFT')
        ->where('e.participant_id', $userID)
        ->where('e.training_id', $trainingID)
        ->get()->row();
    }

    public function get_marks($trainingID, $tmID, $userID){
        // $userID != NULL? $userID : $this->userSessID;
        return $this->db->select('id, mark')
        ->from('marksheet')
        ->where('training_id', $trainingID)
        ->where('tm_id', $tmID)
        ->where('user_id', $userID)
        ->get()->row();
    }

    public function get_course_evaluation_answer_by_question($trainingID, $question){
        // Applicant List
        // $this->db->select('e.id, e.participant_id, e.'.$question.', e.q1_if_not_course_topic_related, e.q2_if_not_participant_helpful, e.q3_if_not_professional_helpful, u.id as user_id, u.name_bn, u.nid');
        $this->db->select('e.*, u.id as user_id, u.name_bn, u.nid');
        $this->db->from('evaluation_course e');
        $this->db->join('users u', 'u.id = e.participant_id', 'LEFT');
        $this->db->where('e.training_id', $trainingID);
        // $this->db->where('p.is_verified', 0);
        // $this->db->where('p.app_user_id !=', NULL);
        $result = $this->db->get()->result();

        return $result;
    }


    public function get_participant_course_evaluation_by_training_id($trainingID) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('training_id', $trainingID);
        $tmp = $this->db->get('evaluation_course')->result();

        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_course_evaluation_participants($trainingID){
        // Applicant List
        $this->db->select('e.id, e.participant_id, e.training_id, e.created, u.id as user_id, u.name_bn, u.nid');
        $this->db->from('evaluation_course e');
        $this->db->join('users u', 'u.id = e.participant_id', 'LEFT');
        $this->db->where('e.training_id', $trainingID);
        // $this->db->where('p.is_verified', 0);
        // $this->db->where('p.app_user_id !=', NULL);
        $result = $this->db->get()->result();

        return $result;
    }

    public function get_upcomming_training($limit=1000, $offset=0, $type=NULL, $officeID=NULL, $district=NULL, $upazila=NULL) {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        // result query
        $this->db->select('t.*, ct.ct_name, c.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->where('t.status', 1); // 1=UpComming, 2=OnGoing, 3=Completed

        if(!empty($_GET['course_id'])){
            $this->db->where('t.course_id', $_GET['course_id']);
        }

        if(!empty($type)){
            $this->db->where('t.course_id', $type);
        }
        if ($start_date != NULL && $end_date != NULL) {
            $this->db->where("t.end_date BETWEEN '$start_date' AND '$end_date'");
        }
        $this->db->order_by('t.id', 'DESC');
        // $this->db->group_by('t.id');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training');
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        // $this->db->where('status', 1);

        if ($this->input->get('course_id') != NULL) {
            $this->db->where('course_id', $this->input->get('course_id'));
        }
        if ($type != NULL) {
            $this->db->where('course_id', $type);
        }
        if ($start_date != NULL && $end_date != NULL) {
            $this->db->where("end_date BETWEEN '$start_date' AND '$end_date'");
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_upcomming_training_coordinate($limit=1000, $offset=0, $type=NULL, $officeID=NULL) {
        // Get training IDs
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $trainingIDs = func_training_ids_cc($this->userSessID);

        if($trainingIDs){

            // Query
            $this->db->select('t.*, ct.ct_name, c.course_title, f.finance_name');
            $this->db->from('training t');
            $this->db->join('course_type ct', 'ct.id = t.course_type', 'LEFT');
            $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
            $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
            $this->db->limit($limit);
            $this->db->offset($offset);

            //$this->db->where('t.status', 1); // 1=UpComming, 2=OnGoing, 3=Completed
            // search
            if(!empty($_GET['course_id'])){
                $this->db->where('t.course_id', $_GET['course_id']);
            }
            if(!empty($type)){
                $this->db->where('t.course_id', $type);
            }
            if ($start_date != NULL && $end_date != NULL) {
                $this->db->where("t.end_date BETWEEN '$start_date' AND '$end_date'");
            }

            $this->db->where_in('t.id', $trainingIDs);
            $this->db->order_by('t.id', 'DESC');
            $result['rows'] = $this->db->get()->result();
            // echo $this->db->last_query(); exit;

            // count query
            $q = $this->db->select('COUNT(*) as count');
            $this->db->from('training');
            // $this->db->where('status', 1);
            // search
            if ($this->input->get('course_id') != NULL) {
                $this->db->where('course_id', $this->input->get('course_id'));
            }
            if ($type != NULL) {
                $this->db->where('course_id', $type);
            }
            if ($start_date != NULL && $end_date != NULL) {
                $this->db->where("end_date BETWEEN '$start_date' AND '$end_date'");
            }
            $this->db->where_in('id', $trainingIDs);
            $tmp = $this->db->get()->result();
            $result['num_rows'] = $tmp[0]->count;

            return $result;
        }
        return 0;
    }



    public function get_training_schedule_with_trainer($trainingID) {
        // result query
        $this->db->select('t.*, u.name_bn, dg.desig_name');
        $this->db->from('training_schedule t');
        $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');
        $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('t.training_id', $trainingID);
        $this->db->where('t.trainer_id !=', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_trainer_evaluation_result_by_user($trainingID, $topicID) {
        // $this->db->select('*');
        $this->db->select('SUM(rate_concept_topic) AS concept_topic, SUM(rate_present_technique) AS present_technique, SUM(rate_use_tool) AS use_tool, SUM(rate_time_manage) AS time_manage, SUM(rate_que_ans_skill) AS skill, COUNT(id) as row_count');
        $this->db->from('evaluation_trainer');
        $this->db->where('training_id', $trainingID);
        $this->db->where('topic_id', $topicID);
        $this->db->where('participant_id', $this->userSessID);
        $query =  $this->db->get()->row();

        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function is_answerd_trainer_evaluation($scheduleID){
        $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation_trainer');
        $this->db->where('topic_id', $scheduleID);
        $this->db->where('participant_id', $this->userSessID);
        $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }


















    public function get_data($limit=1000, $offset=0, $district=NULL, $upazila=NULL, $search=NULL) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
         //search
        $this->db->like('tc.course_title', $search);
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('t.id', 'DESC');
        // $this->db->group_by('t.id');
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



    public function get_info($trainingID) {
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->where('t.id', $trainingID);
        $result = $this->db->get()->row();

        return $result;
    }

    public function get_duplicate_info($trainingID) {
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->where('t.id', $trainingID);
        $result['info'] = $this->db->get()->row();

        return $result;
    }

    public function get_applicant($trainingID){
        // Applicant List
        $this->db->select('p.*, u.name_bn, u.nid');
        $this->db->from('training_participant p');
        $this->db->join('users u', 'u.id = p.app_user_id', 'LEFT');
        $this->db->where('p.training_id', $trainingID);
        // $this->db->where('p.is_verified', 0);
        // $this->db->where('p.app_user_id !=', NULL);
        $result = $this->db->get()->result();

        return $result;
    }

    public function get_course_from_training($trainingID){
        // Applicant List
        $this->db->select('id, course_id');
        $this->db->from('training');
        $this->db->where('id', $trainingID);
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
        $this->db->select('tp.*, t.batch_no, t.start_date, t.end_date, u.id as user_id, tc.course_title, u.username, u.office_type, u.employee_type, u.name_bn, u.name_en, u.father_name, u.mother_name, u.nid, u.mobile_no, u.email, u.dob, u.crrnt_office_id, u.crrnt_desig_id, u.div_id, u.dis_id, u.upa_id, u.union_id, u.created_on, u.modified, e.employee_type_name, o.office_name, d.desig_name');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->join('training t', 't.id = tp.training_id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
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


    public function get_training_info($trainingID){
        $this->db->select('t.*, c.course_title, f.finance_name, u.name_bn');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->join('users u', 'u.id = ts.trainer_id', 'LEFT');
        $this->db->where('t.id', $trainingID);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_training_schedule_info_by_id($scheduleID){
        $this->db->select('ts.*, t.start_date, t.end_date, u.name_bn');
        $this->db->from('training_schedule ts');
        $this->db->join('training t', 't.id = ts.training_id', 'LEFT');
        $this->db->join('users u', 'u.id = ts.trainer_id', 'LEFT');
        $this->db->where('ts.id', $scheduleID);
        $query = $this->db->get()->row();

        return $query;
    }


    public function get_participant_list($trainingID) {
        // dd($trainingID);
        $this->db->select('tp.*, u.name_bn, u.nid, u.mobile_no, o.office_name, d.desig_name, p.pou_name_bn, upa.upa_name_bn, dis.dis_name_bn');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id');
        $this->db->join('pourashava p', 'p.id = u.per_po', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id = u.per_upa_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id = u.per_dis_id', 'LEFT');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
        $this->db->where('tp.is_verified', 1);

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

    public function set_qrcode($id, $data) {
        // $data = array('qr_code' => $filename);
        $this->db->where('id', $id);
        $this->db->update('training', $data);

        return true;
    }

    public function get_subject_id($id) {
        return $this->db->select('id, subject_id')->where('id', $id)->get('training_mark')->row()->subject_id;
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

    /*
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
        $this->db->where('tp.is_complete', 0);
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_certificate($participantID) {
        $this->db->select('tp.*, ds.data_sheet_type, ds.name_bangla, ds.gender, ds.division_id, tm.participant_name, tm.course_id, tm.batch_no, tm.start_date, tm.end_date, tc.course_title, dg.desig_name, dis.dis_name_bn, upa.upa_name_bn, uni.uni_name_bn, u.name_bn, tm.start_date as sd, tm.end_date as ed');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->join('training tm', 'tm.id = tp.training_id', 'LEFT');
        $this->db->join('personal_datas ds', 'ds.id = tp.data_sheet_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
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

    /*public function get_participant_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('training_participant');
        $this->db->where('data_sheet_id', $form_data['data_sheet_id']);
        $this->db->where('tran_mgmt_id', $form_data['tran_mgmt_id']);
        $result = $this->db->get()->result();
        return $result;
    }*/

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
        $this->db->order_by('t.program_date', 'ASC');
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

    /*public function get_honorarium($trainingID) {
        // result query
        $this->db->select('t.*, u.name_bn, d.desig_name');
        $this->db->from('training_schedule t');
        $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        // $this->db->join('training tm', 'tm.id = t.training_id', 'LEFT');
        $this->db->where('t.trainer_id !=', 0);
        $this->db->where('u.user_type', 3);

        $this->db->where('t.training_id', $trainingID);
        $this->db->order_by('t.id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }*/

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
        $this->db->select('u.id, u.name_bn, u.name_en');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.app_user_id', 'LEFT');
        $this->db->where('tp.training_id', $trainingID);
        $this->db->where('tp.is_verified', 1);
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
