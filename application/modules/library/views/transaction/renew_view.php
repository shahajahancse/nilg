<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Personal Info</title><meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>


</head>

<body  class="body_back">
 <?php

$lib_book = 'unchecked';
$lib_journal = 'unchecked';
$lib_thesis = 'unchecked';

if (isset($_POST['submit1'])) {
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


<div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">
<form  name='book_fine' action="<?php echo base_url(); ?>index.php/transaction/renew_fine"  method="post">
<fieldset style='margin: 0 auto;width: 50%;'><legend  style="color:Black; font-size:18px"><b>Choose One </b></legend>
<table width='100%' border='0' align='center' style='padding:10px'>
<tr>
<td><input type="radio" name="radioValue" value="lib_book" id="radioValue" <?PHP print $lib_book; ?> required />Book</td>
<td><input type="radio" name="radioValue" value="lib_journal" id="radioValue" <?PHP print $lib_journal; ?> required />Journal</td>
<td><input type="radio" name="radioValue" value="lib_thesis" id="radioValue" <?PHP print $lib_thesis; ?> required />Thesis</td>
</tr>
</table>

</fieldset>
</br>
<FIELDSET style="width:50%">
<LEGEND style="color:#FF8080; font-size:18px"><b>Renew & Release</b></LEGEND>
<table width='85%' border='0' style='padding:10px'>
<tr>
<td>Enter Member ID</td>
<td>Enter Barcode </td>
</tr>
<tr>
  <td> <input style='background-color:#cccccc;' type='text' size='27px' name='mem_id' id='mem_id' placeholder="Enter Member ID"  value="<?php if (isset($_POST['mem_id'])){echo $_POST['mem_id'];} else{ echo "";} ?>" required  ></td>
    <td> <input style='background-color:#cccccc;' type='text' size='27px' name='acc_no' id='acc_no' placeholder="Enter Barcode No" value="<?php if (isset($_POST['acc_no'])){echo $_POST['acc_no'];} else{ echo "";} ?>" required  ></td></tr>
	<tr height="15px"></tr>
 <tr><td> <!--<input type="image" name="submit1" src='<?php echo base_url();?>uploads/submit.gif' alt="Submit" width="100" height="25"/>-->
 <input  type="submit" name='submit1'  value='Submit'  class="submit"/></td>
 <td><a href="<?php echo base_url(); ?>index.php/transaction/all_fine_calc"  style="text-decoration:none">
   <input name="button" type="button"  style="width:100px;" value="All Fine Cal." class="submit" />
 </a></td>
 </tr>
 <!-- <td><input  type="submit" name='search'  value='Search' /></td>-->
</tr><tr></table>

   </FIELDSET>
</form>
<form  name='book_release' action="<?php echo base_url(); ?>index.php/transaction/release_paper"  method="post">
<?php  if(isset($id)) {?>
<FIELDSET style="width:50%;border:2px solid #43835F; ">
<LEGEND style="color:#FF8080; font-size:18px"><b>Information</b></LEGEND>
<table width='100%' border='0' align='center' style='padding:8px;'>
<input type="hidden" value="<?php echo $id;?>" id="id" name="id"  />
<input type="hidden" value="<?php if (isset($_POST['acc_no'])){echo $_POST['acc_no'];} else{ echo "";} ?>" id="acc_no" name="acc_no"  />
<input type="hidden" value="<?php if (isset($_POST['mem_id'])){echo $_POST['mem_id'];} else{ echo "";} ?>" id="mem_id" name="mem_id"  />
<input type="hidden" value="<?php echo $group_no;?> " id="group_no" name="group_no"  />
<input type="hidden" value="<?php echo $paper_id;?> " id="paper_id" name="paper_id"  />
<input type="hidden" value="<?php echo $selected_radio;?> " id="selected_radio" name="selected_radio"  />
	<tr>
		<td style="color:#000000; font-weight:bold; font-size: 18px;">Member ID</td><td>:</td>
		<td  style="font-size: 18px"> <?php echo $memid;?></td>
	<!--</tr>
		<td style="color:#EEEEEE; font-size: 18px;">Call No</td><td>:</td>
		<td style=" font-weight:bold;font-size: 18px"><?php echo $group_no;?> </td> 
	</tr>-->
	<tr>
		<td style="color:#000000; font-weight:bold; font-size: 18px;">Issued Date</td><td>:</td>
		<td  style="font-size: 18px"><?php echo $iss_date;?></td> 
	</tr>
		<?php 
		if(isset($getdays))
		{
		?>
		
	<tr>
		<td style="color:#000000; font-weight:bold; font-size: 18px;"> Fine Day</td><td>:</td>
		<td  style="font-size: 18px"><?php echo $getdays;?></td> 
	</tr>
	<tr>
		<td style="color:#000000; font-weight:bold; font-size: 18px;">Fine(TK.)</td><td>:</td>
		<td  style="font-size: 18px"><?php echo $fine;?></td>
	</tr>
	<tr>
		 <td style="color:#000000; font-weight:bold; font-size: 18px;">Enter Fine Receipt No.</td><td>:</td>
    <td> <input style='background-color:#cccccc;' type='text' size='27px' name='fine_rec_no' id='fine_rec_no' placeholder="Enter Fine Receipt No" value="" required  ></td>
	</tr>
	<?php } 
	else
	{
	echo "Date not expired";
	}
	?>
	<!--<input type="image" src='<?php echo base_url();?>uploads/release.png' alt="Release" width="100" height="25" />
	 <input type="image" src='<?php echo base_url();?>uploads/renew.png' alt="Renew" width="100" height="25" formaction="<?php echo base_url(); ?>index.php/transaction/renew_paper"/>-->
	<tr height="10px"></tr>
	</tr><td> <input  type="submit" name='submit'  value='Release'  class="submit" /></td>
	<td></td>
	<?php
			 if($selected_radio == "lib_book")
	 		{
	 			//echo "book";
				$is_no = "isbn";
	 		}
			 else if ($selected_radio == "lib_journal")
			 {
	 			//echo "journal";
				$is_no ="issn";
			 }
			
			
			
			$this->db->where($is_no,$group_no);
			$this->db->from($selected_radio);
			$no_copy =  $this->db->count_all_results();
			//echo $no_copy;
			$book_req = "Requesting";
			$this->db->where('group_no',$group_no);
			$this->db->where('status',$book_req);
			$this->db->from('booking');
			$request =  $this->db->count_all_results();
			//echo $request;
			$book_issued = "Issued";
			$this->db->where('group_no',$group_no);
			$this->db->where('status',$book_issued);
			$this->db->from('booking');
			$issued =  $this->db->count_all_results();
			//echo $issued;
			//$available = ($no_copy)- ($issued + $request);
			//echo $available;
			//if($available != 0)
			//{
			?>
	<td> <input  type="submit" name='submit'  value='Renew' formaction="<?php echo base_url(); ?>index.php/transaction/renew_paper"  class="submit"/></td>
	<?php //} 
	//else
	//{
	?>
	<!--<td> Not Available </td>-->
	<?php //} ?>
	<tr>
</table>
</FIELDSET>
<?php } ?>

</form>

</div>

</body>
</html>