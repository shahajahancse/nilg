<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

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
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<div style="width:80%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">
			<form  name='book_fine' action="<?php echo base_url(); ?>library/transaction/renew_fine"  method="post">
				<fieldset style='margin: 0 auto;'>
					<legend  style="color:Black; font-size:18px"><b>Choose One </b></legend>
					<table width='100%' border='0' align='center' style='padding:10px'>
						<tr>
							<td><input type="radio" name="radioValue" value="lib_book" id="radioValue" <?PHP print $lib_book; ?> required /> Book</td>
							<td><input type="radio" name="radioValue" value="lib_journal" id="radioValue" <?PHP print $lib_journal; ?> required /> Journal</td>
							<td><input type="radio" name="radioValue" value="lib_thesis" id="radioValue" <?PHP print $lib_thesis; ?> required /> Thesis</td>
						</tr>
					</table>
				</fieldset>
				</br>

				<FIELDSET >
					<LEGEND style="color:#FF8080; font-size:18px"><b>Renew & Release</b></LEGEND>
					<table  border='0' style='padding:10px'>
						<tr>
							<td>Enter Member ID</td>
							<td>Enter Barcode </td  >
						</tr>
						<tr>
							<td><input style='background-color:#cccccc;' type='text' sname='mem_id' id='mem_id' placeholder="Enter Member ID"  value="<?php if (isset($_POST['mem_id'])){echo $_POST['mem_id'];} else{ echo "";} ?>" required  ></td>
							<td> <input style='background-color:#cccccc;' type='text' name='acc_no' id='acc_no' placeholder="Enter Barcode No" value="<?php if (isset($_POST['acc_no'])){echo $_POST['acc_no'];} else{ echo "";} ?>" required  ></td>
						</tr>
						
						<tr>
							<td><input  type="submit" name='submit1'  value='Submit'  class="btn btn-success"/></td>
							<td><a href="<?php echo base_url(); ?>library/transaction/all_fine_calc"  style="text-decoration:none">
							<input name="button" type="button"  value="All Fine Cal" class="btn btn-success" /></a></td>
						</tr>
					</table>
				</FIELDSET>
			</form>

			<form  name='book_release' action="<?php echo base_url(); ?>library/transaction/release_paper"  method="post">
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
							 <input type="image" src='<?php echo base_url();?>uploads/renew.png' alt="Renew" width="100" height="25" formaction="<?php echo base_url(); ?>library/transaction/renew_paper"/>-->
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
							<td> <input  type="submit" name='submit'  value='Renew' formaction="<?php echo base_url(); ?>library/transaction/renew_paper"  class="submit"/></td>
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

  </div> <!-- END ROW -->
</div>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/dynamic.js"></script>