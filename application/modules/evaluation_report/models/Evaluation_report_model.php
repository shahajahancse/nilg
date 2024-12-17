<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation_report_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    } 

    public function trainer_evaluation($start_date = NULL, $end_date = NULL, $course_id = NULL) {

        $this->db->select('t.course_id, c.course_title, t.participant_name, ot.office_type_name, COUNT(tp.id) as participant');
        $this->db->from('training t');   
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');    
        $this->db->join('office_type ot', 'ot.id = t.lgi_type', 'LEFT');      
        $this->db->join('training_participant tp', 'tp.training_id = t.id', 'LEFT');      
        $this->db->where("t.end_date BETWEEN '$start_date' and '$end_date'");
        // $this->db->where('status', 3);
        if ($course_id != null) {
            $this->db->where('t.course_id', $course_id);
        }
        $this->db->group_by('t.course_id');
        $query = $this->db->get()->result();
        // dd($query);
        if (!empty($query)) {
            foreach ($query as $key => &$row) {
                $query[$key]->total_course = $this->db->select('COUNT(course_id) as total_course')
                                                ->where('course_id', $row->course_id)
                                                ->where("end_date BETWEEN '$start_date' and '$end_date'")
                                                ->get('training')->row()->total_course;
            }
        }

        if (empty($query)) {
            return 'তথ্য পাওয়া যায়নি';
        }

        return $query;
    }

    public function trainer_eva_sum($course_id, $start_date, $end_date) {
        // dd($start_date);
        $data = array();
        $this->db->select('t.course_id,
                    SUM(et.topic_avgrage) AS topic_avgrage, 
                    COUNT(et.participant_id) AS total_parti,
                ');

        $this->db->from('training t');  
        $this->db->join('evaluation_trainer et', 't.id = et.training_id', 'LEFT');      
        $this->db->where('t.course_id', $course_id);
        $this->db->where("t.end_date BETWEEN '$start_date' and '$end_date'");
        $this->db->group_by('t.course_id', 'ASC');
        $data['query'] = $this->db->get()->result();

        // get percentage

        // dd($data['percentage']);
        return $data;
    }  


    public function trainer_evaluation_result($training_id) {

        /*$this->db->select('et.topic_id, t.trainer_id, t.topic');  
        $this->db->from('evaluation_trainer et');  
        $this->db->join('training_schedule t', 't.id = et.topic_id', 'LEFT'); 
        $datas = $this->db->get()->result();
        foreach ($datas as $key => $row) {
            $this->db->where('topic_id',$row->topic_id)->update('evaluation_trainer', array('topic_trainer_id'=>$row->trainer_id));
        }
        dd($datas);*/
        $data = $this->db->select('DISTINCT(t.topic_trainer_id)')->where('t.training_id', $training_id)->get('evaluation_trainer t');
        $trainers = array_map('current', $data->result_array());
        if (empty($trainers)) {
            return 'তথ্য পাওয়া যায়নি';
        }

        $this->db->select('
                    t.training_id, t.trainer_id, u.name_bn,
                    COUNT(t.id) AS total_row, 
                ');

        $this->db->from('training_schedule t');    
        $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');    
        $this->db->where('t.training_id', $training_id);
        $this->db->where_in('t.trainer_id', $trainers);
        // $this->db->where('t.trainer_id IS NOT NULL', NULL, FALSE);
        // $this->db->where('t.trainer_id !=', NULL, FALSE);
        $this->db->where('t.trainer_id !=', 0, FALSE);
        $this->db->group_by('t.trainer_id');
        $query = $this->db->get()->result();

        // dd($query);
        return $query;
    }  

    public function evaluation_sum($training_id, $trainer_id) {
        $data = array();
        $this->db->select('t.topic, et.topic_id,
                    SUM(CASE WHEN et.rate_concept_topic = 4 THEN 1 ELSE 0 END ) AS vg_concept, 
                    SUM(CASE WHEN et.rate_concept_topic = 3 THEN 1 ELSE 0 END ) AS g_concept, 
                    SUM(CASE WHEN et.rate_concept_topic = 2 THEN 1 ELSE 0 END ) AS cv_concept, 
                    SUM(CASE WHEN et.rate_concept_topic = 1 THEN 1 ELSE 0 END ) AS bcv_concept,

                    SUM(CASE WHEN et.rate_present_technique = 4 THEN 1 ELSE 0 END ) AS vg_technique, 
                    SUM(CASE WHEN et.rate_present_technique = 3 THEN 1 ELSE 0 END ) AS g_technique, 
                    SUM(CASE WHEN et.rate_present_technique = 2 THEN 1 ELSE 0 END ) AS cv_technique, 
                    SUM(CASE WHEN et.rate_present_technique = 1 THEN 1 ELSE 0 END ) AS bcv_technique,

                    SUM(CASE WHEN et.rate_use_tool = 4 THEN 1 ELSE 0 END ) AS vg_use_tool, 
                    SUM(CASE WHEN et.rate_use_tool = 3 THEN 1 ELSE 0 END ) AS g_use_tool, 
                    SUM(CASE WHEN et.rate_use_tool = 2 THEN 1 ELSE 0 END ) AS cv_use_tool, 
                    SUM(CASE WHEN et.rate_use_tool = 1 THEN 1 ELSE 0 END ) AS bcv_use_tool, 

                    SUM(CASE WHEN et.rate_time_manage = 4 THEN 1 ELSE 0 END ) AS vg_manage, 
                    SUM(CASE WHEN et.rate_time_manage = 3 THEN 1 ELSE 0 END ) AS g_manage, 
                    SUM(CASE WHEN et.rate_time_manage = 2 THEN 1 ELSE 0 END ) AS cv_manage, 
                    SUM(CASE WHEN et.rate_time_manage = 1 THEN 1 ELSE 0 END ) AS bcv_manage,  

                    SUM(CASE WHEN et.rate_que_ans_skill = 4 THEN 1 ELSE 0 END ) AS vg_ans_skill, 
                    SUM(CASE WHEN et.rate_que_ans_skill = 3 THEN 1 ELSE 0 END ) AS g_ans_skill, 
                    SUM(CASE WHEN et.rate_que_ans_skill = 2 THEN 1 ELSE 0 END ) AS cv_ans_skill, 
                    SUM(CASE WHEN et.rate_que_ans_skill = 1 THEN 1 ELSE 0 END ) AS bcv_ans_skill, 
                    SUM(et.topic_avgrage) AS topic_avgrage, 
                    COUNT(et.topic_id) AS total,
                ');

        $this->db->from('evaluation_trainer et');  
        $this->db->join('training_schedule t', 't.id = et.topic_id', 'LEFT');      
        $this->db->where('et.training_id', $training_id);
        $this->db->where('et.topic_trainer_id', $trainer_id);
        $this->db->group_by('et.topic_id', 'ASC');
        $data['query'] = $this->db->get()->result();

        // get percentage
        $this->db->select('COUNT(et.topic_id) AS total_row, SUM(et.topic_avgrage) AS topic_avgrage');
        $this->db->from('evaluation_trainer et'); 
        $this->db->where('et.training_id', $training_id);
        $this->db->where('et.topic_trainer_id', $trainer_id);
        $row = $this->db->get()->row();
        $data['percentage'] = ($row->topic_avgrage * 5 * 100)/($row->total_row * 5 * 4);
        // dd($data['percentage']);
        return $data;
    }  

}