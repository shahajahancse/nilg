<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory Report</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/report.css" />


</head>

<body>

<div style=" margin:0 auto;  width:412px;">
<div class="report_header" align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
<?php $this->load->view("head_english"); ?>Inventory Report
<br />
<br />
</div>


<table class="reportTable"  border="1" align="center" cellpadding="3" cellspacing="0">
<tr class="report_head" style="background: #9BBB59;">
<td>SL</td>
<td>Accessories name </td> 
<td>Total </td> 
<td>Last update </td> 
<td>Remarks</td> 

<?php
$count = count($values["accessories"]);
for($i=0; $i<$count; $i++ )
{?>
	<tr >
	<?php
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $values["accessories"][$i];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $values["total"][$i];
	echo "</td>";
	$date =  $values["last_updated"][$i];
	$new_date = date('d-M-Y', strtotime($date));

	echo "<td style='text-align:center'>";
	echo $new_date;
	echo "</td>";
	
	echo "<td >";
	echo $values["remarks"][$i];
	echo "</td>";
	
	echo "</tr>";
}

?>

</table>

</div>
</body>
</html>
