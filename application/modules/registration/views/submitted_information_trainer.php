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
		<div class="alert alert-block alert-danger fade in">        
			<a class="close" data-dismiss="alert"></a>
			<h5 class="alert-heading" style="line-height: 20px;"><i class="icon-warning-sign"></i> ধন্যবাদ, আপনার প্রাথমিক রেজিস্ট্রেশন প্রক্রিয়া সম্পন্ন হয়েছে। অনুগ্রহপূর্বক আপনার অ্যাকাউন্টটি যাচাইয়ের জন্য অপেক্ষা করুন।</h5>
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
							<div class="col-md-12">
								<table class="tg" width="100%">     
									<tr>
										<td class="tg-khup">নামঃ (বাংলা)</td>
										<td class="tg-ywa9"><?=$info->name_bn?></td>
										<td class="tg-khup">নামঃ (ইংরেজি)</td>
										<td class="tg-ywa9"><?=$info->name_en?></td>							
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

					</div>  <!-- END GRID BODY -->              
				</div> <!-- END GRID -->
			</div>

		</div> <!-- END ROW -->
	</div>
</div>