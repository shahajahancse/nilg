<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fine Report</title>
<link rel="stylesheet" type="text/css" href="../../../../../css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="../../../../../css/SingleRow.css" />

</head>

<body>
<?php $this->load->view("head_english"); ?>
<div style=" margin:0 auto;  width:800px;">
<!--Report title goes here-->
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;">
Fine Report</span><br /><br />




<table  height="32" border="1" align="center" cellpadding="5" cellspacing="0" class="sal" style="font-size:12px; text-align:center">
<tr style="padding:2px; background:#EAEAEA; font-weight:bold; text-align:center; font-size:14px">
<td >SL</td>
<td >Mem ID</td> 
<td>Acc. No</td> 
<td>Issued Date</td> 
<td width="140px">Fine Day </td> 
<td width="140px">Fine</td> 
</tr>

<?php
$count = count($value["mem_id"]);
for($i=0; $i<$count; $i++ )
{?>
	<tr>
	<?php
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $value["mem_id"][$i];
	echo "</td>";
	
	echo "<td>";
	echo $value["acc_no"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $value["issued_date"][$i];
	echo "</td>";
	
	echo "<td>";
	echo $value["fine_day"][$i];
	echo "</td>";
	
	echo "<td>";
	echo $value["fine"][$i];
	echo "</td>";

	echo "</tr>";
}

?>

</table>
</div>
</div>
</body>
</html>