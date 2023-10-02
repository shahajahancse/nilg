


<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />
<?php if (!empty($css_files)) {
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; } ?>


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
			</div>

			<div class="grid-body">
				<div style=" padding:15px; margin-top:10px;border-radius:7px; border:2px solid #0960B0;">
				  <div style="font-size:25px; font-weight:bold; text-align:center">Call No.  Generate </div><br />

					<form  name='callno_form' target="_blank" method="post" action="<?php echo base_url(); ?>library/setup_con/callno_generate" >
						<div class="col-md-4">						
							<div class="form-group">
								<label for="first_name">Enter Text:</label>
								<input type="text" name="call_text" value="<?php if(isset($call_text)){echo $call_text;}  ?>" id="call_text" required placeholder="Type Text" class="form-control" />
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="last_name">Enter No:</label>
								<input type="text" name="call_no" value="<?php if(isset($call_no)){echo $call_no;}  ?>" id="call_no" required placeholder="Type Number" class="form-control" />
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="last_name">Print Quantity:</label>
								<input type="text" name="print_qty" value="<?php if(isset($print_qty)){echo $print_qty;}  ?>" id="acc_last" required placeholder="Type Quantity" class="form-control" />
							</div>
						</div>

						<input type="submit"  name="callno_gen"  style="width:150px;" value="Generate Call No."  class="button">

					</form >
				</div>
			</div>
		</div>
  </div> <!-- END ROW -->
</div>



<?php if (!empty($css_files)) {
	foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
<?php endforeach;} ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dynamic.js"></script>
