<?php
class Acl_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->library('grocery_CRUD');
		$this->load->model('acl_model');
		$access_level = 7;
		$acl = $this->acl_model->acl_check($access_level);
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD output method
	//-------------------------------------------------------------------------------------------------------
	function lib_output($output = null)
	{
		$this->load->view('admin/setup.php',$output);	
	}
	//-------------------------------------------------------------------------------------------------------
	// Access Control List
	//-------------------------------------------------------------------------------------------------------
	function acl()
	{
		$this->grocery_crud->set_table('member_group');
		$this->grocery_crud->set_subject('User');
		$this->grocery_crud->required_fields('group_name');
		$this->grocery_crud->set_relation_n_n('ACL', 'member_acl_level', 'member_acl_list', 'group_id', 'acl_id', 'acl_name','priority');
		$this->grocery_crud->unset_delete();
		$output = $this->grocery_crud->render();
	 
		$this->lib_output($output);
	}
	
	function acl_list()
	{

		$this->grocery_crud->set_table('member_acl_list');
		
		$output = $this->grocery_crud->render();
		
		$this->lib_output($output);
	}	
	
}