<style type="text/css">
	#experienceDiv td{padding: 5px;}
	#promotionDiv td{padding: 5px;}
	#nilgLeaveDiv td{padding: 5px;}
	#educationInfoDiv td{padding: 5px;}
	#nilgTrainingDiv td{padding: 5px;}
	#localOrgTrainingDiv td{padding: 5px;}
	#foreignOrgTrainingDiv td{padding: 5px;}

</style>

<?php
/*$office_data = '';
foreach ($office as $key => $value) {      
	$office_data .= '<option value="'.$key.'">'.$value.'</option>';
}

$designation_data = '';
foreach ($designation as $key => $value) {      
	$designation_data .= '<option value="'.$key.'">'.$value.'</option>';
}

$leave_type_data = '';
foreach ($leave_type as $key => $value) {      
	$leave_type_data .= '<option value="'.$key.'">'.$value.'</option>';
}
*/
/*$exam_data = '<option value="">-নির্বাচন করুন-</option>';
for($i=0;$i<sizeof($exams);$i++){
	$exam_data .= '<option value="'.$exams[$i]['id'].'">'.$exams[$i]['exam_name'].'</option>';
}

$pass_year_data = '<option value="">-নির্বাচন করুন-</option>';
for($i=date('Y');$i>=1971;$i--){
	$pass_year_data .= '<option value="'.$i.'">'.eng2bng($i).'</option>';
}

$subject_data = '<option value="">-নির্বাচন করুন-</option>';
for($i=0;$i<sizeof($subjects);$i++){
	$subject_data .= '<option value="'.$subjects[$i]['id'].'">'.$subjects[$i]['sub_name'].'</option>';
}

$board_data = '<option value="">-নির্বাচন করুন-</option>';
for($i=0;$i<sizeof($boards);$i++){                              
	$board_data .= '<option value="'.$boards[$i]['id'].'">'.$boards[$i]['board_name'].'</option>';
}*/
?>

