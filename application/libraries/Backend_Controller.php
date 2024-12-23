<?php
include 'classes/BanglaConverter.php';

class Backend_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->lang->load('auth');
		$this->load->model('Common_model');

		// $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning"> <i class="fa fa-warning"></i> ', '</div>');
		// dd($this->session->all_userdata());
		$this->userID = $this->session->userdata('user_id');
		$this->data['request_trainee_no'] = 0;
		// $this->data['request_trainer_no'] = 0;
		$this->data['request_training_application_no'] = 0;
		$this->data['request_staff_no'] = 0;
		$this->data['request_stor_no'] = 0;
		$this->data['Joint_director_no'] = 0;
		$this->data['director_general_no'] = 0;
		$this->data['pre_exam_notify'] = 0;
		$this->data['post_exam_notify'] = 0;
		$this->data['module_exam_notify'] = 0;
		$this->data['leave_notify'] = 0;
		$this->data['un_available_item_notify'] = 0;
		$this->data['train_notify'] = 0;
		$this->data['rev_ntfy'] = 0;
		$this->data['office_ntfy'] = 0;

		if ($this->ion_auth->logged_in()) {
			// Get User Details
			$this->data['userDetails'] = $this->Common_model->get_office_info_by_session();
			$userDetails = $this->data['userDetails'];
			// dd($userDetails);
			// budget notification
			$this->data['rev_ntfy'] = $this->Common_model->rev_notify($userDetails->crrnt_dept_id);
			$this->data['train_notify'] = $this->Common_model->train_notify($userDetails->crrnt_dept_id);
			$this->data['office_ntfy'] = $this->Common_model->office_ntfy($userDetails->crrnt_dept_id, $userDetails->crrnt_office_id);

			// Get Groups
			$users_groups = $this->ion_auth_model->get_users_groups()->result();
			// dd($users_groups);
			$groups_array = array();
			foreach ($users_groups as $group) {
				$groups_array[$group->id] = $group->description;
			}
			$this->data['userGroups'] = implode(',', $groups_array);

			// Count Request
			if ($this->ion_auth->in_group('up')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				// $this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->div_id, $office->dis_id, $office->upa_id, $office->union_id);

				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_trainee_no']);

			} elseif ($this->ion_auth->in_group('paura')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_no']);

			} elseif ($this->ion_auth->in_group('uz')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_no']);

				// New training application notification
				$this->data['request_training_application_no'] = $this->Common_model->get_training_applicaiton_by_office_count($office->crrnt_office_id);

			} elseif ($this->ion_auth->in_group('zp')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_no']);

			} elseif ($this->ion_auth->in_group('ddlg')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_no']);

				// New training application notification
				$this->data['request_training_application_no'] = $this->Common_model->get_training_applicaiton_by_office_count($office->crrnt_office_id);

			} elseif ($this->ion_auth->in_group('city')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_no']);

			} elseif ($this->ion_auth->in_group('partner')) {
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->crrnt_office_id);
				// dd($this->data['request_no']);

			//} elseif ($this->ion_auth->in_group('ddlg')) {
				// exit('o1');
				//$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				// $this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count($office->div_id, $office->dis_id, $office->upa_id, $office->union_id);
				// dd($this->data['request_no']);

			} elseif ($this->ion_auth->in_group('sm')) {
				// nilg stor manager Notification
				// exit('o5');
				$this->data['request_stor_no'] = $this->Common_model->get_stor_manager_notify_count();
				// echo "<pre>"; print_r($this->data['request_stor_no']); exit;

			} elseif ($this->ion_auth->in_group('jd')) {
				// nilg joint director Notification
				// exit('o6');
				$this->data['Joint_director_no'] = $this->Common_model->get_joint_director_notify_count();

			} elseif ($this->ion_auth->in_group('dg')) {
				// nilg director general Notification
				// exit('o7');
				$this->data['director_general_no'] = $this->Common_model->get_director_general_notify_count();

			} elseif (func_nilg_auth($userDetails->office_type) == 'employee' && $this->ion_auth->in_group('trainee')) {
				// exit('o4');
				// nilg staff Notification
				$this->data['request_staff_no'] = $this->Common_model->get_nilg_staff_notify_count();
				$this->data['un_available_item_notify']  = $this->Common_model->get_un_available_item_notify_count();

			} elseif ($this->ion_auth->in_group('trainee')) {
				// exit('o2');
				// $office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// $take_exam = $this->Common_model->get_my_exam_participant_count();
				// dd($take_exam);

				// Pre Exam Notification
				$this->data['pre_exam_notify'] = $this->Common_model->get_my_exam_notify_count(1);
				$this->data['post_exam_notify'] = $this->Common_model->get_my_exam_notify_count(2);
				$this->data['module_exam_notify'] = $this->Common_model->get_my_exam_notify_count(3);

			} elseif ($this->ion_auth->in_group('nilg')) {
				// exit('ok');
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count();
				// New training application notification
				$this->data['request_training_application_no'] = $this->Common_model->get_training_applicaiton_by_office_count($office->crrnt_office_id);

			} elseif ($this->ion_auth->is_admin()) {
				// exit('o3');
				$office = $this->Common_model->get_office_info_by_session();
				// dd($office);

				// New trainee request
				$this->data['request_trainee_no'] = $this->Common_model->get_applicaiton_trainee_request_count();
				// $this->data['request_trainer_no'] = $this->Common_model->get_applicaiton_trainer_request_count();
				// dd($this->data['request_no']);
				// dd($this->data['request_trainer_no']);

				$this->data['request_stor_no'] = $this->Common_model->get_stor_manager_notify_count();
				$this->data['Joint_director_no'] = $this->Common_model->get_joint_director_notify_count();
				$this->data['director_general_no'] = $this->Common_model->get_director_general_notify_count();

				// New training application notification
				$this->data['request_training_application_no'] = $this->Common_model->get_training_applicaiton_by_office_count();

			} else {
				// exit('o8');
				$office = $this->Common_model->get_office_info_by_session();
				// New trainer request
				// $this->data['request_trainer_no'] = $this->Common_model->get_applicaiton_trainer_request_count();
			}

            // leave notification count
			if ($this->ion_auth->in_group(array('dg'))) {
				$this->data['leave_notify'] =  $this->Common_model->get_employee_leave_count(1, array(2,3));
			} else if ($this->ion_auth->in_group(array('ld'))) {
				$this->data['leave_notify'] =  $this->Common_model->get_employee_leave_count(2, array(3));
			} else if ($this->ion_auth->in_group(array('lj'))) {
				$this->data['leave_notify'] =  $this->Common_model->get_employee_leave_count(3, array(3));
			} else {
				$this->data['leave_notify'] =  $this->Common_model->get_employee_leave_count_assign($userDetails->id, 2);
			}
	        // leave notification count end
		}
		// exit('10');

		// Default Value
		$this->data['meta_title'] = 'জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি)';
		$this->data['domain_title'] = 'এনআইএলজি - ইআরপি';
	}
}
