<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
<script type='text/javascript' src='<?php echo base_url();?>js/dynamic.js'></script>
</head>
<body class="body_back">

<?php 
if(isset($value)){ 
//$this->load->view("head_english");
?>
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:17px; font-weight:bold;">
Request List </span> 

</div></br>

<table border='1' cellpadding='5px' cellspacing='0' style=" font-size:13px; margin: 0 auto;">

<tr height="20" style="background:#cccccc">
  <td  width="60"><div align="center"><strong>Member ID </strong></div></td>
  <td  width="60"><div align="center"><strong>Name</strong></div></td>
  <td width="100"><div align="center"><strong>Subject</strong></div></td>
  <td width="80"><div align="center"><strong>Title</strong></div></td>
  <td width="60"><div align="center"><strong>ISBN/ISSN</strong></div></td>
  <td width="60"><div align="center"><strong>Issue Acc No</strong></div></td>
  <td width="60"><div align="center"><strong>Call No</strong></div></td>
  <td  width="60"><div align="center"><strong>Requesting Date </strong></div></td>
  <td  width="60"><div align="center"><strong>Actions</strong></div></td>
</tr>

<?php 

$count = count ($value["mem_id"]);
$count = $count - 1;
for($i=0;$i<=$count; $i++){
$memid = $value["mem_id"][$i];
$group_no = $value["group_no"][$i];
//$acc_no = $value["acc_no"][$i];
?>
<form  id="req_to_issued" name='req_to_issued' action="<?php echo base_url(); ?>index.php/transaction/all_req_issued/<?php echo $i;?>"  method="post">
<tr style="background:#EAEAEA">

<input type="hidden" value="<?php echo $value["mem_id"][$i];?>" id="mem_id<?php echo  $i ?>" name="mem_id<?php echo  $i ?>"  />
<input type="hidden" value="<?php echo $value["group_no"][$i];?>" id="group_no<?php echo  $i ?>" name="group_no<?php echo  $i ?>"  />
<input type="hidden" value="<?php echo $value["acc_no"][$i];?>" id="acc_no<?php echo  $i ?>" name="acc_no<?php echo  $i ?>"  />
<input type="hidden" value="<?php echo $value["paper_id"][$i];?>" id="paper_id<?php echo  $i ?>" name="paper_id<?php echo  $i ?>"  />
  <td align="center"><?php echo $value["mem_id"][$i];?></td>
  <td><?php echo $value["f_name"][$i]." ".$value["l_name"][$i];?></td>
  <td ><div align="center"><?php echo $value["subject"][$i];?></div></td>
    <td align="center"><?php echo $value["title"][$i];?></td>
    <td><?php echo $value["group_no"][$i];?></td>
     <td><input type="text"  id="issue_acc_no<?php echo  $i ?>" name="issue_acc_no<?php echo  $i ?>"  /></td>
  <td><?php echo $value["call_no"][$i];?></td>
  <?php
  $date_time = $value["requesting_date"][$i];
  $new_date = date('d-M-Y h:i:s A', strtotime($date_time));

  
   ?>
  <td><?php echo $new_date?></td>
  <td style='border-bottom:1px solid black;'> <div style="height:45px;"><input  type="submit" name='submit1'  value='Issue' class="submit" /></div><div><input  type="submit" name='submit1'  value='Cancell' formaction="<?php echo base_url(); ?>index.php/transaction/all_req_cancel/<?php echo $i;?>" class="submit" /></div></td>
</tr>
</form>
<?php
}
}
else
{
echo "Requested List Empty";
}

?>
</table>

</body>
</html>