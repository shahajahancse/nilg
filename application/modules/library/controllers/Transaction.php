<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */	
		$this->load->model('processdb');
		$this->load->library('form_validation');
		$this->load->library('grocery_CRUD');	
		/*if($this->session->userdata('logged_in')==FALSE)
		{
			redirect("authentication");
		}
		elseif($this->session->userdata('level')!=1)
		redirect("authentication");*/
		$this->load->model('acl_model');
		$access_level = 2;
		$acl = $this->acl_model->acl_check($access_level);
	}
	
	function renew_view()
	{
		$this->load->view('transaction/renew_view');
	}
	

	function manual_issue_view()
	{
		$this->load->view('transaction/manual_issue_view');
	}
	function manual_issue()
	{
		//$this->load->model('processdb');
		$data = $this->processdb->manual_issue();
		if ($data == "Member not found")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Member ID not found'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "Invalid Member id";
		}
		else if ($data == "Invalid Barcode")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Invalid Barcode'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "Invalid Barcode";
		}
		else if ($data == "You are already Issued this")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You are already Issued this.'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "You are already Issued this";
		}
		else if ($data == "This is Already Requesting")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This is Already Requesting'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "This Book Already Requesting"; 
		}
		else if ($data == "This Book Already Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This Book Already Issued'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "This Book Already Issued";
		}
		
		$this->load->view('transaction/manual_issue_view',$data);
	}
	function renew_fine() //Renew Anf Release
	{
		//$this->load->model('processdb');
		$selected_radio = $this->input->post('radioValue');
		$data = $this->processdb->fine_calc();
		 if ($data == "Requested list is empty")
		{
			echo "Invalid Member id";
		}
		else if ($data == "Invalid Barcode")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Invalid Accession no.'); window.location = \"renew_view\";</SCRIPT>";
			echo "Invalid Barcode";
		}
		else if ($data == "Member not found")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Member ID not found'); window.location = \"renew_view\";</SCRIPT>";
			echo "Invalid Member id";
		}
		else if ($data == "This is not your issued paper")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This is not your issued paper'); window.location = \"renew_view\";</SCRIPT>";
			echo "Invalid Member id";
		}
		$data['table_name'] = $selected_radio;
		$this->load->view('transaction/renew_view',$data);
	}
	function all_fine_calc()
	{
			//echo "hello";
		$data['value'] = $this->processdb->all_fine_calc();
		$this->load->view('transaction/renew_view');
	}
	function release_paper()
	{
		$mem_id = $this->input->post('mem_id');
		$acc_no = $this->input->post('acc_no');
		$book_iss_id = $this->input->post('id');
		$fine_receipt_no = $this->input->post('fine_rec_no');
		$msg = $this->processdb->release_paper($mem_id,$acc_no,$book_iss_id,$fine_receipt_no);
		if ($msg == "You Enter Duplicate Receipt No")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You Enter Duplicate Receipt No'); window.location = \"renew_view\";</SCRIPT>";
		}
		else if ($msg == "Successfully Release")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Successfully Release'); window.location = \"renew_view\";</SCRIPT>";
		}
		$this->load->view('transaction/renew_view');
	}
	function renew_paper()
	{
		$mem_id = $this->input->post('mem_id');
		$acc_no = $this->input->post('acc_no');
		$book_iss_id = $this->input->post('id');
		$fine_receipt_no = $this->input->post('fine_rec_no');
		$paper_id = $this->input->post('paper_id');
		echo $paper_id;
		$msg = $this->processdb->renew_paper($mem_id,$acc_no,$book_iss_id,$fine_receipt_no,$paper_id);
		if ($msg == "not allow")
		{
			echo "You are not allow";
		}
		else if ($msg == "suceessfully Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Successfully Renewed'); window.location = \"renew_view\";</SCRIPT>";
		}
		else if ($msg == "You are also Issued this book")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You are also Issued this book'); window.location = \"renew_view\";</SCRIPT>";
		}
		else if ($msg == "You Enter Duplicate Receipt No")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You Enter Duplicate Receipt No'); window.location = \"renew_view\";</SCRIPT>";
		}
		$this->load->view('transaction/renew_view');
	}
	function paper_issue()
	{
		$group_no = $this->input->post('group_no');
		$acc_no = $this->input->post('acc_no');
		$mem_id = $this->input->post('mem_id');
		$paper_id = $this->input->post('paper_id');
	   // $this->load->model('processdb');
		$msg = $this->processdb->paper_issue_db($mem_id,$group_no,$acc_no,$acc_no,$paper_id);
		if ($msg == "not allow")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Your Permission Rules Already fullfilled'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "Your Permission Rules Already fullfilled";
		}
		else if ($msg == "suceessfully Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Suceessfully Issued'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "Suceessfully Issued";
		}
		else if ($data == "You are already Issued this")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You are already Issued this.'); window.location = \"manual_issue_view\";</SCRIPT>";
			echo "You are already Issued this.";
		}
		$this->load->view('manual_issue_view');
	}	
	
	//======================================Latest Eequest===========================================
	//===============================================================================================
	function latest_request_view()
	{
		$this->load->view('transaction/latest_request');
		//return $result;
	}
	
	function req_issued()
	{
		$val = $this->uri->segment(3);
		$group_no = "group_no$val";
		$acc_no = "acc_no$val";
		$issue_acc_no = "issue_acc_no$val";
		$paper_id = "paper_id$val";
		$group_no = $this->input->post($group_no);
		$acc_no = $this->input->post($acc_no);
		$mem_id = $this->input->post('mem_id');
		$issue_acc_no = $this->input->post($issue_acc_no);
		//echo $mem_id."---".$acc_no;
		$msg = $this->processdb->paper_issue_db($mem_id,$group_no,$acc_no,$issue_acc_no,$paper_id);
		if ($msg == "not allow")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Permission Rules Already fullfilled');</SCRIPT>";
		}
		else if ($msg == "Fill in the Issue Acc No")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Fill in the Issue Acc No');</SCRIPT>";
		}
		else if ($msg == "Acc No Missmatch")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Acc No Missmatch');</SCRIPT>";
		}
		else if ($msg == "Invalid Barcode")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Invalid Barcode');</SCRIPT>";
		}
		else if ($msg == "suceessfully Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Suceessfully Issued');</SCRIPT>";
		}
		else if ($msg == "You are also Issued this")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You are already Issued this');</SCRIPT>";
		}
		else if ($msg == "This are already Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This are already Issued');</SCRIPT>";
		}
		else if ($msg == "This are already Requesting")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This are already Requesting');</SCRIPT>";
		}		$this->load->view('transaction/latest_request');
	}
	
	function req_cancel()
	{
		$val = $this->uri->segment(3);
		$group_no = "group_no$val";
		$acc_no = "acc_no$val";
		$group_no = $this->input->post($group_no);
		$acc_no = $this->input->post($acc_no);
		$mem_id = $this->input->post('mem_id');
		$msg = $this->processdb->req_cancel($mem_id,$group_no,$acc_no);
		$this->load->view('transaction/latest_request');
		if ($msg == "suceessfully Cancel")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Suceessfully Cancel');</SCRIPT>";
		}
	}
	
	//==================================All Request List=========================================
	//===========================================================================================
	function all_request_list()
	{
		$search_query ['value']= $this->processdb->all_request_list();
		$this->load->view('transaction/all_request_list',$search_query);
	}
	
	function all_req_issued()
	{
		$val = $this->uri->segment(3);
		$group_no = "group_no$val";
		$acc_no = "acc_no$val";
		$mem_id = "mem_id$val";
		$issue_acc_no = "issue_acc_no$val";
		$paper_id = "paper_id$val";
		$group_no = $this->input->post($group_no);
		$acc_no = $this->input->post($acc_no);
		$mem_id = $this->input->post($mem_id);
		$issue_acc_no = $this->input->post($issue_acc_no);
		$paper_id = $this->input->post($paper_id);
		
		$msg = $this->processdb->paper_issue_db($mem_id,$group_no,$acc_no,$issue_acc_no,$paper_id);
		if ($msg == "not allow")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Permission Rules Already fullfilled');</SCRIPT>";
		}
		else if ($msg == "Fill in the Issue Acc No")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Fill in the Issue Acc No');</SCRIPT>";
		}
		else if ($msg == "Acc No Missmatch")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Acc No Missmatch');</SCRIPT>";
		}
		else if ($msg == "Invalid Barcode")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Invalid Barcode');</SCRIPT>";
		}
		else if ($msg == "suceessfully Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Suceessfully Issued');</SCRIPT>";
		}
		else if ($msg == "You are also Issued this")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('You are already Issued this');</SCRIPT>";
		}
		else if ($msg == "This are already Issued")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This are already Issued');</SCRIPT>";
		}
		else if ($msg == "This are already Requesting")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('This are already Requesting');</SCRIPT>";
		}
		$this->all_request_list();
		
	}
	
	function all_req_cancel()
	{
		$val = $this->uri->segment(3);
		$group_no = "group_no$val";
		$acc_no = "acc_no$val";
		$mem_id = "mem_id$val";
		$group_no = $this->input->post($group_no);
		$acc_no = $this->input->post($acc_no);
		$mem_id = $this->input->post($mem_id);
		$msg = $this->processdb->req_cancel($mem_id,$group_no,$acc_no);
		if ($msg == "suceessfully Cancel")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Suceessfully Cancel');</SCRIPT>";
		}
		$this->all_request_list();
	}
	
	//===========================================Latest Request=======================================
	//================================================================================================
	

	function ongoing_request() //Latest Request
	{
		
		//echo "helo";
		$data = $this->processdb->ongoing_request();
		if ($data == "not exists")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Invalid Member id');</SCRIPT>";
			//echo "Invalid Member id";
		}
		else if($data == "No Requesting Book")
		{
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('No Requesting Book');</SCRIPT>";
			//echo $data;
		}
		$this->load->view('transaction/latest_request',$data);
	}
	
}