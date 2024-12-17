
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
			<h4><span class="semi-bold">বই</span> </h4>
			<!-- <a class="pull-right"  href="javascript: history.go(-1)"><input class="submit" type="button" value="Back" ></a> -->
		</div>
		<div class="grid-body">


			<div align="center" style=" margin:0 auto; position:relative; right:100px; overflow:hidden; font-family: 'Times New Roman', Times, serif;">
				<span style="font-size:28px; font-weight:bold; color:#006633">Detail Book Report</span> 
			</div>
			</br>

			<?php $image =  $value["image"]; if($image == "") { $image = "book_placeholder.jpg"; } ?>
			<div style="width:600px; height: auto; margin:0 auto; overflow:hidden;">
				<div style="border-radius:7px; border:2px solid #2F5E5E;">
					<table style="margin-left: 15px">
			            <tr>
			            <td><div style=" font-size: 24px; font-style:italic;"> <?php echo $value["title"];?></div></td>
			            <td  rowspan="3"><div>
						<img src="<?php echo base_url(); ?>img/uploads/book_image/<?php echo $image; ?>" height="100" width="88" alt="Image"  />
						</div></td>
			            </tr>
			            
			            <tr>
			            <td><div style=" font-size: 19px;"> <?php echo $value["first_author"];?></div></td>
			            </tr>
			        </table>
					<br/>

					<table style="margin-left: 15px">
						<?php $book_id = $value["id"];?> 
						<tr >
						<td style="font-size: 19px; font-weight:bold;">Subject </td><td >:</td>
						<td style="font-size: 17px;"><?php echo $value["first_subject"];?> </td>
						</tr>
						
						<tr >
						<td style="font-size: 18px; font-weight:bold;">Edition </td><td style="font-size: 17px; font-weight:bold;">:</td>
						<td style="font-size: 17px;"><?php echo $value["edition"];?> </td>
						</tr>
						
						<tr >
						<td style="font-size: 18px; font-weight:bold;">Source </td><td style="font-size: 17px; font-weight:bold;">:</td>
						<td style="font-size: 17px;"><?php echo $value["source"];?></td>
						</tr>
						
						<tr >
						<td style="font-size: 18px; font-weight:bold;">ISBN</td><td style="font-size: 17px; font-weight:bold;">:</td>
						<td style="font-size: 17px;"><?php echo $value["isbn"];?></td>
						</tr>
						
						<tr >
						<td style="font-size: 18px;font-weight:bold;">Call No.</td><td style="font-size: 17px; font-weight:bold;">:</td>
						<td style="font-size: 17px;"><?php echo $value["call_no"];?></td>
						</tr>
					
					</table>

					<?php $isbn = $value["isbn"]; 
					$req = "Requesting";
					$issued = "Issued";
					$no_copy = $this->db->where('isbn',$isbn)->from('lib_book')->count_all_results(); 
					$request = $this->db->where('group_no ',$isbn)->where('status',$req)->from('lib_booking')->count_all_results(); 
					$issued = $this->db->where('group_no ',$isbn)->where('status',$issued)->from('lib_booking')->count_all_results();
					?>

					<FIELDSET style="margin-top:15px;">
						<LEGEND style="color:#FF8080; font-size:17px"><b>Book Status</b></LEGEND>
						<table style="margin-left: 15px">
							<tr>
							<td style="font-size: 17px; font-weight:bold; width:30%">Total Copy</td>
							<td style="font-size: 17px; font-weight:bold; width: 3%;"> : </td>
							<td><?php echo $no_copy;?></td>
							</tr>
							
							<tr>
							<td style="font-size: 17px; font-weight:bold; width:30%">No. of Books Requesting</td>
							<td style="font-size: 17px; font-weight:bold; width: 3%;"> : </td>
							<td><?php echo $request ;?></td>
							</tr>
							
							<tr>
							<td style="font-size: 17px; font-weight:bold; width:30%">No. of Books Issued</td>
							<td style="font-size: 17px; font-weight:bold; width: 3%;"> : </td>
							<td><?php echo $issued ;?></td>
							</tr>
							
							<tr>
							<td style="font-size: 17px; font-weight:bold; width:30%">Available Books</td>
							<td style="font-size: 17px; font-weight:bold; width: 3%;"> : </td>
							<?php $available = ($no_copy -1)- ($issued + $request);?>
							<td><?php echo $available ;?></td>
							</tr>
						</table>
					</FIELDSET>
				</div>
			</div>

			<input  type="hidden" value="<?php echo $isbn;?>" id="group_no" name="group_no">
			<input  type="hidden" value="lib_book" id="table" name="table">
			<input  type="hidden" value="1" id="paper_id" name="paper_id">
			<?php if($available != 0) { ?>
				<div align="center" style="padding-right:70px;  margin-top:12px"><input class="submit" type="button" value="Booking"  onClick="for_booking()" ></div>
			<?php } else {?>
				<div style="font-size:20px; color:#CC0033; text-align:center; width:90%"><blink>Not available for booking</blink></div>
			<?php } ?>




		</div>
    </div>
  </div> <!-- END ROW -->
</div>


<script type='text/javascript' src='<?php echo base_url();?>assets/js/dynamic.js'></script>