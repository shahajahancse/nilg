<div class="page-content">
	<div class="content">
		<div class="row">  
			<div class="col-md-12">
				<h3 style="margin-top: 0;">স্বাগতম, এনআইএলজি (ইআরপি) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h3>
				<hr style="margin:10px auto 20px auto;">
				<?php /*
				<div class="alert alert-block alert-danger fade in">        
					<h4 class="alert-heading"><i class="icon-warning-sign"></i> আপনার রেজিস্ট্রেশন কৃত অ্যাকাউন্টটি এখনো যাচাই করা হয়নি। অনুগ্রহপূর্বক স্টার (*) মার্ক যুক্ত ফিল্ডগুলো পূরণ করে সাবমিট বাটনে ক্লিক করুন।</h4>
					<p> যেকোন সমস্যার জন্য এই নম্বরে যোগাযোগ করুন 01XXXXXXXX</p>
					<!-- <div class="button-set">
						<a class="btn btn-white btn-cons" href="<?=base_url('my-submitted-information');?>">My submitted information</a>
					</div> -->
				</div>
				*/ ?>

				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>
				<?php /*
				<!-- Personal Information -->
				<div class="row mb-50">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 style="line-height: .5; font-weight: bold;"> ব্যাক্তিগত বা সাধারণ তথ্য </h4>
						</div>
						<div class="pull-right">
							<a href="<?=base_url('dashboard/edit_trainee_general_info')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
						</div>

						<table class="tg" width="100%">     
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
					</div>          
				</div>


				<!-- Offical Information -->
				<div class="row mb-50">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 style="line-height: .5; font-weight: bold;"> অফিসিয়াল বা দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য </h4>
						</div>
						<div class="pull-right">
							<a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
						</div>

						<table class="tg" width="100%">     
							<tr>
								<td class="tg-khup">প্রথম চাকুরীতে যোগদানকৃত প্রতিষ্ঠান</td>
								<td class="tg-ywa9"><?=$info->first_office_name?></td>
								<td class="tg-khup">বর্তমান চাকুরীতে যোগদানকৃত প্রতিষ্ঠান</td>
								<td class="tg-ywa9"><?=$info->current_office_name?></td>							
							</tr>
							<tr>
								<td class="tg-khup">প্রথম চাকুরীতে যোগদানকৃত পদঃ</td>
								<td class="tg-ywa9"><?=$info->first_desig_name?></td>
								<td class="tg-khup">বর্তমান চাকুরীতে দায়িত্বপ্রাপ্ত পদঃ</td>
								<td class="tg-ywa9"><?=$info->current_desig_name?></td>
							</tr>
							<tr>
								<td class="tg-khup">প্রথম চাকুরীতে যোগদানের তারিখঃ</td>
								<td class="tg-ywa9"><?=date_bangla_calender_format($info->first_attend_date)?></td>
								<td class="tg-khup">বর্তমান চাকুরীতে যোগদানের তারিখঃ</td>
								<td class="tg-ywa9"><?=date_bangla_calender_format($info->crrnt_attend_date)?></td>
							</tr>
							<tr>
								<td class="tg-khup">চাকুরী স্থায়ী করনের তারিখঃ</td>
								<td class="tg-ywa9"><?=date_bangla_calender_format($info->job_per_date)?></td>
								<td class="tg-khup">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখঃ</td>
								<td class="tg-ywa9"><?=date_bangla_calender_format($info->prl_date)?></td>
							</tr>
							<tr>
								<td class="tg-khup">অবসর গ্রহণের তারিখঃ</td>
								<td class="tg-ywa9"><?=date_bangla_calender_format($info->retirement_date);?></td>
								<td class="tg-khup"></td>
								<td class="tg-ywa9"></td>
							</tr>               
						</table>
					</div>          
				</div>

				<!-- Experience -->
				<div class="row mb-50">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 style="line-height: .5; font-weight: bold;"> ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণ </h4>
						</div>
						<div class="pull-right">
							<a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
						</div>

						<table class="tg" width="100%">
							<tr> 
								<td class="tg-khupCenter">প্রতিষ্ঠানের নাম</td>
								<td class="tg-khupCenter">পদের নাম</td>
								<td class="tg-khupCenter">মেয়াদকাল</td>
							</tr>
							<?php
							if($experience != NULL){
								foreach ($experience as $row) { 
									?>
									<tr> 
										<td class="tg-ywa9"><?=$row->exp_org_name;?></td>
										<td class="tg-ywa9"><?=$row->exp_desig_name;?></td>
										<td class="tg-ywa9"><?=$row->exp_duration;?></td>
									</tr>									
									<?php 
								}
							} 
							?>
						</table>
					</div>
				</div>

				<!-- Promotion -->
				<div class="row mb-50">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 style="line-height: .5; font-weight: bold;"> পদোন্নতি সংক্রান্ত তথ্যাদি</h4>
						</div>
						<div class="pull-right">
							<a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
						</div>

						<table class="tg" width="100%">
							<tr> 
								<td class="tg-khupCenter">প্রতিষ্ঠানের নাম</td>
								<td class="tg-khupCenter">পদোন্নতি প্রাপ্ত পদবী</td>
								<td class="tg-khupCenter">বেতনক্রম</td>
								<td class="tg-khupCenter">মন্তব্য</td>
							</tr>
							<?php
							if($promotion != NULL){
								foreach ($promotion as $row) { 
									?>
									<tr> 
										<td class="tg-ywa9"><?=$row->promo_org_name;?></td>
										<td class="tg-ywa9"><?=$row->pro_desig_name;?></td>
										<td class="tg-ywa9"><?=eng2bng($row->promo_salary_ratio);?></td>
										<td class="tg-ywa9"><?=$row->promo_comments;?></td>
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
							<a href="<?=base_url('#')?>" class="btn btn-blueviolet btn-xs btn-mini"> সম্পাদন করুন </a>
						</div>

						<table class="tg" width="100%">
							<tr> 
								<td class="tg-khupCenter">পরীক্ষার নাম</td>
								<td class="tg-khupCenter">বিষয়</td>
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

				*/ ?>


			</div>
		</div>
	</div>
</div>