<?php
class Grid_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('grid_model');
		$this->load->helper('form');
		if($this->session->userdata('logged_in')==FALSE)
		redirect("newcon");
	}
	
	function grid_window()
	{
		if($this->session->userdata('level')== 0 || $this->session->userdata('level')== 1)
		{
			$this->load->view('grid');
		}
		elseif($this->session->userdata('level')==2)
		{
			$this->load->view('grid_for_user');
		}
	}
	
	function grid_salary_report()
	{
		$this->load->view('grid_salary_report');
	}
	
	function grid_get_all_data()
	{
		$this->db->select('*');
		$this->db->where('mem_id !=','tofayel');
		$this->db->from('member');
	
		$this->db->order_by('id');

		$query = $this->db->get();

		$i = 0;
		foreach($query->result_array() as $row)
		{
			$responce->rows[$i]['id']=$row['mem_id'];
			$responce->rows[$i]['cell']=array($row['mem_id'],$row['first_name']);
			$i++;
		}
		echo json_encode($responce);
		exit;
	}
	
	function grid_all_search()
	{
		$mem_type 	= $this->uri->segment(3);
		
		
		$this->db->select('*');
		$this->db->from('member');
		//$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		
		if($mem_type !="Select")
		{
			$this->db->where('mem_type',$mem_type);
		}
		
		$this->db->order_by('id');
		$query = $this->db->get();
		
		$i = 0;
		foreach($query->result_array() as $row)
		{
			$responce->rows[$i]['id']=$row['mem_id'];
			$responce->rows[$i]['cell']=array($row['mem_id'],$row['first_name'],$row['email']);
			$i++;
		}
		echo json_encode($responce);
		exit;
		
	}
	
	
	function grid_mem_profile()
	{
		
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data['value'] = $this->grid_model->grid_mem_profile($grid_emp_id);
		//print_r($data);
		if(is_string($data))
		{
			echo $data;
		}
		else
		{
			$this->load->view('report/mem_profile',$data);
		}
	}
	
	function fine_cal()
	{
		
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data['value'] = $this->grid_model->fine_cal($grid_emp_id);
		//print_r($data);
		/*if(is_string($data))
		{
			echo $data;
		}
		else
		{
			$this->load->view('mem_profile',$data);
		}*/
	}
	
	function grid_member_card()
	{
		
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data['value'] = $this->grid_model->grid_mem_profile($grid_emp_id);
		//print_r($data);
		if(is_string($data))
		{
			echo $data;
		}
		else
		{
			$this->load->view('report/mem_card',$data);
		}
	}
	
	function grid_expire_issued()
	{
		
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data['value'] = $this->grid_model->grid_expire_issued($grid_emp_id);
		//print_r($data);
		if(is_string($data))
		{
			echo $data;
		}
		else
		{
			//$this->load->view('report/mem_card',$data);
		}
	}
	
	function grid_daily_status_report()
	{
	$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_status = $this->uri->segment(5);
		//echo $grid_status;
		//print_r($grid_emp_id);
		$data["values"] = $this->grid_model->grid_daily_status_report($year, $month, $date, $grid_emp_id,$grid_status);
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		$data["status"]			= $grid_status;
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('report/daily_status_report',$data);
		}
	}
	
	function grid_monthly_status_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_memid = explode('xxx', trim($grid_data));
		
		$first_d=trim(substr($grid_firstdate,0,2));
		$first_m=trim(substr($grid_firstdate,3,2));
		$first_y=trim(substr($grid_firstdate,6,4));
		$grid_status = $this->uri->segment(5);
		$balance_query["status"]			= $grid_status;
		
		$year_month = date("Y-m", mktime(0, 0, 0, $first_m, 1, $first_y));
		$balance_query["year_month"] = $year_month;
		$balance_query["values"]=$this->grid_model->grid_monthly_status_report($year_month, $grid_memid,$grid_status);
		if(is_string($balance_query["values"]))
		{
			echo $balance_query["values"];
		}
		else
		{
			$this->load->view('report/monthly_status_report',$balance_query);
		}
	}
	
	function grid_monthly_log_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$first_d=trim(substr($grid_firstdate,0,2));
		$first_m=trim(substr($grid_firstdate,3,2));
		$first_y=trim(substr($grid_firstdate,6,4));

		$year_month = date("Y-m", mktime(0, 0, 0, $first_m, 1, $first_y));
		$balance_query["year_month"] = $year_month;
		$balance_query["values"]=$this->grid_model->grid_monthly_log_report($year_month);
		if(is_string($balance_query["values"]))
		{
			echo $balance_query["values"];
		}
		else
		{
			$this->load->view('report/monthly_log_report',$balance_query);
		}
	}
	
	function grid_continuous_status_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		//echo $grid_firstdate." ".$grid_seconddate;
		$grid_data = $this->uri->segment(5);
		$grid_memid = explode('xxx', trim($grid_data));
		
		$grid_status = $this->uri->segment(6);
		//echo $grid_status;
		$balance_query["status"]= $grid_status;
		
		
		$balance_query["grid_firstdate"] = $grid_firstdate;
		$balance_query["grid_seconddate"] = $grid_seconddate;
		$balance_query["values"]=$this->grid_model->grid_continuous_status_report($grid_firstdate,$grid_seconddate,$grid_memid,$grid_status);
		if(is_string($balance_query["values"]))
		{
			echo $balance_query["values"];
		}
		else
		{
			$this->load->view('report/continuous_status_report',$balance_query);
		}
	}
	
	
	function grid_continuous_log_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		//echo $grid_firstdate." ".$grid_seconddate;
		
		
		$balance_query["grid_firstdate"] = $grid_firstdate;
		$balance_query["grid_seconddate"] = $grid_seconddate;
		$balance_query["values"]=$this->grid_model->grid_continuous_log_report($grid_firstdate,$grid_seconddate);
		if(is_string($balance_query["values"]))
		{
			echo $balance_query["values"];
		}
		else
		{
			$this->load->view('report/continuous_log_report',$balance_query);
		}
	}
	
	
	function grid_inventory_report()
	{
		$data["values"] = $this->grid_model->grid_inventory_report();
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('report/inventory_report',$data);
		}
	}
	
	function grid_daily_log_report()
	{
	$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		/*$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));*/
		//print_r($grid_emp_id);
		$data["values"] = $this->grid_model->grid_daily_log_report($year, $month, $date);
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('report/daily_log_report',$data);
		}
	}
	
	
	
	function grid_id_card()
	{
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
			
		$query['values'] = $this->grid_model->grid_id_card($grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('id_card',$query);
		}
	}
	
}
?>