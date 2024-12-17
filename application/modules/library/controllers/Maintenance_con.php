<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance_con extends Backend_Controller {

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
		$access_level = 6;
		$acl = $this->Acl_model->acl_check($access_level);
	}
	
	function lib_output($data = null)
	{

		$this->load->view('backend/page_header', $this->data); 
		$this->load->view('admin/setup',$data['output']);
		$this->load->view('backend/page_footer');
		// $this->load->view('admin/setup',$output);	
	}

		
	function database_backup_view()
	{
		// $this->load->view('database_backup');
		// Load view
    	$this->data['meta_title'] = 'Full Database Backup';
    	$this->data['subview'] = 'database_backup';
    	$this->load->view('backend/_layout_main', $this->data);
	}
	
	//-----------------------------------------------------------------------------------------------------
	// Database Backup
	//-----------------------------------------------------------------------------------------------------
	function database_backup()
	{
		$this->load->dbutil();
		
		$prefs = array(
                //'tables'      => array('table1', 'table2'),  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                //'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

		$this->dbutil->backup($prefs); 
		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		$date = date("d-m-Y");
		//$file = base_url()."backup/$date.sql";
		//write_file($file, $backup);
		$download_file = "$date.zip";
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($download_file ,$backup); 
		
	}
	
	function personnel_dictionary()
	{
		$this->grocery_crud->set_table('lib_personnel_dictionary');
		$this->grocery_crud->set_subject('Personnel Dictionary');
		$this->grocery_crud->required_fields('name','designation','mobile');
		$this->grocery_crud->set_field_upload('image','img/personnel');
		//$this->grocery_crud->unset_add();
		//$this->grocery_crud->unset_delete();
		$this->grocery_crud->callback_after_upload(array($this,'personnel_dictionary_callback_after_upload'));

		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'Personnel Dictionary';
		$this->lib_output($this->data);
	}
	
	function personnel_dictionary_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(120,120)->save($file_uploaded,true);
	  return true;
	}
	//-----------------------------------------------------------------------------------------------------
	// Slideshow Setup
	//-----------------------------------------------------------------------------------------------------
	function slide_image ()
	{
		$this->grocery_crud->set_table('lib_slideshow');
		$this->grocery_crud->set_subject('Slide Image');
		$this->grocery_crud->required_fields('image','alt');
		$this->grocery_crud->set_field_upload('image','img/slide');
		//$this->grocery_crud->unset_add();
		$this->grocery_crud->callback_after_upload(array($this,'slide_callback_after_upload'));
		//$this->grocery_crud->unset_delete();

		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'Slide Image';
		$this->lib_output($this->data);
	}
	
	function slide_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(300,300)->save($file_uploaded,true);
	  return true;
	}
	//-----------------------------------------------------------------------------------------------------
	// Front Page Setup
	//-----------------------------------------------------------------------------------------------------
	function front_page_content ()
	{
		$this->grocery_crud->set_table('lib_front_page_content');
		$this->grocery_crud->set_subject('Front Content');
		$this->grocery_crud->required_fields('page_name','content','image');
		$this->grocery_crud->set_field_upload('image','img/front_page');
		//$this->grocery_crud->unset_add();
		$this->grocery_crud->unset_delete();

		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'Front Content';
		$this->lib_output($this->data);
	}
	
	//-----------------------------------------------------------------------------------------------------
	// Digital Collection Setup
	//-----------------------------------------------------------------------------------------------------
	function digital_colection ()
	{
		$this->grocery_crud->set_table('lib_download');
		$this->grocery_crud->set_subject('Digital Collection');
		$this->grocery_crud->required_fields('title','subject','author','file','entry_date','type');
		$this->grocery_crud->set_field_upload('file','img/uploads/digital_colection');
		$this->grocery_crud->set_relation('y_of_pub','lib_pub_year','pub_year');
		$this->grocery_crud->set_relation('type','lib_download_type','download_type');
		$this->grocery_crud->display_as('y_of_pub','Year of Pub.');
		$this->grocery_crud->set_relation('edition','lib_edition','edition_name');
		$this->grocery_crud->callback_before_insert(array($this,'user_actual_date_callback'));
		$this->grocery_crud->callback_before_update(array($this,'user_actual_date_callback'));
		$this->grocery_crud->unset_columns('sys_date','user_name');
		$this->grocery_crud->field_type('sys_date','invisible')->field_type('user_name','invisible');

		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'Digital Collection';
		$this->lib_output($this->data);
	}

	function user_actual_date_callback($post_array) 
	{
		$post_array['user_name'] = $this->session->userdata('mem_id');
		$post_array['sys_date'] = date("Y-m-d");
		return $post_array;
	}
	function digital_colection_type ()
	{
		$this->grocery_crud->set_table('lib_download_type');
		$this->grocery_crud->required_fields('download_type');
		
		$output = $this->grocery_crud->render();
		$this->lib_output($output);
	}
	
}