<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('set_output')) {
   function set_output($Return=array()){
     /*Set response header*/
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");
     /*Final JSON response*/
     exit(json_encode($Return));
   }

}

if (!function_exists('bangla_time_format')) {
   function bangla_time_format($item) {  
      if($item != NULL || $item != '00-00-00'){
         switch ($item) {
            case $item >= '04:00:00' && $item < '06:00:00':
               $format = "ভোর";
               break;
            case $item >= '06:00:00' && $item < '11:59:59':
               $format = "সকাল";
               break;
             case $item >= '12:00:00' && $item < '14:59:59':
               $format = "দুপুর";
               break;
             case $item >= '15:00:00' && $item < '17:59:59':
               $format = "বিকাল";
               break;
             case $item >= '18:00:00' && $item < '19:59:59':
               $format = "সন্ধ্যা";
               break;
             case $item >= '20:00:00' && $item < '24:59:59':
               $format = "রাত";
               break;
             case $item >= '00:00:00' && $item < '03:59:59':
               $format = "রাত";
               break;
            default:
               $format = "";
         }
         
         $time = BanglaConverter::en2bn(date('h:i', strtotime($item)));
         return $format .' '. $time;
      }else{
         return '00-00-00';
      }      
   }
}

if (!function_exists('date_db_format')) {
   function date_db_format($item) {  
      if($item != NULL){
         return date('Y-m-d', strtotime($item));
      }else{
         return '0000-00-00';
      }      
   }
}

if (!function_exists('date_bangla_format')) {
   function date_bangla_format($item) {      
      if($item != '0000-00-00'){
         return date('d-m-Y', strtotime($item));
      }else{
         return '';
      }
   }
}

if (!function_exists('date_browse_format')) {
   function date_browse_format($item) {      
      if($item != '0000-00-00'){
         return date('d-m-Y', strtotime($item));
      }else{
         return '';
      }
   }
}

if (!function_exists('date_detail_format')) {
   function date_detail_format($item) {   
      if($item != '0000-00-00'){
         return date('d F, Y', strtotime($item));
      }else{
         return '';
      }         
   }
}

if (!function_exists('date_dayname_format')) {
   function date_dayname_format($item) {      
      if($item != '0000-00-00'){
         // return date('d M Y', strtotime($item));
         return date_format(date_create($item), "d M Y");
      }else{
         return '';
      }
   }
}