<div class="page-content">     
	<div class="content">  

		<div class="row">
			<div class="col-md-12">
				<div class="grid simple horizontal red">
					<div class="grid-title">
						<h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
						<div class="pull-right">
							<a href="<?=base_url('#')?>" class="btn btn-primary btn-xs btn-mini" data-toggle="modal" data-target="#myModal"> সহায়িকা </a>
						</div>
					</div>

					<div class="grid-body">
						<span style="color: #e22222; font-size: 15px; float: right; font-style: italic;">বিঃ দ্রঃ (*) তারকা যুক্ত ফিল্ডগুলো অবশ্যই পূরণ করতে হবে</span>
						<?php 
						$attributes = array('id' => 'validate');
						echo form_open_multipart("dashboard/edit_trainee_general_info", $attributes);?>
						<div><?php //echo validation_errors(); ?></div>
						<?php if($this->session->flashdata('success')):?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success');;?>
							</div>
						<?php endif; ?>            
						<!-- <div class="pull-right" style="font-weight: bold; color: red; font-size: 16px;">বিঃ দ্রঃ (*) তারকা যুক্ত ফিল্ডগুলো অবশ্যই পূরণ করতে হবে।</div> -->


						<div class="row">
							<div class="col-md-12">
								<fieldset>
									<legend>ব্যাক্তিগত বা সাধারণ তথ্য</legend>

									<div class="row">
										<div class="col-md-12">
											<div class="row" style="border-bottom: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
												<div class="col-md-4">
													<div class="form-group">
														<label class="form-label font-big-bold" style="font-style: italic;">এনআইডি নম্বরঃ</label>
														<span class="font-big-bold"><?=eng2bng($info->nid)?></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="form-label font-big-bold" style="font-style: italic;">জন্ম তারিখঃ</label>
														<span class="font-big-bold"><?=eng2bng($info->dob)?></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="form-label font-big-bold" style="font-style: italic;">মোবাইল নম্বরঃ</label>
														<span class="font-big-bold"><?=eng2bng($info->mobile_no)?></span>
													</div>
												</div>
											</div>

											<div class="row form-row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">নামঃ (বাংলা) <span class="required">*</span></label>
														<?php echo form_error('name_bn'); ?>
														<input name="name_bn" type="text" value="<?=set_value('name_bn', $info->name_bn)?>" class="bangla form-control input-sm" placeholder="উদাঃ আতাউল মোস্তাফা" contenteditable="TRUE">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
														<?php echo form_error('name_en'); ?>
														<input name="name_en" type="text" value="<?=set_value('name_en')?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">পিতা / স্বামীর নামঃ <span class="required">*</span></label>
														<?php echo form_error('father_name'); ?>
														<input name="father_name" type="text" value="<?=set_value('father_name')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">মাতার নামঃ <span class="required">*</span></label>
														<?php echo form_error('mother_name'); ?>
														<input name="mother_name" type="text" value="<?=set_value('mother_name')?>" class="form-control input-sm" placeholder="">
													</div>                            
												</div>
											</div>

											<div class="row form-row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">ই-মেইল অ্যাড্রেসঃ </label>
														<h5 class="font-big-bold"><?=$info->email?></h5>
													</div>
												</div>
												<div class="col-md-3">
													<label class="form-label">লিঙ্গঃ <span class="required">*</span></label>
													<?php echo form_error('gender'); ?>
													<input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : "checked"; ?>> <span style="color: black; font-size: 15px;">পুরুষ </span> 
													<input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
													<div class="error_placeholder"></div>
												</div>
												<div class="col-md-3">
													<label class="form-label">বৈবাহিক অবস্থাঃ <span class="required">*</span></label>
													<?php echo form_error('ms_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('ms_id', $marital_status, set_value('ms_id'), $more_attr);
													?>
												</div>
												<div class="col-md-3">
													<div class="row form-row">
														<div class="col-md-6">                              
															<div class="form-group">                                  
																<label class="form-label">ছেলে সন্তানঃ</label>
																<input name="son_no" type="number" value="<?=set_value('son_no')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label">মেয়ে সন্তানঃ</label>
																<input name="daughter_no" type="number" value="<?=set_value('daughter_no')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="row form-row">
												<div class="col-md-9">
													<div class="row">
														<label class="form-label" style="margin-left: 15px;">স্থায়ী ঠিকানার বিবরণ</label>
														<hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 16px 10px;">

														<div class="col-md-3">
															<div class="form-group">
																<label class="form-label">বিভাগঃ <span class="required">*</span></label>
																<?php echo form_error('per_div_id');
																$more_attr = 'class="form-control input-sm" id="division"';
																echo form_dropdown('per_div_id', $division, set_value('per_div_id'), $more_attr);
																?>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="form-label">জেলাঃ <span class="required">*</span></label>
																<?php echo form_error('per_dis_id');?>
																<select name="per_dis_id" <?=set_value('per_dis_id')?> class="district_val form-control input-sm" id="district">
																	<option value=""> <?=lang('select_district')?></option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="form-label">উপজেলা / থানাঃ <span class="required">*</span></label>
																<?php echo form_error('per_upa_id');?>
																<select name="per_upa_id" <?=set_value('per_upa_id')?> class="upazila_val form-control input-sm">
																	<option value=""> <?=lang('select_up_thana')?></option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="form-label">গ্রাম/ওয়ার্ড/ইউনিয়নঃ <span class="required">*</span></label>
																<?php echo form_error('per_road_no'); ?>
																<input name="per_road_no" type="text" value="<?=set_value('per_road_no')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
														<div class="col-md-6" style="clear: left;">
															<div class="form-group">
																<label class="form-label">বাড়ির নাম / নম্বরঃ <span class="required">*</span></label>
																<?php echo form_error('permanent_add'); ?>
																<input name="permanent_add" type="text" value="<?=set_value('permanent_add')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="form-label">পোষ্ট অফিসঃ <span class="required">*</span></label>
																<?php echo form_error('per_po');?>
																<input name="per_po" type="text" value="<?=set_value('per_po')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="form-label">পোষ্ট কোডঃ <span class="required">*</span></label>
																<?php echo form_error('per_pc');?>
																<input name="per_pc" type="number" value="<?=set_value('per_pc')?>" class="form-control input-sm" placeholder="1234">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
														<!-- <div class="row">
														<div class="col-md-12"> -->
															<label class="form-label">বর্তমান ঠিকানার বিবরণ <span class="required">*</span></label>
															<hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
															<div class="form-group">
																<?php echo form_error('present_add');?>
																<textarea name="present_add" rows="6" class="form-control input-sm" placeholder=""><?=set_value('present_add')?></textarea>
															</div>
															<!-- </div>
														</div> -->
													</div>

												</div>
											</div>										
										</div>

									</fieldset>			
								</div> <!-- /Personal Information -->


								<div class="col-md-12">
									<fieldset>
										<legend>দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য (অফিসিয়াল)</legend>
										<div class="row">

											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ <span class="required">*</span></label>
													<?php echo form_error('first_office_id');?>
													<select class="officeSelect2 form-control input-sm" name="first_office_id"></select>
													<div id="typeerror"></div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">প্রথম নির্বাচিত পদের নামঃ <span class="required">*</span></label>
													<?php echo form_error('first_desig_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('first_desig_id', $designation, set_value('first_desig_id'), $more_attr);
													?>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">প্রথম নির্বাচনের সালঃ <span class="required">*</span></label>
													<?php echo form_error('first_elected_year'); ?>
													<select name="first_elected_year" class="form-control input-sm">
														<option value="">-- নির্বাচন করুন --</option>
														<?php for ($i = date('Y'); $i >= 1971; $i--){ ?>
														<option value="<?=$i?>"><?=eng2bng($i)?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">প্রথম সভায় যোগদানের তারিখঃ <span class="required">*</span></label>
													<input name="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="datetime form-control input-sm" placeholder="">
												</div>
											</div>

											<div class="col-md-3" style="clear: left;">
												<div class="form-group">
													<label class="form-label">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ </label>
													<h5 class="font-big-bold"> <?=$info->office_name?> </h5>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">বর্তমান নির্বাচিত পদের নামঃ </label>
													<h5 class="font-big-bold"> <?=$info->desig_name?> </h5>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">বর্তমান নির্বাচনের সালঃ <span class="required">*</span></label>
													<?php echo form_error('crrnt_elected_year'); ?>
													<select name="crrnt_elected_year" class="form-control input-sm">
														<option value="">-- নির্বাচন করুন --</option>
														<?php for ($i = date('Y'); $i >= 1971; $i--){ ?>
														<option value="<?=$i?>"><?=eng2bng($i)?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="form-label">বর্তমান সভায় যোগদানের তারিখঃ <span class="required">*</span></label>
													<input name="crrnt_attend_date" type="text" value="<?=set_value('crrnt_attend_date')?>" class="datetime form-control input-sm" placeholder="">
												</div>
											</div>
											<div class="col-md-3" style="clear: left;">
												<div class="form-group">
													<label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন? <span class="required">*</span></label>
													<?php echo form_error('elected_times'); ?>
													<select name="elected_times" class="form-control input-sm">
														<?php for($i=1; $i <= 10; $i++){ ?>
														<option value="<?=$i?>" <?=$this->input->post('how_much_elected')==$i?'selected':'';?>><?=eng2bng($i)?></option>
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="col-md-12" >
												<label class="form-label">একাধিকবার নির্বাচিত প্রতিষ্ঠানের তার বিবরণঃ</label>
												<table width="100%" border="1" id="experienceDiv">
													<tr>
														<td width="400">প্রতিষ্ঠানের নাম</td>
														<td width="300">পদের নাম</td>
														<td>মেয়াদকাল</td>
														<td width="100"> <a href="javascript:void();" id="addRowExperience" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
													</tr>
													<tr></tr>
												</table>
											</div>

										</div>
									</fieldset>
								</div> <!-- /Office Information -->

							</div> <!-- /row -->


							<div class="form-actions">  
								<div class="pull-right">
									<?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
								</div>
							</div>
							<?php echo form_close();?>

						</div>  <!-- END GRID BODY -->              
					</div> <!-- END GRID -->
				</div>

			</div> <!-- END ROW -->

		</div>
	</div>



	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript">

		$(document).ready(function() {
			$('#validate').validate({
	      	// focusInvalid: false, 
	      	ignore: "",
	      	rules: {
	      		name_bn:{required: true},
	      		name_en: {required: true},
	      		father_name: {required: true},
	      		mother_name: {required: true},	      		
	      		ms_id: {required: true},
	      		per_div_id: {required: true},
	      		per_dis_id: {required: true},
	      		per_upa_id: {required: true},
	      		per_road_no: {required: true},
	      		permanent_add: {required: true},
	      		per_po: {required: true},
	      		per_pc: {required: true},
	      		present_add: {required: true},
	      		first_office_id: {required: true},
	      		first_desig_id: {required: true},
	      		first_elected_year: {required: true},
	      		first_attend_date: {required: true},
	      		crrnt_elected_year: {required: true},
	      		crrnt_attend_date: {required: true},
	      		elected_times: {required: true}
	      	},

	      	messages: {	      		
	      	},

	      	invalidHandler: function (event, validator) {
	         	//display error alert on form submit    
	         },

		      errorPlacement: function (label, element) { // render error placement for each input type        
		      	if (element.attr("name") == "first_office_id") {
		      		label.insertAfter("#typeerror");
		      	} else {    
		      		$('<span class="error"></span>').insertAfter(element).append(label)
		      		var parent = $(element).parent('.input-with-icon');
		      		parent.removeClass('success-control').addClass('error-control');  
		      	}
		      },

		      highlight: function (element) { // hightlight error inputs
		      	var parent = $(element).parent();
		      	parent.removeClass('success-control').addClass('error-control'); 
		      },

	      	unhighlight: function (element) { // revert the change done by hightlight
	      	},

	      	success: function (label, element) {
	      		var parent = $(element).parent('.input-with-icon');
	      		parent.removeClass('error-control').addClass('success-control'); 
	      	},

	      	submitHandler: function (form) {
	      		form.submit(); 
	      	}
	      });
		});


	// Experence 
	$("#addRowExperience").click(function(e) {
		var items = '';

		items+= '<tr>';              
		items+= '<td><select name="exp_office_id[]" class="officeSelect2 form-control input-sm"></select></td>';
		items+= '<td><select name="exp_design_id[]" class="prDesignationSelect2 form-control input-sm"></select></td>';
		items+= '<td><input name="exp_duration[]" type="text" class="form-control input-sm"></td>';
		items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowExperience(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
		items+= '</tr>';

		$('#experienceDiv tr:last').after(items);		
		select2Office();
		select2DesignationPR();
		// select2DesignationEmployee();
	}); 
	function removeRowExperience(id){ 
		$(id).closest("tr").remove();
	}


	//NILG Promotion
	$("#addRowPromotion").click(function(e) {
		var items = '';

		items+= '<tr>';              
		items+= '<td><input name="promo_org_name[]" type="text" class="form-control input-sm"></td>';
		items+= '<td><input name="promo_desig_id[]" type="text" class="form-control input-sm"></td>';
		items+= '<td><input name="promo_salary_ratio[]" type="text" class="form-control input-sm"></td>';
		items+= '<td><input name="promo_comments[]" type="text" class="form-control input-sm"></td>';
		items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowPromotion(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
		items+= '</tr>';

		$('#promotionDiv tr:last').after(items);
      // select2Organization();
      organization_suggestions(); 
      designation_suggestions(); 
   }); 
	function removeRowPromotion(id){ 
		$(id).closest("tr").remove();
	}


	// Education
	$("#addRow").click(function(e) {
		var items = '';

		items+= '<tr>';        
		items+= '<td><select name="edu_exam_id[]" class="form-control input-sm"><?=$exam_data?></select></td>';
		items+= '<td><select name="edu_pass_year[]" class="form-control input-sm"><?=$pass_year_data?></select></td>';
		items+= '<td><select name="edu_subject_id[]" class="form-control input-sm"><?=$subject_data?></select></td>';
		items+= '<td><select name="edu_board_id[]" class="form-control input-sm"><?=$board_data?></select></td>';
		items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
		items+= '</tr>';

		$('#educationInfoDiv tr:last').after(items);
	}); 
	function removeRow(id){ 
		$(id).closest("tr").remove();
	}


	// NILG Training
	$("#addRowNilgTraining").click(function(e) {
		var items = '';

		items+= '<tr>';     
		items+= '<td><select name="nilg_course_id[]" class="courseSelect2 form-control input-sm"></select></td>';
		items+= '<td><select name="nilg_desig_id[]" class="designationSelect2 form-control input-sm"></select></td>';
		items+= '<td><input name="nilg_batch_no[]" type="number" class="form-control input-sm"></td>';
		items+= '<td><input name="nilg_training_start[]" type="text" class="datetime form-control input-sm"></td>';
		items+= '<td><input name="nilg_training_end[]" type="text" class="datetime form-control input-sm" ></td>';
		items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNilgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
		items+= '</tr>';

		$('#nilgTrainingDiv tr:last').after(items);
		select2Course();
		select2Designation();
		datetime();
	}); 
	function removeRowNilgTraining(id){ 
		$(id).closest("tr").remove();
	}


   // Local Organization Training
   $("#addRowLocalOrgTraining").click(function(e) {
   	var items = '';

   	items+= '<tr>';        
   	items+= '<td><input name="local_course_name[]" type="text" class="form-control input-sm"></td>';
   	items+= '<td><input name="local_training_org_name_adds[]" type="text" class="form-control input-sm"></td>';
   	items+= '<td><input name="local_training_start[]" type="text" class="datetime form-control input-sm"></td>';
   	items+= '<td><input name="local_training_end[]" type="text" class="datetime form-control input-sm"></td>';
   	items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowLocalOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
   	items+= '</tr>';

   	$('#localOrgTrainingDiv tr:last').after(items);    	
   	datetime();
   }); 
   function removeRowLocalOrgTraining(id){ 
   	$(id).closest("tr").remove();
   }

   // Foreign Organization Training
   $("#addRowForeignOrgTraining").click(function(e) {
   	var items = '';

   	items+= '<tr>';        
   	items+= '<td><input name="foreign_course_name[]" type="text" class="form-control input-sm"></td>';
   	items+= '<td><input name="foreign_training_org_name_adds[]" type="text" class="form-control input-sm"></td>';
   	items+= '<td><input name="foreign_training_start[]" type="text" class="datetime form-control input-sm"></td>';
   	items+= '<td><input name="foreign_training_end[]" type="text" class="datetime form-control input-sm"></td>';
   	items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowforeignOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
   	items+= '</tr>';

   	$('#foreignOrgTrainingDiv tr:last').after(items);
   	datetime();
   }); 
   function removeRowforeignOrgTraining(id){ 
   	$(id).closest("tr").remove();
   }

</script>