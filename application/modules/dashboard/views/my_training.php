
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  right: 100%;
  margin-top: 30px;
}

.open>.dropdown-menu {
	display: block !important;
	left: -85px !important;
}
</style>



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

					<div class="grid-body">
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
											  <div class="dropdown" class="btn-group pull-right">
												<a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="dropdown"> অ্যাকশন <span class="caret"></span> </a>
												<ul class="dropdown-menu">
													<li><?=anchor("dashboard/my_training_schedule/".encrypt_url($row->training_id), 'প্রশিক্ষণ কর্মসূচী')?></li>
													<?php 
													if($row->handbook != null && $row->handbook !=''){
										                if (is_array(json_decode($row->handbook))) { ?>
													      	<li class="dropdown-submenu">
													        	<a class="test" tabindex="-1" href="#">ট্রেনিং হ্যান্ডবুক ডাউনলোড  <span class="caret"></span></a>
														        <ul class="dropdown-menu">
															    	<?php  
															    	foreach (json_decode($row->handbook) as $key => $row):
															    	$path = base_url('uploads/handbook/'.$row);
										                          	echo '<li><a href="'.$path.'" target="_blank" class="btn btn-primary btn-xs btn-mini">ফাইল   '.eng2bng($key + 1).'</a></li>'; 
																	endforeach; ?>
														        </ul>
													      	</li>

										                <?php } else {
										                  $path = base_url('uploads/handbook/'.$row->handbook);
										                  echo '<li><a href="'.$path.'" target="_blank" class="btn btn-primary btn-xs btn-mini">ট্রেনিং হ্যান্ডবুক ডাউনলোড </a></li>';
										                } 
										            } ?>
											    </ul>
											  </div>	
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

<script>
	$(document).ready(function(){
	  $('.dropdown-submenu a.test').on("click", function(e){
	    $(this).next('ul').toggle();
	    e.stopPropagation();
	    e.preventDefault();
	  });
	});
</script>