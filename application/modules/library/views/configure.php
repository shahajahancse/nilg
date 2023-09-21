<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
<?php if(isset($output)){
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach;} ?>
<style type='text/css'>
a {
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: none;
}

</style>

</head>
<body class="body_back">


<div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">

<FIELDSET style="width:76%">
<LEGEND style="color:#FF8080; font-size:18px"><b>Configure</b></LEGEND>
<table>
<tr>
<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/setup_con/source_set"><input type="button" value="Source" name="button" class="button" /></a></td>
<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/setup_con/edt_set"><input type="button" value="Edition" name="button" class="button" /></a></td>
<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/setup_con/designation_set"><input type="button" value="Designation" name="button" class="button"  /></a></td>
<tr>
<tr>
<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/setup_con/place_set"><input type="button" value="Place" name="button" class="button" /></a></td>
<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/setup_con/year_set"><input type="button" value="Year" name="button" class="button" /></a></td>
<td style="width:20%;"><a href="<?php echo base_url(); ?>index.php/setup_con/member_type"><input type="button" value="Member Type" name="button" class="button"  /></a></td>
<tr>
</table>
</FIELDSET>
<div id="config" style="width:78%; margin:5px" >
<?php 
if(isset($output))
{
 echo $output; 
 }
?>
</div>

</div>

</body>
</html>