
<?php if (!empty($css_files)):
  foreach($css_files as $file): ?>
	 <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php  endforeach; endif; ?>

<?php if (!empty($js_files)) :
  foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php  endforeach; endif; ?>


<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> লাইব্রেরি </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    
    <div class="grid simple horizontal">

      <div class="grid-title">
        <h4><span class="semi-bold"><?php echo $meta_title?></span></h4>
      </div>

      <div style="margin-bottom: 20px;">
      	<form name="grid">
					<fieldset style='width:95%;'>
						<legend><font size='+1'><b>Date</b></font></legend> 
						<div class="row">
							<div class="col-md-3"> 
								First Date: <input type="text" name="firstdate" id="firstdate" class="form-control input-xs datetime"/>
							</div>

							<div class="col-md-3"> 
								Second Date: <input type="text" name="seconddate" id="seconddate" class="form-control input-xs datetime"/>
							</div>

							<div class="col-md-3"> 
								Start 
								<select name='grid_start' class="form-control" id='grid_start' onchange='grid_get_all_data()' />
									<option value='Select'>Select</option>
									<option value='all'>ALL</option>
								</select>
							</div>

							<div class="col-md-3"> 
								Member Type 
								<select id='grid_memty' name='grid_memty' class="form-control" onChange="grid_all_search()">
									<option value=''></option>
								</select>
							</div>
						</div>
					</fieldset>


					<fieldset style=''><legend><font size='+1'><b>Daily Reports</b></font></legend>
						<table style="font-size:11px; ">
							<tr >
								<td style="">
									<input class="btn btn-sm btn-success" type="button" value="Daily Issued" onClick="grid_daily_issued_report()"> &nbsp;&nbsp;
								</td>
								<td style="">
									<input class="btn btn-sm btn-success" type="button" value="Daily Release" onClick="grid_daily_release_report()"> &nbsp;&nbsp;
								</td>
								<td style="">
									<input class="btn btn-sm btn-success" type="button" value="Daily Cancel" onClick="grid_daily_cancel_report()"> &nbsp;&nbsp;
								</td>
								<td style="">
									<input class="btn btn-sm btn-success" type="button" value="Daily Log" onClick="grid_daily_log_report()">
								</td>
							</tr>
						</table>
					</fieldset>


					<fieldset style=''><legend><font size='+1'><b>Monthly Reports</b></font></legend>
						<table style="font-size:11px; ">
							<tr >
								<td>
									<input type="button" class="btn btn-sm btn-success" value="Monthly Issued" onClick="grid_monthly_issued_report()"> &nbsp;&nbsp;
								</td>
								<td>
									<input type="button" class="btn btn-sm btn-success" value="Monthly Release" onClick="grid_monthly_release_report()"> &nbsp;&nbsp;
								</td>
								<td>
									<input type="button" class="btn btn-sm btn-success" value="Monthly Cancel" onClick="grid_monthly_cancel_report()"> &nbsp;&nbsp;
								</td>
								<td>
									<input type="button" class="btn btn-sm btn-success" value="Monthly Log" onClick="grid_monthly_log_report()">
								</td>
							</tr>
						</table>
					</fieldset>


					<fieldset style=''><legend><font size='+1'><b>Continuous Reports</b></font></legend>
						<table style="font-size:11px; ">
							<tr >
								<td>
									<input class="btn-sm btn-success btn" type="button" value="Continuous Issued" onClick="grid_continuous_issued_report()">&nbsp;&nbsp;
								</td>
								<td>
									<input class="btn-sm btn-success btn" type="button" value="Continuous Release" onClick="grid_continuous_release_report()">&nbsp;&nbsp;
								</td>
								<td>
									<input class="btn-sm btn-success btn" type="button" value="Continuous Cancel" onClick="grid_continuous_cancel_report()">&nbsp;&nbsp;
								</td>
								<td>
									<input class="btn-sm btn-success btn" type="button" value="Continuous Log" onClick="grid_continuous_log_report()">&nbsp;&nbsp;
								</td>
							</tr>
						</table>
					</fieldset>


					<fieldset style=''><legend><font size='+1'><b>Other Reports</b></font></legend>
						<table style="font-size:11px;">
							<tr >
								<td>
									<input type="button" class="btn-sm btn-success btn" value="Member Profile" onClick="grid_mem_profile()">&nbsp;&nbsp;
								</td>
								
								<td>
									<input type="button" class="btn-sm btn-success btn" value="Member Card" onClick="grid_member_card()">&nbsp;&nbsp;
								</td>
								<td>
									<input type="button" class="btn-sm btn-success btn" value="Inventory Report" onClick="grid_inventory_report()">&nbsp;&nbsp;
								</td>
								<td>
									<a href="<?php echo base_url(); ?>index.php/report_con/fine_report" target="_blank"  style="text-decoration:none"> <input type="button" class="btn-sm btn-success btn" value="Fine Report">
								</a>
								</td>
							</tr>
						</table>
					</fieldset>
				</form>

				<div style="float:right;">
					<table id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:15px;"><tr><td></td></tr></table>
				</div>
      </div>

    </div>
  </div> <!-- END ROW -->
</div>



