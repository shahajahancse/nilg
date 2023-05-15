<div class="page-content">
	<div class="content">
		<ul class="breadcrumb pull-left" style="margin-bottom: 20px;">
			<li> <a href="<?=base_url('dashboard')?>" class="active"> <?=lang('common_dashboard')?> </a> </li>
			<li> <a href="<?=base_url('my_profile')?>" class="active"> <?=$module_title; ?> </a></li>
			<!-- <li><?=$meta_title; ?></li> -->
		</ul>
		<div class="pull-right">
			<!-- <a href="#" class="btn btn-success btn-xs btn-mini"> ডাউনলোড প্রোফাইল </a> -->
			<!-- <a href="<?=base_url('dashboard/edit_trainee_general_info')?>" class="btn btn-blueviolet btn-xs btn-mini"> ছবি পরিবর্তন করুন </a>			 -->
		</div>		
		<hr style="clear: both;margin:-5px auto 20px auto;">

		<div class="row">  
			<div class="col-md-12">
				<?php /*
				<h3  style="margin-top: 0;">স্বাগতম, এনআইএলজি (ইআরপি) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h3>
				<hr style="margin:10px auto 20px auto;">
				
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

				<div class="row">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 style="line-height: .5; font-weight: bold;"> ব্যাক্তিগত বা সাধারণ তথ্য </h4>
						</div>
						<div class="pull-right">
							<!-- <a href="<?=base_url('my_profile/edit_trainer_general_info')?>" class="btn btn-blueviolet btn-xs btn-mini"> সংশোধন করুন </a> -->
						</div>
						<table class="tg" width="100%">     
							<tr>
								<td class="tg-khup">নামঃ (বাংলা)</td>
								<td class="tg-ywa9"><?=$info->name_bn?></td>
								<td class="tg-khup">নামঃ (ইংরেজি)</td>
								<td class="tg-ywa9"><?=$info->name_en?></td>			
								<td class="tg-ywa9" rowspan="6" style="width: 160px;">
									<?php
									if($info->profile_img != NULL){
										$url = base_url('uploads/profile/').$info->profile_img;
									}else{
										$url = base_url('uploads/profile/blank.png');
									}
									?>
									<img src="<?=$url?>" width="150">
								</td>					
							</tr>
							<tr>
								<td class="tg-khup">বর্তমান অফিস/প্রতিষ্ঠান</td>
								<td class="tg-ywa9"><?=$info->office_name?></td>
								<td class="tg-khup">পদবি</td>
								<td class="tg-ywa9"><?=$info->designation?></td>
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
								<td class="tg-khup">বর্তমান ঠিকানা</td>
								<td class="tg-ywa9"><?=$info->present_add?></td>
								<td class="tg-khup">আগ্রহী বিষয়</td>
								<td class="tg-ywa9"><?=$info->interested_subjects?></td>
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

			</div>
		</div>
	</div>
</div>