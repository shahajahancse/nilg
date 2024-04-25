<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
	.tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
	.tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
	.tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
	.tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 140px; color: black; text-align: right;}
	.tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
	.tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
</style> 

<div class="page-content">     
	<div class="content">  

		<div class="row">
			<div class="col-md-12">
				<div class="grid simple horizontal red">
					<div class="grid-title">
						<h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
						<div class="pull-right">
							<!-- <a href="<?=base_url('#')?>" class="btn btn-primary btn-xs btn-mini" data-toggle="modal" data-target="#myModal"> সহায়িকা </a> -->
						</div>
					</div>
					<div class="grid-body">
						<?php if ($this->session->flashdata('success')) : ?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						<?php endif; ?>

						<div class="row">
							<div class="col-md-12">
								<!-- <div class="pull-right" style="margin-bottom:20px;">
									<a href="<?=base_url('trainee/accept/'.encrypt_url($info->id))?>" class="btn btn-blueviolet font-big-bold" onclick="return confirm('আপনি কি নিশ্চিত? আপনি এই আবেদনটি গ্রহণ করতে চান?');"> অনুমোদন করুন</a>
									<a href="<?=base_url('trainee/decline/'.encrypt_url($info->id))?>" class="btn btn-danger font-big-bold" onclick="return confirm('আপনি কি নিশ্চিত? আপনি এই আবেদনটি বাতিল করতে চান?');"> বাতিল করুন</a>
								</div> -->								
								
								<div class="row form-row">								
									<?php 
						            $attributes = array('id' => 'validate', 'autcomplete' => 'off');
						            echo form_open_multipart(current_url(), $attributes);?>
            
									<div class="col-md-4 col-md-offset-2 divReason" style="margin-bottom: 20px; display: none;">
										<label>বাতিলের কারণ</label>
										<textarea name="decline_reason" id="decline_reason" class="form-control" rows="2"><?=set_value('decline_reason')?></textarea>
									</div>

									<div class="col-md-2 col-md-offset-6 rmClass" style="margin-bottom: 20px;">
										<label>ডাটা স্ট্যাটাস</label>
										<?php 
										echo form_error('status');
										$more_attr = 'class="form-control input-sm" id="status"';
										echo form_dropdown('status', $status, set_value('status'), $more_attr);
										?>
									</div>

									<div class="col-md-2" style="margin-bottom: 20px;">
										<label>আবেদন স্ট্যাটাস</label>
										<?php 
										echo form_error('verify_status');
										$more_attr = 'class="form-control input-sm" id="verify_status"';
										echo form_dropdown('verify_status', $verify_status, set_value('verify_status'), $more_attr);
										?>
									</div>

									<div class="col-md-2 pull-right" style="margin-top: 24px !important; padding-left: 0px !important;">
										<button type="submit" class="btn btn-blueviolet font-big-bold"><i class="icon-ok"></i>সংরক্ষণ করুন</button>
									</div>
									<?php form_close(); ?>
								</div>

								<table class="tg" width="100%">     
									<tr>
										<td class="tg-khup">নামঃ</td>
										<td class="tg-ywa9"><?=$info->name_bn?></td>
										<td class="tg-khup">অফিসের ধরণঃ</td>
										<td class="tg-ywa9"><?=$info->office_type_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">এনআইডি নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->nid?></td>
										<td class="tg-khup">বর্তমান পদবিঃ</td>
										<td class="tg-ywa9"><?=$info->current_desig_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">জন্ম তারিখঃ</td>
										<td class="tg-ywa9"><?=date_bangla_calender_format($info->dob)?></td>
										<td class="tg-khup">বর্তমান অফিসঃ</td>
										<td class="tg-ywa9"><?=$info->current_office_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">মোবাইল নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->mobile_no?></td>
										<td class="tg-khup">বিভাগঃ</td>
										<td class="tg-ywa9"><?=$info->div_name_bn?></td>
									</tr>
									<tr>
										<td class="tg-khup">ই-মেইল অ্যাড্রেসঃ</td>
										<td class="tg-ywa9"><?=$info->email?></td>										
										<td class="tg-khup">জেলাঃ</td>
										<td class="tg-ywa9"><?=$info->dis_name_bn?></td>
									</tr>
									<tr>
										<td class="tg-khup">আবেদনের সময়ঃ</td>
										<td class="tg-ywa9"><?=date('d F, Y h:i A', $info->created_on);?></td>
										<td class="tg-khup">উপজেলা/থানাঃ</td>
										<td class="tg-ywa9"><?=$info->upa_name_bn?></td>
									</tr>
								</table>

							</div>          

						</div>

					</div>  <!-- END GRID BODY -->              
				</div> <!-- END GRID -->
			</div>

		</div> <!-- END ROW -->
	</div>
</div>


<script type="text/javascript">
  	// 'event_notify[]': { required: true }  

  	$(document).ready(function() {
  		$('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         verify_status: {
         	required: true
         },
      	status: {
      		required: function(element) { 
      			var vStatusID = $('#verify_status').val();
               // console.log(statusID); 
               if ((vStatusID == 1)){
               	return true;
               }else{
               	return false;
               }
            }
         },
      	decline_reason: {
      		required: function(element) { 
      			var vStatusID = $('#verify_status').val();
               // console.log(statusID); 
               if ((vStatusID == 2)){
               	return true;
               }else{
               	return false;
               }
            }
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
      	if (element.attr("name") == "event_notify[]") {
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

  // Get Group ID
  $('#verify_status').change(function(){
  	var status = $('#verify_status').val();

  	if(status == 2){
  		$(".divReason").show();
  		$('.rmClass').removeClass('col-md-offset-6');
  	}else{
  		$(".divReason").hide();
  		$('.rmClass').addClass('col-md-offset-6');
  	}


  });
</script>
