<html><head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />
</head>
		<body>
        <?php $download_type = $this->db->where("id",$type)->get('lib_download_type')->row()->download_type; ?>
		<div style="height:auto; margin:0 auto; width:95%; margin-top:20px;">
		<div style="text-align:center; font-family:Arial; font-size:18px; font-weight:bold; margin-bottom:10px;"><?php echo $download_type; ?></div>
        <?php if($msg =="No Data Match"){?>
		<div style="width:53%;border:4px #9BBB59 solid; font-family:arial; padding:2px; text-align:center; margin:0 auto;"><img src="<?php echo base_url();?>/img/company_photo/no_result.jpg"</div>
		<?php	
		}
		else
		{
		?>
		<table  class="search_tab" border="1"  cellpadding='2' cellspacing='1' style='font-size:13px; text-align:center; border: 1px solid gray; border-collapse:collapse; font-family:arial; border-radius:3px;'>
	
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
<td><a target="_blank" href="<?php echo base_url();?>img/uploads/digital_colection/<?php echo $file[$i]?>"><img src="<?php echo base_url();?>img/company_photo/download.jpg" > </a></td>
</tr>

<?php

}

?>

</table>
<?php
echo $this->pagination->create_links();
		}
?>
</div>
</body></html>