<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSH Payroll</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
</head>

<body style="margin:0px;" >

<div style="margin:0 auto; width:100%; height:60px;; overflow:hidden;" class="head_back">
<div style=" width:68%; font-weight: 900; text-align:center; font-family:'Comic Sans MS';float:left;">
	<div style=" height:auto; width:10%; overflow:hidden; float:left; text-align:left; padding:10px;">
	<?php
	$this->db->select('logo');
	$query = $this->db->get('library_info');
	foreach($query->result() as $rows)
	{
		$logo = $rows->logo;
	}
	
	?>
	<img  height="40" src="<?php echo base_url(); ?>img/company_photo/<?php echo $logo; ?>" />
	</div>
	<div style=" height:auto; width:60%; overflow:hidden; font-size:25px; float:right; text-align:right; color:#FFFFFF;">
	Advanced Library Management System 
	</div>
</div>
<div style="padding:10px; width:30%; float:right;"> 
<?php
if($this->session->userdata('logged_in')==true)
	{
		?>
		<div style="text-align:right; color: #CC0000;">
		<?php
		echo "Welcome, ";
		echo "<b>".$this->session->userdata('mem_id')." ! "."</b> ";
		
		?>
		 <a  href="<?php echo base_url(); ?>index.php/logout_FE"  target="_top" style="text-decoration:none; color:black;">
		<img src="<?php echo base_url(); ?>img/company_photo/exit.png" alt="Exit" />
		</a>
		</div>
		<?php
	}
?>
</div>
</div>

</body>
</html>
