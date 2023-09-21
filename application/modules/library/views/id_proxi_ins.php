<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSL Payroll</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
</head>

<body class="body_back">
<div style=" margin:0 auto; width:100%; height:auto; overflow:hidden;" id="soft_entry">
<h3 style="text-align:center;"> Advanced Library Management System </h3>
<h4 style="text-align:center;"> Developed by Mysoftheaven (BD) Ltd.</h4>
<?php 
$book_status = "Requesting";
$this->db->where('status ', $book_status);
$this->db->from('booking');
$request =  $this->db->count_all_results();
?>   
	<div style="height:60px;">
	
	</div>
	<div style="font-size:90px; font-weight:bold; text-align:center; color:#003C00"><blink>
	<?php echo $request; ?></blink>
	</div>
	<div style="font-size:90px; font-weight:bold; text-align:center">Request</div>
 <?php // echo(CI_VERSION); ?>
</div>
</body>
</html>