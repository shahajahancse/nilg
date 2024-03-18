<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Backend_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) :
			redirect('login');
		endif;

		// dd($this->session->all_userdata());		
		$this->userID = $this->session->userdata('user_id');
		$this->load->model('Dashboard_model');
		$this->load->model('training/Training_model');		
	}

	public function index()
	{
		if ($this->ion_auth->in_group('guest')) { // Guest User (15) Dashboard 

			/*
			// Get user information
			$user = $this->Common_model->get_user_details();
			// dd($user);
			*/

			// Get user application information
			$this->data['info'] = $this->Common_model->get_user_details();
			// dd($this->data['info']);
			// $this->data['info'] = $this->Common_model->get_user_submitted_info();
			$page = 'guest_dashboard_trainee';

			// Load page       
			$this->data['meta_title'] = 'গেস্ট ইউজারের ড্যাশবোর্ড';
			$this->data['subview'] = $page;
			$this->load->view('backend/_layout_main', $this->data);

		}elseif ($this->ion_auth->in_group('acc')) { // ddlg (14) Dashboard 


			$this->data['budget_field'] = $this->db->get('budget_field')->result();
			$this->data['budget_nilg'] = $this->db->get('budget_nilg')->result();
			$this->data['budgets_entry'] = $this->db->get('budgets')->result();
			$budgets = $this->db->get('budgets')->result();
			$in_amount = 0;
			foreach ($budgets as $budget) {
				if (isset($budget->amount)) {
					$in_amount += $budget->amount;
				}
			}
			$this->data['in_amount'] =  $in_amount;










			
			$this->data['info'] = $this->Dashboard_model->get_office_info();      
			$this->data['meta_title'] = 'অ্যাকাউন্ট ড্যাশবোর্ড';
			$this->data['subview'] = 'acc_dashboard';
			$this->load->view('backend/_layout_main', $this->data);



		}   elseif ($this->ion_auth->in_group('trainee')) { // Trainee (10) Dashboard 
			// echo 'Hello'; exit;
			// Get all information
			$results = $this->Dashboard_model->get_trainee_all_data();
			// dd($results['info']);
			$this->data['info'] = $results['info'];

			// Details of Public Representative (PR) and Empployee
			if ($this->data['info']->employee_type == 1) {
				$page = 'trainee_pr_dashboard';
			} else {
				$page = 'trainee_employee_dashboard';
			}

			// Load page       
			$this->data['meta_title'] = 'প্রশিক্ষণার্থীর ড্যাশবোর্ড';
			$this->data['subview'] = $page;
			$this->load->view('backend/_layout_main', $this->data);

			
		} elseif ($this->ion_auth->in_group('trainer')) { // Trainee (11) Dashboard 

			// Get user information
			// $this->data['info'] = $this->Common_model->get_user_submitted_info();
			// dd($user);

			// Load page       
			$this->data['meta_title'] = 'প্রশিক্ষকের ড্যাশবোর্ড';
			$this->data['subview'] = 'trainer_dashboard';
			$this->load->view('backend/_layout_main', $this->data);


		} elseif ($this->ion_auth->in_group('up')) { 
			/*
			@Group ID:		7
			@Group Name:	up		
			@Office Type:	Union Parishad (1)
			*/

			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'ইউনিয়ন পরিষদের ড্যাশবোর্ড';
			$this->data['subview'] = 'up_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		} elseif ($this->ion_auth->in_group('paura')) {	// Paurashava (6) Dashboard 

			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'পৌরসভার ড্যাশবোর্ড';
			$this->data['subview'] = 'paura_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

			
		} elseif ($this->ion_auth->in_group('uz')) {	// Paurashava (6) Dashboard 

			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'উপজেলা পরিষদের ড্যাশবোর্ড';
			$this->data['subview'] = 'uz_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

			
		} elseif ($this->ion_auth->in_group('zp')) {	// Paurashava (6) Dashboard 

			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'জেলা পরিষদের ড্যাশবোর্ড';
			$this->data['subview'] = 'zp_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

			
		} elseif ($this->ion_auth->in_group('city')) {	// Paurashava (6) Dashboard 

			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'সিটি কর্পোরেশন ড্যাশবোর্ড';
			$this->data['subview'] = 'city_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

			
		} elseif ($this->ion_auth->in_group('partner')) { // Partner (12) Dashboard 

			// Get user application information
			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// $this->data['info'] = $this->Common_model->get_user_details();
			// dd($this->data['info']);
			// $this->data['info'] = $this->Common_model->get_user_submitted_info();


			// Load page       
			$this->data['meta_title'] = 'ডেভেলপমেন্ট পার্টনার ড্যাশবোর্ড';
			$this->data['subview'] = 'partner_dashboard';
			$this->load->view('backend/_layout_main', $this->data);


		} elseif ($this->ion_auth->in_group('nilg')) { // Partner (12) Dashboard 

			// Get user application information
			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// $this->data['info'] = $this->Common_model->get_user_details();
			// dd($this->data['info']);
			// $this->data['info'] = $this->Common_model->get_user_submitted_info();


			// Load page       
			$this->data['meta_title'] = 'এনআইএলজি ড্যাশবোর্ড';
			$this->data['subview'] = 'nilg_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		} elseif ($this->ion_auth->in_group('ddlg')) { // ddlg (14) Dashboard 
			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'ডিডিএলজি ড্যাশবোর্ড';
			$this->data['subview'] = 'ddlg_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		/*
		} elseif ($this->ion_auth->in_group('urt')) { // urt (13) Dashboard 
			$this->data['info'] = $this->Dashboard_model->get_office_info();
			// dd($this->data['info']);

			// Load page       
			$this->data['meta_title'] = 'ডিআরটি ড্যাশবোর্ড';
			$this->data['subview'] = 'urt_dashboard';
			$this->load->view('backend/_layout_main', $this->data);
		*/

		}elseif ($this->ion_auth->is_admin()) { // Admin (1) Dashboard
			// dd($this->data['courseStatistics']);

			// Total Data 
			$this->data['totalData'] = $this->Dashboard_model->get_count_user_second();
			$this->data['totalTraining'] = $this->Dashboard_model->get_count_training();
			$this->data['totalOffice'] = $this->Dashboard_model->get_count_office();
			$this->data['totalOfficeUser'] = $this->Dashboard_model->get_count_user_office();			
			// Training summary 
			$this->data['finances'] = $this->Dashboard_model->get_count_training_second();

			// Box summary data			
			// Details summary data Representative
			/*$this->data['totalData'] = $this->Dashboard_model->get_count_user();
			$this->data['total_representative'] = $this->Dashboard_model->get_count_user(array(1,2,3,4,5,7), 1);
			$this->data['rep_union'] = $this->Dashboard_model->get_count_user(array(1), 1);
			$this->data['rep_paurashova'] = $this->Dashboard_model->get_count_user(array(2), 1);
			$this->data['rep_upazila'] = $this->Dashboard_model->get_count_user(array(3), 1);
			$this->data['rep_zila'] = $this->Dashboard_model->get_count_user(array(4), 1);
			$this->data['rep_city'] = $this->Dashboard_model->get_count_user(array(5), 1);
			$this->data['rep_nilg'] = $this->Dashboard_model->get_count_user(array(7), 1);*/

			// Details summary data Kormokorta
			/*$this->data['total_kormokorta'] = $this->Dashboard_model->get_count_user(array(1,2,3,4,5,7), '2');
			$this->data['emp1_union'] = $this->Dashboard_model->get_count_user(array(1), 2);
			$this->data['emp1_paurashova'] = $this->Dashboard_model->get_count_user(array(2), 2);
			$this->data['emp1_upazila'] = $this->Dashboard_model->get_count_user(array(3), 2);
			$this->data['emp1_zila'] = $this->Dashboard_model->get_count_user(array(4), 2);
			$this->data['emp1_city'] = $this->Dashboard_model->get_count_user(array(5), 2);
			$this->data['emp1_nilg'] = $this->Dashboard_model->get_count_user(array(7), 2);*/

			// Details summary data Kormochari
			/*$this->data['total_kormocari'] = $this->Dashboard_model->get_count_user(array(1,2,3,4,5,7), '3');
			$this->data['emp2_union'] = $this->Dashboard_model->get_count_user(array(1), 3);
			$this->data['emp2_pourashova'] = $this->Dashboard_model->get_count_user(array(2), 3);
			$this->data['emp2_upazila'] = $this->Dashboard_model->get_count_user(array(3), 3);
			$this->data['emp2_zila'] = $this->Dashboard_model->get_count_user(array(4), 3);
			$this->data['emp2_city'] = $this->Dashboard_model->get_count_user(array(5), 3);
			$this->data['emp2_nilg'] = $this->Dashboard_model->get_count_user(array(7), 3);*/

			// Details summary data Kormokorta
			/*$this->data['total_nilg_kormokorta'] = $this->Dashboard_model->get_count_user(array(7), 2);
			$this->data['total_nilg_kormocari'] = $this->Dashboard_model->get_count_user(array(7), 3);
			$this->data['nilg_emp1_male'] = $this->Dashboard_model->get_count_user(array(7), 2, null, 'Male');
			$this->data['nilg_emp1_female'] = $this->Dashboard_model->get_count_user(array(7), 2, null, 'Female');
			$this->data['nilg_emp2_male'] = $this->Dashboard_model->get_count_user(array(7), 3, null, 'Male');
			$this->data['nilg_emp2_female'] = $this->Dashboard_model->get_count_user(array(7), 3, null, 'Female');*/


			// Training summary 
			/*$this->data['training_revenue'] = $this->Dashboard_model->get_count_training(1);
			$this->data['training_undp'] = $this->Dashboard_model->get_count_training(2);
			$this->data['training_jica'] = $this->Dashboard_model->get_count_training(3);
			$this->data['training_unicef'] = $this->Dashboard_model->get_count_training(4);
			$this->data['training_helvetas'] = $this->Dashboard_model->get_count_training(5);
			$this->data['training_swiss'] = $this->Dashboard_model->get_count_training(6);
			$this->data['training_uicdp'] = $this->Dashboard_model->get_count_training(7);
			$this->data['training_p4d'] = $this->Dashboard_model->get_count_training(8);*/

			// Office wise statistics			
			/*$this->data['officeUnion'] = $this->Dashboard_model->get_count_user(array(1));
			$this->data['officePaurashava'] = $this->Dashboard_model->get_count_user(array(2));
			$this->data['officeUpazila'] = $this->Dashboard_model->get_count_user(array(3));
			$this->data['officeDdlg'] = $this->Dashboard_model->get_count_user(array(8));
			$this->data['officeZila'] = $this->Dashboard_model->get_count_user(array(4));
			$this->data['officeCity'] = $this->Dashboard_model->get_count_user(array(5));
			$this->data['officeNilg'] = $this->Dashboard_model->get_count_user(array(7));
			$this->data['officeMinistry'] = $this->Dashboard_model->get_count_user(array(9));
			$this->data['officeDirectorate'] = $this->Dashboard_model->get_count_user(array(10));
			$this->data['officeDevlopment'] = $this->Dashboard_model->get_count_user(array(6));*/

			

			// Course Statistics
			$this->data['courseStatistics'] = $this->Dashboard_model->get_count_training_of_course();

			//echo '<pre>';
			//print_r($this->data['monthly_prosikhon_count']); exit;
			//Load page       
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'superadmin_dashboard';
			$this->load->view('backend/_layout_main', $this->data);		

		} else {		

			//Load page       
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'member_dashboard';
			$this->load->view('backend/_layout_main', $this->data);
		}
	}


	public function search($offset = 0){
		// dd($this->input->get());

		//Manage list the users
		$limit = 50;
		$results = $this->Dashboard_model->get_users($limit, $offset);
        // print_r($results); exit;

		$this->data['users'] = $results['rows'];
		$this->data['total_rows'] = $results['num_rows'];

		foreach ($this->data['users'] as $k => $user) {
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		// $results = $this->Trainee_model->get_all_pr($limit, $offset);
		// Results
		// $this->data['results'] = $results['rows'];
		// $this->data['total_rows'] = $results['num_rows'];
      // dd($this->data['results']);

      // Pagination
		$this->data['pagination'] = create_pagination('dashboard/search/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

		//Load page       
		$this->data['meta_title'] = 'অনুসন্ধানের ফলাফল';
		$this->data['subview'] = 'search';
		$this->load->view('backend/_layout_main', $this->data);
	}





	/******************************* Course Registration ************************/
	/****************************************************************************/

	public function my_training()
	{
		// Check Auth
		if(!$this->ion_auth->in_group(array('trainee'))){
			redirect('dashboard');
		}

		// Results
		$this->data['results'] = $this->Dashboard_model->get_my_training();
		// dd($this->data['results']);
		// $t=$this->Common_model->get_training_info(1);  
		// dd($t);

		// View
		$this->data['meta_title'] = 'প্রশিক্ষণ কোর্স';
		$this->data['subview'] = 'my_training';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function my_training_schedule($id)
	{
		// Check Auth
		if(!$this->ion_auth->in_group(array('trainee'))){
			redirect('dashboard');
		}

		// Decrypt Data        
     	$dataID = (int) decrypt_url($id); //exit;
      // Check Exists
     	if (!$this->Common_model->exists('training', 'id', $dataID)) {
      	// redirect('dashboard');
     		show_404('dashboard > my_training_schedule', TRUE);
     	}

     	$this->data['training'] = $this->Training_model->get_training_info($dataID);
     	$this->data['results'] = $this->Training_model->get_schedule($dataID);
      // dd($this->data['training']);

      //Load Page
     	$this->data['meta_title'] = 'প্রশিক্ষণ কর্মসূচী';
     	$this->data['subview'] = 'my_training_schedule';
     	$this->load->view('backend/_layout_main', $this->data);
     }

    public function my_training_schedule_docs($id)
    {
     	// Check Auth
     	if(!$this->ion_auth->in_group(array('trainee'))){
     		redirect('dashboard');
     	}

		// Decrypt Data        
		$scheduleID = (int) decrypt_url($id); //exit;
		// Check Exists
		if (!$this->Common_model->exists('training_schedule', 'id', $scheduleID)) {
		// redirect('dashboard');
			show_404('dashboard > my_training_schedule_docs', TRUE);
		}

        // Results
		$this->data['info']     = $this->Training_model->get_schedule_info($scheduleID);
		$this->data['documents']= $this->Training_model->get_documents_by_schedule($scheduleID);
      // dd($this->data['info']);

        // Load Page
		$this->data['meta_title'] = 'ট্রেনিং ডকুমেন্ট';
		$this->data['subview'] = 'my_training_schedule_docs';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function course_registration()
	{
		// Results
		$this->data['results'] = $this->Dashboard_model->get_training_circular();
		// dd($this->data['results']);

		// View
		$this->data['meta_title'] = 'কোর্স রেজিস্ট্রেশন';
		$this->data['subview'] = 'course_registration';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function course_application($id)
	{
		// Decrypt Data        
     	$dataID = (int) decrypt_url($id); //exit;
      // Check Exists
     	if (!$this->Common_model->exists('training', 'id', $dataID)) {
         // redirect('dashboard');
     		show_404('dashboard > course_application', TRUE);
     	}

     	$this->data['mandatory'] = $this->Dashboard_model->get_mandatory_info($dataID);
     	$mandatory = $this->data['mandatory'];

		// Validation
     	$this->form_validation->set_rules('pin', 'pin', 'required');

		// Validate and Insert to DB
     	if ($this->form_validation->run() == true) {

      	// Check mandatory field is fillupd
     		/*
     		if (empty($mandatory->nid) || empty($mandatory->crrnt_office_id) || empty($mandatory->crrnt_desig_id)) {
     			$this->session->set_flashdata('success', 'মাই প্রোফাইলের তথ্য সঠিকভাবে পূরণ করুন');
     			redirect("dashboard/course_application/".encrypt_url($dataID));
     		}
     		*/

     		$ip = $this->input->ip_address();
     		$trainingID = decrypt_url($this->input->post('hide_training_id'));
     		$pin = $this->input->post('pin');
			// dd($this->Registration_model->check_is_applied(103, 114));

			// Match course ID and PIN
     		if ($this->Dashboard_model->match_training_id_pin($trainingID, $pin) == true) {
				// Get applicant info
				// $user = $this->Dashboard_model->get_applicant_info($nid);
				// dd($user);

				// If application dropped before
     			if ($this->Dashboard_model->check_is_applied($trainingID, $this->userID) == true) {
					// Course apply
     				$this->session->set_flashdata('warning', 'এই কোর্সে আপনি পূর্বে আবেদন করেছেন!');
     			} else {
					// Store application to database
     				$data = array(
     					'training_id'   => $trainingID,
     					'app_user_id'   => $this->userID,
     					'app_date'      => date('Y-m-d H:i:s'),
     					'is_apply'      => 1,
     					'ip_address'    => $ip
     					);
     				if ($this->Common_model->save('training_participant', $data)) {
						// Success
     					$this->session->set_flashdata('success', 'আপনার আবেদনটি সঠিকভাবে ডাটাবেজে সংরক্ষণ করা হয়েছে');
     					redirect("dashboard/course_application_success");
     				}
     			}
     		} else {
				// PIN not match
     			$this->session->set_flashdata('warning', 'পিন নম্বর সঠিক হয়নি!');
     		}
     	}

		// Results
     	$this->data['info'] = $this->Dashboard_model->get_course_info($dataID);      

		// dd($this->data['info']);
		//subjects list for trainer

		// View
     	$this->data['meta_title'] = 'কোর্স রেজিস্ট্রেশন';
     	$this->data['subview'] = 'course_application';
     	$this->load->view('backend/_layout_main', $this->data);
    }





     public function document_upload($id, $schedule_id)
     {
     	$this->data['get_training'] = $this->Common_model->get_training_by_id($id, $schedule_id);

		// dd($this->data['get_training']); exit();


     	$this->data['meta_title'] = 'ডকুমেন্ট আপলোড করুন';
     	$this->data['subview'] = 'document_upload';
     	$this->load->view('backend/_layout_main', $this->data);
     }


	/*public function material_upload()
	{
		// echo "string";
		$id = $this->input->post('training_id');
		$count = count($_FILES['userfile']['size']);
		// dd($id);

		foreach ($_FILES as $key => $value) {
			for ($s = 0; $s <= $count - 1; $s++) {
				$new_file_name = $id . time();

				$_FILES['userfile']['name']     = $value['name'][$s];
				$_FILES['userfile']['type']     = $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']    = $value['error'][$s];
				$_FILES['userfile']['size']     = $value['size'][$s];

				$config['upload_path']      = $this->file_path;
				$config['allowed_types']    = 'gif|jpg|png|doc|docx|xls|xlsx|pdf';
				$config['max_size']         = '60000';
				$config['file_name']        = $new_file_name;
				//$config['max_width']        = '3000';
				//$config['max_height']       = '3000';
				// dd($new_file_name);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload()) {
					$uploadData = $this->upload->data();
					$uploadedFile = $uploadData['file_name'];

					// $source_path = $this->file_path.'/'.$uploadedFile; 
					// $target_path = $this->img_path.'/thumb_'. $uploadedFile;
					//$this->resize($source_path, $target_path);
					// dd($uploadedFile);

					$file_data = array(
						'training_id' => $this->input->post('training_id'),
						'schedule_id' => $this->input->post('schedule_id'),
						'course_id' => $this->input->post('course_id'),
						'uploader_id' => $this->input->post('uploader_id'),
						'file'  => $uploadedFile
						);

					$this->Common_model->save('training_attachment', $file_data);
				}
			}
		}

		$this->session->set_flashdata('success', 'New Attachment insert successfully.');

		// echo "Success"; exit();
		redirect("dashboard/selected_subject");
	}*/

	

	public function pdf_training_material($id)
	{

		// View
		$this->data['meta_title'] = 'কোর্স রেজিস্ট্রেশনের জন্য আবেদন ফরম';
		$this->data['subview'] = 'course_application';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function course_application_success()
	{
		// View
		$this->data['meta_title'] = 'কোর্সের আবেদন সফলভাবে সম্পন্ন হয়েছে';
		$this->data['subview'] = 'course_application_success';
		$this->load->view('backend/_layout_main', $this->data);
	}

	/******************************* Edit Form ************************/
	/******************************************************************/
	/*
	public function edit_edit()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('login');
		}
		// echo 'Information Form'; exit;

		// Get user information
		$this->data['info'] = $this->Common_model->get_user_info();
		// dd($this->data['info']); exit;
		// echo $this->data['info']->user_type; exit();
		$employeeType = $this->data['info']->employee_type;
		$userID = $this->data['info']->id;


		// If not trainer 
		if ($this->data['info']->user_type != 2) {
			redirect('registration/trainer_application_form');
		}

		// Submit infromation of Public Representative, Emaployee
		if ($employeeType == 1) {
			// 1='Jonoprothinidhi'
			//Validation
			$this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
			$this->form_validation->set_rules('name_en', 'name english', 'required|trim');

			if ($this->form_validation->run() == true) {
				$form_data = array(
					'is_applied'            => 1,
					'name_bn'               => $this->input->post('name_bn'),
					'name_en'               => strtoupper($this->input->post('name_en')),
					'father_name'           => $this->input->post('father_name'),
					'mother_name'           => $this->input->post('mother_name'),
					'gender'                => $this->input->post('gender'),
					'ms_id'                 => $this->input->post('ms_id'),
					'son_no'                => $this->input->post('son_no'),
					'daughter_no'           => $this->input->post('daughter_no'),
					'present_add'           => $this->input->post('present_add'),
					'per_div_id'            => $this->input->post('per_div_id'),
					'per_dis_id'            => $this->input->post('per_dis_id'),
					'per_upa_id'            => $this->input->post('per_upa_id'),
					'per_road_no'           => $this->input->post('per_road_no'),
					'permanent_add'         => $this->input->post('permanent_add'),
					'per_pc'                => $this->input->post('per_pc'),
					'per_po'                => $this->input->post('per_po'),
					'crrnt_elected_year'    => $this->input->post('crrnt_elected_year'),
					'crrnt_attend_date'     => $this->input->post('crrnt_attend_date'),
					'first_office_id'       => $this->input->post('first_office_id'),
					'first_desig_id'        => $this->input->post('first_desig_id'),
					'first_elected_year'    => $this->input->post('first_elected_year'),
					'first_attend_date'     => $this->input->post('first_attend_date'),
					'elected_times'         => $this->input->post('elected_times'),
					'modified'              => date('Y-m-d H:i:s')
					);

				if ($this->Common_model->edit('users', $userID, 'id', $form_data)) {
					// Experiance 
					for ($i = 0; $i < sizeof($_POST['exp_office_id']); $i++) {
						$experience_data = array(
							'data_id' => $userID,
							'exp_office_id' => $_POST['exp_office_id'][$i],
							'exp_design_id' => $_POST['exp_design_id'][$i],
							'exp_duration' => $_POST['exp_duration'][$i],
							);
						$this->Common_model->save('per_experience', $experience_data);
					}
					// Education 
					for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
						$education_data = array(
							'data_id' => $userID,
							'edu_exam_id' => $_POST['edu_exam_id'][$i],
							'edu_pass_year' => $_POST['edu_pass_year'][$i],
							'edu_subject_id' => $_POST['edu_subject_id'][$i],
							'edu_board_id' => $_POST['edu_board_id'][$i],
							);
						$this->Common_model->save('per_education', $education_data);
					}
					// NILG training
					for ($i = 0; $i < sizeof($_POST['nilg_course_id']); $i++) {
						$local_org_data = array(
							'data_id' => $userID,
							'nilg_course_id' => $_POST['nilg_course_title'][$i],
							'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
							'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
							'nilg_training_start' => $_POST['nilg_training_start'][$i],
							'nilg_training_end' => $_POST['nilg_training_end'][$i],
							);
						$this->Common_model->save('per_nilg_training', $local_org_data);
					}
					// Local organization training
					for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
						$local_org_data = array(
							'data_id' => $userID,
							'local_course_name' => $_POST['local_course_name'][$i],
							'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
							'local_training_start' => $_POST['local_training_start'][$i],
							'local_training_end' => $_POST['local_training_end'][$i],
							);
						$this->Common_model->save('per_local_org_training', $local_org_data);
					}
					// Foreign organization training
					for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
						$foreign_org_data = array(
							'data_id' => $userID,
							'foreign_course_name' => $_POST['foreign_course_name'][$i],
							'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
							'foreign_training_start' => $_POST['foreign_training_start'][$i],
							'foreign_training_end' => $_POST['foreign_training_end'][$i],
							);
						$this->Common_model->save('per_foreign_org_training', $foreign_org_data);
					}

					// Message
					$this->session->set_flashdata('success', 'আপনার রেজিস্ট্রেশন আবেদনটি সফলভাবে আমাদের ডাটাবেজে সংরক্ষিত হয়েছে');
					redirect('registration/submitted_information');
				}
			}
		} elseif ($employeeType == 2 || $employeeType == 3) {
			// 2=কর্মকর্তা, 3=কর্মচারী
			//Validation
			$this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
			$this->form_validation->set_rules('name_en', 'name english', 'required|trim');

			if ($this->form_validation->run() == true) {
				$form_data = array(
					'is_applied'            => 1,
					'name_bn'               => $this->input->post('name_bn'),
					'name_en'               => strtoupper($this->input->post('name_en')),
					'father_name'           => $this->input->post('father_name'),
					'mother_name'           => $this->input->post('mother_name'),
					'gender'                => $this->input->post('gender'),
					'ms_id'                 => $this->input->post('ms_id'),
					'son_no'                => $this->input->post('son_no'),
					'daughter_no'           => $this->input->post('daughter_no'),
					'present_add'           => $this->input->post('present_add'),
					'per_div_id'            => $this->input->post('per_div_id'),
					'per_dis_id'            => $this->input->post('per_dis_id'),
					'per_upa_id'            => $this->input->post('per_upa_id'),
					'per_road_no'           => $this->input->post('per_road_no'),
					'permanent_add'         => $this->input->post('permanent_add'),
					'per_pc'                => $this->input->post('per_pc'),
					'per_po'                => $this->input->post('per_po'),
					'first_office_id'       => $this->input->post('first_office_id'),
					'crrnt_office_id'       => $this->input->post('crrnt_office_id'),
					'first_desig_id'        => $this->input->post('first_desig_id'),
					'crrnt_desig_id'        => $this->input->post('crrnt_desig_id'),
					'first_attend_date'     => $this->input->post('first_attend_date'),
					'crrnt_attend_date'     => $this->input->post('curr_attend_date'),
					'job_per_date'          => $this->input->post('job_per_date'),
					'retirement_date'       => $this->input->post('retirement_date'),
					'prl_date'              => $this->input->post('retirement_prl_date'),
					'modified'              => date('Y-m-d H:i:s')
					);

				if ($this->Common_model->edit('users', $userID, 'id', $form_data)) {
					// Experiance 
					for ($i = 0; $i < sizeof($_POST['exp_office_id']); $i++) {
						$experience_data = array(
							'data_id' => $userID,
							'exp_office_id' => $_POST['exp_office_id'][$i],
							'exp_design_id' => $_POST['exp_design_id'][$i],
							'exp_duration' => $_POST['exp_duration'][$i],
							);
						$this->Common_model->save('per_experience', $experience_data);
					}
					// promotion 
					for ($i = 0; $i < sizeof($_POST['promo_org_name']); $i++) {
						$promotion_data = array(
							'data_id' => $userID,
							'promo_org_name'     => $_POST['promo_org_name'][$i],
							'promo_desig_id'     => $_POST['promo_desig_id'][$i],
							'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
							'promo_comments'     => $_POST['promo_comments'][$i],
							);
						$this->Common_model->save('per_promotion', $promotion_data);
					}
					// Education 
					for ($i = 0; $i < sizeof($_POST['edu_exam_id']); $i++) {
						$education_data = array(
							'data_id' => $userID,
							'edu_exam_id' => $_POST['edu_exam_id'][$i],
							'edu_pass_year' => $_POST['edu_pass_year'][$i],
							'edu_subject_id' => $_POST['edu_subject_id'][$i],
							'edu_board_id' => $_POST['edu_board_id'][$i],
							);
						$this->Common_model->save('per_education', $education_data);
					}
					// NILG training
					for ($i = 0; $i < sizeof($_POST['nilg_course_id']); $i++) {
						$local_org_data = array(
							'data_id' => $userID,
							'nilg_course_id' => $_POST['nilg_course_title'][$i],
							'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
							'nilg_batch_no' => $_POST['nilg_batch_no'][$i] != NULL ? $_POST['nilg_batch_no'][$i] : NULL,
							'nilg_training_start' => $_POST['nilg_training_start'][$i],
							'nilg_training_end' => $_POST['nilg_training_end'][$i],
							);
						$this->Common_model->save('per_nilg_training', $local_org_data);
					}
					// Local organization training
					for ($i = 0; $i < sizeof($_POST['local_course_name']); $i++) {
						$local_org_data = array(
							'data_id' => $userID,
							'local_course_name' => $_POST['local_course_name'][$i],
							'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
							'local_training_start' => $_POST['local_training_start'][$i],
							'local_training_end' => $_POST['local_training_end'][$i],
							);
						$this->Common_model->save('per_local_org_training', $local_org_data);
					}
					// Foreign organization training
					for ($i = 0; $i < sizeof($_POST['foreign_course_name']); $i++) {
						$foreign_org_data = array(
							'data_id' => $userID,
							'foreign_course_name' => $_POST['foreign_course_name'][$i],
							'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
							'foreign_training_start' => $_POST['foreign_training_start'][$i],
							'foreign_training_end' => $_POST['foreign_training_end'][$i],
							);
						$this->Common_model->save('per_foreign_org_training', $foreign_org_data);
					}
					$this->session->set_flashdata('success', 'আপনার রেজিস্ট্রেশন আবেদনটি সফলভাবে আমাদের ডাটাবেজে সংরক্ষিত হয়েছে');
					// echo "successful"; exit();
					redirect('registration/submitted_information');
				}
			}
		}


		// Dropdown List
		$this->data['division'] = $this->Common_model->get_division();
		$this->data['marital_status'] = $this->Common_model->get_marital_status();
		$this->data['office'] = $this->Common_model->get_office();
		$this->data['designation'] = $this->Common_model->get_designations(1);

		$this->data['exams'] = $this->Common_model->get_all('*', 'exam_names', '1');
		$this->data['subjects'] = $this->Common_model->get_all('*', 'subjects', '1');
		$this->data['boards'] = $this->Common_model->get_all('*', 'boards', '1');
		$this->data['leave_type'] = $this->Common_model->get_leave_type();
		$this->data['employeeType'] = $employeeType;

		// Application Form Interface Public Representative (PR) and Empployee
		if ($this->data['info']->employee_type == 1) {
			$page = 'edit_trainee_general_info';
		} else {
			$page = 'application_form_employee';
		}


		// Load page       
		$this->data['meta_title'] = 'ব্যক্তিগত বা সাধারণ তথ্য সংশোধন ফর্ম';
		$this->data['subview'] = $page;
		$this->load->view('backend/_layout_main', $this->data);
	}
	*/


	public function blank()
	{
		$this->data['page_heading'] = 'Blank Page';
		$this->data['subview'] = 'dashboard/blank';
		$this->load->view('backend/_layout_main', $this->data);
	}
}