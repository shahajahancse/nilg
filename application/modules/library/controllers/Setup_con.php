<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_con extends Backend_Controller {

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

	/*
		//------------------------------------------------------------------------------------------
		// Library Setup
		//-------------------------------------------------------------------------------------------
	*/
	function lib_output($data = null)
	{

		$this->load->view('backend/page_header', $this->data); 
		$this->load->view('admin/setup',$data['output']);
		$this->load->view('backend/page_footer');
		// $this->load->view('admin/setup',$output);	
	}

	//  library setup
	function library_setup ()
	{
		$this->grocery_crud->set_table('library_info');
		$this->grocery_crud->set_subject('Library Setup');
		$this->grocery_crud->required_fields('library_name','address','mobile','phone');
		$this->grocery_crud->set_field_upload('logo','img/company_photo');
		$this->grocery_crud->unset_add();
		$this->grocery_crud->unset_delete();
		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'লাইব্রেরি সেটআপ';
		$this->data['head_title'] = 'লাইব্রেরি সেটআপ';
		$this->lib_output($this->data);
	}

	// member add/setup
	function member()
	{
		$base_url = base_url();
		$this->grocery_crud->set_table('lib_member');
		$this->grocery_crud->set_subject('Member Setup');
		$this->grocery_crud->set_relation('mem_type','lib_member_type','mem_name');
		$this->grocery_crud->set_relation('designation','lib_designation','designation');
		$this->grocery_crud->set_relation('level','lib_member_group','group_name');
		$this->grocery_crud->unset_columns('designation','mem_type','mem_pass','institutional_add','end_date');
		$this->grocery_crud->columns('first_name','last_name','present_add','mem_id','active_date','email','image');
		$this->grocery_crud->required_fields('first_name','last_name','mem_type','mem_pass','present_add','permanent_add','designation','marital_sts','gender','active_date','email','level','end_date');
		$this->grocery_crud->change_field_type('mem_pass','password');
		$this->grocery_crud->set_field_upload('image','img/uploads/mem_image');
		$this->grocery_crud->callback_after_upload(array($this,'member_callback_after_upload'));
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->set_rules('mem_pass','Password','required|min_length[6]|callback_password_check');
		$this->grocery_crud->set_rules('email', 'Email', 'valid_email|required');
		$this->grocery_crud->add_action('Smileys', "$base_url/img/company_photo/profile.png", 'setup_con/action_profile');		

		//$this->grocery_crud->set_rules('email', 'Email', 'valid_email|required|callback_email_check');
		$this->grocery_crud->display_as('first_name','First Name')
						 ->display_as('last_name','Last Name')
						 ->display_as('mem_type','Member Type')
						 ->display_as('permanent_add','Permanent Address')
						 ->display_as('present_add','Present Address')
						 ->display_as('institutional_add','Institutional Address')
						 ->display_as('district','District')
						 ->display_as('mem_id','Member Id')
						 ->display_as('mem_pass','Password')
						 ->display_as('gender','Gender')
						 ->display_as('marital_sts','Marital Status')
						 ->display_as('mob','Mobile No.')
						 ->display_as('level','Access Level')
						 ->display_as('email','Email Id');
		$this->grocery_crud->callback_before_insert(array($this, 'password_mdfive_insert'));
		$this->grocery_crud->callback_before_update(array($this,'password_mdfive_update'));
		
		$state = $this->grocery_crud->getState();
		if($state == 'add' || $state =='insert_validation')
    	{
       		$this->grocery_crud->required_fields('first_name','last_name','mem_type','mem_pass','mem_id','present_add','permanent_add','designation','marital_sts','gender','active_date','email','level','end_date');
			$this->grocery_crud->set_rules('mem_id','Member ID','required|min_length[5]|max_length[12]|callback_mem_id_check');
			$this->grocery_crud->change_field_type('varification_code','hidden');
			$this->grocery_crud->change_field_type('varify_status','hidden');
    	}
		if($state == 'edit')
    	{
       		$this->grocery_crud->change_field_type('mem_id','readonly');
			$this->grocery_crud->change_field_type('varification_code','hidden');
			$this->grocery_crud->change_field_type('varify_status','hidden');
    	}

    	// Load view
    	$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'মেম্বার সেটআপ';
		$this->data['head_title'] = 'মেম্বার সেটআপ';
		$this->lib_output($this->data);
	}

	// configure
	function configure()
	{
		// Load view
    	$this->data['meta_title'] = 'Configure';
    	$this->data['subview'] = 'configure';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	// barcode configure
	function barcode_config()
	{
		// Load view
    	$this->data['meta_title'] = 'Barcode';
    	$this->data['subview'] = 'barcode_config';
    	$this->load->view('backend/_layout_main', $this->data);
	}	

	// Call No. Generator
	function callno_generate()
	{

		$this->data["call_text"] = $this->input->post('call_text');
		$this->data["call_no"] = $this->input->post('call_no');
		$this->data["print_qty"] = $this->input->post('print_qty');

		// $this->load->view('callno_print',$this->data);

		// Load view
    	$this->data['meta_title'] = 'Call No. Generator';
    	$this->data['subview'] = 'callno_print';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	// Call No. config
	function call_no_config()
	{
		// $this->load->view('call_no_config');
		// Load view
    	$this->data['meta_title'] = 'Call No. Generator';
    	$this->data['subview'] = 'call_no_config';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	// Inventory setup
	function inven_setup()
	{
		$this->grocery_crud->set_table('library_accessories');
		$this->grocery_crud->set_subject('Inventory Setup');
		$this->grocery_crud->required_fields('accessories_name','total');
		$this->grocery_crud->set_rules('accessories_name','Accessories_name','trim|required|callback_accessories_check');
		$this->grocery_crud->columns('accessories_name','total','remarks','last_updated');
		$this->grocery_crud->fields('accessories_name','total','remarks','last_updated');
		$this->grocery_crud->callback_before_insert(array($this,'checking_update_date'));
		$this->grocery_crud->callback_before_update(array($this,'checking_update_date'));
		$this->grocery_crud->change_field_type('last_updated','hidden');

		// Load view
		$this->data['output'] = $this->grocery_crud->render();
		$this->data['meta_title'] = 'Inventory Setup';
		$this->lib_output($this->data);

		// $output = $this->grocery_crud->render();
		// $this->lib_output($output);
	}

	// member paper
	function member_paper_status()
	{
		$this->data['search_query'] = $this->Processdb->member_paper_status();
		// dd($this->data['search_query']);

		// Load view
    	$this->data['meta_title'] = 'Configure';
    	$this->data['subview'] = 'member/member_status_view';
    	$this->load->view('backend/_layout_main', $this->data);
		// $this->load->view('member/member_status_view', $search_query);
	}
	
	// Setup
	function setup()
	{
		// $this->load->view('setup.php');
		// Load view
    	$this->data['meta_title'] = 'Setup';
    	$this->data['subview'] = 'setup';
    	$this->load->view('backend/_layout_main', $this->data);
	}













	function configure_output($output = null)
	{
		$this->load->view('configure.php',$output);	
	}
	function setup_output($output = null)
	{
		$this->load->view('setup.php',$output);	
	}

	function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	
	function member_type()
	{
		//$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->set_table('member_type');
		$this->grocery_crud->set_subject('Member Type Setup');
		$this->grocery_crud->required_fields('mem_name','mdayi','mbooki','mbookr','dffw','dfsw','dftw');
		$this->grocery_crud->set_rules('mem_name','Member name','trim|required|callback_mem_name_check');

		$this->grocery_crud->display_as('mem_name','Member')
				 ->display_as('mdayi','Max. Day Issued')
				 ->display_as('mbooki','Max. Books  Issued')
				 ->display_as('mbookr','Max Books Requesting')
				 ->display_as('dffw','Daily Fine 1st week')
				 ->display_as('dfsw','Daily Fine 2nd week')
				 ->display_as('dftw','Daily Fine 3rd week');
		$this->grocery_crud->unset_delete();
		$output = $this->grocery_crud->render();
		$this->configure_output($output);
	}
	
	function mem_name_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$mem_name_old = $this->db->where("id",$id)->get('member_type')->row()->mem_name;
			$this->db->where("mem_name !=",$mem_name_old);
		}
		$num_row = $this->db->where('mem_name',$str)->get('member_type')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('mem_name_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	

	function member_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(100,100)->save($file_uploaded,true);
	  return true;
	}
 
	function password_mdfive_insert($post_array) //for member to convert password into md5
	{   
		$email =  $post_array['email'];
		$mem_id =  $post_array['mem_id'];
		$mem_pass =  $post_array['mem_pass'];
		$first_name =  $post_array['first_name'];
		$last_name =  $post_array['last_name'];
		$this->send_mail_after_insert($mem_id,$mem_pass,$first_name,$last_name,$email);
		$password = $post_array['mem_pass'];
		$mdfive_pass_word = md5($password);
		$post_array['mem_pass'] = $mdfive_pass_word;
		return $post_array;
	}
	
	function password_mdfive_update($post_array,$primary_key) //for member to convert password into md5
	{   
		$id = $primary_key;
		$this->db->select('mem_pass');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_member');
		
		foreach ($query->result() as $row)
		{
			$password = $row->mem_pass; //this is md five encrypted password
		}
		$password_old = $post_array['mem_pass'];
		//$password_old_mdfive = md5($password_old);
		if($password_old == $password)
		{
			$post_array['mem_pass'] = $password;
			return $post_array;
		}
		else 
		{
			$password_new = md5($password_old);
			$post_array['mem_pass'] = $password_new;
			return $post_array;
		}
	}
	
	function send_mail_after_insert($mem_id,$mem_pass,$first_name,$last_name,$email)
	{		
		$from ="nilg_admin@gmail.com";
		$to = $email;
		$subject = "Welcome mail";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$message =  "<html>
			<head>
			<title>NILG:Welcome NILG </title>
			</head>
			
			<body>
			<div align='left' style='width:800px; height:auto; overflow:hidden; padding:10px; '>
			Dear $first_name   $last_name , <br><br>
			<p>Thank you for opening the account from NILG Library. </p><br>
			<p>We wish you will obey the rules of NILG Library </p><br>
			<p>Username : $mem_id ,<br>
				Password :$mem_pass .
			</p>
			<h5>GOOD LUCK...</h5>
			
				<br><br>
				Thanks<br>
			</div>
			</body>
			</html><br>";
		$headers .= 'From: <nilg_admin@gmail.com>' . "\r\n";
		 mail($to,$subject,$message,$headers);
    	//return true;
	}
	
	function password_check($str)
	{
		$id = $this->uri->segment(4);
		$password = md5($str);
		if(!empty($id) && is_numeric($id))
		{
			$mem_pass_old = $this->db->where("id",$id)->get('lib_member')->row()->mem_pass;
			$this->db->where("mem_pass !=",$mem_pass_old);
		}
		$num_row = $this->db->where('mem_pass',$password)->get('lib_member')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('password_check', "Password already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function mem_id_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$mem_id_old = $this->db->where("id",$id)->get('lib_member')->row()->mem_id;
			$this->db->where("mem_id !=",$mem_id_old);
		}
		$num_row = $this->db->where('mem_id',$str)->get('lib_member')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('mem_id_check', "Member ID field $str already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function email_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$email_old = $this->db->where("id",$id)->get('lib_member')->row()->email;
			$this->db->where("email !=",$email_old);
		}
		$num_row = $this->db->where('email',$str)->get('lib_member')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('email_check', "Email ID field already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function action_profile()
	{
		$id["primary_key"] = $this->uri->segment(3);
		$this->load->view('mem_profile.php',$id);
	}
	

	function user_actual_date_callback($post_array) 
	{
		$post_array['user_name'] = $this->session->userdata('mem_id');
		$post_array['sys_date'] = date("Y-m-d");
		return $post_array;
	}
	function journal_set()
	{
		$this->grocery_crud->set_table('lib_journal');
		$this->grocery_crud->set_relation('source','source','source_name');
		$this->grocery_crud->set_relation('y_of_pub','lib_pub_year','pub_year');
		$this->grocery_crud->set_relation('place','lib_pub_place','pub_place');
		$this->grocery_crud->set_subject('Journal Entry');
		$this->grocery_crud->columns('call_no','issn','acc_no','date_of_entry','title','first_subject','language','user_name');
		$this->grocery_crud->required_fields('acc_first','acc_last','call_no','issn','date_of_entry','title','first_subject','language','price','currency','publisher','place','y_of_pub','trans_co_author');
		
		$this->grocery_crud->display_as('acc_first','Acc. No. First')->display_as('acc_last','Acc. No. Last')->display_as('date_of_entry','Date of Entry')->display_as('call_no','Call No')->display_as('issn','ISSN')->display_as('trans_co_author','Author')->display_as('first_subject','1st Subject')->display_as('snd_subject','2nd Subject')->display_as('thrd_subject','3rd Subject')->display_as('forth_subject','4th Subject')->display_as('fifth_subject','5th Subject')->display_as('y_of_pub','Year of Pub.')->display_as('initial_page','Initial Page')->display_as('total_page','Total Page')->display_as('cd','CD')->display_as('corporate_author','Corporate Author');;
		
		$this->grocery_crud->set_rules('acc_first', 'Acc first','trim|required|numeric|callback_journalacc_first_check');
		$this->grocery_crud->set_rules('acc_last', 'Acc last','trim|required|numeric');
		$this->grocery_crud->set_rules('price', 'Price','trim|required|numeric');
		$this->grocery_crud->set_rules('y_of_pub', 'Year of Publication','trim|numeric');
		$this->grocery_crud->set_rules('initial_page', 'Initial Page','trim|numeric');
		$this->grocery_crud->set_rules('total_page', 'Total Page','trim|numeric');
		$this->grocery_crud->callback_before_insert(array($this,'journalrepeat_insert'));
		$this->grocery_crud->callback_before_update(array($this,'journalrepeat_update'));
		$this->grocery_crud->callback_before_delete(array($this,'journal_delete_check'));
		$this->grocery_crud->set_field_upload('image','img/uploads/book_image');
		$this->grocery_crud->callback_after_upload(array($this,'journal_callback_after_upload'));
		$this->grocery_crud->field_type('sys_date','invisible')->field_type('user_name','invisible');
		$state = $this->grocery_crud->getState();
		if($state == 'add' || $state == 'insert_validation')
    	{
		  $this->grocery_crud->change_field_type('acc_no','hidden');
		  $this->grocery_crud->change_field_type('subtitle','hidden');
		  $this->grocery_crud->set_rules('issn','ISSN','trim|required|callback_journalissn_space_check');
    	}
		if($state == 'edit')
    	{
       		//$this->grocery_crud->change_field_type('acc_first','hidden');
			//$this->grocery_crud->change_field_type('acc_last','hidden');
			//$this->grocery_crud->change_field_type('acc_no','hidden');
			//$this->grocery_crud->change_field_type('subtitle','hidden');
    	}
		
		if($state == 'update_validation')
    	{
			$this->grocery_crud->set_rules('issn', 'ISSN','trim|required|callback_journalissn_check');
		  	$this->grocery_crud->set_rules('issn','ISSN','required|callback_journalissn_space_check');
		}
		
		$output = $this->grocery_crud->render();
		$this->setup_output($output);
	}
	
	public function journalissn_space_check($str)
	{
		$check = strpos($str," ");
		if ($check != 0)
		{
			$this->form_validation->set_message('journalissn_space_check', 'The ISSN Number Do not Allow Space');
			return FALSE;
		}
		else
		{
			return true;
		}		
	}
	
	function journal_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(80,110)->save($file_uploaded,true);
	  return true;
	}
	
	function journal_delete_check($primary_key)
    {
		$id = $primary_key;
		//$acc_no = $post_array['acc_no'];
		$this->db->select('acc_no');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_journal');
		
		foreach ($query->result() as $row)
		{
			$acc_no = $row->acc_no;
		}
		$this->db->where('acc_no',$acc_no);
		$query1 = $this->db->get('booking');
		if($query1->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function journalacc_first_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$acc_first_old = $this->db->where("id",$id)->get('lib_journal')->row()->acc_first;
			$this->db->where("acc_no !=",$acc_first_old);
		}
		$num_row = $this->db->where('acc_no',$str)->get('lib_journal')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('journalacc_first_check', 'The Accession First Number already exists');
			return FALSE;
		}
		else
		{
			$num_row1 = $this->db->where('acc_no',$str)->get('lib_book')->num_rows();
			if ($num_row1 >= 1)
			{
				$this->form_validation->set_message('journalacc_first_check', 'The Accession First Number already exists in Book');
				return FALSE;
			}
			$num_row2 = $this->db->where('acc_no',$str)->get('lib_gov_publicaton')->num_rows();
			if ($num_row2 >= 1)
			{
				$this->form_validation->set_message('journalacc_first_check', 'The Accession First Number already exists in Govt. Publication');
				return FALSE;
			}
			$num_row3 = $this->db->where('acc_no',$str)->get('lib_report')->num_rows();
			if ($num_row3 >= 1)
			{
				$this->form_validation->set_message('journalacc_first_check', 'The Accession First Number already exists in Report.');
				return FALSE;
			}
			else
			{
				$acc_last =  $_POST['acc_last'];
				if ($str > $acc_last)
				{
					$this->form_validation->set_message('journalacc_first_check', 'The Acc no. first always less than the Acc no. last');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
		}
	}
	
	public function journalissn_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$issn_old = $this->db->where("id",$id)->get('lib_journal')->row()->issn;
			$this->db->where("issn !=",$issn_old);
		}
		$num_row = $this->db->where('issn',$str)->get('lib_journal')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('journalissn_check', 'The ISSN Number already exists in Journal');
			return FALSE;
		}
		else
		{
			return TRUE;
		}		
	}
	
	
	function journalrepeat_update($post_array,$primary_key)
    {
		$id = $primary_key;
		$this->db->select('issn');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_journal');
		
		foreach ($query->result() as $row)
		{
			$issn = $row->issn;
		}
		
		$data = array();
		$data['date_of_entry'] =  $post_array['date_of_entry'];
		$data['call_no'] =  $post_array['call_no'];
		$data['issn'] =  $post_array['issn'];
		$data['language'] =  $post_array['language'];
		$data['trans_co_author'] =  $post_array['trans_co_author'];;
		$data['title'] = $post_array['title'];
		$data['subtitle'] = $post_array['subtitle'];
		$data['first_subject'] = $post_array['first_subject'];
		$data['snd_subject'] = $post_array['snd_subject'];
		$data['thrd_subject'] = $post_array['thrd_subject'];
		$data['forth_subject'] = $post_array['forth_subject'];
		$data['fifth_subject'] = $post_array['fifth_subject'];
		$data['source'] = $post_array['source'];
		$data['place'] = $post_array['place'];
		$data['publisher'] = $post_array['publisher'];
		$data['y_of_pub'] = $post_array['y_of_pub'];
		$data['initial_page'] = $post_array['initial_page'];
		$data['total_page'] = $post_array['total_page'];
		$data['elastration'] = $post_array['elastration'];
		$data['volume'] = $post_array['volume'];
		$data['cd'] = $post_array['cd'];
		$data['price'] = $post_array['price'];
		$data['currency'] = $post_array['currency'];
		$data['image'] = $post_array['image'];
		$data['user_name'] = $this->session->userdata('mem_id');
		$data['sys_date'] = date("Y-m-d");
		$this->db->where('issn',$issn);
		$this->db->update('lib_journal',$data);
		return true;
    }
	
	
	function journalrepeat_insert($post_array)
    {
		$acc_first = $post_array['acc_first'];
		$acc_last = $post_array['acc_last'];
		$post_array['acc_no'] = $post_array['acc_first'];
		$post_array['user_name'] = $this->session->userdata('mem_id');
		$post_array['sys_date'] = date("Y-m-d");
		
		for($i=$acc_first + 1; $i<=$acc_last; $i++)
		{
			$data = array();
			$data['acc_no'] = $i;
			$data['acc_first'] = $post_array['acc_first'];
			$data['acc_last'] =  $post_array['acc_last'];
			$data['date_of_entry'] =  $post_array['date_of_entry'];
			$data['call_no'] =  $post_array['call_no'];
			$data['issn'] =  $post_array['issn'];
			$data['language'] =  $post_array['language'];
			$data['trans_co_author'] =  $post_array['trans_co_author'];;
			$data['title'] = $post_array['title'];
			$data['subtitle'] = $post_array['subtitle'];
			$data['first_subject'] = $post_array['first_subject'];
			$data['snd_subject'] = $post_array['snd_subject'];
			$data['thrd_subject'] = $post_array['thrd_subject'];
			$data['forth_subject'] = $post_array['forth_subject'];
			$data['fifth_subject'] = $post_array['fifth_subject'];
			$data['source'] = $post_array['source'];
			$data['place'] = $post_array['place'];
			$data['publisher'] = $post_array['publisher'];
			$data['y_of_pub'] = $post_array['y_of_pub'];
			$data['initial_page'] = $post_array['initial_page'];
			$data['total_page'] = $post_array['total_page'];
			$data['elastration'] = $post_array['elastration'];
			$data['volume'] = $post_array['volume'];
			$data['cd'] = $post_array['cd'];
			$data['price'] = $post_array['price'];
			$data['currency'] = $post_array['currency'];
			$data['image'] = $post_array['image'];
			$data['user_name'] = $this->session->userdata('mem_id');
			$data['sys_date'] = date("Y-m-d");
			$this->db->insert('lib_journal',$data);
		}
		return $post_array;
    } 
	
	function book_set()
	{
		$this->grocery_crud->set_table('lib_book');
		$this->grocery_crud->set_subject('Book Setup');
		$this->grocery_crud->set_relation('source','source','source_name');
		$this->grocery_crud->set_relation('edition','edition','edition_name');
		$this->grocery_crud->set_relation('y_of_pub','lib_pub_year','pub_year');
		$this->grocery_crud->set_relation('place','lib_pub_place','pub_place');
		$this->grocery_crud->display_as('acc_first','Acc. No. First')->display_as('acc_last','Acc. No. Last')->display_as('date_of_entry','Date of Entry')->display_as('call_no','Call No')->display_as('isbn','ISBN')->display_as('first_author','1st Author')->display_as('snd_author','2nd Author')->display_as('thrd_author','3rd Author')->display_as('first_subject','1st Subject')->display_as('snd_subject','2nd Subject')->display_as('thrd_subject','3rd Subject')->display_as('forth_subject','4th Subject')->display_as('fifth_subject','5th Subject')->display_as('y_of_pub','Year of Pub.')->display_as('initial_page','Initial Page')->display_as('total_page','Total Page')->display_as('cd','CD')->display_as('corporate_author','Corporate Author');
		$this->grocery_crud->field_type('sys_date','invisible')->field_type('user_name','invisible');
		$this->grocery_crud->required_fields('acc_first','acc_last','call_no','isbn','date_of_entry','title','first_subject','language','price','currency','publisher','place','y_of_pub');
		$this->grocery_crud->columns('call_no','isbn','acc_no','date_of_entry','first_author','title','first_subject','language','user_name');
		$this->grocery_crud->set_rules('acc_first', 'Acc first','trim|required|numeric|callback_bookacc_first_check');
		$this->grocery_crud->set_rules('acc_last', 'Acc last','trim|required|numeric');
		$this->grocery_crud->set_rules('price', 'Price','trim|required|numeric');
		$this->grocery_crud->set_rules('y_of_pub', 'Year of Publication','trim|numeric');
		/*$this->grocery_crud->set_rules('initial_page', 'Initial Page','trim|numeric');
		$this->grocery_crud->set_rules('total_page', 'Total Page','trim|numeric');*/
		$this->grocery_crud->callback_before_insert(array($this,'bookrepeat_insert'));
		$this->grocery_crud->callback_before_update(array($this,'bookrepeat_update'));
		$this->grocery_crud->callback_before_delete(array($this,'book_delete_check'));
		$this->grocery_crud->set_field_upload('image','img/uploads/book_image');
		$this->grocery_crud->callback_after_upload(array($this,'book_callback_after_upload'));
		$this->grocery_crud->field_type('sys_date','invisible')->field_type('user_name','invisible');
		$state = $this->grocery_crud->getState();
		if($state == 'add' || $state =='insert_validation')
    	{
       	 	$this->grocery_crud->change_field_type('acc_no','hidden');
		 	$this->grocery_crud->set_rules('isbn','ISBN','trim|required|callback_bookisbn_space_check');
    	}
		if($state == 'edit')
    	{
       		//$this->grocery_crud->change_field_type('acc_no','hidden');
			//$this->grocery_crud->change_field_type('acc_first','hidden');
			//$this->grocery_crud->change_field_type('acc_last','hidden');
    	}
		if($state == 'update_validation')
    	{
			$this->grocery_crud->set_rules('isbn','ISBN','trim|required|callback_bookisbn_check');
			$this->grocery_crud->set_rules('isbn','ISBN','required|callback_bookisbn_space_check');
		}
		$output = $this->grocery_crud->render();
		$this->setup_output($output);
	}
	
	function book_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(80,110)->save($file_uploaded,true);
	  return true;
	}
	public function bookisbn_space_check($str)
	{
		$check = strpos($str," ");
		if ($check != 0)
		{
			$this->form_validation->set_message('bookisbn_space_check', 'The ISBN Number Do not Allow Space');
			return FALSE;
		}
		else
		{
			return true;
		}		
	}
	function book_delete_check($primary_key)
    {
		$id = $primary_key;
		//$acc_no = $post_array['acc_no'];
		$this->db->select('acc_no');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_book');
		
		foreach ($query->result() as $row)
		{
			$acc_no = $row->acc_no;
		}
		$this->db->where('acc_no',$acc_no);
		$query1 = $this->db->get('booking');
		if($query1->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function bookacc_first_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$acc_first_old = $this->db->where("id",$id)->get('lib_book')->row()->acc_first;
			$this->db->where("acc_no !=",$acc_first_old);
		}
		
		$num_row = $this->db->where('acc_no',$str)->get('lib_book')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('bookacc_first_check', 'The Accession First Number already exists in Book');
			return FALSE;
		}
		else
		{
			$num_row1 = $this->db->where('acc_no',$str)->get('lib_journal')->num_rows();
			if ($num_row1 >= 1)
			{
				$this->form_validation->set_message('bookacc_first_check', 'The Accession First Number already exists in Journal');
				return FALSE;
			}
			$num_row2 = $this->db->where('acc_no',$str)->get('lib_gov_publicaton')->num_rows();
			if ($num_row2 >= 1)
			{
				$this->form_validation->set_message('bookacc_first_check', 'The Accession First Number already exists in Govt. Publication');
				return FALSE;
			}
			$num_row3 = $this->db->where('acc_no',$str)->get('lib_report')->num_rows();
			if ($num_row3 >= 1)
			{
				$this->form_validation->set_message('bookacc_first_check', 'The Accession First Number already exists in Report.');
				return FALSE;
			}

			else
			{
				$acc_last =  $_POST['acc_last'];
				if ($str > $acc_last)
				{
					$this->form_validation->set_message('bookacc_first_check', 'The Acc no. first always less than the Acc no. last');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
		}
	}
	
	public function bookisbn_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$isbn_old = $this->db->where("id",$id)->get('lib_book')->row()->isbn;
			$this->db->where("isbn !=",$isbn_old);
		}
		
		$num_row = $this->db->where('isbn',$str)->get('lib_book')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('bookisbn_check', 'The ISBN  Number already exists in Books');
			return FALSE;
		}
		else
		{
			return TRUE;
		}		
	}
	
	
	function bookrepeat_update($post_array,$primary_key)
    {
		$id = $primary_key;
		$this->db->select('isbn');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_book');
		
		foreach ($query->result() as $row)
		{
			$isbn = $row->isbn;
		}
		$data = array();
		$dateofentry = $post_array['date_of_entry'];
		//$grid_dateofentry  = date("Y-m-d", strtotime($dateofentry));
		$data['date_of_entry'] =  $dateofentry;
		$data['call_no'] =  $post_array['call_no'];
		$data['isbn'] =  $post_array['isbn'];
		$data['language'] =  $post_array['language'];
		$data['first_author'] =  $post_array['first_author'];
		$data['snd_author'] =  $post_array['snd_author'];
		$data['thrd_author'] =  $post_array['thrd_author'];
		$data['editor'] =  $post_array['editor'];
		$data['compiler'] =  $post_array['compiler'];
		$data['title'] = $post_array['title'];
		$data['subtitle'] = $post_array['subtitle'];
		$data['first_subject'] = $post_array['first_subject'];
		$data['snd_subject'] = $post_array['snd_subject'];
		$data['thrd_subject'] = $post_array['thrd_subject'];
		$data['forth_subject'] = $post_array['forth_subject'];
		$data['fifth_subject'] = $post_array['fifth_subject'];
		$data['edition'] = $post_array['edition'];
		$data['volume'] = $post_array['volume'];
		$data['source'] = $post_array['source'];
		$data['place'] = $post_array['place'];
		$data['publisher'] = $post_array['publisher'];
		$data['y_of_pub'] = $post_array['y_of_pub'];
		$data['initial_page'] = $post_array['initial_page'];
		$data['total_page'] = $post_array['total_page'];
		$data['elastration'] = $post_array['elastration'];
		$data['series'] = $post_array['series'];
		$data['cd'] = $post_array['cd'];
		$data['price'] = $post_array['price'];
		$data['currency'] = $post_array['currency'];
		$data['image'] = $post_array['image'];
		$data['user_name'] = $this->session->userdata('mem_id');
		$data['sys_date'] = date("Y-m-d");
		$this->db->where('isbn',$isbn);
		$this->db->update('lib_book',$data);
		return true;
	//return $post_array;
    } 
	
	function bookrepeat_insert($post_array)
    {
		$acc_first = $post_array['acc_first'];
		$acc_last = $post_array['acc_last'];
		$post_array['acc_no'] = $post_array['acc_first'];
		$post_array['user_name'] = $this->session->userdata('mem_id');
		$post_array['sys_date'] = date("Y-m-d");
		
		for($i=$acc_first + 1; $i<=$acc_last; $i++)
		{
			$data = array();
			$data['acc_no'] = $i;
			$data['acc_first'] = $post_array['acc_first'];
			$data['acc_last'] =  $post_array['acc_last'];
			$data['date_of_entry'] =  $post_array['date_of_entry'];
			$data['call_no'] =  $post_array['call_no'];
			$data['isbn'] =  $post_array['isbn'];
			$data['language'] =  $post_array['language'];
			$data['first_author'] =  $post_array['first_author'];
			$data['snd_author'] =  $post_array['snd_author'];
			$data['thrd_author'] =  $post_array['thrd_author'];
			$data['editor'] =  $post_array['editor'];
			$data['compiler'] =  $post_array['compiler'];
			$data['title'] = $post_array['title'];
			$data['subtitle'] = $post_array['subtitle'];
			$data['first_subject'] = $post_array['first_subject'];
			$data['snd_subject'] = $post_array['snd_subject'];
			$data['thrd_subject'] = $post_array['thrd_subject'];
			$data['forth_subject'] = $post_array['forth_subject'];
			$data['fifth_subject'] = $post_array['fifth_subject'];
			$data['edition'] = $post_array['edition'];
			$data['volume'] = $post_array['volume'];
			$data['source'] = $post_array['source'];
			$data['place'] = $post_array['place'];
			$data['publisher'] = $post_array['publisher'];
			$data['y_of_pub'] = $post_array['y_of_pub'];
			$data['initial_page'] = $post_array['initial_page'];
			$data['total_page'] = $post_array['total_page'];
			$data['elastration'] = $post_array['elastration'];
			$data['series'] = $post_array['series'];
			$data['cd'] = $post_array['cd'];
			$data['price'] = $post_array['price'];
			$data['currency'] = $post_array['currency'];
			$data['image'] = $post_array['image'];
			$data['user_name'] = $this->session->userdata('mem_id');
			$data['sys_date'] = date("Y-m-d");
			$this->db->insert('lib_book',$data);
		}
		return $post_array;
    } 
		
	
	function book_trans()
	{	
	  $this->grocery_crud->set_table('booking');
	  $this->grocery_crud->set_subject('Book transaction');
	  $output = $this->grocery_crud->render();
	  $this->lib_output($output);
	}
	
	// ====================================Govt Publication ======================================================
	// ===========================================================================================================
	
	function gov_pub_set()
	{
		$this->grocery_crud->set_table('lib_gov_publicaton');
		$this->grocery_crud->set_subject('Govt. Publcation Setup');
		$this->grocery_crud->set_relation('source','source','source_name');
		$this->grocery_crud->set_relation('edition','edition','edition_name');
		$this->grocery_crud->set_relation('y_of_pub','lib_pub_year','pub_year');
		$this->grocery_crud->set_relation('place','lib_pub_place','pub_place');
		$this->grocery_crud->set_field_upload('image','img/uploads/gov_pub_image');
		$this->grocery_crud->display_as('acc_first','Acc. No. First')->display_as('acc_last','Acc. No. Last')->display_as('date_of_entry','Date of Entry')->display_as('call_no','Call No')->display_as('isbn','ISBN')->display_as('first_author','1st Author')->display_as('snd_author','2nd Author')->display_as('thrd_author','3rd Author')->display_as('first_subject','1st Subject')->display_as('snd_subject','2nd Subject')->display_as('thrd_subject','3rd Subject')->display_as('forth_subject','4th Subject')->display_as('fifth_subject','5th Subject')->display_as('y_of_pub','Year of Pub.')->display_as('initial_page','Initial Page')->display_as('total_page','Total Page')->display_as('cd','CD');
		$this->grocery_crud->field_type('sys_date','invisible')->field_type('user_name','invisible');
		$this->grocery_crud->required_fields('acc_first','acc_last','call_no','isbn','date_of_entry','title','first_subject','language','price','currency','publisher','place','y_of_pub');
		$this->grocery_crud->columns('call_no','isbn','acc_no','date_of_entry','first_author','title','first_subject','language','user_name');
		$this->grocery_crud->set_rules('acc_first', 'Acc first','trim|required|numeric|callback_gov_pub_acc_first_check');
		$this->grocery_crud->set_rules('acc_last', 'Acc last','trim|required|numeric');
		$this->grocery_crud->set_rules('price', 'Price','trim|required|numeric');
		$this->grocery_crud->set_rules('y_of_pub', 'Year of Publication','trim|numeric');
		/*$this->grocery_crud->set_rules('initial_page', 'Initial Page','trim|numeric');
		$this->grocery_crud->set_rules('total_page', 'Total Page','trim|numeric');*/
		$this->grocery_crud->callback_before_insert(array($this,'gov_pub_repeat_insert'));
		$this->grocery_crud->callback_before_update(array($this,'gov_pub_repeat_update'));
		$this->grocery_crud->callback_before_delete(array($this,'gov_pub_delete_check'));
		$this->grocery_crud->callback_after_upload(array($this,'gov_pub_callback_after_upload'));
		$state = $this->grocery_crud->getState();
		if($state == 'add')
    	{
       	 $this->grocery_crud->change_field_type('acc_no','hidden');
    	}
		if($state == 'edit')
    	{
       		$this->grocery_crud->change_field_type('acc_no','hidden');
			$this->grocery_crud->change_field_type('acc_first','hidden');
			$this->grocery_crud->change_field_type('acc_last','hidden');
    	}
		if($state == 'update_validation')
    	{
			$this->grocery_crud->set_rules('isbn','ISBN','trim|required|callback_gov_pub_isbn_check');
		}
		$output = $this->grocery_crud->render();
		$this->setup_output($output);
	}
	function gov_pub_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(80,110)->save($file_uploaded,true);
	  return true;
	}
	function gov_pub_delete_check($primary_key)
    {
		$id = $primary_key;
		//$acc_no = $post_array['acc_no'];
		$this->db->select('acc_no');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_gov_publicaton');
		
		foreach ($query->result() as $row)
		{
			$acc_no = $row->acc_no;
		}
		$this->db->where('acc_no',$acc_no);
		$query1 = $this->db->get('booking');
		if($query1->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function gov_pub_acc_first_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$acc_first_old = $this->db->where("id",$id)->get('lib_gov_publicaton')->row()->acc_first;
			$this->db->where("acc_no !=",$acc_first_old);
		}
		
		$num_row = $this->db->where('acc_no',$str)->get('lib_gov_publicaton')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('gov_pub_acc_first_check', 'The Accession First Number already exists in Govt. Publication.S');
			return FALSE;
		}
		else
		{
			$num_row1 = $this->db->where('acc_no',$str)->get('lib_book')->num_rows();
			if ($num_row1 >= 1)
			{
				$this->form_validation->set_message('gov_pub_acc_first_check', 'The Accession First Number already exists in Book');
				return FALSE;
			}
			$num_row2 = $this->db->where('acc_no',$str)->get('lib_journal')->num_rows();
			if ($num_row2 >= 1)
			{
				$this->form_validation->set_message('gov_pub_acc_first_check', 'The Accession First Number already exists in Journal');
				return FALSE;
			}
			$num_row3 = $this->db->where('acc_no',$str)->get('lib_report')->num_rows();
			if ($num_row3 >= 1)
			{
				$this->form_validation->set_message('gov_pub_acc_first_check', 'The Accession First Number already exists in Report.');
				return FALSE;
			}
			else
			{
				$acc_last =  $_POST['acc_last'];
				if ($str > $acc_last)
				{
					$this->form_validation->set_message('gov_pub_acc_first_check', 'The Acc no. first always less than the Acc no. last');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
		}
	}
	
	public function gov_pub_isbn_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$isbn_old = $this->db->where("id",$id)->get('lib_gov_publicaton')->row()->isbn;
			$this->db->where("isbn !=",$isbn_old);
		}
		
		$num_row = $this->db->where('isbn',$str)->get('lib_gov_publicaton')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('gov_pub_isbn_check', 'The ISBN  Number already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}		
	}
	function gov_pub_repeat_update($post_array,$primary_key)
    {
		$id = $primary_key;
		$this->db->select('isbn');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_gov_publicaton');
		
		foreach ($query->result() as $row)
		{
			$isbn = $row->isbn;
		}
		$data = array();
		$dateofentry = $post_array['date_of_entry'];
		//$grid_dateofentry  = date("Y-m-d", strtotime($dateofentry));
		$data['date_of_entry'] =  $dateofentry;
		$data['call_no'] =  $post_array['call_no'];
		$data['isbn'] =  $post_array['isbn'];
		$data['language'] =  $post_array['language'];
		$data['first_author'] =  $post_array['first_author'];
		$data['snd_author'] =  $post_array['snd_author'];
		$data['thrd_author'] =  $post_array['thrd_author'];
		$data['editor'] =  $post_array['editor'];
		$data['compiler'] =  $post_array['compiler'];
		$data['translator'] = $post_array['translator'];
		$data['title'] = $post_array['title'];
		$data['subtitle'] = $post_array['subtitle'];
		$data['first_subject'] = $post_array['first_subject'];
		$data['snd_subject'] = $post_array['snd_subject'];
		$data['thrd_subject'] = $post_array['thrd_subject'];
		$data['forth_subject'] = $post_array['forth_subject'];
		$data['fifth_subject'] = $post_array['fifth_subject'];
		$data['edition'] = $post_array['edition'];
		$data['volume'] = $post_array['volume'];
		$data['source'] = $post_array['source'];
		$data['place'] = $post_array['place'];
		$data['publisher'] = $post_array['publisher'];
		$data['y_of_pub'] = $post_array['y_of_pub'];
		$data['initial_page'] = $post_array['initial_page'];
		$data['total_page'] = $post_array['total_page'];
		$data['elastration'] = $post_array['elastration'];
		$data['cd'] = $post_array['cd'];
		$data['price'] = $post_array['price'];
		$data['currency'] = $post_array['currency'];
		$data['image'] = $post_array['image'];
		$data['user_name'] = $this->session->userdata('mem_id');
		$data['sys_date'] = date("Y-m-d");
		$this->db->where('isbn',$isbn);
		$this->db->update('lib_gov_publicaton',$data);
		return true;
	//return $post_array;
    }
	
	function gov_pub_repeat_insert($post_array)
    {
		$acc_first = $post_array['acc_first'];
		$acc_last = $post_array['acc_last'];
		$post_array['acc_no'] = $post_array['acc_first'];
		$post_array['user_name'] = $this->session->userdata('mem_id');
		$post_array['sys_date'] = date("Y-m-d");
		
		for($i=$acc_first + 1; $i<=$acc_last; $i++)
		{
			$data = array();
			$data['acc_no'] = $i;
			$data['acc_first'] = $post_array['acc_first'];
			$data['acc_last'] =  $post_array['acc_last'];
			$data['date_of_entry'] =  $post_array['date_of_entry'];
			$data['call_no'] =  $post_array['call_no'];
			$data['isbn'] =  $post_array['isbn'];
			$data['language'] =  $post_array['language'];
			$data['first_author'] =  $post_array['first_author'];
			$data['snd_author'] =  $post_array['snd_author'];
			$data['thrd_author'] =  $post_array['thrd_author'];
			$data['editor'] =  $post_array['editor'];
			$data['compiler'] =  $post_array['compiler'];
			$data['translator'] = $post_array['translator'];
			$data['title'] = $post_array['title'];
			$data['subtitle'] = $post_array['subtitle'];
			$data['first_subject'] = $post_array['first_subject'];
			$data['snd_subject'] = $post_array['snd_subject'];
			$data['thrd_subject'] = $post_array['thrd_subject'];
			$data['forth_subject'] = $post_array['forth_subject'];
			$data['fifth_subject'] = $post_array['fifth_subject'];
			$data['edition'] = $post_array['edition'];
			$data['volume'] = $post_array['volume'];
			$data['source'] = $post_array['source'];
			$data['place'] = $post_array['place'];
			$data['publisher'] = $post_array['publisher'];
			$data['y_of_pub'] = $post_array['y_of_pub'];
			$data['initial_page'] = $post_array['initial_page'];
			$data['total_page'] = $post_array['total_page'];
			$data['elastration'] = $post_array['elastration'];
			$data['cd'] = $post_array['cd'];
			$data['price'] = $post_array['price'];
			$data['currency'] = $post_array['currency'];
			$data['image'] = $post_array['image'];
			$data['user_name'] = $this->session->userdata('mem_id');
			$data['sys_date'] = date("Y-m-d");
			$this->db->insert('lib_gov_publicaton',$data);
		}
		return $post_array;
    } 
	
	//===================================================End Gov Publication=========================================
	//===============================================================================================================
	
	//===================================================Start Report=========================================
	//===============================================================================================================
	function report_set()
	{
		$this->grocery_crud->set_table('lib_report');
		$this->grocery_crud->set_subject('Report Setup');
		$this->grocery_crud->set_relation('source','source','source_name');
		$this->grocery_crud->set_relation('edition','edition','edition_name');
		$this->grocery_crud->set_relation('y_of_pub','lib_pub_year','pub_year');
		$this->grocery_crud->set_relation('place','lib_pub_place','pub_place');
		$this->grocery_crud->set_field_upload('image','img/uploads/report_image');
		$this->grocery_crud->display_as('acc_first','Acc. No. First')->display_as('acc_last','Acc. No. Last')->display_as('date_of_entry','Date of Entry')->display_as('call_no','Call No')->display_as('isbn','ISBN')->display_as('first_author','1st Author')->display_as('snd_author','2nd Author')->display_as('thrd_author','3rd Author')->display_as('first_subject','1st Subject')->display_as('snd_subject','2nd Subject')->display_as('thrd_subject','3rd Subject')->display_as('forth_subject','4th Subject')->display_as('fifth_subject','5th Subject')->display_as('y_of_pub','Year of Pub.')->display_as('initial_page','Initial Page')->display_as('total_page','Total Page')->display_as('cd','CD');
		
		$this->grocery_crud->required_fields('acc_first','acc_last','call_no','isbn','date_of_entry','title','first_subject','language','price','currency','publisher','place','y_of_pub');
		$this->grocery_crud->columns('call_no','isbn','acc_no','date_of_entry','first_author','title','first_subject','language','user_name');
		$this->grocery_crud->set_rules('acc_first', 'Acc first','trim|required|numeric|callback_report_acc_first_check');
		$this->grocery_crud->set_rules('acc_last', 'Acc last','trim|required|numeric');
		$this->grocery_crud->set_rules('price', 'Price','trim|required|numeric');
		$this->grocery_crud->set_rules('y_of_pub', 'Year of Publication','trim|numeric');
		/*$this->grocery_crud->set_rules('initial_page', 'Initial Page','trim|numeric');
		$this->grocery_crud->set_rules('total_page', 'Total Page','trim|numeric');*/
		$this->grocery_crud->callback_before_insert(array($this,'report_repeat_insert'));
		$this->grocery_crud->callback_before_update(array($this,'report_repeat_update'));
		$this->grocery_crud->callback_before_delete(array($this,'report_delete_check'));
		$this->grocery_crud->callback_after_upload(array($this,'report_callback_after_upload'));
		$this->grocery_crud->field_type('sys_date','invisible')->field_type('user_name','invisible');
		$state = $this->grocery_crud->getState();
		if($state == 'add')
    	{
       	 $this->grocery_crud->change_field_type('acc_no','hidden');
    	}
		if($state == 'edit')
    	{
       		$this->grocery_crud->change_field_type('acc_no','hidden');
			$this->grocery_crud->change_field_type('acc_first','hidden');
			$this->grocery_crud->change_field_type('acc_last','hidden');
    	}
		if($state == 'update_validation')
    	{
			$this->grocery_crud->set_rules('isbn','ISBN','trim|required|callback_report_isbn_check');
		}
		$output = $this->grocery_crud->render();
		$this->setup_output($output);
	}
	function report_callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
	  $this->load->library('image_moo');
	  //Is only one file uploaded so it ok to use it with $uploader_response[0].
	  $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	  $this->image_moo->load($file_uploaded)->resize(80,110)->save($file_uploaded,true);
	  return true;
	}
	function report_delete_check($primary_key)
    {
		$id = $primary_key;
		//$acc_no = $post_array['acc_no'];
		$this->db->select('acc_no');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_report');
		
		foreach ($query->result() as $row)
		{
			$acc_no = $row->acc_no;
		}
		$this->db->where('acc_no',$acc_no);
		$query1 = $this->db->get('booking');
		if($query1->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function report_acc_first_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$acc_first_old = $this->db->where("id",$id)->get('lib_report')->row()->acc_first;
			$this->db->where("acc_no !=",$acc_first_old);
		}
		
		$num_row = $this->db->where('acc_no',$str)->get('lib_report')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('report_acc_first_check', 'The Accession First Number already exists in Report.');
			return FALSE;
		}
		else
		{
			$num_row1 = $this->db->where('acc_no',$str)->get('lib_book')->num_rows();
			if ($num_row1 >= 1)
			{
				$this->form_validation->set_message('report_acc_first_check', 'The Accession First Number already exists in Book');
				return FALSE;
			}
			$num_row2 = $this->db->where('acc_no',$str)->get('lib_journal')->num_rows();
			if ($num_row2 >= 1)
			{
				$this->form_validation->set_message('report_acc_first_check', 'The Accession First Number already exists in Journal');
				return FALSE;
			}
			$num_row3 = $this->db->where('acc_no',$str)->get('lib_gov_publicaton')->num_rows();
			if ($num_row3 >= 1)
			{
				$this->form_validation->set_message('report_acc_first_check', 'The Accession First Number already exists in Govt. Publication');
				return FALSE;
			}
			else
			{
				$acc_last =  $_POST['acc_last'];
				if ($str > $acc_last)
				{
					$this->form_validation->set_message('report_acc_first_check', 'The Acc no. first always less than the Acc no. last');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
		}
	}
	
	public function report_isbn_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$isbn_old = $this->db->where("id",$id)->get('lib_report')->row()->isbn;
			$this->db->where("isbn !=",$isbn_old);
		}
		
		$num_row = $this->db->where('isbn',$str)->get('lib_report')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('report_isbn_check', 'The ISBN  Number already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}		
	}
	function report_repeat_update($post_array,$primary_key)
    {
		$id = $primary_key;
		$this->db->select('isbn');
		$this->db->where('id',$id);
		$query = $this->db->get('lib_report');
		
		foreach ($query->result() as $row)
		{
			$isbn = $row->isbn;
		}
		$data = array();
		$dateofentry = $post_array['date_of_entry'];
		$data['date_of_entry'] =  $dateofentry;
		$data['call_no'] =  $post_array['call_no'];
		$data['isbn'] =  $post_array['isbn'];
		$data['language'] =  $post_array['language'];
		$data['first_author'] =  $post_array['first_author'];
		$data['snd_author'] =  $post_array['snd_author'];
		$data['thrd_author'] =  $post_array['thrd_author'];
		$data['editor'] =  $post_array['editor'];
		$data['compiler'] =  $post_array['compiler'];
		$data['translator'] = $post_array['translator'];
		$data['title'] = $post_array['title'];
		$data['subtitle'] = $post_array['subtitle'];
		$data['first_subject'] = $post_array['first_subject'];
		$data['snd_subject'] = $post_array['snd_subject'];
		$data['thrd_subject'] = $post_array['thrd_subject'];
		$data['forth_subject'] = $post_array['forth_subject'];
		$data['fifth_subject'] = $post_array['fifth_subject'];
		$data['edition'] = $post_array['edition'];
		$data['volume'] = $post_array['volume'];
		$data['source'] = $post_array['source'];
		$data['place'] = $post_array['place'];
		$data['publisher'] = $post_array['publisher'];
		$data['y_of_pub'] = $post_array['y_of_pub'];
		$data['initial_page'] = $post_array['initial_page'];
		$data['total_page'] = $post_array['total_page'];
		$data['elastration'] = $post_array['elastration'];
		$data['cd'] = $post_array['cd'];
		$data['price'] = $post_array['price'];
		$data['currency'] = $post_array['currency'];
		$data['image'] = $post_array['image'];
		$data['user_name'] = $this->session->userdata('mem_id');
		$data['sys_date'] = date("Y-m-d");
		$this->db->where('isbn',$isbn);
		$this->db->update('lib_report',$data);
		return true;
	//return $post_array;
    }
	
	function report_repeat_insert($post_array)
    {
		$acc_first = $post_array['acc_first'];
		$acc_last = $post_array['acc_last'];
		$post_array['acc_no'] = $post_array['acc_first'];
		$post_array['user_name'] = $this->session->userdata('mem_id');
		$post_array['sys_date'] = date("Y-m-d");
		
		for($i=$acc_first + 1; $i<=$acc_last; $i++)
		{
			$data = array();
			$data['acc_no'] = $i;
			$data['acc_first'] = $post_array['acc_first'];
			$data['acc_last'] =  $post_array['acc_last'];
			$data['date_of_entry'] =  $post_array['date_of_entry'];
			$data['call_no'] =  $post_array['call_no'];
			$data['isbn'] =  $post_array['isbn'];
			$data['language'] =  $post_array['language'];
			$data['first_author'] =  $post_array['first_author'];
			$data['snd_author'] =  $post_array['snd_author'];
			$data['thrd_author'] =  $post_array['thrd_author'];
			$data['editor'] =  $post_array['editor'];
			$data['compiler'] =  $post_array['compiler'];
			$data['translator'] = $post_array['translator'];
			$data['title'] = $post_array['title'];
			$data['subtitle'] = $post_array['subtitle'];
			$data['first_subject'] = $post_array['first_subject'];
			$data['snd_subject'] = $post_array['snd_subject'];
			$data['thrd_subject'] = $post_array['thrd_subject'];
			$data['forth_subject'] = $post_array['forth_subject'];
			$data['fifth_subject'] = $post_array['fifth_subject'];
			$data['edition'] = $post_array['edition'];
			$data['volume'] = $post_array['volume'];
			$data['source'] = $post_array['source'];
			$data['place'] = $post_array['place'];
			$data['publisher'] = $post_array['publisher'];
			$data['y_of_pub'] = $post_array['y_of_pub'];
			$data['initial_page'] = $post_array['initial_page'];
			$data['total_page'] = $post_array['total_page'];
			$data['elastration'] = $post_array['elastration'];
			$data['cd'] = $post_array['cd'];
			$data['price'] = $post_array['price'];
			$data['currency'] = $post_array['currency'];
			$data['image'] = $post_array['image'];
			$data['user_name'] = $this->session->userdata('mem_id');
			$data['sys_date'] = date("Y-m-d");
			$this->db->insert('lib_report',$data);
		}
		return $post_array;
    } 
	
	//===================================================End Report=========================================
	//===============================================================================================================
	
	public function accessories_check($str)
	{
	  $id = $this->uri->segment(4);
	  if(!empty($id) && is_numeric($id))
	  {
	   $accessories_old = $this->db->where("id",$id)->get('library_accessories')->row()->accessories_name;
	   $this->db->where("accessories_name !=",$accessories_old);
	  }
	  
	  $num_row = $this->db->where('accessories_name',$str)->get('library_accessories')->num_rows();
	  if ($num_row >= 1)
	  {
	   $this->form_validation->set_message('accessories_check', 'The accessories_check already exists');
	   return FALSE;
	  }
	  else
	  {
	   return TRUE;
	  }
	}
	
	function checking_update_date($post_array) //for inventory upfate date field
	{   
		$update_date = date('Y-m-d');
		$post_array['last_updated'] = $update_date;
		return $post_array;
	}
	
	function source_set()
	{
		$this->grocery_crud->set_table('source');
		$this->grocery_crud->set_subject('Source Setup');
		$this->grocery_crud->display_as('source_name','Source');
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->unset_edit();
		$output = $this->grocery_crud->render();
	
		$this->configure_output($output);
		
	}
	
	function edt_set()
	{
		$this->grocery_crud->set_table('edition');
		$this->grocery_crud->set_subject('Edition Setup');
		// $this->grocery_crud->callback_column('buyPrice',array($this,'valueToEuro'));
		$this->grocery_crud->required_fields('edition_name');
		$this->grocery_crud->display_as('edition_name','Edition Name');
		$this->grocery_crud->set_rules('edition_name','Edition Name','trim|required|callback_edition_name_check');
		$this->grocery_crud->unset_delete();
		//$this->grocery_crud->unset_edit();
		$output = $this->grocery_crud->render();
		$this->configure_output($output);
	}
	
	function edition_name_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$edition_name_old = $this->db->where("id",$id)->get('edition')->row()->edition_name;
			$this->db->where("edition_name !=",$edition_name_old);
		}
		$num_row = $this->db->where('edition_name',$str)->get('edition')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('edition_name_check', "This Edition Name already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function designation_set()
	{
		$this->grocery_crud->set_table('lib_designation');
		$this->grocery_crud->set_subject('Designation Entry');
		$this->grocery_crud->required_fields('designation');
		$this->grocery_crud->display_as('designation','Designation Name');
		$this->grocery_crud->set_rules('designation','Designation Name','trim|required|callback_designation_check');
		$this->grocery_crud->unset_delete();
		//$this->grocery_crud->unset_edit();
		$output = $this->grocery_crud->render();
		$this->configure_output($output);
	}
	
	function designation_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$designation_old = $this->db->where("id",$id)->get('lib_designation')->row()->designation;
			$this->db->where("designation !=",$designation_old);
		}
		$num_row = $this->db->where('designation',$str)->get('lib_designation')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('designation_check', "This Designation Name already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function place_set()
	{
		$this->grocery_crud->set_table('lib_pub_place');
		$this->grocery_crud->set_subject('Publishing Place');
		$this->grocery_crud->required_fields('pub_place');
		$this->grocery_crud->display_as('pub_place','Publishing Place');
		$this->grocery_crud->unset_delete();
		//$this->grocery_crud->unset_edit();
		$this->grocery_crud->set_rules('pub_place','Publishing Place','trim|required|callback_pub_place_check');
		$output = $this->grocery_crud->render();
		$this->configure_output($output);
	}
	
	function pub_place_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$pub_place_old = $this->db->where("id",$id)->get('lib_pub_place')->row()->pub_year;
			$this->db->where("pub_place !=",$pub_place_old);
		}
		$num_row = $this->db->where('pub_place',$str)->get('lib_pub_place')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('pub_place_check', "This Place already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function year_set()
	{
		$this->grocery_crud->set_table('lib_pub_year');
		$this->grocery_crud->set_subject('Publishing Year');
		$this->grocery_crud->required_fields('pub_year');
		$this->grocery_crud->display_as('pub_year','Publishing Year');
		$this->grocery_crud->unset_delete();
		//$this->grocery_crud->unset_edit();
		$this->grocery_crud->set_rules('pub_year','Publishing Year','trim|required|callback_pub_year_check');
		$output = $this->grocery_crud->render();
		$this->configure_output($output);
	}
	
	
	function pub_year_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$pub_year_old = $this->db->where("id",$id)->get('lib_pub_year')->row()->pub_year;
			$this->db->where("pub_year !=",$pub_year_old);
		}
		$num_row = $this->db->where('pub_year',$str)->get('lib_pub_year')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('pub_year_check', "This Year already exists");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	
	//-----------------------------------------------------------------------------------------------------
	// Library Setup
	//-----------------------------------------------------------------------------------------------------


	
	function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	
	function barcode_generator()
	{
		$result = $this->processdb->barcode_generator_db();
		echo $result;
		//return $result;
	}

	
	function type_insert($post_array)
    {
		$post_array['type'] = "visitor";
		return $post_array; 
	}
		
}