
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    
	<div style="width:70%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">
		<fieldset style='width:70%; margin:0 auto'><legend><font size='3'><b>Full Database Backup</b></font></legend><br>
			<a href="<?php echo base_url(); ?>index.php/maintenance_con/database_backup" style="text-decoration:none" ><input type='button' name='db_bk' value='Backup' class="button"/></a>
		</fieldset>
	</div>

  </div> <!-- END ROW -->
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dynamic.js"></script>
