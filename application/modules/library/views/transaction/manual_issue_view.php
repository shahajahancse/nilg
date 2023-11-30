

<?php if (!empty($css_files)):
  foreach($css_files as $file): ?>
	 <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php  endforeach; endif; ?>

<?php
	$lib_book = 'unchecked';
	$lib_journal = 'unchecked';
	$lib_thesis = 'unchecked';

	if (isset($_POST['submit'])) {
		$selected_radio = $this->input->post('radioValue');
		if ($selected_radio == 'lib_book') {
			$lib_book = 'checked';
		} else if ($selected_radio == 'lib_journal') {
			$lib_journal = 'checked';
		} else if ($lib_thesis == 'lib_thesis') {
			$lib_thesis = 'checked';
		}
	}
?>


<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> লাইব্রেরি </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    <div class="grid simple horizontal">
      <div class="grid-title">
        <h4><span class="semi-bold"><?php echo $meta_title?></span></h4>
      </div>

      <div style="margin-bottom: 20px;">
				<div style="width:85%; padding:15px;">
					<form  id="manual_booking" name='book_fine' action="<?php echo base_url(); ?>library/transaction/manual_issue"  method="post">
						<fieldset style='margin: 0 auto;'>
							<legend  style="color:Black; font-size:18px"><b>নির্বাচন করুন </b></legend>
							<table width='100%' border='0' align='center' style='padding:10px; font-size: 16px; '>
								<tr>
									<td><input type="radio" name="radioValue" value="lib_book" id="radioValue" <?PHP print $lib_book; ?> required /> বই</td>
									<td><input type="radio" name="radioValue" value="lib_journal" id="radioValue" <?PHP print $lib_journal; ?> required /> জার্নাল</td>
									<td><input type="radio" name="radioValue" value="lib_thesis" id="radioValue" <?PHP print $lib_thesis; ?> required /> থিসিস</td>
								</tr>
							</table>
						</fieldset>

						</br>

						<FIELDSET style=" margin:0 auto;">
							<LEGEND style="color:Black; font-size:18px"><b>ম্যানুয়াল সমস্যা</b></LEGEND>
							<table  border='0' align='center' style='width: 100%;'>
								<tr height="10px;"></tr>
								<tr>
									<td style="font-size: 16px">সদস্য আইডি লিখুন</td>
									<td style="font-size: 16px">বারকোড নম্বর লিখুন</td>
								</tr>
								<tr>
								  <td> <input style='background-color:#cccccc;' type='text' size='27px' name='mem_id' id='mem_id' placeholder="সদস্য আইডি লিখুন"  value="<?php if (isset($_POST['mem_id'])){echo $_POST['mem_id'];} else{ echo "";} ?>" required  ></td>
								  <td> <input style='background-color:#cccccc;' type='text' size='27px' name='acc_no' id='acc_no' placeholder="বারকোড নম্বর লিখুন" value="<?php if (isset($_POST['acc_no'])){echo $_POST['acc_no'];} else{ echo "";} ?>" required  ></td>
								</tr>
								<tr height="10px">
									<td><input type="hidden" value="<?php if(isset($group_no)){echo $group_no;}else{echo " ";} ?>" name="group_no" id="group_no" /></td>
								</tr>
								<tr>
									<td>
									 <input  type="submit" name='submit'  value='সংরক্ষণ' class="btn btn-success" />
									</td>
								</tr>
							</table>
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
								<?php if($available != 0) { ?>
									<div align="center" style="padding-right:70px"><input type="submit" class="submit"  name="submit" value="Issue" formaction="<?php echo base_url(); ?>index.php/transaction/paper_issue" /></div>
								<?php } else {?>
									<div style="font-size:20px; color:#CC0033; text-align:center"><blink>Not available for Issue</blink></div>
								<?php } ?>
							</div>
						<?php } ?>
					</form>
				</div>
      </div>

     </div>
  </div> <!-- END ROW -->
</div>


<?php if (!empty($js_files)) :
  foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php  endforeach; endif; ?>



