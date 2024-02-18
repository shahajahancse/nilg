<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_role_list($limit = 1000, $offset = 0, $type = null) {
        // result query
        $this->db->select('*');
        $this->db->from('groups');
        if (!empty($type)) {
            $this->db->where('type', $type);
        }
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        $result['rows'] = $this->db->get()->result();

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('groups');

        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }    


    public function get_board_institute($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('*');
        $this->db->from('board_institute');
        // $this->db->join('office_type ot', 'ot.id = d.office_type', 'LEFT');        
        // $this->db->join('employee_type e', 'e.id = d.employee_type', 'LEFT');        
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        // Filter        
        /*if($this->input->get('org_type')){
            $this->db->where('org_type', $this->input->get('org_type'));
        }*/
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('board_institute');
        // Filter
        /*if($this->input->get('org_type')){
            $this->db->where('org_type', $this->input->get('org_type'));
        }*/
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_subject($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('*');
        $this->db->from('subject');
        // $this->db->join('office_type ot', 'ot.id = d.office_type', 'LEFT');        
        // $this->db->join('employee_type e', 'e.id = d.employee_type', 'LEFT');        
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        // Filter        
        /*if($this->input->get('org_type')){
            $this->db->where('org_type', $this->input->get('org_type'));
        }*/
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('subject');
        // Filter
        /*if($this->input->get('org_type')){
            $this->db->where('org_type', $this->input->get('org_type'));
        }*/
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_exam($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('*');
        $this->db->from('exam');
        // $this->db->join('office_type ot', 'ot.id = d.office_type', 'LEFT');        
        // $this->db->join('employee_type e', 'e.id = d.employee_type', 'LEFT');        
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        // Filter        
        /*if($this->input->get('org_type')){
            $this->db->where('org_type', $this->input->get('org_type'));
        }*/
        // $query = $this->db->get();
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('exam');
        // Filter
        /*if($this->input->get('org_type')){
            $this->db->where('org_type', $this->input->get('org_type'));
        }*/
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_pourashava($limit = 1000, $offset = 0, $upazilas=NULL) {
        // result query
        $this->db->select('p.id, p.pou_name_bn, p.pou_name_en, p.status, d.dis_name_bn, ut.upa_name_bn');
        $this->db->from('pourashava p');
        $this->db->join('districts d', 'd.id=p.pou_dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=p.pou_upa_id', 'LEFT');

        if($this->input->get('division') > 0){            
            $this->db->where('p.pou_div_id', $this->input->get('division'));     
        }
        if($this->input->get('district') > 0){            
            $this->db->where('p.pou_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > 0){            
            $this->db->where('p.pou_upa_id', $this->input->get('upazila'));     
        }

        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('p.id', 'DESC');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;


        // count query         
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('pourashava');

        if($this->input->get('division') > 0){            
            $this->db->where('pou_div_id', $this->input->get('division'));     
        }
        if($this->input->get('district') > 0){            
            $this->db->where('pou_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > 0){            
            $this->db->where('pou_upa_id', $this->input->get('upazila'));     
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;

    }

    public function get_union($limit = 1000, $offset = 0, $upazilas=NULL) {
        // result query
        $this->db->select('uni.id, uni.uni_name_bn, uni.uni_name_en, uni.status, d.dis_name_bn, ut.upa_name_bn');
        $this->db->from('unions uni');
        $this->db->join('districts d', 'd.id=uni.uni_dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=uni.uni_upa_id', 'LEFT');

        if($this->input->get('division') > 0){            
            $this->db->where('uni.uni_div_id', $this->input->get('division'));     
        }
        if($this->input->get('district') > 0){            
            $this->db->where('uni.uni_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > 0){            
            $this->db->where('uni.uni_upa_id', $this->input->get('upazila'));     
        }

        // if($this->input->get('upazilas') != NULL){
        //     if(count($this->input->get('upazilas')) ==1){
        //         $upazila_id = str_pad($this->input->get('upazilas'), 2, '0', STR_PAD_LEFT);
        //     }else{
        //         $upazila_id = $this->input->get('upazilas');
        //     }
        //     $this->db->where('uni.uni_upa_id', $upazila_id);     
        // }

        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('uni.id', 'ASC');
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;


        // count query         
        $q = $this->db->select('COUNT(*) as count');
        // if($this->input->get('upazilas') != NULL){
        //     if(count($this->input->get('upazilas')) ==1){
        //         $upazila_id = str_pad($this->input->get('upazilas'), 2, '0', STR_PAD_LEFT);

        //     }else{
        //         $upazila_id = $this->input->get('upazilas');
        //     }
        //     $this->db->where('id', $upazila_id);     
        // }
        $this->db->from('unions');
        if($this->input->get('division') > 0){            
            $this->db->where('uni_div_id', $this->input->get('division'));     
        }
        if($this->input->get('district') > 0){            
            $this->db->where('uni_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > 0){            
            $this->db->where('uni_upa_id', $this->input->get('upazila'));     
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;

    }

    public function get_upazila_thana($limit = 1000, $offset = 0, $division=NULL, $district=NULL) {
        // result query
        $this->db->select('ut.id, ut.upa_name_bn, ut.upa_name_en, ut.upa_bbs_code, ut.status, dv.div_name_bn, ds.dis_name_bn');
        $this->db->from('upazilas ut');
        $this->db->join('divisions dv', 'dv.id=ut.upa_div_id');
        $this->db->join('districts ds', 'ds.id=ut.upa_dis_id');
        if($this->input->get('division') != NULL){
            $this->db->where('ut.upa_div_id', $this->input->get('division'));     
        }
        if($this->input->get('district') != NULL){
            $this->db->where('ut.upa_dis_id', $this->input->get('district'));     
        }
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('ut.id', 'DESC');

        $result['rows'] = $this->db->get()->result();

        // count query
        $q = $this->db->select('COUNT(*) as count');
        if($this->input->get('division') != NULL){
            $this->db->where('upa_div_id', $this->input->get('division'));     
        }
        if($this->input->get('district') != NULL){
            $this->db->where('upa_dis_id', $this->input->get('district'));     
        }
        $this->db->from('upazilas');
        
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;

    }    

    public function get_district($limit = 1000, $offset = 0, $division=NULL) {
        // result query
       $this->db->select('di.id, di.dis_name_bn, di.dis_name_en, di.dis_bbs_code, di.status, dv.div_name_bn,  dv.div_name_en');
        $this->db->from('districts di');
        $this->db->join('divisions dv', 'dv.id=di.dis_div_id');
        if($this->input->get('division') != NULL){
            $this->db->where('di.dis_div_id', $this->input->get('division'));     
        }
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('di.id', 'DESC');

        $result['rows'] = $this->db->get()->result();

        // count query
        $q = $this->db->select('COUNT(*) as count');
        if($this->input->get('division') != NULL){
            $this->db->where('dis_div_id', $this->input->get('division'));     
        }
        $this->db->from('districts');
        
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;

    }

    public function get_division() {
        // result query
        $this->db->select('id, div_name_bn, div_name_en, div_bbs_code, status');
        $this->db->from('divisions');
        $query = $this->db->get()->result();
    
        return $query;
    }

    public function get_info($table, $id) {
        $query = $this->db->from($table)
                        ->where('id', $id)
                        ->get()->row();
        return $query;
    }

    public function get_statistics() {
        // result query
        $this->db->select('*');
        $this->db->from('statistics');
        $query = $this->db->get()->result();
    
        return $query;
    }

    public function get_financing() {
        // result query
        $this->db->select('id, finance_name');
        $this->db->from('financing');
        $query = $this->db->get()->result();
    
        return $query;
    }





    // public function get_upazila_thana() {
    //     // result query
    //     $this->db->select('ut.id, ut.div_id, ut.dis_id, ut.up_th_name, ut.up_th_name_bn, ut.status, dv.div_name, ds.district_name');
    //     $this->db->from('upazila_thana ut');
    //     $this->db->join('division dv', 'dv.id=ut.div_id');
    //     $this->db->join('district ds', 'ds.id=ut.dis_id');
        
    //     $query = $this->db->get()->result();

    //     return $query;
    // }

    // public function get_post_office() {
    //     // result query
    //     $this->db->select('p.id, p.dis_id, p.po_name, p.code, p.status, ds.district_name');
    //     $this->db->from('post_office p');
    //     $this->db->join('district ds', 'ds.id=p.dis_id');

    //     $query = $this->db->get()->result();

    //     return $query;
    // }

    // public function get_district() {
    //     // result query
    //     $this->db->select('di.id, di.div_id, di.district_name, di.status, dv.div_name');
    //     $this->db->from('district di');
    //     $this->db->join('division dv', 'dv.id=di.div_id');
    //     $query = $this->db->get()->result();
    
    //     return $query;
    // }

    // public function get_division() {
    //     // result query
    //     $this->db->select('id, status, div_name, div_name_bn');
    //     $this->db->from('division');
    //     $query = $this->db->get()->result();
    
    //     return $query;
    // }

    // public function get_info($id) {
    //     $query = $this->db->from('')
    //                     ->where('id', $id)
    //                     ->get()->row();
    //     return $query;
    // }

    // public function get_up_th_info($id) {
    //     $query = $this->db->from('upazila_thana')->where('id', $id)->get()->row();
    //     return $query;
    // }

    // function delete($id) {
       
    //     $info = $this->get_info($id);

    //     // if(file_exists($img_path.$info->image_file)){
    //     //    @unlink($img_path.$info->image_file);
    //     //    @unlink($img_path_thumbs.$info->image_file);
    //     // }

    //     $this->db->where('id', $id);
    //     $this->db->delete('');
        
    //     return TRUE;
    // }

    // public function get_district_by_div_id($id){
    //     $data[''] = 'Select District';
    //     $this->db->select('id, district_name');
    //     $this->db->from('district');
    //     $this->db->where('div_id',$id);
    //     $this->db->where('status',1);
    //     $this->db->order_by('district_name', 'ASC');
    //     $query = $this->db->get();

    //     foreach ($query->result_array() AS $rows) {
    //         $data[$rows['id']] = $rows['district_name'];
    //     }

    //     return $data;
    // }

    public function get_categories() {
      $this->db->select('*');
      $this->db->from('categories');
      $query = $this->db->get()->result();
      return $query;
    }

    public function get_sub_categories() {
      $this->db->select('sc.*, c.category_name');
      $this->db->from('sub_categories sc');
      $this->db->join('categories c', 'c.id=sc.cate_id');
      $this->db->where('sc.is_delete !=', 1);
      $query = $this->db->get()->result();
      return $query;
    }
    
    public function get_item_unit() {
        $this->db->select('*');
        $this->db->from('item_unit');
        $query = $this->db->get()->result();
        return $query;
    } 
       
    public function get_leave_type() {
        $this->db->select('*');
        $this->db->from('leave_type');
        $query = $this->db->get()->result();
        return $query;
    }
}
