<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Common extends Backend_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Cropper_model');

        // if (!$this->ion_auth->logged_in()):
        //     redirect('login');
        // endif;
    }

    public function index(){
    	redirect('dashboard');
    }

    function ajax_exists_nid(){
        // echo 'true';
        $data = $_POST['national_id'];
        echo $this->Common_model->exists_nid($data);
    }

    function ajax_exists_nid_own($id){
        // echo 'true';
        $data = $_POST['national_id'];
        echo $this->Common_model->exists_nid($data, $id);
    }

    function ajax_exists_mobile(){
        $data = $_POST['mobile_number'];
        echo $this->Common_model->exists_mobile($data);
    }

    function ajax_exists_email(){
        $data = $_POST['email_address'];
        echo $this->Common_model->exists_email($data);
    }

    public function select2_office(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('office_name', $this->input->get("q")); 
            $this->db->or_like('office_name_en', $this->input->get("q")); 
            $query = $this->db->select('id, office_name AS text')
            ->limit(15)
            ->get("office");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_union(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->like('uni_name_bn', $this->input->get("q")); 
            $query = $this->db->select('id, uni_name_bn AS text')
            ->limit(15)
            ->get("unions");
            $json = $query->result();
        }

        // https://stackoverflow.com/questions/36360783/how-to-render-html-in-select2-options
        /*$jsonHTML = '<div>';
        $jsonHTML .= '<h5>Hello</h5>';
        $jsonHTML .= '<div>';*/

        echo json_encode($json);
    }

    public function select2_course(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->like('course_title', $this->input->get("q")); 
            $query = $this->db->select('id, course_title AS text')
            // ->where('course_type', 'NILG')
            ->limit(15)
            ->get("course");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_designation(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->like('desig_name', $this->input->get("q")); 
            $query = $this->db->select('id, desig_name AS text')
            ->limit(15)
            ->get("designations");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_designation_pr(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->like('desig_name', $this->input->get("q")); 
            $query = $this->db->select('id, desig_name AS text')
            ->where('employee_type', 1)
            ->where('status', 1)
            ->limit(15)
            ->get("designations");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_designation_employee(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->like('desig_name', $this->input->get("q")); 
            $query = $this->db->select('id, desig_name AS text')
            ->where('employee_type !=', 1)
            ->where('status', 1)
            ->limit(15)
            ->get("designations");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function get_dept(){
        $data = array();
        $this->db->select('*');
        $query = $this->db->get('department')->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->name_en .' => '. $row->dept_name;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }


    public function select2_nid_trainee_verified(){
        $json = [];
        if(!empty($this->input->get("q"))){
            // Search Term
            $searchTerm = $this->input->get("q");
            $whereLike = " (nid LIKE '%$searchTerm%' OR name_bn LIKE '%$searchTerm%' OR name_en LIKE '%$searchTerm%' OR mobile_no LIKE '%$searchTerm%')";
            // DB Query
            $this->db->select('id, CONCAT(nid, " (", name_bn, ")", " (", mobile_no, ")") AS text');
            // $this->db->or_like('nid', $this->input->get("q")); 
            // $this->db->or_like('name_bn', $this->input->get("q"));
            // $this->db->or_like('mobile_no', $this->input->get("q")); 
            // $this->db->where('user_type', 2);
            $this->db->where('is_verify', 1);
            $this->db->where($whereLike);
            $this->db->limit(15);
            $query = $this->db->get("users");
            // echo $this->db->last_query(); exit;
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_nid_trainer_verified(){
        $json = [];
        if(!empty($this->input->get("q"))){
            // Search Term
            $searchTerm = $this->input->get("q");
            $whereLike = " (u.username LIKE '%$searchTerm%' OR u.name_bn LIKE '%$searchTerm%' OR u.name_en LIKE '%$searchTerm%' OR u.mobile_no LIKE '%$searchTerm%')";
            // DB Query
            $this->db->select('u.id, CONCAT(u.username, " (", u.name_bn, ")", " (", u.mobile_no, ")") AS text');
            $this->db->join('users_groups ug', 'ug.user_id = u.id', 'LEFT');
            $this->db->join('groups g', 'g.id = ug.user_id', 'LEFT');
            $this->db->where('ug.group_id', 11);
            // $this->db->select('id, CONCAT(nid, " (", name_bn, ")", " (", mobile_no, ")") AS text');            
            // $this->db->or_like('nid', $this->input->get("q")); 
            // $this->db->or_like('name_bn', $this->input->get("q"));
            // $this->db->or_like('mobile_no', $this->input->get("q")); 
            // $this->db->where('user_type', 3);
            // $this->db->where('is_verify', 1);
            $this->db->where($whereLike);
            $this->db->limit(15);
            $query = $this->db->get("users u");
            // echo $this->db->last_query(); exit;
            $json = $query->result();
        }
        echo json_encode($json);
    }


    /******************** Trainee Data Delete ********************/
    function ajax_experiance_del($id)
    {
        $this->Common_model->delete('per_experience', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_leave_del($id)
    {
        $this->Common_model->delete('leave_employee', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_promotion_del($id)
    {
        $this->Common_model->delete('per_promotion', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_education_del($id)
    {
        $this->Common_model->delete('per_education', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_nilg_training_del($id)
    {
        $this->Common_model->delete('training_participant', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_local_training_del($id)
    {
        $this->Common_model->delete('per_local_org_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }
    function ajax_foreign_training_del($id)
    {
        $this->Common_model->delete('per_foreign_org_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }


    /****************************** Cropper **********************/
    public function upload() {
        $json = array();
        $avatar_src = $this->input->post('avatar_src');
        $avatar_data = $this->input->post('avatar_data');
        $avatar_file = $_FILES['avatar_file'];
        //$ussid = $this->input->post('ussid');
        $upltype = $this->input->post('upltype');

        $originalPath = ROOT_UPLOAD_PATH; //$this->img_orginal_path;
        $thumbPath = ROOT_UPLOAD_PATH.'_thumb/'; //$this->img_thumb_path; 
        $urlPath =  HTTP_USER_PROFILE_THUMB_PATH; //$this->img_thumb_path;

        $thumb = $this->Cropper_model->setDst($thumbPath);
        $this->Cropper_model->setSrc($avatar_src);
        $data = $this->Cropper_model->setData($avatar_data);
        // set file
        $avatar_path = $this->Cropper_model->setFile($avatar_file, $originalPath); 
        // crop       
        $this->Cropper_model->crop($avatar_path, $thumb, $data);

        // response       
        // 'ussid' => $ussid,
        $json = array(
            'state'  => 200,
            'message' => $this->Cropper_model->getMsg(),
            'result' => $this->Cropper_model->getResult(),
            'thumb' => $this->Cropper_model->getThumbResult(),
            'upltype' => $upltype,
            'urlPath' => $urlPath,
            );
        echo json_encode($json);
    }

    // upload prifile avatar Crop Image
    public function uploadCropImg() {
        $json = array();
        $image_url = $this->input->post('image_url');        
        $user_id = base64_decode($this->input->post('member_id'));   
        $upltype = $this->input->post('upltype');            
        if (!empty($user_id) && !empty($upltype) && $upltype=='avatar') {
            $this->Common_model->seturl($image_url);
            //$this->Common_model->setUserID($user_id);
            //$this->Common_model->setProfilePicture();
            $json['success'] = 'success';
        } else {
            $json['success'] = 'failed';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }











    /* Gives search suggestions based on what is being searched for */
    function suggest_nid(){
        $suggestions = $this->Common_model->get_nid_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_promotion_organization(){
        $suggestions = $this->Common_model->get_promotion_organization_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_promotion_designation(){
        $suggestions = $this->Common_model->get_promotion_designation_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_organization(){
        $suggestions = $this->Common_model->get_organization_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_designation(){
        $suggestions = $this->Common_model->get_designation_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_post_office(){
        $suggestions = $this->Common_model->get_post_office_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_nilg_course(){
        $suggestions = $this->Common_model->get_nilg_course_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_local_course(){
        $suggestions = $this->Common_model->get_local_course_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_other_course(){
        $suggestions = $this->Common_model->get_other_course_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    function suggest_foreign_course(){
        $suggestions = $this->Common_model->get_foreign_course_suggestions($this->input->post('q'));
        echo implode("\n",$suggestions);
    }

    // function suggest_first_organization(){
    //     $suggestions = $this->Common_model->get_first_organization_suggestions($this->input->post('q'));
    //     echo implode("\n",$suggestions);      
    // }

    // function suggest_curr_organization(){
    //     $suggestions = $this->Common_model->get_curr_organization_suggestions($this->input->post('q'));
    //     echo implode("\n",$suggestions);      
    // }

    public function organization(){
        $this->form_validation->set_rules('name_org', 'organization name', 'required|trim');
        // $this->form_validation->set_rules('name_english', 'name english', 'required|trim');

        $message='';
        if ($this->form_validation->run() == true){
            $form_data = array(
                'org_name' => $this->input->post('name_org')
                );    

            if($this->Common_model->save('organizations', $form_data)){   
                $message = '<div class="alert alert-success">প্রদত্ত তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে</div>';                
            }
        }
        echo $message = (validation_errors()) ? validation_errors() : $message;
    }    

    function ajax_check_exists_organization(){
        // echo 'true';
        $id = $_POST['orgname'];
        echo $this->Common_model->exists_organization_name($id);
    }

    public function select2_natioanl_id_name(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('national_id', $this->input->get("q")); 
            $this->db->or_like('name_bangla', $this->input->get("q"));
            $this->db->or_like('telephone_mobile', $this->input->get("q")); 
            $query = $this->db->select('id, CONCAT(national_id, " (", name_bangla, ")", " (", telephone_mobile, ")") AS text')
            ->limit(15)
            ->get("personal_datas");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_trainee(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('trainer_name', $this->input->get("q")); 
            $this->db->or_like('trainer_desig', $this->input->get("q"));
            $this->db->or_like('mobile', $this->input->get("q")); 
            $query = $this->db->select('id, CONCAT(trainer_name, " (", trainer_desig, ")", " (", mobile, ")") AS text')
            ->limit(15)
            ->get("trainer_register");
            $json = $query->result();
        }
        echo json_encode($json);
    }


    public function select2_trainer(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('username', $this->input->get("q")); 
            $this->db->or_like('name_bn', $this->input->get("q"));
            $this->db->or_like('mobile_no', $this->input->get("q")); 
            $this->db->where('user_type', 3);
            $query = $this->db->select('id, CONCAT(username, " (", name_bn, ")", " (", mobile_no, ")") AS text')
            ->limit(15)
            ->get("users");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    public function select2_coordinator(){
        $json = [];
        if(!empty($this->input->get("q"))){
            // Search Term
            $searchTerm = $this->input->get("q");
            $whereLike = " (u.username LIKE '%$searchTerm%' OR u.name_bn LIKE '%$searchTerm%' OR u.name_en LIKE '%$searchTerm%' OR u.mobile_no LIKE '%$searchTerm%')";
            
            // DB Query
            // $this->db->select('u.id, CONCAT(u.name_bn, " (", u.username, ")") AS text');
            $this->db->select('u.id, CONCAT(u.username, " (", u.name_bn, ")", " (", u.mobile_no, ")") AS text');
            $this->db->join('users_groups ug', 'ug.user_id = u.id', 'LEFT');
            $this->db->join('groups g', 'g.id = ug.user_id', 'LEFT');
            $this->db->where('ug.group_id', 9);
            $this->db->where($whereLike);
            $this->db->limit(15);
            $query = $this->db->get("users u");

            /*
            // Search Term
            $searchTerm = $this->input->get("q");
            $whereLike = " (name_bn LIKE '%$searchTerm%' OR username LIKE '%$searchTerm%')";
            // DB Query
            $this->db->select('id, CONCAT(name_bn, " (", username, ")") AS text');
            $this->db->where('user_type', 4);
            $this->db->where($whereLike);
            $this->db->limit(15);
            $query = $this->db->get("users");
            */

            // $this->db->select('u.id, ug.group_id, CONCAT(u.office_name, " (", u.designation, ")") AS text');
            // $this->db->join('users_groups ug', 'ug.user_id = u.id', 'left');
            // $this->db->join('groups g', 'g.id = ug.user_id', 'left');
            // $this->db->where('ug.group_id', 9); 
            // $this->db->or_where_in('ug.group_id', 9);
            // $this->db->having('ug.group_id', 9); 
            // $this->db->having('u.id !=', $this->session->userdata('user_id'));            
            /*$this->db->where('u.user_type', 4);             
            $this->db->or_like('u.name_bn', $this->input->get("q")); 
            $this->db->or_like('u.username', $this->input->get("q")); 
            $this->db->limit(15);            
            $query = $this->db->get("users u");*/

            $json = $query->result();
            // echo $this->db->last_query();exit;
        }
        echo json_encode($json);
    }

    public function select2_organization_name(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('org_name', $this->input->get("q")); 
            $query = $this->db->select('id, org_name AS text')
            ->limit(15)
            ->get("organizations");
            $json = $query->result();
        }
        echo json_encode($json);
    }

    function ajax_office_filter($officeType, $division=NULL, $district=NULL, $upazila=NULL){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_office_list_by_filter($officeType, $division, $district, $upazila)));
    }

    function ajax_designation_filter($officeType){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_designation_list_by_filter($officeType)));
    }

    function ajax_designation_pr($officeID){
        $officeInfo = $this->Common_model->get_office_info($officeID);
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_designation_list_by_filter($officeInfo->office_type, 'pr')));
    }

    function ajax_designation_employee($officeID){
        $officeInfo = $this->Common_model->get_office_info($officeID);
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_designation_list_by_filter($officeInfo->office_type, 'employee')));
    }

    function ajax_evaluation_subject_by_id($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_evaluation_subject_by_id($id)));
    }

    function ajax_district_by_div($div_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_district_by_div_id($div_id)));
    }

    function ajax_active_district_by_div($div_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_active_district_by_div_id($div_id)));
    }

    function ajax_upazila_by_dis($dis_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_upa_tha_by_dis_id($dis_id)));
    }

    function ajax_active_upazila_by_dis($dis_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_active_upa_tha_by_dis_id($dis_id)));
    }

    function ajax_union_by_upa($upa_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_uni_by_upa_id($upa_id)));
    }

    function ajax_active_union_by_upa($upa_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_active_uni_by_upa_id($upa_id)));
    }

    function ajax_exists_identity(){
        // echo 'true';
        $item = $_POST['inputData'];
        $result = $this->Common_model->exists('users', 'username', $item);
        if ($result == 0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }

    /*
    public function script_personal_data_to_users($officeType){
        $message = '';
        $results = $this->Common_model->get_personal_data_by_office($officeType);
        // dd($results);

        if(empty($results)){
            $message = 'No data found!';
            // exit;
        }

        foreach ($results as $row) {
            $nid        = $row->national_id;
            $password   = 'nilg@1234';
            $email      = strtolower($row->email);
            // $crrnt_dept_id = $this->input->post('crrnt_dept_id');
            // Get Employee Type from post current designation
            $empType = $this->Common_model->make_employee_type($row->data_sheet_type);
            $status = $this->Common_model->make_status_type($row->status);

            // Get Office ID
            if($officeType==7){ // NILG
                $officeID = '125';                
            }elseif($officeType==6){ // Dev. Partner
                $officeID = '121';
            }elseif($officeType==5){ //City Corp.
                $officeID = '9';
                $status = '2';
            }elseif($officeType==4){ // Zila Parishad
                if($empType==1){
                    $status = '2';
                }
                // Get zila office id from district id
                $officeID = $this->Common_model->get_zila_office_by_zila_id($row->district_id);
            }elseif($officeType==3){ // Upazila Parishad
                // Get upazila office id from upazila id
                $officeID = $this->Common_model->get_upazila_office_by_upazila_id($row->upa_tha_id);
            }elseif($officeType==2){ // Paurashava
                // Get upazila office id from upazila id
                $officeID = $this->Common_model->get_paurashava_office_by_upazila_id($row->upa_tha_id);
            }elseif($officeType==1){ // Union Parishad
                // Get union office id from union id
                $officeID = $this->Common_model->get_union_office_by_union_id($row->union_id);
            }


            // Make Array Data
            $additional_data = array(
                'id'                => $row->id,
                'is_verify'         => 1,
                'is_office'          => 0,
                'office_type'       => $row->office_type_id,
                'employee_type'     => $empType,
                'crrnt_office_id'   => $officeID,
                // 'crrnt_desig_id'    => NULL,
                // 'crrnt_dept_id'     => NULL,
                'crrnt_elected_year'=> $row->curr_election_year,
                'crrnt_attend_date' => $row->curr_attend_date,
                // 'first_office_id'       => $row->first_office_id,
                // 'first_desig_id'        => $row->first_desig_id,
                'first_elected_year'=> $row->first_election_year,
                'first_attend_date' => $row->first_attend_date,

                'old_first_org_id'  => $row->first_org_id,
                'old_first_desig_id'=> $row->first_desig_id,
                'old_curr_org_id'   => $row->curr_org_id,
                'old_curr_desig_id' => $row->curr_desig_id,

                'div_id'            => $row->division_id,
                'dis_id'            => $row->district_id,
                'upa_id'            => $row->upa_tha_id,
                'union_id'          => $row->union_id,

                'name_bn'           => trim($row->name_bangla),
                'name_en'           => strtoupper($row->name_english),
                'father_name'       => $row->father_name,
                'mother_name'       => $row->mother_name,
                'nid'               => $nid,
                'mobile_no'         => bng2eng($row->telephone_mobile),
                'email'             => $row->email,
                'dob'               => $row->date_of_birth,
                'gender'            => $row->gender,
                'ms_id'             => $row->marital_status_id,
                'son_no'            => $row->son_number,
                'daughter_no'       => $row->daughter_number,

                // 'birth_place'    => $row->birth_place,
                // 'quota_id'       => $row->quota_id,
                // 'religion_id'    => $row->religion_id,
                'present_add'       => $row->present_add,
                'per_div_id'        => $row->per_div_id,
                'per_dis_id'        => $row->per_dis_id,
                'per_upa_id'        => $row->per_upa_id,
                'per_road_no'       => $row->per_road_no,
                'per_po'            => $row->per_po,
                'per_pc'            => $row->per_pc,
                'permanent_add'     => $row->permanent_add,
                
                'elected_times'     => $row->how_much_elected,
                'job_per_date'      => $row->job_per_date,
                'prl_date'          => $row->retirement_prl_date,
                'retirement_date'   => $row->retirement_date,
                'created_on'        => strtotime($row->created),
                'status'            => $status,
                'is_old'            => 1
                );
            // dd($additional_data);

            $user_group = array('10');
            if ($this->ion_auth->register($nid, $password, $email, $additional_data, $user_group)){
                if($this->Common_model->edit('personal_datas', $row->id, 'id', array('is_migrate' => 1))){
                    $message[] = $row->id.' তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
                }
            }else{
                $message[] = $row->id.' <span style="color:red">তথ্যটি সংরক্ষণ হয়নি</span>';
            }
        }        

        dd($message);
    }
    */
    

    /*
    public function script_office_union($districtID){
        $results = $this->Common_model->get_union_table($districtID);
        // dd($results);

        foreach ($results as $row) {
            // dd($row);
            $exists = $this->Common_model->unionExists($row->id);
            // dd($exists);

            if($exists){
                $message[] = 'তথ্যটি পূর্বে সংরক্ষিত হয়েছে';
            }else{
                $form_data = array(
                    'office_type' => 1,
                    'office_name' => $row->text,
                    'office_name_en' => $row->uni_name_en.' Union Parishad, '.$row->upa_name_en.', '.$row->dis_name_en,
                    'division_id' => $row->uni_div_id,
                    'district_id' => $row->uni_dis_id,
                    'upazila_id'  => $row->uni_upa_id,
                    'union_id'    => $row->id,
                    );
                // dd($form_data);
                if($this->Common_model->save('office', $form_data)){
                    $message[] = $row->text.' তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
                }
            }
        }

        dd($message);
    }

    public function script_office_pourashava($divisionID){
        $results = $this->Common_model->get_pourashava($divisionID);
        // dd($results);

        foreach ($results as $row) {
            // dd($row);
            $exists = $this->Common_model->paurashavaExists($row->pou_div_id, $row->pou_upa_id);

            if($exists){
                $message[] = 'তথ্যটি পূর্বে সংরক্ষিত হয়েছে';
            }else{
                $form_data = array(
                    'office_type' => 2,
                    'office_name' => $row->text,
                    'division_id' => $row->pou_div_id,
                    'district_id' => $row->pou_dis_id,
                    'upazila_id'  => $row->pou_upa_id,
                    // 'union_id'    => $this->input->post('union_id'),
                    );
                
                if($this->Common_model->save('office', $form_data)){
                    $message[] = 'তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
                }
            }
        }

        dd($message);
    }
    

    public function script_office_upazila($divisionID){
        $results = $this->Common_model->get_upazila_by_division($divisionID);
        // dd($results);

        foreach ($results as $row) {
            // dd($row);
            $exists = $this->Common_model->uzpExists($row->upa_div_id, $row->id);

            if($exists){
                $message[] = 'তথ্যটি পূর্বে সংরক্ষিত হয়েছে';
            }else{
                $form_data = array(
                    'office_type' => 3,
                    'office_name' => $row->text,
                    'office_name_en' => $row->upa_name_en.' Upazila Parishad, '.$row->dis_name_en,
                    'division_id' => $row->upa_div_id,
                    'district_id' => $row->upa_dis_id,
                    'upazila_id'  => $row->id,
                    );
                // dd($form_data);
                
                if($this->Common_model->save('office', $form_data)){
                    $message[] = 'তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
                }
            }
        }

        dd($message);
    }
    

    public function script_office_district_ddlg($divisionID){
        $results = $this->Common_model->get_district_by_division($divisionID);
        // dd($results);
        
        foreach ($results as $row) {
            // dd($row);           
            $form_data = array(
                'office_type' => 8,
                'office_name' => $row->text,
                'office_name_en' => $row->dis_name_en.' DDLG Office, '.$row->div_name_en,
                'division_id' => $row->dis_div_id,
                'district_id' => $row->id
                );
                // dd($form_data);

            if($this->Common_model->save('office', $form_data)){
                $message[] = 'তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
            }
            
        }

        dd($message);
        exit;
    }
    

    public function script_office_ministry(){
        // $txt_file = fopen('docs/Min-Division.txt','r');
        $txt_file = fopen('docs/Directorates_Others.txt','r');
        // $a = 1;
        while ($line = fgets($txt_file)) {         
            // echo($a." ".$line)."<br>";
            // $a++;

            $form_data = array(
                'office_type' => 10,
                'office_name' => $line
                );
                // dd($form_data);

            if($this->Common_model->save('office', $form_data)){
                $message[] = 'তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
            }
        }
        fclose($txt_file);
    }
    

    public function script_office_zila_parishad_update($officeType){
        $results = $this->Common_model->get_office_filter($officeType);
        // dd($results);
        
        foreach ($results as $row) {
            // dd($row);           
            $form_data = array(
                'office_name_en' => $row->dis_name_en.' Zilla Parishad, '.$row->div_name_en
                );
            // dd($form_data);

            if($this->Common_model->edit('office', $row->id, 'id', $form_data)){
                $message[] = 'তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
            }
        }

        dd($message);
        exit;
    }

    public function script_office_paurashava_update($officeType){
        $results = $this->Common_model->get_office_filter($officeType);
        // dd($results);
        
        foreach ($results as $row) {
            // dd($row);           
            $form_data = array(
                'office_name_en' => $row->upa_name_en.' Paurashava, '.$row->dis_name_en
                );
            // dd($form_data);

            if($this->Common_model->edit('office', $row->id, 'id', $form_data)){
                $message[] = 'তথ্যটি সঠিকভাবে সংরক্ষিত হয়েছে';
            }
        }

        dd($message);
        exit;
    }
    */
}
