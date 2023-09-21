<html><head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />
</head>
		<body>
		<div style="height:auto; margin:0 auto; width:95%; margin-top:20px;">
		<div style="text-align:center; font-family:Arial; font-size:18px; font-weight:bold; margin-bottom:10px;"><?php if($search_type == "keywords"){ echo "Keywords Search";}else { echo "Guided Search";} ?></div>
        <div style="height:30px;"><a  href="javascript: history.go(-1)" style="text-decoration:none;"><input type="button" value="Back" style="border-radius:5px;border:2px solid #8FCD99;background:#BEF3CC; cursor:pointer" /></a></div>
		<div style="width:110px; float:left; font-weight:bold; font-family:arial;">Total Results: </div><div style="color:#19A751; width:50px; float:left;"><?php echo $num_rows1; ?> </div>
		<?php //$this->load->view('search/book_search_all'); ?>
		<table  class="search_tab" border="1"  cellpadding='2' cellspacing='1' style='font-size:13px; text-align:center; border: 1px solid gray; border-collapse:collapse; font-family:arial;'>
	
		<th>Title</th>
		<th>Author</th>
		<th>Publisher</th>
		<th>Year</th>
		<th>Availability</th>
		
		<?php 
//$count = count ($value["author"]);
$count = count ($trans_co_author);
$count = $count - 1;
for($i=0;$i<=$count; $i++){	
?>
<!--
<tr onClick="document.location='link.php';">-->
<tr>

<td><a  style="text-decoration:none; color: #0000A0;" href='<?php echo base_url();?>index.php/library/journal_details_all/<?php echo $issn[$i];?>'><?php echo $jtitle[$i];?></a></td>
<td><?php echo $trans_co_author[$i];?></td>
<td><?php echo $publisher[$i];?></td>
<td><?php echo $y_of_pub[$i];?></td>
<?php $journal_issn = $issn[$i];
//echo $journal_issn;
$num_of_total_journal = $this->db->where('issn',$journal_issn)->get('lib_journal')->num_rows();
$available_total_journal = $num_of_total_journal -1;
$num_of_request_journal = $this->db->where('group_no',$journal_issn)->where('status',"Requesting")->get('booking')->num_rows(); 
$num_of_issued_journal = $this->db->where('group_no',$journal_issn)->where('status',"Issued")->get('booking')->num_rows();
$total_action = $num_of_request_journal  +  $num_of_issued_journal;
if($available_total_journal > $total_action)
{
		$msg = "Available";
}
else
{
	$msg = "Not Available";
}
 ?>
<td><?php echo $msg;?></td></tr>
<?php

}

?>
<tr><input  id='journal_id' value='$call_no' type='hidden' style='border:none' /></tr>

</table>
<?php

echo $this->pagination->create_links();
?>
</div>




			
			</body></html>