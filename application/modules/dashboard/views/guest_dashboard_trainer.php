<div class="page-content">     
	<div class="content">  
		<div class="row">
			<div class="col-md-12">
				<h1>স্বাগতম, এনআইএলজি (ইআরপি) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h1>
			</div>
		</div>

		<?php /*
		<div class="alert alert-block alert-danger fade in" style="margin:30px auto;">        
			<!-- <a class="close" data-dismiss="alert"></a> -->
			<h4 class="alert-heading" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> ধন্যবাদ, আপনার প্রাথমিক রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে। অনুগ্রহপূর্বক আপনার অ্যাকাউন্টটি যাচাইয়ের জন্য অপেক্ষা করুন।</h4>
		</div>	?*/ ?>
		<?php

			// dd($info);
		 if($info->is_verify == 2){ ?> 

		<div class="alert alert-block alert-danger fade in" style="margin:30px auto;">        
			<!-- <a class="close" data-dismiss="alert"></a> -->
			<h4 class="alert-heading" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> দুঃখিত, আপনার আবেদনটি বাতিল করা হয়েছে।</h4>
		</div>

		<div class="alert alert-block alert-danger fade in" style="margin:30px auto;">        
			<!-- <a class="close" data-dismiss="alert"></a> -->
			<h4>কারণ</h4>
			<small class="alert-heading" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> <?= $info->decline_reason; ?></small>
		</div>
		<?php } else if ($info->is_verify == 1) {  ?>
			<div class="alert alert-block alert-success fade in" style="margin:30px auto;">        
				<!-- <a class="close" data-dismiss="alert"></a> -->
				<h4 class="" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> ধন্যবাদ, আপনার রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে। </h4>
			</div>
		<?php  }else { ?>

		<div class="alert alert-block alert-danger fade in" style="margin:30px auto;">        
			<!-- <a class="close" data-dismiss="alert"></a> -->
			<h4 class="alert-heading" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> ধন্যবাদ, আপনার প্রাথমিক রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে। অনুগ্রহপূর্বক আপনার অ্যাকাউন্টটি যাচাইয়ের জন্য অপেক্ষা করুন।</h4>
		</div>

		<?php } ?>


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
							<div class="col-md-12 table-responsive">
								
								<table class="tg" width="100%">     
									<tr>
										<td class="tg-khup">নামঃ</td>
										<td class="tg-ywa9"><?=$info->name_bn?></td>
										<td class="tg-khup">বর্তমান অফিস/প্রতিষ্ঠানঃ</td>
										<td class="tg-ywa9"><?=$info->office_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">এনআইডি নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->nid?></td>
										<td class="tg-khup">বর্তমান পদবিঃ</td>
										<td class="tg-ywa9"><?=$info->designation?></td>
									</tr>
									<tr>
										<td class="tg-khup">জন্ম তারিখঃ</td>
										<td class="tg-ywa9"><?=$info->dob?></td>
										<td class="tg-khup">সর্বোচ্চ শিক্ষাগত যোগ্যতাঃ</td>
										<td class="tg-ywa9"><?=$info->height_education?></td>
									</tr>
									<tr>
										<td class="tg-khup">মোবাইল নম্বরঃ</td>
										<td class="tg-ywa9"><?=$info->mobile_no?></td>
										<td class="tg-khup">যে সব বিষয় পড়াতে আগ্রহীঃ</td>
										<td class="tg-ywa9"><?=$info->interested_subjects?></td>
									</tr>
									<tr>
										<td class="tg-khup">ই-মেইল অ্যাড্রেসঃ</td>
										<td class="tg-ywa9"><?=$info->email?></td>										
										<td class="tg-khup">বর্তমান ঠিকানাঃ</td>
										<td class="tg-ywa9"><?=$info->present_add?></td>
									</tr>
									<tr>
										<td class="tg-khup">আবেদনের সময়ঃ</td>
										<td class="tg-ywa9"><?=date('d F, Y', $info->created_on);?></td>
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