<div class="page-content">
	<div class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="grid simple horizontal red">
					<div class="grid-title">
						<h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
						<div class="pull-right">
							<!-- <a href="<?= base_url('trainee/all_pr') ?>" class="btn btn-primary btn-xs btn-mini"> জনপ্রতিনিধির তালিকা </a> -->
						</div>
					</div>
					<div class="grid-body table-responsive">
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
									<!-- <a href="#" id="generalInfo" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs btn-mini" data-backdrop="true" data-id="<?php echo $info->id; ?>"> সম্পাদনা করুন </a> -->
								</div>
								<div class="pull-right">
									<a href="<?= base_url('my_profile/edit_trainee_general_info/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<table class="tg" width="100%">
									<tr>
										<td class="tg-khups">নামঃ (বাংলা)</td>
										<td class="tg-ywa9"><?= $info->name_bn ?></td>
										<td class="tg-khups">এনআইডি নম্বরঃ</td>
										<td class="tg-ywa9"><?= $info->nid ?></td>
										<td class="tg-ywa9" rowspan="12" style="width: 160px;">
											<?php
											if ($info->profile_img != NULL) {
												$url = base_url('uploads/profile/') . $info->profile_img;
											} else {
												$url = base_url('uploads/profile/blank.png');
											}
											?>
											<img src="<?= $url ?>" width="150">
											<div align="center"><span class='label label-success'><?=$info->status_name ?></span></div>
										</td>
									</tr>
									<tr>
										<td class="tg-khups">নামঃ (ইংরেজি)</td>
										<td class="tg-ywa9"><?= $info->name_en ?></td>
										<td class="tg-khups">মোবাইল নম্বরঃ</td>
										<td class="tg-ywa9"><?= $info->mobile_no ?></td>
										<!-- <td class="tg-ywa9"></td> -->
									</tr>
									<tr>
										<td class="tg-khups">পিতার নামঃ</td>
										<td class="tg-ywa9"><?= $info->father_name ?></td>
										<td class="tg-khups">ই-মেইল অ্যাড্রেসঃ</td>
										<td class="tg-ywa9" rowspan="1"><?= $info->email ?></td>
									</tr>
									<tr>
										<td class="tg-khups">মাতার নামঃ</td>
										<td class="tg-ywa9"><?= $info->mother_name ?></td>
										<td class="tg-khups">বর্তমান ঠিকানাঃ</td>
										<td class="tg-ywa9"><?= $info->present_add ?></td>
									</tr>
									<tr>
										<td class="tg-khups">জন্ম তারিখঃ</td>
										<td class="tg-ywa9"><?= $info->dob ?></td>
										<td class="tg-khups text-center" colspan="2">স্থায়ী ঠিকানার বিবরণঃ</td>
									</tr>
									<tr>
										<td class="tg-khups">লিঙ্গঃ</td>
										<td class="tg-ywa9"><?= func_gender($info->gender) ?></td>
										<td class="tg-khups">বিভাগঃ</td>
										<td class="tg-ywa9"><?= $info->per_div_bn ?></td>
									</tr>
									<tr>
										<td class="tg-khups">বৈবাহিক অবস্থাঃ</td>
										<td class="tg-ywa9"><?= $info->marital_status_name ?></td>
										<td class="tg-khups">জেলাঃ</td>
										<td class="tg-ywa9"><?= $info->per_dis_bn ?></td>
									</tr>
									<tr>
										<td class="tg-khups">ছেলে সন্তানঃ</td>
										<td class="tg-ywa9"><?= eng2bng($info->son_no) ?></td>
										<td class="tg-khups">উপজেলা/থানাঃ</td>
										<td class="tg-ywa9"><?= $info->per_upa_bn ?></td>
									</tr>
									<tr>
										<td class="tg-khups">মেয়ে সন্তানঃ</td>
										<td class="tg-ywa9"><?= eng2bng($info->daughter_no) ?></td>
										<td class="tg-khups">পোষ্ট অফিস (কোড)ঃ</td>
										<td class="tg-ywa9"><?= $info->per_po . ' (' . $info->per_pc . ')'; ?></td>
									</tr>
									<tr>
										<td class="tg-khups">ক্রিয়েটেড ডেটঃ</td>
										<td class="tg-ywa9"><?= date('d F, Y', $info->created_on); ?></td>
										<td class="tg-khups">গ্রাম/ওয়ার্ড/ইউনিয়নঃ</td>
										<td class="tg-ywa9"><?= $info->per_road_no ?></td>
									</tr>
									<tr>
										<td class="tg-khups">ধর্মঃ</td>
										<td class="tg-ywa9">
											<?php if ($info->religion_name) {
												echo $info->religion_name;
											} ?>
										</td>
										<td class="tg-khups">বাড়ির নাম / নম্বরঃ</td>
										<td class="tg-ywa9"><?= $info->permanent_add; ?></td>
									</tr>
									<tr>
										<td class="tg-khups">মুক্তিযোদ্ধা কোটা</td>
										<td class="tg-ywa9">
											<?php if ($info->quota_name) {
												echo $info->quota_name;
											} ?>
										</td>
										<td class="tg-khups">জন্ম স্থানঃ</td>
										<td class="tg-ywa9"><?= $info->birth_place; ?></td>
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
									<a href="<?= base_url('my_profile/edit_trainee_pr_official/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<table class="tg" width="100%">
									<tr>
										<td class="tg-khups">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ</td>
										<td class="tg-ywa9"><?= $info->current_office_name?></td>
										<td class="tg-khups">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ</td>
										<td class="tg-ywa9"><?= $info->first_office_name ?></td>
									</tr>
									<tr>
										<td class="tg-khups">বর্তমান নির্বাচিত পদের নামঃ</td>
										<td class="tg-ywa9"><?= $info->current_desig_name ?></td>
										<td class="tg-khups">প্রথম নির্বাচিত পদের নামঃ</td>
										<td class="tg-ywa9"><?= $info->first_desig_name ?></td>
									</tr>
									<tr>
										<td class="tg-khups">
											বর্তমান নির্বাচনের সালঃ<br>
											বর্তমান সভায় যোগদানের তারিখঃ
										</td>
										<td class="tg-ywa9">
											সাল - <?= eng2bng($info->crrnt_elected_year) ?><br>
											সভার তারিখ - <?= date_bangla_calender_format($info->crrnt_attend_date) ?>
										</td>
										<td class="tg-khups">
											প্রথম নির্বাচনের সালঃ<br>
											প্রথম সভায় যোগদানের তারিখঃ
										</td>
										<td class="tg-ywa9">
											সাল - <?= eng2bng($info->first_elected_year) ?><br>
											সভার তারিখ - <?= date_bangla_calender_format($info->first_attend_date) ?>
										</td>
									</tr>
									<tr>
										<td class="tg-khups" colspan="2">এ যাবত কতবার নির্বাচিত হয়েছেন?</td>
										<td class="tg-ywa9" colspan="2"><?= eng2bng($info->elected_times) ?></td>
										<!-- <td class="tg-khups"></td> -->
										<!-- <td class="tg-ywa9"></td> -->
									</tr>
									<tr>
										<td class="tg-khups">ইতিপূর্ব নির্বাচনের বিবরণ</td>
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
															<td align="center"><?= $exp->office_name; ?></td>
															<td align="center"><?= $exp->desig_name; ?></td>
															<td align="center"><?= eng2bng($exp->exp_duration); ?></td>
														</tr>
													<?php } ?>
												</table>
											<?php } ?>
										</td>
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
									<a href="<?= base_url('my_profile/edit_trainee_education/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<style type="text/css">
									.tg2 td {
										text-align: center;
									}
								</style>
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
												<td class="tg-ywa9"><?= $row->exam_name; ?></td>
												<td class="tg-ywa9"><?= $row->sub_name; ?></td>
												<td class="tg-ywa9"><?= eng2bng($row->edu_pass_year); ?></td>
												<td class="tg-ywa9"><?= $row->board_name; ?></td>
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
									<a href="<?= base_url('my_profile/edit_nilg_training/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
								</div>

								<table class="tg2" width="100%">
									<tr>
										<td class="tg-khupCenter">কোর্সের নাম</td>
										<td class="tg-khupCenter">প্রশিক্ষণে অংশগ্রহণকালিন সময়ে পদবী</td>
										<td class="tg-khupCenter">ব্যাচ নং</td>
										<td class="tg-khupCenter">সময়কাল</td>
										<td class="tg-khupCenter">মেয়াদ</td>
									</tr>
									<?php foreach ($nilg_training as $row) { ?>
									<tr> 
										<td class="tg-ywa9" align="center"><?=$row->participant_name .' এর '. $row->course_title;?></td>
										<td class="tg-ywa9" align="center"><?=$row->desig_name;?></td>
										<td class="tg-ywa9" align="center"><?=eng2bng($row->batch_no);?></td>
										<td class="tg-ywa9" align="center"><?=func_training_date_from_to($row->start_date, $row->end_date);?></td>
										<td class="tg-ywa9" align="center"><?=func_training_duration($row->start_date, $row->end_date);?></td>
									</tr>
									<?php } ?>
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
									<a href="<?= base_url('my_profile/edit_local_training/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
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
											<td class="tg-ywa9"><?= $row->local_course_name; ?></td>
											<td class="tg-ywa9"><?= $row->local_training_org_name_adds; ?></td>
											<td class="tg-ywa9"><?= func_training_date_from_to($row->local_training_start, $row->local_training_end); ?></td>
											<td class="tg-ywa9"><?= func_training_duration($row->local_training_start, $row->local_training_end); ?></td>
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
									<a href="<?= base_url('my_profile/edit_forien_training/' . encrypt_url($info->id)) ?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
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
											<td class="tg-ywa9"><?= $row->foreign_course_name; ?></td>
											<td class="tg-ywa9"><?= $row->foreign_training_org_name_adds; ?></td>
											<td class="tg-ywa9"><?= func_training_date_from_to($row->foreign_training_start, $row->foreign_training_end); ?></td>
											<td class="tg-ywa9"><?= func_training_duration($row->foreign_training_start, $row->foreign_training_end); ?></td>
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

