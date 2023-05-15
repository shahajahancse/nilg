<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trainer_register_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('*');
        $this->db->from('trainer_register');  
        if($this->input->get('name') != NULL){
            $this->db->like('trainer_name', $this->input->get('name'));
        }
        if($this->input->get('designation') != NULL){
            $this->db->like('trainer_desig', $this->input->get('designation'));
        }
        if($this->input->get('mobile_no') != NULL){
            $this->db->where('mobile', $this->input->get('mobile_no')); 
        }
        if($this->input->get('status') != NULL){
            $this->db->where('status', $this->input->get('status')); 
        }
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        //echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('trainer_register');
        if($this->input->get('name') != NULL){
            $this->db->like('trainer_name', $this->input->get('name'));
        }
        if($this->input->get('designation') != NULL){
            $this->db->like('trainer_desig', $this->input->get('designation'));
        }
        if($this->input->get('mobile_no') != NULL){
            $this->db->where('mobile', $this->input->get('mobile_no')); 
        }
        if($this->input->get('status') != NULL){
            $this->db->where('status', $this->input->get('status')); 
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_trainer_list($form_data) {
        // result query
        $this->db->select('*');
        $this->db->from('trainer_register');  
        if($form_data['name'] != NULL){
            $this->db->like('trainer_name', $form_data['name']);
        }
        if($form_data['designation'] != NULL){
            $this->db->like('trainer_desig', $form_data['designation']);
        }
        if($form_data['mobile_no'] != NULL){
            $this->db->where('mobile', $form_data['mobile_no']); 
        }
        if($form_data['status'] != NULL){
            $this->db->where('status', $form_data['status']); 
        }       
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_info($id) {
        $this->db->select('*');
        $this->db->from('trainer_register');
        $this->db->where('id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

}
