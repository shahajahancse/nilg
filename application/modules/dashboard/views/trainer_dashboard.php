<div class="page-content">
	<div class="content">
		<div class="row">  
			<div class="col-md-12">
				<h3  style="margin-top: 0;">স্বাগতম, এনআইএলজি (ইআরপি) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h3>
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
				<div class="row">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 style="line-height: .5; font-weight: bold;"> ব্যাক্তিগত বা সাধারণ তথ্য </h4>
						</div>
						<div class="pull-right">
							<a href="<?=base_url('dashboard/edit_trainer_general_info')?>" class="btn btn-blueviolet btn-xs btn-mini"> সংশোধন করুন </a>
						</div>
						<table class="tg" width="100%">     
							<tr>
								<td class="tg-khup">নামঃ (বাংলা)</td>
								<td class="tg-ywa9"><?=$info->name_bn?></td>
								<td class="tg-khup">নামঃ (ইংরেজি)</td>
								<td class="tg-ywa9"><?=$info->name_en?></td>							
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
				*/ ?>
	

			</div>
		</div>
	</div>
</div>