<style type="text/css">
	.close,
	.close:hover,
	.close:focus {
		color: #dd0b0b !important;
		opacity: 2 !important;
		margin: 2px 10px !important;
	}
</style>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title semi-bold"> Modal Header </h3>
			</div>

			<form method="post" id="validate_personal">
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('common_close') ?></button>
					<input type="submit" class="btn btn-primary" value="Submit">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
	// Question Set Answer Modal
	$("#generalInfo").click(function() {
		var id = $(this).attr("data-id");
		// alert(id);
		$.ajax({
			type: "GET",
			url: hostname + "trainee/ajax_question_by_id/" + id,
		}).done(function(response) {
			$(".modal-title").html('ব্যাক্তিগত বা সাধারণ তথ্য সম্পাদনা করুন');
			$(".modal-body").html(response);
			//update data
			$(".answerUpdate").submit(function() {
				// alert(id);
				$.ajax({
					type: "POST",
					url: hostname + "trainee/ajax_general_Info/" + id,
					data: $(this).serialize(),
					dataType: 'json',
					success: function(response) {
						// alert(response);
						if (response.status == 1) {
							$('.alert').addClass('alert-success').html(response.msg).show();
							window.location = "<?php echo base_url(); ?>qbank";
						} else {
							$('.alert').addClass('alert-red').html(response.msg).show();
						}
					}
				});
				return false;
			});
		});
	});
</script>
