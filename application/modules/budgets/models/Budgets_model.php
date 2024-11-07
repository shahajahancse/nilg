<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Budgets_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    // Manage Budget nilg list
    public function dpt_summary_training($limit, $offset, $arr = array(), $dept_id = null, $type = null,  $user_id = null) {
        $this->db->select('bd.*, bhs.session_name, d.dept_name');
        $this->db->from('budget_nilg bd');
        $this->db->join('session_year as bhs', 'bhs.id = bd.fcl_year', 'left');
        $this->db->join('department as d', 'd.id = bd.dept_id', 'left');
        $this->db->where('bd.soft_delete', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        if (!empty($arr)) {
            $this->db->where_in('bd.status', $arr);
        }
        if (!empty($dept_id)) {
            $this->db->where('bd.dept_id', $dept_id);
        }
        if (!empty($user_id)) {
            $this->db->where('bd.created_by', $user_id);
        }
        if (!empty($type)) {
            $this->db->where_in('bd.type', $type);
        }
        $data = $this->db->order_by('bd.id','desc')->get()->result();
        // dd($this->db->last_query());
        return $data;
    }

    public function dpt_summary($limit, $offset, $arr = array(), $dept_id = null, $type = null,  $user_id = null) {
        // dd($arr);
        $this->db->select('bd.*, bhs.session_name, d.dept_name, u.name_bn');
        $this->db->from('budget_revenue_summary bd');
        $this->db->join('session_year as bhs', 'bhs.id = bd.fcl_year', 'left');
        $this->db->join('department as d', 'd.id = bd.dept_id', 'left');
        $this->db->join('users as u', 'u.id = bd.created_by', 'left');
        // $this->db->where('bd.soft_delete', 1);
        $this->db->limit($limit);
        $this->db->offset($offset);
        if (!empty($arr)) {
            $this->db->where_in('bd.status', $arr);
        }
        if (!empty($dept_id)) {
            $this->db->where('bd.dept_id', $dept_id);
        }
        if (!empty($user_id)) {
            $this->db->where('bd.created_by', $user_id);
        }
        if (!empty($type)) {
            $this->db->where_in('bd.type', $type);
        }
        return $this->db->order_by('bd.id','desc')->get()->result();
    }

    public function get_budget($limit, $offset, $arr = array(), $dept_id = null, $user_id = null, $type = null) {
        //$dept_id=$_POST['department_id'];

      // result query
      $this->db->select('
                  q.*,
                  session_year.session_name,
                  dpt.name_en,
                  dpt.dept_name,
                  course.course_title as course_type,
                  office_type.office_type_name as office_type,
                ');
      $this->db->from('budget_revenue_summary as q');
      $this->db->join('session_year','q.fcl_year=session_year.id','left');
      $this->db->join('department dpt', 'q.dept_id = dpt.id', 'left');
      $this->db->join('course', 'q.course_id = course.id', 'left');
      $this->db->join('office_type', 'q.office_type = office_type.id', 'left');

      if (!empty($arr)) {
          $this->db->where_in('q.status', $arr);
      }
      if (!empty($dept_id)) {
          $this->db->where('q.dept_id', $dept_id);
      }
      if (!empty($user_id)) {
          $this->db->where('q.created_by', $user_id);
      }
      if (!empty($type)) {
          $this->db->where('q.type', $type);
      }

      $this->db->limit($limit);
      $this->db->offset($offset);
      $this->db->order_by('q.id', 'DESC');
      $result['rows'] = $this->db->get()->result();
      // count query
      $this->db->select('COUNT(*) as count');
      $this->db->from('budget_revenue_summary');
      if (!empty($arr)) {
          $this->db->where_in('status', $arr);
      }
      if (!empty($dept_id)) {
          $this->db->where('dept_id', $dept_id);
      }
      if (!empty($user_id)) {
          $this->db->where('created_by', $user_id);
      }
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;
      return $result;
    }
    public function get_budget_sub_head($id){
      $data['0'] = '-- Select Item --';
      $this->db->select('id, name_bn');
      $this->db->from('budget_head_sub');
      $this->db->where('head_id', $id);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['item_name'];
      }
      return $data;
    }
    // End Manage Budget nilg list

    // Budget nilg data info
    public function get_budget_nilg_info($id)
    {
        $this->db->select('
                budget_revenue_summary.*,
                dpt.name_en,
                dpt.dept_name,
                dptu.name_bn as dpt_h_name_bn,
                dptu.name_en as dpt_h_name_en,
                dptu.name_en as dpt_h_signature,
                acu.name_bn as acu_h_name_bn,
                acu.name_en as acu_h_name_en,
                acu.name_en as acu_h_signature,
                crt.name_bn as crt_by_name_bn,
                crt.name_en as crt_by_name_en,
                crt.name_en as crt_by_signature,
                course.course_title as course_id,
                btt.name as trainee_type,
            ');
        $this->db->from('budget_revenue_summary');
        $this->db->join('department dpt', 'budget_revenue_summary.dept_id = dpt.id', 'left');
        $this->db->join('users as dptu', 'budget_revenue_summary.dpt_head_id = dptu.id', 'left');
        $this->db->join('users as acu', 'budget_revenue_summary.acc_head_id = acu.id', 'left');
        $this->db->join('users as crt', 'budget_revenue_summary.created_by = crt.id', 'left');
        $this->db->join('course', 'budget_revenue_summary.course_id = course.id', 'left');
        $this->db->join('budget_trainee_type btt', 'budget_revenue_summary.trainee_type = btt.id', 'left');
        $this->db->where('budget_revenue_summary.id', $id);
        return $this->db->get()->row();
    }
    // End Budget nilg info

    // Manage Budget nilg data
    public function temp_get_budget_details_nilg($id) {
        $this->db->select('
                budget_revenue_summary_details.*,
                budget_head_sub.name_bn,
                budget_head.name_bn as budget_head_name,
            ');
        $this->db->from('budget_revenue_summary_details');
        $this->db->join('budget_head_sub', 'budget_revenue_summary_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_revenue_summary_details.revenue_summary_id', $id);
        $this->db->where('budget_revenue_summary_details.modify_soft_d', 1);
        return $this->db->get()->result();
    }
    public function get_budget_details_nilg($id) {
        $this->db->select('
                budget_revenue_summary_details.*,
                budget_head_sub.name_bn,
                budget_head_sub.prev_amt,
                budget_head.name_bn as budget_head_name,
            ');
        $this->db->from('budget_revenue_summary_details');
        $this->db->join('budget_head_sub', 'budget_revenue_summary_details.head_sub_id = budget_head_sub.id');
        $this->db->join('budget_head', 'budget_head_sub.head_id = budget_head.id');
        $this->db->where('budget_revenue_summary_details.revenue_summary_id', $id);
        $this->db->where('budget_revenue_summary_details.modify_soft_d', 1);
        return $this->db->get()->result();
    }
    // End Manage Budget nilg list


    // Manage Budget office list
    public function get_budget_field($limit,$offset,$arr=array(),$office_id=null,$user_id=null,$dept_id=null) {
      $this->db->select('b.*, o.office_name, c.course_title');
      $this->db->from('budget_field as b');
      $this->db->join('office as o','o.id=b.office_id', 'left');
      $this->db->join('course as c','c.id = b.course_id', 'left');

      if (!empty($arr)) {
          $this->db->where_in('b.status', $arr);
      }
      if (!empty($office_id)) {
          $this->db->where('b.office_id', $office_id);
      }
      if (!empty($user_id)) {
          $this->db->where('b.created_by', $user_id);
      }
      if (!empty($dept_id)) {
          $this->db->where('b.dept_id', $dept_id);
      }

      $this->db->limit($limit);
      $this->db->offset($offset);
      $this->db->order_by('b.id', 'DESC');
      $result['rows'] = $this->db->get()->result();

      // count query
      $this->db->select('COUNT(*) as count');
      $this->db->from('budget_field as q');
      if (!empty($arr)) {
          $this->db->where_in('q.status', $arr);
      }
      if (!empty($office_id)) {
          $this->db->where('q.office_id', $office_id);
      }
      if (!empty($user_id)) {
          $this->db->where('q.created_by', $user_id);
      }
      if (!empty($dept_id)) {
          $this->db->where('q.dept_id', $dept_id);
      }
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;
      return $result;
    }

    public function get_budget_sub_head_office($id){
      $data['0'] = '-- Select Item --';
      $this->db->select('id, name_bn');
      $this->db->from('budget_head_sub');
      $this->db->where('head_id', $id);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['item_name'];
      }
      return $data;
    }
    // End Manage Budget office list





    // budgets entry start
    public function get_budget_entry($limit, $offset) {
      // result query
      $this->db->select('q.*,session_year.session_name');
      $this->db->from('budgets as q');
      $this->db->join('session_year','q.fcl_year=session_year.id','left');
      $this->db->limit($limit);
      $this->db->offset($offset);
      $this->db->order_by('q.id', 'DESC');
      $result['rows'] = $this->db->get()->result();
      // count query
      $this->db->select('COUNT(*) as count');
      $this->db->from('budgets');
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;
      return $result;
    }



    public function get_chahida_potro($limit, $offset) {

        // result query
        $this->db->select('
                    q.*,
                    dpt.name_en,
                    dpt.dept_name,
                  ');
        $this->db->from('budget_chahida_potro as q');
        $this->db->join('department dpt', 'q.dept_id = dpt.id', 'left');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('q.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('budget_chahida_potro');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
      }
    // budgets entry end




    // report






}
