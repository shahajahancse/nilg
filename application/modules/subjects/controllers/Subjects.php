<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Subjects extends MX_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Subjects_model');
		$this->load->model('Common_model');

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

    }


    public function index(){

            // $this->load->view('temp/header');
            // $this->load->view('add_account_head');
            // $this->load->view('temp/footer');

    	$this->data['meta_title'] = lang('subjects_add');
		$this->data['subview'] = 'create';
    	$this->load->view('backend/_layout_main', $this->data);

    }
	public function get_columns()
	{
		$thismodel=$this->this_model();
		
		$columslist=$this->$thismodel->getcolumnlist();
		$filtercolumns=array();
		for($i=0;$i<sizeof($columslist);$i++)
		{
			if($columslist[$i]['Field']=='id') continue;
			$filtercolumns[]=$columslist[$i];
		}
		return $filtercolumns;
	}
	public function this_model()
	{
		return ucwords($this->uri->segment(1)).'_model';
	}
	public function this_table()
	{
		return $this->uri->segment(1);
	}
    public function add() {
    	$data['userDetails'] = $this->Common_model->get_user_details();
		
		$thismodel=$this->this_model();
		$data['allcolumns'] = $this->get_columns();
		
		for($i=0;$i<sizeof($data['allcolumns']);$i++)
		{
			$this->form_validation->set_rules($data['allcolumns'][$i]['Field'], $data['allcolumns'][$i]['Field'], 'required');
		}
		
		$data['status']=array('id','name',array(
								'0'=>array('id'=>'Active','name'=>'Active'),
								'1'=>array('id'=>'Inactive','name'=>'Inactive')
							)
							
						);

		//$data['ijaradar_id']=array('id','fullname',$this->teachermodel->allTeachers());
		//print_r($data['hatbajar_id']);exit;
		
        if ($this->form_validation->run() === false) {
			
			$data['divinfo'][0]=$accountInfo=$this->getpostdate();
				
			// $this->load->view('temp/header');
			// $this->load->view('add', $data);
			// $this->load->view('temp/footer');
			$data['meta_title'] = lang('subjects_add');
			$data['subview'] = 'add';
	    	$this->load->view('backend/_layout_main', $data);

        }else{

			if ($this->input->post('submit', TRUE)) {
				
				
				$data['divinfo']=$accountInfo=$this->getpostdate();
				//print_r($accountInfo);exit;
				//unset($accountInfo['id']);
				if ($this->db->insert($this->this_table(), $accountInfo)) {

						$this->session->set_flashdata('message', 'Successfully Added'); 
						redirect($this->uri->segment(1).'/all');

				}
			}
			$this->load->view('add', $data);
		}
              
    }
	public function dbdateformat($dt)
	{
		$tmpdt=$dt;
		$dt=explode('-',$dt);
		if(sizeof($dt)>1)
			return $dt[2].'-'.$dt[1].'-'.$dt[0];
		else
			return $tmpdt;
	}
	public function getpostdate()
	{
		$thismodel=$this->this_model();
		$data['allcolumns'] = $this->$thismodel->getcolumnlist();
		
		$accountInfo=array();
		for($i=0;$i<sizeof($data['allcolumns']);$i++)
		{
			if($data['allcolumns'][$i]['Type']=='date')
				$accountInfo[$data['allcolumns'][$i]['Field']]=$this->dbdateformat($this->input->post($data['allcolumns'][$i]['Field'], TRUE));
			else
				$accountInfo[$data['allcolumns'][$i]['Field']]=$this->input->post($data['allcolumns'][$i]['Field'], TRUE);
		}   
		//print_r($accountInfo);exit;
		return $accountInfo;
	}

    //This function is use for Listing all account head.
	public function return_columnsonly()
	{
		$thismodel=$this->this_model();
		$columns=$this->$thismodel->getcolumnlist();
		$colarray=array();
		for($i=0;$i<sizeof($columns);$i++)
		{
			$colarray[]=$columns[$i]['Field'];
		}
		return $colarray;
	}
    public function all()
    {
    	$data['userDetails'] = $this->Common_model->get_user_details();
		$thismodel=$this->this_model();
		$select='*';
		$from='subjects';
		$where='1';
		
		//$data['printcolumn']=$this->return_columnsonly();
		$data['printcolumn']=array('id','sub_name','status');
		//print_r($data['printcolumn']);exit;array('id');
		
		$data['all_list'] = $this->$thismodel->get_all($select,$from,$where);
		$data['meta_title'] = 'All Subjects';
		$data['subview'] = 'all';
    	$this->load->view('backend/_layout_main', $data);
    }


        //This function will edit an account head
    public function edit() {
		$data['userDetails'] = $this->Common_model->get_user_details();
		$thismodel=$this->this_model();
		$data['allcolumns'] = $this->get_columns();
		
		for($i=0;$i<sizeof($data['allcolumns']);$i++)
		{
			$this->form_validation->set_rules($data['allcolumns'][$i]['Field'], $data['allcolumns'][$i]['Field'].'_v_name', 'required|xss_clean');
		}
		$data['status']=array('id','name',array(
								'0'=>array('id'=>'Active','name'=>'Active'),
								'1'=>array('id'=>'Inactive','name'=>'Inactive')
							)
							
						);
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {

            $editData = $accountInfo=$this->getpostdate();

            $id = $this->input->post('id', TRUE);

            $this->db->where('id', $id);
            if ($this->db->update($this->this_table(), $editData)) {
                $this->session->set_flashdata('message', $this->this_table().' Update Successful'); 
                redirect($this->this_table().'/all');
            }
        } else {
		
			$data['divinfo']=$this->$thismodel->get_cur_all($id, $this->this_table());

            $data['meta_title'] = 'Update Subject';
			$data['subview'] = 'add';
			$this->load->view('backend/_layout_main', $data);
        }
    }


    

    public function delete(){
		$thismodel=$this->this_model();
        $id = $this->input->get('id'); 
        if ($this->db->delete($this->this_table(), array('id' => $id))) {
        $this->session->set_flashdata('message', 'Deleted Successful'); 
        redirect($this->this_table().'/all');
        }

    }







}
