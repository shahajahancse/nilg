<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Exam_names_model extends CI_Model {
    /**
     * This model is using into the students controller
     * Load : $this->load->model('studentmodel');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function get_all($select,$from,$where){
        $sql = "SELECT $select FROM $from where $where";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
    }
    public function get_cur_all($id, $from){
	
		$dt=$this->get_all('*',$from,'id='.$id);
		return $dt;
    }
	public function getcolumnlist(){
		$sql = "SHOW COLUMNS FROM exam_names";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
	}


   
}
