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
							<a href="<?=base_url('training/course_applicant/'.encrypt_url($info->training_id))?>" class="btn btn-primary btn-xs btn-mini">আবেদনের তালিকা</a>
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
								
								<div class="pull-right" style="margin-bottom:20px;">
									<a href="<?=base_url('training/accept/'.encrypt_url($info->id))?>" class="btn btn-blueviolet font-big-bold" onclick="return confirm('আপনি কি নিশ্চিত? আপনি এই আবেদনটি গ্রহণ করতে চান?');"> অনুমোদন করুন</a>
									<a href="<?=base_url('training/decline/'.encrypt_url($info->id))?>" class="btn btn-danger font-big-bold" onclick="return confirm('আপনি কি নিশ্চিত? আপনি এই আবেদনটি বাতিল করতে চান?');"> বাতিল করুন</a>
								</div>	

								<table class="tg" width="100%" >   
									<caption style="font-weight: bold; font-size: 16px;">আবেদনের তথ্য</caption>  
									<tr>
										<td class="tg-khup">প্রশিক্ষণের শিরোনাম</td>
										<td class="tg-ywa9" colspan="3"><?=func_training_title($info->training_id)?></td>
									</tr>
									<tr>
										<td class="tg-khup">আবেদনের সময়</td>
										<td class="tg-ywa9"><?=$info->app_date?></td>
										<td class="tg-khup">ভেরিফাই স্ট্যাটাসঃ</td>
										<td class="tg-ywa9">
											<?php
											if($info->is_verified == 1){
												echo 'আবেদন গ্রহণ';
											}elseif($info->is_verified == 2){
												echo 'বাতিল';
											}else{
												echo 'যাচাই করা হয়নি';
											}
											?>											
										</td>							
									</tr>
									<tr>
										<td class="tg-khup">আইপি এড্রেসঃ</td>
										<td class="tg-ywa9"><?=$info->ip_address?></td>
										<td class="tg-khup"></td>
										<td class="tg-ywa9"></td>
									</tr>
								</table>
								<br>

								<table class="tg" width="100%" >   
									<caption style="font-weight: bold; font-size: 16px;">আবেদনকারীর তথ্য</caption>  
									<tr>
										<td class="tg-khup">নামঃ (বাংলা)</td>
										<td class="tg-ywa9"><?=$info->name_bn?></td>
										<td class="tg-khup">নামঃ (ইংরেজি)</td>
										<td class="tg-ywa9"><?=$info->name_en?></td>							
									</tr>
									<tr>
										<td class="tg-khup">পিতার নামঃ</td>
										<td class="tg-ywa9"><?=$info->father_name?></td>
										<td class="tg-khup">মাতার নামঃ</td>
										<td class="tg-ywa9"><?=$info->mother_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">এনআইডি নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->nid?></td>
										<td class="tg-khup">জন্ম তারিখঃ</td>
										<td class="tg-ywa9"><?=$info->dob?></td>
									</tr>
									<tr>
										<td class="tg-khup">মোবাইল নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->mobile_no?></td>
										<td class="tg-khup">ই-মেইল অ্যাড্রেসঃ</td>
										<td class="tg-ywa9"><?=$info->email?></td>
									</tr>
									<tr>
										<td class="tg-khup">ক্রিয়েটেড ডেটঃ</td>
										<td class="tg-ywa9"><?=date('d F, Y', $info->created_on);?></td>
										<td class="tg-khup">আপডেটেড ডেটঃ</td>
										<td class="tg-ywa9">
											<?php
											if($info->modified != NULL){
												echo date('d F, Y', strtotime($info->modified));
											}
											?>
										</td>
									</tr>               
								</table>

								<br>
								<table class="tg" width="100%" >   
									<caption style="font-weight: bold; font-size: 16px;">অফিসিয়াল বা দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য</caption>  
									<tr>
										<td class="tg-khup">বর্তমান কর্মরত অফিসের নামঃ</td>
										<td class="tg-ywa9"><?=$info->current_office_name?></td>							
										<td class="tg-khup">প্রথম কর্মরত অফিসের নামঃ</td>
										<td class="tg-ywa9"><?=$info->first_office_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ</td>
										<td class="tg-ywa9"><?=$info->current_desig_name?></td>
										<td class="tg-khup">প্রথম চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ</td>
										<td class="tg-ywa9"><?=$info->first_desig_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">বর্তমান অফিসে যোগদানের তারিখঃ</td>
										<td class="tg-ywa9"> <?=date_bangla_calender_format($info->crrnt_attend_date)?></td>
										<td class="tg-khup"> প্রথম চাকুরীতে যোগদানের তারিখঃ </td>
										<td class="tg-ywa9"> <?=date_bangla_calender_format($info->first_attend_date)?> </td>
									</tr>

									<tr>
										<td class="tg-khup">চাকুরী স্থায়ী করনের তারিখঃ</td>
										<td class="tg-ywa9"><?=date_bangla_calender_format($info->job_per_date)?></td>
										<td class="tg-khup">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখঃ</td>
										<td class="tg-ywa9"><?=date_bangla_calender_format($info->prl_date)?></td>
									</tr> 
									<tr>
										<td class="tg-khup">অবসর গ্রহণের তারিখঃ</td>
										<td class="tg-ywa9"><?=date_bangla_calender_format($info->retirement_date)?></td>
										<td class="tg-khup"></td>
										<td class="tg-ywa9"></td>
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
