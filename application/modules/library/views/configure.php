
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />
<?php if (!empty($css_files)) {
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; } ?>
<style type='text/css'>
	a {
	    text-decoration: none;
	    font-size: 14px;
	}
	a:hover{
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

	<div class="grid simple horizontal red">
		<div class="grid-title">
		<h4><span class="semi-bold">বই অনুসন্ধান</span></h4>
		</div>
		<div class="grid-body tableresponsive">
			<FIELDSET style="width:76%">
				<LEGEND style="color:#FF8080; font-size:18px"><b>Configure</b></LEGEND>
					<table>
						<tr>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>library/setup_con/source_set"><input type="button" value="Source" name="button" class="button" /></a></td>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>library/setup_con/edt_set"><input type="button" value="Edition" name="button" class="button" /></a></td>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>library/setup_con/designation_set"><input type="button" value="Designation" name="button" class="button"  /></a></td>
						</tr>
						<tr>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>library/setup_con/place_set"><input type="button" value="Place" name="button" class="button" /></a></td>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>library/setup_con/year_set"><input type="button" value="Year" name="button" class="button" /></a></td>
							<td style="width:20%;"><a href="<?php echo base_url(); ?>library/setup_con/member_type"><input type="button" value="Member Type" name="button" class="button"  /></a></td>
						</tr>
					</table>
			</FIELDSET>
			<div id="config" style="width:78%; margin:5px" >
				<?php if(isset($output)) { echo $output;  } ?>
			</div>
		</div>
    </div>
  </div> <!-- END ROW -->
</div>


<?php if (!empty($css_files)) {
	foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
<?php endforeach;} ?>