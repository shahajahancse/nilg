
<?php $base_url = base_url();  ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url;?>assets/css/themes/redmond/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>assets/css/themes/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>assets/css/calendar.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<div style="width:70%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">
			<form name="grid">
				<fieldset style='width:95%;'>
					<legend><font size='+1'><b>Date</b></font></legend> First Date: 
					<input type="text" name="firstdate" id="firstdate" style="width:100px;"/>
				
					<script language="JavaScript">
						var o_cal = new tcal ({
							'formname': 'grid',
							'controlname': 'firstdate'
						});
						o_cal.a_tpl.yearscroll = false;
						o_cal.a_tpl.weekstart = 6;
					</script>

					&nbsp;&nbsp; TO &nbsp;&nbsp; Second Date: <input type="text" name="seconddate" id="seconddate" style="width:100px;"/>
				</fieldset>
			 	<br />

				<div style=" position:relative; left:150px; width:334px; background:#DBE1F2; margin-top:10px; border-radius:10px;">
					<table width="329" style="padding:7px">
						<tr>
							<td width="61">Start</td>
							<td width="40">:</td>
							<td width="251"><select name='grid_start' id='grid_start' style="width:250px;" onchange='grid_get_all_data()' /><option value='Select'>Select</option><option value='all'>ALL</option></select></td>
						</tr>
						<tr>
							<td>Member Type </td>
							<td>:</td>
							<td><select id='grid_memty' name='grid_memty' style="width:250px;" onChange="grid_all_search()">
								<option value=''></option></select></td>
						</tr>
					</table>
				</div>

				<fieldset style='width:95%;'><legend><font size='+1'><b>Daily Reports</b></font></legend>
					<table width="100%"  style="font-size:11px; ">
						<tr >
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Daily Issued" onClick="grid_daily_issued_report()"></td>
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Daily Release" onClick="grid_daily_release_report()"></td>
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Daily Cancel" onClick="grid_daily_cancel_report()"></td>
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Daily Log" onClick="grid_daily_log_report()"></td>
						</tr>
					</table>
				</fieldset>
				<br 
				/>

				<fieldset style='width:95%;'><legend><font size='+1'><b>Monthly Reports</b></font></legend>
					<table width="100%"  style="font-size:11px; ">
						<tr >
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%;" value="Monthly Issued" onClick="grid_monthly_issued_report()"></td>
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%;" value="Monthly Release" onClick="grid_monthly_release_report()"></td>
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%;" value="Monthly Cancel" onClick="grid_monthly_cancel_report()"></td>
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%;" value="Monthly Log" onClick="grid_monthly_log_report()"></td>
						</tr>
					</table>
				</fieldset>
				<br />

				<fieldset style='width:95%;'><legend><font size='+1'><b>Continuous Reports</b></font></legend>
					<table width="100%"  style="font-size:11px; ">
						<tr >
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Continuous Issued" onClick="grid_continuous_issued_report()"></td>
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Continuous Release" onClick="grid_continuous_release_report()"></td>
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Continuous Cancel" onClick="grid_continuous_cancel_report()"></td>
							<td style="width:20%;"><input class="report_button" type="button" style="width:100%;" value="Continuous Log" onClick="grid_continuous_log_report()"></td>
						</tr>
					</table>
				</fieldset>
				<br />

				<fieldset style='width:95%;'><legend><font size='+1'><b>Other Reports</b></font></legend>
					<table width="100%"  style="font-size:11px; margin-top:7px; ">
						<tr >
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%;" value="Member Profile" onClick="grid_mem_profile()"></td>
							
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%;" value="Member Card" onClick="grid_member_card()"></td>
							<td style="width:20%;"><input type="button" class="report_button" style="width:100%" value="Inventory Report" onClick="grid_inventory_report()"></td>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/report_con/fine_report" target="_blank"  style="text-decoration:none"> <input type="button" class="report_button" style="width:100%;" value="Fine Report"></a></td>
						</tr>
					</table>
				</fieldset>
			</form>
			<div style="float:right;">
				<table id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:15px;"><tr><td></td></tr></table>
			</div>
		</div>
  </div> <!-- END ROW -->
</div>


<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/js/grid_content.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/js/calendar_eu.js" type="text/javascript"></script>