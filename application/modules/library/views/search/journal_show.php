<html><head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
		<script type='text/javascript' src='<?php echo base_url();?>js/dynamic.js'></script>
		</head>
		<body>
		<div style="height:auto; width:753px; margin:0 auto">
		<table width="100%"  class='sal' border='1' cellpadding='0' cellspacing='0' align='center' style='font-size:14px; text-align:center; border: 1px solid gray;'>
		<?php 
//echo $author[4];
//$count = count ($value["author"]);
$count = count ($title);
$count = $count - 1;
for($i=0;$i<=$count; $i++){
if($i%2==0)
{
$class = "odd";
}
else
{
$class = "even";
}
?>
		
		
		
<tr class="<?php echo $class; ?>" style="border-bottom:1px solid black; "><td width="10%" style='border:0;  padding-left: 5px; '><a  style="text-decoration:none;" href='<?php echo base_url();?>index.php/search_con/book_details/<?php echo $isbn[$i];?>'><img src='<?php echo base_url();?>img/uploads/book_image/media_book.gif'/>BOOK/TEXT</a></td>
<td width='70%' style='border:0;'>
		<a  style="text-decoration:none; color:#512828" href='<?php echo base_url();?>index.php/search_con/journal_details/<?php echo $issn[$i];?>'><div  style='width:100%;height:auto; font-size: 19px;'><?php echo $title[$i];?></div>
<div  style='width:100%; height:auto; font-size: 15px;   padding-top: 10px; color:#A65353' ><?php echo $trans_co_author[$i];?>
</div>
<div  style='width:100%; height:auto; font-size: 15px;   padding-top: 10px;color:#A65353' >ISSN : <?php echo $issn[$i];?>
</div></a>
</td>
<?php
$image_placeholder = $image[$i];
if($image[$i] == "")
{
	$image_placeholder = "book_placeholder.jpg";
}
?>
<td width='20%' style='border:0;;padding-top:7px'><a  style="text-decoration:none; color:#512828" href='<?php echo base_url();?>index.php/search_con/book_details/<?php echo $isbn[$i];?>'><img src='<?php echo base_url();?>img/uploads/book_image/<?php echo $image_placeholder;?>' height="85" width="78"/>
</td>
</tr>
<tr><input  id='book_id' value='$call_no' type='hidden' style='border:none' /></tr>
<?php

}
?>
</table>

</div>


<?php
echo $this->pagination->create_links();
?>

			
			</body></html>