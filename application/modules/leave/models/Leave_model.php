<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leave_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0, $status = null, $user = null, $approve_person=null) {
        // result query
        $this->db->select('el.*, et.leave_name_bn, et.leave_name_en, users.name_bn, dg.dept_name, cd.desig_name');
        $this->db->from('leave_employee el');
        $this->db->join('leave_type et', 'et.id = el.leave_type', 'LEFT');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('el.id', 'DESC');
        // Filter

        if($status != null){
            $this->db->where('el.status', $status);
        }

        if($user != null){
            $this->db->where('el.user_id', $user);
        }

        if($approve_person != null){
            $this->db->where('el.approve_person', $approve_person);
        }

        if($this->input->get('from_date') && $this->input->get('to_date')){
            $this->db->where('el.from_date >=', $this->input->get('from_date'));
            $this->db->where('el.from_date <=', $this->input->get('to_date'));
        }

        if($this->input->get('user_id')){
            $this->db->where('el.user_id', $this->input->get('user_id'));
        }

        if($this->input->get('status')){
            $this->db->where('el.status', $this->input->get('status'));
        }

        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;


        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('leave_employee as el');
        // Filter
        if($this->input->get('from_date') && $this->input->get('to_date')){
            $this->db->where('el.from_date >=', $this->input->get('from_date'));
            $this->db->where('el.from_date <=', $this->input->get('to_date'));
        }

        if($status != null){
            $this->db->where('el.status', $status);
        }

        if($user != null){
            $this->db->where('el.user_id', $user);
        }

        if($approve_person != null){
            $this->db->where('el.approve_person', $approve_person);
        }

        if($this->input->get('user_id')){
            $this->db->where('el.user_id', $this->input->get('user_id'));
        }

        if($this->input->get('status')){
            $this->db->where('el.status', $this->input->get('status'));
        }

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_list($limit = 1000, $offset = 0, $status = array(), $type = null) {
        // result query
        $this->db->select('el.*, et.leave_name_bn, et.leave_name_en, users.name_bn, dg.dept_name, cd.desig_name');
        $this->db->from('leave_employee el');
        $this->db->join('leave_type et', 'et.id = el.leave_type', 'LEFT');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('el.id', 'DESC');
        // Filter
        if(!empty($status)){
            $this->db->where_in('el.status', $status);
        }
        if(!empty($type)){
            $this->db->where('el.employee_type', $type);
        }
        if($this->input->get('user_id')){
            $this->db->where('el.user_id', $this->input->get('user_id'));
        }
        if($this->input->get('from_date') && $this->input->get('to_date')){
            $this->db->where('el.from_date >=', $this->input->get('from_date'));
            $this->db->where('el.from_date <=', $this->input->get('to_date'));
        }
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;


        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('leave_employee as el');
        // Filter
        if(!empty($status)){
            $this->db->where_in('el.status', $status);
        }
        if(!empty($type)){
            $this->db->where('el.employee_type', $type);
        }
        if($this->input->get('from_date') && $this->input->get('to_date')){
            $this->db->where('el.from_date >=', $this->input->get('from_date'));
            $this->db->where('el.from_date <=', $this->input->get('to_date'));
        }
        if($this->input->get('user_id')){
            $this->db->where('el.user_id', $this->input->get('user_id'));
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_list_assign($limit = 1000, $offset = 0, $user_id, $status = null) {
        // result query
        $this->db->select('el.*, et.leave_name_bn, et.leave_name_en, users.name_bn, dg.dept_name, cd.desig_name');
        $this->db->from('leave_employee el');
        $this->db->join('leave_type et', 'et.id = el.leave_type', 'LEFT');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('el.id', 'DESC');
        // Filter
        if($status != null){
            $this->db->where('el.status', $status);
        }
        if($user_id != null){
            $this->db->where('el.control_person', $user_id);
        }
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;


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
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    // Finding the number of days between two dates
    function GetDays($StartDate, $EndDate)
    {
        $StartDate = date("Y-m-d", strtotime($StartDate));
        $EndDate = date("Y-m-d", strtotime($EndDate));

        // Start the variable off with the start date
        $Days[] = $StartDate;

        // Set a 'temp' variable, CurrentDate, with
        // the start date - before beginning the loop
        $CurrentDate = $StartDate;

        // While the current date is less than the end date
        while($CurrentDate < $EndDate){
            // Add a day to the current date
            $CurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($CurrentDate)));

            // Add this new day to the Days array
                $Days[] = $CurrentDate;
            //print_r($Days);
        }

        // Once the loop has finished, return the

        return $Days;
    }

    public function get_user($table, $id) {
        $query = $this->db->from($table)->where('id', $id)->get()->row();
        return $query;
    }

    public function get_info($id) {
        $this->db->select('el.*, u.name_bn, users.employee_type');
        $this->db->from('leave_employee as el');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('users u', 'u.id = el.assign_person', 'LEFT');
        $this->db->where('el.id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_leave_type(){
        $data[''] = lang('select');
        $this->db->select('l.id, l.leave_name_bn as text, l.leave_name_en');
        $this->db->from('leave_type l');
        $this->db->where('status', 1);
        $query = $this->db->get();

        foreach ($query->result_array() as $rows) {
            $data[$rows['id']] = $rows['text'] ." >> ". $rows['leave_name_en'];
        }

        return $data;
    }

    public function get_yearly_leave_count($user = null){
        // get total leave
        $results['total_leave'] = $this->db->from('leave_type')->where('status',1)->get()->result();

        // count used leave
        $this->db->select('
                    SUM(CASE WHEN el.leave_type = 8 THEN el.leave_days ELSE 0 END) as casual_leave,
                    SUM(CASE WHEN el.leave_type = 12 THEN el.leave_days ELSE 0 END) as optional_leave
                ');
        $this->db->where_in('el.leave_type', array(8, 12));
        $this->db->where('el.user_id', $user);
        $this->db->where('el.status', 4);
        $this->db->where('el.from_date >=', date('Y-01-01'));
        $this->db->where('el.from_date <=', date('Y-12-31'));
        $results['used_leave'] = $this->db->get('leave_employee el')->row();
        return $results;
    }

    public function get_report($status = array(), $from_date = null, $to_date = null, $type = null) {
        // result query
        $this->db->select('el.*, et.leave_name_bn, et.leave_name_en, users.name_bn, dg.dept_name, cd.desig_name');
        $this->db->from('leave_employee el');
        $this->db->join('leave_type et', 'et.id = el.leave_type', 'LEFT');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        $this->db->order_by('el.id', 'DESC');
        // Filter
        if($from_date != null && $to_date != null){
            $this->db->where('el.from_date >=', $from_date);
            $this->db->where('el.from_date <=', $to_date);
        }

        if(!empty($status)){
            $this->db->where_in('el.status', $status);
        }

        if($type != null){
            $this->db->where('el.leave_type', $type);
        }

        return $this->db->get()->result();
    }

    public function get_current_report($status = null, $date_from, $date_to) {
        // result query
        $this->db->select('el.*, et.leave_name_bn, et.leave_name_en, users.name_bn, dg.dept_name, cd.desig_name');
        $this->db->from('leave_employee el');
        $this->db->join('leave_type et', 'et.id = el.leave_type', 'LEFT');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        $this->db->order_by('el.id', 'DESC');
        // Filter
        $this->db->where('el.from_date >=', $date_from);
        $this->db->where('el.to_date <=', $date_to);

        if($status != null){
            $this->db->where('el.status', $status);
        }

        return $this->db->get()->result();
    }

    public function get_user_info($user_id) {
        $this->db->select('users.name_bn, dg.dept_name, cd.desig_name');
        $this->db->from('users');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        $this->db->where('users.id', $user_id);
        $result = $this->db->get()->row();

        return $result;
    }

    public function get_enjoyed_leave_report($date_from, $date_to, $status = null) {
        $this->db->select('users.name_bn, dg.dept_name, cd.desig_name,
                SUM(CASE WHEN el.leave_type = 8 THEN el.leave_days ELSE 0 END) as casual_leave,
                SUM(CASE WHEN el.leave_type = 12 THEN el.leave_days ELSE 0 END) as optional_leave,
            ');
        $this->db->from('leave_employee el');
        $this->db->join('users', 'users.id = el.user_id', 'LEFT');
        $this->db->join('department dg', 'dg.id = users.crrnt_dept_id', 'LEFT');
        $this->db->join('designations cd', 'cd.id = users.crrnt_desig_id', 'LEFT');
        // Filter
        $this->db->where('el.from_date >=', $date_from);
        $this->db->where('el.to_date <=', $date_to);

        if($status != null){
            $this->db->where('el.status', $status);
        }
        $this->db->order_by('el.id', 'DESC');
        $this->db->group_by('el.user_id');

        $results = $this->db->get()->result();
        return $results;
    }

}
