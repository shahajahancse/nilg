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
						<?php 
						$attributes = array('id' => 'validate');
						echo form_open_multipart("registration/application_form", $attributes);?>
						<div><?php //echo validation_errors(); ?></div>
						<?php if($this->session->flashdata('success')):?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success');;?>
							</div>
						<?php endif; ?>            

						<div class="row">
							<div class="col-md-12">
								<fieldset>
									<legend>ব্যাক্তিগত বা সাধারণ তথ্য</legend>

									<div class="row">
										<div class="col-md-12">

											<div class="row form-row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">নামঃ (বাংলা) <span class="required">*</span></label>
														<?php echo form_error('name_bangla'); ?>
														<input name="name_bangla" id="name_bangla" type="text" value="<?=set_value('name_bangla', $info->name_bn)?>" class="bangla form-control input-sm" placeholder="উদাঃ আতাউল মোস্তাফা" contenteditable="TRUE">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
														<?php echo form_error('name_english'); ?>
														<input name="name_english" id="name_english" type="text" value="<?=set_value('name_english')?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">পিতা / স্বামীর নামঃ <span class="required">*</span></label>
														<?php echo form_error('father_name'); ?>
														<input name="father_name" id="father_name" type="text" value="<?=set_value('father_name')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">মাতার নামঃ <span class="required">*</span></label>
														<?php echo form_error('mother_name'); ?>
														<input name="mother_name" id="mother_name" type="text" value="<?=set_value('mother_name')?>" class="form-control input-sm" placeholder="">
													</div>                            
												</div>
											</div>




											<div class="row form-row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">জন্ম তারিখঃ <span class="required">*</span></label>
														<?php echo form_error('dob'); ?>
														<input name="dob" id="dob" type="text" value="<?=set_value('dob')?>" onchange="getdate()" class="datetime form-control input-sm" placeholder="">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">এনআইডি নম্বরঃ <span class="required">*</span></label>
														<?php echo form_error('nid'); ?>
														<input name="nid" type="text" value="<?=set_value('nid')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">মোবাইল নম্বরঃ <span class="required">*</span></label>
														<?php echo form_error('mobile_no'); ?>
														<input name="mobile_no" type="text" value="<?=set_value('mobile_no')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">retirement_prl_dateঃ <span class="required">*</span></label>
														<?php echo form_error('retirement_prl_date'); ?>
														<input name="retirement_prl_date" type="text" value="<?=set_value('retirement_prl_date')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">retirement_dateঃ <span class="required">*</span></label>
														<?php echo form_error('retirement_date'); ?>
														<input name="retirement_date" type="text" value="<?=set_value('retirement_date')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">ই-মেইল অ্যাড্রেসঃ </label>
														<?php echo form_error('email'); ?>
														<input name="email" id="email" type="text" value="<?=set_value('email', $info->email)?>" class="form-control input-sm" placeholder="">
													</div>
												</div>												
											</div>

											<div class="row form-row">
												<div class="col-md-3">
													<label class="form-label">লিঙ্গঃ <span class="required">*</span></label>
													<?php echo form_error('gender'); ?>
													<input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : "checked"; ?>> <span style="color: black; font-size: 15px;">পুরুষ </span> 
													<input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
													<div class="error_placeholder"></div>
												</div>
												<div class="col-md-3">
													<label class="form-label">বৈবাহিক অবস্থাঃ <span class="required">*</span></label>
													<?php echo form_error('marital_status_id');
													$more_attr = 'class="form-control input-sm" id="marital_status_id"';
													echo form_dropdown('marital_status_id', $marital_status, set_value('marital_status_id', $this->input->post('marital_status_id')), $more_attr);
													?>
												</div>
												<div class="col-md-3">
													<div class="row form-row">
														<div class="col-md-6">                              
															<div class="form-group">                                  
																<label class="form-label">ছেলে সন্তানঃ</label>
																<?php echo form_error('son_number'); ?>
																<input name="son_number" id="son_number" type="number" value="<?=set_value('son_number')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label">মেয়ে সন্তানঃ</label>
																<?php echo form_error('daughter_number'); ?>
																<input name="daughter_number" id="daughter_number" type="number" value="<?=set_value('daughter_number')?>" class="form-control input-sm" placeholder="">
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="row form-row">
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
														<label class="form-label">বাড়ির নাম / নংঃ <span class="required">*</span></label>
														<?php echo form_error('permanent_add'); ?>
														<input name="permanent_add" type="text" value="<?=set_value('permanent_add')?>" class="form-control input-sm" placeholder="প্রযন্তে">
													</div>
												</div>
												<div class="col-md-3" style="clear: left;">
													<div class="form-group">
														<label class="form-label">গ্রাম/ওয়ার্ড/ইউনিয়নঃ</label>
														<?php echo form_error('per_road_no'); ?>
														<input name="per_road_no" type="text" value="<?=set_value('per_road_no')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">পোষ্ট অফিসঃ</label>
														<?php echo form_error('per_pc');?>
														<input name="per_pc" type="text" value="<?=set_value('per_pc')?>" class="form-control input-sm" placeholder="">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="form-label">পোষ্ট কোডঃ</label>
														<?php echo form_error('per_pc');?>
														<input name="per_pc" type="number" value="<?=set_value('per_pc')?>" class="form-control input-sm" placeholder="1234">
													</div>
												</div>

											</div>
										</div>										
									</div>

								</fieldset>			
							</div> <!-- /Personal Information -->


							<div class="row">
								<div class="col-md-6">
									<fieldset>
										<legend>প্রথম চাকুরীর তথ্য</legend>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">নিয়োগের তারিখঃ <span class="required">*</span></label>
													<input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="form-control input-sm datetime" placeholder="">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">প্রথম যোগদানকৃত প্রতিষ্ঠানঃ <span class="required">*</span></label>

													<?php echo form_error('first_office_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('first_office_id', $office, set_value('first_office_id'), $more_attr);
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">প্রথম যোগদানের  তারিখ <span class="required">*</span></label>
													<input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="form-control input-sm datetime" placeholder="">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">প্রথম যোগদানের সময়ে পদবিঃ <span class="required">*</span></label>

													<?php echo form_error('per_div_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('per_div_id', $designation, set_value('per_div_id'), $more_attr);
													?>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">প্রথম প্রাপ্য গ্রেডঃ <span class="required">*</span></label>

													<?php echo form_error('per_div_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('per_div_id', $designation, set_value('per_div_id'), $more_attr);
													?>
												</div>
											</div>

										</div>
									</fieldset>
								</div>

								<div class="col-md-6">
									<fieldset>
										<legend> বর্তমান চাকুরীর তথ্য </legend>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">বর্তমান কর্মস্থলঃ <span class="required">*</span></label>

													<?php echo form_error('first_office_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('first_office_id', $office, set_value('first_office_id'), $more_attr);
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">বর্তমান কর্মস্থলে যোগদানের তারিখ <span class="required">*</span></label>
													<input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="form-control input-sm datetime" placeholder="">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">বর্তমান পদবিঃ <span class="required">*</span></label>

													<?php echo form_error('per_div_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('per_div_id', $designation, set_value('per_div_id'), $more_attr);
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">বর্তমান পদে প্রথম যোগদানের তারিখ <span class="required">*</span></label>
													<input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="form-control input-sm datetime" placeholder="">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">বর্তমান প্রাপ্য গ্রেডঃ <span class="required">*</span></label>

													<?php echo form_error('per_div_id');
													$more_attr = 'class="form-control input-sm"';
													echo form_dropdown('per_div_id', $designation, set_value('per_div_id'), $more_attr);
													?>
												</div>
											</div>

										</div>
									</fieldset>
								</div> 

							</div>
							<!-- /Office Information -->


							<div class="col-md-12">
								<fieldset>
									<legend>শিক্ষাগত যোগ্যতা ও অন্যান্য তথ্য</legend>
									<div class="row">
										<div class="col-md-12" >
											<label class="form-label">শিক্ষাগত যোগ্যতাঃ</label>
											<table width="100%" border="1" id="educationInfoDiv">
												<tr>
													<td>পরীক্ষার নাম</td>
													<td>পাশের সন</td>
													<td>বিষয়</td>
													<td>বোর্ড / বিশ্ববিদ্যালয়</td>
													<td width="100"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
												</tr>
												<tr></tr>
											</table>
										</div>
									
									</div>
								</fieldset>
							</div> <!-- /Education and Training Information -->

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
	      	name_english:{required: true},
	      	permanent_add: {required: true},
	      	first_office_id: {required: true},
	      	max_education: {required: true},
	      	mobile: {required: true},
	      	phone: {required: false},
	      	email: {required: false, email:true},
	      	interested_subject: {required: false},
	      	present_address: {required: false}
	      },

			//  messages: {
			//    identity: {
			//     required: "Username required.",
			//     minlength: jQuery.format("Enter at least {0} characters"),
			//     remote: jQuery.format("Already in use! Please try again.")
			//   }
			// },

			invalidHandler: function (event, validator) {
	         //display error alert on form submit    
	      },

	      errorPlacement: function (label, element) { // render error placement for each input type            
	      	$('<span class="error"></span>').insertAfter(element).append(label)
	      	var parent = $(element).parent('.input-with-icon');
	      	parent.removeClass('success-control').addClass('error-control');  
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

	function getdate() {
		var tt = document.getElementById('dob').value;

		var date = new Date(tt);
		var newdate = new Date(date);

		newdate.setDate(newdate.getDate() + 21535);        
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
        	// var someFormattedDate = mm + '/' + dd + '/' + y;
        	var someFormattedDate = y + '-' + mm + '-' + dd;

        	newdate.setDate(newdate.getDate() + 365);        
        	var ddr = newdate.getDate();
        	var mmr = newdate.getMonth() + 1;
        	var yr = newdate.getFullYear();
        	var someFormattedDateRetirement = yr + '-' + mmr + '-' + ddr;

        	document.getElementById('retirement_prl_date').value = someFormattedDate;
        	document.getElementById('retirement_date').value = someFormattedDateRetirement;
        }

     </script>