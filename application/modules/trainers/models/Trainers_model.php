<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Trainers_model extends CI_Model {
    /**
     * This model is using into the students controller
     * Load : $this->load->model('studentmodel');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

 //    public function get_all($select,$from,$where){
 //        $sql = "SELECT $select FROM $from where $where";

 //        $query = $this->db->query($sql);
 //        if ($query->num_rows() > 0) {
 //             return $query->result_array();
 //        }
 //    }

	// public function get_prosikhon($select,$from,$where){
 //        $sql = "SELECT $select FROM $from where $where";

 //        $query = $this->db->query($sql);
 //        if ($query->num_rows() > 0) {
 //             return $query->result_array();
 //        }
 //    }
    
	public function get_for_list($table) {
        $data = array();
        $query = $this->db->query("SELECT * FROM $table");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    public function get_cur_all($id, $from){
	
		$dt=$this->get_all('*',$from,'id='.$id);
		return $dt;
    }
	public function getcolumnlist(){
		$sql = "SHOW COLUMNS FROM trainers";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
	}


   
}
