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
</head>
<body class="body_back">


<div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">

<FIELDSET style="width:68%">
<LEGEND style="color:#FF8080; font-size:18px"><b>Library Log</b></LEGEND>

<a href="<?php echo base_url(); ?>index.php/log_con/member_log"><input type="button" class="button" value="Member"/></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>index.php/log_con/visitor_log"><input type="button" class="button" value="Visitor"/></a>


</FIELDSET>
<div id="config" style="width:70%; margin:5px" >
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