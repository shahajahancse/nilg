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
$exam_data = '<option value="">-নির্বাচন করুন-</option>';
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
}
?>

<div class="page-content">     
	<div class="content">  
		<div class="alert alert-block alert-danger fade in">        
			<a class="close" data-dismiss="alert"></a>
			<h5 class="alert-heading" style="line-height: 20px;"><i class="icon-warning-sign"></i> ধন্যবাদ, প্রশিক্ষক হিসাবে আপনার প্রাথমিক রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে।<br>
				নিম্নক্তো ফর্মের ফিল্ড গুলো যথাযথভাবে পূরণ করে সাবমিট বাটনে ক্লিক করে রেজিস্ট্রেশন আবেদন প্রক্রিয়াটি সম্পন্ন করুন। অনুগ্রহপূর্বক আপনার অ্যাকাউন্টটি যাচাইয়ের জন্য অপেক্ষা করুন। </h5>
				<p> যেকোন সমস্যার জন্য এই নম্বরে যোগাযোগ করুন 🎯 ০১৮৬০-৬৭৩৫৭১</p>
			</div>

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
							echo form_open_multipart("registration/trainer_application_form", $attributes);?>
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
										<legend>প্রশিক্ষক এন্ট্রি ফরম</legend>

										<div class="row">
											<div class="col-md-12">
												<div class="row" style="border-bottom: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
													<!-- <div class="col-md-4">
														<div class="form-group">
															<label class="form-label font-big-bold" style="font-style: italic;">এনআইডি নম্বরঃ</label>
															<span class="font-big-bold"><?=eng2bng($info->nid)?></span>
														</div>
													</div> -->
													<!-- <div class="col-md-4">
														<div class="form-group">
															<label class="form-label font-big-bold" style="font-style: italic;">জন্ম তারিখঃ</label>
															<span class="font-big-bold"><?=eng2bng($info->dob)?></span>
														</div>
													</div> -->
													<!-- <div class="col-md-4">
														<div class="form-group">
															<label class="form-label font-big-bold" style="font-style: italic;">মোবাইল নম্বরঃ</label>
															<span class="font-big-bold"><?=eng2bng($info->mobile_no)?></span>
														</div>
													</div> -->
												</div>

												<div class="row form-row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">প্রশিক্ষকের নাম (বাংলা) <span class="required">*</span></label>
															<?php echo form_error('name_bn'); ?>
															<input name="trainer_name" type="text" value="<?=set_value('name_bn', $info->name_bn)?>" class="bangla form-control input-sm" placeholder="উদাঃ আতাউল মোস্তাফা" contenteditable="TRUE">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">প্রশিক্ষকের নাম (ইংরেজি)</label>
															<?php echo form_error('name_en'); ?>
															<input name="name_en" type="text" value="<?=set_value('name_en')?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">পদবি<span class="required">*</span></label>
															<input type="text" class="form-control input-sm"  name="trainer_desig" value="<?=set_value('designation', $info->designation)?>" required>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">মোবাইল নাম্বার<span class="required">*</span></label>
															<input type="text" class="form-control input-sm"  name="mobile" value="<?=set_value('mobile_no', $info->mobile_no)?>" required>
														</div>
													</div>
													
													
													
												</div>

												<div class="row form-row">
													<div class="col-md-3" style="clear: left;">
														<div class="form-group">
															<label class="form-label">অফিসের/প্রতিষ্ঠানের নামঃ <span class="required">*</span></label>
															<input type="text" class="form-control input-sm" name="trainer_org_name" value="<?=set_value('office_name', $info->office_name)?>" required>
														</div>
													</div>
													<div class="col-md-3" >
														<div class="form-group">
															<label class="form-label">সর্বোচ্চ শিক্ষাগত যোগ্যতাঃ<span class="required">*</span></label>
															<input type="text" name="max_education" class="form-control input-sm" required>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">ফোন (অফিস) </label>
															<input type="text" name="phone" class="form-control input-sm" placeholder="">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">ই-মেইল অ্যাড্রেসঃ </label>
															<!-- <h5 class="font-big-bold"><?=$info->email?></h5> -->
															<input type="text" name="email" value="<?=set_value('email', $info->email)?>" class="form-control input-sm">
														</div>
													</div>
													
													
													
												</div>

												<div class="row form-row">
													
													<div class="col-md-3">
														<!-- <div class="row">
														<div class="col-md-12"> -->
															<label class="form-label">যে সব বিষয় পড়াতে আগ্রহী</label>
															<hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
															<div class="form-group">
																<textarea name="interested_subject" rows="6" class="form-control input-sm" placeholder=""></textarea>
															</div>
															<!-- </div>
														</div> -->
													</div>

													<div class="col-md-3">
														<!-- <div class="row">
														<div class="col-md-12"> -->
															<label class="form-label">বর্তমান ঠিকানা </label>
															<hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
															<div class="form-group">
																<textarea name="present_address" rows="6" class="form-control input-sm" placeholder=""></textarea>
															</div>
															<!-- </div>
														</div> -->
													</div>

												</div>
											</div>										
										</div>

									</fieldset>			
								</div> <!-- /Personal Information -->


							


								

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
	}); 
	function removeRowExperience(id){ 
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