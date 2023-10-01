<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<style type='text/css'>
	a {
	    color: blue;
	    text-decoration: none;
	    font-size: 14px;
	}
	a:hover
	{
		text-decoration: none;
	}
</style>


<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<div class="grid simple horizontal">
			<div class="grid-title">
				<h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
			</div>
			<div class="grid-body">
				<FIELDSET style="width:93%">
					<LEGEND style="color:#FF8080; font-size:18px"><b>Setup</b></LEGEND>
					<a href="<?php echo base_url(); ?>library/setup_con/book_set"><input type="button" value="Book" name="button" class="button" /></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo base_url(); ?>library/setup_con/journal_set"><input type="button" value="Journal" name="button" class="button" /></a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo base_url(); ?>library/setup_con/gov_pub_set"><input type="button" value="Gov. Publication" name="button"  class="button" /></a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo base_url(); ?>library/setup_con/report_set"><input type="button" value="Report" name="button"  class="button" /></a>
				</FIELDSET>
				<div id="config" style="width:95%; margin:5px" >
					<?php  if(isset($output)) { echo $output; } ?>
				</div>
			</div>
    </div>

  </div> <!-- END ROW -->
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dynamic.js"></script>