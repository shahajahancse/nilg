<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }


   /*************************** Dashboard ***************************/
   /*****************************************************************/

   public function get_count_by_data_type($memberType) {
      $result = array();

      $this->db->select('COUNT(*) as count');
      $this->db->from('personal_datas');
      $this->db->where('data_sheet_type', $memberType);
      $query = $this->db->get()->result();

      $result = $query[0]->count;

      return $result;
   }

   public function get_count_datasheet($dataType, $officeType) {
      $this->db->select('COUNT(*) as count');
      $this->db->from('personal_datas');
      $this->db->where('data_sheet_type', $dataType);
      $this->db->where('office_type_id', $officeType);

      $query = $this->db->get()->row();
      // echo $this->db->last_query(); exit;

      return $query->count;
   }

   public function get_count_training($financed_by) {
      $this->db->select('COUNT(*) as count');
      $this->db->from('training_management');
      $this->db->where('financing_id', $financed_by);
      $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

      return $query->count;
   }

   /************************** Training *****************************/
   /*****************************************************************/

   public function get_training_info($trainingID) {
      $this->db->select('t.id, t.participant_name, t.batch_no, t.course_id, c.course_title, t.course_type, t.reg_start_date, t.reg_end_date, t.start_date, t.end_date, t.is_published, t.status');
      $this->db->from('training t');
      $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
      $this->db->where('t.id', $trainingID);
      $result = $this->db->get()->row();

      return $result;
   }


   /*************************** Trainee *****************************/
   /*****************************************************************/
   // $this->db->where('t.id', 553);

   public function get_training_list_by_user($userID){
      $this->db->select('t.id, t.participant_name, t.batch_no, c.course_title, t.start_date, t.end_date');
      $this->db->from('training_participant tp');
      $this->db->join('training t', 't.id = tp.training_id', 'LEFT');
      $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
      $this->db->join('training_schedule ts', 'ts.training_id = tp.training_id', 'LEFT'); //ts.trainer_id != null
      $this->db->where('tp.app_user_id', $userID);
      $this->db->where('tp.is_verified', 1);
      $this->db->where('ts.trainer_id !=', 0);
      $this->db->group_by('t.id');
      $this->db->order_by('t.id', 'DESC');
      $result = $this->db->get()->result();

      return $result;
   }

   public function get_training_schedule_with_trainer($trainingID) {
      // result query
      $this->db->select('t.*, u.name_bn' );
      $this->db->from('training_schedule t');
      $this->db->join('users u', 'u.id = t.trainer_id', 'LEFT');
      $this->db->where('t.training_id', $trainingID);
      $this->db->where('t.trainer_id !=', 0);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get()->result();
      return $query;
   }

   function is_answerd_trainer_evaluation($scheduleID, $userID){
      $this->db->select('COUNT(*) as count');
      $this->db->from('evaluation_trainer');
      $this->db->where('topic_id', $scheduleID);
      $this->db->where('participant_id', $userID);
      $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
      $ret['count'] = $tmp[0]->count;

      return $ret;
   }

   function is_answerd_course_evaluation($trainingID, $userID){
      $this->db->select('COUNT(*) as count');
      $this->db->from('evaluation_course');
      $this->db->where('training_id', $trainingID);
      $this->db->where('participant_id', $userID);
      $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
      $ret['count'] = $tmp[0]->count;

      return $ret;
   }

   function answerd_course_evaluation_by_user($trainingID, $userID){
      $this->db->select('*');
      $this->db->from('evaluation_course');
      $this->db->where('training_id', $trainingID);
      $this->db->where('participant_id', $userID);
      return $this->db->get()->row();
   }

   public function get_training_schedule_info_by_id($scheduleID){
      $this->db->select('ts.*, t.participant_name, t.batch_no, c.course_title, t.start_date, t.end_date, u.name_bn');
      $this->db->from('training_schedule ts');
      $this->db->join('training t', 't.id = ts.training_id', 'LEFT');
      $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
      $this->db->join('users u', 'u.id = ts.trainer_id', 'LEFT');
      $this->db->where('ts.id', $scheduleID);
      $query = $this->db->get()->row();

      return $query;
   }

   public function get_trainer_evaluation_result_by_user($trainingID, $userID) {
      // $this->db->select('*');
      $this->db->select('ts.topic, u.name_bn, et.rate_concept_topic, et.rate_present_technique, et.rate_use_tool, et.rate_time_manage, et.rate_que_ans_skill, et.topic_avgrage');
      $this->db->from('evaluation_trainer et');
      $this->db->join('training_schedule ts', 'ts.id = et.topic_id', 'LEFT');
      $this->db->join('users u', 'u.id = et.participant_id', 'LEFT');
      $this->db->where('et.training_id', $trainingID);
        // $this->db->where('et.topic_id', $topicID);
      $this->db->where('et.participant_id', $userID);
      $query =  $this->db->get()->result();

        // return $this->db->last_query(); exit;

      return $query;
   }



   /*
   public function is_answerd_trainer_evaluation($trainingID, $userID){
      $this->db->select('id');
      $this->db->from('evaluation_trainer');
      $this->db->where('training_id', $trainingID);
      $this->db->where('participant_id', $userID);
      $query = $this->db->get();

      if ($query->num_rows() > 0) {
         return TRUE;
      } else {
         return FALSE;
      }
   }*/


   /************************** Directory ****************************/
   /*****************************************************************/

   public function get_users_quick_search($searchTerm){

      $whereLike = " (u.name_bn LIKE '%$searchTerm%' OR u.name_en LIKE '%$searchTerm%' OR dg.desig_name LIKE '%$searchTerm%' OR u.mobile_no LIKE '%$searchTerm%' OR u.email LIKE '%$searchTerm%' OR o.office_name LIKE '%$searchTerm%')";

      // result query
      $this->db->select('u.id, u.name_bn, u.name_en, dg.desig_name AS current_desig_name, u.mobile_no, u.email, u.profile_img, s.status_name, o.office_name');
      $this->db->from('users u');
      $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
      $this->db->join('office o', 'o.id=u.crrnt_office_id', 'LEFT');
      $this->db->join('data_status s', 's.id=u.status', 'LEFT');
      $this->db->where('u.is_verify', 1);
      $this->db->where($whereLike);
      $this->db->limit(50);

      $query = $this->db->get()->result();

      return $query;
   }

   public function get_users_by_office($officeID, $designationID){

      // result query
      $this->db->select('u.id, u.name_bn, dg.desig_name AS current_desig_name, u.mobile_no, u.email, u.profile_img, s.status_name');
      $this->db->from('users u');
      $this->db->join('designations dg', 'dg.id=u.crrnt_desig_id', 'LEFT');
      $this->db->join('data_status s', 's.id=u.status', 'LEFT');
      $this->db->where('u.crrnt_office_id', $officeID);
      $this->db->where('u.crrnt_desig_id', $designationID);
      // $this->db->where('u.user_type', 2);
      $this->db->where('u.is_verify', 1);
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_office_list_by_filter($officeType, $division = NULL, $district = NULL, $upazila = NULL)
   {
      // $data[''] = '-- অফিস নির্বাচন করুন --';
      $this->db->select('id, office_name');
      $this->db->from('office');
      $this->db->where('office_type', $officeType);
      if ($division != NULL) {
         $this->db->where('division_id', $division);
      }
      if ($district != NULL) {
         $this->db->where('district_id', $district);
      }
      if ($upazila != NULL) {
         $this->db->where('upazila_id', $upazila);
      }
      $this->db->where('status', 1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_designation_list_by_filter($officeType)
   {
      // $data[''] = '-- অফিস নির্বাচন করুন --';
      $this->db->select('id, desig_name');
      $this->db->from('designations');
      $this->db->where("FIND_IN_SET('".$officeType."', offices)");
      $this->db->order_by('so', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_upa_tha_by_dis_id($id)
   {
      // $data['0'] = lang('select_up_thana');
      $this->db->select('id, upa_name_bn');
      $this->db->from('upazilas');
      $this->db->where('upa_dis_id', $id);
        // $this->db->where('status',1);
      $this->db->order_by('upa_name_bn', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_district_by_div_id($id)
   {
      // $data['0'] = lang('select_district');
      $this->db->select('id, dis_name_bn');
      $this->db->from('districts');
      $this->db->where('dis_div_id', $id);
      // $this->db->where('status',1);
      $this->db->order_by('dis_name_bn', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_division()
   {
      // $data[''] = lang('select_division');
      $this->db->select('id, div_name_bn');
      $this->db->from('divisions');
      $this->db->order_by('sort_order', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

}
