function grid_get_all_data()
{

	var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 var start = document.getElementById('grid_start').value;	
 if(start == "Select" || start == '')
 {
	 alert("Please select ALL");
	 return;
 }
 
 //var queryString="desig="+desig+"&dept="+dept;
 hostname = window.location.hostname;
 url =  "http://www.nilglibrary.com/index.php/payroll_con/idcard_grid/";
 ajaxRequest.open("POST", url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send();
 
  
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		//alert(resp);
		mem_typ_id_name = resp.split("===");
		//alert(mem_typ_id_name);
		//dept_idname = alldata[0].split("===");
		mem_typ_id = mem_typ_id_name[0].split("***");
	  mem_name = mem_typ_id_name[1].split("***");
			//alert(mem_typ_id);	
		document.grid.grid_memty.options.length=0;
		document.grid.grid_memty.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<mem_typ_id.length; i++){
			document.grid.grid_memty.options[i+1]=new Option(mem_name[i],mem_typ_id[i], false, false);

		}
		
	$('#list1').jqGrid('GridUnload');
	
	hostname = window.location.hostname;
	url =  "http://www.nilglibrary.com/index.php/grid_con/grid_get_all_data";
	//var url = "http://localhost/payroll/index.php/grid_con/grid_get_all_data";
	main_grid(url)
	
	
	}
	}
}

function grid_all_search()
{
	var grid_memty 		= document.getElementById('grid_memty').value;	
	
	$('#list1').jqGrid('GridUnload');
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/ad_library/index.php/grid_con/grid_all_search/"+grid_memty;
	//var url = "http://localhost/payroll/index.php/grid_con/grid_all_search/"+dept+"/"+section+"/"+line+"/"+designation;
	main_grid(url)
}
function grid_mem_profile()
{	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	//var status = "P";
	if(spl =='')
	{
		alert("Please select Member ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_mem_profile/"+spl;
	
	mem_profile = window.open(url,'mem_profile',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	mem_profile.moveTo(0,0);
}

function grid_inventory_report()
{
	hostname = window.location.hostname;
	url =  "http://www.nilglibrary.com/index.php/grid_con/grid_inventory_report/";
	
	inventory_report = window.open(url,'inventory_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	inventory_report.moveTo(0,0);	
}

function grid_fine_report()
{	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	//var status = "P";
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	if(spl =='')
	{
		alert("Please select Member ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/ad_library/index.php/grid_con/fine_cal/"+spl;
	
	mem_profile = window.open(url,'mem_profile',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	mem_profile.moveTo(0,0);
}


function grid_member_card()
{	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	//var status = "P";
	if(spl =='')
	{
		alert("Please select Member ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_member_card/"+spl;
	
	mem_card = window.open(url,'mem_card',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	mem_card.moveTo(0,0);
}

function grid_expire_issued_report()
{	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	//var status = "P";
	if(spl =='')
	{
		alert("Please select Member ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_expire_issued/"+spl;
	
	grid_expire_issued_report = window.open(url,'mem_card',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	grid_expire_issued_report.moveTo(0,0);
}


function grid_daily_present_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	var status = "P";
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/ERP/index.php/grid_con/grid_daily_report/"+firstdate+"/"+status+"/"+spl;
	
	daily_present_report = window.open(url,'daily_present_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_present_report.moveTo(0,0);
}

function grid_daily_issued_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	var status = "P";
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Issued";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_daily_status_report/"+firstdate+"/"+spl+"/"+paper_status;
	
	daily_issued_report = window.open(url,'daily_issued_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_issued_report.moveTo(0,0);
}

function grid_daily_release_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Release";
	//alert(paper_status);
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_daily_status_report/"+firstdate+"/"+spl+"/"+paper_status;
	
	daily_release_report = window.open(url,'daily_release_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_release_report.moveTo(0,0);
}

function grid_daily_cancel_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	var paper_status = "Cancel";
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_daily_status_report/"+firstdate+"/"+spl+"/"+paper_status;
	
	daily_cancel_report = window.open(url,'daily_cancel_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_cancel_report.moveTo(0,0);
}

function grid_daily_log_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_daily_log_report/"+firstdate;
	
	daily_log_report = window.open(url,'daily_log_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_log_report.moveTo(0,0);
}


function grid_monthly_issued_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month and year selection");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
		
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Issued";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_monthly_status_report/"+firstdate+"/"+spl+"/"+paper_status;
	
	monthly_issued_report = window.open(url,'monthly_issued_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
 	monthly_issued_report.moveTo(0,0);
}


function grid_monthly_cancel_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month and year selection");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
		
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Cancel";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_monthly_status_report/"+firstdate+"/"+spl+"/"+paper_status;
	
	monthly_cancel_report = window.open(url,'monthly_cancel_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
 	monthly_cancel_report.moveTo(0,0);
}

function grid_monthly_release_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month and year selection");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
		
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Release";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_monthly_status_report/"+firstdate+"/"+spl+"/"+paper_status;
	
	monthly_release_report = window.open(url,'monthly_release_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
 	monthly_release_report.moveTo(0,0);
}

function grid_monthly_log_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month and year selection");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_monthly_log_report/"+firstdate;
	
	monthly_log_report = window.open(url,'monthly_log_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
 	monthly_log_report.moveTo(0,0);
}

function grid_continuous_issued_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Issued";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_continuous_status_report/"+firstdate+"/"+seconddate+"/"+spl+"/"+paper_status;
	
	continuous_issued_repor = window.open(url,'continuous_issued_repor',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	continuous_issued_repor.moveTo(0,0);
}

function grid_continuous_cancel_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Cancel";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_continuous_status_report/"+firstdate+"/"+seconddate+"/"+spl+"/"+paper_status;
	
	continuous_cancel_report = window.open(url,'continuous_cancel_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	continuous_cancel_report.moveTo(0,0);
}

function grid_continuous_release_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}
	
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var paper_status = "Release";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_continuous_status_report/"+firstdate+"/"+seconddate+"/"+spl+"/"+paper_status;
	
	continuous_release_report = window.open(url,'continuous_release_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	continuous_release_report.moveTo(0,0);
}

function grid_continuous_log_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/index.php/grid_con/grid_continuous_log_report/"+firstdate+"/"+seconddate;
	
	continuous_log_report = window.open(url,'continuous_log_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
 	continuous_log_report.moveTo(0,0);
}


function main_grid(url)
{

jQuery("#list1").jqGrid({
url: url,
datatype: "json",
//width:'600px',
colModel: [
	{name:'id',index:'id', width:100, label: 'MEM ID', hidden: false},
	{name:'first_name',index:'first_name', width:200, label: 'First Name'}
	<!--{name:'emp_dob',index:'emp_dob', width:100, label: 'DOB'}-->
	
],
  rowNum:20000, rowList:[10,20,30],
 //imgpath: gridimgpath,
 pager: jQuery('#pager1'),
 sortname: 'mem_id',
 viewrecords: true,
 sortorder: "asc",
 multiselect:true
 }).navGrid('#pager1',{ edit:false, add:false, del: false });
 
}