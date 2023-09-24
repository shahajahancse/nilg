
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
	<div class="content">
	    <ul class="breadcrumb" style="margin-bottom: 20px;">
	      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
	      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
	      <li><?=$meta_title; ?> </li>
	    </ul>


		<?php $requset_count = $requestins_sts->num_rows();
			if(isset($acc_no)){
				$issued_count = count($acc_no);
			}	
		?>


		<div style="width:70%; margin:0 auto">
			<FIELDSET>
				<LEGEND style="color:#FF8080; font-size:18px"><b>Member Status</b></LEGEND>
				<table>
						<tr>
						<td style="font-size: 19px;">No. of  Request</td><td>:</td>
						<td style="color:#2E5694;font-size: 18px;"><?php if (isset($requset_count)){echo $requset_count;} else {echo "No Request";}?></td>
						</tr>

						<tr>
						<td style="font-size: 19px;">No. of  Issued</td><td>:</td>
						<td style="color:#2E5694;font-size: 18px;"><?php if (isset($issued_count)){echo $issued_count;} else {echo "No Issued";}?></td>
						</tr>
				</table>
			</FIELDSET>
			<?php if (isset($issued_count)) { ?>
			<FIELDSET>
				<LEGEND style="color:#FF8080; font-size:19px"><b>Issued Details</b></LEGEND>
				<table>

					<?php for($i=0;$i<=$issued_count -1; $i++){
						if($i%2==0)
						{
							$class = "odd";
						}
						else
						{
							$class = "even";
						}
					?>
					<tr class="<?php echo $class; ?>" style="border-bottom:1px solid black; ">
						<td width="10%" style='border:0;  padding-left: 5px; '><img src='<?php echo base_url();?>img/uploads/book_image/media_book.gif'/>BOOK/TEXT</td>
						<td width='70%' style='border:0; text-align:center'>
							<div  style='width:100%;height:auto; font-size: 19px;'><?php echo $title[$i];?></div>
							<div  style='width:100%; height:auto; font-size: 15px;   padding-top: 10px; color: #A65353' ><?php echo $first_subject[$i];?></div>
						</td>
						<?php   if(!$image[$i]){ $image[$i] ="images.jpg"; } ?>

						<td width='20%' style='border:0;padding-top:7px'><img src='<?php echo base_url();?>img/uploads/book_image/<?php echo $image[$i];?>' height="85" width="78"/></td>
					</tr>
					<?php } ?>
				</table>	
		   </FIELDSET> 
			<?php } ?>
		</div>
  	</div> <!-- END ROW -->
</div>

<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>