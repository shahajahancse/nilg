<html><head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />
</head>
		<body>
		<div style="height:auto; margin:0 auto; width:95%; margin-top:20px;">
		<div style="text-align:center; font-family:Arial; font-size:18px; font-weight:bold; margin-bottom:10px;"><?php if($search_type == "keywords"){ echo "Keywords Search";}else { echo "Guided Search";} ?></div>
        <div style="height:30px;"><a  href="javascript: history.go(-1)" style="text-decoration:none;"><input type="button" value="Back" style="border-radius:5px;border:2px solid #8FCD99;background:#BEF3CC; cursor:pointer" /></a></div>
		<div style="width:110px; float:left; font-weight:bold; font-family:arial;">Total Results: </div><div style="color:#19A751; width:50px; float:left;"><?php echo $num_rows1; ?> </div>
		<table  class="search_tab" border="1"  cellpadding='2' cellspacing='1' style='font-size:13px; text-align:center; border: 1px solid gray; border-collapse:collapse; font-family:arial;'>
	
		<th>Title</th>
		<th>Author's</th>
		<th>Edition</th>
		<th>Publisher</th>
		<th>Year</th>
		<th>Availability</th>
		
		<?php 
//$count = count ($value["author"]);
$count = count ($first_author);
$count = $count - 1;
for($i=0;$i<=$count; $i++){	
?>
<!--
<tr onClick="document.location='link.php';">-->
<tr>

<td><a  style="text-decoration:none; color: #004080;" href='<?php echo base_url();?>index.php/library/book_details_all/<?php echo $isbn[$i];?>'><?php
 $btitle[$i];

$limited = substr($btitle[$i], 0, 50).'...';
 echo $btitle[$i];

?>




</a></td>
<td><?php echo $first_author[$i];?></td>
<td><?php echo $edition[$i];?></td>
<td><?php echo $publisher[$i];?></td>
<td><?php  $year_id = $y_of_pub[$i];
 $pub_year = $this->db->where("id",$year_id)->get('lib_pub_year');
 if($pub_year->num_rows()>0){echo $pub_year->row()->pub_year;}else{echo 'N/A';}
?></td>
<?php $book_isbn = $isbn[$i];
//echo $book_isbn;
$num_of_total_book = $this->db->where('isbn',$book_isbn)->get('lib_book')->num_rows();
$available_total_book = $num_of_total_book -1;
$num_of_request_book = $this->db->where('group_no',$book_isbn)->where('status',"Requesting")->get('booking')->num_rows(); 
$num_of_issued_book = $this->db->where('group_no',$book_isbn)->where('status',"Issued")->get('booking')->num_rows();
$total_action = $num_of_request_book  +  $num_of_issued_book;
if($available_total_book > $total_action)
{
		$msg = "Available";
}
else
{
	$msg = "Not Available";
}
 ?>
<td><?php echo $msg;?></td>
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