<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Trainers extends MX_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Trainers_model');
        $this->load->model('form_settings/Form_settings_model');
		$this->load->model('Common_model');

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

    }


    public function index(){

            // $this->load->view('temp/header');
            // $this->load->view('add_account_head');
            // $this->load->view('temp/footer');

    	$this->data['meta_title'] = 'Create Scouts Member';
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
		$data_id=$this->input->get('data_id');
		
		$data['get_lang_index']=$this->Form_settings_model->get_lang_index('name','label_lang');

		for($i=0;$i<sizeof($data['allcolumns']);$i++)
		{
			$this->form_validation->set_rules($data['allcolumns'][$i]['Field'], $data['allcolumns'][$i]['Field'], 'required');
		}
		
		
		
		$allformsettings=$this->Form_settings_model->get_all('*','form_settings','1');
		//print_r($allformsettings);exit;
		for($i=0;$i<sizeof($allformsettings);$i++)
		{
			if($allformsettings[$i]['field_type'] != 'text')$data['allcolumns'][$i+3]['Type']=$allformsettings[$i]['field_type'];
			$option_values=explode(',',$allformsettings[$i]['values']);
			if(sizeof($option_values)>1)
			{
				$createarr=array();
				for($j=0;$j<sizeof($option_values);$j++)
				{
					$option_values[$j]=trim($option_values[$j]);
					$createarr[]=array('id'=>$option_values[$j],'name'=>$option_values[$j]);
				}
				//print_r($createarr);exit;
				$data[$allformsettings[$i]['name']]=array('id','name',$createarr);
			}
		}
		//print_r($data);exit;				
		$data['nilg_training_id']=array('id','course_name',$this->$thismodel->get_for_list('nilg_trainings'));
		

        if ($this->form_validation->run() === false) {

			$data['divinfo'][0]=$accountInfo=$this->getpostdate();
			
			if($data_id!=''){
				$data['datasheet']=$this->$thismodel->get_all('*','personal_datas','id='.$data_id);
				$data['divinfo'][0]['applicant_name']=$data['datasheet'][0]['name_bangla'];
				$data['divinfo'][0]['birth_date']=$data['datasheet'][0]['date_of_birth'];
				$data['divinfo'][0]['data_sheet_id']=$data_id;
				$data['divinfo'][0]['entry_date']=date('Y-m-d');
			}
				
				
				
			$data['meta_title'] = 'proshikkhonarthi Registration form';
			$data['subview'] = 'add';
	    	$this->load->view('backend/_layout_main', $data);

        }else{

			if ($this->input->post('submit', TRUE)) {
				
				$data['divinfo']=$accountInfo=$this->getpostdate();
				
				
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
		return $dt;exit;
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
		$select='t.id, nt.course_name, pd.name_bangla, t.entry_date';
		$from='`trainers` t, nilg_trainings nt, personal_datas pd';
		$where='t.`nilg_training_id`=nt.id and t.`data_sheet_id`=pd.id';
		
		//$data['printcolumn']=$this->return_columnsonly();
		$data['printcolumn']=array('id','course_name','name_bangla', 'entry_date');
		//print_r($data['printcolumn']);exit;array('id');
		
		$data['all_list'] = $this->Common_model->get_all($select,$from,$where);
		$data['meta_title'] = lang('trainers_list');
		$data['subview'] = 'all';
    	$this->load->view('backend/_layout_main', $data);
    }
  //   public function reports()
  //   {
  //   	$data['userDetails'] = $this->Common_model->get_user_details();
		// $thismodel=$this->this_model();
		// $select='t.id, nt.course_name, pd.name_bangla, t.entry_date, pd.national_id, pd.data_sheet_type';
		// $from='`trainers` t, nilg_trainings nt, personal_datas pd';
		// $where='t.`nilg_training_id`=nt.id and t.`data_sheet_id`=pd.id';
		
		// //$data['printcolumn']=$this->return_columnsonly();
		// $data['printcolumn']=array('id','course_name','name_bangla', 'data_sheet_type', 'national_id', 'entry_date');
		// //print_r($data['printcolumn']);exit;array('id');
		
		// $data['all_courses'] = $this->$thismodel->get_all('*','nilg_trainings','1');
		// $data['course_name_id']=array('id','course_name',$data['all_courses']);
		
		// $data['t_date']=$data['from_date'] = '';
		// if ($this->input->post('from_date', TRUE)) {

  //           $data['from_date']=$startdate=$this->input->post('from_date', TRUE);
		// 	$where=$where." and prosikkhon_start_date>='$startdate'";
  //       }
		// if($this->input->post('t_date', TRUE))
		// {
		// 	$data['t_date']=$enddate=$this->input->post('t_date', TRUE);
		// 	$where=$where." and prosikkhon_start_date<='$enddate'";
		// }
		
		// if($this->input->post('course_name_id', TRUE))
		// {
		// 	$course_name_id=$this->input->post('course_name_id', TRUE);
		// 	$where=$where." and nt.id='$course_name_id'";
		// }
		// else
		// {
		// 	$hid=$data['course_name_id'][2][0]['id'];
		// 	$where=$where." and nt.id='$hid'";
		// }

		// $data['all_list'] = $this->$thismodel->get_all($select,$from,$where);
		
		// $data['meta_title'] = lang('trainers_list');
		// $data['subview'] = 'reports';
  //   	$this->load->view('backend/_layout_main', $data);
  //   }
	
	
  //   public function reports_sum()
  //   {
  //   	$data['userDetails'] = $this->Common_model->get_user_details();
		// $thismodel=$this->this_model();
				
		// $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','1');
		// $data['total_data']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','1');
		// $data['total_count']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=4');
		// $data['buniad_count']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=5');
		// $data['proshason_count']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=6');
		// $data['aien_count']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=15');
		// $data['Basic_Computer_Application_Literacy']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=17');
		// $data['Basic_Training_Course']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=20');
		// $data['Computer_Application_English_Language']=$cnt[0]['cnt'];
	
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=18');
		// $data['Training_on_Disaster_Control_Management']=$cnt[0]['cnt'];
		
	 //    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=14');
		// $data['audit_apotti_nispotti']=$cnt[0]['cnt'];

  //       $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=6');
		// $data['ayinbidi_obohito_koron']=$cnt[0]['cnt'];
		
  //       $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=25');
		// $data['bidhi_bebostapona_o_hisab_nirikha']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=7');
		// $data['union_porisod_bebosthapona']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=19');
		// $data['u_parisod_ayn_O_prosason_refregeration']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=21');
		// $data['up_bidhimalasamuho_obohitokoron']=$cnt[0]['cnt'];
		
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=12');
		// $data['nambi_bebosthapona']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=24');
		// $data['ppr_training']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=05');
		// $data['prosason_obohitokoron_course']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=23');
		// $data['foundaion_traing']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=22');
		// $data['bi_60_tomo_bunniadi_course']=$cnt[0]['cnt'];
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=08');
		// $data['bises_prosikhon']=$cnt[0]['cnt'];
		
		
		// $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=04');
		// $data['bunadi_prosikhon_course']=$cnt[0]['cnt'];

  //       $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=13');
		// $data['moulo_office_prosason']=$cnt[0]['cnt'];

  //       $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=26');
		// $data['moulik_prosikhon']=$cnt[0]['cnt'];
        
		//   $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=11');
		// $data['tho_exicutive_megistate_prosikhon']=$cnt[0]['cnt'];
		//   $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=10');
		// $data['_tomo_bunniadi_course']=$cnt[0]['cnt'];
		//   $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=9');
		// $data['tomo_ayn_O_prosason_course']=$cnt[0]['cnt'];
		 
		
		// $cnt = $this->$thismodel->get_all('count(*) as cnt','nilg_trainings','1');
		// $data['total_course']=$cnt[0]['cnt'];
		
		
		// $data['no_course']=$data['total_data']-$data['total_count'];
		
		
		
		
		
		// $data['meta_title'] = lang('proshikkhon_report_summary');
		// $data['subview'] = 'reports_sum';
  //   	$this->load->view('backend/_layout_main', $data);
  //   }

// 	public function bochor_onujaI_proshikhon_report()
//     {
// 	$data['userDetails'] = $this->Common_model->get_user_details();
// 		$thismodel=$this->this_model();
//     	//$data['Year']=array('id','course_name',$data['all_courses']);
		
// 		//$data['Year']=$data['Year'] = '';
// 		//var Year = document.getElementById('Year').value
// 		//$year=$this->select->post('Year');
// 		//print_r($year);
// 		if($_POST)
// 		$year=$this->input->post('Year');
// 		else
// 		 $year=date('Y');
// 		//print_r($year);
		
// 	    $data['course_names'] = $this->Common_model->get_all('course_name,course_duration_day,prosikkhon_start_date','nilg_trainings',"YEAR(prosikkhon_start_date)= '$year'");
// 		//$data['course_names']=$this->$cnt;
// 		//echo '<pre>';
// //print_r($cnt);
// 	//exit;
//         $data['meta_title'] = lang('proshikkhon_report_summary');
// 		$data['subview'] = 'bochor_onujaI_proshikhon_report';
//     	$this->load->view('backend/_layout_main', $data);
//     }

        //This function will edit an account head
    public function edit() {
		$data['userDetails'] = $this->Common_model->get_user_details();
		$thismodel=$this->this_model();
		$data['allcolumns'] = $this->get_columns();
		$data['get_lang_index']=$this->Form_settings_model->get_lang_index('name','label_lang');
		
		for($i=0;$i<sizeof($data['allcolumns']);$i++)
		{
			$this->form_validation->set_rules($data['allcolumns'][$i]['Field'], $data['allcolumns'][$i]['Field'].'_v_name', 'required|xss_clean');
		}
		
		$allformsettings=$this->Form_settings_model->get_all('*','form_settings','1');
		//print_r($allformsettings);exit;
		for($i=0;$i<sizeof($allformsettings);$i++)
		{
			if($allformsettings[$i]['field_type'] != 'text')$data['allcolumns'][$i+3]['Type']=$allformsettings[$i]['field_type'];
			$option_values=explode(',',$allformsettings[$i]['values']);
			if(sizeof($option_values)>1)
			{
				$createarr=array();
				for($j=0;$j<sizeof($option_values);$j++)
				{
					$option_values[$j]=trim($option_values[$j]);
					$createarr[]=array('id'=>$option_values[$j],'name'=>$option_values[$j]);
				}
				//print_r($createarr);exit;
				$data[$allformsettings[$i]['name']]=array('id','name',$createarr);
			}
		}
		//print_r($data);exit;				
		$data['nilg_training_id']=array('id','course_name',$this->$thismodel->get_for_list('nilg_trainings'));
		
		
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

			$data['datasheet']=$this->$thismodel->get_all('*','personal_datas','id='.$data['divinfo'][0]['data_sheet_id']);
			$data['divinfo'][0]['applicant_name']=$data['datasheet'][0]['name_bangla'];
			$data['divinfo'][0]['birth_date']=$data['datasheet'][0]['date_of_birth'];
			
            $data['meta_title'] = 'Create Scouts Member';
			$data['subview'] = 'add';
			$this->load->view('backend/_layout_main', $data);
        }
    }
	
	
    public function view() {
		$data['userDetails'] = $this->Common_model->get_user_details();
		$thismodel=$this->this_model();
		$data['allcolumns'] = $this->get_columns();
		$data['get_lang_index']=$this->Form_settings_model->get_lang_index('name','label_lang');
		
		
		$allformsettings=$this->Form_settings_model->get_all('*','form_settings','1');
		//print_r($allformsettings);exit;
		for($i=0;$i<sizeof($allformsettings);$i++)
		{
			if($allformsettings[$i]['field_type'] != 'text')$data['allcolumns'][$i+3]['Type']=$allformsettings[$i]['field_type'];
			$option_values=explode(',',$allformsettings[$i]['values']);
			if(sizeof($option_values)>1)
			{
				$createarr=array();
				for($j=0;$j<sizeof($option_values);$j++)
				{
					$option_values[$j]=trim($option_values[$j]);
					$createarr[]=array('id'=>$option_values[$j],'name'=>$option_values[$j]);
				}
				//print_r($createarr);exit;
				$data[$allformsettings[$i]['name']]=array('id','name',$createarr);
			}
		}
		//print_r($data);exit;				
		$data['nilg_training_id']=array('id','course_name',$this->$thismodel->get_for_list('nilg_trainings'));
		
		
        $id = $this->input->get('id');
        $data['divinfo']=$this->$thismodel->get_cur_all($id, $this->this_table());
		
		
		$data['meta_title'] = 'proshikkhonarthir data';
		$data['subview'] = 'view';
		$this->load->view('backend/_layout_main', $data);
		
		
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
