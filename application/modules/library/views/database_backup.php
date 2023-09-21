<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
</head>
<body class="body_back">
<h3> <?php //  echo $output->title; ?> </h3>
<div style="width:950px; margin:0 auto;min-height:450px;">
<fieldset style='width:70%; margin:0 auto'><legend><font size='3'><b>Full Database Backup</b></font></legend><br>
<a href="<?php echo base_url(); ?>index.php/maintenance_con/database_backup" style="text-decoration:none" ><input type='button' name='db_bk' value='Backup' class="button"/></a>
</fieldset>


</div>
