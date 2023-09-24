
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />


<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<div style="width:80%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">


			<form  id="req_to_issued" name='req_to_issued' action="<?php echo base_url(); ?>index.php/transaction/ongoing_request"  method="post">
				<div style=" margin:0 auto;height:100px;">
					<FIELDSET style="margin:0 auto;">
						<LEGEND style="color:Black; font-size:18px"><b>Request To Issued </b></LEGEND>
						<table  border='0' align='center' style='width: 100%;'>
							<tr height="10px;"></tr>
							<tr>
							  <td><input style='background-color:#cccccc;' type='text' size='27px' name='mem_id' id='mem_id' placeholder="Enter Member ID"  value="<?php if (isset($_POST['mem_id'])){echo $_POST['mem_id'];} else{ echo "";} ?>" required  ></td>
							  <td><input  type="submit" name='submit1'  value='Submit' class="submit" /></td>
							</tr>
						</table>
					</FIELDSET>
				</div>

				<?php if(isset($f_name)){ ?>
					<div style=" margin:0 auto; background: #EEEEEE">
						<table width="100%"  border='1' cellpadding='0' cellspacing='0' align='center' style='font-size:14px; text-align:center; border: 1px solid gray;'>
							<?php 	if(!$image){ $image ="mem_images.jpg"; }?>
							<tr style="border-bottom:1px solid black; ">
								<td width="10%" style='border:0;  padding-left: 5px; '><img width="70" height="70" src='<?php echo base_url(); ?>img/uploads/mem_image/<?php echo $image; ?>'/></td>
								<td width='70%' style='border:0;'>
									<div  style='width:100%;height:auto; font-size: 19px;'>Name : <?php echo $f_name." ".$l_name;?></div>
									<div  style='width:100%; height:auto; font-size: 15px;   padding-top: 10px; color:#A65353' >Designation : <?php echo $designation;?></div>
									<div  style='width:100%; height:auto; font-size: 15px;   padding-top: 10px;color:#A65353' >Email : <?php echo $email;?></div>
								</td>
							</tr>
						</table>
					</div>

					<div style="height:auto; width:753px; margin:0 auto;" >
						<table width="100%"  class='sal' border='0' cellpadding='0' cellspacing='0' align='center' style='font-size:14px; text-align:center; border:2px solid #43835F; border-radius:3px; padding:3px;'>
							<?php 
							$count = count ($acc_no);
							$count = $count - 1;
							for($i=0;$i<=$count; $i++){ ?>	
								<input type="hidden" value="<?php echo $group_no[$i];?>" id="group_no<?php echo  $i ?>" name="group_no<?php echo  $i ?>"  />
								<input type="hidden" value="<?php echo $acc_no[$i];?>" id="acc_no<?php echo  $i ?>" name="acc_no<?php echo  $i ?>"  />	
								<input type="hidden" value="<?php echo $paper_id[$i];?>" id="paper_id<?php echo  $i ?>" name="paper_id<?php echo  $i ?>"  />
								<tr style=" padding-bottom:5px; ">
									<?php $image =  $paper_image[$i]; if(!$image){ $image ="images.jpg"; } ?>
									<td style='border:0;padding-top:7px; padding-bottom:7px; border-left:1px solid; border-bottom:1px solid;border-top:1px solid;'><img src='<?php echo base_url();?>img/uploads/book_image/<?php echo $image;?>' height="85" width="78"/>
									<td width='70%' style='border-top:1px solid;border-bottom:1px solid;'>
											<div  style='width:100%;height:auto; font-size: 19px;'><?php echo $title[$i];?></div>
									<div  style='width:100%; height:auto; font-size: 15px;   padding-top: 10px; color:#A65353' ><?php echo $first_subject[$i];?>
									</div>
									<div  style='width:100%; height:auto; font-size: 15px; font-weight:bold;  padding-top: 10px; color:#A65353' >ISBN/ISSN: <?php echo $group_no[$i];?>
									</div>
									<div  style='width:100%; height:auto; font-size: 15px; font-weight:bold;  padding-top: 10px; color:#A65353' ><input type="text"  id="issue_acc_no<?php echo  $i ?>" name="issue_acc_no<?php echo  $i ?>" placeholder="Enter Barcode"  />
									</div>
									</td>
									<td style='border-top:1px solid;border-right:1px solid;border-bottom:1px solid;'> 
										<div style="height:35px;"><input type="submit" class="submit" value="Issue" width="100" height="25" formaction="<?php echo base_url(); ?>index.php/transaction/req_issued/<?php echo $i;?>"/></div>
										<div><input type="submit" value="Cancell" class="submit" width="100" height="25" formaction="<?php echo base_url(); ?>index.php/transaction/req_cancel/<?php echo $i;?>" /></div>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
				<?php } ?> 
			</form>


		</div>
  </div> <!-- END ROW -->
</div>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/dynamic.js"></script>