if (!function_exists('date_bangla_calender_format')) {
   function date_bangla_calender_format($item) { 
      $convertedDATE = '';
      if($item != ''){     
         $currentDate = date_dayname_format($item);
         $engDATE = array('1','2','3','4','5','6','7','8','9','0','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
         $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার' );
         $convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
      }
      return $convertedDATE;
   }
}

function eng2bng($item) {      
   return BanglaConverter::en2bn($item);
}

function bng2eng($item) {      
   return BanglaConverter::bn2en($item);
}

if (!function_exists('func_datasheet_status')) {
   function func_datasheet_status($item) {      
      if($item == '1'){
         $result = "কর্মরত / নির্বাচিত";
      }elseif($item == '2'){
         $result = "অনির্বাচিত";
      }elseif($item == '3'){
         $result = "অবসরপ্রাপ্ত"; 
      }elseif($item == '4'){
         $result = "স্থগিত"; 
      }elseif($item == '5'){
         $result = "বহিষ্কৃত"; 
      }elseif($item == '6'){
         $result = "মৃত"; 
      }elseif($item == '7'){
         $result = "আর্কাইভ";       
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('datasheet_status')) {
   function datasheet_status_func($item) {      
      if($item == '1'){
         $result = "কর্মরত";
      }elseif($item == '2'){
         $result = "নির্বাচিত";
      }elseif($item == '3'){
         $result = "অনির্বাচিত";
      }elseif($item == '4'){
         $result = "অবসরপ্রাপ্ত"; 
      }elseif($item == '5'){
         $result = "স্থগিত"; 
      }elseif($item == '6'){
         $result = "বহিষ্কৃত"; 
      }elseif($item == '7'){
         $result = "মৃত"; 
      }elseif($item == '8'){
         $result = "আর্কাইভ";       
      }else{
         $result = '';
      }

      return $result;
   }
}

// Get evaluation mark type id from subject id
if (!function_exists('func_eva_mark_type_id')) {
   function func_eva_mark_type_id($item) {   
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $typeID = $CI->Common_model->get_evaluation_mark_type_id($item)->mark_type_id;  
      if($typeID){
         return $typeID;
      }else{
         return NULL;
      }
   }
}

// Get employee type from designation
if (!function_exists('func_get_emp_type_id')) {
   function func_get_emp_type_id($item) {   
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $id = $CI->Common_model->get_employee_type_by_designation_id($item)->id;  
      if($id){
         return $id;
      }else{
         return NULL;
      }
   }
}

// Get union id from office id
if (!function_exists('func_get_union_id')) {
   function func_get_union_id($item) {   
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $id = $CI->Common_model->get_union_by_office_id($item)->id;  
      if($id){
         return $id;
      }else{
         return NULL;
      }
   }
}

// Get upazila id from office id
if (!function_exists('func_get_upazila_id')) {
   function func_get_upazila_id($item) {   
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $id = $CI->Common_model->get_upazila_by_office_id($item)->id;  
      if($id){
         return $id;
      }else{
         return NULL;
      }
   }
}

// Get district id from office id
if (!function_exists('func_get_district_id')) {
   function func_get_district_id($item) {   
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $id = $CI->Common_model->get_district_by_office_id($item)->id;  
      if($id){
         return $id;
      }else{
         return NULL;
      }
   }
}

// Get division from office id
if (!function_exists('func_get_division_id')) {
   function func_get_division_id($item) {   
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $id = $CI->Common_model->get_division_by_office_id($item)->id;  
      if($id){
         return $id;
      }else{
         return NULL;
      }
   }
}

if (!function_exists('func_question_type')) {
   function func_question_type($item) {      
      if($item == '1'){
         $result = "TEXT";
      }elseif($item == '2'){
         $result = "TEXTAREA";
      }elseif($item == '3'){
         $result = "RADIO"; 
      }elseif($item == '4'){
         $result = "CHECKBOX";      
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('func_gender')) {
   function func_gender($item) {      
      if($item == 'Male'){
         $result = 'পুরুষ';
      }elseif($item == 'Female'){
         $result = 'নারী';
      }elseif($item == 'Other'){
         $result = 'অন্যান্য';
      }else{
         $result = '';
      }
      
      return $result;
   }
}


/*if (!function_exists('func_data_status')) {
   function func_data_status($item) { 
      $CI =& get_instance();
      $CI->load->model('Common_model');
      $result = '';
      $data = $CI->Common_model->get_data_status_by_id($item);  

      if($data){
         if($data->id == 1){
            $result = "<span class='label label-success'>".$data->status_name."</span>";
         }elseif($data->id == 2){
            $result = "<span class='label label-success'>".$data->status_name."</span>";
         }elseif($data->id == 3){
            $result = "<span class='label label-info'>".$data->status_name."</span>";       
         }   
      }

      return $result;
   }
}*/

if (!function_exists('func_training_status')) {
   function func_training_status($item) {      
      if($item == 1){
         $result = "<span class='label label-warning' style='color:black;'>আসন্ন</span>";
      }elseif($item == 2){
         $result = "<span class='label label-danger'>চলমান</span>";
      }elseif($item == 3){
         $result = "<span class='label label-info'>সম্পন্ন</span>";       
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('func_training_title')) {
   function func_training_title($trainingID) {
      $CI =& get_instance();
      $CI->load->model('Common_model');

      $info = $CI->Common_model->get_training_info($trainingID);  

      return $info->participant_name." এর \"".$info->course_title."\" কোর্স (ব্যাচ নং ".eng2bng($info->batch_no).')';
   }
}


if (!function_exists('func_training_date')) {
   function func_training_date($startDate, $endDate) {      
      if($startDate == $endDate){
         $datetime = date_bangla_calender_format($startDate);
      }else{
         $datetime = date_bangla_calender_format($startDate).' হতে '.date_bangla_calender_format($endDate);
      }
      return 'প্রশিক্ষণের সময়ঃ '.$datetime.'<br>';
   }
}

if (!function_exists('func_training_date_from_to')) {
   function func_training_date_from_to($startDate, $endDate) {  
      $result = '';
      $training_start   = $startDate != '0000-00-00' ? $startDate : '';
      $training_end     = $endDate != '0000-00-00' ? $endDate : '';

      if($training_start != '0000-00-00'){
         $result = date_bangla_calender_format($training_start).' <em>হতে</em> '.date_bangla_calender_format($training_end);
      }

      return $result;
   }
}

if (!function_exists('func_training_duration')) {
   function func_training_duration($startDate, $endDate) {  
      $result = '';
      $training_start   = $startDate != '0000-00-00' ? $startDate : '';
      $training_end     = $endDate != '0000-00-00' ? $endDate : '';

      if($training_start != '0000-00-00' && $training_end != '0000-00-00'){
         // Day Count
         $date_start = strtotime($training_start);
         $date_end   = strtotime($training_end);
         $datediff = $date_end - $date_start;
         $duration = round($datediff / (60 * 60 * 24));
         $result = eng2bng($duration+1).' দিন';
      }

      return $result;
   }
}

// Check NILG Employee (trainee) Extra User Access 
if (!function_exists('func_nilg_auth')) {
   function func_nilg_auth($officeType, $userDesignation=NULL) { 
      $CI =& get_instance();
      $CI->load->model('Common_model');
      // $result = false;

      return $CI->Common_model->get_nilg_user_access_by_current_designation($officeType, $userDesignation);
      // return $result;
   }
}

// Get Training IDs for Training Coordinator
if (!function_exists('func_training_ids_cc')) {
   function func_training_ids_cc($userID) { 
      $CI =& get_instance();
      $CI->load->model('Common_model');
      // $result = false;

      return $CI->Common_model->get_training_ids_by_cc($userID);
      // return $result;
   }
}


// PHP Array Remove Multiple Elements by Key Example
// https://hdtuto.com/article/php-array-remove-multiple-elements-by-key-example
if (!function_exists('func_array_except')) {
   function func_array_except($array, $keys)
   {
      foreach ($keys as $key) {
         unset($array[$key]);
      }

      return $array;
   }
}

if (!function_exists('func_exam_grade_inwords')) {
   function func_exam_grade_inwords($point) {
      switch ($point) {
         case $point <= 50:
         return 'অকৃতকার্য';
         break;
         case $point <= 50.60 && $point > 50 :
         return 'সি (চলতি মান)';
         break;
         case $point <= 60.70 && $point > 50.60:
         return 'বি (উচ্চ চলতি মান)';
         break;
         case $point <= 70.80 && $point > 60.70:
         return 'বি (সন্তোষজনক)';
         break;
         case $point <= 80.85 && $point > 70.80:
         return 'বি+ (ভাল)';
         break;
         case $point <= 85.90 && $point > 80.85:
         return 'এ (উত্তম)';
         break;
         case $point <= 90.95 && $point > 85.90:
         return 'এ (অতি উত্তম)';
         break;
         case $point <= 95 && $point > 90.95:
         return 'এ+ (অসাধারণ)';
         break;
         case $point <= 100:
         return 'এ+ (অসাধারণ)';
         break;
         default:
         return '';
      }
   }
}


// training participant auto off after 7 day of trtaining end date
if (!function_exists('training_participant_auto_off')) {
   function training_participant_auto_off() {
      $CI =& get_instance();
      $end_date = date("Y-m-d", strtotime("-7 day", strtotime(date("Y-m-d"))));

      $CI->db->select('id, end_date, is_published');
      $CI->db->from('training'); 
      $CI->db->where('is_published', 1);
      $CI->db->where('end_date <', $end_date);
      $CI->db->order_by('id', "DESC");
      $result = $CI->db->get()->result(); 

      if (!empty($result)) {
         foreach ($result as $key => $row) {
            $CI->db->where('id', $row->id)->update('training', array('is_published' => 0));
         }
      }
   }
}


















































if (!function_exists('get_scout_section')) {
   function get_scout_section($type) {
      if($type == 1){
         $data = "Cub Scout";
      }else if($type == 2){
         $data = "Scout";
      }else if($type == 3){
         $data = "Rover Scout";
      }else if($type == 4){
         $data = "Not Applicable";      
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('get_religion')) {
   function get_religion($type) {
      if($type == 1){
         $data = "Islam";
      }else if($type == 2){
         $data = "Hinduism";
      }else if($type == 3){
         $data = "Chrishtianity";
      }else if($type == 4){
         $data = "Buddhism";
      }else if($type == 5){
         $data = "Sikhism";
      }else if($type == 6){
         $data = "Jainism";
      }else if($type == 7){
         $data = "Judaism";
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('get_scout_unit_type')) {
   function get_scout_unit_type($type) {
      if($type == 1){
         $data = "কাব দল";
      }elseif($type == 2){
         $data = "স্কাউট দল";
      }elseif($type == 3){
         $data = "রোভার স্কাউট দল";
      }else if($type == 4){
         $data = "গার্ল-ইন কাব";
      }else if($type == 5){
         $data = "গার্ল-ইন স্কাউট";
      }else if($type == 6){
         $data = "গার্ল-ইন রোভার স্কাউট";      
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('scout_group_office_type')) {
   function scout_group_office_type($type) {
      if($type == 1){
         $result = "Close Group";
      }else{
         $result = "Open Group";
      }
      return $result;
   }
}

if (!function_exists('migrate_verify_status')) {
   function migrate_verify_status($item) {      
      if($item == 'Approved'){
         $result = "<span class='label label-success'>Accept</span>";
      }elseif($item == 'Reject'){      
         $result = "<span class='label label-important'>Reject</span>";
      }else{
         $result = "<span class='label label-warning'>Pending</span>";
      }
      return $result;
   }
}

if (!function_exists('award_status')) {
   function award_status($item) {      
      if($item == 'Approved'){
         $result = "<span class='label label-success'>Accept</span>";
      }elseif($item == 'Reject'){      
         $result = "<span class='label label-important'>Reject</span>";
      }else{
         $result = "<span class='label label-warning'>Pending</span>";
      }
      return $result;
   }
}

if (!function_exists('get_member_type')) {
   function get_member_type($item) {      
      if($item == '1'){
         $result = "New Applicant";
      }elseif($item == '2'){
         $result = "Scout";
      }elseif($item == '3'){
         $result = "Adult Leader";
      }elseif($item == '4'){
         $result = "Professional Executive";
      }elseif($item == '5'){
         $result = "Warrant";
      }elseif($item == '6'){
         $result = "Non-Warrant";
      }elseif($item == '7'){
         $result = "Support Staff";          
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('set_office_type')) {
   function set_office_type($item) {      
      if($item == '1'){
         $result = "National";
      }elseif($item == '2'){
         $result = "Region";
      }elseif($item == '3'){
         $result = "District";
      }elseif($item == '4'){
         $result = "Upazila";
      }elseif($item == '5'){
         $result = "Scout Group";    
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('get_leave_type_level')) {
   function get_leave_type_level($item) {      
      if($item == '1'){
         $result = "অর্জিত ছুটি";
      }elseif($item == '2'){
         $result = "অর্জিত  (শ্রান্তি বিনোদন) ছুটি";
      }elseif($item == '3'){
         $result = "অন্যান্য ছুটি"; 
      }else{
         $result = '';
      }

      return $result;
   }
}


