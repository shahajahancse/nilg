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
						echo form_open_multipart("dashboard/edit_trainee_pr_official", $attributes);?>
						<div><?php //echo validation_errors(); ?></div>
						<?php if($this->session->flashdata('success')):?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success');;?>
							</div>
						<?php endif; ?>            

						<div class="row">
							<div class="col-md-12">
								<fieldset>
									<legend>দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য (অফিসিয়াল)</legend>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ <span class="required">*</span></label>
												<?php echo form_error('first_office_id');?>
												<select class="officeSelect2 form-control input-sm" name="first_office_id"></select>
												<script>
													var $newOption = $("<option></option>").val("<?php echo $info->first_office_id;?>").text("<?php echo $info->institute_name;?>");
													$("#curr_institute_id").append($newOption).trigger('change');
												</script>
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
			// JS Function
			select2Office();
			select2DesignationPR();
		}); 
		function removeRowExperience(id){ 
			$(id).closest("tr").remove();
		}

	});	

</script>