<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_trainings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data_id) {
        // result query
        $this->db->select('t.id, t.entry_date, nt.course_name');
        $this->db->from('trainers t');
        $this->db->join('nilg_trainings nt', 'nt.id = t.nilg_training_id');        
        $this->db->where('t.data_sheet_id', $data_id);
        $this->db->order_by('t.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_certificate_info($id) {
        $query = $this->db->select('t.id, t.entry_date, pd.name_bangla, ds.district_name, ut.up_th_name, dg.desig_name')
                        ->from('trainers t')
                        ->join('personal_datas pd', 'pd.id = t.data_sheet_id')
                        ->join('district ds', 'ds.id = pd.district_id', 'LEFT')
                        ->join('upazila_thana ut', 'ut.id = pd.upa_tha_id', 'LEFT')
                        ->join('designation dg', 'dg.id = pd.curr_desig_id', 'LEFT')
                        ->where('t.id', $id)
                        ->get()->row();
                        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_data_id_from_nid($item) {
        $query = $this->db->from('personal_datas')->where('national_id', $item)->get()->row()->id;
        return $query;
    }


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
