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
						echo form_open(uri_string(), $attributes);
						// echo form_open_multipart("dashboard/course_application/".encrypt_url($info->id), $attributes);?>
						<div class="row">
							<div class="col-md-12">
								<h2 class="text-center" style="font-weight: bold;"><?=func_training_title($info->id)?></h2>
								<h4 class="text-center">প্রশিক্ষণের সময়ঃ <b><?=date_bangla_calender_format($info->start_date)?> <em>হতে</em> <?=date_bangla_calender_format($info->end_date)?></b></h4>
								<h4 class="text-center">আয়োজক অফিসঃ <b><?=$info->office_name?></b></h4>

							</div>
						</div>
						<hr>
						<h4 class="text-center">রেজিস্ট্রেশনের সময়ঃ <b><?=date_bangla_calender_format($info->reg_start_date)?> <em>হতে</em> <?=date_bangla_calender_format($info->reg_end_date)?></b></h4>


						<div class="row">
							<div class="col-md-4  col-md-offset-4">
								<fieldset>
									<legend>কোর্স কোড দিন</legend>

									<div class="row">
										<div class="col-md-12">												
											<div class="row form-row">
												<div class="col-md-12">
													
													<?php if ($this->session->flashdata('success')){ ?>
													<div class="alert alert-success">
														<?php echo $this->session->flashdata('success'); ?>
													</div>
													<?php }elseif($this->session->flashdata('warning')){ ?>
													<div class="alert alert-warning">
														<?php echo $this->session->flashdata('warning'); ?>
													</div>
													<?php } ?>    

													<div class="form-group">
														<label class="form-label">কোর্স কোড <span class="required">*</span></label>
														<?php echo form_error('pin'); ?>
														<input name="pin" type="text" value="<?=set_value('pin')?>" class="form-control input-sm font-opensans" style="text-transform: uppercase;">
													</div>
												</div>
											</div>
										</div>										
									</div>

								</fieldset>			
							</div> <!-- /Personal Information -->				

						</div> <!-- /row -->


						<div class="form-actions">  
							<div class="pull-right">
								<input type="hidden" name="hide_training_id" value="<?=encrypt_url($info->id)?>">
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
	      		pin:{required: true}
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

</script>