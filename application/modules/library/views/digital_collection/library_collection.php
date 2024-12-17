<html><head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />
</head>
		<body>
		<div style="height:auto; margin:0 auto; width:95%; margin-top:20px;">
		<div style="text-align:center; font-family:Arial; font-size:18px; font-weight:bold; margin-bottom:10px;">Islamic Corner</div>
		<table  class="search_tab" border="1"  cellpadding='2' cellspacing='1' style='font-size:13px; text-align:center; border: 1px solid gray; border-collapse:collapse; font-family:arial;'>
	
		<th>Title</th>
		<th>Author's</th>
		<th>File</th>
		
		<?php
//$count = count ($value["author"]);
$count = count($is_title);
$count = $count-1;
for($i=0;$i<=$count; $i++){	
?>
<!--
<tr onClick="document.location='link.php';">-->
<tr>

<td><?php echo $is_title[$i];?></td>
<td><?php echo $author[$i];?></td>
<td><a target="_blank" href="<?php echo base_url();?>img/uploads/digital_colection/<?php echo $file[$i]?>"><?php echo $file[$i];?></a></td>
</tr>

<?php

}

?>
<tr><input  id='book_id' value='$call_no' type='hidden' style='border:none' /></tr>
</table>
<?php
echo $this->pagination->create_links();
?>
</div>
</body></html>