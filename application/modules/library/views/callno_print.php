
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<div class="grid simple horizontal">
			<div class="grid-title">
				<h4><span class="semi-bold"><?=$meta_title; ?> </span></h4>
				<span id="print" class="pull-right btn btn-primary btn-mini" onclick="printDiv()">Print</span>
			</div>

			<div class="grid-body" id="printableArea">
				<?php for($i = 1; $i <= $print_qty; $i++) {?>
					<div style="font-size:18px; padding:15px; float:left; border:1px solid #000000; width:200px; text-align:center; font-weight:bold;">
						<div style="width:100%;"><?php echo $call_no; ?></div>
						<div style="width:100%; text-align:center;"><?php echo $call_text; ?></div>
					</div>
				<?php } ?>
				<div style="clear: both;"></div>
			</div>
  	</div> 
  </div><!-- END ROW -->
</div>



