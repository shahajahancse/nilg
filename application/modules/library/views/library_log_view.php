<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<style type='text/css'>
	body
	{
		font-family: Arial;
		font-size: 14px;
	}
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

	<div style="width:70%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">
		<div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">
			<FIELDSET style="width:68%">
				<LEGEND style="color:#FF8080; font-size:18px"><b>Library Log</b></LEGEND>
				<a href="<?php echo base_url(); ?>index.php/log_con/member_log"><input type="button" class="button" value="Member"/></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo base_url(); ?>index.php/log_con/visitor_log"><input type="button" class="button" value="Visitor"/></a>
			</FIELDSET>
			<div id="config" style="width:70%; margin:5px" >
				<?php if(isset($output)) { echo $output; } ?>
			</div>
		</div>
	</div>
  </div> <!-- END ROW -->
</div>