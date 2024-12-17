<?php
class Acl_con extends Backend_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->model('Acl_model');
		$access_level = 7;
		$acl = $this->Acl_model->acl_check($access_level);
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD output method
	//-------------------------------------------------------------------------------------------------------
	/*function lib_output($output = null)
	{
		$this->load->view('admin/setup.php',$output);	
	}*/

	function lib_output($data = null)
	{
		$this->load->view('backend/page_header', $this->data); 
		$this->load->view('admin/setup',$data['output']);
		$this->load->view('backend/page_footer');
		// $this->load->view('admin/setup',$output);	
	}
	//-------------------------------------------------------------------------------------------------------
	// Access Control List
	//-------------------------------------------------------------------------------------------------------
	function acl()
	{
		$this->grocery_crud->set_table('lib_member_group');
		$this->grocery_crud->set_subject('User');
		$this->grocery_crud->required_fields('group_name');
		$this->grocery_crud->set_relation_n_n('ACL', 'lib_member_acl_level', 'lib_member_acl_list', 'group_id', 'acl_id', 'acl_name','priority');
		$this->grocery_crud->unset_delete();
		
		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'Access Control List';
		$this->lib_output($this->data);
	}
	
	function acl_list()
	{

		$this->grocery_crud->set_table('member_acl_list');
		
		$output = $this->grocery_crud->render();
		
		$this->lib_output($output);
	}	
	
}