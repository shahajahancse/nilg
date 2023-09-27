<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />


<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

	<div class="grid simple horizontal red">
		<div class="grid-title">
			<h4><span class="semi-bold">জার্নাল</span> </h4>
			<!-- <a class="pull-right"  href="javascript: history.go(-1)"><input class="submit" type="button" value="Back" ></a> -->
		</div>
		<div class="grid-body">


			<div align="center" style=" margin:0 auto; position:relative; right:100px; overflow:hidden; font-family: 'Times New Roman', Times, serif;">
				<span style="font-size:28px; font-weight:bold; color:#006633">Detail Journal Report </span> 
			</div>
			</br>


			<div style="width:650px; height: auto; margin:0 auto; overflow:hidden;">
				<div style="width:460px; height:auto; float:left;padding:10; border-radius:7px; border:3px solid #2F5E5E;">
					<div style="font-size: 24px;"> <?php echo $value["title"];?></div><br />
					<div style="font-size: 19px;"><?php echo $value["trans_co_author"];?><br /></div>
					<br/>
					<?php $book_id = $value["id"];?> 

					<table>
						<tr >
						<td style="font-size: 19px;font-weight:bold;">Subject </td><td>:</td>
						<td style="font-size: 17px;"><?php echo $value["first_subject"];?> </td>
						</tr>
						
						
						<tr >
						<td style="font-size: 18px;font-weight:bold;">Source </td><td>:</td>
						<td style="font-size: 17px;"><?php echo $value["source"];?></td>
						</tr>
						
						<tr >
						<td style="font-size: 18px;font-weight:bold;">ISBN</td><td>:</td>
						<td style="font-size: 17px;"><?php echo $value["issn"];?></td>
						</tr>
						
						<tr >
						<td style="font-size: 18px;font-weight:bold;">Call No.</td><td>:</td>
						<td style="font-size: 17px;"><?php echo $value["call_no"];?></td>
						</tr>
					</table>

					<?php 
					$issn = $value["issn"]; 
					$no_copy = $this->db->where('issn',$issn)->from('lib_journal')->count_all_results(); 
					?>

					<?php
					$book_req = "Requesting";
					$this->db->where('group_no',$issn)->where('status',$book_req)->from('lib_booking');
					$request =  $this->db->count_all_results();
					?>

					<?php 
					$book_issued = "Issued";
					$this->db->where('group_no ',$issn)->where('status',$book_issued)->from('lib_booking');
					$issued =  $this->db->count_all_results();
					?>


					<FIELDSET style="margin-top:15px;">
						<LEGEND style="color:#FF8080; font-size:17px"><b>Journal Status</b></LEGEND>
						<table >
							<tr>
							<td style="font-size: 17px;font-weight:bold;">Total Copy</td><td>:</td>
							<td><?php echo $no_copy ;?></td>
							</tr>
							
							<tr>
							<td style="font-size: 17px;font-weight:bold;">No. of Journals Requesting</td><td>:</td>
							<td><?php echo $request ;?></td>
							</tr>
							

							
							<tr>
							<td style="font-weight:bold; font-size: 17px;">No. of Journals Issued</td><td>:</td>
							<td><?php echo $issued ;?></td>
							</tr>
							
							<tr >
							<td style="font-weight:bold; font-size: 17px;">Available Journals</td><td>:</td>
							<?php $available = ($no_copy -1) - ($issued + $request);?>
							<td><?php echo $available ;?></td>
							</tr>
						</table>
					</FIELDSET>
				</div>		
				<?php $image =  $value["image"]; if($image == ""){ $image ="book_placeholder.jpg"; } ?>

				<div style="width:auto; height:auto; float:left; position:relative; left:20px; border: #385F45 2px solid;">
					<img src="<?php echo base_url(); ?>img/uploads/book_image/<?php echo $image; ?>" height="100" width="88" alt="Image"  />
				</div>
			</div>
				
			<input  type="hidden" value="<?php echo $issn;?>" id="group_no" name="group_no">
			<input  type="hidden" value="lib_journal" id="table" name="table">
			<input  type="hidden" value="2" id="paper_id" name="paper_id">

			<?php if($available != 0) { ?>
				<div align="center" style="padding-right:70px; width:82%; margin-top:12px"><input type="submit"  class="submit" value="Booking" onClick="for_booking()"></div>
			<?php } else { ?>
				<div style="font-size:20px; color:#CC0033; text-align:center; width:82%"><blink>Not available for booking</blink></div>
			<?php } ?>


		</div>
    </div>
  </div> <!-- END ROW -->
</div>


<script type='text/javascript' src='<?php echo base_url();?>assets/js/dynamic.js'></script>