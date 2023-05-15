<div class="page-content">     
	<div class="content">
		<ul class="breadcrumb" style="margin-bottom: 20px;">
			<li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
			<li><?=$meta_title?> </li>
		</ul>

		<div class="row">
			<div class="col-md-12">
				<div class="grid simple horizontal green">
					<div class="grid-title">
						<h4><span class="semi-bold"><?=$meta_title; ?></span></h4>						
					</div>

					<div class="grid-body ">
						<div id="infoMessage"><?php //echo $message;?></div>   
						<?php if($this->session->flashdata('success')):?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success');;?>
							</div>
						<?php endif; ?> 

						<table class="table table-hover table-bordered  table-flip-scroll cf">
							<thead class="cf">
								<tr>
									<th>ক্রম</th>
									<th>প্রশিক্ষণের শিরোনাম </th>									
									<th>প্রশিক্ষণের সময়</th>
									<th width="80">অ্যাকশন</td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$sl = 0;
									foreach ($results as $row){
										$sl++;
										?>
										<tr>
											<td class="tg-ywa99"><?=eng2bng($sl).'.'?></td>
											<td class="tg-ywa99"><?=func_training_title($row->training_id)?></td>
											<td class="tg-ywa99"><?=date_bangla_calender_format($row->start_date)?> হতে <?=date_bangla_calender_format($row->end_date)?></td>
											<td class="tg-ywa99">
												<a href="<?=base_url('evaluation/my_training_topic_list/'.encrypt_url($row->training_id));?>" class="btn btn-blueviolet btn-mini">আলোচনার বিষয়</a>												
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>

						</div>
					</div>
				</div>

			</div> <!-- END ROW -->

		</div>
	</div>