<div class="page-content">     
	<div class="content">  

		<div class="row">
			<div class="col-md-12">
				<div class="grid simple horizontal red">
					<div class="grid-title">
						<h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
						<div class="pull-right">
							<a href="<?=base_url('trainee/all_employee')?>" class="btn btn-primary btn-xs btn-mini"> কর্মকর্তা / কর্মচারীর তালিকা </a>
							<!-- <a href="<?=base_url('#')?>" class="btn btn-primary btn-xs btn-mini" data-toggle="modal" data-target="#myModal"> সহায়িকা </a> -->
						</div>
					</div>
					<div class="grid-body">
						<?php if ($this->session->flashdata('success')) : ?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						<?php endif; ?>

						<!-- Personal Information -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-size: 16px; font-weight: bold;"> ব্যাক্তিগত বা সাধারণ তথ্য </h4>
								</div>
								<div class="pull-right">
									<!-- <a href="<?=base_url('my_profile/edit_trainee_general_info')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a> -->
								</div>

								<table class="tg" width="100%">     
									<tr>
										<td class="tg-khup">নামঃ (বাংলা)</td>
										<td class="tg-ywa9"><?=$info->name_bn?></td>
										<td class="tg-khup">এনআইডি নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->nid?></td>										
										<td class="tg-ywa9" rowspan="11" style="width: 160px;">
											<?php
											if($info->profile_img != NULL){
												$url = base_url('uploads/profile/').$info->profile_img;
											}else{
												$url = base_url('uploads/profile/blank.png');
											}
											?>
											<img src="<?=$url?>" width="150" class="image-center">
											<div align="center"><span class='label label-success'><?=$info->status_name ?></span></div>
										</td>
									</tr>
									<tr>
										<td class="tg-khup">নামঃ (ইংরেজি)</td>
										<td class="tg-ywa9"><?=$info->name_en?></td>	
										<td class="tg-khup">মোবাইল নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->mobile_no?></td>
										<!-- <td class="tg-ywa9"></td> -->
									</tr>
									<tr>
										<td class="tg-khup">পিতা / স্বামীর নামঃ</td>
										<td class="tg-ywa9"><?=$info->father_name?></td>
										<td class="tg-khup">ই-মেইল অ্যাড্রেসঃ</td>
										<td class="tg-ywa9" rowspan="1"><?=$info->email?></td>
									</tr>
									<tr>
										<td class="tg-khup">মাতার নামঃ</td>
										<td class="tg-ywa9"><?=$info->mother_name?></td>
										<td class="tg-khup">বর্তমান ঠিকানাঃ</td>
										<td class="tg-ywa9"><?=$info->present_add?></td>
									</tr>
									<tr>
										<td class="tg-khup">জন্ম তারিখঃ</td>
										<td class="tg-ywa9"><?=$info->dob?></td>
										<td class="tg-khup text-left" colspan="2">স্থায়ী ঠিকানার বিবরণঃ</td>
									</tr>
									<tr>
										<td class="tg-khup">লিঙ্গঃ</td>
										<td class="tg-ywa9"><?=func_gender($info->gender)?></td>
										<td class="tg-khup">বিভাগঃ</td>
										<td class="tg-ywa9"><?=$info->div_name_bn?></td>
									</tr>
									<tr>
										<td class="tg-khup">বৈবাহিক অবস্থাঃ</td>
										<td class="tg-ywa9"><?=$info->marital_status_name?></td>
										<td class="tg-khup">জেলাঃ</td>
										<td class="tg-ywa9"><?=$info->dis_name_bn?></td>
									</tr>
									<tr>
										<td class="tg-khup">ছেলে সন্তানঃ</td>
										<td class="tg-ywa9"><?=eng2bng($info->son_no)?></td>
										<td class="tg-khup">উপজেলা/থানাঃ</td>
										<td class="tg-ywa9"><?=$info->upa_name_bn?></td>
									</tr>
									<tr>
										<td class="tg-khup">মেয়ে সন্তানঃ</td>
										<td class="tg-ywa9"><?=eng2bng($info->daughter_no)?></td>
										<td class="tg-khup">পোষ্ট অফিস (কোড)ঃ</td>
										<td class="tg-ywa9"><?=$info->per_po.' ('.$info->per_pc.')';?></td>
									</tr>
									<tr>
										<td class="tg-khup">ক্রিয়েটেড ডেটঃ</td>
										<td class="tg-ywa9"><?=date('d F, Y', $info->created_on);?></td>
										<td class="tg-khup">গ্রাম/ওয়ার্ড/ইউনিয়নঃ</td>
										<td class="tg-ywa9"><?=$info->per_road_no?></td>
									</tr>
									<tr>
										<td class="tg-khup">আপডেটেড ডেটঃ</td>
										<td class="tg-ywa9">
											<?php
											if($info->modified != NULL){
												echo date('d F, Y', strtotime($info->modified));
											}
											?>
										</td>
										<td class="tg-khup">বাড়ির নাম / নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->permanent_add;?></td>
									</tr>               
								</table>
							</div>          
						</div>

						<style type="text/css">
							.tg .tg-khups {
							    background-color: #efefef;
							    color: #ffffff;
							    vertical-align: top;
							    color: black;
							    text-align: right;
							}
						</style>

						<!-- Offical Information -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-weight: bold;"> অফিসিয়াল বা দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য </h4>
								</div>
								<div class="pull-right">
									<!-- <a href="<?=base_url('my_profile/edit_trainee_pr_official')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a> -->
								</div>

								<table class="tg" width="100%">     
									<tr>
										<td class="tg-khups" colspan="1">বর্তমান কর্মরত অফিসের নামঃ</td>
										<td class="tg-ywa9" colspan="3"><?=$info->current_office_name?></td>
									</tr>
									<tr>
										<td class="tg-khups">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ</td>
										<td class="tg-ywa9"><?=$info->current_desig_name?></td>
										<td class="tg-khups">বর্তমান অফিসে যোগদানের তারিখঃ</td>
										<td class="tg-ywa9"> <?=date_bangla_calender_format($info->crrnt_attend_date)?></td>
									</tr>
								</table>
							</div>          
						</div>

						<!-- Education -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-weight: bold;"> শিক্ষাগত যোগ্যতার তথ্য</h4>
								</div>
								<div class="pull-right">
									<!-- <a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a> -->
								</div>

								<table class="tg2" width="100%">
									<tr> 
										<td class="tg-khupCenter">পরীক্ষার নাম</td>
										<td class="tg-khupCenter">বিষয়/বিভাগ</td>
										<td class="tg-khupCenter">পাশের সন</td>
										<td class="tg-khupCenter">বোর্ড / বিশ্ববিদ্যালয়</td>
									</tr>
									<?php
									if($education != NULL){
										foreach ($education as $row) { 
											?>
											<tr> 
												<td class="tg-ywa9"><?=$row->exam_name;?></td>
												<td class="tg-ywa9"><?=$row->sub_name;?></td>
												<td class="tg-ywa9"><?=eng2bng($row->edu_pass_year);?></td>
												<td class="tg-ywa9"><?=$row->board_name;?></td>
											</tr>									
											<?php 
										}
									} 
									?>
								</table>
							</div>
						</div>


						<h4 style="line-height: .5; font-weight: bold;"> প্রশিক্ষণ সংক্রান্ত</h4>

						<!-- NILG Training -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-weight: bold;"> (ক) এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ</h4>
								</div>
								<div class="pull-right">
									<!-- <a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a> -->
								</div>

								<table class="tg2" width="100%">
									<tr> 
										<td class="tg-khupCenter">কোর্সের নাম</td>
										<td class="tg-khupCenter">প্রশিক্ষণে অংশগ্রহণকালিন সময়ে পদবী</td>
										<td class="tg-khupCenter">ব্যাচ নং</td>
										<td class="tg-khupCenter">সময়কাল</td>
										<td class="tg-khupCenter">মেয়াদ</td>
									</tr>
									<?php
									foreach ($nilg_training as $row) { 
										?>
										<tr> 
											<td class="tg-ywa9" align="center"><?=$row->participant_name .' এর '. $row->course_title;?></td>
											<td class="tg-ywa9" align="center"><?=$row->desig_name;?></td>
											<td class="tg-ywa9" align="center"><?=eng2bng($row->batch_no);?></td>
											<td class="tg-ywa9" align="center"><?=func_training_date_from_to($row->start_date, $row->end_date);?></td>
											<td class="tg-ywa9" align="center"><?=func_training_duration($row->start_date, $row->end_date);?></td>
										</tr>									
										<?php 
									}
									?>
								</table>
							</div>
						</div>

						<!-- Other Training in Bangladesh -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-weight: bold;"> (খ) দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষণ</h4>
								</div>
								<div class="pull-right">
									<!-- <a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a> -->
								</div>

								<table class="tg2" width="100%">
									<tr> 
										<td class="tg-khupCenter">কোর্সের নাম</td>
										<td class="tg-khupCenter">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
										<td class="tg-khupCenter">সময়কাল</td>
										<td class="tg-khupCenter">মেয়াদ</td>
									</tr>
									<?php
									foreach ($local_training as $row) { 
										?>
										<tr> 
											<td class="tg-ywa9"><?=$row->local_course_name;?></td>
											<td class="tg-ywa9"><?=$row->local_training_org_name_adds;?></td>
											<td class="tg-ywa9"><?=func_training_date_from_to($row->local_training_start, $row->local_training_end);?></td>
											<td class="tg-ywa9"><?=func_training_duration($row->local_training_start, $row->local_training_end);?></td>
										</tr>									
										<?php 
									}
									?>
								</table>
							</div>
						</div>


						<!-- Foriegn Training -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-weight: bold;"> (গ) বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ</h4>
								</div>
								<div class="pull-right">
									<!-- <a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a> -->
								</div>

								<table class="tg2" width="100%">
									<tr> 
										<td class="tg-khupCenter">কোর্সের নাম</td>
										<td class="tg-khupCenter">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
										<td class="tg-khupCenter">সময়কাল</td>
										<td class="tg-khupCenter">মেয়াদ</td>
									</tr>
									<?php
									foreach ($foreign_training as $row) { 
										?>
										<tr> 
											<td class="tg-ywa9"><?=$row->foreign_course_name;?></td>
											<td class="tg-ywa9"><?=$row->foreign_training_org_name_adds;?></td>
											<td class="tg-ywa9"><?=func_training_date_from_to($row->foreign_training_start, $row->foreign_training_end);?></td>
											<td class="tg-ywa9"><?=func_training_duration($row->foreign_training_start, $row->foreign_training_end);?></td>
										</tr>									
										<?php 
									}
									?>
								</table>
							</div>
						</div>

					</div>  <!-- END GRID BODY -->              
				</div> <!-- END GRID -->
			</div>

		</div> <!-- END ROW -->
	</div>
</div>