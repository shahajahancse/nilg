<div class="page-content">     
	<div class="content">  
		<div class="row">
			<div class="col-md-12">
				<h1>স্বাগতম, এনআইএলজি (ইআরপি) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h1>
			</div>
		</div>

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
		<div class="alert alert-block alert-success fade in" style="margin:10px auto;">        
			<!-- <a class="close" data-dismiss="alert"></a> -->
			<h4 class="" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> ধন্যবাদ, আপনার রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে। </h4>
		</div>
		<?php  }else { ?>

		<div class="alert alert-block alert-danger fade in" style="margin:10px auto;">        
			<!-- <a class="close" data-dismiss="alert"></a> -->
			<h4 class="alert-heading" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> ধন্যবাদ, আপনার প্রাথমিক রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে। অনুগ্রহপূর্বক আপনার অ্যাকাউন্টটি যাচাইয়ের জন্য অপেক্ষা করুন।</h4>
		</div>

		<?php } ?>

		<div class="alert alert-block alert-info fade in" style="margin-top:0px; margin-bottom: 15px;">        
			<h4 class="alert-heading" style="line-height: 20px;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> কোর্স রেজিস্ট্রেশন করার জন্য এই লিংকে ক্লিক করুন <a href="<?=base_url('dashboard/course_registration')?>" class="btn btn-danger btn-sm btn-small">কোর্স রেজিস্ট্রেশন</a></h4>
		</div>

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
										<td class="tg-khup">অফিসের ধরণঃ</td>
										<td class="tg-ywa9"><?=$info->office_type_name?></td>
									</tr>
									<tr>
										<td class="tg-khup">এনআইডি নম্বরঃ</td>
										<td class="tg-ywa9 font-opensans"><?=$info->nid?></td>
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
										<td class="tg-ywa9 font-opensans"><?=$info->mobile_no?></td>
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
										<td class="tg-ywa9 font-opensans"><?=date('d F, Y h:i A', $info->created_on);?></td>
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