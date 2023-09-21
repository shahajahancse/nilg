<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Personal Info</title><meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
<script type='text/javascript' src='<?php echo base_url();?>js/dynamic.js'></script>

</head>

 
<body class="body_back">



 <?php

$lib_book = 'unchecked';
$lib_journal = 'unchecked';
$lib_thesis = 'unchecked';

if (isset($_POST['submit'])) {
$selected_radio = $this->input->post('radioValue');

if ($selected_radio == 'lib_book') {
$lib_book = 'checked';
}
else if ($selected_radio == 'lib_journal') {
$lib_journal = 'checked';
}
else if ($lib_thesis == 'lib_thesis') {
$lib_thesis = 'checked';
}
}

?>
 
<div style="width:70%; margin:0 auto">
<!--<h1><font color="#FF0000"><marquee>Your text here</marquee></font></h1>-->
<form  id="manual_booking" name='book_fine' action="<?php echo base_url(); ?>index.php/transaction/manual_issue"  method="post">
<fieldset style='margin: 0 auto;width: 87%;'><legend  style="color:Black; font-size:18px"><b>Choose One </b></legend>
<table width='100%' border='0' align='center' style='padding:10px'>
<tr>
<td><input type="radio" name="radioValue" value="lib_book" id="radioValue" <?PHP print $lib_book; ?> required />Book</td>
<td><input type="radio" name="radioValue" value="lib_journal" id="radioValue" <?PHP print $lib_journal; ?> required />Journal</td>
<td><input type="radio" name="radioValue" value="lib_thesis" id="radioValue" <?PHP print $lib_thesis; ?> required />Thesis</td>
</tr>
</table>

</fieldset>
</br>
<FIELDSET style="width:87%; margin:0 auto;">
<LEGEND style="color:Black; font-size:18px"><b>Manual Issue</b></LEGEND>
<table  border='0' align='center' style='width: 100%;'>
<tr height="10px;"></tr>
<tr>
<td>Enter Member ID</td>
<td>Enter Barcode No</td>
</tr>
<tr>
  <td> <input style='background-color:#cccccc;' type='text' size='27px' name='mem_id' id='mem_id' placeholder="Enter Member ID"  value="<?php if (isset($_POST['mem_id'])){echo $_POST['mem_id'];} else{ echo "";} ?>" required  ></td>
    <td> <input style='background-color:#cccccc;' type='text' size='27px' name='acc_no' id='acc_no' placeholder="Enter Barcode No" value="<?php if (isset($_POST['acc_no'])){echo $_POST['acc_no'];} else{ echo "";} ?>" required  ></td></tr>
	<tr height="10px"><td><input type="hidden" value="<?php if(isset($group_no)){echo $group_no;}else{echo " ";} ?>" name="group_no" id="group_no" /></td></tr>
 <tr><td><!-- <input type="image" name="submit1" src='<?php echo base_url();?>uploads/submit.gif' alt="Submit" width="100" height="25"/>-->
 <input  type="submit" name='submit'  value='Submit' class="submit" /></td>
 </tr>
 <!-- <td><input  type="submit" name='search'  value='Search' /></td>-->
</tr><tr></table>
</FIELDSET>


<?php if(isset($f_name)){ ?>
	<div id="show_info" style=" margin: 0 auto; padding: 14px;  width: 85%; border:2px solid #43835F; border-radius:5px;">
	<FIELDSET>
			<LEGEND style="color:#FF8080; font-size:18px"><b>Member Status</b></LEGEND>
	<table>
			<tr >
			<td style="font-size: 19px;font-weight:bold">Name </td><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php if (isset($f_name)){echo $f_name." ".$l_name;} else {echo "No Request";}?></td>
			</tr>
			
		
			<tr>
			<td style="font-size: 19px;font-weight:bold">No. of  Requesting</td><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php if (isset($trans_request)){echo $trans_request;} else {echo "No Request";}?></td>
			</tr>

			<tr >
			<td style="font-size: 19px;font-weight:bold">No. of  Issued</td><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php if (isset($trans_issued)){echo $trans_issued;} else {echo "No Issued";}?></td>
			</tr>
	</table>
    </FIELDSET>
	<FIELDSET>
			<LEGEND style="color:#FF8080; font-size:18px"><b>Paper Status</b></LEGEND>
	<table>
			<tr >
			<td style="font-size: 19px; font-weight:bold">Subject </td><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php echo $subject;?></td>
			</tr>
			
		
			<tr>
			<td style="font-size: 19px;font-weight:bold">Title</td><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php if (isset($title)){echo $title;} else {echo "No Title";}?></td>
			</tr>
		
			<tr >
			<td style="font-size: 19px;font-weight:bold">Total Copy</td><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php if (isset($copy_no)){echo $copy_no;} else {echo "No Entry";}?></td>
			</tr>
			
			<tr >
			<td style="font-size: 19px;font-weight:bold">Available Copy</td ><td style="font-size: 19px;font-weight:bold">:</td>
			<td style="color:#000000;font-size: 18px;"><?php if (isset($available)){echo $available;} else {echo "Not Entry";}?></td>
			</tr>
	</table>
    </FIELDSET>
    <input  type="hidden" value="<?php echo $paper_id; ?>" id="paper_id" name="paper_id">
	<?php
	
	if($available != 0)
		{
		?>
		
		<div align="center" style="padding-right:70px"><input type="submit" class="submit"  name="submit" value="Issue" formaction="<?php echo base_url(); ?>index.php/transaction/paper_issue" /></div>
		<?php }
		else
		{?>
		<div style="font-size:20px; color:#CC0033; text-align:center"><blink>Not available for Issue</blink></div>
		<?php
		}
		?>
	</div>
	<?php } ?>
	<!--<input type="image" src='<?php echo base_url();?>uploads/issued.png' alt="Submit" width="100" height="25" formaction="<?php echo base_url(); ?>index.php/transaction/paper_issue"/>-->
</form>
</div>

 
</body>

</html>