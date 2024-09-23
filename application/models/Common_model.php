<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->userSessID = $this->session->userdata('user_id');
    }

    public function save($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($table, $id, $field, $data)
    {
        $this->db->where($field, $id);
        if ($this->db->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function save_batch($table, $data)
    {
        if ($this->db->insert_batch($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_data($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query =  $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    public function get_data_O($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query =  $this->db->get();
        return $query->result();

    }

    public function get_data_array($table, $id=null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($id != null) {
            foreach ($id as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $query =  $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_single_data($table, $id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $query =  $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function delete($table, $field, $id)
    {
        $this->db->where($field, $id);
        $this->db->delete($table);

        return TRUE;
    }

    public function exists($table, $field, $item)
    {
        $this->db->from($table);
        $this->db->where($field, $item);
        $query = $this->db->get();

        return ($query->num_rows() >= 1);
    }

    public function get_all($select, $from, $where)
    {
        $sql = "SELECT $select FROM $from where $where";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function get_info($table, $id)
    {
        $query = $this->db->from($table)->where('id', $id)->get()->row();
        return $query;
    }

    public function set_profile_image($id, $fileName){
        $data = array('profile_img' => $fileName);

        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return true;
    }


    // get nilg employee
    public function get_nilg_employee($crrnt_dept_id = null, $employee_type = null)
    {
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('id, name_bn');
        $this->db->from('users');
        $this->db->where('is_verify', 1);
        if ($crrnt_dept_id != null) {
            $this->db->where('crrnt_dept_id', $crrnt_dept_id);
        }
        if ($employee_type != null) {
            $this->db->where('employee_type', $employee_type);
        }
        $this->db->where('office_type', 7);
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['name_bn'];
        }
        return $data;
    }

    public function get_office_list_by_filter($officeType, $division = NULL, $district = NULL, $upazila = NULL)
    {
        $data = [];
        // $data['0'] = '-- অফিস নির্বাচন করুন --';
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
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['office_name'];
        }

        return $data;
    }

    public function get_designation_list_by_filter($officeType, $empType=NULL)
    {
        $data = [];
        // $data['0'] = '-- পদবি নির্বাচন করুন --';
        $this->db->select('id, desig_name');
        $this->db->from('designations');
        $this->db->where("FIND_IN_SET('" . $officeType . "', offices)");
        if ($empType == 'pr') {
            $this->db->where('employee_type', 1);
        } else if ($empType == 'employee'){
            $this->db->where('employee_type !=', 1);
        }
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['desig_name'];
        }

        return $data;
    }

    public function get_desig_by_type($office_type)
    {
        $this->db->select('id, desig_name');
        $this->db->from('designations');
        $this->db->where('office_type', $office_type);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_designation_by_employee_type($empType)
    {
        $this->db->select('id, desig_name');
        $this->db->from('designations');
        if ($empType == 'pr') {
            $this->db->where('employee_type', 1);
        } else if ($empType == 'employee'){
            $this->db->where('employee_type !=', 1);
        }
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_department_list_by_filter()
    {
        $data['0'] = '-- বিভাগ নির্বাচন করুন --';
        $this->db->select('id, dept_name');
        $this->db->from('department');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['dept_name'];
        }

        return $data;
    }
    public function get_office_id_by_type($type_id){
        $this->db->select('office.id, office.office_name as name');
        $this->db->from('office');
        $this->db->where('office.office_type', $type_id);
        $this->db->where('office.status', 1);
        $this->db->order_by('office.id', 'ASC');
        return $this->db->get()->result();

    }

    public function exists_nid($item, $own_id = NULL)
    {
        $this->db->from('users');
        $this->db->where('nid', $item);
        if ($own_id != NULL) {
            $this->db->where('id !=', $own_id);
        }
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function exists_mobile($item)
    {
        $this->db->from('users');
        $this->db->where('mobile_no', $item);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function exists_email($item)
    {
        $this->db->from('users');
        $this->db->where('email', $item);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function get_signature_by_designation($designationID) {
        $this->db->select('u.id, u.name_bn, u.designation, u.signature, dg.desig_name');
        $this->db->from('users u');
        $this->db->join('designations dg', 'dg.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('u.crrnt_desig_id', $designationID);
        $result = $this->db->get()->row();
        return $result;
    }

    public function get_evaluation_mark_type_id($item)
    {
        $this->db->select('id, mark_type_id');
        $this->db->from('evaluation_subject');
        $this->db->where('id', $item);
        $this->db->limit(1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_employee_type_by_designation_id($item)
    {
        $this->db->select('e.id, e.employee_type_name');
        $this->db->from('designations d');
        $this->db->join('employee_type e', 'e.id=d.employee_type', 'LEFT');
        $this->db->where('d.id', $item);
        $this->db->limit(1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_union_by_office_id($item)
    {
        $this->db->select('u.id, u.uni_name_bn');
        $this->db->from('office o');
        $this->db->join('unions u', 'u.id=o.union_id', 'LEFT');
        $this->db->where('o.id', $item);
        $this->db->limit(1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_upazila_by_office_id($item)
    {
        $this->db->select('u.id, u.upa_name_bn');
        $this->db->from('office o');
        $this->db->join('upazilas u', 'u.id=o.upazila_id', 'LEFT');
        $this->db->where('o.id', $item);
        $this->db->limit(1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_district_by_office_id($item)
    {
        $this->db->select('d.id, d.dis_name_bn');
        $this->db->from('office o');
        $this->db->join('districts d', 'd.id=o.district_id', 'LEFT');
        $this->db->where('o.id', $item);
        $this->db->limit(1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_division_by_office_id($item)
    {
        $this->db->select('d.id, d.div_name_bn');
        $this->db->from('office o');
        $this->db->join('divisions d', 'd.id=o.division_id', 'LEFT');
        $this->db->where('o.id', $item);
        $this->db->limit(1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_office()
    {
        $data[''] = lang('select');
        $this->db->select('id, office_name');
        $this->db->from('office');
        $query = $this->db->get()->result_array();

        foreach ($query as $rows) {
            $data[$rows['id']] = $rows['office_name'];
        }

        return $data;
    }

    public function get_office_info($id)
    {
        $this->db->select('o.*, ot.office_type_name, p.partner_name_full_bn, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn');
        $this->db->from('office o');
        $this->db->join('office_type ot', 'ot.id = o.office_type');
        $this->db->join('development_partner p', 'p.id = o.partner_id', 'LEFT');
        $this->db->join('divisions dv', 'dv.id = o.division_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = o.district_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = o.upazila_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = o.union_id', 'LEFT');
        $this->db->where('o.id', $id);

        $query = $this->db->get()->row();

        return $query;
    }

    public function get_designations($officeType)
    {
        $data[''] = lang('select');
        $this->db->select('id, desig_name');
        $this->db->from('designations');
        $this->db->where('office_type', $officeType);
        $query = $this->db->get()->result_array();

        foreach ($query as $rows) {
            $data[$rows['id']] = $rows['desig_name'];
        }

        return $data;
    }

    public function get_session()
    {
        $data[''] = '--- Select One ---';
        $this->db->select('id, session_name');
        $this->db->from('session_year');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result_array();

        foreach ($query as $rows) {
            $data[$rows['id']] = $rows['session_name'];
        }

        return $data;
    }

    public function get_applicaiton_trainee_request_count($office_id = null, $division = NULL, $district = NULL, $upazila = NULL, $union = NULL)
    {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('is_office', 0);
        $this->db->where('is_applied', 1);
        if ($office_id != NULL) {
            $this->db->where('crrnt_office_id', $office_id);
        }
        if ($division != NULL) {
            $this->db->where('div_id', $division);
        }
        if ($district != NULL) {
            $this->db->where('dis_id', $district);
        }
        if ($upazila != NULL) {
            $this->db->where('upa_id', $upazila);
        }
        if ($union != NULL) {
            $this->db->where('union_id', $union);
        }
        $query = $this->db->get()->result();

        return $query[0]->count;
    }


    public function get_training_applicaiton_by_office_count($office_id=NULL)
    {
        $totalApplication=0;

        // Get Trainee Training List
        $this->db->select('id');
        if($office_id != NULL){
            $this->db->where('office_id', $office_id);
        }
        $this->db->where('status !=', 3);
        $query = $this->db->get('training');

        if($query->num_rows() > 0){
            // Applicant Count
            foreach ($query->result() AS $row){
                $data = $this->get_application_by_training_id($row->id);
                $totalApplication += $data['count'];
            }
            // dd($totalApplication);
            return $totalApplication;
        }

        return $totalApplication;
    }


    public function get_employee_leave_count($type, $status = array())
    {
        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('leave_employee as el');
        $this->db->where_in('el.employee_type', $type);
        // Filter
        if(!empty($status)){
            $this->db->where_in('el.status', $status);
        }

        return $this->db->get()->row()->count;
    }

    public function get_employee_leave_count_assign($user_id, $status)
    {
        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('leave_employee as el');
        // Filter
        if($status != null){
            $this->db->where('el.status', $status);
        }
        if($user_id != null){
            $this->db->where('el.control_person', $user_id);
        }
        return $this->db->get()->row()->count;
    }

    public function get_applicaiton_trainer_request_count($division = NULL, $district = NULL, $upazila = NULL, $union = NULL)
    {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('is_office', 0);
        $this->db->where('is_applied', 1);

        if ($division != NULL) {
            $this->db->where('div_id', $division);
        }
        if ($district != NULL) {
            $this->db->where('dis_id', $district);
        }
        if ($upazila != NULL) {
            $this->db->where('upa_id', $upazila);
        }
        if ($union != NULL) {
            $this->db->where('union_id', $union);
        }
        $query = $this->db->get()->result();

        return $query[0]->count;
    }


    public function set_verification_status()
    {
        return array('' => '-নির্বাচন করুন-', '1' => 'অনুমোদন', '2' => 'বাতিল');
    }

    public function get_office_type_array()
    {
        $this->db->select('*');
        $this->db->from('office_type');
        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'ASC');
        $query =  $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_trainer_course()
    {
        $this->db->select('*');
        $this->db->from('training_schedule t');
        $this->db->where('trainer_id', $this->session->userdata('user_id'));
        $query =  $this->db->get()->result();

        return $query;
    }

    /*public function get_training()
    {
           // result query
        $this->db->select('t.*, tc.course_title, f.finance_name, ts.program_date, ts.time_start, ts.time_end, ts.session_no, ts.topic');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->session->userdata('user_id'));

        $this->db->order_by('t.id', 'DESC');

        $result['rows'] = $this->db->get()->result();


        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training t');

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }    */

    /*
    public function get_training()
    {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name, ts.program_date, ts.time_start, ts.time_end, ts.session_no, ts.topic, ts.id as schedule_id');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->session->userdata('user_id'));

        $this->db->order_by('t.id', 'DESC');

        $result['rows'] = $this->db->get()->result();


        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training t');

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }
    */


    /* public function get_training_by_id($id)
    {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name, ts.program_date, ts.time_start, ts.time_end, ts.session_no, ts.topic, ta.*');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->join('training_attachment ta', 'ta.training_id = t.id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->session->userdata('user_id'));
        $this->db->where('t.id', $id);
        $this->db->order_by('t.id', 'DESC');
        $result = $this->db->get()->row();

        return $result;
    }    */


    /*public function get_materials_by_id($id)
    {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name, ts.program_date, ts.time_start, ts.time_end, ts.session_no, ts.topic, ta.*');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->join('training_attachment ta', 'ta.training_id = t.id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->session->userdata('user_id'));
        $this->db->where('t.id', $id);
        $this->db->order_by('t.id', 'DESC');
        $result = $this->db->get()->result();

        return $result;
    }

    public function __get_application_by_training_id($trainingID) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('training_id', $trainingID);
        $this->db->where('is_verified', 0);
        $tmp = $this->db->get('training_participant')->result();

        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }*/

    public function get_dev_partner_org_type()
    {
        return array('' => '--- নির্বাচন করুন ---', '1' => 'উন্নয়ন সহযোগী সংস্থা', '2' => 'সহযোগী সংস্থা', '3' => 'সহযোগী সংস্থা (ওয়াটার এইড)');
    }

    public function get_trainee_type()
    {
        return array('' => '--- Select One ---', '1' => 'Elected Representative', '2' => 'LGIs Staff', '3' => 'TOT', '4' => 'Special Course/Project', '5' => 'E-Learning');
    }

    public function get_lgi_type()
    {
        return array('' => '--- Select One ---', '1' => 'Union Parishad', '3' => 'Upazila Parishad', '2' => 'Paurashava', '4' => 'Zila Parishad', '5' => 'City Corporation', '20' => 'Other');
    }

    public function get_development_partner()
    {
        $shortNameBn = '';
        $data[''] = lang('select');
        $this->db->select('id, partner_name_full_bn, partner_name_short_bn');
        $this->db->from('development_partner');
        $this->db->where('status', 1);
        $query = $this->db->get()->result_array();

        foreach ($query as $rows) {
            if ($rows['partner_name_short_bn'] != '') {
                $shortNameBn = ' (' . $rows['partner_name_short_bn'] . ')';
            } else {
                $shortNameBn = '';
            }

            $data[$rows['id']] = $rows['partner_name_full_bn'] . $shortNameBn;
        }

        return $data;
    }

    public function get_question_type()
    {
        return array('' => '--- নির্বাচন করুন ---', '1' => 'Input TEXT', '2' => 'Input TEXTAREA', '3' => 'Input RADIO', '4' => 'Input CHECKBOX');
    }

    public function get_data_status()
    {
        $data[''] = '--নির্বাচন করুন--';
        $this->db->select('id, status_name');
        $this->db->from('data_status');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['status_name'];
        }

        return $data;
    }

    public function get_course()
    {
        $data[''] = lang('select');
        $this->db->select('id, course_title');
        $this->db->from('course');
        $this->db->where('status', 1);
        $query =  $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['course_title'];
        }

        return $data;
    }

    public function get_course_type()
    {
        $data[''] = '--নির্বাচন করুন--';
        $this->db->select('id, ct_name');
        $this->db->from('course_type');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['ct_name'];
        }

        return $data;
    }

    public function get_course_designation()
    {
        $data[''] = '--নির্বাচন করুন--';
        $this->db->select('id, course_designation_name');
        $this->db->from('course_designation');
        $this->db->order_by('id', 'ASC');
        $this->db->where('status', 1);
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['course_designation_name'];
        }

        return $data;
    }

    public function get_lg_institute_type()
    {
        $data[''] = '--নির্বাচন করুন--';
        $this->db->select('id, office_type_name');
        $this->db->from('office_type');
        $this->db->where('is_lgi', 1);
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['office_type_name'];
        }

        return $data;
    }

    public function get_course_type_array()
    {
        $this->db->select('*');
        $this->db->from('course_type');
        $query =  $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_evaluation_subject($id=NULL)
    {
        $data = '';
        $this->db->select('id, subject_name');
        $this->db->from('evaluation_subject');
        if($id != NULL){
            $this->db->where("FIND_IN_SET('" . $id . "', course_type)");
        }
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['subject_name'];
        }

        return $data;
    }

    public function get_evaluation_mark_type()
    {
        $data[''] = '-- Select One --';
        $this->db->select('id, mark_type_name');
        $this->db->from('evaluation_mark_type');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['mark_type_name'];
        }

        return $data;
    }

    public function get_training_info($trainingID) {
        $this->db->select('t.*, c.course_title, f.finance_name');
        $this->db->from('training t');
        $this->db->join('course c', 'c.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->where('t.id', $trainingID);
        $result = $this->db->get()->row();

        return $result;
    }

    public function get_training_list()
    {
        $data[''] = lang('select');
        $this->db->select('t.id, t.participant_name, c.course_title');
        $this->db->from('training t');
        $this->db->join('training_course c', 'c.id = t.course_id', 'LEFT');
        $this->db->order_by('t.id', 'DESC');
        $query =  $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['participant_name'] . '(' . $rows['course_title'] . ')';
        }

        return $data;
    }


    public function get_my_exam_notify_count($examType = 1)
    {
        $ids = '';
        // Get Trainee Training List
        $trainingIDs = $this->db->select('training_id')->where('app_user_id', $this->userSessID)->where('is_verified', 1)->get('training_participant')->result();
        foreach ($trainingIDs as $value) {
            $ids[$value->training_id] = $value->training_id;
        }

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('evaluation');
        $this->db->where_in('training_id', $ids);
        $this->db->where('exam_type', $examType); // 1=PRE, 2=POST
        $this->db->where('is_published', 1);
        $tmp = $this->db->get()->result();

        // If Take Exam
        /*$this->db->select('COUNT(*) as count');
        $this->db->from('evaluation_question_answer');
        $this->db->where('eva_id', $evaluationID);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;

        return $ret;*/

        return $query = $tmp[0]->count;
    }

    public function get_my_exam_participant_count()
    {
        // If Take Exam

        // count query
        $q = $this->db->select('eva_id');
        $this->db->from('evaluation_question_answer');
        // $this->db->where('exam_type', $examType); // 1=PRE, 2=POST
        $this->db->where('user_id', $this->userSessID);
        $this->db->group_by('eva_id');
        $tmp = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query = $tmp[0]->count;
    }

    public function set_mark_entry_type()
    {
        return array('pre_exam' => 'Pre Exam', 'post_exam' => 'Post Exam', 'module' => 'Module', 'manual' => 'Manual');
    }

    public function get_training_status()
    {
        return array('1' => 'আসন্ন', '2' => 'চলমান', '3' => 'সম্পন্ন');
    }

    public function get_data_status_by_id($id)
    {
        $query = $this->db->select('id, status_name')->where('id', $id)->get('data_status');

        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return false;
        }
        // return array('1' => 'আসন্ন', '2' => 'চলমান', '3' => 'সম্পন্ন');
    }

    /**************** Inventory notification start *****************/
    /*=============== get nilg staff notification =================*/

    public function get_nilg_staff_notify_count()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where_in('status', [3, 4]);
        $this->db->where('updated >', "now() - interval 48 hour");
        $tmp = $this->db->get('requisitions')->result();

        // echo $this->db->last_query(); exit;
        return $tmp[0]->count;
    }

    public function get_un_available_item_notify_count()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('user_id', $this->userSessID);
        $this->db->where('is_delete', 3);
        $tmp = $this->db->get('requisition_item')->result();

        // echo $this->db->last_query(); exit;
        return $tmp[0]->count;
    }

    /*=============== get nilg stor manager notification =================*/
    public function get_stor_manager_notify_count()
    {
        $ret = array();
        $this->db->select('COUNT(*) as pending');
        $this->db->where('status', 1);
        $pending = $this->db->get('requisitions')->result();

        $this->db->select('COUNT(*) as reject');
        $this->db->where_in('current_desk', [4, 3]);
        $this->db->where('status', 3);
        $this->db->where('updated >', "now() - interval 48 hour");
        $reject = $this->db->get('requisitions')->result();
        // echo $this->db->last_query(); exit;

        $this->db->select('COUNT(*) as approve');
        $this->db->where('status', 4);
        $approve = $this->db->get('requisitions')->result();

        $ret['pending'] = $pending[0]->pending;
        $ret['reject'] = $reject[0]->reject;
        $ret['approve'] = $approve[0]->approve;
        $ret['total'] = $ret['approve'] + $ret['pending'] + $ret['reject'];
        return $ret;
    }

    /*=============== get nilg joint director notification =================*/
    public function get_joint_director_notify_count()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('current_desk', 2);
        $this->db->where('status', 2);
        $tmp = $this->db->get('requisitions')->result();

        // echo $this->db->last_query(); exit;
        return $tmp[0]->count;
    }

    /*=============== get nilg director general notification =================*/
    public function get_director_general_notify_count()
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('current_desk', 3);
        $this->db->where('status', 2);
        $tmp = $this->db->get('requisitions')->result();

        // echo $this->db->last_query(); exit;
        return $tmp[0]->count;
    }


    /************* End inventory notification ******************/



    /*public function get_trainer_course()
    {
        $this->db->select('*');
        $this->db->from('training_schedule t');
        $this->db->where('trainer_id', $this->session->userdata('user_id'));
        $query =  $this->db->get()->result();

        return $query;
    }

    public function get_training()
    {
           // result query
        $this->db->select('t.*, tc.course_title, f.finance_name, ts.program_date, ts.time_start, ts.time_end, ts.session_no, ts.topic, ts.id as schedule_id');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->session->userdata('user_id'));

        $this->db->order_by('t.id', 'DESC');

        $result['rows'] = $this->db->get()->result();


        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training t');

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }


    public function get_training_by_id($id, $schedule_id)
    {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name, ts.program_date, ts.time_start, ts.time_end, ts.session_no, ts.topic, ts.id as schedule_id');
        $this->db->from('training t');
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->where('ts.trainer_id', $this->session->userdata('user_id'));
        $this->db->where('t.id', $id);
        $this->db->where('ts.id', $schedule_id);
        $this->db->order_by('t.id', 'DESC');
        $result = $this->db->get()->row();

        return $result;
    }
*/
    public function get_materials_by_id($id, $schedule_id, $course_id)
    {
        // result query
        $this->db->select('*');
        // $this->db->from('training t');
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        // $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        // $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        // $this->db->join('training_schedule ts', 'ts.training_id = t.id', 'LEFT');
        $this->db->from('training_attachment');
        // $this->db->where('ta.uploader_id', $this->session->userdata('user_id'));
        $this->db->where('training_id', $id);
        $this->db->where('schedule_id', $schedule_id);
        $this->db->where('course_id', $course_id);

        $this->db->order_by('id', 'DESC');

        $result = $this->db->get()->result();

        // echo $this->db->last_query(); exit;


        return $result;
    }


    public function get_application_by_training_id($trainingID)
    {
        $this->db->select('COUNT(*) as count');
        $this->db->where('training_id', $trainingID);
        $this->db->where('is_verified', 0);
        $tmp = $this->db->get('training_participant')->result();

        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    // Get Coordinating Training IDs
    public function get_training_ids_by_cc($userID){
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
        }
        // dd($trainingIDs);

        return $trainingIDs;
    }










































    public function get_nid_suggestions($search)
    {
        $suggestions = array();
        // $this->db->distinct();
        $this->db->select('national_id');
        $this->db->from('personal_datas');
        $this->db->like('national_id', $search);
        // $this->db->where('deleted', 0);
        $this->db->order_by("national_id", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->national_id;
        }
        return $suggestions;
    }

    public function get_organization_suggestions($search)
    {
        $suggestions = array();
        // $this->db->distinct();
        $this->db->select('org_name');
        $this->db->from('organizations');
        $this->db->like('org_name', $search);
        // $this->db->where('deleted', 0);
        $this->db->order_by("org_name", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->org_name;
        }
        return $suggestions;
    }

    public function get_designation_suggestions($search)
    {
        $suggestions = array();
        // $this->db->distinct();
        $this->db->select('desig_name');
        $this->db->from('designation');
        $this->db->like('desig_name', $search);
        // $this->db->where('deleted', 0);
        $this->db->order_by("id", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->desig_name;
        }
        return $suggestions;
    }

    function get_post_office_suggestions($search)
    {
        $suggestions = array();
        $this->db->distinct();
        $this->db->select('per_po');
        $this->db->from('personal_datas');
        $this->db->like('per_po', $search);
        // $this->db->where('deleted', 0);
        $this->db->order_by("per_po", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->per_po;
        }
        return $suggestions;
    }

    function get_nilg_course_suggestions($search)
    {
        $suggestions = array();
        // $this->db->distinct();
        $this->db->select('course_title');
        $this->db->from('training_course');
        $this->db->like('course_title', $search);
        $this->db->where('course_type', 'NILG');
        $this->db->where('course_status', 1);
        $this->db->order_by("course_title", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->course_title;
        }
        return $suggestions;
    }

    function get_promotion_organization_suggestions($search)
    {
        $suggestions = array();
        $this->db->distinct();
        $this->db->select('promo_org_name');
        $this->db->from('per_promotion');
        $this->db->like('promo_org_name', $search);
        $this->db->order_by("promo_org_name", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->promo_org_name;
        }
        return $suggestions;
    }

    function get_promotion_designation_suggestions($search)
    {
        $suggestions = array();
        $this->db->distinct();
        $this->db->select('promo_desig_name');
        $this->db->from('per_promotion');
        $this->db->like('promo_desig_name', $search);
        $this->db->order_by("promo_desig_name", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->promo_desig_name;
        }
        return $suggestions;
    }

    function get_other_course_suggestions($search)
    {
        $suggestions = array();
        $this->db->distinct();
        $this->db->select('local_course_name');
        $this->db->from('per_local_org_training');
        $this->db->like('local_course_name', $search);
        // $this->db->where('course_type', 'Other');
        // $this->db->where('course_status', 1);
        $this->db->order_by("local_course_name", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->local_course_name;
        }
        return $suggestions;
    }

    function get_local_course_suggestions($search)
    {
        $suggestions = array();
        $this->db->select('course_title');
        $this->db->from('training_course');
        $this->db->like('course_title', $search);
        $this->db->where('course_type', 'Other');
        $this->db->where('course_status', 1);
        $this->db->order_by("course_title", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->course_title;
        }
        return $suggestions;
    }

    function get_foreign_course_suggestions($search)
    {
        $suggestions = array();
        $this->db->distinct();
        $this->db->select('foreign_course_name');
        $this->db->from('per_foreign_org_training');
        $this->db->like('foreign_course_name', $search);
        // $this->db->where('course_type', 'Foreign');
        // $this->db->where('course_status', 1);
        $this->db->order_by("foreign_course_name", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->foreign_course_name;
        }
        return $suggestions;

        /*$suggestions = array();
        $this->db->select('course_title');
        $this->db->from('training_course');
        $this->db->like('course_title', $search);
        $this->db->where('course_type', 'Foreign');
        $this->db->where('course_status', 1);
        $this->db->order_by("course_title", "asc");
        $results = $this->db->get();
        foreach ($results->result() as $row) {
            $suggestions[] = $row->course_title;
        }
        return $suggestions;*/
    }

    // public function get_first_organization_suggestions($search){
    //     $suggestions = array();
    //     $this->db->distinct();
    //     $this->db->select('first_org_name');
    //     $this->db->from('personal_datas');
    //     $this->db->like('first_org_name', $search);
    //     // $this->db->where('deleted', 0);
    //     $this->db->order_by("first_org_name", "asc");
    //     $results = $this->db->get();
    //     foreach($results->result() as $row){
    //         $suggestions[]=$row->first_org_name;
    //     }
    //     return $suggestions;
    // }

    // public function get_curr_organization_suggestions($search){
    //     $suggestions = array();
    //     $this->db->distinct();
    //     $this->db->select('curr_org_name');
    //     $this->db->from('personal_datas');
    //     $this->db->like('curr_org_name', $search);
    //     // $this->db->where('deleted', 0);
    //     $this->db->order_by("curr_org_name", "asc");
    //     $results = $this->db->get();
    //     foreach($results->result() as $row){
    //         $suggestions[]=$row->curr_org_name;
    //     }
    //     return $suggestions;
    // }



    public function exists_organization_id($item)
    {
        $this->db->select('id');
        $this->db->from('organizations');
        $this->db->where('org_name', $item);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->id;
        } else {
            return false;
        }
    }

    public function exists_designation_id($item)
    {
        $this->db->select('id');
        $this->db->from('designation');
        $this->db->where('desig_name', $item);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->id;
        } else {
            return false;
        }
    }

    public function exists_training_course_id($item)
    {
        $this->db->select('id');
        $this->db->from('training_course');
        $this->db->where('course_title', $item);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->row()->id;
        } else {
            return false;
        }
    }

    // public function exists_training_other_id($item) {
    //     $this->db->select('id');
    //     $this->db->from('training_course');
    //     $this->db->where('course_title', $item);
    //     $query = $this->db->get();

    //     if ($query->num_rows() >= 1) {
    //         return $query->row()->id;
    //     }else{
    //         return false;
    //     }
    // }

    public function exists_organization_name($item)
    {
        $this->db->from('organizations');
        $this->db->where('org_name', $item);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /*public function exists_national_id($item)
    {
        $this->db->from('personal_datas');
        $this->db->where('national_id', $item);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }*/

    public function national_id_exists($item)
    {
        $this->db->from('users');
        $this->db->where('nid', $item);
        $query = $this->db->get();

        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function get_boards()
    {
        $data['0'] = 'Select';
        $this->db->select('id, board_name');
        $this->db->from('boards');
        $this->db->order_by('board_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['board_name'];
        }

        return $data;
    }

    public function get_subjects()
    {
        $data['0'] = 'Select';
        $this->db->select('id, sub_name');
        $this->db->from('subjects');
        $this->db->order_by('sub_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['sub_name'];
        }

        return $data;
    }

    public function get_exams()
    {
        $data['0'] = 'Select';
        $this->db->select('id, exam_name');
        $this->db->from('exam_names');
        $this->db->order_by('exam_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['exam_name'];
        }

        return $data;
    }

    public function get_dropdown($table, $field, $id)
    {
        $data[''] = '-- ক্যাটাগরি নির্বাচন করুন --';
        $this->db->select("$id, $field");
        $this->db->from($table);
        $this->db->order_by($id, 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows[$id]] = $rows[$field];
        }

        return $data;
    }


    public function get_nilg_course()
    {
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('id, course_title');
        $this->db->from('training_course');
        $this->db->where('course_type', 'NILG');
        $this->db->order_by('course_title', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['course_title'];
        }

        return $data;
    }

    function get_financing()
    {
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('id, finance_name');
        $this->db->from('financing');
        $this->db->order_by('finance_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['finance_name'];
        }

        return $data;
    }


    public function get_union()
    {
        $district[''] = lang('select_union');
        $this->db->select('id, uni_name_bn');
        $this->db->from('unions');
        $this->db->order_by('uni_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['uni_name_bn'];
        }

        return $district;
    }

    public function get_union_active()
    {
        $district[''] = lang('select_union');
        $this->db->select('id, uni_name_bn');
        $this->db->from('unions');
        $this->db->where('status', 1);
        $this->db->order_by('uni_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['uni_name_bn'];
        }

        return $district;
    }

    public function get_pouroshova()
    {
        $district[''] = '-পৌরসভা নির্বাচন করুন-';
        $this->db->select('id, pou_name_bn');
        $this->db->from('pourashava');
        $this->db->where('status', 1);
        $this->db->order_by('pou_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['pou_name_bn'];
        }

        return $district;
    }

    public function get_upazila_thana()
    {
        $district[''] = lang('select_up_thana');
        $this->db->select('id, upa_name_bn');
        $this->db->from('upazilas');
        $this->db->order_by('upa_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['upa_name_bn'];
        }

        return $district;
    }

    public function get_quota()
    {
        $district[''] = lang('select');
        $this->db->select('id, quota_name');
        $this->db->from('job_quota');
        // $this->db->order_by('quota_name', 'ASC');/*  */
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['quota_name'];
        }

        return $district;
    }

    public function get_religion()
    {
        $district[''] = lang('select');
        $this->db->select('id, religion_name');
        $this->db->from('religion');
        // $this->db->order_by('religion_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['religion_name'];
        }

        return $district;
    }

    public function get_upazila_thana_active()
    {
        $district[''] = lang('select_up_thana');
        $this->db->select('id, upa_name_bn');
        $this->db->from('upazilas');
        $this->db->where('status', 1);
        $this->db->order_by('upa_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['upa_name_bn'];
        }

        return $district;
    }

    public function get_district()
    {
        $district[''] = lang('select_district');
        $this->db->select('id, dis_name_bn');
        $this->db->from('districts');
        $this->db->order_by('dis_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['dis_name_bn'];
        }

        return $district;
    }

    public function get_district_active()
    {
        $district[''] = lang('select_district');
        $this->db->select('id, dis_name_bn');
        $this->db->from('districts');
        $this->db->where('status', 1);
        $this->db->order_by('dis_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['dis_name_bn'];
        }

        return $district;
    }

    public function get_division()
    {
        $data[''] = lang('select_division');
        $this->db->select('id, div_name_bn');
        $this->db->from('divisions');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['div_name_bn'];
        }

        return $data;
    }

    public function get_division_active()
    {
        $data[''] = lang('select_division');
        $this->db->select('id, div_name_bn');
        $this->db->from('divisions');
        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['div_name_bn'];
        }

        return $data;
    }


    public function get_district_by_div_id($id)
    {
        $data['0'] = lang('select_district');
        $this->db->select('id, dis_name_bn');
        $this->db->from('districts');
        $this->db->where('dis_div_id', $id);
        // $this->db->where('status',1);
        $this->db->order_by('dis_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['dis_name_bn'];
        }

        return $data;
    }

    public function get_evaluation_subject_by_id($id)
    {
        $data = [];
        $this->db->select('id, subject_name');
        $this->db->from('evaluation_subject');
        $this->db->where("FIND_IN_SET('" . $id . "', course_type)");
        // $this->db->where('status',1);
        $this->db->order_by('subject_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['subject_name'];
        }

        return $data;
    }

    public function get_active_district_by_div_id($id)
    {
        $data['0'] = lang('select_district');
        $this->db->select('id, dis_name_bn');
        $this->db->from('districts');
        $this->db->where('dis_div_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('dis_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['dis_name_bn'];
        }

        return $data;
    }

    public function get_upa_tha_by_dis_id($id)
    {
        $data['0'] = lang('select_up_thana');
        $this->db->select('id, upa_name_bn');
        $this->db->from('upazilas');
        $this->db->where('upa_dis_id', $id);
        // $this->db->where('status',1);
        $this->db->order_by('upa_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['upa_name_bn'];
        }

        return $data;
    }

    public function get_active_upa_tha_by_dis_id($id)
    {
        $data['0'] = lang('select_up_thana');
        $this->db->select('id, upa_name_bn');
        $this->db->from('upazilas');
        $this->db->where('upa_dis_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('upa_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['upa_name_bn'];
        }

        return $data;
    }

    public function get_uni_by_upa_id($id)
    {
        $data['0'] = lang('select_union');
        $this->db->select('id, uni_name_bn');
        $this->db->from('unions');
        $this->db->where('uni_upa_id', $id);
        // $this->db->where('status',1);
        $this->db->order_by('uni_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['uni_name_bn'];
        }

        return $data;
    }

    public function get_active_uni_by_upa_id($id)
    {
        $data['0'] = lang('select_union');
        $this->db->select('id, uni_name_bn');
        $this->db->from('unions');
        $this->db->where('uni_upa_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('uni_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['uni_name_bn'];
        }

        return $data;
    }

    public function get_office_type()
    {
        $data[''] = lang('select_office_type');
        $this->db->select('id, office_type_name');
        $this->db->from('office_type');
        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['office_type_name'];
        }

        return $data;
    }

    public function get_employee_type()
    {
        $data[''] = '--এমপ্লয়ীর ধরণ নির্বাচন করুন--';
        $this->db->select('id, employee_type_name');
        $this->db->from('employee_type');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['employee_type_name'];
        }

        return $data;
    }

    public function get_blood_group()
    {
        $district[''] = 'Select Blood Group';
        $this->db->select('id, bg_name_en');
        $this->db->from('blood_group');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['bg_name_en'];
        }

        return $district;
    }

    public function get_marital_status()
    {
        $data[''] = lang('select');
        $this->db->select('id, marital_status_name');
        $this->db->from('marital_status');
        $query = $this->db->get()->result_array();

        foreach ($query as $rows) {
            $data[$rows['id']] = $rows['marital_status_name'];
        }

        return $data;
    }

    public function get_dis_by_div_id($id)
    {
        $district[''] = lang('select_district');
        $this->db->select('id, div_id, district_name');
        $this->db->from('district');
        $this->db->where('div_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('district_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $district[$rows['id']] = $rows['district_name'];
        }

        return $district;
    }

    public function get_nilg_trainings()
    {
        $data[''] = 'Select One';
        $this->db->select('id, course_name');
        $this->db->from('nilg_trainings');
        $this->db->order_by('course_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['course_name'];
        }

        return $data;
    }

    public function get_data_type()
    {
        $data[''] = lang('select_data_type');
        $this->db->select('id, data_type_name');
        $this->db->from('data_type');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['data_type_name'];
        }
        return $data;
    }

    public function get_organizations()
    {
        $data[''] = 'Select One';
        $this->db->select('id, org_name');
        $this->db->from('organizations');
        $this->db->order_by('org_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['org_name'];
        }

        return $data;
    }

    public function get_organization_type()
    {
        $data[''] = 'Select One';
        $this->db->select('id, type_name');
        $this->db->from('organization_type');
        $this->db->order_by('type_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['type_name'];
        }

        return $data;
    }

    public function get_designation()
    {
        $data[''] = 'Select One';
        $this->db->select('id, desig_name');
        $this->db->from('designation');
        $this->db->order_by('desig_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['desig_name'];
        }

        return $data;
    }

    public function get_training_type()
    {
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('id, type_name');
        $this->db->from('training_type');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['type_name'];
        }

        return $data;
    }

    public function get_certificate_templates()
    {
        $data[''] = '-- নির্বাচন করুন --';
        $this->db->select('id, template_title');
        $this->db->from('certificate_template');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['template_title'];
        }

        return $data;
    }

    public function get_material()
    {
        $data[''] = 'Select One';
        $this->db->select('id, material_name');
        $this->db->from('material');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['material_name'];
        }

        return $data;
    }

    public function get_datasheet_status()
    {
        return array('' => '-- নির্বাচন করুন ---', '1' => 'কর্মরত / নির্বাচিত', '2' => 'অনির্বাচিত', '3' => 'অবসরপ্রাপ্ত', '4' => 'স্থগিত', '5' => 'বহিষ্কৃত', '6' => 'মৃত', '7' => 'আর্কাইভ');
    }

    public function get_leave_type()
    {
        return array('' => '-- নির্বাচন করুন ---', '1' => 'অর্জিত ছুটি', '2' => 'অর্জিত  (শ্রান্তি বিনোদন) ছুটি', '3' => 'অন্যান্য ছুটি');
    }

    public function get_scout_group()
    {
        return array('' => '--- Select Section ---', '1' => 'Cub Scout', '2' => 'Scout', '3' => 'Rover Scout');
    }

    public function get_dd_training_list()
    {
        return array('' => '--- Select Category ---', '1' => 'ওরিয়েন্টেশন কোর্স', '2' => 'বেসিক কোর্স', '3' => 'এডভান্স কোর্স', '4' => 'স্কিল কোর্স', '5' => 'প্রশিক্ষকদের কোর্স', '6' => 'ইউনিট লিডার কোর্স', '7' => 'অন্যান্য লিডার কোর্স');
    }


    public function get_user_details($id=null)
    {
        // , u.office_type_id

        // $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.is_office, u.employee_type, u.nid, u.name_bn, u.nid, u.dob, u.mobile_no, u.email, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, u.crrnt_office_id, oc.office_name as current_office_name, cd.desig_name as current_desig_name, u.office_name as user_office_name, u.created_on, u.profile_img, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.office_name, u.designation, u.height_education, u.interested_subjects, u.present_add');

        $this->db->select('u.id, u.office_type, ot.office_type_name, u.username, u.is_office, u.employee_type, u.nid, u.first_name, u.name_bn, u.nid, u.dob, u.mobile_no, u.email, u.div_id, u.dis_id, u.upa_id, u.union_id, u.is_verify, u.is_applied, u.crrnt_office_id, co.office_name as current_office_name, dg.dept_name as current_dept_name, cd.desig_name as current_desig_name, u.office_name as user_office_name, u.created_on, u.profile_img, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, u.office_name, u.designation, u.height_education, u.interested_subjects, u.present_add, u.decline_reason');

        $this->db->from('users u');
        $this->db->join('office co', 'co.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = u.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type', 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id', 'LEFT');
        if ($id != null) {
            $this->db->where('u.id', $id);
        }else{
            $this->db->where('u.id', $this->session->userdata('user_id'));
        }
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_user_info()
    {
        $this->db->select('u.id, u.username, u.is_office, u.office_type, u.employee_type, u.name_bn, u.nid, u.mobile_no, u.email, u.dob, u.crrnt_office_id, u.crrnt_desig_id, u.office_id, u.div_id, u.dis_id, u.upa_id, u.union_id, e.employee_type_name, o.office_name, d.desig_name, u.designation, u.office_name, ot.office_type_name, di.div_name_bn, dis.dis_name_bn, upa.upa_name_bn, o.office_name, u.profile_img');
        $this->db->from('users u');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id=u.office_type', 'LEFT');
        $this->db->join('divisions di', 'di.id=u.div_id', 'LEFT');
        $this->db->join('districts dis', 'dis.id=u.dis_id', 'LEFT');
        $this->db->join('upazilas upa', 'upa.id=u.upa_id', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();

        return $query;
    }


    /*
    public function get_user_submitted_info()
    {
        $this->db->select('u.id, u.username, u.is_office, u.office_type, u.employee_type, u.name_bn, u.name_en, u.father_name, u.mother_name, u.nid, u.mobile_no, u.email, u.dob, u.crrnt_office_id, u.crrnt_desig_id, u.office_id, u.div_id, u.dis_id, u.upa_id, u.union_id, u.created_on, u.modified, e.employee_type_name, o.office_name, d.desig_name, u.designation, u.office_name, u.present_add, u.interested_subjects, u.profile_img');
        $this->db->from('users u');
        $this->db->join('employee_type e', 'e.id = u.employee_type', 'LEFT');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('designations d', 'd.id = u.crrnt_desig_id', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();

        return $query;
    }
    */

    public function get_office_info_by_session()
    {
        $this->db->select('u.id, u.username, u.name_bn, u.is_office, u.office_type, ot.office_type_name, u.crrnt_office_id, u.crrnt_dept_id, u.crrnt_desig_id, o.office_name, u.office_name as user_office_name, u.div_id, u.dis_id, u.upa_id, u.union_id, dv.div_name_bn, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn, u.profile_img, FROM_UNIXTIME(u.last_login) AS last_login');
        $this->db->from('users u');
        $this->db->join('office o', 'o.id = u.crrnt_office_id', 'LEFT');
        $this->db->join('office_type ot', 'ot.id = u.office_type', 'LEFT');
        $this->db->join('divisions dv', 'dv.id = u.div_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = u.dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = u.upa_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = u.union_id', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();

        return $query;
    }

    // Check NILG Employee (trainee) Extra User Access by Designation
    public function get_nilg_user_access_by_current_designation($officeType, $userDesignation = NULL)
    {
        if($officeType == 7 && $userDesignation == 105){
            // ID: 106 (স্টোর কীপার) - Store Keeper Designation
            return 'sk';

        }elseif($officeType == 7 && $userDesignation == 90){
            // ID: 91 (যুগ্ম-পরিচালক (কর্মসূচি ও মূল্যায়ন))
            return 'jd';

        }elseif($officeType == 7 && $userDesignation == 83){
            // ID: 83 (মহাপরিচালক (অতিরিক্ত সচিব))
            return 'dg';

        }elseif($officeType == 7 && ($userDesignation != 105 || $userDesignation != 9 || $userDesignation != 83)){
            // All NILG Employee
            return 'employee';

        }else{
            return false;
        }

        return '';
    }



    public function all_journal_amount($type){
        $data=array();
        $this->db->select_sum('amount');
        $this->db->where('status',2);
        $this->db->where('type',1);
        if ($type == 'revenue') {
            $data=$this->db->get('budget_j_gov_revenue_register')->row();
        }elseif ($type == 'publication') {
            $data=$this->db->get('budget_j_publication_register')->row();
        }elseif ($type == 'miscellaneous') {
            $data=$this->db->get('budget_j_miscellaneous_register')->row();
        }elseif ($type == 'pension') {
            $data=$this->db->get('budget_j_pension_register')->row();
        }elseif ($type == 'hostel') {
            $this->db->get('budget_j_hostel_register')->row();
        }elseif ($type == 'gpf') {
            $data=$this->db->get('budget_j_gpf_register')->row();
        }elseif ($type == 'cheque') {
            $data=$this->db->get('budget_j_cheque_register')->row();
        }

        if (empty($data)) {
            return 0;
        }else{
            return $data->amount;
        }
    }


    /************************* User Insert Script ***************************/
    /************************************************************************/
    /*
    public function get_personal_data_by_office($officeType){
        $this->db->select('*');
        $this->db->from('personal_datas');
        $this->db->where('is_migrate', 0);
        // $this->db->where('id', '9102');
        $this->db->where('office_type_id', $officeType);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(300);

        return $this->db->get()->result();
    }

    public function get_union_office_by_union_id($id)
    {
        $this->db->select('*');
        $this->db->from('office');
        $this->db->where('office_type', 1);
        $this->db->where('union_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }

    public function get_paurashava_office_by_upazila_id($id)
    {
        $this->db->select('*');
        $this->db->from('office');
        $this->db->where('office_type', 2);
        $this->db->where('upazila_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }

    public function get_upazila_office_by_upazila_id($id)
    {
        $this->db->select('*');
        $this->db->from('office');
        $this->db->where('office_type', 3);
        $this->db->where('upazila_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }


    public function get_zila_office_by_zila_id($id)
    {
        $this->db->select('*');
        $this->db->from('office');
        $this->db->where('office_type', 4);
        $this->db->where('district_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }



    public function make_employee_type($type){
        if($type == 1){
            return '1';
        }elseif($type == 2){
            return '2';
        }elseif($type == 3){
            return '3';
        }elseif($type == 4){
            return '2';
        }elseif($type == 5){
            return '3';
        }elseif($type == 6){
            return '2';
        }elseif($type == 7){
            return '2';
        }elseif($type == 8){
            return '2';
        }else{
            return '';
        }
    }

    public function make_status_type($type){
        if($type == 1){
            return '1'; // Elected 2
        }elseif($type == 2){
            return '3';
        }elseif($type == 3){
            return '4';
        }elseif($type == 5){
            return '6';
        }elseif($type == 6){
            return '7';
        }elseif($type == 7){
            return '8';
        }
    }
    */


    // Office Insert Script
    /*
    public function get_union_table($districtID){
        $this->db->select('uni.*, CONCAT(uni.uni_name_bn, " ইউনিয়ন ", "পরিষদ", ", ", ut.upa_name_bn, ", ", d.dis_name_bn) AS text, uni.uni_name_bn, uni.uni_name_en, uni.status, d.dis_name_bn, d.dis_name_en, ut.upa_name_bn, ut.upa_name_en');
        $this->db->from('unions uni');
        $this->db->join('districts d', 'd.id=uni.uni_dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=uni.uni_upa_id', 'LEFT');
        $this->db->where('uni.uni_dis_id', $districtID);
        $this->db->order_by('uni.id', 'ASC');

        return $this->db->get()->result();
    }

    public function unionExists($unionID)
    {
        $this->db->from('office');
        $this->db->where('office_type', 1);
        $this->db->where('union_id', $unionID);
        $query = $this->db->get();

        return ($query->num_rows() >= 1);
    }

    public function get_pourashava($divisionID) {
        // result query
        $this->db->select('p.*, CONCAT(p.pou_name_bn, ", ", d.dis_name_bn) AS text, p.pou_name_bn, p.pou_name_en, p.status, d.dis_name_bn, ut.upa_name_bn');
        $this->db->from('pourashava p');
        $this->db->join('districts d', 'd.id=p.pou_dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=p.pou_upa_id', 'LEFT');
        $this->db->where('p.pou_div_id', $divisionID);
        $this->db->order_by('p.id', 'DESC');

        return $this->db->get()->result();
        // echo $this->db->last_query(); exit;
    }

    public function paurashavaExists($divsionID, $upazilaID)
    {
        $this->db->from('office');
        $this->db->where('office_type', 2);
        $this->db->where('division_id', $divsionID);
        $this->db->where('upazila_id', $upazilaID);
        $query = $this->db->get();

        return ($query->num_rows() >= 1);
    }

    public function get_upazila_by_division($divisionID) {
        // result query
        $this->db->select('upa.*, CONCAT(upa.upa_name_bn, " উপজেলা ", "পরিষদ", ", ", d.dis_name_bn) AS text, upa.upa_name_bn, upa.upa_name_en, d.dis_name_bn, d.dis_name_en');
        $this->db->from('upazilas upa');
        $this->db->join('districts d', 'd.id=upa.upa_dis_id', 'LEFT');
        $this->db->where('upa.upa_div_id', $divisionID);
        $this->db->where('upa.is_thana', 0);
        $this->db->order_by('upa.id', 'DESC');

        return $this->db->get()->result();
        // echo $this->db->last_query(); exit;
    }

    public function uzpExists($divsionID, $upazilaID)
    {
        $this->db->from('office');
        $this->db->where('office_type', 3);
        $this->db->where('division_id', $divsionID);
        $this->db->where('upazila_id', $upazilaID);
        $query = $this->db->get();

        return ($query->num_rows() >= 1);
    }

    public function get_district_by_division($divisionID) {
        // result query
        $this->db->select('dis.*, CONCAT(dis.dis_name_bn, " ডিডিএলজি ", "অফিস", ", ", div.div_name_bn) AS text, dis.dis_name_bn, dis.dis_name_en, div.div_name_bn, div.div_name_en');
        $this->db->from('districts dis');
        $this->db->join('divisions div', 'div.id=dis.dis_div_id', 'LEFT');
        $this->db->where('dis.dis_div_id', $divisionID);
        $this->db->order_by('dis.id', 'DESC');

        return $this->db->get()->result();
        // echo $this->db->last_query(); exit;
    }


    public function get_office_filter($officeType)
    {
        $data = [];
        // $data['0'] = '-- অফিস নির্বাচন করুন --';
        $this->db->select('o.id, o.office_name, o.district_id, u.upa_name_en, d.dis_name_en, div.div_name_en');
        $this->db->from('office o');
        $this->db->join('upazilas u', 'u.id=o.upazila_id', 'LEFT');
        $this->db->join('districts d', 'd.id=o.district_id', 'LEFT');
        $this->db->join('divisions div', 'div.id=o.division_id', 'LEFT');
        $this->db->where('o.office_type', $officeType);
        $this->db->order_by('o.id', 'ASC');

        return $this->db->get()->result();
    }
    */
}
