<div class="page-content">
	<div class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="grid simple horizontal red">
					<div class="grid-title">
						<h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
						<div class="pull-right">
							<a href="<?= base_url('trainee/all_employee') ?>" class="btn btn-primary btn-xs btn-mini"> কর্মকর্তা / কর্মচারীর তালিকা </a>
							<!-- <a href="<?= base_url('#') ?>" class="btn btn-primary btn-xs btn-mini" data-toggle="modal" data-target="#myModal"> সহায়িকা </a> -->
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
									<h4 style="line-height: .5; font-size: 16px; font-weight: bold;"> ব্যক্তিগত বা সাধারণ তথ্য </h4>
								</div>
								<div class="pull-right">
									<a href="<?= base_url('trainee/edit_trainee_general_info/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<div class="table-responsive">
									<table class="tg" width="100%">
										<tr>
											<td class="tg-khup">নামঃ (বাংলা)</td>
											<td class="tg-ywa9"><?= $info->name_bn ?></td>
											<td class="tg-khup">এনআইডি নম্বরঃ</td>
											<td class="tg-ywa9"><?= $info->nid ?></td>
											<td class="tg-ywa9" rowspan="12" style="width: 160px;">
												<?php
												if ($info->profile_img != NULL) {
													$url = base_url('uploads/profile/') . $info->profile_img;
												} else {
													$url = base_url('uploads/profile/blank.png');
												}
												?>
												<img src="<?= $url ?>" width="150" class="image-center">
												<div align="center"><span class='label label-success'><?= $info->status_name ?></span></div>
	
												<!-- Signature Image -->
												<?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('nilg')) { ?>
													<hr style="border: 1px solid #ccc;">
													<label style="text-align: center;font-weight: bold;">স্বাক্ষর</label>
													<?php if ($info->signature != NULL) {
														$signature = base_url('uploads/signature/') . $info->signature;
														echo '<img src="' . $signature . '" width="100" class="center">';
													}
													?>
												<?php } ?>
	
												<!-- User Role -->
												<hr style="border: 1px solid #ccc;">
												<label style="text-align: center;font-weight: bold;">ইউজার রোল</label>
												<?php foreach ($currentGroups as $grp) { ?>
													<span class='label label-danger' style="display: block;margin-bottom: 5px;"><?= $grp->description ?></span>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td class="tg-khup">নামঃ (ইংরেজি)</td>
											<td class="tg-ywa9"><?= $info->name_en ?></td>
											<td class="tg-khup">মোবাইল নম্বরঃ</td>
											<td class="tg-ywa9"><?= $info->mobile_no ?></td>
										</tr>
										<tr>
											<td class="tg-khup">পিতা / স্বামীর নামঃ</td>
											<td class="tg-ywa9"><?= $info->father_name ?></td>
											<td class="tg-khup">ই-মেইল অ্যাড্রেসঃ</td>
											<td class="tg-ywa9"><?= $info->email ?></td>
										</tr>
										<tr>
											<td class="tg-khup">মাতার নামঃ</td>
											<td class="tg-ywa9"><?= $info->mother_name ?></td>
											<td class="tg-khup">বর্তমান ঠিকানাঃ</td>
											<td class="tg-ywa9"><?= $info->present_add ?></td>
										</tr>
										<tr>
											<td class="tg-khup">জন্ম তারিখঃ</td>
											<td class="tg-ywa9"><?= $info->dob ?></td>
											<td class="tg-khup text-left" colspan="2">স্থায়ী ঠিকানার বিবরণঃ</td>
										</tr>
										<tr>
											<td class="tg-khup">লিঙ্গঃ</td>
											<td class="tg-ywa9"><?= func_gender($info->gender) ?></td>
											<td class="tg-khup">বিভাগঃ</td>
											<td class="tg-ywa9"><?= $info->per_div_bn ?></td>
										</tr>
										<tr>
											<td class="tg-khup">বৈবাহিক অবস্থাঃ</td>
											<td class="tg-ywa9"><?= $info->marital_status_name ?></td>
											<td class="tg-khup">জেলাঃ</td>
											<td class="tg-ywa9"><?= $info->per_dis_bn ?></td>
										</tr>
										<tr>
											<td class="tg-khup">ছেলে সন্তানঃ</td>
											<td class="tg-ywa9"><?= eng2bng($info->son_no) ?></td>
											<td class="tg-khup">উপজেলা/থানাঃ</td>
											<td class="tg-ywa9"><?= $info->per_upa_bn ?></td>
										</tr>
										<tr>
											<td class="tg-khup">মেয়ে সন্তানঃ</td>
											<td class="tg-ywa9"><?= eng2bng($info->daughter_no) ?></td>
											<td class="tg-khup">পোষ্ট অফিস (কোড)ঃ</td>
											<td class="tg-ywa9"><?= $info->per_po . ' (' . $info->per_pc . ')'; ?></td>
										</tr>
										<tr>
											<td class="tg-khup">ধর্মঃ</td>
											<td class="tg-ywa9">
												<?php if ($info->religion_name) {
													echo $info->religion_name;
												} ?>
											</td>
											<td class="tg-khup">গ্রাম/ওয়ার্ড/ইউনিয়নঃ</td>
											<td class="tg-ywa9"><?= $info->per_road_no ?></td>
										</tr>
										<tr>
											<td class="tg-khup">মুক্তিযোদ্ধা কোটা</td>
											<td class="tg-ywa9">
												<?php if ($info->quota_name) {
													echo $info->quota_name;
												} ?>
											</td>
											<td class="tg-khup">বাড়ির নাম / নম্বরঃ</td>
											<td class="tg-ywa9"><?= $info->permanent_add; ?></td>
										</tr>
										<tr>
											<td class="tg-khup">ক্রিয়েটেড ডেটঃ</td>
											<td class="tg-ywa9"><?= date('d F, Y', $info->created_on); ?></td>
											<td class="tg-khup">জন্ম স্থানঃ</td>
											<td class="tg-ywa9"><?= $info->birth_place; ?></td>
										</tr>
									</table>
								</div>
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
									<a href="<?= base_url('trainee/edit_employee_official/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<table class="tg" width="100%">
									<tr>
										<td class="tg-khups">বর্তমান কর্মরত অফিসের নামঃ</td>
										<td class="tg-ywa9"><?= $info->current_office_name ?></td>
										<td class="tg-khups">প্রথম কর্মরত অফিসের নামঃ</td>
										<td class="tg-ywa9"><?= $info->first_office_name ?></td>
									</tr>
									<tr>
										<td class="tg-khups">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ</td>
										<td class="tg-ywa9"><?= $info->current_desig_name ?></td>
										<td class="tg-khups">প্রথম চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ</td>
										<td class="tg-ywa9"><?= $info->first_desig_name ?></td>
									</tr>
									<tr>
										<td class="tg-khups">বর্তমান অফিসে যোগদানের তারিখঃ</td>
										<td class="tg-ywa9"> <?= date_bangla_calender_format($info->crrnt_attend_date) ?></td>
										<td class="tg-khups"> প্রথম চাকুরীতে যোগদানের তারিখঃ </td>
										<td class="tg-ywa9"> <?= date_bangla_calender_format($info->first_attend_date) ?> </td>
									</tr>

									<tr>
										<td class="tg-khups">চাকুরী স্থায়ী করনের তারিখঃ</td>
										<td class="tg-ywa9"><?= date_bangla_calender_format($info->job_per_date) ?></td>
										<td class="tg-khups">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখঃ</td>
										<td class="tg-ywa9"><?= date_bangla_calender_format($info->prl_date) ?></td>
									</tr>
									<tr>
										<td class="tg-khups">অবসর গ্রহণের তারিখঃ</td>
										<td class="tg-ywa9"><?= date_bangla_calender_format($info->retirement_date) ?></td>
										<td class="tg-khups"></td>
										<td class="tg-ywa9"></td>
									</tr>
									<tr>
										<td class="tg-khups">
											ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণঃ</td>
										<td class="tg-ywa9" colspan="3">
											<?php if ($experience != NULL) { ?>
												<table style="border-collapse:collapse; border:1px solid #ccc;width: 100%;">
													<tr>
														<th>প্রতিষ্ঠানের নাম</th>
														<th>পদের নাম</th>
														<th>মেয়াদকাল</th>
													</tr>
													<?php foreach ($experience as $exp) { ?>
														<tr>
															<td><?= $exp->office_name; ?></td>
															<td><?= $exp->desig_name; ?></td>
															<td><?= $exp->exp_duration; ?></td>
														</tr>
													<?php } ?>
												</table>
											<?php } ?>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<!-- Promotion -->
						<div class="row mb-50">
							<div class="col-md-12">
								<div class="pull-left">
									<h4 style="line-height: .5; font-weight: bold;"> পদোন্নতি সংক্রান্ত তথ্য</h4>
								</div>
								<div class="pull-right">
									<a href="<?= base_url('trainee/edit_trainee_promotion/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<table class="tg2" width="100%">
									<tr>
										<td class="tg-khupCenter">প্রতিষ্ঠানের নাম</td>
										<td class="tg-khupCenter">পদোন্নতি প্রাপ্ত পদবী</td>
										<td class="tg-khupCenter">বেতনক্রম</td>
										<td class="tg-khupCenter">মন্তব্য</td>
									</tr>
									<?php
									if ($promotion != NULL) {
										foreach ($promotion as $row) {
									?>
											<tr>
												<td class="tg-ywa9" align="center"><?= $row->promo_org_name; ?></td>
												<td class="tg-ywa9" align="center"><?= $row->promo_desig_name; ?></td>
												<td class="tg-ywa9" align="center"><?= eng2bng($row->promo_salary_ratio); ?></td>
												<td class="tg-ywa9" align="center"><?= $row->promo_comments; ?></td>
											</tr>
									<?php
										}
									}
									?>
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
									<a href="<?= base_url('trainee/edit_trainee_education/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<table class="tg2" width="100%">
									<tr>
										<td class="tg-khupCenter">পরীক্ষার নাম</td>
										<td class="tg-khupCenter">বিষয়/বিভাগ</td>
										<td class="tg-khupCenter">পাশের সন</td>
										<td class="tg-khupCenter">বোর্ড / বিশ্ববিদ্যালয়</td>
									</tr>
									<?php
									if ($education != NULL) {
										foreach ($education as $row) {
									?>
											<tr>
												<td class="tg-ywa9" align="center"><?= $row->exam_name; ?></td>
												<td class="tg-ywa9" align="center"><?= $row->sub_name; ?></td>
												<td class="tg-ywa9" align="center"><?= eng2bng($row->edu_pass_year); ?></td>
												<td class="tg-ywa9" align="center"><?= $row->board_name; ?></td>
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
									<a href="<?= base_url('trainee/edit_nilg_training/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
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
											<td class="tg-ywa9" align="center"><?= $row->participant_name . ' এর ' . $row->course_title; ?></td>
											<td class="tg-ywa9" align="center"><?= $row->desig_name; ?></td>
											<td class="tg-ywa9" align="center"><?= eng2bng($row->batch_no); ?></td>
											<td class="tg-ywa9" align="center"><?= func_training_date_from_to($row->start_date, $row->end_date); ?></td>
											<td class="tg-ywa9" align="center"><?= func_training_duration($row->start_date, $row->end_date); ?></td>
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
									<a href="<?= base_url('trainee/edit_local_training/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
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
											<td class="tg-ywa9" align="center"><?= $row->local_course_name; ?></td>
											<td class="tg-ywa9" align="center"><?= $row->local_training_org_name_adds; ?></td>
											<td class="tg-ywa9" align="center"><?= func_training_date_from_to($row->local_training_start, $row->local_training_end); ?></td>
											<td class="tg-ywa9" align="center"><?= func_training_duration($row->local_training_start, $row->local_training_end); ?></td>
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
									<a href="<?= base_url('trainee/edit_forien_training/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
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
											<td class="tg-ywa9" align="center"><?= $row->foreign_course_name; ?></td>
											<td class="tg-ywa9" align="center"><?= $row->foreign_training_org_name_adds; ?></td>
											<td class="tg-ywa9" align="center"><?= func_training_date_from_to($row->foreign_training_start, $row->foreign_training_end); ?></td>
											<td class="tg-ywa9" align="center"><?= func_training_duration($row->foreign_training_start, $row->foreign_training_end); ?></td>
										</tr>
									<?php
									}
									?>
								</table>
							</div>
						</div>

					</div> <!-- END GRID BODY -->
				</div> <!-- END GRID -->
			</div>

		</div> <!-- END ROW -->
	</div>
</div>