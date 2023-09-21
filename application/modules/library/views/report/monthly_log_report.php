<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly Log Report</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/report.css" />


</head>

<body>
<div style=" margin:0 auto;  width:560px;">
<div class="report_header" align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
<?php $this->load->view("head_english"); ?>
Monthly Log Report of <?php echo "$year_month"; ?>
<br />
<br />
</div>

<table class="reportTable"  border="1" align="center" cellpadding="3" cellspacing="0">
<tr class="report_head" style="background: #9BBB59;">
<td >SL</td>
<td >ID/Name</td> 
<td>Type </td> 
<td>Designation</td> 
<td width="140px">In Time </td> 
<td width="140px">Out Time </td> 
  </tr>

<?php
$count = count($values["id_name"]);
for($i=0; $i<$count; $i++ )
{?>
	<tr style="font-size:13px; min-height:10px;">
	<?php
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $values["id_name"][$i];
	echo "</td>";
	
	echo "<td>";
	echo $values["type"][$i];
	
	echo "</td>";
	
	echo "<td >";
	echo $values["designation"][$i];
	echo "</td>";
	
	$date_intime = $values["in_time"][$i];
   	$new_indate = date('d-M-Y h:i:s A', strtotime($date_intime));
	
	echo "<td >";
	echo $new_indate;
	echo "</td>";
	
	$date_outtime = $values["out_time"][$i];
   	$new_outdate = date('d-M-Y h:i:s A', strtotime($date_outtime));
	
	echo "<td >";
	echo $new_outdate;
	echo "</td>";
	
	echo "</tr>";
}

?>

</table>
</div>
</body>
</html>