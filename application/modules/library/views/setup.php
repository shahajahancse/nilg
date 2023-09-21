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

<FIELDSET style="width:93%">
<LEGEND style="color:#FF8080; font-size:18px"><b>Setup</b></LEGEND>

<a href="<?php echo base_url(); ?>index.php/setup_con/book_set"><input type="button" value="Book" name="button" class="button" /></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>index.php/setup_con/journal_set"><input type="button" value="Journal" name="button" class="button" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>index.php/setup_con/gov_pub_set"><input type="button" value="Gov. Publication" name="button"  class="button" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>index.php/setup_con/report_set"><input type="button" value="Report" name="button"  class="button" /></a>
<!--<input type="image" src='<?php echo base_url();?>img/library_button/book_setup.png' alt="Book_Setup" width="100" height="30"/>
<input type="image" src='<?php echo base_url();?>img/library_button/journal_setup.png' alt="Journal Setup" width="100" height="30"/>
<input type="image" src='<?php echo base_url();?>img/library_button//thesis.png' alt="Thesis Setup" width="100" height="30"/>-->

</FIELDSET>
<div id="config" style="width:95%; margin:5px" >
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