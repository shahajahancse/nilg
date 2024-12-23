<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_con extends Backend_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) :
			redirect('login');
		endif;

        $this->load->model('Common_model');
		$this->load->model('Processdb');
		$this->load->model('Grid_model');
		$this->load->model('Acl_model');
		$this->load->library('form_validation');
		$this->load->library('grocery_CRUD');	
		$access_level = 1;
		// $acl = $this->Acl_model->acl_check($access_level);
	}

	//----------------------------------------------------------------------------------------------
	// CRUD output method
	//----------------------------------------------------------------------------------------------
	/*function lib_log_output($output = null)
	{
		$this->load->view('library_log_view.php',$output);	
	}*/

	function lib_log_output($data = null)
	{
		$this->load->view('backend/page_header', $this->data); 
		$this->load->view('library_log_view',$data['output']);
		$this->load->view('backend/page_footer');
		// $this->load->view('admin/setup',$output);	
	}
	//----------------------------------------------------------------------------------------------
	// library log
	//----------------------------------------------------------------------------------------------

		
	// library log
	function library_log_view()
	{
		// Load view
    	$this->data['meta_title'] = 'Library Log View';
    	$this->data['subview'] = 'library_log_view';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	// member log
	function member_log()
	{
		$this->grocery_crud->set_table('lib_log');
		$this->grocery_crud->set_subject('Member Log');
		$this->grocery_crud->where('type','member');
		$this->grocery_crud->required_fields('id_name','in_time');
		$this->grocery_crud->columns('id_name','in_time','out_time');
		$this->grocery_crud->fields('id_name','in_time','out_time');
		$this->grocery_crud->set_rules('id_name', 'Member ID','trim|required|callback_member_id_check');
		//$this->grocery_crud->change_field_type('acc_no','hidden');
		$this->grocery_crud->display_as('id_name','Member ID');
		$state = $this->grocery_crud->getState();
		if($state == 'update_validation')
    	{
			$this->grocery_crud->set_rules('out_time', 'Out time','trim|required');
    	}
		$this->data['output'] = $this->grocery_crud->render();
		$this->lib_log_output($this->data);
	}

	// visitor log
	function visitor_log()
	{
		$this->grocery_crud->set_table('lib_log');
		$this->grocery_crud->set_subject('Visitor Log');
		$this->grocery_crud->where('type','visitor');
		$this->grocery_crud->columns('id_name','in_time','out_time');
		//$this->grocery_crud->fields('id_name','in_time','out_time');
		$this->grocery_crud->required_fields('id_name','designation','gender','in_time','organizational_address');
		$this->grocery_crud->change_field_type('type','hidden');
		$this->grocery_crud->display_as('id_name','Name');
		$this->grocery_crud->callback_before_insert(array($this,'type_insert'));
		//$this->grocery_crud->callback_add_field('gender',array($this,'add_field_callback_gender'));
		//$this->grocery_crud->callback_edit_field('gender',array($this,'edit_field_callback_gender'));
		$this->grocery_crud->set_rules('email', 'Email', 'valid_email');
		$this->grocery_crud->display_as('contact_no','Contact No')
							->display_as('parmanent_address','Parmanent Address')
							->display_as('organizational_address','Organizational Address')
							->display_as('add_info','Additional Information')
							->display_as('add_info','Additional Information');
		$state = $this->grocery_crud->getState();
		if($state == 'update_validation')
    	{
			$this->grocery_crud->set_rules('out_time', 'Out time','trim|required');
    	}
		$this->data['output'] = $this->grocery_crud->render();
		$this->lib_log_output($this->data);
	}
	
	public function member_id_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$id_name_old = $this->db->where("id",$id)->get('lib_log')->row()->id_name;
			$this->db->where("mem_id",$id_name_old);
		}
		
		$num_row = $this->db->where('mem_id',$str)->get('lib_member')->num_rows();
		if ($num_row == 0)
		{
			$this->form_validation->set_message('member_id_check', 'Invalid Member ID');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
}